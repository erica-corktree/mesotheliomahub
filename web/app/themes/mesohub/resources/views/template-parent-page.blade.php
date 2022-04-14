{{--
  Template Name: Parent Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section>
      @include('partials.page-header')

      <div class="Container">
        <div class="PageWrap">
          @if (App\display_sidebar() && $has_child_pages)
            @include('partials.sidebar')
          @endif

          <div class="PageContent PageContent--parent-page-intro">
            <div class="EditorContent">
              @php the_content() @endphp

              {!! wp_link_pages([
                  'echo' => 0,
                  'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'),
                  'after' => '</p></nav>',
              ]) !!}
            </div>
          </div>
        </div>
      </div>

      @include('partials.segments')

      <div class="Container">
        @include('partials.page-footer')
      </div>

      @include('partials.footer-cta')
    </section>
  @endwhile
@endsection
