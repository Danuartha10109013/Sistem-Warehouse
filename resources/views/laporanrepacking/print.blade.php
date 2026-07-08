<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Print Laporan Repacking CRC</title>
    <link href="{{ asset('sac') }}/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 2rem; font-size: 14px; }
        .print-header { border-bottom: 2px solid #2563eb; padding-bottom: 1rem; margin-bottom: 1.5rem; }
        @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-primary btn-sm">Cetak</button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">Tutup</button>
    </div>

    <div class="print-header text-center">
        <h4 class="fw-bold mb-1">LAPORAN REPACKING CRC</h4>
        <p class="text-muted mb-0">Tata Metal Lestari</p>
    </div>

    <table class="table table-bordered">
        <tbody>
            <tr><th style="width:35%">Attribute</th><td>{{ $record['atributte'] }}</td></tr>
            <tr><th>Tanggal</th><td>{{ $record['tanggal'] }}</td></tr>
            <tr><th>Status</th><td>{{ $record['status'] }}</td></tr>
            <tr><th>Group</th><td>{{ $record['group'] }}</td></tr>
            <tr><th>Plastik Wrapping</th><td>{{ $record['wrapping'] }}</td></tr>
            <tr><th>VCI Paper</th><td>{{ $record['vcipaper'] }}</td></tr>
            <tr><th>Keterangan</th><td>{{ $record['keterangan'] }}</td></tr>
            <tr><th>Dibuat Oleh</th><td>{{ $record['created_by'] }}</td></tr>
            <tr><th>Dibuat Pada</th><td>{{ $record['created_at'] }}</td></tr>
        </tbody>
    </table>
</body>
</html>
