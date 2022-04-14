<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <div class="Hero Hero--guide">
      <div class="Container Container--hero-content">
        <div class="Hero__content">
        <h1 class="Hero__title"><?php echo e($banner->title); ?></h1>

<?php if(isset($banner->subtitle)): ?>
  <div class="Hero__subtitle">
    <?php echo $banner->subtitle; ?>

  </div>
<?php endif; ?>

        </div>

        <div class="Guideform">
          <?php echo do_shortcode("[wpforms id='63904']"); ?>

        </div>
      </div>
      <svg class="Hero__wave" viewBox="0 0 1440 625">
        <path d="M1200.9,306.2c-298.7,14.8-322.1,137.2-505,233.3C534.8,624.1,302.8,645.1,0,602.7V625h1440V213.4C1385.7,270.1,1306,301,1200.9,306.2z"/>
      </svg>
    </div>

    <?php echo $__env->make('partials.segments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('partials.footer-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/template-legal-page.blade.php ENDPATH**/ ?>