<header class="Masthead">
  @if ($acf_options->site_announcement_banner->toggle)
    <div class="Masthead__announcement">
      <p>{!! $acf_options->site_announcement_banner->text !!}</p>
    </div>
  @endif

  <div class="Masthead__content Container">
    @include('partials.svgs.logo')

    <div class="Masthead__buttons">
      @unless (is_page('free-mesothelioma-guide'))
        <div class="Masthead__cta">
          <span class="Icon Icon--phone"></span>
          <a class="Masthead__phone-number" id="HeaderPhoneNumberLink" href="tel:{{ $acf_options->site_phone_number->dial_in }}">{{ $acf_options->site_phone_number->dial_in }}</a>
        </div>

        <a
          class="Masthead__guide-button Button Button--yellow Button--small"
          id="HeaderGuideButton"
          href="/legal-help/receive-a-case-evaluation/"
        >
          <span class="Button__desktop-text">
            {{ __('Request A', 'sage') }}
          </span>
          {{ __('Free Case Evaluation', 'sage') }}
        </a>
      @endunless

      <div class="Masthead__search">
        <button
          class="Masthead__search-button Button Button--outline Button--small js-search-toggle"
          aria-label="{{ __('Search', 'sage') }}"
        >
          <span class="Icon Icon--search"></span>
        </button>

        <div class="Masthead__search-form">
          <form class="Form Form--horizontal" action="/" method="get">
            <input
              class="Form__input"
              id="SiteSearch"
              name="s"
              type="text"
              placeholder="{{ __('Search our site...', 'sage') }}"
            >
            <button class="Button Button--primary" type="submit">
              {{ __('Go', 'sage') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <nav class="Navigation">
    @if ($primary_nav_items)
      <ul id="PrimaryNavigation" class="Navigation__menu Menu">
        @foreach ($primary_nav_items as $item)
          @php
          $navLabel  = strtolower($item->label);
          $navObject = (has_nav_menu("{$navLabel}_menu"))
                       ? wp_get_nav_menu_object(get_nav_menu_locations()["{$navLabel}_menu"])
                       : false;
          @endphp

          <li class="Menu__item Menu__item--{{ $item->classes }}{{ ($navObject && $navObject->count > 0) ? ' Menu__item--has-children' : '' }}">
            <a
              class="Menu__link"
              href="{{ $item->url }}"
            >
             
              <span class="Menu__text">{{ $item->label }}</span>
              <!-- Arrow icon - Need JS to have it click and flip-->
              <!-- <span class="nav_arrow"><i class="fa fa-angle-down"></i></span> -->
            </a>

            @if ($navObject)
              @php
              $cta = get_field('menu_cta', $navObject);

              if ($cta['heading']) {
                  $itemsWrap = '<ul id="%1$s" class="%2$s">';

                  $itemsWrap .= "
                  <li class=\"Menu__item Menu__item--mobile\">
                    <a class=\"Menu__link\" href=\"{$item->url}\">{$item->label}</a>
                  </li>
                  ";

                  $itemsWrap .= '%3$s';

                  $itemsWrap .= "
                    <li class=\"Menu__cta\">
                      <div class=\"Menu__cta__header\">
                        <p class=\"Menu__cta__heading\">
                          {$cta['heading']}
                        </p>
                        <a class=\"Button Button--teal-light\" href=\"{$cta['link']['url']}\">
                          {$cta['link']['title']}
                        </a>
                      </div>
                      <p class=\"Menu__cta__subheading\">
                        {$cta['subheading']}
                      </p>
                    </li>
                  </ul>
                  ";
              } else {
                  $itemsWrap = '<ul id="%1$s" class="%2$s">';

                  $itemsWrap .= "
                  <li class=\"Menu__item Menu__item--mobile\">
                    <a class=\"Menu__link\" href=\"{$item->url}\">{$item->label}</a>
                  </li>
                  ";

                  $itemsWrap .= '%3$s</ul>';
              }
              @endphp

              @if ($navObject && $navObject->count > 0)
                <div class="Navigation__submenu Navigation__submenu--{{ $navLabel }}">
                  {!! wp_nav_menu([
                    'theme_location' => "{$navLabel}_menu",
                    'items_wrap'     => $itemsWrap,
                    'menu_class'     => 'Navigation__submenu__list Menu',
                  ]) !!}
                </div>
              @endif
            @endif
          </li>
        @endforeach
      </ul>
    @endif
  </nav>
</header>
