<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

use function Roots\app;

class Configuration extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Configuration';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Configuration | Options';

    /**
     * The option page permission capability.
     *
     * @var string
     */
    public $capability = 'edit_theme_options';

    /**
     * The option page menu position.
     *
     * @var int
     */
    public $position = PHP_INT_MAX;

    /**
     * The option page autoload setting.
     *
     * @var bool
     */
    public $autoload = true;

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $configuration = new FieldsBuilder('app', [
            'style' => 'seamless',
        ]);

        $configuration
            ->addTab('social_media', [
                'label'     => 'Social Media',
                'placement' => 'top',
            ])
                ->addGroup('social_media', ['label' => 'Social Media'])
                    ->addRepeater('links', ['label' => 'Social Media Links'])
                        ->addLink('link')
                    ->endRepeater()
                ->endGroup()
            ->addTab('footer', [
                'label'     => 'Site Footer',
                'placement' => 'top',
            ])
                ->addGroup('footer', ['label' => 'Site Footer'])
                    ->addText('copyright')
                    ->addTextArea('address')
                ->endGroup();

        return $configuration->build();
    }
}
