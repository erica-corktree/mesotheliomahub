<section class="section section--{{ $section->acf_fc_layout }}">
  <div class="container">
    <div class="items-stretch row row--col-count-2">
      <div class="col col--span-1{{ ($section->alignment === 'right') ? ' order-last' : '' }}">
        <div class="responsive-embed widescreen">
          <iframe src="{{ $section->video }}" frameborder="0" allowfullscreen=""></iframe>
        </div>
      </div>
      <div class="col col--span-1{{ ($section->alignment === 'right') ? ' order-first' : '' }}">
        <h2 class="mb-6 text-2xl">{{ $section->heading }}</h2>
        <h3 class="pr-32 mt-auto mb-6 font-sans text-2xl md:pr-40 text-yellow">{{ $section->subheading }}</h3>
        @if ($section->link)
          <p class="text-center md:text-left">
            <a class="button button--primary button--lg" href="{{ $section->link->url }}">{{ $section->link->title }}</a>
          </p>
        @endif
      </div>
    </div>
  </div>
</section>
