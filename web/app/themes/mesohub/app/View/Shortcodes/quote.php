<?php

namespace App\View\Shortcodes;

use function App\parse_shortcode_content;
use function Roots\view;

/**
 * Outputs a quote
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('quote', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'name'     => '',
        'subtitle' => '',
        'cite'     => '',
    ], $atts));

    $content = parse_shortcode_content($content);

    return view('shortcodes.quote', [
        'content'  => $content,
        'name'     => ($name) ? $name : false,
        'subtitle' => ($subtitle) ? $subtitle : false,
        'cite'     => ($cite) ? $cite : '',
    ]);
});
