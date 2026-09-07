@extends('rekap_prd.layout.V_template')

@section('title', 'Dashboard Rekap PRD & Pengeluaran')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">Dashboard Keseluruhan</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> Dashboard
            </div>
        </div>
    </div>

    <!-- Style untuk Animasi Hover & Segmented Control -->
    <style>
        .hover-elevate {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .hover-elevate:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
        }
        
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
    </style>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 hover-elevate overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-trending-up" style="font-size: 80px; color: #4361ee; transform: rotate(15deg);"></i>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);">
                            <i class="ti ti-trending-up fs-6"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 28px; color: #1e293b;">{{ $latest ? number_format($latest->hasil_prd, 0, ',', '.') : 0 }}</h3>
                    <p class="mb-1 fw-semibold" style="color: #64748b; font-size: 14px;">Hasil PRD (Terkini)</p>
                    <p class="mb-0 text-muted" style="font-size: 12px;">Update: {{ $latest ? \Carbon\Carbon::parse($latest->tanggal)->format('d M Y') : '-' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card border-0 hover-elevate overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-trending-down" style="font-size: 80px; color: #A22C29; transform: rotate(-15deg);"></i>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #f72585 0%, #A22C29 100%);">
                            <i class="ti ti-trending-down fs-6"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 28px; color: #1e293b;">{{ $latest ? number_format($latest->total_pengeluaran, 0, ',', '.') : 0 }}</h3>
                    <p class="mb-1 fw-semibold" style="color: #64748b; font-size: 14px;">Total Pengeluaran</p>
                    <p class="mb-0 text-muted" style="font-size: 12px;">Update Terakhir</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card border-0 hover-elevate overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-package" style="font-size: 80px; color: #10b981; transform: rotate(10deg);"></i>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="ti ti-package fs-6"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 28px; color: #1e293b;">{{ $latest ? number_format($latest->sisa_stock, 0, ',', '.') : 0 }}</h3>
                    <p class="mb-1 fw-semibold" style="color: #64748b; font-size: 14px;">Sisa Stock</p>
                    <p class="mb-0 text-muted" style="font-size: 12px;">Ketersediaan saat ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Keseluruhan -->
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="color: #1e293b;">Grafik Keseluruhan</h5>
                
                <form action="{{ route('rekap-prd.dashboard') }}" method="GET" class="m-0">
                    <div class="segmented-control">
                        <button type="submit" name="filter" value="harian" class="segmented-btn {{ $filter == 'harian' ? 'active' : '' }}">Harian</button>
                        <button type="submit" name="filter" value="bulanan" class="segmented-btn {{ $filter == 'bulanan' ? 'active' : '' }}">Bulanan</button>
                        <button type="submit" name="filter" value="tahunan" class="segmented-btn {{ $filter == 'tahunan' ? 'active' : '' }}">Tahunan</button>
                    </div>
                </form>
            </div>
            
            <div style="height: 400px; width: 100%; position: relative;">
                @if($data->count() > 0)
                    <canvas id="overallChart"></canvas>
                @else
                    <div class="h-100 w-100 d-flex align-items-center justify-content-center text-muted">
                        Belum ada data untuk ditampilkan.
                    </div>
                @endif
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
    
    let chartData = [...rawData];
    if(filter === 'harian') {
        // Exclude initial stock
        chartData = chartData.filter(item => item.tanggal !== '2026-08-31');
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
    gradientStock.addColorStop(0, 'rgba(19, 91, 159, 0.2)'); // Corporate Blue transparent
    gradientStock.addColorStop(1, 'rgba(19, 91, 159, 0.0)');

    new Chart(ctx, {
        data: {
            labels: labels,
            datasets: [
                {
                    type: 'bar',
                    label: 'Total Pengeluaran',
                    data: pengeluaran,
                    backgroundColor: '#A22C29', // Corporate Red
                    hoverBackgroundColor: '#8B2523',
                    borderRadius: 6,
                    barThickness: 10,
                    order: 2
                },
                {
                    type: 'line',
                    label: 'Sisa Stock',
                    data: sisaStock,
                    borderColor: '#135b9f', // Corporate Blue
                    backgroundColor: gradientStock,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#135b9f',
                    pointBorderWidth: 2,
                    pointRadius: 4,
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
</script>
@endif
@endpush
