@extends('layouts.app')

@section('content')
  <header class="PageHeader">
    <div class="Container">
      <div class="PageHeader__content">
        <h1>Stay Up To Date With The Latest in Mesothelioma</h1>
      </div>
    </div>
  </header>

  <div class="Container Container--events">
    @while (have_posts()) @php the_post() @endphp
      <article class="Card Card--event">
        <div class="Card__event-icon">
          <div class="Card__month">{{ date('F', strtotime(get_field('event_date'))) }}</div>
          <div class="Card__day">{{ date('d', strtotime(get_field('event_date'))) }}</div>

          <svg
            class="Card__event-svg"
            version="1.1"
            id="Layer_1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 410 461"
            xml:space="preserve"
          >
            <path style="fill:#2F4858;stroke:#000000;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;" d="M382,13.5c0-6.6-5.4-12-12-12H40c-6.6,0-12,5.4-12,12v196h354V13.5z"/>
            <path style="fill:#4D6370;stroke:#000000;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;" d="M28,214.5v233c0,6.6,5.4,12,12,12h206.1L382,325.7V214.5H28z"/>
            <polygon style="fill:#7C8B96;stroke:#000000;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;" points="251,326.5 251,454.7 381.2,326.5 "/>
            <polygon style="fill:#2F4858;" points="249.5,326.5 92.7,458 238.7,458 245.5,458 249.4,454 "/>
            <path style="fill:#7C8B96;" d="M11,177h2c5.2,0,9.5,4.3,9.5,9.5v51c0,5.2-4.3,9.5-9.5,9.5h-2c-5.2,0-9.5-4.3-9.5-9.5v-51C1.5,181.3,5.8,177,11,177z"/>
            <path d="M13,178.5c4.4,0,8,3.6,8,8v51c0,4.4-3.6,8-8,8h-2c-4.4,0-8-3.6-8-8v-51c0-4.4,3.6-8,8-8H13 M13,175.5h-2c-6.1,0-11,4.9-11,11v51c0,6.1,4.9,11,11,11h2c6.1,0,11-4.9,11-11v-51C24,180.4,19.1,175.5,13,175.5z"/>
            <path style="fill:#7C8B96;" d="M397,176h2c5.2,0,9.5,4.3,9.5,9.5v51c0,5.2-4.3,9.5-9.5,9.5h-2c-5.2,0-9.5-4.3-9.5-9.5v-51C387.5,180.3,391.8,176,397,176z"/>
            <path d="M399,177.5c4.4,0,8,3.6,8,8v51c0,4.4-3.6,8-8,8h-2c-4.4,0-8-3.6-8-8v-51c0-4.4,3.6-8,8-8H399 M399,174.5h-2c-6.1,0-11,4.9-11,11v51c0,6.1,4.9,11,11,11h2c6.1,0,11-4.9,11-11v-51C410,179.4,405.1,174.5,399,174.5z"/>
          </svg>
        </div>

        <div class="Card__event-content">
          <header class="Card__header">
            <h2 class="Card__heading">{!! get_the_title() !!}</h2>

            <time>{{ get_field('event_date') }}</time>
          </header>

          <p>{{ __('Location') }}: {{ get_field('event_location') }}</p>

          <a
            class="Button Button--small Button--primary"
            href="{{ get_field('event_url') }}"
            target="_blank"
          >{{ __('Learn More', 'sage') }}</a>
        </div>
      </article>
    @endwhile
  </div>

  {!! get_the_posts_navigation() !!}
@endsection
