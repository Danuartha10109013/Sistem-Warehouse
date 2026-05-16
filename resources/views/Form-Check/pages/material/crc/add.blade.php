@extends(($embed ?? false) ? 'fomcheck.embed' : 'Form-Check.layout.main')
@section('title')
    Form Submission Material CRC
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
    $radiasiVal = old('radiasi', $isEdit ? ($submission->radiasi ?? '-') : '-');
    $ketRadiasiVal = old('ket_radiasi', $isEdit ? ($submission->ket_radiasi ?? '-') : '-');
    $crcKnownSuppliers = ['Krakatau Steel', 'Gunung Garuda', 'Alexindo', 'Essar', 'Synn Industrial', 'Langfang', 'Baotou', 'Lianxin', 'Ton Yi', 'Shandong (Steelforce)', 'Krakatau Baja Industri', 'Stinko / Posco Vietnam', 'Posco Korea / Posco'];
    $crcSupplierDecoded = $isEdit ? (json_decode($submission->supplier, true) ?? []) : [];
    $crcSupplierSel = old('supplier', $crcSupplierDecoded);
    if (!is_array($crcSupplierSel)) {
        $crcSupplierSel = [$crcSupplierSel];
    }
    $crcOtherSupplier = '';
    foreach ($crcSupplierSel as $entry) {
        if ($entry !== null && $entry !== '' && !in_array($entry, $crcKnownSuppliers, true)) {
            $crcOtherSupplier = (string) $entry;
            break;
        }
    }
    $ketAwalChoices = ['1', '2', '3', '4', '5'];
    $ketAwalRaw = old('ket_awal', $isEdit ? ($submission->ket_awal ?? '') : '');
    $ketAwalVal = '';
    if ($ketAwalRaw !== null && $ketAwalRaw !== '') {
        $ketAwalVal = trim((string) $ketAwalRaw);
        if (is_numeric($ketAwalVal)) {
            $n = (int) round((float) str_replace(',', '.', $ketAwalVal));
            if ($n >= 1 && $n <= 5) {
                $ketAwalVal = (string) $n;
            }
        }
    }
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
          </span> {{ $isEdit ? 'Edit' : 'Add' }} Submission Material CRC
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
                    <form action="{{route('Form-Check.admin.crc.create')}}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{route('Form-Check.pegawai.crc.create')}}" method="POST" enctype="multipart/form-data">
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
                        <label for="exampleInputPassword1">Awal Bongkar <small style="color: red;">*</small></label>
                        <input type="time" name="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ $timeForInput('time') }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Akhir Bongkar <small style="color: red;">*</small></label>
                        <input type="time" name="time_last" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ $timeForInput('time_last') }}">
                      </div>
                      <div class="form-group">
    <!-- Checkbox -->
    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="checkRadiasi"
               @checked($radiasiVal !== '-' && $radiasiVal !== '')>
        <label class="form-check-label" for="checkRadiasi">
            Isi Pengecekan Radiasi
        </label>
    </div>

    <!-- Input Radiasi -->
    <label for="radiasiCrc">Pengecekan Radiasi</label>
    <input type="text" class="form-control" name="radiasi" id="radiasiCrc"
           value="{{ $radiasiVal }}" placeholder="Cth : 1.9">
    <label for="ketRadiasi" class="mt-2">KETERANGAN</label>
    <input type="text" class="form-control" name="ket_radiasi" id="ketRadiasi"
           value="{{ $ketRadiasiVal }}" placeholder="(Gunakan titik bukan koma)">
                      </div>

