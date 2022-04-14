<?php

namespace App\Controllers\Partials;

trait PopularArticles
{
    /**
     * [popularArticles description]
     *
     * @return [type] [description]
     */
    public function popularArticles()
    {
        return get_field('blog_popular_articles', \App::getIdBySlug('blog'));
    }
}
