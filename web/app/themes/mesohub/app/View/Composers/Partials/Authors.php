<?php

namespace App\Controllers\Partials;

trait Authors
{
    /**
     * [popularArticles description]
     *
     * @return [type] [description]
     */
    public function authors()
    {
        return get_users([
            'exclude' => [1, 2],
        ]);
    }
}
