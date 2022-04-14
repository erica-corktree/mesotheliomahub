<footer class="Footer">
  <div class="Container">
    <div class="Footer__col Footer__col--left">
      <?php echo $__env->make('partials.svgs.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <p class="Footer__copyright"><?php echo do_shortcode(get_field('site_footer_copyright', 'option')); ?></p>

      <?php if(has_nav_menu('footer_secondary_navigation')): ?>
        <?php echo wp_nav_menu([
          'theme_location' => 'footer_secondary_navigation',
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'menu_class'     => 'Footer__menu-secondary Menu',
        ]); ?>

      <?php endif; ?>


      <p class="Footer__socal-icons">
        <a
          class="Footer__social-links"
          href="https://www.facebook.com/MesotheliomaHub/"
          onclick="window.open(this.href); return false;"
        >
          <img
            class="Footer__social"
            src="/app/uploads/2021/04/facebook.png"
            alt="This a facebook icon."
          >
        </a>
        <a
          class="Footer__social-links"
          href="https://twitter.com/meso_hub"
          onclick="window.open(this.href); return false;"
        >
          <img
            class="Footer__social"
            src="/app/uploads/2021/04/twitter.png"
            alt="This a twitter icon."
          >
        </a>
        <a
          class="Footer__social-links"
          href="https://www.linkedin.com/company/mesothelioma-hub/"
          onclick="window.open(this.href); return false;"
        >
          <img
            class="Footer__social"
            src="/app/uploads/2021/04/linkedin.png"
            alt="This a linkedin icon."
          >
        </a>
      </p>
    </div>

    <div class="Footer__col Footer__col--right">
      <div class="email_opt">
        <h5>Sign Up For Our Newsletter To Get Up-To-Date Mesothelioma-Related Information</h5>
          <form 
            class="js-cm-form" 
            id="subForm" 
            action="https://www.createsend.com/t/subscribeerror?description=" 
            method="post" 
            data-id="2BE4EF332AA2E32596E38B640E905619E6F7678C791E389D2DD12ACE6662CA3FEB897CF1C7B116686A9D73633488ECA886DD777E35AD460CFF91FB568A0B45AE">
                <div class="form_container">
                  <input 
                    autocomplete="Email" 
                    aria-label="Email" 
                    class="js-cm-email-input qa-input-email" 
                    id="fieldEmail" maxlength="200" 
                    name="cm-jrxull-jrxull" 
                    required="" 
                    type="email"
                    placeholder="Type your email here.">
                    
              <button 
                type="submit"
                class="email_opt_btn">&gt;
              </button>
              </div>  
          </form>
      </div>
      <div class="email_clear">

      </div>
      
      <script type="text/javascript" src="https://js.createsend1.com/javascript/copypastesubscribeformlogic.js"></script>

      <?php if(has_nav_menu('footer_navigation')): ?>
        <?php echo wp_nav_menu([
          'theme_location' => 'footer_navigation',
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'menu_class'     => 'Footer__menu-primary Menu',
        ]); ?>

      <?php endif; ?>

      <p class="Footer__disclaimer">This website information is proprietary, protected, and not a substitute for professional medical advice, diagnosis or treatment. The Mesotheliomahub.com website and its content are sponsored by a law firm and may be deemed attorney advertising. For more information, visit our <a href="https://www.mesotheliomahub.com/about-us/mesothelioma-hub-sponsors/">sponsor page.</a></p>
    </div>

    <p class="Footer__modified"><?php echo e(__('Last Modified', 'sage')); ?>: <time><?php echo e(get_the_modified_date(null, get_the_ID())); ?></time>, <?php echo e(__('Created', 'sage')); ?>: <time><?php echo e(get_the_date(null, get_the_ID())); ?></time></p>
  </div>
</footer>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/footer.blade.php ENDPATH**/ ?>