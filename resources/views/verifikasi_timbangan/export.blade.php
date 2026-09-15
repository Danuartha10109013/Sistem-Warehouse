<table border="1">
    <thead>
        <tr>
            <th style="background-color: #f8fafc; font-weight: bold;">NO</th>
            <th style="background-color: #f8fafc; font-weight: bold;">TANGGAL</th>
            <th style="background-color: #f8fafc; font-weight: bold;">LABEL (kg)</th>
            <th style="background-color: #f8fafc; font-weight: bold;">ACTUAL (kg)</th>
            <th style="background-color: #f8fafc; font-weight: bold;">SELISIH (kg)</th>
            <th style="background-color: #f8fafc; font-weight: bold;">STATUS</th>
            <th style="background-color: #f8fafc; font-weight: bold;">TINDAK LANJUT</th>
            <th style="background-color: #f8fafc; font-weight: bold;">ACTUAL SETELAH (kg)</th>
            <th style="background-color: #f8fafc; font-weight: bold;">SELISIH SETELAH (kg)</th>
            <th style="background-color: #f8fafc; font-weight: bold;">OPERATOR</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
            <td>{{ $row->label }}</td>
            <td>{{ $row->actual }}</td>
            <td>{{ $row->selisih > 0 ? '+'.$row->selisih : $row->selisih }}</td>
            <td>{{ $row->status }}</td>
            <td>{{ $row->tindak_lanjut ?? '-' }}</td>
            <td>{{ $row->actual_setelah ?? '-' }}</td>
            <td>{{ !is_null($row->selisih_setelah) ? ($row->selisih_setelah > 0 ? '+'.$row->selisih_setelah : $row->selisih_setelah) : '-' }}</td>
            <td>{{ $row->operator_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
