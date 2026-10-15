<nav class="navbar navbar-expand-lg fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-3">
    <a href="{{route('welcome')}}" class="navbar-brand p-0">

        <h1 class="display-6 text-primary m-0"><img src="{{asset('img/Logo_TML.png')}}" alt="Logo"> Tata Metal Lestari</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('welcome') }}"
                class="nav-item nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                Home
            </a>
            <a href="{{route('pac')}}" class="nav-item nav-link {{ request()->routeIs('pac') ? 'active' : '' }}">Packing</a>
            <a href="{{route('pac.add')}}" class="nav-item nav-link {{ request()->routeIs('pac.add') ? 'active' : '' }}">Tambah Data</a>
            @if(Auth::check() && in_array(Auth::user()->role, [0, 5]))
            <a href="{{route('pac.rekap_so')}}" class="nav-item nav-link {{ request()->routeIs('pac.rekap_so') ? 'active' : '' }}">Rekap No SO</a>
            @endif
        </div>
        {{-- <a href="#" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a> --}}
    </div>
</nav>


