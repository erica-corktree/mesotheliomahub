<?php

namespace App\Controllers\Partials;

trait Banner
{
    /**
     * [categories description]
     *
     * @return [type] [description]
     */
    public function banner()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return (object) get_field('banner', $home);
            }
        } else {
            return (object) get_field('banner');
        }
    }
}
