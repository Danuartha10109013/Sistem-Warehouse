<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CraneM;
use App\Models\ForkliftM;
use App\Models\TraillerM;
use App\Models\EupM;
use App\Models\CrcM;
use App\Models\Crc_imageM;
use App\Models\IngotM;
use App\Models\Ingot_imageM;
use App\Models\ResinM;
use App\Models\Resin_imageM;
use App\Models\MobileSyncEvent;
use App\Models\TeamLeadM;
use App\Models\KapasitasM;
use App\Models\ShftM;
use App\Models\TrailerNameM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class FormCheckApiController extends Controller
{
    private const TYPES = ['crane', 'forklift', 'trailler', 'eup', 'crc', 'ingot', 'resin'];

    public function index(Request $request)
    {
        $type = $request->string('type')->toString();
        if (!in_array($type, self::TYPES, true)) {
            $type = 'crane';
        }

        $model = $this->modelFor($type);
        $query = $model::query()->orderByDesc('created_at')->orderByDesc('id');

        if ($request->filled('search')) {
            $term = '%' . $request->string('search') . '%';
            $query->where(function ($q) use ($term) {
                $q->where('shift_leader', 'like', $term)
                    ->orWhere('date', 'like', $term)
                    ->orWhere('catatan', 'like', $term)
                    ->orWhere('note_keseluruhan', 'like', $term);
            });
        }

        $rows = $query->limit(100)->get()->map(fn ($row) => $this->formatRow($row, $type))->values();
        $teamLeads = TeamLeadM::query()
            ->where('active', 1)
            ->whereJsonContains('type', 'FC')
            ->orderBy('name')
            ->pluck('name')
            ->unique()
            ->values();
        $capacityType = match ($type) {
            'crane' => 'Crane',
            'forklift' => 'Forklift',
            default => null,
        };
        $capacityQuery = KapasitasM::query()->orderBy('name');
        if ($capacityType !== null) {
            $capacityQuery->where('jenis', $capacityType);
            if ($type === 'crane') {
                $capacityQuery->where('division', $request->user()->division);
            }
        }
        $capacities = $capacityType === null
            ? collect()
            : $capacityQuery->pluck('name')->unique()->values();
        $shifts = ShftM::query()
            ->orderBy('shift')
            ->get(['shift', 'description'])
            ->map(fn ($row) => [
                'value' => (string) $row->shift,
                'label' => $row->description ?: (string) $row->shift,
            ])
            ->values();
        $trailers = TrailerNameM::query()
            ->orderBy('no_mobil')
            ->get(['no_mobil', 'pengguna'])
            ->map(fn ($row) => [
                'value' => $row->no_mobil . '/' . $row->pengguna,
                'label' => $row->no_mobil . '/' . $row->pengguna,
            ])
            ->values();
        $eupChoices = [
            'kaki_pallet' => [
                ['value' => 'Bentuk kaki simetris (Balok)', 'image' => asset('pallet1.jpg')],
                ['value' => 'Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata', 'image' => asset('pallet2.jpg')],
            ],
            'permukaan_pallet' => [
                ['value' => 'Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'image' => asset('pallet3.jpg')],
            ],
            'ketebalan_pallet' => [
                ['value' => 'Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'image' => asset('pallet4.png')],
            ],
            'paku_pallet' => [
                ['value' => 'Paku tidak Keluar', 'image' => asset('pallet4.png')],
            ],
            'keluar_pallet' => [
                ['value' => 'Paku Keluar', 'image' => asset('pallet9.png')],
            ],
            'kaba_simetris' => [
                ['value' => 'Bentuk kaki bagian bawah tidak simetris (Tidak Balok)', 'image' => asset('pallet5.jpg')],
            ],
            'kaba_asimetris' => [
                ['value' => 'Bentuk kaki bagian atas tidak simetris (Tidak Balok)', 'image' => asset('pallet6.jpg')],
            ],
            'papan_patah' => [
                ['value' => 'Papan Permukaan Pallet Patah', 'image' => asset('pallet7.jpg')],
            ],
            'papan_pecah' => [
                ['value' => 'Papan Permukaan Pallet Pecah', 'image' => asset('pallet8.jpg')],
            ],
        ];

        return response()->json([
            'success' => true,
            'type' => $type,
            'summary' => [
                'crane' => CraneM::count(),
                'forklift' => ForkliftM::count(),
                'trailler' => TraillerM::count(),
                'eup' => EupM::count(),
                'crc' => CrcM::count(),
                'ingot' => IngotM::count(),
                'resin' => ResinM::count(),
                'total' => CraneM::count() + ForkliftM::count() + TraillerM::count() + EupM::count() + CrcM::count() + IngotM::count() + ResinM::count(),
            ],
            'options' => [
                'team_leads' => $teamLeads,
                'capacities' => $capacities,
                'shifts' => $shifts,
                'trailers' => $trailers,
                'eup_choices' => $eupChoices,
            ],
            'types' => [
                ['code' => 'crane', 'name' => 'Crane'],
                ['code' => 'forklift', 'name' => 'Forklift'],
                ['code' => 'trailler', 'name' => 'Trailler'],
                ['code' => 'eup', 'name' => 'Pallet EUP'],
                ['code' => 'crc', 'name' => 'Material CRC'],
                ['code' => 'ingot', 'name' => 'Material Ingot'],
                ['code' => 'resin', 'name' => 'Resin / Alkali'],
            ],
            'data' => $rows,
        ]);
    }

    public function sync(Request $request)
    {
        if (is_string($request->input('payload'))) {
            $decodedPayload = json_decode($request->input('payload'), true);
            if (!is_array($decodedPayload)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payload Form Check tidak valid.',
                ], 422);
            }
            $request->merge(['payload' => $decodedPayload]);
        }

        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => ['required', 'in:FORM_CHECK_SUBMITTED'],
            'client_timestamp' => 'required|date',
            'form_type' => ['required', 'in:crane,forklift,trailler,eup,crc,ingot,resin'],
            'payload' => 'required|array',
        ]);

        if (MobileSyncEvent::where('event_id', $data['event_id'])->exists()) {
            return response()->json([
                'success' => true,
                'acknowledged_event_ids' => [$data['event_id']],
            ]);
        }

        $payload = $data['payload'];
        $payload['user_id'] = $request->user()->id;
        $payload = $this->normalizePayload($data['form_type'], $payload);

        if (isset($payload['supplier']) && is_array($payload['supplier'])) {
            $payload['supplier'] = json_encode($payload['supplier']);
        }
        if (isset($payload['kaki_pallet']) && is_array($payload['kaki_pallet'])) {
            $payload['kaki_pallet'] = implode('|', $payload['kaki_pallet']);
        }
        if (isset($payload['checklist_data']) && is_array($payload['checklist_data'])) {
            $payload['checklist_data'] = json_encode($payload['checklist_data']);
        }

        try {
            $model = $this->modelFor($data['form_type']);
            $fillable = (new $model())->getFillable();
            $record = $model::create(collect($payload)->only($fillable)->toArray());

            $imageFields = match ($data['form_type']) {
                'eup' => ['foto7'],
                'crc' => ['foto', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7'],
                'ingot' => ['foto', 'foto1', 'foto3', 'foto5'],
                'resin' => ['foto', 'foto1', 'foto3', 'foto5', 'foto6'],
                default => [],
            };

            $storedImages = [];
            foreach ($imageFields as $field) {
                $paths = [];
                foreach ($request->file($field, []) as $file) {
                    if (!$file->isValid()) {
                        continue;
                    }
                    $name = now()->format('d-m-Y') . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs($data['form_type'], $name, 'public');
                    $paths[] = $name;
                }
                if ($paths) {
                    $storedImages[$field] = json_encode($paths);
                }
            }

            if ($data['form_type'] === 'eup' && isset($storedImages['foto7'])) {
                $decoded = json_decode($storedImages['foto7'], true) ?: [];
                $record->foto7 = implode('|', $decoded);
                $record->save();
            } elseif ($data['form_type'] === 'crc' && $storedImages) {
                Crc_imageM::create(array_merge($storedImages, ['crc_id' => $record->id]));
            } elseif ($data['form_type'] === 'ingot' && $storedImages) {
                Ingot_imageM::create(array_merge($storedImages, ['ingot_id' => $record->id]));
            } elseif ($data['form_type'] === 'resin' && $storedImages) {
                Resin_imageM::create(array_merge($storedImages, ['resin_id' => $record->id]));
            }
        } catch (QueryException $e) {
            Log::error('Form-Check mobile sync gagal', [
                'form_type' => $data['form_type'],
                'event_id' => $data['event_id'],
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Data belum dapat disimpan. Silakan periksa kembali input atau coba lagi.',
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Form-Check mobile sync gagal', [
                'form_type' => $data['form_type'],
                'event_id' => $data['event_id'],
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Data belum dapat disimpan. Silakan coba lagi.',
            ], 500);
        }

        MobileSyncEvent::create([
            'event_id' => $data['event_id'],
            'module' => 'form_check',
            'aggregate_id' => $data['aggregate_id'],
            'event_type' => $data['event_type'],
            'payload' => [
                'form_type' => $data['form_type'],
                'data' => $payload,
            ],
            'device_id' => $request->input('device_id'),
            'user_id' => $request->user()->id,
            'client_timestamp' => $data['client_timestamp'],
            'synced_at' => now(),
            'status' => 'APPLIED',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Form Check berhasil disinkronkan.',
            'record' => $this->formatRow($record, $data['form_type']),
            'acknowledged_event_ids' => [$data['event_id']],
        ]);
    }

    private function normalizePayload(string $type, array $payload): array
    {
        $payload['date'] ??= now()->toDateString();
        $payload['user_id'] ??= null;

        if ($type === 'crane') {
            foreach ([
                'start', 'switch', 'up', 'down', 'ctravel', 'ltravel',
                'emergency', 'speed1', 'speed2', 'block', 'lockert', 'wire',
                'sltravel', 'sirinelt', 'brakeno', 'brakeya', 'bcno',
                'bcya', 'updno', 'updya', 'crcros',
            ] as $field) {
                $payload[$field] ??= 'v';
            }
            $payload['shift'] ??= '1';
            $payload['jenis_crane'] ??= $payload['jenis'] ?? 'Crane';
            $payload['shift_leader'] ??= '-';
            $payload['mtc'] ??= $payload['catatan'] ?? '';
        }

        if ($type === 'forklift') {
            foreach ([
                'horn', 'mundur', 'sein', 'rotating', 'stop', 'utama',
                'connector', 'accu', 'parking', 'brake', 'oil', 'raulic',
                'chain', 'allhose', 'steering', 'belts', 'cooland',
                'transmisi', 'ban', 'fork',
            ] as $field) {
                $payload[$field] ??= 'v';
            }
            $payload['awal'] ??= '-';
            $payload['akhir'] ??= '-';
            $payload['teba'] ??= null;
            $payload['shift'] ??= '1';
            $payload['jenis_forklift'] ??= $payload['jenis'] ?? 'Forklift';
            $payload['shift_leader'] ??= '-';
            $payload['mtc'] ??= $payload['catatan'] ?? '';
        }

        if ($type === 'trailler') {
            foreach ([
                'rantai_pe', 'carrier', 'rantai', 'ban', 'cadangan',
                'sein', 'rotating', 'stop', 'utama', 'kota', 'connector',
                'accu', 'coolant', 'parking', 'brake', 'horn', 'mundur',
                'clamp', 'terpal', 'ganjal', 'pallet', 'apar', 'p3k',
                'fancing', 'triangle', 'tools',
            ] as $field) {
                $payload[$field] ??= 'v';
            }
            $payload['jenis_forklift'] ??= $payload['jenis'] ?? 'Trailler';
            $payload['shift_leader'] ??= '-';
            $payload['mtc_name'] ??= $payload['mtc'] ?? '';
        }

        if ($type === 'eup') {
            $payload['jenis'] ??= 'Penerimaan Pallet';
            $payload['sesuai'] ??= 'Ya';
            $payload['action'] ??= 'Pallet diterima';
        }

        if ($type === 'crc') {
            $payload['shift_leader'] ??= '-';
            $payload['jalan'] ??= 'Sesuai';
            $payload['radiasi'] ??= '-';
            $payload['ket_radiasi'] ??= '-';
        }

        if ($type === 'ingot') {
            $payload['shift_leader'] ??= '-';
            $payload['jalan'] ??= 'Sesuai';
            $payload['time'] ??= '00:00';
            $payload['supplier'] ??= [];
        }

        if ($type === 'resin') {
            $payload['shift_leader'] ??= '-';
            $payload['time'] ??= '00:00';
            $payload['supplier'] ??= [];
            $payload['radiasi'] ??= '-';
            $payload['ket_radiasi'] ??= '-';
        }

        if (isset($payload['supplier']) && is_array($payload['supplier'])) {
            $payload['supplier'] = json_encode(array_values(array_filter($payload['supplier'])));
        }

        return $payload;
    }

    private function modelFor(string $type): string
    {
        return match ($type) {
            'crane' => CraneM::class,
            'forklift' => ForkliftM::class,
            'trailler' => TraillerM::class,
            'eup' => EupM::class,
            'crc' => CrcM::class,
            'ingot' => IngotM::class,
            'resin' => ResinM::class,
            default => CraneM::class,
        };
    }

    private function formatRow($row, string $type): array
    {
        $raw = $row->toArray();
        return [
            'id' => $row->id,
            'form_type' => $type,
            'date' => $row->date ?? null,
            'shift' => $row->shift ?? null,
            'shift_leader' => $row->shift_leader ?? null,
            'title' => $row->jenis_crane ?? $row->jenis_forklift ?? $row->jenis ?? $row->supplier ?? $row->mtc_name ?? 'Form Check',
            'catatan' => $row->catatan ?? $row->note_keseluruhan ?? $row->keterangan ?? null,
            'created_at' => $row->created_at?->toIso8601String(),
            'raw_data' => $raw,
        ];
    }
}
