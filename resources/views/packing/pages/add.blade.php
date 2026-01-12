@extends('packing.layout.main')

@section('title')
    Tambah Laporan Packing
@endsection

@section('content')

<div class="container">

    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="m-0 fw-bold text-dark">
                Tambah Laporan Packing
            </h3>
            <small class="text-muted">Input data packing baru</small>
        </div>
    </div>

    {{-- <div class="position-absolute" style="top: 15px; right: 20px;">
        <div class="form-check form-switch m-0">
            <input class="form-check-input" type="checkbox" id="autoSaveSwitch">
            <label class="form-check-label fw-bold" for="autoSaveSwitch">Auto Save</label>
        </div>
    </div> --}}

    <script>
        document.getElementById('autoSaveSwitch').addEventListener('change', function () {
            if (this.checked) {
                console.log("Auto Save ON");
                // jalankan auto-save setiap 10 detik
                window.autoSaveInterval = setInterval(() => {
                    // panggil ajax save atau submit draft
                    console.log("Auto saving...");
                }, 10000);
            } else {
                console.log("Auto Save OFF");
                clearInterval(window.autoSaveInterval);
            }
        });
    </script>


    <!-- Card Form -->
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <form action="{{ route('pac.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <!-- Date -->
                <div class="col-md-4">
                    <label class="fw-bold mb-1">Date</label>

                    <input type="datetime-local" id="dateInput" name="date"
                        class="form-control rounded-pill px-3 py-2" required>
                </div>


                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const now = new Date();

                        // Format yyyy-MM-ddTHH:mm:ss
                        const formatted = now.toISOString().slice(0,16);

                        document.getElementById("dateInput").value = formatted;
                    });
                </script>


                <!-- Attribute -->
                <div class="col-md-4">
                    <label class="fw-bold mb-1">Attribute</label>

                    <div class="input-group">
                        <input type="text" id="attributeInput" name="attribute"
                            class="form-control rounded-pill px-3 py-2"
                            placeholder="Scan / Input Manual" required>

                        <!-- Ikon QR (button) -->
                        <button type="button" class="btn btn-primary rounded-pill ms-2 px-3"
                                onclick="openScanner()">
                            <i class="fa fa-qrcode"></i>
                        </button>
                    </div>
                    <small id="attrWarning" class="text-danger fw-bold" style="display:none;">Attribute sudah discan.</small>

                    <!-- Area kamera tersembunyi -->
                    <div id="qrScanner" class="mt-2" style="display:none;">
                        <video id="cameraPreview" width="100%" class="rounded" autoplay></video>
                        <button type="button" class="btn btn-danger rounded-pill mt-2 w-100"
                                onclick="closeScanner()">Tutup Kamera</button>
                    </div>
                </div>

                <script src="https://unpkg.com/@zxing/library@latest"></script>

                <script src="https://unpkg.com/@zxing/library@latest"></script>

                <script>
                    const checkAttrUrl = "{{ route('pac.checkAttribute') }}";
                    const attrInput = document.getElementById("attributeInput");
                    const attrWarning = document.getElementById("attrWarning");
                    let attrExists = false;

                    async function checkAttribute(value) {
                        if (!value) {
                            attrExists = false;
                            attrWarning.style.display = "none";
                            return false;
                        }
                        try {
                            const res = await fetch(`${checkAttrUrl}?attribute=${encodeURIComponent(value)}`);
                            const data = await res.json();
                            attrExists = data.exists;
                            attrWarning.style.display = attrExists ? "inline" : "none";
                            return attrExists;
                        } catch (e) {
                            console.error(e);
                            return false;
                        }
                    }

                    attrInput.addEventListener("blur", () => {
                        checkAttribute(attrInput.value.trim());
                    });

                    const addForm = document.querySelector('form');
                    addForm.addEventListener('submit', async (e) => {
                        const exists = await checkAttribute(attrInput.value.trim());
                        if (exists) {
                            e.preventDefault();
                            attrInput.focus();
                            alert("Attribute sudah ada di database, silakan gunakan nilai lain.");
                        }
                    });

                    let stream;
                    let codeReader;

                    function openScanner() {
                        const qrBox = document.getElementById("qrScanner");
                        qrBox.style.display = "block";

                        // Aktifkan decoder untuk QR + Barcode
                        codeReader = new ZXing.BrowserMultiFormatReader();

                        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                            .then(s => {
                                stream = s;

                                const video = document.getElementById("cameraPreview");
                                video.srcObject = s;
                                video.setAttribute("playsinline", true);
                                video.play();

                                // Real-time scanning
                                codeReader.decodeFromVideoDevice(null, "cameraPreview", (result, err) => {
                                    if (result) {
                                        console.log("SCAN:", result.text);

                                        // Isi input otomatis
                                        document.getElementById("attributeInput").value = result.text;

                                        // Tutup scanner
                                        closeScanner();
                                    }
                                });
                            })
                            .catch(err => {
                                alert("Tidak bisa mengakses kamera.");
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

                <!-- Group -->
                <div class="col-md-4">
                    <label class="fw-bold mb-1">Group</label>

                    <select name="group" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Group</option>
                        <option value="A">Group A</option>
                        <option value="B">Group B</option>
                        <option value="Lokal">Group Lokal</option>
                    </select>
                </div>


                <div class="col-md-4">
                    <label class="fw-bold mb-1">Layout Kontainer</label>

                    <div class="position-relative">
                        <button type="button" id="dropdownBtn"
                            class="form-control text-start rounded-pill px-3 py-2 d-flex justify-content-between align-items-center"
                            aria-haspopup="listbox" aria-expanded="false">
                            <span id="dropdownLabel" class="text-muted">Pilih Layout</span>
                            <i class="fa fa-caret-down ms-2"></i>
                        </button>

                        <div id="customDropdown" class="card shadow-sm"
                            style="position:absolute; z-index:2000; width:100%; display:none; max-height:320px; overflow:hidden;">
                            <div class="p-2 border-bottom">
                                <input id="dropdownSearch" class="form-control rounded-pill px-3 py-2"
                                    placeholder="Cari layout atau paste di sini..." autocomplete="off">
                            </div>
                            <div style="max-height:230px; overflow:auto;">
                                <ul id="dropdownList" class="list-group list-group-flush"></ul>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden input -->
                    <input type="hidden" id="layoutValue" name="layout" value="">

                    <!-- Teks Error -->
                    <div id="layoutError" class="text-danger mt-1" style="display:none;">
                        Layout wajib dipilih.
                    </div>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function () {

                    const form = document.querySelector("form");
                    const hidden = document.getElementById("layoutValue");
                    const errorMsg = document.getElementById("layoutError");

                    form.addEventListener("submit", function(e) {
                        if (hidden.value.trim() === "") {
                            e.preventDefault();
                            errorMsg.style.display = "block";  // tampilkan pesan error
                        } else {
                            errorMsg.style.display = "none";   // sembunyikan kalau sudah dipilih
                        }
                    });

                });
                </script>


                    <script>
                        document.addEventListener("DOMContentLoaded", function() {

                        // --- konfigurasi opsi (ganti / ambil dari server jika perlu) ---
                        const items = [];
                        for (let i = 1; i <= 50; i++) items.push("K" + i);
                        // contoh tambahan (bila butuh nama panjang) : items.push("CGL,ELC,CRN03,15T APC Tower");

                        // --- elemen ---
                        const btn = document.getElementById('dropdownBtn');
                        const panel = document.getElementById('customDropdown');
                        const listEl = document.getElementById('dropdownList');
                        const search = document.getElementById('dropdownSearch');
                        const label = document.getElementById('dropdownLabel');
                        const hidden = document.getElementById('layoutValue');

                        // Render semua opsi
                        function renderList(filter = '') {
                            listEl.innerHTML = '';
                            const q = filter.trim().toLowerCase();
                            const filtered = items.filter(it => it.toLowerCase().includes(q));

                            if (filtered.length === 0) {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.textContent = 'Tidak ada hasil';
                            li.style.cursor = 'default';
                            listEl.appendChild(li);
                            return;
                            }

                            filtered.forEach((text, idx) => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.tabIndex = 0;
                            li.dataset.value = text;
                            li.textContent = text;
                            li.addEventListener('click', () => selectItem(text));
                            li.addEventListener('keydown', (e) => {
                                if (e.key === 'Enter') selectItem(text);
                            });
                            listEl.appendChild(li);
                            });
                        }

                        // pilih item
                        function selectItem(value) {
                            hidden.value = value;
                            label.textContent = value;
                            label.classList.remove('text-muted');
                            closePanel();
                        }

                        // buka / tutup panel
                        function openPanel() {
                            panel.style.display = 'block';
                            btn.setAttribute('aria-expanded', 'true');
                            search.focus();
                            // seleksi seluruh teks saat fokus (untuk paste cepat)
                            search.select();
                        }
                        function closePanel() {
                            panel.style.display = 'none';
                            btn.setAttribute('aria-expanded', 'false');
                            search.value = '';
                            renderList(''); // reset
                        }

                        // event tombol
                        btn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            if (panel.style.display === 'block') closePanel(); else openPanel();
                        });

                        // mengetik di search -> filter
                        search.addEventListener('input', function() {
                            renderList(this.value);
                        });

                        // keyboard handling pada panel: arrow keys dan enter memilih item pertama
                        search.addEventListener('keydown', function(e) {
                            const visible = Array.from(listEl.querySelectorAll('.list-group-item')).filter(n => n.style.display !== 'none' && n.dataset.value);
                            if (e.key === 'ArrowDown') {
                            e.preventDefault();
                            if (visible.length) visible[0].focus();
                            } else if (e.key === 'Enter') {
                            e.preventDefault();
                            if (visible.length) selectItem(visible[0].dataset.value);
                            } else if (e.key === 'Escape') {
                            closePanel();
                            }
                        });

                        // allow navigating list items with arrow up/down
                        listEl.addEventListener('keydown', function(e) {
                            const itemsDom = Array.from(listEl.querySelectorAll('.list-group-item')).filter(n => n.dataset.value);
                            const idx = itemsDom.indexOf(document.activeElement);
                            if (e.key === 'ArrowDown') {
                            e.preventDefault();
                            const next = itemsDom[idx+1] || itemsDom[0];
                            next && next.focus();
                            } else if (e.key === 'ArrowUp') {
                            e.preventDefault();
                            const prev = itemsDom[idx-1] || itemsDom[itemsDom.length-1];
                            prev && prev.focus();
                            } else if (e.key === 'Escape') {
                            closePanel();
                            btn.focus();
                            }
                        });

                        // close when clicking outside
                        document.addEventListener('click', function(ev) {
                            if (!panel.contains(ev.target) && !btn.contains(ev.target)) closePanel();
                        });

                        // init render
                        renderList('');

                        // optional: if you want the dropdown to auto-open when user types while focused on page:
                        // document.addEventListener('keydown', function(e) {
                        //   if (e.key.length === 1 && !e.ctrlKey && !e.metaKey && panel.style.display !== 'block') openPanel();
                        // });

                        });
                </script>


                <!-- No SO -->
                <div class="col-md-4">
                    <label class="fw-bold mb-1">No Sales Order/Customer</label>
                    <input type="text" name="no_so" class="form-control rounded-pill px-3 py-2" placeholder="Nomor SO" required>
                </div>

                <!-- Kondisi -->
                <div class="col-md-4">
                    <label class="fw-bold mb-1">Kondisi Coil</label>

                    <select name="kondisi" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Baik">Baik</option>
                        <option value="Damage Realese QA">Damage Realese QA</option>
                    </select>
                </div>

                <!-- PE & VCI -->
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Plastik PE & VCI</label>
                    <select name="plastik" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>

                <!-- Wrapping -->
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Plastik Wrapping</label>
                    <select name="wrapping" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Pakai">Pakai</option>
                        <option value="Tidak Pakai">Tidak Pakai</option>
                    </select>
                </div>

                <!-- Impraboard -->
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Impraboard</label>
                    <select name="impraboard" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Pakai">Pakai</option>
                        <option value="Tidak Pakai">Tidak Pakai</option>
                    </select>
                </div>

                <!-- ID & OD -->
                <div class="col-md-6">
                    <label class="fw-bold mb-1">ID & OD</label>
                    <select name="idod" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>

                <!-- Pallet -->
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Pallet</label>
                    <select name="pallet" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Pakai">Pakai</option>
                        <option value="Tidak Pakai">Tidak Pakai</option>
                    </select>
                </div>

                <!-- Ikatan -->
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Ikatan Bandazer</label>
                     <select name="bandazer" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="OK">OK</option>
                        <option value="Not OK">Not OK</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Label</label>
                     <select name="label" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Tidak Lengkap">Tidak Lengkap</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Plat Inner</label>
                     <select name="inner" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Pakai">Pakai</option>
                        <option value="Tidak Pakai">Tidak Pakai</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold mb-1">Plat Outer</label>
                    <select name="outer" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Pakai">Pakai</option>
                        <option value="Tidak Pakai">Tidak Pakai</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold mb-1">Inner Protector</label>
                    <select name="inerprotector" class="form-select rounded-pill px-3 py-2" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="Tidak Pakai">Tidak Pakai</option>
                        <option value="Steel Ring">Steel Ring</option>
                        <option value="Duplek">Duplek</option>
                        <option value="Steel Sleeve">Steel Sleve</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="fw-bold mb-1">Lainnya</label>
                    <textarea name="lainnya" class="form-control rounded-4 px-3 py-2" rows="4"
                        placeholder="Isi keterangan lainnya di sini..."></textarea>
                </div>

            </div>

            <!-- Buttons -->
            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('pac') }}" class="btn btn-light border rounded-pill px-4 py-2">Kembali</a>

                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2">
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>

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


<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



@endsection
