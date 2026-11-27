<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoilDamageM;
use App\Models\MobileSyncEvent;
use App\Services\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CoilDamageApiController extends Controller
{
    public function index(Request $request)
    {
        $query = CoilDamageM::with('user:id,name')->latest();

        if ($request->filled('search')) {
            $query->where('attribute', 'like', '%' . $request->string('search') . '%');
        }

        $items = $query->paginate(min((int) $request->input('per_page', 20), 100));

        return response()->json([
            'success' => true,
            'data' => collect($items->items())->map(fn (CoilDamageM $item) => $this->format($item)),
            'meta' => [
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'total' => $items->total(),
            ],
        ]);
    }

    public function sync(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:255',
            'event_type' => 'required|in:COIL_DAMAGE_REPORTED',
            'client_timestamp' => 'required|date',
            'berat_coil' => 'required|string|max:255',
            'jenis_handling' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'foto' => 'required|array|min:1',
            'foto.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $existingEvent = MobileSyncEvent::where('event_id', $validated['event_id'])->first();
        if ($existingEvent) {
            $damage = CoilDamageM::where('attribute', $validated['aggregate_id'])->first();
            return response()->json([
                'success' => true,
                'message' => 'Event Coil Damage sudah pernah disinkronkan.',
                'data' => $damage ? $this->format($damage) : null,
                'acknowledged_event_ids' => [$validated['event_id']],
            ]);
        }

        $paths = [];
        DB::beginTransaction();
        try {
            foreach ($request->file('foto', []) as $file) {
                $paths[] = $file->store('coil_damages', 'public');
            }

            $damage = CoilDamageM::create([
                'user_id' => $request->user()->id,
                'attribute' => $validated['aggregate_id'],
                'berat_coil' => $validated['berat_coil'],
                'jenis_handling' => $validated['jenis_handling'],
                'foto' => json_encode(array_map('basename', $paths)),
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            MobileSyncEvent::create([
                'event_id' => $validated['event_id'],
                'module' => 'coil_damage',
                'aggregate_id' => $validated['aggregate_id'],
                'event_type' => $validated['event_type'],
                'payload' => [
                    'damage_id' => $damage->id,
                    'berat_coil' => $validated['berat_coil'],
                    'jenis_handling' => $validated['jenis_handling'],
                    'keterangan' => $validated['keterangan'] ?? null,
                ],
                'user_id' => $request->user()->id,
                'client_timestamp' => $validated['client_timestamp'],
                'synced_at' => now(),
                'status' => 'APPLIED',
            ]);

            LogActivity::record(
                action: 'COIL_DAMAGE_REPORTED',
                module: 'Coil Damage Mobile',
                description: "Coil damage {$damage->attribute} dilaporkan melalui mobile."
            );

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            foreach ($paths as $path) {
                Storage::disk('public')->delete($path);
            }
            throw $e;
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Coil Damage berhasil disimpan.',
            'data' => $this->format($damage),
            'acknowledged_event_ids' => [$validated['event_id']],
        ], 201);
    }

    private function format(CoilDamageM $item): array
    {
        $photos = json_decode($item->foto ?? '[]', true) ?: [];

        return [
            'id' => $item->id,
            'attribute' => $item->attribute,
            'berat_coil' => $item->berat_coil,
            'jenis_handling' => $item->jenis_handling,
            'foto' => array_map(fn ($photo) => asset('storage/coil_damages/' . $photo), $photos),
            'keterangan' => $item->keterangan,
            'reported_by' => $item->user?->name,
            'created_at' => $item->created_at?->toIso8601String(),
        ];
    }
}
