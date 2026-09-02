@extends('rekap_prd.layout.V_template')

@section('title', 'Dashboard Rekap PRD & Pengeluaran')

@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Keseluruhan</h2>
        <p class="text-sm text-gray-500 mt-1">Ringkasan data produksi dan pengeluaran secara global</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <h5 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Hasil PRD (Terkini)</h5>
            <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 shadow-inner">
                <i class="mdi mdi-arrow-up-bold text-xl"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-4">{{ $latest ? number_format($latest->hasil_prd, 0, ',', '.') : 0 }}</h3>
        <p class="text-xs text-gray-400 mt-2">Update Terakhir: {{ $latest ? \Carbon\Carbon::parse($latest->tanggal)->format('d M Y') : '-' }}</p>
    </div>
    
    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <h5 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Pengeluaran</h5>
            <div class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-500 shadow-inner">
                <i class="mdi mdi-arrow-down-bold text-xl"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-4">{{ $latest ? number_format($latest->total_pengeluaran, 0, ',', '.') : 0 }}</h3>
        <p class="text-xs text-gray-400 mt-2">Update Terakhir</p>
    </div>

    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <h5 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Sisa Stock</h5>
            <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-500 shadow-inner">
                <i class="mdi mdi-package-variant text-xl"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-4">{{ $latest ? number_format($latest->sisa_stock, 0, ',', '.') : 0 }}</h3>
        <p class="text-xs text-gray-400 mt-2">Ketersediaan saat ini</p>
    </div>
</div>

<!-- Chart Keseluruhan -->
<div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8 hover:shadow-md transition-shadow duration-300">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white">Grafik Keseluruhan</h4>
        
        <!-- Modern Segmented Control Filter -->
        <form action="{{ route('rekap-prd.dashboard') }}" method="GET">
            <div class="inline-flex bg-gray-100 dark:bg-gray-800 rounded-lg p-1">
                <button type="submit" name="filter" value="harian" class="px-4 py-1.5 text-xs font-medium rounded-md transition-all {{ $filter == 'harian' ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white' }}">Harian</button>
                <button type="submit" name="filter" value="bulanan" class="px-4 py-1.5 text-xs font-medium rounded-md transition-all {{ $filter == 'bulanan' ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white' }}">Bulanan</button>
                <button type="submit" name="filter" value="tahunan" class="px-4 py-1.5 text-xs font-medium rounded-md transition-all {{ $filter == 'tahunan' ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white' }}">Tahunan</button>
            </div>
        </form>
    </div>
    
    <div class="relative h-[400px] w-full">
        @if($data->count() > 0)
            <canvas id="overallChart"></canvas>
        @else
            <div class="h-full w-full flex items-center justify-center text-gray-400">
                Belum ada data untuk ditampilkan.
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
@if($data->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rawData = @json($data);
    const filter = "{{ $filter }}";
    
    let chartData = [...rawData];
    if(filter === 'harian') {
        chartData.sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal)).slice(-30); // 30 hari terakhir
    } else {
        chartData.sort((a, b) => {
            if(a.periode > b.periode) return 1;
            if(a.periode < b.periode) return -1;
            return 0;
        });
    }

    const labels = chartData.map(item => {
        if(filter === 'harian') {
            const d = new Date(item.tanggal);
            return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
        } else if (filter === 'bulanan') {
            const d = new Date(item.periode + '-01'); // trick untuk parse "YYYY-MM"
            return d.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
        } else {
            return item.periode; // tahun
        }
    });
    
    const pengeluaran = chartData.map(item => item.total_pengeluaran);
    const sisaStock = chartData.map(item => item.sisa_stock);

    const ctx = document.getElementById('overallChart').getContext('2d');
    
    const gradientStock = ctx.createLinearGradient(0, 0, 0, 400);
    gradientStock.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); // Emerald Green transparent
    gradientStock.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

    new Chart(ctx, {
        data: {
            labels: labels,
            datasets: [
                {
                    type: 'bar',
                    label: 'Total Pengeluaran',
                    data: pengeluaran,
                    backgroundColor: '#E5E7EB',
                    hoverBackgroundColor: '#111827',
                    borderRadius: 4,
                    barThickness: 8,
                    order: 2
                },
                {
                    type: 'line',
                    label: 'Sisa Stock',
                    data: sisaStock,
                    borderColor: '#10B981',
                    backgroundColor: gradientStock,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#10B981',
                    pointBorderWidth: 2,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4,
                    order: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        font: {
                            family: "'Inter', sans-serif",
                            size: 12,
                            weight: '500'
                        },
                        color: '#6B7280'
                    }
                },
                tooltip: {
                    backgroundColor: '#111827',
                    padding: 12,
                    titleFont: { family: "'Inter', sans-serif", size: 13, weight: '600' },
                    bodyFont: { family: "'Inter', sans-serif", size: 12 },
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: { family: "'Inter', sans-serif", size: 11 },
                        color: '#9CA3AF'
                    }
                },
                y: {
                    beginAtZero: true,
                    border: { display: false },
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false,
                        tickLength: 0,
                    },
                    ticks: {
                        padding: 10,
                        font: { family: "'Inter', sans-serif", size: 11 },
                        color: '#9CA3AF',
                        callback: function(value) {
                            if (value >= 1000000) return (value / 1000000) + 'M';
                            else if (value >= 1000) return (value / 1000) + 'k';
                            return value;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endif
@endpush
