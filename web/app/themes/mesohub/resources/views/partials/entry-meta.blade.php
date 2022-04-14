@php
$class    = $class ?? '';
$postID   = $postID ?? get_the_ID();
$authorID = $authorID ?? get_post_field('post_author', $postID);
@endphp

<div class="EntryMeta {{ $class }}">
  <p class="EntryMeta__authorTime">
    <span class="EntryMeta__text">{{ __('By', 'sage') }}: </span>

    <a
      class="EntryMeta__authorLink"
      href="{{ get_author_posts_url($authorID) }}"
      rel="author"
    >{{ get_the_author_meta('display_name', $authorID) }}</a>

    <span class="EntryMeta__text"> | </span>

    <time
      class="EntryMeta__time"
      datetime="{{ get_post_time('c', true, $postID) }}"
    >{{ get_the_date(null, $postID) }}</time>
  </p>
</div>
