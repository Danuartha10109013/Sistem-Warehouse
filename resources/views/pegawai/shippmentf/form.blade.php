@extends('layout.pegawai.main')
@section('title', 'Shipment F')

@section('content')
    @php($routePrefix = Auth::user()->role == 0 ? 'Ship-Mark.admin.' : 'Ship-Mark.pegawai.')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $shipment->exists ? 'Edit' : 'Tambah' }} Shipment F</h1>
        <div class="card shadow p-4">
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ $shipment->exists ? route($routePrefix . 'shipment-f-update', $shipment->id) : route($routePrefix . 'shipment-f-store') }}">
                @csrf
                @if ($shipment->exists) @method('PUT') @endif
                <div class="mb-3">
                    <label for="no_so">No SO</label>
                    <input class="form-control" id="no_so" name="no_so" maxlength="100" value="{{ old('no_so', $shipment->no_so) }}" required>
                </div>
                <div class="mb-3">
                    <label for="reference">Unicode</label>
                    <input class="form-control" id="reference" name="reference" maxlength="100" value="{{ old('reference', $shipment->reference) }}" placeholder="23353 / V26-2407" required>
                </div>
                <div class="mb-3">
                    <label for="destination">POD</label>
                    <input class="form-control" id="destination" name="destination" maxlength="100" value="{{ old('destination', $shipment->destination) }}" placeholder="VANCOUVER BC, CANADA" required>
                </div>
                <div class="mb-3">
                    <label for="attribute">Attribute</label>
                    <input class="form-control" id="attribute" name="attribute" maxlength="100" value="{{ old('attribute', $shipment->attribute) }}" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection
