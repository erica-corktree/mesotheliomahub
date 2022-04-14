<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Card List component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$card_list = new FieldsBuilder('card_list');
$card_list
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('cards', ['layout' => 'block'])
        ->addText('heading')
        ->addTextarea('description')
        ->addLink('link')
    ->endRepeater()
    ->setLocation('block', '==', 'acf/card_list');

return $card_list;
