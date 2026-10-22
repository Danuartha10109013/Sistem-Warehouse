@extends('packing_list_2.layout.V_template')

@section('title', 'Tempel Data Excel - Packing List 2.0')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Page Info -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h4 class="fw-bolder mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Tempel Data dari Excel</h4>
                <div class="text-muted" style="font-size: 14px;">
                    Home <span class="mx-1">/</span> Packing List 2.0 <span class="mx-1">/</span> Tempel Data
                </div>
            </div>
            <a href="{{ route('packing-list-2.dashboard') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
                <i class="ti ti-arrow-left fs-5"></i>
                <span>Kembali ke Daftar Batch</span>
            </a>
        </div>
    </div>

    <!-- Step 1: Textarea Input Section -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 26px; height: 26px; font-size: 13px;">1</span>
                <h5 class="fw-bold mb-0 text-dark">Salin & Tempel Data (Ctrl + V)</h5>
            </div>
            <p class="text-muted mb-3" style="font-size: 13px;">
                Salin baris data langsung dari Microsoft Excel atau Spreadsheet lalu tempelkan ke area teks di bawah. Pastikan urutan 13 kolom:
                <br>
                <code class="fw-semibold text-primary" style="font-size: 12px;">Code Product &bull; Product Name &bull; <span class="badge bg-success-subtle text-success">Quantity</span> &bull; Unit &bull; <span class="badge bg-success-subtle text-success">Attribute</span> &bull; Storagen Bin &bull; Production &bull; No. SO &bull; <span class="badge bg-success-subtle text-success">Length</span> &bull; Time Scan &bull; Condition &bull; Loc &bull; Ket</code>
            </p>

            <div class="mb-3">
                <textarea id="rawTextarea" class="form-control font-monospace" rows="8" placeholder="Contoh satu baris data:
