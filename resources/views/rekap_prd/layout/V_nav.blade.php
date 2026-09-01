<!-- Sidebar / V_nav -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 menu-sidebar bg-white dark:bg-darkgray rtl:pe-4 rtl:ps-0 h-screen transition-transform -translate-x-full xl:translate-x-0" aria-label="Sidebar">
    <div class="px-6 py-5 flex items-center justify-center border-b border-gray-100 dark:border-gray-700/50 sidebarlogo mb-2">
        <a href="{{ route('rekap-prd.dashboard') }}" class="flex items-center justify-center w-full transition-transform hover:scale-105 duration-300">
            <img src="{{ asset('images/Logo TML side.png') }}" alt="Logo" class="h-10 w-full object-contain" style="max-width: 170px;" />
        </a>
    </div>
    
    <div class="h-[calc(100vh-80px)] overflow-y-auto px-5 mt-2 sidebar-nav hide-menu">
        <!-- Home Section -->
        <div class="caption">
            <h5 class="text-link dark:text-white/70 caption font-semibold leading-6 tracking-widest text-xs pb-2 mt-4 uppercase">Home</h5>
            
            <a href="{{ route('rekap-prd.dashboard') }}" class="flex items-center gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('rekap-prd.dashboard') ? 'bg-primary text-white font-semibold border-primary hover:bg-primary hover:text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span class="text-sm">Dashboard</span>
            </a>
            
            <a href="{{ route('rekap-prd.input') }}" class="flex items-center gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('rekap-prd.input') ? 'bg-primary text-white font-semibold border-primary hover:bg-primary hover:text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span class="text-sm">Input & Analisa</span>
            </a>
            
        </div>
    </div>
</aside>
