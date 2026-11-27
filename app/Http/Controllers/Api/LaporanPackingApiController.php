<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileSyncEvent;
use App\Models\PackingReport;
use App\Models\RekapNoSo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LaporanPackingApiController extends Controller
{
    private const GROUP_OPTIONS = ['A', 'B', 'Lokal'];
    private const COIL_OPTIONS = ['Baik', 'Damage Realese QA'];
    private const PACKING_OPTIONS = ['Pakai', 'Tidak Pakai'];
    private const OK_OPTIONS = ['OK', 'Not OK'];
    private const LABEL_OPTIONS = ['Lengkap', 'Tidak Lengkap'];
    private const PROTECTOR_OPTIONS = ['Tidak Pakai', 'Steel Ring', 'Duplek', 'Steel Sleeve'];

    public function list(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $query = PackingReport::query()->orderByDesc('date')->orderByDesc('id');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $term = '%' . $search . '%';
                $q->where('attribute', 'like', $term)
                    ->orWhere('no_so', 'like', $term)
                    ->orWhere('group', 'like', $term)
                    ->orWhere('layout', 'like', $term);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()->map(fn (PackingReport $row) => [
                'id' => $row->id,
                'date' => $row->date,
                'attribute' => $row->attribute,
                'group' => $row->group,
                'layout' => $row->layout,
                'no_so' => $row->no_so,
                'kondisi' => $row->kondisi,
                'plastik' => $row->plastik,
                'wrapping' => $row->wrapping,
                'impraboard' => $row->impraboard,
                'idod' => $row->idod,
                'pallet' => $row->pallet,
                'bandazer' => $row->bandazer,
                'label' => $row->label,
                'inner' => $row->inner,
                'outer' => $row->outer,
                'inerprotector' => $row->inerprotector,
                'lainnya' => $row->lainnya,
                'created_at' => $row->created_at?->toIso8601String(),
            ])->values(),
        ]);
    }

    public function rekapSoList(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $query = RekapNoSo::query()->orderByDesc('id');

        if ($search !== '') {
            $term = '%' . $search . '%';
            $query->where(function ($q) use ($search, $term) {
                $q->where('attribute', 'like', $term)
                    ->orWhere('no_so', 'like', $term)
                    ->orWhere('catatan', 'like', $term);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()->map(fn (RekapNoSo $row) => [
                'id' => $row->id,
                'attribute' => $row->attribute,
                'no_so' => $row->no_so,
                'catatan' => $row->catatan,
                'created_at' => $row->created_at?->toIso8601String(),
            ])->values(),
        ]);
    }

    public function options()
    {
        return response()->json([
            'success' => true,
            'layouts' => array_map(fn ($i) => 'K' . $i, range(1, 50)),
            'options' => [
                'group' => self::GROUP_OPTIONS,
                'kondisi' => self::COIL_OPTIONS,
                'plastik' => self::OK_OPTIONS,
                'wrapping' => self::PACKING_OPTIONS,
                'impraboard' => self::PACKING_OPTIONS,
                'idod' => self::OK_OPTIONS,
                'pallet' => self::PACKING_OPTIONS,
                'bandazer' => self::OK_OPTIONS,
                'label' => self::LABEL_OPTIONS,
                'inner' => self::PACKING_OPTIONS,
                'outer' => self::PACKING_OPTIONS,
                'inerprotector' => self::PROTECTOR_OPTIONS,
            ],
        ]);
    }

    public function checkAttribute(Request $request)
    {
        $attribute = trim((string) $request->query('attribute'));
        if ($attribute === '') {
            return response()->json(['success' => true, 'exists' => false]);
        }

        return response()->json([
            'success' => true,
            'exists' => PackingReport::whereRaw('LOWER(attribute) = ?', [strtolower($attribute)])->exists(),
        ]);
    }

    public function checkRekapSo(Request $request)
    {
        $attribute = trim((string) $request->query('attribute'));
        $rekap = $attribute === '' ? null : RekapNoSo::where('attribute', $attribute)->first();

        return response()->json([
            'success' => true,
            'found' => $rekap !== null,
            'no_so' => $rekap?->no_so,
            'catatan' => $rekap?->catatan,
        ]);
    }

    public function sync(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:255',
            'event_type' => ['required', Rule::in(['PACKING_REPORT_CREATED'])],
            'client_timestamp' => 'required|date',
            'date' => 'required|date',
            'group' => ['required', Rule::in(self::GROUP_OPTIONS)],
            'layout' => 'required|string|max:255',
            'no_so' => 'nullable|string|max:255',
            'kondisi' => ['required', Rule::in(self::COIL_OPTIONS)],
            'plastik' => ['required', Rule::in(self::OK_OPTIONS)],
            'wrapping' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'impraboard' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'idod' => ['required', Rule::in(self::OK_OPTIONS)],
            'pallet' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'bandazer' => ['required', Rule::in(self::OK_OPTIONS)],
            'label' => ['required', Rule::in(self::LABEL_OPTIONS)],
            'inner' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'outer' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'inerprotector' => ['required', Rule::in(self::PROTECTOR_OPTIONS)],
            'lainnya' => 'nullable|string',
        ]);

        $existingEvent = MobileSyncEvent::where('event_id', $data['event_id'])->first();
        if ($existingEvent) {
            return response()->json([
                'success' => true,
                'acknowledged_event_ids' => [$data['event_id']],
                'record' => $existingEvent->payload,
            ]);
        }

        $attribute = trim($data['aggregate_id']);
        if (PackingReport::whereRaw('LOWER(attribute) = ?', [strtolower($attribute)])->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Attribute sudah digunakan pada laporan packing.',
            ], 422);
        }

        $payload = collect($data)
            ->except(['event_id', 'aggregate_id', 'event_type', 'client_timestamp'])
            ->toArray();
        $payload['attribute'] = $attribute;
        $payload['no_so'] = filled($payload['no_so'] ?? null)
            ? strtoupper(trim($payload['no_so']))
            : null;

        $record = PackingReport::create($payload);

        MobileSyncEvent::create([
            'event_id' => $data['event_id'],
            'module' => 'laporan_packing',
            'aggregate_id' => $attribute,
            'event_type' => $data['event_type'],
            'payload' => $payload,
            'device_id' => $request->input('device_id'),
            'user_id' => Auth::id(),
            'client_timestamp' => $data['client_timestamp'],
            'synced_at' => now(),
            'status' => 'APPLIED',
        ]);

        \App\Services\LogActivity::record(
            action: 'TAMBAH_LAPORAN_PACKING_MOBILE',
            module: 'Laporan Packing Mobile',
            description: 'User ' . (Auth::user()->name ?? 'Mobile') . " menambahkan laporan packing attribute {$attribute}"
        );

        return response()->json([
            'success' => true,
            'message' => 'Laporan packing berhasil disinkronkan.',
            'record' => $record,
            'acknowledged_event_ids' => [$data['event_id']],
        ], 201);
    }
}
