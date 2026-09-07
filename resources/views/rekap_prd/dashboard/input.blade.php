@extends('rekap_prd.layout.V_template')

@section('title', 'Input Rekap PRD')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3">
            <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px; font-size: 1.3rem;">Input Produksi</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> Input Produksi
            </div>
        </div>
    </div>

    <!-- Top Row: Form & Data Terakhir -->
    <div class="row mb-3">
        <!-- Kolom Kiri: Form -->
        <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px;">
                <div class="card-body p-3 d-flex flex-column">
                    <h5 class="fw-bold mb-3" style="color: #1e293b; font-size: 1.1rem;">Form Import Harian</h5>
                    <form action="{{ route('rekap-prd.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-grow-1">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label fw-semibold" style="color: #475569; font-size: 13px; margin-bottom: 4px;">Pilih Tanggal</label>
                            <input type="date" name="tanggal" required class="form-control form-control-sm" style="border-radius: 6px;">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold" style="color: #475569; font-size: 13px; margin-bottom: 4px;">File Hasil PRD (.xlsx)</label>
                            <input type="file" name="file_prd" accept=".xlsx,.xls,.csv" required class="form-control form-control-sm" style="border-radius: 6px;">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold" style="color: #475569; font-size: 13px; margin-bottom: 4px;">File Pengeluaran TML (.xlsx)</label>
                            <input type="file" name="file_tml" accept=".xlsx,.xls,.csv" required class="form-control form-control-sm" style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #475569; font-size: 13px; margin-bottom: 4px;">File Pengeluaran TTL (.xlsx)</label>
                            <input type="file" name="file_ttl" accept=".xlsx,.xls,.csv" required class="form-control form-control-sm" style="border-radius: 6px;">
                        </div>
                        <div class="mt-auto">
                            <button type="submit" class="btn text-white w-100 py-1 fw-semibold" style="background-color: #135b9f; border-color: #135b9f; border-radius: 6px; font-size: 14px;">
                                <i class="ti ti-upload me-1"></i> Hitung & Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Kolom Kanan: Data Terakhir -->
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px;">
                <div class="card-body p-3 d-flex flex-column">
                    <h5 class="fw-bold mb-3" style="color: #1e293b; font-size: 1.1rem;">Data Input Terakhir</h5>
                    @if($latestInput)
                        <div class="table-responsive flex-grow-1">
                            <table class="table table-bordered table-sm mb-0 h-100" style="font-size: 13px;">
                                <tbody>
                                    <tr>
                                        <th class="bg-light px-3 py-2 align-middle" style="width: 40%">Tanggal</th>
                                        <td class="fw-semibold px-3 py-2 align-middle">{{ \Carbon\Carbon::parse($latestInput->tanggal)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light px-3 py-2 align-middle">Hasil PRD</th>
                                        <td class="px-3 py-2 align-middle">{{ number_format($latestInput->hasil_prd, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light px-3 py-2 align-middle">Pengeluaran TML</th>
                                        <td class="px-3 py-2 align-middle" style="color: #A22C29;">{{ number_format($latestInput->pengeluaran_tml, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light px-3 py-2 align-middle">Pengeluaran TTL</th>
                                        <td class="px-3 py-2 align-middle" style="color: #A22C29;">{{ number_format($latestInput->pengeluaran_ttl, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light px-3 py-2 align-middle">Sisa Stock</th>
                                        <td class="fw-bold px-3 py-2 align-middle" style="color: #135b9f;">{{ number_format($latestInput->sisa_stock, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted text-center py-3 flex-grow-1 d-flex align-items-center justify-content-center">Belum ada data input.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Grafik -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-body p-3">
                    <h5 class="fw-bold mb-3" style="color: #1e293b; font-size: 1.1rem;">Grafik Produksi & Pengeluaran</h5>
                    <div class="row">
                        @if($latestInput && $akumulasiBulanIni)
                            <div class="col-6">
                                <h6 class="text-center text-muted fw-bold mb-2" style="font-size: 12px;">Input Terakhir</h6>
                                <div style="height: 160px; width: 100%; position: relative;">
                                    <canvas id="chartHariIni"></canvas>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6 class="text-center text-muted fw-bold mb-2" style="font-size: 12px;">Akumulasi 1 Bulan</h6>
                                <div style="height: 160px; width: 100%; position: relative;">
                                    <canvas id="chartBulanIni"></canvas>
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="h-100 w-100 d-flex align-items-center justify-content-center text-muted py-5">
                                    Belum ada data untuk ditampilkan.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($latestInput && $akumulasiBulanIni)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return new Intl.NumberFormat('id-ID').format(context.parsed.y);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        if (value >= 1000000) return (value / 1000000) + 'M';
                        else if (value >= 1000) return (value / 1000) + 'k';
                        return value;
                    }
                }
            }
        }
    };

    // Format tanggal untuk label
    const tanggalInput = '{{ \Carbon\Carbon::parse($latestInput->tanggal)->format('d M Y') }}';
    const bulanInput = '{{ \Carbon\Carbon::parse($latestInput->tanggal)->format('F Y') }}';

    // Chart Input Terakhir
    const ctxHariIni = document.getElementById('chartHariIni').getContext('2d');
    new Chart(ctxHariIni, {
        type: 'bar',
        data: {
            labels: [tanggalInput],
            datasets: [
                {
                    label: 'Sisa Stock',
                    data: [{{ $latestInput->sisa_stock }}],
                    backgroundColor: '#135b9f',
                    borderRadius: 4,
                },
                {
                    label: 'Total Pengeluaran',
                    data: [{{ $latestInput->total_pengeluaran }}],
                    backgroundColor: '#A22C29',
                    borderRadius: 4,
                }
            ]
        },
        options: commonOptions
    });

    // Chart Akumulasi 1 Bulan
    const ctxBulanIni = document.getElementById('chartBulanIni').getContext('2d');
    new Chart(ctxBulanIni, {
        type: 'bar',
        data: {
            labels: [bulanInput],
            datasets: [
                {
                    label: 'Sisa Stock',
                    data: [{{ $latestInput->sisa_stock }}],
                    backgroundColor: '#135b9f',
                    borderRadius: 4,
                },
                {
                    label: 'Total Pengeluaran',
                    data: [{{ $akumulasiBulanIni->total_pengeluaran }}],
                    backgroundColor: '#A22C29',
                    borderRadius: 4,
                }
            ]
        },
        options: commonOptions
    });
});
</script>
@endif
@endpush