<script>
(function () {
    const checkRadiasi = document.getElementById('checkRadiasi');
    const radiasiCrc = document.getElementById('radiasiCrc');
    const ketRadiasi = document.getElementById('ketRadiasi');
    const form = document.querySelector('form[enctype="multipart/form-data"]');

    function setDashMode() {
        radiasiCrc.required = false;
        radiasiCrc.readOnly = true;
        radiasiCrc.classList.add('bg-light');
        radiasiCrc.value = '-';
        ketRadiasi.readOnly = true;
        ketRadiasi.classList.add('bg-light');
        ketRadiasi.value = '-';
    }

    function setInputMode() {
        radiasiCrc.required = true;
        radiasiCrc.readOnly = false;
        radiasiCrc.classList.remove('bg-light');
        if (radiasiCrc.value === '-') radiasiCrc.value = '';
        ketRadiasi.readOnly = false;
        ketRadiasi.classList.remove('bg-light');
        if (ketRadiasi.value === '-') ketRadiasi.value = '';
    }

    function toggleRadiasi() {
        if (checkRadiasi.checked) setInputMode();
        else setDashMode();
    }

    checkRadiasi.addEventListener('change', toggleRadiasi);
    toggleRadiasi();

    if (form) {
        form.addEventListener('submit', function () {
            if (!checkRadiasi.checked) setDashMode();
        });
    }
})();
</script>
<div class="mb-4 metode-unloading-group">
    <label class="form-label fw-bold">
        Metode Unloading <span class="text-danger">*</span>
    </label>

    <div class="row g-3 mt-1">

        <!-- Forklift -->
        <div class="col-md-6">
            <input type="radio" class="btn-check" name="metode_unloading" 
                   id="forklift" value="Forklift" required @checked(old('metode_unloading', $isEdit ? ($submission->metode_unloading ?? '') : '') === 'Forklift')>
            <label class="card unloading-card border-2 shadow-sm h-100 text-center p-4"
                   for="forklift">
                <div class="mb-2">
                    <i class="mdi mdi-forklift display-5 text-primary"></i>
                </div>
                <h5 class="mb-1">Forklift</h5>
                <small class="text-muted">Unloading menggunakan forklift</small>
            </label>
        </div>

        <!-- Crane -->
        <div class="col-md-6">
            <input type="radio" class="btn-check" name="metode_unloading" 
                   id="crane" value="Crane" required @checked(old('metode_unloading', $isEdit ? ($submission->metode_unloading ?? '') : '') === 'Crane')>
            <label class="card unloading-card border-2 shadow-sm h-100 text-center p-4"
                   for="crane">
                <div class="mb-2">
                    <i class="mdi mdi-crane display-5 text-success"></i>
                </div>
                <h5 class="mb-1">Crane</h5>
                <small class="text-muted">Unloading menggunakan crane</small>
            </label>
        </div>

    </div>
</div>

