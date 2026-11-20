<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ShippmentFTemplate implements FromArray, WithColumnFormatting
{
    public function array(): array
    {
        return [['SO', 'UNICODE', 'POD', 'ATTRIBUTE']];
    }

    public function columnFormats(): array
    {
        return ['A' => NumberFormat::FORMAT_TEXT, 'B' => NumberFormat::FORMAT_TEXT, 'C' => NumberFormat::FORMAT_TEXT, 'D' => NumberFormat::FORMAT_TEXT];
    }
}
