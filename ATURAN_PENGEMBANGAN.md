# 📘 Panduan Pengembangan Sistem Warehouse — PT Tata Metal Lestari

> **Tujuan dokumen ini**: Menjadi rujukan utama (prompt) bagi AI assistant dan developer
> dalam memahami arsitektur, aturan templating, konvensi penamaan file, dan tata cara pengembangan
> modul baru pada project **Sistem Informasi Digital Warehouse**.

---

## 1. GAMBARAN UMUM PROJECT

### 1.1 Teknologi yang Digunakan

| Komponen       | Teknologi                                                                 |
|----------------|---------------------------------------------------------------------------|
| Framework      | **Laravel** (PHP)                                                         |
| Template Engine| **Blade** (`*.blade.php`)                                                 |
| CSS Framework  | **Modernize Template** (Bootstrap 5 based, folder `template_v2/`)         |
| Icon           | Tabler Icons (`@tabler/icons-webfont`), Font Awesome 5                    |
| DataTables     | jQuery DataTables 1.13.6 + Bootstrap 5 plugin                             |
| SweetAlert     | SweetAlert2 v11                                                           |
| Excel I/O      | `maatwebsite/excel` (Laravel Excel)                                       |
| Database       | MySQL (via Eloquent ORM)                                                  |
| Auth           | Laravel built-in Auth (`Auth::check()`, `Auth::user()`)                   |

### 1.2 Struktur Direktori Utama

```
Sistem-Warehouse/
├── app/
│   ├── Http/Controllers/     ← Semua Controller
│   ├── Models/               ← Semua Model Eloquent
│   ├── Exports/              ← Class Export Excel (Maatwebsite)
│   ├── Imports/              ← Class Import Excel (Maatwebsite)
│   └── Services/             ← Service class (opsional)
├── database/
│   └── migrations/           ← File migrasi database
├── resources/
│   └── views/
│       ├── layout/pegawai/   ← Layout LAMA (sidebar.blade.php, topbar.blade.php, dll)
│       ├── rekap_prd/        ← ⭐ MODUL REFERENSI (pola baru yang harus diikuti)
│       ├── verifikasi_timbangan/
│       ├── scan_koil_eup/
│       ├── modul_kapasitas/
│       ├── stock/
│       ├── so/
│       ├── Coil-Damage/
│       ├── Surat-Izin-Keluar/
│       ├── master-data/
│       └── ... (modul lainnya)
├── routes/
│   └── web.php               ← Definisi semua route
└── public/
    ├── template_v2/          ← Asset template (CSS, JS, gambar)
    └── bahan_logo_v2/        ← Logo dan aset gambar
```

---

## 2. DAFTAR MODUL YANG ADA

Berikut seluruh modul yang sudah ada beserta pola templating yang digunakan saat ini:

| No | Modul (Folder Views)          | Pola Layout                          | Keterangan                                |
|----|-------------------------------|--------------------------------------|-------------------------------------------|
| 1  | `rekap_prd`                   | ⭐ `V_template` + `V_header` + `V_nav` | **STANDAR BARU — jadikan referensi**     |
| 2  | `verifikasi_timbangan`        | `V_template` + `V_header` (tanpa V_nav) | Perlu ditambahkan `V_nav`              |
| 3  | `scan_koil_eup`               | Numpang layout `verifikasi_timbangan` | Belum punya layout sendiri                |
| 4  | `modul_kapasitas`             | `V_template` + `V_header` + `V_nav` | Sudah mirip standar baru                  |
| 5  | `stock`                       | `main.blade.php` + `topbar.blade.php` + `V_*` | Pola campuran lama + baru             |
| 6  | `so`                          | `main.blade.php` + `topbar.blade.php` | Pola LAMA                                 |
| 7  | `Coil-Damage`                 | `main.blade.php` (admin/pegawai terpisah) | Pola LAMA                             |
| 8  | `Surat-Izin-Keluar`          | `main.blade.php` (admin terpisah)    | Pola LAMA                                 |
| 9  | `master-data`                 | `main.blade.php` + `sidebar.blade.php` | Pola LAMA                               |
| 10 | `Packing-List`                | Layout lama                          | Pola LAMA                                 |
| 11 | `Mapping-Container`           | Layout lama                          | Pola LAMA                                 |
| 12 | `Supply-Bahan`                | Layout lama                          | Pola LAMA                                 |
| 13 | `Kendaraan`                   | Layout lama                          | Pola LAMA                                 |
| 14 | `Form-Check`                  | Layout lama                          | Pola LAMA                                 |
| 15 | `Open-Packing`                | Layout lama                          | Pola LAMA                                 |
| 16 | `Scan-Layout`                 | Layout lama                          | Pola LAMA                                 |
| 17 | `L-08`                        | Layout lama                          | Pola LAMA                                 |

