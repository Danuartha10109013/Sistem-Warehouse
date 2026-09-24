@extends('verifikasi_timbangan.layout.V_template')

@section('title', 'Master Product')

@section('content')
<style>
    /* Table Styling */
    .table-clean { border-collapse: separate; border-spacing: 0; }
    .table-clean thead th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; border-top: none; padding: 16px; white-space: nowrap; }
    .table-clean tbody td { vertical-align: middle; font-size: 14px; color: #334155; padding: 16px; border-bottom: 1px solid #f1f5f9; background-color: #ffffff; transition: background-color 0.2s; }
    .table-clean tbody tr:hover td { background-color: #f8fafc; }
    
    /* Buttons */
    .action-icon { background: transparent; transition: all 0.2s; border-radius: 8px; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; }
    .action-icon:hover { transform: translateY(-2px); background-color: #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    .btn-modern { border-radius: 8px; font-weight: 500; font-size: 14px; padding: 8px 16px; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
    .btn-modern:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    
    /* Search Box */
    .search-box { position: relative; flex-grow: 1; max-width: 350px; }
    .search-box input { padding-left: 38px; border-radius: 8px; font-size: 14px; border: 1px solid #cbd5e1; padding-top: 9px; padding-bottom: 9px; background-color: #f8fafc; transition: all 0.2s; width: 100%; }
    .search-box input:focus { background-color: #ffffff; border-color: #94a3b8; box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.2); }
    .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    
    /* Pagination */
    .pagination-wrapper .page-item .page-link { border-radius: 8px; margin: 0 4px; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; padding: 8px 14px; transition: all 0.2s; }
    .pagination-wrapper .page-item.active .page-link { background-color: #0f172a; border-color: #0f172a; color: white; box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.2); }
    .pagination-wrapper .page-item .page-link:hover:not(.active) { background-color: #f1f5f9; }
    .pagination-wrapper .page-item.disabled .page-link { background-color: #f8fafc; color: #cbd5e1; }

    /* Photo Viewer Modal (Shopee style) */
    .photo-viewer-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
    .photo-viewer-img { width: 100%; height: auto; max-height: 65vh; object-fit: contain; background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 20px; }
    .photo-viewer-details { padding: 20px 24px; text-align: left; }
    .photo-viewer-title { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1.4; }
    .photo-viewer-sku { font-size: 13px; color: #64748b; font-weight: 500; letter-spacing: 0.5px; background: #f1f5f9; padding: 4px 10px; border-radius: 6px; display: inline-block; }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .table-clean thead th, .table-clean tbody td { padding: 12px 8px; font-size: 13px; }
    }
</style>

<div class="container-fluid p-0">
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-white border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3" style="padding: 20px 24px;">
            
            <!-- Judul -->
            <div class="d-flex flex-column me-auto">
                <h5 class="mb-1 text-dark font-weight-bold" style="font-size: 20px; letter-spacing: 0.2px;">Master Product</h5>
                <small class="text-muted" style="font-size: 13px;">Kelola data produk dan foto katalog</small>
            </div>
            
            <!-- Bagian Kanan (Search & Buttons) -->
            <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-3 w-100" style="max-width: 750px; justify-content: flex-end;">
                
                <!-- Search Box -->
                <div class="d-flex gap-2" style="flex: 1;">
                    <div class="search-box flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control w-100" placeholder="Cari SKU atau nama...">
                    </div>
                    <button type="button" class="btn btn-modern btn-light border text-secondary" id="btnScanSearch" title="Scan QR">
                        <i class="fas fa-barcode"></i>
                    </button>
                </div>

                <div class="d-none d-lg-block border-start mx-1" style="height: 32px; border-color: #e2e8f0 !important;"></div>

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap flex-sm-nowrap gap-2">
                    <button type="button" class="btn btn-modern btn-light border text-dark flex-grow-1 text-nowrap" data-bs-toggle="modal" data-bs-target="#modalImport">
                        <i class="fas fa-file-excel text-success"></i> Import
                    </button>
                    <button type="button" class="btn btn-modern text-white flex-grow-1 text-nowrap" id="btnScanQR" style="background-color: #0ea5e9; border:none;" title="Scan untuk menambah foto">
                        <i class="fas fa-camera"></i> Scan Add
                    </button>
                    <button type="button" class="btn btn-modern btn-dark shadow-sm flex-grow-1 text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fas fa-plus"></i> Manual
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0 position-relative">
            <div id="loadingOverlay" style="display: none; position: absolute; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:10; align-items:center; justify-content:center;">
                <div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>
            </div>
            
            <div class="table-responsive" style="min-height: 400px; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <table class="table table-clean w-100 mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">NO</th>
                            <th style="width: 200px;">SEARCH KEY (SKU)</th>
                            <th>NAMA PRODUK</th>
                            <th style="width: 100px;">FOTO</th>
                            <th class="text-center" style="width: 120px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @include('master_product.partials.table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEdit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4 py-4">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">SEARCH KEY (SKU) <span class="text-danger">*</span></label>
                        <input type="text" name="search_key" id="edit_search_key" class="form-control form-control-lg" style="font-size: 15px; border-radius: 8px;" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">NAMA PRODUK <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control form-control-lg" style="font-size: 15px; border-radius: 8px;" required>
                    </div>
                    <div class="mb-2 p-3 border rounded" style="background-color: #f8fafc;">
                        <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">GANTI FOTO PRODUK (Opsional)</label>
                        <input type="file" name="foto" class="form-control form-control-sm mb-2" accept="image/*">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="hapus_foto" value="1" id="edit_hapus_foto">
                            <label class="form-check-label text-danger" style="font-size: 13px;" for="edit_hapus_foto">
                                Hapus foto yang sudah ada
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light btn-modern text-dark" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark btn-modern px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal View Photo (Shopee Style) -->
<div class="modal fade" id="modalViewPhoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="photo-viewer-card position-relative">
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 16px; right: 16px; z-index: 10; background-color: rgba(255,255,255,0.9); padding: 10px; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></button>
                
                <img id="viewPhotoImg" src="" alt="Product Photo" class="photo-viewer-img">
                
                <div class="photo-viewer-details">
                    <div class="d-flex align-items-start justify-content-between gap-3">
                        <div>
                            <div class="photo-viewer-sku mb-2" id="viewPhotoSku">SKU-12345</div>
                            <h4 class="photo-viewer-title" id="viewPhotoTitle">Nama Produk</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Import Data Excel</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('master-product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4 py-4">
                    <div class="alert alert-info border-0 rounded-3 mb-4" style="background-color: #f0f7ff;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-primary me-2" style="font-size: 16px;"></i>
                            <strong class="text-primary" style="font-size: 14px;">Format Excel yang Diperlukan</strong>
                        </div>
                        <p class="mb-2 text-dark" style="font-size: 13px;">File harus memiliki header pada baris pertama dengan format persis seperti tabel di bawah ini:</p>
                        <div class="table-responsive bg-white rounded border">
                            <table class="table table-sm table-bordered mb-0 text-center" style="font-size: 13px;">
                                <thead style="background-color: #f8fafc;">
                                    <tr>
                                        <th class="py-2 text-dark">search_key</th>
                                        <th class="py-2 text-dark">name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-muted">SKU-001</td>
                                        <td class="text-muted">Nama Produk A</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">SKU-002</td>
                                        <td class="text-muted">Nama Produk B</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">PILIH FILE EXCEL (.xlsx, .csv) <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control form-control-lg" style="font-size: 14px; border-radius: 8px;" required accept=".xlsx,.xls,.csv">
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #135b9f;">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Manual -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Input Manual Produk</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('master-product.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Search Key <span class="text-danger">*</span></label>
                        <input type="text" name="search_key" id="input_search_key" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #135b9f;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Scan QR -->
<div class="modal fade" id="modalScanQR" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Scan QR Code</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qr-reader" style="width: 100%; max-width: 400px; margin: 0 auto; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Foto -->
<div class="modal fade" id="modalUploadFoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Upload Foto: <span id="fotoProductName" class="text-primary"></span></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fotoProductId">
                <div class="mb-3 text-center">
                    <label class="form-label d-block text-muted mb-2">Pilih sumber foto:</label>
                    <div class="d-flex justify-content-center gap-3 mb-3">
                        <button type="button" class="btn btn-outline-dark" onclick="document.getElementById('fotoKamera').click()">
                            <i class="fas fa-camera"></i> Kamera
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fotoGaleri').click()">
                            <i class="fas fa-image"></i> Galeri
                        </button>
                    </div>
                    <input type="file" id="fotoKamera" class="d-none" accept="image/*" capture="environment">
                    <input type="file" id="fotoGaleri" class="d-none" accept="image/*">
                    <input type="file" id="fotoInput" class="d-none"> <!-- Hidden actual input to reuse existing js logic -->
                </div>
                <div class="text-center mt-3" id="fotoPreviewContainer" style="display: none;">
                    <img id="fotoPreview" style="max-height: 200px; max-width: 100%; border-radius: 8px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanFoto" style="background-color: #135b9f;">Upload & Simpan</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let html5QrCode = null;
    let scanMode = 'add'; // 'add' atau 'search'

    // --- AJAX Pagination & Search ---
    const tableBody = document.getElementById('tableBody');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const searchInput = document.getElementById('searchInput');

    function fetchTableData(url) {
        loadingOverlay.style.display = 'flex';
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            tableBody.innerHTML = html;
            loadingOverlay.style.display = 'none';
            bindPaginationLinks();
            
            // Tampilkan baris pagination yang disembunyikan
            const pagRow = document.querySelector('.pagination-row');
            if (pagRow) pagRow.style.display = 'table-row';
        })
        .catch(err => {
            loadingOverlay.style.display = 'none';
            Swal.fire('Error', 'Gagal memuat data.', 'error');
        });
    }

    function bindPaginationLinks() {
        document.querySelectorAll('.pagination-wrapper a.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                fetchTableData(this.href);
            });
        });
    }

    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const val = this.value;
            const url = `{{ route('master-product.index') }}?search=${encodeURIComponent(val)}`;
            fetchTableData(url);
        }, 500);
    });

    // Inisialisasi awal pagination links (jika tidak via AJAX)
    bindPaginationLinks();
    const initPag = document.querySelector('.pagination-row');
    if(initPag) initPag.style.display = 'table-row';

    // --- Tombol Edit & View Foto ---
    window.editProduct = function(id, search_key, name) {
        document.getElementById('edit_search_key').value = search_key;
        document.getElementById('edit_name').value = name;
        document.getElementById('formEdit').action = `/master-product/update/${id}`;
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }

    window.viewPhoto = function(url, title, sku) {
        document.getElementById('viewPhotoImg').src = url;
        document.getElementById('viewPhotoTitle').innerText = title;
        document.getElementById('viewPhotoSku').innerText = sku;
        new bootstrap.Modal(document.getElementById('modalViewPhoto')).show();
    }

    // --- Kamera / Scanner ---
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
            customClass: { confirmButton: 'btn mx-2' },
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

    function showSuccessPopup(titleText, messageText) {
        return Swal.fire({
            html: `
                <div style="margin-bottom: 20px;">
                    <div style="background-color: #f0fdf4; color: #22c55e; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-check" style="font-size: 32px;"></i>
                    </div>
                </div>
                <h5 style="color: #1e293b; font-weight: 500; font-size: 18px; margin-bottom: 12px;">${titleText}</h5>
                <div style="color: #64748b; font-size: 14px;">${messageText}</div>
            `,
            confirmButtonText: 'OK',
            buttonsStyling: false,
            customClass: { confirmButton: 'btn mx-2' },
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

    function showWarningPopup(titleText, messageText) {
        return Swal.fire({
            html: `
                <div style="margin-bottom: 20px;">
                    <div style="background-color: #fffbeb; color: #f59e0b; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 28px;"></i>
                    </div>
                </div>
                <h5 style="color: #1e293b; font-weight: 500; font-size: 18px; margin-bottom: 12px;">${titleText}</h5>
                <div style="color: #64748b; font-size: 14px;">${messageText}</div>
            `,
            confirmButtonText: 'OK',
            buttonsStyling: false,
            customClass: { confirmButton: 'btn mx-2' },
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

    function showConfirmPopup(titleText, messageText, confirmText, cancelText, isDelete = false) {
        const color = isDelete ? '#a52a2a' : '#135b9f';
        const bg = isDelete ? '#fef2f2' : '#eff6ff';
        const icon = isDelete ? 'fa-trash-alt' : 'fa-question';
        
        return Swal.fire({
            html: `
                <div style="margin-bottom: 20px;">
                    <div style="background-color: ${bg}; color: ${color}; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas ${icon}" style="font-size: 28px;"></i>
                    </div>
                </div>
                <h5 style="color: #1e293b; font-weight: 500; font-size: 18px; margin-bottom: 12px;">${titleText}</h5>
                <div style="color: #64748b; font-size: 14px;">${messageText}</div>
            `,
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
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
                confirmBtn.style.backgroundColor = color;
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
        });
    }

    function showLoadingPopup(titleText) {
        return Swal.fire({
            html: `
                <div style="margin-bottom: 20px; display: flex; justify-content: center;">
                    <div class="spinner-border" style="color: #135b9f; width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <h5 style="color: #1e293b; font-weight: 500; font-size: 18px; margin-bottom: 0;">${titleText}</h5>
            `,
            showConfirmButton: false,
            allowOutsideClick: false,
            didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.borderRadius = '16px';
                popup.style.padding = '32px 20px';
                popup.style.width = '320px';
            }
        });
    }

    function openScannerModal(mode) {
        scanMode = mode;
        const modal = new bootstrap.Modal(document.getElementById('modalScanQR'));
        modal.show();
        
        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode('qr-reader');
        }
        
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            (decodedText, decodedResult) => {
                html5QrCode.stop().then(() => {
                    bootstrap.Modal.getInstance(document.getElementById('modalScanQR')).hide();
                    if (scanMode === 'search') {
                        searchInput.value = decodedText;
                        searchInput.dispatchEvent(new Event('input'));
                    } else {
                        checkSearchKey(decodedText);
                    }
                });
            },
            (errorMessage) => {}
        ).catch((err) => {
            console.error("Error starting camera", err);
            showErrorPopup('Error', 'Gagal mengakses kamera.');
        });
    }

    document.getElementById('btnScanQR').addEventListener('click', function() { openScannerModal('add'); });
    document.getElementById('btnScanSearch').addEventListener('click', function() { openScannerModal('search'); });

    document.getElementById('modalScanQR').addEventListener('hidden.bs.modal', function () {
        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop().catch(err => console.error(err));
        }
    });

    function checkSearchKey(key) {
        showLoadingPopup('Mengecek Database...');

        fetch('{{ route("master-product.check-key") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ search_key: key })
        })
        .then(res => res.json())
        .then(data => {
            Swal.close();
            if (data.exists) {
                document.getElementById('fotoProductId').value = data.id;
                document.getElementById('fotoProductName').innerText = data.name + ' (' + data.search_key + ')';
                document.getElementById('fotoPreviewContainer').style.display = 'none';
                document.getElementById('fotoInput').value = '';
                new bootstrap.Modal(document.getElementById('modalUploadFoto')).show();
            } else {
                showConfirmPopup(
                    'Tidak Ditemukan', 
                    `Produk dengan Search Key "${key}" tidak ditemukan.<br>Tambah produk baru?`, 
                    'Tambah Manual', 
                    'Batal'
                ).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('input_search_key').value = key;
                        new bootstrap.Modal(document.getElementById('modalTambah')).show();
                    }
                });
            }
        })
        .catch(err => {
            showErrorPopup('Error', 'Gagal menghubungi server.');
        });
    }

    // Preview Foto
    function handleFileSelection(e) {
        if (e.target.files && e.target.files[0]) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(e.target.files[0]);
            document.getElementById('fotoInput').files = dataTransfer.files;

            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('fotoPreview').src = evt.target.result;
                document.getElementById('fotoPreviewContainer').style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    }

    document.getElementById('fotoKamera').addEventListener('change', handleFileSelection);
    document.getElementById('fotoGaleri').addEventListener('change', handleFileSelection);

    // Simpan Foto
    document.getElementById('btnSimpanFoto').addEventListener('click', function() {
        const fileInput = document.getElementById('fotoInput');
        if (!fileInput.files || fileInput.files.length === 0) {
            showWarningPopup('Peringatan', 'Silakan pilih foto terlebih dahulu.');
            return;
        }

        const formData = new FormData();
        formData.append('id', document.getElementById('fotoProductId').value);
        formData.append('foto', fileInput.files[0]);

        const btn = this;
        btn.disabled = true;
        btn.innerText = 'Mengupload...';

        fetch('{{ route("master-product.upload-foto") }}', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) {
                throw new Error(data.message || data.error || 'Terjadi kesalahan sistem.');
            }
            return data;
        })
        .then(data => {
            btn.disabled = false;
            btn.innerText = 'Upload & Simpan';
            
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('modalUploadFoto')).hide();
                showSuccessPopup('Berhasil!', 'Foto berhasil disimpan.').then(() => {
                    const searchUrl = `{{ route('master-product.index') }}?search=${encodeURIComponent(searchInput.value)}`;
                    fetchTableData(searchUrl);
                });
            } else {
                showErrorPopup('Gagal', data.message || 'Terjadi kesalahan sistem.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerText = 'Upload & Simpan';
            showErrorPopup('Error', err.message || 'Gagal mengupload foto. Pastikan ukuran tidak terlalu besar.');
        });
    });

    // Delegated event listener untuk delete karena tabel diload via AJAX
    document.getElementById('tableBody').addEventListener('submit', function(e) {
        if (e.target && e.target.classList.contains('delete-form')) {
            e.preventDefault();
            const form = e.target;
            showConfirmPopup(
                'Hapus Produk?', 
                'Data dan foto akan dihapus permanen.', 
                'Ya, Hapus', 
                'Batal', 
                true
            ).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
</script>
@endpush
@endsection
