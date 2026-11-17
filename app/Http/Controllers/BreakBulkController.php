<?php

namespace App\Http\Controllers;

use App\Imports\BreakBulkImport;
use App\Models\BreakBulk;
use App\Models\BreakBulkMaster;
use App\Models\BreakBulkScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BreakBulkController extends Controller
{
    // [TAG: HALAMAN UTAMA] Setting Break Bulk (Form Pemindaian & Tabel Scan)
    public function index(Request $request)
    {
        $this->ensureInitialMasterData();

        $scans = BreakBulkScan::orderBy('id', 'desc')->get();
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

        $alreadyScanned = BreakBulkScan::where('atribut', $cleanAttr)->exists();

        if ($item) {
            return response()->json([
                'success'         => true,
                'exists'          => true,
                'already_scanned' => $alreadyScanned,
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
            'already_scanned' => $alreadyScanned,
            'message'         => 'Atribut belum terdaftar di tabel Tambah Data!',
        ]);
    }

    // [TAG: SIMPAN SCAN] Simpan Hasil Scan Operator
    public function storeScan(Request $request)
    {
        $request->validate([
            'atribut'  => 'required|string',
            'trailer'  => 'required|string',
            'weight'   => 'required|numeric',
            'product'  => 'required|string',
            'grouping' => 'required|string',
            'pod'      => 'required|string',
            'lokasi'   => 'required|string',
            'no_so'    => 'nullable|string',
        ]);

        $cleanAttr = trim($request->atribut);

        // Cegah duplikasi scan
        if (BreakBulkScan::where('atribut', $cleanAttr)->exists()) {
            return redirect()->route('break-bulk.index')->with('error', "Atribut {$cleanAttr} sudah pernah discan!");
        }

        // Simpan transaksi scan
        BreakBulkScan::create([
            'atribut'    => $cleanAttr,
            'trailer'    => strtoupper(trim($request->trailer)),
            'weight'     => $request->weight,
            'product'    => trim($request->product),
            'grouping'   => trim($request->grouping),
            'pod'        => strtoupper(trim($request->pod)),
            'no_so'      => !empty($request->no_so) ? strtoupper(trim($request->no_so)) : null,
            'lokasi'     => strtoupper(trim($request->lokasi)),
            'scanned_by' => Auth::check() ? Auth::user()->name : 'Operator',
            'scanned_at' => now(),
        ]);

        // Perbarui status dan no_so di data master impor jika diisi
        $breakBulkItem = BreakBulk::where('atribut', $cleanAttr)->first();
        if ($breakBulkItem) {
            $updateData = [
                'status'     => 'scanned',
                'scanned_at' => now(),
                'scanned_by' => Auth::id(),
            ];
            if (empty($breakBulkItem->no_so) && !empty($request->no_so)) {
                $updateData['no_so'] = strtoupper(trim($request->no_so));
            }
            $breakBulkItem->update($updateData);
        }

        return redirect()->route('break-bulk.index')->with('success', "Atribut {$cleanAttr} berhasil discan!");
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
        BreakBulkScan::truncate();
        BreakBulk::query()->update([
            'status'     => 'pending',
            'scanned_at' => null,
            'scanned_by' => null,
        ]);

        return redirect()->route('break-bulk.index')->with('success', 'Seluruh data scan berhasil direset.');
    }

    // [TAG: HALAMAN TONASE] Halaman Perhitungan / Monitoring Tonase per Trailer
    public function tonase(Request $request)
    {
        $scans = BreakBulkScan::orderBy('created_at', 'desc')->get();
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
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:20480',
        ], [
            'file_excel.required' => 'Pilih file Excel terlebih dahulu.',
            'file_excel.mimes'    => 'Format file harus berupa .xlsx, .xls, atau .csv.',
            'file_excel.max'      => 'Ukuran file maksimal 20 MB.',
        ]);

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
        BreakBulk::truncate();
        return redirect()->route('break-bulk.tambah-data')->with('success', 'Seluruh data Break Bulk berhasil direset.');
    }

    // [TAG: DOWNLOAD TEMPLATE] Unduh Contoh Format Excel
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_break_bulk.csv"',
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['NO', 'Atribut', 'Weight', 'Product', 'NO SO']);
            fputcsv($handle, ['1', 'TML-BB-001', '12500.50', 'CRC PRIME COIL', 'SO-2026-001']);
            fputcsv($handle, ['2', 'TML-BB-002', '11800.00', 'CRC SECONDARY COIL', '']);
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
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
