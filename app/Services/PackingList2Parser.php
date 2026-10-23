<?php

namespace App\Services;

use App\Models\PackingList2Item;
use Carbon\Carbon;

class PackingList2Parser
{
    /**
     * Parse raw pasted TSV text from Excel.
     *
     * @param string $rawText
     * @return array
     */
    public function parse(string $rawText): array
    {
        // Pastikan encoding UTF-8 aman
        $cleanText = mb_convert_encoding($rawText, 'UTF-8', 'UTF-8');
        $cleanText = trim($cleanText);

        if (empty($cleanText)) {
            return [
                'rows' => [],
                'total_rows' => 0,
                'valid_rows' => 0,
                'invalid_rows' => 0,
                'all_valid' => false,
                'message' => 'Teks tempelan kosong.',
            ];
        }

        // Baca stream TSV (fgetcsv otomatis menangani sel berkutip ganda dari Excel dengan enter/koma)
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $cleanText);
        rewind($stream);

        $parsedRows = [];
        $lineIndex = 0;
        $isFirstRow = true;

        while (($columns = fgetcsv($stream, 0, "\t", '"', '\\')) !== false) {
            $lineIndex++;

            // Abaikan baris kosong
            if (empty($columns) || (count($columns) === 1 && trim($columns[0]) === '')) {
                continue;
            }

            // Bersihkan setiap kolom
            $trimmedCols = array_map(function ($col) {
                return trim(mb_convert_encoding($col ?? '', 'UTF-8', 'UTF-8'));
            }, $columns);

            // Deteksi baris header jika ada
            if ($isFirstRow && $this->isHeaderRow($trimmedCols)) {
                $isFirstRow = false;
                continue;
            }
            $isFirstRow = false;

            $parsedRows[] = [
                'row_number' => count($parsedRows) + 1,
                'raw_columns' => $trimmedCols,
            ];
        }
        fclose($stream);

        // Validasi per baris
        $processedRows = [];
        $validCount = 0;
        $invalidCount = 0;

