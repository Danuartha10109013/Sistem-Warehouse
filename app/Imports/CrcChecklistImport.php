<?php

namespace App\Imports;

use App\Models\CrcM;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CrcChecklistImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $groupedData = [];

        foreach ($collection as $index => $row) {
            // Skip the first 3 rows (title and headers)
            if ($index < 3) {
                continue;
            }

            $no_dn = $row[5] ?? null; // No_dn is at index 5
            if (!$no_dn) {
                continue;
            }

            if (!isset($groupedData[$no_dn])) {
                $groupedData[$no_dn] = [];
            }

            $groupedData[$no_dn][] = [
                'produk' => $row[1] ?? null, // Produk is at index 1
                'attribute' => $row[2] ?? null, // Attribute is at index 2
                'supplier_lot_no' => $row[3] ?? null, // Supplier Lot No is at index 3
                'berat' => $row[7] ?? null, // Berat is at index 7
            ];
        }

        foreach ($groupedData as $no_dn => $items) {
            // Find matching CrcM record
            $crc = CrcM::where('shift_leader', $no_dn)->first();
            if ($crc) {
                $crc->update([
                    'checklist_data' => json_encode($items)
                ]);
            }
        }
    }
}

