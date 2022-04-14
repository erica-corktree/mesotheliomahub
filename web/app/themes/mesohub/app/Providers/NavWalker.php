<?php

namespace App;

/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="Menu__item-8" class="Menu__item Menu__item-type-post_type Menu__item-object-page Menu__item-8"><a href="/">Home</a></li>
 *   <li id="Menu__item-9" class="Menu__item Menu__item-type-post_type Menu__item-object-page Menu__item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * NavWalker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 *
 * You can enable/disable this feature in functions.php (or lib/setup.php if you're using Sage):
 * add_theme_support('soil-nav-walker');
 */
class NavWalker extends \Walker_Nav_Menu {
    private $cpt; // Boolean, is current post a custom post type
    private $archive; // Stores the archive page for current URL
    private $currentItem;
    private $itemID;
    private $currentItemSubtitle;
    private $currentItemFeaturedImg;

    public function __construct()
    {
        add_filter('nav_menu_css_class', array($this, 'cssClasses'), 10, 2);
        add_filter('nav_menu_item_id', '__return_null');

        $cpt           = get_post_type();
        $this->cpt     = in_array($cpt, get_post_types(array('_builtin' => false)));
        $this->archive = get_post_type_archive_link($cpt);
    }

    public function checkCurrent($classes)
    {
        return preg_match('/(current[-_])|active/', $classes);
    }

    // @codingStandardsIgnoreStart
    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->is_subitem = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

        if ($element->is_subitem) {
            foreach ($children_elements[$element->ID] as $child) {
                if ($child->current_item_parent || $this->urlCompare($this->archive, $child->url)) {
                    $element->classes[] = 'Menu__item--active';
                }
            }
        }

        $element->is_active = (!empty($element->url) && strpos($this->archive, $element->url));

        if ($element->is_active) {
            $element->classes[] = 'Menu__item--active';
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    // @codingStandardsIgnoreEnd

    function start_lvl(&$output, $depth = 0, $args = [])
    {
        $indent    = str_repeat("\t", $depth);
        $permalink = $this->currentItem->url;
        $title     = $this->currentItem->title;

        if ($depth === 0 && !isset($args->mobile)) {
            $output .= "
                \n$indent
                  <ul
                    class=\"Menu__submenu\"
                    id=\"{$this->itemID}\"
                  >\n
            ";
        } else {
          $output .= "
              \n$indent
              <ul
                class=\"Menu__submenu\"
                id=\"{$this->itemID}\"
              >\n";
        }
    }

    function end_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);

        if ($depth === 0 && !isset($args->mobile)) {
            $output .= "$indent</ul>\n";
        } else {
            $output .= "$indent</ul>\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $this->currentItem = $item;
        $this->itemID = uniqid(sanitize_title($item->title) . '__');

        parent::start_el($output, $item, $depth, $args, $id);

        if ($item->is_subitem && isset($args->mobile)) {
            $output .= "
                <button
                  class=\"Menu__toggle-btn\"
                  aria-controls=\"{$this->itemID}\"
                  aria-expanded=\"false\"
                >
                  <span class=\"visually-hidden\">Show Submenu</span>
                  <span class=\"Icon Icon--angle-down\"></span>
                </button>
            ";
        }
    }

    public function cssClasses($classes, $item)
    {
        $slug = sanitize_title($item->title);

        // Fix core `active` behavior for custom post types
        if ($this->cpt) {
          $classes = str_replace('current_page_parent', '', $classes);

          if ($this->archive) {
            if ($this->urlCompare($this->archive, $item->url)) {
              $classes[] = 'Menu__item--active';
            }
          }
        }

        // Remove most core classes
        $classes = preg_replace(
            '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/',
            'Menu__item--active',
            $classes
        );

        $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

        // Re-add core `Menu__item` class
        $classes[] = 'Menu__item';

        // Re-add core `Menu__item-has-children` class on parent elements
        if ($item->is_subitem) {
          $classes[] = 'Menu__item--has-children';
        }

        // Add `menu-<slug>` class
        $classes[] = 'Menu__item--' . $slug;

        $classes = array_unique($classes);
        $classes = array_map('trim', $classes);

        return array_filter($classes);
    }

    /**
     * Make a URL relative
     *
     * Utility function, from soil
     * @url https://github.com/roots/soil
     *
     * @param $input
     *
     * @return string
     */
    public function rootRelativeUrl($input)
    {
        if (is_feed()) {
            return $input;
        }

        $url = parse_url($input);

        if (!isset($url['host']) || !isset($url['path'])) {
          return $input;
        }

        $site_url = parse_url(network_home_url());  // falls back to home_url

        if (!isset($url['scheme'])) {
            $url['scheme'] = $site_url['scheme'];
        }

        $hosts_match   = $site_url['host'] === $url['host'];
        $schemes_match = $site_url['scheme'] === $url['scheme'];
        $ports_exist   = isset($site_url['port']) && isset($url['port']);
        $ports_match   = ($ports_exist) ? $site_url['port'] === $url['port'] : true;

        if ($hosts_match && $schemes_match && $ports_match) {
            return wp_make_link_relative($input);
        }

        return $input;
    }

    /**
     * Compare URL against relative URL
     *
     * Utility function, from Soil
     * @url https://github.com/roots/soil
     *
     * @param $url
     * @param $rel
     *
     * @return bool
     */
    public function urlCompare($url, $rel)
    {
        $url = trailingslashit($url);
        $rel = trailingslashit($rel);

        return ((strcasecmp($url, $rel) === 0) || $this->rootRelativeUrl($url) == $rel);
    }
}

/**
 * [rootRelativeUrl description]
 *
 * @param [type] $input [description]
 *
 * @return [type] [description]
 */
function rootRelativeUrl($input)
{
    if (is_feed()) {
        return $input;
    }

    $url = parse_url($input);

    if (!isset($url['host']) || !isset($url['path'])) {
      return $input;
    }

    $site_url = parse_url(network_home_url());  // falls back to home_url

    if (!isset($url['scheme'])) {
        $url['scheme'] = $site_url['scheme'];
    }

    $hosts_match   = $site_url['host'] === $url['host'];
    $schemes_match = $site_url['scheme'] === $url['scheme'];
    $ports_exist   = isset($site_url['port']) && isset($url['port']);
    $ports_match   = ($ports_exist) ? $site_url['port'] === $url['port'] : true;

    if ($hosts_match && $schemes_match && $ports_match) {
        return wp_make_link_relative($input);
    }

    return $input;
}

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Remove the id="" on nav menu items
 */
function nav_menu_args($args = '') {
    $nav_menu_args = [];
    $nav_menu_args['container'] = false;

    if (!$args['items_wrap']) {
      $nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
    }

    if (!$args['walker']) {
      $nav_menu_args['walker'] = new NavWalker();
    }

    return array_merge($args, $nav_menu_args);
}

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\\nav_menu_args');
add_filter('nav_menu_item_id', '__return_null');
