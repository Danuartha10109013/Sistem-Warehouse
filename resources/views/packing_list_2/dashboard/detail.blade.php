@extends('packing_list_2.layout.V_template')

@section('title', 'Detail Batch ' . $batch->kode_batch . ' - Packing List 2.0')

@push('css')
<style>
    .btn-export-excel {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #107c41 !important;
        color: #ffffff !important;
        border: 1px solid #0e6c38 !important;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        padding: 7px 16px;
        box-shadow: 0 1px 2px rgba(16, 124, 65, 0.2);
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }
    .btn-export-excel:hover {
        background-color: #0b5e31 !important;
        border-color: #084926 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(16, 124, 65, 0.28);
        transform: translateY(-1px);
    }
    .btn-export-excel:active {
        background-color: #084926 !important;
        transform: translateY(0);
        box-shadow: 0 1px 2px rgba(16, 124, 65, 0.2);
    }
    .btn-export-excel-table {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background-color: #ffffff;
        color: #1e293b !important;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        font-weight: 600;
        font-size: 12.5px;
        padding: 6px 14px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }
    .btn-export-excel-table i {
        color: #107c41;
        font-size: 16px;
    }
    .btn-export-excel-table:hover {
        background-color: #f0fdf4;
        border-color: #86efac;
        color: #166534 !important;
        box-shadow: 0 3px 6px rgba(16, 124, 65, 0.12);
        transform: translateY(-1px);
    }
    .btn-export-excel-table:active {
        background-color: #dcfce7;
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <h4 class="fw-bolder mb-0" style="color: #1e293b; letter-spacing: -0.5px;">Detail Batch: {{ $batch->kode_batch }}</h4>
                    @if ($batch->no_rit)
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1" style="font-size: 12px; border-radius: 6px;"><i class="ti ti-truck-delivery me-1"></i>Rit {{ $batch->no_rit }}</span>
                    @endif
                    @if ($summary['menunggu'] > 0 && $summary['tervalidasi'] == 0)
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 12px; border-radius: 6px;">Semua Menunggu Validasi</span>
                    @elseif ($summary['menunggu'] == 0 && $summary['total'] > 0)
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 12px; border-radius: 6px;">Selesai Tervalidasi</span>
                    @else
                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1" style="font-size: 12px; border-radius: 6px;">Proses Validasi</span>
                    @endif
                </div>
                <div class="text-muted" style="font-size: 13.5px;">
                    Home <span class="mx-1">/</span> Packing List 2.0 <span class="mx-1">/</span> Batch <span class="mx-1">/</span> {{ $batch->kode_batch }}
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('packing-list-2.batch.export-excel', array_merge(['id' => $batch->id], request()->only(['search', 'status']))) }}" class="btn-export-excel">
                    <i class="ti ti-file-spreadsheet fs-5"></i>
                    <span>Export Excel</span>
                </a>
                <a href="{{ route('packing-list-2.dashboard') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
                    <i class="ti ti-arrow-left fs-5"></i>
                    <span>Kembali</span>
                </a>
                <form action="{{ route('packing-list-2.batch.destroy', $batch->id) }}" method="POST" class="d-inline" id="formDeleteDetail">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger d-flex align-items-center gap-2" id="btnDeleteDetail" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
                        <i class="ti ti-trash fs-5"></i>
                        <span>Hapus Batch</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Meta Information Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <span class="text-muted fw-semibold" style="font-size: 12px;">Waktu Input Batch</span>
                <h6 class="fw-bold text-dark mt-1 mb-0">{{ $batch->created_at ? $batch->created_at->format('d M Y, H:i:s') : '-' }}</h6>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <span class="text-muted fw-semibold" style="font-size: 12px;">Dibuat Oleh</span>
                <h6 class="fw-bold text-dark mt-1 mb-0">{{ $batch->user->name ?? 'User' }}</h6>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <span class="text-muted fw-semibold" style="font-size: 12px;">Total Item Koil</span>
                <h6 class="fw-bold text-primary mt-1 mb-0">{{ $summary['total'] }} Koil</h6>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <span class="text-muted fw-semibold" style="font-size: 12px;">Catatan Batch</span>
                <h6 class="fw-normal text-dark mt-1 mb-0" style="font-size: 13px;">{{ $batch->catatan ?: '-' }}</h6>
            </div>
        </div>
    </div>

    <!-- Status Cards Ringkasan -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="{{ route('packing-list-2.detail', ['id' => $batch->id, 'status' => 'MENUNGGU_VALIDASI']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #fffbeb; border-left: 4px solid #f59e0b !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-warning fw-bold" style="font-size: 12px;"><i class="ti ti-clock me-1"></i>Menunggu</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">{{ $summary['menunggu'] }}</h4>
                        </div>
                        <span class="badge bg-warning text-white rounded-pill px-2">Pending</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('packing-list-2.detail', ['id' => $batch->id, 'status' => 'VALID']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #f0fdf4; border-left: 4px solid #10b981 !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-success fw-bold" style="font-size: 12px;"><i class="ti ti-circle-check me-1"></i>Valid (3/3 Cocok)</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">{{ $summary['valid'] }}</h4>
                        </div>
                        <span class="badge bg-success text-white rounded-pill px-2">Cocok</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('packing-list-2.detail', ['id' => $batch->id, 'status' => 'TIDAK_VALID']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #fef2f2; border-left: 4px solid #ef4444 !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-danger fw-bold" style="font-size: 12px;"><i class="ti ti-alert-triangle me-1"></i>Tidak Valid (Ada Selisih)</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">{{ $summary['tidak_valid'] }}</h4>
                        </div>
                        <span class="badge bg-danger text-white rounded-pill px-2">Selisih</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
        <div class="card-body p-4">
            <form action="{{ route('packing-list-2.detail', $batch->id) }}" method="GET" class="row g-3 align-items-center">
                <!-- Search Input -->
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0" style="border-color: #cbd5e1;">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari NO COIL / KODE / Nama..." value="{{ request('search') }}" style="border-color: #cbd5e1; font-size: 13.5px;">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-md-4">
                    <select name="status" class="form-select" style="border-color: #cbd5e1; font-size: 13.5px;">
                        <option value="">-- Semua Status --</option>
                        <option value="MENUNGGU_VALIDASI" {{ request('status') === 'MENUNGGU_VALIDASI' ? 'selected' : '' }}>Menunggu Pemeriksaan</option>
                        <option value="VALID" {{ request('status') === 'VALID' ? 'selected' : '' }}>Valid (3/3 Cocok)</option>
                        <option value="TIDAK_VALID" {{ request('status') === 'TIDAK_VALID' ? 'selected' : '' }}>Tidak Valid (Ada Selisih)</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-3 w-100" style="border-radius: 8px; font-weight: 600;">
                        <i class="ti ti-filter me-1"></i> Filter
                    </button>
                    @if (request()->hasAny(['search', 'status']))
                        <a href="{{ route('packing-list-2.detail', $batch->id) }}" class="btn btn-outline-secondary px-3" style="border-radius: 8px;" title="Reset Filter">
                            <i class="ti ti-rotate"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Items Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="fw-bold mb-0 text-dark">Daftar Item Koil di Batch Ini</h5>
                    <span class="text-muted" style="font-size: 13px;">(Menampilkan {{ count($items) }} dari {{ $summary['total'] }} item)</span>
                </div>
                <a href="{{ route('packing-list-2.batch.export-excel', array_merge(['id' => $batch->id], request()->only(['search', 'status']))) }}" class="btn-export-excel-table">
                    <i class="ti ti-file-spreadsheet"></i>
                    <span>Export ke Excel</span>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0" style="font-size: 12.5px; width: 100%;">
                    <thead class="table-light text-nowrap text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="text-center" style="width: 45px;">No</th>
                            <th style="width: 130px;">Status</th>
                            <th>Code Product</th>
                            <th style="min-width: 200px;">Product Name</th>
                            <th style="min-width: 95px; background-color: #dcfce7; color: #166534;" class="text-end border-success-subtle">
                                <i class="ti ti-check-circle me-1"></i>Quantity
                            </th>
                            <th>Unit</th>
                            <th style="min-width: 130px; background-color: #dcfce7; color: #166534;" class="border-success-subtle">
                                <i class="ti ti-scan me-1"></i>Attribute
                            </th>
                            <th>Storagen Bin</th>
                            <th>Production</th>
                            <th>No. SO</th>
                            <th style="min-width: 95px; background-color: #dcfce7; color: #166534;" class="text-end border-success-subtle">
                                <i class="ti ti-check-circle me-1"></i>Length
                            </th>
                            <th>Time Scan</th>
                            <th>Condition</th>
                            <th>Loc</th>
                            <th>Ket</th>
                            <th style="min-width: 120px;">Validator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $idx => $it)
                            @php
                                $clRes = $it->checklist_result ?: [];
                                $attrOk = !isset($clRes['attribute']) || $clRes['attribute'] === true;
                                $qtyOk  = !isset($clRes['quantity']) || $clRes['quantity'] === true;
                                $lenOk  = !isset($clRes['length']) || $clRes['length'] === true;
                            @endphp
                            <tr>
                                <td class="text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                                <td>
                                    @if ($it->status === 'MENUNGGU_VALIDASI')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="ti ti-clock me-1"></i>Menunggu
                                        </span>
                                    @elseif ($it->status === 'VALID' || $it->status === 'TERVALIDASI')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="ti ti-check me-1"></i>Valid (3/3)
                                        </span>
                                    @elseif ($it->status === 'TIDAK_VALID')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="ti ti-alert-triangle me-1"></i>Tidak Valid
                                        </span>
                                        @if ($it->catatan_verifikasi)
                                            <div class="text-danger fw-bold mt-1" style="font-size: 10px;">{{ $it->catatan_verifikasi }}</div>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary px-2 py-1" style="font-size: 11px;">{{ $it->status }}</span>
                                    @endif
                                </td>
                                <td class="fw-semibold text-dark">{{ $it->kode }}</td>
                                <td class="text-dark">{{ $it->nama_produk }}</td>
                                <td class="text-end fw-bold" style="{{ ($it->status === 'TIDAK_VALID' && !$qtyOk) ? 'background-color: #fee2e2; color: #991b1b; border: 1.5px solid #ef4444;' : 'background-color: #f0fdf4; color: #166534;' }}">
                                    @if ($it->status === 'TIDAK_VALID' && !$qtyOk)
                                        <span class="badge bg-danger text-white me-1" style="font-size: 9px;">BEDA</span>
                                    @endif
                                    {{ fmod((float)$it->qty, 1) !== 0.0 ? number_format((float)$it->qty, 2, ',', '.') : number_format((float)$it->qty, 0, ',', '.') }}
                                </td>
                                <td class="text-muted">{{ $it->uom }}</td>
                                <td class="fw-bold font-monospace" style="{{ ($it->status === 'TIDAK_VALID' && !$attrOk) ? 'background-color: #fee2e2; color: #991b1b; border: 1.5px solid #ef4444;' : 'background-color: #f0fdf4; color: #166534;' }}">
                                    @if ($it->status === 'TIDAK_VALID' && !$attrOk)
                                        <span class="badge bg-danger text-white me-1" style="font-size: 9px;">BEDA</span>
                                    @endif
                                    {{ $it->no_coil }}
                                </td>
                                <td>{{ $it->storage_bin ?: '-' }}</td>
                                <td class="text-muted">{{ $it->tanggal ? $it->tanggal->format('d/m/Y') : '-' }}</td>
                                <td>{{ $it->pengirim ?: '-' }}</td>
                                <td class="text-end fw-bold" style="{{ ($it->status === 'TIDAK_VALID' && !$lenOk) ? 'background-color: #fee2e2; color: #991b1b; border: 1.5px solid #ef4444;' : 'background-color: #f0fdf4; color: #166534;' }}">
                                    @if ($it->status === 'TIDAK_VALID' && !$lenOk)
                                        <span class="badge bg-danger text-white me-1" style="font-size: 9px;">BEDA</span>
                                    @endif
                                    {{ fmod((float)$it->panjang, 1) !== 0.0 ? number_format((float)$it->panjang, 2, ',', '.') : number_format((float)$it->panjang, 0, ',', '.') }}
                                </td>
                                <td class="text-muted" style="font-size: 11.5px;">{{ $it->time ? $it->time->format('m/d/Y H:i:s') : '-' }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $it->kondisi }}</span>
                                </td>
                                <td class="fw-semibold">{{ $it->tujuan }}</td>
                                <td class="text-muted">{{ $it->keterangan ?: '-' }}</td>
                                <td style="font-size: 12px;">
                                    @if ($it->validator)
                                        <span class="fw-medium text-dark">{{ $it->validator->name }}</span>
                                        <small class="text-muted d-block">{{ $it->validated_at ? $it->validated_at->format('d/m/Y H:i') : '' }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" class="text-center py-4 text-muted">
                                    Tidak ada item yang sesuai dengan filter pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnDelete = document.getElementById('btnDeleteDetail');
        if (btnDelete) {
            btnDelete.addEventListener('click', function(e) {
                e.preventDefault();
                window.showCustomConfirm({
                    iconClass: 'ti ti-trash-x',
                    title: 'Hapus Batch Ini?',
                    text: 'Seluruh data item koil di dalam batch ini akan dihapus permanen. Tindakan tidak dapat dibatalkan.',
                    confirmText: 'Ya, Hapus Sekarang'
                }).then(result => {
                    if (result.isConfirmed) {
                        document.getElementById('formDeleteDetail').submit();
                    }
                });
            });
        }
    });
</script>
@endpush
