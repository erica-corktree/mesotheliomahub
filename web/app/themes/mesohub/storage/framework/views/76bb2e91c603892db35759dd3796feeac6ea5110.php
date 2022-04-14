<?php $__env->startSection('content'); ?>
  <div class="PageHeader">
    <div class="Container">
      <h1><?php echo e(__('Search results for:', 'sage')); ?> <?php echo e(get_search_query()); ?></h1>
    </div>
  </div>

  <div class="Container">
    <?php if(!have_posts()): ?>
      <div class="Alert">
        <?php echo e(__('Sorry, no results were found.', 'sage')); ?>

      </div>

      <?php echo $__env->make('partials.search-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <p class="ResultsCount"><?php echo e(__('About', 'sage')); ?> <?php echo e($results_count); ?> <?php echo e(__('results', 'sage')); ?></p>

    <?php while(have_posts()): ?> <?php (the_post()); ?>
      <?php echo $__env->make('partials.content-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endwhile; ?>

    <?php echo App\numeric_pagination(); ?>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/search.blade.php ENDPATH**/ ?>