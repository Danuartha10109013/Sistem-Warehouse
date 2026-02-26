@extends('so.main')
@section('title')
     SO KRAKATAU BAJA INDUSTRI
@endsection
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
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
                html: @json(implode('<br>', $errors->all())),
            })
        </script>
        @endif


    <!-- Page Title -->
    <div class="row mb-4 mt-4">
        <div class="col-12 text-center">
            <h3 class="m-0 fw-bold text-dark">STOCK OPNAME KRAKATAU BAJA INDUSTRI</h3>
        </div>
    </div>
    <!-- Action Buttons + Search -->
    <div class="row g-3 mb-3">

        <!-- New -->
        <div class="col-12 col-md-3">
            <button class="btn btn-primary w-100 rounded-pill py-2"
                data-bs-toggle="modal"
                data-bs-target="#scanModalKBI">
                <i class="fa fa-qrcode me-2"></i> Scan
            </button>
        </div>

        <!-- Modal Scan KBI -->
        <div class="modal fade" id="scanModalKBI" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Data Scan / Manual (KBI)</h5>
                        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('so.store') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-12">
                                    <div id="scannerWarningKBI" class="text-danger fw-bold mb-2" style="display:none;">
                                        No coil telah di-scan!
                                    </div>

                                    <label class="fw-bold mb-1">No coil</label>

                                    <div class="input-group">
                                        <input type="text" id="attributeInputKBI" name="attribute"
                                            class="form-control rounded-pill px-3 py-2 me-2"
                                            placeholder="Scan / Input Manual" required>

                                        <button type="button" class="btn btn-primary rounded-pill px-3"
                                                onclick="openScannerKBI()">
                                            <i class="fa fa-qrcode"></i>
                                        </button>
                                    </div>

                                    <div id="qrScannerKBI" class="mt-3" style="display:none;">
                                        <video id="cameraPreviewKBI" width="100%" class="rounded" autoplay></video>
                                        <button type="button" class="btn btn-danger rounded-pill mt-2 w-100"
                                                onclick="closeScannerKBI()">
                                            Tutup Kamera
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold mb-1">Qty</label>
                                    <input type="number" name="qty" class="form-control rounded-pill px-3 py-2"
                                        placeholder="Qty" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold mb-1">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control rounded-pill px-3 py-2"
                                        placeholder="Lokasi" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="fw-bold mb-1">Nama Barang</label>
                                    <input type="text" name="namabarang" class="form-control rounded-pill px-3 py-2"
                                        placeholder="Nama Barang" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="fw-bold mb-1">Keterangan</label>
                                    <textarea name="keterangan"
                                            class="form-control px-3 py-2 rounded"
                                            rows="3"
                                            placeholder="Keterangan"
                                            ></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill" id="submitBtnKBI">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

<script src="https://unpkg.com/@zxing/library@latest"></script>

{{-- SCANNER KBI --}}
<script>
    let streamKBI;
    let codeReaderKBI;

    function openScannerKBI() {
        const qrBox = document.getElementById("qrScannerKBI");
        qrBox.style.display = "block";

        codeReaderKBI = new ZXing.BrowserMultiFormatReader();

        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
            .then(s => {
                streamKBI = s;
                const video = document.getElementById("cameraPreviewKBI");
                video.srcObject = s;
                video.play();

                codeReaderKBI.decodeFromVideoDevice(null, "cameraPreviewKBI", (result, err) => {
                    if (result) {
                        document.getElementById("attributeInputKBI").value = result.text;
                        document.getElementById("attributeInputKBI").dispatchEvent(new Event('input'));
                        closeScannerKBI();
                    }
                });
            })
            .catch(err => {
                alert("Tidak bisa mengakses kamera");
                console.error(err);
            });
    }

    function closeScannerKBI() {
        const qrBox = document.getElementById("qrScannerKBI");
        qrBox.style.display = "none";
        if (streamKBI) streamKBI.getTracks().forEach(t => t.stop());
        if (codeReaderKBI) codeReaderKBI.reset();
    }
