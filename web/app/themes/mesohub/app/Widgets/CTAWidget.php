<?php
/**
 * [CTAWidget description]
 */
class CTAWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct('cta_widget', 'CTA', [
            'classname' => 'Widget--cta',
            'description' => 'CTA with background image and button',
        ]);
    }

    /**
      * Outputs the content of the widget
      *
      * @param array $args
      * @param array $instance
      */
    public function widget($args, $instance)
    {
        // outputs the content of the widget
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        // widget ID with prefix for use in ACF API functions
        $widgetID = 'widget_' . $args['widget_id'];

        $heading = get_field('widget_heading', $widgetID) ? get_field('widget_heading', $widgetID) : '';
        $subheading = get_field('widget_subheading', $widgetID) ? get_field('widget_subheading', $widgetID) : '';
        $link = get_field('widget_link', $widgetID);
        $image = get_field('widget_image', $widgetID);
        $htmlWidgetID = get_field('widget_id', $widgetID) ? get_field('widget_id', $widgetID) : '';

        if (isset($args['is_mobile'])) {
            $htmlWidgetID = "Mobile{$htmlWidgetID}";
        }

        echo "<a class=\"Widget Widget--cta\" id=\"{$htmlWidgetID}\" href=\"{$link['url']}\">";
        echo '<div class="Widget__content">';

        if ($image) {
            echo "<picture class=\"Widget__picture\">";
            echo "<source srcset=\"{$image['sizes']['medium']}\" media=\"(min-width: 40em)\">";
            echo "<img class=\"Widget__img\" src=\"{$image['sizes']['small']}\" alt=\"{$image['alt']}\">";
            echo "</picture>";
        }

        if ($heading) {
            echo $args['before_title'] . esc_html($heading) . $args['after_title'];
        }

        if ($subheading) {
            echo "<p class=\"Widget__subheading\">{$subheading}</p>";
        }

        echo "<span class=\"Button Button--primary\" href=\"{$link['url']}\">{$link['title']}</span>";
        echo '</div>';

        echo "</a>";
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        // outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
    }
}

register_widget('CTAWidget');
