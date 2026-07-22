<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStock;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\CategoryFilter;
use App\Imports\StockImport;

class KapasitasStockController extends Controller
{
    public function index(Request $request)
    {
        // Get month and year from request, default to current
        $filterMonth = $request->input('filter_month');
        if ($filterMonth) {
            $parts = explode('-', $filterMonth);
            $year = $parts[0];
            $month = $parts[1];
        } else {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
        }

        // Fetch stocks for the selected month
        $stocks = DailyStock::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get();

        // Pivot data: Group -> Rows = Kategori, Cols = Day of Month
        $pivot = [
            'BAHAN BAKU' => [],
            'BARANG JADI' => [],
            'LIMBAH' => []
        ];
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        foreach ($stocks as $stock) {
            $cat = trim(strtoupper($stock->kategori));
            if (!$cat)
                continue;

            $group = strtoupper($stock->kategori_grup ?: 'BARANG JADI');
            
            // --- LOGIK PEMISAHAN CRC BERDASARKAN SUMBER (SOURCE) ---
            // Karena di database namanya tetap "CRC", kita pisahkan nama tampilannya di tabel
            // agar tidak menyatu (melebur) dengan CRC dari sumber lain.
            if ($cat === 'CRC' && $group === 'BAHAN BAKU') {
                if ($stock->source === 'PRD-L3BB') {
                    $cat = 'PRD (CRC DARI PRD-L3BB)';
                } elseif (in_array($stock->source, ['QA-L3', 'QA-L3 BB', 'QA- L3'])) {
                    $cat = 'QA (CRC DARI QA)';
                }
            }
            // -------------------------------------------------------

            if (!isset($pivot[$group])) {
                $pivot[$group] = [];
            }

            $day = Carbon::parse($stock->tanggal)->day;

            if (!isset($pivot[$group][$cat])) {
                $pivot[$group][$cat] = array_fill(1, $daysInMonth, 0);
            }
            $pivot[$group][$cat][$day] += $stock->quantity;
        }

        // Available sources
        $sources = [
            'L3-BB' => 1,
            'PRD-L3BB' => 1,
            'QA-L3' => 1,
            'L3-BJS' => 1,
            'L3-BJ' => 1,
            'WH-TATASENTOSA' => 1,
            'JASPER' => 2,
            'TATALOGAM' => 3,
        ];

        return view('modul_kapasitas.user.V_input_harian', compact('pivot', 'daysInMonth', 'month', 'year', 'sources'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'source' => 'required|string',
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $tanggal = $request->input('tanggal');
        $source = $request->input('source');
        $file = $request->file('file');

        $sourcesMap = [
            'L3-BB' => 1,
            'PRD-L3BB' => 1,
            'QA-L3' => 1,
            'L3-BJS' => 1,
            'L3-BJ' => 1,
            'WH-TATASENTOSA' => 1,
            'JASPER' => 2,
            'TATALOGAM' => 3,
        ];

        $format = $sourcesMap[$source] ?? 1;

        // Ambil daftar kategori yang diblokir dari fitur 'Kelola Filter Kategori' (Global Filter).
        // Semua nama kategori diubah menjadi huruf kecil (lowercase) agar kebal terhadap perbedaan huruf besar/kecil.
        $ignoredCategories = CategoryFilter::pluck('kategori')->map(function ($cat) {
            return strtolower(trim($cat));
        })->toArray();

        // Hapus data lama di database untuk tanggal dan sumber Excel yang sama agar tidak terjadi data ganda (duplikasi).
        DailyStock::where('tanggal', $tanggal)->where('source', $source)->delete();

        $data = Excel::toArray(new StockImport, $file);
        $sheet = $data[0] ?? []; // First sheet

        $aggregated = [];

        if ($format == 1) {
            // Find header row first. 'Kategori Produk' and 'Quantity'
            $catCol = -1;
            $qtyCol = -1;
            $startRow = 0;

            for ($i = 0; $i < 10; $i++) {
                if (!isset($sheet[$i]))
                    continue;
                foreach ($sheet[$i] as $colIdx => $val) {
                    $v = strtolower(trim((string) $val));
                    if ($v == 'kategori produk')
                        $catCol = $colIdx;
                    if ($v == 'quantity')
                        $qtyCol = $colIdx;
                }
                if ($catCol != -1 && $qtyCol != -1) {
                    $startRow = $i + 1;
                    break;
                }
            }

            if ($catCol != -1 && $qtyCol != -1) {
                for ($i = $startRow; $i < count($sheet); $i++) {
                    $row = $sheet[$i];
                    $cat = trim((string) ($row[$catCol] ?? ''));
                    // Quantity might have commas for thousand separators
                    $qtyStr = str_replace(',', '', (string) ($row[$qtyCol] ?? '0'));
                    $qty = (float) $qtyStr;

                    if ($cat && !empty($cat)) {
                        $catLower = strtolower($cat);
                        if (!in_array($catLower, $ignoredCategories)) {
                            $mapped = $this->mapCategoryAndGroup($source, $cat);
                            if ($mapped) {
                                $key = $mapped['kategori'] . '|' . $mapped['grup'];
                                if (!isset($aggregated[$key])) {
                                    $aggregated[$key] = [
                                        'kategori' => $mapped['kategori'],
                                        'grup' => $mapped['grup'],
                                        'qty' => 0
                                    ];
                                }
                                $aggregated[$key]['qty'] += $qty;
                            }
                        }
                    }
                }
            }
        } elseif ($format == 2) {
            // 'Kategori' and 'Stok Akhir'
            $catCol = -1;
            $qtyCol = -1;
            $startRow = 0;

            for ($i = 0; $i < 10; $i++) {
                if (!isset($sheet[$i]))
                    continue;
                foreach ($sheet[$i] as $colIdx => $val) {
                    $v = strtolower(trim((string) $val));
                    if ($v == 'kategori')
                        $catCol = $colIdx;
                    if (str_contains($v, 'stok akhir'))
                        $qtyCol = $colIdx;
                }
                if ($catCol != -1 && $qtyCol != -1) {
                    $startRow = $i + 1;
                    break;
                }
            }

            if ($catCol != -1 && $qtyCol != -1) {
                for ($i = $startRow; $i < count($sheet); $i++) {
                    $row = $sheet[$i];
                    $cat = trim((string) ($row[$catCol] ?? ''));
                    $qtyStr = str_replace(',', '', (string) ($row[$qtyCol] ?? '0'));
                    $qty = (float) $qtyStr;

                    if ($cat && !empty($cat) && strtolower($cat) !== 'total') {
                        $catLower = strtolower($cat);
                        if (!in_array($catLower, $ignoredCategories)) {
                            $mapped = $this->mapCategoryAndGroup($source, $cat);
                            if ($mapped) {
                                $key = $mapped['kategori'] . '|' . $mapped['grup'];
                                if (!isset($aggregated[$key])) {
                                    $aggregated[$key] = [
                                        'kategori' => $mapped['kategori'],
                                        'grup' => $mapped['grup'],
                                        'qty' => 0
                                    ];
                                }
                                $aggregated[$key]['qty'] += $qty;
                            }
                        }
                    }
                }
            }
        } elseif ($format == 3) {
            // 'Kategori Produk' and 'Qty'
            $catCol = -1;
            $qtyCol = -1;
            $startRow = 0;

            for ($i = 0; $i < 10; $i++) {
                if (!isset($sheet[$i]))
                    continue;
                foreach ($sheet[$i] as $colIdx => $val) {
                    $v = strtolower(trim((string) $val));
                    if ($v == 'kategori produk')
                        $catCol = $colIdx;
                    if ($v == 'qty')
                        $qtyCol = $colIdx;
                }
                if ($catCol != -1 && $qtyCol != -1) {
                    $startRow = $i + 1;
                    break;
                }
            }

            if ($catCol != -1 && $qtyCol != -1) {
                for ($i = $startRow; $i < count($sheet); $i++) {
                    $row = $sheet[$i];
                    $cat = trim((string) ($row[$catCol] ?? ''));
                    $qtyStr = str_replace(',', '', (string) ($row[$qtyCol] ?? '0'));
                    $qty = (float) $qtyStr;

                    if ($cat && !empty($cat) && strtolower($cat) !== 'total') {
                        $catLower = strtolower($cat);
                        if (!in_array($catLower, $ignoredCategories)) {
                            $mapped = $this->mapCategoryAndGroup($source, $cat);
                            if ($mapped) {
                                $key = $mapped['kategori'] . '|' . $mapped['grup'];
                                if (!isset($aggregated[$key])) {
                                    $aggregated[$key] = [
                                        'kategori' => $mapped['kategori'],
                                        'grup' => $mapped['grup'],
                                        'qty' => 0
                                    ];
                                }
                                $aggregated[$key]['qty'] += $qty;
                            }
                        }
                    }
                }
            }
        }

        // Insert to DB
        $insertData = [];
        foreach ($aggregated as $key => $dataItem) {
            $insertData[] = [
                'tanggal' => $tanggal,
                'source' => $source,
                'kategori' => $dataItem['kategori'],
                'kategori_grup' => $dataItem['grup'],
                'quantity' => $dataItem['qty'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (count($insertData) > 0) {
            DailyStock::insert($insertData);
        }

        return redirect()->route('modul-kapasitas.input-harian')->with('success', 'Data stok dari ' . $source . ' berhasil diimpor!');
    }

    public function checkImportedSources(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $sources = DailyStock::where('tanggal', $tanggal)
            ->select('source')
            ->distinct()
            ->pluck('source');

        return response()->json($sources);
    }

    public function destroySource(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $source = $request->input('source');

        DailyStock::where('tanggal', $tanggal)
            ->where('source', $source)
            ->delete();

        return redirect()->back()->with('success', "Data stok dari sumber {$source} pada tanggal {$tanggal} berhasil dihapus.");
    }

    /**
     * Fungsi ini bertugas untuk menentukan nama Kategori akhir dan Grup-nya
     * (Bahan Baku, Barang Jadi, atau Limbah) berdasarkan Aturan Khusus (Business Logic).
     */
    private function mapCategoryAndGroup($source, $cat)
    {
        $catLower = strtolower(trim($cat));
        $mappedCat = trim($cat);
        $group = 'BARANG JADI'; // Secara default, kita asumsikan masuk ke Barang Jadi

        // === ATURAN 1: KHUSUS UNTUK SUMBER "PRD-L3BB" ===
        if ($source === 'PRD-L3BB') {
            if ($catLower === 'crc') {
                // Jika kategori adalah CRC, dia masuk ke grup BAHAN BAKU.
                // NAMANYA BUKAN "CRC", MELAINKAN "PRD" AGAR TERPISAH DARI CRC UMUM!
                $mappedCat = 'PRD';
                $group = 'BAHAN BAKU';
            } elseif (in_array($catLower, ['aluminium alloy', 'resin', 'shg zinc 99.995%'])) {
                // Jika kategori adalah bahan-bahan ini, KITA ABAIKAN (TIDAK DIHITUNG SAMA SEKALI).
                // Mengembalikan nilai null akan membuat sistem melewati (skip) baris ini.
                return null;
            } else {
                // Jika selain CRC dan bahan-bahan di atas, semuanya DIGABUNGKAN menjadi "PRD" 
                // dan masuk ke grup BARANG JADI.
                $mappedCat = 'PRD';
                $group = 'BARANG JADI';
            }

            // === ATURAN 2: KHUSUS UNTUK SUMBER "QA-L3" ===
        } elseif ($source === 'QA-L3' || $source === 'QA-L3 BB' || $source === 'QA- L3') {
            if ($catLower === 'crc') {
                // Sama seperti PRD, CRC dari QA juga masuk ke grup BAHAN BAKU.
                // NAMANYA "QA" AGAR TERPISAH DARI CRC UMUM!
                $mappedCat = 'QA';
                $group = 'BAHAN BAKU';
            } else {
                // Sisanya DIGABUNGKAN menjadi "QA" dan masuk ke grup BARANG JADI.
                $mappedCat = 'QA';
                $group = 'BARANG JADI';
            }

            // === ATURAN 3: UNTUK SUMBER EXCEL LAINNYA ===
        } else {
            if ($source === 'LO3-BB' || $source === 'L3-BB') {
                // Sumber LO3-BB adalah khusus bahan mentah, jadi semuanya masuk ke BAHAN BAKU.
                $group = 'BAHAN BAKU';
            } elseif (in_array($catLower, ['dross', 'limbah/dross', 'limbah / dross', 'pup coil'])) {
                // Kata-kata kunci tertentu langsung dikategorikan sebagai LIMBAH.
                $group = 'LIMBAH';
            } else {
                // Selain itu, semuanya masuk ke BARANG JADI (Contoh: TATALOGAM, JASPER, dll).
                $group = 'BARANG JADI';
            }
        }

        // Kembalikan nama kategori (dalam huruf besar) beserta nama grupnya ke sistem utama.
        return [
            'kategori' => strtoupper($mappedCat),
            'grup' => $group
        ];
    }
}
