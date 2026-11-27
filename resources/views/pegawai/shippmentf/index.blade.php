@extends('layout.pegawai.main')
@section('title')
    @if (Auth::user()->role == 0)
        Shipment F || Admin
    @else
        Shipment F || Pegawai
    @endif
@endsection

@section('content')
@php($routePrefix = Auth::user()->role == 0 ? 'Ship-Mark.admin.' : 'Ship-Mark.pegawai.')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">@foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>@endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="save d-flex justify-content-between align-items-center mb-3">
                <a class="btn btn-primary" href="{{ route($routePrefix . 'shipment-f-add') }}">Tambah Data</a>

                <form action="{{ route($routePrefix . 'shipment-f-import') }}" method="POST"
                    enctype="multipart/form-data" class="d-flex align-items-center">
                    @csrf
                    <label class="sr-only" for="shipment-f-file">Impor Excel Shipment F</label>
                    <input id="shipment-f-file" type="file" name="file" accept=".xlsx,.xls" required>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>

            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Shippment F</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="mb-0">All data of Shipment type F
                            <a href="{{ route($routePrefix . 'shipment-f-template') }}">Download Template</a>
                        </p>
                        <form class="form-inline" method="GET" action="{{ route($routePrefix . 'shipment-f') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ $search }}"
                                    placeholder="Search by no SO">
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
                                @forelse ($groups as $group)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $group->no_so }}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route($routePrefix . 'shipment-f-show', $group->id) }}">
                                                <i class="ri-eye-line"></i>Show
                                            </a>
                                            <form action="{{ route($routePrefix . 'shipment-f-delete-so', $group->no_so) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirmDeleteSo(event, this, '{{ $group->no_so }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="ri-delete-bin-line"></i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data Tidak Ada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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