@if ($id)
  @set($hero, @json_decode(json_encode(get_field('post_hero', $id))))
  <div class="hero hero--featured-content hero--featured-blog-post hero--blog-featured-post">
    <div class="container container--hero">
      <div class="hero__inner">
        <p class="hero__category">@category</p>
        <h1 class="hero__title">{{ $hero->heading }}</h1>

        @if (get_post_field('post_author', $id))
          @set($author, get_post_field('post_author', $id))

          <p class="entry-meta entry-meta--hero">
            <span class="entry-meta__prefix" >{{ __('By', 'sage') }}</span>
            <a class="entry-meta__author" href="@authorurl($author)" rel="author" class="fn">@author($author)</a>
            <span class="entry-meta__separator">&#124;</span>
            <time class="entry-meta__time" datetime="{{ get_post_time('c', true, $id) }}">@published($id)</time>
          </p>
        @endif

        @if (isset($hero->introduction))
          <div class="hero__introduction">
            {!! $hero->introduction !!}
          </div>
        @endif

        <p class="hero__link">
          <a class="button button--outline button--primary" href="@permalink($id)">{{ __('Read More', 'sage') }}</a>
        </p>
      </div>
    </div>

    @if ($hero->photo)
      <x-photo class="photo--hero" :photo="$hero->photo" />
    @endif
  </div>
@endif
