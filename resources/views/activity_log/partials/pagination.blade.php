@if ($paginator->hasPages())
    <ul class="pagination pagination-sm mb-0 align-items-center" style="gap: 4px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link rounded-2 border px-3 py-2 text-muted" style="background: #f8fafc; font-size: 13px;">
                    <i class="fas fa-chevron-left" style="font-size: 11px;"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link rounded-2 border px-3 py-2" href="{{ $paginator->previousPageUrl() }}" rel="prev" style="color: #1e293b; background: #fff; font-size: 13px; font-weight: 500;">
                    <i class="fas fa-chevron-left" style="font-size: 11px;"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link border-0 text-muted px-2 py-2" style="font-size: 13px;">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link rounded-2 border-0 px-3 py-2 fw-bold text-white shadow-sm" style="background-color: #135b9f; font-size: 13px;">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-2 border px-3 py-2" href="{{ $url }}" style="color: #475569; background: #fff; font-size: 13px; font-weight: 500;">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link rounded-2 border px-3 py-2" href="{{ $paginator->nextPageUrl() }}" rel="next" style="color: #1e293b; background: #fff; font-size: 13px; font-weight: 500;">
                    <i class="fas fa-chevron-right" style="font-size: 11px;"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link rounded-2 border px-3 py-2 text-muted" style="background: #f8fafc; font-size: 13px;">
                    <i class="fas fa-chevron-right" style="font-size: 11px;"></i>
                </span>
            </li>
        @endif
    </ul>
@endif
