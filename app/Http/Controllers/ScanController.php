<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ScanController extends Controller
{
    public function index()
    {
        // Menampilkan halaman tombol scan
        return view('scan');
    }

    public function scan()
    {
        // 1. Tentukan nama file unik dan path penyimpanan
        $filename = 'scan_' . Str::uuid() . '.jpg';
        $outputDirectory = storage_path('app/public/scans');
        $outputPath = $outputDirectory . '/' . $filename;

        // 2. Pastikan folder tujuan sudah ada
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0777, true, true);
        }

        // 3. Susun perintah CLI NAPS2 (Sesuaikan nama scanner Anda di sini)
        // Gunakan tanda kutip ganda untuk membungkus path Windows agar tidak error karena spasi
        $naps2Path = '"C:\Program Files\NAPS2\naps2.console.exe"';
        $scannerName = '"CanoScan LiDE 120"'; // <-- Sudah disesuaikan dengan tipe scanner Anda
        
        $cmd = "{$naps2Path} --driver wia --device {$scannerName} -o \"{$outputPath}\" --dpi 200 --bitdepth color";

        // 4. Eksekusi perintah di command prompt Windows
        exec($cmd, $output, $status);

        // 5. Cek status (0 berarti sukses dalam Windows CLI)
        if ($status === 0) {
            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil di-scan!',
                'file_url' => asset('storage/scans/' . $filename),
                'file_name' => $filename
            ]);
        }

        // Jika gagal, kembalikan response error beserta log singkatnya
        return response()->json([
            'success' => false,
            'message' => 'Proses scan gagal. Pastikan scanner menyala dan tidak sedang digunakan.',
            'debug' => $output
        ], 500);
    }
}