---

## 3. ⭐ ATURAN TEMPLATING — STANDAR BARU (Wajib)

> **Modul referensi**: `rekap_prd` — semua modul baru **WAJIB** mengikuti pola ini.

### 3.1 Struktur Folder Modul Baru

Setiap modul baru harus memiliki struktur folder sebagai berikut:

```
resources/views/{nama_modul}/
├── layout/
│   ├── V_template.blade.php    ← Template utama (HTML head, body, scripts)
│   ├── V_header.blade.php      ← Header/topbar (navbar, user dropdown, logout)
│   └── V_nav.blade.php         ← Sidebar navigasi (menu modul ini)
├── dashboard/                  ← Halaman-halaman utama modul
│   ├── index.blade.php         ← Dashboard/halaman utama
│   ├── input.blade.php         ← Form input (jika ada)
│   └── data.blade.php          ← Halaman data/tabel (jika ada)
└── exports/                    ← Template export (jika ada)
    └── excel.blade.php         ← Template tabel untuk export Excel
```

### 3.2 Penjelasan Tiap File Layout

#### `V_template.blade.php` — Template Induk

Ini adalah **file utama** yang menjadi kerangka seluruh halaman pada modul tersebut.

**Isi wajib:**
```blade
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Informasi Digital WH') | PT Tata Metal Lestari</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('bahan_logo_v2/logobg-ic.png') }}" />
    <link rel="stylesheet" href="{{ asset('template_v2/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @stack('css')
    {{-- Styling global (warna korporat, sidebar, tabel, modal, dll) --}}
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical"
         data-navbarbg="skin6" data-sidebartype="full"
         data-sidebar-position="fixed" data-header-position="fixed">
        
        {{-- Sidebar --}}
        @include('{nama_modul}.layout.V_nav')
        
        <div class="body-wrapper">
            {{-- Header --}}
            @include('{nama_modul}.layout.V_header')
            
            <div class="container-fluid" style="max-width: 1400px; padding-top: 100px;">
                {{-- Flash Messages (success, error, validation) --}}
                @if (session('success')) ... @endif
                @if (session('error')) ... @endif
                @if ($errors->any()) ... @endif

                {{-- Konten Halaman --}}
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Scripts (jQuery, Bootstrap, Sidebar, DataTables, SweetAlert) --}}
    @stack('scripts')
</body>
</html>
```

**Warna korporat utama yang WAJIB digunakan:**

| Elemen           | Warna HEX   | Keterangan                     |
|------------------|-------------|--------------------------------|
| Primary          | `#135b9f`   | Biru korporat utama            |
| Primary Hover    | `#0f4a85`   | Biru korporat saat hover       |
| Text Dark        | `#1e293b`   | Teks heading/bold              |
| Text Medium      | `#475569`   | Teks body/info                 |
| Text Light       | `#94a3b8`   | Teks caption/small             |
| Background Page  | `#f8fafc`   | Latar belakang halaman         |
| Background Card  | `#ffffff`   | Latar belakang card            |
| Background Hover | `#f1f5f9`   | Background saat hover          |
| Border Light     | `#e2e8f0`   | Garis border card/tabel        |
| Danger/Delete    | `#b91c1c`   | Warna tombol hapus             |
| Danger Hover     | `#991b1b`   | Warna hover tombol hapus       |
| Danger Background| `#fef2f2`   | Background hover tombol hapus  |

#### `V_header.blade.php` — Header / Topbar

**Berisi:**
- Tombol hamburger sidebar (untuk mobile) dengan class `sidebartoggler`
- Tombol **"Menu Utama"** (`{{ url('/welcome') }}`) untuk kembali ke halaman utama
- Dropdown profil user (nama, role, avatar, link profile, tombol logout)

**Aturan:**
- Semua modul menggunakan V_header yang **identik secara fungsional**
- Yang boleh berbeda hanya referensi `@include` path-nya
- Logout harus melalui **SweetAlert2 confirm dialog** (sudah ada di V_template)

