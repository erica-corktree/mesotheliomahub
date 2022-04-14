<?php
$class    = $class ?? '';
$postID   = $postID ?? get_the_ID();
$authorID = $authorID ?? get_post_field('post_author', $postID);
?>

<div class="EntryMeta <?php echo e($class); ?>">
  <p class="EntryMeta__authorTime">
    <span class="EntryMeta__text"><?php echo e(__('By', 'sage')); ?>: </span>

    <a
      class="EntryMeta__authorLink"
      href="<?php echo e(get_author_posts_url($authorID)); ?>"
      rel="author"
    ><?php echo e(get_the_author_meta('display_name', $authorID)); ?></a>

    <span class="EntryMeta__text"> | </span>

    <time
      class="EntryMeta__time"
      datetime="<?php echo e(get_post_time('c', true, $postID)); ?>"
    ><?php echo e(get_the_date(null, $postID)); ?></time>
  </p>
</div>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/entry-meta.blade.php ENDPATH**/ ?>