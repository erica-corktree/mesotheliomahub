<?php

namespace App;

use function Roots\app;
use function Roots\asset;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Standard body class */
    $classes[] = 'SiteBody';

    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = 'Page';
            $classes[] = basename(get_permalink());
        }
    }

    if (is_front_page()) {
        $classes[] = 'FrontPage';
    }

    if (is_page() && !get_the_post_thumbnail_url()) {
        $classes[] = 'Page--no-banner-bg';
    }

    if (is_page_template('views/template-about-page.blade.php')) {
        $classes[] = 'AboutPage';
    }

    if (is_page_template('views/template-events-page.blade.php')) {
        $classes[] = 'EventsPage';
    }

    if (is_page_template('views/template-glossary-page.blade.php')) {
        $classes[] = 'GlossaryPage';
    }

    if (is_page_template('views/template-guide-page.blade.php')) {
        $classes[] = 'GuidePage';
    }

    if (is_page_template('views/template-landing-page.blade.php')) {
        $classes[] = 'LandingPage';
    }

    if (is_page_template('views/template-legal-page.blade.php')) {
        $classes[] = 'LegalPage';
    }

    if (is_page() && is_page_template('views/template-parent-page.blade.php')) {
        $classes[] = 'Page--parent';
    } elseif (is_page() && !is_front_page()) {
        $classes[] = 'Page--child';
    }

    if (is_search()) {
        $classes[array_search('search', $classes)] = 'Search';
    }

    if (is_singular('post')) {
        $classes[array_search('single-post', $classes)] = 'SinglePost';
    }

    if (is_home() || is_category() || is_author()) {
        $classes[array_search('blog', $classes)] = 'Blog';
    }

    if (is_category()) {
        $classes[array_search('category', $classes)] = 'Category';
    }

    if (is_author()) {
        $classes[array_search('author', $classes)] = 'Author';
    }

    /** Announcement banner is active */
    if (get_field('site_announcement_banner_toggle', 'option')) {
        $classes[] = 'SiteBody--announcement-active';
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'SidebarVisible';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Remove jQuery Migrate
 *
 * @param \WP_Scripts $scripts
 *
 * @return void
 */
add_filter('wp_default_scripts', function (&$scripts) {
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, ['jquery-core'], '1.12.4');
    }
});

/**
 * Decrease the order priority of the YoastSEO meta box
 *
 * @return string
 */
add_filter('wpseo_metabox_prio', function () {
    return 'low';
});

/**
 * Enable the sidebar
 *
 * @var bool $display Whether the sidebar should be displayed or not
 *
 * @return bool
 */
add_filter('sage/display_sidebar', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
        (is_page() || is_home() || is_singular('post') || is_category() || is_author())
        && !is_front_page()
        && !is_page_template('views/template-landing-page.blade.php')
        && !is_page_template('views/template-about-page.blade.php')
        && !is_page('views/template-glossary-page.blade.php'),
    ]);

    if (is_page_template('views/template-parent-page.blade.php') && !hasChildPages()) {
        $display = false;
    }

    return $display;
});

/**
 * Changes oEmbed YouTube URLs from youtube.com to youtube-nocookie.com in favor of GDPR.
 *
 * @var string $searchString
 * @var string $url
 *
 * @return string
 */
add_filter('embed_oembed_html', function ($searchString, $url) {
    if (preg_match('#https?://(www\.)?youtube\.com#i', $searchString)) {
        $searchString = preg_replace(
            '#(https?:)?//(www\.)?youtube\.com#i',
            '$1//$2youtube-nocookie.com',
            $searchString
        );
    }

    return $searchString;
}, 10, 2);

/**
 * Remove unnecessary ACF Extended features
 *
 * @see /wp-admin/edit.php?post_type=acf-field-group&page=acf-tools
 * @link https://github.com/acf-extended/ACF-Extended/blob/master/acf-extended.php#L48
 * @link https://www.acf-extended.com/features
 *
 * @return boolean
 */
