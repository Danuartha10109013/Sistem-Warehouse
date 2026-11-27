<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SidewallMaster;
use App\Models\SidewallModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanSidewallApiController extends Controller
{
    public function index(Request $request)
    {
        $query = SidewallModel::query()->orderByDesc('created_at')->orderByDesc('id');
        if ($request->filled('search')) {
            $term = '%' . $request->string('search') . '%';
            $query->where(function ($q) use ($term) {
                $q->where('size_sidewall', 'like', $term)
                    ->orWhere('tujuan', 'like', $term)
                    ->orWhere('shift', 'like', $term)
                    ->orWhere('keterangan', 'like', $term);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()->map(fn (SidewallModel $row) => $this->formatRow($row))->values(),
            'options' => [
                'size_sidewall' => SidewallMaster::where('type', 'size_sidewall')->orderBy('value')->pluck('value')->values(),
                'tujuan' => SidewallMaster::where('type', 'tujuan')->orderBy('value')->pluck('value')->values(),
                'shift' => SidewallMaster::where('type', 'shift')->orderBy('value')->pluck('value')->values(),
            ],
        ]);
    }

    public function sync(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => ['required', 'in:SIDEWALL_REPORT_CREATED'],
            'client_timestamp' => 'required|date',
            'date' => 'required|date',
            'shift' => 'required|string|max:191',
            'keterangan' => 'nullable|string|max:500',
            'details' => 'required|array|min:1',
            'details.*.size_sidewall' => 'required|string|max:191',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.tujuan' => 'required|string|max:191',
        ]);

        if (\App\Models\MobileSyncEvent::where('event_id', $data['event_id'])->exists()) {
            return response()->json(['success' => true, 'acknowledged_event_ids' => [$data['event_id']]]);
        }

        $records = DB::transaction(function () use ($data, $request) {
            return collect($data['details'])->map(fn ($detail) => SidewallModel::create([
                'date' => $data['date'],
                'shift' => $data['shift'],
                'keterangan' => $data['keterangan'] ?? null,
                'size_sidewall' => $detail['size_sidewall'],
                'jumlah' => $detail['jumlah'],
                'tujuan' => $detail['tujuan'],
            ]));
        });

        \App\Models\MobileSyncEvent::create([
            'event_id' => $data['event_id'],
            'module' => 'laporan_sidewall',
            'aggregate_id' => $data['aggregate_id'],
            'event_type' => $data['event_type'],
            'payload' => collect($data)->except(['event_id', 'aggregate_id', 'event_type', 'client_timestamp'])->toArray(),
            'device_id' => $request->input('device_id'),
            'user_id' => $request->user()->id,
            'client_timestamp' => $data['client_timestamp'],
            'synced_at' => now(),
            'status' => 'APPLIED',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan Sidewall berhasil disinkronkan.',
            'record' => $this->formatRow($records->first()),
            'acknowledged_event_ids' => [$data['event_id']],
        ]);
    }

    private function formatRow(SidewallModel $row): array
    {
        return [
            'id' => $row->id,
            'date' => $row->date,
            'size_sidewall' => $row->size_sidewall,
            'jumlah' => (int) $row->jumlah,
            'tujuan' => $row->tujuan,
            'shift' => $row->shift,
            'keterangan' => $row->keterangan,
            'created_at' => $row->created_at?->toIso8601String(),
        ];
    }
}
