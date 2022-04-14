<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if ( ! class_exists( 'STI_Admin_Options' ) ) :

    /**
     * Class for plugin admin options methods
     */
    class STI_Admin_Options {

        /*
         * Get default settings values
         * @param string $tab Tab name
		 * @return array
         */
        static public function get_default_settings( $tab = false ) {

            $options = self::options_array( $tab );
            $default_settings = array();

            foreach ( $options as $section_name => $section ) {
                foreach ($section as $values) {

                    if ( $values['type'] === 'heading' || $values['type'] === 'html' ) {
                        continue;
                    }

                    if ($values['type'] === 'checkbox') {
                        foreach ($values['choices'] as $key => $val) {
                            $default_settings[$values['id']][$key] = (string) sanitize_text_field( $values['value'][$key] );
                        }
                        continue;
                    }

                    if ( $values['type'] === 'display_rules' ) {
                        $default_settings[$values['id']] = $values['value'];
                        continue;
                    }

                    if ( $values['type'] === 'textarea' && isset( $values['allow_tags'] ) ) {
                        $default_settings[$values['id']] = (string) addslashes( wp_kses( stripslashes( $values['value'] ), STI_Admin_Helpers::get_kses( $values['allow_tags'] ) ) );
                        continue;
                    }

                    if ( $values['type'] === 'sortable_table' ) {
                        foreach ( $values['choices'] as $key => $opts_arr ) {
                            foreach( $opts_arr as $opt_name => $opt_val ) {
                                if ( $opt_name === 'name' ) continue;
                                $default_settings[$values['id']][$key][$opt_name] = (string) sanitize_text_field( $opt_val );
                            }
                        }
                        continue;
                    }

                    $default_settings[$values['id']] = (string) sanitize_text_field( $values['value'] );

                }
            }

            return $default_settings;

        }

        /*
         * Update plugin settings
         */
        static public function update_settings() {

            $current_section = isset( $_GET['section'] ) ? sanitize_text_field( $_GET['section'] ) : 'none';

            $options = self::options_array( false, $current_section );

            $settings = self::get_settings();
            $current_tab = empty( $_GET['tab'] ) ? 'general' : sanitize_text_field( $_GET['tab'] );

            foreach ( $options[$current_tab] as $values ) {

                if ( ! isset( $values['type'] ) ) {
                    continue;
                }

                if ( $values['type'] === 'heading' || $values['type'] === 'html' ) {
                    continue;
                }

                if ( $values['type'] === 'toggler' ) {
                    $new_value = isset( $_POST[ $values['id'] ] ) ? 'true' : 'false';
                    $settings[ $values['id'] ] = $new_value;
                    continue;
                }

                if ( $values['type'] === 'checkbox' ) {
                    foreach ( $values['choices'] as $key => $val ) {
                        $settings[$values['id']][$key] = (string) sanitize_text_field( $_POST[ $values['id'] ][$key] );
                    }
                    continue;
                }

                if ( $values['type'] === 'textarea' && isset( $values['allow_tags'] ) ) {
                    $settings[ $values['id'] ] = (string) addslashes( wp_kses( stripslashes( $_POST[ $values['id'] ] ), STI_Admin_Helpers::get_kses( $values['allow_tags'] ) ) );
                    continue;
                }

                if ( $values['type'] === 'display_rules' ) {
                    $new_value = isset( $_POST[ $values['id'] ] ) ? $_POST[ $values['id'] ]: array();
                    $settings[ $values['id'] ] = $new_value;
                    continue;
                }

                if ( $values['type'] === 'sortable_table' ) {

                    $table_keys = array_map( 'sanitize_text_field', array_keys( $_POST[ $values['id'] ] ) );
                    $sorted_table = array_merge( array_flip( $table_keys ), $values['choices'] );
                    $table_options = array();

                    foreach ( $sorted_table as $key => $opts_arr ) {
                        foreach( $opts_arr as $opt_name => $opt_val ) {
                            if ( $opt_name === 'name' ) continue;
                            $table_options[$key][$opt_name] = isset( $_POST[ $values['id'] ][$key][$opt_name] ) ? (string) sanitize_text_field( $_POST[ $values['id'] ][$key][$opt_name] ) : 'false';
                        }
                    }

                    $settings[$values['id']] = $table_options;

                    continue;
                }

                $new_value = isset( $_POST[ $values['id'] ] ) ? $_POST[ $values['id'] ] : '';
                $settings[ $values['id'] ] = (string) sanitize_text_field( $new_value );

            }

            update_option( 'sti_settings', $settings );

        }

        /*
         * Get plugin settings
         * @return array
         */
        static public function get_settings() {
            $plugin_options = get_option( 'sti_settings' );
            return $plugin_options;
        }

        /*
         * Options array that generate settings page
         *
         * @param string $tab Tab name
         * @return array
         */
        static public function options_array( $tab = false, $section = false  ) {

            $options = self::include_options();
            $options_arr = array();

            /**
             * Filter the array of plugin options
             * @since 1.31
             * @param array $options Array of options
             */
            $options = apply_filters( 'sti_all_options', $options );

            foreach ( $options as $tab_name => $tab_options ) {

                if ( $tab && $tab !== $tab_name ) {
                    continue;
                }

                foreach ( $tab_options as $option ) {

                    if ( $section ) {

                        if ( ( isset( $option['section'] ) && $option['section'] !== $section ) || ( !isset( $option['section'] ) && $section !== 'none' ) ) {
                            continue;
                        }

                    }

                    $options_arr[$tab_name][] = $option;

                }

            }

            return $options_arr;

        }

        /*
         * Include options array
         * @return array
         */
        static public function include_options() {

            $options = array();

            $options['general'][] = array(
                "name"    => __( "What to Share", "share-this-image" ),
                "desc"    => '',
                "type"    => "heading"
            );

            $options['general'][] = array(
                "name"    => __( "Display rules", "share-this-image" ),
                "desc"    => __( "Choose what images on what pages must be available for sharing.", "share-this-image" ) . '<br>' .
                             __( "By default all images on all pages are available for sharing.", "share-this-image" ),
                "id"      => "display_rules",
                "value"   => array(
                    "group_1" => array(
                        "rule_1" => array(
                            "param" => "image",
                            "operator" => "equal",
                            "value" => "sti_any",
                        ),
                        "rule_2" => array(
                            "param" => "page",
                            "operator" => "equal",
                            "value" => "sti_any",
                        ),
                    ),
                ),
                "type"    => "display_rules",
            );

            $options['general'][] = array(
                "name"    => __( "Buttons to display", "share-this-image" ),
                "desc"    => '',
                "type"    => "heading"
            );

            $options['general'][] = array(
                "name"  => __( "Sharing buttons", "share-this-image" ),
                "desc"  => __( "Enable or disable sharing buttons for desktop and mobile. Drag & drop to change the order.", "share-this-image" ),
                "id"    => "buttons",
                "value" => array(),
                "type"  => "sortable_table",
                'choices' => array(
                    "facebook" => array(
                        'name'    => __( "Facebook", "share-this-image" ),
                        'desktop' => 'true',
                        'mobile'  => 'true'
                    ),
                    "twitter" => array(
                        'name'    => __( "Twitter", "share-this-image" ),
                        'desktop' => 'true',
                        'mobile'  => 'true'
                    ),
                    "linkedin" => array(
                        'name'    => __( "LinkedIn", "share-this-image" ),
                        'desktop' => 'true',
                        'mobile'  => 'true'
                    ),
                    "pinterest" => array(
                        'name'    => __( "Pinterest", "share-this-image" ),
                        'desktop' => 'true',
                        'mobile'  => 'true'
                    ),
                    "messenger" => array(
                        'name'    => __( "Messenger", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                    "whatsapp" => array(
                        'name'    => __( "WhatsApp", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                    "telegram" => array(
                        'name'    => __( "Telegram", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                    "tumblr" => array(
                        'name'    => __( "Tumblr", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                    "reddit" => array(
                        'name'    => __( "Reddit", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                    "vkontakte" => array(
                        'name'    => __( "Vkontakte", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                    "odnoklassniki" => array(
                        'name'    => __( "Odnoklassniki", "share-this-image" ),
                        'desktop' => 'false',
                        'mobile'  => 'false'
                    ),
                )
            );

            $options['general'][] = array(
                "name"    => __( "Display Settings", "share-this-image" ),
                "desc"    => '',
                "type"    => "heading"
            );

            $options['general'][] = array(
                "name"  => __( "Buttons position", "share-this-image" ),
                "desc"  => __( "Choose sharing buttons position.", "share-this-image" ) . '<br>' .
                    __( "NOTE: Enabling some positions can cause problems with images inside sliders, galleries, etc.", "share-this-image" ),
                "id"    => "position",
                "value" => 'image_hover',
                "type"  => "radio",
                'choices' => array(
                    'image'       => __( 'On image ( always show )', 'share-this-image' ),
                    'image_hover' => __( 'On image ( show on mouse enter )', 'share-this-image' ),
                )
            );

            $options['general'][] = array(
                "name"  => __( "Minimal width", "share-this-image" ),
                "desc"  => __( "Minimum width of image in pixels to use for sharing.", "share-this-image" ),
                "id"    => "minWidth",
                "value" => '150',
                "type"  => "number"
            );

            $options['general'][] = array(
                "name"  => __( "Minimal height", "share-this-image" ),
                "desc"  => __( "Minimum height of image in pixels to use for sharing.", "share-this-image" ),
                "id"    => "minHeight",
                "value" => '150',
                "type"  => "number"
            );

            $options['general'][] = array(
                "name"  => __( "Facebook app id", "share-this-image" ),
                "desc"  => __( "Required for FB Messenger sharing. Read more", "share-this-image" ) . ' <a href="https://share-this-image.com/guide/facebook-app-id/" target="_blank">' . __( 'here.', 'share-this-image' ) . '</a>' ,
                "id"    => "fb_app",
                "value" => '',
                "type"  => "text"
            );

            $options['general'][] = array(
                "name"  => __( "Twitter via", "share-this-image" ),
                "desc"  => __( "Set twitters 'via' property.", "share-this-image" ),
                "id"    => "twitter_via",
                "value" => '',
                "type"  => "text"
            );

            $options['general'][] = array(
                "name"  => __( "Enable on mobile?", "share-this-image" ),
                "desc"  => __( "Enable image sharing on mobile devices", "share-this-image" ),
                "id"    => "on_mobile",
                "value" => 'true',
                "type"  => "radio",
                'choices' => array(
                    'true' => __( 'On', 'share-this-image' ),
                    'false' => __( 'Off', 'share-this-image' )
                )
            );

            $options['general'][] = array(
                "name"  => __( "Short links", "share-this-image" ),
                "desc"  => __( "Use or not short links method.", "share-this-image" ),
                "id"    => "short_url",
                "inherit" => "true",
                "value" => 'sti',
                "type"  => "radio",
                'choices' => array(
                    'sti'   => sprintf( __( 'STI links shortener. Links will look like: %s', 'share-this-image' ), home_url( '/' ) . 'sti/1485507' ),
                    'no'    => __( 'Off', 'share-this-image' ),
                )
            );

            $options['general'][] = array(
                "name"  => __( "Use intermediate page.", "share-this-image" ),
                "desc"  => __( "If you have some problems with redirection from social networks to page with sharing image try to switch Off this option.", "share-this-image" ) . '</br>' .
                    __( "But before apply it need to be tested to ensure that all work's fine.", 'share-this-image' ),
                "id"    => "sharer",
                "value" => 'true',
                "type"  => "radio",
                'choices' => array(
                    'true'  => __( 'On', 'share-this-image' ),
                    'false' => __( 'Off', 'share-this-image' )
                )
            );

            $options['general'][] = array(
                "name"  => __( "Google Analytics", "share-this-image" ),
                "desc"  => __( "Use google analytics to track social buttons clicks. Need google analytics to be installed on your site.", "share-this-image" ) .
                    '<br>' . __( "Will be send the event with category - 'STI click', action - 'social button name' and label of value of image URL.", "share-this-image" ) .
                    ' <a href="https://share-this-image.com/guide/google-analytics/" target="_blank">' . __( 'More info', 'share-this-image' ) . '</a>' ,
                "id"    => "use_analytics",
                "value" => 'false',
                "type"  => "radio",
                'choices' => array(
                    'true'  => __( 'On', 'share-this-image' ),
                    'false' => __( 'Off', 'share-this-image' )
                )
            );

            $options['content'][] = array(
                "name"    => "",
                "desc"    => sprintf( __( 'Plugin has %s special rules %s how to choose what title and description to use for sharing.', 'share-this-image' ), '<a href="https://share-this-image.com/guide/customize-content/" target="_blank">', '</a>' ) . '<br>' .
                    __( 'There is different sources that plugin look in step by step searching for content according to priority of this sources.', 'share-this-image' ) . '<br>' .
                    __( 'Also with PRO plugin version you can change priority of this sources or even disable/enable some of them.', 'share-this-image' ) . '<br>' . '<br>' .
                    __( "For title: 'data-title attribute' -> 'image title attribute' -> 'default title option' -> 'page title'", "share-this-image" ) . '<br>' .
                    __( "For description: 'data-summary attribute' -> 'image caption' -> 'image alt attribute' -> 'default description option'", "share-this-image" ) . '<br>' . '<br>' .
                    sprintf( __( "It is also possible to create your fully unique title and description with help of special %s variables and conditions %s.", "share-this-image" ), '<a href="https://share-this-image.com/guide/customize-content/" target="_blank">', '</a>' ),
                "type"    => "heading"
            );

            $options['content'][] = array(
                "name"    => __( "Default Content", "share-this-image" ),
                "desc"    => '',
                "type"    => "heading"
            );

            $options['content'][] = array(
                "name"  => __( "Default Title", "share-this-image" ),
                "desc"  => __( "Content for 'Default Title' source.", "share-this-image" ),
                "id"    => "title",
                "value" => '',
                "type"  => "text"
            );

            $options['content'][] = array(
                "name"  => __( "Default Description", "share-this-image" ),
                "desc"  => __( "Content for 'Default Description' source.", "share-this-image" ),
                "id"    => "summary",
                "value" => '',
                "type"  => "textarea",
                'allow_tags' => array( 'a', 'br', 'em', 'strong', 'b', 'code', 'blockquote', 'p', 'i' )
            );

            return $options;

        }

        /*
       * Include display rules
       * @return array
       */
        static public function include_rules() {

            $options = array();

            $options['common'][] = array(
                "name" => __( "Selector", "share-this-image" ),
                "id"   => "selector",
                "type" => "text",
                'placeholder' => __( "Image css selector", "share-this-image" ) . ' ( default = img )',
                "operators" => "equals",
            );

            $options['image'][] = array(
                "name" => __( "Image", "share-this-image" ),
                "id"   => "image",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_images',
                    'params'   => array()
                ),
            );

            $options['image'][] = array(
                "name" => __( "Image URL", "share-this-image" ),
                "id"   => "image_url",
                "type" => "text",
                'placeholder' => '',
                "operators" => "equals_compare",
            );

            $options['image'][] = array(
                "name" => __( "Image format", "share-this-image" ),
                "id"   => "image_format",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_image_formats',
                    'params'   => array()
                ),
            );

            $options['post'][] = array(
                "name" => __( "Post", "share-this-image" ),
                "id"   => "post",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_posts',
                    'params'   => array()
                ),
                "suboption" => array(
                    'callback' => 'STI_Admin_Helpers::get_post_types',
                    'params'   => array()
                ),
            );

            $options['post'][] = array(
                "name" => __( "Post type", "share-this-image" ),
                "id"   => "post_type",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_post_types',
                    'params'   => array()
                ),
            );

            $options['page'][] = array(
                "name" => __( "Page", "share-this-image" ),
                "id"   => "page",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_pages',
                    'params'   => array()
                ),
            );

            $options['page'][] = array(
                "name" => __( "Page ID", "share-this-image" ),
                "id"   => "page_id",
                "type" => "number",
                "operators" => "equals",
            );

            $options['page'][] = array(
                "name" => __( "Page URL", "share-this-image" ),
                "id"   => "page_url",
                "type" => "text",
                'placeholder' => sprintf( __( 'Full page URL, e.g: %s', 'share-this-image' ), home_url( '/' ) . 'my-page/' ),
                "operators" => "equals_compare",
            );

            $options['page'][] = array(
                "name" => __( "Page template", "share-this-image" ),
                "id"   => "page_template",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_page_templates',
                    'params'   => array()
                ),
            );

            $options['page'][] = array(
                "name" => __( "Page type", "share-this-image" ),
                "id"   => "page_type",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_page_type',
                    'params'   => array()
                ),
            );

            $options['page'][] = array(
                "name" => __( "Page archives", "share-this-image" ),
                "id"   => "page_archives",
                "type" => "callback",
                "operators" => "equals",
                "choices" => array(
                    'callback' => 'STI_Admin_Helpers::get_page_archive_terms',
                    'params'   => array()
                ),
                "suboption" => array(
                    'callback' => 'STI_Admin_Helpers::get_page_archives',
                    'params'   => array()
                ),
            );

            /**
             * Filter display rules
             * @since 1.60
             * @param array $options Array of label rules
             */
            $options = apply_filters( 'sti_display_rules', $options );

            return $options;

        }

        /*
         * Rules operators
         * @param $name string Operator name
         * @return array
         */
        static public function get_rule_operators( $name ) {

            $operators = array();

            $operators['equals'] = array(
                array(
                    "name" => __( "equal to", "share-this-image" ),
                    "id"   => "equal",
                ),
                array(
                    "name" => __( "not equal to", "share-this-image" ),
                    "id"   => "not_equal",
                ),
            );

            $operators['equals_compare'] = array(
                array(
                    "name" => __( "equal to", "share-this-image" ),
                    "id"   => "equal",
                ),
                array(
                    "name" => __( "not equal to", "share-this-image" ),
                    "id"   => "not_equal",
                ),
                array(
                    "name" => __( "contains", "share-this-image" ),
                    "id"   => "contains",
                ),
                array(
                    "name" => __( "not contains", "share-this-image" ),
                    "id"   => "not_contains",
                ),
            );

            return $operators[$name];

        }

        /*
         * Include rule array by rule id
         * @return array
         */
        static public function include_rule_by_id( $id ) {

            $rules = STI_Admin_Options::include_rules();
            $rule = array();

            if ( $rules ) {
                foreach ( $rules as $rule_section => $section_rules ) {
                    foreach ( $section_rules as $section_rule ) {
                        if ( $section_rule['id'] === $id ) {
                            $rule = $section_rule;
                            break;
                        }
                    }
                }
            }

            if ( empty( $rule ) ) {
                $rule = $rules['attributes'][0];
            }

            return $rule;

        }

        /*
         * Get section name
         * @param $name string Section id
         * @return string
         */
        static public function get_rule_section( $name ) {

            $label = $name;

            $sections = array(
                'common'     => __( "Common", "share-this-image" ),
                'page'       => __( "Page", "share-this-image" ),
                'post'       => __( "Post", "share-this-image" ),
                'image'      => __( "Image", "share-this-image" ),
            );

            if ( isset( $sections[$name] ) ) {
                $label = $sections[$name];
            }

            return $label;

        }

    }

endif;