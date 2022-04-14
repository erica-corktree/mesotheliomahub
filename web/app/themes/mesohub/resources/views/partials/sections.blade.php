@if ($sections)
  @foreach ($sections as $section)
    @if (isset($section->acf_fc_layout))
      @set($section->acf_fc_layout, str_replace('_', '-', $section->acf_fc_layout))
      @includeIf("partials.sections.{$section->acf_fc_layout}", ['section' => $section])
    @endif
  @endforeach
@endif
