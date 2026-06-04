<table>
    <thead>
        <tr>
            <th colspan="14" style="font-size: 14px; font-weight: bold;">LAPORAN ID &amp; OD</th>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Diekspor pada</th>
            <td colspan="12">{{ $filters['exported_at'] ?? now()->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Rentang tanggal</th>
            <td colspan="12">{{ $filters['from'] ?? '—' }} s/d {{ $filters['to'] ?? '—' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Size ID</th>
            <td colspan="12">{{ $filters['size_id'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Size OD</th>
            <td colspan="12">{{ $filters['size_od'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Tujuan</th>
            <td colspan="12">{{ $filters['tujuan'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Shift</th>
            <td colspan="12">{{ $filters['shift'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Pencarian</th>
            <td colspan="12">{{ $filters['search'] ?? '—' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Total baris</th>
            <td colspan="12">{{ $filters['total_rows'] ?? $records->count() }}</td>
        </tr>
        <tr><td colspan="14"></td></tr>
        <tr style="font-weight: bold; background-color: #e2e8f0;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Size ID</th>
            <th>Jumlah ID</th>
            <th>Jumlah ID NG</th>
            <th>Size OD</th>
            <th>Jumlah OD</th>
            <th>Jumlah OD NG</th>
            <th>Total OK</th>
            <th>Total NG</th>
            <th>Tujuan</th>
            <th>Shift</th>
            <th>Keterangan</th>
            <th>Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @forelse($records as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->date ?: ($row->created_at?->format('Y-m-d') ?? '—') }}</td>
            <td>{{ $row->size_id ?? '—' }}</td>
            <td>{{ (int) $row->jumlah_id }}</td>
            <td>{{ (int) $row->jumlah_id_ng }}</td>
            <td>{{ $row->size_od ?? '—' }}</td>
            <td>{{ (int) $row->jumlah_od }}</td>
            <td>{{ (int) $row->jumlah_od_ng }}</td>
            <td>{{ (int) $row->jumlah_id + (int) $row->jumlah_od }}</td>
            <td>{{ (int) $row->jumlah_id_ng + (int) $row->jumlah_od_ng }}</td>
            <td>{{ $row->tujuan ?? '—' }}</td>
            <td>{{ $row->shift ?? '—' }}</td>
            <td>{{ $row->keterangan ?? '—' }}</td>
            <td>{{ $row->created_at?->format('d-m-Y H:i') ?? '—' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="14">Tidak ada data untuk filter yang dipilih.</td>
        </tr>
        @endforelse
    </tbody>
</table>
