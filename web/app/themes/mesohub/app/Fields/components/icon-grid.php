<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Icon Grid component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$icon_grid = new FieldsBuilder('icon_grid');
$icon_grid
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('items', ['layout' => 'block'])
        ->addImage('icon')
        ->addText('heading')
        ->addTextarea('description', [
            'rows' => '4',
        ])
        ->addLink('link')
    ->endRepeater()
    ->addLink('link')
    ->addGroup('styles')
        ->addColorPicker('background_color')
            ->setWidth('50')
        ->addColorPicker('text_color')
            ->setWidth('50')
        ->addImage('photo')
            ->setWidth('50')
        ->addTrueFalse('photo_full_width')
            ->setWidth('50')
    ->endGroup()
    ->setLocation('block', '==', 'acf/icon_grid');

return $icon_grid;
