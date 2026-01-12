<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Welcome || PT Tata Metal Lestari</title>
      <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
      <style>
         body {
            background: linear-gradient(135deg, #a8b2b5, #6ca885, #67a8ce);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: white;
            position: relative;
            padding: 20px;
         }

         /* Background STOP SUAP - Seperti cap air (watermark) di tengah bawah */
         .stop-suap-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("STOP SUAP.png") }}');
            background-size: 15% auto;
            transform: translate(40%, -17%) !important;
            background-repeat: no-repeat;
            background-position: center 60%;
            background-attachment: fixed;
            z-index: 1;
            pointer-events: none;
            opacity: 0.3;
         }

         /* Wrapper untuk konten */
         .content-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1200px;
            text-align: center;
         }

         .judul {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 10;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2),
                        inset 0 1px 0 0 rgba(255, 255, 255, 0.4);
         }

         .judul h1 {
            font-size: 2.5rem;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3),
                        0 0 20px rgba(255, 255, 255, 0.1);
         }

         .gambar {
            text-align: center;
            margin: 0 auto 30px auto;
            position: relative;
            z-index: 10;
            padding: 25px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2),
                        inset 0 1px 0 0 rgba(255, 255, 255, 0.4);
            display: inline-block;
            width: fit-content;
         }

         .gambar img {
            max-width: 150px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
         }

         .menu-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            position: relative;
            z-index: 10;
         }

         .menu-item {
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-align: center;
            text-decoration: none;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2),
                        inset 0 1px 0 0 rgba(255, 255, 255, 0.4),
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 10;
            overflow: hidden;
         }

         /* Efek shimmer/glow pada menu item */
         .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
               90deg,
               transparent,
               rgba(255, 255, 255, 0.2),
               transparent
            );
            transition: left 0.5s;
         }

         .menu-item:hover::before {
            left: 100%;
         }

         .menu-item i {
            font-size: 50px;
            margin-bottom: 10px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
         }

         .menu-item:hover {
            transform: translateY(-10px) scale(1.05);
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.3),
                        inset 0 1px 0 0 rgba(255, 255, 255, 0.5),
                        0 0 20px rgba(255, 255, 255, 0.2);
         }

         .menu-item:hover i {
            transform: scale(1.1);
         }

         .menu-title {
            font-size: 18px;
            font-weight: 500;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
         }

         .menu-item:hover .menu-title {
            transform: translateY(-2px);
         }
         
         h1 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-style: italic;
         }

         /* Responsive untuk tablet */
         @media (max-width: 768px) {
            .stop-suap-background {
               background-size: 30% auto;
               background-position: center 65%;
               opacity: 0.3;
            }
            
            .judul {
               padding: 20px;
               margin-bottom: 20px;
            }
            
            .judul h1 {
               font-size: 1.8rem;
            }
            
            .gambar {
               padding: 20px;
               margin-bottom: 20px;
            }
            
            .menu-item {
               width: 120px;
               height: 120px;
               border-radius: 15px;
            }
            
            .menu-item i {
               font-size: 40px;
            }
            
            .menu-title {
               font-size: 14px;
            }
         }

         /* Responsive untuk mobile */
         @media (max-width: 576px) {
            .stop-suap-background {
               background-size: 30% auto;
               background-position: center 65%;
               opacity: 0.3;
            }
            
            body {
               padding: 15px;
            }
            
            .judul {
               padding: 15px;
               margin-bottom: 15px;
               border-radius: 15px;
            }
            
            .judul h1 {
               font-size: 1.5rem;
            }
            
            .gambar {
               padding: 15px;
               margin-bottom: 15px;
               border-radius: 15px;
            }
            
            .gambar img {
               max-width: 120px;
            }
            
            .menu-item {
               width: 100px;
               height: 100px;
               border-radius: 15px;
            }
            
            .menu-item i {
               font-size: 35px;
            }
            
            .menu-title {
               font-size: 12px;
            }
            
            .menu-container {
               gap: 15px;
            }
         }

         /* Untuk layar sangat kecil (mobile portrait) */
         @media (max-width: 480px) {
            .stop-suap-background {
               background-size: 30% auto;
               background-position: center 60%;
               opacity: 0.3;
            }
            
            .judul {
               padding: 12px;
               border-radius: 12px;
            }
            
            .judul h1 {
               font-size: 1.2rem;
            }
            
            .gambar {
               padding: 12px;
               border-radius: 12px;
            }
            
            .menu-item {
               width: 90px;
               height: 90px;
               border-radius: 12px;
            }
            
            .menu-item i {
               font-size: 30px;
            }
            
            .menu-title {
               font-size: 11px;
            }
         }

      </style>
   </head>
   <body>
      <!-- Background STOP SUAP -->
      <div class="stop-suap-background" aria-label="Stop Suap - Hargai Petugas Kami"></div>
      
      <div class="content-wrapper">
      <div class="judul">
         <h1 style="font-size: 2em;font-weight: bolder">Sistem Informasi Manajemen Operasional</h1>
         <h1 style="font-size: 1em">PT. Tata Metal Lestari</h1>
      </div>

      <div class="gambar">
         <img src="{{ asset('Logo TML.png') }}" alt="Logo PT Tata Metal Lestari">
      </div>
     @if(Auth::check())
