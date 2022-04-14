<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Roots\Acorn\View\Component;

class Field extends Component
{
    /**
     * The label for this form field.
     * @var string
     */
    public $label;

    /**
     * The type of form field this comoponent is.
     * @var string
     */
    public $type;

    /**
     * Create the component instance.
     *
     * @param string $label
     * @param string $type
     *
     * @return void
     */
    public function __construct($label, $type)
    {
        $this->label = $label;
        $this->type  = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.field');
    }
}
