<?php

namespace App\Imports;

use App\Models\BreakBulk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BreakBulkImport implements ToCollection, WithStartRow
{
    public int $insertedCount = 0;
    public int $updatedCount = 0;
    public int $skippedCount = 0;

    public function startRow(): int
    {
        return 2; // Lewati baris header ke-1
    }

    public function collection(Collection $rows)
    {
        // Cache data atribut yang sudah ada di database untuk efisiensi
        $existingRecords = BreakBulk::all()->keyBy(function ($item) {
            return strtoupper(trim($item->atribut));
        });

        foreach ($rows as $row) {
            $noUrut  = isset($row[0]) ? trim((string)$row[0]) : null;
            $atribut = isset($row[1]) ? trim((string)$row[1]) : null;
            $rawWeight = isset($row[2]) ? trim((string)$row[2]) : null;
            $product = isset($row[3]) ? trim((string)$row[3]) : null;
            $noSo    = isset($row[4]) ? trim((string)$row[4]) : null;

            // Lewati jika atribut kosong
            if (empty($atribut)) {
                continue;
            }

            // Abaikan jika header terbaca kembali
            $attrLower = strtolower($atribut);
            if (in_array($attrLower, ['atribut', 'attribute', 'no'])) {
                continue;
            }

            // Normalisasi weight ke float/decimal
            $weight = 0;
            if (!empty($rawWeight)) {
                // Ganti koma desimal ke titik jika ada
                $normalizedWeight = str_replace(',', '.', str_replace('.', '', $rawWeight));
                // Fallback sederhana jika format standar 1234.56
                if (!is_numeric($normalizedWeight)) {
                    $normalizedWeight = str_replace(',', '.', $rawWeight);
                }
                $weight = is_numeric($normalizedWeight) ? (float)$normalizedWeight : (float)filter_var($rawWeight, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }

            $key = strtoupper($atribut);

            if (isset($existingRecords[$key])) {
                // Update data jika sudah ada
                $record = $existingRecords[$key];
                $record->update([
                    'no_urut' => is_numeric($noUrut) ? (int)$noUrut : $record->no_urut,
                    'weight'  => $weight > 0 ? $weight : $record->weight,
                    'product' => $product ?: $record->product,
                    'no_so'   => !empty($noSo) ? strtoupper($noSo) : $record->no_so,
                ]);
                $this->updatedCount++;
            } else {
                // Simpan data baru
                $newRecord = BreakBulk::create([
                    'no_urut' => is_numeric($noUrut) ? (int)$noUrut : null,
                    'atribut' => $atribut,
                    'weight'  => $weight,
                    'product' => $product ?: '-',
                    'no_so'   => !empty($noSo) ? strtoupper($noSo) : null,
                    'status'  => 'pending',
                ]);

                $existingRecords[$key] = $newRecord;
                $this->insertedCount++;
            }
        }
    }
}
