@extends('Mapping-Container.layout.main')

@section('title')
    Edit Shipment
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Shipment</h1>

    <form action="{{ route('Mapping.admin.update-shipment', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- No GS -->
        <div class="mb-3">
            <label class="form-label"><b>No GS</b></label>
            <input type="text"
                   class="form-control"
                   name="no_gs"
                   value="{{ old('no_gs', $data->no_gs) }}"
                   readonly>
        </div>

        <!-- Tanggal GS -->
        <div class="mb-3">
            <label class="form-label"><b>Tanggal GS</b></label>
            <input type="date"
                   class="form-control"
                   name="tgl_gs"
                   value="{{ old('tgl_gs', $data->tgl_gs) }}"
                   required>
        </div>

        <!-- No Container -->
        <div class="mb-3">
            <label class="form-label"><b>No Container</b></label>
            <input type="text"
                   class="form-control"
                   name="no_container"
                   value="{{ old('no_container', $data->no_container) }}"
                   required>
        </div>

        <!-- No Mobil -->
        <div class="mb-3">
            <label class="form-label"><b>No Mobil</b></label>
            <input type="text"
                   class="form-control"
                   name="no_mobil"
                   value="{{ old('no_mobil', $data->no_mobil) }}"
                   required>
        </div>

        <!-- Tare -->
        <div class="mb-3">
            <label class="form-label"><b>Tare</b></label>
            <input type="text"
                   class="form-control"
                   name="tare"
                   value="{{ old('tare', $data->tare) }}"
                   required>
        </div>

        <!-- Customer -->
        <div class="mb-3">
            <label class="form-label"><b>Customer</b></label>
            <input type="text"
                   class="form-control"
                   name="kepada"
                   value="{{ old('kepada', $data->kepada) }}"
                   required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">
                Update
            </button>

            <a href="{{ route('Mapping.admin.shipment') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
