@extends('fomcheck.main')
@section('title')
     FORM CHECK
@endsection
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .fomcheck-pagination nav {
        width: 100%;
        justify-content: center !important;
    }
    .fomcheck-pagination nav > div.d-none.flex-sm-fill {
        flex-direction: column;
        align-items: center;
        gap: .5rem;
    }
    .fomcheck-pagination nav p.small {
        display: none;
    }
    .fomcheck-pagination .pagination {
        margin-bottom: 0;
        justify-content: center;
    }
    #formModal, #deleteModal {
        z-index: 1060;
    }
    .modal-backdrop {
        z-index: 1055;
    }
</style>

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

@php
    $isAdmin = Auth::user()->role == 0;
    $queryBase = request()->only(['search', 'start', 'end', 'sort', 'direction']);
    $tabUrl = fn ($t) => route('fomcheck', array_merge($queryBase, ['type' => $t]));
    $typeLabels = ['crc' => 'CRC', 'ingot' => 'INGOT', 'resin' => 'RESIN/ALKALI'];
    $exportRoute = "fomcheck.{$type}.export";
    $printRoute = "fomcheck.{$type}.print";
    $modalAddUrls = [
        'crc' => route('fomcheck.crc.add', ['embed' => 1]),
        'ingot' => route('fomcheck.ingot.add', ['embed' => 1]),
        'resin' => route('fomcheck.resin.add', ['embed' => 1]),
    ];
@endphp

<div class="row mb-4 mt-4">
    <div class="col-12 text-center">
        <h3 class="m-0 fw-bold text-dark">FORM CHECK KEDATANGAN MATERIAL</h3>
    </div>
</div>

