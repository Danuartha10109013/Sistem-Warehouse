<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RekapPrd;

class RekapPrdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data stok awal untuk tanggal 31 Agustus 2026
        RekapPrd::updateOrCreate(
            ['tanggal' => '2026-08-31'],
            [
                'hasil_prd' => 0,
                'pengeluaran_tml' => 0,
                'pengeluaran_ttl' => 0,
                'total_pengeluaran' => 0,
                'sisa_stock' => 12193433,
            ]
        );

        $this->command->info("Data stok awal PRD (12516) per tanggal 31 Agustus berhasil ditambahkan!");
    }
}
