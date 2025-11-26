<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>FM.WH.02.02 - CEKLIST KEDATANGAN RAW MATERIAL</title>
<style>
  @page { size: A4; margin: 20mm; }
  body {
    font-family: "Arial", sans-serif;
    font-size: 12px;
    color: #000;
    background: #fff;
    margin: 0;
    padding: 0;
  }
  .page {
    width: 210mm;
    min-height: 297mm;
    padding: 20mm;
    box-sizing: border-box;
  }
  header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding-bottom: 6px;
    margin-bottom: 8px;
  }
  header img {
    width: 90px;
    height: auto;
  }
  header .title {
    text-align: center;
    flex: 1;
  }
  header .title h1 {
    margin-top: 55px;
    font-size: 20px;
    margin: 0;
    text-transform: uppercase;
    font-weight: bold;
  }
  header .title p {
    font-size: 11px;
    margin: 2px 0 0;
  }
  header .form-code {
    font-size: 11px;
    text-align: right;
    margin-top: -30px;
  }


  table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid #000;
    margin-top: 6px;
  }
  table th, table td {
    border: 1px solid #000;
    padding: 4px 6px;
    vertical-align: top;
  }
  table th {
    text-align: center;
    font-weight: bold;
  }
  .section-title {
    font-weight: bold;
    margin-top: 10px;
  }

  .table-pertama{
    border: none;
  }

  .signature-block {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
  }
  .signature {
    text-align: center;
    /* border: 1px solid #000; */
    width: 200px;
    height: 80px;
    padding-top: 40px;
    font-size: 11px;
  }
  .notes {
    font-size: 11px;
    margin-top: 10px;
  }
</style>
</head>
<body>
<div class="page">

  <header>
    <img src="{{ asset('Logo_TML.png') }}" alt="Logo TML">

    <div class="title">
      <h1>CEKLIST KEDATANGAN RAW MATERIAL</h1>
      <!-- <p>FM.WH.02.02</p> -->
    </div>
    <div class="form-code">
      <p><strong>FM.WH.02.02</strong> </p>
      <!-- <p><strong>Tanggal:</strong> ___________</p> -->
    </div>
  </header>
@php
    // dd($submission);
