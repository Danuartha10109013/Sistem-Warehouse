@extends('break_bulk.layout.V_template')

@section('title', 'Tambah Data - Break Bulk')

@push('css')
<style>
    /* Styling tabel modern & clean */
    #dataTable {
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }
    #dataTable thead th {
        background-color: #f8fafc !important;
        color: #334155 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 14px 16px !important;
        vertical-align: middle !important;
    }
    #dataTable tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        font-size: 14px !important;
    }
    #dataTable tbody tr:hover td {
        background-color: #f8fafc !important;
    }
    .badge-chip {
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
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info (Breadcrumb Card) -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bolder mb-1 fs-5 fs-md-4" style="color: #1e293b; letter-spacing: -0.5px;">
                        <i class="fas fa-file-excel text-primary me-2"></i>Tambah Data Break Bulk
                    </h4>
                    <div class="text-muted" style="font-size: 13px;">
                        Home <span class="mx-1">/</span> Setting Break Bulk <span class="mx-1">/</span> <span class="text-primary fw-semibold">Tambah Data</span>
                    </div>
                </div>
                <div class="w-100 w-sm-auto">
                    <button type="button" class="btn btn-primary w-100 w-sm-auto d-flex align-items-center justify-content-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImportExcel" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;">
                        <i class="fas fa-cloud-upload-alt fs-5"></i>
                        <span>Import Data Excel</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px;">
        <div class="card-header bg-white py-3 px-3 px-md-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-radius: 14px 14px 0 0;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(19, 91, 159, 0.1); color: #135b9f;">
                    <i class="fas fa-table fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0 fs-6 fs-md-5">Daftar Data Break Bulk</h5>
                    <small class="text-muted d-none d-sm-block">Data koil/material hasil import yang terdaftar di sistem</small>
                </div>
            </div>
            @if($totalItems > 0)
            <div class="d-flex align-items-center gap-2 ms-auto ms-sm-0">
                <span class="badge bg-light text-primary border border-primary-subtle px-2 px-md-3 py-2 fw-semibold" style="border-radius: 8px;">
                    <i class="fas fa-database me-1"></i> {{ number_format($totalItems) }} Baris ({{ number_format($totalWeight / 1000, 2) }} Ton)
                </span>
                <form id="resetAllForm" action="{{ route('break-bulk.destroy-all') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" style="border-radius: 8px; font-weight: 600; padding: 6px 12px;" onclick="confirmResetAll()">
                        <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Reset Data</span>
                    </button>
                </form>
            </div>
            @endif
        </div>

        <div class="card-body p-3 p-md-4">
            @if($totalItems > 0)
                <!-- Search Toolbar -->
                <div class="row align-items-center mb-3 g-3">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <span class="input-group-text bg-white border-end-0 pe-2" style="border-color: #cbd5e1;">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 custom-dt-search ps-1" placeholder="Cari atribut, produk, no so..." style="border-color: #cbd5e1; font-size: 14px; padding: 10px 12px;">
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="dataTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th style="width: 220px;">Atribut</th>
                                <th class="text-end" style="width: 160px;">Weight (Kg)</th>
                                <th>Product</th>
                                <th style="width: 180px;">NO SO</th>
                                <th class="text-center" style="width: 130px;">Status</th>
                                <th class="text-center" style="width: 90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <td class="text-center fw-semibold text-muted">{{ $item->no_urut ?: ($index + 1) }}</td>
                                <td>
                                    <span class="badge-chip">
                                        <i class="fas fa-barcode"></i>{{ $item->atribut }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-dark font-monospace" style="font-size: 15px;">
                                        {{ number_format($item->weight, 2, ',', '.') }}
                                    </span>
                                    <small class="text-muted ms-1">kg</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $item->product }}</span>
                                </td>
                                <td>
                                    @if(!empty($item->no_so))
                                        <span class="badge bg-light text-dark border px-2 py-1 font-monospace fw-semibold" style="letter-spacing: 0.3px;">
                                            {{ $item->no_so }}
                                        </span>
                                    @else
                                        <span class="text-muted fs-6 fst-italic">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'scanned')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill fw-semibold">
                                            <i class="fas fa-check-circle me-1"></i>Scanned
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 rounded-pill fw-semibold">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-icons">
                                        <form id="deleteForm{{ $item->id }}" action="{{ route('break-bulk.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon-btn delete-button" title="Hapus Data" onclick="confirmDeleteOne('{{ $item->id }}', '{{ $item->atribut }}')">
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
                <!-- Clean & Friendly Empty State -->
                <div class="text-center py-5 my-3">
                    <div class="mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px; background-color: rgba(19, 91, 159, 0.08); color: #135b9f;">
                            <i class="fas fa-file-excel fs-1"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-2" style="letter-spacing: -0.3px;">Belum Ada Data Break Bulk</h5>
                    <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto; font-size: 14px; line-height: 1.6;">
                        Tabel masih kosong. Silakan import berkas Excel (.xlsx / .xls) untuk mendaftarkan atribut dan spesifikasi koil Break Bulk ke dalam sistem.
                    </p>
                    <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                        <button type="button" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImportExcel" style="border-radius: 10px; font-weight: 600; padding: 10px 22px;">
                            <i class="fas fa-cloud-upload-alt fs-5"></i>
                            <span>Import Data Sekarang</span>
                        </button>
                        <a href="{{ route('break-bulk.template-excel') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;">
                            <i class="fas fa-file-download"></i>
                            <span>Unduh Template</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Popup Import Excel -->