@php
$akses = json_decode(Auth::user()->type);

// Daftar semua menu dan route-nya
$menuItems = [
    "SP"  => ["title" => "Ship Mark", "icon" => "mdi-shipping-pallet", "route" => Auth::user()->role == 0 ? route('Ship-Mark.admin.dashboard') : route('Ship-Mark.pegawai.dashboard')],
    "MP"  => ["title" => "Mapping", "icon" => "mdi-map-marker-path", "route" => Auth::user()->role == 0 ? route('Mapping.admin.shipment') : route('Mapping.pegawai.shipment')],
    "FC"  => ["title" => "Form Check", "icon" => "mdi-checkbox-marked-outline", "route" => Auth::user()->role == 0 ? route('Form-Check.admin.dashboard') : route('Form-Check.pegawai.dashboard')],
    "OP"  => ["title" => "Open Packing", "icon" => "mdi-package-variant-closed-check", "route" => Auth::user()->role == 0 ? route('Open-Packing.admin.dashboard') : route('Open-Packing.pegawai.dashboard')],
    "PL"  => ["title" => "Packing List", "icon" => "mdi-format-list-checks", "route" => route('Packing-List.admin.dashboard')],
    "CK"  => ["title" => "Checklist Kendaraan", "icon" => "mdi-car", "route" => Auth::user()->role == 0 ? route('Kendaraan.admin.dashboard') : route('Kendaraan.pegawai.dashboard')],
    "SL"  => ["title" => "Scan Layout", "icon" => "mdi-qrcode", "route" => Auth::user()->role == 0 ? route('Scan-Layout.admin.dashboard') : route('Scan-Layout.pegawai.dashboard')],
    "CD"  => ["title" => "Coil Damage", "icon" => "mdi-package-variant-closed-remove", "route" => Auth::user()->role == 0 ? route('Coil-Damage.admin.dashboard') : route('Coil-Damage.pegawai.dashboard')],
    "SO"  => ["title" => "Stock Opname", "icon" => "mdi-package-variant-closed-check", "route" => Auth::user()->role == 0 ? route('so.utama') : route('so.utama')],
    // "L8"  => ["title" => "Packing L08", "icon" => "mdi-numeric-8-box-multiple", "route" => Auth::user()->role == 0 ? route('L-08.admin.dashboard') : route('L-08.pegawai.dashboard')],
    // "PC"  => ["title" => "Form Packing", "icon" => "mdi-numeric-8-box-multiple", "route" => Auth::user()->role == 0 ? route('L-08.admin.dashboard') : route('L-08.pegawai.dashboard')],
];
@endphp

<div class="menu-container">
    @foreach ($menuItems as $key => $item)
        @if (in_array('all', $akses) || in_array($key, $akses) || ($key == 'admin' && Auth::user()->role == 0))
            <a href="{{ $item['route'] }}" class="menu-item">
                <div>
                    <i class="mdi {{ $item['icon'] }}"></i>
                    <div class="menu-title">{{ $item['title'] }}</div>
                </div>
            </a>
        @endif
    @endforeach

    {{-- Tambahan menu SIK --}}
    @if (in_array('all', $akses) || in_array('SIK', $akses))
    <a href="{{ route('sik') }}" class="menu-item">
        <div>
            <i class="mdi mdi-email"></i>
            <div class="menu-title">Surat Izin Keluar</div>
        </div>
    </a>
    <a href="{{ route('pac') }}" class="menu-item">
        <div>
            <i class="mdi mdi-note"></i>
            <div class="menu-title">Laporan Packing</div>
        </div>
    </a>

    @endif

    {{-- Menu khusus Superadmin --}}
    @if (Auth::user()->role == 5)
    <a href="{{ route('superadmin.Administrator.kelola-user') }}" class="menu-item">
        <div>
            <i class="mdi mdi-account"></i>
            <div class="menu-title">Kelola Pegawai</div>
        </div>
    </a>
    <a href="{{ route('superadmin.data-master') }}" class="menu-item">
        <div>
            <i class="mdi mdi-database-settings"></i>
            <div class="menu-title">Data Master</div>
        </div>
    </a>
    @endif

    {{-- Logout --}}
    <a href="{{ route('logout') }}" class="menu-item" id="logout-btn">
        <div>
            <i class="mdi mdi-logout"></i>
            <div class="menu-title">Sign Out</div>
        </div>
    </a>
</div>

{{-- SweetAlert logout confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault(); // Stop the default link action
        const logoutUrl = this.href;

        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = logoutUrl;
            }
        });
    });
</script>

@else
<script>window.location = "{{ route('login') }}";</script>
@endif

      </div> <!-- End content-wrapper -->
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
