<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Content with Card component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$content_with_card = new FieldsBuilder('content_with_card');
$content_with_card
    ->addWysiwyg('content', [
        'label'        => 'Content',
        'instructions' => 'The main content for this section.',
        'tabs'         => 'all',
        'toolbar'      => 'full',
        'media_upload' => 1,
    ])
    ->addWysiwyg('card_content', [
        'label'        => 'Card Content',
        'instructions' => 'This content will be placed in a card positioned to the right.',
        'tabs'         => 'all',
        'toolbar'      => 'basic',
        'media_upload' => 0,
    ])
    ->setLocation('block', '==', 'acf/content_with_card');

return $content_with_card;
