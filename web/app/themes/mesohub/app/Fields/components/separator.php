<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Photo Slider component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$separator = new FieldsBuilder('separator');
$separator
    ->addSelect('width', [
        'ui'          => 1,
        'allow_null'  => 1,
        'placeholder' => 'Default',
    ])
        ->addChoices(['small' => 'Small'], ['medium' => 'Medium'], ['full' => 'Full'])
        ->setWidth(100/3)
        ->setInstructions('Overrides the default width of the separator.')
    ->addColorPicker('color')
        ->setInstructions('Overrides the default seperator (border) color.')
        ->setWidth(100/3)
    ->addImage('icon')
        ->setInstructions('Will be centered over the separator.')
        ->setWidth(100/3)
    ->setLocation('block', '==', 'acf/separator');

return $separator;
