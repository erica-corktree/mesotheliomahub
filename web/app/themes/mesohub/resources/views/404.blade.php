@extends('layouts.app')

@section('content')
  <div class="NotFoundContent Container">
    <h1>{{ __('404:', 'sage') }} {{ $title }}</h1>
  </div>

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif
@endsection
