@extends('break_bulk.layout.V_template')

@section('title', 'Monitoring Tonase - Break Bulk')

@push('css')
<style>
    .stat-card-accent {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #eef2f6;
    }
    .stat-card-accent:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }
    #dataTable thead th {
        background-color: #f8fafc !important;
        color: #334155 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 12px 14px !important;
        vertical-align: middle !important;
    }
    #dataTable tbody td {
        padding: 12px 14px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        font-size: 13px !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bolder mb-1 fs-5 fs-md-4" style="color: #1e293b; letter-spacing: -0.5px;">
                        <i class="fas fa-weight-hanging text-primary me-2"></i>Monitoring Tonase Break Bulk
                    </h4>
                    <div class="text-muted" style="font-size: 13px;">
                        Home <span class="mx-1">/</span> Setting Break Bulk <span class="mx-1">/</span> <span class="text-primary fw-semibold">Tonase</span>
                    </div>
                </div>
                <div class="w-100 w-sm-auto">
                    <a href="{{ route('break-bulk.index') }}" class="btn btn-outline-primary w-100 w-sm-auto d-flex align-items-center justify-content-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 9px 18px;">
                        <i class="fas fa-barcode"></i>
                        <span>Ke Form Scan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik Kartu (2x2 di Mobile, 4x1 di Desktop) -->
    <div class="row g-2 g-md-3 mb-4">
        <!-- 1. Total Trailer -->
        <div class="col-6 col-md-3">
            <div class="card stat-card-accent shadow-sm border-0 h-100" style="border-left: 4px solid #135b9f !important;">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold" style="font-size: 11px; text-transform: uppercase;">Trailer Aktif</span>
                            <h3 class="fw-bold mb-0 mt-1 text-dark fs-5 fs-md-3">{{ number_format($totalTrailer) }}</h3>
                            <small class="text-muted" style="font-size: 11px;">Unit</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(19, 91, 159, 0.1); color: #135b9f;">
                            <i class="fas fa-truck-moving fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total Koil -->
        <div class="col-6 col-md-3">
            <div class="card stat-card-accent shadow-sm border-0 h-100" style="border-left: 4px solid #0891b2 !important;">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold" style="font-size: 11px; text-transform: uppercase;">Total Koil</span>
                            <h3 class="fw-bold mb-0 mt-1 text-dark fs-5 fs-md-3">{{ number_format($totalKoil) }}</h3>
                            <small class="text-muted" style="font-size: 11px;">Roll</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(8, 145, 178, 0.1); color: #0891b2;">
                            <i class="fas fa-cubes fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Total Tonase -->
        <div class="col-6 col-md-3">
            <div class="card stat-card-accent shadow-sm border-0 h-100" style="border-left: 4px solid #16a34a !important;">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold" style="font-size: 11px; text-transform: uppercase;">Tonase</span>
                            <h3 class="fw-bold mb-0 mt-1 text-success fs-5 fs-md-3">{{ number_format($grandTotalWeight / 1000, 2, ',', '.') }}</h3>
                            <small class="text-muted" style="font-size: 11px;">Ton</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(22, 163, 74, 0.1); color: #16a34a;">
                            <i class="fas fa-weight-hanging fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Rata-rata Tonase per Trailer -->
        <div class="col-6 col-md-3">
            <div class="card stat-card-accent shadow-sm border-0 h-100" style="border-left: 4px solid #f59e0b !important;">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold" style="font-size: 11px; text-transform: uppercase;">Rata-rata/Unit</span>
                            <h3 class="fw-bold mb-0 mt-1 text-warning-emphasis fs-5 fs-md-3">
                                {{ $totalTrailer > 0 ? number_format(($grandTotalWeight / $totalTrailer) / 1000, 2, ',', '.') : '0,00' }}
                            </h3>
                            <small class="text-muted" style="font-size: 11px;">Ton</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="fas fa-calculator fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Rekapitulasi Tonase per Trailer -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px;">
        <div class="card-header bg-white py-3 px-3 px-md-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-radius: 14px 14px 0 0;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(19, 91, 159, 0.1); color: #135b9f;">
                    <i class="fas fa-table-list fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0 fs-6 fs-md-5">Rekapitulasi Tonase per Nomor Trailer</h5>
                    <small class="text-muted d-none d-sm-block">Total beban berat dan kapasitas muat tiap unit trailer</small>
                </div>
            </div>
            @if($totalTrailer > 0)
            <span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 fw-semibold" style="border-radius: 8px;">
                <i class="fas fa-check-circle me-1"></i> {{ $totalTrailer }} Trailer Terdaftar
            </span>
            @endif
        </div>

        <div class="card-body p-3 p-md-4">
            @if($totalTrailer > 0)
                <!-- Search Toolbar -->
                <div class="row align-items-center mb-3 g-2">
                    <div class="col-12 col-md-5 col-lg-4">
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <span class="input-group-text bg-white border-end-0 pe-2" style="border-color: #cbd5e1;">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 custom-dt-search ps-1" placeholder="Cari nomor trailer..." style="border-color: #cbd5e1; font-size: 14px; padding: 9px 12px;">
                        </div>
                    </div>
                </div>

                <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                    <table class="table table-hover align-middle mb-0 text-nowrap" id="dataTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 60px;">NO</th>
                                <th>NOMOR TRAILER</th>
                                <th class="text-end" style="width: 220px;">TONASE</th>
                                <th class="text-center" style="width: 140px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trailers as $t)
                            <tr>
                                <td class="text-muted fw-semibold">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 font-monospace fw-bold fs-6" style="border-radius: 8px;">
                                        <i class="fas fa-truck me-2"></i>Trailer {{ $t->trailer }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bolder text-success font-monospace fs-5">
                                        {{ number_format($t->total_weight / 1000, 2, ',', '.') }}
                                    </span>
                                    <span class="badge bg-success-subtle text-success ms-1">Ton</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalDetailTrailer{{ $loop->iteration }}" style="border-radius: 8px; font-weight: 600; padding: 6px 14px;">
                                        <i class="fas fa-eye"></i>
                                        <span>Detail</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Kondisi Kosong -->
                <div class="text-center py-5 my-3">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 76px; height: 76px; background-color: rgba(19, 91, 159, 0.08); color: #135b9f;">
                            <i class="fas fa-truck-loading fs-2"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Belum Ada Data Tonase Trailer</h5>
                    <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto; font-size: 14px;">
                        Data tonase akan otomatis dihitung saat koil discan dan dialokasikan ke nomor trailer pada modul Setting Break Bulk.
                    </p>
                    <a href="{{ route('break-bulk.index') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm" style="border-radius: 10px; font-weight: 600; padding: 10px 24px;">
                        <i class="fas fa-barcode fs-5"></i>
                        <span>Mulai Scan Koil</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail Koil per Trailer -->
@if($totalTrailer > 0)
    @foreach($trailers as $t)
    <div class="modal fade" id="modalDetailTrailer{{ $loop->iteration }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $loop->iteration }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.18);">
                <div class="modal-header border-bottom py-3 px-3 px-md-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-truck text-primary fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0 fs-6 fs-md-5" id="modalDetailLabel{{ $loop->iteration }}">
                                Detail Muatan Trailer: {{ $t->trailer }}
                            </h5>
                            <small class="text-muted">Total {{ $t->total_koil }} koil ({{ number_format($t->total_weight / 1000, 2, ',', '.') }} Ton)</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 p-md-4">
                    <!-- Ringkasan Info Trailer -->
                    <div class="row g-2 mb-3">
                        <div class="col-6 col-md-3">
                            <div class="p-2 border rounded bg-light text-center">
                                <small class="text-muted d-block" style="font-size: 11px;">Nomor Trailer</small>
                                <span class="fw-bold font-monospace text-primary fs-6">{{ $t->trailer }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2 border rounded bg-light text-center">
                                <small class="text-muted d-block" style="font-size: 11px;">Jumlah Koil</small>
                                <span class="fw-bold text-dark fs-6">{{ $t->total_koil }} Roll</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2 border rounded bg-light text-center">
                                <small class="text-muted d-block" style="font-size: 11px;">Total Berat</small>
                                <span class="fw-bold font-monospace text-dark fs-6">{{ number_format($t->total_weight, 2, ',', '.') }} <small>Kg</small></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2 border rounded bg-light text-center">
                                <small class="text-muted d-block" style="font-size: 11px;">Tonase</small>
                                <span class="fw-bold font-monospace text-success fs-6">{{ number_format($t->total_weight / 1000, 2, ',', '.') }} Ton</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Tag POD & Grouping -->
                    <div class="p-2 border rounded bg-light-subtle d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 px-3">
                        <div>
                            <small class="text-muted fw-semibold me-1">POD (Tujuan):</small>
                            @forelse($t->pods as $pod)
                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace">{{ $pod }}</span>
                            @empty
                                <span class="text-muted small">-</span>
                            @endforelse
                        </div>
                        <div>
                            <small class="text-muted fw-semibold me-1">Grouping:</small>
                            @forelse($t->groupings as $grp)
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2 py-1">{{ $grp }}</span>
                            @empty
                                <span class="text-muted small">-</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tabel Daftar Koil -->
                    <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                        <table class="table table-sm table-hover align-middle mb-0 text-nowrap" style="font-size: 13px;">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;">No</th>
                                    <th>Atribut</th>
                                    <th>Produk</th>
                                    <th class="text-end">Berat (Kg)</th>
                                    <th>Grouping</th>
                                    <th>POD</th>
                                    <th>No SO</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($t->items as $item)
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="font-monospace fw-bold text-primary">{{ $item->atribut }}</span>
                                    </td>
                                    <td>
                                        @if($item->product == 'Menunggu Import' || empty($item->product) || $item->product == '-')
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                                <i class="fas fa-clock me-1"></i>Menunggu Import
                                            </span>
                                        @else
                                            <span class="text-dark fw-medium">{{ $item->product }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end font-monospace fw-bold">
                                        @if($item->weight > 0)
                                            {{ number_format($item->weight, 2, ',', '.') }}
                                        @else
                                            <span class="badge bg-warning-subtle text-warning-emphasis">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-primary border">{{ $item->grouping }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border font-monospace">{{ $item->pod }}</span>
                                    </td>
                                    <td>
                                        <span class="font-monospace text-muted">{{ $item->no_so ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info-emphasis border">{{ $item->lokasi }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-top py-2 px-4">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="border-radius: 8px;">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

@endsection
