<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use PostTypes\PostType;

use function Roots\app;
use function Roots\asset;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    global $wp_query;

    wp_enqueue_script('sage/vendor.js', asset('scripts/vendor.js')->uri(), ['jquery'], null, true);
    wp_enqueue_script('sage/app.js', asset('scripts/app.js')->uri(), ['sage/vendor.js', 'jquery'], null, true);

    wp_add_inline_script('sage/vendor.js', asset('scripts/manifest.js')->contents(), 'before');

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('sage/main.js', 'wpVars', [
        'env'          => WP_ENV,
        'maxNumPages'  => $wp_query->max_num_pages,
        'currentPage'  => get_query_var('paged') ?: 1,
        'postsPerPage' => get_option('posts_per_page'),
        'currentCount' => $wp_query->post_count,
        'totalCount'   => $wp_query->found_posts,
        'isSearch'     => $wp_query->is_search,
        'formMessages' => [
          'thank_you_guide' => get_field('site_guide_form', 'option')['thank_you_guide'],
          'thank_you_legal' => get_field('site_guide_form', 'option')['thank_you_legal'],
          'error'           => get_field('site_guide_form', 'option')['error'],
        ],
        'postType'     => (isset($wp_query->post->post_type) && $wp_query->post->post_type !== '')
                          ? $wp_query->post->post_type
                          : 'post',
    ]);

    wp_dequeue_style('wp-block-library');
    wp_enqueue_style('sage/app.css', asset('styles/app.css')->uri(), false, null);
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    if ($manifest = asset('scripts/manifest.asset.php')->get()) {
        wp_enqueue_script('sage/vendor.js', asset('scripts/vendor.js')->uri(), $manifest['dependencies'], null, true);
        wp_enqueue_script('sage/editor.js', asset('scripts/editor.js')->uri(), ['sage/vendor.js'], null, true);

        wp_add_inline_script('sage/vendor.js', asset('scripts/manifest.js')->contents(), 'before');
    }

    wp_enqueue_style('sage/editor.css', asset('styles/editor.css')->uri(), false, null);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Custom Post Types with PostType library
     * @link https://github.com/jjgrainger/PostTypes
     */
    $events = new PostType('event', [
        'public'              => false, // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable'  => false, // you shouldn't be able to query it
        'show_ui'             => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus'   => false, // you shouldn't be able to add it to menus
        'has_archive'         => true,  // it shouldn't have archive page
        'rewrite'             => false, // it shouldn't have rewrite rules
    ]);
    $reviewer = new PostType('reviewer', [
        'public'              => true,  // it is public, it should have it's own permalink, and so on
        'publicly_queryable'  => true,  // you should be able to query it
        'show_ui'             => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus'   => false, // you shouldn't be able to add it to menus
        'has_archive'         => false, // it shouldn't have archive page
        'rewrite'             => true,  // it shoul have rewrite rules
        'show_in_rest'        => true,  // it should be queriable via the REST API
        'menu_position'       => 70,    // it should be after the "Users" tab
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'custom-fields',
        ],
    ]);

    // Post type icons
    $events->icon('dashicons-calendar-alt');
    $reviewer->icon('dashicons-admin-users');

    // Register the post types
    $events->register();
    $reviewer->register();

    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation'          => __('Primary Navigation', 'sage'),
        'mesothelioma_menu'           => __('Mesothelioma Menu', 'sage'),
        'treatment_menu'              => __('Treatment Menu', 'sage'),
        'veterans_menu'               => __('Veterans Menu', 'sage'),
        'legal_menu'                  => __('Legal Menu', 'sage'),
        'community_menu'              => __('Community  Menu', 'sage'),
        'footer_navigation'           => __('Footer Navigation', 'sage'),
        'footer_secondary_navigation' => __('Footer Secondary Navigation', 'sage'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Additional image sizes
     */
    add_image_size('small', 300, 300, false);

    /**
     * Add theme support for Wide Alignment
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#wide-alignment
     */
    add_theme_support('align-wide');

    /**
     * Enable responsive embeds
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Enable theme color palette support
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
     */
    add_theme_support('editor-color-palette', [
        [
            'name'  => __('Primary', 'sage'),
            'slug'  => 'primary',
            'color' => '#525ddc',
        ]
    ]);

    /**
     * Register shortcodes
     */
    collect(glob(get_theme_file_path('/app') . '/View/Shortcodes/*.php'))->map(function ($shortcode) {
        return require_once $shortcode;
    });

    /**
     * Allows editors access to the "Appearance" tab
     */
    $editorRole = get_role('editor');
    $editorRole->add_cap('edit_theme_options');

    /**
     * Enable ACF options page
     * @link https://www.advancedcustomfields.com/resources/options-page/
     */
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug'  => 'theme-options',
            'capability' => 'edit_posts',
            'redirect'   => false
        ]);

        acf_add_options_sub_page(array(
            'page_title'  => 'Theme CTA Options',
            'menu_title'  => 'CTA Options',
            'parent_slug' => 'theme-options',
        ));
    }
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<div class="Widget %2$s" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="Widget__title">',
        'after_title'   => '</h4>',
    ];

    register_sidebar([
        'name'          => __('Pages', 'sage'),
        'id'            => 'sidebar-pages'
    ] + $config);

    require_once dirname(__FILE__) . '/Widgets/BoxWidget.php';
    require_once dirname(__FILE__) . '/Widgets/CTAWidget.php';
    require_once dirname(__FILE__) . '/Widgets/InfoWidget.php';
    require_once dirname(__FILE__) . '/Widgets/ListWidget.php';
    require_once dirname(__FILE__) . '/Widgets/SliderWidget.php';
    require_once dirname(__FILE__) . '/Widgets/PhoneNumberCTAWidget.php';
});
