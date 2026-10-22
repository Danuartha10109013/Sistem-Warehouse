@extends('packing_list_2.layout.V_template')

@section('title', 'Daftar Batch - Packing List 2.0')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Monitoring Batch Packing List 2.0</h4>
                <div class="text-muted" style="font-size: 14px;">
                    Home <span class="mx-1">/</span> Packing List 2.0 <span class="mx-1">/</span> Daftar Batch
                </div>
            </div>
            <div>
                <a href="{{ route('packing-list-2.paste') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 18px;">
                    <i class="ti ti-clipboard-data fs-5"></i>
                    <span>Tempel Data dari Excel</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-folders" style="font-size: 70px; color: #135b9f;"></i>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);">
                            <i class="ti ti-folders fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 26px; color: #1e293b;">{{ number_format($totalBatch, 0, ',', '.') }}</h3>
                    <p class="mb-0 text-muted fw-semibold" style="font-size: 13px;">Total Batch Input</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-packages" style="font-size: 70px; color: #10b981;"></i>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="ti ti-packages fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 26px; color: #1e293b;">{{ number_format($totalItems, 0, ',', '.') }}</h3>
                    <p class="mb-0 text-muted fw-semibold" style="font-size: 13px;">Total Item Koil</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-clock-hour-4" style="font-size: 70px; color: #f59e0b;"></i>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="ti ti-clock-hour-4 fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 26px; color: #1e293b;">{{ number_format($totalMenunggu, 0, ',', '.') }}</h3>
                    <p class="mb-0 text-muted fw-semibold" style="font-size: 13px;">Menunggu Validasi</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; background: linear-gradient(135deg, #fdf2f8 0%, #ffffff 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="ti ti-circle-check" style="font-size: 70px; color: #ec4899;"></i>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
                            <i class="ti ti-circle-check fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bolder mb-1" style="font-size: 26px; color: #1e293b;">{{ number_format($totalTervalidasi, 0, ',', '.') }}</h3>
                    <p class="mb-0 text-muted fw-semibold" style="font-size: 13px;">Tervalidasi / Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card: Daftar Batch -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h5 class="fw-bold mb-1" style="color: #1e293b;">Daftar Batch Hasil Tempel</h5>
                    <p class="text-muted mb-0" style="font-size: 13px;">Riwayat batch koil yang diinput dari Excel.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group" style="width: 250px;">
                        <span class="input-group-text bg-white border-end-0" style="border-color: #e2e8f0;">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 custom-dt-search" placeholder="Cari batch..." style="border-color: #e2e8f0; font-size: 14px;">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="dataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                    <thead style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <tr>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold" style="font-size: 12px; width: 60px;">No</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold" style="font-size: 12px;">Kode Batch</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold" style="font-size: 12px;">Tanggal Input</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold" style="font-size: 12px;">Dibuat Oleh</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold text-center" style="font-size: 12px;">Total Item</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold" style="font-size: 12px;">Ringkasan Status</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold" style="font-size: 12px;">Catatan</th>
                            <th class="py-3 px-3 text-secondary text-uppercase fw-bold text-center" style="font-size: 12px; width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $index => $b)
                            @php
                                $total = (int) ($b->total_items_count ?: $b->total_item);
                                $done = (int) $b->count_tervalidasi;
                                $valid = (int) $b->count_valid;
                                $tidakValid = (int) $b->count_tidak_valid;
                                $pending = (int) $b->count_menunggu;
                            @endphp
                            <tr>
                                <td class="px-3 text-muted fw-semibold">{{ $index + 1 }}</td>
                                <td class="px-3">
                                    <a href="{{ route('packing-list-2.detail', $b->id) }}" class="fw-bold text-primary text-decoration-none">
                                        {{ $b->kode_batch }}
                                    </a>
                                </td>
                                <td class="px-3 text-muted" style="font-size: 13px;">
                                    {{ $b->created_at ? $b->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 11px;">
                                            {{ strtoupper(substr($b->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="text-dark fw-medium" style="font-size: 13px;">{{ $b->user->name ?? 'User' }}</span>
                                    </div>
                                </td>
                                <td class="px-3 text-center fw-bold text-dark">
                                    {{ $total }} Koil
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        @if ($pending > 0)
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="ti ti-clock me-1"></i>{{ $pending }} Menunggu
                                            </span>
                                        @endif
                                        @if ($valid > 0)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="ti ti-check me-1"></i>{{ $valid }} Valid (3/3)
                                            </span>
                                        @endif
                                        @if ($tidakValid > 0)
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="ti ti-alert-triangle me-1"></i>{{ $tidakValid }} Tidak Valid
                                            </span>
                                        @endif
                                        @if ($total == 0)
                                            <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 11.5px;">Kosong</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3 text-muted" style="font-size: 12.5px;">
                                    {{ $b->catatan ? Str::limit($b->catatan, 35) : '-' }}
                                </td>
                                <td class="px-3 text-center">
                                    <div class="action-icons">
                                        <!-- Detail Button -->
                                        <a href="{{ route('packing-list-2.detail', $b->id) }}" class="action-icon-btn" title="Lihat Detail Item">
                                            <i class="ti ti-eye fs-5"></i>
                                        </a>

                                        <!-- Hapus Button (Bisa dihapus kapan saja) -->
                                        <form action="{{ route('packing-list-2.batch.destroy', $b->id) }}" method="POST" class="d-inline form-delete-batch">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon-btn delete-button btn-confirm-delete" title="Hapus Batch" data-batch="{{ $b->kode_batch }}">
                                                <i class="ti ti-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="ti ti-inbox text-secondary" style="font-size: 50px;"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark">Belum Ada Batch Packing List</h6>
                                    <p class="mb-3" style="font-size: 13px;">Klik tombol di bawah untuk mulai menempel data koil dari Excel.</p>
                                    <a href="{{ route('packing-list-2.paste') }}" class="btn btn-primary btn-sm px-3 py-2" style="border-radius: 8px;">
                                        <i class="ti ti-clipboard-data me-1"></i> Tempel Data Sekarang
                                    </a>
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
        document.querySelectorAll('.btn-confirm-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const batchCode = this.getAttribute('data-batch') || 'Batch';

                window.showCustomConfirm({
                    iconClass: 'ti ti-trash-x',
                    title: `Hapus ${batchCode}?`,
                    text: `Seluruh item koil di dalam batch <strong>${batchCode}</strong> akan dihapus permanen.<br>Tindakan ini tidak dapat dibatalkan.`,
                    confirmText: 'Ya, Hapus Batch'
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
