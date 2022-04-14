<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Video section component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$video = new FieldsBuilder('video');
$video
    ->addText('heading')
    ->addText('subheading')
    ->addUrl('video')
        ->setWidth('50')
    ->addRadio('alignment', [
        'label'         => 'Video Alignment',
        'instructions'  => 'The position of the video relative to the content',
        'choices'       => ['left' => 'Left', 'right' => 'Right'],
        'default_value' => 'left',
        'layout'        => 'horizontal',
        'return_format' => 'value',
    ])
        ->setWidth('50')
    ->addLink('link')
    ->setLocation('block', '==', 'acf/video');

return $video;
