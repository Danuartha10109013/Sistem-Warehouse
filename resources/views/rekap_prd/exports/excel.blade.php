<table>
    <thead>
        <tr>
            <th rowspan="2" style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">Tgl</th>
            <th rowspan="2" style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">Saldo Awal</th>
            <th rowspan="2" style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">Hasil Prod CGL</th>
            <th colspan="2" style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000;">Pengeluaran</th>
            <th rowspan="2" style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">Total<br>Pengeluaran</th>
            <th rowspan="2" style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000; vertical-align: middle;">Saldo Akhir</th>
        </tr>
        <tr>
            <th style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000;">TML</th>
            <th style="background-color: #E6E6FA; font-weight: bold; text-align: center; border: 1px solid #000000;">TTL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        @if($item->tanggal == '2026-08-31')
            @continue
        @endif
        @php
            $saldoAwal = $item->sisa_stock - $item->hasil_prd + $item->total_pengeluaran;
        @endphp
        <tr>
            <td style="border: 1px solid #000000; text-align: center;">
                @if($filter == 'harian' || $filter == 'bulanan')
                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-y') }}
                @elseif($filter == 'tahunan')
                    Bulan {{ date('F', mktime(0, 0, 0, $item->periode, 1)) }} 
                @else
                    {{ $item->periode ?? $item->tanggal }}
                @endif
            </td>
            <td style="border: 1px solid #000000;">{{ $saldoAwal }}</td>
            <td style="border: 1px solid #000000;">{{ $item->hasil_prd }}</td>
            <td style="border: 1px solid #000000;">{{ $item->pengeluaran_tml }}</td>
            <td style="border: 1px solid #000000;">{{ $item->pengeluaran_ttl }}</td>
            <td style="border: 1px solid #000000; background-color: #FCE4D6; font-weight: bold;">{{ $item->total_pengeluaran }}</td>
            <td style="border: 1px solid #000000; font-weight: bold;">{{ $item->sisa_stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
