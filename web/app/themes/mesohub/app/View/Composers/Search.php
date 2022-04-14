<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Search extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'search',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'results_count' => $this->resultsCount(),
        ];
    }

    /**
     * Search results count.
     *
     * @return String
     */
    public function resultsCount()
    {
        global $wp_query;

        return $wp_query->found_posts;
    }
}
