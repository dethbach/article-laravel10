<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" aria-label="Previous">
                <span aria-hidden="true"><i class="bi bi-caret-left-fill"></i></span>
            </a>
        </li>
        @else
        <li class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Previous">
                <span aria-hidden="true"><i class="bi bi-caret-left-fill text-primary"></i></span>
            </a>
        </li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item disabled"><a class="page-link">{{ $page }}</a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true"><i class="bi bi-caret-right-fill text-primary"></i></span>
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link disabled" aria-label="Next">
                <span aria-hidden="true"><i class="bi bi-caret-right-fill"></i></span>
            </a>
        </li>
        @endif
    </ul>
</nav>