@extends('laporanidod.main')
@section('title')
    Laporan ID & OD
@endsection

@push('styles')
<style>
    .idod-dashboard {
        padding-top: 6.5rem;
        padding-bottom: 3rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    .idod-filter-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.9);
    }
    .idod-stat-card {
        border: 0;
        border-radius: 1rem;
        color: #fff;
        overflow: hidden;
        min-height: 110px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
    }
    .idod-stat-card .stat-label {
        font-size: 0.8rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .idod-stat-card .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        line-height: 1.2;
    }
    .bg-stat-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8); }
    .bg-stat-success { background: linear-gradient(135deg, #059669, #047857); }
    .bg-stat-warning { background: linear-gradient(135deg, #d97706, #b45309); }
    .bg-stat-info { background: linear-gradient(135deg, #7c3aed, #6d28d9); }
    .idod-chart-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
        height: 100%;
    }
    .idod-chart-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 600;
        color: #0f172a;
    }
    .chart-wrap {
        position: relative;
        height: 280px;
    }
    .chart-wrap-sm {
        height: 240px;
    }
    .period-btn.active {
        background: #2563eb !important;
        border-color: #2563eb !important;
        color: #fff !important;
    }
    #idodTable tbody tr:hover {
        background-color: #f8fafc;
    }
    .idod-loading {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.75);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 5;
        border-radius: 1rem;
    }
    .idod-loading.show {
        display: flex;
    }
    .dashboard-panel {
        position: relative;
    }
    #idodFormModal .idod-form-section {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1rem 1.1rem;
        height: 100%;
        background: #fff;
    }
    #idodFormModal .idod-section-id {
        border-top: 3px solid #2563eb;
    }
    #idodFormModal .idod-section-od {
        border-top: 3px solid #059669;
    }
    #idodFormModal .idod-section-head {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 0.85rem;
        color: #0f172a;
    }
    #idodFormModal .idod-section-head .badge {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.03em;
    }
    #idodFormModal .idod-ng-field .form-label {
        color: #b91c1c;
    }
    #idodFormModal .idod-ng-field .form-control {
        border-color: #fecaca;
        background-color: #fffbfb;
    }
    #idodFormModal .idod-ng-field .form-control:focus {
        border-color: #f87171;
        box-shadow: 0 0 0 0.2rem rgba(248, 113, 113, 0.2);
    }
    #idodFormModal .idod-ok-field .form-label {
        color: #047857;
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