<div class="row g-3 mb-3 align-items-end">
    <div class="col-12 col-lg-auto d-flex flex-wrap gap-2">
        <button type="button"
                class="btn btn-primary btn-open-modal"
                data-bs-toggle="modal"
                data-bs-target="#formModal"
                data-url="{{ $modalAddUrls[$type] }}"
                data-title="Tambah {{ $typeLabels[$type] }}">
            <i class="bi bi-plus-circle me-1"></i> Tambah {{ $typeLabels[$type] }}
        </button>
        @if($isAdmin)
        <a href="{{ route($exportRoute) }}" class="btn btn-success">
            <i class="bi bi-download me-1"></i> Export Excel
        </a>
        @endif
    </div>

    <div class="col-12 col-lg">
        <form action="{{ route('fomcheck') }}" method="GET" class="row g-2 align-items-end">
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="sort" value="{{ $sort }}">
            <input type="hidden" name="direction" value="{{ $direction }}">
            <div class="col-md-3">
                <input type="date" name="start" value="{{ $start }}" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="date" name="end" value="{{ $end }}" class="form-control">
            </div>
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $searchTerm }}" class="form-control"
                       placeholder="Cari responden / no dokumen">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    @foreach($typeLabels as $key => $label)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $type === $key ? 'active fw-semibold' : '' }}"
                           href="{{ $tabUrl($key) }}">
                            {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-3">Data Kedatangan — {{ $typeLabels[$type] }}</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>No Dokumen</th>
                                @if($type === 'crc')
                                <th>Supplier</th>
                                @endif
                                <th>Responden</th>
                                <th>
                                    <a href="{{ route('fomcheck', array_merge($queryBase, [
                                        'type' => $type,
                                        'sort' => 'date',
                                        'direction' => request('direction') === 'asc' ? 'desc' : 'asc',
                                    ])) }}" class="text-decoration-none text-dark">
                                        Tanggal
                                        @if($sort === 'date')
                                        <i class="bi bi-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                @if($type === 'crc')
                                <th>Awal Muat</th>
                                <th>Akhir Muat</th>
                                @endif
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $d)
                            <tr>
                                <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                <td>{{ $d->shift_leader }}</td>
                                @if($type === 'crc')
                                <td>
                                    @php $suppliers = json_decode($d->supplier, true) ?? []; @endphp
                                    @if(count($suppliers))
                                    <ul class="mb-0 ps-3 small">
                                        @foreach($suppliers as $item)
                                        <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    —
                                    @endif
                                </td>
                                @endif
                                <td>{{ $users[$d->user_id] ?? '—' }}</td>
                                <td>{{ $d->date?->format('d-m-Y') ?? $d->created_at }}</td>
                                @if($type === 'crc')
                                <td>{{ $d->time ?? '—' }}</td>
                                <td>{{ $d->time_last ?? '—' }}</td>
                                @endif
                                <td class="text-center">
                                    <div class="d-inline-flex flex-wrap gap-1 justify-content-center">
                                        <button type="button"
                                                class="btn btn-sm btn-primary btn-open-modal"
                                                data-bs-toggle="modal"
                                                data-bs-target="#formModal"
                                                data-url="{{ route('fomcheck.'.$type.'.show', ['id' => $d->id, 'embed' => 1]) }}"
                                                data-title="Detail {{ $typeLabels[$type] }}">
                                            Detail
                                        </button>
                                        @if(Auth::user()->email == 'danuartha@tatametal.com')
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary btn-open-modal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#formModal"
                                                    data-url="{{ route('fomcheck.'.$type.'.edit', ['id' => $d->id, 'embed' => 1]) }}"
                                                    data-title="Edit {{ $typeLabels[$type] }}">
                                                Edit
                                            </button>
                                        @endif
                                        @if($isAdmin)
                                        <a href="{{ route($printRoute, $d->id) }}" class="btn btn-sm btn-success">Print</a>
                                        <button type="button"
                                                class="btn btn-sm btn-danger btn-delete-material"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-id="{{ $d->id }}"
                                                data-type="{{ $type }}">
                                            Hapus
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ $type === 'crc' ? 8 : 5 }}" class="text-center text-muted py-4">
                                    Belum ada data {{ $typeLabels[$type] }}.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($data->hasPages())
                <div class="mt-3 fomcheck-pagination">
                    {{ $data->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('modals')
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="formModalFrame" title="Form Check" style="width:100%;height:78vh;border:0;display:block;"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus data ini?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endpush

@push('scripts')
<script>
(function () {
    const formModal = document.getElementById('formModal');
    const formModalFrame = document.getElementById('formModalFrame');
    const formModalLabel = document.getElementById('formModalLabel');
    const deleteForm = document.getElementById('deleteForm');

    const destroyBase = {
        crc: @json(url('fomcheck/crc/destroy')),
        ingot: @json(url('fomcheck/ingot/destroy')),
        resin: @json(url('fomcheck/resin/destroy')),
    };

    function hideFormModal() {
        if (typeof bootstrap === 'undefined' || !formModal) return;
        const instance = bootstrap.Modal.getInstance(formModal);
        if (instance) instance.hide();
    }

    document.querySelectorAll('.btn-open-modal').forEach(function (button) {
        button.addEventListener('click', function () {
            if (formModalLabel) formModalLabel.textContent = this.dataset.title || 'Form';
            if (formModalFrame) formModalFrame.src = this.dataset.url || 'about:blank';
        });
    });

    if (formModal) {
        formModal.addEventListener('hidden.bs.modal', function () {
            if (formModalFrame) formModalFrame.src = 'about:blank';
        });
    }

    document.querySelectorAll('.btn-delete-material').forEach(function (button) {
        button.addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.action = destroyBase[this.dataset.type] + '/' + this.dataset.id;
            }
        });
    });

    window.addEventListener('message', function (event) {
        if (!event.data || !event.data.type) return;

        if (event.data.type === 'fomcheck-success') {
            hideFormModal();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: event.data.message || 'Data berhasil disimpan',
                showConfirmButton: false,
                timer: 1700
            }).then(function () {
                var params = new URLSearchParams(window.location.search);
                if (event.data.materialType) params.set('type', event.data.materialType);
                window.location.search = params.toString();
            });
        }

        if (event.data.type === 'fomcheck-close') {
            hideFormModal();
        }
    });
})();
</script>
@endpush
