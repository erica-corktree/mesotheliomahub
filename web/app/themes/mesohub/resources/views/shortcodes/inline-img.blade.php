<div class="flex mb-8 flex-col md:flex-row items-center">
  <picture class="mx-auto h-40 w-40 md:self-start">
    <img class="h-full w-full object-contain" src="{{ $src }}" alt="{{ $alt }}">
  </picture>

  <div class="editorcontent flex-1 pt-4 md:pt-0 md:pl-8">
    {!! $content !!}
  </div>
</div>
