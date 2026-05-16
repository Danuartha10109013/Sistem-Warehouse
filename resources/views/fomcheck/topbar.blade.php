@php
    $navWelcome = request()->routeIs('welcome');
    $navFomcheck = request()->routeIs('fomcheck*');
    $navCRC = request()->routeIs('fomcheck.crc*');
    $navINGOT = request()->routeIs('fomcheck.ingot*');
    $navRESIN = request()->routeIs('fomcheck.resin*');
@endphp
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
                class="nav-item nav-link {{ $navWelcome ? 'active' : '' }}">
                Home
            </a>
            <a href="{{ route('fomcheck') }}"
                class="nav-item nav-link {{ $navFomcheck ? 'active' : '' }}">
                Form Check
            </a>
            <a href="{{ route('fomcheck', ['type' => 'crc']) }}"
                class="nav-item nav-link {{ $navCRC ? 'active' : '' }}">
                    CRC
                </a>

                <a href="{{ route('fomcheck', ['type' => 'ingot']) }}"
                class="nav-item nav-link {{ $navINGOT ? 'active' : '' }}">
                    INGOT
                </a>

                <a href="{{ route('fomcheck', ['type' => 'resin']) }}"
                class="nav-item nav-link {{ $navRESIN ? 'active' : '' }}">
                    RESIN
                </a>
        </div>
        {{-- <a href="#" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a> --}}
    </div>
</nav>

