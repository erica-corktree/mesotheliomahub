<?php

namespace App\Controllers\Partials;

trait ChildPages
{
  /**
   * [formatPages description]
   *
   * @param [type] $childPages [description]
   *
   * @return array
   */
  private function formatPages($childPages)
  {
    $pageIndex      = 0;
    $formattedPages = [];

    foreach ($childPages as $page) {
      $pageSubIndex   = 0;

      $grandChildren = get_posts([
        'post_parent'    => $page->ID,
        'orderby'        => 'menu_order',
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_status' => 'publish',
      ]);

      $formattedPages[] = [
        'id'       => $page->ID,
        'url'      => get_the_permalink($page->ID),
        'title'    => get_the_title($page->ID),
        'children' => [],
        'childIds' => [],
      ];

      if ($grandChildren) {
        foreach ($grandChildren as $child) {

          $grandGrandChildren = get_posts([
            'post_parent'    => $child->ID,
            'orderby'        => 'menu_order',
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'post_status' => 'publish',
          ]);

          $formattedPages[$pageIndex]['children'][] = [
            'id'    => $child->ID,
            'url'   => get_the_permalink($child->ID),
            'title' => get_the_title($child->ID),
            'children' => [],
            'childIds' => [],
          ];

          if ($grandGrandChildren) {
            foreach ($grandGrandChildren as $grandChild) {

              $formattedPages[$pageIndex]['children'][$pageSubIndex]['children'][] = [
                'id'    => $grandChild->ID,
                'url'   => get_the_permalink($grandChild->ID),
                'title' => get_the_title($grandChild->ID),
              ];

              $formattedPages[$pageIndex]['children'][$pageSubIndex]['childIds'][] = $grandChild->ID;
              $formattedPages[$pageIndex]['childIds'][] = $grandChild->ID;
            }
          }
          $pageSubIndex++;
          $formattedPages[$pageIndex]['childIds'][] = $child->ID;
        }
      }

      $pageIndex++;
    }

    return $formattedPages;
  }

  /**
   * Get content sections
   *
   * @return array The content sections
   */
  public function childPages()
  {
    global $post;

    $index          = 0;
    $formattedPages = [];
    $parents        = get_post_ancestors($post->ID);
    $parentId       = ($parents) ? $parents[count($parents) - 1]: $post->ID;
    $childPages     = get_posts([
      'post_parent'    => $post->ID,
      'orderby'        => 'menu_order',
      'post_type'      => 'page',
      'posts_per_page' => -1,
      'post_status' => 'publish',
    ]);

    if ($childPages && !$parents) {
      $formattedPages = $this->formatPages($childPages);
    } else {
      $childPages = get_posts([
        'post_parent'    => $parentId,
        'orderby'        => 'menu_order',
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_status' => 'publish',
      ]);

      if ($childPages) {
        $formattedPages = $this->formatPages($childPages);
      }
    }

    return $formattedPages;
  }
}
