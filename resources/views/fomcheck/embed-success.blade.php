<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Berhasil</title>
</head>
<body>
<script>
    window.parent.postMessage({
        type: 'fomcheck-success',
        message: @json($message),
        materialType: @json($type),
    }, '*');
</script>
<p class="text-center text-muted p-4">Menyimpan data...</p>
</body>
</html>
