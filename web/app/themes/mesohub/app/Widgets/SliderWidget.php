<?php
/**
 * [SliderWidget description]
 */
class SliderWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct('slider_widget', 'Slider', [
            'classname' => 'Widget--slider',
            'description' => 'Slider with multiple info boxes',
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

        $slides = get_field('widget_slides', $widgetID);

        $heading = get_field('widget_heading', $widgetID) ? get_field('widget_heading', $widgetID) : '';
        $subheading = get_field('widget_subheading', $widgetID) ? get_field('widget_subheading', $widgetID) : '';
        $link = get_field('widget_link', $widgetID);
        $icon = get_field('widget_icon', $widgetID);
        $htmlWidgetID = get_field('widget_id', $widgetID) ? get_field('widget_id', $widgetID) : '';

        if (isset($args['is_mobile'])) {
            $htmlWidgetID = "Mobile{$htmlWidgetID}";
        }

        echo "<div class=\"Widget Widget--slider\" id=\"{$htmlWidgetID}\">";
        echo '<div class="Widget__content">';
        echo '<div class="WidgetSlider">';

        foreach ($slides as $slide) {
            echo '<div class="WidgetSlider__slide">';

            if ($slide['heading']) {
                echo $args['before_title'] . esc_html($slide['heading']) . $args['after_title'];
            }

            if ($slide['icon']) {
                echo "<div class=\"Widget__icon\">";
                @include get_template_directory() . "/views/partials/svgs/{$slide['icon']}.blade.php";
                echo "</div>";
            }

            if ($slide['subheading']) {
                echo "<p class=\"Widget__subheading\">{$slide['subheading']}</p>";
            }

            if ($slide['link']) {
                echo "<a class=\"Button Button--primary\" href=\"{$slide['link']['url']}\">{$slide['link']['title']}</a>";
            }

            echo '</div>';
        }

        echo '</div>';
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

register_widget('SliderWidget');
