<section
  class="section section--{{ $section->acf_fc_layout }}{{ ($section->styles->content_width) ? " section--content-width-{$section->styles->content_width}" : '' }}{{ ($section->styles->photo && !$section->styles->photo_full_width) ? " section--{$section->acf_fc_layout}-with-photo" : '' }}{{ ($section->styles->photo && $section->styles->photo_full_width) ? " section--{$section->acf_fc_layout}-with-photo-fw" : '' }}"

  @if (!empty($section->styles->background_color) || !empty($section->styles->text_color))
    style="{{ ($section->styles->background_color) ? "background-color:{$section->styles->background_color};" : '' }}{{ ($section->styles->text_color) ? "color:{$section->styles->text_color};" : '' }}"
  @endif
>
  <div class="container">
    <div class="editorcontent">
      {!! $section->content !!}
    </div>

    @if ($section->styles->photo)
      <x-photo class="photo--section-{{ $section->acf_fc_layout }}" :photo="$section->styles->photo" />
    @endif
  </div>
</section>
