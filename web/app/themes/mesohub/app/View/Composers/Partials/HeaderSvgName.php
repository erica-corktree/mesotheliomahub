<?php

namespace App\Controllers\Partials;

trait HeaderSvgName
{
    /**
     * [headerSvgName description]
     *
     * @return string
     */
    public function headerSvgName()
    {
        $slug    = $GLOBALS['post']->post_name;
        $parents = get_post_ancestors($GLOBALS['post']->ID);

        $parentSlug = ($parents)
                      ? get_post($parents[count($parents) - 1])->post_name . '.'
                      : '';

        return "{$parentSlug}{$slug}";
    }
}
