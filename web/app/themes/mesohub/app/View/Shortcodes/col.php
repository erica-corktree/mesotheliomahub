<?php

namespace App\View\Shortcodes;

use function App\parse_shortcode_content;
use function Roots\view;

/**
 * Columns
 * Used within [row] or [grid] shortcodes.
 *
 * @param array|string $atts    The shortcode attributes
 * @param string       $content The enclosed content
 *
 * @return String
 */
add_shortcode('col', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'span' => '',
    ], $atts));

    $content = parse_shortcode_content($content);
    $span    = !empty($span) ? $span : '1';

    return view('shortcodes.col', [
        'content' => $content,
        'span'    => $span,
    ]);
});
