@extends('so.main')

@section('title','Coming Soon')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card border-0 shadow-lg rounded-4 text-center p-4">

                <!-- ICON -->
                <div class="mb-3">
                    <i class="fa-solid fa-hourglass-half fa-4x text-primary"></i>
                </div>

                <!-- TITLE -->
                <h3 class="fw-bold mb-2">Coming Soon</h3>
                <p class="text-muted mb-4">
                    Modul ini sedang dalam proses pengembangan
                </p>

                <!-- INFO BOX -->
                {{-- <div class="row g-3 mb-4">

                    <div class="col-6">
                        <div class="card bg-success text-white border-0 rounded-3 p-3 h-100">
                            <i class="fa-solid fa-warehouse fs-3 mb-2"></i>
                            <small>Stock Opname</small>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card bg-primary text-white border-0 rounded-3 p-3 h-100">
                            <i class="fa-solid fa-bolt fs-3 mb-2"></i>
                            <small>Electric</small>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card bg-dark text-white border-0 rounded-3 p-3 h-100">
                            <i class="fa-solid fa-screwdriver-wrench fs-3 mb-2"></i>
                            <small>Mechanic</small>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card bg-danger text-white border-0 rounded-3 p-3 h-100">
                            <i class="fa-solid fa-helmet-safety fs-3 mb-2"></i>
                            <small>Safety</small>
                        </div>
                    </div>

                </div> --}}

                <!-- BADGE -->
                <span class="badge bg-warning text-dark px-3 py-2 mb-3">
                    🚧 Dalam Pengembangan
                </span>

                <!-- BUTTON -->
                <div class="mt-4">
                    <a href="{{ route('so.utama') }}" class="btn btn-outline-primary px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
