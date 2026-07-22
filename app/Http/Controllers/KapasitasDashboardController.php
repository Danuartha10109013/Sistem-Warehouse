<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KapasitasDashboardController extends Controller
{
    public function index(Request $request)
    {
        $filterMonth = $request->input('filter_month');
        if ($filterMonth) {
            $parts = explode('-', $filterMonth);
            $year = $parts[0] ?? date('Y');
            $month = $parts[1] ?? date('m');
        } else {
            // Find the latest month with data if no filter is applied
            $latestDate = DailyStock::max('tanggal');
            if ($latestDate) {
                $year = date('Y', strtotime($latestDate));
                $month = date('m', strtotime($latestDate));
            } else {
                $year = date('Y');
                $month = date('m');
            }
        }

        // 1. Total Stock for the month
        $totalStockMonth = DailyStock::whereYear('tanggal', $year)
                                     ->whereMonth('tanggal', $month)
                                     ->sum('quantity');

        // 2. Distinct Sources for the month
        $sourcesMonth = DailyStock::whereYear('tanggal', $year)
                                  ->whereMonth('tanggal', $month)
                                  ->distinct('source')->count('source');

        // 3. Top Category for the month
        $topCategory = DailyStock::whereYear('tanggal', $year)
                                 ->whereMonth('tanggal', $month)
            ->select('kategori', DB::raw('SUM(quantity) as total'))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->first();

        // --- TREND CHART DATA (Per Month for the selected Year) ---
        $trendData = DailyStock::whereYear('tanggal', $year)
            ->select(DB::raw('MONTH(tanggal) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->orderBy('month')
            ->get();

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $trendDates = $monthNames;
        $trendTotals = array_fill(0, 12, 0);

        foreach ($trendData as $data) {
            $trendTotals[$data->month - 1] = (float) $data->total;
        }

        // --- DONUT CHART DATA (Category distribution for the month) ---
        $distributionData = DailyStock::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->select('kategori', DB::raw('SUM(quantity) as total'))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->limit(7) // Limit to top 7 categories
            ->get();

        $distCategories = $distributionData->pluck('kategori')->toArray();
        $distTotals = $distributionData->pluck('total')->map(function($val) { return (float)$val; })->toArray();

        return view('modul_kapasitas.user.V_dasboard', compact(
            'totalStockMonth', 
            'sourcesMonth', 
            'topCategory', 
            'trendDates', 
            'trendTotals',
            'distCategories',
            'distTotals',
            'year',
            'month'
        ));
    }
}
