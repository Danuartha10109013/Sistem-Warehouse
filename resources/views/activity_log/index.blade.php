@extends('user.layout.V_template')
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
    .diff-table td { font-size: 13px; font-family: monospace; }

    /* Fix Pagination SVG Icon & Styling */
    .pagination svg {
        width: 1rem !important;
        height: 1rem !important;
    }
    .pagination .page-item .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        color: #135b9f;
    }
    .pagination .page-item.active .page-link {
        background-color: #135b9f;
        border-color: #135b9f;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">Log Aktivitas Sistem</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> Administrator <span class="mx-1">/</span> Log Aktivitas
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body">
            <form method="GET" action="{{ route('superadmin.activity-log.index') }}" class="row g-3">
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
                    <label class="form-label fw-semibold">Aksi</label>
                    <select name="action" class="form-select">
                        <option value="">-- Semua Aksi --</option>
                        @foreach ($actions as $act)
                            <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ $act }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Modul</label>
                    <select name="module" class="form-select">
                        <option value="">-- Semua Modul --</option>
                        @foreach ($modules as $mod)
                            <option value="{{ $mod }}" {{ request('module') == $mod ? 'selected' : '' }}>{{ $mod }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Cari Deskripsi / IP</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Kata kunci...">
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('superadmin.activity-log.index') }}" class="btn btn-light"><i class="fas fa-undo"></i></a>
                </div>
            </form>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Waktu</th>
                            <th>Pengguna</th>
                            <th>Aksi</th>
                            <th>Modul</th>
                            <th>Deskripsi</th>
                            <th>IP Address</th>
                            <th class="text-center">Detail Perubahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td style="white-space: nowrap; font-size: 13px;">
                                {{ $log->created_at ? $log->created_at->format('d/m/Y H:i:s') : '-' }}
                            </td>
                            <td>
                                <span class="fw-semibold">{{ $log->user_name ?? ($log->user->name ?? 'Guest') }}</span>
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($log->action) {
                                        'CREATE' => 'badge-create',
                                        'UPDATE' => 'badge-update',
                                        'DELETE' => 'badge-delete',
                                        'LOGIN'  => 'badge-login',
                                        'LOGOUT' => 'badge-logout',
                                        default  => 'badge-custom'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} px-2 py-1 rounded-pill">{{ $log->action }}</span>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $log->module ?? '-' }}</span></td>
                            <td style="max-width: 300px;" class="text-truncate" title="{{ $log->description }}">
                                {{ $log->description }}
                            </td>
                            <td style="font-size: 12px; color: #64748b;">{{ $log->ip_address ?? '-' }}</td>
                            <td class="text-center">
                                @if ($log->old_values || $log->new_values)
                                    <button class="btn btn-sm btn-outline-info view-diff-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#diffModal" 
                                            data-log='@json($log)'>
                                        <i class="fas fa-eye me-1"></i> Lihat Diff
                                    </button>
                                @else
                                    <span class="text-muted" style="font-size: 12px;">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat aktivitas yang tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                <div class="text-muted small">
                    Menampilkan <strong>{{ $logs->firstItem() ?? 0 }}</strong> sampai <strong>{{ $logs->lastItem() ?? 0 }}</strong> dari <strong>{{ $logs->total() }}</strong> log
                </div>
                <div>
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail Diff --}}
<div class="modal fade" id="diffModal" tabindex="-1" aria-labelledby="diffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
    document.querySelectorAll('.view-diff-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const data = JSON.parse(this.dataset.log);
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
        });
    });
</script>
@endpush
@endsection
