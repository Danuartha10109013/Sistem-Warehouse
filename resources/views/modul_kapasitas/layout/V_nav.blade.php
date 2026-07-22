<!-- Sidebar / V_nav -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 menu-sidebar bg-white dark:bg-darkgray rtl:pe-4 rtl:ps-0 h-screen transition-transform -translate-x-full xl:translate-x-0" aria-label="Sidebar">
    <div class="px-6 py-5 flex items-center justify-center border-b border-gray-100 dark:border-gray-700/50 sidebarlogo mb-2">
        <a href="{{ route('modul-kapasitas.dashboard') }}" class="flex items-center justify-center w-full transition-transform hover:scale-105 duration-300">
            <img src="{{ asset('images/Logo TML side.png') }}" alt="Logo" class="h-10 w-full object-contain" style="max-width: 170px;" />
        </a>
    </div>
    
    <div class="h-[calc(100vh-80px)] overflow-y-auto px-5 mt-2 sidebar-nav hide-menu">
        <!-- Home Section -->
        <div class="caption">
            <h5 class="text-link dark:text-white/70 caption font-semibold leading-6 tracking-widest text-xs pb-2 mt-4 uppercase">Home</h5>
            
            <a href="{{ route('modul-kapasitas.dashboard') }}" class="flex items-center gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('modul-kapasitas.dashboard') ? 'bg-primary text-white font-semibold border-primary hover:bg-primary hover:text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span class="text-sm">Dashboard</span>
            </a>
            
            <!-- Utilities Section -->
            <h5 class="text-link dark:text-white/70 caption font-semibold leading-6 tracking-widest text-xs pb-2 mt-6 uppercase">Utilities</h5>

            <a href="{{ route('modul-kapasitas.input-harian') }}" class="flex items-center gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('modul-kapasitas.input-harian') ? 'bg-lightprimary text-primary font-semibold border-primary' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span class="text-sm">Input Harian</span>
            </a>

            <!-- Kapasitas Dropdown -->
            <button type="button" class="flex items-center w-full gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('modul-kapasitas.kapasitas.*') ? 'bg-lightprimary text-primary font-semibold border-primary' : '' }}" aria-controls="dropdown-kapasitas" data-collapse-toggle="dropdown-kapasitas">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                <span class="flex-1 text-left text-sm whitespace-nowrap">Kapasitas</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            <ul id="dropdown-kapasitas" class="{{ request()->routeIs('modul-kapasitas.kapasitas.*') ? '' : 'hidden' }} py-2 space-y-1">
                <li>
                    <a href="{{ route('modul-kapasitas.kapasitas.crc') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->routeIs('modul-kapasitas.kapasitas.crc') ? 'text-primary font-semibold' : '' }}">CRC</a>
                </li>
                <li>
                    <a href="{{ route('modul-kapasitas.kapasitas.barang-jadi') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->routeIs('modul-kapasitas.kapasitas.barang-jadi') ? 'text-primary font-semibold' : '' }}">Barang Jadi</a>
                </li>
            </ul>

            <!-- Kelola Dropdown -->
            <button type="button" class="flex items-center w-full gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('modul-kapasitas.filter-kategori') || request()->routeIs('modul-kapasitas.kelola-kapasitas') ? 'bg-lightprimary text-primary font-semibold border-primary' : '' }}" aria-controls="dropdown-kelola" data-collapse-toggle="dropdown-kelola">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span class="flex-1 text-left text-sm whitespace-nowrap">Kelola</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            <ul id="dropdown-kelola" class="{{ request()->routeIs('modul-kapasitas.filter-kategori') || request()->routeIs('modul-kapasitas.kelola-kapasitas') ? '' : 'hidden' }} py-2 space-y-1">
                <li>
                    <a href="{{ route('modul-kapasitas.filter-kategori') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->routeIs('modul-kapasitas.filter-kategori') ? 'text-primary font-semibold' : '' }}">Filter Kategori</a>
                </li>
                <li>
                    <a href="{{ route('modul-kapasitas.kelola-kapasitas') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->routeIs('modul-kapasitas.kelola-kapasitas') ? 'text-primary font-semibold' : '' }}">Kapasitas</a>
                </li>
            </ul>
        </div>
    </div>
</aside>
