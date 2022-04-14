<?php

namespace App;

/**
 * Simple function to pretty up our field partial includes.
 *
 * @link https://roots.io/guides/using-acf-builder-with-sage/
 *
 * @param mixed $partial
 * @return mixed
 */
function get_field_partial($partial)
{
    $partial = str_replace('.', '/', $partial);

    return include(get_theme_file_path('/app') . "/Fields/{$partial}.php");
}

/**
 * This function will return an array of attachment data
 *
 * @param mixed $post either post ID or post object
 * @return array
 */
function get_image_data($attachment)
{
    // get post
    if (!$attachment = get_post($attachment)) {
        return false;
    }

    // validate post_type
    if ($attachment->post_type !== 'attachment') {
        return false;
    }

    $sizes_id       = 0;
    $meta           = wp_get_attachment_metadata($attachment->ID);
    $attached_file  = get_attached_file($attachment->ID);
    $attachment_url = wp_get_attachment_url($attachment->ID);

    // get mime types
    if (strpos($attachment->post_mime_type, '/') !== false) {
        list($type, $subtype) = explode('/', $attachment->post_mime_type);
    } else {
        list($type, $subtype) = [$attachment->post_mime_type, ''];
    }

    $response = [
        'ID'          => $attachment->ID,
        'id'          => $attachment->ID,
        'title'       => $attachment->post_title,
        'filename'    => wp_basename($attached_file),
        'filesize'    => 0,
        'url'         => $attachment_url,
        'link'        => get_attachment_link($attachment->ID),
        'alt'         => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'author'      => $attachment->post_author,
        'description' => $attachment->post_content,
        'caption'     => $attachment->post_excerpt,
        'name'        => $attachment->post_name,
        'status'      => $attachment->post_status,
        'uploaded_to' => $attachment->post_parent,
        'date'        => $attachment->post_date_gmt,
        'modified'    => $attachment->post_modified_gmt,
        'menu_order'  => $attachment->menu_order,
        'mime_type'   => $attachment->post_mime_type,
        'type'        => $type,
        'subtype'     => $subtype,
        'icon'        => wp_mime_type_icon($attachment->ID),
    ];

    if (isset($meta['filesize'])) {
        $response['filesize'] = $meta['filesize'];
    } elseif (file_exists($attached_file)) {
        $response['filesize'] = filesize($attached_file);
    }

    if ($type === 'image') {
        $sizes_id           = $attachment->ID;
        $src                = wp_get_attachment_image_src($attachment->ID, 'full');
        $response['url']    = $src[0];
        $response['width']  = $src[1];
        $response['height'] = $src[2];
    } elseif ($type === 'video') {
        $response['width']  = $meta['width']  ?? 0;
        $response['height'] = $meta['height'] ?? 0;

        // featured image
        if ($featured_id = get_post_thumbnail_id($attachment->ID)) {
            $sizes_id = $featured_id;
        }
    } elseif ($type === 'audio') {
        // featured image
        if ($featured_id = get_post_thumbnail_id($attachment->ID)) {
            $sizes_id = $featured_id;
        }
    }

    if ($sizes_id) {
        $sizes = get_intermediate_image_sizes();
        $data = array();

        foreach ($sizes as $size) {
            $src = wp_get_attachment_image_src($sizes_id, $size);
            $data[$size] = $src[0];
            $data[$size . '-width'] = $src[1];
            $data[$size . '-height'] = $src[2];
        }

        // append
        $response['sizes'] = $data;
    }

    return $response;
}

/**
 * Outputs the_widget() as a string.
 *
 * @param [type] $widget
 * @param string $instance
 * @param string $args
 * @return string
 */
function get_the_widget($widget, $instance = '', $args = '')
{
    ob_start();
    the_widget($widget, $instance, $args);

    return ob_get_clean();
}

/**
 * Get widget data for a sidebar
 *
 * @param string $sidebarName The registered sidebar name.
 * @return array|object
 */
function get_widget_data($sidebarName)
{
    global $wp_registered_sidebars, $wp_registered_widgets;

    $output = [];
    $sidebarID = false;

    foreach ($wp_registered_sidebars as $sidebar) {
        if ($sidebar['name'] === $sidebarName) {
            $sidebarID = $sidebar['id'];
            break;
        }
    }

    if (!$sidebarID) {
        return $output;
    }

    // A nested array in the format $sidebar_id => array( 'widget_id-1', 'widget_id-2' ... );
    $sidebarsWidgets = wp_get_sidebars_widgets();
    $widgetIDs = $sidebarsWidgets[$sidebarID];

    if (!$widgetIDs) {
        // Without proper widget_ids we can't continue.
        return [];
    }

    // Loop over each widget_id so we can fetch the data out of the wp_options table.
    foreach ($widgetIDs as $id) {
        $output[] = (object) [
            'ID' => $id,
            'className' => get_class($wp_registered_widgets[$id]['callback'][0]),
        ];
    }

    return $output;
}

/**
 * Parses shortcode content to handle extra p tags and what not
 *
 * @param string $content The unprocessed shortcode content
 *
 * @return string The processed shortcode content
 */
