<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <div class="Hero Hero--home-page">
      <div class="Container">
        <div class="Hero__content">
          <h1 class="Hero__title"><?php echo $banner->title ?? $title; ?></h1>

          <?php if(isset($banner->subtitle)): ?>
            <?php echo $banner->subtitle; ?>

          <?php endif; ?>

          <div class="Hero__cta">
            <a class="Hero__phone-number" id="HomeHeroPhoneNumber" href="tel:833.997.1947">
              <?php echo e(__('833-997-1947', 'sage')); ?>

            </a>
            <a class="Hero__guide" id="HomeHeroGuide" href="/free-mesothelioma-guide/">
              <?php echo e(__('Let Us Help', 'sage')); ?>

            </a>
          </div>
        </div>
      </div>

      <picture class="Photo Photo--home-layer-3">
        <source srcset="<?php echo e(get_the_post_thumbnail_url(null, 'full')); ?>" media="(min-width: 64em)">
        <source srcset="<?php echo e(get_the_post_thumbnail_url(null, 'large')); ?>" media="(min-width: 52em)">
        <img class="Photo__img" srcset="<?php echo e(get_the_post_thumbnail_url(null, 'medium_large')); ?>" alt="" style="width: 100%;">
      </picture>
    </div>

    <?php echo $__env->make('partials.segments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/front-page.blade.php ENDPATH**/ ?>