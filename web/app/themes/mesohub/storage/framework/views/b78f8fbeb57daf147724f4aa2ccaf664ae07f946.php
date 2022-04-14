<div class="FooterCTA">
  <div class="Container">
    <div class="FooterCTA__col FooterCTA__col--left">
      <h3 class="FooterCTA__heading"><?php echo e($acf_options->site_page_footer_cta->heading); ?></h3>
      <p class="FooterCTA__content"><?php echo e($acf_options->site_page_footer_cta->content); ?></p>
    </div>

    <div class="FooterCTA__col FooterCTA__col--right">
      <?php if ($__env->exists('partials.svgs.community-members')) echo $__env->make('partials.svgs.community-members', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <a class="FooterCTA__phone-number" href="tel:<?php echo e($acf_options->site_phone_number->dial_in); ?>">
        <span class="Icon Icon--phone"></span> <?php echo e($acf_options->site_phone_number->dial_in); ?>

      </a>
    </div>
  </div>
</div>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/footer-cta.blade.php ENDPATH**/ ?>