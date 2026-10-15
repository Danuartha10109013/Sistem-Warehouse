{{-- Desktop Table View --}}
<div class="table-responsive d-none d-md-block">
    <table class="table table-hover align-middle mb-0" style="min-width: 780px;">
        <thead class="table-light">
            <tr>
                <th style="font-size: 13px; font-weight: 600;">Waktu</th>
                @if ($isSuperAdmin)
                    <th style="font-size: 13px; font-weight: 600;">Pengguna</th>
                @endif
                <th style="font-size: 13px; font-weight: 600;">Aksi</th>
                <th style="font-size: 13px; font-weight: 600;">Modul</th>
                <th style="font-size: 13px; font-weight: 600;">Deskripsi</th>
                <th style="font-size: 13px; font-weight: 600;">IP Address</th>
                <th class="text-center" style="font-size: 13px; font-weight: 600;">Detail Perubahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
            <tr>
                <td style="white-space: nowrap; font-size: 13px;">
                    {{ $log->created_at ? $log->created_at->format('d/m/Y H:i:s') : '-' }}
                </td>
                @if ($isSuperAdmin)
                <td>
                    <span class="fw-semibold" style="font-size: 13px; color: #1e293b;">
                        {{ $log->user_name ?? ($log->user->name ?? 'Guest') }}
                    </span>
                </td>
                @endif
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
                    <span class="badge {{ $badgeClass }} px-2 py-1 rounded-pill" style="font-size: 11px; letter-spacing: 0.3px;">{{ $log->action }}</span>
                </td>
                <td><span class="badge bg-light text-dark border" style="font-size: 12px;">{{ $log->module ?? '-' }}</span></td>
                <td style="max-width: 320px;" class="text-truncate" title="{{ $log->description }}">
                    <span style="font-size: 13px; color: #334155;">{{ $log->description }}</span>
                </td>
                <td style="font-size: 12px; color: #64748b;">{{ $log->ip_address ?? '-' }}</td>
                <td class="text-center">
                    @if ($log->old_values || $log->new_values)
                        <button class="btn btn-sm btn-outline-info view-diff-btn px-2 py-1" 
                                data-bs-toggle="modal" 
                                data-bs-target="#diffModal" 
                                data-log='@json($log)'
                                style="font-size: 12px; border-radius: 6px;">
                            <i class="fas fa-eye me-1"></i> Lihat Diff
                        </button>
                    @else
                        <span class="text-muted" style="font-size: 12px;">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ $isSuperAdmin ? 7 : 6 }}" class="text-center py-5 text-muted">
                    <i class="fas fa-history fs-2 mb-2 d-block text-black-50"></i>
                    Belum ada riwayat aktivitas yang tercatat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile Card View --}}
<div class="d-md-none">
    @forelse ($logs as $log)
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
        <div class="card border mb-3 shadow-none" style="border-radius: 10px; border-color: #e2e8f0 !important; background: #ffffff;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-1 flex-wrap">
                        <span class="badge {{ $badgeClass }} px-2 py-1 rounded-pill" style="font-size: 11px;">{{ $log->action }}</span>
                        @if($log->module)
                            <span class="badge bg-light text-dark border" style="font-size: 11px;">{{ $log->module }}</span>
                        @endif
                    </div>
                    <small class="text-muted" style="font-size: 12px;">
                        <i class="far fa-clock me-1"></i>{{ $log->created_at ? $log->created_at->format('d/m/Y H:i') : '-' }}
                    </small>
                </div>

                @if ($isSuperAdmin)
                    <div class="mb-2" style="font-size: 13px;">
                        <span class="text-muted"><i class="fas fa-user-circle me-1"></i></span>
                        <strong style="color: #1e293b;">{{ $log->user_name ?? ($log->user->name ?? 'Guest') }}</strong>
                    </div>
                @endif

                <div class="mb-2" style="font-size: 13px; color: #334155; line-height: 1.45;">
                    {{ $log->description }}
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-2">
                    <small class="text-muted" style="font-size: 11px;">
                        <i class="fas fa-network-wired me-1"></i>{{ $log->ip_address ?? '-' }}
                    </small>
                    @if ($log->old_values || $log->new_values)
                        <button class="btn btn-sm btn-outline-info view-diff-btn px-2 py-1" 
                                data-bs-toggle="modal" 
                                data-bs-target="#diffModal" 
                                data-log='@json($log)'
                                style="font-size: 11px; border-radius: 6px;">
                            <i class="fas fa-eye me-1"></i> Lihat Diff
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-4 text-muted">
            <i class="fas fa-history fs-2 mb-2 d-block text-black-50"></i>
            Belum ada riwayat aktivitas yang tercatat.
        </div>
    @endforelse
</div>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 pt-3 border-top gap-2">
    <div class="text-muted small text-center text-md-start">
        Menampilkan <strong>{{ $logs->firstItem() ?? 0 }}</strong> sampai <strong>{{ $logs->lastItem() ?? 0 }}</strong> dari <strong>{{ $logs->total() }}</strong> log
    </div>
    <div class="pagination-wrapper overflow-auto w-100 w-md-auto d-flex justify-content-center">
        {{ $logs->links('activity_log.partials.pagination') }}
    </div>
</div>
