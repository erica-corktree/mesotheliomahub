<?php

/**
 * Theme admin.
 */

namespace App;

use WP_Customize_Manager;

use function Roots\asset;
use function \Sober\Intervention\intervention;

/**
 * Register the `.brand` selector to the blogname.
 *
 * @param  \WP_Customize_Manager $wp_customize
 * @return void
 */
add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector'        => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Register the customizer assets.
 *
 * @return void
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset('scripts/customizer.js')->uri(), ['customize-preview'], null, true);
});

/**
 * Clean up, clean up...
 */
if (function_exists('\Sober\Intervention\intervention')) {
    intervention('add-svg-support');
    intervention('remove-emoji');
    intervention('remove-help-tabs');
    intervention('remove-howdy');
    intervention('remove-menu-items', ['comments'], 'all');
    intervention('remove-page-components', 'comments', 'all');
    intervention('remove-post-components', 'comments', 'all');
    intervention('remove-taxonomies', ['tag'], 'all');
    intervention('remove-toolbar-items', ['customize', 'logo',], 'all');
    intervention('update-label-footer');
    intervention('update-pagination', 100);
}
