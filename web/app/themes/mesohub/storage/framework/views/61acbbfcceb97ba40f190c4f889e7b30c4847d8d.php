<?php $__env->startSection('content'); ?>
  <?php $blogId = get_option('page_for_posts', true); ?>

  <section>
    <header class="PageHeader">
      <div class="Container">
        <div class="PageHeader__content">
          <h1>The Latest in Mesothelioma News</h1>

          <?php if(isset($banner->title)): ?>
            <p><?php echo $banner->title; ?></p>
          <?php endif; ?>
        </div>

        <picture class="Photo Photo--home-layer-3">
          <source srcset="<?php echo e(get_the_post_thumbnail_url($blogId, 'full')); ?>" media="(min-width: 64em)">
          <source srcset="<?php echo e(get_the_post_thumbnail_url($blogId, 'large')); ?>" media="(min-width: 52em)">

          <img
            class="Photo__img"
            srcset="<?php echo e(get_the_post_thumbnail_url($blogId, 'medium_large')); ?>"
            alt=""
            style="width: 100%;"
          >
        </picture>
      </div>
    </header>

    <div class="Container">
      <div class="PageWrap">
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="PageContent">
          <?php echo $__env->make('partials.blog-posts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
    </div>

    <?php echo $__env->make('partials.footer-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/home.blade.php ENDPATH**/ ?>