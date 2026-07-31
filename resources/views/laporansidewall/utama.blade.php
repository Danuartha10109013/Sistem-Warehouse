@extends('so.main')
@section('title','STOCK OPNAME')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<div class="container py-4">

    <!-- TITLE -->
    <div class="text-center mb-4">
        <h1 class="fw-bold">STOCK OPNAME</h1>
        <small class="text-muted">Pilih kategori stock opname</small>
    </div>

    <div class="row g-3 justify-content-center">

        <!-- BB - BJ - BJS (satu tampilan) -->
        <div class="col-12 col-lg-8">
            <a href="{{ route('so.bahan_baku') }}" class="text-decoration-none">
                <div class="card bg-success text-white shadow-sm border-0 text-center p-4">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fa-solid fa-warehouse fs-1 mb-2"></i>
                        <strong>BB - BJ - BJS</strong>
                        <small class="text-light-50">Satu tampilan stock opname</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- SPAREPART (tetap terpisah) -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.sparepart') }}" class="text-decoration-none">
                <div class="card bg-success text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-gears fs-1 mb-2"></i>
                    <strong>SPAREPART</strong>
                </div>
            </a>
        </div>

        <!-- ELECTRIC -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.electric') }}" class="text-decoration-none">
                <div class="card bg-primary text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-bolt fs-1 mb-2"></i>
                    <strong>ELECTRIC</strong>
                </div>
            </a>
        </div>

        <!-- MECHANIC -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.mechanic') }}" class="text-decoration-none">
                <div class="card bg-dark text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-screwdriver-wrench fs-1 mb-2"></i>
                    <strong>MECHANIC</strong>
                </div>
            </a>
        </div>

        <!-- PROYEK -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.proyek') }}" class="text-decoration-none">
                <div class="card bg-warning text-dark text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-diagram-project fs-1 mb-2"></i>
                    <strong>PROYEK</strong>
                </div>
            </a>
        </div>

        <!-- SAFETY -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.safety') }}" class="text-decoration-none">
                <div class="card bg-danger text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-helmet-safety fs-1 mb-2"></i>
                    <strong>SAFETY</strong>
                </div>
            </a>
        </div>

        <!-- UTILITY -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.utility') }}" class="text-decoration-none">
                <div class="card bg-info text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-faucet fs-1 mb-2"></i>
                    <strong>UTILITY</strong>
                </div>
            </a>
        </div>

        <!-- GENERAL -->
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.general') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-boxes-stacked fs-1 mb-2"></i>
                    <strong>GENERAL STORAGE</strong>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <a href="{{ route('so.kbi') }}" class="text-decoration-none">
                <div class="card bg-dark text-white text-center p-4 shadow-sm border-0 h-100">
                    <i class="fa-solid fa-building fs-1 mb-2"></i>
                    <strong>KRAKATAU BAJA INDUSTRI</strong>
                </div>
            </a>
        </div>

    </div>
</div>

@endsection
