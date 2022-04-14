@extends('layouts.app')

@section('content')
  <section>
    <header class="PageHeader">
      <div class="Container">
        <div class="PageHeader__content">
          <h1>{!! $title !!}</h1>
        </div>
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
