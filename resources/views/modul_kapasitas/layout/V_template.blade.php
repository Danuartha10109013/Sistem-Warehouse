<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_TML.png') }}" />
    <!-- Compiled CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/template.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ['Manrope', 'system-ui', 'serif'],
                },
                extend: {
                    borderRadius: {
                        bb: "20px",
                    },
                    colors: {
                        primary: "var(--color-primary)",
                        secondary: "var(--color-secondary)",
                        info: "var(--color-info)",
                        success: "var(--color-success)",
                        warning: "var(--color-warning)",
                        error: "var(--color-error)",
                        lightprimary: "var(--color-lightprimary)",
                        lightsecondary: "var(--color-lightsecondary)",
                        lightsuccess: "var(--color-lightsuccess)",
                        lighterror: "var(--color-lighterror)",
                        lightinfo: "var(--color-lightinfo)",
                        lightwarning: "var(--color-lightwarning)",
                        border: "var(--color-border)",
                        bordergray: "var(--color-bordergray)",
                        lightgray: "var(--color-lightgray)",
                        muted: "var(--color-muted)",
                        lighthover: "var(--color-lighthover)",
                        surface: "var(--color-surface-ld)",
                        sky: "var(--color-sky)",
                        bodytext: "var(--color-bodytext)",
                        dark: "var(--color-dark)",
                        link: "var(--color-link)",
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
    @stack('styles')
</head>
<body class="text-sm text-bodytext bg-white dark:bg-darkgray">
    <div class="flex w-full min-h-screen dark:bg-darkgray">
        <div class="page-wrapper flex w-full">
            
            <!-- Sidebar / V_nav -->
            @include('modul_kapasitas.layout.V_nav')

            <!-- Main Content Area -->
            <div class="page-wrapper-sub flex flex-col w-full dark:bg-darkgray">
                
                <!-- Top Header -->
                @include('modul_kapasitas.layout.V_header')

                <div class="bg-lightgray dark:bg-dark h-full rounded-bb">
                    <!-- Body Content -->
                    <div class="w-full">
                        <div class="w-full 2xl:container mx-auto py-8 px-4 sm:px-6 lg:px-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>

