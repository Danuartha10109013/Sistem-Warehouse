@extends('verifikasi_timbangan.layout.V_template')

@section('title', 'Verifikasi Timbangan Open Pack')

@section('content')
<style>
    /* Menyesuaikan dengan gaya DataTables standar / clean UI */
    .table-clean {
        border-collapse: collapse;
    }
    .table-clean thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 13px;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
        vertical-align: middle;
        padding: 16px 12px;
        white-space: nowrap;
    }
    .table-clean tbody td {
        vertical-align: middle;
        font-size: 13.5px;
        color: #64748b;
        padding: 16px 12px;
        border-bottom: 1px solid #f1f5f9;
        background-color: #ffffff;
    }
    .table-clean tbody tr:hover td {
        background-color: #f8fafc;
    }
    .action-icon {
        background: transparent;
        border: none;
        padding: 4px 6px;
        font-size: 16px;
        transition: transform 0.2s;
    }
    .action-icon:hover {
        transform: scale(1.1);
    }
    .badge-soft {
        padding: 4px 8px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 4px;
    }
    
    /* Custom SweetAlert Styling (Matching Image 2) */
    .swal2-popup-custom {
        border-radius: 16px !important;
        padding: 2rem 1rem !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1) !important;
    }
    .swal2-cancel-custom {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 14.5px !important;
        margin-right: 12px !important;
    }
    .swal2-cancel-custom:hover {
        background-color: #e2e8f0 !important;
    }
    .swal2-confirm-custom {
        background-color: #A22C29 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 14.5px !important;
    }
    .swal2-confirm-custom:hover {
        background-color: #8b0000 !important;
    }
    .sort-icon {
        font-size: 10px;
        color: #cbd5e1;
        margin-left: 6px;
    }
    
    /* Pagination Styling */
    .pagination-clean .pagination {
        margin-bottom: 0;
    }
    .pagination-clean .page-link {
        color: #475569;
        border: 1px solid #e2e8f0;
        margin: 0 2px;
        border-radius: 4px;
        font-size: 13.5px;
        padding: 6px 12px;
    }
    .pagination-clean .page-item.active .page-link {
        background-color: #135b9f;
        border-color: #135b9f;
        color: #ffffff;
    }
    .pagination-clean .page-link:hover {
        background-color: #f1f5f9;
        color: #1e293b;
    }
</style>

