<?php

return [

    /*
    |----------------------------------------------------------------------
    | Default widgets
    |----------------------------------------------------------------------
    |
    | Filter default widgets available to WordPress
    |
    */

    'default_widgets' => [
        'archives'        => false,
        'calendar'        => false,
        'categories'      => false,
        'custom_html'     => true,
        'links'           => false,
        'media_audio'     => false,
        'media_image'     => false,
        'media_gallery'   => false,
        'media_video'     => false,
        'meta'            => false,
        'pages'           => false,
        'search'          => false,
        'text'            => true,
        'recent_posts'    => false,
        'recent_comments' => false,
        'rss'             => false,
        'tag_cloud'       => false,
        'menu'            => true,
    ],

    /*
    |----------------------------------------------------------------------
    | Additional widgets
    |----------------------------------------------------------------------
    |
    | Add additional widgets
    |
    */

    'additional_widgets' => [
        \WPSEO_Show_Address::class,
        \WPSEO_Show_Map::class,
        \WPSEO_Show_Open_Closed::class,
        \WPSEO_Show_OpeningHours::class,
    ],

];
