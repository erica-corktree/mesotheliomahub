<section
  class="section section--{{ $section->acf_fc_layout }}{{ ($section->styles->content_width) ? " section--w-{$section->styles->content_width}" : '' }}"
  @if (!empty($section->styles->background_color) || !empty($section->styles->text_color))
    style="{{ ($section->styles->background_color) ? "background-color: {$section->styles->background_color};" : '' }}{{ ($section->styles->text_color) ? "color: {$section->styles->text_color};" : '' }}"
  @endif
>
  <div class="container{{ ($section->styles->content_width) ? " container--w-{$section->styles->content_width}" : '' }}">
    <h2 class="section__heading">{{ $section->heading }}</h2>
    <p class="section__subheading">{{ $section->subheading }}</p>

    <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($section->cards as $card)
        <div class="card">
          @if (isset($card->photo))
            <x-photo class="photo--card" :photo="$card->photo" />
          @endif

          @if ($card->heading)
            <header class="card__header">
              <h3 class="card__title">{!! $card->heading !!}</h3>
            </header>
          @endif

          <div class="card__content">
            <div class="card__summary">
              {!! $card->description !!}
            </div>

            @if ($card->link)
              <p class="card__link">
                <a class="button button--yellow stretched-link" href="{{ $card->link->url }}">{{ $card->link->title }}</a>
              </p>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    @if (!empty($section->content))
      <div class="editorcontent">
        {!! $section->content !!}
      </div>
    @endif
  </div>
</section>
