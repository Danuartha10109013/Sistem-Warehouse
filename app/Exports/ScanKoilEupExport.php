<?php

namespace App\Exports;

use App\Models\ScanKoilEup;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ScanKoilEupExport implements FromView, ShouldAutoSize, WithStyles
{
    public function view(): View
    {
        return view('scan_koil_eup.exports.excel', [
            'data' => ScanKoilEup::with(['layout', 'palet'])->latest()->get()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFD9D9D9'],
                ],
            ],
        ];
    }
}
