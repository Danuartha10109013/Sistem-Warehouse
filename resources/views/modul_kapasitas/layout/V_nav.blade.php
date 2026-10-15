<!-- Sidebar / V_nav -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 menu-sidebar bg-white rtl:pe-4 rtl:ps-0 h-screen transition-transform -translate-x-full xl:translate-x-0 w-[270px] border-r border-slate-100" style="width: 270px !important;" aria-label="Sidebar">
    <!-- Brand Logo Header -->
    <div class="p-3.5 flex items-center justify-between border-b border-slate-100">
        <a href="{{ route('modul-kapasitas.dashboard') }}" class="flex items-center gap-2 text-decoration-none whitespace-nowrap overflow-hidden w-full" style="white-space: nowrap !important;">
            <img src="{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}" style="height: 38px; width: auto; flex-shrink: 0;" alt="Logo" />
            <span style="font-weight: 700; font-size: 17.5px; color: #1a569d; letter-spacing: 0.3px; font-family: 'Plus Jakarta Sans', sans-serif; white-space: nowrap !important;">TATA METAL LESTARI</span>
        </a>
        <!-- Close Button Mobile View -->
        <button type="button" data-drawer-hide="sidebar" aria-controls="sidebar" class="xl:hidden p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 cursor-pointer ml-1 flex-shrink-0">
            <i class="ti ti-x" style="font-size: 20px;"></i>
        </button>
    </div>
    
    <!-- Sidebar Navigation Links -->
    <div class="h-[calc(100vh-75px)] overflow-y-auto px-4 py-3 sidebar-nav">
        <!-- HOME SECTION -->
        <span class="nav-caption">Home</span>
        
        <a href="{{ route('modul-kapasitas.dashboard') }}" class="sidebar-item-link {{ request()->routeIs('modul-kapasitas.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large" style="font-size: 1.1rem; width: 22px; text-align: center;"></i>
            <span>Dashboard</span>
        </a>
        
        <!-- UTILITIES SECTION -->
        <span class="nav-caption" style="margin-top: 14px;">Utilities</span>

        <!-- Input Harian -->
        <a href="{{ route('modul-kapasitas.input-harian') }}" class="sidebar-item-link {{ request()->routeIs('modul-kapasitas.input-harian') ? 'active' : '' }}">
            <i class="fas fa-edit" style="font-size: 1.1rem; width: 22px; text-align: center;"></i>
            <span>Input Harian</span>
        </a>

        <!-- Dropdown Kapasitas -->
        @php
            $isKapasitasActive = request()->routeIs('modul-kapasitas.kapasitas.*');
        @endphp
        <div class="my-1">
            <button type="button" class="sidebar-item-link w-full justify-between cursor-pointer {{ $isKapasitasActive ? 'active' : '' }}" onclick="toggleNavDropdown('dropdown-kapasitas', this)">
                <div class="flex items-center gap-3">
                    <i class="fas fa-chart-pie" style="font-size: 1.1rem; width: 22px; text-align: center;"></i>
                    <span>Kapasitas</span>
                </div>
                <i class="ti ti-chevron-down transition-transform duration-200 text-slate-400 chevron-icon {{ $isKapasitasActive ? 'rotate-180 text-[#135b9f]' : '' }}" style="font-size: 16px;"></i>
            </button>
            <div id="dropdown-kapasitas" class="{{ $isKapasitasActive ? '' : 'hidden' }} space-y-0.5 mt-1">
                <a href="{{ route('modul-kapasitas.kapasitas.crc') }}" class="sidebar-subitem-link {{ request()->routeIs('modul-kapasitas.kapasitas.crc') ? 'active' : '' }}">
                    <i class="fas fa-circle" style="font-size: 6px; width: 14px; text-align: center;"></i>
                    <span>CRC</span>
                </a>
                <a href="{{ route('modul-kapasitas.kapasitas.barang-jadi') }}" class="sidebar-subitem-link {{ request()->routeIs('modul-kapasitas.kapasitas.barang-jadi') ? 'active' : '' }}">
                    <i class="fas fa-circle" style="font-size: 6px; width: 14px; text-align: center;"></i>
                    <span>Barang Jadi</span>
                </a>
            </div>
        </div>

        <!-- Dropdown Kelola -->
        @php
            $isKelolaActive = request()->routeIs('modul-kapasitas.filter-kategori') || request()->routeIs('modul-kapasitas.kelola-kapasitas');
        @endphp
        <div class="my-1">
            <button type="button" class="sidebar-item-link w-full justify-between cursor-pointer {{ $isKelolaActive ? 'active' : '' }}" onclick="toggleNavDropdown('dropdown-kelola', this)">
                <div class="flex items-center gap-3">
                    <i class="fas fa-cog" style="font-size: 1.1rem; width: 22px; text-align: center;"></i>
                    <span>Kelola</span>
                </div>
                <i class="ti ti-chevron-down transition-transform duration-200 text-slate-400 chevron-icon {{ $isKelolaActive ? 'rotate-180 text-[#135b9f]' : '' }}" style="font-size: 16px;"></i>
            </button>
            <div id="dropdown-kelola" class="{{ $isKelolaActive ? '' : 'hidden' }} space-y-0.5 mt-1">
                <a href="{{ route('modul-kapasitas.filter-kategori') }}" class="sidebar-subitem-link {{ request()->routeIs('modul-kapasitas.filter-kategori') ? 'active' : '' }}">
                    <i class="fas fa-circle" style="font-size: 6px; width: 14px; text-align: center;"></i>
                    <span>Filter Kategori</span>
                </a>
                <a href="{{ route('modul-kapasitas.kelola-kapasitas') }}" class="sidebar-subitem-link {{ request()->routeIs('modul-kapasitas.kelola-kapasitas') ? 'active' : '' }}">
                    <i class="fas fa-circle" style="font-size: 6px; width: 14px; text-align: center;"></i>
                    <span>Kapasitas</span>
                </a>
            </div>
        </div>
    </div>
</aside>

<script>
    function toggleNavDropdown(id, btn) {
        const menu = document.getElementById(id);
        if (menu) {
            menu.classList.toggle('hidden');
            const icon = btn.querySelector('.chevron-icon');
            if (icon) {
                icon.classList.toggle('rotate-180');
            }
        }
    }
</script>
