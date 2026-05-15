<?php

namespace App\Exports;

use App\Models\Pengecekan;
use App\Models\Shipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MappingContainerExportExcelPenilaian implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected ?string $start;
    protected ?string $end;
    protected ?string $search;

    public function __construct(?string $start = null, ?string $end = null, ?string $search = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->search = $search;
    }

    protected function getShipments()
    {
        $query = Shipment::query();

        if ($this->search) {
            $query->where('no_gs', 'like', '%' . $this->search . '%');
        }

        if ($this->start && $this->end) {
            $query->whereBetween('created_at', [$this->start, $this->end]);
        }

        return $query->latest()->get();
    }

    public function collection()
    {
        $shipments = $this->getShipments();
        $data = collect();

        foreach ($shipments as $index => $shipment) {
            $pengecekan = Pengecekan::where('no_gs', $shipment->no_gs)->first();
            $data->push([
                'No' => $index + 1,
                'No GS' => $shipment->no_gs,
                'Tanggal' => $pengecekan ? $pengecekan->tgl_gs : $shipment->tgl_gs,
                'No Kontainer' => $pengecekan ? $pengecekan->no_container : $shipment->no_container,
                'Expedisi' => $pengecekan ? $pengecekan->ekspedisi : null,
                'Lantai' => $pengecekan ? $pengecekan->lantai : null,
                'Dinding' => $pengecekan ? $pengecekan->dinding : null,
                'Kondisi Ban' => $pengecekan ? $pengecekan->kondisi_ban : null,
                'Rangka' => $pengecekan ? $pengecekan->rangka : null,
                'Radiasi' => $pengecekan ? $pengecekan->radiasi : null,
                'Pengunci Kontainer' => $pengecekan ? $pengecekan->pengunci_kontainer : null,
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'No',
            'No GS',
            'Tanggal',
            'No Kontainer',
            'Expedisi',
            'Lantai',
            'Dinding',
            'Kondisi Ban',
            'Rangka',
            'Radiasi',
            'Pengunci Kontainer',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E0E0E0']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}
