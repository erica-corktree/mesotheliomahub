<section class="section section--{{ $section->acf_fc_layout }}">
  <div class="container">
    <div class="editorcontent">
      @if ($section->heading)
        <h2 class="section__heading">{{ $section->heading }}</h2>
      @endif

      @if ($section->subheading)
        <p class="section__subheading">{{ $section->subheading }}</p>
      @endif
    </div>

    @if ($section->slides)
      <div class="photo-slider photo-slider--section-{{ $section->acf_fc_layout }}">
        <div class="glide glide--section-{{ $section->acf_fc_layout }}">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
              @foreach ($section->slides as $slide)
                <li class="glide__slide">
                  @if ($slide->photo)
                    @if ($slide->link) <a href="{{ $link->url }}" title="{{ $link->title }}"> @endif
                    <x-photo class="photo--glide photo--section-{{ $section->acf_fc_layout }}" :photo="$slide->photo" />
                    @if ($slide->link) </a> @endif
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    @endif
  </div>
</section>
