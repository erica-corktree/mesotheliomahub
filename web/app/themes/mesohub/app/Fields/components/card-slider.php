<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Card Slider component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$card_slider = new FieldsBuilder('card_slider');
$card_slider
    ->addText('heading')
    ->addText('subheading')
    ->addRepeater('cards', [
        'instructions' => 'Row of cards that will make up the slider.',
        'layout'       => 'block',
        'button_label' => 'Add Card',
    ])
        ->addText('heading')
        ->addTextarea('content', [
            'label' => 'Card Content',
            'rows'  => '4',
        ])
        ->addRepeater('links', [
            'label'        => 'Card Links',
            'instructions' => 'Up to 3 button links that can be added to this card.',
            'max' => 3,
        ])
            ->addLink('link')
        ->endRepeater()
    ->endRepeater()
    ->setLocation('block', '==', 'acf/card_slider');

return $card_slider;
