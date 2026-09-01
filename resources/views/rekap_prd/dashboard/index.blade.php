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
    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h5 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Hasil PRD (Terkini)</h5>
            <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                <i class="mdi mdi-arrow-up-bold text-xl"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-4">{{ $latest ? number_format($latest->hasil_prd, 0, ',', '.') : 0 }}</h3>
        <p class="text-xs text-gray-400 mt-2">Update Terakhir: {{ $latest ? \Carbon\Carbon::parse($latest->tanggal)->format('d M Y') : '-' }}</p>
    </div>
    
    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h5 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Pengeluaran</h5>
            <div class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                <i class="mdi mdi-arrow-down-bold text-xl"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-4">{{ $latest ? number_format($latest->total_pengeluaran, 0, ',', '.') : 0 }}</h3>
        <p class="text-xs text-gray-400 mt-2">Update Terakhir</p>
    </div>

    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h5 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Sisa Stock</h5>
            <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                <i class="mdi mdi-package-variant text-xl"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-4">{{ $latest ? number_format($latest->sisa_stock, 0, ',', '.') : 0 }}</h3>
        <p class="text-xs text-gray-400 mt-2">Ketersediaan saat ini</p>
    </div>
</div>

<!-- Chart Keseluruhan -->
<div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white">Grafik Keseluruhan</h4>
        
        <div class="flex items-center gap-2">
            <!-- Dropdown Filter -->
            <form action="{{ route('rekap-prd.dashboard') }}" method="GET" class="flex items-center gap-2">
                <select name="filter" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </form>

            <!-- Export Form -->
            <form id="exportForm" action="{{ route('rekap-prd.export') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="filter" value="{{ $filter }}">
                <input type="hidden" name="chart_image" id="chart_image">
            </form>
            <button type="button" onclick="exportExcel()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export Excel
            </button>
        </div>
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
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Pengeluaran (Akumulasi)',
                    data: pengeluaran,
                    borderColor: 'rgba(239, 68, 68, 1)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Sisa Stock (Akumulasi)',
                    data: sisaStock,
                    borderColor: 'rgba(34, 197, 94, 1)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            devicePixelRatio: 4,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        font: { family: "'Plus Jakarta Sans', sans-serif", weight: '600' }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    titleFont: { family: "'Plus Jakarta Sans', sans-serif" },
                    bodyFont: { family: "'Plus Jakarta Sans', sans-serif" },
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: {
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

function exportExcel() {
    const canvas = document.getElementById('overallChart');
    if (canvas) {
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        const tempCtx = tempCanvas.getContext('2d');
        tempCtx.fillStyle = '#ffffff';
        tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
        tempCtx.drawImage(canvas, 0, 0);
        
        document.getElementById('chart_image').value = tempCanvas.toDataURL('image/png');
    }
    document.getElementById('exportForm').submit();
}
</script>
@endif
@endpush
