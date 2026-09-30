<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ route('superadmin.Administrator.kelola-user') }}" class="text-nowrap logo-img d-flex align-items-center justify-content-start text-decoration-none w-100" style="gap: 10px;">
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
          <span class="hide-menu">Administrator</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('superadmin.Administrator.kelola-user*') ? 'active' : '' }}" href="{{ route('superadmin.Administrator.kelola-user') }}" aria-expanded="false">
            <span>
              <i class="fas fa-users" style="font-size: 1.1rem;"></i>
            </span>
            <span class="hide-menu">Kelola User</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
