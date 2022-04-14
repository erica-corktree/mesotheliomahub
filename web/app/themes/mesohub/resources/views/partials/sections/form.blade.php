<section
  class="section section--{{ $section->acf_fc_layout }}{{ ($section->styles->photo) ? " section--{$section->acf_fc_layout}-with-photo" : '' }}"
  id="{{ $section->slug }}"
  @if (!empty($section->styles->background_color) || !empty($section->styles->text_color))
    style="{{ ($section->styles->background_color) ? "background-color: {$section->styles->background_color};" : '' }}{{ ($section->styles->text_color) ? "color: {$section->styles->text_color};" : '' }}"
  @endif
>
  <div class="container">
    <h2 class="section__heading">{!! $section->heading !!}</h2>
    <p class="section__subheading">{!! $section->subheading !!}</p>
    @shortcode("[hf_form slug=\"{$section->slug}\"]")
  </div>

  @if ($section->styles->photo)
    <x-photo class="photo--section photo--section-{{ $section->acf_fc_layout }}" :photo="$section->styles->photo" />
  @endif
</section>
