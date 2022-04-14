<footer class="relative z-10">
  <div class="attribution">
    <p class="flex items-center py-4 font-medium attribution__title">
      <button
        class="flex items-center justify-center w-6 h-6 rounded-full shadow-md attribution__toggle bg-grey-light"
        aria-controls="attribution-author"
        aria-expanded="false"
        aria-label="{{ __('Toggle author info', 'sage') }}"
      >
        @svg('images.plus', 'w-4')
      </button>

      <span class="ml-2">{{ __('Author:', 'sage') }} {{ $author->name ?? '' }}</span>
    </p>

    <div class="flex hidden py-4 attribution__content" id="attribution-author" aria-hidden="true">
      @if (isset($author->photo))
        <picture class="w-24 h-24 mb-4 rounded-full md:mb-0">
          <img
            class="block object-cover w-full h-full border rounded-full border-grey-dark"
            src="{{ $author->photo->sizes->thumbnail ?? '' }}"
            alt="{{ __('Photo of', 'sage') }} {{ $author->name ?? '' }}"
          >
        </picture>
      @endif

      <div class="flex-1 md:pl-4">
        <p class="mb-2 text-lg font-medium leading-none">
          <a class="underline text-yellow hover:text-yellow-dark" href="{{ $author->url ?? '' }}">{{ $author->name ?? '' }}</a>
        </p>

        <p class="mb-4 font-medium leading-none text-grey-dark">{{ $author->title ?? '' }}</p>
        <p>{{ $author->bio ?? '' }}</p>
      </div>
    </div>

    @if ($reviewer)
      <p class="flex items-center py-4 font-medium attribution__title">
        <button
          class="flex items-center justify-center w-6 h-6 rounded-full shadow-md attribution__toggle bg-grey-light"
          aria-controls="attribution-reviewer"
          aria-expanded="false"
          aria-label="{{ __('Toggle author info', 'sage') }}"
        >
          @svg('images.plus', 'w-4')
        </button>

        <span class="ml-2">{{ __('Medical Reviewer:', 'sage') }} {{ $reviewer->name }}</span>
      </p>

      <div class="flex hidden py-4 attribution__content" id="attribution-reviewer" aria-hidden="true">
        @if (isset($reviewer->photo))
          <picture class="w-24 h-24 mb-4 rounded-full md:mb-0">
            <img
              class="block object-cover w-full h-full border rounded-full border-grey-dark"
              src="{{ $reviewer->photo->sizes->thumbnail }}"
              alt="{{ __('Photo of', 'sage') }} {{ $reviewer->name }}"
            >
          </picture>
        @endif

        <div class="flex-1 md:pl-4">
          <p class="mb-2 text-lg font-medium leading-none">
            <a class="underline text-yellow hover:text-yellow-dark" href="{{ $reviewer->url }}">{{ $reviewer->name }}</a>
          </p>

          <p class="mb-4 font-medium leading-none text-grey-dark">{{ $reviewer->title }}</p>
          {!! $reviewer->bio !!}
        </div>
      </div>
    @endif

    @if (get_field('page_citations'))
      <p class="flex items-center py-4 font-medium attribution__title">
        <button
          class="flex items-center justify-center w-6 h-6 rounded-full shadow-md attribution__toggle bg-grey-light"
          aria-controls="attribution-citations"
          aria-expanded="false"
          aria-label="{{ __('Toggle citations', 'sage') }}"
        >
          @svg('images.plus', 'w-4')
        </button>

        <span class="ml-2">{{ __('Sources', 'sage') }}</span>
      </p>

      <div class="hidden py-4 attribution__content" id="attribution-citations" aria-hidden="true">
        <div class="editorcontent">
          {!! get_field('page_citations') !!}
        </div>
      </div>
    @endif
  </div>
</footer>
