@forelse($data as $index => $row)
<tr>
    <td class="text-center">{{ $data->firstItem() + $index }}</td>
    <td><span class="fw-bold text-dark">{{ $row->search_key }}</span></td>
    <td>{{ $row->name }}</td>
    <td>
        @if($row->foto)
            <img src="{{ asset('storage/' . $row->foto) }}" alt="Foto" style="height: 48px; width: 48px; border-radius: 8px; object-fit: cover; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="viewPhoto('{{ asset('storage/' . $row->foto) }}', '{{ addslashes($row->name) }}', '{{ $row->search_key }}')">
        @else
            <span class="badge bg-light text-muted border">No Photo</span>
        @endif
    </td>
    <td class="text-center">
        <div class="d-flex justify-content-center gap-2">
            <button type="button" class="btn btn-sm btn-light border action-icon" onclick="editProduct({{ $row->id }}, '{{ $row->search_key }}', '{{ addslashes($row->name) }}')" title="Edit"><i class="fas fa-edit text-primary"></i></button>
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

<tr class="pagination-row" style="display: none;">
    <td colspan="5">
        <div class="pagination-wrapper mt-3 d-flex justify-content-center">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </td>
</tr>
