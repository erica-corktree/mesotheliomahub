<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Roots\Acorn\View\Component;

class Fieldset extends Component
{
    /**
     * The legend heading for this fieldset.
     * @var string
     */
    public $legend;

    /**
     * Create the component instance.
     *
     * @param string $legend
     *
     * @return void
     */
    public function __construct($legend)
    {
        $this->label = $legend;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.fieldset');
    }
}
