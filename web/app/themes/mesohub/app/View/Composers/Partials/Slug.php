<?php

namespace App\Controllers\Partials;

trait Slug
{
    /**
     * Get the slug of whatever content type being viewed.
     *
     * @return string The slug.
     */
    public function slug()
    {
        global $post;

        $slug = $post->post_name;

        return $slug;
    }
}
