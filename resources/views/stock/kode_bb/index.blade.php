@extends('stock.layout.V_template')
@section('title', 'Master Data Kode Bahan Baku')

@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 1700
        });
    });
</script>
@endif

@if(isset($errors) && $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `{!! implode('<br>', $errors->all()) !!}`,
        });
    });
</script>
@endif

<div class="card h-full min-w-0">
    <div class="card-body min-w-0">
        <!-- Page Title & Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h4 class="text-xl font-bold text-gray-800 dark:text-white uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Master Data Bahan Baku
                </h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola isian Supplier, Kode Produk, Kode Supplier, dan Jenis untuk Navbar</p>
            </div>
            <button type="button" data-modal-target="tambahModal" data-modal-toggle="tambahModal" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Bahan Baku
            </button>
        </div>

        <!-- Filter & Search Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-darkgray p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="relative w-full md:w-80">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                </div>
                <input type="text" id="searchInput" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari Supplier, Kode, atau Jenis...">
            </div>

            <!-- Quick Filter Tags -->
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold text-gray-500 uppercase mr-1">Filter Jenis:</span>
                <button type="button" onclick="filterJenis('ALL')" class="btn-filter-jenis px-3 py-1.5 text-xs font-semibold rounded-lg bg-primary text-white transition-colors" data-jenis="ALL">Semua</button>
                <button type="button" onclick="filterJenis('CRC')" class="btn-filter-jenis px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 transition-colors" data-jenis="CRC">CRC</button>
                <button type="button" onclick="filterJenis('RESIN')" class="btn-filter-jenis px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 transition-colors" data-jenis="RESIN">RESIN</button>
                <button type="button" onclick="filterJenis('INGOT')" class="btn-filter-jenis px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 transition-colors" data-jenis="INGOT">INGOT</button>
            </div>
        </div>

        <div class="mb-4 flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Data: <span id="totalDataCount" class="font-bold text-primary">{{ $items->count() }}</span></span>
        </div>

        <!-- Table Master Data -->
        <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
            <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" id="masterTable">
                <thead class="text-xs text-white uppercase bg-primary dark:bg-blue-900 shadow-sm">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold">NO</th>
                        <th class="px-4 py-3 font-bold">NAMA SUPPLIER</th>
                        <th class="px-4 py-3 font-bold">KODE PRODUK</th>
                        <th class="px-4 py-3 font-bold">KODE SUPPLIER</th>
                        <th class="px-4 py-3 font-bold text-center">JENIS</th>
                        <th class="px-4 py-3 font-bold text-center">ORIGIN</th>
                        <th class="px-4 py-3 text-center font-bold">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr class="master-row border-b border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors bg-white dark:bg-darkgray" data-jenis="{{ strtoupper($item->jenis) }}">
                        <td class="px-4 py-3 text-center font-medium text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white uppercase">
                            {{ strtoupper($item->supplier) }}
                        </td>
                        <td class="px-4 py-3 font-mono text-gray-600 dark:text-gray-300 uppercase">
                            @if(strtoupper($item->jenis) === 'RESIN' && $item->nama_produk)
                                {{ strtoupper($item->kode_produk ?? '-') }} - {{ strtoupper($item->nama_produk) }}
                            @else
                                {{ strtoupper($item->kode_produk ?? '-') }}
                            @endif
                        </td>
                        <td class="px-4 py-3 font-mono">
                            <span class="px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 font-semibold text-xs uppercase">
                                {{ strtoupper($item->kode_supplier ?? '-') }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if(strtoupper($item->jenis) === 'CRC')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-300">CRC</span>
                            @elseif(strtoupper($item->jenis) === 'RESIN')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 border border-amber-300">RESIN</span>
                            @elseif(strtoupper($item->jenis) === 'INGOT')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-950 dark:text-purple-300 border border-purple-300">INGOT</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 uppercase">{{ strtoupper($item->jenis) }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-xs uppercase {{ strtoupper($item->origin) == 'IMPORT' ? 'text-amber-600 font-medium' : 'text-gray-500' }}">
                                {{ strtoupper($item->origin ?? 'LOKAL') }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" data-modal-target="editModal{{ $item->id }}" data-modal-toggle="editModal{{ $item->id }}" class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button type="button" data-modal-target="deleteModal{{ $item->id }}" data-modal-toggle="deleteModal{{ $item->id }}" class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data Master Bahan Baku. Klik "Tambah Bahan Baku" untuk menambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Modal Tambah Data -->
<div id="tambahModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Master Bahan Baku
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="tambahModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <form action="{{ route('stock.kode_bb.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Bahan Baku <span class="text-red-500">*</span></label>
                        <select name="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required onchange="toggleNamaProdukField(this, 'namaProdukField')">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="CRC">CRC</option>
                            <option value="RESIN">RESIN</option>
                            <option value="INGOT">INGOT</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier <span class="text-red-500">*</span></label>
                        <input type="text" name="supplier" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="CONTOH: KS, HANWA, KOREA ZINC..." oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Produk</label>
                        <input type="text" name="kode_produk" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="CONTOH: CRFH0251219, IR000001, AF000001..." oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div id="namaProdukField" style="display: none;">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_produk" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="CONTOH: PT METAL COAT - ALKALI" oninput="this.value = this.value.toUpperCase()">
                        <p class="text-xs text-gray-500 mt-1">Wajib diisi untuk RESIN (satu supplier punya banyak kode produk berbeda)</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Supplier / Atribut</label>
                        <input type="text" name="kode_supplier" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="CONTOH: KS, HANWA, IA_D, CR_A_..." oninput="this.value = this.value.toUpperCase()">
                        <p class="text-xs text-gray-500 mt-1">Disimpan dalam kapital (uppercase) untuk URL & identifikasi stock</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origin</label>
                        <select name="origin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="Lokal">Lokal</option>
                            <option value="Import">Import</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-600 gap-2">
                    <button type="button" data-modal-hide="tambahModal" class="py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">Batal</button>
                    <button type="submit" class="text-white bg-primary hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit & Delete foreach -->
@foreach ($items as $item)
<!-- Modal Edit -->
<div id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Master Bahan Baku
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editModal{{ $item->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <form action="{{ route('stock.kode_bb.update', $item->id) }}" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Bahan Baku <span class="text-red-500">*</span></label>
                        <select name="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required onchange="toggleNamaProdukField(this, 'namaProdukFieldEdit{{ $item->id }}')">
                            <option value="CRC" {{ strtoupper($item->jenis) === 'CRC' ? 'selected' : '' }}>CRC</option>
                            <option value="RESIN" {{ strtoupper($item->jenis) === 'RESIN' ? 'selected' : '' }}>RESIN</option>
                            <option value="INGOT" {{ strtoupper($item->jenis) === 'INGOT' ? 'selected' : '' }}>INGOT</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier <span class="text-red-500">*</span></label>
                        <input type="text" name="supplier" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ strtoupper($item->supplier) }}" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Produk</label>
                        <input type="text" name="kode_produk" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ strtoupper($item->kode_produk) }}" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div id="namaProdukFieldEdit{{ $item->id }}" style="display: {{ strtoupper($item->jenis) === 'RESIN' ? 'block' : 'none' }};">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_produk" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ strtoupper($item->nama_produk ?? '') }}" placeholder="CONTOH: PT METAL COAT - ALKALI" oninput="this.value = this.value.toUpperCase()">
                        <p class="text-xs text-gray-500 mt-1">Wajib diisi untuk RESIN (satu supplier punya banyak kode produk berbeda)</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Supplier / Atribut</label>
                        <input type="text" name="kode_supplier" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ strtoupper($item->kode_supplier) }}" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origin</label>
                        <select name="origin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="Lokal" {{ $item->origin == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                            <option value="Import" {{ $item->origin == 'Import' ? 'selected' : '' }}>Import</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-600 gap-2">
                    <button type="button" data-modal-hide="editModal{{ $item->id }}" class="py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">Batal</button>
                    <button type="submit" class="text-white bg-primary hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-red-600 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-base font-medium text-gray-700 dark:text-gray-300">
                    Apakah Anda yakin ingin menghapus data supplier <strong>{{ $item->supplier }}</strong> ({{ $item->jenis }})?
                </h3>
                <form action="{{ route('stock.kode_bb.destroy', $item->id) }}" method="POST" class="inline-flex gap-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        Ya, Hapus
                    </button>
                    <button type="button" data-modal-hide="deleteModal{{ $item->id }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        Batal
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    // Search Filter
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#masterTable tbody .master-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const currentJenisFilter = document.querySelector('.btn-filter-jenis.bg-primary').getAttribute('data-jenis');
            const rowJenis = row.getAttribute('data-jenis');

            const matchesSearch = text.includes(filter);
            const matchesJenis = (currentJenisFilter === 'ALL' || rowJenis === currentJenisFilter);

            if (matchesSearch && matchesJenis) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('totalDataCount').textContent = visibleCount;
    });

    // Filter by Jenis buttons
    function filterJenis(jenis) {
        document.querySelectorAll('.btn-filter-jenis').forEach(btn => {
            if (btn.getAttribute('data-jenis') === jenis) {
                btn.className = 'btn-filter-jenis px-3 py-1.5 text-xs font-semibold rounded-lg bg-primary text-white transition-colors';
            } else {
                btn.className = 'btn-filter-jenis px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 transition-colors';
            }
        });

        const filter = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#masterTable tbody .master-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowJenis = row.getAttribute('data-jenis');

            const matchesSearch = text.includes(filter);
            const matchesJenis = (jenis === 'ALL' || rowJenis === jenis);

            if (matchesSearch && matchesJenis) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('totalDataCount').textContent = visibleCount;
    }

    // Show/Hide Nama Produk field based on Jenis selection
    function toggleNamaProdukField(selectElement, targetId) {
        const jenis = selectElement.value.toUpperCase();
        const namaProdukField = document.getElementById(targetId);
        const namaProdukInput = namaProdukField.querySelector('input[name="nama_produk"]');

        if (jenis === 'RESIN') {
            namaProdukField.style.display = 'block';
            // Make required for RESIN
            if (namaProdukInput) {
                namaProdukInput.setAttribute('required', 'required');
            }
        } else {
            namaProdukField.style.display = 'none';
            // Clear nama_produk and remove required when switching away from RESIN
            if (namaProdukInput) {
                namaProdukInput.value = '';
                namaProdukInput.removeAttribute('required');
            }
        }
    }

    // Initialize toggle for add form
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSelect = document.querySelector('select[name="jenis"]');
        if (jenisSelect) {
            jenisSelect.addEventListener('change', function() {
                toggleNamaProdukField(this, 'namaProdukField');
            });
            // Initial check
            toggleNamaProdukField(jenisSelect, 'namaProdukField');
        }
    });

    // Validate nama_produk required for RESIN on form submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const jenisSelect = form.querySelector('select[name="jenis"]');
            const namaProdukInput = form.querySelector('input[name="nama_produk"]');

            if (jenisSelect && namaProdukInput) {
                const jenis = jenisSelect.value.toUpperCase();
                if (jenis === 'RESIN' && !namaProdukInput.value.trim()) {
                    e.preventDefault();
                    alert('Nama Produk wajib diisi untuk RESIN!');
                    namaProdukInput.focus();
                }
            }
        });
    });
</script>
@endpush

@endsection
