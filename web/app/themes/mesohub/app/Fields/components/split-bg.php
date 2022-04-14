<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Card Grid component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$split_bg = new FieldsBuilder('split_bg');
$split_bg
    ->addText('heading')
    ->addTextarea('subheading')
    ->addLink('link')
    ->addImage('photo')
    ->setLocation('block', '==', 'acf/split_bg');

return $split_bg;
