@extends(($embed ?? false) ? 'fomcheck.embed' : 'Form-Check.layout.main')
@section('title')
    Form Submission Material RESIN
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
@php
    $submission = $submission ?? null;
    $isEdit = filled($submission);
    $dateDefault = '';
    if ($isEdit && !empty($submission->date)) {
        try {
            $dateDefault = \Carbon\Carbon::parse($submission->date)->format('Y-m-d');
        } catch (\Throwable $e) {
            $dateDefault = is_string($submission->date) ? $submission->date : '';
        }
    }
    $supplierVals = old('supplier', $isEdit ? (json_decode($submission->supplier, true) ?? []) : []);
    if (!is_array($supplierVals)) {
        $supplierVals = [$supplierVals];
    }
    $resinSupplierPick = $supplierVals[0] ?? '';
    $resinSupplierKnown = ['Metal Coat', 'Inkote'];
    $resinSupplierOther = ($resinSupplierPick !== '' && !in_array($resinSupplierPick, $resinSupplierKnown, true)) ? $resinSupplierPick : '';
    $jenisVal = old('jenis', $isEdit ? ($submission->jenis ?? '') : '');
    $jenisKnown = ['RESIN', 'ALKALI'];
    $jenisOther = ($jenisVal !== '' && !in_array($jenisVal, $jenisKnown, true)) ? $jenisVal : '';
    $timeForInput = function (string $field) use ($isEdit, $submission) {
        $fallback = $isEdit ? (data_get($submission, $field) ?? '') : '';
        $raw = old($field, $fallback);
        if ($raw === null || $raw === '') {
            return '';
        }
        try {
            return \Carbon\Carbon::parse($raw)->format('H:i');
        } catch (\Throwable $e) {
            return '';
        }
    };
