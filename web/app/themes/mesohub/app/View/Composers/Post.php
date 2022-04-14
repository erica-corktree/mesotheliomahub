<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Pagi\PagiFacade as Pagi;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'home',
        'partials.content',
        'partials.content-*',
        'partials.hero',
        'partials.hero-*',
        'partials.page-header',
        'partials.page-hero',
        'partials.pagination',
        'template-*',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'hero'       => $this->hero(),
            'next'       => $this->next(),
            'pagi'       => $this->pagination(),
            'prev'       => $this->prev(),
            'slug'       => $this->slug(),
            'title'      => $this->title(),
            'categories' => $this->categories(),
            'popular_articles' => @json_decode(json_encode(
                get_field('blog_popular_articles', get_option('page_for_posts', true))
            )),
        ];
    }

    /**
     * [categories description]
     *
     * @return [type] [description]
     */
    public function categories()
    {
        return get_the_terms(get_the_ID(), 'category');
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        $type   = get_post_type();
        $fields = isset($type) ? get_field($type) : false;

        if (isset($fields['hero']['heading']) && !empty($fields['hero']['heading'])) {
            return $fields['hero']['heading'];
        }

        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            /* translators: %s is replaced with the search query */
            return sprintf(
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    /**
     * Returns the hero fields.
     *
     * @return object
     */
    public function hero()
    {
        $type   = get_post_type();
        $fields = isset($type) ? get_field($type) : false;

        return isset($fields)
               ? @json_decode(json_encode($fields['hero']), false)
               : false;
    }

    /**
     * @return object
     */
    public function next()
    {
        return get_next_post();
    }

    /**
     * Builds pagination using Pagi
     */
    public function pagination()
    {
        $pagination = Pagi::build();

        return $pagination;
    }

    /**
     * @return object
     */
    public function prev()
    {
        return get_previous_post();
    }

    /**
     * @return string
     */
    public function slug()
    {
        return sanitize_post($GLOBALS['wp_the_query']->get_queried_object()->post_name);
    }
}
