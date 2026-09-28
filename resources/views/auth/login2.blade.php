<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login || Sistem Informasi Digital WH</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('bahan_logo_v2/logobg-ic.png')}}" />
    <link rel="stylesheet" href="{{asset('template_v2/src/assets/css/styles.min.css')}}" />
    <style>
        /* Mengganti latar belakang dengan gambar pabrik/perusahaan beserta overlay gelap yang elegan */
        .page-wrapper {
            background: linear-gradient(rgba(30, 41, 59, 0.8), rgba(19, 91, 159, 0.9)), url('{{ asset("bahan_logo_v2/main_image-v2.jpg") }}') center center / cover no-repeat fixed !important;
        }

        /* Menambahkan bayangan pada card agar lebih menonjol di atas background terang */
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        .radial-gradient {
            background: none !important;
        }

        /* Global Override Primary Color (Biru Korporat) untuk tombol Login */
        .btn-primary {
            background-color: #135b9f !important;
            border-color: #135b9f !important;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #0f4a85 !important;
            border-color: #0f4a85 !important;
        }

        /* Menyesuaikan warna input form agar putih bersih & netral */
        .form-control {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            /* Border abu-abu muda */
            color: #334155 !important;
        }

        .form-control:focus {
            border-color: #135b9f !important;
            /* Warna biru korporat saat di-klik */
            box-shadow: 0 0 0 0.25rem rgba(19, 91, 159, 0.25) !important;
        }

        /* Menyesuaikan tombol icon mata (password) agar menyatu dengan input */
        .input-group .btn-outline-secondary {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-left: none !important;
            /* Menghilangkan garis tengah */
            color: #64748b !important;
        }

        .input-group .btn-outline-secondary:hover {
            background-color: #f8fafc !important;
            color: #5d87ff !important;
        }

        #password {
            border-right: none !important;
            /* Menghilangkan garis batas dengan tombol mata */
        }

        /* Menyesuaikan jarak/margin di mobile */
        @media (max-width: 576px) {
            .card-body {
                padding: 1.5rem !important;
                /* Mengurangi padding card di mobile */
            }
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <!-- Mengatur kolom agar di mobile tidak terlalu besar (menggunakan col-10/11) -->
                    <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xxl-3">
                        <div class="card mb-0 shadow-sm">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{asset('bahan_logo_v2/logobg-ic.png')}}" width="180"
                                        alt="Logo Tata Metal Lestari">
                                </a>
                                <p class="text-center">Sistem Informasi Manajemen Operasional</p>

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <form method="POST" action="{{route('login-proses')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email" value="{{ session('email') }}" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('template_v2/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('template_v2/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            const passwordInput = document.getElementById("password");
            const icon = this.querySelector("i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("ti-eye");
                icon.classList.add("ti-eye-off");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("ti-eye-off");
                icon.classList.add("ti-eye");
            }
        });
    </script>
</body>

</html>