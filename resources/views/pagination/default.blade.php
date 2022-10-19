@if ($paginator->hasPages())
    <div class="d-flex align-items-center">
        <p class="m-0 text-muted">
            Showing
            @if ($paginator->firstItem())
                <span>{{ $paginator->firstItem() }}</span> to <span>{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
                of <span>{{ $paginator->total() }}</span>
            entries
        </p>
        <ul class="pagination m-0 ms-auto">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="11 7 6 12 11 17"></polyline>
                            <polyline points="17 7 12 12 17 17"></polyline>
                        </svg>
                        first
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}" tabindex="-1" aria-disabled="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="11 7 6 12 11 17"></polyline>
                            <polyline points="17 7 12 12 17 17"></polyline>
                        </svg>
                        first
                    </a>
                </li>
            @endif
            @if ($paginator->onFirstPage())
                <li class="me-3 page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="15 6 9 12 15 18" />
                        </svg>
                        prev
                    </a>
                </li>
            @else
                <li class="me-3 page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="15 6 9 12 15 18" />
                        </svg>
                        prev
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li class="ms-3 page-item">
                @if ($paginator->hasMorePages())
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        next
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="9 6 15 12 9 18" />
                        </svg>
                    </a>
                @else
                    <a class="page-link" href="#">
                        next
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="9 6 15 12 9 18" />
                        </svg>
                    </a>
                @endif
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                    last
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="7 7 12 12 7 17"></polyline>
                        <polyline points="13 7 18 12 13 17"></polyline>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
@endif
