<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>NO COIL EUP</th>
            <th>TIMESTAMP</th>
            <th>PALET</th>
            <th>LAYOUT PENGIRIMAN</th>
            <th>BERAT (KG)</th>
            <th>KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->no_coil_eup }}</td>
            <td>{{ $row->created_at->format('d/m/Y H:i:s') }}</td>
            <td>{{ $row->palet ? $row->palet->nama_palet : '-' }}</td>
            <td>{{ $row->layout->nama_layout ?? '-' }}</td>
            <td>{{ $row->berat }}</td>
            <td>{{ $row->keterangan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
