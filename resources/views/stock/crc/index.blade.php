@extends('stock.layout.V_template')
@section('title', 'Data Stock CRC - ' . strtoupper($type))

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

@if($errors->any())
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
        <!-- Page Title -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white uppercase">Data Stock CRC - {{ strtoupper($type) }}</h4>
                <p class="text-sm text-gray-500 mt-1">Menampilkan data stock kategori CRC berdasarkan filter {{ strtoupper($type) }}</p>
            </div>
        </div>

        <!-- Action Buttons & Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-darkgray p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="relative w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                </div>
                <input type="text" id="searchInput" class="block w-full md:w-80 p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari cepat (Ketik di sini...)">
            </div>
            
            <div class="flex gap-2 w-full md:w-auto justify-end">
                <button type="button" data-modal-target="uploadModal" data-modal-toggle="uploadModal" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                    <i class="fa fa-upload"></i>
                    Upload Excel
                </button>
                <button type="button" data-modal-target="historyModal" data-modal-toggle="historyModal" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                    <i class="fa fa-history"></i>
                    Riwayat Upload
                </button>
            </div>
        </div>



        <!-- Tabs -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="crcTabs" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 rounded-t-lg text-primary border-primary font-bold dark:text-blue-500 dark:border-blue-500" id="stock-tab" data-target="stock" type="button" role="tab">DATA STOCK</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="masuk-tab" data-target="masuk" type="button" role="tab">CRC MASUK</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="keluar-tab" data-target="keluar" type="button" role="tab">CRC KELUAR</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="rekap-tab" data-target="rekap" type="button" role="tab">REKAP PER UKURAN</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="rekap-bulan-tab" data-target="rekap-bulan" type="button" role="tab">REKAP PER BULAN</button>
                </li>
            </ul>
        </div>
        
        <div id="crcTabContent">
            <!-- TAB 1: DATA STOCK -->
            <div class="tab-pane active" id="stock" role="tabpanel">
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" data-tab="stock">
                        <thead class="text-xs text-white uppercase bg-primary dark:bg-blue-900 shadow-sm">
                            <tr>
                                <th class="px-3 py-3 text-center border-b border-blue-400 font-bold">No</th>
                                <th class="px-3 py-3 border-b border-blue-400 font-bold">Storage Bin</th>
                                <th class="px-3 py-3 border-b border-blue-400 font-bold">Kode Produk</th>
                                <th class="px-3 py-3 border-b border-blue-400 font-bold">Nama Produk</th>
                                <th class="px-3 py-3 border-b border-blue-400 font-bold">Attribute Set Value</th>
                                <th class="px-3 py-3 border-b border-blue-400 font-bold text-right">Qty</th>
                                <th class="px-3 py-3 border-b border-blue-400 font-bold">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_stock as $d)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white searchable-row">
                                <td class="px-3 py-3 text-center font-medium">{{ $loop->iteration }}</td>
                                <td class="px-3 py-3">{{ $d->storage_bin ?? '-' }}</td>
                                <td class="px-3 py-3">{{ $d->kode_produk ?? '-' }}</td>
                                <td class="px-3 py-3">{{ $d->nama_produk ?? '-' }}</td>
                                <td class="px-3 py-3">{{ $d->attribute_set_value ?? '-' }}</td>
                                <td class="px-3 py-3 text-right">{{ is_numeric($d->quantity) ? number_format($d->quantity, 0, ',', '.') : $d->quantity }}</td>
                                <td class="px-3 py-3">{{ $d->satuan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-3 py-3 text-center text-gray-500">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 2: CRC MASUK -->
            <div class="tab-pane hidden" id="masuk" role="tabpanel">
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" data-tab="masuk">
                        <thead class="text-xs text-black uppercase bg-yellow-300 dark:bg-yellow-600 shadow-sm border-b-2 border-black">
                            <tr>
                                <th class="px-3 py-3 border-r border-black font-bold">TGL MASUK</th>
                                <th class="px-3 py-3 border-r border-black font-bold">BATCH (STORAGE BIN)</th>
                                <th class="px-3 py-3 border-r border-black font-bold">ATTRIBUTE</th>
                                <th class="px-3 py-3 border-r border-black font-bold">UKURAN</th>
                                @foreach($months as $m)
                                    <th class="px-3 py-3 border-r border-black font-bold text-center">{{ $m }}</th>
                                @endforeach
                                <th class="px-3 py-3 font-bold text-right border-black">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_masuk as $d)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white searchable-row">
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->tgl_masuk }}</td>
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->storage_bin ?? '-' }}</td>
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->attribute_set_value ?? '-' }}</td>
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->ukuran }}</td>
                                @foreach($months as $m)
                                    <td class="px-3 py-2 text-center border-r border-gray-300">{{ $d->bulan_masuk === $m ? (is_numeric($d->quantity) ? number_format($d->quantity, 0, ',', '.') : $d->quantity) : '' }}</td>
                                @endforeach
                                <td class="px-3 py-2 text-right bg-yellow-100 font-bold border-l border-gray-300">{{ is_numeric($d->quantity) ? number_format($d->quantity, 0, ',', '.') : $d->quantity }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ 5 + count($months) }}" class="px-3 py-3 text-center text-gray-500">Belum ada data masuk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: CRC KELUAR -->
            <div class="tab-pane hidden" id="keluar" role="tabpanel">
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" data-tab="keluar">
                        <thead class="text-xs text-black uppercase bg-yellow-300 dark:bg-yellow-600 shadow-sm border-b-2 border-black">
                            <tr>
                                <th class="px-3 py-3 border-r border-black font-bold">TGL KELUAR</th>
                                <th class="px-3 py-3 border-r border-black font-bold">ATTRIBUTE</th>
                                <th class="px-3 py-3 border-r border-black font-bold">UKURAN</th>
                                @foreach($months as $m)
                                    <th class="px-3 py-3 border-r border-black font-bold text-center">{{ $m }}</th>
                                @endforeach
                                <th class="px-3 py-3 font-bold text-right border-black">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_keluar as $d)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white searchable-row">
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->tgl_keluar }}</td>
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->attribute_set_value ?? '-' }}</td>
                                <td class="px-3 py-2 border-r border-gray-300">{{ $d->ukuran }}</td>
                                @foreach($months as $m)
                                    <td class="px-3 py-2 text-center border-r border-gray-300">{{ $d->bulan_keluar === $m ? (is_numeric($d->quantity) ? number_format($d->quantity, 0, ',', '.') : $d->quantity) : '' }}</td>
                                @endforeach
                                <td class="px-3 py-2 text-right bg-yellow-100 font-bold border-l border-gray-300">{{ is_numeric($d->quantity) ? number_format($d->quantity, 0, ',', '.') : $d->quantity }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ 4 + count($months) }}" class="px-3 py-3 text-center text-gray-500">Belum ada data keluar</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 4: REKAP PER UKURAN -->
            <div class="tab-pane hidden" id="rekap" role="tabpanel">
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" data-tab="rekap">
                        <thead class="text-xs text-black uppercase bg-yellow-300 dark:bg-yellow-600 shadow-sm border-b-2 border-black">
                            <tr>
                                <th class="px-3 py-3 border-r border-black font-bold">STATUS</th>
                                <th class="px-3 py-3 border-r border-black font-bold text-center">UKURAN</th>
                                <th class="px-3 py-3 border-r border-black bg-blue-100 font-bold text-right">MASUK</th>
                                <th class="px-3 py-3 border-r border-black bg-orange-100 font-bold text-right">KELUAR</th>
                                <th class="px-3 py-3 font-bold text-right border-black bg-yellow-200">SALDO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekap_ukuran as $r)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white searchable-row">
                                <td class="px-3 py-2 border-r border-gray-300">CRC {{ strtoupper($type) }}</td>
                                <td class="px-3 py-2 border-r border-gray-300 text-center">{{ $r['ukuran'] }}</td>
                                <td class="px-3 py-2 text-right bg-blue-50 border-r border-gray-300">{{ number_format($r['masuk'], 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right bg-orange-50 border-r border-gray-300">{{ number_format($r['keluar'], 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right font-bold bg-yellow-100 border-l border-gray-300">{{ number_format($r['saldo'], 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-3 py-3 text-center text-gray-500">Belum ada rekap</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 5: REKAP PER BULAN -->
            <div class="tab-pane hidden" id="rekap-bulan" role="tabpanel">
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" data-tab="rekap-bulan">
                        <thead class="text-xs text-black uppercase bg-yellow-300 dark:bg-yellow-600 shadow-sm border-b-2 border-black">
                            <tr>
                                <th class="px-3 py-3 border-r border-black font-bold">BULAN</th>
                                <th class="px-3 py-3 border-r border-black font-bold text-right bg-blue-100">MASUK</th>
                                <th class="px-3 py-3 border-r border-black font-bold text-right bg-orange-100">KELUAR</th>
                                <th class="px-3 py-3 font-bold text-right border-black bg-yellow-200">SALDO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekap_bulan as $r)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white searchable-row">
                                <td class="px-3 py-2 border-r border-gray-300">{{ $r['bulan'] }}</td>
                                <td class="px-3 py-2 text-right bg-blue-50 border-r border-gray-300">{{ number_format($r['masuk'], 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right bg-orange-50 border-r border-gray-300">{{ number_format($r['keluar'], 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right font-bold bg-yellow-100 border-l border-gray-300">{{ number_format($r['saldo'], 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-3 py-3 text-center text-gray-500">Belum ada rekap bulan</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-black bg-yellow-300 font-bold text-black text-xs">
                                <td class="px-3 py-3 border-r border-black text-right">TOTAL</td>
                                <td class="px-3 py-3 border-r border-black text-right bg-blue-200">{{ number_format($total_masuk_bulan, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 border-r border-black text-right bg-orange-200">{{ number_format($total_keluar_bulan, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 border-black text-right bg-yellow-400"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

        <!-- Pagination UI -->
        <div class="flex flex-col md:flex-row justify-between items-center mt-4 gap-4">
            <div class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan <span id="pageStart" class="font-semibold">0</span> sampai <span id="pageEnd" class="font-semibold">0</span> dari <span id="pageTotal" class="font-semibold">0</span> data
            </div>
            <div class="inline-flex rounded-md shadow-sm" id="paginationControls">
                <button type="button" id="btnPrev" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">Sebelumnya</button>
                <span id="pageNumbers" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">Hal 1 dari 1</span>
                <button type="button" id="btnNext" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">Selanjutnya</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal Upload Excel -->
<div id="uploadModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-lg font-semibold text-white">
                    <i class="fa fa-upload me-2"></i> Upload Data Stock CRC
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="uploadModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <form action="{{ route('stock.crc.import') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Excel / CSV</label>
                        <input type="file" name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept=".xlsx,.xls,.csv" required>
                        <p class="mt-1 text-xs text-gray-500">Pilih file excel laporan harian</p>
                    </div>
                </div>
                <div class="flex justify-end pt-2 border-t border-gray-200 dark:border-gray-600">
                    <button type="button" data-modal-hide="uploadModal" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                        <i class="fa fa-paper-plane me-1"></i> Proses Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Riwayat Upload -->
<div id="historyModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-red-600">
                <h3 class="text-lg font-semibold text-white">
                    <i class="fa fa-history me-2"></i> Riwayat Upload & Hapus Data
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-red-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="historyModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <p class="text-sm text-gray-500 mb-4">Anda dapat menghapus data yang salah diupload berdasarkan waktu upload (batch).</p>
                
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Waktu Upload</th>
                                <th class="px-4 py-3 text-center">Total Baris</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($batches as $batch)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-3 font-medium">{{ $batch->batch_time }}</td>
                                <td class="px-4 py-3 text-center">{{ $batch->total }} item</td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('stock.crc.batch_delete') }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA data CRC yang diupload pada {{ $batch->batch_time }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="batch_time" value="{{ $batch->batch_time }}">
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center">
                                            Hapus Batch
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500">Belum ada riwayat upload</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .hidden-by-search { display: none !important; }
    .hidden-by-page { display: none !important; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        let currentPage = 1;
        const rowsPerPage = 10;
        let currentTabId = 'stock';

        // Tab Switching Logic
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                tabButtons.forEach(b => {
                    b.classList.remove('text-primary', 'border-primary', 'font-bold', 'dark:text-blue-500', 'dark:border-blue-500');
                    b.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                });
                tabPanes.forEach(p => p.classList.add('hidden'));
                
                btn.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                btn.classList.add('text-primary', 'border-primary', 'font-bold', 'dark:text-blue-500', 'dark:border-blue-500');
                
                currentTabId = btn.getAttribute('data-target');
                document.getElementById(currentTabId).classList.remove('hidden');
                
                if(searchInput) searchInput.value = '';
                document.querySelectorAll("tbody tr.searchable-row").forEach(row => row.classList.remove('hidden-by-search'));
                currentPage = 1;
                renderTable();
            });
        });

        function renderTable() {
            const activeTableRows = Array.from(document.querySelectorAll(`.tab-pane#${currentTabId} tbody tr.searchable-row`));
            let visibleRows = activeTableRows.filter(row => !row.classList.contains('hidden-by-search'));
            
            const totalRows = visibleRows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage) || 1;
            
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;
            
            const startIdx = (currentPage - 1) * rowsPerPage;
            const endIdx = startIdx + rowsPerPage;
            
            activeTableRows.forEach(row => row.classList.add('hidden-by-page'));
            
            visibleRows.slice(startIdx, endIdx).forEach(row => {
                row.classList.remove('hidden-by-page');
            });
            
            document.getElementById('pageStart').textContent = totalRows === 0 ? 0 : startIdx + 1;
            document.getElementById('pageEnd').textContent = Math.min(endIdx, totalRows);
            document.getElementById('pageTotal').textContent = totalRows;
            document.getElementById('pageNumbers').textContent = `Hal ${currentPage} dari ${totalPages}`;
            
            document.getElementById('btnPrev').disabled = currentPage === 1;
            document.getElementById('btnNext').disabled = currentPage === totalPages;
        }

        if(searchInput) {
            searchInput.addEventListener("keyup", function () {
                const filter = this.value.toLowerCase();
                const activeTableRows = document.querySelectorAll(`.tab-pane#${currentTabId} tbody tr.searchable-row`);
                
                activeTableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if(text.includes(filter)) {
                        row.classList.remove('hidden-by-search');
                    } else {
                        row.classList.add('hidden-by-search');
                    }
                });
                currentPage = 1;
                renderTable();
            });
        }

        document.getElementById('btnPrev').addEventListener('click', () => {
            if (currentPage > 1) { currentPage--; renderTable(); }
        });
        
        document.getElementById('btnNext').addEventListener('click', () => {
            currentPage++; renderTable();
        });

        renderTable();
    });
</script>
@endpush

@endsection
