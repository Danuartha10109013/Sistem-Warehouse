@extends('stock.layout.V_template')
@section('title', 'Data Stock')

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

@push('styles')
<style>
    .hidden-by-search { display: none !important; }
    .hidden-by-page { display: none !important; }
    .hidden-by-toggle { display: none !important; }
</style>
@endpush

<div class="card h-full min-w-0">
    <div class="card-body min-w-0">
        <!-- Page Title -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white uppercase">Update Stock Bahan Baku</h4>
                @if($data->last())
                <p class="text-sm text-gray-500 mt-1">Last updated {{ $data->last()->created_at->format('d-m-Y H:i:s') }}</p>
                @else
                <p class="text-sm text-gray-500 mt-1">No data found</p>
                @endif
            </div>
        </div>

        <!-- Action Buttons + Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-darkgray p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            
            <div class="relative w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                </div>
                <input type="text" id="searchInput" class="block w-full md:w-80 p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari cepat (Ketik di sini...)">
            </div>
            
            <div class="flex gap-2 w-full md:w-auto justify-end">
                <button type="button" data-modal-target="scanModal" data-modal-toggle="scanModal" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Update Data
                </button>
            </div>

            <!-- BUTTON FILTER / TOGGLE -->
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" id="btnBelum" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-4 py-2 transition-colors">Belum Scan</button>
                <button type="button" id="btnSudah" class="text-green-600 border border-green-600 hover:bg-green-600 hover:text-white font-medium rounded-lg text-sm px-4 py-2 transition-colors">Sudah Scan</button>
                
                @foreach($kategori->pluck('jenis')->unique() as $jenis)
                    <button class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-4 py-2 transition-colors dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">{{ $jenis }}</button>
                @endforeach
            </div>

        </div>

        <div class="mb-4">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Data: <span class="text-red-600">{{ $data->count() }}</span></span>
        </div>

        <!-- Table -->
        <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
            <table class="w-full text-xs xl:text-sm text-left text-gray-700 dark:text-gray-300" id="dataTable">
                <thead class="text-xs text-white uppercase bg-primary dark:bg-blue-900 shadow-sm">
                    <tr>
                        <th class="px-3 py-3 text-center border-b border-blue-400 dark:border-blue-700 font-bold">No</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Date</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">KPC</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Barcode</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Nama Barang</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Berat</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Lokasi</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Storagebin Awal</th>
                        <th class="px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Storagebin Hasil</th>
                        <th class="col-scan px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Scanner</th>
                        <th class="col-scan px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Berat SO</th>
                        <th class="col-scan px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Selisih SO</th>
                        <th class="col-scan px-3 py-3 border-b border-blue-400 dark:border-blue-700 font-bold">Keterangan</th>
                        <th class="px-3 py-3 text-center border-b border-blue-400 dark:border-blue-700 font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr class="searchable-row border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors bg-white dark:bg-darkgray {{ $d->scanner ? 'row-sudah' : 'row-belum' }}">
                        <td class="px-3 py-3 text-center font-medium">{{ $loop->iteration }}</td>
                        <td class="px-3 py-3">{{ $d->date }}</td>
                        <td class="px-3 py-3">{{ $d->kpc }}</td>
                        <td class="px-3 py-3">{{ $d->barcode }}</td>
                        <td class="px-3 py-3">{{ $d->namabarang }}</td>
                        <td class="px-3 py-3">{{ $d->berat }}</td>
                        <td class="px-3 py-3">{{ $d->lokasi }}</td>
                        <td class="px-3 py-3">{{ $d->storagebin ?? '-' }}</td>
                        <td class="px-3 py-3">{{ $d->storagebin_hasil ?? '-' }}</td>

                        <td class="col-scan px-3 py-3">{{ $d->scanner ?? '-' }}</td>
                        <td class="col-scan px-3 py-3">{{ $d->scanner ? $d->qty_scan : '-' }}</td>
                        <td class="col-scan px-3 py-3">
                            {{ $d->scanner ? ($d->berat - $d->qty_scan) : '-' }}
                        </td>
                        <td class="col-scan px-3 py-3">{!! nl2br(e($d->keterangan)) !!}</td>
                        <td class="px-3 py-3 text-center flex justify-center gap-2">
                            <!-- Action buttons -->
                            <button data-modal-target="editModal{{ $d->id }}" data-modal-toggle="editModal{{ $d->id }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button data-modal-target="deleteModal{{ $d->id }}" data-modal-toggle="deleteModal{{ $d->id }}" class="text-red-600 hover:text-red-800" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

