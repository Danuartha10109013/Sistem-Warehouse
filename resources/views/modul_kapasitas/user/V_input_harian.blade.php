@extends('modul_kapasitas.layout.V_template')

@section('title', 'Data Harian')

@section('content')
<div class="card h-full">
    <div class="card-body">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Rekap Stok Kapasitas Warehouse</h4>
                <p class="text-sm text-gray-500 mt-1">Impor data dari Excel untuk diakumulasikan ke dalam tabel stok harian.</p>
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

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-darkgray p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <!-- Filter Bulan/Tahun -->
            <form method="GET" action="{{ route('modul-kapasitas.input-harian') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                @php
                    // Format year-month for the input value (e.g. "2026-07")
                    $currentFilterValue = sprintf('%04d-%02d', $year, $month);
                @endphp
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="month" name="filter_month" value="{{ $currentFilterValue }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white shadow-sm transition-colors cursor-pointer" onchange="this.form.submit()">
                </div>
            </form>
            
            <div class="relative flex-grow md:w-64">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                    </div>
                    <input type="text" id="table-search" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white shadow-sm transition-colors" placeholder="Cari kategori...">
                </div>

            <button type="button" data-modal-target="importModal" data-modal-toggle="importModal" class="text-white bg-primary hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Input Data Baru
            </button>
        </div>

        <!-- Top Scrollbar (Sinkronisasi dengan tabel di bawahnya) -->
        <style>
            .sticky-shadow {
                position: sticky;
                left: 0;
            }
            
            /* Trik agar shadow bisa keluar dari tabel dan menutupi sel di sebelahnya */
            .sticky-shadow::after {
                content: '';
                position: absolute;
                top: 0;
                right: -10px;
                bottom: 0;
                width: 10px;
                box-shadow: inset 6px 0 8px -4px rgba(0,0,0,0.25);
                pointer-events: none;
                z-index: 50;
            }
        </style>

        <div id="topScrollbar" class="w-full overflow-x-auto overflow-y-hidden mb-1 custom-scrollbar">
            <div id="topScrollbarContent" class="h-[1px]"></div>
        </div>

        <!-- Tabel Data -->
        <div id="tableContainer" class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md custom-scrollbar">
            <table id="dataTable" class="w-full text-base text-left text-gray-700 dark:text-gray-300">
                <thead class="text-xs text-white uppercase bg-primary dark:bg-blue-900 shadow-sm relative z-40">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-extrabold border-b border-blue-400 dark:border-blue-700 whitespace-nowrap sticky left-0 z-50 bg-primary dark:bg-blue-900 text-sm sticky-shadow">KATEGORI STOCK</th>
                        @for($d = 1; $d <= $daysInMonth; $d++)
                            <th scope="col" class="px-3 py-4 text-center border-b border-r border-blue-400 dark:border-blue-700 min-w-[50px] last:border-r-0 bg-blue-600 dark:bg-blue-800 shadow-inner font-bold text-sm">{{ $d }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="relative z-10">
                    @php 
                        $groupColors = [
                            'BAHAN BAKU' => 'bg-green-200 dark:bg-green-900 text-green-900 dark:text-green-100',
                            'BARANG JADI' => 'bg-blue-200 dark:bg-blue-900 text-blue-900 dark:text-blue-100',
                            'LIMBAH' => 'bg-orange-200 dark:bg-orange-900 text-orange-900 dark:text-orange-100'
                        ];
                    @endphp

                    @forelse(['BAHAN BAKU', 'BARANG JADI', 'LIMBAH'] as $groupName)
                        @if(isset($pivot[$groupName]) && count($pivot[$groupName]) > 0)
                            <!-- Group Header Row -->
                            <tr class="bg-gray-50 dark:bg-gray-800 relative">
                                <td class="px-6 py-3 font-extrabold text-base sticky left-0 z-40 border-b border-gray-300 dark:border-gray-600 {{ $groupColors[$groupName] }} sticky-shadow">
                                    {{ $groupName }}
                                </td>
                                <td colspan="{{ $daysInMonth }}" class="border-b border-gray-300 dark:border-gray-600 {{ $groupColors[$groupName] }} opacity-70"></td>
                            </tr>
                            
                            @php $rowIndex = 0; @endphp
                            @foreach($pivot[$groupName] as $kategori => $days)
                                @php 
                                    $isEven = $rowIndex % 2 == 0; 
                                    $bgClass = $isEven ? 'bg-white dark:bg-darkgray' : 'bg-gray-50 dark:bg-gray-800';
                                    $stickyBgClass = $isEven ? 'bg-white dark:bg-darkgray' : 'bg-gray-50 dark:bg-gray-800';
                                    
                                    // Special highlight for PRD and QA to match user's excel
                                    if ($kategori === 'PRD' || $kategori === 'QA' || str_contains($kategori, 'PRD') || str_contains($kategori, 'QA')) {
                                        $bgClass = 'bg-orange-50 dark:bg-orange-900/30';
                                        $stickyBgClass = 'bg-orange-50 dark:bg-orange-900/30';
                                        if (str_contains($kategori, 'PRD')) {
                                            $bgClass = 'bg-red-50 dark:bg-red-900/30';
                                            $stickyBgClass = 'bg-red-50 dark:bg-red-900/30 text-red-600';
                                        }
                                        if (str_contains($kategori, 'QA')) {
                                            $bgClass = 'bg-orange-100 dark:bg-orange-800/30';
                                            $stickyBgClass = 'bg-orange-100 dark:bg-orange-800/30 text-red-600';
                                        }
                                    }
                                    $rowIndex++;
                                @endphp
                                <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors group {{ $bgClass }} relative">
                                    <td class="px-6 py-3 font-medium text-gray-800 whitespace-nowrap dark:text-gray-200 sticky left-0 z-30 group-hover:bg-gray-200 dark:group-hover:bg-gray-600 {{ $stickyBgClass }} transition-colors sticky-shadow">
                                        {{ $kategori }}
                                    </td>
                                    @for($d = 1; $d <= $daysInMonth; $d++)
                                        <td class="px-2 py-3 text-center border-r border-gray-300 dark:border-gray-600 last:border-r-0 hover:bg-blue-100 dark:hover:bg-gray-500 transition-colors cursor-default {{ $days[$d] > 0 ? 'text-gray-800 dark:text-gray-200 font-medium' : 'text-transparent' }}">
                                            {{ $days[$d] > 0 ? number_format($days[$d], 0, ',', '.') : '' }}
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endif
                    @empty
                        <tr class="bg-white dark:bg-darkgray">
                            <td colspan="{{ $daysInMonth + 1 }}" class="px-6 py-10 text-center text-gray-500 text-lg">Belum ada data stok untuk bulan ini...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Input Baru -->
<div id="importModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-darkgray">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Import Data Harian Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="importModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('modul-kapasitas.input-harian.import') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Tanggal</label>
                        <input type="date" name="tanggal" id="importTanggal" value="{{ date('Y-m-d') }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-dark dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        
                        <!-- Indikator sudah di-input -->
                        <div id="importedIndicator" class="mt-3 text-sm text-gray-500 hidden">
                            <span class="block mb-1">Telah diinput pada tanggal ini:</span>
                            <div id="importedSourcesList" class="flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sumber (Source)</label>
                        <select name="source" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-dark dark:border-gray-500 dark:text-white">
                            <option value="">-- Pilih Sumber --</option>
                            @foreach($sources as $src => $fmt)
                            <option value="{{ $src }}">{{ $src }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Excel (.xlsx/.xls)</label>
                        <input type="file" name="file" accept=".xlsx,.xls" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-dark dark:border-gray-500 dark:placeholder-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 dark:file:bg-gray-700 dark:file:text-white dark:hover:file:bg-gray-600 transition-colors">
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-600">
                    <button data-modal-hide="importModal" type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                    <button type="submit" class="text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Search Table Functionality
    const searchInput = document.getElementById('table-search');
    const tableRows = document.querySelectorAll('tbody tr.group');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const categoryCell = row.querySelector('td:first-child');
            if (categoryCell) {
                const text = categoryCell.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });

    // 2. Fetch Imported Sources on Date Change
    const tanggalInput = document.getElementById('importTanggal');
    const indicatorDiv = document.getElementById('importedIndicator');
    const indicatorList = document.getElementById('importedSourcesList');

    function checkImportedSources(dateValue) {
        if(!dateValue) return;
        
        fetch(`{{ route('modul-kapasitas.input-harian.check-sources') }}?tanggal=${dateValue}`)
            .then(res => res.json())
            .then(data => {
                if (data && data.length > 0) {
                    indicatorList.innerHTML = data.map(src => `
                        <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-md border border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800">
                            ${src}
                            <button type="button" onclick="deleteSource('${src}', '${dateValue}')" class="text-red-500 hover:text-red-700 font-bold ml-1 text-base leading-none" title="Hapus Data Ini">&times;</button>
                        </span>
                    `).join('');
                    indicatorDiv.classList.remove('hidden');
                } else {
                    indicatorDiv.classList.add('hidden');
                    indicatorList.innerHTML = '';
                }
            })
            .catch(err => console.error('Error fetching sources:', err));
    }

    // 2b. Function to handle deletion via dynamic form
    window.deleteSource = function(source, tanggal) {
        if(confirm('Hapus semua data dari sumber ' + source + ' pada tanggal ' + tanggal + '?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('modul-kapasitas.input-harian.delete-source') }}";
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = "{{ csrf_token() }}";
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            const tanggalInput = document.createElement('input');
            tanggalInput.type = 'hidden';
            tanggalInput.name = 'tanggal';
            tanggalInput.value = tanggal;
            form.appendChild(tanggalInput);

            const sourceInput = document.createElement('input');
            sourceInput.type = 'hidden';
            sourceInput.name = 'source';
            sourceInput.value = source;
            form.appendChild(sourceInput);

            document.body.appendChild(form);
            form.submit();
        }
    };

    // Check when modal is opened (useful for initial date value)
    document.querySelector('[data-modal-target="importModal"]').addEventListener('click', function() {
        checkImportedSources(tanggalInput.value);
    });

    // Check when date changes
    tanggalInput.addEventListener('change', function() {
        checkImportedSources(this.value);
    });
    
    // 3. Sync Top and Bottom Scrollbars
    const topScrollbar = document.getElementById('topScrollbar');
    const topScrollbarContent = document.getElementById('topScrollbarContent');
    const tableContainer = document.getElementById('tableContainer');
    const dataTable = document.getElementById('dataTable');

    function syncScrollWidth() {
        if(dataTable && topScrollbarContent) {
            topScrollbarContent.style.width = dataTable.offsetWidth + 'px';
        }
    }

    // Initial sync
    syncScrollWidth();
    // Sync on window resize
    window.addEventListener('resize', syncScrollWidth);

    let isSyncingLeftScroll = false;
    let isSyncingRightScroll = false;

    topScrollbar.addEventListener('scroll', function() {
        if (!isSyncingLeftScroll) {
            isSyncingRightScroll = true;
            tableContainer.scrollLeft = this.scrollLeft;
        }
        isSyncingLeftScroll = false;
    });

    tableContainer.addEventListener('scroll', function() {
        if (!isSyncingRightScroll) {
            isSyncingLeftScroll = true;
            topScrollbar.scrollLeft = this.scrollLeft;
        }
        isSyncingRightScroll = false;
    });
});
</script>
@endsection
