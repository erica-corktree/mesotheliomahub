<?php

namespace App\View\Shortcodes;

use function App\parse_shortcode_content;
use function Roots\view;

/**
 * Row
 *
 * @param array|string $atts    The shortcode attributes
 * @param string       $content The enclosed content
 *
 * @return String
 */
add_shortcode('row', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'count' => '',
        'class' => '',
    ], $atts));

    $count   = !empty($count) ? $count : '3';
    $class   = !empty($class) ? $class : '';
    $content = !empty($content) ? parse_shortcode_content($content) : '';

    return view('shortcodes.row', [
        'count'   => $count,
        'class'   => $class,
        'content' => $content,
    ]);
});
