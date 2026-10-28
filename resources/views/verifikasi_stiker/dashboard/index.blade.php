@extends('verifikasi_stiker.layout.V_template')

@section('title', 'Dashboard Verifikasi Stiker')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-3 mb-md-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Dashboard Verifikasi Stiker</h4>
                <div class="text-muted" style="font-size: 13px;">
                    Home <span class="mx-1">/</span> Verifikasi Stiker <span class="mx-1">/</span> Dashboard
                </div>
            </div>
            <div class="d-flex align-items-stretch align-items-md-center gap-2 flex-wrap w-100 w-md-auto">
                <!-- Filter Tanggal Input Admin -->
                <form method="GET" action="{{ route('verifikasi-stiker.dashboard') }}" class="d-flex align-items-center gap-2 bg-white px-3 py-2 border rounded-3 shadow-sm w-100 w-md-auto">
                    <i class="fas fa-calendar-day text-primary"></i>
                    <span class="small fw-bold text-muted text-nowrap">Tgl Input:</span>
                    <select name="tanggal_input" class="form-select form-select-sm border-0 fw-bold" onchange="this.form.submit()" style="width: auto; background-color: transparent; cursor: pointer; color: #1e293b;">
                        <option value="all" {{ $selectedDate === 'all' ? 'selected' : '' }}>Semua Tanggal</option>
                        @foreach($availableDates as $dt)
                            @php $dtStr = $dt->format('Y-m-d'); @endphp
                            <option value="{{ $dtStr }}" {{ $selectedDate == $dtStr ? 'selected' : '' }}>
                                {{ $dt->format('d/m/Y') }} {{ $dtStr == now()->toDateString() ? '(Hari Ini)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div class="d-flex gap-2 w-100 w-md-auto flex-wrap">
                    <a href="{{ route('verifikasi-stiker.scan', ['tanggal_input' => $selectedDate]) }}" class="btn btn-primary flex-fill d-inline-flex align-items-center justify-content-center gap-2 shadow-sm py-2 px-3" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-qrcode"></i>
                        <span>Scan Stiker</span>
                    </a>
                    <a href="{{ route('verifikasi-stiker.export-excel', ['tanggal_input' => $selectedDate]) }}" class="btn btn-success flex-fill d-inline-flex align-items-center justify-content-center gap-2 shadow-sm py-2 px-3" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-file-excel"></i>
                        <span>Export Excel</span>
                    </a>
                    <a href="{{ route('verifikasi-stiker.data') }}" class="btn btn-outline-primary flex-fill d-inline-flex align-items-center justify-content-center gap-2 shadow-sm py-2 px-3" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-database"></i>
                        <span>Master Data</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards (Grid 2x2 di Mobile, 1x4 di Desktop) -->
    <div class="row g-2 g-md-3 mb-3 mb-md-4">
        <!-- Total Data -->
        <div class="col-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; transition: transform 0.2s;">
                <div class="card-body p-3 p-md-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block text-truncate" style="font-size: 11px; letter-spacing: 0.3px;">Total Data</span>
                        <h3 class="fw-bolder mb-0 mt-1" style="color: #1e293b; font-size: clamp(20px, 3.5vw, 28px);">{{ number_format($totalData ?? 0) }}</h3>
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border-radius: 10px; background-color: rgba(19, 91, 159, 0.1); color: #135b9f;">
                        <i class="fas fa-boxes fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terverifikasi (Sesuai) -->
        <div class="col-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; transition: transform 0.2s;">
                <div class="card-body p-3 p-md-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block text-truncate" style="font-size: 11px; letter-spacing: 0.3px;">Sesuai (OK)</span>
                        <h3 class="fw-bolder mb-0 mt-1" style="color: #16a34a; font-size: clamp(20px, 3.5vw, 28px);">{{ number_format($totalSesuai ?? 0) }}</h3>
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border-radius: 10px; background-color: #dcfce7; color: #16a34a;">
                        <i class="fas fa-check-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Belum Verifikasi -->
        <div class="col-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; transition: transform 0.2s;">
                <div class="card-body p-3 p-md-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block text-truncate" style="font-size: 11px; letter-spacing: 0.3px;">Belum Cek</span>
                        <h3 class="fw-bolder mb-0 mt-1" style="color: #d97706; font-size: clamp(20px, 3.5vw, 28px);">{{ number_format($totalBelum ?? 0) }}</h3>
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border-radius: 10px; background-color: #fef3c7; color: #d97706;">
                        <i class="fas fa-clock fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tidak Sesuai -->
        <div class="col-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; transition: transform 0.2s;">
                <div class="card-body p-3 p-md-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold d-block text-truncate" style="font-size: 11px; letter-spacing: 0.3px;">Tidak Sesuai</span>
                        <h3 class="fw-bolder mb-0 mt-1" style="color: #dc2626; font-size: clamp(20px, 3.5vw, 28px);">{{ number_format($totalTidakSesuai ?? 0) }}</h3>
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border-radius: 10px; background-color: #fee2e2; color: #dc2626;">
                        <i class="fas fa-times-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Verifikasi Terkini -->
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom p-3 p-md-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-history text-primary"></i>
                <h5 class="fw-bold mb-0" style="color: #1e293b; font-size: 16px;">Riwayat Verifikasi Terkini</h5>
            </div>
            <a href="{{ route('verifikasi-stiker.data', ['tanggal_input' => $selectedDate]) }}" class="btn btn-sm btn-link text-decoration-none fw-semibold p-0" style="color: #135b9f; font-size: 13px;">
                Semua Data <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <!-- Swipe Hint Khusus Layar HP -->
        <div class="d-block d-md-none text-muted small px-3 py-2 border-bottom bg-light" style="font-size: 12px;">
            <i class="fas fa-arrows-alt-h me-1 text-primary"></i> Geser tabel ke samping untuk melihat detail
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="ps-4 text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Attribute</th>
                            <th class="text-center text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Status</th>
                            <th class="text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Produk (Kuning)</th>
                            <th class="text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Supplier Lot No</th>
                            <th class="text-end text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Berat</th>
                            <th class="text-center text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">3 Ceklis</th>
                            <th class="text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentVerifikasi as $item)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-light text-dark border font-monospace" style="font-size: 12px; letter-spacing: 0.3px;">
                                    {{ $item->attribute }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($item->status_verifikasi == 'sesuai')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 11px;">
                                        <i class="fas fa-check me-1"></i> Sesuai
                                    </span>
                                @elseif($item->status_verifikasi == 'tidak_sesuai')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 11px;">
                                        <i class="fas fa-times me-1"></i> Tidak Sesuai
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 11px;">
                                        <i class="fas fa-clock me-1"></i> Belum
                                    </span>
                                @endif
                            </td>
                            <td class="fw-semibold" style="color: #1e293b;">{{ $item->produk }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $item->supplier_lot_no }}</span></td>
                            <td class="text-end fw-bold">{{ number_format($item->berat, 2, '.', ',') }}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <span class="badge {{ $item->check_produk ? 'bg-success' : 'bg-light text-muted border' }}" title="Produk: {{ $item->check_produk ? 'OK' : '-' }}" style="font-size: 10px;">P</span>
                                    <span class="badge {{ $item->check_lot_no ? 'bg-success' : 'bg-light text-muted border' }}" title="Lot No: {{ $item->check_lot_no ? 'OK' : '-' }}" style="font-size: 10px;">L</span>
                                    <span class="badge {{ $item->check_berat ? 'bg-success' : 'bg-light text-muted border' }}" title="Berat: {{ $item->check_berat ? 'OK' : '-' }}" style="font-size: 10px;">B</span>
                                </div>
                            </td>
                            <td style="font-size: 13px;">
                                <div class="fw-semibold text-dark">{{ $item->verified_by ?? '-' }}</div>
                                <div class="text-muted" style="font-size: 11px;">{{ $item->verified_at ? $item->verified_at->format('d/m/Y H:i') : '-' }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted" style="opacity: 0.4;"></i>
                                <p class="mb-0">Belum ada riwayat verifikasi pada tanggal ini.</p>
                                <a href="{{ route('verifikasi-stiker.scan', ['tanggal_input' => $selectedDate]) }}" class="btn btn-sm btn-primary mt-3" style="border-radius: 6px;">
                                    Mulai Scan Stiker
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
