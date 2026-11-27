<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CrcM;
use App\Models\M_OpenPackInspection;
use App\Models\M_OpenPackInspectionPhoto;
use App\Models\MobileSyncEvent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ReportOpenPackApiController extends Controller
{
    private const PHOTO_SLOTS = [
        'awal_ws',
        'awal_ds',
        'temuan_awal_damaged',
        'temuan_awal_evidence',
        'ng_sidewall_ws',
        'ng_sidewall_ds',
        'ng_bawah',
        'ng_surface',
        'defect_sidewall_damaged',
        'defect_sidewall_evidence',
        'defect_id_od_damaged',
        'defect_id_od_evidence',
        'defect_karat_damaged',
        'defect_karat_evidence',
    ];

    public function searchCoils(Request $request): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        // [TAG: PENCARIAN ATTRIBUTE CRC]
        $search = trim($request->string('search')->toString());
        $exact = $request->boolean('exact');
        if (mb_strlen($search) < 2) {
            return response()->json(['success' => true, 'data' => []]);
        }

        $crcRecords = CrcM::query()
            ->whereNotNull('checklist_data')
            ->whereRaw('LOWER(checklist_data) LIKE ?', ['%'.mb_strtolower($search).'%'])
            ->orderByDesc('id')
            ->limit(10)
            ->get(['id', 'date', 'shift_leader', 'supplier', 'checklist_data']);

        $results = [];
        foreach ($crcRecords as $crc) {
            foreach ($this->checklistItems($crc) as $item) {
                $attribute = trim((string) ($item['attribute'] ?? ''));
                if (
                    $attribute === ''
                    || ($exact ? $attribute !== $search : mb_stripos($attribute, $search) === false)
                ) {
                    continue;
                }

                $results[] = [
                    'crc_id' => $crc->id,
                    'attribute' => $attribute,
                    'nomor_coil_supplier' => (string) ($item['supplier_lot_no'] ?? ''),
                    'tanggal_kedatangan' => $crc->date,
                    'nomor_surat_jalan' => $crc->shift_leader,
                    'nama_supplier' => $this->supplierName($crc->supplier),
                ];

                if (count($results) >= 10) {
                    break 2;
                }
            }
        }

        return response()->json(['success' => true, 'data' => $results]);
    }

    public function index(Request $request): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        $reports = M_OpenPackInspection::query()
            ->with('photos')
            ->latest('id')
            ->paginate(min(max((int) $request->input('per_page', 30), 1), 100));

        return response()->json([
            'success' => true,
            'data' => $reports->getCollection()
                ->map(fn (M_OpenPackInspection $report) => $this->formatReport($report))
                ->values(),
            'meta' => [
                'current_page' => $reports->currentPage(),
                'last_page' => $reports->lastPage(),
                'total' => $reports->total(),
            ],
        ]);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        $report = M_OpenPackInspection::with('photos')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $this->formatReport($report),
        ]);
    }

    public function sync(Request $request): JsonResponse
    {
        if ($response = $this->accessDenied($request)) {
            return $response;
        }

        // [TAG: VALIDASI EVENT DAN DOKUMENTASI]
        if (is_string($request->input('payload'))) {
            $payload = json_decode($request->input('payload'), true);
            if (! is_array($payload)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payload Report Open Pack tidak valid.',
                ], 422);
            }
            $request->merge(['payload' => $payload]);
        }

        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => 'required|in:OPEN_PACK_REPORT_CREATED',
            'client_timestamp' => 'required|date',
            'payload' => 'required|array',
            'payload.crc_id' => 'required|integer|exists:crc,id',
            'payload.attribute' => 'required|string|max:255',
            'payload.tanggal_open_pack' => 'required|date',
            'payload.grup' => 'required|in:A,B,C,D',
            'payload.kondisi_awal' => 'required|in:OK,NOT_GOOD',
            'payload.kondisi_setelah_open_pack' => 'required|in:OK,NOT_GOOD',
            'payload.ada_temuan_awal' => 'sometimes|boolean',
            'payload.ada_temuan_setelah' => 'sometimes|boolean',
            'payload.keterangan' => 'nullable|string',
        ]);

        $existingEvent = MobileSyncEvent::where('event_id', $data['event_id'])->first();
        if ($existingEvent) {
            return $this->acknowledged($data['event_id'], $existingEvent->payload['inspection_id'] ?? null);
        }

        $photoRules = [];
        foreach (self::PHOTO_SLOTS as $slot) {
            $photoRules[$slot] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'];
        }
        if ($data['payload']['kondisi_awal'] === 'NOT_GOOD') {
            $photoRules['awal_ws'][0] = 'required';
            $photoRules['awal_ds'][0] = 'required';
        }
        if ($data['payload']['kondisi_setelah_open_pack'] === 'NOT_GOOD') {
            foreach (['ng_sidewall_ws', 'ng_sidewall_ds', 'ng_bawah', 'ng_surface'] as $slot) {
                $photoRules[$slot][0] = 'required';
            }
        }
        Validator::make($request->all(), $photoRules)->validate();

        $crc = CrcM::findOrFail($data['payload']['crc_id']);
        $coil = $this->findChecklistItem($crc, $data['payload']['attribute']);
        if ($coil === null) {
            return response()->json([
                'success' => false,
                'message' => 'Attribute tidak cocok dengan data Form Check yang dipilih.',
            ], 422);
        }

        $allowedSlots = [];
        if ($data['payload']['kondisi_awal'] === 'NOT_GOOD') {
            $allowedSlots = array_merge($allowedSlots, ['awal_ws', 'awal_ds']);
        }
        if ($request->boolean('payload.ada_temuan_awal')) {
            $allowedSlots = array_merge($allowedSlots, ['temuan_awal_damaged', 'temuan_awal_evidence']);
        }
        if ($data['payload']['kondisi_setelah_open_pack'] === 'NOT_GOOD') {
            $allowedSlots = array_merge($allowedSlots, ['ng_sidewall_ws', 'ng_sidewall_ds', 'ng_bawah', 'ng_surface']);
        }
        if ($request->boolean('payload.ada_temuan_setelah')) {
            $allowedSlots = array_merge($allowedSlots, [
                'defect_sidewall_damaged',
                'defect_sidewall_evidence',
                'defect_id_od_damaged',
                'defect_id_od_evidence',
                'defect_karat_damaged',
                'defect_karat_evidence',
            ]);
        }

        $storedPaths = [];
        try {
            // [TAG: SIMPAN LAPORAN DAN EVENT IDEMPOTEN]
            $report = DB::transaction(function () use ($request, $data, $crc, $coil, $allowedSlots, &$storedPaths) {
                $report = M_OpenPackInspection::create([
                    'crc_id' => $crc->id,
                    'attribute' => trim((string) $coil['attribute']),
                    'nomor_coil_supplier' => $coil['supplier_lot_no'] ?? null,
                    'tanggal_kedatangan' => $crc->date,
                    'nomor_surat_jalan' => $crc->shift_leader,
                    'nama_supplier' => $this->supplierName($crc->supplier),
                    'tanggal_open_pack' => $data['payload']['tanggal_open_pack'],
                    'grup' => $data['payload']['grup'],
                    'kondisi_awal' => $data['payload']['kondisi_awal'],
                    'kondisi_setelah_open_pack' => $data['payload']['kondisi_setelah_open_pack'],
                    'keterangan' => $data['payload']['keterangan'] ?? null,
                    'created_by' => $request->user()->id,
                ]);

                $savedPhotos = [];
                foreach ($allowedSlots as $slot) {
                    $file = $request->file($slot);
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('open_pack_photos', 'public');
                    $storedPaths[] = $path;
                    M_OpenPackInspectionPhoto::create([
                        'open_pack_inspection_id' => $report->id,
                        'slot_key' => $slot,
                        'file_path' => 'storage/'.$path,
                    ]);
                    $savedPhotos[$slot] = $path;
                }

                MobileSyncEvent::create([
                    'event_id' => $data['event_id'],
                    'module' => 'report_open_pack',
                    'aggregate_id' => $data['aggregate_id'],
                    'event_type' => $data['event_type'],
                    'payload' => [
                        ...$data['payload'],
                        'inspection_id' => $report->id,
                        'photos' => $savedPhotos,
                    ],
                    'device_id' => $request->input('device_id'),
                    'user_id' => $request->user()->id,
                    'client_timestamp' => Carbon::parse($data['client_timestamp']),
                    'synced_at' => now(),
                    'status' => 'APPLIED',
                ]);

                return $report->load('photos');
            });
        } catch (Throwable $exception) {
            foreach ($storedPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            $existingEvent = MobileSyncEvent::where('event_id', $data['event_id'])->first();
            if ($existingEvent) {
                return $this->acknowledged($data['event_id'], $existingEvent->payload['inspection_id'] ?? null);
            }

            Log::error('Report Open Pack mobile sync gagal', [
                'event_id' => $data['event_id'],
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Laporan belum dapat disimpan. Silakan coba sinkronkan kembali.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Report Open Pack berhasil disimpan.',
            'data' => $this->formatReport($report),
            'acknowledged_event_ids' => [$data['event_id']],
        ], 201);
    }

    private function accessDenied(Request $request): ?JsonResponse
    {
        $user = $request->user();
        $permissions = json_decode((string) $user->type, true);
        $permissions = is_array($permissions) ? $permissions : [$user->type];

        if (in_array((int) $user->role, [0, 5], true) || in_array('all', $permissions, true) || in_array('OP', $permissions, true)) {
            return null;
        }

        return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki akses ke modul Report Open Pack.',
        ], 403);
    }

    private function checklistItems(CrcM $crc): array
    {
        $items = $crc->checklist_data;
        if (is_string($items)) {
            $items = json_decode($items, true);
        }

        return is_array($items) ? $items : [];
    }

    private function findChecklistItem(CrcM $crc, string $attribute): ?array
    {
        foreach ($this->checklistItems($crc) as $item) {
            if (isset($item['attribute']) && strcasecmp(trim((string) $item['attribute']), trim($attribute)) === 0) {
                return $item;
            }
        }

        return null;
    }

    private function supplierName(?string $supplier): string
    {
        $decoded = json_decode((string) $supplier, true);
        if (is_array($decoded)) {
            return implode(', ', array_filter(array_map(
                static fn ($value) => trim((string) $value),
                $decoded
            )));
        }

        return trim(str_replace(['[', ']', '"'], '', (string) $supplier));
    }

    private function formatReport(M_OpenPackInspection $report): array
    {
        return [
            'id' => $report->id,
            'crc_id' => $report->crc_id,
            'attribute' => $report->attribute,
            'nomor_coil_supplier' => $report->nomor_coil_supplier,
            'tanggal_kedatangan' => $report->tanggal_kedatangan,
            'nomor_surat_jalan' => $report->nomor_surat_jalan,
            'nama_supplier' => $report->nama_supplier,
            'tanggal_open_pack' => $report->tanggal_open_pack,
            'grup' => $report->grup,
            'kondisi_awal' => $report->kondisi_awal,
            'kondisi_setelah_open_pack' => $report->kondisi_setelah_open_pack,
            'keterangan' => $report->keterangan,
            'created_at' => $report->created_at?->toIso8601String(),
            'photos' => $report->photos->mapWithKeys(fn (M_OpenPackInspectionPhoto $photo) => [
                $photo->slot_key => asset($photo->file_path),
            ]),
        ];
    }

    private function acknowledged(string $eventId, ?int $inspectionId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Event Report Open Pack sudah pernah disinkronkan.',
            'data' => $inspectionId ? $this->formatReport(
                M_OpenPackInspection::with('photos')->findOrFail($inspectionId)
            ) : null,
            'acknowledged_event_ids' => [$eventId],
        ]);
    }
}
