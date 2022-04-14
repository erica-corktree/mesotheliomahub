<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <header class="PageHeader">
      <div class="Container">
        <div class="PageHeader__content">
          <h1>
            <?php if(isset($banner->title)): ?>
              <?php echo e($banner->title); ?>

            <?php else: ?>
              <?php echo e($title); ?>

            <?php endif; ?>
          </h1>
        </div>

        <?php echo $__env->make('partials.page-header-illustration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </header>

    <div class="Container">
      <div class="Glossary">
        <div class="Glossary__button-wrap">
          <button
            class="Glossary__toggle-button Button Button--outline-dark"
            data-toggle="GlossaryLettersWrap"
          ><?php echo e(__('Skip to Letter')); ?> <span class="Icon Icon--angle-down"></span></button>

          <div class="Glossary__letters-wrap" id="GlossaryLettersWrap" data-toggler=".js-active">
            <ul class="Glossary__letters" data-magellan data-offset="150">
              <?php $__currentLoopData = $glossary_terms_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="Glossary__letters__item">
                  <a class="Glossary__letters__link" href="#<?php echo e($letter->letter); ?>terms"><?php echo e($letter->letter); ?></a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>

        <?php $__currentLoopData = $glossary_terms_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div
            class="Glossary__term"
            id="<?php echo e($letter->letter); ?>terms"
            data-magellan-target="<?php echo e($letter->letter); ?>terms"
          >
            <h2 class="Glossary__term__heading"><?php echo e($letter->letter); ?></h2>

            <dl class="Glossary__term-list">
              <?php $__currentLoopData = $letter->terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="Glossary__term-list__item">
                  <dt class="Glossary__term-list__name"><?php echo e($term->name); ?></dt>
                  <dd class="Glossary__term-list__description">
                    <?php echo e($term->description); ?>


                    <?php if($term->child_terms): ?>
                      <dl class="Glossary__term-list">
                        <?php $__currentLoopData = $term->child_terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="Glossary__term-list__item">
                            <dt class="Glossary__term-list__name"><?php echo e($child_term->name); ?></dt>
                            <dd class="Glossary__term-list__description">
                              <?php echo e($child_term->description); ?>

                            </dd>
                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </dl>
                    <?php endif; ?>
                  </dd>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </dl>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <?php echo $__env->make('partials.footer-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/template-glossary-page.blade.php ENDPATH**/ ?>