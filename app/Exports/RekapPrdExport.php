<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RekapPrdExport implements FromView, WithDrawings, ShouldAutoSize
{
    protected $data;
    protected $filter;
    protected $imagePath;

    public function __construct($data, $filter, $imagePath = null)
    {
        $this->data = $data;
        $this->filter = $filter;
        $this->imagePath = $imagePath;
    }

    public function view(): View
    {
        return view('rekap_prd.exports.excel', [
            'data' => $this->data,
            'filter' => $this->filter
        ]);
    }

    public function drawings()
    {
        if ($this->imagePath && file_exists($this->imagePath)) {
            $drawing = new Drawing();
            $drawing->setName('Grafik');
            $drawing->setDescription('Grafik Rekap PRD');
            $drawing->setPath($this->imagePath);
            $drawing->setHeight(350); 
            $drawing->setCoordinates('D2'); // Posisi grafik di kolom D baris 2

            return $drawing;
        }

        return [];
    }
}
