<?php

namespace App\Http\Controllers;

use App\Exports\IdodExportExcel;
use App\Models\IDODModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class IdOdController extends Controller
{
    private const TUJUAN_OPTIONS = ['Sadang', 'Exspor', 'Lokal'];

    private const SHIFT_OPTIONS = ['Group A', 'Group B'];

    public function index()
    {
        $filterOptions = $this->filterOptions();

        return view('laporanidod.index', [
            'tujuanOptions' => collect(self::TUJUAN_OPTIONS),
            'shiftOptions' => collect(self::SHIFT_OPTIONS),
            'sizeIdOptions' => $filterOptions['size_id'],
            'sizeOdOptions' => $filterOptions['size_od'],
        ]);
    }

    public function idod_export(Request $request)
    {
        ['query' => $query, 'filters' => $filters] = $this->buildFilteredContext($request);

        $records = (clone $query)->orderByDesc('created_at')->get();
        $filters['total_rows'] = $records->count();
        $filters['exported_at'] = now()->format('d-m-Y H:i');

        $filename = sprintf(
            'Laporan_ID_OD_%s_%s.xlsx',
            $filters['from'],
            $filters['to']
        );

        return Excel::download(new IdodExportExcel($records, $filters), $filename);
    }

    public function dashboardData(Request $request)
    {
        $validated = $request->validate([
            'period' => 'nullable|in:day,month,year',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'tujuan' => 'nullable|string|max:191',
            'shift' => 'nullable|string|max:191',
            'size_id' => 'nullable|string|max:191',
            'size_od' => 'nullable|string|max:191',
            'search' => 'nullable|string|max:191',
            'page' => 'nullable|integer|min:1',
        ]);

        $period = $validated['period'] ?? 'day';
        $page = max(1, (int) ($validated['page'] ?? $request->input('page', 1)));
        $perPage = 25;

        ['query' => $query, 'filters' => $filterMeta] = $this->buildFilteredContext($request, $validated);

        $totalRecords = (clone $query)->count();
        $avgJumlah = $totalRecords > 0
            ? (float) (clone $query)->selectRaw(
                'AVG(COALESCE(jumlah_id, 0) + COALESCE(jumlah_od, 0)) as avg_val'
            )->value('avg_val')
            : 0;

        $paginated = (clone $query)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($perPage, ['*'], 'page', $page);

        $dateSql = $this->reportDateSql();

        $timeline = (clone $query)
            ->select(
                DB::raw($this->periodSelect($period, $dateSql) . ' as period_key'),
                DB::raw('COALESCE(SUM(jumlah_id), 0) as jumlah_id'),
                DB::raw('COALESCE(SUM(jumlah_id_ng), 0) as jumlah_id_ng'),
                DB::raw('COALESCE(SUM(jumlah_od), 0) as jumlah_od'),
                DB::raw('COALESCE(SUM(jumlah_od_ng), 0) as jumlah_od_ng')
            )
            ->groupBy('period_key')
            ->orderBy('period_key')
            ->get();

        $byTujuan = $this->aggregateByDimension($query, 'tujuan', 10);
        $byShift = $this->aggregateByDimension($query, 'shift');

        $totalJumlahId = (int) (clone $query)->sum('jumlah_id');
        $totalJumlahOd = (int) (clone $query)->sum('jumlah_od');
        $totalJumlahIdNg = (int) (clone $query)->sum('jumlah_id_ng');
        $totalJumlahOdNg = (int) (clone $query)->sum('jumlah_od_ng');

        return response()->json([
            'filters' => array_merge($filterMeta, ['period' => $period]),
            'summary' => [
                'total_records' => $totalRecords,
                'total_jumlah_id' => $totalJumlahId,
                'total_jumlah_od' => $totalJumlahOd,
                'total_jumlah_id_ng' => $totalJumlahIdNg,
                'total_jumlah_od_ng' => $totalJumlahOdNg,
                'total_jumlah' => $totalJumlahId + $totalJumlahOd,
                'total_jumlah_ng' => $totalJumlahIdNg + $totalJumlahOdNg,
                'avg_jumlah' => round($avgJumlah, 1),
            ],
            'timeline' => [
                'labels' => $timeline->map(fn ($row) => $this->formatPeriodLabel($row->period_key, $period))->values(),
                'jumlah_id' => $timeline->pluck('jumlah_id')->map(fn ($v) => (int) $v)->values(),
                'jumlah_id_ng' => $timeline->pluck('jumlah_id_ng')->map(fn ($v) => (int) $v)->values(),
                'jumlah_od' => $timeline->pluck('jumlah_od')->map(fn ($v) => (int) $v)->values(),
                'jumlah_od_ng' => $timeline->pluck('jumlah_od_ng')->map(fn ($v) => (int) $v)->values(),
            ],
            'by_id_od' => [
                'labels' => ['ID (OK)', 'OD (OK)', 'ID (NG)', 'OD (NG)'],
                'jumlah' => [$totalJumlahId, $totalJumlahOd, $totalJumlahIdNg, $totalJumlahOdNg],
            ],
            'by_tujuan' => $this->formatGroupBreakdown($byTujuan, 'tujuan'),
            'by_shift' => $this->formatGroupBreakdown($byShift, 'shift'),
            'rows' => collect($paginated->items())
                ->map(fn (IDODModel $row) => $this->formatRow($row))
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
        return redirect()->to(route('idod') . '#tambah-data');
    }

    public function edit_idod($id)
    {
        return redirect()->to(route('idod') . '?edit=' . $id);
    }

    public function create_idod(Request $request)
    {
        $data = $this->validatedPayload($request);
        $record = IDODModel::create($data);

        return $this->crudResponse($request, 'Data berhasil ditambahkan.', $record, 201);
    }

    public function show_idod(Request $request, $id)
    {
        $record = IDODModel::findOrFail($id);

        return response()->json([
            'record' => $this->formatRow($record, forForm: true),
        ]);
    }

    public function update_idod(Request $request, $id)
    {
        $record = IDODModel::findOrFail($id);
        $record->update($this->validatedPayload($request));

        return $this->crudResponse($request, 'Data berhasil diperbarui.', $record->fresh());
    }

    public function destroy_idod(Request $request, $id)
    {
        $record = IDODModel::findOrFail($id);
        $record->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.',
            ]);
        }

        return redirect()->route('idod')->with('success', 'Data berhasil dihapus.');
    }

    private function validatedPayload(Request $request): array
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'size_id' => 'required|string|max:191',
            'jumlah_id' => 'required|integer|min:0',
            'jumlah_id_ng' => 'nullable|integer|min:0',
            'size_od' => 'required|string|max:191',
            'jumlah_od' => 'required|integer|min:0',
            'jumlah_od_ng' => 'nullable|integer|min:0',
            'tujuan' => ['required', 'string', Rule::in(self::TUJUAN_OPTIONS)],
            'shift' => ['required', 'string', Rule::in(self::SHIFT_OPTIONS)],
            'keterangan' => 'nullable|string|max:500',
        ]);

        if ((int) $validated['jumlah_id'] + (int) $validated['jumlah_od'] < 1) {
            throw ValidationException::withMessages([
                'jumlah_id' => ['Minimal salah satu jumlah ID OK atau OD OK harus lebih dari 0.'],
            ]);
        }

        $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');
        $validated['jumlah_id'] = (int) $validated['jumlah_id'];
        $validated['jumlah_id_ng'] = (int) ($validated['jumlah_id_ng'] ?? 0);
        $validated['jumlah_od'] = (int) $validated['jumlah_od'];
        $validated['jumlah_od_ng'] = (int) ($validated['jumlah_od_ng'] ?? 0);

        if ($validated['jumlah_id_ng'] > $validated['jumlah_id']) {
            throw ValidationException::withMessages([
                'jumlah_id_ng' => ['Jumlah ID NG tidak boleh melebihi Jumlah ID OK.'],
            ]);
        }

        if ($validated['jumlah_od_ng'] > $validated['jumlah_od']) {
            throw ValidationException::withMessages([
                'jumlah_od_ng' => ['Jumlah OD NG tidak boleh melebihi Jumlah OD OK.'],
            ]);
        }

        return $validated;
    }

    private function formatRow(IDODModel $row, bool $forForm = false): array
    {
        $reportDate = $row->report_date;

        return [
            'id' => $row->id,
            'date' => $forForm
                ? ($reportDate?->format('Y-m-d') ?? '')
                : ($row->date ?: ($row->created_at?->format('Y-m-d') ?? '—')),
            'size_id' => $forForm ? ($row->size_id ?? '') : ($row->size_id ?: '—'),
            'jumlah_id' => (int) $row->jumlah_id,
            'jumlah_id_ng' => (int) $row->jumlah_id_ng,
            'size_od' => $forForm ? ($row->size_od ?? '') : ($row->size_od ?: '—'),
            'jumlah_od' => (int) $row->jumlah_od,
            'jumlah_od_ng' => (int) $row->jumlah_od_ng,
            'total_jumlah' => $row->total_jumlah,
            'total_jumlah_ng' => $row->total_jumlah_ng,
            'tujuan' => $forForm ? ($row->tujuan ?? '') : ($row->tujuan ?: '—'),
            'shift' => $forForm ? ($row->shift ?? '') : ($row->shift ?: '—'),
            'keterangan' => $forForm ? ($row->keterangan ?? '') : ($row->keterangan ?: '—'),
            'created_at' => $row->created_at?->format('d-m-Y H:i') ?? '—',
        ];
    }

    private function crudResponse(Request $request, string $message, IDODModel $record, int $status = 200)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'record' => $this->formatRow($record),
            ], $status);
        }

        return redirect()->route('idod')->with('success', $message);
    }

    /**
     * @return array{query: Builder, filters: array<string, string>}
     */
    private function buildFilteredContext(Request $request, ?array $validated = null): array
    {
        $validated ??= $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'tujuan' => 'nullable|string|max:191',
            'shift' => 'nullable|string|max:191',
            'size_id' => 'nullable|string|max:191',
            'size_od' => 'nullable|string|max:191',
            'search' => 'nullable|string|max:191',
        ]);

        $to = isset($validated['to'])
            ? Carbon::parse($validated['to'])->endOfDay()
            : Carbon::now()->endOfDay();
        $from = isset($validated['from'])
            ? Carbon::parse($validated['from'])->startOfDay()
            : (clone $to)->subDays(30)->startOfDay();

        $query = IDODModel::query()
            ->inReportRange($from->toDateString(), $to->toDateString());

        foreach (['tujuan', 'shift', 'size_id', 'size_od'] as $field) {
            if (!empty($validated[$field])) {
                $query->where($field, $validated[$field]);
            }
        }

        if (!empty($validated['search'])) {
            $term = '%' . $validated['search'] . '%';
            $query->where(function ($q) use ($term) {
                $q->where('size_id', 'like', $term)
                    ->orWhere('size_od', 'like', $term)
                    ->orWhere('tujuan', 'like', $term)
                    ->orWhere('keterangan', 'like', $term)
                    ->orWhere('shift', 'like', $term)
                    ->orWhere('date', 'like', $term);
            });
        }

        return [
            'query' => $query,
            'filters' => [
                'from' => $from->toDateString(),
                'to' => $to->toDateString(),
                'size_id' => !empty($validated['size_id']) ? $validated['size_id'] : 'Semua',
                'size_od' => !empty($validated['size_od']) ? $validated['size_od'] : 'Semua',
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
        $totalOrderSql = 'COALESCE(SUM(jumlah_id), 0) + COALESCE(SUM(jumlah_id_ng), 0) + COALESCE(SUM(jumlah_od), 0) + COALESCE(SUM(jumlah_od_ng), 0)';

        $builder = (clone $query)
            ->select(
                $column,
                DB::raw('COALESCE(SUM(jumlah_id), 0) as jumlah_id'),
                DB::raw('COALESCE(SUM(jumlah_id_ng), 0) as jumlah_id_ng'),
                DB::raw('COALESCE(SUM(jumlah_od), 0) as jumlah_od'),
                DB::raw('COALESCE(SUM(jumlah_od_ng), 0) as jumlah_od_ng'),
                DB::raw("({$totalOrderSql}) as total_jumlah")
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
            'labels' => $rows->pluck($labelKey)->map(fn ($v) => $v ?: '—')->values(),
            'jumlah_id' => $rows->pluck('jumlah_id')->map(fn ($v) => (int) $v)->values(),
            'jumlah_id_ng' => $rows->pluck('jumlah_id_ng')->map(fn ($v) => (int) $v)->values(),
            'jumlah_od' => $rows->pluck('jumlah_od')->map(fn ($v) => (int) $v)->values(),
            'jumlah_od_ng' => $rows->pluck('jumlah_od_ng')->map(fn ($v) => (int) $v)->values(),
        ];
    }

    private function filterOptions(): array
    {
        return [
            'size_id' => IDODModel::query()->whereNotNull('size_id')->where('size_id', '!=', '')->distinct()->orderBy('size_id')->pluck('size_id'),
            'size_od' => IDODModel::query()->whereNotNull('size_od')->where('size_od', '!=', '')->distinct()->orderBy('size_od')->pluck('size_od'),
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
                'day' => Carbon::createFromFormat('Y-m-d', $key)->format('d M Y'),
                'year' => $key,
                default => Carbon::createFromFormat('Y-m', $key)->format('M Y'),
            };
        } catch (\Throwable) {
            return $key;
        }
    }
}
