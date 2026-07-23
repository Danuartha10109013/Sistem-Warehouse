@extends('modul_kapasitas.layout.V_template')

@section('title', 'Dashboard')

@push('styles')
<style>
    .kapasitas-page {
        min-width: 0;
        max-width: 100%;
    }
    .summary-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    @media (hover: hover) and (pointer: fine) {
        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        .category-list-item:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }
    }
    .chart-panel {
        min-height: 240px;
    }
    @media (min-width: 640px) {
        .chart-panel {
            min-height: 320px;
        }
    }
</style>
@endpush

@section('content')
<div class="kapasitas-page mb-6 flex flex-col gap-4 lg:flex-row lg:justify-between lg:items-center">
    <div class="min-w-0">
        <h4 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Dashboard Analitik Stok</h4>
        <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400 mt-1">
            Ringkasan performa untuk bulan:
            <span class="font-semibold text-primary">
                {{ \Carbon\Carbon::createFromFormat('Y-m', "$year-$month")->translatedFormat('F Y') }}
            </span>
        </p>
    </div>

    <div class="flex flex-col sm:flex-row items-stretch gap-3 w-full lg:w-auto lg:max-w-md shrink-0">
        <!-- Filter Bulan/Tahun -->
        <form method="GET" action="{{ route('modul-kapasitas.dashboard') }}" class="w-full min-w-0 flex-1">
            @php
                $currentFilterValue = sprintf('%04d-%02d', $year, $month);
            @endphp
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="month" name="filter_month" value="{{ $currentFilterValue }}" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-2.5 dark:bg-darkgray dark:border-gray-700 dark:placeholder-gray-400 dark:text-white shadow-sm transition-colors cursor-pointer" onchange="this.form.submit()">
            </div>
        </form>

        <a href="{{ route('modul-kapasitas.input-harian') }}" class="btn bg-primary text-white hover:bg-blue-700 py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 shadow-sm text-sm font-medium whitespace-nowrap w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            <span>Lihat Input Harian</span>
        </a>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6 mb-6">
    <!-- Card 1 -->
    <div class="bg-white dark:bg-darkgray rounded-xl p-4 sm:p-6 border-t-4 border-t-primary shadow-sm summary-card relative overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="flex justify-between items-start gap-3">
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Stok (Bulan Ini)</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white break-all sm:break-normal">{{ number_format($totalStockMonth, 0, ',', '.') }}</h3>
            </div>
            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-xl text-primary border border-blue-100 dark:border-blue-800/50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-500 dark:text-gray-400">Akumulasi di bulan {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}</span>
        </div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-primary opacity-5 rounded-full blur-xl"></div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white dark:bg-darkgray rounded-xl p-4 sm:p-6 border-t-4 border-t-indigo-500 shadow-sm summary-card relative overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="flex justify-between items-start gap-3">
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Sumber (Source)</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">{{ $sourcesMonth }} <span class="text-base sm:text-lg font-normal text-gray-500">sumber</span></h3>
            </div>
            <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-800/50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            Terdeteksi sepanjang bulan ini
        </div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-indigo-500 opacity-5 rounded-full blur-xl"></div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white dark:bg-darkgray rounded-xl p-4 sm:p-6 border-t-4 border-t-orange-500 shadow-sm summary-card relative overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="flex justify-between items-start gap-3">
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Kategori Terbanyak</p>
                <h3 class="text-lg sm:text-2xl font-bold text-gray-900 dark:text-white line-clamp-2 break-words" title="{{ $topCategory ? $topCategory->kategori : '-' }}">{{ $topCategory ? $topCategory->kategori : '-' }}</h3>
            </div>
            <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded-xl text-orange-600 dark:text-orange-400 border border-orange-100 dark:border-orange-800/50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            Total Stok: <strong class="text-gray-900 dark:text-white">{{ $topCategory ? number_format($topCategory->total, 0, ',', '.') : 0 }}</strong>
        </div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-orange-500 opacity-5 rounded-full blur-xl"></div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
    <!-- Line Chart (Trend Tahunan) -->
    <div class="xl:col-span-2 bg-white dark:bg-darkgray rounded-xl p-4 sm:p-6 border border-gray-100 dark:border-gray-700 shadow-sm min-w-0">
        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center mb-4">
            <h5 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Tren Stok Tahunan ({{ $year }})</h5>
            <div class="self-start sm:self-auto px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-xs font-semibold rounded-full text-primary border border-blue-100 dark:border-blue-800 shrink-0">
                Tahun {{ $year }}
            </div>
        </div>
        <div id="trendChart" class="w-full min-w-0 chart-panel"></div>
    </div>

    <!-- Donut Chart & List (Distribusi Kategori) -->
    <div class="bg-white dark:bg-darkgray rounded-xl p-0 border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col h-full overflow-hidden min-w-0">
        <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700">
            <h5 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Distribusi Kategori (Top 7)</h5>
            <p class="text-xs text-gray-500 mt-1">Bulan {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F Y') }}</p>
        </div>
        
        <div class="p-4 sm:p-6 flex-grow flex flex-col min-w-0">
            @if(count($distCategories) > 0)
                <div id="distributionChart" class="w-full min-h-[200px] sm:min-h-[220px] flex justify-center mb-4 sm:mb-6"></div>

                <div class="space-y-3 flex-grow overflow-y-auto max-h-[200px] sm:max-h-[180px] custom-scrollbar pr-1 sm:pr-2">
                    @php
                        $colors = ['#0d6efd', '#20c997', '#ffc107', '#fd7e14', '#dc3545', '#6f42c1', '#17a2b8'];
                        $totalAll = array_sum($distTotals);
                    @endphp
                    @foreach($distCategories as $index => $kategori)
                        @php
                            $color = $colors[$index % count($colors)];
                            $total = $distTotals[$index];
                            $percentage = $totalAll > 0 ? round(($total / $totalAll) * 100) : 0;
                        @endphp
                        <div class="category-list-item p-2 rounded-lg transition-colors">
                            <div class="flex justify-between items-center gap-2 mb-1">
                                <div class="flex items-center gap-2 min-w-0 flex-1">
                                    <div class="w-3 h-3 rounded-full shrink-0" style="background-color: {{ $color }}"></div>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate" title="{{ $kategori }}">{{ $kategori }}</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900 dark:text-white shrink-0 tabular-nums">{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700 mt-1">
                                <div class="h-1.5 rounded-full" style="width: {{ $percentage }}%; background-color: {{ $color }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full h-full min-h-[300px] flex items-center justify-center flex-col text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 opacity-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <p class="font-medium">Belum ada data stok bulan ini</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const isDarkMode = document.documentElement.classList.contains('dark') || document.body.classList.contains('dark');
    const textColor = isDarkMode ? '#9ca3af' : '#6b7280';
    const gridColor = isDarkMode ? '#374151' : '#f3f4f6';

    function trendChartHeight() {
        return window.innerWidth < 640 ? 260 : 320;
    }
    function donutChartHeight() {
        return window.innerWidth < 640 ? 200 : 240;
    }

    let trendChart = null;
    let donutChart = null;
    
    // ==========================================
    // 1. TREND CHART (Line Area - Per Month)
    // ==========================================
    const trendDates = {!! json_encode($trendDates) !!};
    const trendTotals = {!! json_encode($trendTotals) !!};
    
    const trendOptions = {
        series: [{
            name: 'Total Stok',
            data: trendTotals
        }],
        chart: {
            height: trendChartHeight(),
            type: 'area',
            fontFamily: 'Plus Jakarta Sans, sans-serif',
            toolbar: {
                show: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800
            }
        },
        colors: ['#0d6efd'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [0, 90, 100]
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        xaxis: {
            categories: trendDates,
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                style: {
                    colors: textColor,
                    fontSize: '12px',
                    fontWeight: 500
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: textColor,
                    fontSize: '12px'
                },
                formatter: function (value) {
                    if (value >= 1000000) {
                        return (value / 1000000).toFixed(1) + 'M';
                    } else if (value >= 1000) {
                        return (value / 1000).toFixed(1) + 'k';
                    }
                    return new Intl.NumberFormat('id-ID').format(value);
                }
            }
        },
        grid: {
            borderColor: gridColor,
            strokeDashArray: 4,
            yaxis: { lines: { show: true } },
            xaxis: { lines: { show: false } }
        },
        tooltip: {
            theme: isDarkMode ? 'dark' : 'light',
            y: {
                formatter: function (val) {
                    return new Intl.NumberFormat('id-ID').format(val) + " unit"
                }
            }
        },
        markers: {
            size: 4,
            colors: ['#fff'],
            strokeColors: '#0d6efd',
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        }
    };

    if (document.getElementById("trendChart")) {
        trendChart = new ApexCharts(document.querySelector("#trendChart"), trendOptions);
        trendChart.render();
    }

    // ==========================================
    // 2. DISTRIBUTION CHART (Donut)
    // ==========================================
    const distCategories = {!! json_encode($distCategories ?? []) !!};
    const distTotals = {!! json_encode($distTotals ?? []) !!};
    
    if (distCategories.length > 0 && document.getElementById("distributionChart")) {
        const donutOptions = {
            series: distTotals,
            labels: distCategories,
            chart: {
                type: 'donut',
                height: donutChartHeight(),
                fontFamily: 'Plus Jakarta Sans, sans-serif',
            },
            colors: ['#0d6efd', '#20c997', '#ffc107', '#fd7e14', '#dc3545', '#6f42c1', '#17a2b8'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '13px',
                                color: textColor,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '22px',
                                fontWeight: 800,
                                color: isDarkMode ? '#fff' : '#111827',
                                offsetY: 5,
                                formatter: function (val) {
                                    if (val >= 1000000) {
                                        return (val / 1000000).toFixed(1) + 'M';
                                    } else if (val >= 1000) {
                                        return (val / 1000).toFixed(1) + 'k';
                                    }
                                    return new Intl.NumberFormat('id-ID').format(val);
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'Total Stok',
                                fontSize: '12px',
                                color: textColor,
                                formatter: function (w) {
                                    const total = w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0);
                                    if (total >= 1000000) {
                                        return (total / 1000000).toFixed(1) + 'M';
                                    } else if (total >= 1000) {
                                        return (total / 1000).toFixed(1) + 'k';
                                    }
                                    return new Intl.NumberFormat('id-ID').format(total);
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                colors: isDarkMode ? '#1f2937' : '#ffffff', // Background color for gap matching container
                width: 3
            },
            legend: {
                show: false // Hidden because we use custom list below it
            },
            tooltip: {
                theme: isDarkMode ? 'dark' : 'light',
                y: {
                    formatter: function (val) {
                        return new Intl.NumberFormat('id-ID').format(val) + " unit"
                    }
                }
            }
        };

        donutChart = new ApexCharts(document.querySelector("#distributionChart"), donutOptions);
        donutChart.render();
    }

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            if (trendChart) {
                trendChart.updateOptions({ chart: { height: trendChartHeight() } });
            }
            if (donutChart) {
                donutChart.updateOptions({ chart: { height: donutChartHeight() } });
            }
        }, 150);
    });
});
</script>
@endpush
