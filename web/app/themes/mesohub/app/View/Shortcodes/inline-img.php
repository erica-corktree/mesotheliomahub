<?php

namespace App\View\Shortcodes;

use function App\parse_shortcode_content;
use function Roots\view;

/**
 * Inline image
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('inline-img', function ($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'src'   => '',
        'alt'   => '',
        'align' => '',
    ], $atts));

    $content = parse_shortcode_content($content);

    return view('shortcodes.inline-img', [
        'content' => $content,
        'align'   => !empty($align) ? $align : 'left',
        'src'     => !empty($src) ? $src : false,
        'alt'     => !empty($alt) ? $alt : '',
    ]);
});
