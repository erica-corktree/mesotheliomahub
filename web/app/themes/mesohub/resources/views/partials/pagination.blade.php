@set($hasPages, isset($pagi) ? $pagi->hasPages() : null)

@if (isset($hasPages))
  <nav class="flex items-center" role="navigation" aria-label="pagination">
    @if (!$pagi->onFirstPage())
      <a class="button button--sm button--outline button--primary" href="{{ $pagi->previousPageUrl() }}" rel="prev">&larr; {{ __('Previous', 'sage') }}</a>
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
                <span class="button button--sm button--outline button--primary" aria-current="page">{{ $page }}</span>
              @else
                <a class="button button--sm button--outline button--primary" href="{{ $url }}">{{ $page }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach
    </ul>

    @if ($pagi->hasMorePages())
      <a class="button button--sm button--outline button--primary" href="{{ $pagi->nextPageUrl() }}" rel="next">{{ __('Next', 'sage') }} &rarr;</a>
    @endif
  </nav>
@endif