#### `V_nav.blade.php` — Sidebar Navigasi

**Berisi:**
- Logo brand (`logobg-ic.png` + teks "TATA METAL LESTARI")
- Menu navigasi **khusus modul ini saja** (bukan menu global)
- Setiap `<li>` memiliki pengecekan `{{ request()->routeIs('...') ? 'active' : '' }}`

**Contoh referensi dari `rekap_prd`:**
```blade
<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ route('{nama_modul}.dashboard') }}" class="text-nowrap logo-img ...">
        <img src="{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}" style="height: 38px;" />
        <span style="font-weight: 700; font-size: 18px; color: #1a569d; ...">TATA METAL LESTARI</span>
      </a>
    </div>
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">{Kategori Menu}</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('{nama_modul}.dashboard') ? 'active' : '' }}"
             href="{{ route('{nama_modul}.dashboard') }}">
            <span><i class="fas fa-th-large" style="font-size: 1.1rem;"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        {{-- Menu-menu lain sesuai kebutuhan modul --}}
      </ul>
    </nav>
  </div>
</aside>
```

**Aturan penting V_nav:**
- Setiap modul **HARUS punya V_nav sendiri** — JANGAN numpang modul lain
- Menu di sidebar hanya berisi **halaman dalam modul tersebut**
- Gunakan `request()->routeIs()` untuk highlight menu aktif
- Gunakan icon dari **Font Awesome 5** (`fas fa-*`) dengan `font-size: 1.1rem`

### 3.3 Aturan Halaman Konten

Setiap halaman konten yang `@extends` dari `V_template` harus mengikuti pola:

```blade
@extends('{nama_modul}.layout.V_template')

@section('title', '{Judul Halaman}')

@section('content')
<div class="container-fluid p-0">
    {{-- Header Page Info (Breadcrumb Card) --}}
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">{Judul Halaman}</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> {Breadcrumb}
            </div>
        </div>
    </div>

    {{-- Konten utama halaman di sini --}}
</div>
@endsection

@push('css')
{{-- CSS tambahan khusus halaman ini --}}
@endpush

@push('scripts')
{{-- JavaScript tambahan khusus halaman ini --}}
@endpush
```

### 3.4 Aturan Tabel Data (DataTables)

- Gunakan `id="dataTable"` pada tabel utama (otomatis ter-init oleh V_template)
- Gunakan custom search input dengan class `custom-dt-search` (bukan bawaan DataTables)
- DOM layout: `"<'table-responsive'tr><'row dt-footer-row'<'col-sm-12 col-md-5 d-flex align-items-center'i><'col-sm-12 col-md-7'p>>"`
- Bahasa: Indonesia (sudah dikonfigurasi di V_template)

### 3.5 Aturan Action Buttons di Tabel

Gunakan pola `action-icons` yang sudah didefinisikan di V_template:

```html
<div class="action-icons">
    <a href="#" class="action-icon-btn" title="Edit">
        <i class="ti ti-edit"></i>
    </a>
    <button class="action-icon-btn delete-button" title="Hapus">
        <i class="ti ti-trash"></i>
    </button>
</div>
```

### 3.6 Aturan Konfirmasi Hapus Data

Gunakan fungsi `window.showCustomConfirm()` yang sudah ada di V_template:

```javascript
window.showCustomConfirm({
    iconClass: 'fas fa-trash-alt',
    title: 'Hapus Data?',
    text: 'Data yang dihapus tidak dapat dikembalikan.',
    confirmText: 'Ya, Hapus'
}).then((result) => {
    if (result.isConfirmed) {
        // submit form atau redirect
    }
});
```

---

## 4. ATURAN PENAMAAN FILE & KONVENSI

### 4.1 Penamaan Controller

| Konvensi                | Contoh                           |
|-------------------------|----------------------------------|
| Format                  | `{NamaModul}Controller.php`     |
| PascalCase              | `RekapPrdController.php`         |
| Lokasi                  | `app/Http/Controllers/`          |

### 4.2 Penamaan Model

| Konvensi                | Contoh                           |
|-------------------------|----------------------------------|
| Format                  | `{NamaModel}.php`               |
| PascalCase, Singular    | `RekapPrd.php`                   |
| Lokasi                  | `app/Models/`                    |
| Tabel DB                | `rekap_prds` (plural, snake_case)|

