<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Photo Slider component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$photo_slider = new FieldsBuilder('photo_slider');
$photo_slider
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('slides', [
        'instructions' => 'The photo slides will make up the slider.',
        'layout'       => 'block',
        'button_label' => 'Add Slide',
    ])
        ->addImage('photo')
            ->setWidth('50')
        ->addLink('link')
            ->setWidth('50')
    ->endRepeater()
    ->setLocation('block', '==', 'acf/photo_slider');

return $photo_slider;