add_filter('acf/settings/acfe/modules/dynamic_post_types', '__return_false');
add_filter('acf/settings/acfe/modules/dynamic_taxonomies', '__return_false');
add_filter('acf/settings/acfe/modules/dynamic_forms', '__return_false');
add_filter('acf/settings/acfe/modules/dynamic_options_pages', '__return_false');
add_filter('acf/settings/acfe/modules/dynamic_block_types', '__return_false');
add_filter('acf/settings/acfe/modules/author', '__return_false');
add_filter('acf/settings/acfe/modules/taxonomies', '__return_false');
add_filter('acf/settings/acfe/modules/options', '__return_false');

/**
 * Return the compiled blade template path for acfe_flexible_render_template
 *
 * @return string
 */
// add_filter('acfe/flexible/render/template', function ($template, $field, $layout, $is_preview) {
//     return App\template_path(locate_template($template));
// }, 10, 4);

// acf/update_value/key={$field_key} - filter for a specific field based on it's name
add_filter('acf/update_value/key=field_page_page_hero_photo', function ($value, $post_id, $field) {
    if ($value != '' && get_post_type() === 'page') {
        // Add the value which is the image ID to the _thumbnail_id meta data for the current post
        update_post_meta($post_id, '_thumbnail_id', $value);
    }

    return $value;
}, 1, 3);

/**
 * Adds necessary attributes to recaptcha script
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 *
 * @return string
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {
	if ($handle === 'google/recaptcha') {
		if (stripos($tag, 'async') === false) {
			$tag = str_replace(' src', ' async="async" src', $tag);
		}

		if (stripos($tag, 'defer') === false) {
			$tag = str_replace('<script ', '<script defer ', $tag);
		}
	}

	return $tag;
}, 10, 3);

/**
 * [add_filter description]
 *
 * @var [type]
 */
add_filter('image_size_names_choose', function ($sizes) {
    return array_merge($sizes, ['small' => __('Small', 'sage')]);
});

/**
 * [add_filter description]
 * @var [type]
 */
add_filter('get_next_post_sort', function ($sort) {
    $sort = 'ORDER BY p.menu_order ASC LIMIT 1';

    return $sort;
});

/**
 * [add_filter description]
 * @var [type]
 */
add_filter('get_next_post_where', function ($where) {
    global $post, $wpdb;

    $where = $wpdb->prepare("WHERE p.menu_order > '%s' AND p.post_type = 'page' AND p.post_status = 'publish'", $post->menu_order);

    return $where;
});

/**
 * [add_filter description]
 * @var [type]
 */
add_filter('get_previous_post_sort', function ($sort) {
    $sort = 'ORDER BY p.menu_order DESC LIMIT 1';

    return $sort;
});

/**
 * [add_filter description]
 * @var [type]
 */
add_filter('get_previous_post_where', function ($where) {
    global $post, $wpdb;

    $where = $wpdb->prepare("WHERE p.menu_order < '%s' AND p.post_type = 'page' AND p.post_status = 'publish'", $post->menu_order);

    return $where;
});

/**
 * Filter events from search
 *
 * @param bool    $should_index Should Algolia index this post?
 * @param WP_Post $post The post
 *
 * @return bool
 */
add_filter('algolia_should_index_searchable_post', function (bool $should_index, \WP_Post $post) {
    $excludedPostTypes = [
        'event',
    ];

    if ($should_index === false) {
        return $should_index;
    }

    return !in_array($post->post_type, $excludedPostTypes, true);
}, 10, 2);

/**
 * Filters events archive
 */
add_action('pre_get_posts', function ($query) {
    global $wp_post_statuses;

    if (is_admin() || !$query->is_main_query()) {
        return $query;
    }

    // if (is_page('events')) {
    //     $query->set('order', 'ASC');
    //     $wp_post_statuses['future']->public = true;
    // }

    return $query;
});
