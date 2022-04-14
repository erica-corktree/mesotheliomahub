<div class="BlogPosts">
  <div class="BlogPosts__filters">
    <div class="Dropdown">
      <button class="Dropdown__button">
        <span class="Dropdown__button__text"><?php echo e(__('Filter by Category', 'sage')); ?></span>
        <span class="Icon Icon--angle-down"></span>
      </button>

      <ul class="Dropdown__menu">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="Dropdown__menu__item">
            <a class="Dropdown__menu__link" href="/blog/category/<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>

    <div class="Dropdown Dropdown--right">

      <ul class="Dropdown__menu">
        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="Dropdown__menu__item">
            <a class="Dropdown__menu__link" href="/blog/author/<?php echo e($author->user_login); ?>"><?php echo e($author->display_name); ?></a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  </div>

  <?php if(!have_posts()): ?>
    <div class="Alert">
      <?php echo e(__('Sorry, no results were found.', 'sage')); ?>

    </div>

    <?php echo $__env->make('partials.search-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <?php while(have_posts()): ?> <?php the_post() ?>
    <?php
    $categories = get_the_terms(get_the_ID(), 'category');
    ?>

    <article class="Card Card--blog-post">
      <div class="Card__col Card__col--left">
        <header class="Card__header">
          <h2 class="Card__heading"><a href="<?php echo e(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h2>

          <?php echo $__env->make('partials.entry-meta', [
            'terms' => get_the_terms(get_the_ID(), 'category'),
          ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php if($categories): ?>
            <ul class="Card__cat-list">
              <li><b><?php echo e(__('Categories:', 'sage')); ?></b></li>

              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a
                    href="<?php echo e(esc_url(get_category_link($category->term_id))); ?>"
                    itemprop="keywords"
                  ><?php echo e($category->name); ?></a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          <?php endif; ?>
        </header>

        <div class="Card__content">
          <?php if(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)): ?>
            <?php echo e(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)); ?>

          <?php else: ?>
            <?php echo get_the_excerpt(); ?>

          <?php endif; ?>
        </div>
      </div>

      <div class="Card__col Card__col--right">
        <div class="Card__img-link" href="<?php echo e(get_permalink()); ?>">
          <picture>
            <source srcset="<?php echo e(get_the_post_thumbnail_url(null, 'full')); ?>" media="(min-width: 64em)">
            <source srcset="<?php echo e(get_the_post_thumbnail_url(null, 'large')); ?>" media="(min-width: 52em)">
            <source srcset="<?php echo e(get_the_post_thumbnail_url(null, 'medium_large')); ?>" media="(min-width: 40em)">
            <img class="Card__img" srcset="<?php echo e(get_the_post_thumbnail_url(null, 'medium')); ?>" alt="">
          </picture>
          </div>

        <a class="Button Button--small Button--primary" href="<?php echo e(get_permalink()); ?>"><?php echo e(__('Read More', 'sage')); ?></a>
      </div>
    </article>
  <?php endwhile; ?>

  <?php echo App\numeric_pagination(); ?>

</div>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/blog-posts.blade.php ENDPATH**/ ?>