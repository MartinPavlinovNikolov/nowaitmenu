@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="btn btn-default btn-sm disabled"><span>&laquo;</span></div>
        @else
            <div class="btn btn-success btn-sm active"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></div>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="btn btn-default btn-sm disabled"><span>{{ $element }}</span></div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="btn btn-success btn-sm active"><span>{{ $page }}</span></div>
                    @else
                        <div class="btn btn-default btn-sm disabled"><a href="{{ $url }}">{{ $page }}</a></div>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div class="btn btn-success btn-sm active"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></div>
        @else
            <div class="btn btn-default btn-sm disabled"><span>&raquo;</span></div>
        @endif
    </div>
@endif
