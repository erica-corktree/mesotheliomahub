<article class="SearchResult">
  <header class="SearchResult__header">
    <?php
    if (get_post_meta(get_the_ID(), '_yoast_wpseo_title', true)) {
        $title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
    } else {
        $title = get_the_title();
    }
    ?>

    <h2><a href="<?php echo e(get_the_permalink()); ?>"><?php echo e($title); ?></a></h2>
    <p><a href="<?php echo e(get_the_permalink()); ?>"><?php echo e(get_the_permalink()); ?></a></p>
  </header>

  <div class="SearchResult__summary">
    <?php if(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)): ?>
      <?php echo e(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)); ?>

    <?php else: ?>
      <?php echo get_the_excerpt(); ?>

    <?php endif; ?>
  </div>
</article>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/content-search.blade.php ENDPATH**/ ?>