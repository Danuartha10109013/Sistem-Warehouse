@extends('layout.pegawai.main')

@section('title')
    Cari Atribute | Ship-Mark
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between align-items-center">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">
                            <i class="ri-search-eye-line mr-1"></i> Pencarian Global Atribute (Shipment A – F)
                        </h4>
                    </div>
                </div>

                <div class="iq-card-body">
                    {{-- Form Pencarian --}}
                    @php
                        $searchRoute = Auth::user()->role == 0
                            ? route('Ship-Mark.admin.search-atribute')
                            : route('Ship-Mark.pegawai.search-atribute');
                    @endphp
                    <form method="GET" action="{{ $searchRoute }}" class="mb-4">
                        <div class="input-group input-group-lg">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   value="{{ $search }}"
                                   placeholder="Masukkan nomor / kode atribute..."
                                   autofocus>
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4" type="submit">
                                    <i class="ri-search-line mr-1"></i> Cari
                                </button>
                                @if ($search !== '')
                                    <a href="{{ $searchRoute }}" class="btn btn-outline-secondary px-3">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    {{-- Ringkasan Hasil --}}
                    @if ($search !== '')
                        <div class="alert {{ $results->isEmpty() ? 'alert-warning' : 'alert-info' }} d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                @if ($results->isEmpty())
                                    <strong>Tidak ditemukan</strong> data dengan atribute <code>{{ $search }}</code> di Shipment A – F.
                                @else
                                    <strong>Ditemukan {{ $results->count() }} data</strong> untuk <code>{{ $search }}</code>:
                                    @foreach ($summary as $shipName => $count)
                                        <span class="badge bg-light text-dark border ms-1">{{ $shipName }} ({{ $count }})</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Tabel Hasil --}}
                        @if ($results->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Lokasi Shipment</th>
                                            <th>Atribute</th>
                                            <th>No SO</th>
                                            <th>Detail</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="badge {{ $row['badge_class'] }} px-2 py-1">
                                                        {{ $row['shipment'] }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold">{{ $row['atribute'] }}</td>
                                                <td>{{ $row['no_so'] }}</td>
                                                <td class="text-muted small">{{ $row['detail'] ?: '-' }}</td>
                                                <td class="text-center text-nowrap">
                                                    <a href="{{ $row['print_url'] }}" class="btn btn-primary btn-sm" title="Print">
                                                        <i class="ri-printer-line"></i>
                                                    </a>
                                                    <a href="{{ $row['edit_url'] }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="ri-edit-2-line"></i>
                                                    </a>
                                                    @if ($row['delete_method'] === 'DELETE')
                                                        <form action="{{ $row['delete_url'] }}" method="POST" class="d-inline" onsubmit="return confirmDeleteForm(event, this, '{{ $row['atribute'] }}')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ $row['delete_url'] }}" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirmDeleteLink(event, this.href, '{{ $row['atribute'] }}')">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="ri-search-2-line" style="font-size: 3rem; opacity: 0.4;"></i>
                            <p class="mt-2 mb-0">Ketik kode atribute di atas untuk mencari di seluruh Shipment A sampai F.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDeleteForm(e, form, atribute) {
    e.preventDefault();
    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data atribute ' + atribute + ' akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    return false;
}

function confirmDeleteLink(e, url, atribute) {
    e.preventDefault();
    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data atribute ' + atribute + ' akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}
</script>
@endsection
