@extends('so.main')
@section('title')
    SAC SO
@endsection
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="m-0 fw-bold text-dark">SAC Stock Opname</h3>
        </div>
    </div>
    <!-- Action Buttons + Search -->
    <div class="row g-3 mb-3">

        <!-- New -->
        <div class="col-12 col-md-3">
            <button class="btn btn-primary w-100 rounded-pill py-2"
                    data-bs-toggle="modal"
                    data-bs-target="#scanModal">
                <i class="fa fa-qrcode me-2"></i> Scan
            </button>
        </div>

        <!-- Modal Scan / Input Attribute -->
        <div class="modal fade" id="scanModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Data Scan / Manual</h5>
                        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('so.store') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row g-3">

                                <!-- ATTRIBUTE (SCAN / MANUAL) -->
                                <div class="col-md-12">
                                    <div id="scannerWarning" class="text-danger fw-bold mb-2" style="display:none;">
                                        Attribute telah di-scan!
                                    </div>

                                    <label class="fw-bold mb-1">Attribute</label>

                                    <div class="input-group">
                                        <input type="text" id="attributeInput" name="attribute"
                                            class="form-control rounded-pill px-3 py-2 me-2"
                                            placeholder="Scan / Input Manual" required>

                                        <button type="button" class="btn btn-primary rounded-pill px-3"
                                                onclick="openScanner()">
                                            <i class="fa fa-qrcode"></i>
                                        </button>
                                    </div>

                                    <!-- CAMERA AREA -->
                                    <div id="qrScanner" class="mt-3" style="display:none;">
                                        <video id="cameraPreview" width="100%" class="rounded" autoplay></video>
                                        <button type="button" class="btn btn-danger rounded-pill mt-2 w-100"
                                                onclick="closeScanner()">
                                            Tutup Kamera
                                        </button>
                                    </div>
                                </div>

                                <!-- QTY -->
                                <div class="col-md-6">
                                    <label class="fw-bold mb-1">Qty</label>
                                    <input type="number" name="qty" class="form-control rounded-pill px-3 py-2"
                                        placeholder="Qty" required>
                                </div>

                                <!-- LOKASI -->
                                <div class="col-md-6">
                                    <label class="fw-bold mb-1">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control rounded-pill px-3 py-2"
                                        placeholder="Lokasi" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="fw-bold mb-1">Nama Barang</label>
                                    <input type="text" name="namabarang" class="form-control rounded-pill px-3 py-2"
                                        placeholder="namabarang" required>
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
                            <button type="submit" class="btn btn-primary rounded-pill" id="submitBtn">Simpan</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>

<script src="https://unpkg.com/@zxing/library@latest"></script>

<script>
let stream;
let codeReader;

function openScanner() {
    const qrBox = document.getElementById("qrScanner");
    qrBox.style.display = "block";

    codeReader = new ZXing.BrowserMultiFormatReader();

    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(s => {
            stream = s;

            const video = document.getElementById("cameraPreview");
            video.srcObject = s;
            video.play();

            codeReader.decodeFromVideoDevice(null, "cameraPreview", (result, err) => {
                if (result) {
                    const input = document.getElementById("attributeInput");
                    input.value = result.text;

                    // TRIGGER INPUT EVENT
                    input.dispatchEvent(new Event('input'));

                    closeScanner();
                }
            });
        })
        .catch(err => {
            alert("Tidak bisa mengakses kamera");
            console.error(err);
        });
}

function closeScanner() {
    const qrBox = document.getElementById("qrScanner");
    qrBox.style.display = "none";

    if (stream) {
        stream.getTracks().forEach(t => t.stop());
    }

    if (codeReader) {
        codeReader.reset();
    }
}
</script>

<script>

const autofillUrl = "{{ route('so.autofill') }}";

