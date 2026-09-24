<?php

namespace App\Imports;

use App\Models\MasterProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class MasterProductImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        if (!isset($row['search_key']) || !isset($row['name'])) {
            return null;
        }

        return new MasterProduct([
            'search_key' => $row['search_key'],
            'name'       => $row['name'],
        ]);
    }

    public function uniqueBy()
    {
        return 'search_key';
    }
}
