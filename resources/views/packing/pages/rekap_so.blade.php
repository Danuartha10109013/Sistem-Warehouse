@extends('packing.layout.main')

@section('title')
    Rekap No SO - Laporan Packing
@endsection

@section('content')

<div class="container pb-5">

    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="m-0 fw-bold text-dark">
                <i class="fas fa-file-invoice text-primary me-2"></i>Rekap No SO
            </h3>
            <small class="text-muted">Master data referensi No SO & Catatan otomatis untuk scan attribute Laporan Packing</small>
        </div>
    </div>

    <!-- Alert Success / Errors / Import Summary -->
    @if(session('import_summary'))
        @php
            $inserted = session('import_summary')['inserted'] ?? 0;
            $duplicates = session('import_summary')['duplicates'] ?? [];
            $dupCount = count($duplicates);
        @endphp

        @if($inserted > 0 && $dupCount == 0)
            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>Berhasil menambahkan seluruh <strong>{{ $inserted }}</strong> data Rekap No SO dari file Excel.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif($inserted > 0 && $dupCount > 0)
            <div class="alert alert-warning alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                <div class="d-flex align-items-center mb-1">
                    <i class="fas fa-info-circle me-2 fs-5 text-warning"></i>
                    <strong>Hasil Import: Berhasil Menambahkan {{ $inserted }} data baru, dan {{ $dupCount }} data tidak dapat ditambahkan karena nomor attribute sudah terdaftar di master:</strong>
                </div>
                <div class="mt-2 text-dark small">
                    <strong>Daftar nomor attribute yang sudah ada di tabel (dilewati):</strong>
                    <div class="mt-1 p-2 bg-white rounded-3 border" style="max-height: 120px; overflow-y: auto;">
                        @foreach($duplicates as $dup)
                            <span class="badge bg-danger-subtle text-danger border me-1 mb-1 font-monospace">{{ $dup }}</span>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                <div class="d-flex align-items-center mb-1">
                    <i class="fas fa-exclamation-triangle me-2 fs-5"></i>
                    <strong>Tidak ada data baru yang ditambahkan. Sebanyak {{ $dupCount }} data tidak dapat ditambahkan karena sudah tersedia di tabel Daftar Master Rekap No SO:</strong>
                </div>
                <div class="mt-2 text-dark small">
                    <div class="mt-1 p-2 bg-white rounded-3 border" style="max-height: 120px; overflow-y: auto;">
                        @foreach($duplicates as $dup)
                            <span class="badge bg-danger-subtle text-danger border me-1 mb-1 font-monospace">{{ $dup }}</span>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i><strong>Terjadi Kesalahan:</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Card Input & Upload Excel -->
    <div class="card shadow-lg border-0 rounded-4 p-4 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">
                    <i class="fas fa-file-excel text-success me-2"></i>Import Data Rekap No SO dari Excel
                </h5>
                <p class="text-muted small mb-0">
                    Upload file Excel dengan kolom: <strong>Atrribute</strong>, <strong>No SO</strong>, dan <strong>Catatan(opsional)</strong>.
                </p>
            </div>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <a href="{{ route('pac.rekap_so.template') }}" class="btn btn-outline-success rounded-pill px-3 py-2 btn-sm">
                    <i class="fas fa-download me-1"></i>Download Template
                </a>
                <button type="button" class="btn btn-outline-primary rounded-pill px-3 py-2 btn-sm" data-bs-toggle="collapse" data-bs-target="#manualInputCollapse">
                    <i class="fas fa-plus me-1"></i>Input Manual
                </button>
            </div>
        </div>

        <!-- Form Manual Input (Collapsible) -->
        <div class="collapse mb-4" id="manualInputCollapse">
            <div class="p-3 bg-light rounded-4 border">
                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-edit me-1 text-primary"></i>Tambah Manual 1 Data</h6>
                <form action="{{ route('pac.rekap_so.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Atrribute <span class="text-danger">*</span></label>
                            <input type="text" name="attribute" class="form-control rounded-pill px-3 py-2" placeholder="Contoh: G1L26123935" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">No SO <span class="text-danger">*</span></label>
                            <input type="text" name="no_so" class="form-control rounded-pill px-3 py-2" placeholder="Contoh: SOX26-029" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Catatan(opsional)</label>
                            <input type="text" name="catatan" class="form-control rounded-pill px-3 py-2" placeholder="Contoh: TAMPA">
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 btn-sm">
                                <i class="fas fa-save me-1"></i>Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Upload Excel Normal Size -->
        <form action="{{ route('pac.rekap_so.store') }}" method="POST" enctype="multipart/form-data" id="formUploadExcel">
            @csrf
            
            <div class="row g-3 align-items-end mb-4">
                <div class="col-md-8 col-lg-9">
                    <label class="form-label small fw-bold mb-1">
                        <i class="fas fa-file-excel text-success me-1"></i>Pilih File Excel (.xlsx / .xls / .csv)
                    </label>
                    <input type="file" id="fileExcel" name="file_excel" accept=".xlsx, .xls, .csv" 
                        class="form-control rounded-pill px-3 py-2" required>
                </div>
                <div class="col-md-4 col-lg-3">
                    <button type="submit" id="btnSubmitExcel" class="btn btn-primary rounded-pill w-100 py-2">
                        <i class="fas fa-upload me-2"></i>Import File Excel
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <a href="{{ route('pac') }}" class="btn btn-light border rounded-pill px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Card Tabel Daftar Rekap No SO -->
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">
                    <i class="fas fa-database text-primary me-2"></i>Daftar Master Rekap No SO
                </h5>
                <small class="text-muted">Data ini otomatis mengisi No SO & Catatan saat scan Attribute di Tambah Laporan Packing</small>
            </div>

            <div class="mt-2 mt-md-0 d-flex flex-wrap align-items-center gap-2">
                <!-- Form Pencarian -->
                <form action="{{ route('pac.rekap_so') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-pill px-3 py-1 small" 
                            placeholder="Cari Attribute / No SO..." value="{{ $search ?? '' }}">
                        @if($search)
                        <a href="{{ route('pac.rekap_so') }}" class="btn btn-outline-secondary rounded-pill ms-1 px-3 py-1 small">
                            Reset
                        </a>
                        @endif
                        <button class="btn btn-primary rounded-pill ms-1 px-3 py-1 small" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                @if($rekapData->total() > 0)
                <!-- Tombol Clear Semua Data -->
                <form action="{{ route('pac.rekap_so.clear') }}" method="POST" id="formClearAll" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger rounded-pill px-3 py-1 small" id="btnClearAll">
                        <i class="fas fa-trash-alt me-1"></i>Clear Semua Data
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div class="table-responsive rounded-3 border">
            <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Atrribute</th>
                        <th>No SO</th>
                        <th>Catatan(opsional)</th>
                        <th>Ditambahkan</th>
                        <th style="width: 100px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapData as $index => $item)
                    <tr>
                        <td>{{ $rekapData->firstItem() + $index }}</td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary font-monospace fw-bold px-2 py-1">
                                {{ $item->attribute }}
                            </span>
                        </td>
                        <td>
                            <strong class="text-dark">{{ $item->no_so }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $item->catatan ?: '-' }}</span>
                        </td>
                        <td class="text-muted small">
                            {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('pac.rekap_so.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete-row"
                                    data-attribute="{{ $item->attribute }}">
                                    <i class="fas fa-trash-alt me-1"></i>Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-3x text-secondary opacity-50 mb-2"></i>
                            <p class="mb-0">Belum ada data Rekap No SO. Silakan upload file Excel atau input manual.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($rekapData->hasPages())
        <div class="mt-3 d-flex justify-content-end">
            {{ $rekapData->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</div>

<style>
    .pagination svg {
        max-width: 18px !important;
        max-height: 18px !important;
    }
    .pagination .page-item .page-link {
        color: #135b9f;
        border-radius: 8px;
        margin: 0 2px;
    }
    .pagination .page-item.active .page-link {
        background-color: #135b9f;
        border-color: #135b9f;
        color: #ffffff;
    }
</style>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Konfirmasi Hapus Data
        const deleteButtons = document.querySelectorAll(".btn-delete-row");
        deleteButtons.forEach(btn => {
            btn.addEventListener("click", function () {
                const form = this.closest("form");
                const attr = this.getAttribute("data-attribute");

                Swal.fire({
                    title: 'Hapus Rekap No SO?',
                    html: `Data attribute <strong>${attr}</strong> akan dihapus dari master rekap.<br><small class="text-muted">Catatan: Data di Laporan Packing yang sudah tersimpan TIDAK akan terpengaruh.</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#b91c1c',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Konfirmasi Clear Semua Data
        const btnClearAll = document.getElementById("btnClearAll");
        if (btnClearAll) {
            btnClearAll.addEventListener("click", function () {
                const form = document.getElementById("formClearAll");
                Swal.fire({
                    title: 'Clear Seluruh Data Rekap?',
                    html: `Semua data master Rekap No SO akan <strong>dikosongkan</strong>.<br><br><span class="badge bg-success-subtle text-success p-2">Data Laporan Packing yang sudah tersimpan TIDAK akan terpengaruh.</span>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#b91c1c',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Kosongkan Semua',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }
    });

    @if(session('import_summary'))
        @php
            $inserted = session('import_summary')['inserted'] ?? 0;
            $duplicates = session('import_summary')['duplicates'] ?? [];
            $dupCount = count($duplicates);
            $dupHtml = '';
            foreach($duplicates as $d) {
                $dupHtml .= '<span class="badge bg-danger-subtle text-danger border m-1 p-1" style="font-size:12px; font-family:monospace;">' . e($d) . '</span>';
            }
        @endphp

        @if($inserted > 0 && $dupCount == 0)
            Swal.fire({
                icon: 'success',
                title: 'Import Berhasil!',
                text: 'Berhasil menambahkan seluruh {{ $inserted }} data ke Rekap No SO.',
                confirmButtonColor: '#135b9f'
            });
        @elseif($inserted > 0 && $dupCount > 0)
            Swal.fire({
                icon: 'warning',
                title: 'Hasil Import Excel',
                html: `
                    <div class="text-start">
                        <p class="mb-2"><strong class="text-success">✓ Berhasil Menambahkan {{ $inserted }} data baru.</strong></p>
                        <p class="mb-1 text-danger"><strong>⚠ {{ $dupCount }} data tidak dapat ditambahkan</strong> karena nomor attribute sudah terdaftar di tabel Daftar Master Rekap No SO:</p>
                        <div class="p-2 border rounded bg-light" style="max-height: 150px; overflow-y: auto;">
                            {!! $dupHtml !!}
                        </div>
                    </div>
                `,
                confirmButtonColor: '#135b9f'
            });
        @else
            Swal.fire({
                icon: 'error',
                title: 'Data Duplikat',
                html: `
                    <div class="text-start">
                        <p class="mb-2 text-danger"><strong>Tidak ada data baru yang ditambahkan.</strong></p>
                        <p class="mb-1">Sebanyak <strong>{{ $dupCount }} data</strong> tidak dapat ditambahkan karena nomor attribute sudah tersedia di tabel Daftar Master Rekap No SO:</p>
                        <div class="p-2 border rounded bg-light" style="max-height: 150px; overflow-y: auto;">
                            {!! $dupHtml !!}
                        </div>
                    </div>
                `,
                confirmButtonColor: '#135b9f'
            });
        @endif
    @endif
</script>

@endsection
