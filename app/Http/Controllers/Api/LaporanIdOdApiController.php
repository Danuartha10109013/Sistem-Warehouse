<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IDODModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LaporanIdOdApiController extends Controller
{
    private const TUJUAN_OPTIONS = ['Sadang', 'Exspor', 'Lokal'];
    private const SHIFT_OPTIONS = ['Group A', 'Group B'];

    public function index(Request $request)
    {
        $query = IDODModel::query()->orderByDesc('created_at')->orderByDesc('id');
        if ($request->filled('search')) {
            $term = '%' . $request->string('search') . '%';
            $query->where(function ($q) use ($term) {
                $q->where('size_id', 'like', $term)
                    ->orWhere('size_od', 'like', $term)
                    ->orWhere('tujuan', 'like', $term)
                    ->orWhere('keterangan', 'like', $term);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()->map(fn (IDODModel $row) => $this->formatRow($row))->values(),
            'options' => [
                'size_id' => IDODModel::query()->select('size_id')->distinct()->orderBy('size_id')->pluck('size_id')->values(),
                'size_od' => IDODModel::query()->select('size_od')->distinct()->orderBy('size_od')->pluck('size_od')->values(),
                'tujuan' => self::TUJUAN_OPTIONS,
                'shift' => self::SHIFT_OPTIONS,
            ],
        ]);
    }

    public function sync(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|uuid',
            'aggregate_id' => 'required|string|max:191',
            'event_type' => ['required', 'in:ID_OD_REPORT_CREATED'],
            'client_timestamp' => 'required|date',
            'date' => 'required|date',
            'size_id' => 'required|string|max:191',
            'jumlah_id' => 'required|integer|min:0',
            'jumlah_id_ng' => 'nullable|integer|min:0',
            'size_od' => 'required|string|max:191',
            'jumlah_od' => 'required|integer|min:0',
            'jumlah_od_ng' => 'nullable|integer|min:0',
            'tujuan' => ['required', 'in:' . implode(',', self::TUJUAN_OPTIONS)],
            'shift' => ['required', 'in:' . implode(',', self::SHIFT_OPTIONS)],
            'keterangan' => 'nullable|string|max:500',
        ]);

        $this->validateCounts($data);
        if (\App\Models\MobileSyncEvent::where('event_id', $data['event_id'])->exists()) {
            return response()->json(['success' => true, 'acknowledged_event_ids' => [$data['event_id']]]);
        }

        $record = DB::transaction(function () use ($data) {
            return IDODModel::create([
                'date' => $data['date'],
                'size_id' => $data['size_id'],
                'jumlah_id' => $data['jumlah_id'],
                'jumlah_id_ng' => $data['jumlah_id_ng'] ?? 0,
                'size_od' => $data['size_od'],
                'jumlah_od' => $data['jumlah_od'],
                'jumlah_od_ng' => $data['jumlah_od_ng'] ?? 0,
                'tujuan' => $data['tujuan'],
                'shift' => $data['shift'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);
        });

        \App\Models\MobileSyncEvent::create([
            'event_id' => $data['event_id'],
            'module' => 'laporan_id_od',
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
            'message' => 'Laporan ID OD berhasil disinkronkan.',
            'record' => $this->formatRow($record),
            'acknowledged_event_ids' => [$data['event_id']],
        ]);
    }

    private function validateCounts(array $data): void
    {
        if ((int) $data['jumlah_id'] + (int) $data['jumlah_od'] < 1) {
            throw ValidationException::withMessages(['jumlah_id' => ['Minimal salah satu jumlah ID OK atau OD OK harus lebih dari 0.']]);
        }
    }

    private function formatRow(IDODModel $row): array
    {
        return [
            'id' => $row->id,
            'date' => $row->date,
            'size_id' => $row->size_id,
            'jumlah_id' => (int) $row->jumlah_id,
            'jumlah_id_ng' => (int) $row->jumlah_id_ng,
            'size_od' => $row->size_od,
            'jumlah_od' => (int) $row->jumlah_od,
            'jumlah_od_ng' => (int) $row->jumlah_od_ng,
            'tujuan' => $row->tujuan,
            'shift' => $row->shift,
            'keterangan' => $row->keterangan,
            'created_at' => $row->created_at?->toIso8601String(),
        ];
    }
}