### 4.3 Penamaan View / Blade

| Komponen       | Penamaan                           | Contoh                           |
|----------------|------------------------------------|----------------------------------|
| Folder modul   | `snake_case` (huruf kecil)         | `rekap_prd`, `scan_koil_eup`     |
| File layout    | Prefix `V_` + fungsinya            | `V_template`, `V_header`, `V_nav`|
| File halaman   | Deskriptif, `snake_case`           | `index`, `input`, `data`, `edit` |
| File export    | Deskriptif sesuai format           | `excel.blade.php`                |

### 4.4 Penamaan Route

| Konvensi         | Contoh                                      |
|------------------|----------------------------------------------|
| URL prefix       | `kebab-case`                                 |
| Route name       | `{modul}.{aksi}` dot notation                |
| Contoh URL       | `/rekap-prd`, `/rekap-prd/data`              |
| Contoh name      | `rekap-prd.dashboard`, `rekap-prd.store`     |

**Pola route standar untuk sebuah modul:**
```php
// routes/web.php
Route::prefix('nama-modul')->middleware('auth')->group(function () {
    Route::get('/',         [NamaModulController::class, 'index'])->name('nama-modul.dashboard');
    Route::get('/input',    [NamaModulController::class, 'input'])->name('nama-modul.input');
    Route::get('/data',     [NamaModulController::class, 'data'])->name('nama-modul.data');
    Route::post('/store',   [NamaModulController::class, 'store'])->name('nama-modul.store');
    Route::post('/export',  [NamaModulController::class, 'exportExcel'])->name('nama-modul.export');
    Route::delete('/{id}',  [NamaModulController::class, 'destroy'])->name('nama-modul.destroy');
});
```

### 4.5 Penamaan Migration

| Konvensi                | Contoh                                              |
|-------------------------|-----------------------------------------------------|
| Format                  | `{tanggal}_create_{nama_tabel}_table.php`           |
| Format alter            | `{tanggal}_add_{kolom}_to_{tabel}_table.php`        |
| Contoh                  | `2026_09_01_114307_create_rekap_prds_table.php`     |

### 4.6 Penamaan Export/Import Class

| Tipe     | Format                         | Contoh                          |
|----------|--------------------------------|---------------------------------|
| Export   | `{NamaModul}Export.php`        | `RekapPrdExport.php`            |
| Import   | `{NamaModul}Import.php`       | `RekapImport.php`               |
| Lokasi   | `app/Exports/` atau `app/Imports/` |                             |

---

## 5. ATURAN LOGIKA & STRUKTUR CONTROLLER

### 5.1 Pola Method Controller Standar

Setiap controller modul sebaiknya memiliki method berikut (sesuai kebutuhan):

```php
class NamaModulController extends Controller
{
    // [TAG: HALAMAN UTAMA] Dashboard atau index
    public function index(Request $request) { ... }

    // [TAG: HALAMAN INPUT] Form input data
    public function input(Request $request) { ... }

    // [TAG: HALAMAN DATA] Tampilkan data dengan filter
    public function data(Request $request) { ... }

    // [TAG: SIMPAN DATA] Proses simpan/update data
    public function store(Request $request) { ... }

    // [TAG: HAPUS DATA] Proses hapus data
    public function destroy($id) { ... }

    // [TAG: EXPORT] Export data ke Excel
    public function exportExcel(Request $request) { ... }
}
```

### 5.2 Aturan Komentar di Controller

Gunakan **TAG komentar** pada setiap blok logika penting:

```php
// [TAG: NAMA_TAG] Penjelasan singkat apa yang dilakukan blok ini
```

Contoh tag yang sudah digunakan di project:
- `[TAG: FILTER AWAL]` — Logika penerimaan parameter filter
- `[TAG: QUERY HARIAN]` — Query data per hari
- `[TAG: QUERY BULANAN]` — Query data per bulan
- `[TAG: QUERY TAHUNAN]` — Query data per tahun
- `[TAG: VALIDASI]` — Validasi input form
- `[TAG: PERHITUNGAN PRD]` — Perhitungan data produksi
- `[TAG: RUMUS AKHIR]` — Rumus kalkulasi akhir
- `[TAG: SIMPAN DATABASE]` — Proses simpan ke database
- `[TAG: REKALKULASI]` — Penghitungan ulang data terkait

### 5.3 Aturan Validasi

