<?php

namespace App\Imports;

use App\Models\LaporanrepackingM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DaftarRepackingImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Skip header row
    }

    public function model(array $row)
    {
        if (!isset($row[1])) {
            return null;
        }
        
        return new LaporanrepackingM([
            'atributte' => $row[1],
            'ukuran'    => $row[2] ?? null,
            'berat'     => $row[3] ?? null,
            'layout'    => $row[4] ?? null,
            'status'    => 'Pending'
        ]);
    }
}
