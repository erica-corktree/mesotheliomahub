<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Blog Posts component
 * @link https://github.com/StoutLogic/acf-builder/
 */
$blog_posts = new FieldsBuilder('blog_posts');
$blog_posts
    ->addText('heading')
    ->addText('subheading')
    ->addTaxonomy('category')
    ->addNumber('amount')
    ->addLink('link')
    ->setLocation('block', '==', 'acf/blog_posts');

return $blog_posts;
