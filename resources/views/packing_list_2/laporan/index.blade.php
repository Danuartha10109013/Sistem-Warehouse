@extends('packing_list_2.layout.V_template')

@section('title', 'Riwayat & Laporan Harian - Packing List 2.0')

@push('css')
<style>
    .btn-export-excel {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #107c41 !important;
        color: #ffffff !important;
        border: 1px solid #0e6c38 !important;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 18px;
        box-shadow: 0 1px 2px rgba(16, 124, 65, 0.2);
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }
    .btn-export-excel:hover {
        background-color: #0b5e31 !important;
        border-color: #084926 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(16, 124, 65, 0.28);
        transform: translateY(-1px);
    }
    .btn-export-excel-table {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: #ffffff;
        color: #1e293b !important;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-weight: 600;
        font-size: 11.5px;
        padding: 5px 10px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-export-excel-table i {
        color: #107c41;
        font-size: 14px;
    }
    .btn-export-excel-table:hover {
        background-color: #f0fdf4;
        border-color: #86efac;
        color: #166534 !important;
        box-shadow: 0 2px 4px rgba(16, 124, 65, 0.12);
        transform: translateY(-1px);
    }
    .date-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        background-color: #ffffff;
        color: #475569;
        transition: all 0.15s ease;
    }
    .date-pill:hover {
        border-color: #135b9f;
        color: #135b9f;
        background-color: #f0f7ff;
    }
    .date-pill.active {
        background-color: #135b9f;
        border-color: #135b9f;
        color: #ffffff;
    }
    .date-pill.active .badge {
        background-color: #ffffff !important;
        color: #135b9f !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info & Date Filter -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                <div>
                    <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Riwayat & Laporan Batch Harian</h4>
                    <div class="text-muted" style="font-size: 13.5px;">
                        Home <span class="mx-1">/</span> Packing List 2.0 <span class="mx-1">/</span> Riwayat & Laporan Harian
                    </div>
                </div>

                <!-- Export Button -->
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('packing-list-2.laporan.export', ['tanggal' => $tanggal]) }}" class="btn-export-excel">
                        <i class="ti ti-file-spreadsheet fs-5"></i>
                        <span>Download Excel Laporan ({{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }})</span>
                    </a>
                </div>
            </div>

            <hr class="my-3 text-muted" style="opacity: 0.15;">

            <!-- Date Selector Form & Quick Date Shortcuts -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <form action="{{ route('packing-list-2.laporan') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
                    <label for="tanggalInput" class="fw-bold text-dark mb-0 me-1" style="font-size: 13px;">
                        <i class="ti ti-calendar me-1 text-primary"></i>Pilih Tanggal:
                    </label>
                    <input type="date" id="tanggalInput" name="tanggal" value="{{ $tanggal }}" class="form-control" style="width: 170px; font-size: 13px; border-color: #cbd5e1; border-radius: 8px;">
                    <button type="submit" class="btn btn-primary" style="font-weight: 600; font-size: 13px; border-radius: 8px; padding: 7px 15px;">
                        <i class="ti ti-search me-1"></i>Tampilkan
                    </button>
                    @if ($tanggal !== date('Y-m-d'))
                        <a href="{{ route('packing-list-2.laporan', ['tanggal' => date('Y-m-d')]) }}" class="btn btn-outline-secondary" style="font-size: 13px; border-radius: 8px; padding: 7px 14px;">
                            Hari Ini
                        </a>
                    @endif
                </form>

                <!-- Quick Date Pills -->
                @if ($availableDates->isNotEmpty())
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">Riwayat Tanggal:</span>
                        @foreach ($availableDates as $ad)
                            <a href="{{ route('packing-list-2.laporan', ['tanggal' => $ad->tgl]) }}" 
                               class="date-pill {{ $tanggal === $ad->tgl ? 'active' : '' }}">
                                <span>{{ \Carbon\Carbon::parse($ad->tgl)->format('d M') }}</span>
                                <span class="badge bg-light text-dark rounded-pill" style="font-size: 10px;">{{ $ad->jml_batch }} batch</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Table: Daftar Batch di Tanggal Terpilih -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Daftar Batch Tanggal {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</h5>
                    <span class="text-muted" style="font-size: 13px;">Menampilkan {{ $batches->count() }} batch yang dibuat pada tanggal ini</span>
                </div>
                <div>
                    <a href="{{ route('packing-list-2.laporan.export', ['tanggal' => $tanggal]) }}" class="btn-export-excel-table">
                        <i class="ti ti-file-spreadsheet"></i>
                        <span>Download Excel Hari Ini</span>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                    <thead class="table-light text-nowrap text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="text-center" style="width: 45px;">No</th>
                            <th>Kode Batch</th>
                            <th class="text-center">Rit</th>
                            <th>Jam Input</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-center">Total Koil</th>
                            <th style="min-width: 180px;">Status Validasi</th>
                            <th>Catatan</th>
                            <th class="text-center" style="width: 190px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $idx => $b)
                            @php
                                $bTotal = $b->items->count();
                                $bValid = $b->items->whereIn('status', ['VALID', 'TERVALIDASI'])->count();
                                $bPending = $b->items->where('status', 'MENUNGGU_VALIDASI')->count();
                                $bInvalid = $b->items->where('status', 'TIDAK_VALID')->count();
                                $pct = $bTotal > 0 ? round(($bValid / $bTotal) * 100) : 0;
                            @endphp
                            <tr>
                                <td class="text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                                <td>
                                    <a href="{{ route('packing-list-2.detail', $b->id) }}" class="fw-bold text-decoration-none text-primary">
                                        {{ $b->kode_batch }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($b->no_rit)
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1" style="font-size: 11px;">Rit {{ $b->no_rit }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    <i class="ti ti-clock me-1" style="font-size: 12px;"></i>
                                    {{ $b->created_at ? $b->created_at->format('H:i:s') : '-' }}
                                </td>
                                <td>{{ $b->user->name ?? 'User' }}</td>
                                <td class="text-center fw-bold text-dark">{{ $bTotal }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <div class="progress flex-grow-1" style="height: 6px; border-radius: 4px; background-color: #e2e8f0;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pct }}%;" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="fw-bold" style="font-size: 11px; color: #166534;">{{ $pct }}%</span>
                                    </div>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <span class="badge bg-success-subtle text-success px-1" style="font-size: 10px;">{{ $bValid }} Cocok</span>
                                        @if ($bPending > 0)
                                            <span class="badge bg-warning-subtle text-warning px-1" style="font-size: 10px;">{{ $bPending }} Menunggu</span>
                                        @endif
                                        @if ($bInvalid > 0)
                                            <span class="badge bg-danger-subtle text-danger px-1" style="font-size: 10px;">{{ $bInvalid }} Selisih</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-muted" style="max-width: 180px;">
                                    <span class="text-truncate d-inline-block w-100" title="{{ $b->catatan }}">{{ $b->catatan ?: '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('packing-list-2.detail', $b->id) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" style="border-radius: 6px; font-size: 11.5px; font-weight: 600; padding: 4px 10px;">
                                            <i class="ti ti-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('packing-list-2.batch.export-excel', $b->id) }}" class="btn-export-excel-table" title="Download Excel batch ini">
                                            <i class="ti ti-file-spreadsheet"></i> Excel
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="ti ti-folder-x fs-1 d-block mb-2 text-muted" style="opacity: 0.5;"></i>
                                    Tidak ada data batch pada tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}.
                                    <div class="mt-2">
                                        <a href="{{ route('packing-list-2.paste') }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus me-1"></i> Input Data Batch Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Collapsible Card: Konsolidasi Seluruh Item Koil Hari Ini -->
    @if ($summary['total_items'] > 0)
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center justify-content-between" style="border-radius: 16px 16px 0 0;">
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Konsolidasi Seluruh Item Koil Tanggal Ini</h5>
                    <span class="text-muted" style="font-size: 13px;">Rekapitulasi gabungan dari seluruh {{ $batches->count() }} batch (Total {{ $summary['total_items'] }} koil)</span>
                </div>
                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCoilItems" aria-expanded="false" aria-controls="collapseCoilItems">
                    <i class="ti ti-chevron-down me-1"></i> Buka / Tutup Tabel Koil
                </button>
            </div>
            <div class="collapse" id="collapseCoilItems">
                <div class="card-body p-4 pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0" style="font-size: 12px; width: 100%;">
                            <thead class="table-light text-nowrap text-uppercase" style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" style="width: 40px;">No</th>
                                    <th>Kode Batch</th>
                                    <th>Status</th>
                                    <th>Code Product</th>
                                    <th>Product Name</th>
                                    <th class="text-end" style="background-color: #dcfce7; color: #166534;">Quantity</th>
                                    <th>Unit</th>
                                    <th style="background-color: #dcfce7; color: #166534;">Attribute (No Coil)</th>
                                    <th>Storage Bin</th>
                                    <th>Production</th>
                                    <th>No. SO</th>
                                    <th class="text-end" style="background-color: #dcfce7; color: #166534;">Length</th>
                                    <th>Loc</th>
                                    <th>Validator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $rowNum = 1; @endphp
                                @foreach ($batches as $b)
                                    @foreach ($b->items as $it)
                                        <tr>
                                            <td class="text-center text-muted fw-bold">{{ $rowNum++ }}</td>
                                            <td class="fw-semibold text-primary">
                                                <a href="{{ route('packing-list-2.detail', $b->id) }}" class="text-decoration-none">
                                                    {{ $b->kode_batch }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($it->status === 'MENUNGGU_VALIDASI')
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 10px;">Menunggu</span>
                                                @elseif ($it->status === 'VALID' || $it->status === 'TERVALIDASI')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 10px;">Valid (3/3)</span>
                                                @elseif ($it->status === 'TIDAK_VALID')
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 10px;">Tidak Valid</span>
                                                @endif
                                            </td>
                                            <td class="fw-semibold text-dark">{{ $it->kode }}</td>
                                            <td class="text-dark">{{ $it->nama_produk }}</td>
                                            <td class="text-end fw-bold" style="background-color: #f0fdf4; color: #166534;">
                                                {{ fmod((float)$it->qty, 1) !== 0.0 ? number_format((float)$it->qty, 2, ',', '.') : number_format((float)$it->qty, 0, ',', '.') }}
                                            </td>
                                            <td class="text-muted">{{ $it->uom }}</td>
                                            <td class="fw-bold font-monospace" style="background-color: #f0fdf4; color: #166534;">
                                                {{ $it->no_coil }}
                                            </td>
                                            <td>{{ $it->storage_bin ?: '-' }}</td>
                                            <td class="text-muted">{{ $it->tanggal ? $it->tanggal->format('d/m/Y') : '-' }}</td>
                                            <td>{{ $it->pengirim ?: '-' }}</td>
                                            <td class="text-end fw-bold" style="background-color: #f0fdf4; color: #166534;">
                                                {{ fmod((float)$it->panjang, 1) !== 0.0 ? number_format((float)$it->panjang, 2, ',', '.') : number_format((float)$it->panjang, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $it->tujuan ?: '-' }}</td>
                                            <td style="font-size: 11px;">{{ $it->validator->name ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
