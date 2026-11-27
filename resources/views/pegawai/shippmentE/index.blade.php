@extends('layout.pegawai.main')
@section('title')
    @if (Auth::user()->role == 0)
        Shippment E || Admin
    @else
        Shippment E || Pegawai
    @endif
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="save d-flex justify-content-between align-items-center mb-3">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Tombol Tambah Data di sebelah kiri -->
                    @if (Auth::user()->role == 0)
                        <a class="btn btn-primary" href="{{route('Ship-Mark.admin.shipment-e-add')}}">Tambah Data</a>
                    @else
                        <a class="btn btn-primary" href="{{route('Ship-Mark.pegawai.shipment-e-add')}}">Tambah Data</a>
                    @endif

                    <!-- Form Upload File Excel di sebelah kanan -->
                    @if (Auth::user()->role == 0)
                        <form action="{{ route('Ship-Mark.admin.add-shippmente-excel') }}" method="post"
                            enctype="multipart/form-data" class="d-flex align-items-center">
                    @else
                            <form action="{{ route('Ship-Mark.pegawai.add-shippmente-excel') }}" method="post"
                                enctype="multipart/form-data" class="d-flex align-items-center">
                        @endif
                            @csrf
                            <input type="file" name="shipmentb" accept=".xlsx,.xls,.csv" required>
                            <select style="margin-left: -60px;margin-right: 10px" name="satuan_berat" id="">
                                <option value="KGS">KGS</option>
                                <option value="LBS">LBS</option>
                                <option value="MT">MT</option>
                            </select>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>



                </div>


                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Shippment E</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="mb-0">All data of Shipment type E
                                <a href="{{ route('download.file', ['file' => 'ShippmentE.xlsx']) }}">
                                    Download Template
                                </a>
                            </p>
                        @if (Auth::user()->role == 0)
                            <form class="form-inline" method="GET" action="{{ route('Ship-Mark.admin.shipment-e') }}">
                        @else
                            <form class="form-inline" method="GET" action="{{ route('Ship-Mark.pegawai.shipment-e') }}">
                        @endif
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" value="{{ $search ?? '' }}" placeholder="Search by no SO">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No SO</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($data) || $data->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">Data Tidak Ada</td>
                                </tr>
                            @else
                                @foreach ($data as $d)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{$d->no_so}}</td>
                                        <td>
                                            @if (Auth::user()->role == 0)
                                                <a class="btn btn-primary"
                                                    href="{{route('Ship-Mark.admin.shipment-e-show', $d->no_so)}}">
                                                    <i class="ri-eye-line"></i>Show
                                                </a>
                                                <form action="{{ route('Ship-Mark.admin.shipment-e-delete-so', $d->no_so) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirmDeleteSo(event, this, '{{ $d->no_so }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="ri-delete-bin-line"></i>Delete</button>
                                                </form>
                                            @else
                                                <a class="btn btn-primary"
                                                    href="{{route('Ship-Mark.pegawai.shipment-e-show', $d->no_so)}}">
                                                    <i class="ri-eye-line"></i>Show
                                                </a>
                                                <form action="{{ route('Ship-Mark.pegawai.shipment-e-delete-so', $d->no_so) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirmDeleteSo(event, this, '{{ $d->no_so }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="ri-delete-bin-line"></i>Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        
                        </table>
                    </div>
                 </div>
                 
              </div>
              
           </div>
        </div>

    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteSo(e, form, noSo) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus NO SO?',
                text: 'Semua data pada NO SO ' + noSo + ' akan dihapus permanen.',
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
    </script>
@endsection