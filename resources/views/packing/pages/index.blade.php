@extends('packing.layout.main')
@section('title')
    Laporan Packing
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
            <h3 class="m-0 fw-bold text-dark">Laporan Packing</h3>
        </div>
    </div>
    <!-- Action Buttons + Search -->
    <div class="row g-3 mb-3">

        <!-- New -->
        <div class="col-12 col-md-3">
            <a href="{{ route('pac.add') }}"
               class="btn btn-primary w-100 rounded-pill py-2">
                <i class="fa fa-plus me-2"></i>New
            </a>
        </div>

        <div class="col-12 col-md-3">
    <!-- Export -->
            <div class="dropdown mb-3">
            <button class="btn btn-success dropdown-toggle" type="button" id="exportMenu" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-download"></i> Export
            </button>

            <ul class="dropdown-menu" aria-labelledby="exportMenu">
                <li>
                    <a class="dropdown-item" href="#" id="exportExcelBtn">
                        <i class="fa fa-file-excel-o text-success"></i> Export to Excel
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" id="exportPdfBtn">
                        <i class="fa fa-file-pdf-o text-danger"></i> Export to PDF
                    </a>
                </li>
            </ul>
        </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>


<script>
document.getElementById("exportExcelBtn").addEventListener("click", function () {

    let table = document.getElementById("dataTable");

    let ws = XLSX.utils.table_to_sheet(table);

    // Hapus kolom ACTION
    let range = XLSX.utils.decode_range(ws["!ref"]);
    for (let R = range.s.r; R <= range.e.r; R++) {
        let addr = XLSX.utils.encode_cell({ r: R, c: range.e.c });
        delete ws[addr];
    }
    range.e.c--;
    ws["!ref"] = XLSX.utils.encode_range(range);

    // Geser isi tabel ke bawah 2 baris
    let newData = {};
    Object.keys(ws).forEach(key => {
        if (key[0] === "!") return;

        let cell = XLSX.utils.decode_cell(key);
        let newKey = XLSX.utils.encode_cell({ r: cell.r + 2, c: cell.c });

        newData[newKey] = ws[key];
    });

    ws = newData;

    let lastCol = range.e.c;
    let lastColLetter = XLSX.utils.encode_col(lastCol);

    // HEADER 2 BARIS
    ws["A1"] = { t: "s", v: "FORM CEK LIST & LAPORAN PACKING" };
    ws["A2"] = { t: "s", v: "" };
    ws[lastColLetter + "2"] = { t: "s", v: "FM.WH.21.00" };

    ws["!ref"] = `A1:${lastColLetter}${range.e.r + 3}`;

    ws["!merges"] = [
        { s: { r: 0, c: 0 }, e: { r: 0, c: lastCol } },
        { s: { r: 1, c: 0 }, e: { r: 1, c: lastCol - 1 } }
    ];

    // STYLING BORDER & FONT
    ws["!cols"] = [];

    let totalRows = range.e.r + 3;
    let totalCols = lastCol + 1;

    for (let c = 0; c < totalCols; c++) {
        let th = table.querySelectorAll("thead th")[c];
        let px = th ? th.offsetWidth : 100;
        ws["!cols"].push({ wch: Math.floor(px / 7) });
    }

    for (let R = 0; R < totalRows; R++) {
        for (let C = 0; C < totalCols; C++) {

            let addr = XLSX.utils.encode_cell({ r: R, c: C });
            let cell = ws[addr];
            if (!cell) continue;

            cell.s = {
                font: { name: "Calibri", sz: (R === 0 ? 14 : 12), bold: (R <= 2) },
                alignment: {
                    horizontal: "center",
                    vertical: "center"
                },
                border: {
                    top: { style: "thin", color: { rgb: "000000" } },
                    bottom: { style: "thin", color: { rgb: "000000" } },
                    left: { style: "thin", color: { rgb: "000000" } },
                    right: { style: "thin", color: { rgb: "000000" } }
                }
            };

            if (R === 2) {
                cell.s.fill = {
                    patternType: "solid",
                    fgColor: { rgb: "BFBFBF" }
                };
            }

            if (R === 0) {
                cell.s.alignment.horizontal = "center";
            }
        }
    }

    let wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Laporan Packing");

    let today = new Date().toISOString().slice(0,10);
    let filename = `FM.21.00 FORM CEK LIST & LAPORAN PACKING - ${today}.xlsx`;

    XLSX.writeFile(wb, filename);
});


// ===============================
// ===== EXPORT PDF SYSTEM =======
// ===============================

