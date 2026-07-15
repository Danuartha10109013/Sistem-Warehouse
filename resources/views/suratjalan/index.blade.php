@extends('laporanrepacking.main')

@section('title')
    Scan Surat Jalan
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .sj-wrap {
        padding-top: 6.25rem;
        padding-bottom: 3rem;
        max-width: 1440px;
        margin: 0 auto;
    }

    .sj-shell {
        background:
            radial-gradient(circle at top left, rgba(37, 99, 235, 0.12), transparent 35%),
            radial-gradient(circle at bottom right, rgba(16, 185, 129, 0.10), transparent 30%),
            #f8fafc;
        border: 1px solid rgba(226, 232, 240, 0.95);
        border-radius: 1.25rem;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .sj-hero {
        padding: 1.5rem;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.94), rgba(37, 99, 235, 0.90));
        color: #fff;
    }

    .sj-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
    }

    .sj-preview {
        border: 1px dashed #cbd5e1;
        border-radius: 0.9rem;
        height: 400px; /* Batasi tinggi preview agar tidak merusak modal */
        background: #f8fafc;
        display: flex;
        align-items: flex-start; /* Mulai dari atas */
        justify-content: center;
        overflow: auto; /* Aktifkan scroll (geser-geser) jika gambar kebesaran */
        position: relative;
    }

    .sj-preview img,
    .sj-preview iframe {
        width: 100%;
        height: auto; /* Biarkan tinggi menyesuaikan agar proporsional */
        background: #fff;
    }

    .sj-preview .placeholder {
        color: #64748b;
        text-align: center;
        padding: 1rem;
    }

    .sj-table thead th {
        background: #f8fafc;
        color: #0f172a;
        font-weight: 600;
        border-bottom: 1px solid #e2e8f0 !important;
        white-space: nowrap;
    }

    .sj-badge {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #fff;
    }

    @media (max-width: 767.98px) {
        .sj-wrap {
            padding-top: 5.25rem;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }
</style>
@endpush

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid sj-wrap px-2 px-md-3 px-lg-4" id="surat-jalan-app">
    <div class="sj-shell">
        <div class="sj-hero d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
            <div>
                <div class="small text-uppercase opacity-75 mb-2">Modul Dokumentasi</div>
                <h2 class="fw-bold mb-2">Scan Surat Jalan</h2>
                <p class="mb-0 text-white-75">Simpan hasil scan ke server, tampilkan preview, lalu kelola data surat jalan langsung dari tabel utama.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge rounded-pill sj-badge px-3 py-2"><i class="bi bi-image me-1"></i> Base64 / Blob</span>
                <span class="badge rounded-pill sj-badge px-3 py-2"><i class="bi bi-cloud-arrow-up me-1"></i> AJAX Save</span>
                <button type="button" class="btn btn-light rounded-pill px-4" id="btnOpenForm">
                    <i class="bi bi-plus-circle me-1"></i> Input Baru
                </button>
            </div>
        </div>

        <div class="p-3 p-md-4">
            <div class="row g-3 mb-4">
                <div class="col-12 col-lg-3">
                    <div class="sj-card p-3 h-100">
                        <div class="text-muted small">Total Data</div>
                        <div class="fs-3 fw-bold" id="summaryTotal">0</div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="sj-card p-3 h-100">
                        <div class="row g-3 align-items-end">
                            <div class="col-12 col-lg-8">
                                <label class="form-label fw-semibold small">Cari data</label>
                                <input type="text" class="form-control" id="searchInput" placeholder="No. surat jalan atau business partner">
                            </div>
                            <div class="col-12 col-lg-4 d-grid d-lg-flex gap-2">
                                <button type="button" class="btn btn-outline-secondary" id="btnResetSearch">Reset</button>
                                <button type="button" class="btn btn-primary" id="btnSearch">
                                    <i class="bi bi-search me-1"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sj-card mb-4 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center border-bottom">
                    <strong>Daftar Surat Jalan</strong>
                    <span class="badge text-bg-primary rounded-pill" id="tableCount">0 data</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 sj-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Surat Jalan</th>
                                <th>Business Partner</th>
                                <th>Tanggal Receive</th>
                                <th>Foto Scan</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="small text-muted" id="paginationInfo">—</div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0" id="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modals')
<div class="modal fade" id="suratJalanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="suratJalanModalTitle">Input Surat Jalan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="suratJalanForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="recordId" name="id" value="">
                    <input type="hidden" id="scanPayload" name="scan_payload" value="">

                    <div class="alert alert-danger d-none" id="formErrors"></div>

                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label fw-semibold">Nomor Surat Jalan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="noSuratJalan" name="no_surat_jalan" placeholder="SJ-0001" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label fw-semibold">Business Partner <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="businessPartner" name="business_partner" placeholder="Nama vendor / customer" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label fw-semibold">Receive Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="receiveDate" name="receive_date" required>
                        </div>
                        <div class="col-12 col-lg-6 d-flex align-items-end gap-2 flex-wrap">
                            <button type="button" class="btn btn-outline-primary" id="btnScanDocument">
                                <i class="bi bi-printer me-1"></i> Scan Surat Jalan
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="btnPickFile">
                                <i class="bi bi-upload me-1"></i> Pilih File
                            </button>
                            <button type="button" class="btn btn-outline-danger" id="btnClearScan">
                                <i class="bi bi-x-circle me-1"></i> Hapus Preview
                            </button>
                            <input type="file" id="scanFileInput" accept="image/*,application/pdf" class="d-none">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Preview Hasil Scan</label>
                            <div class="sj-preview" id="scanPreview">
                                <div class="placeholder" id="scanPlaceholder">
                                    <div class="fw-semibold mb-1">Belum ada hasil scan</div>
                                    <div class="small">Gunakan Scanner.js atau pilih file gambar/PDF sebagai fallback.</div>
                                </div>
                                <img id="scanPreviewImage" class="d-none" alt="Preview scan">
                                <iframe id="scanPreviewPdf" class="d-none" title="Preview PDF"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4" id="btnSubmitForm">
                        <span class="submit-text">Simpan</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Surat Jalan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Yakin ingin menghapus data ini?</p>
                <p class="small text-muted mb-0" id="deleteSummary">—</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger px-4" id="btnDeleteConfirm">
                    <span class="delete-text">Hapus</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Preview Surat Jalan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center bg-light">
                <img id="modalPreviewImage" src="" class="img-fluid rounded shadow" alt="Preview" style="max-height: 75vh;">
            </div>
        </div>
    </div>
</div>
@endpush
@endsection

@push('scripts')
<script src="https://cdn.asprise.com/scannerjs/scanner.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const apiUrl = @json(route('suratjalan.dashboard-data'));
    const storeUrl = @json(route('suratjalan.store'));
    const updateUrlTemplate = @json(url('surat-jalan/update/__ID__'));
    const showUrlTemplate = @json(url('surat-jalan/show/__ID__'));
    const destroyUrlTemplate = @json(url('surat-jalan/destroy/__ID__'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

    const modalEl = document.getElementById('suratJalanModal');
    const deleteModalEl = document.getElementById('deleteConfirmModal');
    const form = document.getElementById('suratJalanForm');
    const tableBody = document.getElementById('tableBody');
    const pagination = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');
    const scanPayload = document.getElementById('scanPayload');
    const scanFileInput = document.getElementById('scanFileInput');
    const scanPreviewImage = document.getElementById('scanPreviewImage');
    const scanPreviewPdf = document.getElementById('scanPreviewPdf');
    const scanPlaceholder = document.getElementById('scanPlaceholder');
    const btnSubmitForm = document.getElementById('btnSubmitForm');
    const formErrors = document.getElementById('formErrors');
    const deleteSummary = document.getElementById('deleteSummary');
    const btnDeleteConfirm = document.getElementById('btnDeleteConfirm');
    const summaryTotal = document.getElementById('summaryTotal');
    const tableCount = document.getElementById('tableCount');
    const paginationInfo = document.getElementById('paginationInfo');
    const modalTitle = document.getElementById('suratJalanModalTitle');

    let currentPage = 1;
    let deleteTargetId = null;

    const modal = typeof bootstrap !== 'undefined' ? new bootstrap.Modal(modalEl) : null;
    const deleteModal = typeof bootstrap !== 'undefined' ? new bootstrap.Modal(deleteModalEl) : null;

    function setLoading(button, loading) {
        const text = button.querySelector('.submit-text, .delete-text');
        const spinner = button.querySelector('.spinner-border');
        if (text) text.classList.toggle('d-none', loading);
        if (spinner) spinner.classList.toggle('d-none', !loading);
        button.disabled = loading;
    }

    function resetPreview() {
        scanPayload.value = '';
        scanFileInput.value = '';
        scanPreviewImage.src = '';
        scanPreviewPdf.src = '';
        scanPreviewImage.classList.add('d-none');
        scanPreviewPdf.classList.add('d-none');
        scanPlaceholder.classList.remove('d-none');
    }

    function showPreviewFromDataUrl(dataUrl) {
        resetPreview();
        scanPayload.value = dataUrl;
        scanPlaceholder.classList.add('d-none');

        if (dataUrl.startsWith('data:application/pdf')) {
            scanPreviewPdf.src = dataUrl;
            scanPreviewPdf.classList.remove('d-none');
            return;
        }

        scanPreviewImage.src = dataUrl;
        scanPreviewImage.classList.remove('d-none');
    }

    function fileToDataUrl(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(String(reader.result || ''));
            reader.onerror = () => reject(new Error('Gagal membaca file.'));
            reader.readAsDataURL(file);
        });
    }

    async function compressImage(file, quality = 0.7, maxWidth = 1200) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = event => {
                const img = new Image();
                img.src = event.target.result;
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;

                    if (width > maxWidth) {
                        height = Math.round((height * maxWidth) / width);
                        width = maxWidth;
                    }

                    canvas.width = width;
                    canvas.height = height;

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    // Kompresi ke format JPEG
                    const compressedDataUrl = canvas.toDataURL('image/jpeg', quality);
                    resolve(compressedDataUrl);
                };
                img.onerror = error => reject(error);
            };
            reader.onerror = error => reject(error);
        });
    }

    async function handleFileInput(file) {
        if (!file) return;
        
        let dataUrl;
        if (file.type.startsWith('image/')) {
            // Kompres gambar dengan maksimal lebar 1200px dan kualitas 70%
            dataUrl = await compressImage(file, 0.7, 1200);
        } else {
            // Jika PDF atau format lain, konversi langsung
            dataUrl = await fileToDataUrl(file);
        }
        
        showPreviewFromDataUrl(dataUrl);
    }

    async function tryScannerIntegration() {
        // Tampilkan loading SweetAlert
        Swal.fire({
            title: 'Sedang Men-scan...',
            text: 'Mohon tunggu, mesin scanner sedang bekerja. Jangan tutup halaman ini.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            // 1. Panggil API lokal kita
            const res = await fetch("{{ route('laravel.scan') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await res.json();

            if (!data.success) {
                throw new Error(data.message || 'Gagal men-scan dokumen.');
            }

            // 2. Ambil gambar hasil scan sebagai Blob
            const imageRes = await fetch(data.file_url + '?t=' + new Date().getTime());
            const imageBlob = await imageRes.blob();

            // 3. Ubah Blob menjadi Data URL untuk disimpan ke scan_payload
            const dataUrl = await fileToDataUrl(imageBlob);
            
            // 4. Tampilkan ke preview
            showPreviewFromDataUrl(dataUrl);

            Swal.close();
            
            // Optional: Beri tahu sukses
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'Scan berhasil!'
            });

        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Scan Gagal',
                text: error.message || 'Pastikan mesin menyala dan kabel USB terhubung.'
            });
        }
    }

    function clearForm() {
        form.reset();
        document.getElementById('recordId').value = '';
        modalTitle.textContent = 'Input Surat Jalan';
        resetPreview();
        formErrors.classList.add('d-none');
        formErrors.innerHTML = '';
    }

    function openForm(record = null) {
        clearForm();

        if (record) {
            document.getElementById('recordId').value = record.id || '';
            document.getElementById('noSuratJalan').value = record.no_surat_jalan || '';
            document.getElementById('businessPartner').value = record.business_partner || '';
            document.getElementById('receiveDate').value = record.receive_date || '';
            modalTitle.textContent = 'Edit Surat Jalan';

            if (record.foto_scan_url) {
                showPreviewFromDataUrl(record.foto_scan_url);
                scanPayload.value = '';
            }
        }

        modal?.show();
    }

    function renderRows(rows, paginationData) {
        if (!rows.length) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-5">Tidak ada data.</td></tr>';
            return;
        }

        tableBody.innerHTML = rows.map((row, index) => {
            const number = ((paginationData.current_page - 1) * paginationData.per_page) + index + 1;
            const viewBtn = row.foto_scan_url
                ? `<button type="button" class="btn btn-sm btn-outline-success btn-view-file" data-url="${row.foto_scan_url}" title="View file"><i class="bi bi-eye"></i></button>`
                : `<button type="button" class="btn btn-sm btn-outline-success" disabled title="File tidak tersedia"><i class="bi bi-eye"></i></button>`;

            const thumbnail = row.foto_scan_url 
                ? `<img src="${row.foto_scan_url}" class="border rounded btn-view-file" data-url="${row.foto_scan_url}" style="height: 40px; cursor: pointer;" alt="Scan">`
                : `<span class="text-muted">-</span>`;

            return `
                <tr>
                    <td>${number}</td>
                    <td>${row.no_surat_jalan}</td>
                    <td>${row.business_partner}</td>
                    <td>${row.receive_date_label}</td>
                    <td>${thumbnail}</td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-1">
                            <button type="button" class="btn btn-sm btn-outline-primary btn-edit" data-id="${row.id}" title="Edit"><i class="bi bi-pencil"></i></button>
                            ${viewBtn}
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="${row.id}" data-label="${row.no_surat_jalan}" title="Delete"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    function renderPagination(data) {
        pagination.innerHTML = '';

        if (data.last_page <= 1) {
            return;
        }

        const createItem = (label, page, disabled = false, active = false) => {
            return `
                <li class="page-item ${disabled ? 'disabled' : ''} ${active ? 'active' : ''}">
                    <button class="page-link" type="button" data-page="${page}">${label}</button>
                </li>
            `;
        };

        pagination.insertAdjacentHTML('beforeend', createItem('&laquo;', Math.max(1, data.current_page - 1), data.current_page === 1));

        for (let page = 1; page <= data.last_page; page += 1) {
            pagination.insertAdjacentHTML('beforeend', createItem(page, page, false, page === data.current_page));
        }

        pagination.insertAdjacentHTML('beforeend', createItem('&raquo;', Math.min(data.last_page, data.current_page + 1), data.current_page === data.last_page));
    }

    async function loadData(page = 1) {
        currentPage = page;
        const search = searchInput.value.trim();
        const params = new URLSearchParams({ page: String(page) });
        if (search) params.set('search', search);

        tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-5">Memuat data...</td></tr>';

        try {
            const response = await fetch(`${apiUrl}?${params.toString()}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            summaryTotal.textContent = data.summary?.total_records ?? 0;
            tableCount.textContent = `${data.summary?.total_records ?? 0} data`;

            if (data.rows && data.rows.length) {
                renderRows(data.rows, data.pagination);
            } else {
                tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-5">Tidak ada data.</td></tr>';
            }

            renderPagination(data.pagination);
            paginationInfo.textContent = data.pagination?.total
                ? `Menampilkan ${data.pagination.from} - ${data.pagination.to} dari ${data.pagination.total} data`
                : '—';
        } catch (error) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger py-5">Gagal memuat data.</td></tr>';
            Swal.fire({ icon: 'error', title: 'Gagal', text: error.message || 'Gagal memuat data.' });
        }
    }

    async function fetchRecord(id) {
        const response = await fetch(showUrlTemplate.replace('__ID__', id), {
            headers: { 'Accept': 'application/json' }
        });

        const data = await response.json();
        return data.record;
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        formErrors.classList.add('d-none');
        formErrors.innerHTML = '';

        const recordId = document.getElementById('recordId').value;
        const url = recordId ? updateUrlTemplate.replace('__ID__', recordId) : storeUrl;
        const method = 'POST';
        const formData = new FormData(form);

        if (!scanPayload.value && !recordId) {
            Swal.fire({ icon: 'warning', title: 'Preview scan belum ada', text: 'Silakan scan atau pilih file terlebih dahulu.' });
            return;
        }

        setLoading(btnSubmitForm, true);

        try {
            const response = await fetch(url, {
                method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Gagal menyimpan data.');
            }

            modal?.hide();
            Swal.fire({ icon: 'success', title: 'Berhasil', text: data.message || 'Data berhasil disimpan.', timer: 1500, showConfirmButton: false });
            await loadData(currentPage);
        } catch (error) {
            formErrors.textContent = error.message || 'Terjadi kesalahan saat menyimpan data.';
            formErrors.classList.remove('d-none');
        } finally {
            setLoading(btnSubmitForm, false);
        }
    });

    document.getElementById('btnOpenForm').addEventListener('click', () => openForm());
    document.getElementById('btnScanDocument').addEventListener('click', tryScannerIntegration);
    document.getElementById('btnPickFile').addEventListener('click', () => scanFileInput.click());
    document.getElementById('btnClearScan').addEventListener('click', resetPreview);
    document.getElementById('btnSearch').addEventListener('click', () => loadData(1));
    document.getElementById('btnResetSearch').addEventListener('click', () => {
        searchInput.value = '';
        loadData(1);
    });

    scanFileInput.addEventListener('change', async function () {
        const file = this.files?.[0];
        if (!file) return;
        await handleFileInput(file);
    });

    pagination.addEventListener('click', function (event) {
        const button = event.target.closest('button[data-page]');
        if (!button || button.closest('.disabled')) return;
        loadData(Number(button.dataset.page || 1));
    });

    tableBody.addEventListener('click', async function (event) {
        const editButton = event.target.closest('.btn-edit');
        const deleteButton = event.target.closest('.btn-delete');
        const viewButton = event.target.closest('.btn-view-file');

        if (editButton) {
            const record = await fetchRecord(editButton.dataset.id);
            openForm(record);
        }

        if (viewButton && viewButton.dataset.url) {
            document.getElementById('modalPreviewImage').src = viewButton.dataset.url;
            new bootstrap.Modal(document.getElementById('previewModal')).show();
        }

        if (deleteButton) {
            deleteTargetId = deleteButton.dataset.id;
            deleteSummary.textContent = deleteButton.dataset.label || 'Data terpilih';
            deleteModal?.show();
        }
    });

    btnDeleteConfirm.addEventListener('click', async function () {
        if (!deleteTargetId) return;
        setLoading(btnDeleteConfirm, true);

        try {
            const response = await fetch(destroyUrlTemplate.replace('__ID__', deleteTargetId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: new FormData()
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Gagal menghapus data.');
            }

            deleteModal?.hide();
            deleteTargetId = null;
            Swal.fire({ icon: 'success', title: 'Berhasil', text: data.message || 'Data berhasil dihapus.', timer: 1500, showConfirmButton: false });
            await loadData(currentPage);
        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: error.message || 'Terjadi kesalahan.' });
        } finally {
            setLoading(btnDeleteConfirm, false);
        }
    });

    loadData(1);
});
</script>
@endpush