function parse_shortcode_content($content)
{
    // Parse nested shortcodes and add formatting.
    $content = wpautop(do_shortcode(trim($content)));

    /* Remove '</p>' from the start of the string. */
    if (substr($content, 0, 4) === '</p>') {
        $content = substr($content, 4);
    }

    /* Remove '<p>' from the end of the string. */
    if (substr($content, -3, 3 ) === '<p>') {
        $content = substr($content, 0, -3);
    }

    /* Remove any instances of '<p></p>'. */
    $content = str_replace(['<p></p>'], '', $content);

    return $content;
}

/**
 * Get a page's ID by its slug
 *
 * @param string $slug The page slug
 *
 * @return int The page ID
 */
function get_id_by_slug($slug = '')
{
    $page = get_page_by_path($slug);

    return ($page) ? $page->ID : null;
}

/**
 * Is the current page a certain page or a child of it?
 *
 * @param int|string $id Page ID or slug
 * @return boolean
 */
function is_tree($id)
{
    global $post;

    if (!is_numeric($id)) {
        $page = get_page_by_path($id);
        $id   = $page->ID;
    }

    if (is_page() && ($post->post_parent == $id || (is_page($id) || in_array($id, $post->ancestors)))) {
        return true;
    } else {
        return false;
    }
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;

    isset($display) || $display = apply_filters('sage/display_sidebar', false);

    return $display;
}

/**
 * Loads template parts as a string instead of as an include
 *
 * @param string      $slug The slug name for the generic template.
 * @param string|null $name The name of the specialized template.
 *
 * @return string|false The template part
 */
function load_template_part($name, $part = null)
{
    ob_start();

    get_template_part($name, $part);

    $part = ob_get_contents();

    ob_end_clean();

    return $part;
}

/**
 * Log data in the browser console
 *
 * @param [any] $data
 *
 * @return [void]
 */
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode( $data ) . ')';
    echo '</script>';
}

/**
 * Numeric pagination
 *
 * @param int $page Page number
 *
 * @return string The numeric pagination
 */
function numeric_pagination($page = 2)
{
    if (is_singular()) {
        return;
    }

    global $wp_query;

    /* Stop the code if there is only a single page page */
    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);

    /*Add current page into the array */
    if ( $paged >= 1 ) {
        $links[] = $paged;
    }

    /*Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    $pagination = "<ul class=\"Pagination\">";

    /*Display Previous Post Link */
    if (get_previous_posts_link()) {
        $pagination .= '<li class="Pagination__item Pagination__item--prev">' . get_previous_posts_link('Prev') . '</li>';
    }

    /*Display Link to first page*/
    if (!in_array(1, $links)) {
        $class = (1 == $paged)
                 ? ' class="Pagination__item Pagination__item--active"'
                 : ' class="Pagination__item"';

        $pagination .= "<li{$class}><a href=\"" . esc_url(get_pagenum_link(1)) . "\">1</a></li>";

        if (!in_array(2, $links)) {
            $pagination .= '<li class="Pagination__item">…</li>';
        }
    }

    /* Link to current page */
    sort($links);

    foreach ((array) $links as $link) {
        $class = ($paged == $link)
                 ? ' class="Pagination__item Pagination__item--active"'
                 : ' class="Pagination__item"';

        $pagination .= "<li{$class}><a href=\"" . esc_url(get_pagenum_link($link)) . "\">{$link}</a></li>";
    }

    /* Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            $pagination .= '<li class="Pagination__item Pagination__item--unavailable"><a href="#" disabled>&hellip;</a></li>' . "\n";
        }

        $class = ($paged == $max)
                 ? ' class="Pagination__item Pagination__item--active"'
                 : ' class="Pagination__item"';

        $pagination .= "<li{$class}><a href=\"" . esc_url(get_pagenum_link($max)) . "\">{$max}</a></li>";
    }

    /** Next Post Link */
    if ( get_next_posts_link() ) {
        $pagination .= '<li class="Pagination__item Pagination__item--next">' . get_next_posts_link('Next') . '</li>';
    }

    $pagination .= '</ul>' . "\n";

    return $pagination;
}

function hasChildPages()
{
    if (!is_page()) {
        return false;
    }

    $children = get_pages(['child_of' => $GLOBALS['post']->ID]);

    return (count($children) > 0);
}

function shareLinks($id = null)
{
    $title     = htmlspecialchars(urlencode(get_the_title($id)));
    $permalink = htmlspecialchars(urlencode(get_the_permalink($id)));
    $excerpt   = htmlspecialchars(urlencode(@get_the_excerpt($id)));

    $socialLinks = [
        'facebook' => [
            'url'  => "https://www.facebook.com/sharer/sharer.php?text={$title}&amp;u={$permalink}",
            'label' => 'Facebook',
        ],
        'twitter' => [
            'url'  => "https://twitter.com/intent/tweet?counturl={$permalink}&amp;text={$title}&amp;url={$permalink}&amp;via=meso_hub",
            'label' => 'Twitter',
        ],
        'linkedin' => [
            'url'  => "https://www.linkedin.com/shareArticle?mini=true&url={$permalink}&summary={$excerpt}",
            'label' => 'LinkedIn',
        ],
    ];

    return $socialLinks;
}
