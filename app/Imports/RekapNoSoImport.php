<?php

namespace App\Imports;

use App\Models\RekapNoSo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RekapNoSoImport implements ToCollection, WithStartRow
{
    public int $insertedCount = 0;
    public array $duplicates = [];

    public function startRow(): int
    {
        return 2; // Lewati baris header
    }

    public function collection(Collection $rows)
    {
        // Ambil semua attribute yang sudah ada di database untuk lookup cepat O(1)
        $existingAttributes = RekapNoSo::pluck('attribute')
            ->map(fn($a) => strtoupper(trim((string)$a)))
            ->flip()
            ->toArray();

        foreach ($rows as $row) {
            $attribute = isset($row[0]) ? trim((string)$row[0]) : null;
            $noSo = isset($row[1]) ? trim((string)$row[1]) : null;
            $catatan = isset($row[2]) ? trim((string)$row[2]) : null;

            if (empty($attribute) || empty($noSo)) {
                continue;
            }

            // Abaikan jika baris header terbaca kembali
            $attrLower = strtolower($attribute);
            if ($attrLower === 'attribute' || $attrLower === 'atrribute') {
                continue;
            }

            $attrUpper = strtoupper($attribute);

            // Cek apakah attribute sudah terdaftar di database atau sudah diproses di baris sebelumnya
            if (isset($existingAttributes[$attrUpper])) {
                $this->duplicates[] = $attribute;
                continue;
            }

            // Simpan data baru
            RekapNoSo::create([
                'attribute' => $attribute,
                'no_so'     => strtoupper($noSo),
                'catatan'   => $catatan ?: null,
            ]);

            // Tandai sudah tersimpan agar baris duplikat berikutnya dalam file yang sama juga terdeteksi
            $existingAttributes[$attrUpper] = true;
            $this->insertedCount++;
        }
    }
}
