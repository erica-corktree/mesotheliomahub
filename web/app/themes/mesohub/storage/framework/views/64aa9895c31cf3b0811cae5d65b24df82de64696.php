<?php if(isset($content_sections) && !empty($content_sections)): ?>
  <div class="Segments">
    <?php $__currentLoopData = $content_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($section->acf_fc_layout === 'normal'): ?>
        <section
          class="Segment Segment--normal
                 <?php if($section->bg_color): ?> Segment--<?php echo e($section->bg_color); ?> <?php endif; ?>
                 <?php if($section->icon): ?> Segment--has-icon <?php endif; ?>
                 <?php if($section->top_wave): ?> Segment--top-wave-visible <?php endif; ?>
                 <?php if($section->bottom_wave): ?> Segment--bottom-wave-visible <?php endif; ?>
                "
        >
          <?php if($section->top_wave): ?>
            <svg class="Segment__wave Segment__wave--top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 78"><path d="M1440,61.3V0H0v76.7C192.4,63.7,635.7,1,917.8,1C1102.2,1,1276.2,21.1,1440,61.3z"/></svg>
          <?php endif; ?>

          <div class="Container">
            <?php if($section->icon): ?>
              <div class="Segment__icon Segment__icon--<?php echo e($section->icon); ?>">
                <?php if ($__env->exists("partials.svgs.{$section->icon}")) echo $__env->make("partials.svgs.{$section->icon}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            <?php endif; ?>

            <div class="Segment__content EditorContent">
              <?php echo $section->content; ?>

            </div>
          </div>

          <?php if($section->bottom_wave): ?>
            <svg class="Segment__wave Segment__wave--bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 75.7"><path d="M522.2,74.7C337.8,74.7,163.8,54.6,0,14.4v61.3h1440V0h-14.1C1226.7,14.9,797.6,74.7,522.2,74.7z"/></svg>
          <?php endif; ?>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'cta'): ?>
        <section class="Segment Segment--cta">
          <div class="Container">
            <div class="Segment__col Segment__col--left">
              <h3 class="Segment__heading"><?php echo $section->heading; ?></h3>
              <p class="Segment__subheading"><?php echo e($section->subheading); ?></p>
            </div>

            <div class="Segment__col Segment__col--right">
              <?php if ($__env->exists("partials.svgs.{$section->icon}")) echo $__env->make("partials.svgs.{$section->icon}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <a class="Button Button--primary" href="<?php echo e($section->link->url); ?>"><?php echo e($section->link->title); ?></a>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'tabbed_menu'): ?>
        <?php
        $tabID = uniqid('tab_');
        ?>

        <section class="Segment Segment--tabs">
          <div class="Tabs">
            <div class="Container">
              <ul class="Tabs__menu tabs" data-tabs id="<?php echo e($tabID); ?>">
                <?php $__currentLoopData = $section->tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="Tabs__menu__item tabs-title <?php if($loop->first): ?> is-active <?php endif; ?>">
                    <a class="Tabs__menu__link" href="#<?php echo e($tabID); ?>_<?php echo e($loop->index); ?>"><?php echo e($tab['label']); ?></a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>

              <div class="Tabs__pane-container tabs-content" data-tabs-content="<?php echo e($tabID); ?>">
                <?php $__currentLoopData = $section->tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div
                    class="Tabs__pane tabs-panel <?php if($loop->first): ?> is-active <?php endif; ?>"
                    id="<?php echo e($tabID); ?>_<?php echo e($loop->index); ?>"
                  >
                    <div class="Tabs__pane-content">
                      <?php echo $tab['content']; ?>


                      <ul class="Tabs__link-menu">
                        <?php $__currentLoopData = $tab['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li class="Tabs__link-menu__item">
                            <a href="<?php echo e($item->link->url); ?>"><?php echo e($item->link->title); ?> <span class="icon icon--chevron"></span></a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    </div>

                    <div class="Tabs__bg">
                      <img
                        class="Tabs__bg__img"
                        src="<?php echo e($tab['bg']['url']); ?>"
                        srcset="<?php echo e($tab['bg']['sizes']['small']); ?> 320w,
                                <?php echo e($tab['bg']['sizes']['medium']); ?> 440w,
                                <?php echo e($tab['bg']['sizes']['medium_large']); ?> 740w,
                                <?php echo e($tab['bg']['url']); ?> 800w"
                        sizes="(max-width: 320px) 300px,
                               (max-width: 480px) 500px,
                               (max-width: 740px) 768px,
                               2200px"
                        alt="<?php echo e($tab['bg']['alt']); ?>"
                      >
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'spotlight'): ?>
        <?php if(!$loop->first && $content_sections[$loop->index - 1]->acf_fc_layout !== 'spotlight'): ?>
          <div class="SegmentSpotlightWrap">
        <?php endif; ?>

        <section class="Segment Segment--spotlight Segment--spotlight--<?php echo e($section->alignment); ?> <?php if (! ($section->heading_border)): ?> Segment--spotlight--no-heading-border <?php endif; ?>">
          <div class="Container">
            <div class="Segment__col Segment__col--left">
              <?php if($section->subheading): ?>
                <p class="Segment__subheading"><?php echo e($section->subheading); ?></p>
              <?php endif; ?>

              <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>

              <div class="Segment__content EditorContent">
                <?php echo $section->content; ?>

              </div>

              <?php if(isset($section->link->url, $section->link->title)): ?>
                <p class="Segment__button-link">
                  <a class="Button Button--yellow" href="<?php echo e($section->link->url); ?>">
                    <?php echo e($section->link->title); ?>

                  </a>
                </p>
              <?php endif; ?>
            </div>

            <div class="Segment__col Segment__col--right">
              <?php if($section->image): ?>
                <picture class="Segment__picture">
                  <source srcset="<?php echo e($section->image->url); ?>" media="(min-width: 64em)">
                  <source srcset="<?php echo e($section->image->sizes->large); ?>" media="(min-width: 52em)">
                  <source srcset="<?php echo e($section->image->sizes->medium_large); ?>" media="(min-width: 40em)">
                  <img
                    class="Segment__image"
                    srcset="<?php echo e($section->image->sizes->medium); ?>"
                    alt="<?php echo e($section->image->alt); ?>"
                  >
                </picture>
              <?php else: ?>
                <?php if ($__env->exists("partials.svgs.illustrations.{$section->illustration}")) echo $__env->make("partials.svgs.illustrations.{$section->illustration}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <?php if(!$loop->last): ?>
          <?php if($content_sections[$loop->index + 1]->acf_fc_layout !== 'spotlight'): ?>
            </div> <!--.SegmentSpoitlightWrap -->
          <?php endif; ?>
        <?php else: ?>
          </div> <!--.SegmentSpoitlightWrap -->
        <?php endif; ?>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'icon_grid'): ?>
        <section class="Segment Segment--icon-grid <?php if($section->bg_color): ?> Segment--<?php echo e($section->bg_color); ?> <?php endif; ?>">
          <div class="Container">
            <?php if($section->heading): ?>
              <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>
            <?php endif; ?>

            <?php if($section->subheading): ?>
              <p class="Segment__subheading"><?php echo e($section->subheading); ?></p>
            <?php endif; ?>

            <div class="IconGrid">
              <?php $__currentLoopData = $section->icon_grid_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="IconGrid__col">
                  <?php if($item->link): ?>
                    <a class="Card" href="<?php echo e($item->link); ?>">
                  <?php else: ?>
                    <div class="Card Card--non-link">
                  <?php endif; ?>
                    <h4 class="Card__heading"><?php echo e($item->heading); ?></h4>

                    <?php if($item->icon): ?>
                      <picture class="Card__icon Photo Photo--card">
                        <source srcset="<?php echo e($item->icon->url); ?>" media="(min-width: 64em)">
                        <source srcset="<?php echo e($item->icon->sizes->large); ?>" media="(min-width: 52em)">
                        <source srcset="<?php echo e($item->icon->sizes->medium_large); ?>" media="(min-width: 40em)">
                        <img class="Photo__img" src="<?php echo e($item->icon->sizes->medium); ?>" alt="<?php echo e($item->icon->alt); ?>" loading="lazy">
                      </picture>
                    <?php endif; ?>

                    <?php if($item->content): ?>
                      <div class="Card__content"><?php echo e($item->content); ?></div>
                    <?php endif; ?>

                    <?php if($item->link): ?>
                      <div class="Card__footer Button Button--yellow">
                        <?php echo e(__('Learn More', 'sage')); ?> <span class="Icon Icon--angle-right"></span>
                      </div>
                    <?php endif; ?>
                  <?php if($item->link): ?>
                    </a>
                  <?php else: ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'icon_list'): ?>
        <section class="Segment Segment--icon-list">
          <div class="Container">
            <?php echo $section->content; ?>


            <ul class="IconList">
              <?php $__currentLoopData = $section->icon_list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="IconList__item">
                  <div class="IconList__icon <?php echo e($item->icon); ?>"><?php if ($__env->exists("partials.svgs.{$item->icon}")) echo $__env->make("partials.svgs.{$item->icon}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>

                  <div class="IconList__content-wrap">
                    <h4 class="IconList__heading"><?php echo e($item->heading); ?></h4>
                    <div class="IconList__content"><?php echo e($item->content); ?></div>
                  </div>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'quotes'): ?>
        <section class="Segment Segment--quotes">
          <div class="Container">
            <figure class="Quote <?php if($section->bg_color): ?> Quote--<?php echo e($section->bg_color); ?> <?php endif; ?>">
              <blockquote class="Quote__content">
                <p><?php echo e($section->quote); ?></p>
              </blockquote>

              <figcaption class="Quote__caption">
                <span><?php echo e($section->author); ?></span>
              </figcaption>
            </figure>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'highlight'): ?>
        <section class="Segment Segment--highlight">
          <div class="Container">
            <div class="Highlight <?php if($section->bg_color): ?> Highlight--<?php echo e($section->bg_color); ?> <?php endif; ?>">
              <p><?php echo $section->content; ?></p>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'steps'): ?>
        <section class="Segment Segment--steps">
          <div class="Container">
            <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>

            <div class="StepsList">
              <?php $__currentLoopData = $section->steps_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="StepsList__item">
                  <div class="StepsList__content">
                    <h3 class="StepsList__heading"><?php echo $step->heading; ?></h3>
                    <p class="StepsList__desc"><?php echo e($step->description); ?></p>
                  </div>

                  <ul class="SlotList">
                    <?php $__currentLoopData = $step->page_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="SlotList__item">
                        <a class="SlotList__link" href="<?php echo e($link->link->url); ?>"><?php echo e($link->link->title); ?></a>
                      </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'stats'): ?>
        <section
          class="Segment Segment--stats
                 <?php if($section->bg_color): ?> Segment--<?php echo e($section->bg_color); ?> <?php endif; ?>
                "
        >
          <?php if(is_page('mesothelioma')): ?>
            <div class="Segment__bg">
              <?php echo $__env->make('partials.svgs.mesothelioma-page-waves', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
          <?php endif; ?>

          <div class="Container">
            <div class="Segment__col Segment__col--left">
              <?php if($section->statistic->type === 'normal'): ?>
                <div class="Statistic">
                  <div class="Statistic__figure"><?php echo e($section->statistic->number); ?></div>
                  <div class="Statistic__desc"><?php echo e($section->statistic->caption); ?></div>
                </div>
              <?php else: ?>
                <?php
                $offset = 339.292 * (1 - ($section->statistic->number / 100));
                ?>

                <div class="Percentage">
                  <div class="Percentage__text">
                    <div class="Percentage__figure"><?php echo e($section->statistic->number); ?>%</div>
                    <div class="Percentage__description"><?php echo e($section->statistic->caption); ?></div>
                  </div>

                  <svg class="Percentage__circle" viewBox="0 0 120 120">
                    <circle class="Percentage__circle__meter" cx="60" cy="60" r="54" stroke-width="6"></circle>
                    <circle class="Percentage__circle__value" cx="60" cy="60" r="54" stroke-width="8" style="stroke-dasharray: 339.292; stroke-dashoffset: <?php echo e($offset); ?>;"></circle>
                  </svg>
                </div>
              <?php endif; ?>
            </div>

            <div class="Segment__col Segment__col--right">
              <div class="Segment__content EditorContent">
                <?php echo $section->content; ?>

              </div>
            </div>
          </div>

          <?php if(is_page('veterans')): ?>
            <div class="Segment__bg">
              <?php if ($__env->exists('partials.svgs.navy-ship')) echo $__env->make('partials.svgs.navy-ship', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <svg class="Segment__wave Segment__wave--bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 75.7"><path d="M14.1,0L0,0l0,75.7h1440V14.4c-163.8,40.2-337.8,60.3-522.2,60.3C642.4,74.7,213.3,14.9,14.1,0z"/></svg>
            </div>
          <?php endif; ?>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'split'): ?>
        <section class="Segment Segment--split">
          <div class="Container">
            <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>
            <p class="Segment__subheading"><?php echo e($section->subheading); ?></p>

            <div class="SplitMenu">
              <div class="SplitMenu__col SplitMenu__col--left">
                <?php if($section->left->icon): ?>
                  <picture class="SplitMenu__bg Photo Photo--split-menu">
                    <source srcset="<?php echo e($section->left->icon->url); ?>" media="(min-width: 64em)">
                    <source srcset="<?php echo e($section->left->icon->sizes->large); ?>" media="(min-width: 52em)">
                    <source srcset="<?php echo e($section->left->icon->sizes->medium_large); ?>" media="(min-width: 40em)">
                    <img class="Photo__img" src="<?php echo e($section->left->icon->sizes->medium); ?>" alt="<?php echo e($section->left->icon->alt); ?>" loading="lazy">
                  </picture>
                <?php endif; ?>

                <h3 class="SplitMenu__heading"><?php echo $section->left->heading; ?></h3>

                <?php if($section->left->list): ?>
                  <ul class="SplitMenu__list">
                    <?php $__currentLoopData = $section->left->list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($item->item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>

                <a class="Button Button--yellow" href="<?php echo e($section->left->link->url); ?>"><?php echo $section->left->link->title; ?></a>
              </div>

              <div class="SplitMenu__col SplitMenu__col--right">
                <?php if($section->right->icon): ?>
                  <picture class="SplitMenu__bg Photo Photo--split-menu">
                    <source srcset="<?php echo e($section->right->icon->url); ?>" media="(min-width: 64em)">
                    <source srcset="<?php echo e($section->right->icon->sizes->large); ?>" media="(min-width: 52em)">
                    <source srcset="<?php echo e($section->right->icon->sizes->medium_large); ?>" media="(min-width: 40em)">
                    <img class="Photo__img" src="<?php echo e($section->right->icon->sizes->medium); ?>" alt="<?php echo e($section->right->icon->alt); ?>" loading="lazy">
                  </picture>
                <?php endif; ?>

                <h3 class="SplitMenu__heading"><?php echo $section->right->heading; ?></h3>

                <?php if($section->right->list): ?>
                  <ul class="SplitMenu__list">
                    <?php $__currentLoopData = $section->right->list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($item->item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>

                <a class="Button Button--yellow" href="<?php echo e($section->right->link->url); ?>"><?php echo $section->right->link->title; ?></a>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'card_stack'): ?>
        <section class="Segment Segment--card-stack">
          <div class="Container">
            <div class="Segment__content">
              <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>

              <?php echo $section->content; ?>

            </div>

            <div class="CardStack">
              <?php if($section->card_heading): ?>
                <h3 class="CardStack__heading"><?php echo e($section->card_heading); ?></h3>
              <?php endif; ?>

              <?php $__currentLoopData = $section->cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="Card">
                  <p class="Card__heading"><?php echo e($card->heading); ?></p>
                  <p class="Card__content"><?php echo e($card->caption); ?></p>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>

          <?php if($section->bg_graphics): ?>
            <svg class="Segment__waves" viewBox="0 0 1732.3 474.8"><path d="M620.2,473c-196.8,15.8-297.2-80.4-434.7-80.4C3,392.6,0,474.8,0,474.8h1732.3c0,0-50.3-474.8-510.8-474.8C804.6,0,816.9,457.2,620.2,473z"/></svg>
            <svg class="Segment__shapes" viewBox="0 0 1316 613.9"><path style="fill:#AEE1F6;" d="M1264,422.1c-0.4,0-0.7-0.1-1-0.4l-33.5-29.2c-0.4-0.4-0.6-0.9-0.5-1.4l8.5-43.6c0.1-0.5,0.5-1,1-1.1l42-14.5c0.5-0.2,1.1-0.1,1.5,0.3l33.5,29.2c0.4,0.4,0.6,0.9,0.5,1.4l-8.5,43.6c-0.1,0.5-0.5,1-1,1.1l-42,14.5C1264.4,422,1264.2,422.1,1264,422.1z M1232.1,390.8l32.2,28l40.4-13.9l8.2-41.9l-32.2-28l-40.4,13.9L1232.1,390.8z"/><path style="opacity:0.75;fill:#017BBB;" d="M657.4,391.1c-0.7,0-1.3-0.2-1.8-0.6l-85.1-66.5c-0.8-0.7-1.3-1.7-1.1-2.8l15-106.9c0.1-1.1,0.9-2,1.8-2.4l100.1-40.5c1-0.4,2.1-0.2,3,0.4l85.1,66.5c0.8,0.7,1.3,1.7,1.1,2.8l-15,106.9c-0.1,1.1-0.9,2-1.8,2.4l-100.1,40.5C658.2,391,657.8,391.1,657.4,391.1z M575.5,320.3l82.4,64.4l96.9-39.2l14.5-103.5L687,177.6l-96.9,39.2L575.5,320.3z"/><path style="opacity:0.75;fill:#017BBB;" d="M1019.5,263.7c-0.8,0-1.7-0.4-2.2-1L926.6,162c-0.7-0.8-1-1.9-0.6-2.9l41.9-128.9c0.3-1,1.2-1.8,2.2-2l132.5-28.2c1.1-0.2,2.1,0.1,2.9,0.9l90.7,100.7c0.7,0.8,1,1.9,0.6,2.9l-41.9,128.9c-0.3,1-1.2,1.8-2.2,2l-132.5,28.2C1019.9,263.7,1019.7,263.7,1019.5,263.7z M932.2,159.3l88.3,98.1l129.2-27.5l40.8-125.6l-88.3-98.1L973,33.7L932.2,159.3z"/><path style="opacity:0.75;fill:#017BBB;" d="M1030.3,230.5c-0.8,0-1.7-0.4-2.2-1l-67.2-74.7c-0.7-0.8-1-1.9-0.6-2.9l31.1-95.6c0.3-1,1.2-1.8,2.2-2l98.3-20.9c1.1-0.2,2.1,0.1,2.9,0.9l67.2,74.7c0.7,0.8,1,1.9,0.6,2.9l-31.1,95.6c-0.3,1-1.2,1.8-2.2,2l-98.3,20.9C1030.7,230.4,1030.5,230.5,1030.3,230.5z M966.4,152l64.9,72.1l94.9-20.2l30-92.3l-64.9-72.1l-94.9,20.2L966.4,152z"/><path style="opacity:0.75;fill:#017BBB;" d="M268.7,613.9c-0.1,0-0.1,0-0.2,0l-73.7-5.2c-1.1-0.1-2-0.7-2.5-1.7l-32.4-66.4c-0.5-1-0.4-2.1,0.2-3l41.3-61.2c0.6-0.9,1.6-1.4,2.7-1.3l73.7,5.2c1.1,0.1,2,0.7,2.5,1.7l32.4,66.4c0.5,1,0.4,2.1-0.2,3l-41.3,61.2C270.6,613.4,269.7,613.9,268.7,613.9z M196.9,602.9l70.2,4.9l39.4-58.4l-30.9-63.3l-70.2-4.9l-39.4,58.4L196.9,602.9z"/><path style="fill:#AEE1F6;" d="M570.5,610.9c-0.4,0-0.8-0.2-1.1-0.5l-30.3-32.5c-0.4-0.4-0.5-0.9-0.3-1.5l13-42.5c0.2-0.5,0.6-0.9,1.1-1l43.3-10c0.5-0.1,1.1,0,1.4,0.4l30.3,32.5c0.4,0.4,0.5,0.9,0.3,1.5l-13,42.5c-0.2,0.5-0.6,0.9-1.1,1l-43.3,10C570.7,610.9,570.6,610.9,570.5,610.9z M541.9,576.5l29.1,31.2l41.6-9.6l12.5-40.8L596,526.1l-41.6,9.6L541.9,576.5z"/><path style="fill:#AEE1F6;" d="M27.6,526.4c-0.3,0-0.6-0.1-0.9-0.3L0.6,506.4c-0.4-0.3-0.7-0.8-0.6-1.4l4-32.5c0.1-0.5,0.4-1,0.9-1.2L35,458.6c0.5-0.2,1.1-0.1,1.5,0.2l26.1,19.7c0.4,0.3,0.7,0.8,0.6,1.4l-4,32.5c-0.1,0.5-0.4,1-0.9,1.2l-30.1,12.8C28,526.3,27.8,526.4,27.6,526.4z M3.1,504.5l24.7,18.6l28.5-12.1l3.8-30.8l-24.7-18.6L6.9,473.8L3.1,504.5z"/><path style="fill:#AEE1F6;" d="M414.6,521.4c-0.3,0-0.6-0.1-0.9-0.3l-26.1-19.7c-0.4-0.3-0.7-0.8-0.6-1.4l4-32.5c0.1-0.5,0.4-1,0.9-1.2l30.1-12.8c0.5-0.2,1.1-0.1,1.5,0.2l26.1,19.7c0.4,0.3,0.7,0.8,0.6,1.4l-4,32.5c-0.1,0.5-0.4,1-0.9,1.2l-30.1,12.8C415,521.3,414.8,521.4,414.6,521.4z M390.1,499.5l24.7,18.6l28.5-12.1l3.8-30.8l-24.7-18.6l-28.5,12.1L390.1,499.5z"/></svg>
          <?php endif; ?>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'card_grid'): ?>
        <section class="Segment Segment--card-grid">
          <div class="Container">
            <div class="Segment__content">
              <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>

              <?php echo $section->content; ?>

            </div>

            <div class="CardGrid">
              <?php $__currentLoopData = $section->cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="CardGrid__col">
                  <div class="Card">
                    <p class="Card__heading"><?php echo e($card->heading); ?></p>
                    <div class="Card__content EditorContent"><?php echo $card->caption; ?></div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>

          <svg class="Segment__waves" viewBox="0 0 1440 625">
            <path d="M195,574.9c304.9,2.9,339.3-146.7,533.6-252.5c170.8-93,408-102.6,711.4-29V0H0v625C52.8,590.9,117.8,574.2,195,574.9z"/>
          </svg>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'single_video'): ?>
        <section class="Segment Segment--single-video">
          <div class="Container">
            <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>
            <p class="Segment__subheading"><?php echo e($section->subheading); ?></p>

            <div class="Segment__video-frame responsive-embed widescreen">
              <iframe
                src="<?php echo e($section->video); ?>"
                frameborder="0"
                allow="accelerometer; encrypted-media; gyroscope"
                allowfullscreen
              ></iframe>
            </div>

            <p class="Segment__description"><?php echo e($section->description); ?></p>
          </div>
        </section>
      <?php endif; ?>

      <?php if($section->acf_fc_layout === 'video_grid'): ?>
        <section class="Segment Segment--video-grid">
          <div class="Container">
            <h3 class="Segment__heading"><?php echo e($section->heading); ?></h3>
            <p class="Segment__subheading"><?php echo e($section->subheading); ?></p>

            <div class="VideoGrid">
              <?php $__currentLoopData = $section->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="VideoGrid__item">
                  <?php if($video->thumbnail): ?>
                    <a class="VideoGrid__thumbnail-link" href="<?php echo e($video->url); ?>">
                      <picture class="VideoGrid__thumbnail Photo Photo--video-grid">
                        <source srcset="<?php echo e($video->thumbnail->url); ?>" media="(min-width: 64em)">
                        <source srcset="<?php echo e($video->thumbnail->sizes->large); ?>" media="(min-width: 52em)">
                        <source srcset="<?php echo e($video->thumbnail->sizes->medium_large); ?>" media="(min-width: 40em)">
                        <img class="Photo__img" src="<?php echo e($video->thumbnail->sizes->medium); ?>" alt="<?php echo e($video->thumbnail->alt); ?>" loading="lazy">
                      </picture>
                    </a>
                  <?php endif; ?>

                  <h3 class="VideoGrid__heading"><?php echo e($video->title); ?></h3>
                  <p class="VideoGrid__desc"><?php echo e($video->description); ?></p>
                  <p class="VideoGrid__link"><a class="Button Button--primary" href="<?php echo e($video->url); ?>" target="_blank"><?php echo e(__('Watch on YouTube', 'sage')); ?></a></p>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </section>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/segments.blade.php ENDPATH**/ ?>