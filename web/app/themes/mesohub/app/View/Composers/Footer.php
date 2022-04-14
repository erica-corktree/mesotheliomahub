<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class Footer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'footer_navigation'           => $this->footerNavigation(),
            'footer_secondary_navigation' => $this->footerSecondaryNavigation(),
        ];
    }

    /**
     * Returns the footer navigation.
     *
     * @return array
     */
    public function footerNavigation()
    {
        return Navi::build('secondary_navigation')->toArray();
    }

    /**
     * Returns the secondary footer navigation.
     *
     * @return array
     */
    public function footerSecondaryNavigation()
    {
        return Navi::build('secondary_navigation')->toArray();
    }
}
