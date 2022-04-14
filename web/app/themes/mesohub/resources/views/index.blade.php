@extends('layouts.app')

@section('content')
  <header class="PageHeader">
    <div class="Container">
      <div class="PageHeader__content">
        <h1>{{ $title }}</h1>
      </div>
    </div>
  </header>

  <div class="Container">
    <div class="PageContent">
      @include('partials.sidebar')

      <div class="EditorContent">
        <h2>{{ $banner->title }}</h2>
        <p>{{ $banner->subtitle }}</p>

        @while (have_posts()) @php the_post() @endphp
          @include('partials.content-'.get_post_type())
        @endwhile

        {!! get_the_posts_navigation() !!}
      </div>
    </div>
  </div>
@endsection
