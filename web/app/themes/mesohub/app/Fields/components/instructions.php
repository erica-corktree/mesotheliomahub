<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Instructions component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$instructions = new FieldsBuilder('instructions');
$instructions
    ->addRepeater('steps')
        ->addText('heading')
        ->addTextarea('intro', [
            'rows' => 2
        ])
    ->endRepeater()
    ->addGroup('styles')
        ->addColorPicker('background-color')
            ->setWidth('50')
        ->addColorPicker('color')
            ->setWidth('50')
    ->endGroup()
    ->setLocation('block', '==', 'acf/instructions');

return $instructions;
