<table>
    <tbody>
        <!-- Title & Metadata -->
        <tr>
            <td colspan="14" style="font-size: 14pt; font-weight: bold; text-align: left; background-color: #f1f5f9; color: #1e293b;">
                PT TATA METAL LESTARI - LAPORAN HASIL SCAN &amp; VERIFIKASI STIKER
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Tanggal Input Data</td>
            <td colspan="11">{{ $tanggal }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Waktu Export</td>
            <td colspan="11">{{ now()->format('d/m/Y H:i:s') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Ringkasan Hasil Verifikasi</td>
            <td colspan="11">Total: {{ $summary['total'] }} Stiker | Sesuai: {{ $summary['sesuai'] }} | Tidak Sesuai: {{ $summary['tidak_sesuai'] }}</td>
        </tr>
        <tr>
            <td colspan="14"></td>
        </tr>

        <!-- Table Header -->
        <tr>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">NO</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">TGL INPUT</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">WAKTU VERIFIKASI</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">ATTRIBUTE</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">STATUS</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">PRODUK</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">SUPPLIER LOT NO</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">TGL DN</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">BERAT (KG)</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">1. CEK PRODUK</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">2. CEK LOT NO</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">3. CEK BERAT</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">PETUGAS</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">CATATAN</td>
        </tr>

        <!-- Table Data -->
        @forelse($items as $idx => $item)
            @php
                $isSesuai = $item->status_verifikasi === 'sesuai';
                $statusBg = $isSesuai ? '#dcfce7' : '#fee2e2';
                $statusColor = $isSesuai ? '#15803d' : '#b91c1c';
                $statusLabel = $isSesuai ? 'SESUAI' : 'TIDAK SESUAI';
            @endphp
            <tr>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $idx + 1 }}</td>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $item->tanggal_input ? $item->tanggal_input->format('d/m/Y') : '-' }}</td>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $item->verified_at ? $item->verified_at->format('d/m/Y H:i:s') : '-' }}</td>
                <td style="font-family: monospace; border: 1px solid #cbd5e1;">{{ $item->attribute }}</td>
                <td style="text-align: center; font-weight: bold; background-color: {{ $statusBg }}; color: {{ $statusColor }}; border: 1px solid #cbd5e1;">{{ $statusLabel }}</td>
                <td style="border: 1px solid #cbd5e1;">{{ $item->produk }}</td>
                <td style="font-family: monospace; border: 1px solid #cbd5e1;">{{ $item->supplier_lot_no }}</td>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $item->tgl_dn ?: '-' }}</td>
                <td style="text-align: right; font-weight: bold; border: 1px solid #cbd5e1;">{{ number_format($item->berat, 2, '.', ',') }}</td>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $item->check_produk ? 'SESUAI' : 'TIDAK' }}</td>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $item->check_lot_no ? 'SESUAI' : 'TIDAK' }}</td>
                <td style="text-align: center; border: 1px solid #cbd5e1;">{{ $item->check_berat ? 'SESUAI' : 'TIDAK' }}</td>
                <td style="border: 1px solid #cbd5e1;">{{ $item->verified_by ?? '-' }}</td>
                <td style="border: 1px solid #cbd5e1;">{{ $item->catatan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="14" style="text-align: center; padding: 15px; color: #64748b; border: 1px solid #cbd5e1;">
                    Tidak ada data hasil verifikasi untuk tanggal ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
