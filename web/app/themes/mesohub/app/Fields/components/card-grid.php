<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Card Grid component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$card_grid = new FieldsBuilder('card_grid');
$card_grid
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('cards', ['layout' => 'block'])
        ->addImage('photo')
        ->addText('heading')
        ->addTextarea('description')
        ->addLink('link')
    ->endRepeater()
    ->addGroup('styles')
        ->addColorPicker('background_color')
            ->setWidth(100/3)
        ->addColorPicker('text_color')
            ->setWidth(100/3)
        ->addSelect('content_width', [
            'ui'          => 1,
            'allow_null'  => 1,
            'placeholder' => 'Default',
        ])
            ->setInstructions('Overrides the default width of the content.')
            ->addChoices(['sm' => 'Small'], ['md' => 'Medium'], ['lg' => 'Large'], ['full' => 'Full'])
            ->setWidth(100/3)
    ->endGroup()
    ->setLocation('block', '==', 'acf/card_grid');

return $card_grid;
