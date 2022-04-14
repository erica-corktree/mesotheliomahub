<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Form component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$form = new FieldsBuilder('form');
$form
    ->addText('heading')
    ->addText('subheading')
    ->addText('slug')
    ->addGroup('styles')
        ->addColorPicker('background_color')
            ->setWidth('50')
        ->addColorPicker('text_color')
            ->setWidth('50')
        ->addImage('photo')
            ->setWidth('100')
    ->endGroup()
    ->setLocation('block', '==', 'acf/form');

return $form;
