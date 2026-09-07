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
        // imagePath is no longer needed since we use native charts
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
        $charts = [];
        $row = 1;

        foreach ($this->data as $item) {
            if ($item->tanggal == '2026-08-31') {
                continue;
            }

            // Define Data Series Labels
            $dataSeriesLabels = [
                new DataSeriesValues('String', 'Worksheet!$A$' . ($row + 5), null, 1), // Sisa Stock
                new DataSeriesValues('String', 'Worksheet!$A$' . ($row + 4), null, 1), // Total pengeluaran
            ];
            
            // We use the date string as the X-axis category
            $xAxisTickValues = [
                new DataSeriesValues('String', 'Worksheet!$A$' . $row, null, 1),
            ];

            // Define Values
            $dataSeriesValues = [
                new DataSeriesValues('Number', 'Worksheet!$B$' . ($row + 5), null, 1),
                new DataSeriesValues('Number', 'Worksheet!$B$' . ($row + 4), null, 1),
            ];

            // Build the dataseries
            $series = new DataSeries(
                DataSeries::TYPE_BARCHART,       // plotType
                DataSeries::GROUPING_CLUSTERED,  // plotGrouping
                range(0, count($dataSeriesValues) - 1), // plotOrder
                $dataSeriesLabels,               // plotLabel
                $xAxisTickValues,                // plotCategory
                $dataSeriesValues                // plotValues
            );
            $series->setPlotDirection(DataSeries::DIRECTION_COL);

            // Add data labels (values) to the chart
            $layout = new \PhpOffice\PhpSpreadsheet\Chart\Layout();
            $layout->setShowVal(true);
            $layout->setShowLegendKey(false);
            $layout->setShowCatName(false);
            $layout->setShowSerName(false);

            // Set the series in the plot area with the layout
            $plotArea = new PlotArea($layout, [$series]);

            // Set the chart legend
            $legend = new Legend(Legend::POSITION_BOTTOM, null, false);

            if ($this->filter == 'harian' || $this->filter == 'bulanan') {
                $titleText = \Carbon\Carbon::parse($item->tanggal)->format('d M Y');
            } elseif ($this->filter == 'tahunan') {
                $titleText = date('F', mktime(0, 0, 0, $item->periode, 1));
            } else {
                $titleText = 'Grafik';
            }

            $title = new Title($titleText);

            // Create the chart
            $chart = new Chart(
                'chart_' . $row, 
                $title, 
                $legend, 
                $plotArea, 
                true, 
                0, 
                null, 
                null  
            );

            // Position chart from Col D to J alongside its data block
            $chart->setTopLeftPosition('D' . $row);
            $chart->setBottomRightPosition('J' . ($row + 6));

            $charts[] = $chart;

            $row += 7; // Move to the next block (6 data rows + 1 empty row)
        }

        return $charts;
    }
}
