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
            <a href="{{route('stock')}}" class="nav-item nav-link {{ request()->routeIs('stock') ? 'active' : '' }}">Stock</a>
            <a href="#" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#scanModal">
                Tambah Data
            </a>
            <a href="{{ route('stock', ['jenis' => 'INGOT']) }}"
            class="nav-item nav-link {{ request()->routeIs('stock') && request()->route('jenis') === 'INGOT' ? 'active' : '' }}">
                INGOT
            </a>
            <a href="{{ route('stock', ['jenis' => 'CRC']) }}"
            class="nav-item nav-link {{ request()->routeIs('stock') && request()->route('jenis') === 'CRC' ? 'active' : '' }}">
                CRC
            </a>
            <a href="{{ route('stock', ['jenis' => 'RESIN']) }}"
            class="nav-item nav-link {{ request()->routeIs('stock') && request()->route('jenis') === 'RESIN' ? 'active' : '' }}">
                RESIN
            </a>
            <a href="{{ route('stock', ['jenis' => 'ALKALI']) }}"
            class="nav-item nav-link {{ request()->routeIs('stock') && request()->route('jenis') === 'ALKALI' ? 'active' : '' }}">
                ALKALI
            </a>






        </div>
        {{-- <a href="#" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a> --}}
    </div>
</nav>