Selalu gunakan `$request->validate()` sebelum proses data:

```php
$request->validate([
    'tanggal'  => 'required|date',
    'file_prd' => 'required|mimes:xlsx,xls,csv',
]);
```

---

## 6. CHECKLIST PEMBUATAN MODUL BARU

Gunakan checklist ini setiap kali membuat modul baru:

### 6.1 Database

- [ ] Buat migration `create_{nama_tabel}_table.php`
- [ ] Buat Model `app/Models/{NamaModel}.php` dengan `$fillable`
- [ ] Jalankan `php artisan migrate`

### 6.2 Backend (Controller & Route)

- [ ] Buat Controller `app/Http/Controllers/{NamaModul}Controller.php`
- [ ] Definisikan method sesuai kebutuhan (`index`, `store`, `destroy`, dll)
- [ ] Daftarkan route di `routes/web.php` dengan prefix dan name group
- [ ] Tambahkan middleware `auth` pada route group

### 6.3 Frontend (Views)

- [ ] Buat folder `resources/views/{nama_modul}/`
- [ ] Buat subfolder `layout/` dengan file:
  - [ ] `V_template.blade.php` — Copy dari `rekap_prd`, ubah `@include` path
  - [ ] `V_header.blade.php` — Copy dari `rekap_prd` (identik fungsional)
  - [ ] `V_nav.blade.php` — Buat baru sesuai menu modul ini
- [ ] Buat subfolder `dashboard/` dengan halaman konten
- [ ] Buat subfolder `exports/` jika perlu fitur export

### 6.4 Fitur Export (Opsional)

- [ ] Buat Export class di `app/Exports/{NamaModul}Export.php`
- [ ] Buat Import class di `app/Imports/{NamaModul}Import.php` (jika perlu)
- [ ] Buat template export di `views/{nama_modul}/exports/excel.blade.php`

### 6.5 Integrasi Menu Utama

- [ ] Tambahkan link modul di halaman Welcome (`welcome.blade.php`)
- [ ] Pastikan icon dan label konsisten dengan modul lain

---

## 7. ⚠️ ATURAN KERJA DENGAN AI ASSISTANT

### 7.1 Prinsip Utama

> **JANGAN langsung eksekusi kode.** Selalu berikan **rancangan/rencana** terlebih dahulu
> dan tunggu persetujuan sebelum mengimplementasikan.

### 7.2 Aturan Detail

1. **Fokus pada apa yang diperintahkan**
   - Hanya kerjakan apa yang diminta oleh user
   - Jangan menambahkan fitur atau perubahan yang tidak diminta

2. **Jangan ubah modul lain tanpa konfirmasi**
   - Jika perubahan yang diminta **berdampak** ke modul lain, tanyakan dulu
   - Jika menemukan bug di modul lain saat mengerjakan, laporkan tapi **jangan langsung perbaiki**

3. **Selalu berikan rancangan sebelum implementasi**
   - Jelaskan file apa saja yang akan dibuat/diubah
   - Jelaskan perubahan kode yang akan dilakukan
   - Tampilkan struktur folder yang akan dibuat
   - Tunggu user berkata "OK", "lanjut", "setuju", atau sejenisnya

4. **Pertahankan konsistensi template**
   - Semua modul baru **WAJIB** menggunakan pola `V_template + V_header + V_nav` dari `rekap_prd`
   - Jangan mencampur dengan pola lama (`main.blade.php + topbar.blade.php`)
   - Jangan menggunakan TailwindCSS — gunakan Bootstrap 5 + custom CSS yang sudah ada

5. **Dokumentasi perubahan**
   - Berikan penjelasan setiap perubahan yang dilakukan
   - Gunakan komentar `[TAG: ...]` pada logika penting di controller

### 7.3 Format Rancangan yang Harus Diberikan

Sebelum eksekusi, berikan rancangan dengan format:

```
## Rancangan Perubahan: {Nama Fitur/Modul}

### File yang Akan Dibuat:
1. `path/ke/file_baru.php` — Deskripsi fungsi file ini

### File yang Akan Diubah:
1. `path/ke/file_existing.php` — Perubahan: {deskripsi singkat}

### File yang TIDAK Diubah:
- Semua file di luar daftar di atas tidak akan disentuh

### Struktur Folder:
resources/views/{nama_modul}/
├── layout/
│   ├── V_template.blade.php
│   ├── V_header.blade.php
│   └── V_nav.blade.php
└── dashboard/
    └── index.blade.php

### Logika Bisnis:
- Penjelasan alur logika yang akan diimplementasikan

### Apakah ada dampak ke modul lain?
- Ya/Tidak. Jika ya, jelaskan apa dampaknya.
```

