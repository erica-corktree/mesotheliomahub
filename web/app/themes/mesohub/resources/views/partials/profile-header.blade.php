<div class="relative py-8 text-white md:py-12 bg-yellow-dark">
  <div class="container relative z-10">
    <div class="flex flex-wrap pt-4">
      @if ($profile->photo)
        <picture class="w-32 h-32 mb-4 rounded-full md:mb-0">
          <img
            class="block object-cover w-full h-full border rounded-full border-grey-dark"
            src="{{ $profile->photo->sizes->thumbnail ?? '' }}"
            alt="{{ __('Photo of', 'sage') }} {{ $profile->name ?? '' }}"
          >
        </picture>
      @endif

      <div class="@if ($profile->photo) md:pl-6 @endif md:flex-1">
        <hgroup>
          <h1 class="mb-2 text-3xl font-medium leading-none md:text-5xl">{{ $profile->name }}</h1>
          <h2 class="mb-6 text-lg font-medium md:text-xl md:leading-none text-yellow-lightest">{{ $profile->title }}</h2>
        </hgroup>

        {!! $profile->bio !!}
      </div>
    </div>
  </div>
</div>
