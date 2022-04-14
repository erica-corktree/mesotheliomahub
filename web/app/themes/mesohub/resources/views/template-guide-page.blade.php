{{--
  Template Name: Guide Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="Hero Hero--guide">
      <div class="Container Container--hero-content">
        <div class="Hero__content">
          <h1 class="Hero__title" style="padding-top:0px">{{ $banner->title }}</h1>

          @if (isset($banner->subtitle))
            <div class="Hero__subtitle">
              {!! $banner->subtitle !!}
            </div>
          @endif

        </div>
        <div class="Guideform">
          <?php echo do_shortcode("[wpforms id='61169']"); ?>

        </div>
         
      </div>

      <svg class="Hero__wave" viewBox="0 0 1440 625">
        <path d="M1200.9,306.2c-298.7,14.8-322.1,137.2-505,233.3C534.8,624.1,302.8,645.1,0,602.7V625h1440V213.4C1385.7,270.1,1306,301,1200.9,306.2z"/>
      </svg>
    </div>

    @include('partials.segments')

    @include('partials.footer-cta')
  @endwhile
@endsection
