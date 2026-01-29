@extends('stock.main')
@section('title')
     SO {{$key}}
@endsection
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1700
            })
        </script>
        @endif

        @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            })
        </script>
        @endif


    <!-- Page Title -->
    <div class="row mb-4 mt-4">
        <div class="col-12 text-center">
            <h3 class="m-0 fw-bold text-dark">UPDATE STOCK BAHAN BAKU </h3>
            @if($data->last())
            <small>last updated {{ $data->last()->created_at->format('d-m-Y H:i:s') }}</small>
            @else
            <small>no data found</small>
            @endif
        </div>
    </div>
    <!-- Action Buttons + Search -->
    <div class="row g-3 mb-3">

        <!-- New -->
        <div class="col-12 col-md-3">
            <button class="btn btn-primary w-100 rounded-pill py-2"
                    data-bs-toggle="modal"
                    data-bs-target="#scanModal">
                <i class="fa fa-edit me-2"></i> Update
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">

                    <div class="modal-header">
                        <h5 class="modal-title" id="scanModalLabel">
                            <i class="fa fa-upload me-2"></i> Update Data Barang
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('stock.excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">

                            <!-- Jenis Transaksi -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jenis Transaksi</label>
                                <select name="jenis_transaksi" class="form-select" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="masuk">Barang Masuk</option>
                                    <option value="keluar">Barang Keluar</option>
                                </select>
                            </div>

                            <!-- Upload File -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload File</label>
                                <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv,.pdf" required>
                                <small class="text-muted">
                                    Format: Excel / CSV
                                </small>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane me-1"></i> Proses
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

   <!-- BUTTON FILTER -->
<div class="mb-3">
    @foreach($kategori->pluck('jenis')->unique() as $jenis)
        <button class="btn btn-outline">{{ $jenis }}</button>
    @endforeach

</div>

<div class="card">
    <div class="card-header">
        Data Stock | Total <span class="text-danger">{{ $data->count() }}</span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th class="sortable">No</th>
                    <th class="sortable">Date</th>
                    <th class="sortable">KPC</th>
                    <th class="sortable">Barcode</th>
                    <th class="sortable">Nama Barang</th>
                    <th class="sortable">Berat</th>
                    <th class="sortable">Lokasi</th>
                    <th class="sortable">Storagebin Awal</th>
                    <th class="sortable">Storagebin Hasil</th>
                    <th class="col-scan sortable">Scanner</th>

                    <!-- Kolom yang harus hilang di mode Belum Scan -->
                    <th class="col-scan sortable">Berat SO</th>
                    <th class="col-scan sortable">Selisih SO</th>
                    <th class="col-scan sortable">Keterangan</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $d)
                <tr class="{{ $d->scanner ? 'row-sudah' : 'row-belum' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->date }}</td>
                    <td>{{ $d->kpc }}</td>
                    <td>{{ $d->barcode }}</td>
                    <td>{{ $d->namabarang }}</td>
                    <td>{{ $d->berat }}</td>
                    <td>{{ $d->lokasi }}</td>
                    <td>{{ $d->storagebin ?? '-' }}</td>
                    <td>{{ $d->storagebin_hasil ?? '-' }}</td>

                    <td class="col-scan">{{ $d->scanner ?? '-' }}</td>
                    <td class="col-scan">{{ $d->scanner ? $d->qty_scan : '-' }}</td>
                    <td class="col-scan">
                        {{ $d->scanner ? ($d->berat - $d->qty_scan) : '-' }}
                    </td>
                    <td class="col-scan">{!! nl2br(e($d->keterangan)) !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- JAVASCRIPT SWITCH MODE -->
<script>
// FUNGSI UNTUK MENGAKTIFKAN MODE BELUM
function aktifkanModeBelum() {
    // button style
    document.getElementById("btnBelum").classList.remove("btn-outline-danger");
    document.getElementById("btnBelum").classList.add("btn-danger");
    document.getElementById("btnSudah").classList.remove("btn-success");
    document.getElementById("btnSudah").classList.add("btn-outline-success");

    // hide scan columns
    document.querySelectorAll(".col-scan").forEach(col => col.style.display = "none");

    // show only rows not scanned
    document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "none");
    document.querySelectorAll(".row-belum").forEach(r => r.style.display = "table-row");
}

// klik manual
document.getElementById("btnBelum").addEventListener("click", aktifkanModeBelum);

