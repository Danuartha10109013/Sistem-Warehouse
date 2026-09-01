<?php

namespace App\Imports;

use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockCrcImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $excelAttributes = [];
        
        foreach ($rows as $row) {
            if (!isset($row['kategori_produk']) || strtoupper(trim($row['kategori_produk'])) !== 'CRC') {
                continue;
            }

            $attribute = $row['atribut'] ?? $row['attribute'] ?? null;
            if (!$attribute) continue;

            $excelAttributes[] = $attribute;
            
            $quantity = isset($row['quantity']) ? str_replace(',', '', $row['quantity']) : 0;
            $quantity = is_numeric($quantity) ? (float) $quantity : $quantity;

            // Cari stok aktif (belum keluar) dengan attribute yang sama
            $existingStock = Stock::where('kategori_produk', 'CRC')
                                  ->where('attribute_set_value', $attribute)
                                  ->whereNull('date_keluar')
                                  ->first();

            if ($existingStock) {
                $existingQty = is_numeric($existingStock->quantity) ? (float) $existingStock->quantity : $existingStock->quantity;
                
                // Jika quantity berubah, anggap barang lama KELUAR, dan buat barang MASUK baru
                if ($existingQty !== $quantity) {
                    $existingStock->update(['date_keluar' => now()]);
                    
                    // Buat data baru (MASUK)
                    Stock::create([
                        'kode_produk'         => $row['kode_produk'] ?? null,
                        'nama_produk'         => $row['nama_produk'] ?? null,
                        'kategori_produk'     => $row['kategori_produk'] ?? null,
                        'quantity'            => $quantity,
                        'satuan'              => $row['unit'] ?? null,
                        'storage_bin'         => $row['storage_bin'] ?? null,
                        'attribute_set_value' => $attribute,
                        'date_keluar'         => null,
                    ]);
                } else {
                    // Jika quantity sama, cukup update data pendukung (misal pindah lokasi storage bin)
                    $existingStock->update([
                        'kode_produk' => $row['kode_produk'] ?? $existingStock->kode_produk,
                        'nama_produk' => $row['nama_produk'] ?? $existingStock->nama_produk,
                        'satuan'      => $row['unit'] ?? $existingStock->satuan,
                        'storage_bin' => $row['storage_bin'] ?? $existingStock->storage_bin,
                    ]);
                }
            } else {
                // Barang benar-benar baru (MASUK)
                Stock::create([
                    'kode_produk'         => $row['kode_produk'] ?? null,
                    'nama_produk'         => $row['nama_produk'] ?? null,
                    'kategori_produk'     => $row['kategori_produk'] ?? null,
                    'quantity'            => $quantity,
                    'satuan'              => $row['unit'] ?? null,
                    'storage_bin'         => $row['storage_bin'] ?? null,
                    'attribute_set_value' => $attribute,
                    'date_keluar'         => null,
                ]);
            }
        }

        // Tandai data CRC lama yang tidak ada di file Excel sebagai Barang Keluar
        if (count($excelAttributes) > 0) {
            Stock::where('kategori_produk', 'CRC')
                 ->whereNull('date_keluar') // hanya yang belum ditandai keluar
                 ->whereNotIn('attribute_set_value', $excelAttributes)
                 ->update(['date_keluar' => now()]);
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}
