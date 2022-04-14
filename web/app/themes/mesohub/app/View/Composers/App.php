<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

use function Roots\app;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'acf_options'       => @json_decode(json_encode(get_fields('options'))),
            'primary_nav_items' => $this->primaryNavItems(),
            'shareLinks'        => $this->shareLinks(),
            'siteName'          => $this->siteName(),
            'siteOptions'       => $this->siteOptions(),
        ];
    }

    /**
     * [primaryNavItems description]
     *
     * @return [type] [description]
     */
    public function primaryNavItems()
    {
        if (Navi::build('primary_navigation')->isEmpty()) {
            return;
        }

        $navi = Navi::build('primary_navigation')->toArray();

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

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * All ACF theme options.
     *
     * @return object
     */
    public function siteOptions()
    {
        return  @json_decode(json_encode(get_fields('options')));
    }

    /**
     * @return array
     */
    public function shareLinks($id = null)
    {
        $title     = htmlspecialchars(urlencode(get_the_title($id)));
        $permalink = htmlspecialchars(urlencode(get_the_permalink($id)));
        $excerpt   = htmlspecialchars(urlencode(@get_the_excerpt($id)));

        $socialLinks = [
            'facebook' => [
                'url'  => "https://www.facebook.com/sharer/sharer.php?text={$title}&amp;u={$permalink}",
                'label' => 'Facebook',
            ],
            'twitter' => [
                'url'  => "https://twitter.com/intent/tweet?counturl={$permalink}&amp;text={$title}&amp;url={$permalink}&amp;via=meso_hub",
                'label' => 'Twitter',
            ],
            'linkedin' => [
                'url'  => "https://www.linkedin.com/shareArticle?mini=true&url={$permalink}&summary={$excerpt}",
                'label' => 'LinkedIn',
            ],
        ];

        return $socialLinks;
    }

    /**
     * Does the current page have child pages?
     *
     * @return boolean
     */
    public function hasChildPages()
    {
        if (!is_page()) {
            return false;
        }

        $children = get_pages(['child_of' => $GLOBALS['post']->ID]);

        return (count($children) > 0);
    }

    /**
     * Is the current page a certain page or a child of it?
     *
     * @param int|string $id Page ID or slug
     *
     * @return boolean
     */
    public function isTree($id)
    {
        global $post;

        $theID = (is_int($id)) ? $id : App::getIdBySlug($id);

        return (is_page() && ($post->post_parent === $theID || is_page($theID)));
    }

    /**
     * Gets a post ID by its slug
     *
     * @param string $slug The post slug
     *
     * @return int The post ID
     */
    public function getIdBySlug($slug = '')
    {
        $page = get_page_by_path($slug);

        return ($page) ? $page->ID : null;
    }

    /**
     * Get current view ID
     *
     * @return int The ID for the active view
     */
    public function id()
    {
        if (is_singular()) {
            return get_the_ID();
        }

        return false;
    }
}
