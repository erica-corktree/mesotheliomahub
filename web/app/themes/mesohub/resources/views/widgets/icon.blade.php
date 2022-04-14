@if (isset($icon))
  <x-photo class="photo--widget" :photo="$icon" />
@endif

@if (isset($link))
  <a class="button button--yellow-dark" href="{{ $link->url }}">{{ $link->title }}</a>
@endif
