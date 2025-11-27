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

                    <form action="{{ route('pac.add') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row g-3">

                                <!-- ATTRIBUTE (SCAN / MANUAL) -->
                                <div class="col-md-12">
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

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary rounded-pill">Simpan</button>
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
                                document.getElementById("attributeInput").value = result.text;
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


    </div>

<div class="card">
    <div class="card-header">
        Data Yang belum Ditemukan
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
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @if ($data)
                @foreach ($data as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->date }}</td>
                    <td>{{ $d->attribute }}</td>
                    <td>Group {{ $d->group }}</td>
                    <td>{{ $d->layout }}</td>
                    <td>{{ $d->no_so }}</td>
                    <td>{{ $d->kondisi }}</td>

                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $d->id }}">
                            Edit
                        </button>



                        <!-- Tombol Delete -->
                        <button class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $d->id }}">
                            Delete
                        </button>

                    </td>

                </tr>
                @endforeach



            @endif
        </tbody>
    </table>
</div>
</div>

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
