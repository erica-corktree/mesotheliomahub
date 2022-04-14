<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * CTA component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$cta = new FieldsBuilder('cta', ['label' => 'CTA']);
$cta
    ->addText('heading')
    ->addLink('link')
    ->addGroup('styles')
        ->addColorPicker('background_color')
            ->setWidth('50')
        ->addColorPicker('text_color')
            ->setWidth('50')
        ->addImage('photo')
            ->setWidth('100')
    ->endGroup()
    ->setLocation('block', '==', 'acf/cta');

return $cta;
