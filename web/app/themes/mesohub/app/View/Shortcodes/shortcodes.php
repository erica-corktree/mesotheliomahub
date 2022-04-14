<?php

namespace App;

use function Roots\app;
use function Roots\asset;

/**
 * Outputs the current year
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('year', function($atts = [], $content = null) {
    return date('Y');
});

/**
 * Outputs the main phone number with a link and optional icon
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('phone-number', function($atts = [], $content = null) {
    extract(shortcode_atts([
        'class' => '',
        'icon'  => false,
    ], $atts));

    $phoneNumber = get_field('site_phone_number', 'option');
    $numberLink  = preg_replace('/[^0-9]/', '', get_field('site_phone_number', 'option'));

    if ($icon) {
        return "<a class=\"phone-number {$class}\" href=\"tel:{$numberLink}\"><span class=\"fa fa-{$icon}\"></span> {$phoneNumber}</a>";
    } else {
        return "<a class=\"phone-number {$class}\" href=\"tel:{$numberLink}\">{$phoneNumber}</a>";
    }
});

/**
 * Buttons
 *
 * @param array|string $atts    The shortcode attributes
 * @param string       $content The enclosed content
 *
 * @return String
 */
add_shortcode('btn', function($atts = [], $content = null) {
    extract(shortcode_atts([
        'href'  => '',
        'style' => '',
    ], $atts));

    if ($style) {
        $style = " Button--{$style}";
    }

    return "<a class=\"Button{$style}\" href=\"{$href}\">{$content}</a>";
});

/**
 * In-content CTA
 *
 * @param array|string $atts    The shortcode attributes
 * @param string       $content The enclosed content
 *
 * @return String
 */
add_shortcode('in-content-cta', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'type'  => '',
        'title' => '',
        'url'   => '',
        'img'   => '',
    ], $atts));

    $output = '';

    switch ($type) {
        case 'bar':
            $fields = [
                'heading' => get_field('site_incontent_cta_1_heading', 'option'),
                'subheading' => get_field('site_incontent_cta_1_subheading', 'option'),
                'link' => get_field('site_incontent_cta_1_link', 'option'),
            ];

            $output = "
                <div class=\"InContentCTA InContentCTA--bar\">
                  <div class=\"InContentCTA__col\">
                    <h3>{$fields['heading']}</h3>
                    <p>{$fields['subheading']}</p>
                  </div>

                  <div class=\"InContentCTA__col\">
                    <a class=\"Button Button--primary\" href=\"{$fields['link']['url']}\">
                      <span class=\"icon icon--phone\"></span> {$fields['link']['title']}
                    </a>
                  </div>
                </div>
            ";

            break;
        case 'small':
            $fields = [
                'content' => $content
                             ? parse_shortcode_content($content)
                             : get_field('site_incontent_cta_normal_content', 'option'),
                'link' => ($title && $url)
                          ? ['title' => $title, 'url' => $url,]
                          : get_field('site_incontent_cta_normal_link', 'option'),
            ];

            $output = "
                <div class=\"InContentCTA InContentCTA--small\">
                  <div class=\"InContentCTA__col\">
                    {$fields['content']}
                  </div>

                  <div class=\"InContentCTA__col\">
                    <a
                      class=\"InContentCTA__link Button Button--primary\"
                      href=\"{$fields['link']['url']}\"
                    >{$fields['link']['title']}</a>
                  </div>
                </div>
            ";

            break;
        case 'solid':
        case 'solid2':
        case 'solid3':
        case 'with-border':
            $fields = [
                'bg_color' => shortcode_atts(['bg-color' => ''], $atts) ? shortcode_atts(['bg-color' => ''], $atts)['bg-color'] : 'white',
                'img'      => $img ?? '',
                'content'  => $content ? parse_shortcode_content($content) : '',
                'type'     => $type ?? 'solid', 'solid2', 'solid3',
            ];

            $output = "
                <div class=\"InContentCTA InContentCTA--{$fields['type']} InContentCTA--{$fields['type']}-{$fields['bg_color']}\">
                  <div class=\"InContentCTA\">{$fields['content']}</div>
                </div>
            ";

            break;
        default:
            $fields = [
                'content' => get_field('site_incontent_cta_normal_content', 'option'),
                'image' => get_field('site_incontent_cta_normal_image', 'option'),
            ];

            $output = "
                <div class=\"InContentCTA InContentCTA--normal\">
                  <div class=\"InContentCTA__col\">
                    <img
                      class=\"InContentCTA__img\"
                      src=\"{$fields['image']['sizes']['medium']}\"
                      alt=\"{$fields['image']['alt']}\"
                    >
                  </div>

                  <div class=\"InContentCTA__col\">
                    {$fields['content']}
                  </div>
                </div>
            ";
    }

    return $output;
});

