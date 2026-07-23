<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\DailyStock;
use Carbon\Carbon;

class RekapStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path('REKAP STOCK VS KAPASITAS WH TML JAN - DES 2026 (1).xlsx');
        
        if (!file_exists($filePath)) {
            $this->command->error("File not found at: {$filePath}");
            return;
        }

        $this->command->info("Loading spreadsheet...");
        $spreadsheet = IOFactory::load($filePath);
        $sheetNames = $spreadsheet->getSheetNames();

        $months = [
            'JAN' => 1, 'FEB' => 2, 'MAR' => 3, 'APR' => 4, 'MEI' => 5, 'JUNI' => 6,
            'JULI' => 7, 'AGS' => 8, 'SEP' => 9, 'OKT' => 10, 'NOV' => 11, 'DES' => 12
        ];
        
        // Hapus data lama yang salah source (WH-TATASENTOSA)
        $this->command->info("Membersihkan data seeder sebelumnya (WH-TATASENTOSA)...");
        DailyStock::where('source', 'WH-TATASENTOSA')->whereYear('tanggal', 2026)->delete();

        // Gunakan source L3-BB agar terbaca di modul Kapasitas CRC
        $source = 'L3-BB';
        $year = 2026;

        foreach ($sheetNames as $sheetName) {
            if (!isset($months[$sheetName])) continue;
            
            $month = $months[$sheetName];
            $this->command->info("Processing {$sheetName} (Month: {$month})...");
            
            // Hapus data lama untuk sumber ini di bulan dan tahun yang bersangkutan
            DailyStock::where('source', $source)
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->delete();

            $sheet = $spreadsheet->getSheetByName($sheetName);
            $data = $sheet->toArray();
            
            if (count($data) < 5) continue;
            
            $row3 = $data[2];
            $dayMap = [];
            for ($c = 2; $c < count($row3); $c++) {
                $val = trim((string)($row3[$c] ?? ''));
                if (is_numeric($val) && $val > 0 && $val <= 31) {
                    $dayMap[$c] = (int)$val;
                }
            }
            
            $currentGroup = '';
            $insertData = [];
            
            for ($r = 4; $r < count($data); $r++) {
                $row = $data[$r];
                $col0 = trim((string)($row[0] ?? ''));
                $col1 = trim((string)($row[1] ?? ''));
                
                if ($col0 != '') {
                    $currentGroup = strtoupper($col0);
                }
                
                if ($col1 != '' && strtolower($col1) != 'average') {
                    $cat = strtoupper($col1);
                    
                    // Loop over each day mapped to a column
                    foreach ($dayMap as $colIdx => $day) {
                        $qtyStr = trim((string)($row[$colIdx] ?? '0'));
                        // Remove commas
                        $qtyStr = str_replace(',', '', $qtyStr);
                        $qty = (float)$qtyStr;
                        
                        if ($qty > 0 || $qtyStr === '0') {
                            $tanggal = sprintf('%04d-%02d-%02d', $year, $month, $day);
                            $insertData[] = [
                                'tanggal' => $tanggal,
                                'source' => $source,
                                'kategori' => $cat,
                                'kategori_grup' => $currentGroup,
                                'quantity' => $qty,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                }
            }
            
            if (count($insertData) > 0) {
                // Insert in chunks to avoid memory issues or query limits
                foreach (array_chunk($insertData, 500) as $chunk) {
                    DailyStock::insert($chunk);
                }
                $this->command->info("  Inserted " . count($insertData) . " records for {$sheetName}.");
            }
        }
        
        $this->command->info("Seeding completed successfully!");
    }
}
