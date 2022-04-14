<?php
/**
 * [BoxWidget description]
 */
class BoxWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = [
          'classname' => 'Widget--box',
          'description' => 'Generic box widget',
        ];

        parent::__construct('box_widget', 'Box', $widget_ops);
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

        $title   = get_field('widget_title', $widgetID) ? get_field('widget_title', $widgetID): '';
        $content = get_field('widget_content', $widgetID);
        $isLink  = get_field('widget_is_link', $widgetID);
        $linkUrl = get_field('widget_link_url', $widgetID);
        $htmlWidgetID = get_field('widget_id', $widgetID) ? get_field('widget_id', $widgetID) : '';

        if (isset($args['is_mobile'])) {
            $htmlWidgetID = "Mobile{$htmlWidgetID}";
        }

        if ($isLink) {
            echo "<a class=\"Widget Widget--box Widget--box--is-link\" id=\"{$htmlWidgetID}\" href=\"{$linkUrl}\">";
        } else {
            echo $args['before_widget'];
        }

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        if ($content) {
            echo '<div class="Widget__content">';
            echo $content;
            echo '</div>';
        }

        if ($isLink) {
            echo "</a>";
        } else {
            echo $args['after_widget'];
        }
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

register_widget('BoxWidget');
