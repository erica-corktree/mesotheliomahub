<?php
$id    = $id ?? get_the_ID();
$class = $class ?? '';
?>

<div class="ShareTools <?php echo e($class); ?> ">
  <div class="ShareTools__col">
    <div class="ShareTools__share-wrap">
      <button class="Button Button--share" data-toggle="ShareTools<?php echo e($id); ?>">
        <span class="Icon Icon--external-link"></span>
        <span class="Button__text"><?php echo e(__('Share', 'sage')); ?></span>
      </button>

      <div class="Tooltip" id="ShareTools<?php echo e($id); ?>" data-toggler=".js-opened">
        <button class="Tooltip__close" data-toggle="ShareTools<?php echo e($id); ?>">
          <span class="Icon Icon--close"></span>
        </button>

        <p class="Tooltip__heading"><?php echo e(__('Share', 'sage')); ?></p>
        <p class="Tooltip__subheading"><?php echo get_the_title($id); ?></p>

        <ul class="Tooltip__list">
          <?php $__currentLoopData = App\shareLinks($id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <a class="Button Button--icon" href="<?php echo e($link['url']); ?>">
                <span class="Icon Icon--<?php echo e($name); ?>"></span>
                <span class="Button__text"><?php echo e(__($link['label'], 'sage')); ?></span>
              </a>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/share-tools.blade.php ENDPATH**/ ?>