</script>

{{-- AUTOFILL KBI --}}
<script>
    const autofillUrl = "{{ route('so.autofill') }}";

    document.getElementById('attributeInputKBI').addEventListener('input', function () {
        let attr = this.value;
        if (attr.length < 3) return;

        fetch(`${autofillUrl}?attribute=${encodeURIComponent(attr)}`)
            .then(response => response.json())
            .then(data => {
                const warning = document.getElementById("scannerWarningKBI");
                const submitBtn = document.getElementById("submitBtnKBI");

                if (data.status === true) {
                    document.querySelector('#scanModalKBI input[name="qty"]').value = data.qty ?? '';
                    document.querySelector('#scanModalKBI input[name="lokasi"]').value = data.lokasi ?? '';
                    document.querySelector('#scanModalKBI input[name="namabarang"]').value = data.namabarang ?? '';
                    document.querySelector('#scanModalKBI textarea[name="keterangan"]').value = data.keterangan ?? '';
                    warning.style.display = "block";
                    if (submitBtn) submitBtn.disabled = true;
                } else {
                    warning.style.display = "none";
                    if (submitBtn) submitBtn.disabled = false;
                }
            })
            .catch(() => {
                const warning = document.getElementById("scannerWarningKBI");
                const submitBtn = document.getElementById("submitBtnKBI");
                if (warning) warning.style.display = "none";
                if (submitBtn) submitBtn.disabled = false;
            });
    });
</script>

        <style>
            th.sortable { cursor: pointer; position: relative; user-select: none; padding-right: 20px !important; }
            th.sortable::after { content: "↕"; position: absolute; right: 5px; opacity: 0.3; transition: transform 0.3s ease, opacity 0.2s; }
            th.sortable.asc::after { content: "↑"; opacity: 1; transform: translateY(-2px); }
            th.sortable.desc::after { content: "↓"; opacity: 1; transform: translateY(2px); }
        </style>

   <!-- BUTTON FILTER -->
<div class="mb-3">
    <button id="btnBelum" class="btn btn-outline-danger rounded-pill px-3">Belum Scan</button>
    <button id="btnSudah" class="btn btn-outline-success rounded-pill px-3">Sudah Scan</button>
    <button id="btnSelisih" class="btn btn-outline-warning rounded-pill px-3">Selisih</button>
</div>

