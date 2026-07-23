<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStock;
use App\Models\Setting;
use Carbon\Carbon;

class KapasitasController extends Controller
{
    /**
     * Menampilkan halaman perhitungan Kapasitas CRC
     */
    public function crc(Request $request)
    {
        // 1. Ambil bulan dan tahun dari request
        $filterMonth = $request->input('filter_month');
        if ($filterMonth) {
            $parts = explode('-', $filterMonth);
            $year = $parts[0];
            $month = $parts[1];
        } else {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
        }

        // 2. Tentukan jumlah hari dalam bulan dan tahun yang dipilih
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        // 3. Ambil nilai Kapasitas (KAP) dari pengaturan (tabel settings)
        // Kita menggunakan key 'kapasitas_crc' dengan nilai default 6760 (sesuai contoh gambar)
        $kapasitasSetting = Setting::where('key', 'kapasitas_crc')->first();
        $kapasitasValue = $kapasitasSetting ? (float)$kapasitasSetting->value : 6760;

        // 4. Ambil data stok harian berdasarkan bulan dan tahun yang dipilih
        // Filter kategori 'CRC', 'PRD', dan 'QA' saja agar query lebih cepat
        $stocks = DailyStock::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get(); // Ambil semua dan filter manual saja karena ada logic group dll

        // 5. Inisialisasi array untuk menyimpan data setiap harinya (1 sampai tanggal terakhir)
        $dataCrc = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $dataCrc[$d] = [
                'wh' => 0,
                'prd_qa' => 0,
            ];
        }

        // 6. Mengolah data stok (looping) ke dalam array berdasarkan tanggal
        foreach ($stocks as $stock) {
            $cat = trim(strtoupper($stock->kategori));
            $group = strtoupper($stock->kategori_grup ?: 'BARANG JADI');
            $source = strtoupper(trim($stock->source));
            $day = Carbon::parse($stock->tanggal)->day;

            // Kondisi WH CRC: Kategori CRC, grup harus BAHAN BAKU, dan sumbernya awalnya L3BB CRC
            if ($cat === 'CRC' && $group === 'BAHAN BAKU') {
                if ($source === 'L3-BB' || $source === 'L3BB' || $source === 'PRD-L3BB') {
                    $dataCrc[$day]['wh'] += $stock->quantity;
                }
            }

            // Kondisi PRD & QA: Kategori PRD atau QA, dan grup harus BAHAN BAKU yang oranye
            if (($cat === 'PRD' || $cat === 'QA' || str_contains($cat, 'PRD') || str_contains($cat, 'QA')) && $group === 'BAHAN BAKU') {
                $dataCrc[$day]['prd_qa'] += $stock->quantity;
            }
        }

        // 7. Kalkulasi total (WH + PRD_QA), nilai Trend, serta Rata-rata (Average) dan Nilai Tertinggi (Max)
        $processedData = [];
        $sumWh = 0;
        $sumPrdQa = 0;
        $sumTotal = 0;
        $sumTrend = 0;

        $maxWh = 0;
        
        $validDaysCount = 0;
        $maxPrdQa = 0;
        $maxTotal = 0;
        $maxTrend = 0;

        for ($d = 1; $d <= $daysInMonth; $d++) {
            if (\Carbon\Carbon::create($year, $month, $d)->isSunday()) continue;
            $validDaysCount++;
            
            // Rumus: dibagi 1000
            $wh = $dataCrc[$d]['wh'] / 1000;
            $prdQa = $dataCrc[$d]['prd_qa'] / 1000;
            
            $totalStock = $wh + $prdQa;
            
            // Trend = Total Stock dibagi Kapasitas (kemudian dijadikan persen di view, di sini dikali 100)
            $trend = $kapasitasValue > 0 ? ($totalStock / $kapasitasValue) * 100 : 0;

            // Simpan nilai tertinggi (Max)
            if ($wh > $maxWh) $maxWh = $wh;
            if ($prdQa > $maxPrdQa) $maxPrdQa = $prdQa;
            if ($totalStock > $maxTotal) $maxTotal = $totalStock;
            if ($trend > $maxTrend) $maxTrend = $trend;

            // Tambahkan ke Sum untuk rata-rata (Average)
            $sumWh += $wh;
            $sumPrdQa += $prdQa;
            $sumTotal += $totalStock;
            $sumTrend += $trend;

            $processedData[$d] = [
                'wh' => $wh,
                'prd_qa' => $prdQa,
                'total_stock' => $totalStock,
                'kap' => $kapasitasValue, // statis global
                'trend' => $trend,
            ];
        }

        // Rata-rata (Average) = Jumlah keseluruhan dibagi jumlah hari valid dalam bulan tersebut
        $averages = [
            'wh' => $validDaysCount > 0 ? $sumWh / $validDaysCount : 0,
            'prd_qa' => $validDaysCount > 0 ? $sumPrdQa / $validDaysCount : 0,
            'total_stock' => $validDaysCount > 0 ? $sumTotal / $validDaysCount : 0,
            'kap' => $kapasitasValue,
            'trend' => $validDaysCount > 0 ? $sumTrend / $validDaysCount : 0,
        ];

