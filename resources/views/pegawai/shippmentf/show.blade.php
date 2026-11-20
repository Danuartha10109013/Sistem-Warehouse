@extends('layout.pegawai.main')
@section('title', 'Shipment F')

@section('content')
    @php($routePrefix = Auth::user()->role == 0 ? 'Ship-Mark.admin.' : 'Ship-Mark.pegawai.')
    <div class="container-fluid">
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <div class="iq-card"><div class="iq-card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Shipment F: {{ $shipment->no_so }}</h4>
                <a class="btn btn-primary" href="{{ route($routePrefix . 'shipment-f-add') }}">Tambah Data</a>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="btn btn-success" href="{{ route($routePrefix . 'shipment-f-print', $shipment->id) }}">Cetak Semua</a>
                <form class="form-inline" method="GET" action="{{ route($routePrefix . 'shipment-f-show', $shipment->id) }}">
                    <input class="form-control mr-2" type="search" name="search" value="{{ $search }}" placeholder="Cari Unicode">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
            <div class="table-responsive"><table class="table">
                <thead><tr><th>#</th><th>No SO</th><th>Unicode</th><th>POD</th><th>Attribute</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td><td>{{ $item->no_so }}</td><td>{{ $item->reference }}</td><td>{{ $item->destination }}</td><td>{{ $item->attribute }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route($routePrefix . 'shipment-f-printone', $item->id) }}">Cetak</a>
                                <a class="btn btn-warning" href="{{ route($routePrefix . 'shipment-f-edit', $item->id) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route($routePrefix . 'shipment-f-delete', $item->id) }}" onsubmit="return confirm('Hapus data Shipment F ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Data Tidak Ada</td></tr>
                    @endforelse
                </tbody>
            </table></div>
        </div></div>
    </div>
@endsection
