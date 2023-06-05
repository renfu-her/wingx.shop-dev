@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            <!-- 上一頁連結 -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">@lang('pagination.previous')</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif

            <!-- 分頁數字 -->
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            <!-- 下一頁連結 -->
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">@lang('pagination.next')</span></li>
            @endif
        </ul>
    </nav>
@endif
