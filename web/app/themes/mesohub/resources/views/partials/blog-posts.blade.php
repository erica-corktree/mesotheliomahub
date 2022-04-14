<div class="BlogPosts">
  <div class="BlogPosts__filters">
    <div class="Dropdown">
      <button class="Dropdown__button">
        <span class="Dropdown__button__text">{{ __('Filter by Category', 'sage') }}</span>
        <span class="Icon Icon--angle-down"></span>
      </button>

      <ul class="Dropdown__menu">
        @foreach ($categories as $category)
          <li class="Dropdown__menu__item">
            <a class="Dropdown__menu__link" href="/blog/category/{{ $category->slug }}">{{ $category->name }}</a>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="Dropdown Dropdown--right">

      <ul class="Dropdown__menu">
        @foreach ($authors as $author)
          <li class="Dropdown__menu__item">
            <a class="Dropdown__menu__link" href="/blog/author/{{ $author->user_login }}">{{ $author->display_name }}</a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>

  @if (!have_posts())
    <div class="Alert">
      {{  __('Sorry, no results were found.', 'sage') }}
    </div>

    @include('partials.search-form')
  @endif

  @while (have_posts()) @php the_post() @endphp
    @php
    $categories = get_the_terms(get_the_ID(), 'category');
    @endphp

    <article class="Card Card--blog-post">
      <div class="Card__col Card__col--left">
        <header class="Card__header">
          <h2 class="Card__heading"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>

          @include('partials.entry-meta', [
            'terms' => get_the_terms(get_the_ID(), 'category'),
          ])

          @if ($categories)
            <ul class="Card__cat-list">
              <li><b>{{ __('Categories:', 'sage') }}</b></li>

              @foreach ($categories as $category)
                <li>
                  <a
                    href="{{ esc_url(get_category_link($category->term_id)) }}"
                    itemprop="keywords"
                  >{{ $category->name }}</a>
                </li>
              @endforeach
            </ul>
          @endif
        </header>

        <div class="Card__content">
          @if (get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true))
            {{ get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) }}
          @else
            {!! get_the_excerpt() !!}
          @endif
        </div>
      </div>

      <div class="Card__col Card__col--right">
        <div class="Card__img-link" href="{{ get_permalink() }}">
          <picture>
            <source srcset="{{ get_the_post_thumbnail_url(null, 'full') }}" media="(min-width: 64em)">
            <source srcset="{{ get_the_post_thumbnail_url(null, 'large') }}" media="(min-width: 52em)">
            <source srcset="{{ get_the_post_thumbnail_url(null, 'medium_large') }}" media="(min-width: 40em)">
            <img class="Card__img" srcset="{{ get_the_post_thumbnail_url(null, 'medium') }}" alt="">
          </picture>
          </div>

        <a class="Button Button--small Button--primary" href="{{ get_permalink() }}">{{ __('Read More', 'sage') }}</a>
      </div>
    </article>
  @endwhile

  {!! App\numeric_pagination() !!}
</div>