        foreach ($parsedRows as $item) {
            $cols = $item['raw_columns'];
            $rowNum = $item['row_number'];
            $errors = [];

            // 1. Periksa jumlah kolom (harus tepat 13)
            if (count($cols) !== 13) {
                $errors[] = "Jumlah kolom harus 13 (terdeteksi " . count($cols) . " kolom).";
            }

            $kode        = $cols[0] ?? '';
            $namaProduk  = $cols[1] ?? '';
            $rawQty      = $cols[2] ?? '';
            $uom         = $cols[3] ?? '';
            $noCoil      = $cols[4] ?? '';
            $storageBin  = $cols[5] ?? '';
            $rawTanggal  = $cols[6] ?? '';
            $pengirim    = $cols[7] ?? '';
            $rawPanjang  = $cols[8] ?? '';
            $rawTime     = $cols[9] ?? '';
            $kondisi     = $cols[10] ?? '';
            $tujuan      = $cols[11] ?? '';
            $keterangan  = $cols[12] ?? '';

            // 2. Validasi KODE & NAMA PRODUK
            if (empty($kode)) {
                $errors[] = "KODE tidak boleh kosong.";
            }
            if (empty($namaProduk)) {
                $errors[] = "NAMA PRODUK tidak boleh kosong.";
            }

            // 3. Validasi QTY (angka > 0, hapus pemisah ribuan)
            $cleanQty = $this->parseNumber($rawQty);
            if ($cleanQty === null || $cleanQty <= 0) {
                $errors[] = "QTY harus berupa angka lebih besar dari 0 (nilai: '{$rawQty}').";
            }

            // 4. Validasi UOM
            if (empty($uom)) {
                $errors[] = "UOM tidak boleh kosong.";
            }

            // 5. Validasi NO COIL (wajib diisi, no koil sama diizinkan)
            if (empty($noCoil)) {
                $errors[] = "NO COIL wajib diisi.";
            }

            // 6. Validasi TANGGAL format dd/mm/yyyy
            $formattedTanggal = null;
            if (empty($rawTanggal)) {
                $errors[] = "TANGGAL wajib diisi.";
            } else {
                $formattedTanggal = $this->parseTanggal($rawTanggal);
                if (!$formattedTanggal) {
                    $errors[] = "Format TANGGAL harus dd/mm/yyyy (contoh: 12/10/2026, nilai: '{$rawTanggal}').";
                }
            }

            // 7. Validasi PANJANG (angka > 0, hapus pemisah ribuan)
            $cleanPanjang = $this->parseNumber($rawPanjang);
            if ($cleanPanjang === null || $cleanPanjang <= 0) {
                $errors[] = "PANJANG harus berupa angka lebih besar dari 0 (nilai: '{$rawPanjang}').";
            }

            // 8. Validasi TIME format mm/dd/yyyy hh:mm:ss
            $formattedTime = null;
            if (empty($rawTime)) {
                $errors[] = "TIME wajib diisi.";
            } else {
                $formattedTime = $this->parseTime($rawTime);
                if (!$formattedTime) {
                    $errors[] = "Format TIME harus mm/dd/yyyy hh:mm:ss (contoh: 10/15/2026 10:54:23, nilai: '{$rawTime}').";
                }
            }

            // 9. Validasi KONDISI dan TUJUAN
            if (empty($kondisi)) {
                $errors[] = "KONDISI tidak boleh kosong.";
            }
            if (empty($tujuan)) {
                $errors[] = "TUJUAN tidak boleh kosong.";
            }

            $isValid = count($errors) === 0;
            if ($isValid) {
                $validCount++;
            } else {
                $invalidCount++;
            }

            $ritNumber = $this->extractRitNumber($keterangan);

            $processedRows[] = [
                'row_number'        => $rowNum,
                'kode'              => $kode,
                'code_product'      => $kode,
                'nama_produk'       => $namaProduk,
                'product_name'      => $namaProduk,
                'qty'               => $cleanQty ?? 0,
                'quantity'          => $cleanQty ?? 0,
                'qty_raw'           => $rawQty,
                'uom'               => $uom,
                'unit'              => $uom,
                'no_coil'           => $noCoil,
                'attribute'         => $noCoil,
                'storage_bin'       => $storageBin,
                'storagen_bin'      => $storageBin,
                'tanggal'           => $formattedTanggal ? $formattedTanggal->format('Y-m-d') : null,
                'tanggal_display'   => $formattedTanggal ? $formattedTanggal->format('d/m/Y') : $rawTanggal,
                'production'        => $formattedTanggal ? $formattedTanggal->format('d/m/Y') : $rawTanggal,
                'pengirim'          => $pengirim,
                'no_so'             => $pengirim,
                'panjang'           => $cleanPanjang ?? 0,
                'length'            => $cleanPanjang ?? 0,
                'panjang_raw'       => $rawPanjang,
                'time'              => $formattedTime ? $formattedTime->format('Y-m-d H:i:s') : null,
                'time_display'      => $formattedTime ? $formattedTime->format('m/d/Y H:i:s') : $rawTime,
                'time_scan'         => $formattedTime ? $formattedTime->format('m/d/Y H:i:s') : $rawTime,
                'kondisi'           => $kondisi,
                'condition'         => $kondisi,
                'tujuan'            => $tujuan,
                'loc'               => $tujuan,
                'keterangan'        => $keterangan,
                'ket'               => $keterangan,
                'rit_number'        => $ritNumber,
                'is_valid'          => $isValid,
                'errors'            => $errors,
            ];
        }

        // Hitung pengelompokan rit
        $ritGroups = [];
        foreach ($processedRows as $r) {
            $key = $r['rit_number'] !== null ? 'Rit ' . $r['rit_number'] : 'Tanpa Rit';
            $ritGroups[$key] = ($ritGroups[$key] ?? 0) + 1;
        }

