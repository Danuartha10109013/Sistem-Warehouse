<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\VerifikasiTimbangan;
use Carbon\Carbon;

class VerifikasiTimbanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path('data_verifikasi_timbangan.xlsx');
        
        if (!file_exists($filePath)) {
            $this->command->error("File not found at: {$filePath}");
            return;
        }

        $this->command->info("Loading spreadsheet...");
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Data starts from row 6 (index 5) after headers
        $headerRow = 5; // Row 6 (0-indexed)
        
        // Clear existing data
        $this->command->info("Membersihkan data verifikasi timbangan yang ada...");
        VerifikasiTimbangan::truncate();

        $insertData = [];
        $skippedCount = 0;

        for ($i = $headerRow + 1; $i < count($data); $i++) {
            $row = $data[$i];
            
            // Skip empty rows
            if (empty($row[0])) {
                $skippedCount++;
                continue;
            }

            // Column mapping:
            // 0: TANGGAL (d-m-Y format)
            // 1: LABEL
            // 2: ACTUAL
            // 3: SELISIH
            // 4: STATUS
            // 5: TINDAK LANJUT
            // 6: ACTUAL SETELAH TINDAK LANJUT
            // 7: SELISIH SETELAH TINDAK LANJUT
            // 8: OPERATOR

            $tanggalStr = trim((string)($row[0] ?? ''));
            $label = trim((string)($row[1] ?? ''));
            $actual = trim((string)($row[2] ?? ''));
            $selisih = trim((string)($row[3] ?? ''));
            $status = trim((string)($row[4] ?? ''));
            $tindakLanjut = trim((string)($row[5] ?? ''));
            $actualSetelah = trim((string)($row[6] ?? ''));
            $selisihSetelah = trim((string)($row[7] ?? ''));
            $operatorName = trim((string)($row[8] ?? ''));

            // Skip if date is empty
            if (empty($tanggalStr)) {
                $skippedCount++;
                continue;
            }

            // Convert date from d-m-Y to Y-m-d
            try {
                $tanggal = Carbon::createFromFormat('d-m-Y', $tanggalStr)->format('Y-m-d');
            } catch (\Exception $e) {
                // Try alternative format without leading zeros
                try {
                    $tanggal = Carbon::createFromFormat('j-m-Y', $tanggalStr)->format('Y-m-d');
                } catch (\Exception $e2) {
                    $this->command->warn("Skipping row {$i}: Invalid date format '{$tanggalStr}'");
                    $skippedCount++;
                    continue;
                }
            }

            // Convert numeric values
            $label = (float)str_replace(',', '', $label);
            $actual = (float)str_replace(',', '', $actual);
            
            // Handle selisih - convert "-" to 0 or null
            if ($selisih === '-' || $selisih === '.' || empty($selisih)) {
                $selisih = 0;
            } else {
                $selisih = (float)str_replace(',', '', $selisih);
            }

            // Handle nullable fields
            if ($tindakLanjut === '-' || $tindakLanjut === '.' || empty($tindakLanjut)) {
                $tindakLanjut = null;
            }

            if ($actualSetelah === '-' || $actualSetelah === '.' || empty($actualSetelah)) {
                $actualSetelah = null;
            } else {
                $actualSetelah = (float)str_replace(',', '', $actualSetelah);
            }

            if ($selisihSetelah === '-' || $selisihSetelah === '.' || empty($selisihSetelah)) {
                $selisihSetelah = null;
            } else {
                $selisihSetelah = (float)str_replace(',', '', $selisihSetelah);
            }

            // Skip if no operator name
            if (empty($operatorName)) {
                $skippedCount++;
                continue;
            }

            $insertData[] = [
                'tanggal' => $tanggal,
                'label' => $label,
                'actual' => $actual,
                'selisih' => $selisih,
                'status' => $status,
                'tindak_lanjut' => $tindakLanjut,
                'actual_setelah' => $actualSetelah,
                'selisih_setelah' => $selisihSetelah,
                'operator_name' => $operatorName,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (count($insertData) > 0) {
            // Insert in chunks to avoid memory issues
            foreach (array_chunk($insertData, 100) as $chunk) {
                VerifikasiTimbangan::insert($chunk);
            }
            $this->command->info("Berhasil menambahkan " . count($insertData) . " data verifikasi timbangan.");
            if ($skippedCount > 0) {
                $this->command->info("Melewati {$skippedCount} baris kosong/invalid.");
            }
        } else {
            $this->command->warn("Tidak ada data valid yang ditemukan untuk di-import.");
        }

        // Note: Excel file is kept in public folder for reference
        // To remove it, manually delete: public/data_verifikasi_timbangan.xlsx

        $this->command->info("Seeding completed successfully!");
    }
}