// AUTO AKTIF SAAT PERTAMA KALI HALAMAN LOAD
window.addEventListener("load", aktifkanModeBelum);
</script>
<script>
document.getElementById("btnBelum").addEventListener("click", function () {
    // button style
    this.classList.remove("btn-outline-danger");
    this.classList.add("btn-danger");
    document.getElementById("btnSudah").classList.remove("btn-success");
    document.getElementById("btnSudah").classList.add("btn-outline-success");

    // hide scan columns
    document.querySelectorAll(".col-scan").forEach(col => col.style.display = "none");

    // show only rows not scanned
    document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "none");
    document.querySelectorAll(".row-belum").forEach(r => r.style.display = "table-row");
});

document.getElementById("btnSudah").addEventListener("click", function () {
    // button style
    this.classList.remove("btn-outline-success");
    this.classList.add("btn-success");
    document.getElementById("btnBelum").classList.remove("btn-danger");
    document.getElementById("btnBelum").classList.add("btn-outline-danger");

    // show scan columns
    document.querySelectorAll(".col-scan").forEach(col => col.style.display = "");

    // show only scanned rows
    document.querySelectorAll(".row-belum").forEach(r => r.style.display = "none");
    document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "table-row");
});
</script>


</div>

@if ($data)

    @foreach ($data as $d)

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded-4">

            <form method="POST" action="{{ route('pac.update', $d->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Edit Laporan {{ $d->id }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Date</label>
                    <input type="datetime-local" name="date" class="form-control rounded-pill"
                            value="{{ $d->date }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Attribute</label>
                    <input type="text" name="attribute" class="form-control rounded-pill"
                            value="{{ $d->attribute }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Group</label>
                    <select name="group" class="form-select rounded-pill">
                        <option value="A" {{ $d->group=='A'?'selected':'' }}>Group A</option>
                        <option value="B" {{ $d->group=='B'?'selected':'' }}>Group B</option>
                        <option value="Lokal" {{ $d->group=='Lokal'?'selected':'' }}>Group Lokal</option>
                    </select>
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Layout</label>
                    <input type="text" name="layout" class="form-control rounded-pill" value="{{ $d->layout }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">No SO</label>
                    <input type="text" name="no_so" class="form-control rounded-pill" value="{{ $d->no_so }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Kondisi</label>
                    <select name="kondisi" class="form-select rounded-pill">
                        <option value="Baik" {{ $d->kondisi=='Baik'?'selected':'' }}>Baik</option>
                        <option value="Damage Realese QA" {{ $d->kondisi=='Damage Realese QA'?'selected':'' }}>Damage Realese QA</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">PE & VCI</label>
                    <select name="plastik" class="form-select rounded-pill">
                        <option value="OK" {{ $d->plastik=='OK'?'selected':'' }}>OK</option>
                        <option value="Not OK" {{ $d->plastik=='Not OK'?'selected':'' }}>Not OK</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Wrapping</label>
                    <select name="wrapping" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->wrapping=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->wrapping=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Impraboard</label>
                    <select name="impraboard" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->impraboard=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->impraboard=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">ID & OD</label>
                    <select name="idod" class="form-select rounded-pill">
                        <option value="OK" {{ $d->idod=='OK'?'selected':'' }}>OK</option>
                        <option value="Not OK" {{ $d->idod=='Not OK'?'selected':'' }}>Not OK</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Pallet</label>
                    <select name="pallet" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->pallet=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->pallet=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Bandazer</label>
                    <select name="bandazer" class="form-select rounded-pill">
                        <option value="OK" {{ $d->bandazer=='OK'?'selected':'' }}>OK</option>
                        <option value="Not OK" {{ $d->bandazer=='Not OK'?'selected':'' }}>Not OK</option>
                    </select>
                    </div>

                </div>

                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
                </div>

            </form>

            </div>
        </div>
        </div>

    @endforeach

    @foreach ($data as $d)

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

            <form method="POST" action="{{ route('pac.delete', $d->id) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                <p class="fw-bold">Yakin ingin menghapus data ini?</p>
                <p class="text-muted">No SO: {{ $d->no_so }} | Attribute: {{ $d->attribute }}</p>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
                </div>

            </form>

            </div>
        </div>
        </div>
    @endforeach

@else
@endif


{{-- </div> --}}
@endsection
