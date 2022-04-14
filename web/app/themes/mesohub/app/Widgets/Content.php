<?php

namespace App\Widgets;

use Log1x\AcfComposer\Widget;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Content extends Widget
{
    /**
     * The display name of the widget.
     *
     * @var string
     */
    public $name = 'Content';

    /**
     * The description of the widget.
     *
     * @var string
     */
    public $description = 'Select a page or post to display.';

    /**
     * Data to be passed to the widget before rendering.
     * @see resources/views/partials/widgets/content.blade.php
     *
     * @return array
     */
    public function with()
    {
        return [
            'content' => $this->content(),
        ];
    }

    /**
     * The title of the widget.
     *
     * @return string
     */
    public function title() {
        return get_field('title', $this->widget->id);
    }

    /**
     * The widget field group.
     *
     * @return array
     */
    public function fields()
    {
        $content = new FieldsBuilder('content');

        $content
            ->addText('title');

        $content
            ->addPostObject('content', [
                'post_type'     => ['post', 'page'],
                'multiple'      => 0,
                'return_format' => 'id',
            ]);

        return $content->build();
    }

    /**
     * Meta data needed from the selected content.
     *
     * @return object
     */
    public function content()
    {
        $id = get_field('content', $this->widget->id) ?: null;

        return (object) [
            'author'    => get_the_author_meta('display_name', get_post_field('post_author', $id)),
            'date'      => get_the_date(null, $id),
            'excerpt'   => get_post_meta($id, '_yoast_wpseo_metadesc', true) ?: get_the_excerpt($id),
            'permalink' => get_the_permalink($id),
            'photo'     => get_field(get_post_type($id) . '_hero_photo', $id) ?: null,
            'time'      => get_post_time('c', true, $id),
            'title'     => get_the_title($id),
        ];
    }
}
