<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class Navigation extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.navigation'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'navigation' => $this->navigation(),
        ];
    }

    /**
     * Returns the primary navigation.
     *
     * @return array
     */
    public function navigation()
    {
        if (Navi::build('header_menu_primary')->isEmpty()) {
            return;
        }

        $navi = Navi::build('header_menu_primary')->toArray();

        foreach ($navi as &$item) {
            $submenu = get_field('submenu', $item->id);

            if ($submenu) {
                $navMenu      = wp_get_nav_menu_object($submenu);
                $navMenuId    = $navMenu ? "nav_menu_{$navMenu->term_id}" : '';
                $navMenuItems = Navi::build($navMenu->slug);
                $submenuPanel = json_decode(json_encode(get_field('panel', $navMenuId)));

                $item->submenu = (object) [
                    'items' => !$navMenuItems->isEmpty() ? $navMenuItems->toArray() : [],
                    'panel' => (object) [
                        'title'   => $submenuPanel->title,
                        'content' => $submenuPanel->content[0],
                        'layout'  => str_replace('_', '-', $submenuPanel->content[0]->acf_fc_layout),
                    ],
                ];
            }
        }

        return $navi;
    }
}
