<div class="cta cta--in-content">
  <div class="relative z-10 flex flex-wrap justify-end">
    <div
      @if ($photo)
        class="py-12 pr-4 w-full md:w-1/2 font-medium text-3xl leading-tight"
      @else
        class="py-12 pr-4 flex flex-col md:flex-row items-center font-medium text-3xl leading-tight"
      @endif
    >
      {!! $content !!}
    </div>
  </div>

  @if ($photo)
    <x-photo class="absolute inset-y-0 left-0 w-full md:w-1/2 opacity-50 md:opacity-100" :photo="$photo" />
  @endif
</div>
