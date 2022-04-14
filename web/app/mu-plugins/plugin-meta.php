<?php

/**
 * Plugin Name: Plugin Meta
 * Plugin URI:  https://github.com/recoveryworldwide/plugin-meta
 * Description: Meta package for commonly used WordPress plugins.
 * Version:     1.0.0
 * Author:      Recovery Worldwide
 * Author URI:  https://github.com/recoveryworldwide
 * Licence:     MIT
 */

namespace App\PluginMeta;

add_action('plugins_loaded', new class
{
    /**
     * Invoke the plugin.
     *
     * @return void
     */
    public function __invoke()
    {
        /**
         * Disable unnecessary ACF Extended modules.
         *
         * @return boolean
         */
        foreach([
            'acf/settings/acfe/modules/dynamic_post_types',
            'acf/settings/acfe/modules/dynamic_taxonomies',
            'acf/settings/acfe/modules/dynamic_forms',
            'acf/settings/acfe/modules/dynamic_options_pages',
            'acf/settings/acfe/modules/dynamic_block_types',
            'acf/settings/acfe/modules/author',
            'acf/settings/acfe/modules/taxonomies',
            'acf/settings/acfe/modules/options',
            'acf/settings/acfe/dev'
        ] as $filter) {
            add_filter($filter, '__return_false');
        };

        /**
         * Remove the EditorsKit and CoBlocks getting started screens.
         *
         * @return bool
         */
        foreach(['blockopts_welcome_cap', 'coblocks_getting_started_screen_capability'] as $filter) {
            add_filter($filter, '__return_false');
        }

        /**
         * Move User Activity to Settings -> Activity
         *
         * @param array $default
         *
         * @return array
         */
        add_filter('wp_user_activity_get_post_type_args', function ($default) {
            return array_merge($default, [
                'labels'       => ['all_items' => 'Activity'] + $default['labels'],
                'show_in_menu' => 'users.php'
            ]);
        });

        /**
         * Remove the UpdraftPlus admin bar item.
         *
         * @return void
         */
        add_filter('init', function () {
            if (defined('UPDRAFTPLUS_ADMINBAR_DISABLE')) {
                return;
            }

            define('UPDRAFTPLUS_ADMINBAR_DISABLE', true);
        });

        /**
         * Fix the role capability for Better Search Replace.
         *
         * @return string
         */
        add_filter('bsr_capability', function () {
            return 'manage_options';
        });

        /**
         * Make WP User Profiles stop being naughty.
         *
         * @return void
         */
        remove_filter('wp_user_profiles_show_other_section', 'wp_user_profiles_has_profile_actions');

        /**
         * Remove metaboxes created by Related Posts for WordPress.
         *
         * @return void
         */
        add_action('do_meta_boxes', function () {
            remove_meta_box('rp4wp_metabox_related_posts', get_post_types(), 'normal');
            remove_meta_box('rp4wp_metabox_exclude_post', get_post_types(), 'side');
        });

        /**
         * Disable unwanted default functionality of Related Posts for WordPress.
         *
         * @return void
         */
        add_filter('rp4wp_append_content', '__return_false');
        add_filter('rp4wp_disable_css', '__return_true');

        /**
         * Change the WordPress login header to the blog name
         *
         * @return string
         */
        add_filter('login_headertext', function () {
            return get_bloginfo('name');
        });

        /**
         * Lower WordPress SEO's Metabox Priority
         *
         * @return string
         */
        add_filter('wpseo_metabox_prio', function () {
            return 'low';
        });

        /**
         * Disable Yoast's hidden "love letter" about using the plugin.
         *
         * @return void
         */
        // add_action('template_redirect', function () {
        //     if (!class_exists('WPSEO_Frontend')) {
        //         return;
        //     }

        //     $instance = \WPSEO_Frontend::get_instance();

        //     // Ensure a future version of Yoast does break the site.
        //     if (!method_exists($instance, 'debug_mark')) {
        //         return;
        //     }

        //     // Remove the "love letter".
        //     remove_action('wpseo_head', [$instance, 'debug_mark'], 2);
        // }, 9999);

        /**
         * Changes oEmbed YouTube URLs from youtube.com to youtube-nocookie.com in favor of GDPR.
         *
         * @return string
         */
        add_action('oembed_result', function ($searchString, $url) {
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
         * Remove automatic update check from site health
         *
         * @param array $tests
         *
         * @return array
         */
        add_filter('site_status_tests', function ($tests) {
            unset($tests['direct']['theme_version']);
            unset($tests['async']['background_updates']);
            return $tests;
        });

        /**
         * Remove some dashboard panels from WP admin
         *
         * @return void
         */
        add_action('admin_menu', function () {
            remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Remove "Activity" which includes "Recent Comments"
            remove_meta_box('dashboard_primary', 'dashboard', 'core'); // Remove "WordPress Events and News"
            remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Remove "Quick Draft"
            remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Remove "At a Glance"
            remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal'); // Remove "Yoast SEO Posts Overview"
        });


        /**
         * Remove Gutenberg's admin menu item.
         *
         * @return void
         */
        remove_filter('admin_menu', 'gutenberg_menu');

        /**
         * Disable page caching in WP Rocket on non-production enviornments.
         */
        if (defined('WP_ENV') && WP_ENV !== 'production') {
            add_filter('do_rocket_generate_caching_files', '__return_false');
        }
    }
});
