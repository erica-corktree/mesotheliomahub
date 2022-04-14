<header class="PageHeader @if (is_singular('post')) PageHeader--blog-post @endif">
  <div class="Container">
    <div class="PageHeader__content">
      @if (is_singular('post'))
        <div class="Breadcrumbs">
          <p id="breadcrumbs">
            <a href="/blog">{{ __('Back to Blog', 'sage') }}</a>
          </p>
        </div>
      @elseif (function_exists('yoast_breadcrumb')
               && !is_page_template('views/template-about-page.blade.php')
               && !is_page_template('views/template-parent-page.blade.php')
               && !is_page_template('views/template-landing-page.blade.php'))
        <div class="Breadcrumbs">
          @php yoast_breadcrumb('<p id="breadcrumbs">','</p>') @endphp
        </div>

        @if (isset($parent_page) && !empty($parent_page))
          <div class="Breadcrumbs Breadcrumbs--parent">
            <p>
              <a href="{{ get_the_permalink($parent_page->ID) }}">
                <span aria-hidden="true">&lsaquo;</span> {{ get_the_title($parent_page->ID) }}
              </a>
            </p>
          </div>
        @endif
      @endif

      <h1>
        @if (isset($banner->title))
          {!! $banner->title !!}
        @else
          {!! $title !!}
        @endif
      </h1>

      @if (is_singular('post'))
        <div class="PageHeader__meta">
          <p class="PageHeader__author">{{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author">{{ get_the_author() }}</a></p>

          <time
            class="PageHeader__time"
            datetime="{{ get_post_time('c', true, get_the_ID()) }}"
          >
            {{ get_the_date(null, get_the_ID()) }}
          </time>

          @if ($categories)
            <ul class="PageHeader__categories">
              @foreach ($categories as $category)
                <li class="PageHeader__categories__item">
                  <a
                    class="PageHeader__categories__link"
                    href="{{ esc_url(get_category_link($category->term_id)) }}"
                    itemprop="keywords"
                  >
                    {{ esc_html($category->name) }}@unless($loop->last){{ ',' }}@endunless
                  </a>
                </li>
              @endforeach
            </ul>
          @endif
        </div>

        @include('partials.share-tools', ['class' => 'ShareTools--PageHeader'])
      @elseif (isset($banner->subtitle))
        {!! $banner->subtitle !!}
      @endif
    </div>

    @include('partials.page-header-illustration')
  </div>
</header>
