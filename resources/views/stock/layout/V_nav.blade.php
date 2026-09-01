<!-- Sidebar / V_nav -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 menu-sidebar bg-white dark:bg-darkgray rtl:pe-4 rtl:ps-0 h-screen transition-transform -translate-x-full xl:translate-x-0" aria-label="Sidebar">
    <div class="px-6 py-5 flex items-center justify-center border-b border-gray-100 dark:border-gray-700/50 sidebarlogo mb-2">
        <a href="{{ route('welcome') }}" class="flex items-center justify-center w-full transition-transform hover:scale-105 duration-300">
            <img src="{{ asset('images/Logo TML side.png') }}" alt="Logo" class="h-10 w-full object-contain" style="max-width: 170px;" />
        </a>
    </div>
    
    <div class="h-[calc(100vh-80px)] overflow-y-auto px-5 mt-2 sidebar-nav hide-menu">
        <!-- Home Section -->
        <div class="caption">
            <h5 class="text-link dark:text-white/70 caption font-semibold leading-6 tracking-widest text-xs pb-2 mt-4 uppercase">Home</h5>
            
            <a href="{{ route('stock') }}" class="flex items-center gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('stock') ? 'bg-primary text-white font-semibold border-primary hover:bg-primary hover:text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span class="text-sm">Data Stock</span>
            </a>
            
            <!-- CRC Dropdown -->
            <button type="button" class="flex items-center w-full gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all" aria-controls="dropdown-crc" data-collapse-toggle="dropdown-crc">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline><polyline points="7.5 19.79 7.5 14.6 3 12"></polyline><polyline points="21 12 16.5 14.6 16.5 19.79"></polyline><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                <span class="flex-1 text-left text-sm whitespace-nowrap">CRC</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            <ul id="dropdown-crc" class="{{ request()->routeIs('stock.crc') || request()->routeIs('stock.crc.rekap_masuk') ? 'block' : 'hidden' }} py-2 space-y-1">
                <li>
                    <a href="{{ route('stock.crc.rekap_masuk') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->routeIs('stock.crc.rekap_masuk') ? 'bg-lightprimary text-primary font-semibold' : '' }}">REKAP CRC MASUK DAN KELUAR</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'ks') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/ks') ? 'bg-lightprimary text-primary font-semibold' : '' }}">KS</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'hanwa') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/hanwa') ? 'bg-lightprimary text-primary font-semibold' : '' }}">HANWA</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'grp') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/grp') ? 'bg-lightprimary text-primary font-semibold' : '' }}">GRP</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'grp_tl') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/grp_tl') ? 'bg-lightprimary text-primary font-semibold' : '' }}">GRP TL</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'essar_ina') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/essar_ina') ? 'bg-lightprimary text-primary font-semibold' : '' }}">ESSAR INA</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'posco_vnm') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/posco_vnm') ? 'bg-lightprimary text-primary font-semibold' : '' }}">POSCO VNM</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'posco_kor') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/posco_kor') ? 'bg-lightprimary text-primary font-semibold' : '' }}">POSCO KOR</a>
                </li>
                <li>
                    <a href="{{ route('stock.crc', 'nai_ina') }}" class="flex items-center w-full py-2 px-3 text-sm text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->is('stock/crc/nai_ina') ? 'bg-lightprimary text-primary font-semibold' : '' }}">NAI INA</a>
                </li>
            </ul>
            
        </div>
    </div>
</aside>
