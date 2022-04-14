<section
  class="section section--{{ $section->acf_fc_layout }}"

  @if (!empty($section->styles->background_color) || !empty($section->styles->text_color))
    style="{{ ($section->styles->background_color) ? "background-color:{$section->styles->background_color};" : '' }}{{ ($section->styles->text_color) ? "color:{$section->styles->text_color};" : '' }}"
  @endif
>
  <div class="container">
    <h2 class="section__heading">{!! $section->heading !!}</h2>

    <p class="section__link">
      <a class="button button--lg button--primary" href="{{ $section->link->url }}">{!! $section->link->title !!}</a>
    </p>
  </div>
</section>
