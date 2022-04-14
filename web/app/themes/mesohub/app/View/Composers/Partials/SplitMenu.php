<?php

namespace App\Controllers\Partials;

trait SplitMenu
{
    /**
     * Get content sections
     *
     * @return array The content sections
     */
    public function splitMenu()
    {
        return get_field('split_menu');
    }
}
