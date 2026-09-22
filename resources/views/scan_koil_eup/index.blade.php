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
</style>

<style>
    /* Responsive Tabs */
    .tabs-container {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 1.25rem;
    }
    .tabs-container .nav-tabs {
        border-bottom: none;
        flex-wrap: wrap;
    }
    .tabs-container .nav-item {
        flex-grow: 1;
        text-align: center;
    }
    .tabs-container .nav-link {
        margin-bottom: -1px;
        width: 100%;
        justify-content: center;
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
        .card-header-mobile button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid p-0">
    
    <div class="card border-0 shadow-sm" style="border-radius: 8px;">
        <!-- Card Header -->
        <div class="card-header bg-white border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3 card-header-mobile" style="padding: 20px 24px;">
            <h5 class="mb-0 text-dark font-weight-bold" style="font-size: 18px; letter-spacing: 0.3px;">Manajemen Scan Koil EUP</h5>
            <button type="button" class="btn btn-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #135b9f; border: none; font-weight: 500; padding: 8px 16px; border-radius: 6px;">
                <i class="fas fa-plus"></i> Input Data
            </button>
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
            <form action="{{ route('scan-koil-eup.store') }}" method="POST">
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
                                <input type="text" name="no_coil_eup" class="form-control" required placeholder="Scan atau Ketik..." style="font-size: 14px; border-radius: 6px 0 0 6px; padding: 10px 12px; border: 1px solid #cbd5e1; border-right: none;" autofocus>
                                <button type="button" class="input-group-text bg-white text-primary" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; cursor: pointer;" title="Scan Barcode/QR" onclick="alert('Membuka Kamera untuk Scan...')">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                            </div>
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
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Berat <span class="text-primary">*</span></label>
                        <input type="number" step="any" name="berat" class="form-control" required placeholder="0" style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;">
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Opsional..." style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;"></textarea>
                    </div>

                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 pt-1">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 16px;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #135b9f; border-color: #135b9f; font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 20px;">Simpan</button>
                </div>
            </form>
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
        
        // Auto-focus input form
        const modalTambah = document.getElementById('modalTambah');
        if (modalTambah) {
            modalTambah.addEventListener('shown.bs.modal', function () {
                const inputCoil = modalTambah.querySelector('input[name="no_coil_eup"]');
                if (inputCoil) {
                    inputCoil.focus();
                }
            });
        }
        
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