/**
 * Mobile CTAs that use sidebar widgets
 *
 * @return String
 */
add_shortcode('mobile-cta', function($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'number' => '',
    ], $atts));

    $theCTA    = false;
    $widgetIDs = false;
    $ctaNumber = false;
    $output    = '';

    switch (get_post_type()) {
        case 'page':
          $widgetIDs = get_widget_data('Pages');

          break;
        case 'post':
          $widgetIDs = get_widget_data('Pages');

          break;
    }

    $ctaNumber = (!empty($number) && ((int) $number > 0))
                 ? (int) $number - 1
                 : 0;

    $ctaName = $widgetIDs[$ctaNumber]->className;
    $ctaID   = $widgetIDs[$ctaNumber]->ID;

    ob_start();

    the_widget($ctaName, '', [
      'before_widget' => '<div class="Widget %s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="Widget__title">',
      'after_title'   => '</h4>',
      'widget_id'     => $ctaID,
      'is_mobile'     => true,
    ]);

    $output = ob_get_contents();

    ob_end_clean();

    return $output;
});

/**
 * Outputs a quote
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('quote', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'name'     => '',
        'subtitle' => '',
        'cite'     => '',
    ], $atts));

    $output = "
      <figure class=\"Quote\">
        <blockquote class=\"Quote__content\" cite=\"{$cite}\">
          <p>{$content}</p>
        </blockquote>
        <figcaption class=\"Quote__caption\">
          <span>
    ";

    if ($name) {
        $output .= "
          <b>{$name}</b>
        ";
    }

    if ($name && $subtitle) {
        $output .= '<br>';
    }

    if ($subtitle) {
        $output .= $subtitle;
    }

    $output .= "
          </span>
        </figcaption>
      </figure>
    ";

    return $output;
});

/**
 * [row] shortcode
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('row', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'count' => '',
    ], $atts));

    $content = do_shortcode($content);

    return "<div class=\"Row Row--{$count}\">" . parse_shortcode_content($content) . "</div>";
});

/**
 * [column] shortcode
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('column', function ($atts = [], $content = null) {
    return "<div class=\"Row__col\">" . parse_shortcode_content($content) . "</div>";
});

/**
 * Highlights text
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('highlight', function ($atts = [], $content = null) {
    return "<div class=\"Highlight\">" . parse_shortcode_content($content) . "</div>";
});

add_shortcode('dot-graph', function ($atts = [], $content = null) {
    extract(shortcode_atts([
        'heading' => '',
        'percentage' => '',
    ], $atts));

    $content = parse_shortcode_content($content);

    $output = '<div class="DotGraph">';

    $output .= '<div class="DotGraph__col DotGraph__col--left">';
    $output .= "<p class=\"DotGraph__heading\">{$heading}</p>";
    $output .= "<div class=\"DotGraph__content\">$content</div>";
    $output .= '</div>';

    $output .= '<div class="DotGraph__col DotGraph__col--right">';
    $output .= '<ul class="DotGraph__list">';

    foreach (range(1, 100) as $number) {
        if ($number <= (int) $percentage) {
            $output .= '
            <li class="DotGraph__list__item DotGraph__list__item--filled">
              <span class="DotGraph__list__dot"></span>
            </li>';
        } else {
            $output .= '
            <li class="DotGraph__list__item">
              <span class="DotGraph__list__dot"></span>
            </li>';
        }
    }

    $output .= '</ul>';

    $output .= '</div></div>';

    return $output;
});

/**
 * Statistics container
 *
 * @var array  $atts    The shortcode attributes
 * @var string $content Content within the shortcode tags
 *
 * @return String
 */
