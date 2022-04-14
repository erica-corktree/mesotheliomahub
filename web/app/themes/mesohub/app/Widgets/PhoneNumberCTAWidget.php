<?php
/**
 * [CTAWidget description]
 */
class PhoneNumberCTAWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct('phone_number_widget', 'Phone Number CTA', [
            'classname' => 'Widget--phone-cta',
            'description' => 'CTA featuring hotline phone number',
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
        $phoneNumber = get_field('site_phone_number', 'option')['dial_in'];
        $htmlWidgetID = get_field('widget_id', $widgetID) ? get_field('widget_id', $widgetID) : '';

        if (isset($args['is_mobile'])) {
            $htmlWidgetID = "Mobile{$htmlWidgetID}";
        }

        echo "<div class=\"Widget Widget--phone-cta\" id=\"{$htmlWidgetID}\">";
        echo "<div class=\"Widget__content\">";

        echo "<a class=\"Widget__phone-number\" href=\"tel:{$phoneNumber}\"><span class=\"Icon Icon--phone\"></span> {$phoneNumber}</a>";

        if ($heading) {
            echo $args['before_title'] . esc_html($heading) . $args['after_title'];
        }

        if ($subheading) {
            echo "<p class=\"Widget__subheading\">{$subheading}</p>";
        }

        echo '</div>';
        echo '</div>';
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

register_widget('PhoneNumberCTAWidget');
