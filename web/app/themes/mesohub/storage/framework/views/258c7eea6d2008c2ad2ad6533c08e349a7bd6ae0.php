<header class="PageHeader <?php if(is_singular('post')): ?> PageHeader--blog-post <?php endif; ?>">
  <div class="Container">
    <div class="PageHeader__content">
      <?php if(is_singular('post')): ?>
        <div class="Breadcrumbs">
          <p id="breadcrumbs">
            <a href="/blog"><?php echo e(__('Back to Blog', 'sage')); ?></a>
          </p>
        </div>
      <?php elseif(function_exists('yoast_breadcrumb')
               && !is_page_template('views/template-about-page.blade.php')
               && !is_page_template('views/template-parent-page.blade.php')
               && !is_page_template('views/template-landing-page.blade.php')): ?>
        <div class="Breadcrumbs">
          <?php yoast_breadcrumb('<p id="breadcrumbs">','</p>') ?>
        </div>

        <?php if(isset($parent_page) && !empty($parent_page)): ?>
          <div class="Breadcrumbs Breadcrumbs--parent">
            <p>
              <a href="<?php echo e(get_the_permalink($parent_page->ID)); ?>">
                <span aria-hidden="true">&lsaquo;</span> <?php echo e(get_the_title($parent_page->ID)); ?>

              </a>
            </p>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <h1>
        <?php if(isset($banner->title)): ?>
          <?php echo $banner->title; ?>

        <?php else: ?>
          <?php echo $title; ?>

        <?php endif; ?>
      </h1>

      <?php if(is_singular('post')): ?>
        <div class="PageHeader__meta">
          <p class="PageHeader__author"><?php echo e(__('By', 'sage')); ?> <a href="<?php echo e(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"><?php echo e(get_the_author()); ?></a></p>

          <time
            class="PageHeader__time"
            datetime="<?php echo e(get_post_time('c', true, get_the_ID())); ?>"
          >
            <?php echo e(get_the_date(null, get_the_ID())); ?>

          </time>

          <?php if($categories): ?>
            <ul class="PageHeader__categories">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="PageHeader__categories__item">
                  <a
                    class="PageHeader__categories__link"
                    href="<?php echo e(esc_url(get_category_link($category->term_id))); ?>"
                    itemprop="keywords"
                  >
                    <?php echo e(esc_html($category->name)); ?><?php if (! ($loop->last)): ?><?php echo e(','); ?><?php endif; ?>
                  </a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          <?php endif; ?>
        </div>

        <?php echo $__env->make('partials.share-tools', ['class' => 'ShareTools--PageHeader'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php elseif(isset($banner->subtitle)): ?>
        <?php echo $banner->subtitle; ?>

      <?php endif; ?>
    </div>

    <?php echo $__env->make('partials.page-header-illustration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</header>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/page-header.blade.php ENDPATH**/ ?>