<div class="modal fade" id="modalImportExcel" tabindex="-1" aria-labelledby="modalImportExcelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom py-3 px-3 px-md-4">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 fs-6 fs-md-5" id="modalImportExcelLabel">
                    <i class="fas fa-file-excel text-success fs-4"></i> Import Data Break Bulk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('break-bulk.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-3 p-md-4">
                    <!-- Template Download Box -->
                    <div class="d-flex align-items-center justify-content-between p-3 mb-4 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <div>
                            <div class="fw-semibold text-dark" style="font-size: 14px;">Template Excel Standar</div>
                            <small class="text-muted">Unduh format kolom resmi sebelum upload</small>
                        </div>
                        <a href="{{ route('break-bulk.template-excel') }}" class="btn btn-sm btn-outline-success d-flex align-items-center gap-1 shadow-sm" style="font-weight: 600; border-radius: 8px; padding: 6px 14px;">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    </div>

                    <!-- File Input -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Pilih File Excel (.xlsx, .xls, .csv):</label>
                        <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls,.csv" required style="border-radius: 10px; padding: 10px 14px; border-color: #cbd5e1; font-size: 14px;">
                    </div>

                    <div class="p-3 rounded-3" style="background-color: #f1f5f9; font-size: 12px; color: #475569; line-height: 1.5;">
                        <i class="fas fa-info-circle text-primary me-1"></i>
                        Format kolom baris 1: <strong>NO</strong>, <strong>Atribut</strong>, <strong>Weight</strong>, <strong>Product</strong>, <strong>NO SO</strong> (Opsional).
                    </div>
                </div>
                <div class="modal-footer border-top py-3 px-3 px-md-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 10px; font-weight: 600; padding: 8px 18px;">Batal</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 8px 20px;">
                        <i class="fas fa-cloud-upload-alt"></i> Upload & Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDeleteOne(id, atribut) {
        window.showCustomConfirm({
            iconClass: 'fas fa-trash-alt',
            title: 'Hapus Item?',
            text: `Data atribut <strong>${atribut}</strong> akan dihapus permanen.`,
            confirmText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }

    function confirmResetAll() {
        window.showCustomConfirm({
            iconClass: 'fas fa-exclamation-triangle',
            title: 'Reset Semua Data?',
            text: 'Semua baris data Break Bulk yang tersimpan akan dihapus seluruhnya!',
            confirmText: 'Ya, Reset Semua'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('resetAllForm').submit();
            }
        });
    }
</script>
@endpush