document.getElementById("exportPdfBtn").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;

    let doc = new jsPDF('l', 'mm', 'a4');

    let today = new Date().toISOString().slice(0,10);
    let filename = `FM.21.00 FORM CEK LIST & LAPORAN PACKING - ${today}.pdf`;

    // HEADER PDF
    doc.setFontSize(14);
    doc.text("FORM CEK LIST & LAPORAN PACKING", 148, 15, { align: "center" });

    doc.setFontSize(10);
    doc.text("FM.WH.21.00", 280, 15, { align: "right" });

    // Tabel
    let table = document.getElementById("dataTable");
    let headers = [...table.querySelectorAll("thead th")].map(th => th.innerText);
    headers.pop(); // hapus kolom action

    let body = [];
    table.querySelectorAll("tbody tr").forEach(tr => {
        let row = [...tr.querySelectorAll("td")].map(td => td.innerText);
        row.pop();
        body.push(row);
    });

    // ★ BATASI MAKSIMAL 15 DATA
    body = body.slice(0, 15);

    doc.autoTable({
        head: [headers],
        body: body,
        startY: 25,
        styles: {
            fontSize: 8,
            cellPadding: 2
        },
        headStyles: {
            fillColor: [200, 200, 200],
            textColor: 0,
            halign: 'center'
        },
        theme: 'grid'
    });

    doc.save(filename);
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
<style>
    #dataTable thead th {
        position: sticky;
        top: 0;
        background: #fff; /* atau #f8f9fa agar cocok dengan bootstrap */
        z-index: 10;
    }

    /* Untuk scroll hanya di body tabel */
    .table-responsive {
        max-height: 500px; /* sesuaikan */
        overflow-y: auto;
    }

    .table-wrapper {
    overflow-x: hidden;
    overflow-y: auto;
}
#dataTable thead th {
    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
}


</style>




<!-- SCROLLBAR ATAS -->
<div id="scrollTop" style="overflow-x: auto; overflow-y: hidden; height: 16px;">
    <div id="scrollTopInner"></div>
</div>

<!-- TABEL ASLI -->
<div id="scrollBottom" style="max-height: 500px; overflow: auto;">
    <table class="table table-striped" id="dataTable">
        <thead>
            <tr>
                <th class="sortable">No</th>
                <th class="sortable">Date</th>
                <th class="sortable">Attribute</th>
                <th class="sortable">Group</th>
                <th class="sortable">Layout</th>
                <th class="sortable">No Sales Order/Customer</th>
                <th class="sortable">Kondisi Coil</th>
                <th class="sortable">Plastik PE & VCI</th>
                <th class="sortable">Wrapping</th>
                <th class="sortable">Impraboard</th>
                <th class="sortable">ID & OD</th>
                <th class="sortable">Pallet</th>
                <th class="sortable">Ikatan Bandazer</th>
                <th class="sortable">Label</th>
                <th class="sortable">Plat Inner</th>
                <th class="sortable">Plat Outer</th>
                <th class="sortable">Lainnya</th>
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
                    <td>{{ $d->plastik }}</td>
                    <td>{{ $d->wrapping }}</td>
                    <td>{{ $d->impraboard }}</td>
                    <td>{{ $d->idod }}</td>
                    <td>{{ $d->pallet }}</td>
                    <td>{{ $d->bandazer }}</td>
                    <td>{{ $d->label }}</td>
                    <td>{{ $d->inner }}</td>
                    <td>{{ $d->outer }}</td>
                    <td>{{ $d->lainnya }}</td>
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

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">label</label>
                    <select name="label" class="form-select rounded-pill">
                        <option value="Lengkap" {{ $d->label=='Lengkap'?'selected':'' }}>Lengkap</option>
                        <option value="Tidak Lengkap" {{ $d->label=='Tidak Lengkap'?'selected':'' }}>Tidak Lengkap</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Plat Inner</label>
                    <select name="inner" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->inner=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->inner=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label class="fw-bold mb-1">Plat Outer</label>
                    <select name="outer" class="form-select rounded-pill">
                        <option value="Pakai" {{ $d->outer=='Pakai'?'selected':'' }}>Pakai</option>
                        <option value="Tidak Pakai" {{ $d->outer=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold mb-1">Lainnya</label>
                        <textarea name="lainnya" class="form-control rounded-4 px-3 py-2"
                            rows="4">{{ $d->lainnya }}</textarea>
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

<script>
    const scrollTop = document.getElementById("scrollTop");
    const scrollTopInner = document.getElementById("scrollTopInner");
    const scrollBottom = document.getElementById("scrollBottom");

    function syncWidth() {
        scrollTopInner.style.width = scrollBottom.scrollWidth + "px";
    }

    window.addEventListener("load", syncWidth);
    window.addEventListener("resize", syncWidth);

    scrollTop.addEventListener("scroll", () => {
        scrollBottom.scrollLeft = scrollTop.scrollLeft;
    });

    scrollBottom.addEventListener("scroll", () => {
        scrollTop.scrollLeft = scrollBottom.scrollLeft;
    });
</script>

{{-- </div> --}}
@endsection
