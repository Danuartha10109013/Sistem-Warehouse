@extends('break_bulk.layout.V_template')

@section('title', 'Master Data - Break Bulk')

@php
    $activeTab = request('tab', 'grouping');
    if (!in_array($activeTab, ['grouping', 'pod', 'lokasi'])) {
        $activeTab = 'grouping';
    }
@endphp

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bolder mb-1 fs-5 fs-md-4" style="color: #1e293b; letter-spacing: -0.5px;">
                        <i class="fas fa-database text-primary me-2"></i>Master Data Break Bulk
                    </h4>
                    <div class="text-muted" style="font-size: 13px;">
                        Home <span class="mx-1">/</span> Setting Break Bulk <span class="mx-1">/</span> <span class="text-primary fw-semibold">Master Data</span>
                    </div>
                </div>
                <div class="w-100 w-sm-auto">
                    <button type="button" class="btn btn-primary w-100 w-sm-auto d-flex align-items-center justify-content-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahMaster" style="border-radius: 10px; font-weight: 600; padding: 10px 20px;">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Opsi Master</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Nav Tabs & Cards -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px;">
        <div class="card-header bg-white border-bottom pt-3 px-3 px-md-4" style="border-radius: 14px 14px 0 0;">
            <ul class="nav nav-tabs card-header-tabs" id="masterTabs" role="tablist" style="overflow-x: auto; flex-wrap: nowrap; -webkit-overflow-scrolling: touch; border-bottom: none;">
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link {{ $activeTab === 'grouping' ? 'active' : '' }} fw-bold text-dark d-flex align-items-center gap-2" id="grouping-tab" data-bs-toggle="tab" data-bs-target="#tabGrouping" data-tab-name="grouping" type="button" role="tab" style="padding: 10px 18px; white-space: nowrap;">
                        <i class="fas fa-layer-group text-primary"></i>
                        <span>Grouping ({{ $groupings->count() }})</span>
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link {{ $activeTab === 'pod' ? 'active' : '' }} fw-bold text-dark d-flex align-items-center gap-2" id="pod-tab" data-bs-toggle="tab" data-bs-target="#tabPod" data-tab-name="pod" type="button" role="tab" style="padding: 10px 18px; white-space: nowrap;">
                        <i class="fas fa-ship text-success"></i>
                        <span>POD / Pelabuhan ({{ $pods->count() }})</span>
                    </button>
                </li>
                <li class="nav-item flex-shrink-0" role="presentation">
                    <button class="nav-link {{ $activeTab === 'lokasi' ? 'active' : '' }} fw-bold text-dark d-flex align-items-center gap-2" id="lokasi-tab" data-bs-toggle="tab" data-bs-target="#tabLokasi" data-tab-name="lokasi" type="button" role="tab" style="padding: 10px 18px; white-space: nowrap;">
                        <i class="fas fa-map-marker-alt text-danger"></i>
                        <span>Lokasi ({{ $lokasis->count() }})</span>
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body p-3 p-md-4">
            <div class="tab-content" id="masterTabsContent">
                <!-- TAB 1: GROUPING -->
                <div class="tab-pane fade {{ $activeTab === 'grouping' ? 'show active' : '' }}" id="tabGrouping" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small">Pilihan kategori pengelompokan koil / muatan:</span>
                    </div>
                    <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                        <table class="table table-hover align-middle mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama Grouping</th>
                                    <th>Keterangan</th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($groupings as $idx => $g)
                                <tr>
                                    <td class="fw-semibold text-muted">{{ $idx + 1 }}</td>
                                    <td><span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 fw-bold font-monospace fs-6">{{ $g->nama }}</span></td>
                                    <td class="text-muted">{{ $g->keterangan ?: '-' }}</td>
                                    <td class="text-center">
                                        <form id="deleteMaster{{ $g->id }}" action="{{ route('break-bulk.master-data.destroy', $g->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon-btn delete-button" onclick="confirmDeleteMaster('{{ $g->id }}', '{{ $g->nama }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data grouping.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TAB 2: POD -->
                <div class="tab-pane fade {{ $activeTab === 'pod' ? 'show active' : '' }}" id="tabPod" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small">Pilihan Port of Discharge (Pelabuhan Bongkar Tujuan):</span>
                    </div>
                    <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                        <table class="table table-hover align-middle mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama Pelabuhan (POD)</th>
                                    <th>Keterangan</th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pods as $idx => $p)
                                <tr>
                                    <td class="fw-semibold text-muted">{{ $idx + 1 }}</td>
                                    <td><span class="badge bg-light text-success border border-success-subtle px-3 py-2 fw-bold font-monospace fs-6">{{ $p->nama }}</span></td>
                                    <td class="text-muted">{{ $p->keterangan ?: '-' }}</td>
                                    <td class="text-center">
                                        <form id="deleteMaster{{ $p->id }}" action="{{ route('break-bulk.master-data.destroy', $p->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon-btn delete-button" onclick="confirmDeleteMaster('{{ $p->id }}', '{{ $p->nama }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data POD.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TAB 3: LOKASI -->
                <div class="tab-pane fade {{ $activeTab === 'lokasi' ? 'show active' : '' }}" id="tabLokasi" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small">Pilihan Lokasi / Bay muat Break Bulk:</span>
                    </div>
                    <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                        <table class="table table-hover align-middle mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Keterangan</th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lokasis as $idx => $l)
                                <tr>
                                    <td class="fw-semibold text-muted">{{ $idx + 1 }}</td>
                                    <td><span class="badge bg-light text-danger border border-danger-subtle px-3 py-2 fw-bold font-monospace fs-6">{{ $l->nama }}</span></td>
                                    <td class="text-muted">{{ $l->keterangan ?: '-' }}</td>
                                    <td class="text-center">
                                        <form id="deleteMaster{{ $l->id }}" action="{{ route('break-bulk.master-data.destroy', $l->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon-btn delete-button" onclick="confirmDeleteMaster('{{ $l->id }}', '{{ $l->nama }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data lokasi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Master Data -->
