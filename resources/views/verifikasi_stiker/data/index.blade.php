@extends('verifikasi_stiker.layout.V_template')

@section('title', 'Data Bahan Baku & Import Excel')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-3 mb-md-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Data Bahan Baku Masuk</h4>
                <div class="text-muted" style="font-size: 13px;">
                    Home <span class="mx-1">/</span> Verifikasi Stiker <span class="mx-1">/</span> Data & Import
                </div>
            </div>
            <div class="w-100 w-md-auto">
                <button type="button" class="btn btn-primary w-100 w-md-auto d-inline-flex align-items-center justify-content-center gap-2 shadow-sm py-2 px-3" data-bs-toggle="modal" data-bs-target="#modalImportExcel" style="border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-file-import"></i>
                    <span>Import Excel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('verifikasi-stiker.data') }}" class="row g-3 align-items-center">
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-bold text-muted mb-1">Tanggal Input Admin:</label>
                    <select name="tanggal_input" class="form-select">
                        <option value="all">-- Semua Tanggal Input --</option>
                        @foreach($availableDates as $dt)
                            @php $dtStr = $dt->format('Y-m-d'); @endphp
                            <option value="{{ $dtStr }}" {{ request('tanggal_input') == $dtStr ? 'selected' : '' }}>
                                {{ $dt->format('d/m/Y') }} {{ $dtStr == now()->toDateString() ? '(Hari Ini)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-bold text-muted mb-1">Status Verifikasi:</label>
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Diverifikasi</option>
                        <option value="sesuai" {{ request('status') == 'sesuai' ? 'selected' : '' }}>Sesuai (OK)</option>
                        <option value="tidak_sesuai" {{ request('status') == 'tidak_sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Cari Kata Kunci:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Attribute, Produk, atau Lot No..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-12 col-md-2 d-flex align-items-end gap-2" style="margin-top: auto;">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold" style="border-radius: 8px;">
                        Filter
                    </button>
                    @if(request('search') || request('status') || request('tanggal_input'))
                        <a href="{{ route('verifikasi-stiker.data') }}" class="btn btn-outline-secondary" title="Reset Filter" style="border-radius: 8px;">
                            <i class="fas fa-undo"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Master Bahan Baku -->
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom p-3 p-md-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-0" style="color: #1e293b; font-size: 16px;">Daftar Item Bahan Baku ({{ number_format($data->total()) }} Item)</h5>
                <small class="text-muted" style="font-size: 12px;">Data dikelompokkan per Tanggal Input Admin | 3 Ceklis Verifikasi</small>
            </div>
            @if($data->total() > 0)
                <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" id="btnResetAll" style="border-radius: 6px;">
                    <i class="fas fa-trash-alt"></i>
                    <span>Reset Semua Data</span>
                </button>
                <form id="formResetAll" action="{{ route('verifikasi-stiker.truncate') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endif
        </div>

        <!-- Swipe Hint Khusus Layar HP -->
        <div class="d-block d-md-none text-muted small px-3 py-2 border-bottom bg-light" style="font-size: 12px;">
            <i class="fas fa-arrows-alt-h me-1 text-primary"></i> Geser tabel ke samping untuk melihat seluruh data
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="ps-4 text-center" style="width: 45px;">No</th>
                            <th>Tgl Input</th>
                            <th>Attribute</th>
                            <th>Produk (Kuning)</th>
                            <th>Supplier Lot No (Kuning)</th>
                            <th>Tgl DN</th>
                            <th class="text-end">Berat</th>
                            <th class="text-center">3 Ceklis Fisik</th>
                            <th class="text-center">Status</th>
                            <th>Petugas Verifikasi</th>
                            <th class="text-center pe-4" style="width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                        <tr>
                            <td class="ps-4 text-center text-muted fw-semibold">
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td style="font-size: 13px;">
                                <span class="badge bg-light text-dark border">
                                    {{ $item->tanggal_input ? $item->tanggal_input->format('d/m/Y') : '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace" style="font-size: 12px; letter-spacing: 0.3px;">
                                    {{ $item->attribute }}
                                </span>
                            </td>
                            <td class="fw-semibold" style="color: #1e293b; max-width: 220px;">
                                {{ $item->produk }}
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace">
                                    {{ $item->supplier_lot_no }}
                                </span>
                            </td>
                            <td style="font-size: 13px;">{{ $item->tgl_dn ?? '-' }}</td>
                            <td class="text-end fw-bold font-monospace">
                                {{ number_format($item->berat, 2, '.', ',') }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <!-- Cek Produk -->
                                    <span class="badge {{ $item->check_produk ? 'bg-success' : 'bg-light text-muted border' }}" title="Ceklis Produk: {{ $item->check_produk ? 'Sesuai' : 'Belum' }}" style="font-size: 10px;">
                                        P {{ $item->check_produk ? '✓' : '✗' }}
                                    </span>
                                    <!-- Cek Lot No -->
                                    <span class="badge {{ $item->check_lot_no ? 'bg-success' : 'bg-light text-muted border' }}" title="Ceklis Lot No: {{ $item->check_lot_no ? 'Sesuai' : 'Belum' }}" style="font-size: 10px;">
                                        L {{ $item->check_lot_no ? '✓' : '✗' }}
                                    </span>
                                    <!-- Cek Berat -->
                                    <span class="badge {{ $item->check_berat ? 'bg-success' : 'bg-light text-muted border' }}" title="Ceklis Berat: {{ $item->check_berat ? 'Sesuai' : 'Belum' }}" style="font-size: 10px;">
                                        B {{ $item->check_berat ? '✓' : '✗' }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->status_verifikasi == 'sesuai')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 11px;">
                                        <i class="fas fa-check me-1"></i> Sesuai
                                    </span>
                                @elseif($item->status_verifikasi == 'tidak_sesuai')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 11px;">
                                        <i class="fas fa-times me-1"></i> Tidak Sesuai
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 11px;">
                                        <i class="fas fa-clock me-1"></i> Belum
                                    </span>
                                @endif
                            </td>
                            <td style="font-size: 13px;">
                                @if($item->verified_by)
                                    <div class="fw-semibold text-dark">{{ $item->verified_by }}</div>
                                    <div class="text-muted" style="font-size: 11px;">{{ $item->verified_at ? $item->verified_at->format('d/m/Y H:i') : '' }}</div>
                                    @if($item->catatan)
                                        <div class="text-danger small fst-italic">{{ $item->catatan }}</div>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center pe-4">
                                <div class="action-icons">
                                    <form action="{{ route('verifikasi-stiker.destroy', $item->id) }}" method="POST" class="d-inline form-delete-item">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="action-icon-btn delete-button btn-confirm-delete" title="Hapus Item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                <p class="mb-2">Tidak ada data bahan baku pada filter ini.</p>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalImportExcel">
                                    <i class="fas fa-file-import me-1"></i> Import File Excel
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($data->hasPages())
                <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="text-muted small">
                        Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
                    </div>
                    <div>
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade" id="modalImportExcel" tabindex="-1" aria-labelledby="modalImportExcelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
            <form action="{{ route('verifikasi-stiker.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalImportExcelLabel" style="color: #1e293b;">
                        <i class="fas fa-file-excel text-success me-2"></i> Import Rekap Bahan Baku Masuk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 mb-3" style="background-color: #eff6ff; color: #1e40af; border-radius: 10px; font-size: 13px;">
                        <i class="fas fa-info-circle me-1"></i>
                        Data akan disimpan dengan label <strong>Tanggal Input Admin</strong> agar pengelompokan verifikasi harian rapi:
                        <ul class="mb-0 mt-1 ps-3">
                            <li><strong>Filter Khusus:</strong> Hanya data dengan kode Attribute berawalan <code>CR_</code> yang akan diimport. Barcode selain <code>CR_</code> otomatis dilewati.</li>
                            <li><strong>Aturan Duplikat:</strong> Kode Attribute <code>CR_</code> wajib unik dan tidak boleh duplikat (otomatis dilewati jika sudah ada).</li>
                            <li><strong>Format Kolom:</strong> Attribute (C), Produk (B), Supplier Lot No (D), Tgl DN (E), Berat (H)</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_input" class="form-label fw-semibold" style="color: #334155;">Tanggal Input Admin</label>
                        <input class="form-control" type="date" id="tanggal_input" name="tanggal_input" value="{{ date('Y-m-d') }}" required style="border-radius: 8px;">
                        <small class="text-muted">Data ini akan dikelompokkan pada tanggal tersebut.</small>
                    </div>

                    <div class="mb-3">
                        <label for="file_excel" class="form-label fw-semibold" style="color: #334155;">Pilih File Excel (.xlsx, .xls, .csv)</label>
                        <input class="form-control" type="file" id="file_excel" name="file_excel" accept=".xlsx,.xls,.csv" required style="border-radius: 8px;">
                        <small class="text-muted">Maksimal ukuran file: 10 MB</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold" style="border-radius: 8px;">
                        <i class="fas fa-upload me-1"></i> Mulai Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.btn-confirm-delete').on('click', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        window.showCustomConfirm({
            iconClass: 'fas fa-trash-alt',
            title: 'Hapus Item?',
            text: 'Item bahan baku ini akan dihapus dari sistem verifikasi stiker.',
            confirmText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $('#btnResetAll').on('click', function() {
        window.showCustomConfirm({
            iconClass: 'fas fa-exclamation-triangle',
            title: 'Reset Semua Data?',
            text: 'Semua data bahan baku & riwayat verifikasi akan dihapus permanen!',
            confirmText: 'Ya, Reset Semua'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formResetAll').submit();
            }
        });
    });
});
</script>
@endpush
