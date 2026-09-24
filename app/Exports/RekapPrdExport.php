<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class RekapPrdExport implements FromView, WithCharts, ShouldAutoSize
{
    protected $data;
    protected $filter;

    public function __construct($data, $filter, $imagePath = null)
    {
        $this->data = $data;
        $this->filter = $filter;
    }

    public function view(): View
    {
        return view('rekap_prd.exports.excel', [
            'data' => $this->data,
            'filter' => $this->filter
        ]);
    }

    public function charts()
    {
        $dataCount = count($this->data);
        if ($dataCount == 0) return [];

        // Data begins at row 3 in the Excel sheet because header spans 2 rows
        $startRow = 3;
        $endRow = $startRow + $dataCount - 1;
        
        // --- CHART 1: POSISI STOCK WH TML CIK - SEPTEMBER 2026 ---
        // Labels: Saldo Awal (B), Hasil Prod CGL (C), Total Pengeluaran (F), Saldo Akhir (G)
        $dataSeriesLabels1 = [
            new DataSeriesValues('String', 'Worksheet!$B$1', null, 1),
            new DataSeriesValues('String', 'Worksheet!$C$1', null, 1),
            new DataSeriesValues('String', 'Worksheet!$F$1', null, 1),
            new DataSeriesValues('String', 'Worksheet!$G$1', null, 1),
        ];

        // X-Axis values: Tgl (A3:A$endRow)
        $xAxisTickValues1 = [
            new DataSeriesValues('String', 'Worksheet!$A$' . $startRow . ':$A$' . $endRow, null, $dataCount),
        ];

        // Y-Axis values for Chart 1
        $dsVal1_0 = new DataSeriesValues('Number', 'Worksheet!$B$' . $startRow . ':$B$' . $endRow, null, $dataCount);
        $dsVal1_0->setFillColor('4472C4'); // Blue
        
        $dsVal1_1 = new DataSeriesValues('Number', 'Worksheet!$C$' . $startRow . ':$C$' . $endRow, null, $dataCount);
        $dsVal1_1->setFillColor('C0504D'); // Red
        
        $dsVal1_2 = new DataSeriesValues('Number', 'Worksheet!$F$' . $startRow . ':$F$' . $endRow, null, $dataCount);
        $dsVal1_2->setFillColor('9BBB59'); // Green
        
        $dsVal1_3 = new DataSeriesValues('Number', 'Worksheet!$G$' . $startRow . ':$G$' . $endRow, null, $dataCount);
        $dsVal1_3->setFillColor('F79646'); // Orange

        $dataSeriesValues1 = [
            $dsVal1_0,
            $dsVal1_1,
            $dsVal1_2,
            $dsVal1_3,
        ];

        $series1 = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($dataSeriesValues1) - 1),
            $dataSeriesLabels1,
            $xAxisTickValues1,
            $dataSeriesValues1
        );
        $series1->setPlotDirection(DataSeries::DIRECTION_COL);

        $plotArea1 = new PlotArea(null, [$series1]);
        $legend1 = new Legend(Legend::POSITION_RIGHT, null, false);
        $title1 = new Title('POSISI STOCK WH TML CIK - SEPTEMBER 2026');
        $chart1 = new Chart('chart1', $title1, $legend1, $plotArea1, true, 0, null, null);

        // Position Chart 1 below the table
        $chart1StartRow = $endRow + 3;
        $chart1->setTopLeftPosition('B' . $chart1StartRow);
        $chart1->setBottomRightPosition('K' . ($chart1StartRow + 20));


        // --- CHART 2: POSISI STOCK WH TML CIK - 2026 (Hasil Prod CGL & Total Pengeluaran) ---
        $dataSeriesLabels2 = [
            new DataSeriesValues('String', 'Worksheet!$C$1', null, 1),
            new DataSeriesValues('String', 'Worksheet!$F$1', null, 1),
        ];

        $xAxisTickValues2 = [
            new DataSeriesValues('String', 'Worksheet!$A$' . $startRow . ':$A$' . $endRow, null, $dataCount),
        ];

        $dsVal2_0 = new DataSeriesValues('Number', 'Worksheet!$C$' . $startRow . ':$C$' . $endRow, null, $dataCount);
        $dsVal2_0->setFillColor('C0504D'); // Red
        
        $dsVal2_1 = new DataSeriesValues('Number', 'Worksheet!$F$' . $startRow . ':$F$' . $endRow, null, $dataCount);
        $dsVal2_1->setFillColor('9BBB59'); // Green

        $dataSeriesValues2 = [
            $dsVal2_0,
            $dsVal2_1,
        ];

        $series2 = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($dataSeriesValues2) - 1),
            $dataSeriesLabels2,
            $xAxisTickValues2,
            $dataSeriesValues2
        );
        $series2->setPlotDirection(DataSeries::DIRECTION_COL);

        $plotArea2 = new PlotArea(null, [$series2]);
        $legend2 = new Legend(Legend::POSITION_RIGHT, null, false);
        $title2 = new Title('POSISI STOCK WH TML CIK - 2026');
        $chart2 = new Chart('chart2', $title2, $legend2, $plotArea2, true, 0, null, null);

        // Position Chart 2 below Chart 1
        $chart2StartRow = $chart1StartRow + 22;
        $chart2->setTopLeftPosition('B' . $chart2StartRow);
        $chart2->setBottomRightPosition('K' . ($chart2StartRow + 20));

        return [$chart1, $chart2];
    }
}
