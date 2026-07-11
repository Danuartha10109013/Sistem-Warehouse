<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormatDaftarExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                '1',
                'Contoh Atribut A',
                '100x100',
                '50kg',
                'Lay-1',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Atribute',
            'Ukuran',
            'Berat',
            'Layout'
        ];
    }
}
