<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KendaraanM;
use App\Models\MobileSyncEvent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class KendaraanChecklistApiController extends Controller
{
    private const FIELDS = [
        'no_urut',
        'tanggal',
        'jam',
        'nama_ekspedisi',
        'ket_nama_ekspedisi',
        'no_mobil',
        'ket_no_mobil',
        'no_kontainer',
        'ket_no_kontainer',
        'tujuan',
        'ket_tujuan',
        'nama_sopir',
        'ket_nama_sopir',
        'helm',
        'ket_helm',
        'celana_panjang',
        'ket_celana_panjang',
        'baju_lengan_panjang',
        'ket_baju_lengan_panjang',
        'sepatu',
        'ket_sepatu',
        'sim',
        'ket_sim',
        'masa_berlaku_sim',
        'ket_masa_berlaku_sim',
        'stnk',
        'ket_stnk',
        'masa_berlaku_stnk',
        'ket_masa_berlaku_stnk',
        'kir',
        'ket_kir',
        'masa_berlaku_kir',
        'ket_masa_berlaku_kir',
        'surat_pengantar_ekspedisi',
        'ket_surat_pengantar_ekspedisi',
        'segel',
        'ket_segel',
    ];

    public function index(Request $request): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        $search = trim($request->string('search')->toString());
        $records = KendaraanM::query()
            ->with('user:id,name')
            ->when($search !== '', fn ($query) => $query->where('no_mobil', 'like', '%'.$search.'%'))
            ->latest('id')
            ->paginate(min(max((int) $request->input('per_page', 30), 1), 100));

        return response()->json([
            'success' => true,
            'data' => $records->getCollection()
                ->map(fn (KendaraanM $record) => $this->formatRecord($record))
                ->values(),
            'meta' => [
                'current_page' => $records->currentPage(),
                'last_page' => $records->lastPage(),
                'total' => $records->total(),
            ],
        ]);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        $record = KendaraanM::with('user:id,name')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $this->formatRecord($record),
        ]);
    }

    public function sync(Request $request): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        if (is_string($request->input('payload'))) {
            $payload = json_decode($request->input('payload'), true);
            if (! is_array($payload)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payload Checklist Kendaraan tidak valid.',
                ], 422);
            }
            $request->merge(['payload' => $payload]);
        }

        $rules = [
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => 'required|in:KENDARAAN_CHECKLIST_CREATED',
            'client_timestamp' => 'required|date',
            'payload' => 'required|array',
            'payload.no_urut' => 'required|string',
            'payload.tanggal' => 'required|date',
            'payload.jam' => 'required|date_format:H:i:s',
            'payload.nama_ekspedisi' => 'required|string',
            'payload.no_mobil' => 'required|string',
            'payload.no_kontainer' => 'required|string',
            'payload.tujuan' => 'required|string',
            'payload.nama_sopir' => 'required|string',
            'payload.helm' => 'required|string',
            'payload.celana_panjang' => 'required|string',
            'payload.baju_lengan_panjang' => 'required|string',
            'payload.sepatu' => 'required|string',
            'payload.sim' => 'required|string',
            'payload.masa_berlaku_sim' => 'required|string',
            'payload.ket_masa_berlaku_sim' => 'nullable|date',
            'payload.stnk' => 'required|string',
            'payload.masa_berlaku_stnk' => 'required|string',
            'payload.ket_masa_berlaku_stnk' => 'nullable|date',
            'payload.kir' => 'required|string',
            'payload.masa_berlaku_kir' => 'required|string',
            'payload.ket_masa_berlaku_kir' => 'nullable|date',
            'payload.surat_pengantar_ekspedisi' => 'required|string',
            'payload.segel' => 'required|string',
        ];
        foreach ([
            'ket_nama_ekspedisi',
            'ket_no_mobil',
            'ket_no_kontainer',
            'ket_tujuan',
            'ket_nama_sopir',
            'ket_helm',
            'ket_celana_panjang',
            'ket_baju_lengan_panjang',
            'ket_sepatu',
            'ket_sim',
            'ket_stnk',
            'ket_kir',
            'ket_surat_pengantar_ekspedisi',
            'ket_segel',
        ] as $field) {
            $rules["payload.$field"] = 'nullable|string';
        }

        $data = $request->validate($rules);
        $existingEvent = MobileSyncEvent::where('event_id', $data['event_id'])->first();
        if ($existingEvent) {
            return $this->acknowledged(
                $data['event_id'],
                $existingEvent->payload['kendaraan_id'] ?? null,
            );
        }

        Validator::make($request->all(), [
            'no_mobil_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'no_kontainer_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ])->validate();

        $storedPaths = [];
        try {
            $record = DB::transaction(function () use ($request, $data, &$storedPaths) {
                $attributes = $data['payload'];
                foreach (self::FIELDS as $field) {
                    if (! array_key_exists($field, $attributes)) {
                        $attributes[$field] = null;
                    }
                }

                foreach (['no_mobil_foto', 'no_kontainer_foto'] as $slot) {
                    if (! $request->hasFile($slot)) {
                        $attributes[$slot] = null;

                        continue;
                    }
                    $path = $request->file($slot)->store('uploads', 'public');
                    $storedPaths[] = $path;
                    $attributes[$slot] = $path;
                }

                $attributes['user_id'] = $request->user()->id;
                $record = KendaraanM::create($attributes);

                MobileSyncEvent::create([
                    'event_id' => $data['event_id'],
                    'module' => 'checklist_kendaraan',
                    'aggregate_id' => $data['aggregate_id'],
                    'event_type' => $data['event_type'],
                    'payload' => [
                        ...$data['payload'],
                        'kendaraan_id' => $record->id,
                        'photos' => [
                            'no_mobil_foto' => $record->no_mobil_foto,
                            'no_kontainer_foto' => $record->no_kontainer_foto,
                        ],
                    ],
                    'device_id' => $request->input('device_id'),
                    'user_id' => $request->user()->id,
                    'client_timestamp' => Carbon::parse($data['client_timestamp']),
                    'synced_at' => now(),
                    'status' => 'APPLIED',
                ]);

                return $record->load('user:id,name');
            });
        } catch (Throwable $exception) {
            foreach ($storedPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            $existingEvent = MobileSyncEvent::where('event_id', $data['event_id'])->first();
            if ($existingEvent) {
                return $this->acknowledged(
                    $data['event_id'],
                    $existingEvent->payload['kendaraan_id'] ?? null,
                );
            }

            Log::error('Checklist Kendaraan mobile sync gagal', [
                'event_id' => $data['event_id'],
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Checklist Kendaraan belum dapat disimpan. Silakan coba sinkronkan kembali.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Checklist Kendaraan berhasil disimpan.',
            'data' => $this->formatRecord($record),
            'acknowledged_event_ids' => [$data['event_id']],
        ], 201);
    }

    private function accessDenied(Request $request): ?JsonResponse
    {
        $user = $request->user();
        $permissions = json_decode((string) $user->type, true);
        $permissions = is_array($permissions) ? $permissions : [$user->type];

        if (
            in_array((int) $user->role, [0, 5], true)
            || in_array('all', $permissions, true)
            || in_array('CK', $permissions, true)
        ) {
            return null;
        }

        return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki akses ke modul Checklist Kendaraan.',
        ], 403);
    }

    private function acknowledged(string $eventId, ?int $recordId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Event Checklist Kendaraan sudah pernah tersinkron.',
            'data' => ['id' => $recordId],
            'acknowledged_event_ids' => [$eventId],
        ]);
    }

    private function formatRecord(KendaraanM $record): array
    {
        $data = $record->only([
            'id',
            ...self::FIELDS,
            'no_mobil_foto',
            'no_kontainer_foto',
            'user_id',
            'created_at',
        ]);
        $data['responden'] = $record->user?->name;
        $data['no_mobil_foto_url'] = $record->no_mobil_foto
            ? asset('storage/'.$record->no_mobil_foto)
            : null;
        $data['no_kontainer_foto_url'] = $record->no_kontainer_foto
            ? asset('storage/'.$record->no_kontainer_foto)
            : null;

        return $data;
    }
}
