@extends('break_bulk.layout.V_template')

@section('title', 'Setting Break Bulk')

@push('css')
<style>
    .badge-chip-scan {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--bs-font-monospace);
        font-weight: 700;
        font-size: 13px;
        color: #135b9f;
        background-color: rgba(19, 91, 159, 0.08);
        border: 1px solid rgba(19, 91, 159, 0.2);
        padding: 4px 10px;
        border-radius: 6px;
    }
    .modal-dialog-scrollable .modal-body {
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch !important;
        overscroll-behavior: contain !important;
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
    #qr-reader {
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #135b9f !important;
    }
    #qr-reader video {
        border-radius: 10px;
        object-fit: cover;
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
                        <i class="fas fa-dolly-flatbed text-primary me-2"></i>Setting Break Bulk
                    </h4>
                    <div class="text-muted" style="font-size: 13px;">
                        Home <span class="mx-1">/</span> Modul <span class="mx-1">/</span> <span class="text-primary fw-semibold">Setting Break Bulk</span>
                    </div>
                </div>
                <div class="w-100 w-sm-auto">
                    <button type="button" class="btn btn-primary w-100 w-sm-auto d-flex align-items-center justify-content-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalScanBreakBulk" style="border-radius: 10px; font-weight: 600; padding: 10px 22px;">
                        <i class="fas fa-barcode fs-5"></i>
                        <span>Scan Koil Break Bulk</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil Scan -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px;">
        <div class="card-header bg-white py-3 px-3 px-md-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-radius: 14px 14px 0 0;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(22, 163, 74, 0.1); color: #16a34a;">
                    <i class="fas fa-list-check fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0 fs-6 fs-md-5">Tabel Hasil Scan Break Bulk</h5>
                    <small class="text-muted d-none d-sm-block">Data material yang telah berhasil diverifikasi dan disimpan</small>
                </div>
            </div>
            @if($totalScans > 0)
            <div class="d-flex align-items-center gap-2 ms-auto ms-sm-0">
                <span class="badge bg-light text-primary border border-primary-subtle px-2 px-md-3 py-2 fw-semibold" style="border-radius: 8px;">
                    <i class="fas fa-check-double me-1"></i> {{ number_format($totalScans) }} Discan ({{ number_format($totalWeightScanned / 1000, 2) }} Ton)
                </span>
                <form id="resetAllScanForm" action="{{ route('break-bulk.scan.destroy-all') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" style="border-radius: 8px; font-weight: 600; padding: 6px 12px;" onclick="confirmResetScan()">
                        <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Reset Sesi</span>
                    </button>
                </form>
            </div>
            @endif
        </div>

        <div class="card-body p-3 p-md-4">
            @if($totalScans > 0)
                <!-- Search Toolbar untuk Mobile & Desktop -->
                <div class="row align-items-center mb-3 g-2">
                    <div class="col-12 col-md-5 col-lg-4">
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <span class="input-group-text bg-white border-end-0 pe-2" style="border-color: #cbd5e1;">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 custom-dt-search ps-1" placeholder="Cari atribut, trailer, produk..." style="border-color: #cbd5e1; font-size: 14px; padding: 9px 12px;">
                        </div>
                    </div>
                </div>

                <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                    <table class="table table-hover align-middle mb-0 text-nowrap" id="dataTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 170px;">ATRIBUT</th>
                                <th style="width: 130px;">TRAILER</th>
                                <th class="text-end" style="width: 130px;">WEIGHT</th>
                                <th>PRODUK</th>
                                <th style="width: 140px;">GROUPING</th>
                                <th style="width: 140px;">POD</th>
                                <th style="width: 140px;">NO SO</th>
                                <th style="width: 110px;">LOKASI</th>
                                <th class="text-center" style="width: 80px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scans as $row)
                            <tr>
                                <td>
                                    <span class="badge-chip-scan">
                                        <i class="fas fa-barcode"></i>{{ $row->atribut }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold font-monospace text-dark">{{ $row->trailer }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-dark font-monospace">{{ number_format($row->weight, 2, ',', '.') }}</span>
                                    <small class="text-muted">kg</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $row->product }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-primary border border-primary-subtle px-2 py-1 fw-semibold">{{ $row->grouping }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 font-monospace fw-semibold">{{ $row->pod }}</span>
                                </td>
                                <td>
                                    @if(!empty($row->no_so))
                                        <span class="badge bg-light text-secondary border px-2 py-1 font-monospace fw-semibold">{{ $row->no_so }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2 py-1 font-monospace fw-bold">{{ $row->lokasi }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-icons">
                                        <form id="deleteScanForm{{ $row->id }}" action="{{ route('break-bulk.scan.destroy', $row->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon-btn delete-button" title="Hapus Baris Scan" onclick="confirmDeleteScan('{{ $row->id }}', '{{ $row->atribut }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Kondisi Kosong Awal -->
                <div class="text-center py-5 my-3">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 76px; height: 76px; background-color: rgba(19, 91, 159, 0.08); color: #135b9f;">
                            <i class="fas fa-barcode fs-2"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Tabel Scan Masih Kosong</h5>
                    <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto; font-size: 14px;">
                        Belum ada koil yang discan pada sesi ini. Klik tombol di bawah untuk mulai memindai barcode.
                    </p>
                    <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalScanBreakBulk" style="border-radius: 10px; font-weight: 600; padding: 10px 24px;">
                        <i class="fas fa-barcode fs-5"></i>
                        <span>Buka Popup Scan Koil</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Popup Form Pemindaian Barcode (Mobile-Friendly) -->
<div class="modal fade" id="modalScanBreakBulk" tabindex="-1" aria-labelledby="modalScanBreakBulkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <form action="{{ route('break-bulk.scan.store') }}" method="POST" id="formScanModal" class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.22); max-height: calc(100vh - 3.5rem); display: flex; flex-direction: column;">
            @csrf
            <div class="modal-header border-bottom py-3 px-3 px-md-4 flex-shrink-0">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-qrcode text-primary fs-4"></i>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0 fs-6 fs-md-5" id="modalScanBreakBulkLabel">Form Pemindaian Barcode</h5>
                        <small class="text-muted" id="modalSubTitle">Scan barcode fisik atau input manual</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-3 p-md-4 flex-grow-1" style="overflow-y: auto; -webkit-overflow-scrolling: touch; overscroll-behavior: contain;">
                <!-- Status Lookup Barcode -->
                <div id="lookupStatusBadge" class="alert alert-light border d-flex align-items-center gap-2 py-2 px-3 mb-3" style="border-radius: 10px; font-size: 13px;">
                    <i class="fas fa-keyboard text-muted"></i>
                    <span id="lookupStatusText" class="text-muted">Siap scan atau ketik nomor atribut barcode...</span>
                </div>

                    <!-- Kamera Scanner Viewport (Toggleable) -->
                    <div id="cameraScannerCard" class="card border border-2 border-primary mb-3 shadow-sm d-none" style="border-radius: 14px; overflow: hidden; background-color: #0f172a;">
                        <div class="card-header bg-dark text-white px-3 py-2 d-flex justify-content-between align-items-center border-0">
                            <span class="small fw-bold text-white d-flex align-items-center gap-2">
                                <i class="fas fa-circle text-danger fa-pulse"></i> Kamera Pemindai Aktif
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-light py-1 px-3 fw-semibold" id="btnTutupKamera">
                                <i class="fas fa-times me-1"></i> Tutup Kamera
                            </button>
                        </div>
                        <div class="card-body p-2 text-center">
                            <div id="qr-reader" style="width: 100%; max-width: 420px; margin: 0 auto; min-height: 180px; background-color: #000;"></div>
                            <div class="text-white-50 small mt-2">
                                <i class="fas fa-info-circle text-warning me-1"></i> Arahkan kamera HP ke barcode fisik koil.
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 g-md-3">
                        <!-- 1. ATRIBUT + TOMBOL KAMERA -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                ATRIBUT <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-primary border-end-0">
                                    <i class="fas fa-barcode"></i>
                                </span>
                                <input type="text" name="atribut" id="inputAtribut" class="form-control font-monospace fw-bold" placeholder="Scan barcode..." autofocus required autocomplete="off" style="border-color: #cbd5e1; height: 44px;">
                                <button type="button" id="btnToggleKamera" class="btn btn-outline-primary d-flex align-items-center gap-1 px-3" title="Scan menggunakan kamera HP / Webcam">
                                    <i class="fas fa-camera"></i>
                                    <span class="d-none d-sm-inline">Kamera</span>
                                </button>
                            </div>
                        </div>

                        <!-- 2. TRAILER -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                TRAILER <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="trailer" id="inputTrailer" class="form-control font-monospace" placeholder="Nomor Trailer / Truk (Angka)" required inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="border-radius: 8px; height: 44px;">
                        </div>

                        <!-- 3. WEIGHT (Otomatis) -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                WEIGHT (KG) <span class="badge bg-light text-primary border px-1">Otomatis</span>
                            </label>
                            <input type="number" step="0.01" name="weight" id="inputWeight" class="form-control bg-light fw-bold text-end" placeholder="0.00" readonly required style="border-radius: 8px; height: 44px;">
                        </div>

                        <!-- 4. PRODUK (Otomatis) -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                PRODUK <span class="badge bg-light text-primary border px-1">Otomatis</span>
                            </label>
                            <input type="text" name="product" id="inputProduct" class="form-control bg-light fw-semibold" placeholder="Nama Produk" readonly required style="border-radius: 8px; height: 44px;">
                        </div>

                        <!-- 5. GROUPING -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                GROUPING <span class="text-danger">*</span>
                            </label>
                            <select name="grouping" id="selectGrouping" class="form-select" required style="border-radius: 8px; height: 44px;">
                                <option value="">-- Pilih Grouping --</option>
                                @foreach($groupingOptions as $grp)
                                    <option value="{{ $grp }}">{{ $grp }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 6. POD (Pelabuhan) -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                POD (Tujuan) <span class="text-danger">*</span>
                            </label>
                            <select name="pod" id="selectPod" class="form-select" required style="border-radius: 8px; height: 44px;">
                                <option value="">-- Pilih Pelabuhan --</option>
                                @foreach($podOptions as $pod)
                                    <option value="{{ $pod }}">{{ $pod }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 7. NO SO (Auto / Manual) -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                NO SO <span class="badge bg-light text-muted border px-1">Auto / Manual</span>
                            </label>
                            <input type="text" name="no_so" id="inputNoSo" class="form-control font-monospace" placeholder="Nomor SO (Opsional)" style="border-radius: 8px; height: 44px;">
                        </div>

                        <!-- 8. LOKASI -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1">
                                LOKASI <span class="text-danger">*</span>
                            </label>
                            <select name="lokasi" id="selectLokasi" class="form-select" required style="border-radius: 8px; height: 44px;">
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach($lokasiOptions as $lok)
                                    <option value="{{ $lok }}">{{ $lok }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top py-3 px-3 px-md-4 d-flex justify-content-between align-items-center flex-wrap gap-2 flex-shrink-0">
                    <button type="reset" class="btn btn-light" id="btnResetModalForm" style="border-radius: 8px;">
                        Bersihkan
                    </button>
                    <div class="d-flex gap-2 ms-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Tutup</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2" id="btnSubmitScan" style="border-radius: 8px; font-weight: 600; padding: 8px 24px;">
                            <i class="fas fa-check"></i>
                            <span>Simpan Scan</span>
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- Library HTML5-QRCode Scanner -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputAtribut = document.getElementById('inputAtribut');
        const inputWeight = document.getElementById('inputWeight');
        const inputProduct = document.getElementById('inputProduct');
        const inputNoSo = document.getElementById('inputNoSo');
        const statusBadge = document.getElementById('lookupStatusBadge');
        const statusText = document.getElementById('lookupStatusText');
        const modalEl = document.getElementById('modalScanBreakBulk');

        let html5QrCode = null;
        let isCameraActive = false;
        let timeout = null;

        // Auto-focus input saat modal dibuka
        modalEl.addEventListener('shown.bs.modal', function () {
            inputAtribut.focus();
        });

        // Hentikan kamera saat modal ditutup
        modalEl.addEventListener('hidden.bs.modal', function () {
            stopCameraScanner();
        });

        // Lookup AJAX Atribut
        function lookupAtribut(val) {
            const cleanVal = val.trim();
            if (!cleanVal) {
                resetAutoFields();
                setStatus('ready', '<i class="fas fa-keyboard text-muted"></i>', 'Siap scan atau ketik nomor atribut barcode...');
                return;
            }

            setStatus('loading', '<i class="fas fa-spinner fa-spin text-primary"></i>', 'Mengecek data di sistem...');

            fetch(`{{ url('/break-bulk/cek-atribut') }}/${encodeURIComponent(cleanVal)}`)
                .then(res => res.json())
                .then(res => {
                    if (res.exists) {
                        inputWeight.value = res.data.weight;
                        inputProduct.value = res.data.product;

                        if (res.data.no_so) {
                            inputNoSo.value = res.data.no_so;
                            inputNoSo.readOnly = true;
                            inputNoSo.classList.add('bg-light');
                        } else {
                            inputNoSo.value = '';
                            inputNoSo.readOnly = false;
                            inputNoSo.classList.remove('bg-light');
                        }

                        if (res.already_scanned) {
                            setStatus('warning', '<i class="fas fa-exclamation-triangle text-warning"></i>', 'Peringatan: Atribut ini sudah pernah discan sebelumnya!');
                        } else {
                            setStatus('success', '<i class="fas fa-check-circle text-success"></i>', `Data Cocok: ${res.data.product} (${res.data.weight} kg)`);
                        }
                    } else {
                        resetAutoFields();
                        setStatus('danger', '<i class="fas fa-times-circle text-danger"></i>', 'Atribut tidak ditemukan di tabel Tambah Data!');
                    }
                })
                .catch(() => {
                    setStatus('danger', '<i class="fas fa-exclamation-circle text-danger"></i>', 'Koneksi lookup gagal.');
                });
        }

        function setStatus(type, icon, text) {
            statusBadge.className = 'alert d-flex align-items-center gap-2 py-2 px-3 mb-3 ';
            if (type === 'success') {
                statusBadge.classList.add('alert-success', 'border-success');
            } else if (type === 'warning') {
                statusBadge.classList.add('alert-warning', 'border-warning');
            } else if (type === 'danger') {
                statusBadge.classList.add('alert-danger', 'border-danger');
            } else {
                statusBadge.classList.add('alert-light', 'border');
            }
            statusBadge.innerHTML = `${icon} <span class="fw-medium">${text}</span>`;
        }

        function resetAutoFields() {
            inputWeight.value = '';
            inputProduct.value = '';
            inputNoSo.value = '';
            inputNoSo.readOnly = false;
            inputNoSo.classList.remove('bg-light');
        }

        inputAtribut.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                lookupAtribut(this.value);
            }, 300);
        });

        document.getElementById('btnResetModalForm').addEventListener('click', function() {
            setTimeout(() => {
                resetAutoFields();
                setStatus('ready', '<i class="fas fa-keyboard text-muted"></i>', 'Siap scan atau ketik nomor atribut barcode...');
                inputAtribut.focus();
            }, 50);
        });

        // Kontrol Kamera Pemindai (HTML5-QRCode)
        const btnToggleKamera = document.getElementById('btnToggleKamera');
        const btnTutupKamera = document.getElementById('btnTutupKamera');
        const cameraCard = document.getElementById('cameraScannerCard');

        btnToggleKamera.addEventListener('click', function() {
            if (!isCameraActive) {
                startCameraScanner();
            } else {
                stopCameraScanner();
            }
        });

        btnTutupKamera.addEventListener('click', function() {
            stopCameraScanner();
        });

        function startCameraScanner() {
            if (typeof Html5Qrcode === 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Kamera',
                    text: 'Library scanner kamera belum termuat. Periksa koneksi internet.'
                });
                return;
            }

            cameraCard.classList.remove('d-none');
            btnToggleKamera.classList.replace('btn-outline-primary', 'btn-danger');
            btnToggleKamera.innerHTML = '<i class="fas fa-times"></i> <span class="d-none d-sm-inline">Tutup</span>';
            isCameraActive = true;

            html5QrCode = new Html5Qrcode("qr-reader");
            const config = { fps: 15, qrbox: { width: 280, height: 160 } };

            html5QrCode.start(
                { facingMode: "environment" }, // Kamera belakang HP
                config,
                (decodedText) => {
                    // Berhasil scan barcode
                    inputAtribut.value = decodedText;
                    lookupAtribut(decodedText);
                    stopCameraScanner();

                    // Suara Beep singkat / Haptic jika didukung
                    if (navigator.vibrate) {
                        navigator.vibrate(100);
                    }
                },
                (errorMessage) => {
                    // Abaikan frame tanpa barcode
                }
            ).catch(err => {
                cameraCard.classList.add('d-none');
                btnToggleKamera.classList.replace('btn-danger', 'btn-outline-primary');
                btnToggleKamera.innerHTML = '<i class="fas fa-camera"></i> <span class="d-none d-sm-inline">Kamera</span>';
                isCameraActive = false;
                Swal.fire({
                    icon: 'warning',
                    title: 'Izin Kamera Diperlukan',
                    text: 'Pastikan izin kamera telah diberikan di browser perangkat Anda.'
                });
            });
        }

        function stopCameraScanner() {
            if (html5QrCode && isCameraActive) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    html5QrCode = null;
                }).catch(() => {
                    html5QrCode = null;
                });
            }
            cameraCard.classList.add('d-none');
            btnToggleKamera.classList.replace('btn-danger', 'btn-outline-primary');
            btnToggleKamera.innerHTML = '<i class="fas fa-camera"></i> <span class="d-none d-sm-inline">Kamera</span>';
            isCameraActive = false;
        }
    });

    function confirmDeleteScan(id, atribut) {
        window.showCustomConfirm({
            iconClass: 'fas fa-trash-alt',
            title: 'Batalkan Scan?',
            text: `Data hasil scan atribut <strong>${atribut}</strong> akan dihapus dan status koil dikembalikan ke pending.`,
            confirmText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteScanForm' + id).submit();
            }
        });
    }

    function confirmResetScan() {
        window.showCustomConfirm({
            iconClass: 'fas fa-exclamation-triangle',
            title: 'Reset Sesi Scan?',
            text: 'Seluruh riwayat hasil scan pada tabel ini akan dikosongkan kembali.',
            confirmText: 'Ya, Reset Sesi'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('resetAllScanForm').submit();
            }
        });
    }
</script>
@endpush
