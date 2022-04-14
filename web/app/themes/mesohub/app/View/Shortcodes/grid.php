<?php

namespace App\View\Shortcodes;

use function App\parse_shortcode_content;
use function Roots\view;

/**
 * Grid
 *
 * @param array|string $atts    The shortcode attributes
 * @param string       $content The enclosed content
 *
 * @return String
 */
add_shortcode('grid', function ($atts = [], $content = null) {
    $atts = shortcode_atts([
        'col-count' => '',
    ], $atts);

    $content = parse_shortcode_content($content);

    return view('shortcodes.grid', [
        'content'   => $content,
        'col_count' => $atts['col-count'] ?? '',
    ]);
});