@endphp
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
          </span> {{ $isEdit ? 'Edit' : 'Add' }} Submission Material RESIN
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
                <h4 class="card-title">From Daily Checklist Kedatangan Material  FM.WH.02.01</h4>
                <p class="card-description">Form checklist ini dibuat untuk memastikan kondisi material yang datang dalam kondisi baik (tanpa cacat) sesuai dengan spesifikasi yang telah di tentukan sebelumnya. <br>
                    <br>Serta untuk melihat kesesuaian material yang ada pada surat jalan dengan kondisi fisiknya.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan.</strong> Mohon periksa kembali isian form Anda.
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @isset($updateRoute)
                    <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                    @elseif(isset($storeRoute))
                    <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                    @elseif (Auth::user()->role == 0)
                    <form action="{{route('Form-Check.admin.resin.create')}}" method="POST" enctype="multipart/form-data">
                    @else
                    <form action="{{route('Form-Check.pegawai.resin.create')}}" method="POST" enctype="multipart/form-data">
                    @endif
                @csrf
                @isset($updateRoute)
                @method('PUT')
                @endisset
                @if($embed ?? false)
                <input type="hidden" name="embed" value="1">
                @endif
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputUsername1">PENERIMA<small style="color: red;">*</small></label>
                        <input type="text" name="user_id" value="{{ old('user_id', $isEdit ? $submission->user_id : Auth::user()->id) }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ $respondenName ?? Auth::user()->name }}" readonly>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NOMOR DOKUMEN<small style="color: red;">*</small></label>
                        <input type="text" class="form-control" name="shift_leader" id="exampleInputUsername1" value="{{ old('shift_leader', $isEdit ? ($submission->shift_leader ?? '') : '') }}" required>
                      </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">TANGGAL SURAT JALAN<small style="color: red;">*</small></label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" value="{{ old('date', $dateDefault) }}" required>
                      </div>
                      <div class="form-group">
                        <label for="inputJumlahResin">Jumlah <small style="color: red;">*</small></label>
                        <input type="text" class="form-control" name="jumlah" id="inputJumlahResin"
                               value="{{ old('jumlah', $isEdit ? ($submission->jumlah ?? '') : '') }}"
                               placeholder="Contoh: 10 drum, 5 Bulky"
                               maxlength="191" required>
                        <!-- <small class="text-muted d-block mt-1">Bukan pilihan &quot;Jumlah sesuai surat jalan&quot; di bawah; ini khusus angka/keterangan jumlah di header cetak.</small> -->
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist<small style="color: red;">*</small></label>
                        <input type="time" name="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ $timeForInput('time') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Pengecekan Radiasi<small style="color: red;">*</small></label>
                        <input type="text" class="form-control bg-light" name="radiasi" id="radiasiResin" value="{{ old('radiasi', $isEdit ? ($submission->radiasi ?? '-') : '-') }}" readonly required>
                      </div>
                      <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="ket_radiasi" id="exampleInputPassword1" placeholder="(Gunakan titik bukan koma)" value="{{ old('ket_radiasi', $isEdit ? ($submission->ket_radiasi ?? '-') : '-') }}" readonly required>
                        </div>
                </div>
                <hr class="mt-2">


                    <div class="form-group">
                        <label for="exampleInputPassword1">
                            PENGIRIM/SUPPLIER <small style="color: red;">*</small><br>
                        </label>
                <div class="row mt-3">

                        <div class="col-md-6">
                            <label><input type="radio" name="supplier[]" value="Metal Coat" @checked(!$resinSupplierOther && $resinSupplierPick === 'Metal Coat')> Metal Coat</label><br>
                            <label><input type="radio" name="supplier[]" value="Inkote" @checked(!$resinSupplierOther && $resinSupplierPick === 'Inkote')> Inkote</label><br>
                            <label><input type="radio" id="otherCheckbox" @checked($resinSupplierOther !== '')> Other: </label>
                            <input type="text" name="supplier[]" id="otherText" value="{{ $resinSupplierOther }}" @disabled($resinSupplierOther === '')><br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                JENIS <small style="color: red;">*</small><br class="mb-3">
                                <label><input class="mt-3" type="radio" name="jenis" value="RESIN" @checked(!$jenisOther && $jenisVal === 'RESIN')> RESIN</label><br>
                                <label><input type="radio" name="jenis" value="ALKALI" @checked(!$jenisOther && $jenisVal === 'ALKALI')> ALKALI</label><br>
                                <label><input type="radio" name="jenis" value="RESIN-ALKALI" @checked(!$jenisOther && $jenisVal === 'RESIN-ALKALI')> RESIN-ALKALI</label><br>
                                <label><input type="radio" id="otjenis" @checked($jenisOther !== '')> Other: </label>
                                       <input type="text" name="jenis" id="otText" value="{{ $jenisOther }}" @disabled($jenisOther === '')><br>
                            </div>
                        </div>

                    </div>
                </div>
                <script>
                    document.getElementById('otherCheckbox').addEventListener('change', function() {
                        var otherText = document.getElementById('otherText');
                        otherText.disabled = !this.checked;
                    });
                    document.getElementById('otjenis').addEventListener('change', function() {
                        var otherText = document.getElementById('otText');
                        otherText.disabled = !this.checked;
                    });
                    (function () {
                        var oc = document.getElementById('otherCheckbox');
                        var ot = document.getElementById('otherText');
                        if (oc && ot && oc.checked) ot.disabled = false;
                        var oj = document.getElementById('otjenis');
                        var otx = document.getElementById('otText');
                        if (oj && otx && oj.checked) otx.disabled = false;
                    })();
                </script>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            CUACA <small style="color: red;">*</small><br class="mb-3">
                            <label><input class="mt-3" type="radio" name="cuaca" value="Cerah" @checked(old('cuaca', $isEdit ? ($submission->cuaca ?? '') : '') === 'Cerah')> Cerah</label><br>
                            <label><input type="radio" name="cuaca" value="Berawan" @checked(old('cuaca', $isEdit ? ($submission->cuaca ?? '') : '') === 'Berawan')> Berawan</label><br>
                            <label><input type="radio" name="cuaca" value="Hujan" @checked(old('cuaca', $isEdit ? ($submission->cuaca ?? '') : '') === 'Hujan')> Hujan</label><br>
                        </div>
                        <div class="form-group">
                            TUJUAN SURAT JALAN <small style="color: red;">*</small><br class="mb-3">
                            <label><input class="mt-3" type="radio" name="jalan" value="Sesuai" @checked(old('jalan', $isEdit ? ($submission->jalan ?? '') : '') === 'Sesuai')> Sesuai</label><br>
                            <label><input type="radio" name="jalan" value="Tidak Sesuai" @checked(old('jalan', $isEdit ? ($submission->jalan ?? '') : '') === 'Tidak Sesuai')> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload">FOTO <small style="color: red;">*</small><br></label>
                            <input type="file" class="" name="foto[]" id="fotoUpload" multiple>
                            <div id="fileList"></div>
                        </div>
                        <script>
                            var selectedFiles = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload').addEventListener('change', function() {
                                var fileList = document.getElementById('fileList');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles.length; i++) {
                                    fileList.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan', $isEdit ? ($submission->keterangan ?? '') : '') }}">
                        </div>

                        <div class="form-group">
                                BARANG SESUAI SURAT JALAN <small style="color: red;">*</small><br class="mb-3">
                                <label><input class="mt-3" type="radio" name="sesuai" value="sesuai" @checked(old('sesuai', $isEdit ? ($submission->sesuai ?? '') : '') === 'sesuai')> Sesuai</label><br>
                                <label><input type="radio" name="sesuai" value="tidak sesuai" @checked(old('sesuai', $isEdit ? ($submission->sesuai ?? '') : '') === 'tidak sesuai')> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload1">FOTO <br></label>
                            <input type="file" class="" name="foto1[]" id="fotoUpload1" multiple>
                            <div id="fileList1"></div>
                        </div>
                        <script>
                            var selectedFiles1 = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload1').addEventListener('change', function() {
                                var fileList1 = document.getElementById('fileList1');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles1.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList1.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles1.length; i++) {
                                    fileList1.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles1[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan1" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan1', $isEdit ? ($submission->keterangan1 ?? '') : '') }}">
                        </div>



                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            KERING / BASAH <small style="color: red;">*</small><br class="mb-3">
                            <label><input class="mt-3" type="radio" name="kering" value="Kering/Tidak kena air" @checked(old('kering', $isEdit ? ($submission->kering ?? '') : '') === 'Kering/Tidak kena air')> Kering/Tidak kena air</label><br>
                            <label><input type="radio" name="kering" value="Basah/Terdapat bercak bekas terkena air" @checked(old('kering', $isEdit ? ($submission->kering ?? '') : '') === 'Basah/Terdapat bercak bekas terkena air')> Basah/Terdapat bercak bekas terkena air</label><br>
                        </div>
                    <div class="mb-3">
                        <label for="fotoUpload3">FOTO <br></label>
                        <input type="file" class="" name="foto3[]" id="fotoUpload3" multiple>
                        <div id="fileList3"></div>
                    </div>
                    <script>
                        var selectedFiles3 = []; // Array untuk menyimpan file yang dipilih

                        document.getElementById('fotoUpload3').addEventListener('change', function() {
                            var fileList3 = document.getElementById('fileList3');

                            // Menambahkan file yang baru dipilih ke array
                            for (var i = 0; i < this.files.length; i++) {
                                selectedFiles3.push(this.files[i]);
                            }

                            // Reset daftar tampilan
                            fileList3.innerHTML = '';

                            // Menampilkan semua file yang ada di array
                            for (var i = 0; i < selectedFiles3.length; i++) {
                                fileList3.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles3[i].name + '</p>';
                            }
                        });
                    </script>

                    <div class="form-group">
                        <label for="exampleInputPassword1">KETERANGAN</label>
                        <input type="text" class="form-control" name="keterangan3" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan3', $isEdit ? ($submission->keterangan3 ?? '') : '') }}">
                    </div>

                        <div class="form-group">
                            JUMLAH SESUAI SURAT JALAN<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="jumlahin" value="Sesuai" @checked(old('jumlahin', $isEdit ? ($submission->jumlahin ?? '') : '') === 'Sesuai')> Sesuai</label><br>
                                <label><input type="radio" name="jumlahin" value="Tidak Sesuai" @checked(old('jumlahin', $isEdit ? ($submission->jumlahin ?? '') : '') === 'Tidak Sesuai')> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload5">FOTO <br></label>
                            <input type="file" class="" name="foto5[]" id="fotoUpload5" multiple>
                            <div id="fileList5"></div>
                        </div>
                        <script>
                            var selectedFiles5 = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload5').addEventListener('change', function() {
                                var fileList5 = document.getElementById('fileList5');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles5.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList5.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles5.length; i++) {
                                    fileList5.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles5[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan5" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan5', $isEdit ? ($submission->keterangan5 ?? '') : '') }}">
                        </div>
                        <div class="form-group">
                            DRUM TIDAK PENYOK/BOCOR (RESIN-ALKALI)<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="drum" value="Sesuai" @checked(old('drum', $isEdit ? ($submission->drum ?? '') : '') === 'Sesuai')> Sesuai</label><br>
                                <label><input type="radio" name="drum" value="Tidak Sesuai" @checked(old('drum', $isEdit ? ($submission->drum ?? '') : '') === 'Tidak Sesuai')> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload6">FOTO <br></label>
                            <input type="file" class="" name="foto6[]" id="fotoUpload6" multiple>
                            <div id="fileList6"></div>
                        </div>
                        <script>
                            var selectedFiles6 = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload6').addEventListener('change', function() {
                                var fileList6 = document.getElementById('fileList6');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles6.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList6.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles6.length; i++) {
                                    fileList6.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles6[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan6" id="keteranganDrum" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan6', $isEdit ? ($submission->keterangan6 ?? '') : '') }}">
                        </div>

                    </div>
                </div>



                      <button type="submit" class="btn btn-primary me-2">{{ $isEdit ? 'Simpan perubahan' : 'Submit' }}</button>
                      <button type="button" class="btn btn-light"
                              @if($embed ?? false) onclick="window.parent.postMessage({type:'fomcheck-close'}, '*')" @endif>
                          Batal
                      </button>

            </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
