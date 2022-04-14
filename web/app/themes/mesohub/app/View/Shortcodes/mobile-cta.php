<?php

namespace App\View\Shortcodes;

use function App\get_widget_data;
use function Roots\view;

/**
 * Mobile-only CTAs that use sidebar widgets
 *
 * @return String
 */
add_shortcode('mobile-cta', function ($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'number' => '',
    ], $atts));

    $theCTA    = false;
    $widgetIDs = false;
    $ctaNumber = false;
    $output    = '';

    switch (get_post_type()) {
        case 'page':
            $widgetIDs = get_widget_data('Primary');
            break;
        case 'post':
            $widgetIDs = get_widget_data('Post');
            break;
    }

    $ctaNumber = (!empty($number) && ((int) $number > 0))
                 ? (int) $number - 1
                 : 0;

    $ctaName = $widgetIDs[$ctaNumber]->className;
    $ctaID   = $widgetIDs[$ctaNumber]->ID;

    return view('shortcodes.mobile-cta', [
        'ctaName' => $ctaName,
        'ctaID'   => $ctaID,
    ]);
});
