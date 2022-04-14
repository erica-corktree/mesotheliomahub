<?php
/**
 * [ListWidget description]
 */
class ListWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = [
          'classname' => 'Widget--list',
          'description' => 'Widget containing a formatted list',
        ];

        parent::__construct('list_widget', 'List', $widget_ops);
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

        $title = get_field('widget_title', $widgetID) ? get_field('widget_title', $widgetID) : '';
        $listType = get_field('widget_list_type', $widgetID);
        $list = null;

        switch ($listType) {
            case 'page':
                $list = get_field('widget_page_list', $widgetID);
                break;
            case 'post':
                $list = get_field('widget_post_list', $widgetID);
                break;
            case 'author':
                $list = get_field('widget_author_list', $widgetID);
                break;
        }

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        if ($list) {
            echo '<div class="Widget__content">';
            echo '<ul>';

            switch ($listType) {
                case 'page':
                    foreach ($list as $item) {
                        if (!empty($item['page'])) {
                            $link = get_the_permalink($item['page']->ID);

                            echo "<li><a href=\"{$link}\">{$item['page']->post_title}</a></li>";
                        }
                    }

                    break;
                case 'post':
                    foreach ($list as $item) {
                        $link = get_permalink($item['post']->ID);

                        echo "<li><a href=\"{$link}\">{$item['post']->post_title}</a></li>";
                    }

                    break;
                case 'author':
                    foreach ($list as $item) {
                        $link = get_author_posts_url($item['author']['ID']);

                        echo "<li><a href=\"{$link}\">{$item['author']['display_name']}</a></li>";
                    }

                    break;
            }

            echo '</ul>';
            echo '</div>';
        }

        echo $args['after_widget'];
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

register_widget('ListWidget');
