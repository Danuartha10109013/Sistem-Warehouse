@extends('verifikasi_stiker.layout.V_template')

@section('title', 'Kontak Notifikasi WhatsApp')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">
                    <i class="fab fa-whatsapp me-2" style="color: #25D366;"></i> Kontak Notifikasi WhatsApp
                </h4>
                <div class="text-muted" style="font-size: 14px;">
                    Home <span class="mx-1">/</span> Verifikasi Stiker <span class="mx-1">/</span> Notifikasi WA
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-primary fw-semibold d-inline-flex align-items-center gap-2 shadow-sm"
                        style="background-color: #135b9f; border-color: #135b9f; border-radius: 8px;"
                        data-bs-toggle="modal" data-bs-target="#modalTambahKontak">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Nomor Penerima</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Status Gateway Fonnte & Limit Kuota Real-time -->
    @php
        $isConnected = ($fonnteDevice['device_status'] ?? '') === 'connect';
        $quotaRemaining = $fonnteDevice['quota'] ?? 0;
        $messagesSent = $fonnteDevice['messages'] ?? 0;
        $deviceName = $fonnteDevice['name'] ?? 'Device WH';
        $deviceNumber = $fonnteDevice['device'] ?? '-';
        $package = $fonnteDevice['package'] ?? 'Free';
        $expired = $fonnteDevice['expired'] ?? '-';
    @endphp

    <div class="row g-3 mb-4">
        <!-- Kartu 1: Status Koneksi WhatsApp Fonnte -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold">Status Fonnte</span>
                        @if($isConnected)
                            <span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 700;">
                                <i class="fas fa-check-circle me-1"></i> CONNECT
                            </span>
                        @else
                            <span class="badge" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 11px; font-weight: 700;">
                                <i class="fas fa-times-circle me-1"></i> DISCONNECT
                            </span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="fab fa-whatsapp fs-3 text-success"></i>
                        <div>
                            <div class="fw-bold text-dark font-monospace" style="font-size: 15px;">{{ $deviceNumber !== '-' ? '+'.$deviceNumber : 'Tidak Ada Nomor' }}</div>
                            <small class="text-muted" style="font-size: 11px;">Device: <strong>{{ $deviceName }}</strong> ({{ $package }})</small>
                        </div>
                    </div>
                    @if(!$isConnected)
                        <div class="alert alert-danger p-1 mt-2 mb-0 small text-center" style="font-size: 10px; border-radius: 6px;">
                            <i class="fas fa-exclamation-triangle me-1"></i> Perlu scan QR di dashboard Fonnte
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kartu 2: Sisa Limit Kuota Pesan -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="text-muted small fw-semibold">Sisa Limit Kuota</span>
                        <span class="badge bg-light text-primary border" style="font-size: 10px;">Berkurang per kirim</span>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <span class="fw-bolder font-monospace text-primary" style="font-size: 26px;">{{ number_format($quotaRemaining, 0, ',', '.') }}</span>
                        <span class="text-muted small">Pesan</span>
                    </div>
                    <div class="text-muted" style="font-size: 11px;">
                        <i class="fas fa-calendar-alt me-1 text-secondary"></i> Berlaku s/d: <strong>{{ $expired }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 3: Pesan Terkirim -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="text-muted small fw-semibold">Total Pesan Terkirim</span>
                        <i class="fas fa-paper-plane text-info"></i>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <span class="fw-bolder font-monospace text-dark" style="font-size: 26px;">{{ number_format($messagesSent, 0, ',', '.') }}</span>
                        <span class="text-muted small">Terkirim</span>
                    </div>
                    <div class="text-muted" style="font-size: 11px;">
                        <i class="fas fa-info-circle me-1 text-secondary"></i> Kuota terpakai dari Fonnte
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 4: Kontak Aktif & Aksi Cepat Uji Coba -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted small fw-semibold">Penerima Siaga</span>
                            <span class="badge bg-success text-white" style="font-size: 10px;">{{ $contacts->where('is_active', true)->count() }} Aktif</span>
                        </div>
                        <div class="text-muted" style="font-size: 11px; line-height: 1.4;">
                            Menerima alert otomatis jika verifikasi <strong>Tidak Sesuai</strong>.
                        </div>
                    </div>
                    <form action="{{ route('verifikasi-stiker.notif-wa.test') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center gap-1 shadow-sm"
                                style="border-radius: 6px; font-size: 11px;"
                                {{ (!$isConnected || $contacts->where('is_active', true)->isEmpty()) ? 'disabled' : '' }}>
                            <i class="fab fa-whatsapp"></i>
                            <span>Tes Kirim Semua Kontak</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Kontak -->
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom p-3 p-md-4 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #1e293b; font-size: 16px;">
                <i class="fas fa-address-book me-2 text-primary"></i> Daftar Nomor Penerima Notifikasi
            </h5>
            <span class="badge bg-light text-primary border fw-bold px-3 py-2">
                {{ $contacts->where('is_active', true)->count() }} Aktif / {{ $contacts->count() }} Total
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="ps-4" style="width: 60px;">No</th>
                            <th>Nama Penerima</th>
                            <th>Jabatan / Bagian</th>
                            <th>Nomor WhatsApp</th>
                            <th class="text-center" style="width: 140px;">Status</th>
                            <th class="text-center pe-4" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $index => $contact)
                            <tr>
                                <td class="ps-4 text-muted fw-semibold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $contact->nama }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted border">
                                        {{ $contact->jabatan ?: 'Staff / QC' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fab fa-whatsapp text-success fs-5"></i>
                                        <span class="font-monospace fw-semibold text-dark">{{ $contact->nomor_wa }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('verifikasi-stiker.notif-wa.toggle', $contact->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $contact->is_active ? 'btn-success' : 'btn-outline-secondary' }} px-3 py-1"
                                                style="border-radius: 20px; font-size: 11px; font-weight: 700;"
                                                title="Klik untuk ubah status aktif">
                                            @if($contact->is_active)
                                                <i class="fas fa-check me-1"></i> Aktif
                                            @else
                                                <i class="fas fa-pause me-1"></i> Nonaktif
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <!-- Edit Modal Trigger -->
                                        <button type="button" class="btn btn-sm btn-light border text-primary"
                                                style="border-radius: 6px; padding: 4px 8px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditKontak{{ $contact->id }}"
                                                title="Edit Kontak">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <!-- Test Single Number -->
                                        <form action="{{ route('verifikasi-stiker.notif-wa.test') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="target" value="{{ $contact->nomor_wa }}">
                                            <button type="submit" class="btn btn-sm btn-light border text-success"
                                                    style="border-radius: 6px; padding: 4px 8px;"
                                                    title="Tes Kirim ke Nomor Ini">
                                                <i class="fab fa-whatsapp"></i>
                                            </button>
                                        </form>

                                        <!-- Delete Button with Confirm -->
                                        <button type="button" class="btn btn-sm btn-light border text-danger btn-delete-contact"
                                                style="border-radius: 6px; padding: 4px 8px;"
                                                data-id="{{ $contact->id }}"
                                                data-nama="{{ $contact->nama }}"
                                                title="Hapus Kontak">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="form-delete-{{ $contact->id }}" action="{{ route('verifikasi-stiker.notif-wa.destroy', $contact->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>

                                    <!-- Modal Edit Kontak -->
                                    <div class="modal fade" id="modalEditKontak{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="border-radius: 12px;">
                                                <form action="{{ route('verifikasi-stiker.notif-wa.update', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header border-bottom p-4">
                                                        <h5 class="modal-title fw-bold text-dark">
                                                            <i class="fas fa-edit me-2 text-primary"></i> Edit Kontak WhatsApp
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4 text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-dark">Nama Lengkap</label>
                                                            <input type="text" name="nama" class="form-control" value="{{ $contact->nama }}" required style="border-radius: 8px;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-dark">Nomor WhatsApp</label>
                                                            <input type="text" name="nomor_wa" class="form-control font-monospace" value="{{ $contact->nomor_wa }}" required style="border-radius: 8px;">
                                                            <small class="text-muted">Gunakan format 0812... atau 62812...</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-dark">Jabatan / Bagian</label>
                                                            <input type="text" name="jabatan" class="form-control" value="{{ $contact->jabatan }}" placeholder="Contoh: Supervisor QC / Kepala Regu" style="border-radius: 8px;">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-top p-3">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                                        <button type="submit" class="btn btn-primary fw-semibold" style="background-color: #135b9f; border-color: #135b9f; border-radius: 8px;">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fab fa-whatsapp mb-3" style="font-size: 3rem; color: #cbd5e1;"></i>
                                        <h6 class="fw-bold text-secondary mb-1">Belum Ada Nomor WhatsApp Penerima</h6>
                                        <p class="small mb-3">Tambahkan 3 - 5 nomor kontak pengawas untuk menerima notifikasi saat stiker tidak sesuai.</p>
                                        <button type="button" class="btn btn-sm btn-primary fw-semibold" 
                                                style="background-color: #135b9f; border-color: #135b9f; border-radius: 6px;"
                                                data-bs-toggle="modal" data-bs-target="#modalTambahKontak">
                                            <i class="fas fa-plus me-1"></i> Tambah Nomor Sekarang
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kontak Baru -->
<div class="modal fade" id="modalTambahKontak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <form action="{{ route('verifikasi-stiker.notif-wa.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="fab fa-whatsapp me-2" style="color: #25D366;"></i> Tambah Kontak WhatsApp
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Bpk. Ahmad" required style="border-radius: 8px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Nomor WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_wa" class="form-control font-monospace" placeholder="Contoh: 081234567890" required style="border-radius: 8px;">
                        <small class="text-muted">Bisa diawali 08... atau 628...</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Jabatan / Bagian</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Supervisor QC / Manager WH" style="border-radius: 8px;">
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-primary fw-semibold" style="background-color: #135b9f; border-color: #135b9f; border-radius: 8px;">Simpan Nomor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tombol Hapus dengan konfirmasi SweetAlert2 (sesuai standar project)
    const deleteButtons = document.querySelectorAll('.btn-delete-contact');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');

            if (typeof window.showCustomConfirm === 'function') {
                window.showCustomConfirm({
                    iconClass: 'fas fa-trash-alt',
                    title: 'Hapus Kontak?',
                    text: 'Nomor WhatsApp untuk ' + nama + ' akan dihapus dan tidak menerima notifikasi lagi.',
                    confirmText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-delete-' + id).submit();
                    }
                });
            } else {
                if (confirm('Hapus kontak WhatsApp ' + nama + '?')) {
                    document.getElementById('form-delete-' + id).submit();
                }
            }
        });
    });
});
</script>
@endpush

