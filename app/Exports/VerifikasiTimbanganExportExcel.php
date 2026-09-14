<?php

namespace App\Exports;

use App\Models\VerifikasiTimbangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VerifikasiTimbanganExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $data = VerifikasiTimbangan::orderBy('tanggal', 'desc')->get();
        
        return view('verifikasi_timbangan.export', [
            'data' => $data
        ]);
    }
}
