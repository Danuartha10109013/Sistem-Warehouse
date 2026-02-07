<?php

namespace App\Imports;

use App\Models\SAC;
use App\Models\KBI;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SACImport implements ToModel, WithHeadingRow
{
    protected $kategori;

    public function __construct($kategori)
    {
        $this->kategori = $kategori;
    }

    public function model(array $row)
    {
        if ($this->kategori === "BB - BJ - BJS - SP") {

            return new SAC([
                'date'       => isset($row['date'])
                                ? Date::excelToDateTimeObject($row['date'])
                                : null,
                'warehouse'  => $row['warehouse'] ?? null,
                'kpc'        => $row['kpc'] ?? null,
                'barcode'    => $row['barcode'] ?? null,
                'namabarang' => $row['namabarang'] ?? null,
                'berat'      => $row['berat'] ?? null,
                'lokasi'     => $row['lokasi'] ?? null,
                'storagebin' => $row['storagebin'] ?? null,
                'jenis'      => $this->kategori,
            ]);

        } elseif ($this->kategori === "KBI") {

            return new KBI([
                'date'          => isset($row['date'])
                                   ? Date::excelToDateTimeObject($row['date'])
                                   : null,
                'so'            => $row['so'] ?? null,
                'delivery_no'   => $row['delivery_no'] ?? null,
                'coil_no'       => $row['coil_no'] ?? null,
                'delv_weight'    => $row['delv_weight'] ?? null,
                'thick'         => $row['thick'] ?? null,
                'width_batch'   => $row['width_batch'] ?? null,
                'thicknes'   => $row['thick'] + " X " + $row['width_batch'],
                'storagebin_kbi'   => $row['storagebin_kbi'] ?? null,
                'status'   => 'belum scan',
            ]);
        }

        return null;
    }
}
