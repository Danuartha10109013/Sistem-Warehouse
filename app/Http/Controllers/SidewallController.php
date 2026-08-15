<?php

namespace App\Http\Controllers;

use App\Exports\SidewallExportExcel;
use App\Models\SidewallModel;
use App\Models\SidewallMaster;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class SidewallController extends Controller
{
    private const TUJUAN_OPTIONS = ['Sadang', 'Cikarang'];

    private const SHIFT_OPTIONS = ['Group A', 'Group B'];

    public function index()
    {
        $masters = SidewallMaster::all();

        return view('laporansidewall.index', [
            'tujuanOptions' => $masters->where('type', 'tujuan')->pluck('value'),
            'shiftOptions' => $masters->where('type', 'shift')->pluck('value'),
            'sizeSidewallOptions' => $masters->where('type', 'size_sidewall')
                ->pluck('value')
                ->sortBy(function ($val) { return (float) $val; })
                ->values(),
        ]);
    }

    public function idod_export(Request $request)
    {
        ['query' => $query, 'filters' => $filters] = $this->buildFilteredContext($request);

        $records = (clone $query)->orderByDesc('created_at')->get();
        $filters['total_rows'] = $records->count();
        $filters['exported_at'] = now()->format('d-m-Y H:i');

        $filename = sprintf(
            'Laporan_Sidewall_%s_%s.xlsx',
            $filters['from'],
            $filters['to']
        );

        return Excel::download(new SidewallExportExcel($records, $filters), $filename);
    }

    public function dashboardData(Request $request)
    {
        $validated = $request->validate([
            'period' => 'nullable|in:day,month,year',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'tujuan' => 'nullable|string|max:191',
            'shift' => 'nullable|string|max:191',
            'size_sidewall' => 'nullable|string|max:191',
            'search' => 'nullable|string|max:191',
            'page' => 'nullable|integer|min:1',
        ]);

        $period = $validated['period'] ?? 'day';
        $page = max(1, (int) ($validated['page'] ?? $request->input('page', 1)));
        $perPage = 25;

        ['query' => $query, 'filters' => $filterMeta] = $this->buildFilteredContext($request, $validated);

        $totalRecords = (clone $query)->count();
        $avgJumlah = 0; // Not used anymore

        $paginated = (clone $query)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($perPage, ['*'], 'page', $page);

        $dateSql = $this->reportDateSql();

        $timeline = (clone $query)
            ->select(
                DB::raw($this->periodSelect('day', $dateSql) . ' as period_key'),
                DB::raw("SUM(CASE WHEN tujuan = 'Sadang' THEN (CAST(size_sidewall AS UNSIGNED) * jumlah) ELSE 0 END) as total_sadang"),
                DB::raw("SUM(CASE WHEN tujuan = 'Cikarang' THEN (CAST(size_sidewall AS UNSIGNED) * jumlah) ELSE 0 END) as total_cikarang")
            )
            ->groupBy('period_key')
            ->orderBy('period_key')
            ->get();

        $diffInDays = Carbon::parse($filterMeta['from'])->diffInDays(Carbon::parse($filterMeta['to']));
        
        // Query for monthly timeline: if range is small (like default 30 days), show 12 months ending at 'to' date.
        if ($diffInDays > 60) {
            $timelineMonthlyQuery = clone $query;
        } else {
            ['query' => $baseQuery] = $this->buildFilteredContext($request, $validated, false);
            
            $toMonthly = Carbon::parse($filterMeta['to'])->endOfYear();
            $fromMonthly = Carbon::parse($filterMeta['to'])->startOfYear();
            
            $timelineMonthlyQuery = $baseQuery->inReportRange($fromMonthly->toDateString(), $toMonthly->toDateString());
        }

        $timelineMonthly = $timelineMonthlyQuery
            ->select(
                DB::raw($this->periodSelect('month', $dateSql) . ' as period_key'),
                DB::raw("SUM(CASE WHEN tujuan = 'Sadang' THEN (CAST(size_sidewall AS UNSIGNED) * jumlah) ELSE 0 END) as total_sadang"),
                DB::raw("SUM(CASE WHEN tujuan = 'Cikarang' THEN (CAST(size_sidewall AS UNSIGNED) * jumlah) ELSE 0 END) as total_cikarang")
            )
            ->groupBy('period_key')
            ->orderBy('period_key')
            ->get();

        $byTujuan = $this->aggregateByDimension($query, 'tujuan', 10);
        $byShift = $this->aggregateByDimension($query, 'shift');

        $totalSadang = (clone $query)->where('tujuan', 'Sadang')->count();
        $totalCikarang = (clone $query)->where('tujuan', 'Cikarang')->count();


        return response()->json([
            'filters' => array_merge($filterMeta, ['period' => $period]),
            'summary' => [
                'total_records' => $totalRecords,
                'total_sadang' => $totalSadang,
                'total_cikarang' => $totalCikarang,
                'total_gabungan' => $totalSadang + $totalCikarang,
                'avg_jumlah' => round($avgJumlah, 1),
            ],
            'timeline' => [
                'labels' => $timeline->map(fn ($row) => $this->formatPeriodLabel($row->period_key, 'day'))->values(),
                'total_sadang' => $timeline->pluck('total_sadang')->map(fn ($v) => (int) $v)->values(),
                'total_cikarang' => $timeline->pluck('total_cikarang')->map(fn ($v) => (int) $v)->values(),
            ],
            'timeline_monthly' => [
                'labels' => $timelineMonthly->map(fn ($row) => $this->formatPeriodLabel($row->period_key, 'month'))->values(),
                'total_sadang' => $timelineMonthly->pluck('total_sadang')->map(fn ($v) => (int) $v)->values(),
                'total_cikarang' => $timelineMonthly->pluck('total_cikarang')->map(fn ($v) => (int) $v)->values(),
            ],
            'by_tujuan' => $this->formatGroupBreakdown($byTujuan, 'tujuan'),
            'by_shift' => $this->formatGroupBreakdown($byShift, 'shift'),
            'rows' => collect($paginated->items())
                ->map(fn (SidewallModel $row) => $this->formatRow($row))
                ->values(),
            'pagination' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem(),
            ],
        ]);
    }

    public function add_idod()
    {
        return redirect()->to(route('sidewall') . '#tambah-data');
    }

    public function edit_idod($id)
    {
        return redirect()->to(route('sidewall') . '?edit=' . $id);
    }

    public function create_idod(Request $request)
    {
        $data = $this->validatedPayload($request);
        
        $records = [];
        foreach ($data['details'] as $detail) {
            $records[] = SidewallModel::create([
                'date' => $data['date'],
                'shift' => $data['shift'],
                'keterangan' => $data['keterangan'],
                'size_sidewall' => $detail['size_sidewall'],
                'jumlah' => $detail['jumlah'],
                'tujuan' => $detail['tujuan'],
            ]);
        }

        return $this->crudResponse($request, 'Data berhasil ditambahkan.', $records[0] ?? null, 201);
    }

    public function show_idod(Request $request, $id)
    {
        $record = SidewallModel::findOrFail($id);

        return response()->json([
            'record' => $this->formatRow($record, forForm: true),
        ]);
    }

    public function update_idod(Request $request, $id)
    {
        $record = SidewallModel::findOrFail($id);
        $data = $this->validatedPayload($request);
        
        // Since edit only edits a single item, we take the first detail
        $detail = $data['details'][0];
        
        $record->update([
            'date' => $data['date'],
            'shift' => $data['shift'],
            'keterangan' => $data['keterangan'],
            'size_sidewall' => $detail['size_sidewall'],
            'jumlah' => $detail['jumlah'],
            'tujuan' => $detail['tujuan'],
        ]);

        return $this->crudResponse($request, 'Data berhasil diperbarui.', $record->fresh());
    }

    public function destroy_idod(Request $request, $id)
    {
        $record = SidewallModel::findOrFail($id);
        $record->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.',
            ]);
        }

        return redirect()->route('sidewall')->with('success', 'Data berhasil dihapus.');
    }

    public function getMasters()
    {
        return response()->json(SidewallMaster::orderBy('value')->get());
    }

    public function storeMaster(Request $request)
    {
        $request->validate([
            'type' => 'required|in:size_sidewall,tujuan,shift',
            'value' => 'required|string|max:191'
        ]);

        $master = SidewallMaster::create([
            'type' => $request->type,
            'value' => $request->value
        ]);

        return response()->json(['success' => true, 'data' => $master]);
    }

    public function destroyMaster($id)
    {
        $master = SidewallMaster::findOrFail($id);
        $master->delete();

        return response()->json(['success' => true]);
    }

    private function validatedPayload(Request $request): array
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'shift' => ['required', 'string', 'max:191'],
            'keterangan' => 'nullable|string|max:500',
            'details' => 'required|array|min:1',
            'details.*.size_sidewall' => 'required|string|max:191',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.tujuan' => ['required', 'string', 'max:191'],
        ]);

        $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');

        return $validated;
    }

    private function formatRow(SidewallModel $row, bool $forForm = false): array
    {
        $reportDate = $row->report_date;

        return [
            'id' => $row->id,
            'date' => $forForm
                ? ($reportDate?->format('Y-m-d') ?? '')
                : ($row->date ?: ($row->created_at?->format('Y-m-d') ?? '—')),
            'size_sidewall' => $forForm ? ($row->size_sidewall ?? '') : ($row->size_sidewall ?: '—'),
            'jumlah' => $forForm ? ($row->jumlah ?? 1) : ($row->jumlah ?: 1),
            'tujuan' => $forForm ? ($row->tujuan ?? '') : ($row->tujuan ?: '—'),
            'shift' => $forForm ? ($row->shift ?? '') : ($row->shift ?: '—'),
            'keterangan' => $forForm ? ($row->keterangan ?? '') : ($row->keterangan ?: '—'),
            'created_at' => $row->created_at?->format('d-m-Y H:i') ?? '—',
        ];
    }

    private function crudResponse(Request $request, string $message, SidewallModel $record, int $status = 200)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'record' => $this->formatRow($record),
            ], $status);
        }

        return redirect()->route('sidewall')->with('success', $message);
    }

    /**
     * @return array{query: Builder, filters: array<string, string>}
     */
    private function buildFilteredContext(Request $request, ?array $validated = null, bool $applyDate = true): array
    {
        $validated ??= $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'tujuan' => 'nullable|string|max:191',
            'shift' => 'nullable|string|max:191',
            'size_sidewall' => 'nullable|string|max:191',
            'search' => 'nullable|string|max:191',
        ]);

        $to = isset($validated['to'])
            ? Carbon::parse($validated['to'])->endOfDay()
            : Carbon::now()->endOfDay();
        $from = isset($validated['from'])
            ? Carbon::parse($validated['from'])->startOfDay()
            : (clone $to)->subDays(30)->startOfDay();

        $query = SidewallModel::query();
        
        if ($applyDate) {
            $query->inReportRange($from->toDateString(), $to->toDateString());
        }

        foreach (['tujuan', 'shift', 'size_sidewall'] as $field) {
            if (!empty($validated[$field])) {
                $query->where($field, $validated[$field]);
            }
        }

        if (!empty($validated['search'])) {
            $term = '%' . $validated['search'] . '%';
            $query->where(function ($q) use ($term) {
                $q->where('size_sidewall', 'like', $term)
                    ->orWhere('tujuan', 'like', $term)
                    ->orWhere('keterangan', 'like', $term)
                    ->orWhere('shift', 'like', $term)
                    ->orWhere('date', 'like', $term);
            });
        }

        $masters = SidewallMaster::all();

        return [
            'query' => $query,
            'filters' => [
                'from' => $from->toDateString(),
                'to' => $to->toDateString(),
                'size_sidewall' => !empty($validated['size_sidewall']) ? $validated['size_sidewall'] : 'Semua',
                'tujuan' => !empty($validated['tujuan']) ? $validated['tujuan'] : 'Semua',
                'shift' => !empty($validated['shift']) ? $validated['shift'] : 'Semua',
                'search' => !empty($validated['search']) ? $validated['search'] : '—',
            ],
        ];
    }

    /**
     * @return \Illuminate\Support\Collection<int, object>
     */
    private function aggregateByDimension(Builder $query, string $column, ?int $limit = null)
    {
        $builder = (clone $query)
            ->select(
                $column,
                DB::raw("SUM(CASE WHEN tujuan = 'Sadang' THEN (CAST(size_sidewall AS UNSIGNED) * jumlah) ELSE 0 END) as total_sadang"),
                DB::raw("SUM(CASE WHEN tujuan = 'Cikarang' THEN (CAST(size_sidewall AS UNSIGNED) * jumlah) ELSE 0 END) as total_cikarang"),
                DB::raw("SUM(CAST(size_sidewall AS UNSIGNED) * jumlah) as total_jumlah")
            )
            ->whereNotNull($column)
            ->where($column, '!=', '')
            ->groupBy($column)
            ->orderByDesc('total_jumlah');

        if ($limit !== null) {
            $builder->limit($limit);
        }

        return $builder->get();
    }

    /**
     * @param \Illuminate\Support\Collection<int, object> $rows
     * @return array<string, mixed>
     */
    private function formatGroupBreakdown($rows, string $labelKey): array
    {
        return [
            'labels' => $rows->pluck($labelKey)->map(fn ($v) => (string) $v)->values(),
            'total_sadang' => $rows->pluck('total_sadang')->map(fn ($v) => (int) $v)->values(),
            'total_cikarang' => $rows->pluck('total_cikarang')->map(fn ($v) => (int) $v)->values(),
        ];
    }

    private function filterOptions(): array
    {
        return [
            'size_sidewall' => SidewallModel::query()->whereNotNull('size_sidewall')->where('size_sidewall', '!=', '')->distinct()->orderBy('size_sidewall')->pluck('size_sidewall'),
        ];
    }

    private function reportDateSql(): string
    {
        return "COALESCE(STR_TO_DATE(NULLIF(TRIM(date), ''), '%Y-%m-%d'), DATE(created_at))";
    }

    private function periodSelect(string $period, string $dateSql): string
    {
        return match ($period) {
            'day' => "DATE_FORMAT({$dateSql}, '%Y-%m-%d')",
            'year' => "DATE_FORMAT({$dateSql}, '%Y')",
            default => "DATE_FORMAT({$dateSql}, '%Y-%m')",
        };
    }

    private function formatPeriodLabel(?string $key, string $period): string
    {
        if (!$key) {
            return '—';
        }

        try {
            return match ($period) {
                'day' => Carbon::createFromFormat('!Y-m-d', $key)->format('d M Y'),
                'year' => $key,
                default => Carbon::createFromFormat('!Y-m', $key)->format('M Y'),
            };
        } catch (\Throwable) {
            return $key;
        }
    }
}
