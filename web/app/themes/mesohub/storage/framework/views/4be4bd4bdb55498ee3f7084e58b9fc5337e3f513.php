<header class="Masthead">
  <?php if($acf_options->site_announcement_banner->toggle): ?>
    <div class="Masthead__announcement">
      <p><?php echo $acf_options->site_announcement_banner->text; ?></p>
    </div>
  <?php endif; ?>

  <div class="Masthead__content Container">
    <?php echo $__env->make('partials.svgs.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="Masthead__buttons">
      <?php if (! (is_page('free-mesothelioma-guide'))): ?>
        <div class="Masthead__cta">
          <span class="Icon Icon--phone"></span>
          <a class="Masthead__phone-number" id="HeaderPhoneNumberLink" href="tel:<?php echo e($acf_options->site_phone_number->dial_in); ?>"><?php echo e($acf_options->site_phone_number->dial_in); ?></a>
        </div>

        <a
          class="Masthead__guide-button Button Button--yellow Button--small"
          id="HeaderGuideButton"
          href="/legal-help/receive-a-case-evaluation/"
        >
          <span class="Button__desktop-text">
            <?php echo e(__('Request A', 'sage')); ?>

          </span>
          <?php echo e(__('Free Case Evaluation', 'sage')); ?>

        </a>
      <?php endif; ?>

      <div class="Masthead__search">
        <button
          class="Masthead__search-button Button Button--outline Button--small js-search-toggle"
          aria-label="<?php echo e(__('Search', 'sage')); ?>"
        >
          <span class="Icon Icon--search"></span>
        </button>

        <div class="Masthead__search-form">
          <form class="Form Form--horizontal" action="/" method="get">
            <input
              class="Form__input"
              id="SiteSearch"
              name="s"
              type="text"
              placeholder="<?php echo e(__('Search our site...', 'sage')); ?>"
            >
            <button class="Button Button--primary" type="submit">
              <?php echo e(__('Go', 'sage')); ?>

            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <nav class="Navigation">
    <?php if($primary_nav_items): ?>
      <ul id="PrimaryNavigation" class="Navigation__menu Menu">
        <?php $__currentLoopData = $primary_nav_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
          $navLabel  = strtolower($item->label);
          $navObject = (has_nav_menu("{$navLabel}_menu"))
                       ? wp_get_nav_menu_object(get_nav_menu_locations()["{$navLabel}_menu"])
                       : false;
          ?>

          <li class="Menu__item Menu__item--<?php echo e($item->classes); ?><?php echo e(($navObject && $navObject->count > 0) ? ' Menu__item--has-children' : ''); ?>">
            <a
              class="Menu__link"
              href="<?php echo e($item->url); ?>"
            >
             
              <span class="Menu__text"><?php echo e($item->label); ?></span>
              <!-- Arrow icon - Need JS to have it click and flip-->
              <!-- <span class="nav_arrow"><i class="fa fa-angle-down"></i></span> -->
            </a>

            <?php if($navObject): ?>
              <?php
              $cta = get_field('menu_cta', $navObject);

              if ($cta['heading']) {
                  $itemsWrap = '<ul id="%1$s" class="%2$s">';

                  $itemsWrap .= "
                  <li class=\"Menu__item Menu__item--mobile\">
                    <a class=\"Menu__link\" href=\"{$item->url}\">{$item->label}</a>
                  </li>
                  ";

                  $itemsWrap .= '%3$s';

                  $itemsWrap .= "
                    <li class=\"Menu__cta\">
                      <div class=\"Menu__cta__header\">
                        <p class=\"Menu__cta__heading\">
                          {$cta['heading']}
                        </p>
                        <a class=\"Button Button--teal-light\" href=\"{$cta['link']['url']}\">
                          {$cta['link']['title']}
                        </a>
                      </div>
                      <p class=\"Menu__cta__subheading\">
                        {$cta['subheading']}
                      </p>
                    </li>
                  </ul>
                  ";
              } else {
                  $itemsWrap = '<ul id="%1$s" class="%2$s">';

                  $itemsWrap .= "
                  <li class=\"Menu__item Menu__item--mobile\">
                    <a class=\"Menu__link\" href=\"{$item->url}\">{$item->label}</a>
                  </li>
                  ";

                  $itemsWrap .= '%3$s</ul>';
              }
              ?>

              <?php if($navObject && $navObject->count > 0): ?>
                <div class="Navigation__submenu Navigation__submenu--<?php echo e($navLabel); ?>">
                  <?php echo wp_nav_menu([
                    'theme_location' => "{$navLabel}_menu",
                    'items_wrap'     => $itemsWrap,
                    'menu_class'     => 'Navigation__submenu__list Menu',
                  ]); ?>

                </div>
              <?php endif; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    <?php endif; ?>
  </nav>
</header>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/header.blade.php ENDPATH**/ ?>