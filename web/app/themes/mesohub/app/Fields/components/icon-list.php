<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Icon List component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$icon_list = new FieldsBuilder('icon_list');
$icon_list
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('items', ['layout' => 'block'])
        ->addImage('icon')
        ->addText('heading')
        ->addTextarea('description', [
            'rows' => '4',
        ])
        ->addLink('link')
        ->addRadio('alignment', [
            'label' => 'Icon Alignment',
            'instructions' => 'The position of the icon relative to the description',
            'choices' => [
                'left' => 'Left',
                'right' => 'Right',
            ],
            'default_value' => 'left',
            'layout' => 'horizontal',
            'return_format' => 'value',
        ])
    ->endRepeater()
    ->setLocation('block', '==', 'acf/icon_list');

return $icon_list;
