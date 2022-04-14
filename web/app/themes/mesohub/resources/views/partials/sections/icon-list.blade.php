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

    @foreach ($section->items as $item)
      <div class="mb-8 text-grey-darker">
        <div class="flex flex-col items-center sm:flex-row">
          @if (!empty($item->icon))
            <picture class="@if ($item->alignment === 'right') md:order-last @endif flex flex-none items-center justify-center w-48 h-48 mx-auto">
              @foreach (get_intermediate_image_sizes() as $size)
                @if (isset($item->icon->sizes->{$size}))
                  <source
                    srcset="{{ $item->icon->sizes->{$size} }}"
                    media="(max-width: {{ $item->icon->sizes->{"{$size}-width"} }}px)"
                  >
                @endif
              @endforeach

              <img class="w-full h-auto" src="{{ $item->icon->url }}" alt="{{ $item->icon->alt }}">
            </picture>
          @endif

          <div class="@if ($item->alignment === 'right') md:order-first sm:mr-8 @else sm:ml-8 @endif w-full sm:w-auto mt-4 sm:mt-0 flex-grow">
            <h3 class="mb-8 text-2xl font-medium leading-none text-yellow">{{ $item->heading }}</h3>
            <p>{!! $item->description !!}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
