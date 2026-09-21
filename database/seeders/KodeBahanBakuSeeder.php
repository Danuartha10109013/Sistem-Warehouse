<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KodeBahanBaku;

class KodeBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // CRC Suppliers
            [
                'supplier'       => 'KS',
                'kode_produk'   => 'CRFH0251219',
                'kode_supplier' => 'ks',
                'attribute_code'=> 'CR_A_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Lokal',
            ],
            [
                'supplier'       => 'HANWA',
                'kode_produk'   => 'CRFH0251219',
                'kode_supplier' => 'hanwa',
                'attribute_code'=> 'CR_BE_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Lokal',
            ],
            [
                'supplier'       => 'GRP',
                'kode_produk'   => 'CRFH0351219',
                'kode_supplier' => 'grp',
                'attribute_code'=> 'CR_B_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Lokal',
            ],
            [
                'supplier'       => 'GRP TL',
                'kode_produk'   => 'CRFH0351219',
                'kode_supplier' => 'grp_tl',
                'attribute_code'=> 'CR_BTL_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Lokal',
            ],
            [
                'supplier'       => 'ESSAR INA',
                'kode_produk'   => 'CRFH0301219',
                'kode_supplier' => 'essar_ina',
                'attribute_code'=> 'CR_G_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Lokal',
            ],
            [
                'supplier'       => 'POSCO VNM',
                'kode_produk'   => 'CRFH0301219',
                'kode_supplier' => 'posco_vnm',
                'attribute_code'=> 'CR_AY_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Import',
            ],
            [
                'supplier'       => 'POSCO KOR',
                'kode_produk'   => 'CRFH0301219',
                'kode_supplier' => 'posco_kor',
                'attribute_code'=> 'CR_AH_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Import',
            ],
            [
                'supplier'       => 'NAI INA',
                'kode_produk'   => 'CRFH0301219',
                'kode_supplier' => 'nai_ina',
                'attribute_code'=> 'CR_AZ_',
                'jenis'         => 'CRC',
                'kategori'      => 'CRC',
                'origin'        => 'Lokal',
            ],

            // RESIN Suppliers
            [
                'supplier'       => 'DIC Graphics',
                'kode_produk'   => 'AF000001',
                'kode_supplier' => 'afcr_e',
                'attribute_code'=> 'AFCR_E',
                'jenis'         => 'RESIN',
                'kategori'      => 'RESIN',
                'origin'        => 'Lokal',
            ],
            [
                'supplier'       => 'Kansai Paint',
                'kode_produk'   => 'KR000001',
                'kode_supplier' => 'krgi_e',
                'attribute_code'=> 'KRGI_E',
                'jenis'         => 'RESIN',
                'kategori'      => 'RESIN',
                'origin'        => 'Lokal',
            ],

            // INGOT Suppliers
            [
                'supplier'       => 'Daching / YC',
                'kode_produk'   => 'IR000001',
                'kode_supplier' => 'ia_d',
                'attribute_code'=> 'IA_D',
                'jenis'         => 'INGOT',
                'kategori'      => 'ALUMINIUM ALLOY',
                'origin'        => 'Import',
            ],
            [
                'supplier'       => 'Korea Zinc',
                'kode_produk'   => 'IR000004',
                'kode_supplier' => 'iz_c',
                'attribute_code'=> 'IZ_C',
                'jenis'         => 'INGOT',
                'kategori'      => 'SHG ZINC 99.995%',
                'origin'        => 'Import',
            ],
            [
                'supplier'       => 'Nyrstar',
                'kode_produk'   => 'IR000004',
                'kode_supplier' => 'iz_bea',
                'attribute_code'=> 'IZ_BEA',
                'jenis'         => 'INGOT',
                'kategori'      => 'SHG ZINC 99.995%',
                'origin'        => 'Import',
            ],
        ];

        foreach ($items as $item) {
            KodeBahanBaku::updateOrCreate(
                [
                    'supplier'      => $item['supplier'],
                    'kode_supplier' => $item['kode_supplier'],
                    'jenis'         => $item['jenis'],
                ],
                $item
            );
        }
    }
}
