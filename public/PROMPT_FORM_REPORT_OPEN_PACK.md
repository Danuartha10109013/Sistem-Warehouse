# PROMPT: Build Form Input — Modul Report Open Pack

## 0. Konteks Proyek
Saya sedang mengembangkan aplikasi Laravel dengan arsitektur multi-modul (mengikuti pola sistem OHE yang sudah ada):
- Framework: **Laravel** + **Livewire** (reactive component) + **Tailwind CSS**
- Konvensi penamaan custom: `M_` untuk Model, `C_` untuk Controller, `V_` untuk View
- Namespacing per modul, contoh: `App\Models\OpenPack\`
- Modul yang sedang dikerjakan: **Report Open Pack** — template dan halaman utamanya **sudah ada**. Yang perlu dibuat sekarang adalah **form inputan (input form)** untuk mengisi data inspeksi open pack, mengikuti struktur pada draft form terlampir (`DRAFT_FORM_INSPEKSI_OPEN_PACK.docx`), plus fitur **export ke PDF** dengan layout yang sama seperti dokumen Word tersebut.

Tolong buatkan implementasi lengkap (migration, model, Livewire component, view/blade, validasi, dan service export PDF) untuk kebutuhan di bawah ini.

---

## 1. Struktur Form

### A. Informasi Umum
Field-field berikut diambil otomatis dari modul **Formcheck Kedatangan Material** (form checklist kedatangan material yang sudah ada di sistem — sesuaikan nama tabel/model/relasi dengan yang sebenarnya ada di database, saya beri placeholder di bawah):

| Field | Sumber | Perilaku |
|---|---|---|
| Tanggal Kedatangan | `formcheck.tanggal_kedatangan` | Auto-fill (read-only), terisi setelah Attribute dipilih |
| Nomor Surat Jalan | `formcheck.nomor_surat_jalan` | Auto-fill (read-only) |
| Nomor Supplier (nomor coil) | `formcheck.nomor_coil_supplier` | Auto-fill (read-only) |
| **Attribute** | `formcheck.attribute` (format `CR_xx_xx-xxx`, contoh: `CR_B_26-115396`) | **Search key** — input dengan autocomplete/typeahead ala search bar Google: user mengetik, muncul daftar rekomendasi/saran dari data Formcheck yang cocok (searchable dropdown), lalu saat dipilih men-trigger auto-fill seluruh field lain di section ini |
| Supplier | `formcheck.nama_supplier` | Auto-fill (read-only) |
| Tanggal Open Pack | `now()` | Otomatis terisi tanggal hari ini saat form dibuka, tidak bisa diedit |
| Grup | — | Pilihan ganda (radio/select): **A / B / C / D** |

**Behavior yang diminta:**
1. Field "Attribute" adalah **live search / typeahead** (bisa pakai Livewire `wire:model.live` + debounce, query ke tabel Formcheck `WHERE attribute LIKE '%...%'`, tampilkan max ±10 hasil sebagai dropdown suggestion).
2. Saat salah satu hasil suggestion diklik/dipilih → otomatis fetch 1 record Formcheck terkait dan isi field Tanggal Kedatangan, Nomor Surat Jalan, Nomor Supplier, dan Supplier (read-only, non-editable oleh user).
3. Jika Attribute belum dipilih, field lain di section A tetap kosong/disabled.
4. Tanggal Open Pack selalu `today()`, tidak perlu dan tidak boleh diinput manual.

### B. Kondisi Awal (CRC sebelum Open Pack)
- Pilihan radio: **OK** / **Not Good**
  - OK = Packing tidak ada sobek, ID/OD tidak ada penyok
  - Not Good = Packing sobek (indikasi damaged), ID/OD penyok/rusak
- **Jika "Not Good" dipilih** → wajib muncul upload foto CRC sebelum open pack (**WS** dan **DS**, keduanya **wajib**)
- **Temuan Ketidaksesuaian (opsional, hanya tampil jika ditemukan)**: upload foto ketidaksesuaian (Packing sobek, ID/OD penyok) — field ini hanya wajib diisi jika user menandai ada temuan; jika tidak ada temuan, field ini disembunyikan/tidak wajib

### C. Kondisi Setelah dilakukan Open Pack
- Pilihan radio: **OK** / **Not Good**
  - OK = Tidak ada sobek, tidak ada penyok, tidak ada karat
  - Not Good = Sidewall ada sobekan/damaged, ID/OD coil damaged, surface karat
- **Jika "Not Good" dipilih**, munculkan blok **"Kriteria dokumentasi jika kondisi NG"** berisi 4 upload foto, **semua wajib**:
  1. Dokumentasi Sidewall WS CRC (kondisi VCI supplier masih di bawah CRC)
  2. Dokumentasi Sidewall DS CRC (kondisi VCI supplier masih di bawah CRC)
  3. Dokumentasi Bagian bawah CRC (potensi dent dari palet/baut kontainer)
  4. Dokumentasi Surface CRC depan & belakang (cek karat saat open pack)
- **Temuan Defect / Ketidaksesuaian (opsional, hanya tampil jika ditemukan)** — masing-masing item punya **2 slot upload berpasangan** (foto damaged + foto evidence dari supplier untuk pembanding):
  1. Dokumentasi damaged pada sidewall + lampiran evidence VCI dari supplier (disandingkan posisinya)
  2. Dokumentasi damaged pada ID/OD + lampiran evidence Ring ID/OD dari supplier (disandingkan posisinya)
  3. Dokumentasi karat pada surface + lampiran evidence VCI dari supplier

### Keterangan
- Text area, opsional, free text.

---

## 2. Komponen Upload Foto (dipakai berulang di semua slot foto)
Buat 1 komponen Livewire reusable (misal `V_PhotoUploadInput`) dengan spesifikasi:
- **Responsive**: grid kotak-kotak thumbnail (seperti pada dokumen Word — kotak placeholder untuk tiap slot foto), menyesuaikan ukuran layar (mobile: 2 kolom, desktop: 3–4 kolom)
- Saat kotak diklik dan belum ada foto → tampilkan **pilihan aksi**: "Buka Kamera" atau "Upload dari Galeri/File"
  - Buka Kamera → gunakan `<input type="file" accept="image/*" capture="environment">` untuk trigger kamera langsung di mobile
  - Upload → `<input type="file" accept="image/*">` biasa, bisa multi-select tergantung slot
- Preview thumbnail setelah foto dipilih, dengan tombol hapus/ganti foto
- Validasi: tipe file image (jpg/jpeg/png), ukuran maksimal (tentukan misal 5MB), kompres otomatis jika perlu sebelum upload
- Slot foto yang wajib (required) diberi tanda visual (misal border merah / asterisk) sebelum diisi
- Slot yang conditional (baru muncul jika kondisi Not Good / ada temuan) di-render dengan Livewire reactive show/hide, bukan disembunyikan lewat CSS saja — supaya validasi backend ikut menyesuaikan

---

## 3. Struktur Data / Migration (usulan, sesuaikan nama tabel existing)
Buatkan migration untuk tabel utama, misal `open_pack_inspections`:
- `id`
- `formcheck_id` (FK ke tabel Formcheck kedatangan material)
- `attribute` (snapshot dari Formcheck, agar tidak berubah kalau data Formcheck diedit)
- `tanggal_kedatangan`, `nomor_surat_jalan`, `nomor_supplier`, `nama_supplier` (snapshot)
- `tanggal_open_pack`
- `grup` (enum A/B/C/D)
- `kondisi_awal` (enum OK/NOT_GOOD)
- `kondisi_setelah_open_pack` (enum OK/NOT_GOOD)
- `keterangan` (text, nullable)
- `created_by`, timestamps

Buatkan tabel terpisah untuk foto, misal `open_pack_inspection_photos`:
- `id`
- `open_pack_inspection_id` (FK)
- `slot_key` (string — identifier tetap untuk tiap jenis foto, misal `kondisi_awal_ws`, `kondisi_awal_ds`, `temuan_awal`, `ng_sidewall_ws`, `ng_sidewall_ds`, `ng_bawah`, `ng_surface`, `defect_sidewall_damaged`, `defect_sidewall_evidence`, `defect_id_od_damaged`, `defect_id_od_evidence`, `defect_karat_damaged`, `defect_karat_evidence`)
- `file_path`
- timestamps

Model: `M_OpenPackInspection`, `M_OpenPackInspectionPhoto`, relasi `hasMany` ke foto dan `belongsTo` ke Formcheck.

---

## 4. Validasi (Livewire rules, real-time sesuai kondisi dinamis)
- Attribute wajib dipilih dari suggestion (bukan free text sembarangan) — validasi Attribute harus match record Formcheck yang valid
- Grup wajib dipilih
- Kondisi Awal & Kondisi Setelah Open Pack wajib dipilih
- Jika Kondisi Awal = Not Good → foto WS & DS kondisi awal wajib
- Jika Kondisi Setelah Open Pack = Not Good → 4 foto dokumentasi NG wajib
- Foto temuan/defect hanya wajib jika toggle "ada temuan" diaktifkan user

---

## 5. Export PDF
- Buat service (`OpenPackPdfExportService` atau sejenis) yang generate PDF dari data inspeksi
- Layout PDF harus mengikuti struktur & pengelompokan section persis seperti draft Word (`DRAFT_FORM_INSPEKSI_OPEN_PACK.docx`): Section A (tabel info umum), Section B (kondisi awal + foto), Section C (kondisi setelah open pack + kriteria dokumentasi NG + temuan defect), lalu Keterangan
- Sertakan foto-foto yang diupload ke dalam PDF, dikelompokkan sesuai slot masing-masing dengan label
- Gunakan library PDF yang sudah lazim dipakai di Laravel (misal `barryvdh/laravel-dompdf` atau `spatie/laravel-pdf`) — sebutkan trade-off singkat jika perlu install baru
- Sediakan tombol "Export PDF" di halaman detail/setelah submit form

---

## 6. Yang Perlu Saya Konfirmasi / Sesuaikan Sebelum Dikerjakan
1. Nama tabel & kolom asli modul Formcheck Kedatangan Material (saya pakai placeholder `formcheck.*` di atas)
2. Apakah upload foto disimpan di local storage, S3, atau storage lain yang sudah dipakai di modul lain
3. Library PDF yang sudah dipakai di proyek ini (jika sudah ada, pakai itu supaya konsisten)
4. Apakah field "Grup" berelasi ke master data tertentu atau memang hardcode 4 pilihan (A/B/C/D)
