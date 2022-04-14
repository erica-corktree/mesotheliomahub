@if ($pagi->hasPages())
  <nav class="flex items-center my-8" role="navigation" aria-label="pagination">
    @if (! $pagi->onFirstPage())
      <a
        href="{{ $pagi->previousPageUrl() }}"
        rel="prev"
        aria-label="Previous Page"
        class="px-4 py-1 mr-3 border rounded-sm hover:bg-yellow-600 hover:text-white"
      >&larr; Previous</a>
    @endif

    <ul class="flex">
      @foreach ($pagi->elements() as $element)
        @if (is_string($element))
          <li class="disabled" aria-disabled="true">
            <span class="py-1 mr-3">&hellip;</span>
          </li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              @if ($page == $pagi->currentPage())
                <span
                  class="px-4 py-1 mr-3 text-white bg-yellow-600 border rounded-sm"
                  aria-current="page"
                >{{ $page }}</span>
              @else
                <a
                  href="{{ $url }}"
                  class="px-4 py-1 mr-3 border rounded-sm hover:bg-yellow-600 hover:text-white"
                >{{ $page }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach
    </ul>

    @if ($pagi->hasMorePages())
      <a
        href="{{ $pagi->nextPageUrl() }}"
        rel="next"
        aria-label="Next Page"
        class="px-4 py-1 mr-3 border rounded-sm hover:bg-yellow-600 hover:text-white"
      >Next &rarr;</a>
    @endif
  </nav>
@endif
