<section class="section section--{{ $section->acf_fc_layout }}">
  <div class="container">
    <div class="editorcontent">
      {!! $section->content !!}
    </div>

    <div class="card card--section-{{ $section->acf_fc_layout }}">
      {!! $section->card_content !!}
    </div>
  </div>
</section>
