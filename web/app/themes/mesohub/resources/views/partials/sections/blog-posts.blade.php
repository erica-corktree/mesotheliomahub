<section class="section section--{{ $section->acf_fc_layout }}">
  <div class="container">
    @query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
    ])

    @hasposts
      <h2 class="section__heading">{{ $section->heading }}</h2>

      <div class="grid grid-cols-1 gap-8 mb-6 md:mb-10 md:grid-cols-2 lg:grid-cols-3">
        @posts
          <article class="card card--post">
            @set($photo, json_decode(json_encode(get_field('post_hero_photo', get_the_ID()))))
            <x-photo class="photo--card" :photo="$photo" />

            <header class="card__header">
              <p class="card__category">@category</p>
              <h2 class="card__title">@title</h2>

              <p class="card__meta">
                <span class="card__prefix">{{ __('By', 'sage') }}</span>
                <span class="card__author">@author</span>
                <span class="card__meta-separator">&#124;</span>
                <time class="card__time" datetime="@published('c')">@published('F j, Y')</time>
              </p>
            </header>

            <div class="card__content">
              <div class="card__summary">
                @if (get_field('post_hero_introduction', get_the_ID()))
                  {!! get_field('post_hero_introduction', get_the_ID()) !!}
                @else
                  @excerpt
                @endif
              </div>

              <p class="card__link">
                <a class="button button--outline button--primary stretched-link" href="@permalink">{{ __('Read More', 'sage') }}</a>
              </p>
            </div>
          </article>
        @endposts
      </div>

      @if ($section->link)
        <p class="text-center">
          <a class="button button--lg button--primary" href="{{ $section->link->url }}">{{ $section->link->title }}</a>
        </p>
      @endif
    @endhasposts
  </div>
</section>
