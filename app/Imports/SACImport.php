<?php

namespace App\Imports;

use App\Models\Packing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SAC implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Packing([
            'date'       => $row['date'],
            'warehouse'  => $row['warehouse'],
            'kpc'        => $row['kpc'],
            'barcode'    => $row['barcode'],
            'namabarang' => $row['namabarang'],
            'berat'      => $row['berat'],
            'lokasi'     => $row['lokasi'],
        ]);
    }
}
