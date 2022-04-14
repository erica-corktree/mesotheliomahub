<?php

namespace App\View\Shortcodes;

/**
 * Outputs the current year e.g. 2020
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('year', function ($atts = [], $content = null) {
    return date('Y');
});
