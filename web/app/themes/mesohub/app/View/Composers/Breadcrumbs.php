<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Breadcrumbs extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.breadcrumbs'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'breadcrumbs' => $this->breadcrumbs(),
        ];
    }

    /**
     * Get Yoast SEO breadcrumb links into an object
     * to allow for more customizability in views.
     *
     * @see https://yoast.com/help/implement-wordpress-seo-breadcrumbs/
     *
     * @return array
     */
    public function breadcrumbs()
    {
        $crumbs = [];
        $type   = get_post_type();

        if (function_exists('yoast_breadcrumb')) {
            /**
             * Get all links before the current page.
             * @see https://www.php.net/manual/en/class.domdocument.php
             */
            $dom = new \DOMDocument();
            $dom->loadHTML(yoast_breadcrumb('', '', false));
            $items = $dom->getElementsByTagName('a');

            foreach ($items as $tag) {
                $crumbs[] = (object) [
                    'text' => $tag->nodeValue,
                    'href' => $tag->getAttribute('href'),
                ];
            }

            /**
             * Get current page text and href.
             * @see https://www.php.net/manual/en/class.domxpath.php
             */
            $items  = new \DOMXPath($dom);
            $dom    = $items->query('//*[contains(@class, "breadcrumb_last")]');
            $text   = $dom->item(0)->nodeValue;
            $prefix = get_option('wpseo_titles')
                      ? get_option('wpseo_titles')['breadcrumbs-archiveprefix']
                      : '';

            if (is_author()) {
                $text = 'Author: ' . str_replace($prefix, '', $dom->item(0)->nodeValue);
            }

            if ($type === 'reviewer') {
                $text = 'Medical Reviewer: ' . $dom->item(0)->nodeValue;
            }

            $crumbs[] = (object) [
                'text' => $text,
                'href' => trailingslashit(home_url(esc_url_raw(add_query_arg([])))),
            ];
        }

        return $crumbs;
    }
}
