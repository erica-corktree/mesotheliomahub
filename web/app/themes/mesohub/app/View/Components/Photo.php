<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;
use function App\get_image_data;

class Photo extends Component
{
    /**
     * @var string
     */
    public $class;

    /**
     * @var mixed
     */
    public $photo;

    /**
     * Create the component instance.
     *
     * @param string
     * @param string
     *
     * @return void
     */
    public function __construct($class, $photo)
    {
        $this->class = $class;
        $this->photo = isset($photo->ID)
                       ? $photo
                       : json_decode(json_encode(get_image_data($photo)));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.photo');
    }
}
