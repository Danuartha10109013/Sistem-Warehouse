<?php

namespace App\Imports;

use App\Models\VerifikasiStiker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class VerifikasiStikerImport implements ToCollection, WithStartRow
{
    public int $importedCount = 0;
    public int $skippedNonCrCount = 0;
    public int $skippedDuplicateCount = 0;
    public array $duplicateAttributes = [];
    public string $tanggalInput;

    public function __construct(?string $tanggalInput = null)
    {
        $this->tanggalInput = $tanggalInput ?: now()->toDateString();
    }

    public function startRow(): int
    {
        return 4; // Baris data dimulai dari baris ke-4
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Kolom B (index 1): Produk
            // Kolom C (index 2): Attribute
            // Kolom D (index 3): Supplier Lot No
            // Kolom E (index 4): Tgl_dn
            // Kolom H (index 7): Berat

            $produk = isset($row[1]) ? trim((string) $row[1]) : '';
            $attribute = isset($row[2]) ? trim((string) $row[2]) : '';
            $supplierLotNo = isset($row[3]) ? trim((string) $row[3]) : '';
            $tglRaw = $row[4] ?? null;
            $beratRaw = $row[7] ?? 0;

            // Lewati baris kosong jika tidak ada attribute dan produk
            if (empty($attribute) && empty($produk)) {
                continue;
            }

            // ATURAN 1: Hanya data dengan kode attribute berawalan "CR_" yang diterima masuk
            if (!str_starts_with(strtoupper($attribute), 'CR_')) {
                $this->skippedNonCrCount++;
                continue;
            }

            // ATURAN 2: Kode attribute berawalan "CR_" tidak boleh duplikat (wajib unik)
            $exists = VerifikasiStiker::where('attribute', $attribute)->first();
            if ($exists) {
                $this->skippedDuplicateCount++;
                if (count($this->duplicateAttributes) < 5) {
                    $this->duplicateAttributes[] = $attribute;
                }
                continue;
            }

            // Format tanggal DN
            $tglDn = null;
            if ($tglRaw) {
                if (is_numeric($tglRaw)) {
                    try {
                        $tglDn = ExcelDate::excelToDateTimeObject($tglRaw)->format('d-m-Y');
                    } catch (\Exception $e) {
                        $tglDn = (string) $tglRaw;
                    }
                } else {
                    $tglDn = trim((string) $tglRaw);
                }
            }

            // Format berat
            $berat = 0;
            if ($beratRaw !== null) {
                $cleanedBerat = str_replace([',', ' '], '', (string) $beratRaw);
                $berat = is_numeric($cleanedBerat) ? (float) $cleanedBerat : 0;
            }

            VerifikasiStiker::create([
                'tanggal_input'     => $this->tanggalInput,
                'produk'            => $produk,
                'attribute'         => $attribute,
                'supplier_lot_no'   => $supplierLotNo,
                'tgl_dn'            => $tglDn,
                'berat'             => $berat,
                'status_verifikasi' => 'belum',
                'check_produk'      => false,
                'check_lot_no'      => false,
                'check_berat'       => false,
            ]);

            $this->importedCount++;
        }
    }
}