add_shortcode('statistics', function ($atts = [], $content = null) {
    $content = parse_shortcode_content($content);

    return "<div class=\"Statistics\">{$content}</div>";
});

/**
 * Single statistic
 *
 * @return String
 */
add_shortcode('stat', function ($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'title' => '',
        'sub'   => ''
    ], $atts));

    $content = parse_shortcode_content($content);

    $output =
    "<div class=\"Stat\">
      <div class=\"Stat__inner\">
        <div class=\"Stat__title\">{$title}</div>
        <div class=\"Stat__subtitle\">{$sub}</div>
        <div class=\"Stat__body\">{$content}</div>
      </div>
    </div>";

    return $output;
});

/**
 * [add_shortcode description]
 *
 * @var [type]
 */
add_shortcode('symptoms', function ($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'title' => '',
        'icon'  => ''
    ], $atts));

    $content = parse_shortcode_content($content);

    $output = "
    <div class=\"Symptoms\">
      <h4 class=\"Symptoms__title\">{$title}</h4>

      <div class=\"Symptoms__inner\">
        <div class=\"Symptoms__icon\">
          <img class=\"Symptoms__icon__img\" src=\"{$icon}\" alt=\"\">
        </div>

        <div class=\"Symptoms__content EditorContent\">{$content}</div>
      </div>
    </div>
    ";

    return $output;
});

/**
 * State selector
 */
add_shortcode('state-selector', function ($atts = [], $content = null, $tag = '') {
    $states = [
        'Alabama',
        'Alaska',
        'Arizona',
        'Arkansas',
        'California',
        'Colorado',
        'Connecticut',
        'Delaware',
        'Florida',
        'Georgia',
        'Hawaii',
        'Idaho',
        'Illinois',
        'Indiana',
        'Iowa',
        'Kansas',
        'Kentucky',
        'Louisiana',
        'Maine',
        'Maryland',
        'Massachusetts',
        'Michigan',
        'Minnesota',
        'Mississippi',
        'Missouri',
        'Montana',
        'Nebraska',
        'Nevada',
        'New Hampshire',
        'New Jersey',
        'New Mexico',
        'New York',
        'North Carolina',
        'North Dakota',
        'Ohio',
        'Oklahoma',
        'Oregon',
        'Pennsylvania',
        'Rhode Island',
        'South Carolina',
        'South Dakota',
        'Tennessee',
        'Texas',
        'Utah',
        'Vermont',
        'Virginia',
        'Washington',
        'West Virginia',
        'Wisconsin',
        'Wyoming',
    ];

    $output = '<div class="StateSelector">';

    foreach ($states as $state) {
        $state_slug = sanitize_title($state);
        $state_img  = asset("images/{$state_slug}.png")->uri();

        if (get_id_by_slug("/mesothelioma/states/{$state_slug}/")) {
            $output .= '<div class="StateSelector__item">';
            $output .= "<a class=\"StateSelector__link\" href=\"/mesothelioma/states/{$state_slug}/\">";
            $output .= "<img class=\"StateSelector__img\" src=\"$state_img\" alt=\"{$state}\">";
            $output .= "<span class=\"StateSelector__text\">{$state}</span>";
            $output .= '</a>';
            $output .='</div>';
        }
    }

    $output .= '</div>';

    return $output;
});

/**
 * Inline image
 */
add_shortcode('inline-img', function ($atts = [], $content = null, $tag = '') {
    extract(shortcode_atts([
        'src'   => '',
        'align' => '',
        'alt' => '',
    ], $atts));

    $align   = !empty($align) ? $align : 'left';
    $content = parse_shortcode_content($content);

    $output =
    "<div class=\"InlineImg InlineImg--{$align}\">
      <div class=\"InlineImg__photo\">
        <img class=\"InlineImg__img\" src=\"{$src}\" alt=\"{$alt}\">
      </div>
      <div class=\"InlineImg__content EditorContent\">{$content}</div>
    </div>";

    return $output;
});
