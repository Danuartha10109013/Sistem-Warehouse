<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Digital WH') | PT Tata Metal Lestari</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('bahan_logo_v2/logobg-ic.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Compiled CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/template.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'Manrope', 'system-ui', 'sans-serif'],
                },
                extend: {
                    borderRadius: {
                        bb: "20px",
                    },
                    colors: {
                        primary: "#135b9f",
                        lightprimary: "rgba(19, 91, 159, 0.1)",
                        secondary: "var(--color-secondary)",
                        info: "var(--color-info)",
                        success: "var(--color-success)",
                        warning: "var(--color-warning)",
                        error: "var(--color-error)",
                        lightsecondary: "var(--color-lightsecondary)",
                        lightsuccess: "var(--color-lightsuccess)",
                        lighterror: "var(--color-lighterror)",
                        lightinfo: "var(--color-lightinfo)",
                        lightwarning: "var(--color-lightwarning)",
                        border: "var(--color-border)",
                        bordergray: "var(--color-bordergray)",
                        lightgray: "#f8fafc",
                        muted: "var(--color-muted)",
                        lighthover: "var(--color-lighthover)",
                        surface: "var(--color-surface-ld)",
                        sky: "var(--color-sky)",
                        bodytext: "#5a6a85",
                        dark: "var(--color-dark)",
                        link: "#1e293b",
                        darklink: "var(--color-darklink)",
                        darkborder: "var(--color-darkborder)",
                        darkgray: "var(--color-darkgray)",
                        darkmuted: "var(--color-darkmuted)",
                    },
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        :root {
            --color-primary: #135b9f;
            --color-lightprimary: rgba(19, 91, 159, 0.1);
        }
        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Sidebar Link corporate styling */
        .sidebar-item-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            margin: 4px 0;
            border-radius: 8px;
            color: #5a6a85;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .sidebar-item-link:hover {
            background-color: rgba(19, 91, 159, 0.05);
            color: #135b9f;
            transform: translateX(3px);
        }
        .sidebar-item-link.active {
            background-color: rgba(19, 91, 159, 0.1) !important;
            color: #135b9f !important;
            font-weight: 700 !important;
        }
        .sidebar-subitem-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px 8px 38px;
            margin: 2px 0;
            border-radius: 6px;
            color: #64748b;
            font-weight: 500;
            font-size: 13.5px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .sidebar-subitem-link:hover {
            background-color: rgba(19, 91, 159, 0.05);
            color: #135b9f;
        }
        .sidebar-subitem-link.active {
            background-color: rgba(19, 91, 159, 0.1) !important;
            color: #135b9f !important;
            font-weight: 700 !important;
        }
        .nav-caption {
            font-size: 11px;
            font-weight: 800;
            color: #94a3b8;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 12px 14px 6px;
            display: block;
        }
        /* Custom SweetAlert Button Styles */
        .swal-custom-btn {
            border-radius: 8px !important;
            padding: 12px 28px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            letter-spacing: 0.3px !important;
            transition: all 0.2s ease !important;
            margin: 0 8px !important;
            cursor: pointer;
        }
        .swal-custom-confirm {
            background-color: #b91c1c !important;
            color: #ffffff !important;
            border: 1px solid #991b1b !important;
            box-shadow: 0 4px 6px rgba(153, 27, 27, 0.15) !important;
        }
        .swal-custom-confirm:hover {
            background-color: #991b1b !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 15px rgba(153, 27, 27, 0.25) !important;
        }
        .swal-custom-cancel {
            background-color: #ffffff !important;
            color: #475569 !important;
            border: 1px solid #cbd5e1 !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02) !important;
        }
        .swal-custom-cancel:hover {
            background-color: #f8fafc !important;
            color: #1e293b !important;
            border-color: #94a3b8 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05) !important;
        }
        .custom-logout-popup {
            border-radius: 20px !important;
            padding: 32px 24px 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        }
        .custom-actions-container {
            margin-top: 24px !important;
            gap: 12px;
        }
        .custom-close-btn {
            color: #94a3b8 !important;
        }
        .custom-close-btn:hover {
            color: #ef4444 !important;
            background: #fef2f2 !important;
        }
        /* Match Sidebar & Content Layout to rekap_prd (270px) */
        #sidebar {
            width: 270px !important;
            max-width: 270px !important;
        }
        .page-wrapper {
            margin-left: 270px !important;
        }
        @media screen and (max-width: 1280px) {
            .page-wrapper {
                margin-left: 0 !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="text-sm text-bodytext bg-slate-50 overflow-x-hidden">
    <div class="flex w-full min-h-screen bg-slate-50 overflow-x-hidden min-w-0">
        <div class="page-wrapper flex w-full xl:w-[calc(100%-270px)] min-w-0">
            
            <!-- Sidebar / V_nav -->
            @include('modul_kapasitas.layout.V_nav')

            <!-- Main Content Area -->
            <div class="page-wrapper-sub flex flex-col w-full min-w-0 bg-slate-50">
                
                <!-- Top Header -->
                @include('modul_kapasitas.layout.V_header')

                <div class="bg-slate-50 h-full min-w-0">
                    <!-- Body Content -->
                    <div class="w-full min-w-0 overflow-x-hidden">
                        <div class="w-full 2xl:container mx-auto py-6 px-4 sm:px-6 lg:px-8 min-w-0">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.showCustomConfirm = function(options) {
            return Swal.fire({
                html: `
                    <div style="margin-bottom: 24px; margin-top: 10px; text-align: center;">
                        <div style="width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center; background: #fef2f2; border-radius: 50%;">
                            <i class="${options.iconClass || 'fas fa-trash-alt'}" style="font-size: 40px; color: #ef4444;"></i>
                        </div>
                    </div>
                    <h2 style="font-weight: 800; color: #1e293b; font-size: 22px; margin-bottom: 12px; font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.5px; text-align: center;">${options.title}</h2>
                    <p style="color: #64748b; font-size: 15px; margin-bottom: 0; line-height: 1.6; font-family: 'Plus Jakarta Sans', sans-serif; text-align: center;">
                        ${options.text}
                    </p>
                `,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: options.confirmText || 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                width: '420px',
                background: '#ffffff',
                backdrop: `rgba(15, 23, 42, 0.65)`,
                buttonsStyling: false,
                customClass: {
                    popup: 'custom-logout-popup',
                    closeButton: 'custom-close-btn',
                    confirmButton: 'swal-custom-btn swal-custom-confirm',
                    cancelButton: 'swal-custom-btn swal-custom-cancel',
                    actions: 'custom-actions-container'
                }
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('header-logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');
                    window.showCustomConfirm({
                        iconClass: 'ti ti-logout',
                        title: 'Konfirmasi Keluar',
                        text: 'Apakah Anda yakin ingin mengakhiri sesi ini?<br>Anda harus <span style="color: #1e293b; font-weight: 600;">login kembali</span> untuk mengakses sistem.',
                        confirmText: 'Ya, Keluar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

