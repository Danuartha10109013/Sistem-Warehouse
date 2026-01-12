@extends('Form-Check.layout.main')

@section('title', 'Detail Submission Material RESIN')

@section('content')
<style>
    /* Fixed background STOP SUAP yang selalu terlihat saat scroll - Di atas item-item form */
    .stop-suap-background {
        position: fixed;
        top: 0%;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset("STOP SUAP.png") }}');
        background-size: 30% auto;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        z-index: 9999;
        pointer-events: none;
        opacity: 0.25;
    }
    
    /* Wrapper untuk memastikan konten ada di atas background */
    .content-wrapper {
        position: relative;
        z-index: 10;
        background-color: transparent;
    }
    
    /* Membuat background card transparan agar gambar STOP SUAP terlihat */
    .stretch-card .card {
        background-color: rgba(255, 255, 255, 0.5) !important;
        backdrop-filter: blur(2px);
    }
    
    .card-body {
        background-color: transparent !important;
    }
    
    .page-header {
        background-color: transparent !important;
    }
    
    /* Pastikan card dan elemen form tetap terlihat */
    .card, .page-header, .breadcrumb {
        position: relative;
        z-index: 9999;
    }
    
    /* Responsive untuk tablet */
    @media (max-width: 768px) {
        .stop-suap-background {
            background-size: 60% auto;
            opacity: 0.2;
        }
        .stretch-card .card {
            background-color: rgba(255, 255, 255, 0.4) !important;
        }
    }
    
    /* Responsive untuk mobile */
    @media (max-width: 576px) {
        .stop-suap-background {
            background-size: 80% auto;
            opacity: 0.18;
        }
        .stretch-card .card {
            background-color: rgba(255, 255, 255, 0.75) !important;
        }
    }
    
    /* Untuk layar sangat kecil (mobile portrait) */
    @media (max-width: 480px) {
        .stop-suap-background {
            background-size: 90% auto;
            opacity: 0.15;
        }
        .stretch-card .card {
            background-color: rgba(255, 255, 255, 0.7) !important;
        }
    }
</style>

<!-- Fixed Background STOP SUAP -->
<div class="stop-suap-background" aria-label="Stop Suap - Hargai Petugas Kami"></div>

<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Detail Submission Material RESIN
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Form Submission Material RESIN</h4>
                    <p class="card-description">Detail dari submission material RESIN yang telah diinput sebelumnya.</p>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>PENERIMA</label>
                            @php
                                $user = \App\Models\User::find($submission->user_id);
                            @endphp
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>NOMOR DOKUMEN</label>
                            <input type="text" class="form-control" value="{{ $submission->shift_leader }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>TANGGAL SURAT JALAN</label>
                            <input type="text" class="form-control" value="{{ $submission->date }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jam Checklist</label>
                            <input type="text" class="form-control" value="{{ $submission->time ? \Carbon\Carbon::parse($submission->time)->format('H:i:s') : '-' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Radiasi</label>
                            <input type="text" class="form-control" value="{{ $submission->radiasi ?? '-' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Radiasi</label>
                            <input type="text" class="form-control" value="{{ $submission->ket_radiasi ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>PENGIRIM/SUPPLIER</label>
                            <ul>
                                @php
                                $supplier = $submission->supplier;
                                if (is_string($supplier)) {
                                    $supp = json_decode($supplier, true);
                                    if (!$supp) {
                                        $supp = explode('|', str_replace(['"', '[', ']'], '', $supplier));
                                        $supp = array_filter(array_map('trim', $supp));
                                    }
                                } else {
                                    $supp = is_array($supplier) ? $supplier : [];
                                }
                                @endphp
                                @if(!empty($supp))
                                    @foreach($supp as $s)
                                        @if($s)
                                            <li>{{ $s }}</li>
                                        @endif
                                    @endforeach
                                @else
                                    <li>-</li>
                                @endif
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>JENIS</label>
                            <input type="text" class="form-control" value="{{ $submission->jenis ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Cuaca</label>
                            <input type="text" class="form-control" value="{{ $submission->cuaca ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tujuan Surat Jalan</label>
                            <input type="text" class="form-control" value="{{ $submission->jalan ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan ?? '-' }}" readonly>
                        </div>

                        <hr>

                        @php
                            $resin_images = \App\Models\Resin_ImageM::where('resin_id', $submission->id)->first();
                        @endphp

                        <div class="form-group">
                            <label><strong>FOTO</strong></label>
                            <div class="row">
                                @if($resin_images && $resin_images->foto)
                                    @php
                                        $fotos = json_decode($resin_images->foto, true);
                                    @endphp
                                    @if($fotos && is_array($fotos))
                                        @foreach($fotos as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/resin/'.$fotoItem) }}" class="img-fluid" alt="Foto">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>-</p>
                                    @endif
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label><strong>Barang Sesuai Surat Jalan</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->sesuai ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan1 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($resin_images && $resin_images->foto1)
                                    @php
                                        $fotos1 = json_decode($resin_images->foto1, true);
                                    @endphp
                                    @if($fotos1 && is_array($fotos1))
                                        @foreach($fotos1 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/resin/'.$fotoItem) }}" class="img-fluid" alt="Foto Barang Sesuai">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>-</p>
                                    @endif
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label><strong>Kering / Basah</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->kering ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan3 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($resin_images && $resin_images->foto3)
                                    @php
                                        $fotos3 = json_decode($resin_images->foto3, true);
                                    @endphp
                                    @if($fotos3 && is_array($fotos3))
                                        @foreach($fotos3 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/resin/'.$fotoItem) }}" class="img-fluid" alt="Foto Kering/Basah">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>-</p>
                                    @endif
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label><strong>Jumlah Sesuai Surat Jalan</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->jumlahin ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan5 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($resin_images && $resin_images->foto5)
                                    @php
                                        $fotos5 = json_decode($resin_images->foto5, true);
                                    @endphp
                                    @if($fotos5 && is_array($fotos5))
                                        @foreach($fotos5 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/resin/'.$fotoItem) }}" class="img-fluid" alt="Foto Jumlah">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>-</p>
                                    @endif
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label><strong>Drum Tidak Penyok/Bocor (Resin-Alkali)</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->drum ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan6 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($resin_images && $resin_images->foto6)
                                    @php
                                        $fotos6 = json_decode($resin_images->foto6, true);
                                    @endphp
                                    @if($fotos6 && is_array($fotos6))
                                        @foreach($fotos6 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/resin/'.$fotoItem) }}" class="img-fluid" alt="Foto Drum">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>-</p>
                                    @endif
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
