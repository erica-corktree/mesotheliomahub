<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <section>
      <header class="PageHeader">
        <div class="Container">
          <div class="PageHeader__content">
            <h1 class="PageHeader__heading"><?php echo e(get_the_title()); ?></h1>
          </div>
        </div>
      </header>
        
      <div class="Container Container--page-wrap">
        <div class="PageWrap">
          <div class="PageContent">
          <div class="reviewer_image" style="width:25%;margin-bottom:20px;">
        <?php if(get_the_post_thumbnail_url()): ?>
              <picture class="Photo Photo--reviewer">
                <source srcset="<?php echo e(get_the_post_thumbnail_url($id, 'full')); ?>" media="(min-width: 64em)">
                <source srcset="<?php echo e(get_the_post_thumbnail_url($id, 'large')); ?>" media="(min-width: 52em)">
                <source srcset="<?php echo e(get_the_post_thumbnail_url($id, 'medium_large')); ?>" media="(min-width: 40em)">
                <img class="Photo__img" srcset="<?php echo e(get_the_post_thumbnail_url($id, 'medium')); ?>" alt="" style="width: 100%;" loading="lazy">
              </picture>
            <?php endif; ?>
  </div>
            <div class="EditorContent">
              <?php the_content() ?>
            </div>
          </div>
        </div>
      </div>

      <?php echo $__env->make('partials.footer-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
  <?php endwhile; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/single-reviewer.blade.php ENDPATH**/ ?>