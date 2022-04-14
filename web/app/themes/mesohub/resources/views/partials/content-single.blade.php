<section>
  @include('partials.page-header')

  <div class="Container Container--page-wrap">
    <div class="PageWrap">
      @if (App\display_sidebar())
        @include('partials.sidebar')
      @endif

      <div class="PageContent">
        <div class="EditorContent">
          @php the_content() @endphp

          {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}

          @include('partials.page-footer')
        </div>
      </div>
    </div>
  </div>

  @include('partials.segments')
  @include('partials.footer-cta')
</section>
