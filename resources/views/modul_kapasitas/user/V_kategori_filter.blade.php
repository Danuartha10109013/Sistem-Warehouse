@extends('modul_kapasitas.layout.V_template')

@section('title', 'Kelola Filter Kategori')

@section('content')
<div class="mb-6">
    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Filter Kategori</h4>
    <p class="text-gray-500 dark:text-gray-400 mt-1">
        Daftar kategori di bawah ini akan diabaikan (tidak dihitung stoknya) saat Anda mengimpor data harian.
    </p>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Berhasil!</span> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Gagal!</span> {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Form Tambah Filter -->
    <div class="md:col-span-1">
        <div class="bg-white dark:bg-darkgray rounded-xl p-6 border-t-4 border-t-primary shadow-sm border-gray-100 dark:border-gray-700">
            <h5 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tambah Filter Baru</h5>
            <form action="{{ route('modul-kapasitas.filter-kategori.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                    <input type="text" id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary" placeholder="Contoh: Reject, Kosong, dll." required>
                    <p class="text-xs text-gray-500 mt-2">Nama kategori tidak bersifat <em>Case Sensitive</em> (huruf besar/kecil dianggap sama).</p>
                </div>
                <button type="submit" class="w-full text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Filter -->
    <div class="md:col-span-2">
        <div class="bg-white dark:bg-darkgray rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="relative overflow-x-auto">
                <table class="w-full text-base text-left text-gray-700 dark:text-gray-300">
                    <thead class="text-xs text-white uppercase bg-primary dark:bg-blue-900 shadow-sm">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-16 text-center">No</th>
                            <th scope="col" class="px-6 py-3">Nama Kategori yang Diblokir</th>
                            <th scope="col" class="px-6 py-3 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($filters as $index => $filter)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-center font-medium text-gray-900 dark:text-white">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $filter->kategori }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('modul-kapasitas.filter-kategori.destroy', $filter->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus filter kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline flex items-center justify-center gap-1 mx-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-gray-400"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                        <p>Belum ada kategori yang difilter.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
