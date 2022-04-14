@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="Hero Hero--home-page">
      <div class="Container">
        <div class="Hero__content">
          <h1 class="Hero__title">{!! $banner->title ?? $title !!}</h1>

          @if (isset($banner->subtitle))
            {!! $banner->subtitle !!}
          @endif

          <div class="Hero__cta">
            <a class="Hero__phone-number" id="HomeHeroPhoneNumber" href="tel:833.997.1947">
              {{ __('833-997-1947', 'sage') }}
            </a>
            <a class="Hero__guide" id="HomeHeroGuide" href="/free-mesothelioma-guide/">
              {{ __('Let Us Help', 'sage') }}
            </a>
          </div>
        </div>
      </div>

      <picture class="Photo Photo--home-layer-3">
        <source srcset="{{ get_the_post_thumbnail_url(null, 'full') }}" media="(min-width: 64em)">
        <source srcset="{{ get_the_post_thumbnail_url(null, 'large') }}" media="(min-width: 52em)">
        <img class="Photo__img" srcset="{{ get_the_post_thumbnail_url(null, 'medium_large') }}" alt="" style="width: 100%;">
      </picture>
    </div>

    @include('partials.segments')
  @endwhile
@endsection
