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

    <div class="flex flex-wrap justify-center pt-24 -mx-4">
      @foreach ($section->testimonials as $testimonial)
        <div class="flex w-full px-4 mb-32 md:mb-0 sm:w-1/2 md:w-1/3 last:mb-0">
          <figure class="testimonial">
            @if ($testimonial->photo)
              <x-photo class="photo--testimonial" :photo="$testimonial->photo" />
            @endif

            <blockquote class="testimonial__content">
              <p class="testimonial__quote">{{ $testimonial->quote }}</p>
            </blockquote>

            <figcaption class="testimonial__caption">
              <span class="testimonial__caption-inner">
                @if ($testimonial->name)
                  <b class="testimonial__name">{{ $testimonial->name }}</b>
                @endif

                @if ($testimonial->title)
                  <span class="testimonial__title">{{ $testimonial->title }}</span>
                @endif
              </span>
            </figcaption>
          </figure>
        </div>
      @endforeach
    </div>
  </div>
</section>
