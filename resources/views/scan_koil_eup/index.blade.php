@extends('verifikasi_timbangan.layout.V_template')

@section('title', 'Scan Koil EUP')

@section('content')
<style>
    /* Menyesuaikan dengan gaya DataTables standar / clean UI */
    .table-clean {
        border-collapse: collapse;
    }
    .table-clean thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 13px;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
        vertical-align: middle;
        padding: 16px 12px;
        white-space: nowrap;
    }
    .table-clean tbody td {
        vertical-align: middle;
        font-size: 13.5px;
        color: #64748b;
        padding: 16px 12px;
        border-bottom: 1px solid #f1f5f9;
        background-color: #ffffff;
    }
    .table-clean tbody tr:hover td {
        background-color: #f8fafc;
    }
    .action-icon {
        background: transparent;
        border: none;
        padding: 4px 6px;
        font-size: 16px;
        transition: transform 0.2s;
    }
    .action-icon:hover {
        transform: scale(1.1);
    }
    
    /* Pagination Styling */
    .pagination-clean .pagination {
        margin-bottom: 0;
    }
    .pagination-clean .page-link {
        color: #475569;
        border: 1px solid #e2e8f0;
        margin: 0 2px;
        border-radius: 4px;
        font-size: 13.5px;
        padding: 6px 12px;
    }
    .pagination-clean .page-item.active .page-link {
        background-color: #135b9f;
        border-color: #135b9f;
        color: #ffffff;
    }
    .pagination-clean .page-link:hover {
        background-color: #f1f5f9;
        color: #1e293b;
    }
    
    /* Tabs Styling */
    .nav-tabs-custom {
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 0;
    }
    .nav-tabs-custom .nav-link {
        border: none;
        color: #64748b;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 24px;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
    }
    .nav-tabs-custom .nav-link:hover {
        color: #135b9f;
        border-color: transparent;
    }
    .nav-tabs-custom .nav-link.active {
        color: #135b9f;
        border-bottom: 2px solid #135b9f;
        background-color: transparent;
    }

    /* Scan Option Cards & Pulse Animation */
    .scan-option-card {
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        background: #ffffff;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .scan-option-card:hover {
        border-color: #135b9f !important;
        background-color: #f8fafc !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(19, 91, 159, 0.08);
    }
    @keyframes blinkLaser {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.25; }
    }
    .blink-laser {
        animation: blinkLaser 1.2s infinite;
    }
    @keyframes pulseRing {
        0% { transform: scale(0.9); opacity: 0.8; }
        100% { transform: scale(1.4); opacity: 0; }
    }
    .pulse-ring-laser {
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        border: 2px solid #ef4444;
        border-radius: 50%;
        animation: pulseRing 1.5s infinite;
    }
</style>

