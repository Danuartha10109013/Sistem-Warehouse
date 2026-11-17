<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BreakBulkScanExport implements FromView, ShouldAutoSize, WithTitle, WithStyles
{
    use Exportable;

    protected $groupedScans;
    protected $totalItems;
    protected $totalWeight;

    public function __construct($groupedScans, $totalItems, $totalWeight)
    {
        $this->groupedScans = $groupedScans;
        $this->totalItems   = $totalItems;
        $this->totalWeight  = $totalWeight;
    }

    public function view(): View
    {
        return view('break_bulk.exports.scan_excel', [
            'groupedScans' => $this->groupedScans,
            'totalItems'   => $this->totalItems,
            'totalWeight'  => $this->totalWeight,
            'exportedAt'   => now(),
        ]);
    }

    public function title(): string
    {
        return 'Hasil Scan Break Bulk';
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }
}