<div class="container-fluid idod-dashboard px-4">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-dark mb-1">Dashboard Laporan ID &amp; OD</h2>
            <p class="text-muted mb-0">Ringkasan data per hari, bulan, dan tahun — filter langsung tanpa reload halaman.</p>
        </div>
        <div class="col-auto d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-success rounded-pill px-4" id="btnExportExcel" title="Unduh data sesuai filter aktif (.xlsx)">
                <i class="fas fa-file-excel me-1"></i> Export Excel
            </button>
            <button type="button" class="btn btn-primary rounded-pill px-4" id="btnTambahData">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </button>
        </div>
    </div>

    <div class="idod-filter-card p-3 p-md-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-12 col-lg-3">
                <label class="form-label fw-semibold small text-muted mb-2">Periode grafik</label>
                <div class="btn-group w-100" role="group" id="periodGroup">
                    <button type="button" class="btn btn-outline-primary period-btn active" data-period="day">Harian</button>
                    <button type="button" class="btn btn-outline-primary period-btn" data-period="month">Bulanan</button>
                    <button type="button" class="btn btn-outline-primary period-btn" data-period="year">Tahunan</button>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Dari tanggal</label>
                <input type="date" class="form-control" id="filterFrom">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Sampai tanggal</label>
                <input type="date" class="form-control" id="filterTo">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Size ID</label>
                <select class="form-select" id="filterSizeId">
                    <option value="">Semua</option>
                    @foreach($sizeIdOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Size OD</label>
                <select class="form-select" id="filterSizeOd">
                    <option value="">Semua</option>
                    @foreach($sizeOdOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Tujuan</label>
                <select class="form-select" id="filterTujuan">
                    <option value="">Semua</option>
                    @foreach($tujuanOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label fw-semibold small">Shift</label>
                <select class="form-select" id="filterShift">
                    <option value="">Semua</option>
                    @foreach($shiftOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label fw-semibold small">Cari</label>
                <input type="text" class="form-control" id="filterSearch" placeholder="Size ID/OD, tujuan, keterangan…">
            </div>
            <div class="col-12 col-lg-2 d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary w-100" id="btnResetFilter">Reset</button>
            </div>
        </div>
        <div class="mt-2 small text-muted" id="filterSummary">Memuat data…</div>
    </div>

    <div class="dashboard-panel mb-4">
        <div class="idod-loading" id="dashboardLoading">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
        <div class="row g-3 mb-4" id="summaryCards">
            <div class="col-6 col-xl-3">
                <div class="card idod-stat-card bg-stat-primary h-100">
                    <div class="card-body">
                        <div class="stat-label">Total entri</div>
                        <div class="stat-value" id="statRecords">0</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card idod-stat-card bg-stat-success h-100">
                    <div class="card-body">
                        <div class="stat-label">Total jumlah ID</div>
                        <div class="stat-value" id="statJumlahId">0</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card idod-stat-card bg-stat-warning h-100">
                    <div class="card-body">
                        <div class="stat-label">Total jumlah OD</div>
                        <div class="stat-value" id="statJumlahOd">0</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card idod-stat-card bg-stat-info h-100">
                    <div class="card-body">
                        <div class="stat-label">Total gabungan</div>
                        <div class="stat-value" id="statJumlah">0</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-xl-8">
                <div class="card idod-chart-card h-100">
                    <div class="card-header py-3">Tren per periode</div>
                    <div class="card-body">
                        <div class="chart-wrap">
                            <canvas id="chartTimeline"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card idod-chart-card h-100">
                    <div class="card-header py-3">Perbandingan ID &amp; OD</div>
                    <div class="card-body">
                        <div class="chart-wrap chart-wrap-sm">
                            <canvas id="chartIdOd"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <div class="card idod-chart-card h-100">
                    <div class="card-header py-3">Top tujuan (ID &amp; OD)</div>
                    <div class="card-body">
                        <div class="chart-wrap chart-wrap-sm">
                            <canvas id="chartTujuan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card idod-chart-card h-100">
                    <div class="card-header py-3">Per shift</div>
                    <div class="card-body">
                        <div class="chart-wrap chart-wrap-sm">
                            <canvas id="chartShift"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card idod-chart-card">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>Detail data</span>
            <span class="badge bg-primary rounded-pill" id="tableCount">0 baris</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="idodTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Size ID</th>
                            <th class="text-end">Jml ID OK</th>
                            <th class="text-end text-danger">Jml ID NG</th>
                            <th>Size OD</th>
                            <th class="text-end">Jml OD OK</th>
                            <th class="text-end text-danger">Jml OD NG</th>
                            <th class="text-end">Total OK</th>
                            <th>Tujuan</th>
                            <th>Shift</th>
                            <th>Keterangan</th>
                            <th>Dibuat</th>
                            <th class="text-center" style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="idodTableBody">
                        <tr>
                            <td colspan="14" class="text-center text-muted py-5">Memuat…</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-top" id="idodTablePaginationWrap">
            <div class="small text-muted" id="idodTablePaginationInfo">—</div>
            <nav aria-label="Paginasi tabel ID OD">
                <ul class="pagination pagination-sm mb-0" id="idodTablePagination"></ul>
            </nav>
        </div>
    </div>
</div>

{{-- Modal Tambah / Edit --}}
<div class="modal fade" id="idodFormModal" tabindex="-1" aria-labelledby="idodFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="idodFormModalLabel">Tambah Data ID &amp; OD</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="idodForm" novalidate>
                <div class="modal-body">
                    <div id="idodFormErrors" class="alert alert-danger d-none" role="alert"></div>
                    <input type="hidden" id="idodRecordId" name="id" value="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" for="idodDate">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date" id="idodDate" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" for="idodShift">Shift <span class="text-danger">*</span></label>
                            <select class="form-select" name="shift" id="idodShift" required>
                                <option value="">— Pilih shift —</option>
                                @foreach($shiftOptions as $opt)
                                <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" for="idodTujuan">Tujuan <span class="text-danger">*</span></label>
                            <select class="form-select" name="tujuan" id="idodTujuan" required>
                                <option value="">— Pilih tujuan —</option>
                                @foreach($tujuanOptions as $opt)
                                <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="idod-form-section idod-section-id">
                                <div class="idod-section-head">
                                    <span>Inner Diameter (ID)</span>
                                    <span class="badge bg-primary">ID</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="idodSizeId">Size ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="size_id" id="idodSizeId" list="sizeIdList" placeholder="………………………………………" required>
                                    <datalist id="sizeIdList">
                                        @foreach($sizeIdOptions as $opt)
                                        <option value="{{ $opt }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6 idod-ok-field">
                                        <label class="form-label fw-semibold" for="idodJumlahId">Jumlah ID OK <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="jumlah_id" id="idodJumlahId" min="0" step="1" value="0" required>
                                    </div>
                                    <div class="col-6 idod-ng-field">
                                        <label class="form-label fw-semibold" for="idodJumlahIdNg">Jumlah ID NG</label>
                                        <input type="number" class="form-control" name="jumlah_id_ng" id="idodJumlahIdNg" min="0" step="1" value="0" placeholder="Hasil buruk">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="idod-form-section idod-section-od">
                                <div class="idod-section-head">
                                    <span>Outer Diameter (OD)</span>
                                    <span class="badge bg-success">OD</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="idodSizeOd">Size OD <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="size_od" id="idodSizeOd" list="sizeOdList" placeholder="………………………………………" required>
                                    <datalist id="sizeOdList">
                                        @foreach($sizeOdOptions as $opt)
                                        <option value="{{ $opt }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6 idod-ok-field">
                                        <label class="form-label fw-semibold" for="idodJumlahOd">Jumlah OD OK <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="jumlah_od" id="idodJumlahOd" min="0" step="1" value="0" required>
                                    </div>
                                    <div class="col-6 idod-ng-field">
                                        <label class="form-label fw-semibold" for="idodJumlahOdNg">Jumlah OD NG</label>
                                        <input type="number" class="form-control" name="jumlah_od_ng" id="idodJumlahOdNg" min="0" step="1" value="0" placeholder="Hasil buruk">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" for="idodKeterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="idodKeterangan" rows="2" placeholder="Opsional"></textarea>
                        </div>
                        <div class="col-12">
                            <p class="small text-muted mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                Minimal salah satu jumlah <strong>ID OK</strong> atau <strong>OD OK</strong> harus lebih dari 0.
                                Jumlah NG tidak boleh melebihi jumlah OK pada bagian yang sama.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4" id="idodFormSubmit">
                        <span class="submit-text">Simpan</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="idodDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Yakin ingin menghapus data berikut?</p>
                <p class="mb-0 small text-muted" id="idodDeleteSummary">—</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger rounded-pill px-4" id="idodDeleteConfirm">
                    <span class="delete-text">Hapus</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function () {
    const apiUrl = @json(route('idod.dashboard-data'));
    const exportUrl = @json(route('idod.export'));
    const storeUrl = @json(route('idod.create'));
    const updateUrlTemplate = @json(url('idod/update/__ID__'));
    const destroyUrlTemplate = @json(url('idod/destroy/__ID__'));
    const showUrlTemplate = @json(url('idod/show/__ID__'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

    let period = 'day';
    let currentPage = 1;
    const perPage = 25;
    let debounceTimer = null;
    let charts = { timeline: null, idOd: null, tujuan: null, shift: null };
    let deleteTargetId = null;

    const formModalEl = document.getElementById('idodFormModal');
    const deleteModalEl = document.getElementById('idodDeleteModal');
    const formModal = formModalEl ? bootstrap.Modal.getOrCreateInstance(formModalEl) : null;
    const deleteModal = deleteModalEl ? bootstrap.Modal.getOrCreateInstance(deleteModalEl) : null;

    const el = (id) => document.getElementById(id);

    function defaultDates() {
        const to = new Date();
        const from = new Date();
        from.setDate(from.getDate() - 30);
        el('filterTo').value = to.toISOString().slice(0, 10);
        el('filterFrom').value = from.toISOString().slice(0, 10);
    }

    function params() {
        const p = new URLSearchParams();
        p.set('period', period);
        p.set('from', el('filterFrom').value);
        p.set('to', el('filterTo').value);
        const sizeId = el('filterSizeId').value;
        const sizeOd = el('filterSizeOd').value;
        const tujuan = el('filterTujuan').value;
        const shift = el('filterShift').value;
        const search = el('filterSearch').value.trim();
        if (sizeId) p.set('size_id', sizeId);
        if (sizeOd) p.set('size_od', sizeOd);
        if (tujuan) p.set('tujuan', tujuan);
        if (shift) p.set('shift', shift);
        if (search) p.set('search', search);
        p.set('page', String(currentPage));
        return p;
    }

    function exportParams() {
        const p = params();
        p.delete('period');
        return p;
    }

    function setLoading(on) {
        el('dashboardLoading').classList.toggle('show', on);
    }

    function destroyChart(key) {
        if (charts[key]) {
            charts[key].destroy();
            charts[key] = null;
        }
    }

    function formatNumber(n) {
        return new Intl.NumberFormat('id-ID').format(n);
    }

    function updateSummary(s, filters) {
        el('statRecords').textContent = formatNumber(s.total_records);
        el('statJumlahId').textContent = formatNumber(s.total_jumlah_id);
        el('statJumlahOd').textContent = formatNumber(s.total_jumlah_od);
        el('statJumlah').textContent = formatNumber(s.total_jumlah);
        const periodLabel = { day: 'harian', month: 'bulanan', year: 'tahunan' }[filters.period] || filters.period;
        el('filterSummary').textContent =
            `Periode grafik: ${periodLabel} · Rentang ${filters.from} s/d ${filters.to}` +
            (s.total_jumlah_ng != null ? ` · Total NG: ${formatNumber(s.total_jumlah_ng)}` : '');
    }

    function renderPagination(pg) {
        const info = el('idodTablePaginationInfo');
        const ul = el('idodTablePagination');
        if (!pg || !pg.total) {
            info.textContent = 'Tidak ada data';
            ul.innerHTML = '';
            return;
        }
        info.textContent = `Menampilkan ${formatNumber(pg.from)}–${formatNumber(pg.to)} dari ${formatNumber(pg.total)} data (terbaru di atas)`;

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

    function renderTable(rows, pagination) {
        const tbody = el('idodTableBody');
        const pg = pagination || {};
        if (pg.total) {
            el('tableCount').textContent = formatNumber(pg.total) + ' data';
        } else {
            el('tableCount').textContent = '0 data';
        }
        renderPagination(pg);

        if (!rows.length) {
            tbody.innerHTML = '<tr><td colspan="14" class="text-center text-muted py-5">Tidak ada data untuk filter ini.</td></tr>';
            return;
        }

        const rowOffset = ((pg.current_page || 1) - 1) * (pg.per_page || perPage);
        tbody.innerHTML = rows.map((r, i) => `
            <tr data-id="${r.id}">
                <td>${rowOffset + i + 1}</td>
                <td>${escapeHtml(r.date)}</td>
                <td>${escapeHtml(r.size_id)}</td>
                <td class="text-end">${formatNumber(r.jumlah_id)}</td>
                <td class="text-end text-danger">${formatNumber(r.jumlah_id_ng)}</td>
                <td>${escapeHtml(r.size_od)}</td>
                <td class="text-end">${formatNumber(r.jumlah_od)}</td>
                <td class="text-end text-danger">${formatNumber(r.jumlah_od_ng)}</td>
                <td class="text-end fw-semibold">${formatNumber(r.total_jumlah)}</td>
                <td>${escapeHtml(r.tujuan)}</td>
                <td>${escapeHtml(r.shift)}</td>
                <td class="small">${escapeHtml(r.keterangan)}</td>
                <td class="small text-muted">${escapeHtml(r.created_at)}</td>
                <td class="text-center text-nowrap">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-edit-idod" title="Edit"
                            data-id="${r.id}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete-idod" title="Hapus"
                            data-id="${r.id}"
                            data-label="${escapeAttr(r.size_id + ' / ' + r.size_od + ' · ' + r.date)}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `).join('');
    }

    function escapeAttr(str) {
        return String(str ?? '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function urlWithId(template, id) {
        return template.replace('__ID__', id);
    }

    function showFormErrors(errors) {
        const box = el('idodFormErrors');
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
        const btn = el('idodFormSubmit');
        btn.disabled = on;
        btn.querySelector('.submit-text').classList.toggle('d-none', on);
        btn.querySelector('.spinner-border').classList.toggle('d-none', !on);
    }

    function syncNgMaxLimits() {
        const idOk = parseInt(el('idodJumlahId').value, 10) || 0;
        const odOk = parseInt(el('idodJumlahOd').value, 10) || 0;
        el('idodJumlahIdNg').max = idOk;
        el('idodJumlahOdNg').max = odOk;
        if (parseInt(el('idodJumlahIdNg').value, 10) > idOk) el('idodJumlahIdNg').value = idOk;
        if (parseInt(el('idodJumlahOdNg').value, 10) > odOk) el('idodJumlahOdNg').value = odOk;
    }

    function resetIdodForm() {
        el('idodForm').reset();
        el('idodRecordId').value = '';
        el('idodDate').value = new Date().toISOString().slice(0, 10);
        el('idodShift').value = '';
        el('idodTujuan').value = '';
        el('idodJumlahId').value = 0;
        el('idodJumlahIdNg').value = 0;
        el('idodJumlahOd').value = 0;
        el('idodJumlahOdNg').value = 0;
        syncNgMaxLimits();
        el('idodForm')?.querySelectorAll('.is-invalid').forEach((f) => f.classList.remove('is-invalid'));
    }

    function validateIdodFormClient() {
        const errors = [];
        const jumlahId = parseInt(el('idodJumlahId').value, 10) || 0;
        const jumlahOd = parseInt(el('idodJumlahOd').value, 10) || 0;
        const jumlahIdNg = parseInt(el('idodJumlahIdNg').value, 10) || 0;
        const jumlahOdNg = parseInt(el('idodJumlahOdNg').value, 10) || 0;

        el('idodJumlahIdNg').classList.toggle('is-invalid', jumlahIdNg > jumlahId);
        el('idodJumlahOdNg').classList.toggle('is-invalid', jumlahOdNg > jumlahOd);

        if (!el('idodDate').value) errors.push('Tanggal wajib diisi.');
        if (!el('idodShift').value) errors.push('Shift wajib dipilih.');
        if (!el('idodTujuan').value) errors.push('Tujuan wajib dipilih.');
        if (!el('idodSizeId').value.trim()) errors.push('Size ID wajib diisi.');
        if (!el('idodSizeOd').value.trim()) errors.push('Size OD wajib diisi.');
        if (jumlahId + jumlahOd < 1) errors.push('Minimal salah satu jumlah ID OK atau OD OK harus lebih dari 0.');
        if (jumlahIdNg > jumlahId) errors.push('Jumlah ID NG tidak boleh melebihi Jumlah ID OK.');
        if (jumlahOdNg > jumlahOd) errors.push('Jumlah OD NG tidak boleh melebihi Jumlah OD OK.');

        if (errors.length) {
            showFormErrors(errors.map((m) => `<div>${escapeHtml(m)}</div>`).join(''));
            return false;
        }
        showFormErrors(null);
        return true;
    }

    function openAddModal() {
        el('idodFormModalLabel').textContent = 'Tambah Data ID & OD';
        resetIdodForm();
        showFormErrors(null);
        formModal?.show();
    }

    function fillForm(row) {
        el('idodRecordId').value = row.id;
        el('idodDate').value = row.date || '';
        el('idodSizeId').value = row.size_id || '';
        el('idodJumlahId').value = row.jumlah_id ?? 0;
        el('idodJumlahIdNg').value = row.jumlah_id_ng ?? 0;
        el('idodSizeOd').value = row.size_od || '';
        el('idodJumlahOd').value = row.jumlah_od ?? 0;
        el('idodJumlahOdNg').value = row.jumlah_od_ng ?? 0;
        el('idodTujuan').value = row.tujuan || '';
        el('idodShift').value = row.shift || '';
        el('idodKeterangan').value = row.keterangan || '';
        syncNgMaxLimits();
        el('idodForm')?.querySelectorAll('.is-invalid').forEach((f) => f.classList.remove('is-invalid'));
    }

    function setFormFieldsDisabled(on) {
        el('idodForm')?.querySelectorAll('input, textarea, select').forEach((field) => {
            field.disabled = on;
        });
    }

    async function openEditModal(id) {
        el('idodFormModalLabel').textContent = 'Edit Data ID & OD';
        showFormErrors(null);
        formModal?.show();
        setFormFieldsDisabled(true);
        try {
            const res = await fetch(urlWithId(showUrlTemplate, id), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Gagal memuat data');
            fillForm(data.record);
        } catch (err) {
            formModal?.hide();
            Swal.fire({ icon: 'error', title: 'Gagal', text: err.message || 'Data tidak ditemukan.' });
        } finally {
            setFormFieldsDisabled(false);
        }
    }

    async function submitForm(e) {
        e.preventDefault();
        syncNgMaxLimits();
        if (!validateIdodFormClient()) return;

        const id = el('idodRecordId').value;
        const isEdit = !!id;
        const url = isEdit ? urlWithId(updateUrlTemplate, id) : storeUrl;
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            date: el('idodDate').value,
            size_id: el('idodSizeId').value.trim(),
            jumlah_id: parseInt(el('idodJumlahId').value, 10) || 0,
            jumlah_id_ng: parseInt(el('idodJumlahIdNg').value, 10) || 0,
            size_od: el('idodSizeOd').value.trim(),
            jumlah_od: parseInt(el('idodJumlahOd').value, 10) || 0,
            jumlah_od_ng: parseInt(el('idodJumlahOdNg').value, 10) || 0,
            tujuan: el('idodTujuan').value.trim(),
            shift: el('idodShift').value.trim(),
            keterangan: el('idodKeterangan').value.trim(),
        };

        setFormSubmitting(true);
        showFormErrors(null);

        try {
            const res = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(payload),
            });
            const data = await res.json().catch(() => ({}));
            if (!res.ok) {
                if (data.errors) showFormErrors(data.errors);
                else showFormErrors(data.message || 'Gagal menyimpan data.');
                return;
            }
            formModal?.hide();
            Swal.fire({ icon: 'success', title: 'Berhasil', text: data.message || 'Data tersimpan.', timer: 1700, showConfirmButton: false });
            loadDashboard();
        } catch (err) {
            console.error(err);
            showFormErrors('Terjadi kesalahan jaringan. Coba lagi.');
        } finally {
            setFormSubmitting(false);
        }
    }

    function openDeleteModal(id, label) {
        deleteTargetId = id;
        el('idodDeleteSummary').textContent = label || ('ID #' + id);
        deleteModal?.show();
    }

    async function confirmDelete() {
        if (!deleteTargetId) return;
        const btn = el('idodDeleteConfirm');
        btn.disabled = true;
        btn.querySelector('.delete-text').classList.toggle('d-none', true);
        btn.querySelector('.spinner-border').classList.toggle('d-none', false);

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
            if (!res.ok) {
                Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Tidak dapat menghapus data.' });
                return;
            }
            deleteModal?.hide();
            deleteTargetId = null;
            Swal.fire({ icon: 'success', title: 'Terhapus', text: data.message || 'Data dihapus.', timer: 1500, showConfirmButton: false });
            loadDashboard();
        } catch (err) {
            console.error(err);
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan jaringan.' });
        } finally {
            btn.disabled = false;
            btn.querySelector('.delete-text').classList.toggle('d-none', false);
            btn.querySelector('.spinner-border').classList.toggle('d-none', true);
        }
    }

    function escapeHtml(str) {
        const d = document.createElement('div');
        d.textContent = str ?? '';
        return d.innerHTML;
    }

    function timelineSeries(data, key, labelCount) {
        const arr = data.timeline?.[key];
        if (arr && arr.length) return arr;
        return Array(Math.max(labelCount, 1)).fill(0);
    }

    const CHART_STACK_COLORS = {
        idOk: 'rgba(37, 99, 235, 0.9)',
        idNg: 'rgba(248, 113, 113, 0.9)',
        odOk: 'rgba(5, 150, 105, 0.9)',
        odNg: 'rgba(251, 146, 60, 0.9)',
    };

    function groupSeries(group, key) {
        const arr = group?.[key];
        const n = group?.labels?.length || 0;
        if (arr && arr.length) return arr.map((v) => Number(v) || 0);
        return Array(Math.max(n, 1)).fill(0);
    }

    function stackedQuantityDatasets(group, stackId) {
        return [
            { label: 'ID OK', data: groupSeries(group, 'jumlah_id'), stack: stackId, backgroundColor: CHART_STACK_COLORS.idOk, borderRadius: 4 },
            { label: 'ID NG', data: groupSeries(group, 'jumlah_id_ng'), stack: stackId, backgroundColor: CHART_STACK_COLORS.idNg, borderRadius: 4 },
            { label: 'OD OK', data: groupSeries(group, 'jumlah_od'), stack: stackId, backgroundColor: CHART_STACK_COLORS.odOk, borderRadius: 4 },
            { label: 'OD NG', data: groupSeries(group, 'jumlah_od_ng'), stack: stackId, backgroundColor: CHART_STACK_COLORS.odNg, borderRadius: 4 },
        ];
    }

    function buildCharts(data) {
        const tlLabels = data.timeline?.labels?.length ? data.timeline.labels : ['Tidak ada data'];
        const n = tlLabels.length;
        const tlIdOk = timelineSeries(data, 'jumlah_id', n);
        const tlIdNg = timelineSeries(data, 'jumlah_id_ng', n);
        const tlOdOk = timelineSeries(data, 'jumlah_od', n);
        const tlOdNg = timelineSeries(data, 'jumlah_od_ng', n);

        destroyChart('timeline');
        charts.timeline = new Chart(el('chartTimeline'), {
            type: 'bar',
            data: {
                labels: tlLabels,
                datasets: [
                    {
                        label: 'ID OK',
                        data: tlIdOk,
                        stack: 'jumlah',
                        backgroundColor: 'rgba(37, 99, 235, 0.9)',
                        borderRadius: 4,
                    },
                    {
                        label: 'ID NG',
                        data: tlIdNg,
                        stack: 'jumlah',
                        backgroundColor: 'rgba(248, 113, 113, 0.9)',
                        borderRadius: 4,
                    },
                    {
                        label: 'OD OK',
                        data: tlOdOk,
                        stack: 'jumlah',
                        backgroundColor: 'rgba(5, 150, 105, 0.9)',
                        borderRadius: 4,
                    },
                    {
                        label: 'OD NG',
                        data: tlOdNg,
                        stack: 'jumlah',
                        backgroundColor: 'rgba(251, 146, 60, 0.9)',
                        borderRadius: 4,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            footer: (items) => {
                                const sum = items.reduce((a, i) => a + (i.parsed.y || 0), 0);
                                return 'Total: ' + new Intl.NumberFormat('id-ID').format(sum);
                            },
                        },
                    },
                },
                scales: {
                    x: { stacked: true },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah' },
                        ticks: { precision: 0 },
                    },
                },
            },
        });

        destroyChart('idOd');
        const idOdLabels = data.by_id_od?.labels?.length ? data.by_id_od.labels : ['ID (OK)', 'OD (OK)', 'ID (NG)', 'OD (NG)'];
        const idOdData = data.by_id_od?.jumlah?.length ? data.by_id_od.jumlah : [0, 0, 0, 0];
        charts.idOd = new Chart(el('chartIdOd'), {
            type: 'doughnut',
            data: {
                labels: idOdLabels,
                datasets: [{
                    data: idOdData,
                    backgroundColor: ['#2563eb', '#059669', '#f87171', '#fb923c'],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } },
            },
        });

        destroyChart('tujuan');
        const byTujuan = data.by_tujuan || {};
        const tujuanLabels = byTujuan.labels?.length ? byTujuan.labels : ['Tidak ada data'];
        charts.tujuan = new Chart(el('chartTujuan'), {
            type: 'bar',
            data: {
                labels: tujuanLabels,
                datasets: stackedQuantityDatasets(byTujuan, 'tujuan'),
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12 } } },
                scales: {
                    x: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah' },
                        ticks: { precision: 0 },
                    },
                    y: { stacked: true },
                },
            },
        });

        destroyChart('shift');
        const byShift = data.by_shift || {};
        const shiftLabels = byShift.labels?.length ? byShift.labels : ['Tidak ada data'];
        charts.shift = new Chart(el('chartShift'), {
            type: 'bar',
            data: {
                labels: shiftLabels,
                datasets: stackedQuantityDatasets(byShift, 'shift'),
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12 } } },
                scales: {
                    x: { stacked: true },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah' },
                        ticks: { precision: 0 },
                    },
                },
            },
        });
    }

    async function loadDashboard(options = {}) {
        if (options.resetPage) currentPage = 1;
        setLoading(true);
        try {
            const res = await fetch(apiUrl + '?' + params().toString(), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!res.ok) throw new Error('Gagal memuat data');
            const data = await res.json();
            if (data.pagination?.current_page) {
                currentPage = data.pagination.current_page;
            }
            updateSummary(data.summary, data.filters);
            buildCharts(data);
            renderTable(data.rows, data.pagination);
        } catch (e) {
            console.error(e);
            el('filterSummary').textContent = 'Gagal memuat data. Periksa koneksi atau coba lagi.';
            el('idodTableBody').innerHTML =
                '<tr><td colspan="14" class="text-center text-danger py-4">Gagal memuat data.</td></tr>';
            renderPagination(null);
        } finally {
            setLoading(false);
        }
    }

    function scheduleLoad() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => loadDashboard({ resetPage: true }), 350);
    }

    function goToPage(page) {
        currentPage = Math.max(1, page);
        loadDashboard();
        el('idodTable')?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    document.querySelectorAll('.period-btn').forEach((btn) => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.period-btn').forEach((b) => b.classList.remove('active'));
            this.classList.add('active');
            period = this.dataset.period;
            scheduleLoad();
        });
    });

    ['filterFrom', 'filterTo', 'filterSizeId', 'filterSizeOd', 'filterTujuan', 'filterShift'].forEach((id) => {
        el(id).addEventListener('change', scheduleLoad);
    });
    el('filterSearch').addEventListener('input', scheduleLoad);

    el('btnResetFilter').addEventListener('click', function () {
        defaultDates();
        el('filterSizeId').value = '';
        el('filterSizeOd').value = '';
        el('filterTujuan').value = '';
        el('filterShift').value = '';
        el('filterSearch').value = '';
        period = 'day';
        document.querySelectorAll('.period-btn').forEach((b) => {
            b.classList.toggle('active', b.dataset.period === 'day');
        });
        loadDashboard({ resetPage: true });
    });

    el('idodTablePagination')?.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-page]');
        if (!btn || btn.disabled) return;
        const page = parseInt(btn.dataset.page, 10);
        if (!Number.isNaN(page)) goToPage(page);
    });

    el('btnExportExcel')?.addEventListener('click', function () {
        window.location.href = exportUrl + '?' + exportParams().toString();
    });

    el('btnTambahData')?.addEventListener('click', openAddModal);
    document.getElementById('navTambahIdod')?.addEventListener('click', function (e) {
        if (window.location.pathname.includes('idod')) {
            e.preventDefault();
            openAddModal();
        }
    });
    el('idodForm')?.addEventListener('submit', submitForm);
    ['idodJumlahId', 'idodJumlahOd'].forEach((id) => {
        el(id)?.addEventListener('input', syncNgMaxLimits);
    });
    el('idodDeleteConfirm')?.addEventListener('click', confirmDelete);

    el('idodTableBody')?.addEventListener('click', function (e) {
        const editBtn = e.target.closest('.btn-edit-idod');
        const deleteBtn = e.target.closest('.btn-delete-idod');
        if (editBtn?.dataset.id) {
            openEditModal(editBtn.dataset.id);
        }
        if (deleteBtn) {
            openDeleteModal(deleteBtn.dataset.id, deleteBtn.dataset.label);
        }
    });

    if (window.location.hash === '#tambah-data') {
        setTimeout(openAddModal, 400);
    }

    const editParam = new URLSearchParams(window.location.search).get('edit');
    if (editParam) {
        setTimeout(() => openEditModal(editParam), 500);
        history.replaceState(null, '', window.location.pathname);
    }

    defaultDates();
    loadDashboard({ resetPage: true });
})();
</script>
@endpush
