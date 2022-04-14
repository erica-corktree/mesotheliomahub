@if ($photo)
  <picture class="photo{{ $class ? " {$class}" : '' }}">
    @foreach (get_intermediate_image_sizes() as $size)
      @if (isset($photo->sizes->{$size}))
        <source srcset="{{ $photo->sizes->{$size} }}" media="(max-width: {{ $photo->sizes->{"{$size}-width"} }}px)">
      @endif
    @endforeach

    <img class="photo__img" src="{{ $photo->url ?? '' }}" alt="{{ $photo->alt ?? '' }}" loading="lazy">
  </picture>
@endif