<div class="modal fade" id="modalTambahMaster" tabindex="-1" aria-labelledby="modalTambahMasterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom py-3 px-3 px-md-4">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 fs-6 fs-md-5" id="modalTambahMasterLabel">
                    <i class="fas fa-plus-circle text-primary"></i> Tambah Pilihan Master Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('break-bulk.master-data.store') }}" method="POST">
                @csrf
                <div class="modal-body p-3 p-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Kategori Master: <span class="text-danger">*</span></label>
                        <select name="kategori" id="modalKategoriSelect" class="form-select" required style="border-radius: 8px; height: 44px;">
                            <option value="grouping">Grouping</option>
                            <option value="pod">POD (Pelabuhan Tujuan)</option>
                            <option value="lokasi">Lokasi / Bay</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Nama Opsi: <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control font-monospace fw-bold" placeholder="Contoh: CR NON OIL, HOUSTON, TB-1" required style="border-radius: 8px; height: 44px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Keterangan: (Opsional)</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Deskripsi singkat..." style="border-radius: 8px; height: 44px;">
                    </div>
                </div>
                <div class="modal-footer border-top py-3 px-3 px-md-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-save"></i> Simpan Master
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('#masterTabs button[data-bs-toggle="tab"]');
        const modalKategoriSelect = document.getElementById('modalKategoriSelect');

        // Simpan state tab saat berpindah & update URL query tanpa refresh
        tabButtons.forEach(btn => {
            btn.addEventListener('shown.bs.tab', function(e) {
                const tabName = e.target.getAttribute('data-tab-name');
                if (tabName) {
                    sessionStorage.setItem('breakBulkActiveTab', tabName);
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.set('tab', tabName);
                    window.history.replaceState({}, '', newUrl);

                    // Sesuaikan dropdown modal tambah sesuai tab aktif
                    if (modalKategoriSelect) {
                        modalKategoriSelect.value = tabName;
                    }
                }
            });
        });

        // Set awal kategori modal tambah saat dibuka
        const activeBtn = document.querySelector('#masterTabs button.active');
        if (activeBtn && modalKategoriSelect) {
            const currentTabName = activeBtn.getAttribute('data-tab-name');
            if (currentTabName) {
                modalKategoriSelect.value = currentTabName;
            }
        }
    });

    function confirmDeleteMaster(id, nama) {
        window.showCustomConfirm({
            iconClass: 'fas fa-trash-alt',
            title: 'Hapus Pilihan Master?',
            text: `Opsi <strong>${nama}</strong> akan dihapus dari pilihan dropdown.`,
            confirmText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteMaster' + id).submit();
            }
        });
    }
</script>
@endpush
