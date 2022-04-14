<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * SEO tab partial
 * @link https://github.com/StoutLogic/acf-builder/
 */
$seo = new FieldsBuilder('seo');
$seo
    ->addTab('seo', [
        'label'     => 'SEO',
        'placement' => 'top',
    ])
        ->addGroup('seo')
            ->addField('yoast', 'yoast')
        ->endGroup();

return $seo;
