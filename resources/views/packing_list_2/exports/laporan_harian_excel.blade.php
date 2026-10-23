<table>
    <tbody>
        <!-- Title & Metadata -->
        <tr>
            <td colspan="18" style="font-size: 14pt; font-weight: bold; text-align: left; background-color: #f1f5f9;">
                LAPORAN HARIAN BATCH PACKING LIST 2.0
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Tanggal Laporan</td>
            <td colspan="15">{{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Total Batch</td>
            <td colspan="15">{{ $summary['total_batch'] }} Batch</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Total Item Koil</td>
            <td colspan="15">{{ $summary['total_items'] }} Koil</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Ringkasan Validasi</td>
            <td colspan="15">Valid: {{ $summary['valid'] }} | Menunggu: {{ $summary['menunggu'] }} | Selisih: {{ $summary['tidak_valid'] }}</td>
        </tr>
        <tr>
            <td colspan="18"></td>
        </tr>

        <!-- Section 1: Ringkasan Batch -->
        <tr>
            <td colspan="11" style="font-size: 12pt; font-weight: bold; background-color: #e2e8f0; text-align: left;">
                1. RINGKASAN DAFTAR BATCH TANGGAL {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
            </td>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">NO</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">KODE BATCH</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">RIT</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">JAM INPUT</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">OPERATOR</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">TOTAL KOIL</td>
            <td style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">VALID (3/3)</td>
            <td style="background-color: #b45309; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">MENUNGGU</td>
            <td style="background-color: #991b1b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">SELISIH</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">STATUS</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">CATATAN</td>
            <td colspan="7"></td>
        </tr>
        @forelse($batches as $bIdx => $b)
            @php
                $bValid = $b->items->whereIn('status', ['VALID', 'TERVALIDASI'])->count();
                $bPending = $b->items->where('status', 'MENUNGGU_VALIDASI')->count();
                $bInvalid = $b->items->where('status', 'TIDAK_VALID')->count();
                $statusBatch = 'Proses Validasi';
                if ($bPending == 0 && $b->items->count() > 0) {
                    $statusBatch = 'Selesai Tervalidasi';
                } elseif ($bPending == $b->items->count()) {
                    $statusBatch = 'Semua Menunggu';
                }
            @endphp
            <tr>
                <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $bIdx + 1 }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: left; font-weight: bold;">{{ $b->kode_batch }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $b->no_rit ? 'Rit ' . $b->no_rit : '-' }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $b->created_at ? $b->created_at->format('H:i:s') : '-' }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $b->user->name ?? 'User' }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center; font-weight: bold;">{{ $b->items->count() }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center; background-color: #f0fdf4; color: #166534; font-weight: bold;">{{ $bValid }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center; background-color: #fffbeb; color: #b45309; font-weight: bold;">{{ $bPending }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center; background-color: #fef2f2; color: #991b1b; font-weight: bold;">{{ $bInvalid }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $statusBatch }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $b->catatan ?: '-' }}</td>
                <td colspan="7"></td>
            </tr>
        @empty
            <tr>
                <td colspan="11" style="border: 1px solid #cbd5e1; text-align: center; color: #64748b;">
                    Tidak ada batch pada tanggal ini.
                </td>
                <td colspan="7"></td>
            </tr>
        @endforelse

        <!-- Total Row Section 1 -->
        <tr>
            <td colspan="5" style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #f1f5f9;">TOTAL</td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #f1f5f9;">{{ $summary['total_items'] }}</td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #dcfce7; color: #166534;">{{ $summary['valid'] }}</td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #fef3c7; color: #b45309;">{{ $summary['menunggu'] }}</td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #fee2e2; color: #991b1b;">{{ $summary['tidak_valid'] }}</td>
            <td colspan="2" style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
            <td colspan="7"></td>
        </tr>

        <tr><td colspan="18"></td></tr>
        <tr><td colspan="18"></td></tr>

        <!-- Section 2: Detail Seluruh Item Koil -->
        <tr>
            <td colspan="18" style="font-size: 12pt; font-weight: bold; background-color: #e2e8f0; text-align: left;">
                2. DETAIL SELURUH ITEM KOIL TANGGAL {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
            </td>
        </tr>
        <tr>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">NO</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">KODE BATCH</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">RIT</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">STATUS</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">CODE PRODUCT</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">PRODUCT NAME</td>
            <td style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">QUANTITY</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">UNIT</td>
            <td style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">ATTRIBUTE (NO COIL)</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">STORAGE BIN</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">PRODUCTION</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">NO. SO</td>
            <td style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">LENGTH</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">TIME SCAN</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">CONDITION</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">LOC</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">KET</td>
            <td style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000;">VALIDATOR</td>
        </tr>
        @php
            $itemSeq = 1;
            $allQty = 0;
            $allLen = 0;
        @endphp
        @forelse($batches as $b)
            @foreach($b->items as $it)
                @php
                    $statusLabel = 'Menunggu';
                    if ($it->status === 'VALID' || $it->status === 'TERVALIDASI') {
                        $statusLabel = 'Valid (3/3)';
                    } elseif ($it->status === 'TIDAK_VALID') {
                        $statusLabel = 'Tidak Valid';
                    }
                    $allQty += (float)$it->qty;
                    $allLen += (float)$it->panjang;
                @endphp
                <tr>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $itemSeq++ }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left; font-weight: bold;">{{ $b->kode_batch }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $b->no_rit ? 'Rit ' . $b->no_rit : '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center; font-weight: bold;">{{ $statusLabel }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->kode }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->nama_produk }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: right; background-color: #f0fdf4;">{{ (float)$it->qty }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $it->uom }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center; background-color: #f0fdf4; mso-number-format:'\@';">{{ $it->no_coil }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->storage_bin ?: '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $it->tanggal ? $it->tanggal->format('d/m/Y') : '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->pengirim ?: '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: right; background-color: #f0fdf4;">{{ (float)$it->panjang }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $it->time ? $it->time->format('m/d/Y H:i:s') : '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $it->kondisi ?: '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $it->tujuan ?: '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->keterangan ?: '-' }}</td>
                    <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->validator->name ?? '-' }}</td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="18" style="border: 1px solid #cbd5e1; text-align: center; color: #64748b;">
                    Tidak ada item koil pada tanggal ini.
                </td>
            </tr>
        @endforelse

        <!-- Total Row Section 2 -->
        <tr>
            <td colspan="6" style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #f1f5f9;">TOTAL KESELURUHAN</td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: right; background-color: #dcfce7; color: #166534;">{{ $allQty }}</td>
            <td colspan="2" style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
            <td colspan="3" style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: right; background-color: #dcfce7; color: #166534;">{{ $allLen }}</td>
            <td colspan="5" style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
        </tr>
    </tbody>
</table>
