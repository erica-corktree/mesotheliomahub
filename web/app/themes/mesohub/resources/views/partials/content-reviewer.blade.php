<div class="container flex flex-wrap">
  <section class="w-full py-6 md:py-8">
    @if ($reviewer->reviewed)
      <div class="editorcontent">
        <h2>{{ __('Content Reviewed', 'sage') }}</h2>
      </div>

      <div class="pt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @posts($reviewer->reviewed)
          @include('partials.content')
        @endposts
      </div>
    @endif
  </section>
</div>

@include('partials.cta-footer')
