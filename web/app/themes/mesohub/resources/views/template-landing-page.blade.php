{{--
  Template Name: Landing Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section>
      @include('partials.page-header')

      <div class="Segment Segment--normal">
        <div class="Container">
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

      @include('partials.segments')
    </section>
  @endwhile
@endsection
