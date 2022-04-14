<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * content component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$content = new FieldsBuilder('content');
$content
    ->addWysiwyg('content', [
        'label'        => 'Content',
        'instructions' => 'The main content for this section.',
        'tabs'         => 'all',
        'toolbar'      => 'full',
        'media_upload' => 1,
    ])
    ->addGroup('styles')
        ->addColorPicker('background_color')
            ->setWidth('33.3333333333')
        ->addColorPicker('text_color')
            ->setWidth('33.3333333333')
        ->addSelect('content_width', [
            'ui'          => 1,
            'allow_null'  => 1,
            'placeholder' => 'Default',
        ])
            ->addChoices(['small' => 'Small'], ['medium' => 'Medium'], ['full' => 'Full'])
            ->setWidth('33.3333333333')
            ->setInstructions('Overrides the default width of the content.')
        ->addImage('photo')
            ->setWidth('50')
        ->addTrueFalse('photo_full_width')
            ->setWidth('50')
    ->endGroup()
    ->setLocation('block', '==', 'acf/content');

return $content;
