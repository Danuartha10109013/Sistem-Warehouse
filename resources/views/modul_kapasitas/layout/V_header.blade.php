<header class="sticky top-0 z-[60] bg-white dark:bg-dark w-full">
    <nav class="px-4 sm:px-30 py-4 rounded-none bg-transparent dark:bg-transparent w-full">
        <div class="flex gap-3 items-center justify-between w-full">
            <div class="flex gap-2 items-center">
                <span data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" class="h-10 w-10 flex text-black dark:text-white text-opacity-65 xl:hidden hover:text-primary hover:bg-lightprimary rounded-full justify-center items-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="currentColor" d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg>
                </span>
                <div class="hidden md:flex items-center text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-full shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span id="headerDate">Memuat tanggal...</span>
                </div>
            </div>

            <div class="flex gap-4 items-center">
                <a href="{{ route('welcome') }}" class="text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-primary transition-colors flex items-center gap-2 bg-gray-100 dark:bg-gray-800 px-3 py-2 rounded-lg shadow-sm hover:bg-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="hidden sm:inline">Menu Utama</span>
                </a>
                
                <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 p-1.5 pr-4 rounded-full border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="h-9 w-9 rounded-full flex justify-center items-center bg-primary text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="flex flex-col hidden sm:flex">
                        @if(Auth::check())
                            <span class="text-sm font-bold text-gray-800 dark:text-white leading-none">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ Auth::user()->role == '1' ? 'Admin' : (Auth::user()->role == '2' ? 'Pegawai' : (Auth::user()->role == '0' ? 'Super Admin' : 'User')) }}
                            </span>
                        @else
                            <span class="text-sm font-bold text-gray-800 dark:text-white leading-none">Guest</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Not logged in</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // Script untuk menampilkan tanggal hari ini secara otomatis
    document.addEventListener("DOMContentLoaded", function() {
        const dateElement = document.getElementById('headerDate');
        if (dateElement) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date();
            dateElement.innerText = today.toLocaleDateString('id-ID', options);
        }
    });
</script>
