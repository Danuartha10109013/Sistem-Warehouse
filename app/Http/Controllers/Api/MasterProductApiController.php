<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Models\MobileSyncEvent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Throwable;

class MasterProductApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search = trim($request->string('search')->toString());
        $records = MasterProduct::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('search_key', 'like', '%'.$search.'%')
                    ->orWhere('name', 'like', '%'.$search.'%');
            })
            ->latest('id')
            ->paginate(min(max((int) $request->input('per_page', 30), 1), 100));

        return response()->json([
            'success' => true,
            'data' => $records->getCollection()
                ->map(fn (MasterProduct $item) => $this->formatRecord($item))
                ->values(),
            'meta' => [
                'current_page' => $records->currentPage(),
                'last_page' => $records->lastPage(),
                'total' => $records->total(),
            ],
        ]);
    }

    public function sync(Request $request): JsonResponse
    {
        if (is_string($request->input('payload'))) {
            $payload = json_decode($request->input('payload'), true);
            if (! is_array($payload)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payload Master Product tidak valid.',
                ], 422);
            }
            $request->merge(['payload' => $payload]);
        }

        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => 'required|in:MASTER_PRODUCT_CREATED,MASTER_PRODUCT_UPDATED,MASTER_PRODUCT_DELETED',
            'client_timestamp' => 'required|date',
            'payload' => 'required|array',
        ]);

        $existingEvent = MobileSyncEvent::where('event_id', $data['event_id'])->first();
        if ($existingEvent) {
            return response()->json([
                'success' => true,
                'message' => 'Event Master Product sudah pernah tersinkron.',
                'data' => ['id' => $existingEvent->payload['product_id'] ?? null],
                'acknowledged_event_ids' => [$data['event_id']],
            ]);
        }

        Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ])->validate();

        $storedFoto = null;
        try {
            $result = DB::transaction(function () use ($request, $data, &$storedFoto) {
                $payload = $data['payload'];
                $product = null;

                if ($data['event_type'] === 'MASTER_PRODUCT_DELETED') {
                    $id = $payload['id'] ?? null;
                    if ($id) {
                        $product = MasterProduct::find($id);
                        if ($product) {
                            if ($product->foto) {
                                Storage::disk('public')->delete($product->foto);
                            }
                            $product->delete();
                        }
                    }
                } else {
                    $searchKey = trim((string) ($payload['search_key'] ?? ''));
                    $name = trim((string) ($payload['name'] ?? ''));
                    if ($searchKey === '' || $name === '') {
                        throw new \InvalidArgumentException('search_key dan name wajib diisi.');
                    }

                    $id = $payload['id'] ?? null;
                    $product = $id ? MasterProduct::find($id) : MasterProduct::where('search_key', $searchKey)->first();

                    $fotoPath = $product?->foto;
                    if ($request->hasFile('foto')) {
                        $file = $request->file('foto');
                        $manager = new ImageManager(new Driver());
                        $encoded = $manager->read($file->getRealPath())->toWebp(80);
                        $filename = 'master_products/'.$searchKey.'_'.time().'.webp';
                        Storage::disk('public')->put($filename, (string) $encoded);
                        $storedFoto = $filename;
                        if ($fotoPath) {
                            Storage::disk('public')->delete($fotoPath);
                        }
                        $fotoPath = $filename;
                    } elseif (! empty($payload['hapus_foto'])) {
                        if ($fotoPath) {
                            Storage::disk('public')->delete($fotoPath);
                        }
                        $fotoPath = null;
                    }

                    if ($product) {
                        $product->update([
                            'search_key' => $searchKey,
                            'name' => $name,
                            'foto' => $fotoPath,
                        ]);
                    } else {
                        $product = MasterProduct::create([
                            'search_key' => $searchKey,
                            'name' => $name,
                            'foto' => $fotoPath,
                        ]);
                    }
                }

                MobileSyncEvent::create([
                    'event_id' => $data['event_id'],
                    'module' => 'master_product',
                    'aggregate_id' => $data['aggregate_id'],
                    'event_type' => $data['event_type'],
                    'payload' => [
                        ...$payload,
                        'product_id' => $product?->id,
                    ],
                    'device_id' => $request->input('device_id'),
                    'user_id' => $request->user()->id,
                    'client_timestamp' => Carbon::parse($data['client_timestamp']),
                    'synced_at' => now(),
                    'status' => 'APPLIED',
                ]);

                return $product;
            });
        } catch (Throwable $exception) {
            if ($storedFoto) {
                Storage::disk('public')->delete($storedFoto);
            }
            Log::error('Master Product mobile sync gagal', [
                'event_id' => $data['event_id'],
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal sinkronisasi Master Product: '.$exception->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Master Product berhasil disimpan.',
            'data' => $result ? $this->formatRecord($result) : null,
            'acknowledged_event_ids' => [$data['event_id']],
        ], 201);
    }

    private function formatRecord(MasterProduct $item): array
    {
        return [
            'id' => $item->id,
            'search_key' => $item->search_key,
            'name' => $item->name,
            'foto' => $item->foto,
            'foto_url' => $item->foto ? asset('storage/'.$item->foto) : null,
            'created_at' => $item->created_at?->toIso8601String(),
        ];
    }
}