<style>
    /* Responsive Tabs */
    .tabs-container {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 1.25rem;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        width: 100%;
    }
    .tabs-container::-webkit-scrollbar {
        height: 4px;
    }
    .tabs-container::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 4px;
    }
    .tabs-container .nav-tabs {
        border-bottom: none;
        flex-wrap: nowrap;
        display: flex;
        width: max-content;
    }
    .tabs-container .nav-item {
        flex: 0 0 auto;
    }
    .tabs-container .nav-link {
        margin-bottom: -1px;
    }
    
    /* Table Responsive Enhancements */
    .table-responsive th, .table-responsive td {
        white-space: nowrap;
    }
    
    /* Mobile Header */
    @media (max-width: 576px) {
        .card-header-mobile {
            flex-direction: column !important;
            align-items: flex-start !important;
        }
        .card-header-mobile .button-group-mobile {
            width: 100%;
        }
        .card-header-mobile .button-group-mobile > a, 
        .card-header-mobile .button-group-mobile > button {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid p-0">
    
    <div class="card border-0 shadow-sm" style="border-radius: 8px;">
        <!-- Card Header -->
        <div class="card-header bg-white border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3 card-header-mobile" style="padding: 20px 24px;">
            <h5 class="mb-0 text-dark font-weight-bold" style="font-size: 18px; letter-spacing: 0.3px;">Manajemen Scan Koil EUP</h5>
            <div class="d-flex flex-wrap gap-2 button-group-mobile">
                <a href="{{ route('scan-koil-eup.export') }}" class="btn btn-success shadow-sm d-flex align-items-center gap-2" style="background-color: #107c41; border: none; font-weight: 500; padding: 8px 16px; border-radius: 6px;">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                <button type="button" class="btn btn-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #135b9f; border: none; font-weight: 500; padding: 8px 16px; border-radius: 6px;">
                    <i class="fas fa-plus"></i> Input Data
                </button>
            </div>
        </div>
        
        <!-- Navigation Tabs -->
        <div class="card-body p-0">
            <div class="tabs-container px-4 pt-3">
                <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 flex-nowrap" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="input-tab" data-bs-toggle="tab" data-bs-target="#input-pane" type="button" role="tab" aria-controls="input-pane" aria-selected="true">
                            <i class="fas fa-list-ul me-1"></i> Data Scan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tonase-tab" data-bs-toggle="tab" data-bs-target="#tonase-pane" type="button" role="tab" aria-controls="tonase-pane" aria-selected="false">
                            <i class="fas fa-weight-hanging me-1"></i> Tonase per Layout
                        </button>
                    </li>
                    
                    <!-- Tombol Kelola dengan tampilan seperti tab -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#modalKelolaLayout">
                            <i class="fas fa-boxes me-1"></i> Kelola Layout
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#modalKelolaPalet">
                            <i class="fas fa-pallet me-1"></i> Kelola Palet
                        </button>
                    </li>
                </ul>
            </div>
            
            <div class="tab-content" id="myTabContent">
                
                <!-- TAB: INPUT DATA -->
                <div class="tab-pane fade show active" id="input-pane" role="tabpanel" aria-labelledby="input-tab">
                    <div class="table-responsive">
                        <table class="table table-clean w-100 mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th>NO COIL EUP</th>
                                    <th>TIMESTAMP</th>
                                    <th>PALET</th>
                                    <th>LAYOUT PENGIRIMAN</th>
                                    <th>BERAT</th>
                                    <th>KETERANGAN</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $row)
                                <tr>
                                    <td class="text-center">{{ $data->firstItem() + $index }}</td>
                                    <td><span class="fw-bold text-dark">{{ $row->no_coil_eup }}</span></td>
                                    <td>{{ $row->created_at->format('d/m/Y, H:i:s') }}</td>
                                    <td>{{ $row->palet ? $row->palet->nama_palet : '-' }}</td>
                                    <td>{{ $row->layout->nama_layout }}</td>
                                    <td>{{ number_format($row->berat, 2, ',', '.') }}</td>
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('scan-koil-eup.destroy', $row->id) }}" method="POST" class="delete-form" data-text="Data scan ini akan dihapus permanen.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-icon text-danger" title="Hapus Data">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada data scan koil EUP.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($data->hasPages())
                    <div class="px-4 py-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-center bg-white" style="border-radius: 0 0 8px 8px;">
                        <div class="text-muted mb-3 mb-md-0" style="font-size: 13.5px;">
                            Menampilkan <strong>{{ $data->firstItem() ?? 0 }}</strong> sampai <strong>{{ $data->lastItem() ?? 0 }}</strong> dari <strong>{{ $data->total() }}</strong> data
                        </div>
                        <div class="pagination-clean">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- TAB: TONASE -->
                <div class="tab-pane fade" id="tonase-pane" role="tabpanel" aria-labelledby="tonase-tab">
                    <div class="table-responsive">
                        <table class="table table-clean w-100 mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th>LAYOUT PENGIRIMAN</th>
                                    <th>TOTAL TONASE (BERAT)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tonase as $index => $t)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><span class="fw-bold">{{ $t->nama_layout }}</span></td>
                                    <td>{{ number_format($t->total_berat, 2, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data layout.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data / Scan Baru -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true" style="text-align: left;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h6 class="modal-title fw-bold" style="color: #1e293b; font-size: 16px;">Input Data Scan Koil EUP</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-scan-koil" action="{{ route('scan-koil-eup.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">TimeStamp</label>
                            <input type="text" class="form-control bg-light text-muted" value="{{ date('d/m/Y, H:i:s') }}" readonly style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1; cursor: not-allowed;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">No Coil EUP <span class="text-primary">*</span></label>
                            <div class="input-group">
                                <input type="text" id="no_coil_eup" name="no_coil_eup" class="form-control" required placeholder="Scan atau Ketik..." style="font-size: 14px; border-radius: 6px 0 0 6px; padding: 10px 12px; border: 1px solid #cbd5e1; border-right: none;" autofocus>
                                <button type="button" id="btn-scan" class="input-group-text bg-white text-primary" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; cursor: pointer;" title="Scan Barcode/QR">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                            </div>
                            <div id="qr-reader" style="width: 100%; display: none; margin-top: 10px; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1;"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Palet</label>
                                <select name="palet_id" class="form-select" style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;">
                                    <option value="">-- Pilih Palet --</option>
                                    @foreach($palets as $palet)
                                        <option value="{{ $palet->id }}">{{ $palet->nama_palet }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Layout Pengiriman <span class="text-primary">*</span></label>
                                <select name="layout_id" class="form-select" required style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;">
                                    <option value="">-- Pilih Layout --</option>
                                    @foreach($layouts as $layout)
                                        <option value="{{ $layout->id }}">{{ $layout->nama_layout }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Berat (kg) <span class="text-primary">*</span></label>
                        <div class="input-group">
                            <input type="number" step="any" id="berat" name="berat" class="form-control" required placeholder="0" style="font-size: 14px; border-radius: 6px 0 0 6px; padding: 10px 12px; border: 1px solid #cbd5e1; border-right: none;">
                            <button type="button" id="btn-scan-berat" class="input-group-text bg-white text-primary" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; cursor: pointer;" title="Scan Barcode/QR">
                                <i class="fas fa-qrcode"></i>
                            </button>
                        </div>
                        <div id="qr-reader-berat" style="width: 100%; display: none; margin-top: 10px; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1;"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Opsional..." style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;"></textarea>
                    </div>

                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 pt-1">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 16px;">Batal</button>
                    <button type="submit" id="btn-submit-scan" class="btn btn-primary" style="background-color: #135b9f; border-color: #135b9f; font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 20px;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pilihan Metode Scan: Kamera vs Zebra Infrared -->
<div class="modal fade" id="modalPilihMetodeScan" tabindex="-1" aria-hidden="true" style="text-align: left; z-index: 1065;">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 440px;">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom-0 pb-1 pt-4 px-4">
                <div>
                    <h6 class="modal-title fw-bold text-dark mb-0" style="font-size: 16px;">Pilih Metode Scan Barcode</h6>
                    <small class="text-muted" style="font-size: 12px;">Pilih metode pembacaan barcode untuk form</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <!-- Input Sink Tersembunyi untuk Menangkap Keystroke Zebra Saat Modal Terbuka -->
                <input type="text" id="zebra-hidden-scanner-sink" style="position: absolute; opacity: 0; pointer-events: none; left: -9999px; width: 1px; height: 1px;" autocomplete="off">

                <!-- Pilihan Target Field: No Coil EUP vs Berat -->
                <div class="mb-3 p-2 bg-light rounded-3 d-flex align-items-center justify-content-between border">
                    <span class="text-secondary fw-bold" style="font-size: 12px;"><i class="fas fa-crosshairs me-1 text-primary"></i> Target Input:</span>
                    <div class="btn-group btn-group-sm" role="group" id="btn-group-target-scan">
                        <button type="button" class="btn btn-primary btn-target-select active" data-target="no_coil_eup" id="btn-target-coil" style="font-size: 11.5px; font-weight: 600; padding: 4px 10px;">
                            <i class="fas fa-barcode me-1"></i> No Coil
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-target-select" data-target="berat" id="btn-target-berat" style="font-size: 11.5px; font-weight: 600; padding: 4px 10px;">
                            <i class="fas fa-weight me-1"></i> Berat
                        </button>
                    </div>
                </div>

                <!-- State 1: Pilihan Metode -->
                <div id="scan-method-selection">
                    <div class="d-flex flex-column gap-3">
                        <!-- Opsi 1: Zebra TC22R Infrared / Pelatuk -->
                        <div class="scan-option-card p-3" id="opt-scan-zebra" role="button">
                            <div class="d-flex align-items-start gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3 text-danger flex-shrink-0" style="width: 48px; height: 48px; background-color: #fef2f2;">
                                    <i class="fas fa-barcode fs-4"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 14px;">Scanner Fisik Zebra TC22</h6>
                                        <span class="badge bg-danger text-white" style="font-size: 10px; border-radius: 4px;">Hardware</span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 12px; line-height: 1.4;">
                                        Tarik <strong>pelatuk fisik (BUTTON_L1)</strong> sekarang. Data hasil scan akan langsung masuk otomatis ke target input yang dipilih di atas.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Opsi 2: Kamera Perangkat -->
                        <div class="scan-option-card p-3" id="opt-scan-camera" role="button">
                            <div class="d-flex align-items-start gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3 text-primary flex-shrink-0" style="width: 48px; height: 48px; background-color: #eff6ff;">
                                    <i class="fas fa-camera fs-4"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 14px;">Kamera Layar</h6>
                                        <span class="badge bg-primary text-white" style="font-size: 10px; border-radius: 4px;">Webcam</span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 12px; line-height: 1.4;">
                                        Buka kamera internal perangkat untuk membaca barcode/QR melalui tangkapan video.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- State 2: Menunggu Tembakan Zebra -->
                <div id="scan-zebra-waiting" style="display: none;" class="text-center py-3">
                    <div class="mb-3 position-relative d-inline-block">
                        <div class="pulse-ring-laser"></div>
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger text-white mx-auto shadow" style="width: 68px; height: 68px;">
                            <i class="fas fa-barcode fs-2"></i>
                        </div>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Siap Scan Sinar Zebra</h6>
                    <p class="text-muted mb-3" style="font-size: 12.5px;">Arahkan moncong Zebra dan <strong>tekan pelatuk fisik</strong> sekarang...</p>
                    <div class="p-2 rounded bg-light border text-danger font-monospace mb-3" style="font-size: 12px;">
                        <i class="fas fa-circle text-danger me-1 blink-laser"></i> Menunggu tembakan sinar laser Zebra...
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-cancel-zebra" style="border-radius: 6px;">
                        Kembali ke Pilihan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kelola Layout -->
<div class="modal fade" id="modalKelolaLayout" tabindex="-1" aria-hidden="true" style="text-align: left;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h6 class="modal-title fw-bold" style="color: #1e293b; font-size: 16px;">Kelola Layout Pengiriman</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <form id="form-layout" action="{{ route('scan-koil-eup.layout.store') }}" method="POST" class="mb-3 d-flex flex-column flex-sm-row gap-2">
                    @csrf
                    <input type="text" name="nama_layout" class="form-control" required placeholder="Nama Layout Baru (misal: K18)" style="font-size: 14px; border-radius: 6px;">
                    <button type="submit" class="btn btn-primary" style="background-color: #135b9f; border: none; border-radius: 6px; white-space: nowrap;"><i class="fas fa-plus"></i> Tambah</button>
                </form>
                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-bordered table-sm mb-0 text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>NO</th>
                                <th>NAMA LAYOUT</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-layout">
                            @forelse($layouts as $index => $layout)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $layout->nama_layout }}</td>
                                <td>
                                    <form action="{{ route('scan-koil-eup.layout.destroy', $layout->id) }}" method="POST" class="delete-form" data-text="Semua data scan terkait layout ini akan ikut terhapus!">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted">Belum ada layout.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kelola Palet -->
<div class="modal fade" id="modalKelolaPalet" tabindex="-1" aria-hidden="true" style="text-align: left;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h6 class="modal-title fw-bold" style="color: #1e293b; font-size: 16px;">Kelola Palet</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <form id="form-palet" action="{{ route('scan-koil-eup.palet.store') }}" method="POST" class="mb-3 d-flex flex-column flex-sm-row gap-2">
                    @csrf
                    <input type="text" name="nama_palet" class="form-control" required placeholder="Nama Palet Baru (misal: 4)" style="font-size: 14px; border-radius: 6px;">
                    <button type="submit" class="btn btn-primary" style="background-color: #135b9f; border: none; border-radius: 6px; white-space: nowrap;"><i class="fas fa-plus"></i> Tambah</button>
                </form>
                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-bordered table-sm mb-0 text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>NO</th>
                                <th>NAMA PALET</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-palet">
                            @forelse($palets as $index => $palet)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $palet->nama_palet }}</td>
                                <td>
                                    <form action="{{ route('scan-koil-eup.palet.destroy', $palet->id) }}" method="POST" class="delete-form" data-text="Palet ini akan dihapus permanen.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted">Belum ada palet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function showErrorPopup(titleText, messageText) {
        Swal.fire({
            html: `
                <div style="margin-bottom: 20px;">
                    <div style="background-color: #fef2f2; color: #ef4444; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-times" style="font-size: 32px;"></i>
                    </div>
                </div>
                <h5 style="color: #1e293b; font-weight: 500; font-size: 18px; margin-bottom: 12px;">${titleText}</h5>
                <div style="color: #64748b; font-size: 14px;">${messageText}</div>
            `,
            confirmButtonText: 'OK',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn mx-2'
            },
            didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.borderRadius = '16px';
                popup.style.padding = '32px 20px';
                popup.style.width = '380px';
                
                const confirmBtn = Swal.getConfirmButton();
                confirmBtn.style.backgroundColor = '#135b9f';
                confirmBtn.style.color = '#ffffff';
                confirmBtn.style.borderRadius = '8px';
                confirmBtn.style.padding = '10px 32px';
                confirmBtn.style.fontWeight = '500';
                confirmBtn.style.border = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        
        // Proteksi Form Submit Ganda (Anti Double-Submit)
        const formTambahScan = document.getElementById('form-scan-koil');
        const btnSubmitScan = document.getElementById('btn-submit-scan');
        let isSubmittingScan = false;

        if (formTambahScan) {
            formTambahScan.addEventListener('submit', function (e) {
                if (isSubmittingScan) {
                    e.preventDefault();
                    return false;
                }
                isSubmittingScan = true;
                if (btnSubmitScan) {
                    btnSubmitScan.disabled = true;
                    btnSubmitScan.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
                }
            });

            // Cegah tombol Enter otomatis men-submit form sebelum user siap
            const noCoilInput = document.getElementById('no_coil_eup');
            const beratInput = document.getElementById('berat');

            if (noCoilInput) {
                noCoilInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (beratInput && !beratInput.value) {
                            beratInput.focus();
                        }
                    }
                });
            }
            if (beratInput) {
                beratInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (btnSubmitScan) {
                            btnSubmitScan.focus();
                        }
                    }
                });
            }
        }

        // Auto-focus input form & reset submit state
        const modalTambah = document.getElementById('modalTambah');
        if (modalTambah) {
            modalTambah.addEventListener('shown.bs.modal', function () {
                isSubmittingScan = false;
                if (btnSubmitScan) {
                    btnSubmitScan.disabled = false;
                    btnSubmitScan.innerHTML = 'Simpan';
                }
                const inputCoil = modalTambah.querySelector('input[name="no_coil_eup"]');
                if (inputCoil) {
                    inputCoil.focus();
                }
            });
            
            // Matikan kamera dan reset state jika modal ditutup
            modalTambah.addEventListener('hidden.bs.modal', function () {
                isSubmittingScan = false;
                if (btnSubmitScan) {
                    btnSubmitScan.disabled = false;
                    btnSubmitScan.innerHTML = 'Simpan';
                }

                // Untuk Coil EUP
                const qrReader = document.getElementById('qr-reader');
                const btnScan = document.getElementById('btn-scan');
                if (qrReader && qrReader.style.display === 'block') {
                    btnScan.click(); // Trigger click untuk mematikan dan reset UI
                }
                
                // Untuk Berat
                const qrReaderBerat = document.getElementById('qr-reader-berat');
                const btnScanBerat = document.getElementById('btn-scan-berat');
                if (qrReaderBerat && qrReaderBerat.style.display === 'block') {
                    btnScanBerat.click(); 
                }
            });
        }

        // Sound Beep Generator via Web Audio API
        function playZebraBeep() {
            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(1400, audioCtx.currentTime); // 1400 Hz beep
                gain.gain.setValueAtTime(0.2, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.12);
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.12);
            } catch (e) {
                // Ignore audio context error if browser blocks autoplay
            }
        }

        // Variabel Controller Scanner
        let activeTargetField = 'no_coil_eup'; // 'no_coil_eup' atau 'berat'
        let html5QrCodeCoil = null;
        let html5QrCodeBerat = null;
        const modalPilihMetodeEl = document.getElementById('modalPilihMetodeScan');
        const bsModalPilihMetode = modalPilihMetodeEl ? new bootstrap.Modal(modalPilihMetodeEl) : null;
        const bsModalTambah = modalTambah ? new bootstrap.Modal(modalTambah) : null;

        const scanMethodSelection = document.getElementById('scan-method-selection');
        const scanZebraWaiting = document.getElementById('scan-zebra-waiting');
        const optScanZebra = document.getElementById('opt-scan-zebra');
        const optScanCamera = document.getElementById('opt-scan-camera');
        const btnCancelZebra = document.getElementById('btn-cancel-zebra');

        // Buka Modal Pilihan Metode Scan & Set Target Field
        function openScanMethodModal(targetField) {
            setScanTargetField(targetField);
            if (scanMethodSelection) scanMethodSelection.style.display = 'block';
            if (scanZebraWaiting) scanZebraWaiting.style.display = 'none';
            if (bsModalPilihMetode) bsModalPilihMetode.show();
        }

        // Fungsi Switch Target Input (No Coil EUP vs Berat)
        function setScanTargetField(field) {
            activeTargetField = field;
            const btnCoil = document.getElementById('btn-target-coil');
            const btnBerat = document.getElementById('btn-target-berat');
            if (btnCoil && btnBerat) {
                if (field === 'berat') {
                    btnBerat.className = 'btn btn-primary btn-target-select active';
                    btnCoil.className = 'btn btn-outline-primary btn-target-select';
                } else {
                    btnCoil.className = 'btn btn-primary btn-target-select active';
                    btnBerat.className = 'btn btn-outline-primary btn-target-select';
                }
            }
            // Arahkan fokus ke sink penangkap scan
            const sink = document.getElementById('zebra-hidden-scanner-sink');
            if (sink) {
                sink.value = '';
                sink.focus();
            }
        }

        // Listener Tombol Pilihan Target di Modal
        document.querySelectorAll('.btn-target-select').forEach(btn => {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                setScanTargetField(target);
            });
        });

        // Saat modal metode scan terbuka, auto-fokus ke sink agar tembakan Zebra langsung tertangkap
        if (modalPilihMetodeEl) {
            modalPilihMetodeEl.addEventListener('shown.bs.modal', function () {
                const sink = document.getElementById('zebra-hidden-scanner-sink');
                if (sink) {
                    sink.value = '';
                    sink.focus();
                }
            });
        }

        // Listener Input Sink Penangkap Barcode Zebra di Modal
        const zebraSink = document.getElementById('zebra-hidden-scanner-sink');
        if (zebraSink) {
            zebraSink.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    e.stopPropagation();
                    const val = this.value.trim();
                    this.value = '';
                    if (val.length >= 2) {
                        applyZebraScannedBarcode(val);
                    }
                }
            });
            zebraSink.addEventListener('input', function() {
                const val = this.value;
                if (val.includes('\n') || val.includes('\r')) {
                    const clean = val.replace(/[\r\n]/g, '').trim();
                    this.value = '';
                    if (clean.length >= 2) {
                        applyZebraScannedBarcode(clean);
                    }
                }
            });
        }

        // Handler Klik Tombol QR di Input Form
        const btnScanCoil = document.getElementById('btn-scan');
        const qrReaderCoil = document.getElementById('qr-reader');
        if (btnScanCoil) {
            btnScanCoil.addEventListener('click', function(e) {
                e.preventDefault();
                if (qrReaderCoil && qrReaderCoil.style.display === 'block') {
                    stopCameraScanner('no_coil_eup');
                    return;
                }
                openScanMethodModal('no_coil_eup');
            });
        }

        const btnScanBerat = document.getElementById('btn-scan-berat');
        const qrReaderBerat = document.getElementById('qr-reader-berat');
        if (btnScanBerat) {
            btnScanBerat.addEventListener('click', function(e) {
                e.preventDefault();
                if (qrReaderBerat && qrReaderBerat.style.display === 'block') {
                    stopCameraScanner('berat');
                    return;
                }
                openScanMethodModal('berat');
            });
        }

        // Opsi 1: Pengguna Memilih Scanner Fisik Zebra
        if (optScanZebra) {
            optScanZebra.addEventListener('click', function() {
                if (bsModalPilihMetode) bsModalPilihMetode.hide();

                setTimeout(() => {
                    const targetInput = document.getElementById(activeTargetField);
                    if (targetInput) {
                        targetInput.focus();
                        targetInput.select();
                    }
                }, 300);

                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'info',
                    title: 'Target: ' + (activeTargetField === 'berat' ? 'Berat Koil' : 'No Coil EUP'),
                    text: 'Tarik pelatuk fisik (BUTTON_L1) di genggaman Zebra.',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            });
        }

        // Opsi 2: Pengguna Memilih Kamera
        if (optScanCamera) {
            optScanCamera.addEventListener('click', function() {
                if (bsModalPilihMetode) bsModalPilihMetode.hide();
                startCameraScanner(activeTargetField);
            });
        }

        // Jalankan Kamera WebRTC
        function startCameraScanner(targetField) {
            const readerId = targetField === 'berat' ? 'qr-reader-berat' : 'qr-reader';
            const btnId = targetField === 'berat' ? 'btn-scan-berat' : 'btn-scan';
            const qrReader = document.getElementById(readerId);
            const btnScan = document.getElementById(btnId);
            const inputField = document.getElementById(targetField);

            if (!qrReader || !btnScan || !inputField) return;

            qrReader.style.display = 'block';
            btnScan.innerHTML = '<i class="fas fa-times text-danger"></i>';

            let qrInstance = targetField === 'berat' ? html5QrCodeBerat : html5QrCodeCoil;
            if (!qrInstance) {
                qrInstance = new Html5Qrcode(readerId);
                if (targetField === 'berat') html5QrCodeBerat = qrInstance;
                else html5QrCodeCoil = qrInstance;
            }

            qrInstance.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                (decodedText) => {
                    playZebraBeep();
                    if (targetField === 'berat') {
                        const num = decodedText.replace(/[^0-9.]/g, '');
                        inputField.value = num;
                    } else {
                        inputField.value = decodedText;
                    }
                    stopCameraScanner(targetField);
                    highlightInputField(inputField);
                },
                (errorMessage) => {}
            ).catch((err) => {
                console.error("Error starting camera", err);
                showErrorPopup('Akses Kamera Gagal', 'Browser tidak memiliki izin atau tidak ada kamera yang terdeteksi.');
                stopCameraScanner(targetField);
            });
        }

        // Hentikan Kamera
        function stopCameraScanner(targetField) {
            const readerId = targetField === 'berat' ? 'qr-reader-berat' : 'qr-reader';
            const btnId = targetField === 'berat' ? 'btn-scan-berat' : 'btn-scan';
            const qrReader = document.getElementById(readerId);
            const btnScan = document.getElementById(btnId);
            const qrInstance = targetField === 'berat' ? html5QrCodeBerat : html5QrCodeCoil;

            if (qrReader) qrReader.style.display = 'none';
            if (btnScan) btnScan.innerHTML = '<i class="fas fa-qrcode"></i>';

            if (qrInstance) {
                qrInstance.stop().then(() => {}).catch(err => console.error(err));
            }
        }

        // Efek Highlight Hijau Sukses pada Input
        function highlightInputField(el) {
            if (!el) return;
            el.style.transition = 'all 0.3s ease';
            el.style.backgroundColor = '#dcfce7';
            el.style.borderColor = '#16a34a';
            setTimeout(() => {
                el.style.backgroundColor = '';
                el.style.borderColor = '#cbd5e1';
            }, 900);
        }

        // Injeksi Hasil Scan Hardware Zebra ke Form
        function applyZebraScannedBarcode(barcodeText) {
            playZebraBeep();

            // Jika modal pilihan metode sedang terbuka, tutup otomatis
            if (modalPilihMetodeEl && modalPilihMetodeEl.classList.contains('show')) {
                if (bsModalPilihMetode) bsModalPilihMetode.hide();
            }

            // Matikan kamera jika sebelumnya menyala
            stopCameraScanner('no_coil_eup');
            stopCameraScanner('berat');

            // Jika modalTambah belum terbuka, buka secara otomatis
            if (modalTambah && !modalTambah.classList.contains('show')) {
                if (bsModalTambah) bsModalTambah.show();
                activeTargetField = 'no_coil_eup';
            }

            // Cek elemen aktif atau input target
            const activeEl = document.activeElement;
            let targetEl = null;

            if (activeTargetField === 'berat') {
                targetEl = document.getElementById('berat');
            } else if (activeEl && activeEl.id === 'berat') {
                targetEl = activeEl;
            } else {
                targetEl = document.getElementById('no_coil_eup');
            }

            if (targetEl) {
                if (targetEl.id === 'berat') {
                    const cleanNum = barcodeText.replace(/[^0-9.]/g, '');
                    targetEl.value = cleanNum;
                } else {
                    targetEl.value = barcodeText;
                    // Auto-fokus ke berat jika berat masih kosong
                    const beratInput = document.getElementById('berat');
                    if (beratInput && !beratInput.value) {
                        beratInput.focus();
                    } else {
                        const nextSelect = modalTambah ? modalTambah.querySelector('select[name="palet_id"]') : null;
                        if (nextSelect) nextSelect.focus();
                    }
                }

                highlightInputField(targetEl);

                // Toast notifikasi sukses scan Zebra
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Scan Zebra Berhasil!',
                    text: barcodeText,
                    showConfirmButton: false,
                    timer: 1800,
                    timerProgressBar: true
                });
            }
        }

        // [DETEKSI SCANNER HARDWARE ZEBRA]: Listener Keystroke Berkecepatan Tinggi
        let zebraCharBuffer = [];
        let lastCharTimestamp = 0;
        const ZEBRA_BURST_MAX_MS = 100; // Toleransi intercharacter delay Zebra

        window.addEventListener('keydown', function (e) {
            const currentTime = Date.now();
            const elapsed = currentTime - lastCharTimestamp;
            lastCharTimestamp = currentTime;

            // Jika tombol Enter diterima
            if (e.key === 'Enter') {
                if (zebraCharBuffer.length >= 3) {
                    const finalBarcode = zebraCharBuffer.join('').trim();
                    zebraCharBuffer = [];
                    e.preventDefault();
                    e.stopPropagation();
                    applyZebraScannedBarcode(finalBarcode);
                    return;
                } else if (e.target && (e.target.id === 'no_coil_eup' || e.target.id === 'berat') && e.target.value.trim().length >= 3) {
                    // Kasus DataWedge mengetik langsung ke field yang sedang aktif
                    const typedBarcode = e.target.value.trim();
                    e.preventDefault();
                    e.stopPropagation();
                    applyZebraScannedBarcode(typedBarcode);
                    return;
                }
                zebraCharBuffer = [];
                return;
            }

            // Jika jeda antar karakter melebihi batas burst, reset buffer
            if (elapsed > ZEBRA_BURST_MAX_MS) {
                zebraCharBuffer = [];
            }

            // Tampung karakter teks
            if (e.key && e.key.length === 1) {
                zebraCharBuffer.push(e.key);
            }
        }, true); // useCapture = true agar menangkap sebelum submit form default
        
        // AJAX Kelola Layout
        const formLayout = document.getElementById('form-layout');
        if (formLayout) {
            formLayout.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const tbody = document.getElementById('tbody-layout');
                        if(tbody.querySelector('td[colspan]')) tbody.innerHTML = ''; // Hapus pesan kosong
                        const index = tbody.querySelectorAll('tr').length + 1;
                        
                        const row = `<tr>
                            <td>${index}</td>
                            <td>${data.data.nama_layout}</td>
                            <td>
                                <form action="/scan-koil-eup/layout/destroy/${data.data.id}" method="POST" class="delete-form" data-text="Semua data scan terkait layout ini akan ikut terhapus!">
                                    <input type="hidden" name="_token" value="${formData.get('_token')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm text-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>`;
                        tbody.insertAdjacentHTML('beforeend', row);
                        
                        // Update Dropdown di Form Input Data Utama
                        const select = document.querySelector('select[name="layout_id"]');
                        if (select) select.insertAdjacentHTML('beforeend', `<option value="${data.data.id}">${data.data.nama_layout}</option>`);
                        
                        this.reset(); // Kosongkan inputan
                    } else {
                        showErrorPopup('Gagal', 'Gagal menambahkan layout. Nama mungkin sudah ada.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorPopup('Oops...', 'Terjadi kesalahan sistem!');
                });
            });
        }

        // AJAX Kelola Palet
        const formPalet = document.getElementById('form-palet');
        if (formPalet) {
            formPalet.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const tbody = document.getElementById('tbody-palet');
                        if(tbody.querySelector('td[colspan]')) tbody.innerHTML = ''; 
                        const index = tbody.querySelectorAll('tr').length + 1;
                        
                        const row = `<tr>
                            <td>${index}</td>
                            <td>${data.data.nama_palet}</td>
                            <td>
                                <form action="/scan-koil-eup/palet/destroy/${data.data.id}" method="POST" class="delete-form" data-text="Palet ini akan dihapus permanen.">
                                    <input type="hidden" name="_token" value="${formData.get('_token')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm text-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>`;
                        tbody.insertAdjacentHTML('beforeend', row);
                        
                        const select = document.querySelector('select[name="palet_id"]');
                        if (select) select.insertAdjacentHTML('beforeend', `<option value="${data.data.id}">${data.data.nama_palet}</option>`);
                        
                        this.reset(); 
                    } else {
                        showErrorPopup('Gagal', 'Gagal menambahkan palet. Nama mungkin sudah ada.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorPopup('Oops...', 'Terjadi kesalahan sistem!');
                });
            });
        }
        
        // Global SweetAlert Delete Confirmation
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.classList.contains('delete-form')) {
                e.preventDefault();
                const form = e.target;
                Swal.fire({
                    html: `
                        <div style="margin-bottom: 20px;">
                            <div style="background-color: #fef2f2; color: #a52a2a; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-trash-alt" style="font-size: 28px;"></i>
                            </div>
                        </div>
                        <h5 style="color: #1e293b; font-weight: 500; font-size: 18px; margin-bottom: 12px;">Hapus Data Scan Koil?</h5>
                        <div style="color: #64748b; font-size: 14px;">${form.dataset.text || "Data akan dihapus permanen."}</div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn mx-2',
                        cancelButton: 'btn mx-2'
                    },
                    didOpen: () => {
                        const popup = Swal.getPopup();
                        popup.style.borderRadius = '16px';
                        popup.style.padding = '32px 20px';
                        popup.style.width = '380px';
                        
                        const confirmBtn = Swal.getConfirmButton();
                        confirmBtn.style.backgroundColor = '#a52a2a';
                        confirmBtn.style.color = '#ffffff';
                        confirmBtn.style.borderRadius = '8px';
                        confirmBtn.style.padding = '10px 24px';
                        confirmBtn.style.fontWeight = '500';
                        confirmBtn.style.border = 'none';
                        
                        const cancelBtn = Swal.getCancelButton();
                        cancelBtn.style.backgroundColor = '#f1f5f9';
                        cancelBtn.style.color = '#334155';
                        cancelBtn.style.borderRadius = '8px';
                        cancelBtn.style.padding = '10px 24px';
                        cancelBtn.style.fontWeight = '500';
                        cancelBtn.style.border = 'none';
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

    });
</script>
@endsection
