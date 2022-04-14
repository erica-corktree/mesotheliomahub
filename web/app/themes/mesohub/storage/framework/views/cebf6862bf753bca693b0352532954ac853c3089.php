<section>
  <?php echo $__env->make('partials.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="Container Container--page-wrap">
    <div class="PageWrap">
      <?php if(App\display_sidebar()): ?>
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>

      <div class="PageContent">
        <div class="EditorContent">
          <?php the_content() ?>

          <?php echo wp_link_pages([
              'echo' => 0,
              'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'),
              'after' => '</p></nav>',
          ]); ?>


          <?php echo $__env->make('partials.page-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
    </div>
  </div>

  <?php echo $__env->make('partials.segments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('partials.footer-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/content-page.blade.php ENDPATH**/ ?>