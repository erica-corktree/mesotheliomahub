<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Blog extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'home',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'authors'          => @json_decode(json_encode(get_users(['exclude' => [1, 2]]))),
            'blog'             => @json_decode(json_encode(get_field('blog', 3))),
            'categories'       => @json_decode(json_encode(get_categories(['orderby' => 'name', 'order' => 'ASC']))),
            'popular_articles' => @json_decode(json_encode(get_field('blog_popular_articles', get_option('page_for_posts', true)))),
        ];
    }
}
