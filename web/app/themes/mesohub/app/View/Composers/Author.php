<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use function App\get_image_data;

class Author extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'author',
        'partials.attribution',
        'partials.content',
        'partials.content-*',
        'partials.entry-meta',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'author'           => $this->authorData(),
            'current_author'   => $this->currentAuthor(),
            'authors'          => @json_decode(json_encode(get_users(['exclude' => [1, 2]]))),
            'categories'       => @json_decode(json_encode(get_categories(['orderby' => 'name', 'order' => 'ASC']))),
            'popular_articles' => @json_decode(json_encode(get_field('blog_popular_articles', get_option('page_for_posts', true)))),
        ];
    }

    /**
     * @return object | false
     */
    public function authorData()
    {
        $id = get_the_author_meta('ID');

        if ($id) {
            return (object) [
                'ID'    => $id,
                'name'  => get_the_author_meta('display_name', $id),
                'title' => get_field('author_title', "user_{$id}"),
                'bio'   => get_the_author_meta('description', $id),
                'url'   => get_author_posts_url($id),
                'photo' => json_decode(json_encode(get_field('author_photo', "user_{$id}"))),
            ];
        }

        return false;
    }

    /**
     * @return object | false
     */
    public function currentAuthor()
    {
        $authorData = $GLOBALS['wp_query']->get_queried_object()->data;

        $author = [
            'ID'    => $authorData->ID,
            'email' => $authorData->user_email,
            'name'  => $authorData->display_name,
        ];

        return (object) $author;
    }
}
