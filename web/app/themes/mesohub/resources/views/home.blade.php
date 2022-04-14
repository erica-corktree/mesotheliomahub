@extends('layouts.app')

@section('content')
  @set($blogId, get_option('page_for_posts', true))

  <section>
    <header class="PageHeader">
      <div class="Container">
        <div class="PageHeader__content">
          <h1>The Latest in Mesothelioma News</h1>

          @if (isset($banner->title))
            <p>{!! $banner->title !!}</p>
          @endif
        </div>

        <picture class="Photo Photo--home-layer-3">
          <source srcset="{{ get_the_post_thumbnail_url($blogId, 'full') }}" media="(min-width: 64em)">
          <source srcset="{{ get_the_post_thumbnail_url($blogId, 'large') }}" media="(min-width: 52em)">

          <img
            class="Photo__img"
            srcset="{{ get_the_post_thumbnail_url($blogId, 'medium_large') }}"
            alt=""
            style="width: 100%;"
          >
        </picture>
      </div>
    </header>

    <div class="Container">
      <div class="PageWrap">
        @include('partials.sidebar')

        <div class="PageContent">
          @include('partials.blog-posts')
        </div>
      </div>
    </div>

    @include('partials.footer-cta')
  </section>
@endsection
