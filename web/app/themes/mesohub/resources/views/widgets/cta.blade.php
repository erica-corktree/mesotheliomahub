@if (isset($title))
  <p>{{ $title }}</p>
@endif

@if (isset($button))
  <a class="button button--primary stretched-link" href="{{ $button['url'] }}">{{ $button['title'] }}</a>
@endif
