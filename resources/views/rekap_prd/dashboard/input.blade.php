@extends('rekap_prd.layout.V_template')

@section('title', 'Input & Analisa Rekap PRD')

@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Input & Analisa Data</h2>
        <p class="text-sm text-gray-500 mt-1">Upload file excel harian dan analisa dengan filter fleksibel</p>
    </div>
</div>

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  <span class="font-medium">Berhasil!</span> {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <span class="font-medium">Gagal!</span> Periksa kembali file dan inputan Anda.
</div>
@endif

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Form Upload -->
    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 xl:col-span-1">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Form Import Harian</h4>
        <form action="{{ route('rekap-prd.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Tanggal</label>
                <input type="date" name="tanggal" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File Hasil PRD (.xlsx)</label>
                <input type="file" name="file_prd" accept=".xlsx,.xls,.csv" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File Pengeluaran TML (.xlsx)</label>
                <input type="file" name="file_tml" accept=".xlsx,.xls,.csv" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            </div>
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File Pengeluaran TTL (.xlsx)</label>
                <input type="file" name="file_ttl" accept=".xlsx,.xls,.csv" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            </div>
            <button type="submit" class="w-full text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">Hitung & Simpan</button>
        </form>
    </div>

    <!-- Chart Fleksibel -->
    <div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 xl:col-span-2">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-bold text-gray-800 dark:text-white">Analisa Grafik</h4>
            
            <div class="flex items-center gap-2">
                <!-- Dropdown Filter -->
                <form action="{{ route('rekap-prd.input') }}" method="GET" class="flex items-center gap-2">
                    <select name="filter" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                    </select>

                    <input type="date" name="filter_date" value="{{ $filter_date ?? date('Y-m-d') }}" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $filter == 'harian' ? '' : 'hidden' }}">
                    
                    <input type="month" name="filter_month" value="{{ $filter_month ?? date('Y-m') }}" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $filter == 'bulanan' ? '' : 'hidden' }}">
                    
                    <input type="number" name="filter_year" value="{{ $filter_year ?? date('Y') }}" min="2000" max="2100" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $filter == 'tahunan' ? '' : 'hidden' }}">
                </form>

                <!-- Export Form -->
                <form id="exportForm" action="{{ route('rekap-prd.export') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="filter" value="{{ $filter }}">
                    <input type="hidden" name="filter_date" value="{{ $filter_date ?? '' }}">
                    <input type="hidden" name="filter_month" value="{{ $filter_month ?? '' }}">
                    <input type="hidden" name="filter_year" value="{{ $filter_year ?? '' }}">
                    <input type="hidden" name="chart_image" id="chart_image">
                </form>
                <button type="button" onclick="exportExcel()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export Excel
                </button>
            </div>
        </div>
        
        <div class="relative h-[350px] w-full">
            @if($data->count() > 0)
                <canvas id="rekapChart"></canvas>
            @else
                <div class="h-full w-full flex items-center justify-center text-gray-400">
                    Belum ada data untuk ditampilkan di grafik.
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Table -->
<div class="bg-white dark:bg-darkgray p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Data Rekapitulasi (Filter: {{ ucfirst($filter) }})</h4>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Periode</th>
                    <th scope="col" class="px-6 py-3">Hasil PRD CGL</th>
                    <th scope="col" class="px-6 py-3 text-red-500">Pengeluaran TML</th>
                    <th scope="col" class="px-6 py-3 text-red-500">Pengeluaran TTL</th>
                    <th scope="col" class="px-6 py-3 font-bold text-red-600">Total Pengeluaran</th>
                    <th scope="col" class="px-6 py-3 font-bold text-green-600">Sisa Stock</th>
                    <th scope="col" class="px-6 py-3 font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if($filter == 'harian' || $filter == 'bulanan')
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        @elseif($filter == 'tahunan')
                            {{ date('F', mktime(0, 0, 0, $item->periode, 1)) }} {{ $filter_year }}
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ number_format($item->hasil_prd, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ number_format($item->pengeluaran_tml, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ number_format($item->pengeluaran_ttl, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 font-bold text-red-600">{{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 font-bold text-green-600">{{ number_format($item->sisa_stock, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($filter == 'harian' || $filter == 'bulanan')
                            <form action="{{ route('rekap-prd.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data untuk tanggal {{ \Carbon\Carbon::parse($item->tanggal)->format("d M Y") }}? Sisa Stock hari-hari setelahnya akan otomatis dihitung ulang.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    Hapus
                                </button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
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
    
    // Sort chronological for chart
    let chartData = [...rawData];
    if(filter === 'harian') {
        chartData.sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal)).slice(-14);
    } else {
        chartData.sort((a, b) => {
            if(a.periode > b.periode) return 1;
            if(a.periode < b.periode) return -1;
            return 0;
        });
    }

    const labels = chartData.map(item => {
        if(filter === 'harian' || filter === 'bulanan') {
            const d = new Date(item.tanggal);
            return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
        } else if (filter === 'tahunan') {
            const namaBulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
            return namaBulan[item.periode - 1]; 
        }
    });
    
    const pengeluaran = chartData.map(item => item.total_pengeluaran);
    const sisaStock = chartData.map(item => item.sisa_stock);

    const ctx = document.getElementById('rekapChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Pengeluaran',
                    data: pengeluaran,
                    backgroundColor: 'rgba(239, 68, 68, 0.85)',
                    borderRadius: 4,
                },
                {
                    label: 'Sisa Stock',
                    data: sisaStock,
                    backgroundColor: 'rgba(34, 197, 94, 0.85)',
                    borderRadius: 4,
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
    const canvas = document.getElementById('rekapChart');
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
