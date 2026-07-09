@extends('laporanrepacking.main')
@section('title')
    LAPORAN REPACKING CRC
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .lrep-dashboard {
        padding-top: 6.5rem;
        padding-bottom: 3rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    .lrep-filter-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.9);
    }
    .lrep-table-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
    }
    .lrep-table-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 600;
        color: #0f172a;
    }
    .lrep-loading {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.75);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 5;
        border-radius: 1rem;
    }
    .lrep-loading.show { display: flex; }
    .lrep-panel { position: relative; }
    .lrep-dashboard .page-actions { position: relative; z-index: 3; }
    #lrepFormModal, #lrepDeleteModal { z-index: 1060; }
    .modal-backdrop { z-index: 1055; }
    #lrepFormModal .lrep-form-section {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1rem 1.1rem;
        background: #fff;
        border-top: 3px solid #2563eb;
    }
    #lrepFormModal .lrep-section-head {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 0.85rem;
        color: #0f172a;
    }
    .status-badge-ok { background: #dcfce7; color: #166534; }
    .status-badge-ng { background: #fee2e2; color: #991b1b; }
    .status-badge-proses { background: #fef3c7; color: #92400e; }
    #lrepTable tbody tr:hover { background-color: #f8fafc; }
    .lrep-attr-scan .input-group .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .lrep-attr-scan .input-group .btn {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }
    .lrep-qr-wrap {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        overflow: hidden;
        background: #0f172a;
    }
    .lrep-qr-wrap #lrepQrReader {
        width: 100%;
        min-height: 240px;
    }
    .lrep-qr-wrap #lrepQrReader video {
        border-radius: 0.5rem;
        width: 100% !important;
        object-fit: cover;
    }
    #btnLrepScanQr.active {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }
    @media (max-width: 767.98px) {
        .lrep-dashboard {
            padding-top: 5.25rem;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        #lrepFormModal .modal-dialog {
            max-width: 100%;
            margin: 0;
        }
        #lrepFormModal .modal-content {
            min-height: 100dvh;
            border-radius: 0;
        }
    }
</style>
@endpush

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'success', title: 'Berhasil', text: @json(session('success')), timer: 1700, showConfirmButton: false });
    });
</script>
@endif

