@unless (App\is_tree('about-us'))
  @set($author, "user_{$GLOBALS['post']->post_author}")
  @set($reviewer, get_field('medical_reviewer'))
<!--googleoff: index-->
  <footer class="ContentFooter">
    <div class="ContentFooter__section">
      <a class="UserLink" data-toggle="Author" role="button">
        @if (get_field('author_photo', $author))
          <img
            class="UserLink__img"
            src="{{ get_field('author_photo', $author)['sizes']['small'] }}"
            alt="{{ __('Photo of', 'sage') }} {{ get_the_author() }}"
          >
        @endif

        <span class="UserLink__info">
          <span class="UserLink__label">{{ __('Author', 'sage') }}</span>
          <span class="UserLink__name">{{ get_the_author() }}</span>

          @if (get_field('author_title', $author))
            <span class="UserLink__title">
              {{ get_field('author_title', $author) }}
            </span>
          @endif
        </span>

        <span class="Icon Icon--UserLink Icon--plus"></span>
      </a>

      <div
        class="ContentFooter__author-about ContentFooter__section__content"
        id="Author"
        data-toggler=".js-expanded"
      >
        {!! get_the_author_meta('description') !!}
      </div>
    </div>

    @if ($reviewer)
      <div class="ContentFooter__section">
        <a class="UserLink" data-toggle="Reviewer" role="button">
          @if (has_post_thumbnail($reviewer))
            <img
              class="UserLink__img"
              src="{{ get_the_post_thumbnail_url($reviewer, 'thumbnail') }}"
              alt="{{ __('Photo of', 'sage') }} {{ get_the_title($reviewer) }}"
            >
          @endif

          <span class="UserLink__info">
            <span class="UserLink__label">{{ __('Reviewer', 'sage') }}</span>
            <span class="UserLink__name">{{ get_the_title($reviewer) }}</span>
            <span class="UserLink__title">
              {{ __('Last Reviewed:') }} {{ $medical_review_date }}
            </span>
          </span>

          <span class="Icon Icon--UserLink Icon--plus"></span>
        </a>

        <div
          class="ContentFooter__author-about ContentFooter__section__content"
          id="Reviewer"
          data-toggler=".js-expanded"
        >
          {!! get_the_content(null, false, $reviewer) !!}
        </div>
      </div>
    @endif

    @if (get_field('citations'))
      <div class="ContentFooter__section">
        <p class="ContentFooter__section__heading">
          <a
            data-toggle="Citations"
            role="button"
          >
            {{ __('Sources', 'sage') }}
          </a>
        </p>

        <div
          class="ContentFooter__section__content ContentFooter__citations"
          id="Citations"
          data-toggler=".js-expanded"
        >
          {!! get_field('citations') !!}
        </div>
      </div>
    @endif

    @unless (is_singular('post'))
      <div class="ContentFooter__nav">
        @if ($GLOBALS['post']->post_parent)
          {!! previous_post_link('%link', '
            <span class="Icon Icon--angle-left"></span>
            <span class="ContentFooter__nav__text-wrap">
              <span class="ContentFooter__nav__label ContentFooter__nav__label--prev">
                Previous Page
              </span>
              <span class="ContentFooter__nav__text">%title</span>
            </span>
          ') !!}
        @endif

        {!! next_post_link('%link', '
          <span class="ContentFooter__nav__text-wrap">
            <span class="ContentFooter__nav__label ContentFooter__nav__label--next">
              Next Page
            </span>
            <span class="ContentFooter__nav__text">%title</span>
          </span>
          <span class="Icon Icon--angle-right"></span>
        ') !!}
      </div>
    @endunless
  </footer>
  <!--googleon: index-->
@endunless
