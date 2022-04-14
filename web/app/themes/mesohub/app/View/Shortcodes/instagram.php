<?php

namespace App\View\Shortcodes;

use function Roots\view;

/**
 * Instagram feed
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('instagram', function ($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'account' => '',
        'count'   => '',
    ], $atts));

    return view('shortcodes.instagram', [
        'account' => $account,
        'count'   => $count,
    ]);
});
