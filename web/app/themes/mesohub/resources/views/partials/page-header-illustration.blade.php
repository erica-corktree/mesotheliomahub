@php
$id = is_home() ? get_option('page_for_posts', true) : null;
@endphp

@if (get_the_post_thumbnail_url())
  <picture class="Illustration">
    <source srcset="{{ get_the_post_thumbnail_url($id, 'full') }}" media="(min-width: 64em)">
    <source srcset="{{ get_the_post_thumbnail_url($id, 'large') }}" media="(min-width: 52em)">
    <source srcset="{{ get_the_post_thumbnail_url($id, 'medium_large') }}" media="(min-width: 40em)">
    <img class="PageHeader__bg__img" srcset="{{ get_the_post_thumbnail_url($id, 'medium') }}" alt="" style="width: 100%;">
  </picture>
@endif
