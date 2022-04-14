<aside
  class="Sidebar"
  itemscope
  itemtype="http://schema.org/WPSideBar"
>
  <?php if(is_page() && isset($child_pages)): ?>
    <nav class="PageNav">
      <h3 class="PageNav__heading">
        <a href="<?php echo e(get_the_permalink($top_level_parent->ID)); ?>"><?php echo e($top_level_parent->post_title); ?></a>
      </h3>

      <ul class="PageNav__menu">
        <?php $__currentLoopData = $child_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <?php if($id === $page['id']): ?>
            <li class="PageNav__menu-item PageNav__menu-item--active">
          <?php elseif(in_array($id, $page['childIds'])): ?>
            <li class="PageNav__menu-item" aria-expanded="true">
          <?php else: ?>
            <li class="PageNav__menu-item">
          <?php endif; ?>
            <a class="PageNav__link" href="<?php echo e($page['url']); ?>"><?php echo $page['title']; ?></a>

            <?php if(in_array($id, $page['childIds'])): ?>
              <button
                class="PageNav__expand"
                aria-haspopup="true"
                aria-expanded="false"
              ><span class="Icon"></span></button>
            <?php elseif($page['children']): ?>
                <button
                  class="PageNav__expand"
                  aria-haspopup="true"
                  aria-expanded="true"
                ><span class="Icon"></span></button>
            <?php endif; ?>

            <?php if($page['children']): ?>
              <?php if(in_array($id, $page['childIds'])): ?>
                <ul class="PageNav__sub-menu js-expanded" aria-hidden="false">
              <?php else: ?>
                <ul class="PageNav__sub-menu" aria-hidden="true">
              <?php endif; ?>
                <?php $__currentLoopData = $page['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($id === $child['id']): ?>
                    <li class="PageNav__menu-item PageNav__menu-item--active">
                  <?php elseif(in_array($id, $child['childIds'])): ?>
                    <li class="PageNav__menu-item" aria-expanded="true">
                  <?php else: ?>
                    <li class="PageNav__menu-item">
                  <?php endif; ?>

                  <a class="PageNav__link" href="<?php echo e($child['url']); ?>"><?php echo $child['title']; ?></a>

                  <?php if(in_array($id, $child['childIds'])): ?>
                    <button
                    class="PageNav__expand"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><span class="Icon"></span></button>
                  <?php elseif($child['children']): ?>
                    <button
                      class="PageNav__expand"
                      aria-haspopup="true"
                      aria-expanded="true"
                    ><span class="Icon"></span></button>
                  <?php endif; ?>

                    <?php if($child['children']): ?>
                      <?php if(in_array($id, $child['childIds'])): ?>
                        <ul class="PageNav__sub-menu js-expanded" aria-hidden="false">
                      <?php else: ?>
                        <ul class="PageNav__sub-menu" aria-hidden="true">
                      <?php endif; ?>
                        <?php $__currentLoopData = $child['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($id === $sub_child['id']): ?>
                            <li class="PageNav__menu-item PageNav__menu-item--active">
                          <?php else: ?>
                            <li class="PageNav__menu-item">
                          <?php endif; ?>

                            <a class="PageNav__link" href="<?php echo e($sub_child['url']); ?>"><?php echo $sub_child['title']; ?></a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    <?php endif; ?>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </nav>
  <?php elseif(is_singular('post') || is_home() || is_category() || is_author()): ?>
    <nav class="PageNav">
      <h3 class="PageNav__heading"><a href="#">Popular Articles</a></h3>

      <?php if($popular_articles): ?>
        <ul class="PageNav__menu" role="tree">
          <?php $__currentLoopData = $popular_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="PageNav__menu-item" role="treeitem">
              <a href="<?php echo e(get_the_permalink($article->ID)); ?>"><?php echo e(get_the_title($article->ID)); ?></a>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </nav>
  <?php endif; ?>

  <a class="Widget Widget--cta" id="PageGuideCTAWidget" href="https://www.mesotheliomahub.com/legal-help/receive-a-case-evaluation/">
    <div class="Widget__content" style="text-align:center">
        <img src="https://www.mesotheliomahub.com/app/uploads/2022/02/case-eval.png" width="100px" style="margin:0 auto">
        <h4 class="Widget__title">Fill out a Free Mesothelioma Case Evaluation Form Here</h2>
      <span class="Button Button--primary" href="https://www.mesotheliomahub.com/legal-help/receive-a-case-evaluation/">Free Case Evaluation</span>
    </div>
  </a>
</aside>
<?php /**PATH /www/mesotheliomahub_583/public/current/web/app/themes/mesohub/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>