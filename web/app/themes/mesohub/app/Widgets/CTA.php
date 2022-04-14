<?php

namespace App\Widgets;

use Log1x\AcfComposer\Widget;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CTA extends Widget
{
    /**
     * The display name of the widget.
     *
     * @var string
     */
    public $name = 'CTA';

    /**
     * The description of the widget.
     *
     * @var string
     */
    public $description = 'Call to action link.';

    /**
     * Data to be passed to the widget before rendering.
     * @see resources/views/partials/widgets/cta.blade.php
     *
     * @return array
     */
    public function with()
    {
        return [
            'title'  => $this->title(),
            'button' => $this->button(),
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
        $cta = new FieldsBuilder('cta');

        $cta
            ->addText('title');

        $cta
            ->addText('subtitle');

        $cta
            ->addLink('button');

        return $cta->build();
    }

    /**
     * The subtitle of the widget.
     *
     * @return string
     */
    public function subtitle() {
        return get_field('subtitle', $this->widget->id);
    }

    /**
     * @return array
     */
    public function button()
    {
        return get_field('button', $this->widget->id) ?: [];
    }
}
