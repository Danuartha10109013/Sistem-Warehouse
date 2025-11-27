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
            <a href="{{route('so')}}" class="nav-item nav-link {{ request()->routeIs('so') ? 'active' : '' }}">Stock</a>
            <a href="#" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
                Tambah Data
            </a>

            <!-- Modal Upload Excel -->
            <div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="uploadExcelLabel">Upload File Excel</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('so.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Pilih File Excel</label>
                                    <input type="file" name="excel" class="form-control" accept=".xlsx,.xls" required>
                                </div>

                                <p class="text-muted small">
                                    * File wajib format <strong>.xlsx</strong> atau <strong>.xls</strong>
                                </p>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


        </div>
        {{-- <a href="#" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a> --}}
    </div>
</nav>


