<table>
    <tbody>
        <!-- Title & Metadata Header -->
        <tr>
            <td colspan="11" style="font-size: 14pt; font-weight: bold; text-align: left; background-color: #f1f5f9; color: #1e293b;">
                PT TATA METAL LESTARI - LAPORAN HASIL SCAN BREAK BULK
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Waktu Export</td>
            <td colspan="8">{{ $exportedAt->format('d/m/Y H:i:s') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Total Trailer Terdaftar</td>
            <td colspan="8">{{ count($groupedScans) }} Trailer</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Total Koil Terverifikasi</td>
            <td colspan="8">{{ number_format($totalItems) }} Koil ({{ number_format($totalWeight / 1000, 2, '.', ',') }} Ton / {{ number_format($totalWeight, 2, '.', ',') }} kg)</td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>

        <!-- Table Column Headers -->
        <tr>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">NO</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">NOMOR TRAILER</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">JUMLAH KOIL</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">ATRIBUT (BARCODE)</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">PRODUK</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">BERAT (KG)</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">GROUPING</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">POD (TUJUAN)</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">NO SO</td>
            <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">LOKASI</td>
            <td style="background-color: #0284c7; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">TOTAL TONASE TRAILER</td>
        </tr>

        <!-- Table Data Rows -->
        @php
            $globalNo = 1;
        @endphp

        @forelse($groupedScans as $trailer => $coils)
            @php
                $trailerRowCount = count($coils);
                $trailerTotalWeightKg = $coils->sum('weight');
                $trailerTotalTon = $trailerTotalWeightKg / 1000;
            @endphp

            @foreach($coils as $idx => $coil)
                <tr>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $globalNo++ }}</td>

                    @if($idx === 0)
                        <td rowspan="{{ $trailerRowCount }}" style="text-align: center; vertical-align: middle; font-weight: bold; background-color: #f8fafc; border: 1px solid #000000;">
                            Trailer {{ $trailer }}
                        </td>
                        <td rowspan="{{ $trailerRowCount }}" style="text-align: center; vertical-align: middle; font-weight: bold; background-color: #f8fafc; border: 1px solid #000000;">
                            {{ $trailerRowCount }} Koil
                        </td>
                    @endif

                    <td style="font-family: monospace; text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $coil->atribut }}</td>
                    <td style="vertical-align: middle; border: 1px solid #000000;">{{ $coil->product }}</td>
                    <td style="text-align: right; vertical-align: middle; border: 1px solid #000000;">{{ number_format($coil->weight, 2, '.', ',') }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $coil->grouping ?: '-' }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $coil->pod ?: '-' }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $coil->no_so ?: '-' }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $coil->lokasi ?: '-' }}</td>

                    @if($idx === 0)
                        <td rowspan="{{ $trailerRowCount }}" style="text-align: center; vertical-align: middle; font-weight: bold; font-size: 11pt; background-color: #e0f2fe; color: #0369a1; border: 1px solid #000000;">
                            {{ number_format($trailerTotalTon, 2, '.', ',') }} Ton
                        </td>
                    @endif
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="11" style="text-align: center; padding: 15px; color: #64748b; border: 1px solid #000000;">
                    Belum ada data scan yang tersimpan.
                </td>
            </tr>
        @endforelse

        <!-- Grand Total Footer -->
        @if($totalItems > 0)
            <tr>
                <td colspan="5" style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; border: 1px solid #000000;">
                    TOTAL KESELURUHAN ({{ count($groupedScans) }} TRAILER / {{ number_format($totalItems) }} KOIL)
                </td>
                <td style="background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: right; vertical-align: middle; border: 1px solid #000000;">
                    {{ number_format($totalWeight, 2, '.', ',') }}
                </td>
                <td colspan="4" style="background-color: #1e3a8a; border: 1px solid #000000;"></td>
                <td style="background-color: #0284c7; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle; font-size: 11pt; border: 1px solid #000000;">
                    {{ number_format($totalWeight / 1000, 2, '.', ',') }} Ton
                </td>
            </tr>
        @endif
    </tbody>
</table>
