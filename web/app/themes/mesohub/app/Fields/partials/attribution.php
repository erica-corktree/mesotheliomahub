<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Header tab partial
 * @link https://github.com/StoutLogic/acf-builder/
 */
$attribution = new FieldsBuilder('attribution');
$attribution
    ->addTab('attribution', ['placement' => 'top'])
        ->addWysiwyg('citations', [
            'label'        => 'Citations',
            'instructions' => 'Citations for this content.',
            'tabs'         => 'all',
            'toolbar'      => 'basic',
            'media_upload' => 0,
        ]);

return $attribution;
