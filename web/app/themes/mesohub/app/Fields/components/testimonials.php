<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Testimonials component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$testimonials = new FieldsBuilder('testimonials');
$testimonials
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('testimonials', ['layout' => 'block'])
        ->addTextarea('quote')
            ->setWidth('75')
        ->addImage('photo')
            ->setWidth('25')
        ->addText('name')
            ->setWidth('50')
        ->addText('title')
            ->setWidth('50')
    ->endRepeater()
    ->setLocation('block', '==', 'acf/testimonials');

return $testimonials;
