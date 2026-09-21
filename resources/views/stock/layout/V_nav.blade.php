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
            
            @php
                // Fetch dynamic items grouped by Jenis (CRC, RESIN, INGOT)
                $dynamicBB = \App\Models\KodeBahanBaku::all();
                
                // Group by uppercase jenis
                $groupedBB = $dynamicBB->groupBy(function($item) {
                    return strtoupper(trim($item->jenis ?? 'LAINNYA'));
                });

                // Ensure priority order: CRC, RESIN, INGOT, then others
                $orderedKeys = ['CRC', 'RESIN', 'INGOT'];
                foreach ($groupedBB->keys() as $k) {
                    if (!in_array($k, $orderedKeys)) {
                        $orderedKeys[] = $k;
                    }
                }
            @endphp

            <!-- Dynamic Dropdowns by Jenis (CRC / RESIN / INGOT) -->
            @foreach($orderedKeys as $jenis)
                @if(isset($groupedBB[$jenis]))
                    @php
                        $items = $groupedBB[$jenis];
                        $dropdownId = 'dropdown-' . \Illuminate\Support\Str::slug($jenis);

                        // Check if current page matches any item in this dropdown
                        $isGroupActive = false;
                        foreach ($items as $it) {
                            $slug = !empty($it->kode_supplier) ? strtolower($it->kode_supplier) : \Illuminate\Support\Str::slug($it->supplier, '_');
                            if (request()->is('stock/crc/' . $slug) || request()->is('stock/material/' . $slug)) {
                                $isGroupActive = true;
                                break;
                            }
                        }
                        if ($jenis === 'CRC' && (request()->routeIs('stock.crc.rekap_masuk') || request()->routeIs('stock.crc'))) {
                            $isGroupActive = true;
                        }
                    @endphp

                    <!-- Dropdown Toggle Button for {{ $jenis }} -->
                    <button type="button" class="flex items-center w-full gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ $isGroupActive ? 'bg-lightprimary text-primary font-semibold border-primary' : '' }}" aria-controls="{{ $dropdownId }}" data-collapse-toggle="{{ $dropdownId }}">
                        @if($jenis === 'CRC')
                            <!-- CRC Coil/Cube Icon -->
                            <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline><polyline points="7.5 19.79 7.5 14.6 3 12"></polyline><polyline points="21 12 16.5 14.6 16.5 19.79"></polyline><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        @elseif($jenis === 'RESIN')
                            <!-- Resin Flask/Liquid Icon -->
                            <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.527a2 2 0 0 1-.211.896L4.72 20.55a1 1 0 0 0 .9 1.45h12.76a1 1 0 0 0 .9-1.45l-5.069-10.127A2 2 0 0 1 14 9.527V2"></path><path d="M8.5 2h7"></path><path d="M7 16h10"></path></svg>
                        @elseif($jenis === 'INGOT')
                            <!-- Ingot Layers Icon -->
                            <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        @else
                            <!-- Default Box Icon -->
                            <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        @endif

                        <span class="flex-1 text-left text-sm whitespace-nowrap font-medium">{{ $jenis }}</span>
                        
                        <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                            {{ $items->count() }}
                        </span>

                        <svg class="w-3 h-3 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
                    </button>

                    <!-- Dropdown List Items -->
                    <ul id="{{ $dropdownId }}" class="{{ $isGroupActive ? 'block' : 'hidden' }} py-1 space-y-1">
                        @if($jenis === 'CRC')
                        <li>
                            <a href="{{ route('stock.crc.rekap_masuk') }}" class="flex items-center w-full py-2 px-3 text-xs text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ request()->routeIs('stock.crc.rekap_masuk') ? 'bg-lightprimary text-primary font-semibold' : '' }}">
                                REKAP CRC MASUK DAN KELUAR
                            </a>
                        </li>
                        @endif

                        @foreach($items as $item)
                            @php
                                $itemSlug = !empty($item->kode_supplier) ? strtolower($item->kode_supplier) : \Illuminate\Support\Str::slug($item->supplier, '_');
                                $isItemActive = request()->is('stock/crc/' . $itemSlug) || request()->is('stock/material/' . $itemSlug);
                            @endphp
                            <li>
                                <a href="{{ route('stock.crc', $itemSlug) }}" class="flex items-center justify-between w-full py-2 px-3 text-xs text-bodytext transition-colors rounded-md pl-11 hover:bg-lightprimary hover:text-primary {{ $isItemActive ? 'bg-lightprimary text-primary font-semibold' : '' }}" title="Nama Supplier: {{ strtoupper($item->supplier) }} | Kode Produk: {{ strtoupper($item->kode_produk) }} | Kode Supplier: {{ strtoupper($item->kode_supplier) }}">
                                    <div class="flex flex-col min-w-0 pr-2">
                                        <span class="truncate font-medium text-xs uppercase">{{ strtoupper($item->supplier) }}</span>
                                        @if($item->kode_produk)
                                        <span class="text-[10px] text-gray-400 dark:text-gray-400 truncate uppercase">
                                            {{ strtoupper($item->kode_produk) }}
                                        </span>
                                        @endif
                                    </div>
                                    @if($item->kode_supplier)
                                    <span class="text-[10px] uppercase font-mono px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 shrink-0">
                                        {{ strtoupper($item->kode_supplier) }}
                                    </span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach

            <!-- Master Data Section -->
            <h5 class="text-link dark:text-white/70 caption font-semibold leading-6 tracking-widest text-xs pb-2 mt-6 uppercase">Master Data</h5>
            
            <a href="{{ route('stock.kode_bb.index') }}" class="flex items-center gap-3 py-2 px-3 my-1 rounded-r-md border-l-4 border-transparent text-bodytext hover:bg-lightprimary hover:text-primary hover:border-primary transition-all {{ request()->routeIs('stock.kode_bb.*') ? 'bg-primary text-white font-semibold border-primary hover:bg-primary hover:text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                <span class="text-sm">Kelola Bahan Baku</span>
            </a>

        </div>
    </div>
</aside>
