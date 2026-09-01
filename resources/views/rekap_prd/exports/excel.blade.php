<table>
    @foreach($data as $item)
    <tr>
        <td style="font-weight: bold;">
            @if($filter == 'harian' || $filter == 'bulanan')
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-y') }}
            @elseif($filter == 'tahunan')
                Bulan {{ date('F', mktime(0, 0, 0, $item->periode, 1)) }} 
            @else
                {{ $item->periode ?? $item->tanggal }}
            @endif
        </td>
        <td></td>
    </tr>
    <tr>
        <td>Hasil PRD CGL</td>
        <td>{{ $item->hasil_prd }}</td>
    </tr>
    <tr>
        <td>Pengeluaran TML</td>
        <td>{{ $item->pengeluaran_tml }}</td>
    </tr>
    <tr>
        <td>Pengeluaran TTL</td>
        <td>{{ $item->pengeluaran_ttl }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #fce4d6;">Total pengeluaran</td>
        <td style="font-weight: bold; background-color: #fce4d6;">{{ $item->total_pengeluaran }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Sisa stock</td>
        <td style="font-weight: bold;">{{ $item->sisa_stock }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    @endforeach
</table>