<!-- Modal Scan/Update Excel -->
<div id="scanModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-lg font-semibold text-white">
                    <i class="fa fa-upload me-2"></i> Update Data Barang
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="scanModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('stock.excel') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
                        <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="masuk">Barang Masuk</option>
                            <option value="keluar">Barang Keluar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File</label>
                        <input type="file" name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".xlsx,.xls,.csv,.pdf" required>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">Format: Excel / CSV</p>
                    </div>
                </div>
                <div class="flex justify-end pt-2 border-t border-gray-200 dark:border-gray-600">
                    <button type="button" data-modal-hide="scanModal" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                    <button type="submit" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2">
                        <i class="fa fa-paper-plane me-1"></i> Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($data)
    @foreach ($data as $d)
        <!-- Modal Edit -->
        <div id="editModal{{ $d->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-primary">
                        <h3 class="text-lg font-semibold text-white">
                            Edit Laporan {{ $d->id }}
                        </h3>
                        <button type="button" class="text-white bg-transparent hover:bg-blue-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editModal{{ $d->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST" action="{{ route('pac.update', $d->id) }}" class="p-4 md:p-5">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-3">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                <input type="datetime-local" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" value="{{ $d->date }}">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attribute</label>
                                <input type="text" name="attribute" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" value="{{ $d->attribute }}">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group</label>
                                <select name="group" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="A" {{ $d->group=='A'?'selected':'' }}>Group A</option>
                                    <option value="B" {{ $d->group=='B'?'selected':'' }}>Group B</option>
                                    <option value="Lokal" {{ $d->group=='Lokal'?'selected':'' }}>Group Lokal</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Layout</label>
                                <input type="text" name="layout" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" value="{{ $d->layout }}">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No SO</label>
                                <input type="text" name="no_so" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" value="{{ $d->no_so }}">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kondisi</label>
                                <select name="kondisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="Baik" {{ $d->kondisi=='Baik'?'selected':'' }}>Baik</option>
                                    <option value="Damage Realese QA" {{ $d->kondisi=='Damage Realese QA'?'selected':'' }}>Damage Realese QA</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PE & VCI</label>
                                <select name="plastik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="OK" {{ $d->plastik=='OK'?'selected':'' }}>OK</option>
                                    <option value="Not OK" {{ $d->plastik=='Not OK'?'selected':'' }}>Not OK</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wrapping</label>
                                <select name="wrapping" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="Pakai" {{ $d->wrapping=='Pakai'?'selected':'' }}>Pakai</option>
                                    <option value="Tidak Pakai" {{ $d->wrapping=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Impraboard</label>
                                <select name="impraboard" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="Pakai" {{ $d->impraboard=='Pakai'?'selected':'' }}>Pakai</option>
                                    <option value="Tidak Pakai" {{ $d->impraboard=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID & OD</label>
                                <select name="idod" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="OK" {{ $d->idod=='OK'?'selected':'' }}>OK</option>
                                    <option value="Not OK" {{ $d->idod=='Not OK'?'selected':'' }}>Not OK</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pallet</label>
                                <select name="pallet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="Pakai" {{ $d->pallet=='Pakai'?'selected':'' }}>Pakai</option>
                                    <option value="Tidak Pakai" {{ $d->pallet=='Tidak Pakai'?'selected':'' }}>Tidak Pakai</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bandazer</label>
                                <select name="bandazer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                    <option value="OK" {{ $d->bandazer=='OK'?'selected':'' }}>OK</option>
                                    <option value="Not OK" {{ $d->bandazer=='Not OK'?'selected':'' }}>Not OK</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end pt-2 border-t border-gray-200 dark:border-gray-600 mt-4">
                            <button type="button" data-modal-hide="editModal{{ $d->id }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100">Close</button>
                            <button type="submit" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div id="deleteModal{{ $d->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-red-600">
                        <h3 class="text-lg font-semibold text-white">Confirm Delete</h3>
                        <button type="button" class="text-white bg-transparent hover:bg-red-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="deleteModal{{ $d->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('pac.delete', $d->id) }}" class="p-4 md:p-5">
                        @csrf
                        @method('DELETE')
                        <div class="mb-4">
                            <p class="font-bold text-gray-800 dark:text-gray-200">Yakin ingin menghapus data ini?</p>
                            <p class="text-sm text-gray-500 mt-1">No SO: {{ $d->no_so }} | Attribute: {{ $d->attribute }}</p>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="button" data-modal-hide="deleteModal{{ $d->id }}" class="py-2.5 px-5 me-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">Cancel</button>
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnBelum = document.getElementById("btnBelum");
        const btnSudah = document.getElementById("btnSudah");
        const searchInput = document.getElementById("searchInput");
        const tableRows = Array.from(document.querySelectorAll("tbody tr.searchable-row"));
        
        let currentPage = 1;
        const rowsPerPage = 10;

        function renderTable() {
            let visibleRows = tableRows.filter(row => !row.classList.contains('hidden-by-search') && !row.classList.contains('hidden-by-toggle'));
            
            const totalRows = visibleRows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage) || 1;
            
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;
            
            const startIdx = (currentPage - 1) * rowsPerPage;
            const endIdx = startIdx + rowsPerPage;
            
            tableRows.forEach(row => row.classList.add('hidden-by-page'));
            
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

        function aktifkanModeBelum() {
            btnBelum.classList.remove("border", "border-red-600", "text-red-600", "hover:bg-red-600", "hover:text-white");
            btnBelum.classList.add("bg-red-600", "text-white");
            
            btnSudah.classList.remove("bg-green-600", "text-white");
            btnSudah.classList.add("border", "border-green-600", "text-green-600", "hover:bg-green-600", "hover:text-white");

            document.querySelectorAll(".col-scan").forEach(col => col.style.display = "none");

            tableRows.forEach(r => {
                r.style.display = '';
                if (r.classList.contains('row-sudah')) {
                    r.classList.add('hidden-by-toggle');
                } else {
                    r.classList.remove('hidden-by-toggle');
                }
            });
            currentPage = 1;
            renderTable();
        }

        btnBelum.addEventListener("click", aktifkanModeBelum);

        btnSudah.addEventListener("click", function () {
            btnSudah.classList.remove("border", "border-green-600", "text-green-600", "hover:bg-green-600", "hover:text-white");
            btnSudah.classList.add("bg-green-600", "text-white");

            btnBelum.classList.remove("bg-red-600", "text-white");
            btnBelum.classList.add("border", "border-red-600", "text-red-600", "hover:bg-red-600", "hover:text-white");

            document.querySelectorAll(".col-scan").forEach(col => col.style.display = "");

            tableRows.forEach(r => {
                r.style.display = '';
                if (r.classList.contains('row-belum')) {
                    r.classList.add('hidden-by-toggle');
                } else {
                    r.classList.remove('hidden-by-toggle');
                }
            });
            currentPage = 1;
            renderTable();
        });

        // AUTO AKTIF SAAT PERTAMA KALI HALAMAN LOAD
        aktifkanModeBelum();

        if(searchInput) {
            searchInput.addEventListener("keyup", function () {
                const filter = this.value.toLowerCase();
                tableRows.forEach(row => {
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
    });
</script>
@endpush

@endsection
