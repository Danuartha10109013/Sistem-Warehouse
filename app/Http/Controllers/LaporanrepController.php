<?php

namespace App\Http\Controllers;

use App\Models\LaporanrepackingM;
use App\Imports\DaftarRepackingImport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Maatwebsite\Excel\Facades\Excel;

class LaporanrepController extends Controller
{
    private const STATUS_OPTIONS = ['Retur', 'Naik Lagi', 'Skip Lama'];

    private const GROUP_OPTIONS = ['Grup A', 'Grup B', 'Grup C', 'Grup D'];

    private const WRAPPING_OPTIONS = ['Pakai', 'Tidak Pakai'];

    private const VCIPAPER_OPTIONS = ['Pakai', 'Tidak Pakai'];

    public function index()
    {
        return view('laporanrepacking.index', [
            'statusOptions' => collect(self::STATUS_OPTIONS),
            'groupOptions' => collect(self::GROUP_OPTIONS),
            'wrappingOptions' => collect(self::WRAPPING_OPTIONS),
            'vcipaperOptions' => collect(self::VCIPAPER_OPTIONS),
        ]);
    }

    public function dashboardData(Request $request)
    {
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'status' => 'nullable|string|max:191',
            'group' => 'nullable|string|max:191',
            'search' => 'nullable|string|max:191',
            'page' => 'nullable|integer|min:1',
        ]);

        $page = max(1, (int) ($validated['page'] ?? $request->input('page', 1)));
        $perPage = 15;

        ['query' => $query, 'filters' => $filterMeta] = $this->buildFilteredContext($request, $validated);

        $totalRecords = (clone $query)->count();

        $paginated = (clone $query)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'filters' => $filterMeta,
            'summary' => [
                'total_records' => $totalRecords,
            ],
            'rows' => collect($paginated->items())
                ->map(fn(LaporanrepackingM $row) => $this->formatRow($row))
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

    public function add_laporanrepacking()
    {
        return redirect()->to(route('laporanrepacking') . '#tambah-data');
    }

    public function edit_laporanrepacking($id)
    {
        return redirect()->to(route('laporanrepacking') . '?edit=' . $id);
    }

    public function create_laporanrepacking(Request $request)
    {
        $data = $this->validatedPayload($request);
        $data['created_by'] = Auth::user()->name ?? Auth::user()->email ?? 'System';

        // Cek apakah ada record dengan status Pending untuk atribut ini
        $record = LaporanrepackingM::where('atributte', $data['atributte'])
            ->where('status', 'Pending')
            ->orderBy('id', 'asc')
            ->first();

        if ($record) {
            // Update record yang Pending
            $record->update($data);
            $message = 'Laporan repacking CRC berhasil diperbarui dari daftar.';
        } else {
            // Buat record baru jika tidak ada yang Pending
            $record = LaporanrepackingM::create($data);
            $message = 'Laporan repacking CRC berhasil ditambahkan.';
        }

        return $this->crudResponse($request, $message, $record, 201);
    }

    public function show_laporanrepacking(Request $request, $id)
    {
        $record = LaporanrepackingM::findOrFail($id);

        return response()->json([
            'record' => $this->formatRow($record, forForm: true),
        ]);
    }

    public function update_laporanrepacking(Request $request, $id)
    {
        $record = LaporanrepackingM::findOrFail($id);
        $record->update($this->validatedPayload($request));

        return $this->crudResponse($request, 'Laporan repacking CRC berhasil diperbarui.', $record->fresh());
    }

    public function destroy_laporanrepacking(Request $request, $id)
    {
        $record = LaporanrepackingM::findOrFail($id);
        $record->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.',
            ]);
        }

        return redirect()->route('laporanrepacking')->with('success', 'Data berhasil dihapus.');
    }

    public function getDaftarRepacking(Request $request)
    {
        $data = LaporanrepackingM::where('status', 'Pending')->orderBy('id', 'asc')->get();
        // ubah 'atributte' menjadi 'atribute' agar sesuai dgn frontend JS yg sdh ada
        $data = $data->map(function ($item) {
            $item->atribute = $item->atributte;
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function uploadDaftarRepacking(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|max:10240'
        ]);

        try {
            Excel::import(new DaftarRepackingImport, $request->file('file_excel'));
            return response()->json(['success' => true, 'message' => 'Daftar Repacking berhasil diunggah!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengunggah: ' . $e->getMessage()]);
        }
    }

    public function storeDaftarRepacking(Request $request)
    {
        $request->validate([
            'atribute' => 'required|string|max:255',
            'ukuran' => 'nullable|string|max:255',
            'berat' => 'nullable|string|max:255',
            'layout' => 'nullable|string|max:255',
        ]);

        LaporanrepackingM::create([
            'atributte' => $request->atribute, // note spelling difference in DB
            'ukuran' => $request->ukuran,
            'berat' => $request->berat,
            'layout' => $request->layout,
            'status' => 'Pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Data Daftar Repacking berhasil ditambahkan!']);
    }

    public function downloadFormatDaftar()
    {
        return Excel::download(new \App\Exports\FormatDaftarExport, 'Format_Daftar_Repacking.xlsx');
    }

    public function laporanrepacking_export(Request $request): StreamedResponse
    {
        ['query' => $query, 'filters' => $filters] = $this->buildFilteredContext($request);

        $records = (clone $query)->orderByDesc('created_at')->get();

        $filename = sprintf(
            'Laporan_Repacking_CRC_%s_%s.csv',
            $filters['from'],
            $filters['to']
        );

        return response()->streamDownload(function () use ($records) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'No',
                'Attribute',
                'Tanggal',
                'Status',
                'Group',
                'Wrapping',
                'VCI Paper',
                'Keterangan',
                'Dibuat Oleh',
                'Dibuat Pada',
            ]);

            foreach ($records as $index => $row) {
                $formatted = $this->formatRow($row);
                fputcsv($handle, [
                    $index + 1,
                    $formatted['atributte'],
                    $formatted['tanggal'],
                    $formatted['status'],
                    $formatted['group'],
                    $formatted['wrapping'],
                    $formatted['vcipaper'],
                    $formatted['keterangan'],
                    $formatted['created_by'],
                    $formatted['created_at'],
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function print_laporanrepacking($id)
    {
        $record = LaporanrepackingM::findOrFail($id);

        return view('laporanrepacking.print', [
            'record' => $this->formatRow($record),
        ]);
    }

    private function validatedPayload(Request $request): array
    {
        $validated = $request->validate([
            'atributte' => 'required|string|max:191',
            'tanggal' => 'required|date',
            'status' => ['required', 'string', Rule::in(self::STATUS_OPTIONS)],
            'group' => ['required', 'string', Rule::in(self::GROUP_OPTIONS)],
            'wrapping' => ['required', 'string', Rule::in(self::WRAPPING_OPTIONS)],
            'vcipaper' => ['required', 'string', Rule::in(self::VCIPAPER_OPTIONS)],
            'keterangan' => 'nullable|string|max:500',
        ]);

        $validated['tanggal'] = Carbon::parse($validated['tanggal'])->format('Y-m-d');

        return $validated;
    }

    private function formatRow(LaporanrepackingM $row, bool $forForm = false): array
    {
        $reportDate = $row->report_date;

        return [
            'id' => $row->id,
            'atributte' => $forForm ? ($row->atributte ?? '') : ($row->atributte ?: '—'),
            'tanggal' => $forForm
                ? ($reportDate?->format('Y-m-d') ?? '')
                : ($row->tanggal ?: ($row->created_at?->format('d-m-Y') ?? '—')),
            'status' => $forForm ? ($row->status ?? '') : ($row->status ?: '—'),
            'group' => $forForm ? ($row->group ?? '') : ($row->group ?: '—'),
            'wrapping' => $forForm ? ($row->wrapping ?? '') : ($row->wrapping ?: '—'),
            'vcipaper' => $forForm ? ($row->vcipaper ?? '') : ($row->vcipaper ?: '—'),
            'keterangan' => $forForm ? ($row->keterangan ?? '') : ($row->keterangan ?: '—'),
            'created_by' => $forForm ? ($row->created_by ?? '') : ($row->created_by ?: '—'),
            'created_at' => $row->created_at?->format('d-m-Y H:i') ?? '—',
        ];
    }

    private function crudResponse(Request $request, string $message, LaporanrepackingM $record, int $status = 200)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'record' => $this->formatRow($record),
            ], $status);
        }

        return redirect()->route('laporanrepacking')->with('success', $message);
    }

    /**
     * @return array{query: Builder, filters: array<string, string>}
     */
    private function buildFilteredContext(Request $request, ?array $validated = null): array
    {
        $validated ??= $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'status' => 'nullable|string|max:191',
            'group' => 'nullable|string|max:191',
            'search' => 'nullable|string|max:191',
        ]);

        $to = isset($validated['to'])
            ? Carbon::parse($validated['to'])->endOfDay()
            : Carbon::now()->endOfDay();
        $from = isset($validated['from'])
            ? Carbon::parse($validated['from'])->startOfDay()
            : (clone $to)->subDays(30)->startOfDay();

        $query = LaporanrepackingM::query()
            ->where('status', '!=', 'Pending')
            ->inReportRange($from->toDateString(), $to->toDateString());

        foreach (['status', 'group'] as $field) {
            if (!empty($validated[$field])) {
                $query->where($field, $validated[$field]);
            }
        }

        if (!empty($validated['search'])) {
            $term = '%' . $validated['search'] . '%';
            $query->where(function (Builder $q) use ($term) {
                $q->where('atributte', 'like', $term)
                    ->orWhere('status', 'like', $term)
                    ->orWhere('group', 'like', $term)
                    ->orWhere('wrapping', 'like', $term)
                    ->orWhere('vcipaper', 'like', $term)
                    ->orWhere('keterangan', 'like', $term)
                    ->orWhere('created_by', 'like', $term);
            });
        }

        return [
            'query' => $query,
            'filters' => [
                'from' => $from->format('d-m-Y'),
                'to' => $to->format('d-m-Y'),
                'status' => $validated['status'] ?? '',
                'group' => $validated['group'] ?? '',
                'search' => $validated['search'] ?? '',
            ],
        ];
    }
}