<div class="container-fluid lrep-dashboard px-2 px-md-3 px-lg-4" id="tambah-data">
    <div class="row mb-4 align-items-center g-2">
        <div class="col-12 col-md">
            <h2 class="fw-bold text-dark mb-1">Laporan Repacking CRC</h2>
            <p class="text-muted mb-0 small">Input dan monitoring pelaporan repackaging material CRC — tanpa reload halaman.</p>
        </div>
        <div class="col-12 col-md-auto d-flex flex-wrap gap-2 page-actions">
            <button type="button" class="btn btn-success rounded-pill px-4" id="btnExportData" title="Unduh data sesuai filter aktif">
                <i class="bi bi-download me-1"></i> Export Data
            </button>
            <button type="button"
                    class="btn btn-primary rounded-pill px-4"
                    id="btnTambahData"
                    data-bs-toggle="modal"
                    data-bs-target="#lrepFormModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Data
            </button>
        </div>
    </div>

    <div class="lrep-filter-card p-3 p-md-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Dari tanggal</label>
                <input type="date" class="form-control" id="filterFrom">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Sampai tanggal</label>
                <input type="date" class="form-control" id="filterTo">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Status</label>
                <select class="form-select" id="filterStatus">
                    <option value="">Semua</option>
                    @foreach($statusOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Group</label>
                <select class="form-select" id="filterGroup">
                    <option value="">Semua</option>
                    @foreach($groupOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label fw-semibold small">Cari</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="filterSearch" placeholder="Attribute, keterangan, dibuat oleh…">
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <button type="button" class="btn btn-outline-secondary w-100" id="btnResetFilter" title="Reset filter">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>
        <div class="mt-2 small text-muted" id="filterSummary">Memuat data…</div>
    </div>

    <div class="lrep-panel">
        <div class="lrep-loading" id="tableLoading">
            <div class="spinner-border text-primary" role="status"></div>
        </div>

        <div class="card lrep-table-card">
            <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span>Data Pelaporan Repacking CRC</span>
                <span class="badge bg-primary rounded-pill" id="tableCount">0 data</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="lrepTable">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Attribute</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Group</th>
                                <th>Wrapping</th>
                                <th>VCI Paper</th>
                                <th>Keterangan</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center" style="width:130px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="lrepTableBody">
                            <tr>
                                <td colspan="10" class="text-center text-muted py-5">Memuat…</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
                <div class="small text-muted" id="lrepPaginationInfo">—</div>
                <nav aria-label="Paginasi tabel">
                    <ul class="pagination pagination-sm mb-0" id="lrepPagination"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
{{-- Modal Tambah / Edit --}}
<div class="modal fade" id="lrepFormModal" tabindex="-1" aria-labelledby="lrepFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="lrepFormModalLabel">Tambah Laporan Repacking CRC</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="lrepForm" novalidate>
                <div class="modal-body">
                    <div id="lrepFormErrors" class="alert alert-danger d-none" role="alert"></div>
                    <input type="hidden" id="lrepRecordId" name="id" value="">

                    <div class="lrep-form-section mb-3">
                        <div class="lrep-section-head">
                            <i class="bi bi-box-seam text-primary"></i>
                            <span>Informasi Material CRC</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 lrep-attr-scan">
                                <label class="form-label fw-semibold" for="lrepAtributte">Attribute <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="atributte" id="lrepAtributte"
                                           placeholder="Scan QR atau ketik nomor attribute" required autocomplete="off">
                                    <button type="button" class="btn btn-outline-primary" id="btnLrepScanQr" title="Scan QR Code">
                                        <i class="bi bi-qr-code-scan"></i>
                                    </button>
                                </div>
                                <div id="lrepQrReaderWrap" class="lrep-qr-wrap mt-2 d-none">
                                    <div id="lrepQrReader"></div>
                                    <div class="p-2 bg-white">
                                        <button type="button" class="btn btn-sm btn-outline-danger w-100" id="btnLrepCloseQr">
                                            <i class="bi bi-camera-video-off me-1"></i> Tutup Kamera
                                        </button>
                                    </div>
                                </div>
                                <small class="text-muted">Arahkan kamera ke QR code attribute coil.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="lrepTanggal">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal" id="lrepTanggal" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="lrepStatus">Status <span class="text-danger">*</span></label>
                                <select class="form-select" name="status" id="lrepStatus" required>
                                    <option value="">— Pilih status —</option>
                                    @foreach($statusOptions as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="lrepGroup">Group <span class="text-danger">*</span></label>
                                <select class="form-select" name="group" id="lrepGroup" required>
                                    <option value="">— Pilih group —</option>
                                    @foreach($groupOptions as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="lrep-form-section" id="lrepKondisiPackingSection" style="display: none;">
                        <div class="lrep-section-head">
                            <i class="bi bi-layers text-primary"></i>
                            <span>Kondisi Packing</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="lrepWrapping">Plastik Wrapping <span class="text-danger">*</span></label>
                                <select class="form-select" name="wrapping" id="lrepWrapping" required>
                                    <option value="">— Pilih kondisi —</option>
                                    @foreach($wrappingOptions as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="lrepVcipaper">VCI Paper <span class="text-danger">*</span></label>
                                <select class="form-select" name="vcipaper" id="lrepVcipaper" required>
                                    <option value="">— Pilih kondisi —</option>
                                    @foreach($vcipaperOptions as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="lrepKeterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="lrepKeterangan" rows="3"
                                          placeholder="Catatan tambahan (opsional)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap gap-2">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4" id="lrepFormSubmit">
                        <span class="submit-text">Simpan</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="lrepDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Yakin ingin menghapus laporan repacking berikut?</p>
                <p class="mb-0 small text-muted" id="lrepDeleteSummary">—</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger rounded-pill px-4" id="lrepDeleteConfirm">
                    <span class="delete-text">Hapus</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
(function () {
    const apiUrl = @json(route('laporanrep.dashboard-data'));
    const exportUrl = @json(route('laporanrepacking.export'));
    const storeUrl = @json(route('laporanrepacking.create'));
    const updateUrlTemplate = @json(url('laporan-repacking/update/__ID__'));
    const destroyUrlTemplate = @json(url('laporan-repacking/destroy/__ID__'));
    const showUrlTemplate = @json(url('laporan-repacking/show/__ID__'));
    const printUrlTemplate = @json(url('laporan-repacking/print/__ID__'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

    let currentPage = 1;
    const perPage = 15;
    let debounceTimer = null;
    let deleteTargetId = null;
    let lrepQrScanner = null;
    let lrepQrActive = false;

    function getModal(modalEl) {
        if (!modalEl || typeof bootstrap === 'undefined') return null;
        return bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
    }

    function hideFormModal() {
        stopLrepQrScanner();
        if (!formModalEl || typeof bootstrap === 'undefined') return;
        const instance = bootstrap.Modal.getInstance(formModalEl) || formModal || getModal(formModalEl);
        instance?.hide();
    }

    const formModalEl = document.getElementById('lrepFormModal');
    const deleteModalEl = document.getElementById('lrepDeleteModal');
    let formModal = null;
    let deleteModal = null;

    const el = (id) => document.getElementById(id);

    function stopLrepQrScanner() {
        const wrap = el('lrepQrReaderWrap');
        const scanBtn = el('btnLrepScanQr');

        if (!lrepQrScanner || !lrepQrActive) {
            wrap?.classList.add('d-none');
            scanBtn?.classList.remove('active');
            return;
        }

        lrepQrScanner.stop().then(() => {
            lrepQrScanner.clear();
            lrepQrActive = false;
            lrepQrScanner = null;
            wrap?.classList.add('d-none');
            scanBtn?.classList.remove('active');
        }).catch(() => {
            lrepQrActive = false;
            lrepQrScanner = null;
            wrap?.classList.add('d-none');
            scanBtn?.classList.remove('active');
        });
    }

    function startLrepQrScanner() {
        if (typeof Html5Qrcode === 'undefined') {
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Library QR scanner belum dimuat.' });
            return;
        }

        if (lrepQrActive) {
            stopLrepQrScanner();
            return;
        }

        const wrap = el('lrepQrReaderWrap');
        const scanBtn = el('btnLrepScanQr');
        wrap?.classList.remove('d-none');
        scanBtn?.classList.add('active');

        const formats = [
            Html5QrcodeSupportedFormats.QR_CODE,
            Html5QrcodeSupportedFormats.DATA_MATRIX,
            Html5QrcodeSupportedFormats.CODE_128,
            Html5QrcodeSupportedFormats.CODE_39
        ];
        lrepQrScanner = new Html5Qrcode('lrepQrReader', { formatsToSupport: formats });
        
        lrepQrScanner.start(
            { facingMode: 'environment' },
            { 
                fps: 15, 
                qrbox: { width: 250, height: 250 },
                disableFlip: false
            },
            (decodedText) => {
                const value = String(decodedText || '').trim();
                if (!value) return;

                el('lrepAtributte').value = value;
                el('lrepAtributte').dispatchEvent(new Event('input', { bubbles: true }));
                stopLrepQrScanner();
                Swal.fire({
                    icon: 'success',
                    title: 'QR Terbaca',
                    text: value,
                    timer: 1400,
                    showConfirmButton: false,
                });
            },
            () => {}
        ).then(() => {
            lrepQrActive = true;
        }).catch((err) => {
            stopLrepQrScanner();
            Swal.fire({
                icon: 'error',
                title: 'Kamera',
                text: 'Tidak dapat mengakses kamera. Izinkan akses kamera di browser Anda.',
            });
            console.error(err);
        });
    }

    function defaultDates() {
        const to = new Date();
        const from = new Date();
        from.setDate(from.getDate() - 30);
        el('filterTo').value = to.toISOString().slice(0, 10);
        el('filterFrom').value = from.toISOString().slice(0, 10);
    }

    function params() {
        const p = new URLSearchParams();
        p.set('from', el('filterFrom').value);
        p.set('to', el('filterTo').value);
        const status = el('filterStatus').value;
        const group = el('filterGroup').value;
        const search = el('filterSearch').value.trim();
        if (status) p.set('status', status);
        if (group) p.set('group', group);
        if (search) p.set('search', search);
        p.set('page', String(currentPage));
        return p;
    }

    function setLoading(on) {
        el('tableLoading').classList.toggle('show', on);
    }

    function escapeHtml(str) {
        return String(str ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function escapeAttr(str) {
        return String(str ?? '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function statusBadge(status) {
        const s = String(status ?? '');
        let cls = 'status-badge-proses';
        if (s === 'Skip Lama') cls = 'status-badge-ok';
        else if (s === 'Retur') cls = 'status-badge-ng';
        else if (s === 'Naik Lagi') cls = 'status-badge-proses';
        return `<span class="badge rounded-pill ${cls}">${escapeHtml(s)}</span>`;
    }

    function formatNumber(n) {
        return new Intl.NumberFormat('id-ID').format(n);
    }

    function renderPagination(pg) {
        const info = el('lrepPaginationInfo');
        const ul = el('lrepPagination');
        if (!pg || !pg.total) {
            info.textContent = 'Tidak ada data';
            ul.innerHTML = '';
            return;
        }
        info.textContent = `Menampilkan ${formatNumber(pg.from)}–${formatNumber(pg.to)} dari ${formatNumber(pg.total)} data`;

        if (pg.last_page <= 1) {
            ul.innerHTML = '';
            return;
        }

        const pages = [];
        const addPage = (n, label = null, active = false, disabled = false) => {
            pages.push({ n, label: label ?? String(n), active, disabled });
        };

        addPage(pg.current_page - 1, '‹', false, pg.current_page <= 1);

        let start = Math.max(1, pg.current_page - 2);
        let end = Math.min(pg.last_page, pg.current_page + 2);
        if (pg.current_page <= 3) end = Math.min(5, pg.last_page);
        if (pg.current_page >= pg.last_page - 2) start = Math.max(1, pg.last_page - 4);

        if (start > 1) {
            addPage(1);
            if (start > 2) pages.push({ n: null, label: '…', disabled: true });
        }
        for (let i = start; i <= end; i++) {
            addPage(i, String(i), i === pg.current_page);
        }
        if (end < pg.last_page) {
            if (end < pg.last_page - 1) pages.push({ n: null, label: '…', disabled: true });
            addPage(pg.last_page);
        }

        addPage(pg.current_page + 1, '›', false, pg.current_page >= pg.last_page);

        ul.innerHTML = pages.map((p) => {
            if (p.n === null) {
                return `<li class="page-item disabled"><span class="page-link">${p.label}</span></li>`;
            }
            const cls = ['page-item'];
            if (p.active) cls.push('active');
            if (p.disabled) cls.push('disabled');
            return `<li class="${cls.join(' ')}">
                <button type="button" class="page-link" data-page="${p.n}" ${p.disabled ? 'disabled' : ''}>${p.label}</button>
            </li>`;
        }).join('');
    }

    function renderTable(rows, pagination, filters) {
        const tbody = el('lrepTableBody');
        const pg = pagination || {};

        el('tableCount').textContent = formatNumber(pg.total || 0) + ' data';
        el('filterSummary').textContent =
            `Rentang ${filters.from} s/d ${filters.to}` +
            (filters.search ? ` · Pencarian: "${filters.search}"` : '') +
            ` · Total: ${formatNumber(pg.total || 0)} data`;

        renderPagination(pg);

        if (!rows.length) {
            tbody.innerHTML = '<tr><td colspan="10" class="text-center text-muted py-5">Tidak ada data untuk filter ini.</td></tr>';
            return;
        }

        const rowOffset = ((pg.current_page || 1) - 1) * (pg.per_page || perPage);
        tbody.innerHTML = rows.map((r, i) => `
            <tr data-id="${r.id}">
                <td>${rowOffset + i + 1}</td>
                <td class="fw-semibold">${escapeHtml(r.atributte)}</td>
                <td>${escapeHtml(r.tanggal)}</td>
                <td>${statusBadge(r.status)}</td>
                <td>${escapeHtml(r.group)}</td>
                <td>${escapeHtml(r.wrapping)}</td>
                <td>${escapeHtml(r.vcipaper)}</td>
                <td class="small">${escapeHtml(r.keterangan)}</td>
                <td class="small text-muted">${escapeHtml(r.created_by)}</td>
                <td class="text-center text-nowrap">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-edit-lrep" title="Edit" data-id="${r.id}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <a href="${printUrlTemplate.replace('__ID__', r.id)}" target="_blank"
                       class="btn btn-sm btn-outline-success" title="Print">
                        <i class="bi bi-printer"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete-lrep" title="Hapus"
                            data-id="${r.id}"
                            data-label="${escapeAttr(r.atributte + ' · ' + r.tanggal)}">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `).join('');
    }

    async function fetchData() {
        setLoading(true);
        try {
            const res = await fetch(apiUrl + '?' + params().toString(), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!res.ok) throw new Error('Gagal memuat data');
            const data = await res.json();
            renderTable(data.rows || [], data.pagination || {}, data.filters || {});
        } catch (err) {
            el('lrepTableBody').innerHTML =
                '<tr><td colspan="10" class="text-center text-danger py-5">Gagal memuat data. Silakan coba lagi.</td></tr>';
            el('filterSummary').textContent = 'Terjadi kesalahan saat memuat data.';
        } finally {
            setLoading(false);
        }
    }

    function scheduleFetch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            currentPage = 1;
            fetchData();
        }, 350);
    }

    function urlWithId(template, id) {
        return template.replace('__ID__', id);
    }

    function showFormErrors(errors) {
        const box = el('lrepFormErrors');
        if (!errors || (typeof errors === 'object' && !Object.keys(errors).length)) {
            box.classList.add('d-none');
            box.innerHTML = '';
            return;
        }
        let html = '';
        if (typeof errors === 'string') {
            html = errors;
        } else {
            Object.values(errors).forEach((msgs) => {
                (Array.isArray(msgs) ? msgs : [msgs]).forEach((m) => { html += `<div>${escapeHtml(m)}</div>`; });
            });
        }
        box.innerHTML = html;
        box.classList.remove('d-none');
    }

    function setFormSubmitting(on) {
        const btn = el('lrepFormSubmit');
        btn.disabled = on;
        btn.querySelector('.submit-text').classList.toggle('d-none', on);
        btn.querySelector('.spinner-border').classList.toggle('d-none', !on);
    }

    function resetForm() {
        stopLrepQrScanner();
        el('lrepForm').reset();
        el('lrepRecordId').value = '';
        el('lrepTanggal').value = new Date().toISOString().slice(0, 10);
        showFormErrors(null);
        el('lrepForm')?.querySelectorAll('.is-invalid').forEach((f) => f.classList.remove('is-invalid'));
        if (el('lrepKondisiPackingSection')) {
            el('lrepKondisiPackingSection').style.display = 'none';
        }
    }

    function openAddModal() {
        resetForm();
        el('lrepFormModalLabel').textContent = 'Tambah Laporan Repacking CRC';
        if (!formModal) formModal = getModal(formModalEl);
        formModal?.show();
    }

    async function openEditModal(id) {
        resetForm();
        el('lrepFormModalLabel').textContent = 'Edit Laporan Repacking CRC';
        try {
            const res = await fetch(urlWithId(showUrlTemplate, id), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!res.ok) throw new Error('Data tidak ditemukan');
            const data = await res.json();
            const r = data.record;
            el('lrepRecordId').value = r.id;
            el('lrepAtributte').value = r.atributte;
            el('lrepTanggal').value = r.tanggal;
            el('lrepStatus').value = r.status;
            el('lrepGroup').value = r.group;
            
            if (r.status) {
                el('lrepKondisiPackingSection').style.display = 'block';
            }
            
            el('lrepWrapping').value = r.wrapping;
            el('lrepVcipaper').value = r.vcipaper;
            el('lrepKeterangan').value = r.keterangan;
            if (!formModal) formModal = getModal(formModalEl);
            formModal?.show();
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Tidak dapat memuat data untuk diedit.' });
        }
    }

    el('btnTambahData')?.addEventListener('click', function () {
        resetForm();
        el('lrepFormModalLabel').textContent = 'Tambah Laporan Repacking CRC';
    });

    formModalEl?.addEventListener('show.bs.modal', function () {
        formModal = getModal(formModalEl);
    });

    formModalEl?.addEventListener('hidden.bs.modal', function () {
        stopLrepQrScanner();
        el('lrepRecordId').value = '';
        resetForm();
    });

    el('btnLrepScanQr')?.addEventListener('click', startLrepQrScanner);
    el('btnLrepCloseQr')?.addEventListener('click', stopLrepQrScanner);

    el('lrepStatus')?.addEventListener('change', function () {
        const val = this.value;
        const section = el('lrepKondisiPackingSection');
        if (!section) return;
        
        if (val) {
            section.style.display = 'block';
            if (val === 'Retur') {
                el('lrepWrapping').value = 'Tidak Pakai';
                el('lrepVcipaper').value = 'Pakai';
            } else if (val === 'Naik Lagi') {
                el('lrepWrapping').value = 'Pakai';
                el('lrepVcipaper').value = 'Tidak Pakai';
            } else if (val === 'Skip Lama') {
                el('lrepWrapping').value = 'Pakai';
                el('lrepVcipaper').value = 'Pakai';
            }
        } else {
            section.style.display = 'none';
            el('lrepWrapping').value = '';
            el('lrepVcipaper').value = '';
        }
    });

    el('btnExportData')?.addEventListener('click', function () {
        const p = params();
        p.delete('page');
        window.location.href = exportUrl + '?' + p.toString();
    });

    el('btnResetFilter')?.addEventListener('click', function () {
        defaultDates();
        el('filterStatus').value = '';
        el('filterGroup').value = '';
        el('filterSearch').value = '';
        currentPage = 1;
        fetchData();
    });

    ['filterFrom', 'filterTo', 'filterStatus', 'filterGroup'].forEach((id) => {
        el(id)?.addEventListener('change', function () {
            currentPage = 1;
            fetchData();
        });
    });

    el('filterSearch')?.addEventListener('input', scheduleFetch);

    el('lrepPagination')?.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-page]');
        if (!btn || btn.disabled) return;
        currentPage = parseInt(btn.dataset.page, 10);
        fetchData();
    });

    document.getElementById('lrepTableBody')?.addEventListener('click', function (e) {
        const editBtn = e.target.closest('.btn-edit-lrep');
        const deleteBtn = e.target.closest('.btn-delete-lrep');
        if (editBtn) openEditModal(editBtn.dataset.id);
        if (deleteBtn) {
            deleteTargetId = deleteBtn.dataset.id;
            el('lrepDeleteSummary').textContent = deleteBtn.dataset.label || '—';
            if (!deleteModal) deleteModal = getModal(deleteModalEl);
            deleteModal?.show();
        }
    });

    el('lrepForm')?.addEventListener('submit', async function (e) {
        e.preventDefault();
        showFormErrors(null);
        setFormSubmitting(true);

        const id = el('lrepRecordId').value;
        const url = id ? urlWithId(updateUrlTemplate, id) : storeUrl;
        const method = id ? 'PUT' : 'POST';

        const formData = new FormData(el('lrepForm'));
        const body = Object.fromEntries(formData.entries());
        delete body.id;

        try {
            const res = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(body),
            });

            const data = await res.json().catch(() => ({}));

            if (!res.ok) {
                showFormErrors(data.errors || data.message || 'Validasi gagal.');
                setFormSubmitting(false);
                return;
            }

            hideFormModal();
            setFormSubmitting(false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message || 'Data berhasil disimpan',
                timer: 1500,
                showConfirmButton: false,
            });
            fetchData();
        } catch (err) {
            setFormSubmitting(false);
            showFormErrors('Terjadi kesalahan jaringan. Silakan coba lagi.');
        }
    });

    el('lrepDeleteConfirm')?.addEventListener('click', async function () {
        if (!deleteTargetId) return;
        const btn = el('lrepDeleteConfirm');
        btn.disabled = true;
        btn.querySelector('.delete-text').classList.add('d-none');
        btn.querySelector('.spinner-border').classList.remove('d-none');

        try {
            const res = await fetch(urlWithId(destroyUrlTemplate, deleteTargetId), {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            const data = await res.json().catch(() => ({}));
            deleteModal?.hide();
            if (res.ok) {
                Swal.fire({ icon: 'success', title: 'Berhasil', text: data.message || 'Data dihapus', timer: 1500, showConfirmButton: false });
                fetchData();
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal menghapus data.' });
            }
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan jaringan.' });
        } finally {
            btn.disabled = false;
            btn.querySelector('.delete-text').classList.remove('d-none');
            btn.querySelector('.spinner-border').classList.add('d-none');
            deleteTargetId = null;
        }
    });

    defaultDates();
    fetchData();

    const editId = new URLSearchParams(window.location.search).get('edit');
    if (editId) openEditModal(editId);

    if (window.location.hash === '#tambah-data') openAddModal();
})();
});
</script>
@endpush