        $highest = [
            'wh' => $maxWh,
            'prd_qa' => $maxPrdQa,
            'total_stock' => $maxTotal,
            'kap' => $kapasitasValue,
            'trend' => $maxTrend,
        ];

        // 8. Kirim semua variabel ke tampilan view (blade)
        return view('modul_kapasitas.kapasitas.V_crc', compact(
            'processedData', 
            'averages', 
            'highest', 
            'daysInMonth', 
            'month', 
            'year',
            'kapasitasValue'
        ));
    }

    /**
     * Menampilkan halaman perhitungan Kapasitas Barang Jadi
     */
    public function barangJadi(Request $request)
    {
        // 1. Ambil bulan dan tahun dari request
        $filterMonth = $request->input('filter_month');
        if ($filterMonth) {
            $parts = explode('-', $filterMonth);
            $year = $parts[0];
            $month = $parts[1];
        } else {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
        }

        // 2. Tentukan jumlah hari
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        // 3. Ambil nilai Kapasitas Barang Jadi
        $kapasitasSetting = Setting::where('key', 'kapasitas_barang_jadi')->first();
        $kapasitasValue = $kapasitasSetting ? (float)$kapasitasSetting->value : 10000;

        // 4. Ambil data stok harian
        $stocks = DailyStock::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->where('kategori_grup', 'BARANG JADI') // Filter hanya BARANG JADI di level database
            ->get();

        // 5. Inisialisasi array data
        $dataBj = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $dataBj[$d] = [
                'wh' => 0,
                'prd_qa' => 0,
            ];
        }

        // 6. Mengolah data stok (looping)
        foreach ($stocks as $stock) {
            $cat = trim(strtoupper($stock->kategori));
            $day = Carbon::parse($stock->tanggal)->day;

            $isPrdOrQa = ($cat === 'PRD' || $cat === 'QA' || $cat === 'QC' || str_contains($cat, 'PRD') || str_contains($cat, 'QA') || str_contains($cat, 'QC'));

            if ($isPrdOrQa) {
                // PRD & QA/QC
                $dataBj[$day]['prd_qa'] += $stock->quantity;
            } else {
                // Sisanya masuk ke WH
                $dataBj[$day]['wh'] += $stock->quantity;
            }
        }

        // 7. Kalkulasi total (WH + PRD_QA), nilai Trend, serta Rata-rata dan Nilai Tertinggi
        $processedData = [];
        $sumWh = 0;
        $sumPrdQa = 0;
        $sumTotal = 0;
        $sumTrend = 0;

        $maxWh = 0;
        
        $validDaysCount = 0;
        $maxPrdQa = 0;
        $maxTotal = 0;
        $maxTrend = 0;

        for ($d = 1; $d <= $daysInMonth; $d++) {
            if (\Carbon\Carbon::create($year, $month, $d)->isSunday()) continue;
            $validDaysCount++;
            
            // Rumus: dibagi 1000
            $wh = $dataBj[$d]['wh'] / 1000;
            $prdQa = $dataBj[$d]['prd_qa'] / 1000;
            
            $totalStock = $wh + $prdQa;
            
            // Trend = Total Stock dibagi Kapasitas
            $trend = $kapasitasValue > 0 ? ($totalStock / $kapasitasValue) * 100 : 0;

            // Simpan nilai tertinggi (Max)
            if ($wh > $maxWh) $maxWh = $wh;
            if ($prdQa > $maxPrdQa) $maxPrdQa = $prdQa;
            if ($totalStock > $maxTotal) $maxTotal = $totalStock;
            if ($trend > $maxTrend) $maxTrend = $trend;

            // Tambahkan ke Sum untuk rata-rata (Average)
            $sumWh += $wh;
            $sumPrdQa += $prdQa;
            $sumTotal += $totalStock;
            $sumTrend += $trend;

            $processedData[$d] = [
                'wh' => $wh,
                'prd_qa' => $prdQa,
                'total_stock' => $totalStock,
                'kap' => $kapasitasValue,
                'trend' => $trend,
            ];
        }

        // Rata-rata (Average)
        $averages = [
            'wh' => $validDaysCount > 0 ? $sumWh / $validDaysCount : 0,
            'prd_qa' => $validDaysCount > 0 ? $sumPrdQa / $validDaysCount : 0,
            'total_stock' => $validDaysCount > 0 ? $sumTotal / $validDaysCount : 0,
            'kap' => $kapasitasValue,
            'trend' => $validDaysCount > 0 ? $sumTrend / $validDaysCount : 0,
        ];

        $highest = [
            'wh' => $maxWh,
            'prd_qa' => $maxPrdQa,
            'total_stock' => $maxTotal,
            'kap' => $kapasitasValue,
            'trend' => $maxTrend,
        ];

        // 8. Kirim semua variabel ke tampilan view (blade)
        return view('modul_kapasitas.kapasitas.V_barang_jadi', compact(
            'processedData', 
            'averages', 
            'highest', 
            'daysInMonth', 
            'month', 
            'year',
            'kapasitasValue'
        ));
    }
}
