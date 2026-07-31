<!DOCTYPE html>
<html>
<head>
    <title>Report Open Pack - {{ $inspection->attribute }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h3 { text-align: center; text-transform: uppercase; margin-bottom: 20px; }
        .section-title { font-weight: bold; margin-top: 20px; margin-bottom: 10px; background-color: #e0e0e0; padding: 5px; }
        .photo-grid { width: 100%; margin-bottom: 10px; border: none; }
        .photo-grid td { width: 50%; border: none; padding: 5px; text-align: center; vertical-align: top; }
        .photo-grid img { max-width: 100%; max-height: 200px; border: 1px solid #ccc; }
        .label { font-weight: bold; margin-top: 5px; }
        .grid-4 td { width: 25%; }
    </style>
</head>
<body>

    <h3>Form Inspeksi Open Pack</h3>

    <div class="section-title">A. INFORMASI UMUM</div>
    <table>
        <tr>
            <th width="30%">Attribute / Coil ID</th>
            <td width="70%">{{ $inspection->attribute }}</td>
        </tr>
        <tr>
            <th>Tanggal Kedatangan</th>
            <td>{{ $inspection->tanggal_kedatangan }}</td>
        </tr>
        <tr>
            <th>Nomor Surat Jalan</th>
            <td>{{ $inspection->nomor_surat_jalan }}</td>
        </tr>
        <tr>
            <th>Nomor Coil Supplier</th>
            <td>{{ $inspection->nomor_coil_supplier }}</td>
        </tr>
        <tr>
            <th>Nama Supplier</th>
            <td>{{ $inspection->nama_supplier }}</td>
        </tr>
        <tr>
            <th>Tanggal Open Pack</th>
            <td>{{ $inspection->tanggal_open_pack }}</td>
        </tr>
        <tr>
            <th>Grup</th>
            <td>{{ $inspection->grup }}</td>
        </tr>
    </table>

    <div class="section-title">B. KONDISI AWAL (CRC Sebelum Open Pack)</div>
    <p>Kondisi Aktual: <strong>{{ $inspection->kondisi_awal }}</strong></p>
    
    @if($inspection->kondisi_awal === 'NOT_GOOD')
    <table class="photo-grid">
        <tr>
            <td>
                @if(isset($photos['awal_ws']))
                    <img src="{{ $photos['awal_ws'] }}">
                @else
                    <div style="height: 150px; border: 1px dashed #999;"></div>
                @endif
                <div class="label">Dokumentasi WS</div>
            </td>
            <td>
                @if(isset($photos['awal_ds']))
                    <img src="{{ $photos['awal_ds'] }}">
                @else
                    <div style="height: 150px; border: 1px dashed #999;"></div>
                @endif
                <div class="label">Dokumentasi DS</div>
            </td>
        </tr>
    </table>
    @endif

    @if(isset($photos['temuan_awal_damaged']) || isset($photos['temuan_awal_evidence']))
    <p><strong>Temuan Defect Ketidaksesuaian:</strong></p>
    <table class="photo-grid">
        <tr>
            <td>
                @if(isset($photos['temuan_awal_damaged']))
                    <img src="{{ $photos['temuan_awal_damaged'] }}">
                @endif
                <div class="label">Dokumentasi Damaged</div>
            </td>
            <td>
                @if(isset($photos['temuan_awal_evidence']))
                    <img src="{{ $photos['temuan_awal_evidence'] }}">
                @endif
                <div class="label">Lampiran Evidence Supplier</div>
            </td>
        </tr>
    </table>
    @endif


    <div class="section-title">C. KONDISI SETELAH OPEN PACK</div>
    <p>Kondisi Aktual: <strong>{{ $inspection->kondisi_setelah_open_pack }}</strong></p>

    @if($inspection->kondisi_setelah_open_pack === 'NOT_GOOD')
    <table class="photo-grid grid-4">
        <tr>
            <td>
                @if(isset($photos['ng_sidewall_ws']))
                    <img src="{{ $photos['ng_sidewall_ws'] }}">
                @endif
                <div class="label">Sidewall WS (VCI di bawah)</div>
            </td>
            <td>
                @if(isset($photos['ng_sidewall_ds']))
                    <img src="{{ $photos['ng_sidewall_ds'] }}">
                @endif
                <div class="label">Sidewall DS (VCI di bawah)</div>
            </td>
            <td>
                @if(isset($photos['ng_bawah']))
                    <img src="{{ $photos['ng_bawah'] }}">
                @endif
                <div class="label">Bagian Bawah CRC</div>
            </td>
            <td>
                @if(isset($photos['ng_surface']))
                    <img src="{{ $photos['ng_surface'] }}">
                @endif
                <div class="label">Surface CRC (Karat)</div>
            </td>
        </tr>
    </table>
    @endif

    @if(isset($photos['defect_sidewall_damaged']) || isset($photos['defect_id_od_damaged']) || isset($photos['defect_karat_damaged']))
    <p><strong>Rincian Temuan Defect / Ketidaksesuaian:</strong></p>
    <table class="photo-grid">
        @if(isset($photos['defect_sidewall_damaged']) || isset($photos['defect_sidewall_evidence']))
        <tr>
            <td>
                @if(isset($photos['defect_sidewall_damaged']))
                    <img src="{{ $photos['defect_sidewall_damaged'] }}">
                @endif
                <div class="label">Sidewall Damaged</div>
            </td>
            <td>
                @if(isset($photos['defect_sidewall_evidence']))
                    <img src="{{ $photos['defect_sidewall_evidence'] }}">
                @endif
                <div class="label">Evidence VCI Supplier</div>
            </td>
        </tr>
        @endif

        @if(isset($photos['defect_id_od_damaged']) || isset($photos['defect_id_od_evidence']))
        <tr>
            <td>
                @if(isset($photos['defect_id_od_damaged']))
                    <img src="{{ $photos['defect_id_od_damaged'] }}">
                @endif
                <div class="label">ID/OD Damaged</div>
            </td>
            <td>
                @if(isset($photos['defect_id_od_evidence']))
                    <img src="{{ $photos['defect_id_od_evidence'] }}">
                @endif
                <div class="label">Evidence Ring ID/OD</div>
            </td>
        </tr>
        @endif

        @if(isset($photos['defect_karat_damaged']) || isset($photos['defect_karat_evidence']))
        <tr>
            <td>
                @if(isset($photos['defect_karat_damaged']))
                    <img src="{{ $photos['defect_karat_damaged'] }}">
                @endif
                <div class="label">Surface Karat</div>
            </td>
            <td>
                @if(isset($photos['defect_karat_evidence']))
                    <img src="{{ $photos['defect_karat_evidence'] }}">
                @endif
                <div class="label">Evidence VCI Supplier</div>
            </td>
        </tr>
        @endif
    </table>
    @endif

    <div class="section-title">KETERANGAN</div>
    <p>{{ $inspection->keterangan ?: '-' }}</p>

</body>
</html>
