<?php

namespace App\Controllers\Partials;

trait BlogCategories
{
    /**
     * [categories description]
     *
     * @return [type] [description]
     */
    public function categories()
    {
        return get_categories([
            'orderby' => 'name',
            'order'   => 'ASC',
        ]);
    }
}
