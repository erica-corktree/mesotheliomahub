<?php $__env->startSection('content'); ?>
  <section>
    <header class="PageHeader">
      <div class="Container">
        <div class="PageHeader__content">
          <h1><?php echo $title; ?></h1>
        </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/archive.blade.php ENDPATH**/ ?>