@endphp
  <table class="table-ppertama" style="border: none; border-bottom: 2px solid #000;">
    <tr>
      <td width="25%" style="border: none">Pengirim / Supplier</td>
      @if($submission->supplier)
      <td width="25%" style="border: none">:
        <span style="text-decoration: underline;font-weight: bold">
            {{
                is_array($submission->supplier)
                    ? implode(', ', $submission->supplier)
                    : trim(str_replace(['[', ']', '"'], '', $submission->supplier))
            }}
        </span>

      </td>
      @else
      <td width="25%" style="border: none">: ______________________</td>
      @endif
      <td width="25%" style="border: none">No. Surat Jalan / No. Cont.</td>
      @if($submission->shift_leader)
      <td width="25%" style="border: none">:
        <span style="text-decoration: underline;font-weight: bold">
            {{$submission->shift_leader}}
        </span>
      </td>
      @else
      <td width="25%" style="border: none">: ______________________</td>
      @endif
    </tr>
    <tr>
      <td style="border: none">Jenis</td>
      @if($submission->jenis)
      <td width="25%" style="border: none">:
        <span style="text-decoration: underline;font-weight: bold">
            {{$submission->jenis}}
        </span>
      </td>
      @else
      <td width="25%" style="border: none">: ______________________</td>
      @endif
      <td style="border: none">Jumlah</td>
      @if($submission->jumlahin)
      <td width="25%" style="border: none">:
        <span style="text-decoration: underline;font-weight: bold">
            {{$submission->jumlahin}}
        </span>
      </td>
      @else
      <td width="25%" style="border: none">: ______________________</td>
      @endif
    </tr>
    <tr>
      <td style="border: none">Tanggal Surat Jalan</td>
      @if($submission->date)
      <td width="25%" style="border: none">:
        <span style="text-decoration: underline;font-weight: bold">
            {{ \Carbon\Carbon::parse($submission->date)->format('d-m-Y') }}
        </span>
      </td>
      @else
      <td width="25%" style="border: none">: ______________________</td>
      @endif
      <td style="border: none">Cuaca</td>
      @if($submission->cuaca)
      <td width="25%" style="border: none">:
        <span style="text-decoration: underline;font-weight: bold">
            {{$submission->cuaca}}
        </span>
      </td>
      @else
      <td width="25%" style="border: none">: ______________________</td>
      @endif
    </tr>
  </table>

  {{-- <p class="section-title">Checklist Kedatangan</p> --}}

  <table>
    <thead>
    <tr>
      <th rowspan="2" style="border:1px solid #000; width:5%; vertical-align: middle;" >No.</th>
      <th rowspan="2" style="border:1px solid #000;vertical-align: middle;">Uraian</th>
      <th colspan="2" style="border:1px solid #000;vertical-align: middle;">Hasil Pengecekan</th>
      <th rowspan="2" style="border:1px solid #000; width:25%;vertical-align: middle;">Keterangan</th>
    </tr>
    <tr>
      <th style="border:1px solid #000; width:12%;vertical-align: middle;">Sesuai</th>
      <th style="border:1px solid #000; width:12%;vertical-align: middle;">Tidak Sesuai</th>
    </tr>
  </thead>
    <tbody>
      <tr><td align="center">1</td><td>Tujuan Surat Jalan</td><td style="vertical-align: middle; " align="center">{{$submission->jalan == 'Sesuai' ? '√' : ''}}</td><td style="vertical-align: middle; " align="center">{{$submission->jalan != 'Sesuai' ? '√' : ''}}</td><td>{{$submission->keterangan}}</td></tr>
      <tr><td align="center">2</td><td>Barang Sesuai Surat Jalan</td><td style="vertical-align: middle; " align="center">{{$submission->sesuai == 'sesuai' ? '√' : ''}}</td><td style="vertical-align: middle; " align="center">{{$submission->sesuai != 'sesuai' ? '√' : ''}}</td><td>{{$submission->keterangan1}}</td></tr>
      <tr><td align="center">3</td><td>Kondisi Kemasan Bagus</td><td style="vertical-align: middle; " align="center">√</td><td></td><td></td></tr>
      <tr><td align="center">4</td><td>Kering / tidak kena air</td><td style="vertical-align: middle; " align="center">{{$submission->kering == 'Kering/Tidak kena air' ? '√' : ''}}</td><td style="vertical-align: middle; " align="center">{{$submission->kering != 'Kering/Tidak kena air' ? '√' : ''}}</td><td>{{$submission->keterangan3}}</td></tr>
      <tr><td align="center">5</td><td>Kondisi pengikat (Straping) kencang</td><td style="vertical-align: middle; " align="center">√</td><td></td><td></td></tr>
      <tr><td align="center">6</td><td>Jumlah sesuai surat jalan</td><td style="vertical-align: middle; " align="center">{{$submission->jumlahin == 'Sesuai' ? '√' : ''}}</td><td style="vertical-align: middle; " align="center">{{$submission->jumlahin != 'Sesuai' ? '√' : ''}}</td><td>{{$submission->keterangan5}}</td></tr>
      <tr><td align="center">7</td><td>Drum tidak penyok / bocor (Resin - Alkali)</td><td style="vertical-align: middle; " align="center">√</td><td></td><td></td></tr>
      <tr><td align="center">8</td><td>Rantai dialas karet Ban luar</td><td style="vertical-align: middle; " align="center">√</td><td></td><td></td></tr>
      <tr><td align="center">9</td><td>Menggunakan Side Wall</td><td style="vertical-align: middle; " align="center">√</td><td></td><td></td></tr>
      <tr><td align="center">10</td><td>Pengecekan Radiasi</td><td style="vertical-align: middle; " align="center">{{$submission->radiasi <= 2 ? '√' : ''}}</td><td style="vertical-align: middle; " align="center">{{$submission->radiasi > 2 ? '√' : ''}}</td><td style="color: {{$submission->radiasi > 2 ? 'red' : ''}}">{{'Radiasi : '.$submission->radiasi." Sivert | "}} {{$submission->ket_radiasi}}</td></tr>
    </tbody>
  </table>

  <div class="notes">
    <ul>
      <li>Berikan tanda (√) pada kolom hasil pengecekan.</li>
      <li>Lampirkan Surat Jalan.</li>
      <li>Lakukan dokumentasi (Foto / Video) untuk kondisi yang “tidak sesuai”.</li>
      <li>Batas maksimal radiasi adalah 2 Sivert; lebih dari 2 Sivert tidak diperbolehkan untuk bongkar.</li>
    </ul>
  </div>

  <div class="section-title">Catatan:</div>
  <table>
    <tr><td style="height:300px"></td></tr>
  </table>

  <div class="signature-block">
    <div class="signature">Cikarang, {{ \Carbon\Carbon::parse($submission->date)->format('d-m-Y') }} <br>
    <br><br><br>
    <p>
        @php
            $nama = \App\Models\User::where('id', $submission->user_id)->value('name');
        @endphp
        {{ $nama }}</p>
</div>
  </div>

</div>
</body>
</html>
