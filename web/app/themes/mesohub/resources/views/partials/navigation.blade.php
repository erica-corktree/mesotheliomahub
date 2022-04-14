@if ($navigation)
  <nav class="navigation" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SitenavigationElement">
    <div class="container navigation__container">
      <a class="navigation__close button button--white button--navigation-close" href="#primary-nav" aria-controls="primary-nav">
        @svg('images.x', 'block w-8 h-auto')
        <span>{{ __('Close', 'sage') }}</span>
      </a>

      <ul class="navigation__menu" id="primary-nav">
        @foreach ($navigation as $item)
          <li class="navigation__menu-item {{ !empty($item->classes) ? "navigation__menu-item--{$item->classes}" : '' }} {{ $item->active ? 'navigation__menu-item--active' : '' }}">
            <a class="navigation__menu-link" href="{{ $item->url }}"><span>{{ $item->label }}</span>

            @if ($item->children)
              <button class="navigation__toggle-button" aria-haspopup="true" aria-label="Show Submenu">
                @svg('images.chevron-down', 'inline-block w-4 h-auto')
              </button>

              <ul class="navigation__submenu" aria-label="{{ __('Submenu', 'sage') }}" aria-hidden="true">
                @foreach ($item->children as $child)
                  <li class="navigation__submenu-item {{ $child->active ? 'navigation__submenu-item--active' : '' }}">
                    <a class="navigation__submenu-link" href="{{ $child->url }}">{{ $child->label }}</a>
                  </li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </nav>
@endif