document.getElementById('attributeInput').addEventListener('input', function () {
    let attr = this.value;
    if (attr.length < 3) return;

    fetch(`${autofillUrl}?attribute=${encodeURIComponent(attr)}`)
        .then(response => response.json())
        .then(data => {
            const warning = document.getElementById("scannerWarning");
            const submitBtn = document.getElementById("submitBtn");

            if (data.status === true) {

                // Autofill field
                document.querySelector('input[name="qty"]').value = data.qty ?? '';
                document.querySelector('input[name="lokasi"]').value = data.lokasi ?? '';
                document.querySelector('input[name="namabarang"]').value = data.namabarang ?? '';
                document.querySelector('textarea[name="keterangan"]').value = data.keterangan ?? '';

                // Cek apakah sudah pernah discan
                if (data.scanner && data.scanner !== "") {
                    warning.style.display = "block";
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = "0.4";
                    submitBtn.style.cursor = "not-allowed";
                } else {
                    warning.style.display = "none";
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = "1";
                    submitBtn.style.cursor = "pointer";
                }

            } else {
                warning.style.display = "none";
                submitBtn.disabled = false;
                submitBtn.style.opacity = "1";
            }
        })
        .catch(err => console.error("Autofill error:", err));
});

</script>





        {{-- <div class="col-12 col-md-3">
            <a href="{{ route('pac.add') }}"
               class="btn btn-primary w-100 rounded-pill py-2">
                <i class="fa fa-plus me-2"></i>New
            </a>
        </div> --}}

        <div class="col-12 col-md-3">
            <!-- Export -->
        <button id="exportExcel" class="btn btn-success mb-3">
           <i class="fa fa-download"></i> Export to Excel
        </button>
        </div>

        <script>
        document.getElementById("exportExcel").addEventListener("click", function () {
            let table = document.getElementById("dataTable");
            let tableHTML = table.outerHTML.replace(/ /g, '%20');

            let filename = "Packing_Report_" + new Date().toISOString().slice(0,10) + ".xls";

            let excelContent = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <meta charset="UTF-8">
                </head>
                <body>
                    ${table.outerHTML}
                </body>
                </html>
            `;

            let blob = new Blob([excelContent], {
                type: "application/vnd.ms-excel"
            });

            let url = URL.createObjectURL(blob);

            let a = document.createElement("a");
            a.href = url;
            a.download = filename;
            a.click();

            URL.revokeObjectURL(url);
        });
        </script>


        <style>
            th.sortable {
                cursor: pointer;
                position: relative;
                user-select: none;
                padding-right: 20px !important;
            }

            /* Icon panah */
            th.sortable::after {
                content: "↕";
                position: absolute;
                right: 5px;
                opacity: 0.3;
                transition: transform 0.3s ease, opacity 0.2s;
            }

            /* Sort ASC */
            th.sortable.asc::after {
                content: "↑";
                opacity: 1;
                transform: translateY(-2px);
            }

            /* Sort DESC */
            th.sortable.desc::after {
                content: "↓";
                opacity: 1;
                transform: translateY(2px);
            }
        </style>

        <!-- Search -->
        <div class="col-12 col-md-6">
            <div class="d-flex w-100">
                <input type="text" id="tableSearch"
                    class="form-control rounded-pill px-3 py-2"
                    placeholder="Cari di tabel...">
                    <button class="btn btn-danger rounded-pill ms-2 px-4 py-2">
                            Search
                    </button>
            </div>
        </div>

       <script>
// ========== SEARCH ==========
document.getElementById("tableSearch").addEventListener("keyup", function () {
    let input = this.value.toLowerCase();
    let rows = document.querySelectorAll("#dataTable tbody tr");

    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(input) ? "" : "none";
    });
});

// ========== SORT ==========
document.addEventListener("DOMContentLoaded", function () {
    let currentSortColumn = -1;
    let sortDirection = true;

    document.querySelectorAll("#dataTable th.sortable").forEach((header, columnIndex) => {
        header.addEventListener("click", () => {
            sortTable(columnIndex, header);
        });
    });

    function sortTable(columnIndex, headerElement) {
        const table = document.getElementById("dataTable");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));

        document.querySelectorAll("th.sortable").forEach(th => th.classList.remove("asc", "desc"));

        if (currentSortColumn === columnIndex) {
            sortDirection = !sortDirection;
        } else {
            sortDirection = true;
        }
        currentSortColumn = columnIndex;

        headerElement.classList.add(sortDirection ? "asc" : "desc");

        rows.sort((a, b) => {
            let A = a.children[columnIndex].innerText.toLowerCase().trim();
            let B = b.children[columnIndex].innerText.toLowerCase().trim();

            let numA = parseFloat(A.replace(/[^0-9.-]/g, ''));
            let numB = parseFloat(B.replace(/[^0-9.-]/g, ''));

            if (!isNaN(numA) && !isNaN(numB)) {
                return sortDirection ? numA - numB : numB - numA;
            }

            return sortDirection ? A.localeCompare(B) : B.localeCompare(A);
        });

        rows.forEach(row => tbody.appendChild(row));
    }
});
</script>


   <!-- BUTTON FILTER -->
<div class="mb-3">
    <button id="btnBelum" class="btn btn-outline-danger rounded-pill px-3">Belum Scan</button>
    <button id="btnSudah" class="btn btn-outline-success rounded-pill px-3">Sudah Scan</button>
</div>

<div class="card">
    <div class="card-header">
        Data Stock | Total <span class="text-danger">{{ $data->count() }}</span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th class="sortable">No</th>
                    <th class="sortable">Date</th>
                    <th class="sortable">KPC</th>
                    <th class="sortable">Barcode</th>
                    <th class="sortable">Nama Barang</th>
                    <th class="sortable">Berat</th>
                    <th class="sortable">Lokasi</th>
                    <th class="col-scan sortable">Scanner</th>

                    <!-- Kolom yang harus hilang di mode Belum Scan -->
                    <th class="col-scan sortable">Berat SO</th>
                    <th class="col-scan sortable">Selisih SO</th>
                    <th class="col-scan sortable">Keterangan</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $d)
                <tr class="{{ $d->scanner ? 'row-sudah' : 'row-belum' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->date }}</td>
                    <td>{{ $d->kpc }}</td>
                    <td>{{ $d->barcode }}</td>
                    <td>{{ $d->namabarang }}</td>
                    <td>{{ $d->berat }}</td>
                    <td>{{ $d->lokasi }}</td>

                    <td class="col-scan">{{ $d->scanner ?? '-' }}</td>
                    <td class="col-scan">{{ $d->scanner ? $d->qty_scan : '-' }}</td>
                    <td class="col-scan">
                        {{ $d->scanner ? ($d->berat - $d->qty_scan) : '-' }}
                    </td>
                    <td class="col-scan">{{ $d->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- JAVASCRIPT SWITCH MODE -->
<script>
// FUNGSI UNTUK MENGAKTIFKAN MODE BELUM
function aktifkanModeBelum() {
    // button style
    document.getElementById("btnBelum").classList.remove("btn-outline-danger");
    document.getElementById("btnBelum").classList.add("btn-danger");
    document.getElementById("btnSudah").classList.remove("btn-success");
    document.getElementById("btnSudah").classList.add("btn-outline-success");

    // hide scan columns
    document.querySelectorAll(".col-scan").forEach(col => col.style.display = "none");

    // show only rows not scanned
    document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "none");
    document.querySelectorAll(".row-belum").forEach(r => r.style.display = "table-row");
}

// klik manual
document.getElementById("btnBelum").addEventListener("click", aktifkanModeBelum);

// AUTO AKTIF SAAT PERTAMA KALI HALAMAN LOAD
window.addEventListener("load", aktifkanModeBelum);
</script>
<script>
document.getElementById("btnBelum").addEventListener("click", function () {
    // button style
    this.classList.remove("btn-outline-danger");
    this.classList.add("btn-danger");
    document.getElementById("btnSudah").classList.remove("btn-success");
    document.getElementById("btnSudah").classList.add("btn-outline-success");

    // hide scan columns
    document.querySelectorAll(".col-scan").forEach(col => col.style.display = "none");

    // show only rows not scanned
    document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "none");
    document.querySelectorAll(".row-belum").forEach(r => r.style.display = "table-row");
});

document.getElementById("btnSudah").addEventListener("click", function () {
    // button style
    this.classList.remove("btn-outline-success");
    this.classList.add("btn-success");
    document.getElementById("btnBelum").classList.remove("btn-danger");
    document.getElementById("btnBelum").classList.add("btn-outline-danger");

    // show scan columns
    document.querySelectorAll(".col-scan").forEach(col => col.style.display = "");

    // show only scanned rows
    document.querySelectorAll(".row-belum").forEach(r => r.style.display = "none");
    document.querySelectorAll(".row-sudah").forEach(r => r.style.display = "table-row");
});
</script>


</div>

@if ($data)

    @foreach ($data as $d)

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded-4">

            <form method="POST" action="{{ route('pac.update', $d->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Edit Laporan {{ $d->id }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Date</label>
                    <input type="datetime-local" name="date" class="form-control rounded-pill"
                            value="{{ $d->date }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Attribute</label>
                    <input type="text" name="attribute" class="form-control rounded-pill"
                            value="{{ $d->attribute }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Group</label>
                    <select name="group" class="form-select rounded-pill">
                        <option value="A" {{ $d->group=='A'?'selected':'' }}>Group A</option>
                        <option value="B" {{ $d->group=='B'?'selected':'' }}>Group B</option>
                        <option value="Lokal" {{ $d->group=='Lokal'?'selected':'' }}>Group Lokal</option>
                    </select>
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Layout</label>
                    <input type="text" name="layout" class="form-control rounded-pill" value="{{ $d->layout }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">No SO</label>
                    <input type="text" name="no_so" class="form-control rounded-pill" value="{{ $d->no_so }}">
                    </div>

                    <div class="col-md-4">
                    <label class="fw-bold mb-1">Kondisi</label>
                    <select name="kondisi" class="form-select rounded-pill">
                        <option value="Baik" {{ $d->kondisi=='Baik'?'selected':'' }}>Baik</option>
                        <option value="Damage Realese QA" {{ $d->kondisi=='Damage Realese QA'?'selected':'' }}>Damage Realese QA</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">PE & VCI</label>
                    <select name="plastik" class="form-select rounded-pill">
                        <option value="OK" {{ $d->plastik=='OK'?'selected':'' }}>OK</option>
                        <option value="Not OK" {{ $d->plastik=='Not OK'?'selected':'' }}>Not OK</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Wrapping</label>
                    <select name="wrapping" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->wrapping=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->wrapping=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Impraboard</label>
                    <select name="impraboard" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->impraboard=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->impraboard=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">ID & OD</label>
                    <select name="idod" class="form-select rounded-pill">
                        <option value="OK" {{ $d->idod=='OK'?'selected':'' }}>OK</option>
                        <option value="Not OK" {{ $d->idod=='Not OK'?'selected':'' }}>Not OK</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Pallet</label>
                    <select name="pallet" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->pallet=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->pallet=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Bandazer</label>
                    <select name="bandazer" class="form-select rounded-pill">
                        <option value="OK" {{ $d->bandazer=='OK'?'selected':'' }}>OK</option>
                        <option value="Not OK" {{ $d->bandazer=='Not OK'?'selected':'' }}>Not OK</option>
                    </select>
                    </div>

                </div>

                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
                </div>

            </form>

            </div>
        </div>
        </div>

    @endforeach

    @foreach ($data as $d)

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

            <form method="POST" action="{{ route('pac.delete', $d->id) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                <p class="fw-bold">Yakin ingin menghapus data ini?</p>
                <p class="text-muted">No SO: {{ $d->no_so }} | Attribute: {{ $d->attribute }}</p>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
                </div>

            </form>

            </div>
        </div>
        </div>
    @endforeach

@else
@endif


{{-- </div> --}}
@endsection
