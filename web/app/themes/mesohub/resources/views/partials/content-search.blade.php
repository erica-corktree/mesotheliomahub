<article class="SearchResult">
  <header class="SearchResult__header">
    @php
    if (get_post_meta(get_the_ID(), '_yoast_wpseo_title', true)) {
        $title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
    } else {
        $title = get_the_title();
    }
    @endphp

    <h2><a href="{{ get_the_permalink() }}">{{ $title }}</a></h2>
    <p><a href="{{ get_the_permalink() }}">{{ get_the_permalink() }}</a></p>
  </header>

  <div class="SearchResult__summary">
    @if (get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true))
      {{ get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) }}
    @else
      {!! get_the_excerpt() !!}
    @endif
  </div>
</article>
