@extends('modul_kapasitas.layout.V_template')

@section('title', 'Kelola Kapasitas')

@section('content')
<div class="card h-full">
    <div class="card-body">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Kelola Kapasitas</h4>
                <p class="text-sm text-gray-500 mt-1">Atur nilai kapasitas stok yang akan digunakan untuk perhitungan bulanan.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('modul-kapasitas.kelola-kapasitas.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl">
                <!-- Card CRC -->
                <div class="bg-white dark:bg-darkgray p-6 rounded-xl shadow-sm border-t-4 border-t-primary border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-100 text-primary rounded-lg dark:bg-blue-900/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 dark:text-white">Kapasitas CRC</h5>
                    </div>
                    
                    <div class="mb-4">
                        <label for="kapasitas_crc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Target Kapasitas (Ton)</label>
                        <input type="number" step="0.001" id="kapasitas_crc" name="kapasitas_crc" value="{{ old('kapasitas_crc', $kapasitasCrc) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-base font-semibold rounded-lg focus:ring-primary focus:border-primary block w-full p-3 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-colors" placeholder="Contoh: 6760" required />
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Nilai ini digunakan sebagai pembagi (limit) untuk menghitung persentase <b>Trend</b> pada modul Kapasitas CRC.</p>
                    </div>
                </div>
                
                <!-- Card Barang Jadi -->
                <div class="bg-white dark:bg-darkgray p-6 rounded-xl shadow-sm border-t-4 border-t-green-500 border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-green-100 text-green-600 rounded-lg dark:bg-green-900/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 dark:text-white">Kapasitas Barang Jadi</h5>
                    </div>
                    
                    <div class="mb-4">
                        <label for="kapasitas_barang_jadi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Target Kapasitas (Ton)</label>
                        <input type="number" step="0.001" id="kapasitas_barang_jadi" name="kapasitas_barang_jadi" value="{{ old('kapasitas_barang_jadi', $kapasitasBarangJadi ?? '10000') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-base font-semibold rounded-lg focus:ring-primary focus:border-primary block w-full p-3 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-colors" placeholder="Contoh: 10000" required />
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Nilai ini digunakan sebagai pembagi (limit) untuk menghitung persentase <b>Trend</b> pada modul Kapasitas Barang Jadi.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 max-w-4xl flex justify-end">
                <button type="submit" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center shadow-md flex items-center gap-2 transition-all hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