        return [
            'rows'         => $processedRows,
            'total_rows'   => count($processedRows),
            'valid_rows'   => $validCount,
            'invalid_rows' => $invalidCount,
            'all_valid'    => count($processedRows) > 0 && $invalidCount === 0,
            'rit_groups'   => $ritGroups,
        ];
    }

    /**
     * Ekstrak nomor rit dari kolom keterangan (contoh: "8", "RIT 8", "T 8").
     */
    public function extractRitNumber(?string $keterangan): ?string
    {
        if ($keterangan === null) {
            return null;
        }
        $keterangan = trim($keterangan);
        if ($keterangan === '') {
            return null;
        }

        if (preg_match('/^\d+$/', $keterangan)) {
            return (string) ((int) $keterangan);
        }

        if (preg_match('/rit\s*[-#:]?\s*(\d+)/i', $keterangan, $matches)) {
            return (string) ((int) $matches[1]);
        }

        if (preg_match('/\b(\d+)\b/', $keterangan, $matches)) {
            return (string) ((int) $matches[1]);
        }

        if (preg_match('/(\d+)/', $keterangan, $matches)) {
            return (string) ((int) $matches[1]);
        }

        return null;
    }

    /**
     * Deteksi apakah baris adalah header tabel.
     */
    protected function isHeaderRow(array $cols): bool
    {
        $headerKeywords = [
            'CODE PRODUCT', 'KODE', 'PRODUCT NAME', 'NAMA PRODUK', 
            'QUANTITY', 'QTY', 'UNIT', 'UOM', 'ATTRIBUTE', 'NO COIL', 
            'STORAGEN BIN', 'STORAGE BIN', 'PRODUCTION', 'NO. SO', 'NO SO', 
            'LENGTH', 'PANJANG', 'TIME SCAN', 'CONDITION', 'LOC', 'KET'
        ];
        $matchCount = 0;
        foreach ($cols as $c) {
            $upper = strtoupper($c);
            foreach ($headerKeywords as $kw) {
                if (str_contains($upper, $kw)) {
                    $matchCount++;
                    break;
                }
            }
        }
        return $matchCount >= 2;
    }

    /**
     * Hapus pemisah ribuan (baik format Indonesia 1.017 maupun format US 1,017) dan ubah ke angka float.
     */
    public function parseNumber(?string $val): ?float
    {
        if ($val === null) return null;
        $val = trim($val);
        if ($val === '') return null;

        // Hilangkan spasi jika ada
        $val = str_replace(' ', '', $val);

        // Kasus 1: Mengandung titik dan koma (misal 1.017,50 atau 1,017.50)
        if (strpos($val, '.') !== false && strpos($val, ',') !== false) {
            if (strrpos($val, ',') > strrpos($val, '.')) {
                // Format Indonesia: 1.017,50 -> titik ribuan, koma desimal
                $val = str_replace('.', '', $val);
                $val = str_replace(',', '.', $val);
            } else {
                // Format US: 1,017.50 -> koma ribuan, titik desimal
                $val = str_replace(',', '', $val);
            }
        } elseif (strpos($val, '.') !== false) {
            // Kasus 2: Hanya mengandung titik (misal 1.017 atau 12.345.678)
            // Di Excel Indonesia, 1.017 adalah seribu tujuh belas (pemisah ribuan)
            if (preg_match('/^\d{1,3}(\.\d{3})+$/', $val)) {
                $val = str_replace('.', '', $val);
            }
        } elseif (strpos($val, ',') !== false) {
            // Kasus 3: Hanya mengandung koma (misal 1,017 atau 3,760)
            if (preg_match('/^\d{1,3}(,\d{3})+$/', $val)) {
                $val = str_replace(',', '', $val);
            } else {
                // Desimal berkoma, misal 1017,5
                $val = str_replace(',', '.', $val);
            }
        }

        $clean = preg_replace('/[^0-9.-]/', '', $val);
        if (!is_numeric($clean)) {
            return null;
        }

        return (float) $clean;
    }

    /**
     * Parsing eksplisit format TANGGAL dd/mm/yyyy (contoh: 12/10/2026).
     */
    public function parseTanggal(?string $val): ?Carbon
    {
        if (empty($val)) return null;
        $val = trim($val);

        try {
            $dt = Carbon::createFromFormat('!d/m/Y', $val);
            // Validasi format ulang untuk mencegah tanggal overflow (misal 32/01/2026)
            if ($dt && $dt->format('d/m/Y') === $val) {
                return $dt;
            }
        } catch (\Exception $e) {
            // Ignore
        }

        return null;
    }

    /**
     * Parsing eksplisit format TIME mm/dd/yyyy hh:mm:ss (contoh: 10/15/2026 10:54:23).
     */
    public function parseTime(?string $val): ?Carbon
    {
        if (empty($val)) return null;
        $val = trim($val);

        $formats = [
            'm/d/Y H:i:s',
            'm/d/Y H:i',
            'n/j/Y H:i:s',
            'n/j/Y H:i',
        ];

        foreach ($formats as $fmt) {
            try {
                $dt = Carbon::createFromFormat($fmt, $val);
                if ($dt) {
                    return $dt;
                }
            } catch (\Exception $e) {
                // Next format
            }
        }

        return null;
    }
}
