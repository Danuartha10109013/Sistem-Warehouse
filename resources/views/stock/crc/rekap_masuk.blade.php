@extends('stock.layout.V_template')
@section('title', 'Data Stock CRC - REKAP MASUK')

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
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white uppercase">REKAP CRC MASUK DAN KELUAR</h4>
                <p class="text-sm text-gray-500 mt-1">Menampilkan rekapitulasi data stock masuk dan keluar kategori CRC untuk semua supplier</p>
            </div>
            <div class="mt-4 md:mt-0">
                <form action="{{ url()->current() }}" method="GET" class="flex items-center space-x-2">
                    <div>
                        <input type="month" name="start_date" value="{{ $start_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <span class="text-gray-500">-</span>
                    <div>
                        <input type="month" name="end_date" value="{{ $end_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Filter</button>
                </form>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="rekapTabs" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 rounded-t-lg text-primary border-primary font-bold dark:text-blue-500 dark:border-blue-500" id="rekap-crc-tab" data-target="rekap-crc" type="button" role="tab">REKAP CRC</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="masuk-perbulan-tab" data-target="masuk-perbulan" type="button" role="tab">REKAP MASUK PERBULAN</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="keluar-perbulan-tab" data-target="keluar-perbulan" type="button" role="tab">REKAP KELUAR PERBULAN</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="chart-tab" data-target="chart" type="button" role="tab">CHART</button>
                </li>
            </ul>
        </div>
        
        <div id="rekapTabContent">
            <!-- TAB 1: REKAP CRC -->
            <div class="tab-pane active" id="rekap-crc" role="tabpanel">
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md mt-6">
            <table class="w-full text-[11px] xl:text-xs text-left text-gray-700 dark:text-gray-300">
                <thead class="text-[11px] text-black bg-orange-200 dark:bg-orange-600 shadow-sm border-b-2 border-black">
                    <tr>
                        <th class="px-2 py-2 border-r border-b border-black font-bold text-center uppercase" colspan="2">UKURAN</th>
                        <th class="px-2 py-2 border-r border-b border-black font-bold text-center uppercase" colspan="{{ count($supplier_columns) }}">SUPPLIER</th>
                        <th class="px-2 py-2 font-bold text-center border-black uppercase" rowspan="2">TOTAL KG</th>
                    </tr>
                    <tr>
                        <th class="px-2 py-1 border-r border-black font-bold bg-orange-100 text-center">UKURAN</th>
                        <th class="px-2 py-1 border-r border-black font-bold bg-orange-100 text-center">GRADE</th>
                        @foreach($supplier_columns as $col)
                            <th class="px-2 py-1 border-r border-black font-bold text-center bg-orange-100 uppercase">{{ $col }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekap_crc_masuk as $r)
                    <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white">
                        <td class="px-2 py-1 border-r border-gray-300 whitespace-nowrap">{{ $r['ukuran'] }}</td>
                        <td class="px-2 py-1 border-r border-gray-300 text-[10px] whitespace-nowrap">{{ $r['grade'] }}</td>
                        @foreach($supplier_columns as $col)
                            <td class="px-2 py-1 text-right border-r border-gray-300">{{ $r[$col] > 0 ? number_format($r[$col], 0, ',', '.') : '-' }}</td>
                        @endforeach
                        <td class="px-2 py-1 text-right font-bold bg-orange-50 border-l border-gray-300">{{ number_format($r['TOTAL KG'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 3 + count($supplier_columns) }}" class="px-3 py-3 text-center text-gray-500">Belum ada rekap crc masuk</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-black bg-orange-200 font-bold text-black text-[11px]">
                        <td class="px-2 py-2 border-r border-black text-right" colspan="2">TOTAL</td>
                        @foreach($supplier_columns as $col)
                            <td class="px-2 py-2 border-r border-black text-right">{{ $total_rekap_crc[$col] > 0 ? number_format($total_rekap_crc[$col], 0, ',', '.') : '-' }}</td>
                        @endforeach
                        <td class="px-2 py-2 border-black text-right">{{ number_format($total_rekap_crc['TOTAL KG'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
                </div>
            </div>

            <!-- TAB 2: REKAP MASUK PERBULAN -->
            <div class="tab-pane hidden" id="masuk-perbulan" role="tabpanel">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 mt-6">
                    <h5 class="text-md font-semibold text-gray-800 dark:text-white uppercase">REKAP CRC MASUK</h5>
                </div>
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-[11px] xl:text-xs text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-[11px] text-black bg-orange-200 dark:bg-orange-600 shadow-sm border-b-2 border-black">
                            <tr>
                                <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">SUPPLIER</th>
                                @foreach ($months_labels as $key => $label)
                                <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">{{ $label }}</th>
                                @endforeach
                                <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">TOTAL</th>
                                <th class="px-2 py-2 border-black font-bold text-center uppercase">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier_list_perbulan as $sup)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white">
                                <td class="px-2 py-1 border-r border-gray-300 whitespace-nowrap">{{ $sup }}</td>
                                @foreach ($months_perbulan as $m)
                                    <td class="px-2 py-1 text-right border-r border-gray-300">{{ $rekap_masuk_perbulan[$sup][$m] > 0 ? number_format($rekap_masuk_perbulan[$sup][$m], 0, ',', '.') : '-' }}</td>
                                @endforeach
                                <td class="px-2 py-1 text-right border-r border-gray-300 font-bold bg-orange-50">{{ number_format($rekap_masuk_perbulan[$sup]['TOTAL'], 0, ',', '.') }}</td>
                                <td class="px-2 py-1 text-right border-gray-300">{{ $rekap_masuk_perbulan[$sup]['PERCENTAGE'] }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-black bg-orange-200 font-bold text-black text-[11px]">
                                <td class="px-2 py-2 border-r border-black text-left">TOTAL</td>
                                @foreach ($months_perbulan as $m)
                                    <td class="px-2 py-2 border-r border-black text-right">{{ $total_per_bulan[$m] > 0 ? number_format($total_per_bulan[$m], 0, ',', '.') : '-' }}</td>
                                @endforeach
                                <td class="px-2 py-2 border-r border-black text-right">{{ number_format($total_per_bulan['TOTAL'], 0, ',', '.') }}</td>
                                <td class="px-2 py-2 border-black text-right">{{ $total_per_bulan['PERCENTAGE'] }}%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- TAB 3: REKAP KELUAR PERBULAN -->
            <div class="tab-pane hidden" id="keluar-perbulan" role="tabpanel">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 mt-6">
                    <h5 class="text-md font-semibold text-gray-800 dark:text-white uppercase">REKAP CRC KELUAR</h5>
                </div>
                <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
                    <table class="w-full text-[11px] xl:text-xs text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-[11px] text-black bg-orange-200 dark:bg-orange-600 shadow-sm border-b-2 border-black">
                            <tr>
                                <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">SUPPLIER</th>
                                @foreach ($months_labels as $key => $label)
                                <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">{{ $label }}</th>
                                @endforeach
                                <th class="px-2 py-2 border-black font-bold text-center uppercase">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier_list_keluar as $sup)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white">
                                <td class="px-2 py-1 border-r border-gray-300 whitespace-nowrap">{{ $sup }}</td>
                                @foreach ($months_keluar as $m)
                                    <td class="px-2 py-1 text-right border-r border-gray-300">{{ $rekap_keluar_perbulan[$sup][$m] > 0 ? number_format($rekap_keluar_perbulan[$sup][$m], 0, ',', '.') : '-' }}</td>
                                @endforeach
                                <td class="px-2 py-1 text-right border-gray-300 font-bold bg-orange-50">{{ number_format($rekap_keluar_perbulan[$sup]['TOTAL'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-black bg-orange-200 font-bold text-black text-[11px]">
                                <td class="px-2 py-2 border-r border-black text-left">TOTAL</td>
                                @foreach ($months_keluar as $m)
                                    <td class="px-2 py-2 border-r border-black text-right">{{ $total_keluar_per_bulan[$m] > 0 ? number_format($total_keluar_per_bulan[$m], 0, ',', '.') : '-' }}</td>
                                @endforeach
                                <td class="px-2 py-2 border-black text-right">{{ number_format($total_keluar_per_bulan['TOTAL'], 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- TAB 4: CHART -->
            <div class="tab-pane hidden" id="chart" role="tabpanel">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-6">
                    <!-- SECTION: MASUK (PENERIMAAN) -->
                    <div>
                        <h5 class="text-md font-bold text-gray-800 dark:text-white uppercase mb-4">PENERIMAAN CRC ({{ \Carbon\Carbon::parse($start_date)->translatedFormat('M Y') }} - {{ \Carbon\Carbon::parse($end_date)->translatedFormat('M Y') }})</h5>
                        
                        <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md mb-6">
                            <table class="w-full text-[11px] xl:text-xs text-left text-gray-700 dark:text-gray-300">
                                <thead class="text-[11px] text-black bg-yellow-300 dark:bg-yellow-600 shadow-sm border-b-2 border-black">
                                    <tr>
                                        <th class="px-2 py-2 border-r border-black font-bold uppercase">SUPPLIER</th>
                                        <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">LOKAL</th>
                                        <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">IMPORT</th>
                                        <th class="px-2 py-2 border-black font-bold text-center uppercase">% Supp vs Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chart_masuk as $sup => $data)
                                    <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white">
                                        <td class="px-2 py-1 border-r border-gray-300">{{ $sup }}</td>
                                        <td class="px-2 py-1 text-right border-r border-gray-300">{{ $data['lokal'] > 0 ? number_format($data['lokal'], 0, ',', '.') : '-' }}</td>
                                        <td class="px-2 py-1 text-right border-r border-gray-300">{{ $data['import'] > 0 ? number_format($data['import'], 0, ',', '.') : '-' }}</td>
                                        <td class="px-2 py-1 text-right border-gray-300">{{ number_format($data['pct'], 2, ',', '.') }}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-t-2 border-black bg-yellow-300 font-bold text-black text-[11px]">
                                        <td class="px-2 py-2 border-r border-black text-center">TOTAL</td>
                                        <td class="px-2 py-2 border-r border-black text-right">{{ number_format($total_masuk_lokal, 0, ',', '.') }}</td>
                                        <td class="px-2 py-2 border-r border-black text-right">{{ number_format($total_masuk_import, 0, ',', '.') }}</td>
                                        <td class="px-2 py-2 border-black text-right">100,00%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mb-4">
                            <table class="w-2/3 text-[11px] xl:text-xs text-left border border-black mb-4">
                                <tr>
                                    <th class="px-2 py-1 border-r border-black font-bold bg-gray-100">% LOKAL vs IMPORT</th>
                                    <th class="px-2 py-1 border-r border-black text-center font-bold">{{ number_format($pct_masuk_lokal, 2, ',', '.') }}%</th>
                                    <th class="px-2 py-1 text-center font-bold">{{ number_format($pct_masuk_import, 2, ',', '.') }}%</th>
                                </tr>
                            </table>
                            <table class="w-1/2 text-[11px] xl:text-xs text-left border border-black">
                                <tr>
                                    <th class="px-2 py-1 border-r border-black font-bold bg-yellow-300">TOTAL CRC MASUK</th>
                                    <th class="px-2 py-1 text-center font-bold bg-yellow-300">{{ number_format($total_masuk_all, 0, ',', '.') }}</th>
                                </tr>
                            </table>
                        </div>

                        <div class="border-2 border-green-600 p-4 rounded-lg bg-white mt-4">
                            <h6 class="text-center font-bold text-sm mb-4">PENERIMAAN CRC<br>{{ \Carbon\Carbon::parse($start_date)->translatedFormat('M Y') }} - {{ \Carbon\Carbon::parse($end_date)->translatedFormat('M Y') }}</h6>
                            <canvas id="chartMasuk" height="200"></canvas>
                        </div>
                    </div>

                    <!-- SECTION: KELUAR (PENGELUARAN) -->
                    <div>
                        <h5 class="text-md font-bold text-gray-800 dark:text-white uppercase mb-4">PENGELUARAN CRC ({{ \Carbon\Carbon::parse($start_date)->translatedFormat('M Y') }} - {{ \Carbon\Carbon::parse($end_date)->translatedFormat('M Y') }})</h5>
                        
                        <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md mb-6">
                            <table class="w-full text-[11px] xl:text-xs text-left text-gray-700 dark:text-gray-300">
                                <thead class="text-[11px] text-black bg-blue-200 dark:bg-blue-500 shadow-sm border-b-2 border-black">
                                    <tr>
                                        <th class="px-2 py-2 border-r border-black font-bold uppercase">SUPPLIER</th>
                                        <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">LOKAL</th>
                                        <th class="px-2 py-2 border-r border-black font-bold text-center uppercase">IMPORT</th>
                                        <th class="px-2 py-2 border-black font-bold text-center uppercase">% Supp vs Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chart_keluar as $sup => $data)
                                    <tr class="border-b border-gray-300 hover:bg-gray-100 bg-white">
                                        <td class="px-2 py-1 border-r border-gray-300">{{ $sup }}</td>
                                        <td class="px-2 py-1 text-right border-r border-gray-300">{{ $data['lokal'] > 0 ? number_format($data['lokal'], 0, ',', '.') : '-' }}</td>
                                        <td class="px-2 py-1 text-right border-r border-gray-300">{{ $data['import'] > 0 ? number_format($data['import'], 0, ',', '.') : '-' }}</td>
                                        <td class="px-2 py-1 text-right border-gray-300">{{ number_format($data['pct'], 2, ',', '.') }}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-t-2 border-black bg-blue-200 font-bold text-black text-[11px]">
                                        <td class="px-2 py-2 border-r border-black text-center">TOTAL</td>
                                        <td class="px-2 py-2 border-r border-black text-right">{{ number_format($total_keluar_lokal, 0, ',', '.') }}</td>
                                        <td class="px-2 py-2 border-r border-black text-right">{{ number_format($total_keluar_import, 0, ',', '.') }}</td>
                                        <td class="px-2 py-2 border-black text-right">100,00%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mb-4">
                            <table class="w-2/3 text-[11px] xl:text-xs text-left border border-black mb-4">
                                <tr>
                                    <th class="px-2 py-1 border-r border-black font-bold bg-gray-100">% LOKAL vs IMPORT</th>
                                    <th class="px-2 py-1 border-r border-black text-center font-bold">{{ number_format($pct_keluar_lokal, 2, ',', '.') }}%</th>
                                    <th class="px-2 py-1 text-center font-bold">{{ number_format($pct_keluar_import, 2, ',', '.') }}%</th>
                                </tr>
                            </table>
                            <table class="w-1/2 text-[11px] xl:text-xs text-left border border-black">
                                <tr>
                                    <th class="px-2 py-1 border-r border-black font-bold bg-blue-200">TOTAL CRC KELUAR</th>
                                    <th class="px-2 py-1 text-center font-bold bg-blue-200">{{ number_format($total_keluar_all, 0, ',', '.') }}</th>
                                </tr>
                            </table>
                        </div>

                        <div class="border-2 border-orange-500 p-4 rounded-lg bg-white mt-4">
                            <h6 class="text-center font-bold text-sm mb-4">PENGELUARAN CRC<br>{{ \Carbon\Carbon::parse($start_date)->translatedFormat('M Y') }} - {{ \Carbon\Carbon::parse($end_date)->translatedFormat('M Y') }}</h6>
                            <canvas id="chartKeluar" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset all tabs
                tabButtons.forEach(b => {
                    b.classList.remove('text-primary', 'border-primary', 'font-bold', 'dark:text-blue-500', 'dark:border-blue-500');
                    b.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                });
                tabPanes.forEach(p => p.classList.add('hidden'));
                
                // Set active tab
                btn.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                btn.classList.add('text-primary', 'border-primary', 'font-bold', 'dark:text-blue-500', 'dark:border-blue-500');
                
                // Show content
                const targetId = btn.getAttribute('data-target');
                document.getElementById(targetId).classList.remove('hidden');
            });
        });

        // Initialize Charts
        const ctxMasuk = document.getElementById('chartMasuk');
        if (ctxMasuk) {
            new Chart(ctxMasuk, {
                type: 'bar',
                data: {
                    labels: ['LOKAL', 'IMPORT'],
                    datasets: [{
                        label: 'TON',
                        data: [{{ $total_masuk_lokal }}, {{ $total_masuk_import }}],
                        backgroundColor: ['#b45309', '#1d4ed8'],
                        borderWidth: 1,
                        barPercentage: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        const ctxKeluar = document.getElementById('chartKeluar');
        if (ctxKeluar) {
            new Chart(ctxKeluar, {
                type: 'bar',
                data: {
                    labels: ['LOKAL', 'IMPORT'],
                    datasets: [{
                        label: 'TON',
                        data: [{{ $total_keluar_lokal }}, {{ $total_keluar_import }}],
                        backgroundColor: ['#2563eb', '#f59e0b'],
                        borderWidth: 1,
                        barPercentage: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    });
</script>
@endpush

@endsection