<style>
    .metode-unloading-group .btn-check {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .metode-unloading-group .unloading-card {
        cursor: pointer;
        transition: 0.2s ease-in-out;
        border-color: #dee2e6;
        background-color: rgba(255, 255, 255, 0.5);
    }

    .metode-unloading-group .unloading-card:hover {
        transform: scale(1.02);
    }

    .metode-unloading-group .btn-check:checked + .unloading-card {
        border-color: #0d6efd !important;
        background-color: #f0f8ff !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 22, 54, 0.25);
        transform: scale(1.02);
    }
</style>
                <hr class="mt-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">
                            PENGIRIM/SUPPLIER <small style="color: red;">*</small><br>
                        </label>
                <div class="row mt-3">
                        <div class="col-md-6">
                            <label><input type="checkbox" name="supplier[]" value="Krakatau Steel" @checked(in_array('Krakatau Steel', $crcSupplierSel, true))> Krakatau Steel</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Gunung Garuda" @checked(in_array('Gunung Garuda', $crcSupplierSel, true))> Gunung Garuda</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Alexindo" @checked(in_array('Alexindo', $crcSupplierSel, true))> Alexindo</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Essar" @checked(in_array('Essar', $crcSupplierSel, true))> Essar</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Synn Industrial" @checked(in_array('Synn Industrial', $crcSupplierSel, true))> Synn Industrial</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Langfang" @checked(in_array('Langfang', $crcSupplierSel, true))> Langfang</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Baotou" @checked(in_array('Baotou', $crcSupplierSel, true))> Baotou</label><br>
                        </div>
                        <div class="col-md-6">
                            <label><input type="checkbox" name="supplier[]" value="Lianxin" @checked(in_array('Lianxin', $crcSupplierSel, true))> Lianxin</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Ton Yi" @checked(in_array('Ton Yi', $crcSupplierSel, true))> Ton Yi</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Shandong (Steelforce)" @checked(in_array('Shandong (Steelforce)', $crcSupplierSel, true))> Shandong (Steelforce)</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Krakatau Baja Industri" @checked(in_array('Krakatau Baja Industri', $crcSupplierSel, true))> Krakatau Baja Industri</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Stinko / Posco Vietnam" @checked(in_array('Stinko / Posco Vietnam', $crcSupplierSel, true))> Stinko / Posco Vietnam</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Posco Korea / Posco" @checked(in_array('Posco Korea / Posco', $crcSupplierSel, true))> Posco Korea / Posco</label><br>
                            <!-- Checkbox untuk "Other" dengan input text -->
                            <label><input type="checkbox" id="otherCheckbox" @checked($crcOtherSupplier !== '')> Other: </label>
                            <input type="text" name="supplier[]" id="otherText" value="{{ $crcOtherSupplier }}" @disabled($crcOtherSupplier === '')><br>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById('otherCheckbox').addEventListener('change', function() {
                        var otherText = document.getElementById('otherText');
                        otherText.disabled = !this.checked;
                    });
                    (function () {
                        var oc = document.getElementById('otherCheckbox');
                        var ot = document.getElementById('otherText');
                        if (oc && ot && oc.checked) {
                            ot.disabled = false;
                        }
                    })();
                </script>
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="jumlahDropdown">Jumlah <small style="color: red;">*</small></label>
                            <select class="form-control" name="ket_awal" id="jumlahDropdown" required>
                                <option value="" disabled @selected($ketAwalVal === '')>--Pilih jumlah--</option>
                                @foreach($ketAwalChoices as $n)
                                <option value="{{ $n }}" @selected($ketAwalVal === $n)>{{ $n }}</option>
                                @endforeach
                                @if($ketAwalVal !== '' && ! in_array($ketAwalVal, $ketAwalChoices, true))
                                <option value="{{ $ketAwalVal }}" selected>{{ $ketAwalVal }}</option>
                                @endif
                            </select>
                        </div>
                        <hr>

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

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan', $isEdit ? ($submission->keterangan ?? '') : '') }}">
                        </div>
                        <hr>

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
                        <hr>

                        <div class="form-group">
                                KONDISI KEMASAN BAIK <small style="color: red;">*</small><br class="mb-3">
                                <label><input class="mt-3" type="radio" name="baik" value="baik" @checked(old('baik', $isEdit ? ($submission->baik ?? '') : '') === 'baik')> Baik</label><br>
                                <label><input type="radio" name="baik" value="tidak baik" @checked(old('baik', $isEdit ? ($submission->baik ?? '') : '') === 'tidak baik')> Tidak Baik</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload2">FOTO <br></label>
                            <input type="file" class="" name="foto2[]" id="fotoUpload2" multiple>
                            <div id="fileList2"></div>
                        </div>
                        <script>
                            var selectedFiles2 = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload2').addEventListener('change', function() {
                                var fileList2 = document.getElementById('fileList2');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles2.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList2.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles2.length; i++) {
                                    fileList2.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles2[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan2" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan2', $isEdit ? ($submission->keterangan2 ?? '') : '') }}">
                        </div>

                        <hr>

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

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            KONDISI PENGIKAT (STRAPPING) KENCANG    <small style="color: red;">*</small>                        <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="kencang" value="Kencang" @checked(old('kencang', $isEdit ? ($submission->kencang ?? '') : '') === 'Kencang')> Kencang</label><br>
                                <label><input type="radio" name="kencang" value="Tidak kencang/ada yang putus" @checked(old('kencang', $isEdit ? ($submission->kencang ?? '') : '') === 'Tidak kencang/ada yang putus')> Tidak kencang/ada yang putus</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload4">FOTO <br></label>
                            <input type="file" class="" name="foto4[]" id="fotoUpload4" multiple>
                            <div id="fileList4"></div>
                        </div>
                        <script>
                            var selectedFiles4 = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload4').addEventListener('change', function() {
                                var fileList4 = document.getElementById('fileList4');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles4.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList4.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles4.length; i++) {
                                    fileList4.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles4[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan4" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan4', $isEdit ? ($submission->keterangan4 ?? '') : '') }}">
                        </div>
                        <hr>

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
                        <hr>


                        <div class="form-group">
                            RANTAI DIALAS KARET BAN LUAR<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="alas" value="Di atas alas karet ban" @checked(old('alas', $isEdit ? ($submission->alas ?? '') : '') === 'Di atas alas karet ban')> Di atas alas karet ban</label><br>
                                <label><input type="radio" name="alas" value="Tidak terdapat alas karet ban" @checked(old('alas', $isEdit ? ($submission->alas ?? '') : '') === 'Tidak terdapat alas karet ban')> Tidak terdapat alas karet ban</label><br>
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
                            <input type="text" class="form-control" name="keterangan6" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan6', $isEdit ? ($submission->keterangan6 ?? '') : '') }}">
                        </div>
                        <hr>

                        <div class="form-group">
                            MENGGUNAKAN SIDE WALL<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="wall" value="Menggunakan side wall" @checked(old('wall', $isEdit ? ($submission->wall ?? '') : '') === 'Menggunakan side wall')> Menggunakan side wall</label><br>
                                <label><input type="radio" name="wall" value="Tidak menggunakan side wall" @checked(old('wall', $isEdit ? ($submission->wall ?? '') : '') === 'Tidak menggunakan side wall')> Tidak menggunakan side wall</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload7">FOTO <br></label>
                            <input type="file" class="" name="foto7[]" id="fotoUpload7" multiple>
                            <div id="fileList7"></div>
                        </div>
                        <script>
                            var selectedFiles7 = []; // Array untuk menyimpan file yang dipilih

                            document.getElementById('fotoUpload7').addEventListener('change', function() {
                                var fileList7 = document.getElementById('fileList7');

                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles7.push(this.files[i]);
                                }

                                // Reset daftar tampilan
                                fileList7.innerHTML = '';

                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles7.length; i++) {
                                    fileList7.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles7[i].name + '</p>';
                                }
                            });
                        </script>



                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan7" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada" value="{{ old('keterangan7', $isEdit ? ($submission->keterangan7 ?? '') : '') }}">
                        </div>
                        <hr>

                        <div class="form-group">
                            BAN DI GANJAL            <small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="perganjalan" value="Ya" @checked(old('perganjalan', $isEdit ? ($submission->perganjalan ?? '') : '') === 'Ya')> Ya</label><br>
                                <label><input type="radio" name="perganjalan" value="Tidak" @checked(old('perganjalan', $isEdit ? ($submission->perganjalan ?? '') : '') === 'Tidak')> Tidak</label><br>
                        </div>

                    </div>
                </div>



                      <div class="form-group mb-3">
                          <label for="noteKeseluruhan">Note</label>
                          <textarea class="form-control" name="note_keseluruhan" id="noteKeseluruhan" rows="3" placeholder="Masukkan keterangan umum/keseluruhan terkait pengecekan dan kondisi material">{{ old('note_keseluruhan', $isEdit ? ($submission->note_keseluruhan ?? '') : '') }}</textarea>
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
