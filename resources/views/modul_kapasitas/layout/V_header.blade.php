<header class="sticky top-0 z-[50] bg-white border-b border-slate-100 w-full" style="box-shadow: 0px 2px 10px rgba(0,0,0,0.04);">
    <div class="px-4 sm:px-6 py-2.5 flex items-center justify-between w-full">
        <!-- Kiri: Hamburger Toggle & Logo Mobile View -->
        <div class="flex items-center gap-2">
            <button type="button" data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" class="p-2 text-slate-600 hover:text-[#135b9f] hover:bg-slate-100 rounded-lg transition-colors xl:hidden flex items-center justify-center cursor-pointer" id="headerCollapse">
                <i class="ti ti-menu-2" style="font-size: 24px;"></i>
            </button>
            
            <!-- Logo saat Mobile View -->
            <a href="{{ route('modul-kapasitas.dashboard') }}" class="flex xl:hidden items-center text-decoration-none ml-1">
                <img src="{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}" style="height: 32px; width: auto;" alt="Logo" />
            </a>
        </div>

        <!-- Kanan: Menu Utama & User Profile Dropdown -->
        <div class="flex items-center gap-2 sm:gap-3">
            <!-- Tombol Menu Utama -->
            <a href="{{ url('/welcome') }}" class="flex items-center gap-2 text-sm font-semibold transition-all" style="background-color: #f1f5f9; color: #475569; border-radius: 8px; padding: 6px 12px; border: 1px solid #e2e8f0;" onmouseover="this.style.backgroundColor='#e2e8f0'; this.style.color='#1e293b';" onmouseout="this.style.backgroundColor='#f1f5f9'; this.style.color='#475569';">
                <i class="ti ti-home" style="font-size: 18px;"></i>
                <span class="hidden md:inline">Menu Utama</span>
            </a>

            <!-- User Profile Dropdown Container -->
            <div class="relative" id="userProfileDropdownContainer">
                <button type="button" id="userProfileBtn" class="flex items-center gap-2 p-1 md:py-1 md:px-2 rounded-full hover:bg-slate-100 transition-colors cursor-pointer" aria-expanded="false">
                    <!-- Info Nama & Role (Desktop) -->
                    <div class="hidden md:flex flex-col items-end justify-center me-1 text-right">
                        <span class="font-bold text-slate-800 leading-tight" style="font-size: 14px;">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                        <span class="text-slate-500 font-medium mt-0.5 leading-none" style="font-size: 11px;">
                            @if(Auth::check())
                                @if(Auth::user()->role == 5 || Auth::user()->role == 0) Super Admin
                                @elseif(Auth::user()->role == 1) Admin
                                @else Pegawai @endif
                            @else Guest @endif
                        </span>
                    </div>

                    <!-- Avatar -->
                    @if(Auth::check() && Auth::user()->profile)
                        <img src="{{ asset('storage/'.Auth::user()->profile) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover shadow-sm" onerror="this.outerHTML='<span class=\'w-10 h-10 rounded-full text-white flex items-center justify-center font-bold text-base shadow-sm\' style=\'background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);\'>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>'">
                    @else
                        <span class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold text-base shadow-sm" style="background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);">
                            {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'G' }}
                        </span>
                    @endif

                    <i class="ti ti-chevron-down text-slate-400 hidden md:block" style="font-size: 16px;"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="userProfileDropdownMenu" class="hidden absolute right-0 top-full mt-2 w-64 bg-white rounded-2xl border border-slate-200 shadow-xl p-2 z-50 transition-all">
                    <!-- Info User Card -->
                    <div class="flex items-center p-3 mb-2 bg-slate-50 rounded-xl">
                        @if(Auth::check() && Auth::user()->profile)
                            <img src="{{ asset('storage/'.Auth::user()->profile) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover shrink-0" onerror="this.outerHTML='<span class=\'w-12 h-12 rounded-full text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-sm\' style=\'background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);\'>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>'">
                        @else
                            <span class="w-12 h-12 rounded-full text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-sm" style="background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);">
                                {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'G' }}
                            </span>
                        @endif
                        <div class="ml-3 overflow-hidden text-left">
                            <h6 class="font-bold text-slate-800 text-sm truncate" title="{{ Auth::check() ? Auth::user()->name : 'Guest' }}">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h6>
                            <span class="text-xs text-slate-500 font-semibold block">
                                @if(Auth::check())
                                    @if(Auth::user()->role == 5 || Auth::user()->role == 0) Super Admin
                                    @elseif(Auth::user()->role == 1) Admin
                                    @else Pegawai @endif
                                @else Guest @endif
                            </span>
                        </div>
                    </div>

                    <!-- Link My Profile -->
                    <a href="{{ Auth::check() ? url('/profile/' . Auth::user()->id) : '#' }}" class="flex items-center gap-2.5 py-2 px-3 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-[#135b9f] transition-all">
                        <i class="ti ti-user-circle" style="font-size: 18px;"></i>
                        <span>Detail Profile</span>
                    </a>
                    
                    <hr class="my-1.5 border-slate-100">

                    <!-- Link Logout -->
                    <a href="{{ route('logout') }}" id="header-logout-btn" class="flex items-center gap-2.5 py-2 px-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-all">
                        <i class="ti ti-logout" style="font-size: 18px;"></i>
                        <span>Sign Out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profileBtn = document.getElementById('userProfileBtn');
        const profileMenu = document.getElementById('userProfileDropdownMenu');

        if (profileBtn && profileMenu) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = profileMenu.classList.contains('hidden');
                profileMenu.classList.toggle('hidden');
                profileBtn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            });

            document.addEventListener('click', function(e) {
                if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                    profileMenu.classList.add('hidden');
                    profileBtn.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !profileMenu.classList.contains('hidden')) {
                    profileMenu.classList.add('hidden');
                    profileBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });
</script>
