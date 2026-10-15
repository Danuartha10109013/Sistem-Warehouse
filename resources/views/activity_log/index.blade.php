@extends($isSuperAdmin ? 'user.layout.V_template' : 'verifikasi_timbangan.layout.V_template')
@section('title', 'Log Aktivitas Pengguna')

@push('css')
<style>
    .badge-create { background-color: #10b981; color: white; }
    .badge-update { background-color: #3b82f6; color: white; }
    .badge-delete { background-color: #ef4444; color: white; }
    .badge-login  { background-color: #8b5cf6; color: white; }
    .badge-logout { background-color: #6b7280; color: white; }
    .badge-custom { background-color: #f59e0b; color: white; }
    .diff-table th { background: #f8fafc; font-size: 12px; }
    .diff-table td { font-size: 13px; font-family: monospace; word-break: break-word; }

    /* Custom Modern Pagination Styling */
    .pagination .page-link {
        border-radius: 8px !important;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        transition: all 0.2s ease;
    }
    .pagination .page-link:hover {
        background-color: #f1f5f9;
        color: #135b9f;
        border-color: #cbd5e1;
    }
    .pagination .page-item.active .page-link {
        background-color: #135b9f !important;
        border-color: #135b9f !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(19, 91, 159, 0.25);
    }
    .pagination .page-item.disabled .page-link {
        background-color: #f8fafc;
        color: #94a3b8;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    @media (max-width: 767.98px) {
        .body-wrapper > .container-fluid {
            padding: 85px 12px 20px 12px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3 p-md-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">{{ $isSuperAdmin ? 'Log Aktivitas Sistem' : 'Log Aktivitas Saya' }}</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> {{ $isSuperAdmin ? 'Administrator' : 'Akun' }} <span class="mx-1">/</span> Log Aktivitas
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('activity-log.index') }}" class="row g-3" id="activityLogFilterForm">
                @if ($isSuperAdmin)
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">User</label>
                        <select name="user_id" class="form-select">
                            <option value="">-- Semua User --</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }} ({{ $u->username }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                @else
                    <div class="col-md-3">
                @endif
                        <label class="form-label fw-semibold">Aksi</label>
                        <select name="action" class="form-select">
                            <option value="">-- Semua Aksi --</option>
                            @foreach ($actions as $act)
                                <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ $act }}</option>
                            @endforeach
                        </select>
                    </div>

                @if ($isSuperAdmin)
                    <div class="col-md-2">
                @else
                    <div class="col-md-3">
                @endif
                        <label class="form-label fw-semibold">Modul</label>
                        <select name="module" class="form-select">
                            <option value="">-- Semua Modul --</option>
                            @foreach ($modules as $mod)
                                <option value="{{ $mod }}" {{ request('module') == $mod ? 'selected' : '' }}>{{ $mod }}</option>
                            @endforeach
                        </select>
                    </div>

                @if ($isSuperAdmin)
                    <div class="col-md-3">
                @else
                    <div class="col-md-4">
                @endif
                        <label class="form-label fw-semibold">Cari Deskripsi / IP</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Kata kunci...">
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                        <a href="{{ route('activity-log.index') }}" class="btn btn-light" id="activityLogResetBtn"><i class="fas fa-undo"></i></a>
                    </div>
            </form>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card shadow-sm border-0 position-relative" style="border-radius: 12px;">
        <div class="card-body p-3 p-md-4 position-relative">
            {{-- Loading Overlay for smooth AJAX transitions --}}
            <div id="tableLoadingOverlay" class="position-absolute top-0 start-0 w-100 h-100 d-none justify-content-center align-items-center" style="background: rgba(255, 255, 255, 0.7); z-index: 5; border-radius: 12px; backdrop-filter: blur(2px);">
                <div class="spinner-border text-primary" role="status" style="width: 2.5rem; height: 2.5rem;">
                    <span class="visually-hidden">Memuat...</span>
                </div>
            </div>

            <div id="activityLogTableContainer">
                @include('activity_log.partials.table')
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail Diff --}}
<div class="modal fade" id="diffModal" tabindex="-1" aria-labelledby="diffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="diffModalLabel"><i class="fas fa-history me-2 text-primary"></i>Detail Perubahan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 p-2 bg-light rounded" id="diffInfo" style="font-size: 13px;"></div>
                <div class="table-responsive">
                    <table class="table table-bordered diff-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Kolom</th>
                                <th style="width: 37.5%;" class="text-danger">Sebelum (Lama)</th>
                                <th style="width: 37.5%;" class="text-success">Sesudah (Baru)</th>
                            </tr>
                        </thead>
                        <tbody id="diffTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const tableContainer = document.getElementById('activityLogTableContainer');
    const loadingOverlay = document.getElementById('tableLoadingOverlay');
    const filterForm = document.getElementById('activityLogFilterForm');
    const resetBtn = document.getElementById('activityLogResetBtn');

    function loadTableData(url) {
        if (!tableContainer) return;
        
        if (loadingOverlay) {
            loadingOverlay.classList.remove('d-none');
            loadingOverlay.classList.add('d-flex');
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal memuat data');
            return response.text();
        })
        .then(html => {
            tableContainer.innerHTML = html;
            window.history.pushState(null, '', url);
        })
        .catch(err => {
            console.error('Error loading activity logs:', err);
        })
        .finally(() => {
            if (loadingOverlay) {
                loadingOverlay.classList.remove('d-flex');
                loadingOverlay.classList.add('d-none');
            }
        });
    }

    // Intercept click on pagination links (No page reload, smooth AJAX in-place)
    document.addEventListener('click', function(e) {
        const link = e.target.closest('#activityLogTableContainer .pagination a.page-link');
        if (link && link.href) {
            e.preventDefault();
            loadTableData(link.href);
        }
    });

    // Intercept filter form submit (Smooth AJAX filter)
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData).toString();
            const actionUrl = this.getAttribute('action') || window.location.pathname;
            loadTableData(`${actionUrl}?${params}`);
        });
    }

    // Intercept reset button
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (filterForm) filterForm.reset();
            loadTableData(this.href);
        });
    }

    // Event delegation for diff modal button (works smoothly across AJAX-loaded rows)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.view-diff-btn');
        if (btn && btn.dataset.log) {
            const data = JSON.parse(btn.dataset.log);
            const oldVals = data.old_values || {};
            const newVals = data.new_values || {};
            
            document.getElementById('diffInfo').innerHTML = `
                <div><strong>Aksi:</strong> ${data.action} | <strong>Modul:</strong> ${data.module ?? '-'}</div>
                <div><strong>Oleh:</strong> ${data.user_name} | <strong>Waktu:</strong> ${new Date(data.created_at).toLocaleString('id-ID')}</div>
                <div class="text-muted mt-1">${data.description ?? ''}</div>
            `;

            const tbody = document.getElementById('diffTableBody');
            tbody.innerHTML = '';

            const allKeys = Array.from(new Set([...Object.keys(oldVals), ...Object.keys(newVals)]));

            if (allKeys.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Tidak ada rekaman atribut spesifik</td></tr>`;
                return;
            }

            allKeys.forEach(k => {
                const oldText = oldVals[k] !== undefined ? (typeof oldVals[k] === 'object' ? JSON.stringify(oldVals[k]) : oldVals[k]) : '-';
                const newText = newVals[k] !== undefined ? (typeof newVals[k] === 'object' ? JSON.stringify(newVals[k]) : newVals[k]) : '-';

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="fw-semibold text-secondary">${k}</td>
                    <td class="text-danger bg-danger-subtle">${oldText === null ? '<em>null</em>' : oldText}</td>
                    <td class="text-success bg-success-subtle">${newText === null ? '<em>null</em>' : newText}</td>
                `;
                tbody.appendChild(tr);
            });
        }
    });
</script>
@endpush
@endsection
