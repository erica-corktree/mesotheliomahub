<?php

namespace App\View\Shortcodes;

use function App\{get_image_data, parse_shortcode_content};
use function Roots\view;

/**
 * In-content CTA
 *
 * @param array|string $atts    The shortcode attributes
 * @param string       $content The enclosed content
 *
 * @return String
 */
add_shortcode('in-content-cta', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'align' => '',
        'bg'    => '',
        'photo' => '',
    ], $atts));

    $content = parse_shortcode_content($content);

    return view('shortcodes.in-content-cta', [
        'content' => $content,
        'align'   => ($align) ? "CTA--in-content-{$align}" : '',
        'bg'      => ($bg) ? "CTA--in-content-{$bg}" : '',
        'photo'   => ($photo) ? get_image_data((int) $photo) : false,
    ]);
});
