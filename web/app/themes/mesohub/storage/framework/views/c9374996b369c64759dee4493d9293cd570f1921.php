<?php if (! (App\is_tree('about-us'))): ?>
  <?php $author = "user_{$GLOBALS['post']->post_author}"; ?>
  <?php $reviewer = get_field('medical_reviewer'); ?>
<!--googleoff: index-->
  <footer class="ContentFooter">
    <div class="ContentFooter__section">
      <a class="UserLink" data-toggle="Author" role="button">
        <?php if(get_field('author_photo', $author)): ?>
          <img
            class="UserLink__img"
            src="<?php echo e(get_field('author_photo', $author)['sizes']['small']); ?>"
            alt="<?php echo e(__('Photo of', 'sage')); ?> <?php echo e(get_the_author()); ?>"
          >
        <?php endif; ?>

        <span class="UserLink__info">
          <span class="UserLink__label"><?php echo e(__('Author', 'sage')); ?></span>
          <span class="UserLink__name"><?php echo e(get_the_author()); ?></span>

          <?php if(get_field('author_title', $author)): ?>
            <span class="UserLink__title">
              <?php echo e(get_field('author_title', $author)); ?>

            </span>
          <?php endif; ?>
        </span>

        <span class="Icon Icon--UserLink Icon--plus"></span>
      </a>

      <div
        class="ContentFooter__author-about ContentFooter__section__content"
        id="Author"
        data-toggler=".js-expanded"
      >
        <?php echo get_the_author_meta('description'); ?>

      </div>
    </div>

    <?php if($reviewer): ?>
      <div class="ContentFooter__section">
        <a class="UserLink" data-toggle="Reviewer" role="button">
          <?php if(has_post_thumbnail($reviewer)): ?>
            <img
              class="UserLink__img"
              src="<?php echo e(get_the_post_thumbnail_url($reviewer, 'thumbnail')); ?>"
              alt="<?php echo e(__('Photo of', 'sage')); ?> <?php echo e(get_the_title($reviewer)); ?>"
            >
          <?php endif; ?>

          <span class="UserLink__info">
            <span class="UserLink__label"><?php echo e(__('Reviewer', 'sage')); ?></span>
            <span class="UserLink__name"><?php echo e(get_the_title($reviewer)); ?></span>
            <span class="UserLink__title">
              <?php echo e(__('Last Reviewed:')); ?> <?php echo e($medical_review_date); ?>

            </span>
          </span>

          <span class="Icon Icon--UserLink Icon--plus"></span>
        </a>

        <div
          class="ContentFooter__author-about ContentFooter__section__content"
          id="Reviewer"
          data-toggler=".js-expanded"
        >
          <?php echo get_the_content(null, false, $reviewer); ?>

        </div>
      </div>
    <?php endif; ?>

    <?php if(get_field('citations')): ?>
      <div class="ContentFooter__section">
        <p class="ContentFooter__section__heading">
          <a
            data-toggle="Citations"
            role="button"
          >
            <?php echo e(__('Sources', 'sage')); ?>

          </a>
        </p>

        <div
          class="ContentFooter__section__content ContentFooter__citations"
          id="Citations"
          data-toggler=".js-expanded"
        >
          <?php echo get_field('citations'); ?>

        </div>
      </div>
    <?php endif; ?>

    <?php if (! (is_singular('post'))): ?>
      <div class="ContentFooter__nav">
        <?php if($GLOBALS['post']->post_parent): ?>
          <?php echo previous_post_link('%link', '
            <span class="Icon Icon--angle-left"></span>
            <span class="ContentFooter__nav__text-wrap">
              <span class="ContentFooter__nav__label ContentFooter__nav__label--prev">
                Previous Page
              </span>
              <span class="ContentFooter__nav__text">%title</span>
            </span>
          '); ?>

        <?php endif; ?>

        <?php echo next_post_link('%link', '
          <span class="ContentFooter__nav__text-wrap">
            <span class="ContentFooter__nav__label ContentFooter__nav__label--next">
              Next Page
            </span>
            <span class="ContentFooter__nav__text">%title</span>
          </span>
          <span class="Icon Icon--angle-right"></span>
        '); ?>

      </div>
    <?php endif; ?>
  </footer>
  <!--googleon: index-->
<?php endif; ?>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/page-footer.blade.php ENDPATH**/ ?>