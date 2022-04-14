<article class="relative flex flex-col overflow-hidden bg-white border rounded shadow-md text-grey-darker">
  @if (isset($hero->photo))
    <x-photo class="z-0 h-56 mb-4 rounded-t" :photo="$hero->photo" />
  @endif

  <header class="px-6 mb-4">
    <p class="mb-1 tracking-widest uppercase">@category</p>
    <h2 class="mb-2 font-sans text-xl font-medium leading-snug md:text-2xl">@title</h2>
    <p>{{ __('By', 'sage') }} @author <span>&#124;</span> <time datetime="@published('c')">@published('F j, Y')</time></p>
  </header>

  <div class="flex flex-col flex-auto px-6 pb-6">
    <div class="flex-auto entry-summary stretched-link">
      @if (isset($hero->introduction))
        {!! $hero->introduction !!}
      @else
        @excerpt
      @endif
    </div>

    <p class="mt-6">
      <a class="button button--outline button--primary stretched-link" href="@permalink">{{ __('Read More', 'sage') }}</a>
    </p>
  </div>
</article>
