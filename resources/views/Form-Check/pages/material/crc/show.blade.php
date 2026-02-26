@extends('Form-Check.layout.main')
@section('title', 'Detail Submission Material CRC')
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
                </span> Detail Submission Material CRC
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
                    <h4 class="card-title">Detail Form Daily Checklist Kedatangan Material FM.WH.02.01</h4>
                    <p class="card-description">Detail dari submission material CRC yang telah diinput sebelumnya.</p>

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
                            <input type="text" class="form-control" value="{{ $submission->created_at->format('H:i:s') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Radiasi</label>
                            <input type="text" class="form-control" value="{{ $submission->radiasi }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Radiasi</label>
                            <input type="text" class="form-control" value="{{ $submission->ket_radiasi ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Awal Bongkar</label>
                            <input type="text" class="form-control" value="{{ $submission->time ? \Carbon\Carbon::parse($submission->time)->format('H:i:s') : '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Akhir Bongkar</label>
                            <input type="text" class="form-control" value="{{ $submission->time_last ? \Carbon\Carbon::parse($submission->time_last)->format('H:i:s') : '-' }}" readonly>
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
                            <label>Jumlah</label>
                            <input type="text" class="form-control" value="{{ $submission->ket_awal ?? '-' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Metode Unloading</label>
                            <input type="text" class="form-control" value="{{ $submission->metode_unloading ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Cuaca</label>
                            <input type="text" class="form-control" value="{{ $submission->cuaca ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan ?? '-' }}" readonly>
                        </div>

                        <hr>

                        @php
                            $crc_images = \App\Models\Crc_imageM::where('crc_id', $submission->id)->first();
                        @endphp

                        <div class="form-group">
                            <label><strong>FOTO</strong></label>
                            <div class="row">
                                @if($crc_images && $crc_images->foto)
                                    @php
                                        $fotos = json_decode($crc_images->foto, true);
                                    @endphp
                                    @if($fotos && is_array($fotos))
                                        @foreach($fotos as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto">
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
                                @if($crc_images && $crc_images->foto1)
                                    @php
                                        $fotos1 = json_decode($crc_images->foto1, true);
                                    @endphp
                                    @if($fotos1 && is_array($fotos1))
                                        @foreach($fotos1 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Barang Sesuai">
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
                            <label><strong>Kondisi Kemasan Baik</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->baik ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan2 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($crc_images && $crc_images->foto2)
                                    @php
                                        $fotos2 = json_decode($crc_images->foto2, true);
                                    @endphp
                                    @if($fotos2 && is_array($fotos2))
                                        @foreach($fotos2 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Kondisi Kemasan">
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
                                @if($crc_images && $crc_images->foto3)
                                    @php
                                        $fotos3 = json_decode($crc_images->foto3, true);
                                    @endphp
                                    @if($fotos3 && is_array($fotos3))
                                        @foreach($fotos3 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Kering/Basah">
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
                            <label><strong>Kondisi Pengikat (Strapping) Kencang</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->kencang ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan4 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($crc_images && $crc_images->foto4)
                                    @php
                                        $fotos4 = json_decode($crc_images->foto4, true);
                                    @endphp
                                    @if($fotos4 && is_array($fotos4))
                                        @foreach($fotos4 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Strapping">
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
                                @if($crc_images && $crc_images->foto5)
                                    @php
                                        $fotos5 = json_decode($crc_images->foto5, true);
                                    @endphp
                                    @if($fotos5 && is_array($fotos5))
                                        @foreach($fotos5 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Jumlah">
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
                            <label><strong>Rantai Dialas Karet Ban Luar</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->alas ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan6 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($crc_images && $crc_images->foto6)
                                    @php
                                        $fotos6 = json_decode($crc_images->foto6, true);
                                    @endphp
                                    @if($fotos6 && is_array($fotos6))
                                        @foreach($fotos6 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Rantai">
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
                            <label><strong>Menggunakan Side Wall</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->wall ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="{{ $submission->keterangan7 ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <div class="row">
                                @if($crc_images && $crc_images->foto7)
                                    @php
                                        $fotos7 = json_decode($crc_images->foto7, true);
                                    @endphp
                                    @if($fotos7 && is_array($fotos7))
                                        @foreach($fotos7 as $fotoItem)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ asset('storage/crc/'.$fotoItem) }}" class="img-fluid" alt="Foto Side Wall">
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
                            <label><strong>Ban Di Ganjal</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->perganjalan ?? '-' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Keterangan Ban Di Ganjal</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->ket_perganjalan ?? '-' }}" readonly>
                        </div>

                                <hr>
                        <div class="form-group">
                            <label><strong>Note Keseluruhan</strong></label>
                            <input type="text" class="form-control" value="{{ $submission->note_keseluruhan ?? '-' }}" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

