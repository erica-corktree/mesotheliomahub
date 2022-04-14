<?php

namespace App\Widgets;

use Log1x\AcfComposer\Widget;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Icon extends Widget
{
    /**
     * The display name of the widget.
     *
     * @var string
     */
    public $name = 'Icon';

    /**
     * The description of the widget.
     *
     * @var string
     */
    public $description = 'Features a prominent icon with a button link.';

    /**
     * Data to be passed to the widget before rendering.
     * @see resources/views/partials/widgets/icon.blade.php
     *
     * @return array
     */
    public function with()
    {
        return [
            'icon' => $this->icon(),
            'link' => $this->link(),
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
        $icon = new FieldsBuilder('icon');

        $icon
            ->addText('title');

        $icon
            ->addImage('icon')
            ->addLink('link');

        return $icon->build();
    }

    /**
     * The icon.
     *
     * @return object
     */
    public function icon()
    {
        return json_decode(json_encode(get_field('icon', $this->widget->id) ?: []));
    }

    /**
     * The link.
     *
     * @return object
     */
    public function link()
    {
        return json_decode(json_encode(get_field('link', $this->widget->id) ?: []));
    }
}
