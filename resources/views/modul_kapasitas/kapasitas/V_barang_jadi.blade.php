@extends('modul_kapasitas.layout.V_template')

@section('title', 'Kapasitas Barang Jadi')

@section('content')
<div class="card h-full min-w-0">
    <div class="card-body min-w-0">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Perhitungan Kapasitas Barang Jadi</h4>
                <p class="text-sm text-gray-500 mt-1">Data dikalkulasi berdasarkan stok harian khusus dari grup Barang Jadi.</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 bg-white dark:bg-darkgray p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <!-- Filter Bulan/Tahun -->
            <form method="GET" action="{{ route('modul-kapasitas.kapasitas.barang-jadi') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                @php
                    $currentFilterValue = sprintf('%04d-%02d', $year, $month);
                @endphp
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="month" name="filter_month" value="{{ $currentFilterValue }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white shadow-sm transition-colors cursor-pointer" onchange="this.form.submit()">
                </div>
            </form>
            
            <div class="flex gap-2">
                <button type="button" onclick="exportToExcel()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-3.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Excel
                </button>
                <button type="button" onclick="exportToPDF()" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-6 py-3.5 transition-colors shadow-sm flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 6H7a2 2 0 00-2 2v11a2 2 0 002 2z"></path></svg>
                    Export PDF
                </button>
            </div>
        </div>

        <!-- Full Export Wrapper -->
        <div id="export-container" class="bg-transparent">
            
            <!-- Chart Section -->
            <div class="mb-8 p-6 bg-white dark:bg-darkgray border-t-4 border-t-primary rounded-lg shadow-md">
            <div class="text-center mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white uppercase">KAPASITAS BARANG JADI</h3>
                <h4 class="text-lg font-bold text-gray-700 dark:text-gray-300 uppercase">{{ $months[$month] ?? '' }} {{ $year }}</h4>
            </div>
            <div class="relative w-full h-80">
                <canvas id="kapasitasChart"></canvas>
            </div>
            
            @php
                $lastDayWithValue = 1;
                foreach($processedData as $d => $val) {
                    if($val['total_stock'] > 0) {
                        $lastDayWithValue = $d;
                    }
                }
                $lastStock = $processedData[$lastDayWithValue]['total_stock'];
                $lastTrend = $processedData[$lastDayWithValue]['trend'];
                $tersisa = $kapasitasValue - $lastStock;
                $tersisaPersen = $kapasitasValue > 0 ? ($tersisa / $kapasitasValue) * 100 : 0;
            @endphp
            
            <!-- Summary Section -->
            <div class="mt-8 mb-4 font-bold text-gray-900 dark:text-gray-100 text-base md:text-lg">
                <h5 class="mb-3 uppercase text-black dark:text-white">PERHITUNGAN KAPASITAS : RATA-RATA BERAT PER COIL 20 TON</h5>
                <div class="grid grid-cols-2 md:grid-cols-[250px_auto] gap-y-2">
                    <div>Kapasitas</div>
                    <div>{{ number_format($kapasitasValue, 0, ',', '.') }} Ton</div>
                    
                    <div>Posisi Stock {{ sprintf('%02d', $lastDayWithValue) }} {{ strtoupper(substr($months[$month] ?? '', 0, 3)) }} {{ substr($year, 2) }}</div>
                    <div>{{ number_format($lastStock, 0, ',', '.') }} Ton</div>
                    
                    <div>Kapasitas (%)</div>
                    <div>{{ number_format($lastTrend, 1, ',', '.') }}% Ton</div>
                    
                    <div>Kapasitas tersisa</div>
                    <div>{{ number_format($tersisaPersen, 1, ',', '.') }}% Ton</div>
                </div>
            </div>
            </div>
        <div class="html2pdf__page-break"></div>

        <!-- Tabel Kapasitas Barang Jadi -->
        <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-md">
            <table class="w-full text-xs xl:text-sm 2xl:text-base text-right text-gray-700 dark:text-gray-300" id="bjTable">
                <thead class="text-xs text-white uppercase bg-primary dark:bg-blue-900 shadow-sm">
                    <tr>
                        <th rowspan="2" class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-b border-blue-400 dark:border-blue-700 font-extrabold sticky left-0 bg-primary dark:bg-blue-900 z-10">TGL</th>
                        <th colspan="2" class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-b border-blue-400 dark:border-blue-700 font-extrabold">STOCK</th>
                        <th rowspan="2" class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-b border-blue-400 dark:border-blue-700 font-extrabold">TOTAL STOCK</th>
                        <th rowspan="2" class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-b border-blue-400 dark:border-blue-700 font-extrabold">KAP</th>
                        <th rowspan="2" class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-b border-blue-400 dark:border-blue-700 font-extrabold">TREND</th>
                    </tr>
                    <tr>
                        <th class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-b border-blue-400 dark:border-blue-700 font-extrabold">WH</th>
                        <th class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-b border-blue-400 dark:border-blue-700 font-extrabold">PRD & QA</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rowIdx = 0; @endphp
                    @foreach($processedData as $d => $row)
                        @php 
                            $rowIdx++;
                            $isEven = $rowIdx % 2 == 0; 
                            $bgClass = $isEven ? 'bg-white dark:bg-darkgray' : 'bg-gray-50 dark:bg-gray-800';
                        @endphp
                        <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors {{ $bgClass }}">
                            <td class="px-3 py-2 2xl:px-6 2xl:py-3 text-center font-bold border-r border-gray-300 dark:border-gray-600 sticky left-0 z-10 {{ $bgClass }} group-hover:bg-gray-200 dark:group-hover:bg-gray-600">{{ $d }}</td>
                            <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ $row['wh'] > 0 ? number_format($row['wh'], 0, ',', '.') : '0' }}</td>
                            <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ $row['prd_qa'] > 0 ? number_format($row['prd_qa'], 0, ',', '.') : '0' }}</td>
                            <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600 font-medium">{{ $row['total_stock'] > 0 ? number_format($row['total_stock'], 0, ',', '.') : '0' }}</td>
                            <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ number_format($row['kap'], 0, ',', '.') }}</td>
                            <td class="px-3 py-2 2xl:px-6 2xl:py-3 font-medium">{{ number_format($row['trend'], 0, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                    
                    <!-- Average Row -->
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border-b border-gray-400 dark:border-gray-700">
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 text-center font-extrabold border-r border-gray-400 dark:border-gray-700 sticky left-0 bg-gray-200 dark:bg-gray-700 z-10">AVERAGE</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-400 dark:border-gray-700 font-bold">{{ number_format($averages['wh'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-400 dark:border-gray-700 font-bold">{{ number_format($averages['prd_qa'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-400 dark:border-gray-700 font-bold">{{ number_format($averages['total_stock'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-400 dark:border-gray-700 font-bold">{{ number_format($averages['kap'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 font-bold">{{ number_format($averages['trend'], 0, ',', '.') }}%</td>
                    </tr>
                    
                    <!-- Highest Row -->
                    <tr class="bg-white dark:bg-darkgray text-red-600 font-bold">
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 text-center border-r border-gray-300 dark:border-gray-600 sticky left-0 bg-white dark:bg-darkgray z-10">Stock tertinggi</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ number_format($highest['wh'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ number_format($highest['prd_qa'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ number_format($highest['total_stock'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3 border-r border-gray-300 dark:border-gray-600">{{ number_format($highest['kap'], 0, ',', '.') }}</td>
                        <td class="px-3 py-2 2xl:px-6 2xl:py-3">{{ number_format($highest['trend'], 0, ',', '.') }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        </div> <!-- End of Full Export Wrapper -->
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- For Export Excel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<!-- For Export PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('kapasitasChart').getContext('2d');
        
        const labels = [
            @foreach($processedData as $d => $row)
                {{ $d }},
            @endforeach
        ];
        const stockData = [
            @foreach($processedData as $d => $row)
                {{ $row['total_stock'] }},
            @endforeach
        ];
        const kapData = [
            @foreach($processedData as $d => $row)
                {{ $kapasitasValue }},
            @endforeach
        ];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'POSISI STOCK',
                        data: stockData,
                        borderColor: '#3b82f6', // blue-500
                        backgroundColor: '#3b82f6',
                        borderWidth: 2,
                        pointBackgroundColor: '#ef4444', // red points
                        pointBorderColor: '#3b82f6',
                        pointRadius: 4,
                        fill: false,
                        tension: 0
                    },
                    {
                        label: 'KAPASITAS STOCK',
                        data: kapData,
                        borderColor: '#ef4444', // red-500
                        backgroundColor: '#ef4444',
                        borderWidth: 3,
                        pointRadius: 0, // flat line without points
                        fill: false,
                        tension: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    });

    async function exportToExcel() {
        const workbook = new ExcelJS.Workbook();
        const sheet = workbook.addWorksheet('Kapasitas Barang Jadi');

        // Add Title
        sheet.mergeCells('A1:F1');
        sheet.getCell('A1').value = 'KAPASITAS BARANG JADI - {{ $months[$month] ?? '' }} {{ $year }}';
        sheet.getCell('A1').font = { size: 14, bold: true };
        sheet.getCell('A1').alignment = { horizontal: 'center' };

        // Convert Chart to Base64 Image
        const canvas = document.getElementById('kapasitasChart');
        const imageId = workbook.addImage({
            base64: canvas.toDataURL('image/png'),
            extension: 'png',
        });
        
        // Add image to sheet (spans from row 3 to row 20)
        sheet.addImage(imageId, {
            tl: { col: 0, row: 2 },
            ext: { width: canvas.width * 0.7, height: canvas.height * 0.7 }
        });

        // Start Table Data at Row 22
        const startRow = 22;
        
        // Table Headers
        sheet.getRow(startRow).values = ['TGL', 'WH', 'PRD & QA', 'TOTAL STOCK', 'KAP', 'TREND (%)'];
        sheet.getRow(startRow).font = { bold: true };
        
        // Add Data Rows
        let rowIdx = startRow + 1;
        
        @foreach($processedData as $d => $r)
            sheet.getRow(rowIdx++).values = [
                {{ $d }}, 
                {{ $r['wh'] }}, 
                {{ $r['prd_qa'] }}, 
                {{ $r['total_stock'] }}, 
                {{ $r['kap'] }}, 
                {{ $r['trend'] }}
            ];
        @endforeach
        
        // Add Average & Highest
        sheet.getRow(rowIdx).values = ['AVERAGE', {{ $averages['wh'] }}, {{ $averages['prd_qa'] }}, {{ $averages['total_stock'] }}, {{ $averages['kap'] }}, {{ $averages['trend'] }}];
        sheet.getRow(rowIdx).font = { bold: true };
        rowIdx++;
        
        sheet.getRow(rowIdx).values = ['Stock Tertinggi', {{ $highest['wh'] }}, {{ $highest['prd_qa'] }}, {{ $highest['total_stock'] }}, {{ $highest['kap'] }}, {{ $highest['trend'] }}];
        sheet.getRow(rowIdx).font = { bold: true, color: { argb: 'FFFF0000' } };

        // Save file
        const buffer = await workbook.xlsx.writeBuffer();
        const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = "Kapasitas_Barang_Jadi_Lengkap_{{ $months[$month] ?? '' }}_{{ $year }}.xlsx";
        link.click();
    }

    function exportToPDF() {
        const element = document.getElementById('export-container');
        const tableWrapper = element.querySelector('.overflow-x-auto');
        
        if (tableWrapper) {
            tableWrapper.classList.remove('overflow-x-auto');
        }

        const opt = {
            margin:       0.3,
            filename:     'Kapasitas_{{ $months[$month] ?? '' }}_{{ $year }}.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, scrollY: 0 },
            jsPDF:        { unit: 'in', format: 'a3', orientation: 'landscape' },
            pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
        };
        
        html2pdf().set(opt).from(element).save().then(() => {
            if (tableWrapper) {
                tableWrapper.classList.add('overflow-x-auto');
            }
        });
    }
</script>
@endpush
@endsection