CPXC0431056165G35CL2-1008	0.43 x 1056mm AZ165 G350 CL2 NEXALUME® Clear Resin-1008	3,774	Kilogram	G1L26124353	WH-L03-BJ EXP (6-6-6)	12/10/2026	SOX26-26029	1,020	10/16/2026 8:40:47	BAIK	SDG	T 26" style="font-size: 12.5px; border-radius: 10px; border-color: #cbd5e1;"></textarea>
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <button type="button" class="btn btn-outline-danger btn-sm" id="btnReset" style="border-radius: 8px;">
                    <i class="ti ti-trash me-1"></i> Bersihkan Area Teks
                </button>
                <button type="button" class="btn btn-primary px-4 py-2 d-flex align-items-center gap-2" id="btnParse" style="border-radius: 8px; font-weight: 600;">
                    <i class="ti ti-table-options fs-5"></i>
                    <span>Urai Data & Tampilkan Preview</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 2: Interactive Preview Section (Hidden until parsed) -->
    <div id="previewSection" style="display: none;">
        <!-- Status Summary Alert -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 26px; height: 26px; font-size: 13px;">2</span>
                        <h5 class="fw-bold mb-0 text-dark">Pratinjau Data (Preview)</h5>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark border px-3 py-2 fw-semibold" style="font-size: 13px;">
                            Total: <strong id="sumTotal">0</strong> Baris
                        </span>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fw-semibold" style="font-size: 13px;">
                            Valid: <strong id="sumValid">0</strong>
                        </span>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 fw-semibold" style="font-size: 13px;">
                            Bermasalah: <strong id="sumInvalid">0</strong>
                        </span>
                    </div>
                </div>

                <div id="validationBanner" class="alert py-2 px-3 mb-0" style="border-radius: 8px; font-size: 13.5px;"></div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Tabel Hasil Penguraian</h6>
                        <small class="text-muted">Kolom bertanda <span class="badge bg-success-subtle text-success border border-success-subtle py-0 px-1">HIJAU</span> adalah target checklist validasi di mobile scanner.</small>
                    </div>
                    <div class="text-muted" style="font-size: 12px;">
                        <i class="ti ti-info-circle me-1"></i> Klik pada teks kolom untuk mengedit
                    </div>
                </div>

                <div class="table-responsive" style="max-height: 520px; overflow-y: auto;">
                    <table class="table table-bordered table-hover align-middle mb-0" id="previewTable" style="font-size: 12.5px;">
                        <thead class="table-light sticky-top" style="z-index: 5;">
                            <tr class="text-nowrap text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                                <th style="width: 45px;" class="text-center">No</th>
                                <th style="width: 120px;">Status</th>
                                <th style="min-width: 140px;">Code Product</th>
                                <th style="min-width: 220px;">Product Name</th>
                                <th style="min-width: 100px; background-color: #dcfce7; color: #166534;" class="border-success-subtle text-center">
                                    <i class="ti ti-check-circle me-1"></i>Quantity
                                </th>
                                <th style="min-width: 80px;">Unit</th>
                                <th style="min-width: 130px; background-color: #dcfce7; color: #166534;" class="border-success-subtle text-center">
                                    <i class="ti ti-scan me-1"></i>Attribute
                                </th>
                                <th style="min-width: 130px;">Storagen Bin</th>
                                <th style="min-width: 100px;">Production</th>
                                <th style="min-width: 110px;">No. SO</th>
                                <th style="min-width: 100px; background-color: #dcfce7; color: #166534;" class="border-success-subtle text-center">
                                    <i class="ti ti-check-circle me-1"></i>Length
                                </th>
                                <th style="min-width: 140px;">Time Scan</th>
                                <th style="min-width: 90px;">Condition</th>
                                <th style="min-width: 80px;">Loc</th>
                                <th style="min-width: 90px;">Ket</th>
                                <th style="width: 50px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="previewTbody">
                            <!-- Diisi via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Step 3: Save Batch Form -->
                <div class="mt-4 pt-3 border-top">
                    <div class="row align-items-end g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-dark mb-1" style="font-size: 13px;">Catatan Batch (Opsional)</label>
                            <input type="text" id="catatanBatch" class="form-control" placeholder="Contoh: Penerimaan Koil Shift Pagi / Surat Jalan SOX26-26029" style="border-radius: 8px;">
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button type="button" class="btn btn-success px-4 py-2 w-100 w-md-auto d-inline-flex align-items-center justify-content-center gap-2" id="btnSaveBatch" disabled style="border-radius: 8px; font-weight: 700; height: 42px;">
                                <i class="ti ti-device-floppy fs-5"></i>
                                <span>Simpan Batch (0 Item)</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentRows = [];

    // Tombol Urai Data
    document.getElementById('btnParse').addEventListener('click', function() {
        const text = document.getElementById('rawTextarea').value.trim();
        if (!text) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Masih Kosong',
                text: 'Silakan tempelkan (Ctrl+V) baris teks dari Excel terlebih dahulu.',
                confirmButtonText: 'Tutup',
                customClass: { confirmButton: 'btn btn-primary' }
            });
            return;
        }

        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengurai Data...';

        fetch("{{ route('packing-list-2.parse-preview') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ raw_text: text })
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="ti ti-table-options fs-5"></i><span>Urai Data & Tampilkan Preview</span>';

            if (data.total_rows === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Ada Data Terbaca',
                    text: data.message || 'Pastikan baris data tidak kosong.',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            currentRows = data.rows || [];
            renderPreviewTable();
            document.getElementById('previewSection').style.display = 'block';
            document.getElementById('previewSection').scrollIntoView({ behavior: 'smooth' });
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<i class="ti ti-table-options fs-5"></i><span>Urai Data & Tampilkan Preview</span>';
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mengurai Data',
                text: 'Terjadi kesalahan sistem saat parsing. Periksa konsol browser.',
                confirmButtonText: 'Tutup'
            });
            console.error(err);
        });
    });

    // Tombol Bersihkan Textarea
    document.getElementById('btnReset').addEventListener('click', function() {
        document.getElementById('rawTextarea').value = '';
        currentRows = [];
        document.getElementById('previewSection').style.display = 'none';
    });

    // Render Tabel Preview
    function renderPreviewTable() {
        const tbody = document.getElementById('previewTbody');
        tbody.innerHTML = '';

        let validCount = 0;
        let invalidCount = 0;

        currentRows.forEach((r, idx) => {
            const tr = document.createElement('tr');
            if (!r.is_valid) {
                tr.classList.add('table-danger');
                invalidCount++;
            } else {
                validCount++;
            }

            const errorHtml = r.errors && r.errors.length > 0 
                ? `<div class="mt-1 text-danger fw-semibold" style="font-size: 11px;">${r.errors.join('<br>')}</div>`
                : '';

            const statusBadge = r.is_valid
                ? `<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1"><i class="ti ti-check me-1"></i>Valid</span>`
                : `<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1"><i class="ti ti-alert-circle me-1"></i>Error</span>`;

            tr.innerHTML = `
                <td class="text-center text-muted fw-bold">${idx + 1}</td>
                <td>
                    ${statusBadge}
                    ${errorHtml}
                </td>
                <td contenteditable="true" data-field="kode" data-idx="${idx}">${escapeHtml(r.kode || '')}</td>
                <td contenteditable="true" data-field="nama_produk" data-idx="${idx}">${escapeHtml(r.nama_produk || '')}</td>
                <td contenteditable="true" data-field="qty" data-idx="${idx}" class="text-end fw-bold" style="background-color: #f0fdf4; color: #166534;">${escapeHtml(String(r.qty || ''))}</td>
                <td contenteditable="true" data-field="uom" data-idx="${idx}">${escapeHtml(r.uom || '')}</td>
                <td contenteditable="true" data-field="no_coil" data-idx="${idx}" class="fw-bold font-monospace" style="background-color: #f0fdf4; color: #166534;">${escapeHtml(r.no_coil || '')}</td>
                <td contenteditable="true" data-field="storage_bin" data-idx="${idx}">${escapeHtml(r.storage_bin || '')}</td>
                <td contenteditable="true" data-field="tanggal_display" data-idx="${idx}">${escapeHtml(r.tanggal_display || '')}</td>
                <td contenteditable="true" data-field="pengirim" data-idx="${idx}">${escapeHtml(r.pengirim || '')}</td>
                <td contenteditable="true" data-field="panjang" data-idx="${idx}" class="text-end fw-bold" style="background-color: #f0fdf4; color: #166534;">${escapeHtml(String(r.panjang || ''))}</td>
                <td contenteditable="true" data-field="time_display" data-idx="${idx}">${escapeHtml(r.time_display || '')}</td>
                <td contenteditable="true" data-field="kondisi" data-idx="${idx}">${escapeHtml(r.kondisi || '')}</td>
                <td contenteditable="true" data-field="tujuan" data-idx="${idx}">${escapeHtml(r.tujuan || '')}</td>
                <td contenteditable="true" data-field="keterangan" data-idx="${idx}">${escapeHtml(r.keterangan || '')}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger p-1" onclick="deleteRow(${idx})" title="Hapus Baris">
                        <i class="ti ti-trash"></i>
                    </button>
                </td>
            `;

            tbody.appendChild(tr);
        });

        // Update Ringkasan Counter
        document.getElementById('sumTotal').innerText = currentRows.length;
        document.getElementById('sumValid').innerText = validCount;
        document.getElementById('sumInvalid').innerText = invalidCount;

        const banner = document.getElementById('validationBanner');
        const saveBtn = document.getElementById('btnSaveBatch');

        if (currentRows.length === 0) {
            banner.className = 'alert alert-secondary py-2 px-3 mb-0';
            banner.innerHTML = '<i class="ti ti-info-circle me-1"></i> Tidak ada baris data.';
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="ti ti-device-floppy fs-5"></i><span>Simpan Batch (0 Item)</span>';
        } else if (invalidCount > 0) {
            banner.className = 'alert alert-danger py-2 px-3 mb-0';
            banner.innerHTML = `<i class="ti ti-alert-triangle me-1"></i> Terdapat <strong>${invalidCount}</strong> baris yang bermasalah. Perbaiki sel yang salah atau klik ikon sampah untuk menghapus baris tersebut.`;
            saveBtn.disabled = true;
            saveBtn.innerHTML = `<i class="ti ti-device-floppy fs-5"></i><span>Perbaiki Data (${validCount}/${currentRows.length} Valid)</span>`;
        } else {
            banner.className = 'alert alert-success py-2 px-3 mb-0';
            banner.innerHTML = `<i class="ti ti-circle-check me-1"></i> Semua <strong>${validCount}</strong> baris valid dan siap disimpan ke sistem.`;
            saveBtn.disabled = false;
            saveBtn.innerHTML = `<i class="ti ti-device-floppy fs-5"></i><span>Simpan Batch (${validCount} Item)</span>`;
        }
    }

    // Event listener untuk pengeditan inline contenteditable
    document.getElementById('previewTbody').addEventListener('blur', function(e) {
        if (e.target && e.target.hasAttribute('contenteditable')) {
            const field = e.target.getAttribute('data-field');
            const idx = parseInt(e.target.getAttribute('data-idx'));
            const newVal = e.target.innerText.trim();

            if (currentRows[idx]) {
                currentRows[idx][field] = newVal;
                // Jika tanggal atau time diedit, sinkronkan juga raw
                if (field === 'tanggal_display') currentRows[idx]['tanggal'] = newVal;
                if (field === 'time_display') currentRows[idx]['time'] = newVal;

                // Validasi ulang lokal sederhana
                validateLocalRows();
            }
        }
    }, true);

    // Hapus baris dari preview
    window.deleteRow = function(idx) {
        currentRows.splice(idx, 1);
        validateLocalRows();
    };

    // Helper parsing angka untuk format Indonesia (1.017) dan format US (1,017)
    function parseJsNumber(val) {
        if (val === null || val === undefined) return NaN;
        let s = String(val).trim().replace(/\s+/g, '');
        if (!s) return NaN;

        if (s.indexOf('.') !== -1 && s.indexOf(',') !== -1) {
            if (s.lastIndexOf(',') > s.lastIndexOf('.')) {
                s = s.replace(/\./g, '').replace(/,/g, '.');
            } else {
                s = s.replace(/,/g, '');
            }
        } else if (s.indexOf('.') !== -1) {
            if (/^\d{1,3}(\.\d{3})+$/.test(s)) {
                s = s.replace(/\./g, '');
            }
        } else if (s.indexOf(',') !== -1) {
            if (/^\d{1,3}(,\d{3})+$/.test(s)) {
                s = s.replace(/,/g, '');
            } else {
                s = s.replace(/,/g, '.');
            }
        }

        return parseFloat(s);
    }

    // Validasi ulang client-side saat sel diedit atau baris dihapus
    function validateLocalRows() {
        currentRows.forEach((r, idx) => {
            const errors = [];
            if (!r.kode) errors.push("KODE kosong.");
            if (!r.nama_produk) errors.push("NAMA PRODUK kosong.");

            const q = parseJsNumber(r.qty);
            if (isNaN(q) || q <= 0) errors.push("QTY harus > 0.");
            else r.qty = q;

            if (!r.uom) errors.push("UOM kosong.");

            // NO COIL wajib diisi, nomor koil sama diperbolehkan
            if (!r.no_coil) {
                errors.push("NO COIL kosong.");
            }

            const p = parseJsNumber(r.panjang);
            if (isNaN(p) || p <= 0) errors.push("PANJANG harus > 0.");
            else r.panjang = p;

            if (!r.kondisi) errors.push("KONDISI kosong.");
            if (!r.tujuan) errors.push("TUJUAN kosong.");

            // Cek format tanggal sederhana dd/mm/yyyy atau yyyy-mm-dd
            const tgl = r.tanggal_display || r.tanggal;
            if (!tgl) errors.push("TANGGAL kosong.");

            const tm = r.time_display || r.time;
            if (!tm) errors.push("TIME kosong.");

            r.errors = errors;
            r.is_valid = errors.length === 0;
        });

        renderPreviewTable();
    }

    // Tombol Simpan Batch
    document.getElementById('btnSaveBatch').addEventListener('click', function() {
        if (currentRows.length === 0) return;

        const invalidRows = currentRows.filter(r => !r.is_valid);
        if (invalidRows.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Data Belum Valid',
                text: 'Harap perbaiki atau hapus semua baris yang bermasalah terlebih dahulu.'
            });
            return;
        }

        const catatan = document.getElementById('catatanBatch').value.trim();

        Swal.fire({
            title: 'Simpan Batch?',
            text: `Akan menyimpan 1 batch dengan ${currentRows.length} item koil baru berstatus MENUNGGU_VALIDASI.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-primary px-4 me-2',
                cancelButton: 'btn btn-light px-4 border'
            },
            buttonsStyling: false
        }).then(result => {
            if (result.isConfirmed) {
                // Tampilkan loading
                Swal.fire({
                    title: 'Menyimpan Data...',
                    text: 'Mohon tunggu, sistem sedang memverifikasi transaksi database.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Siapkan payload data
                const payload = {
                    catatan: catatan,
                    items: currentRows.map(r => ({
                        kode: r.kode,
                        nama_produk: r.nama_produk,
                        qty: r.qty,
                        uom: r.uom,
                        no_coil: r.no_coil,
                        storage_bin: r.storage_bin,
                        tanggal: r.tanggal || r.tanggal_display,
                        pengirim: r.pengirim,
                        panjang: r.panjang,
                        time: r.time || r.time_display,
                        kondisi: r.kondisi,
                        tujuan: r.tujuan,
                        keterangan: r.keterangan
                    }))
                };

                fetch("{{ route('packing-list-2.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Batch Berhasil Disimpan!',
                            text: data.message,
                            confirmButtonText: 'Lihat Detail Batch',
                            customClass: { confirmButton: 'btn btn-primary px-4' }
                        }).then(() => {
                            window.location.href = data.redirect || "{{ route('packing-list-2.dashboard') }}";
                        });
                    } else {
                        let errDetail = data.message || 'Terjadi kesalahan.';
                        if (data.errors && data.errors.length > 0) {
                            errDetail += '<br><small class="text-danger">' + data.errors.slice(0, 5).join('<br>') + (data.errors.length > 5 ? '<br>...dan lainnya' : '') + '</small>';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            html: errDetail
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Sistem',
                        text: 'Gagal menghubungi server. Periksa koneksi atau konsol.'
                    });
                    console.error(err);
                });
            }
        });
    });

    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
</script>
@endpush
