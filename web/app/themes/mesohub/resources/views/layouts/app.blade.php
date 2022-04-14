<a href="#main-content" class="skip-link">{{ __('Skip to main content', 'sage') }}</a>

@include('partials.header')

<div class="Document @if (App\display_sidebar()) Document--has-sidebar @endif" role="document">
  <main class="Main">
    @yield('content')
  </main>
</div>

@include('partials.footer')
@include('partials.cta-bottom')
@include('partials.modal-guide')
@include('partials.modal-legal')
