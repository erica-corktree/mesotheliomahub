<?php

namespace App\Controllers\Partials;

trait CTAInContentPageFooter
{
    /**
     * Get content sections
     *
     * @return array The content sections
     */
    public function incontentCtaPageFooter()
    {
        return get_field('site_incontent_cta_page_footer', 'option');
    }
}
