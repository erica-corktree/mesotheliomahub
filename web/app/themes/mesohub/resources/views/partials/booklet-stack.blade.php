@set($photo, '/app/uploads/2020/07/Mesothelioma-Hub_Homepage-Hero-1-768x432.jpg')
@set($title, ['top' => __('A Complete', 'sage'), 'bottom' => __('Mesothelioma Guide', 'sage')])
@set($subtitle, __('Resources that support you and your family.', 'sage'))

<span class="booklet-stack">
  @for ($i = 0; $i < 3; $i++)
    <span class="booklet booklet--{{ ($i+1) }}">
      <picture class="booklet__photo">
        <img class="booklet__img" src="{{ $photo }}" alt="">
      </picture>
      <span class="booklet__title">
        <span class="booklet__title-top">{{ $title['top'] }}</span>
        <span class="booklet__title-bottom">{{ $title['bottom'] }}</span>
      </span>
      <span class="booklet__subtitle">{{ $subtitle }}</span>
    </span>
  @endfor
</span>
