<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapPrdController extends Controller
{
    public function index(Request $request)
    {
        // [TAG: FILTER AWAL] Mengambil filter dari URL, secara default menampilkan grafik 'harian'
        $filter = $request->query('filter', 'harian'); 
        
        if ($filter == 'bulanan') {
            // [TAG: QUERY BULANAN] Mengelompokkan semua data (tanpa memandang tahun spesifik) menjadi per Bulan
            // DATE_FORMAT mengubah tanggal menjadi 'YYYY-MM' untuk dijadikan acuan group by
            $data = \App\Models\RekapPrd::selectRaw('
                DATE_FORMAT(tanggal, "%Y-%m") as periode, 
                SUM(hasil_prd) as hasil_prd,
                SUM(pengeluaran_tml) as pengeluaran_tml,
                SUM(pengeluaran_ttl) as pengeluaran_ttl,
                SUM(total_pengeluaran) as total_pengeluaran,
                SUM(sisa_stock) as sisa_stock
            ')
            ->groupBy('periode')
            ->orderBy('periode', 'desc')
            ->get();
        } elseif ($filter == 'tahunan') {
            // [TAG: QUERY TAHUNAN] Mengelompokkan semua data ke total Per Tahun (YYYY)
            $data = \App\Models\RekapPrd::selectRaw('
                YEAR(tanggal) as periode, 
                SUM(hasil_prd) as hasil_prd,
                SUM(pengeluaran_tml) as pengeluaran_tml,
                SUM(pengeluaran_ttl) as pengeluaran_ttl,
                SUM(total_pengeluaran) as total_pengeluaran,
                SUM(sisa_stock) as sisa_stock
            ')
            ->groupBy('periode')
            ->orderBy('periode', 'desc')
            ->get();
        } else {
            // [TAG: QUERY HARIAN] Mengambil semua data secara harian (tidak di grouping)
            $data = \App\Models\RekapPrd::orderBy('tanggal', 'desc')->get();
        }

        $latest = \App\Models\RekapPrd::orderBy('tanggal', 'desc')->first();
        $year = date('Y');

        return view('rekap_prd.dashboard.index', compact('data', 'latest', 'year', 'filter'));
    }

    public function input(Request $request)
    {
        // [TAG: FILTER SPESIFIK] Mengambil nilai filter dan inputan spesifik tanggal dari halaman
        $filter = $request->query('filter', 'harian'); 
        $filter_date = $request->query('filter_date', date('Y-m-d'));
        $filter_month = $request->query('filter_month', date('Y-m'));
        $filter_year = $request->query('filter_year', date('Y'));
        
        if ($filter == 'harian') {
            // Jika mode Harian: Filter hanya untuk 1 tanggal spesifik secara persis
            $data = \App\Models\RekapPrd::whereDate('tanggal', $filter_date)->orderBy('tanggal', 'asc')->get();
        } elseif ($filter == 'bulanan') {
            // Jika mode Bulanan: Filter hanya untuk bulan dan tahun spesifik
            // Hasilnya akan berupa rincian setiap tanggal di bulan tersebut
            $year = substr($filter_month, 0, 4);
            $month = substr($filter_month, 5, 2);
            $data = \App\Models\RekapPrd::whereYear('tanggal', $year)
                                        ->whereMonth('tanggal', $month)
                                        ->orderBy('tanggal', 'asc')
                                        ->get();
        } elseif ($filter == 'tahunan') {
            // Jika mode Tahunan: Filter untuk tahun spesifik, lalu dikelompokkan (SUM) berdasarkan Nomor Bulan (1-12)
            $data = \App\Models\RekapPrd::selectRaw('
                MONTH(tanggal) as periode, 
                SUM(hasil_prd) as hasil_prd,
                SUM(pengeluaran_tml) as pengeluaran_tml,
                SUM(pengeluaran_ttl) as pengeluaran_ttl,
                SUM(total_pengeluaran) as total_pengeluaran,
                SUM(sisa_stock) as sisa_stock
            ')
            ->whereYear('tanggal', $filter_year)
            ->groupBy('periode')
            ->orderBy('periode', 'asc')
            ->get();
        } else {
            $data = \App\Models\RekapPrd::orderBy('tanggal', 'desc')->get();
        }

        return view('rekap_prd.dashboard.input', compact('data', 'filter', 'filter_date', 'filter_month', 'filter_year'));
    }

    public function store(Request $request)
    {
        // [TAG: VALIDASI] Memastikan input form sudah lengkap dan format file benar
        $request->validate([
            'tanggal' => 'required|date',
            'file_prd' => 'required|mimes:xlsx,xls,csv',
            'file_tml' => 'required|mimes:xlsx,xls,csv',
            'file_ttl' => 'required|mimes:xlsx,xls,csv',
        ]);

        $tanggal = $request->tanggal;

        // [TAG: PERHITUNGAN PRD] Membaca file PRD CGL dan menjumlahkan seluruh baris di kolom Qty
        $prdData = \Maatwebsite\Excel\Facades\Excel::toArray(new \App\Imports\RekapImport, $request->file('file_prd'));
        $totalPrd = 0;
        if(isset($prdData[0])) {
            foreach ($prdData[0] as $row) {
                $totalPrd += (int)($row['movement_quantity'] ?? $row['movement_qty'] ?? $row['qty'] ?? 0);
            }
        }

        // [TAG: PERHITUNGAN TML] Membaca file PENGELUARAN TML dan menjumlahkan kolom Qty
        $tmlData = \Maatwebsite\Excel\Facades\Excel::toArray(new \App\Imports\RekapImport, $request->file('file_tml'));
        $totalTml = 0;
        if(isset($tmlData[0])) {
            foreach ($tmlData[0] as $row) {
                $totalTml += (int)($row['movement_qty'] ?? $row['movement_quantity'] ?? $row['qty'] ?? 0);
            }
        }

        // [TAG: PERHITUNGAN TTL] Membaca file PENGELUARAN TTL dan menjumlahkan kolom Qty
        $ttlData = \Maatwebsite\Excel\Facades\Excel::toArray(new \App\Imports\RekapImport, $request->file('file_ttl'));
        $totalTtl = 0;
        if(isset($ttlData[0])) {
            foreach ($ttlData[0] as $row) {
                $totalTtl += (int)($row['qty'] ?? $row['movement_qty'] ?? $row['movement_quantity'] ?? 0);
            }
        }

        // [TAG: RUMUS AKHIR] Menjumlahkan Total Pengeluaran dan menghitung Sisa Stock
        $totalPengeluaran = $totalTml + $totalTtl; // Total barang keluar hari ini
        
        // Cari sisa stock di hari/tanggal sebelum inputan ini
        $previousData = \App\Models\RekapPrd::where('tanggal', '<', $tanggal)
                                            ->orderBy('tanggal', 'desc')
                                            ->first();
        $sisaStockKemarin = $previousData ? $previousData->sisa_stock : 0;
        
        // Sisa Stock Hari Ini = Sisa Stock Kemarin + Produksi Hari Ini - Pengeluaran Hari Ini
        $sisaStock = $sisaStockKemarin + $totalPrd - $totalPengeluaran;

        // [TAG: SIMPAN DATABASE] Menyimpan atau memperbarui data (UpdateOrCreate) ke database berdasarkan tanggal input
        \App\Models\RekapPrd::updateOrCreate(
            ['tanggal' => $tanggal],
            [
                'hasil_prd' => $totalPrd,
                'pengeluaran_tml' => $totalTml,
                'pengeluaran_ttl' => $totalTtl,
                'total_pengeluaran' => $totalPengeluaran,
                'sisa_stock' => $sisaStock,
            ]
        );

        // [TAG: REKALKULASI] Jika admin menginput data tanggal di masa lalu, kita harus menghitung ulang sisa stock untuk hari-hari setelahnya
        $subsequentData = \App\Models\RekapPrd::where('tanggal', '>', $tanggal)
                                              ->orderBy('tanggal', 'asc')
                                              ->get();
        
        $currentSisaStock = $sisaStock;
        foreach ($subsequentData as $data) {
            $currentSisaStock = $currentSisaStock + $data->hasil_prd - $data->total_pengeluaran;
            $data->update(['sisa_stock' => $currentSisaStock]);
        }

        return redirect()->back()->with('success', 'Data rekap berhasil dihitung dan disimpan!');
    }

    public function exportExcel(Request $request)
    {
        $filter = $request->input('filter', 'harian');
        $filter_date = $request->input('filter_date', date('Y-m-d'));
        $filter_month = $request->input('filter_month', date('Y-m'));
        $filter_year = $request->input('filter_year', date('Y'));
        
        $chartImage = $request->input('chart_image');
        
        if ($filter == 'harian') {
            $data = \App\Models\RekapPrd::whereDate('tanggal', $filter_date)->orderBy('tanggal', 'asc')->get();
            $exportName = 'Harian_' . $filter_date;
        } elseif ($filter == 'bulanan') {
            $year = substr($filter_month, 0, 4);
            $month = substr($filter_month, 5, 2);
            $data = \App\Models\RekapPrd::whereYear('tanggal', $year)
                                        ->whereMonth('tanggal', $month)
                                        ->orderBy('tanggal', 'asc')
                                        ->get();
            $exportName = 'Bulanan_' . $filter_month;
        } elseif ($filter == 'tahunan') {
            $data = \App\Models\RekapPrd::selectRaw('
                MONTH(tanggal) as periode, 
                SUM(hasil_prd) as hasil_prd,
                SUM(pengeluaran_tml) as pengeluaran_tml,
                SUM(pengeluaran_ttl) as pengeluaran_ttl,
                SUM(total_pengeluaran) as total_pengeluaran,
                SUM(sisa_stock) as sisa_stock
            ')
            ->whereYear('tanggal', $filter_year)
            ->groupBy('periode')
            ->orderBy('periode', 'asc')
            ->get();
            $exportName = 'Tahunan_' . $filter_year;
        } else {
            $data = \App\Models\RekapPrd::orderBy('tanggal', 'asc')->get();
            $exportName = 'Semua';
        }

        // Decode Base64 Image
        $imagePath = null;
        if ($chartImage) {
            $imageParts = explode(";base64,", $chartImage);
            if (count($imageParts) == 2) {
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = 'chart_rekap_' . time() . '.png';
                $imagePath = storage_path('app/public/' . $fileName);
                
                // Pastikan direktori public ada
                if(!file_exists(storage_path('app/public'))) {
                    mkdir(storage_path('app/public'), 0777, true);
                }
                file_put_contents($imagePath, $imageBase64);
            }
        }

        $fileName = 'Rekap_PRD_' . $exportName . '_' . date('YmdHis') . '.xlsx';
        
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\RekapPrdExport($data, $filter, $imagePath), $fileName);
    }

    public function destroy($id)
    {
        $rekap = \App\Models\RekapPrd::findOrFail($id);
        $tanggal = $rekap->tanggal;
        $rekap->delete();

        // [TAG: REKALKULASI SETELAH HAPUS] Menghitung ulang sisa stock hari-hari setelahnya
        $subsequentData = \App\Models\RekapPrd::where('tanggal', '>', $tanggal)
                                              ->orderBy('tanggal', 'asc')
                                              ->get();
        
        // Ambil sisa stock hari sebelum yang dihapus
        $previousData = \App\Models\RekapPrd::where('tanggal', '<', $tanggal)
                                            ->orderBy('tanggal', 'desc')
                                            ->first();
        $currentSisaStock = $previousData ? $previousData->sisa_stock : 0;
        
        foreach ($subsequentData as $data) {
            $currentSisaStock = $currentSisaStock + $data->hasil_prd - $data->total_pengeluaran;
            $data->update(['sisa_stock' => $currentSisaStock]);
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus dan Sisa Stock telah disesuaikan kembali!');
    }
}
