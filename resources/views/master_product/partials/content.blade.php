{{-- 1. KATALOG GRID (Shopee / E-Commerce Style) --}}
<div id="catalogGridView" class="view-mode-container">
    <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-4 row-cols-xl-6">
        @forelse($data as $row)
            @php
                $fotoUrl = $row->foto ? asset('storage/' . $row->foto) : '';
                $cleanName = addslashes($row->name);
                $createdAt = $row->created_at ? $row->created_at->format('d/m/Y') : '-';
            @endphp
            <div class="col">
                <div class="card h-100 border product-card position-relative shadow-sm" style="border-radius: 12px; overflow: hidden; transition: all 0.25s ease;">
                    
                    {{-- SKU Badge --}}
                    <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1 text-white" 
                          style="background: rgba(15, 23, 42, 0.78); font-size: 11px; font-weight: 600; border-radius: 6px; z-index: 2; backdrop-filter: blur(4px); font-family: monospace;">
                        {{ $row->search_key }}
                    </span>

                    {{-- Image Container (Shopee 1:1 Aspect Ratio) --}}
                    <div class="product-img-wrap position-relative cursor-pointer" 
                         onclick="viewProductDetail({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}', '{{ $fotoUrl }}', '{{ $createdAt }}')"
                         style="aspect-ratio: 1 / 1; width: 100%; background-color: #f8fafc; overflow: hidden; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #f1f5f9; cursor: pointer;">
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="{{ $row->name }}" class="product-card-img" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                        @else
                            <div class="text-center p-3 text-muted">
                                <i class="fas fa-image text-black-50 mb-1" style="font-size: 2rem;"></i>
                                <div style="font-size: 11px; font-weight: 500; color: #94a3b8;">No Photo</div>
                            </div>
                        @endif
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-2 p-md-3 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="product-card-title mb-2 text-dark" 
                                title="{{ $row->name }}"
                                onclick="viewProductDetail({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}', '{{ $fotoUrl }}', '{{ $createdAt }}')"
                                style="font-size: 13px; font-weight: 600; line-height: 1.4; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: pointer;">
                                {{ $row->name }}
                            </h6>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-2 border-top mt-1">
                            <div class="d-flex gap-1">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary flex-grow-1 d-flex align-items-center justify-content-center gap-1 py-1" 
                                        onclick="viewProductDetail({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}', '{{ $fotoUrl }}', '{{ $createdAt }}')"
                                        style="font-size: 12px; border-radius: 6px;">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button type="button" 
                                        class="btn btn-sm btn-light border text-secondary px-2 py-1" 
                                        onclick="editProduct({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}')" 
                                        title="Edit"
                                        style="border-radius: 6px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('master-product.destroy', $row->id) }}" method="POST" class="delete-form d-inline mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-light border text-danger px-2 py-1" 
                                            title="Hapus"
                                            style="border-radius: 6px;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center text-muted">
                <i class="fas fa-box-open fs-1 mb-2 d-block text-black-50"></i>
                <p class="mb-0" style="font-size: 14px;">Belum ada data produk atau tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- 2. TABEL VIEW (Compact Table List) --}}
<div id="catalogTableView" class="view-mode-container d-none">
    <div class="table-responsive" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-clean w-100 mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">NO</th>
                    <th style="width: 200px;">SEARCH KEY (SKU)</th>
                    <th>NAMA PRODUK</th>
                    <th style="width: 100px;">FOTO</th>
                    <th class="text-center" style="width: 120px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $row)
                @php
                    $fotoUrl = $row->foto ? asset('storage/' . $row->foto) : '';
                    $cleanName = addslashes($row->name);
                    $createdAt = $row->created_at ? $row->created_at->format('d/m/Y') : '-';
                @endphp
                <tr>
                    <td class="text-center">{{ $data->firstItem() + $index }}</td>
                    <td><span class="fw-bold text-dark font-monospace">{{ $row->search_key }}</span></td>
                    <td>
                        <span class="fw-semibold text-dark" 
                              style="cursor: pointer;"
                              onclick="viewProductDetail({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}', '{{ $fotoUrl }}', '{{ $createdAt }}')">
                            {{ $row->name }}
                        </span>
                    </td>
                    <td>
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="Foto" style="height: 48px; width: 48px; border-radius: 8px; object-fit: cover; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'" onclick="viewProductDetail({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}', '{{ $fotoUrl }}', '{{ $createdAt }}')">
                        @else
                            <span class="badge bg-light text-muted border">No Photo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <button type="button" class="btn btn-sm btn-light border action-icon" onclick="viewProductDetail({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}', '{{ $fotoUrl }}', '{{ $createdAt }}')" title="Detail"><i class="fas fa-eye text-primary"></i></button>
                            <button type="button" class="btn btn-sm btn-light border action-icon" onclick="editProduct({{ $row->id }}, '{{ $row->search_key }}', '{{ $cleanName }}')" title="Edit"><i class="fas fa-edit text-secondary"></i></button>
                            <form action="{{ route('master-product.destroy', $row->id) }}" method="POST" class="delete-form d-inline mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border action-icon text-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="fas fa-box-open fs-2 mb-2 d-block text-black-50"></i>
                        Belum ada data atau tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- 3. PAGINATION & INFO FOOTER DENGAN SWITCHER DI BAWAH TABEL --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-3">
    <div class="d-flex flex-wrap align-items-center gap-3">
        <div class="text-muted small">
            Menampilkan <strong>{{ $data->firstItem() ?? 0 }}</strong> sampai <strong>{{ $data->lastItem() ?? 0 }}</strong> dari <strong>{{ $data->total() }}</strong> produk
        </div>

        <!-- Switcher Tampilan (Di Bawah Tabel) -->
        <div class="btn-group border rounded-3 p-1 bg-light" role="group">
            <button type="button" class="btn btn-sm px-2 px-sm-3 fw-semibold active btn-dark text-white" id="btnViewGrid" title="Tampilan Katalog" style="border-radius: 6px; font-size: 12px;">
                <i class="fas fa-th-large me-1"></i> Katalog
            </button>
            <button type="button" class="btn btn-sm px-2 px-sm-3 fw-semibold btn-light text-secondary" id="btnViewTable" title="Tampilan Tabel" style="border-radius: 6px; font-size: 12px;">
                <i class="fas fa-list me-1"></i> Tabel
            </button>
        </div>
    </div>
    <div class="pagination-wrapper overflow-auto">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
