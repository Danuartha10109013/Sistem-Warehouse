@extends('verifikasi_stiker.layout.V_template')

@section('title', 'Scan Verifikasi Stiker')

@section('content')
    @php
        $riwayatVerifikasi = $riwayatVerifikasi ?? collect([]);
    @endphp
    <div class="container-fluid p-0">
        <!-- Header Page Info -->
        <div class="card shadow-sm border-0 mb-3 mb-md-4"
            style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
            <div
                class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Scan Verifikasi Stiker</h4>
                    <div class="text-muted" style="font-size: 13px;">
                        Home <span class="mx-1">/</span> Verifikasi Stiker <span class="mx-1">/</span> Scan
                    </div>
                </div>
                <div class="w-100 w-md-auto">
                    <!-- Selector Tanggal Input Admin -->
                    <form method="GET" action="{{ route('verifikasi-stiker.scan') }}" class="d-flex align-items-center gap-2 bg-white px-3 py-1 border rounded-3 shadow-sm w-100"
                        style="height: 42px;">
                        <i class="fas fa-calendar-day text-primary"></i>
                        <span class="small fw-bold text-muted text-nowrap">Tgl Input:</span>
                        <select name="tanggal_input" id="selectTanggalInput" class="form-select form-select-sm border-0 fw-bold py-0 flex-fill"
                            onchange="this.form.submit()"
                            style="background-color: transparent; cursor: pointer; color: #1e293b; min-width: 140px;">
                            <option value="all" {{ $selectedDate === 'all' ? 'selected' : '' }}>Semua Tanggal</option>
                            @foreach($availableDates as $dt)
                                @php $dtStr = $dt->format('Y-m-d'); @endphp
                                <option value="{{ $dtStr }}" {{ $selectedDate == $dtStr ? 'selected' : '' }}>
                                    {{ $dt->format('d/m/Y') }} {{ $dtStr == now()->toDateString() ? '(Hari Ini)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scan Input Card -->
        <div class="card shadow-sm border-0 mb-3 mb-md-4" style="border-radius: 12px;">
            <div class="card-body p-3 p-md-4 p-lg-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 text-center">
                        <span class="badge mb-2 px-3 py-2 bg-light text-dark border"
                            style="font-size: 12px; font-weight: 700; letter-spacing: 0.5px;">
                            <i class="fas fa-barcode me-1 text-primary"></i> INPUT ATTRIBUTE
                        </span>
                        <h3 class="fw-bold mb-2 mb-md-3" style="color: #1e293b; font-size: clamp(18px, 3.5vw, 24px);">Scan
                            atau Masukkan Attribute Stiker</h3>
                        <p class="text-muted mb-3 mb-md-4" style="font-size: 13px;">
                            Data diverifikasi untuk input tanggal <strong id="labelActiveTanggal"
                                class="text-primary">{{ $selectedDate == 'all' ? 'Semua Tanggal' : date('d/m/Y', strtotime($selectedDate)) }}</strong>.
                        </p>

                        <!-- Form Search -->
                        <form id="formScanAttribute" class="position-relative mb-3">
                            @csrf
                            <div class="input-group input-group-lg shadow-sm"
                                style="border-radius: 12px; overflow: hidden; border: 2px solid #135b9f;">
                                <span class="input-group-text bg-white border-0 text-primary ps-3 ps-md-4">
                                    <i class="fas fa-barcode fa-lg"></i>
                                </span>
                                <input type="text" id="inputAttribute" name="attribute"
                                    class="form-control border-0 py-3 fw-bold" placeholder="Scan barcode stiker di sini..."
                                    style="font-size: 16px; color: #1e293b; letter-spacing: 0.5px;" autocomplete="off"
                                    autofocus required>
                                <!-- Tombol Cek -->
                                <button type="submit" id="btnCari"
                                    class="btn btn-primary px-4 fw-bold d-flex align-items-center gap-2">
                                    <i class="fas fa-search"></i>
                                    <span>Cek</span>
                                </button>
                            </div>
                        </form>

                        <!-- Tombol Buka Kamera (Besar, Jelas, Menonjol) -->
                        <div class="mb-3">
                            <button type="button" id="btnToggleKamera"
                                class="btn w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2"
                                style="border-radius: 12px; font-size: 15px; background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%); color: #ffffff; border: none; transition: all 0.2s ease;">
                                <i class="fas fa-camera fs-5"></i>
                                <span id="labelBtnKamera">Buka Kamera Pemindai (HP / Tablet / Webcam)</span>
                            </button>
                        </div>

                        <!-- Inline Kamera Scanner Card (Awalnya tersembunyi) -->
                        <div id="cameraScannerCard" class="card border border-2 border-primary mb-3 shadow-sm d-none"
                            style="border-radius: 14px; overflow: hidden; background-color: #0f172a;">
                            <div
                                class="card-header bg-dark text-white px-3 py-2 d-flex justify-content-between align-items-center border-0">
                                <span class="small fw-bold text-white d-flex align-items-center gap-2">
                                    <i class="fas fa-circle text-danger fa-pulse"></i> Kamera Pemindai Aktif
                                </span>
                                <button type="button" class="btn btn-sm btn-outline-light py-1 px-3 fw-semibold"
                                    id="btnTutupKamera">
                                    <i class="fas fa-times me-1"></i> Tutup Kamera
                                </button>
                            </div>
                            <div class="card-body p-2 text-center">
                                <div id="qr-reader"
                                    style="width: 100%; max-width: 480px; margin: 0 auto; border-radius: 10px; overflow: hidden; min-height: 240px; background-color: #000;">
                                </div>
                                <div class="text-white-50 small mt-2">
                                    <i class="fas fa-info-circle text-warning me-1"></i> Arahkan kamera ke barcode stiker.
                                    Otomatis terdeteksi dan membuka popup.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center px-1 mt-2">
                            <small class="text-muted"><i class="fas fa-mobile-alt me-1"></i> Scanner barcode atau kamera
                                otomatis membuka popup verifikasi.</small>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none text-muted p-0"
                                id="btnClearInput">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Verifikasi Stiker -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-header bg-white border-bottom p-3 p-md-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="fw-bold mb-0" style="color: #1e293b; font-size: 16px;">
                        <i class="fas fa-history me-2 text-primary"></i> Riwayat Verifikasi Stiker
                    </h5>
                    <span class="badge bg-light text-primary border fw-bold" id="badgeSessionCount">{{ $riwayatVerifikasi->count() }} Data</span>
                </div>
                <!-- Tombol Export Excel Hasil Scan Per Hari -->
                <a href="{{ route('verifikasi-stiker.export-excel', ['tanggal_input' => $selectedDate]) }}"
                   class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center gap-1 shadow-sm px-3 py-1"
                   style="border-radius: 6px; font-size: 12px;">
                    <i class="fas fa-file-excel"></i>
                    <span>Export Excel ({{ $selectedDate === 'all' ? 'Semua' : date('d/m/Y', strtotime($selectedDate)) }})</span>
                </a>
            </div>
            <!-- Swipe Hint Khusus Layar HP -->
            <div class="d-block d-md-none text-muted small px-3 py-2 border-bottom bg-light" style="font-size: 12px;">
                <i class="fas fa-arrows-alt-h me-1 text-primary"></i> Geser tabel ke samping untuk melihat detail scan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" id="tableSessionScans">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th class="ps-4">Waktu</th>
                                <th>Attribute</th>
                                <th>Status</th>
                                <th>Produk</th>
                                <th>Lot No</th>
                                <th class="text-end">Berat</th>
                                <th class="text-center pe-4">3 Ceklis</th>
                            </tr>
                        </thead>
                        <tbody id="tbodySessionScans">
                            @php
                                $groupedRiwayat = $riwayatVerifikasi->groupBy(function($item) {
                                    return $item->tanggal_input ? $item->tanggal_input->format('Y-m-d') : 'no_date';
                                });
                            @endphp
                            @forelse($groupedRiwayat as $tglKey => $groupItems)
                                @php
                                    $isToday = $tglKey === now()->toDateString();
                                    $isYesterday = $tglKey === now()->subDay()->toDateString();
                                    if ($isToday) {
                                        $labelHari = 'Hari Ini (' . now()->format('d/m/Y') . ')';
                                        $badgeHari = 'bg-primary text-white';
                                    } elseif ($isYesterday) {
                                        $labelHari = 'Kemarin (' . now()->subDay()->format('d/m/Y') . ')';
                                        $badgeHari = 'bg-secondary text-white';
                                    } elseif ($tglKey === 'no_date') {
                                        $labelHari = 'Tanpa Tanggal Input';
                                        $badgeHari = 'bg-light text-dark';
                                    } else {
                                        $labelHari = 'Input Tanggal ' . \Carbon\Carbon::parse($tglKey)->format('d/m/Y');
                                        $badgeHari = 'bg-light text-dark border';
                                    }
                                @endphp
                                <!-- Baris Pemisah Tanggal -->
                                <tr class="table-light group-date-header" id="group-date-{{ $tglKey }}">
                                    <td colspan="7" class="py-2 px-3 fw-bold" style="background-color: #f1f5f9; color: #1e293b; font-size: 12px; border-top: 2px solid #e2e8f0; border-bottom: 1px solid #cbd5e1;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-calendar-alt text-primary"></i>
                                                <span>{{ $labelHari }}</span>
                                                <span class="badge {{ $badgeHari }} px-2 py-0" style="font-size: 10px;">{{ $groupItems->count() }} Data</span>
                                            </div>
                                            <small class="text-muted fw-normal">Sesuai: <strong class="text-success">{{ $groupItems->where('status_verifikasi', 'sesuai')->count() }}</strong> • Tidak: <strong class="text-danger">{{ $groupItems->where('status_verifikasi', 'tidak_sesuai')->count() }}</strong></small>
                                        </div>
                                    </td>
                                </tr>

                                @foreach($groupItems as $item)
                                    @php
                                        $countChecks = ($item->check_produk ? 1 : 0) + ($item->check_lot_no ? 1 : 0) + ($item->check_berat ? 1 : 0);
                                        $waktu = $item->verified_at ? $item->verified_at->format('H:i:s') : '-';
                                        $tgl = $item->verified_at ? $item->verified_at->format('d/m') : '';
                                    @endphp
                                    <tr id="session-row-{{ $item->id }}" class="row-riwayat-item" data-attribute="{{ $item->attribute }}" style="cursor: pointer;" title="Klik untuk cek ulang / lihat detail">
                                        <td class="ps-4 font-monospace" style="font-size: 13px;">
                                            <div class="fw-semibold text-dark">{{ $waktu }}</div>
                                            @if($tgl)<small class="text-muted" style="font-size: 10px;">{{ $tgl }}</small>@endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace" style="font-size: 12px; letter-spacing: 0.3px;">
                                                {{ $item->attribute }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->status_verifikasi === 'sesuai')
                                                <span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 700;">
                                                    <i class="fas fa-check-circle me-1"></i> SESUAI
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 11px; font-weight: 700;">
                                                    <i class="fas fa-times-circle me-1"></i> TIDAK SESUAI
                                                </span>
                                            @endif
                                        </td>
                                        <td class="fw-semibold text-dark" style="font-size: 13px;">{{ $item->produk }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace" style="font-size: 12px;">
                                                {{ $item->supplier_lot_no }}
                                            </span>
                                        </td>
                                        <td class="text-end fw-bold font-monospace" style="font-size: 13px;">
                                            {{ number_format($item->berat, 0, ',', '.') }} kg
                                        </td>
                                        <td class="text-center pe-4">
                                            @if($countChecks === 3)
                                                <span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11px;">
                                                    3/3 Cek
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11px;">
                                                    {{ $countChecks }}/3 Cek
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr id="rowEmptySession">
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-barcode fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                        Belum ada data yang diverifikasi untuk tanggal ini. Silakan scan barcode stiker.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL POPUP VERIFIKASI 3 CEKLIS (TAMPILAN RAPI & RESPONSIF) -->
    <!-- ======================================================== -->
    <div class="modal fade" id="modalVerifikasiStiker" tabindex="-1" aria-labelledby="modalVerifikasiStikerLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content border-0 shadow" style="border-radius: 14px; overflow: hidden;">

                <!-- Modal Header (2-Row Clean Layout: No Truncation) -->
                <div class="modal-header px-3 py-2 border-bottom bg-white flex-column align-items-stretch">
                    <!-- Row 1: Badges & Close Button -->
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <div class="d-flex align-items-center gap-1">
                            <span class="badge bg-light text-dark border" style="font-size: 10px; font-weight: 700; letter-spacing: 0.5px; padding: 3px 7px;">
                                ATTRIBUTE
                            </span>
                            <div id="badgeStatusContainer"></div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 11px;"></button>
                    </div>
                    <!-- Row 2: Full-Width Attribute Code -->
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="mb-0 fw-bold font-monospace text-dark text-break" id="displayAttribute" style="font-size: 17px; letter-spacing: 0.3px;">-</h5>
                    </div>
                </div>

                <!-- Sub-Bar Info Ringkas -->
                <div class="px-3 py-2 border-bottom bg-light d-flex align-items-center justify-content-between text-muted" style="font-size: 11px;">
                    <div class="d-flex align-items-center gap-1 text-nowrap me-2 overflow-hidden text-truncate">
                        <span>DN: <strong id="displayTglDn" class="text-dark font-monospace">-</strong></span>
                        <span class="text-muted mx-1">•</span>
                        <span>Input: <strong id="displayTglInput" class="text-dark font-monospace">-</strong></span>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary px-2 py-0 fw-semibold flex-shrink-0 text-nowrap shadow-none" id="btnCheckAll" style="font-size: 10.5px; border-radius: 4px; height: 23px; line-height: 21px;">
                        <i class="fas fa-check-double me-1"></i><span>Centang (3/3)</span>
                    </button>
                </div>

                <!-- Modal Body: 3 Item Ceklis Ramping -->
                <div class="modal-body p-2 p-md-3" style="background-color: #f8fafc;">
                    <input type="hidden" id="currentRecordId">

                    <!-- 3 Item Cards Ramping -->
                    <div class="d-flex flex-column gap-2">

                        <!-- ITEM 1: NAMA PRODUK -->
                        <div class="card border rounded-2 p-2 transition-all row-check-card shadow-none mb-0"
                            id="cardCheckProduk" style="background-color: #ffffff; border-color: #e2e8f0; cursor: pointer;">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div class="overflow-hidden flex-grow-1">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="badge"
                                            style="background-color: #fef08a; color: #854d0e; font-size: 10px; font-weight: 700; padding: 2px 6px;">
                                            1. PRODUK (KUNING B)
                                        </span>
                                    </div>
                                    <div class="fw-bold text-dark" id="displayProduk"
                                        style="font-size: 13px; line-height: 1.35; word-break: break-word;">-</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <input class="form-check-input verify-checkbox d-none" type="checkbox" id="checkProduk">
                                    <button type="button"
                                        class="btn btn-outline-secondary btn-sm px-2 py-1 fw-bold d-flex align-items-center gap-1 btn-toggle-check"
                                        data-target="#checkProduk" style="border-radius: 6px; font-size: 12px;">
                                        <i class="far fa-square"></i>
                                        <span>Ceklis</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ITEM 2: SUPPLIER LOT NO -->
                        <div class="card border rounded-2 p-2 transition-all row-check-card shadow-none mb-0"
                            id="cardCheckLotNo" style="background-color: #ffffff; border-color: #e2e8f0; cursor: pointer;">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div class="overflow-hidden flex-grow-1">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="badge"
                                            style="background-color: #fef08a; color: #854d0e; font-size: 10px; font-weight: 700; padding: 2px 6px;">
                                            2. LOT NO (KUNING D)
                                        </span>
                                    </div>
                                    <div class="fw-bold font-monospace text-dark text-break" id="displayLotNo"
                                        style="font-size: 14px;">-</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <input class="form-check-input verify-checkbox d-none" type="checkbox" id="checkLotNo">
                                    <button type="button"
                                        class="btn btn-outline-secondary btn-sm px-2 py-1 fw-bold d-flex align-items-center gap-1 btn-toggle-check"
                                        data-target="#checkLotNo" style="border-radius: 6px; font-size: 12px;">
                                        <i class="far fa-square"></i>
                                        <span>Ceklis</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ITEM 3: BERAT TERTERA -->
                        <div class="card border rounded-2 p-2 transition-all row-check-card shadow-none mb-0"
                            id="cardCheckBerat" style="background-color: #ffffff; border-color: #e2e8f0; cursor: pointer;">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div class="overflow-hidden flex-grow-1">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="badge"
                                            style="background-color: #fef08a; color: #854d0e; font-size: 10px; font-weight: 700; padding: 2px 6px;">
                                            3. BERAT (KUNING H)
                                        </span>
                                    </div>
                                    <div class="fw-bolder font-monospace text-dark" id="displayBerat"
                                        style="font-size: 15px;">-</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <input class="form-check-input verify-checkbox d-none" type="checkbox" id="checkBerat">
                                    <button type="button"
                                        class="btn btn-outline-secondary btn-sm px-2 py-1 fw-bold d-flex align-items-center gap-1 btn-toggle-check"
                                        data-target="#checkBerat" style="border-radius: 6px; font-size: 12px;">
                                        <i class="far fa-square"></i>
                                        <span>Ceklis</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Info Verifikasi sebelumnya jika ada -->
                    <div id="verifiedInfoBox" class="alert alert-light border mt-2 mb-0 py-1 px-2 d-none"
                        style="border-radius: 6px; font-size: 11px; background-color: #ffffff;">
                        <i class="fas fa-user-check text-success me-1"></i>
                        Diverifikasi: <strong id="displayVerifiedBy">-</strong> • <span id="displayVerifiedAt">-</span>
                    </div>
                </div>

                <!-- Modal Footer: 1 Baris Bersisian Hemat Ruang -->
                <div
                    class="modal-footer px-3 py-2 border-top bg-white d-flex gap-2 justify-content-between align-items-center">
                    <button type="button" class="btn btn-light px-3 py-2 fw-semibold text-muted border flex-shrink-0"
                        data-bs-dismiss="modal" style="border-radius: 8px; font-size: 13px;">
                        <i class="fas fa-arrow-left me-1"></i> Tutup
                    </button>
                    <button type="button"
                        class="btn btn-success flex-grow-1 py-2 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm"
                        id="btnSimpanVerifikasi" style="border-radius: 8px; font-size: 14px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Simpan Verifikasi</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        $(document).ready(function () {
            const inputAttr = $('#inputAttribute');
            const formScan = $('#formScanAttribute');
            const selectTgl = $('#selectTanggalInput');
            const modalEl = document.getElementById('modalVerifikasiStiker');
            const modalVerifikasi = new bootstrap.Modal(modalEl);
            let currentItem = null;
            let sessionScanCount = {{ $riwayatVerifikasi->count() }};

            // Inisialisasi Scanner Kamera Inline
            let html5QrCode = null;
            let cameraActive = false;

            $('#btnToggleKamera').on('click', function () {
                if (!cameraActive) {
                    startCameraScanner();
                } else {
                    stopCameraScanner();
                }
            });

            $('#btnTutupKamera').on('click', function () {
                stopCameraScanner();
            });

            function startCameraScanner() {
                if (typeof Html5Qrcode === 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Library Gagal Dimuat',
                        text: 'Library scanner kamera belum termuat sempurna. Periksa koneksi internet Anda.',
                        confirmButtonText: 'Tutup'
                    });
                    return;
                }

                // Tampilkan container card kamera
                $('#cameraScannerCard').removeClass('d-none');
                $('#labelBtnKamera').text('Tutup Kamera Pemindai');
                $('#btnToggleKamera').css('background', '#dc2626');

                if (html5QrCode) {
                    html5QrCode.stop().then(() => {
                        try { html5QrCode.clear(); } catch (e) { }
                        html5QrCode = null;
                        initAndRunScanner();
                    }).catch(() => {
                        try { html5QrCode.clear(); } catch (e) { }
                        html5QrCode = null;
                        initAndRunScanner();
                    });
                } else {
                    initAndRunScanner();
                }
            }

            function initAndRunScanner() {
                const qrBoxConfig = { width: 260, height: 180 };
                const scanConfig = {
                    fps: 15,
                    qrbox: qrBoxConfig,
                    disableFlip: false
                };

                const onScanSuccess = function (decodedText) {
                    const val = String(decodedText || '').trim();
                    if (!val) return;
                    stopCameraScanner();
                    inputAttr.val(val);
                    formScan.submit(); // Otomatis cek attribute stiker
                };

                // Format barcode & QR stiker yang didukung
                let formats = undefined;
                if (typeof Html5QrcodeSupportedFormats !== 'undefined') {
                    formats = [
                        Html5QrcodeSupportedFormats.QR_CODE,
                        Html5QrcodeSupportedFormats.CODE_128,
                        Html5QrcodeSupportedFormats.CODE_39,
                        Html5QrcodeSupportedFormats.DATA_MATRIX,
                        Html5QrcodeSupportedFormats.EAN_13,
                        Html5QrcodeSupportedFormats.UPC_A
                    ];
                }

                html5QrCode = new Html5Qrcode("qr-reader", formats ? { formatsToSupport: formats, verbose: false } : false);

                // Ambil daftar kamera perangkat terlebih dahulu
                Html5Qrcode.getCameras().then(function (cameras) {
                    if (!cameras || cameras.length === 0) {
                        throw new Error("Tidak ada perangkat kamera yang ditemukan.");
                    }

                    // Cari kamera belakang jika ada (untuk HP / Tablet)
                    let selectedCameraId = cameras[0].id;
                    for (let i = 0; i < cameras.length; i++) {
                        const label = (cameras[i].label || '').toLowerCase();
                        if (label.includes('back') || label.includes('belakang') || label.includes('rear') || label.includes('environment')) {
                            selectedCameraId = cameras[i].id;
                            break;
                        }
                    }

                    return html5QrCode.start(selectedCameraId, scanConfig, onScanSuccess, function () { });
                }).then(function () {
                    cameraActive = true;
                }).catch(function (err) {
                    console.warn("Gagal via getCameras, coba fallback facingMode environment:", err);

                    // Fallback kedua: coba langsung facingMode environment
                    if (html5QrCode) {
                        html5QrCode.start(
                            { facingMode: "environment" },
                            scanConfig,
                            onScanSuccess,
                            function () { }
                        ).then(function () {
                            cameraActive = true;
                        }).catch(function (finalErr) {
                            handleCameraError(finalErr || err);
                        });
                    } else {
                        handleCameraError(err);
                    }
                });
            }

            function handleCameraError(err) {
                console.error("Camera Error:", err);
                stopCameraScanner();

                const errStr = (err && err.toString()) ? err.toString().toLowerCase() : '';
                const errName = err && err.name ? err.name : '';
                let pesan = '';

                if (errName === 'NotAllowedError' || errStr.includes('permission') || errStr.includes('denied') || errStr.includes('notallowed')) {
                    pesan = `<strong>Izin kamera terblokir di browser.</strong><br><br>
                    1. Klik ikon <strong>gembok / perizinan</strong> di sebelah kiri address bar (alamat web browser).<br>
                    2. Ubah izin <strong>Kamera</strong> menjadi <strong>Izinkan / Allow</strong>.<br>
                    3. Muat ulang (refresh) halaman ini.`;
                } else if (!window.isSecureContext && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
                    pesan = `<strong>Browser memerlukan koneksi aman (HTTPS).</strong><br><br>
                    Jika diakses dari HP via IP lokal (<code>http://192.168.x.x:8000</code>), browser Chrome/Safari memblokir kamera tanpa HTTPS. Silakan buka melalui <code>localhost</code> di laptop, atau gunakan tunnel HTTPS.`;
                } else {
                    pesan = `Pastikan perangkat Anda memiliki kamera yang aktif dan tidak sedang digunakan oleh aplikasi lain.<br><br><small class="text-muted">Detail error: ${err && err.message ? err.message : err}</small>`;
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Kamera Tidak Dapat Dibuka',
                    html: `<div class="text-start" style="font-size: 14px; line-height: 1.6;">${pesan}</div>`,
                    confirmButtonText: 'Saya Mengerti',
                    customClass: { confirmButton: 'btn btn-primary px-4' },
                    buttonsStyling: false
                });
            }

            function stopCameraScanner() {
                cameraActive = false;
                $('#cameraScannerCard').addClass('d-none');
                $('#labelBtnKamera').text('Buka Kamera Pemindai (HP / Tablet / Webcam)');
                $('#btnToggleKamera').css('background', 'linear-gradient(135deg, #135b9f 0%, #0f4a85 100%)');

                if (html5QrCode) {
                    html5QrCode.stop().then(function () {
                        try { html5QrCode.clear(); } catch (e) { }
                        html5QrCode = null;
                    }).catch(function (err) {
                        console.warn("Camera stop error:", err);
                        try { html5QrCode.clear(); } catch (e) { }
                        html5QrCode = null;
                    });
                }
            }

            inputAttr.focus();

            // Event saat modal ditutup: selalu kembalikan fokus ke input scanner
            $(modalEl).on('hidden.bs.modal', function () {
                inputAttr.val('').focus();
            });

            // Ganti Tanggal Input
            selectTgl.on('change', function () {
                const text = $(this).find('option:selected').text();
                $('#labelActiveTanggal').text(text);
                inputAttr.val('').focus();
            });

            $('#btnClearInput').on('click', function () {
                inputAttr.val('').focus();
            });

            // Form submit check attribute
            formScan.on('submit', function (e) {
                e.preventDefault();
                const attrVal = $.trim(inputAttr.val());
                if (!attrVal) return;

                $('#btnCari').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

                $.ajax({
                    url: "{{ route('verifikasi-stiker.check-attribute') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        attribute: attrVal,
                        tanggal_input: selectTgl.val()
                    },
                    success: function (res) {
                        $('#btnCari').prop('disabled', false).html('<i class="fas fa-search"></i> <span class="d-none d-sm-inline">Cek</span>');
                        if (res.success) {
                            currentItem = res.data;
                            populateModalAndShow(currentItem);
                        }
                    },
                    error: function (xhr) {
                        $('#btnCari').prop('disabled', false).html('<i class="fas fa-search"></i> <span class="d-none d-sm-inline">Cek</span>');
                        const msg = xhr.responseJSON ? xhr.responseJSON.message : 'Attribute tidak ditemukan';
                        Swal.fire({
                            icon: 'error',
                            title: 'Tidak Ditemukan',
                            text: msg,
                            confirmButtonText: 'Tutup',
                            customClass: {
                                confirmButton: 'btn btn-primary px-4'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            inputAttr.select().focus();
                        });
                    }
                });
            });

            function populateModalAndShow(item) {
                $('#currentRecordId').val(item.id);
                $('#displayAttribute').text(item.attribute);
                $('#displayProduk').text(item.produk || '-');
                $('#displayLotNo').text(item.supplier_lot_no || '-');
                $('#displayTglDn').text(item.tgl_dn || '-');
                $('#displayTglInput').text(item.tanggal_input || '-');
                $('#displayBerat').text(item.berat + ' kg');

                // Set status checklist
                $('#checkProduk').prop('checked', item.check_produk);
                $('#checkLotNo').prop('checked', item.check_lot_no);
                $('#checkBerat').prop('checked', item.check_berat);

                updateCheckProgressUI();

                // Status badge di header
                let badgeHtml = '';
                if (item.status_verifikasi === 'sesuai') {
                    badgeHtml = '<span class="badge bg-success px-2 py-1 fw-bold text-nowrap" style="font-size: 10px;"><i class="fas fa-check-circle me-1"></i> SESUAI</span>';
                    $('#verifiedInfoBox').removeClass('d-none');
                    $('#displayVerifiedBy').text(item.verified_by || '-');
                    $('#displayVerifiedAt').text(item.verified_at || '-');
                } else if (item.status_verifikasi === 'tidak_sesuai') {
                    badgeHtml = '<span class="badge bg-danger px-2 py-1 fw-bold text-nowrap" style="font-size: 10px;"><i class="fas fa-times-circle me-1"></i> TIDAK SESUAI</span>';
                    $('#verifiedInfoBox').removeClass('d-none');
                    $('#displayVerifiedBy').text(item.verified_by || '-');
                    $('#displayVerifiedAt').text(item.verified_at || '-');
                } else {
                    badgeHtml = '<span class="badge bg-warning text-dark px-2 py-1 fw-bold text-nowrap" style="font-size: 10px;"><i class="fas fa-clock me-1"></i> BELUM</span>';
                    $('#verifiedInfoBox').addClass('d-none');
                }
                $('#badgeStatusContainer').html(badgeHtml);

                modalVerifikasi.show();
            }

            // Toggle klik card row atau tombol ceklis
            $('.row-check-card').on('click', function (e) {
                if (!$(e.target).closest('.btn-toggle-check').length) {
                    const cb = $(this).find('.verify-checkbox');
                    cb.prop('checked', !cb.prop('checked')).trigger('change');
                }
            });

            $('.btn-toggle-check').on('click', function (e) {
                e.stopPropagation();
                const targetId = $(this).data('target');
                const cb = $(targetId);
                cb.prop('checked', !cb.prop('checked')).trigger('change');
            });

            $('.verify-checkbox').on('change', function () {
                updateCheckProgressUI();
            });

            // Toggle Centang Semua (2 Fungsi: Ceklis Semua / Hapus Semua)
            $('#btnCheckAll').on('click', function () {
                const c1 = $('#checkProduk').is(':checked');
                const c2 = $('#checkLotNo').is(':checked');
                const c3 = $('#checkBerat').is(':checked');
                const allChecked = c1 && c2 && c3;

                // Jika semua sudah tercentang, uncentang semua. Jika belum, centang semua.
                $('#checkProduk, #checkLotNo, #checkBerat').prop('checked', !allChecked);
                updateCheckProgressUI();
            });

            function updateRowCardUI(cardId, isChecked, btnTarget) {
                const card = $(cardId);
                const iconCircle = card.find('.check-icon-circle');
                const btn = $(`button[data-target="${btnTarget}"]`);

                if (isChecked) {
                    card.css({
                        'background-color': '#f0fdf4',
                        'border-color': '#86efac'
                    });
                    btn.removeClass('btn-outline-secondary')
                        .addClass('btn-success')
                        .html('<i class="fas fa-check-square"></i> <span>Sesuai</span>');
                } else {
                    card.css({
                        'background-color': '#ffffff',
                        'border-color': '#e2e8f0'
                    });
                    btn.removeClass('btn-success')
                        .addClass('btn-outline-secondary')
                        .html('<i class="far fa-square"></i> <span>Ceklis</span>');
                }
            }

            function updateCheckProgressUI() {
                const c1 = $('#checkProduk').is(':checked');
                const c2 = $('#checkLotNo').is(':checked');
                const c3 = $('#checkBerat').is(':checked');

                updateRowCardUI('#cardCheckProduk', c1, '#checkProduk');
                updateRowCardUI('#cardCheckLotNo', c2, '#checkLotNo');
                updateRowCardUI('#cardCheckBerat', c3, '#checkBerat');

                const count = (c1 ? 1 : 0) + (c2 ? 1 : 0) + (c3 ? 1 : 0);

                if (count === 3) {
                    $('#btnCheckAll')
                        .removeClass('btn-outline-primary')
                        .addClass('btn-outline-secondary')
                        .html('<i class="fas fa-undo me-1"></i><span>Hapus (0/3)</span>');
                    $('#btnSimpanVerifikasi').removeClass('btn-secondary').addClass('btn-success');
                } else {
                    $('#btnCheckAll')
                        .removeClass('btn-outline-secondary')
                        .addClass('btn-outline-primary')
                        .html('<i class="fas fa-check-double me-1"></i><span>Centang (3/3)</span>');
                }
            }

            // Simpan Verifikasi
            $('#btnSimpanVerifikasi').on('click', function () {
                const c1 = $('#checkProduk').is(':checked');
                const c2 = $('#checkLotNo').is(':checked');
                const c3 = $('#checkBerat').is(':checked');

                if (!c1 || !c2 || !c3) {
                    const count = (c1 ? 1 : 0) + (c2 ? 1 : 0) + (c3 ? 1 : 0);
                    Swal.fire({
                        title: '<span style="font-size: 17px; font-weight: 700; color: #1e293b;">Atribut Belum Lengkap</span>',
                        html: `<div style="font-size: 13px; color: #64748b; line-height: 1.5;">
                                Hanya <strong>${count} dari 3</strong> atribut yang dicentang.<br>
                                Simpan stiker ini dengan status <span class="badge" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 11px; font-weight: 700;">TIDAK SESUAI</span>?
                               </div>`,
                        icon: 'warning',
                        iconColor: '#f59e0b',
                        width: '360px',
                        padding: '1.25rem',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fas fa-save me-1"></i> Ya, Simpan',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        buttonsStyling: false,
                        customClass: {
                            popup: 'rounded-4 shadow border-0',
                            actions: 'd-flex justify-content-center gap-2 w-100 mt-3 pt-2 border-top',
                            cancelButton: 'btn btn-light border text-muted px-3 py-2 fw-semibold flex-fill',
                            confirmButton: 'btn btn-warning text-dark fw-bold px-3 py-2 flex-fill shadow-sm'
                        }
                    }).then((res) => {
                        if (res.isConfirmed) {
                            doSubmitVerification(c1, c2, c3);
                        }
                    });
                    return;
                }

                doSubmitVerification(c1, c2, c3);
            });

            function doSubmitVerification(c1, c2, c3, catatan = '') {
                const recordId = $('#currentRecordId').val();
                if (!recordId) return;

                $('#btnSimpanVerifikasi').prop('disabled', true);

                $.ajax({
                    url: "{{ route('verifikasi-stiker.verify') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: recordId,
                        check_produk: c1 ? 1 : 0,
                        check_lot_no: c2 ? 1 : 0,
                        check_berat: c3 ? 1 : 0,
                        catatan: catatan
                    },
                    success: function (res) {
                        $('#btnSimpanVerifikasi').prop('disabled', false);
                        if (res.success) {
                            modalVerifikasi.hide();

                            const isSesuai = res.status === 'sesuai';
                            Swal.fire({
                                icon: isSesuai ? 'success' : 'warning',
                                title: isSesuai ? 'Verifikasi Sesuai' : 'Verifikasi Tidak Sesuai',
                                text: res.message,
                                timer: isSesuai ? 1400 : 3500,
                                showConfirmButton: !isSesuai,
                                confirmButtonText: 'OK, Lanjut Scan',
                                width: '360px',
                                customClass: {
                                    popup: 'rounded-4 shadow border-0',
                                    confirmButton: 'btn btn-primary px-3 py-1'
                                },
                                buttonsStyling: false
                            });

                            currentItem.check_produk = c1;
                            currentItem.check_lot_no = c2;
                            currentItem.check_berat = c3;
                            currentItem.status_verifikasi = res.status;

                            appendSessionScan(currentItem, c1, c2, c3, res.status);
                        }
                    },
                    error: function () {
                        $('#btnSimpanVerifikasi').prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menyimpan verifikasi.',
                            confirmButtonText: 'Tutup',
                            width: '320px',
                            customClass: {
                                popup: 'rounded-4 shadow border-0',
                                confirmButton: 'btn btn-secondary px-4'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }

            function appendSessionScan(item, c1, c2, c3, status) {
                $('#rowEmptySession').remove();

                const now = new Date();
                const timeStr = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                const dateStr = (now.getDate() < 10 ? '0' : '') + now.getDate() + '/' + ((now.getMonth() + 1) < 10 ? '0' : '') + (now.getMonth() + 1);

                const count = (c1 ? 1 : 0) + (c2 ? 1 : 0) + (c3 ? 1 : 0);
                const checksBadge = count === 3
                    ? '<span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11px;">3/3 Cek</span>'
                    : `<span class="badge" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11px;">${count}/3 Cek</span>`;

                const statusBadge = status === 'sesuai'
                    ? '<span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 700;"><i class="fas fa-check-circle me-1"></i> SESUAI</span>'
                    : '<span class="badge" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 11px; font-weight: 700;"><i class="fas fa-times-circle me-1"></i> TIDAK SESUAI</span>';

                const rowHtml = `
                    <tr id="session-row-${item.id}" class="row-riwayat-item" data-attribute="${item.attribute}" style="cursor: pointer;" title="Klik untuk cek ulang / lihat detail">
                        <td class="ps-4 font-monospace" style="font-size: 13px;">
                            <div class="fw-semibold text-dark">${timeStr}</div>
                            <small class="text-muted" style="font-size: 10px;">${dateStr}</small>
                        </td>
                        <td><span class="badge bg-light text-dark border font-monospace" style="font-size: 12px; letter-spacing: 0.3px;">${item.attribute}</span></td>
                        <td>${statusBadge}</td>
                        <td class="fw-semibold text-dark" style="font-size: 13px;">${item.produk}</td>
                        <td><span class="badge bg-light text-dark border font-monospace" style="font-size: 12px;">${item.supplier_lot_no}</span></td>
                        <td class="text-end fw-bold font-monospace" style="font-size: 13px;">${item.berat} kg</td>
                        <td class="text-center pe-4">${checksBadge}</td>
                    </tr>
                `;

                const existingRow = $(`#session-row-${item.id}`);
                if (existingRow.length > 0) {
                    existingRow.replaceWith(rowHtml);
                } else {
                    sessionScanCount++;
                    $('#badgeSessionCount').text(sessionScanCount + ' Data');
                    $('#tbodySessionScans').prepend(rowHtml);
                }
            }

            // Klik baris riwayat untuk langsung membuka detail/verifikasi ulang
            $(document).on('click', '.row-riwayat-item', function () {
                const attr = $(this).data('attribute');
                if (attr) {
                    inputAttr.val(attr);
                    formScan.trigger('submit');
                }
            });
        });
    </script>
@endpush