<div class="card">
    <div class="card-header">
        Data Stock | Total
        <span id="totalBelum" class="text-danger">
            {{ $data->whereNull('scanner')->count() }}
        </span>
        <span id="totalSudah" class="text-success" style="display:none;">
            {{ $data->whereNotNull('scanner')->count() }}
        </span>
        <span id="totalSelisih" class="text-warning" style="display:none;">
            {{ $data->filter(fn($d) => $d->scanner && (float)($d->berat ?? 0) != (float)($d->qty_scan ?? 0))->count() }}
        </span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th class="sortable">No</th>
                        <th class="sortable">Date</th>
                        <th class="sortable">NO COIL</th>
                        <th class="sortable">Berat</th>
                        <th class="sortable">Lokasi</th>
                        <th class="sortable">Layout</th>
                        <th class="col-scan sortable">Scanner</th>
                        <th class="col-scan sortable">Berat SO</th>
                        <th class="col-scan sortable">Selisih SO</th>
                        <th class="sortable">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $d)
                    @php
                        $isSelisih = $d->scanner && (float)($d->berat ?? 0) != (float)($d->qty_scan ?? 0);
                    @endphp
                    <tr class="{{ $d->scanner ? 'row-sudah' : 'row-belum' }} {{ $isSelisih ? 'row-selisih' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->date }}</td>
                        <td>{{ $d->coil_no }}</td>
                        <td>{{ $d->delv_weight }}</td>
                        <td>{{ $d->storagebin_kbi }}</td>
                        <td>{{ $d->storagebin_hasil ?? $d->storagebin ?? '-' }}</td>
                        <td class="col-scan">{{ $d->scanner ?? '-' }}</td>
                        <td class="col-scan">{{ $d->scanner ? $d->qty_scan : '-' }}</td>
                        <td class="col-scan">
                            {{ $d->scanner ? ($d->berat - $d->qty_scan) : '-' }}
                        </td>
                        <td>{!! nl2br(e($d->keterangan)) !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JAVASCRIPT SWITCH MODE -->
<script>
    function aktifkanModeBelum() {
        document.getElementById("btnBelum").classList.remove("btn-outline-danger");
        document.getElementById("btnBelum").classList.add("btn-danger");
        document.getElementById("btnSudah").classList.remove("btn-success");
        document.getElementById("btnSudah").classList.add("btn-outline-success");
        document.getElementById("btnSelisih").classList.remove("btn-warning");
        document.getElementById("btnSelisih").classList.add("btn-outline-warning");
        document.querySelectorAll(".col-scan").forEach(col => col.style.display = "none");
        document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "none");
        document.querySelectorAll(".row-belum").forEach(r => r.style.display = "table-row");
        document.querySelectorAll(".row-selisih").forEach(r => r.style.display = "none");
        const totalBelum = document.getElementById("totalBelum");
        const totalSudah = document.getElementById("totalSudah");
        const totalSelisih = document.getElementById("totalSelisih");
        if (totalBelum && totalSudah && totalSelisih) {
            totalBelum.style.display = "inline";
            totalSudah.style.display = "none";
            totalSelisih.style.display = "none";
        }
    }

    function aktifkanModeSudah() {
        document.getElementById("btnSudah").classList.remove("btn-outline-success");
        document.getElementById("btnSudah").classList.add("btn-success");
        document.getElementById("btnBelum").classList.remove("btn-danger");
        document.getElementById("btnBelum").classList.add("btn-outline-danger");
        document.getElementById("btnSelisih").classList.remove("btn-warning");
        document.getElementById("btnSelisih").classList.add("btn-outline-warning");
        document.querySelectorAll(".col-scan").forEach(col => col.style.display = "");
        document.querySelectorAll(".row-belum").forEach(r => r.style.display = "none");
        document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "table-row");
        const totalBelum = document.getElementById("totalBelum");
        const totalSudah = document.getElementById("totalSudah");
        const totalSelisih = document.getElementById("totalSelisih");
        if (totalBelum && totalSudah && totalSelisih) {
            totalBelum.style.display = "none";
            totalSudah.style.display = "inline";
            totalSelisih.style.display = "none";
        }
    }

    function aktifkanModeSelisih() {
        document.getElementById("btnSelisih").classList.remove("btn-outline-warning");
        document.getElementById("btnSelisih").classList.add("btn-warning");
        document.getElementById("btnBelum").classList.remove("btn-danger");
        document.getElementById("btnBelum").classList.add("btn-outline-danger");
        document.getElementById("btnSudah").classList.remove("btn-success");
        document.getElementById("btnSudah").classList.add("btn-outline-success");
        document.querySelectorAll(".col-scan").forEach(col => col.style.display = "");
        document.querySelectorAll(".row-belum").forEach(r => r.style.display = "none");
        document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "none");
        document.querySelectorAll(".row-selisih").forEach(r => r.style.display = "table-row");
        const totalBelum = document.getElementById("totalBelum");
        const totalSudah = document.getElementById("totalSudah");
        const totalSelisih = document.getElementById("totalSelisih");
        if (totalBelum && totalSudah && totalSelisih) {
            totalBelum.style.display = "none";
            totalSudah.style.display = "none";
            totalSelisih.style.display = "inline";
        }
    }

    window.addEventListener("load", aktifkanModeBelum);

    document.getElementById("btnBelum").addEventListener("click", function () {
        aktifkanModeBelum();
    });

    document.getElementById("btnSudah").addEventListener("click", function () {
        aktifkanModeSudah();
    });

    document.getElementById("btnSelisih").addEventListener("click", function () {
        aktifkanModeSelisih();
    });
</script>

</div>
@endsection
