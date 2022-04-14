@extends('layouts.app')

@section('content')
  <div class="PageHeader">
    <div class="Container">
      <h1>{{ __('Search results for:', 'sage') }} {{ get_search_query() }}</h1>
    </div>
  </div>

  <div class="Container">
    @if (!have_posts())
      <div class="Alert">
        {{  __('Sorry, no results were found.', 'sage') }}
      </div>

      @include('partials.search-form')
    @endif

    <p class="ResultsCount">{{ __('About', 'sage')}} {{ $results_count }} {{ __('results', 'sage') }}</p>

    @while (have_posts()) @php(the_post())
      @include('partials.content-search')
    @endwhile

    {!! App\numeric_pagination() !!}
  </div>
@endsection
