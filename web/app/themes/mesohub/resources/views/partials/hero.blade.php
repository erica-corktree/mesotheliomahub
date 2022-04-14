<div class="hero {{ (is_front_page()) ? 'hero--home-page' : '' }}">
  <div class="container container--hero">
    <div class="hero__inner">
      <h1 class="hero__title">{!! $title !!}</h1>

      @if (isset($hero->introduction))
        <div class="hero__introduction">{!! $hero->introduction !!}</div>
      @endif

      @if (is_front_page())
        @includeIf('partials.video-flyout')
      @endif
    </div>
  </div>

  @if (isset($hero->photo))
    <x-photo class="photo--hero" :photo="$hero->photo" />
  @endif
</div>
