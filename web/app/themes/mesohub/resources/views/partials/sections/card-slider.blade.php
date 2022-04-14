<section class="section section--{{ $section->acf_fc_layout }} py-12">
  <div class="max-w-4xl mx-auto mb-12 text-center editorcontent">
    @if ($section->heading)
      <h2 class="text-white">{{ $section->heading }}</h2>
    @endif

    @if ($section->subheading)
      <p>{{ $section->subheading }}</p>
    @endif
  </div>

  @if ($section->cards)
    <div class="container">
      <div class="glide">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            @foreach ($section->cards as $card)
              <li class="glide__slide">
                <div class="p-6 overflow-hidden text-black border shadow-lg bg-grey-lighter">
                  <h3 class="mb-4 text-2xl font-medium text-yellow-dark">{{ $card->heading }}</h3>
                  <p class="mb-12 text-grey-darker">{{ $card->content }}</p>

                  @if ($card->links)
                    @foreach ($card->links as $link)
                      <p class="mb-4 last:mb-0"><a class="block button button--yellow" href="{{ $link->link->url }}">{{ $link->link->title }}</a></p>
                    @endforeach
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="flex items-center justify-between mt-8 glide__arrows md:block md:mt-0" data-glide-el="controls">
          <button
            class="left-0 w-12 h-12 -translate-y-1/2 rounded-full glide__arrow glide__arrow--left md:absolute top-1/2 md:-ml-16 bg-grey-lighter text-yellow-dark"
            data-glide-dir="<"
            aria-label="{{ __('Prev', 'sage') }}"
          >
            @svg('images.chevron-left', 'inline-block w-8 h-auto')
          </button>
          <button
            class="right-0 w-12 h-12 -translate-y-1/2 rounded-full glide__arrow glide__arrow--right md:absolute top-1/2 md:-mr-16 bg-grey-lighter text-yellow-dark"
            data-glide-dir=">"
            aria-label="{{ __('Next', 'sage') }}"
          >
            @svg('images.chevron-right', 'inline-block w-8 h-auto')
          </button>
        </div>

        <div class="glide__bullets" data-glide-el="controls[nav]">
          <button class="glide__bullet" data-glide-dir="=0"></button>
          <button class="glide__bullet" data-glide-dir="=1"></button>
          <button class="glide__bullet" data-glide-dir="=2"></button>
        </div>
      </div>
    </div>
  @endif
</section>
