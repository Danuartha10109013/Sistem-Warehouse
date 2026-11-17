<?php

namespace App\Http\Controllers;

use App\Exports\BreakBulkScanExport;
use App\Exports\BreakBulkTemplateExport;
use App\Imports\BreakBulkImport;
use App\Models\BreakBulk;
use App\Models\BreakBulkMaster;
use App\Models\BreakBulkScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BreakBulkController extends Controller
{
    // [TAG: HALAMAN UTAMA] Setting Break Bulk (Form Pemindaian & Tabel Scan)
    public function index(Request $request)
    {
        $this->ensureInitialMasterData();

        // Query relasi JOIN atribut agar weight & product selalu tersinkron dinamis
        $scans = BreakBulkScan::leftJoin('break_bulks', 'break_bulk_scans.atribut', '=', 'break_bulks.atribut')
            ->select(
                'break_bulk_scans.id',
                'break_bulk_scans.atribut',
                'break_bulk_scans.trailer',
                DB::raw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0) as weight'),
                DB::raw('COALESCE(NULLIF(break_bulks.product, "-"), NULLIF(break_bulk_scans.product, "-"), "Menunggu Import") as product'),
                DB::raw('COALESCE(break_bulk_scans.no_so, break_bulks.no_so) as no_so'),
                'break_bulk_scans.grouping',
                'break_bulk_scans.pod',
                'break_bulk_scans.lokasi',
                'break_bulk_scans.scanned_by',
                'break_bulk_scans.scanned_at',
                'break_bulk_scans.created_at',
                'break_bulks.id as master_id',
                'break_bulks.status as master_status'
            )
            ->orderBy('break_bulk_scans.id', 'desc')
            ->get();

        $groupingOptions = BreakBulkMaster::where('kategori', 'grouping')->pluck('nama');
        $podOptions      = BreakBulkMaster::where('kategori', 'pod')->pluck('nama');
        $lokasiOptions   = BreakBulkMaster::where('kategori', 'lokasi')->pluck('nama');

        $totalScans = $scans->count();
        $totalWeightScanned = $scans->sum('weight');

        return view('break_bulk.dashboard.index', compact(
            'scans',
            'groupingOptions',
            'podOptions',
            'lokasiOptions',
            'totalScans',
            'totalWeightScanned'
        ));
    }

    // [TAG: REDIRECT SCAN LAMA] Arahkan route scan lama ke index Setting Break Bulk
    public function scan(Request $request)
    {
        return redirect()->route('break-bulk.index');
    }

    // [TAG: AJAX CEK ATRIBUT] Cek dan Ambil Data Otomatis dari Tabel Tambah Data
    public function cekAtribut($atribut)
    {
        $cleanAttr = trim($atribut);
        $item = BreakBulk::where('atribut', $cleanAttr)->first();
        $existingScan = BreakBulkScan::where('atribut', $cleanAttr)->first();

        $scanData = null;
        if ($existingScan) {
            $scanData = [
                'trailer'  => $existingScan->trailer,
                'grouping' => $existingScan->grouping,
                'pod'      => $existingScan->pod,
                'lokasi'   => $existingScan->lokasi,
                'no_so'    => $existingScan->no_so,
            ];
        }

        if ($item) {
            return response()->json([
                'success'         => true,
                'exists'          => true,
                'already_scanned' => (bool)$existingScan,
                'existing_scan'   => $scanData,
                'data'            => [
                    'atribut' => $item->atribut,
                    'weight'  => (float)$item->weight,
                    'product' => $item->product,
                    'no_so'   => $item->no_so,
                ],
            ]);
        }

        return response()->json([
            'success'         => true,
            'exists'          => false,
            'already_scanned' => (bool)$existingScan,
            'existing_scan'   => $scanData,
            'message'         => 'Atribut belum terdaftar di Tambah Data (tetap bisa discan & disimpan, akan sinkron otomatis saat Excel di-upload).',
        ]);
    }

    // [TAG: SIMPAN SCAN] Simpan / Update Hasil Scan Operator (Upsert)
    public function storeScan(Request $request)
    {
        $request->validate([
            'atribut'  => 'required|string',
            'trailer'  => 'required|string',
            'weight'   => 'nullable|numeric',
            'product'  => 'nullable|string',
            'grouping' => 'required|string',
            'pod'      => 'required|string',
            'lokasi'   => 'required|string',
            'no_so'    => 'nullable|string',
        ]);

        $cleanAttr = trim($request->atribut);

        // Cek data di Tambah Data Break Bulk jika sudah ada
        $breakBulkItem = BreakBulk::where('atribut', $cleanAttr)->first();
        $weight = $breakBulkItem && $breakBulkItem->weight > 0
            ? (float)$breakBulkItem->weight
            : ($request->filled('weight') ? (float)$request->weight : 0);
        $product = $breakBulkItem && $breakBulkItem->product !== '-'
            ? $breakBulkItem->product
            : ($request->filled('product') ? trim($request->product) : 'Menunggu Import');
        $noSo = !empty($request->no_so)
            ? strtoupper(trim($request->no_so))
            : ($breakBulkItem ? $breakBulkItem->no_so : null);

        // Cek apakah atribut sudah pernah discan sebelumnya (Jika ya -> UPDATE)
        $existingScan = BreakBulkScan::where('atribut', $cleanAttr)->first();

        if ($existingScan) {
            $existingScan->update([
                'trailer'    => trim($request->trailer),
                'weight'     => $weight > 0 ? $weight : $existingScan->weight,
                'product'    => ($product && $product !== 'Menunggu Import') ? $product : $existingScan->product,
                'grouping'   => trim($request->grouping),
                'pod'        => strtoupper(trim($request->pod)),
                'no_so'      => $noSo ?: $existingScan->no_so,
                'lokasi'     => strtoupper(trim($request->lokasi)),
                'scanned_by' => Auth::check() ? Auth::user()->name : ($existingScan->scanned_by ?? 'Operator'),
                'scanned_at' => now(),
            ]);

            if ($breakBulkItem) {
                $updateData = [
                    'status'     => 'scanned',
                    'scanned_at' => now(),
                    'scanned_by' => Auth::id(),
                ];
                if (empty($breakBulkItem->no_so) && !empty($noSo)) {
                    $updateData['no_so'] = $noSo;
                }
                $breakBulkItem->update($updateData);
            }

            return redirect()->route('break-bulk.index')->with('success', "Data scan atribut {$cleanAttr} berhasil diperbarui ke Trailer {$request->trailer}!");
        }

        // Jika belum pernah discan, simpan sebagai data scan baru
        BreakBulkScan::create([
            'atribut'    => $cleanAttr,
            'trailer'    => trim($request->trailer),
            'weight'     => $weight,
            'product'    => $product ?: 'Menunggu Import',
            'grouping'   => trim($request->grouping),
            'pod'        => strtoupper(trim($request->pod)),
            'no_so'      => $noSo,
            'lokasi'     => strtoupper(trim($request->lokasi)),
            'scanned_by' => Auth::check() ? Auth::user()->name : 'Operator',
            'scanned_at' => now(),
        ]);

        if ($breakBulkItem) {
            $updateData = [
                'status'     => 'scanned',
                'scanned_at' => now(),
                'scanned_by' => Auth::id(),
            ];
            if (empty($breakBulkItem->no_so) && !empty($noSo)) {
                $updateData['no_so'] = $noSo;
            }
            $breakBulkItem->update($updateData);
        }

        $successMsg = $breakBulkItem
            ? "Atribut {$cleanAttr} berhasil diverifikasi & disimpan ke Trailer {$request->trailer}!"
            : "Atribut {$cleanAttr} berhasil disimpan ke Trailer {$request->trailer}! (Menunggu data spesifikasi di-import ke Tambah Data)";

        return redirect()->route('break-bulk.index')->with('success', $successMsg);
    }

    // [TAG: HAPUS SCAN] Hapus/Batalkan 1 Baris Scan
    public function destroyScan($id)
    {
        $scan = BreakBulkScan::findOrFail($id);
        $attr = $scan->atribut;

        // Kembalikan status di master impor ke pending
        BreakBulk::where('atribut', $attr)->update([
            'status'     => 'pending',
            'scanned_at' => null,
            'scanned_by' => null,
        ]);

        $scan->delete();

        return redirect()->route('break-bulk.index')->with('success', "Data scan atribut {$attr} berhasil dihapus.");
    }

    // [TAG: RESET SCAN] Reset Seluruh Scan Hari Ini
    public function destroyAllScan()
    {
        if (!Auth::check() || (Auth::user()->role != 0 && Auth::user()->role !== 'admin')) {
            return redirect()->route('break-bulk.index')->with('error', 'Akses ditolak: Hanya role Admin yang dapat mereset sesi scan.');
        }

        BreakBulkScan::truncate();
        BreakBulk::query()->update([
            'status'     => 'pending',
            'scanned_at' => null,
            'scanned_by' => null,
        ]);

        return redirect()->route('break-bulk.index')->with('success', 'Seluruh data scan berhasil direset.');
    }

    // [TAG: EXPORT EXCEL SCAN] Export hasil scan break bulk terurut per trailer dengan merge tonase
    public function exportExcel()
    {
        $scans = BreakBulkScan::leftJoin('break_bulks', 'break_bulk_scans.atribut', '=', 'break_bulks.atribut')
            ->select(
                'break_bulk_scans.id',
                'break_bulk_scans.atribut',
                'break_bulk_scans.trailer',
                DB::raw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0) as weight'),
                DB::raw('COALESCE(NULLIF(break_bulks.product, "-"), NULLIF(break_bulk_scans.product, "-"), "Menunggu Import") as product'),
                DB::raw('COALESCE(break_bulk_scans.no_so, break_bulks.no_so) as no_so'),
                'break_bulk_scans.grouping',
                'break_bulk_scans.pod',
                'break_bulk_scans.lokasi',
                'break_bulk_scans.scanned_by',
                'break_bulk_scans.scanned_at',
                'break_bulk_scans.created_at'
            )
            ->orderByRaw('CAST(break_bulk_scans.trailer AS UNSIGNED) ASC')
            ->orderBy('break_bulk_scans.trailer', 'asc')
            ->orderBy('break_bulk_scans.atribut', 'asc')
            ->get();

        if ($scans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data hasil scan untuk diexport.');
        }

        $groupedScans = $scans->groupBy('trailer');
        $totalItems   = $scans->count();
        $totalWeight  = $scans->sum('weight');

        $fileName = 'Hasil_Scan_Break_Bulk_' . date('Ymd_His') . '.xlsx';

        return Excel::download(new BreakBulkScanExport($groupedScans, $totalItems, $totalWeight), $fileName);
    }

    // [TAG: HALAMAN TONASE] Halaman Perhitungan / Monitoring Tonase per Trailer
    public function tonase(Request $request)
    {
        // Query relasi JOIN atribut agar tonase selalu tersinkron dinamis
        $scans = BreakBulkScan::leftJoin('break_bulks', 'break_bulk_scans.atribut', '=', 'break_bulks.atribut')
            ->select(
                'break_bulk_scans.id',
                'break_bulk_scans.atribut',
                'break_bulk_scans.trailer',
                DB::raw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0) as weight'),
                DB::raw('COALESCE(NULLIF(break_bulks.product, "-"), NULLIF(break_bulk_scans.product, "-"), "Menunggu Import") as product'),
                DB::raw('COALESCE(break_bulk_scans.no_so, break_bulks.no_so) as no_so'),
                'break_bulk_scans.grouping',
                'break_bulk_scans.pod',
                'break_bulk_scans.lokasi',
                'break_bulk_scans.scanned_by',
                'break_bulk_scans.scanned_at',
                'break_bulk_scans.created_at',
                'break_bulks.id as master_id'
            )
            ->orderBy('break_bulk_scans.created_at', 'desc')
            ->get();

        $grouped = $scans->groupBy('trailer');

        $trailers = $grouped->map(function ($items, $trailerNo) {
            return (object)[
                'trailer'      => $trailerNo,
                'total_koil'   => $items->count(),
                'total_weight' => $items->sum('weight'),
                'pods'         => $items->pluck('pod')->filter()->unique()->values(),
                'groupings'    => $items->pluck('grouping')->filter()->unique()->values(),
                'lokasis'      => $items->pluck('lokasi')->filter()->unique()->values(),
                'items'        => $items,
            ];
        })->sortBy('trailer')->values();

        $totalTrailer = $trailers->count();
        $totalKoil = $scans->count();
        $grandTotalWeight = $scans->sum('weight');

        return view('break_bulk.tonase.index', compact('trailers', 'totalTrailer', 'totalKoil', 'grandTotalWeight'));
    }

    // [TAG: HALAMAN TAMBAH DATA] Halaman Tambah & Import Data Excel
    public function tambahData(Request $request)
    {
        $data = BreakBulk::orderBy('id', 'desc')->get();
        $totalItems = $data->count();
        $totalWeight = $data->sum('weight');

        return view('break_bulk.tambah_data.index', compact('data', 'totalItems', 'totalWeight'));
    }

    // [TAG: IMPORT EXCEL] Proses Import File Excel
    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|max:20480',
        ], [
            'file_excel.required' => 'Pilih file Excel terlebih dahulu.',
            'file_excel.max'      => 'Ukuran file maksimal 20 MB.',
        ]);

        $file = $request->file('file_excel');
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
            return redirect()->route('break-bulk.tambah-data')->with('error', 'Format file harus berupa .xlsx, .xls, atau .csv.');
        }

        try {
            $import = new BreakBulkImport();
            Excel::import($import, $request->file('file_excel'));

            $pesan = "Import selesai. Berhasil tambah {$import->insertedCount} data baru";
            if ($import->updatedCount > 0) {
                $pesan .= ", memperbarui {$import->updatedCount} data";
            }
            $pesan .= ".";

            return redirect()->route('break-bulk.tambah-data')->with('success', $pesan);
        } catch (\Exception $e) {
            return redirect()->route('break-bulk.tambah-data')->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }

    // [TAG: HAPUS DATA TAMBAH] Hapus 1 Baris Data
    public function destroy($id)
    {
        $item = BreakBulk::findOrFail($id);
        $item->delete();

        return redirect()->route('break-bulk.tambah-data')->with('success', 'Data berhasil dihapus.');
    }

    // [TAG: HAPUS SEMUA DATA TAMBAH] Reset / Hapus Seluruh Data Tambah
    public function destroyAll()
    {
        if (!Auth::check() || (Auth::user()->role != 0 && Auth::user()->role !== 'admin')) {
            return redirect()->route('break-bulk.tambah-data')->with('error', 'Akses ditolak: Hanya role Admin yang dapat mereset data break bulk.');
        }

        BreakBulk::truncate();
        return redirect()->route('break-bulk.tambah-data')->with('success', 'Seluruh data Break Bulk berhasil direset.');
    }

    // [TAG: DOWNLOAD TEMPLATE] Unduh Contoh Format Excel (.xlsx)
    public function downloadTemplate()
    {
        $fileName = 'Template_Import_Break_Bulk.xlsx';
        return Excel::download(new BreakBulkTemplateExport(), $fileName);
    }

    // [TAG: HALAMAN MASTER DATA] Master Data (Grouping, POD, Lokasi)
    public function masterData(Request $request)
    {
        $this->ensureInitialMasterData();

        $groupings = BreakBulkMaster::where('kategori', 'grouping')->orderBy('nama')->get();
        $pods      = BreakBulkMaster::where('kategori', 'pod')->orderBy('nama')->get();
        $lokasis   = BreakBulkMaster::where('kategori', 'lokasi')->orderBy('nama')->get();

        return view('break_bulk.master_data.index', compact('groupings', 'pods', 'lokasis'));
    }

    // [TAG: SIMPAN MASTER DATA] Tambah Opsi Master Baru
    public function storeMaster(Request $request)
    {
        $request->validate([
            'kategori'   => 'required|in:grouping,pod,lokasi',
            'nama'       => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        BreakBulkMaster::create([
            'kategori'   => $request->kategori,
            'nama'       => strtoupper(trim($request->nama)),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('break-bulk.master-data', ['tab' => $request->kategori])->with('success', 'Master data berhasil ditambahkan.');
    }

    // [TAG: HAPUS MASTER DATA] Hapus Opsi Master
    public function destroyMaster($id)
    {
        $master = BreakBulkMaster::findOrFail($id);
        $kategori = $master->kategori;
        $master->delete();

        return redirect()->route('break-bulk.master-data', ['tab' => $kategori])->with('success', 'Master data berhasil dihapus.');
    }

    // Helper: Buat data default jika master data masih kosong
    private function ensureInitialMasterData(): void
    {
        if (BreakBulkMaster::count() === 0) {
            $initials = [
                // Grouping
                ['kategori' => 'grouping', 'nama' => 'CR NON OIL', 'keterangan' => 'Standar Cold Rolled non-oil'],
                ['kategori' => 'grouping', 'nama' => 'CR OIL', 'keterangan' => 'Cold Rolled oiled'],
                ['kategori' => 'grouping', 'nama' => 'GI', 'keterangan' => 'Galvanized Iron'],
                ['kategori' => 'grouping', 'nama' => 'GL', 'keterangan' => 'Galvalume'],
                // POD (Port of Discharge)
                ['kategori' => 'pod', 'nama' => 'HOUSTON', 'keterangan' => 'Port of Houston'],
                ['kategori' => 'pod', 'nama' => 'CHARLESTON', 'keterangan' => 'Port of Charleston'],
                ['kategori' => 'pod', 'nama' => 'TAMPA', 'keterangan' => 'Port of Tampa'],
                ['kategori' => 'pod', 'nama' => 'NEW ORLEANS', 'keterangan' => 'Port of New Orleans'],
                // Lokasi
                ['kategori' => 'lokasi', 'nama' => 'TB-1', 'keterangan' => 'Area Muat Trailer Bay 1'],
                ['kategori' => 'lokasi', 'nama' => 'TB-2', 'keterangan' => 'Area Muat Trailer Bay 2'],
                ['kategori' => 'lokasi', 'nama' => 'TB-3', 'keterangan' => 'Area Muat Trailer Bay 3'],
                ['kategori' => 'lokasi', 'nama' => 'WH-A', 'keterangan' => 'Gudang Utama A'],
            ];

            foreach ($initials as $item) {
                BreakBulkMaster::create($item);
            }
        }
    }
}
