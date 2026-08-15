@extends('fomcheck.main')
@section('title')
    REPORT OPEN PACK
@endsection

@push('head')
    @livewireStyles
@endpush

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .report-open-pack-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        @media (max-width: 767.98px) {
            .header .hero-header {
                padding-left: 0.65rem !important;
                padding-right: 0.65rem !important;
            }
        }
    </style>

    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h4 class="mb-0 fw-bold" style="color: #03487c;"><i class="bi bi-box-seam me-2"></i> Report Open Pack</h4>
                        <p class="text-muted small mt-1">Isi form inspeksi Report Open Pack di bawah ini.</p>
                    </div>
                    <div class="card-body px-4 py-4">
                        @livewire('form-report-open-pack')
                    </div>
                </div>

                @if(isset($history) && count($history) > 0)
                <div class="card shadow-sm border-0 rounded-lg mt-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold" style="color: #03487c;"><i class="bi bi-clock-history me-2"></i> Riwayat Laporan</h5>
                    </div>
                    <div class="card-body px-4 py-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Attribute</th>
                                        <th>Surat Jalan</th>
                                        <th>Kondisi Awal</th>
                                        <th>Setelah Open Pack</th>
                                        <th>Tanggal Form</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history as $row)
                                    <tr>
                                        <td class="fw-bold">{{ $row->attribute }}</td>
                                        <td>{{ $row->nomor_surat_jalan }}</td>
                                        <td>
                                            @if($row->kondisi_awal == 'OK') <span class="badge bg-success">OK</span> @else <span class="badge bg-danger">NG</span> @endif
                                        </td>
                                        <td>
                                            @if($row->kondisi_setelah_open_pack == 'OK') <span class="badge bg-success">OK</span> @else <span class="badge bg-danger">NG</span> @endif
                                        </td>
                                        <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('report-open-pack.export', $row->id) }}" class="btn btn-sm btn-outline-danger" target="_blank"><i class="bi bi-file-pdf"></i> PDF</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
