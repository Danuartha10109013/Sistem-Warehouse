<?php

namespace App\Imports;

use App\Models\SAC;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SACImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new SAC([
            'date'       => Date::excelToDateTimeObject($row['date']),
            'warehouse'  => $row['warehouse'],
            'kpc'        => $row['kpc'],
            'barcode'    => $row['barcode'],
            'namabarang' => $row['namabarang'],
            'berat'      => $row['berat'],
            'lokasi'     => $row['lokasi'],
            'jenis'      => 'otomatis',
        ]);
    }
}

