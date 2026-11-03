<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ route('verifikasi-stiker.dashboard') }}" class="text-nowrap logo-img d-flex align-items-center justify-content-start text-decoration-none w-100" style="gap: 10px;">
        <img src="{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}" style="height: 38px; width: auto;" alt="Logo" />
        <span style="font-weight: 700; font-size: 18px; color: #1a569d; letter-spacing: 0.5px; font-family: 'Plus Jakarta Sans', sans-serif;">TATA METAL LESTARI</span>
      </a>
      <div class="close-btn d-xl-none sidebartoggler cursor-pointer text-muted p-1" id="sidebarCollapse">
        <i class="fas fa-times fs-5"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Menu Verifikasi</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('verifikasi-stiker.dashboard') ? 'active' : '' }}" href="{{ route('verifikasi-stiker.dashboard') }}" aria-expanded="false">
            <span>
              <i class="fas fa-th-large" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('verifikasi-stiker.scan') ? 'active' : '' }}" href="{{ route('verifikasi-stiker.scan') }}" aria-expanded="false">
            <span>
              <i class="fas fa-qrcode" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Scan Verifikasi</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('verifikasi-stiker.data') ? 'active' : '' }}" href="{{ route('verifikasi-stiker.data') }}" aria-expanded="false">
            <span>
              <i class="fas fa-table" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Data & Import</span>
          </a>
        </li>
        @php
          $userTypes = json_decode(Auth::user()->type ?? '[]', true) ?? [];
          $canAccessWaNotif = Auth::user()->role == 0 || in_array('all', $userTypes) || in_array('VS_WA', $userTypes);
        @endphp

        @if($canAccessWaNotif)
        <li class="nav-small-cap">
          <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Pengaturan</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('verifikasi-stiker.notif-wa*') ? 'active' : '' }}" href="{{ route('verifikasi-stiker.notif-wa') }}" aria-expanded="false">
            <span>
              <i class="fab fa-whatsapp" style="font-size: 1.2rem; color: #25D366;"></i>
            </span>
            <span class="hide-menu">Kontak Notif WA</span>
          </a>
        </li>
        @endif
      </ul>
    </nav>
  </div>
</aside>