---

## 8. REFERENSI CEPAT — TEMPLATE COPY-PASTE

### 8.1 Template V_template.blade.php Baru

Saat membuat modul baru, copy file berikut dan ubah path `@include`:

**Source:** `resources/views/rekap_prd/layout/V_template.blade.php`

Yang perlu diubah:
```blade
{{-- Baris 242: ubah path V_nav --}}
@include('{nama_modul_baru}.layout.V_nav')

{{-- Baris 248: ubah path V_header --}}
@include('{nama_modul_baru}.layout.V_header')
```

### 8.2 Template V_header.blade.php Baru

**Source:** `resources/views/rekap_prd/layout/V_header.blade.php`

> File ini biasanya **identik** untuk semua modul. Cukup copy tanpa perubahan.

### 8.3 Template V_nav.blade.php Baru

**Source:** `resources/views/rekap_prd/layout/V_nav.blade.php`

Yang perlu diubah:
- Link logo → arahkan ke route dashboard modul baru
- Item menu → sesuaikan dengan halaman-halaman modul baru
- `routeIs()` → sesuaikan dengan nama route modul baru

### 8.4 Template Halaman Konten Baru

```blade
@extends('{nama_modul}.layout.V_template')

@section('title', '{Judul Halaman}')

@section('content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8f9fa);">
        <div class="card-body p-4">
            <h4 class="fw-bolder mb-2" style="color: #1e293b; letter-spacing: -0.5px;">{Judul}</h4>
            <div class="text-muted" style="font-size: 14px;">
                Home <span class="mx-1">/</span> {Breadcrumb}
            </div>
        </div>
    </div>

    {{-- Konten halaman --}}

</div>
@endsection
```

### 8.5 Template Controller Baru

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{NamaModel};

class {NamaModul}Controller extends Controller
{
    // [TAG: HALAMAN UTAMA]
    public function index(Request $request)
    {
        // Query data...
        return view('{nama_modul}.dashboard.index', compact('data'));
    }

    // [TAG: SIMPAN DATA]
    public function store(Request $request)
    {
        $request->validate([
            // validasi...
        ]);

        // Proses simpan...
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    // [TAG: HAPUS DATA]
    public function destroy($id)
    {
        {NamaModel}::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
```

### 8.6 Template Route Group Baru

```php
// ============================
// MODUL: {NAMA MODUL}
// ============================
Route::prefix('{nama-modul}')->middleware('auth')->group(function () {
    Route::get('/',        [{NamaModul}Controller::class, 'index'])->name('{nama-modul}.dashboard');
    Route::get('/input',   [{NamaModul}Controller::class, 'input'])->name('{nama-modul}.input');
    Route::get('/data',    [{NamaModul}Controller::class, 'data'])->name('{nama-modul}.data');
    Route::post('/store',  [{NamaModul}Controller::class, 'store'])->name('{nama-modul}.store');
    Route::post('/export', [{NamaModul}Controller::class, 'exportExcel'])->name('{nama-modul}.export');
    Route::delete('/{id}', [{NamaModul}Controller::class, 'destroy'])->name('{nama-modul}.destroy');
});
```

---

## 9. CATATAN PENTING

1. **Jangan gunakan TailwindCSS** untuk modul baru — kecuali `modul_kapasitas` yang sudah terlanjur menggunakannya.
2. **Jangan buat layout terpisah admin/pegawai** — gunakan satu layout V_template yang sama dan bedakan akses via middleware/role check di controller.
3. **Selalu gunakan `asset()` helper** untuk path ke file statis.
4. **Selalu gunakan `route()` helper** untuk URL di blade — jangan hardcode URL.
5. **DataTables hanya perlu satu inisialisasi** di V_template (sudah auto-init untuk `#dataTable`).
6. **SweetAlert2 sudah tersedia global** di V_template — gunakan `window.showCustomConfirm()`.

---

*Dokumen ini terakhir diperbarui: 23 September 2026*
*Referensi utama: Modul `rekap_prd` — path: `resources/views/rekap_prd/`*
