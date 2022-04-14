@if ($related)
  <div class="relative z-10">
    <h2 class="mb-8 text-2xl font-medium leading-none text-yellow">{{ __('Related Pages') }}</h2>

    <div class="flex flex-wrap md:-mx-8">
      @foreach ($related as $item)
        @php
        $photo = json_decode(json_encode(get_field('page_hero_photo', $item->ID), false));
        @endphp

        <div class="w-full md:w-1/3 mb-8 md:mb-0 md:px-8 last:mb-0">
          @if ($photo)
            <x-photo class="block w-64 md:w-auto mb-4 border" :photo="$photo" />
          @endif

          <h4 class="mb-4 font-medium text-xl">
            <a class="text-yellow-dark" href="{{ esc_url(get_permalink($item->ID)) }}">{!! get_the_title($item->ID) !!}</a>
          </h4>

          <p>
            <a class="button button--yellow-dark" href="{{ esc_url(get_permalink($item->ID)) }}">{{ __('Read More', 'sage') }}</a>
          </p>
        </div>
      @endforeach
    </div>
  </div>
@endif
