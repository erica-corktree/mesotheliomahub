<section class="section section--{{ $section->acf_fc_layout }}{{ ($section->styles->photo) ? " section--{$section->acf_fc_layout}-with-photo" : '' }}{{ ($section->styles->photo && $section->styles->photo_full_width) ? " section--{$section->acf_fc_layout}-with-photo-fw" : '' }}">
  <div class="container">
    <div class="section__inner">
      @if ($section->heading)
        <h2 class="section__heading">{!! $section->heading !!}</h2>
      @endif

      @if ($section->subheading)
        <p class="section__subheading">{!! $section->subheading !!}</p>
      @endif

      @if ($section->styles->photo && $section->styles->photo_full_width)
        <x-photo class="photo--section-{{ $section->acf_fc_layout }}" :photo="$section->styles->photo" />
      @endif
    </div>

    @if ($section->styles->photo && !$section->styles->photo_full_width)
      <div class="mx-auto mb-12 text-center md:mb-16" style="max-width: 500px;">
        <x-photo class="" :photo="$section->styles->photo" />
      </div>
    @endif

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($section->items as $item)
        <div class="relative flex flex-col text-center">
          @if (!empty($item->icon))
            <x-photo class="block w-12 h-auto mx-auto mb-2" :photo="$item->icon" />
          @endif

          @if ($item->heading)
            <h3 class="text-xl font-bold text-grey-darker">{!! $item->heading !!}</h3>
          @endif

          @if ($item->description)
            <p class="mt-4">{{ $item->description }}</p>
          @endif

          @if ($item->link)
            <p class="mt-4">
              <a class="button button--yellow-dark" href="{{ $item->link->url }}">{!! $item->link->title !!}</a>
            </p>
          @endif
        </div>
      @endforeach
    </div>

    @if ($section->link)
      <p class="mt-12 text-center md:mt-16"><a class="button button--primary button--lg" href="{{ $section->link->url }}">{{ $section->link->title }}</a></p>
    @endif
  </div>
</section>
