<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ route('break-bulk.index') }}" class="text-nowrap logo-img d-flex align-items-center justify-content-start text-decoration-none w-100" style="gap: 10px;">
        <img src="{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}" style="height: 38px; width: auto;" alt="Logo" />
        <span style="font-weight: 700; font-size: 18px; color: #1a569d; letter-spacing: 0.5px; font-family: 'Plus Jakarta Sans', sans-serif;">TATA METAL LESTARI</span>
      </a>
      <div class="close-btn d-none sidebartoggler cursor-pointer" style="display: none !important;" id="sidebarCollapse">
        <i class="fas fa-times fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Break Bulk</span>
        </li>

        {{-- 1. Setting Break Bulk --}}
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('break-bulk.index') || request()->routeIs('break-bulk.dashboard') ? 'active' : '' }}" href="{{ route('break-bulk.index') }}" aria-expanded="false">
            <span>
              <i class="fas fa-dolly-flatbed" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Setting Break Bulk</span>
          </a>
        </li>

        {{-- 2. Tonase --}}
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('break-bulk.tonase') ? 'active' : '' }}" href="{{ route('break-bulk.tonase') }}" aria-expanded="false">
            <span>
              <i class="fas fa-weight-hanging" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Tonase</span>
          </a>
        </li>

        {{-- 3. Tambah Data --}}
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('break-bulk.tambah-data') ? 'active' : '' }}" href="{{ route('break-bulk.tambah-data') }}" aria-expanded="false">
            <span>
              <i class="fas fa-plus-circle" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Tambah Data</span>
          </a>
        </li>

        {{-- 4. Master Data (Dapat diakses oleh semua user modul Break Bulk) --}}
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('break-bulk.master-data') ? 'active' : '' }}" href="{{ route('break-bulk.master-data') }}" aria-expanded="false">
            <span>
              <i class="fas fa-database" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Master Data</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
