<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Button component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$config = (object) [
    'ui'      => 1,
    'wrapper' => ['width' => (100 / 3)],
];

$button = new FieldsBuilder('button');
$button
    ->addGroup('button')
        ->addLink('link', ['wrapper' => $config->wrapper])
            ->setInstructions('URL and label for this button.')

        ->addSelect('size', ['ui' => $config->ui, 'allow_null' => 1, 'placeholder' => 'Default', 'wrapper' => $config->wrapper])
            ->addChoices(['small' => 'Small'], ['medium' => 'Medium'], ['large' => 'Large'])
            ->setInstructions('The size of the button.')

        ->addSelect('color', ['ui' => $config->ui, 'allow_null' => 1, 'placeholder' => 'None', 'wrapper' => $config->wrapper])
            ->addChoices(['blue' => 'Blue'], ['red' => 'Red'], ['green' => 'Green'])
            ->setInstructions('The background color of the button.')
    ->endGroup();

return $button;
