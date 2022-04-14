@if ($content)
  <div class="relative p-8">
    <x-photo class="photo--widget" :photo="$content->photo" />
    <p class="mb-1 text-xl font-heading font-medium leading-snug text-yellow">{{ $content->title }}</p>

    <p class="mb-6 text-sm text-grey-dark">
      <span>{{ __('By', 'sage') }} {{ $content->author }}<span>
      {{-- <span>&#124;</span>
      <time datetime="{{ $content->time }}">{{ $content->date }}</time> --}}
    </p>

    <p class="mb-6 text-grey-darker">{{ $content->excerpt }}</p>
    <p><a class="button button--yellow-dark stretched-link" href="{{ $content->permalink }}">{{ __('Read More', 'sage') }}</a></p>
  </div>
@else
  <div class="p-4">
    <p class="text-grey-dark">Alert Warning: No content found</p>
  </div>
@endif
