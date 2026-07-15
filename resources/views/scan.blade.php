<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Coba Remote Scanner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5 text-center">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h4 class="card-title mb-4">Uji Coba Sistem Scan Dokumen</h4>
            
            <button id="btnScan" class="btn btn-primary btn-lg w-100 py-3">
                <span id="scanText">MULAI SCAN DOKUMEN</span>
                <span id="loadingText" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Mesin sedang men-scan...
                </span>
            </button>

            <div id="resultArea" class="mt-4 d-none">
                <h5 class="text-success">Scan Berhasil!</h5>
                <img id="previewImage" src="" class="img-fluid border rounded my-3" alt="Hasil Scan">
                <br>
                <a id="downloadLink" href="" target="_blank" class="btn btn-outline-secondary btn-sm">Buka File Asli</a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('btnScan').onclick = async function() {
    const btn = this;
    const scanText = document.getElementById('scanText');
    const loadingText = document.getElementById('loadingText');
    const resultArea = document.getElementById('resultArea');
    const previewImage = document.getElementById('previewImage');
    const downloadLink = document.getElementById('downloadLink');

    // 1. Ubah tombol menjadi mode loading
    btn.disabled = true;
    scanText.classList.add('d-none');
    loadingText.classList.remove('d-none');
    resultArea.classList.add('d-none');

    try {
        // 2. Kirim request ke backend Laravel
        let res = await fetch("{{ route('laravel.scan') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        let data = await res.json();

        if (data.success) {
            // 3. Tampilkan hasil jika sukses
            previewImage.src = data.file_url + '?t=' + new Date().getTime(); // Anti cache
            downloadLink.href = data.file_url;
            resultArea.classList.remove('d-none');
        } else {
            alert(data.message || 'Terjadi kesalahan sistem.');
            console.error('Debug details:', data.debug);
        }
    } catch (error) {
        console.error(error);
        alert('Gagal terhubung ke server.');
    } finally {
        // 4. Kembalikan tombol ke kondisi semula
        btn.disabled = false;
        scanText.classList.remove('d-none');
        loadingText.classList.add('d-none');
    }
}
</script>

</body>
</html>
