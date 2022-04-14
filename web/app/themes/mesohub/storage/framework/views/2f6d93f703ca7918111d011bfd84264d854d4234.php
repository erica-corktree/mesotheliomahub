<?php $__env->startSection('content'); ?>
  <div class="NotFoundContent Container">
    <h1><?php echo e(__('404:', 'sage')); ?> <?php echo e($title); ?></h1>
  </div>

  <?php if(!have_posts()): ?>
    <div class="alert alert-warning">
      <?php echo e(__('Sorry, but the page you were trying to view does not exist.', 'sage')); ?>

    </div>
    <?php echo get_search_form(false); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/404.blade.php ENDPATH**/ ?>