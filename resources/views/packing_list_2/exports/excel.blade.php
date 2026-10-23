<table>
    <thead>
        <!-- Header Info Batch -->
        <tr>
            <th colspan="18" style="font-size: 14pt; font-weight: bold; text-align: left;">
                DETAIL BATCH: {{ $batch->kode_batch }}
            </th>
        </tr>
        <tr>
            <th colspan="3" style="font-weight: bold;">No. Rit</th>
            <th colspan="15">{{ $batch->no_rit ? 'Rit ' . $batch->no_rit : '-' }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-weight: bold;">Waktu Input</th>
            <th colspan="15">{{ $batch->created_at ? $batch->created_at->format('d M Y, H:i:s') : '-' }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-weight: bold;">Dibuat Oleh</th>
            <th colspan="15">{{ $batch->user->name ?? 'User' }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-weight: bold;">Catatan Batch</th>
            <th colspan="15">{{ $batch->catatan ?: '-' }}</th>
        </tr>
        <tr>
            <th colspan="3" style="font-weight: bold;">Total Item Koil</th>
            <th colspan="15">{{ count($items) }} Item</th>
        </tr>
        <tr>
            <th colspan="18"></th>
        </tr>

        <!-- Table Column Headers -->
        <tr>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">NO</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">STATUS</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">CODE PRODUCT</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">PRODUCT NAME</th>
            <th style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">QUANTITY</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">UNIT</th>
            <th style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">ATTRIBUTE (NO COIL)</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">STORAGE BIN</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">PRODUCTION</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">NO. SO</th>
            <th style="background-color: #166534; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">LENGTH</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">TIME SCAN</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">CONDITION</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">LOC</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">KET</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">VALIDATOR</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">WAKTU VALIDASI</th>
            <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">CATATAN VERIFIKASI</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalQty = 0;
            $totalPanjang = 0;
        @endphp
        @forelse($items as $idx => $it)
            @php
                $statusLabel = 'Menunggu';
                if ($it->status === 'VALID' || $it->status === 'TERVALIDASI') {
                    $statusLabel = 'Valid (3/3)';
                } elseif ($it->status === 'TIDAK_VALID') {
                    $statusLabel = 'Tidak Valid';
                }

                $totalQty += (float)$it->qty;
                $totalPanjang += (float)$it->panjang;
            @endphp
            <tr>
                <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $idx + 1 }}</td>
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
                <td style="border: 1px solid #cbd5e1; text-align: center;">{{ $it->validated_at ? $it->validated_at->format('d/m/Y H:i') : '-' }}</td>
                <td style="border: 1px solid #cbd5e1; text-align: left;">{{ $it->catatan_verifikasi ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="18" style="border: 1px solid #cbd5e1; text-align: center; color: #64748b;">
                    Tidak ada item koil.
                </td>
            </tr>
        @endforelse

        <!-- Total Row -->
        <tr>
            <td colspan="4" style="border: 1px solid #000000; font-weight: bold; text-align: center; background-color: #f1f5f9;">TOTAL</td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: right; background-color: #dcfce7;">{{ $totalQty }}</td>
            <td style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
            <td colspan="4" style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
            <td style="border: 1px solid #000000; font-weight: bold; text-align: right; background-color: #dcfce7;">{{ $totalPanjang }}</td>
            <td colspan="7" style="border: 1px solid #000000; background-color: #f1f5f9;"></td>
        </tr>
    </tbody>
</table>
