<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\KodeBahanBaku;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $key = 'Stock';
        $kategori = KodeBahanBaku::all();
        $data = Stock::all();
        return view('stock.index', compact('key', 'data', 'kategori'));
    }

    public function crcIndex($type)
    {
        $key = 'Stock';
        $kategori = KodeBahanBaku::all();
        
        $query = Stock::where('kategori_produk', 'CRC');
        
        if ($type === 'ks') {
            $query->where(function($q) {
                $q->where('attribute_set_value', 'like', 'CR\_A\_%')
                  ->orWhere('attribute_set_value', 'like', 'CR\_AG\_%');
            });
        } elseif ($type === 'hanwa') {
            $query->where('attribute_set_value', 'like', 'CR\_BE\_%');
        } elseif ($type === 'grp') {
            $query->where('attribute_set_value', 'like', 'CR\_B\_%');
        } elseif ($type === 'grp_tl') {
            $query->where('attribute_set_value', 'like', 'CR\_BTL\_%');
        } elseif ($type === 'essar_ina') {
            $query->where('attribute_set_value', 'like', 'CR\_G\_%');
        } elseif ($type === 'posco_vnm') {
            $query->where('attribute_set_value', 'like', 'CR\_AY\_%');
        } elseif ($type === 'posco_kor') {
            $query->where('attribute_set_value', 'like', 'CR\_AH\_%');
        } elseif ($type === 'nai_ina') {
            $query->where('attribute_set_value', 'like', 'CR\_AZ\_%');
        } else {
            abort(404);
        }

        $rawData = $query->get();
        
        $data_stock = collect();
        $data_masuk = collect();
        $data_keluar = collect();
        $rekap_ukuran = [];
        $rekap_bulan = [];
        $months = [];

        foreach ($rawData as $d) {
            // Extract Ukuran
            $ukuran = '-';
            if (preg_match('/(\d+(?:\.\d+)?\s*[xX]\s*\d+(?:\.\d+)?)/', $d->nama_produk, $matches)) {
                $ukuran = strtolower(str_replace('X', 'x', $matches[1]));
            }
            $d->ukuran = $ukuran;
            
            // Dates and Months
            $d->tgl_masuk = $d->created_at ? $d->created_at->format('d-M-y') : '-';
            $d->bulan_masuk = $d->created_at ? strtoupper($d->created_at->format('M')) : '-';
            
            if ($d->bulan_masuk !== '-' && !in_array($d->bulan_masuk, $months)) {
                $months[] = $d->bulan_masuk;
            }

            if ($d->bulan_masuk !== '-' && !isset($rekap_bulan[$d->bulan_masuk])) {
                $rekap_bulan[$d->bulan_masuk] = ['bulan' => $d->bulan_masuk, 'masuk' => 0, 'keluar' => 0, 'saldo' => 0];
            }

            if ($d->date_keluar) {
                $dtKeluar = \Carbon\Carbon::parse($d->date_keluar);
                $d->tgl_keluar = $dtKeluar->format('d-M-y');
                $d->bulan_keluar = strtoupper($dtKeluar->format('M'));
                $data_keluar->push($d);
                
                if (!in_array($d->bulan_keluar, $months)) {
                    $months[] = $d->bulan_keluar;
                }

                if (!isset($rekap_bulan[$d->bulan_keluar])) {
                    $rekap_bulan[$d->bulan_keluar] = ['bulan' => $d->bulan_keluar, 'masuk' => 0, 'keluar' => 0, 'saldo' => 0];
                }
            } else {
                $data_stock->push($d);
            }
            
            $data_masuk->push($d);

            // Rekap Per Ukuran
            if (!isset($rekap_ukuran[$ukuran])) {
                $rekap_ukuran[$ukuran] = ['ukuran' => $ukuran, 'masuk' => 0, 'keluar' => 0, 'saldo' => 0];
            }
            $qty = (float) $d->quantity;
            $rekap_ukuran[$ukuran]['masuk'] += $qty;
            if ($d->date_keluar) {
                $rekap_ukuran[$ukuran]['keluar'] += $qty;
            }
            $rekap_ukuran[$ukuran]['saldo'] = $rekap_ukuran[$ukuran]['masuk'] - $rekap_ukuran[$ukuran]['keluar'];

            // Rekap Per Bulan
            if ($d->bulan_masuk !== '-') {
                $rekap_bulan[$d->bulan_masuk]['masuk'] += $qty;
            }
            if ($d->date_keluar) {
                $rekap_bulan[$d->bulan_keluar]['keluar'] += $qty;
            }
        }

        $rekap_ukuran = collect($rekap_ukuran)->sortBy('ukuran')->values();
        
        // Month sorting logically (Jan to Dec)
        $monthOrder = ['JAN'=>1, 'FEB'=>2, 'MAR'=>3, 'APR'=>4, 'MAY'=>5, 'JUN'=>6, 'JUL'=>7, 'AUG'=>8, 'SEP'=>9, 'OCT'=>10, 'NOV'=>11, 'DEC'=>12];
        usort($months, function($a, $b) use ($monthOrder) {
            $orderA = $monthOrder[$a] ?? 99;
            $orderB = $monthOrder[$b] ?? 99;
            return $orderA <=> $orderB;
        });

        // Hitung Saldo Kumulatif untuk Rekap Bulan
        $sorted_rekap_bulan = [];
        $saldo_sebelumnya = 0;
        
        $bulan_keys = array_keys($rekap_bulan);
        usort($bulan_keys, function($a, $b) use ($monthOrder) {
            return ($monthOrder[$a] ?? 99) <=> ($monthOrder[$b] ?? 99);
        });

        $total_masuk_bulan = 0;
        $total_keluar_bulan = 0;

        foreach ($bulan_keys as $bulan) {
            $data_bulan = $rekap_bulan[$bulan];
            $saldo_sebelumnya = $saldo_sebelumnya + $data_bulan['masuk'] - $data_bulan['keluar'];
            $data_bulan['saldo'] = $saldo_sebelumnya;
            $total_masuk_bulan += $data_bulan['masuk'];
            $total_keluar_bulan += $data_bulan['keluar'];
            $sorted_rekap_bulan[] = $data_bulan;
        }
        $rekap_bulan = collect($sorted_rekap_bulan);

        $batches = Stock::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i") as batch_time, COUNT(*) as total')
            ->where('kategori_produk', 'CRC')
            ->groupBy('batch_time')
            ->orderBy('batch_time', 'desc')
            ->get();

        return view('stock.crc.index', compact('key', 'data_stock', 'data_masuk', 'data_keluar', 'rekap_ukuran', 'rekap_bulan', 'total_masuk_bulan', 'total_keluar_bulan', 'months', 'kategori', 'type', 'batches'));
    }

    public function rekapCrcMasuk(Request $request)
    {
        $key = 'Stock';
        $kategori = KodeBahanBaku::all();

        $start_date = $request->input('start_date', date('Y-01'));
        $end_date = $request->input('end_date', date('Y-12'));
        
        $start = \Carbon\Carbon::createFromFormat('Y-m', $start_date)->startOfMonth();
        $end = \Carbon\Carbon::createFromFormat('Y-m', $end_date)->endOfMonth();
        
        $months_labels = [];
        $months_perbulan = [];
        $current = $start->copy();
        $monthIndo = ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGU','SEPT','OKT','NOV','DES'];
        
        while($current->lessThanOrEqualTo($end)) {
            $k = $current->format('Y-m');
            $months_perbulan[] = $k;
            $months_labels[$k] = $monthIndo[$current->month - 1] . " '" . $current->format('y');
            $current->addMonth();
        }

        // Rekap CRC Masuk (All Suppliers)
        $allCrcRaw = Stock::where('kategori_produk', 'CRC')->get();
        $rekap_crc_masuk = [];
        $supplier_columns = [
            'KS', 'GRP', 'ESSAR', 'POSCO VIETNAM', 'HYUNDAI - KOREA', 
            'SYNN INDUSTRIAL - TAIWAN', 'HANWA', 'TON YI - TAIWAN', 
            'STINKO - POSCO KOREA', 'MARUBENI - VIETNAM', 
            'NEW ASIA INTERNATIONAL - INDONESIA', 'SINO GLORY - CHINA'
        ];

        foreach ($allCrcRaw as $d) {
            $ukuran = '-';
            $grade = 'FH (G550)';
            if (preg_match('/(\d+(?:\.\d+)?\s*[xX]\s*\d+(?:\.\d+)?)/', $d->nama_produk, $matches)) {
                $ukuran = strtolower(str_replace('X', 'x', $matches[1]));
                $split = explode($matches[1], $d->nama_produk);
                if (isset($split[1]) && trim($split[1]) !== '') {
                    $grade = trim($split[1]);
                }
            }
            
            $attr = $d->attribute_set_value ?? '';
            $sup = 'LAINNYA';
            if (str_starts_with($attr, 'CR_A_') || str_starts_with($attr, 'CR_AG_')) $sup = 'KS';
            elseif (str_starts_with($attr, 'CR_BE_')) $sup = 'HANWA';
            elseif (str_starts_with($attr, 'CR_B_') || str_starts_with($attr, 'CR_BTL_')) $sup = 'GRP';
            elseif (str_starts_with($attr, 'CR_G_')) $sup = 'ESSAR';
            elseif (str_starts_with($attr, 'CR_AY_')) $sup = 'POSCO VIETNAM';
            elseif (str_starts_with($attr, 'CR_AH_')) $sup = 'STINKO - POSCO KOREA';
            elseif (str_starts_with($attr, 'CR_AZ_')) $sup = 'NEW ASIA INTERNATIONAL - INDONESIA';
            
            if (!isset($rekap_crc_masuk[$ukuran])) {
                $rekap_crc_masuk[$ukuran] = ['ukuran' => $ukuran, 'grade' => $grade];
                foreach ($supplier_columns as $col) {
                    $rekap_crc_masuk[$ukuran][$col] = 0;
                }
                $rekap_crc_masuk[$ukuran]['LAINNYA'] = 0;
                $rekap_crc_masuk[$ukuran]['TOTAL KG'] = 0;
            }
            
            $qty = (float) $d->quantity;
            if (in_array($sup, $supplier_columns) || $sup === 'LAINNYA') {
                $rekap_crc_masuk[$ukuran][$sup] += $qty;
                $rekap_crc_masuk[$ukuran]['TOTAL KG'] += $qty;
            }
        }
        $rekap_crc_masuk = collect($rekap_crc_masuk)->sortBy('ukuran')->values();
        
        $total_rekap_crc = [];
        foreach ($supplier_columns as $col) {
            $total_rekap_crc[$col] = $rekap_crc_masuk->sum($col);
        }
        $total_rekap_crc['LAINNYA'] = $rekap_crc_masuk->sum('LAINNYA');
        $total_rekap_crc['TOTAL KG'] = $rekap_crc_masuk->sum('TOTAL KG');

        // REKAP MASUK PERBULAN
        $rekap_masuk_perbulan = [];
        $supplier_list_perbulan = [
            'KRAKATAU STEEL', 'GRP', 'STEEL FORCE', 'ESSAR', 'POSCO VIETNAM',
            'CSC STEEL - MALAYSIA', 'BAOSTEEL', 'HYUNDAI - KOREA', 'HANWA',
            'SYNN INDUSTRIAL', 'TON YI - TAIWAN', 'LANGFANG - CHINA', 'LIANXIN - CHINA',
            'SARANA', 'HOA PHAT - VIETNAM', 'STINKO - POSCO KOREA', 'MARUBENI - VIETNAM',
            'SINO GLORY - CHINA', 'NAT - INDONESIA'
        ];
        
        foreach ($supplier_list_perbulan as $sup) {
            $rekap_masuk_perbulan[$sup] = array_fill_keys($months_perbulan, 0);
            $rekap_masuk_perbulan[$sup]['TOTAL'] = 0;
            $rekap_masuk_perbulan[$sup]['PERCENTAGE'] = 0;
        }

        $total_all_masuk = 0;
        $total_per_bulan = array_fill_keys($months_perbulan, 0);
        $total_per_bulan['TOTAL'] = 0;
        $total_per_bulan['PERCENTAGE'] = 0;

        foreach ($allCrcRaw as $d) {
            $attr = $d->attribute_set_value ?? '';
            $sup = null;
            if (str_starts_with($attr, 'CR_A_') || str_starts_with($attr, 'CR_AG_')) $sup = 'KRAKATAU STEEL';
            elseif (str_starts_with($attr, 'CR_B_') || str_starts_with($attr, 'CR_BTL_')) $sup = 'GRP';
            elseif (str_starts_with($attr, 'CR_G_')) $sup = 'ESSAR';
            elseif (str_starts_with($attr, 'CR_AY_')) $sup = 'POSCO VIETNAM';
            elseif (str_starts_with($attr, 'CR_BE_')) $sup = 'HANWA';
            elseif (str_starts_with($attr, 'CR_AH_')) $sup = 'STINKO - POSCO KOREA';
            elseif (str_starts_with($attr, 'CR_AZ_')) $sup = 'NAT - INDONESIA';

            if ($sup && isset($rekap_masuk_perbulan[$sup])) {
                $created_date = $d->created_at;
                
                if ($created_date && $created_date->between($start, $end)) {
                    $qty = (float) $d->quantity;
                    $map_month = $created_date->format('Y-m');

                    if (isset($rekap_masuk_perbulan[$sup][$map_month])) {
                        $rekap_masuk_perbulan[$sup][$map_month] += $qty;
                        $rekap_masuk_perbulan[$sup]['TOTAL'] += $qty;
                        $total_all_masuk += $qty;
                        
                        $total_per_bulan[$map_month] += $qty;
                        $total_per_bulan['TOTAL'] += $qty;
                    }
                }
            }
        }

        foreach ($supplier_list_perbulan as $sup) {
            if ($total_all_masuk > 0) {
                $rekap_masuk_perbulan[$sup]['PERCENTAGE'] = round(($rekap_masuk_perbulan[$sup]['TOTAL'] / $total_all_masuk) * 100);
            }
        }
        if ($total_all_masuk > 0) $total_per_bulan['PERCENTAGE'] = 100;

        // REKAP KELUAR PERBULAN
        $rekap_keluar_perbulan = [];
        $supplier_list_keluar = [
            'KRAKATAU STEEL', 'GRP', 'STEEL FORCE', 'ESSAR', 'POSCO VIETNAM',
            'CSC STEEL - MALAYSIA', 'BAOTAO - MONGOLIA', 'HYUNDAI - KOREA', 'HANWA',
            'SYNN INDUSTRIAL', 'TON YI - TAIWAN', 'LANGFANG - CHINA', 'LIANXIN - CHINA',
            'SARANA', 'HOA PHAT - VIETNAM', 'STINKO - POSCO KOREA', 'MARUBENI - VIETNAM',
            'SINO GLORY - CHINA', 'NEW ASIA INTERNATIONAL - INDONESIA'
        ];
        
        $months_keluar = $months_perbulan;
        
        foreach ($supplier_list_keluar as $sup) {
            $rekap_keluar_perbulan[$sup] = array_fill_keys($months_keluar, 0);
            $rekap_keluar_perbulan[$sup]['TOTAL'] = 0;
        }

        $total_keluar_per_bulan = array_fill_keys($months_keluar, 0);
        $total_keluar_per_bulan['TOTAL'] = 0;

        foreach ($allCrcRaw as $d) {
            if (!$d->date_keluar) continue; // Only process data that has date_keluar

            $attr = $d->attribute_set_value ?? '';
            $sup = null;
            if (str_starts_with($attr, 'CR_A_') || str_starts_with($attr, 'CR_AG_')) $sup = 'KRAKATAU STEEL';
            elseif (str_starts_with($attr, 'CR_B_') || str_starts_with($attr, 'CR_BTL_')) $sup = 'GRP';
            elseif (str_starts_with($attr, 'CR_G_')) $sup = 'ESSAR';
            elseif (str_starts_with($attr, 'CR_AY_')) $sup = 'POSCO VIETNAM';
            elseif (str_starts_with($attr, 'CR_BE_')) $sup = 'HANWA';
            elseif (str_starts_with($attr, 'CR_AH_')) $sup = 'STINKO - POSCO KOREA';
            elseif (str_starts_with($attr, 'CR_AZ_')) $sup = 'NEW ASIA INTERNATIONAL - INDONESIA';

            if ($sup && isset($rekap_keluar_perbulan[$sup])) {
                $date_keluar = \Carbon\Carbon::parse($d->date_keluar);
                
                if ($date_keluar && $date_keluar->between($start, $end)) {
                    $qty = (float) $d->quantity;
                    $map_month = $date_keluar->format('Y-m');

                    if (isset($rekap_keluar_perbulan[$sup][$map_month])) {
                        $rekap_keluar_perbulan[$sup][$map_month] += $qty;
                        $rekap_keluar_perbulan[$sup]['TOTAL'] += $qty;
                        
                        $total_keluar_per_bulan[$map_month] += $qty;
                        $total_keluar_per_bulan['TOTAL'] += $qty;
                    }
                }
            }
        }

        // CHART DATA CALCULATION
        $chart_masuk = [];
        $chart_keluar = [];
        
        $lokal_suppliers = ['KS', 'GRP', 'ESSAR', 'HANWA', 'KRAKATAU STEEL'];
        
        $suppliers_chart = [
            'KS' => ['KRAKATAU STEEL'], 'GRP' => ['GRP'], 'ESSAR' => ['ESSAR'], 'HANWA' => ['HANWA'],
            'SHANDONG' => [], 'POSCO' => ['POSCO VIETNAM'], 'CSC STEEL' => ['CSC STEEL - MALAYSIA'],
            'BAOTAO' => ['BAOTAO - MONGOLIA'], 'HYUNDAI' => ['HYUNDAI - KOREA'], 'SYNN' => ['SYNN INDUSTRIAL'],
            'TONYI - TAIWAN' => ['TON YI - TAIWAN'], 'LANGFANG - CHINA' => ['LANGFANG - CHINA'],
            'LIANXIN - CHINA' => ['LIANXIN - CHINA']
        ];

        $total_masuk_lokal = 0;
        $total_masuk_import = 0;
        
        foreach ($suppliers_chart as $sup_label => $aliases) {
            $lokal_val = 0;
            $import_val = 0;
            $is_lokal = in_array($sup_label, $lokal_suppliers);
            
            foreach ($aliases as $alias) {
                if (isset($rekap_masuk_perbulan[$alias])) {
                    if ($is_lokal) $lokal_val += $rekap_masuk_perbulan[$alias]['TOTAL'];
                    else $import_val += $rekap_masuk_perbulan[$alias]['TOTAL'];
                }
            }
            
            $chart_masuk[$sup_label] = [
                'lokal' => $lokal_val,
                'import' => $import_val,
                'pct' => 0
            ];
            $total_masuk_lokal += $lokal_val;
            $total_masuk_import += $import_val;
        }
        $total_masuk_all = $total_masuk_lokal + $total_masuk_import;
        foreach ($chart_masuk as $sup_label => $vals) {
            $sup_total = $vals['lokal'] + $vals['import'];
            $chart_masuk[$sup_label]['pct'] = $total_masuk_all > 0 ? ($sup_total / $total_masuk_all) * 100 : 0;
        }
        $pct_masuk_lokal = $total_masuk_all > 0 ? ($total_masuk_lokal / $total_masuk_all) * 100 : 0;
        $pct_masuk_import = $total_masuk_all > 0 ? ($total_masuk_import / $total_masuk_all) * 100 : 0;

        $total_keluar_lokal = 0;
        $total_keluar_import = 0;
        
        foreach ($suppliers_chart as $sup_label => $aliases) {
            $lokal_val = 0;
            $import_val = 0;
            $is_lokal = in_array($sup_label, $lokal_suppliers);
            
            foreach ($aliases as $alias) {
                if (isset($rekap_keluar_perbulan[$alias])) {
                    if ($is_lokal) $lokal_val += $rekap_keluar_perbulan[$alias]['TOTAL'];
                    else $import_val += $rekap_keluar_perbulan[$alias]['TOTAL'];
                }
            }
            
            $chart_keluar[$sup_label] = [
                'lokal' => $lokal_val,
                'import' => $import_val,
                'pct' => 0
            ];
            $total_keluar_lokal += $lokal_val;
            $total_keluar_import += $import_val;
        }
        $total_keluar_all = $total_keluar_lokal + $total_keluar_import;
        foreach ($chart_keluar as $sup_label => $vals) {
            $sup_total = $vals['lokal'] + $vals['import'];
            $chart_keluar[$sup_label]['pct'] = $total_keluar_all > 0 ? ($sup_total / $total_keluar_all) * 100 : 0;
        }
        $pct_keluar_lokal = $total_keluar_all > 0 ? ($total_keluar_lokal / $total_keluar_all) * 100 : 0;
        $pct_keluar_import = $total_keluar_all > 0 ? ($total_keluar_import / $total_keluar_all) * 100 : 0;


        return view('stock.crc.rekap_masuk', compact(
            'key', 'kategori', 'rekap_crc_masuk', 'supplier_columns', 'total_rekap_crc',
            'rekap_masuk_perbulan', 'supplier_list_perbulan', 'months_perbulan', 'total_per_bulan',
            'rekap_keluar_perbulan', 'supplier_list_keluar', 'months_keluar', 'total_keluar_per_bulan',
            'start_date', 'end_date', 'months_labels',
            'chart_masuk', 'total_masuk_lokal', 'total_masuk_import', 'total_masuk_all', 'pct_masuk_lokal', 'pct_masuk_import',
            'chart_keluar', 'total_keluar_lokal', 'total_keluar_import', 'total_keluar_all', 'pct_keluar_lokal', 'pct_keluar_import'
        ));
    }

    public function importCrc(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\StockCrcImport, $request->file('file'));

        return back()->with('success', 'Data Stock CRC berhasil diimpor!');
    }

    public function deleteCrcBatch(Request $request)
    {
        $request->validate([
            'batch_time' => 'required'
        ]);

        Stock::where('kategori_produk', 'CRC')
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i") = ?', [$request->batch_time])
            ->delete();

        return back()->with('success', 'Riwayat upload pada ' . $request->batch_time . ' berhasil dihapus!');
    }
}
