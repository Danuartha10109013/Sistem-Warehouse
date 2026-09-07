@extends('rekap_prd.layout.V_template')

@section('title', 'Data Rekap PRD')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">Data Rekapitulasi</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> Data Rekapitulasi
            </div>
        </div>
    </div>

    <!-- Style untuk Segmented Control -->
    <style>
        .segmented-control {
            display: inline-flex;
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 4px;
        }
        .segmented-btn {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .segmented-btn:hover {
            color: #1e293b;
        }
        .segmented-btn.active {
            background-color: #ffffff;
            color: #135b9f;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        /* Fix for giant calendar icon in WebKit browsers */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="month"]::-webkit-calendar-picker-indicator {
            width: 16px !important;
            height: 16px !important;
            padding: 0;
            margin: 0;
            cursor: pointer;
        }
    </style>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0" style="color: #1e293b;">Grafik Filter Data</h5>
                        
                        <!-- Header Filter -->
                        <div class="d-flex align-items-center gap-3">
                            <form action="{{ route('rekap-prd.data') }}" method="GET" class="d-flex align-items-center m-0 gap-3">
                                <div class="segmented-control">
                                    <button type="submit" name="filter" value="harian" class="segmented-btn {{ $filter == 'harian' ? 'active' : '' }}">Harian</button>
                                    <button type="submit" name="filter" value="bulanan" class="segmented-btn {{ $filter == 'bulanan' ? 'active' : '' }}">Bulanan</button>
                                    <button type="submit" name="filter" value="tahunan" class="segmented-btn {{ $filter == 'tahunan' ? 'active' : '' }}">Tahunan</button>
                                </div>
                                
                                <input type="date" name="filter_date" value="{{ $filter_date ?? date('Y-m-d') }}" onchange="this.form.submit()" class="form-control form-control-sm {{ $filter == 'harian' ? '' : 'd-none' }}" style="border-radius: 8px;">
                                <input type="month" name="filter_month" value="{{ $filter_month ?? date('Y-m') }}" onchange="this.form.submit()" class="form-control form-control-sm {{ $filter == 'bulanan' ? '' : 'd-none' }}" style="border-radius: 8px;">
                                <input type="number" name="filter_year" value="{{ $filter_year ?? date('Y') }}" min="2000" max="2100" onchange="this.form.submit()" class="form-control form-control-sm {{ $filter == 'tahunan' ? '' : 'd-none' }}" style="border-radius: 8px; width: 100px;">
                            </form>

                            <!-- Export Form -->
                            <form id="exportForm" action="{{ route('rekap-prd.export') }}" method="POST" class="d-none">
                                @csrf
                                <input type="hidden" name="filter" value="{{ $filter }}">
                                <input type="hidden" name="filter_date" value="{{ $filter_date ?? '' }}">
                                <input type="hidden" name="filter_month" value="{{ $filter_month ?? '' }}">
                                <input type="hidden" name="filter_year" value="{{ $filter_year ?? '' }}">
                                <input type="hidden" name="chart_image" id="chart_image">
                            </form>
                            <button type="button" onclick="exportExcel()" class="btn text-white fw-semibold" style="background-color: #135b9f; border-color: #135b9f; border-radius: 8px; font-size: 14px;">
                                <i class="ti ti-file-spreadsheet me-2"></i>Export Excel
                            </button>
                        </div>
                    </div>
                    
                    <div style="height: 350px; width: 100%; position: relative;">
                        @if($data->count() > 0)
                            <canvas id="rekapChart"></canvas>
                        @else
                            <div class="h-100 w-100 d-flex align-items-center justify-content-center text-muted">
                                Belum ada data untuk ditampilkan di grafik.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0 mb-5" style="border-radius: 16px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4" style="color: #1e293b;">Data Rekapitulasi (Filter: {{ ucfirst($filter) }})</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 12px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="py-3 px-4 rounded-start">Periode</th>
                            <th class="py-3 px-4">Hasil PRD CGL</th>
                            <th class="py-3 px-4" style="color: #A22C29;">Pengeluaran TML</th>
                            <th class="py-3 px-4" style="color: #A22C29;">Pengeluaran TTL</th>
                            <th class="py-3 px-4 fw-bold" style="color: #A22C29;">Total Pengeluaran</th>
                            <th class="py-3 px-4 fw-bold" style="color: #135b9f;">Sisa Stock</th>
                            <th class="py-3 px-4 rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($data as $item)
                        @if($item->tanggal == '2026-08-31')
                            @continue
                        @endif
                        <tr>
                            <td class="py-3 px-4 fw-medium text-dark">
                                @if($filter == 'harian' || $filter == 'bulanan')
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                @elseif($filter == 'tahunan')
                                    {{ date('F', mktime(0, 0, 0, $item->periode, 1)) }} {{ $filter_year }}
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ number_format($item->hasil_prd, 0, ',', '.') }}</td>
                            <td class="py-3 px-4" style="color: #A22C29;">{{ number_format($item->pengeluaran_tml, 0, ',', '.') }}</td>
                            <td class="py-3 px-4" style="color: #A22C29;">{{ number_format($item->pengeluaran_ttl, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 fw-bold" style="color: #A22C29;">{{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 fw-bold" style="color: #135b9f;">{{ number_format($item->sisa_stock, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                @if($filter == 'harian' || $filter == 'bulanan')
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('rekap-prd.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ \Carbon\Carbon::parse($item->tanggal)->format("d M Y") }}')" class="btn btn-sm text-white" style="border-radius: 6px; background-color: #A22C29; border: 1px solid #A22C29;" onmouseover="this.style.backgroundColor='#8B2523';" onmouseout="this.style.backgroundColor='#A22C29';">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-4 px-4 text-center text-muted">Belum ada data tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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
        // Exclude initial stock
        chartData = chartData.filter(item => item.tanggal !== '2026-08-31');
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
                    label: 'Sisa Stock',
                    data: sisaStock,
                    backgroundColor: '#135b9f', // Corporate Blue
                    hoverBackgroundColor: '#0f4880',
                    borderRadius: 4,
                },
                {
                    label: 'Total Pengeluaran',
                    data: pengeluaran,
                    backgroundColor: '#A22C29', // Corporate Red
                    hoverBackgroundColor: '#8B2523',
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
                        boxWidth: 8,
                        boxHeight: 8,
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 12,
                            weight: '600'
                        },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13, weight: '700' },
                    bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
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
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                        color: '#94a3b8'
                    }
                },
                y: {
                    beginAtZero: true,
                    border: { display: false },
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 10,
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                        color: '#94a3b8',
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
        const imageData = canvas.toDataURL('image/png');
        document.getElementById('chart_image').value = imageData;
    }
    document.getElementById('exportForm').submit();
}

function confirmDelete(id, tanggal) {
    if (typeof window.showCustomConfirm === 'function') {
        window.showCustomConfirm({
            iconClass: 'ti ti-trash',
            title: 'Hapus Data Rekap?',
            text: 'Data untuk tanggal <b>' + tanggal + '</b> akan dihapus permanen.',
            confirmText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    } else {
        // Fallback jika Swal belum diload
        if (confirm('Apakah Anda yakin ingin menghapus data untuk tanggal ' + tanggal + '?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
}
</script>
@endif
@endpush
