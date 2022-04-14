@php
$id    = $id ?? get_the_ID();
$class = $class ?? '';
@endphp

<div class="ShareTools {{ $class }} ">
  <div class="ShareTools__col">
    <div class="ShareTools__share-wrap">
      <button class="Button Button--share" data-toggle="ShareTools{{ $id }}">
        <span class="Icon Icon--external-link"></span>
        <span class="Button__text">{{ __('Share', 'sage') }}</span>
      </button>

      <div class="Tooltip" id="ShareTools{{ $id }}" data-toggler=".js-opened">
        <button class="Tooltip__close" data-toggle="ShareTools{{ $id }}">
          <span class="Icon Icon--close"></span>
        </button>

        <p class="Tooltip__heading">{{ __('Share', 'sage') }}</p>
        <p class="Tooltip__subheading">{!! get_the_title($id) !!}</p>

        <ul class="Tooltip__list">
          @foreach (App\shareLinks($id) as $name => $link)
            <li>
              <a class="Button Button--icon" href="{{ $link['url'] }}">
                <span class="Icon Icon--{{ $name }}"></span>
                <span class="Button__text">{{ __($link['label'], 'sage') }}</span>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
