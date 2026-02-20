<?php

namespace App\Exports;

use App\Models\Coil;
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

class MappingContainerExportExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function collection()
    {
        // Get all shipments with related data
        $shipments = Shipment::all();
        $data = collect();

        foreach ($shipments as $index => $shipment) {
            // Get pengecekan data for this shipment
            $pengecekan = Pengecekan::where('no_gs', $shipment->no_gs)->first();
            
            // Count coils with same no_gs
            $jumlahCoil = Coil::where('no_gs', $shipment->no_gs)->count();
            
            // Get dates/times
            $tgl_gs = $pengecekan ? $pengecekan->tgl_gs : $shipment->tgl_gs;
            $no_container = $pengecekan ? $pengecekan->no_container : $shipment->no_container;
            $awal_muat = $pengecekan ? $pengecekan->awal_muat : null;
            $awal_muat1 = $pengecekan ? $pengecekan->awal_muat1 : null;
            $selesai_muat = $pengecekan ? $pengecekan->selesai_muat : null;
            
            // Calculate time differences
            $time_muat = null;
            $total_muat = null;
            
            if ($awal_muat && $awal_muat1) {
                $time_muat = $this->calculateTimeDifference($awal_muat, $awal_muat1);
            }
            
            if ($awal_muat && $selesai_muat) {
                $total_muat = $this->calculateTimeDifference($awal_muat, $selesai_muat);
            }
            
            $data->push([
                'No' => $index + 1,
                'No GS' => $shipment->no_gs,
                'Tanggal' => $tgl_gs,
                'No Kontainer' => $no_container,
                'Jumlah Coil' => $jumlahCoil,
                'Awal Muat' => $awal_muat,
                'Selesai Muat' => $awal_muat1,
                'Selesai Seling' => $selesai_muat,
                'Time Muat' => $time_muat,
                'Total Muat (Segel)' => $total_muat,
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
            'Jumlah Coil',
            'Awal Muat',
            'Selesai Muat',
            'Selesai Seling',
            'Time Muat',
            'Total Muat (Segel)',
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

    /**
     * Calculate time difference between two time strings, return as "X menit"
     */
    private function calculateTimeDifference($startTime, $endTime)
    {
        if (!$startTime || !$endTime) {
            return null;
        }

        try {
            $start = \DateTime::createFromFormat('H:i:s', $startTime);
            if (!$start) {
                $start = \DateTime::createFromFormat('H:i', $startTime);
            }

            $end = \DateTime::createFromFormat('H:i:s', $endTime);
            if (!$end) {
                $end = \DateTime::createFromFormat('H:i', $endTime);
            }

            if (!$start || !$end) {
                return null;
            }

            if ($end < $start) {
                $end->modify('+1 day');
            }

            $totalMenit = (int) (($end->getTimestamp() - $start->getTimestamp()) / 60);
            return $totalMenit . ' menit';
        } catch (\Exception $e) {
            return null;
        }
    }
}
