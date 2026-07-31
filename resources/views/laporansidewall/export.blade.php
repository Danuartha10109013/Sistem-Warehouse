<table>
    <thead>
        <tr>
            <th colspan="8" style="font-size: 14px; font-weight: bold;">LAPORAN Sidewall</th>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Diekspor pada</th>
            <td colspan="6">{{ $filters['exported_at'] ?? now()->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Rentang tanggal</th>
            <td colspan="6">{{ $filters['from'] ?? '—' }} s/d {{ $filters['to'] ?? '—' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Size Sidewall</th>
            <td colspan="6">{{ $filters['size_sidewall'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Tujuan</th>
            <td colspan="6">{{ $filters['tujuan'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Shift</th>
            <td colspan="6">{{ $filters['shift'] ?? 'Semua' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Pencarian</th>
            <td colspan="6">{{ $filters['search'] ?? '—' }}</td>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: bold;">Total baris</th>
            <td colspan="6">{{ $filters['total_rows'] ?? $records->count() }}</td>
        </tr>
        <tr><td colspan="8"></td></tr>
        <tr style="font-weight: bold; background-color: #e2e8f0;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Size Sidewall</th>
            <th>Jumlah</th>
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
            <td>{{ $row->size_sidewall ?? '—' }}</td>
            <td>{{ $row->jumlah ?? 1 }}</td>
            <td>{{ $row->tujuan ?? '—' }}</td>
            <td>{{ $row->shift ?? '—' }}</td>
            <td>{{ $row->keterangan ?? '—' }}</td>
            <td>{{ $row->created_at?->format('d-m-Y H:i') ?? '—' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">Tidak ada data untuk filter yang dipilih.</td>
        </tr>
        @endforelse
    </tbody>
</table>
