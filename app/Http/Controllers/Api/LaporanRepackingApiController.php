<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaporanrepackingM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LaporanRepackingApiController extends Controller
{
    private const STATUS_OPTIONS = ['Retur', 'Naik Lagi', 'Skip Lama'];
    private const GROUP_OPTIONS = ['Grup A', 'Grup B', 'Grup C', 'Grup D'];
    private const PACKING_OPTIONS = ['Pakai', 'Tidak Pakai'];

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:191',
        ]);

        $query = LaporanrepackingM::query()->orderByDesc('created_at')->orderByDesc('id');
        if (!empty($validated['search'])) {
            $term = '%' . $validated['search'] . '%';
            $query->where(function ($q) use ($term) {
                $q->where('atributte', 'like', $term)
                    ->orWhere('status', 'like', $term)
                    ->orWhere('group', 'like', $term)
                    ->orWhere('keterangan', 'like', $term);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()->map(fn (LaporanrepackingM $row) => $this->formatRow($row))->values(),
            'options' => [
                'status' => self::STATUS_OPTIONS,
                'group' => self::GROUP_OPTIONS,
                'wrapping' => self::PACKING_OPTIONS,
                'vcipaper' => self::PACKING_OPTIONS,
            ],
        ]);
    }

    public function sync(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => ['required', Rule::in(['REPACKING_REPORT_CREATED'])],
            'client_timestamp' => 'required|date',
            'tanggal' => 'required|date',
            'status' => ['required', Rule::in(self::STATUS_OPTIONS)],
            'group' => ['required', Rule::in(self::GROUP_OPTIONS)],
            'wrapping' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'vcipaper' => ['required', Rule::in(self::PACKING_OPTIONS)],
            'keterangan' => 'nullable|string|max:500',
        ]);

        if (\App\Models\MobileSyncEvent::where('event_id', $data['event_id'])->exists()) {
            return response()->json([
                'success' => true,
                'acknowledged_event_ids' => [$data['event_id']],
            ]);
        }

        $record = LaporanrepackingM::where('atributte', $data['aggregate_id'])
            ->where('status', 'Pending')
            ->orderBy('id')
            ->first();

        $payload = collect($data)->except(['event_id', 'aggregate_id', 'event_type', 'client_timestamp'])->toArray();
        $payload['atributte'] = $data['aggregate_id'];
        $payload['created_by'] = $request->user()->name ?? $request->user()->email ?? 'Mobile Operator';

        if ($record) {
            $record->update($payload);
        } else {
            $record = LaporanrepackingM::create($payload);
        }

        \App\Models\MobileSyncEvent::create([
            'event_id' => $data['event_id'],
            'module' => 'laporan_repacking',
            'aggregate_id' => $data['aggregate_id'],
            'event_type' => $data['event_type'],
            'payload' => $payload,
            'device_id' => $request->input('device_id'),
            'user_id' => $request->user()->id,
            'client_timestamp' => $data['client_timestamp'],
            'synced_at' => now(),
            'status' => 'APPLIED',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan repacking berhasil disinkronkan.',
            'record' => $this->formatRow($record->fresh()),
            'acknowledged_event_ids' => [$data['event_id']],
        ]);
    }

    private function formatRow(LaporanrepackingM $row): array
    {
        return [
            'id' => $row->id,
            'atributte' => $row->atributte,
            'tanggal' => $row->tanggal ?: ($row->created_at?->format('Y-m-d')),
            'status' => $row->status,
            'group' => $row->group,
            'wrapping' => $row->wrapping,
            'vcipaper' => $row->vcipaper,
            'keterangan' => $row->keterangan,
            'created_by' => $row->created_by,
            'created_at' => $row->created_at?->toIso8601String(),
        ];
    }
}
