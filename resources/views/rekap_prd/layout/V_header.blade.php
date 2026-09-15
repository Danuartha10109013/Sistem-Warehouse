<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2 fs-6" style="font-size: 24px;"></i>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <!-- Tombol Menu Utama -->
        <li class="nav-item d-none d-md-block me-3">
            <a href="{{ url('/welcome') }}" class="btn btn-sm d-flex align-items-center gap-2" style="background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; padding: 8px 16px; border: 1px solid #e2e8f0; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#e2e8f0'; this.style.color='#1e293b';" onmouseout="this.style.backgroundColor='#f1f5f9'; this.style.color='#475569';">
                <i class="ti ti-home fs-5"></i>
                Menu Utama
            </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover d-flex align-items-center gap-2" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 4px 8px; border-radius: 30px; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
            
            <!-- Info Nama & Role -->
            <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-1">
                <span class="fw-bold" style="font-size: 14px; color: #1e293b; line-height: 1;">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                <span class="text-muted mt-1" style="font-size: 11px; font-weight: 500; line-height: 1;">
                    @if(Auth::check())
                        @if(Auth::user()->role == 5) Super Admin
                        @elseif(Auth::user()->role == 0) Admin
                        @else Pegawai @endif
                    @else Guest @endif
                </span>
            </div>

            <!-- Avatar -->
            @if(Auth::check() && Auth::user()->profile)
                <img src="{{ asset('storage/'.Auth::user()->profile) }}" alt="Profile" width="40" height="40" class="rounded-circle shadow-sm" style="object-fit: cover;" onerror="this.outerHTML='<span class=\'rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm\' style=\'width:40px;height:40px;font-size:16px;font-weight:700;background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);\'>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>'">
            @else
                <span class="rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; font-size: 16px; font-weight: 700; background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);">
                    {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'G' }}
                </span>
            @endif

            <i class="ti ti-chevron-down text-muted d-none d-md-block ms-1" style="font-size: 16px;"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2" style="width: 260px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 40px rgba(0,0,0,0.08); padding: 8px;">
            <div class="message-body">
              
              <!-- Info Teks & Avatar -->
              <div class="d-flex align-items-center p-3 mb-2" style="background-color: #f8fafc; border-radius: 12px; margin: 4px;">
                @if(Auth::check() && Auth::user()->profile)
                    <img src="{{ asset('storage/'.Auth::user()->profile) }}" alt="Profile" class="rounded-circle flex-shrink-0" style="width: 48px; height: 48px; object-fit: cover;" onerror="this.outerHTML='<span class=\'rounded-circle text-white d-flex align-items-center justify-content-center flex-shrink-0\' style=\'width:48px;height:48px;min-width:48px;font-size:20px; background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);\'>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>'">
                @else
                    <span class="rounded-circle text-white d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 48px; height: 48px; min-width: 48px; font-size: 20px; font-weight: 700; background: linear-gradient(135deg, #135b9f 0%, #0f4a85 100%);">
                        {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'G' }}
                    </span>
                @endif
                <div class="ms-3 overflow-hidden">
                  <h6 class="mb-1 fw-bold text-truncate" style="color: #1e293b; font-size: 15px;" title="{{ Auth::check() ? Auth::user()->name : 'Guest' }}">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h6>
                  <span class="text-muted d-block" style="font-size: 12px; font-weight: 600;">
                        @if(Auth::check())
                            @if(Auth::user()->role == 5) Super Admin
                            @elseif(Auth::user()->role == 0) Admin
                            @else Pegawai @endif
                        @else Guest @endif
                  </span>
                </div>
              </div>

              <!-- Link My Profile -->
              <a href="{{ Auth::check() ? url('/profile/' . Auth::user()->id) : '#' }}" class="d-flex align-items-center gap-2 dropdown-item py-2 px-3 mt-1" style="border-radius: 8px; margin: 0 4px; font-weight: 500; color: #334155; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f1f5f9'; this.style.color='#135b9f';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#334155';">
                <i class="ti ti-user-circle fs-5"></i>
                <p class="mb-0 fs-3">Detail Profile</p>
              </a>
              
              <hr class="dropdown-divider" style="margin: 8px 4px; border-color: #f1f5f9;">

              <!-- Link Logout -->
              <a href="{{ route('logout') }}" class="d-flex align-items-center gap-2 dropdown-item py-2 px-3 text-danger" style="border-radius: 8px; margin: 0 4px; font-weight: 500; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#fef2f2';" onmouseout="this.style.backgroundColor='transparent';" id="header-logout-btn">
                <i class="ti ti-logout fs-5"></i>
                <p class="mb-0 fs-3">Sign Out</p>
              </a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>