<div class="container-fluid p-0">
    
    <!-- Tabel Data & Header Menyatu -->
    <div class="card border-0 shadow-sm" style="border-radius: 8px;">
        <!-- Card Header -->
        <div class="card-header bg-white border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2" style="padding: 20px 24px;">
            <h5 class="fw-bold mb-0" style="color: #1e293b; font-size: 16px;">Verifikasi Timbangan Open Pack</h5>
            <button class="btn btn-primary fw-semibold text-nowrap" style="background-color: #135b9f; border: none; border-radius: 6px; padding: 10px 20px; font-size: 13.5px;" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </button>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <!-- Gunakan class DataTables jika library-nya tersedia di V_template -->
                <table class="table table-clean w-100 mb-0" id="tabelVerifikasi">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">NO <i class="fas fa-sort sort-icon"></i></th>
                            <th>TANGGAL <i class="fas fa-sort sort-icon"></i></th>
                            <th>LABEL <i class="fas fa-sort sort-icon"></i></th>
                            <th>ACTUAL <i class="fas fa-sort sort-icon"></i></th>
                            <th>SELISIH <i class="fas fa-sort sort-icon"></i></th>
                            <th class="text-center">STATUS <i class="fas fa-sort sort-icon"></i></th>
                            <th>TINDAK LANJUT <i class="fas fa-sort sort-icon"></i></th>
                            <th>ACT. SETELAH <i class="fas fa-sort sort-icon"></i></th>
                            <th>SEL. SETELAH <i class="fas fa-sort sort-icon"></i></th>
                            <th>OPERATOR <i class="fas fa-sort sort-icon"></i></th>
                            <th class="text-center">ACTION <i class="fas fa-sort sort-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $row)
                        <tr>
                            <td class="text-center">{{ $data->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $row->label }} kg</td>
                            <td>{{ $row->actual }} kg</td>
                            
                            <!-- Selisih -->
                            @if($row->selisih < -10 || $row->selisih > 10)
                                <td style="color: #dc2626; font-weight: 600;">{{ $row->selisih > 0 ? '+'.$row->selisih : $row->selisih }} kg</td>
                            @else
                                <td style="color: #059669; font-weight: 600;">{{ $row->selisih > 0 ? '+'.$row->selisih : $row->selisih }} kg</td>
                            @endif

                            <!-- Status -->
                            <td class="text-center">
                                @if($row->status == 'OK')
                                    <span class="badge" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #059669; font-weight: 600; padding: 5px 10px;">OK</span>
                                @else
                                    @if(is_null($row->tindak_lanjut))
                                        <span class="badge" style="background-color: #fef2f2; color: #991b1b; border: 1px solid #dc2626; font-weight: 600; padding: 5px 10px;">NOT-OK</span>
                                    @else
                                        <span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #2563eb; font-weight: 600; padding: 5px 10px;">CALIBRATED</span>
                                    @endif
                                @endif
                            </td>
                            
                            <!-- Hasil Tindak Lanjut -->
                            <td>{{ $row->tindak_lanjut ?? '-' }}</td>
                            <td>{{ $row->actual_setelah ? $row->actual_setelah.' kg' : '-' }}</td>
                            <td>
                                @if(!is_null($row->selisih_setelah))
                                    {{ $row->selisih_setelah > 0 ? '+'.$row->selisih_setelah : $row->selisih_setelah }} kg
                                @else
                                    -
                                @endif
                            </td>
                            
                            <!-- Operator -->
                            <td>{{ $row->operator_name }}</td>
                            
                            <!-- Kolom Action (Icon Only) -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-3">
                                    <!-- Tombol Kalibrasi (Icon Kunci Inggris/Tools) -->
                                    @if($row->status == 'NOT OK' && is_null($row->tindak_lanjut))
                                        <button type="button" class="action-icon text-primary" data-bs-toggle="modal" data-bs-target="#modalTindakLanjut{{ $row->id }}" title="Isi Kalibrasi">
                                            <i class="fas fa-tools"></i>
                                        </button>
                                    @endif

                                    <!-- Tombol Hapus (Icon Trash) -->
                                    @if(Auth::check() && in_array(Auth::user()->role, [0, 5]))
                                        <form action="{{ route('verifikasi-timbangan.destroy', $row->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon btn-delete-swal" style="color: #991b1b;" title="Hapus Data">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if(!($row->status == 'NOT OK' && is_null($row->tindak_lanjut)) && !(Auth::check() && in_array(Auth::user()->role, [0, 5])))
                                        -
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Tindak Lanjut -->
                        @if($row->status == 'NOT OK' && is_null($row->tindak_lanjut))
                        <div class="modal fade modal-tindak-lanjut" id="modalTindakLanjut{{ $row->id }}" tabindex="-1" aria-hidden="true" style="text-align: left;">
                            <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 400px;">
                                <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                    <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                                        <h6 class="modal-title fw-bold" style="color: #1e293b; font-size: 16px;">Tindak Lanjut Kalibrasi</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('verifikasi-timbangan.update', $row->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body px-4 py-3">
                                            <div class="alert mb-3" style="background-color: #fef2f2; border: 1px solid #f87171; color: #991b1b; padding: 10px 12px; border-radius: 6px; font-size: 13px;">
                                                Selisih: <strong>{{ $row->selisih > 0 ? '+'.$row->selisih : $row->selisih }} kg</strong>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Deskripsi Kalibrasi</label>
                                                <textarea name="tindak_lanjut" class="form-control input-deskripsi" rows="2" required style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;"></textarea>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Actual Setelah Kalibrasi</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" name="actual_setelah" class="form-control input-actual-setelah" required placeholder="0.00" style="font-size: 14px; border-radius: 6px 0 0 6px; padding: 10px 12px; border: 1px solid #cbd5e1; border-right: none;">
                                                    <span class="input-group-text bg-white text-muted" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; font-size: 13px; font-weight: 600;">kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 px-4 pb-4 pt-1">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 16px;">Batal</button>
                                            <button type="submit" class="btn btn-primary" style="background-color: #135b9f; border-color: #135b9f; font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 20px;">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">Belum ada data verifikasi timbangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Links -->
            @if($data->hasPages())
            <div class="px-4 py-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-center bg-white" style="border-radius: 0 0 8px 8px;">
                <div class="text-muted mb-3 mb-md-0" style="font-size: 13.5px;">
                    Menampilkan <strong>{{ $data->firstItem() ?? 0 }}</strong> sampai <strong>{{ $data->lastItem() ?? 0 }}</strong> dari <strong>{{ $data->total() }}</strong> data
                </div>
                <div class="pagination-clean">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true" style="text-align: left;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h6 class="modal-title fw-bold" style="color: #1e293b; font-size: 16px;">Input Data Verifikasi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('verifikasi-timbangan.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Tanggal Verifikasi</label>
                        <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}" style="font-size: 14px; border-radius: 6px; padding: 10px 12px; border: 1px solid #cbd5e1;">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Berat Label (Patokan)</label>
                        <div class="input-group">
                            <input type="number" class="form-control bg-light" value="9340" readonly style="font-size: 14px; border-radius: 6px 0 0 6px; padding: 10px 12px; cursor: not-allowed; border: 1px solid #cbd5e1; color: #64748b; font-weight: 600;">
                            <span class="input-group-text bg-light text-muted" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; border-left: none; font-size: 13px; font-weight: 600;">kg</span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Berat Actual (Timbangan)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="actual" class="form-control" required placeholder="0.00" style="font-size: 14px; border-radius: 6px 0 0 6px; padding: 10px 12px; border: 1px solid #cbd5e1; border-right: none;" autofocus>
                            <span class="input-group-text bg-white text-muted" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; font-size: 13px; font-weight: 600;">kg</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 pt-1">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 16px;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #135b9f; border-color: #135b9f; font-size: 13.5px; font-weight: 600; border-radius: 6px; padding: 8px 20px;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script SweetAlert untuk Hapus Data -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Jika menggunakan DataTables, uncomment script di bawah -->
<!-- 
<script>
    $(document).ready(function() {
        $('#tabelVerifikasi').DataTable();
    });
</script> 
-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Auto-focus input "actual" saat modal Tambah Data terbuka
        const modalTambah = document.getElementById('modalTambah');
        if (modalTambah) {
            modalTambah.addEventListener('shown.bs.modal', function () {
                const inputActual = modalTambah.querySelector('input[name="actual"]');
                if (inputActual) {
                    inputActual.focus();
                }
            });
        }
        
        // Auto-focus dan navigasi Enter untuk Modal Tindak Lanjut
        const modalsTindakLanjut = document.querySelectorAll('.modal-tindak-lanjut');
        modalsTindakLanjut.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                const inputDeskripsi = modal.querySelector('.input-deskripsi');
                if (inputDeskripsi) {
                    inputDeskripsi.focus();
                }
            });

            const inputDeskripsi = modal.querySelector('.input-deskripsi');
            const inputActualSetelah = modal.querySelector('.input-actual-setelah');

            if (inputDeskripsi && inputActualSetelah) {
                inputDeskripsi.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        inputActualSetelah.focus();
                    }
                });
            }
        });

        const deleteButtons = document.querySelectorAll('.btn-delete-swal');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');
                
                // Ambil tanggal dari baris yang diklik
                const row = this.closest('tr');
                const tanggal = row.querySelector('td:first-child').innerText.trim();

                Swal.fire({
                    width: '380px',
                    html: `
                        <div style="margin-bottom: 24px;">
                            <div style="background-color: #fef2f2; width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-trash-alt" style="color: #A22C29; font-size: 28px;"></i>
                            </div>
                        </div>
                        <h4 style="color: #1e293b; font-weight: 500; font-size: 20px; margin-bottom: 12px; letter-spacing: -0.5px;">Hapus Data Verifikasi?</h4>
                        <p style="color: #64748b; font-size: 14px; margin-bottom: 0;">Data untuk tanggal <strong>${tanggal}</strong> akan<br>dihapus permanen.</p>
                    `,
                    showCancelButton: true,
                    buttonsStyling: false,
                    reverseButtons: true, // Tombol Batal di kiri, Hapus di kanan
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'swal2-popup-custom',
                        confirmButton: 'swal2-confirm-custom',
                        cancelButton: 'swal2-cancel-custom'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
