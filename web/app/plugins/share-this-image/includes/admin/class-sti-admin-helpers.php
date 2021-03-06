<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if ( ! class_exists( 'STI_Admin_Helpers' ) ) :

    /**
     * Class for plugin help methods
     */
    class STI_Admin_Helpers {

        /*
         * Get array of options terms groups
         */
        static public function get_svg( $icon_name ) {

            $icon = '';

            $icon_arr = array(
                'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>',
                'messenger' => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"<g><path d="M12,0A11.77,11.77,0,0,0,0,11.5,11.28,11.28,0,0,0,3.93,20L3,23.37A.5.5,0,0,0,3.5,24a.5.5,0,0,0,.21,0l3.8-1.78A12.39,12.39,0,0,0,12,23,11.77,11.77,0,0,0,24,11.5,11.77,11.77,0,0,0,12,0Zm7.85,8.85-6,6a.5.5,0,0,1-.68,0L9.94,12.1l-5.2,2.83a.5.5,0,0,1-.59-.79l6-6a.5.5,0,0,1,.68,0l3.24,2.78,5.2-2.83a.5.5,0,0,1,.59.79Z"/></g></svg>',
                'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>',
                'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"/></svg>',
                'reddit' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 11.5c0-1.65-1.35-3-3-3-.96 0-1.86.48-2.42 1.24-1.64-1-3.75-1.64-6.07-1.72.08-1.1.4-3.05 1.52-3.7.72-.4 1.73-.24 3 .5C17.2 6.3 18.46 7.5 20 7.5c1.65 0 3-1.35 3-3s-1.35-3-3-3c-1.38 0-2.54.94-2.88 2.22-1.43-.72-2.64-.8-3.6-.25-1.64.94-1.95 3.47-2 4.55-2.33.08-4.45.7-6.1 1.72C4.86 8.98 3.96 8.5 3 8.5c-1.65 0-3 1.35-3 3 0 1.32.84 2.44 2.05 2.84-.03.22-.05.44-.05.66 0 3.86 4.5 7 10 7s10-3.14 10-7c0-.22-.02-.44-.05-.66 1.2-.4 2.05-1.54 2.05-2.84zM2.3 13.37C1.5 13.07 1 12.35 1 11.5c0-1.1.9-2 2-2 .64 0 1.22.32 1.6.82-1.1.85-1.92 1.9-2.3 3.05zm3.7.13c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9.8 4.8c-1.08.63-2.42.96-3.8.96-1.4 0-2.74-.34-3.8-.95-.24-.13-.32-.44-.2-.68.15-.24.46-.32.7-.18 1.83 1.06 4.76 1.06 6.6 0 .23-.13.53-.05.67.2.14.23.06.54-.18.67zm.2-2.8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm5.7-2.13c-.38-1.16-1.2-2.2-2.3-3.05.38-.5.97-.82 1.6-.82 1.1 0 2 .9 2 2 0 .84-.53 1.57-1.3 1.87z"/></svg>',
                'pinterest' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.14.5C5.86.5 2.7 5 2.7 8.75c0 2.27.86 4.3 2.7 5.05.3.12.57 0 .66-.33l.27-1.06c.1-.32.06-.44-.2-.73-.52-.62-.86-1.44-.86-2.6 0-3.33 2.5-6.32 6.5-6.32 3.55 0 5.5 2.17 5.5 5.07 0 3.8-1.7 7.02-4.2 7.02-1.37 0-2.4-1.14-2.07-2.54.4-1.68 1.16-3.48 1.16-4.7 0-1.07-.58-1.98-1.78-1.98-1.4 0-2.55 1.47-2.55 3.42 0 1.25.43 2.1.43 2.1l-1.7 7.2c-.5 2.13-.08 4.75-.04 5 .02.17.22.2.3.1.14-.18 1.82-2.26 2.4-4.33.16-.58.93-3.63.93-3.63.45.88 1.8 1.65 3.22 1.65 4.25 0 7.13-3.87 7.13-9.05C20.5 4.15 17.18.5 12.14.5z"/></svg>',
				'whatsapp' => '<svg enable-background="new 0 0 100 100" version="1.1" viewBox="0 0 100 100" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><defs><rect height="100" id="SVGID_1_" width="100"/></defs><path d="M95,49.247c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L5,95.406   l7.975-23.522c-4.023-6.606-6.34-14.354-6.34-22.637c0-24.213,19.781-43.841,44.184-43.841C75.223,5.406,95,25.034,95,49.247    M50.818,12.388c-20.484,0-37.146,16.535-37.146,36.859c0,8.066,2.629,15.535,7.076,21.611l-4.641,13.688l14.275-4.537   c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.858C87.964,28.924,71.301,12.388,50.818,12.388    M73.129,59.344c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.494c-0.993-0.359-1.717-0.539-2.438,0.536   c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.334   c-3.219-2.847-5.393-6.364-6.025-7.44c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882   c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.976   c-0.902-2.151-1.803-1.793-2.436-1.793c-0.631,0-1.354-0.09-2.076-0.09s-1.896,0.269-2.889,1.344   c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.114c0.541,0.716,7.49,11.92,18.5,16.223   C63.2,71.177,63.2,69.742,65.186,69.562c1.984-0.179,6.406-2.599,7.312-5.107C73.398,61.943,73.398,59.792,73.129,59.344"/></g></svg>',
                'telegram' => '<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path></svg>',
                'vkontakte' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.547 7h-3.29a.743.743 0 0 0-.655.392s-1.312 2.416-1.734 3.23C14.734 12.813 14 12.126 14 11.11V7.603A1.104 1.104 0 0 0 12.896 6.5h-2.474a1.982 1.982 0 0 0-1.75.813s1.255-.204 1.255 1.49c0 .42.022 1.626.04 2.64a.73.73 0 0 1-1.272.503 21.54 21.54 0 0 1-2.498-4.543.693.693 0 0 0-.63-.403h-2.99a.508.508 0 0 0-.48.685C3.005 10.175 6.918 18 11.38 18h1.878a.742.742 0 0 0 .742-.742v-1.135a.73.73 0 0 1 1.23-.53l2.247 2.112a1.09 1.09 0 0 0 .746.295h2.953c1.424 0 1.424-.988.647-1.753-.546-.538-2.518-2.617-2.518-2.617a1.02 1.02 0 0 1-.078-1.323c.637-.84 1.68-2.212 2.122-2.8.603-.804 1.697-2.507.197-2.507z"/></svg>',
                'tumblr' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.5.5v5h5v4h-5V15c0 5 3.5 4.4 6 2.8v4.4c-6.7 3.2-12 0-12-4.2V9.5h-3V6.7c1-.3 2.2-.7 3-1.3.5-.5 1-1.2 1.4-2 .3-.7.6-1.7.7-3h3.8z"/></svg>',
                'odnoklassniki' => '<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M22,15c-1,0-3,2-7,2s-6-2-7-2c-1.104,0-2,0.896-2,2c0,1,0.568,1.481,1,1.734C8.185,19.427,12,21,12,21l-4.25,5.438  c0,0-0.75,0.935-0.75,1.562c0,1.104,0.896,2,2,2c1.021,0,1.484-0.656,1.484-0.656S14.993,23.993,15,24  c0.007-0.007,4.516,5.344,4.516,5.344S19.979,30,21,30c1.104,0,2-0.896,2-2c0-0.627-0.75-1.562-0.75-1.562L18,21  c0,0,3.815-1.573,5-2.266C23.432,18.481,24,18,24,17C24,15.896,23.104,15,22,15z" id="K"/><path d="M15,0c-3.866,0-7,3.134-7,7s3.134,7,7,7c3.865,0,7-3.134,7-7S18.865,0,15,0z M15,10.5c-1.933,0-3.5-1.566-3.5-3.5  c0-1.933,1.567-3.5,3.5-3.5c1.932,0,3.5,1.567,3.5,3.5C18.5,8.934,16.932,10.5,15,10.5z" id="O"/></svg>',
            );

            /**
             * Filter the array of social icons
             * @since 1.31
             * @param array $icon_arr Array of icons
             */
            $icon_arr = apply_filters( 'sti_svg_icons', $icon_arr );

            if ( $icon_name && isset( $icon_arr[$icon_name] ) ) {
                $icon = $icon_arr[$icon_name];
            }

            return $icon;

        }

        /**
         * Get array of allowed tags for wp_kses function
         * @param array $allowed_tags Tags that is allowed to display
         * @return array $tags
         */
        static public function get_kses( $allowed_tags = array() ) {

            $tags = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'b' => array(),
                'code' => array(),
                'blockquote' => array(
                    'cite' => array(),
                ),
                'p' => array(),
                'i' => array(),
                'h1' => array(),
                'h2' => array(),
                'h3' => array(),
                'h4' => array(),
                'h5' => array(),
                'h6' => array(),
                'img' => array(
                    'alt' => array(),
                    'src' => array()
                )
            );

            if ( is_array( $allowed_tags ) && ! empty( $allowed_tags ) ) {
                foreach ( $tags as $tag => $tag_arr ) {
                    if ( array_search( $tag, $allowed_tags ) === false ) {
                        unset( $tags[$tag] );
                    }
                }

            }

            return $tags;

        }

        /*
         * Get available post types
         * @return array
         */
        static public function get_post_types() {

            $options = array();

            $args = array(
                'public' => true,
            );
            $post_types = get_post_types( $args, 'object' );

            if ( $post_types && ! empty( $post_types ) ) {
                foreach( $post_types as $post_type_name => $post_type ) {

                    if ( in_array( $post_type->name, array( 'attachment' ) ) ) {
                        continue;
                    }

                    $options[] = array(
                        'name'  => $post_type->label,
                        'value' => $post_type->name
                    );

                }
            }

            return $options;

        }

        /*
         * Get post type items
         * @param $name string Post type name
         * @return array
         */
        static public function get_posts( $name = false ) {

            if ( ! $name ) {
                return false;
            }

            $options = array();

            $args = array(
                'post_type'   => $name,
                'numberposts' => -1,
                'post_status' => 'any'
            );

            $posts = get_posts( $args );

            if ( ! empty( $posts ) ) {
                foreach ( $posts as $post ) {
                    $title = $post->post_title ? $post->post_title :  __( "(no title)", "share-this-image" ) . ' (ID = ' . $post->ID . ')';
                    $options[$post->ID] = $title;
                }
            }

            return $options;

        }

        /*
         * Get available post taxonomies
         * @param $name string Post type name
         * @return array
         */
        static public function get_post_taxonomies( $name = false ) {

            if ( ! $name ) {
                return false;
            }

            $options = array();
            $taxonomy_objects = get_object_taxonomies( $name, 'objects' );

            foreach( $taxonomy_objects as $taxonomy_object ) {

                $options[] = array(
                    'name'  => $taxonomy_object->label,
                    'value' => $taxonomy_object->name
                );

            }

            return $options;

        }

        /*
         * Get available images
         * @return array
         */
        static public function get_images() {

            $options = array();

            $args = array(
                'post_type'      => 'attachment',
                'numberposts'    => -1,
                'post_status'    => 'any',
                'post_mime_type' => 'image',
            );

            $images = get_posts( $args );

            $options['sti_any'] = __( "Any", "share-this-image" );

            if ( ! empty( $images ) ) {
                foreach ( $images as $image ) {
                    $options[$image->ID] = $image->post_title;
                }
            }

            return $options;

        }

        /*
         * Get available image formats
         * @return array
         */
        static public function get_image_formats() {

            $options = array();

            $values = array(
                'jpeg' => 'JPEG',
                'gif'  => 'GIF',
                'png'  => 'PNG',
                'svg'  => 'SVG',
                'webp' => 'WebP',
                'tiff' => 'TIFF',
                'bmp'  => 'Bitmap',
                'eps'  => 'EPS',
                'heif' => 'HEIF',
            );

            $options['sti_any'] = __( "Any", "share-this-image" );

            foreach ( $values as $value_val => $value_name ) {
                $options[$value_val] = $value_name;
            }

            return $options;

        }

        /*
         * Get available taxonomies_terms
         * @param $name string Tax name
         * @return array
         */
        static public function get_tax_terms( $name = false ) {

            if ( ! $name ) {
                return false;
            }

            $tax = get_terms( array(
                'taxonomy'   => $name,
                'hide_empty' => false,
            ) );

            $options = array();

            if ( $name && $name === 'product_shipping_class' ) {
                $options['none'] = __( "No shipping class", "share-this-image" );
            }

            if ( ! empty( $tax ) ) {
                foreach ( $tax as $tax_item ) {
                    $options[$tax_item->term_id] = $tax_item->name;
                }
            }

            return $options;

        }

        /*
         * Get all available pages
         * @return array
         */
        static public function get_pages() {

            $pages = get_pages( array( 'parent' => 0, 'hierarchical' => 0 ) );
            $options = array();

            $options['sti_any'] = __( "Any", "share-this-image" );

            if ( $pages && ! empty( $pages ) ) {

                foreach( $pages as $page ) {

                    $title = $page->post_title ? $page->post_title :  __( "(no title)", "share-this-image" );

                    $options[$page->ID] = $title;

                    $child_pages = get_pages( array( 'child_of' => $page->ID ) );

                    if ( $child_pages && ! empty( $child_pages ) ) {

                        foreach( $child_pages as $child_page ) {

                            $page_prefix = '';
                            $parents_number = sizeof( $child_page->ancestors );

                            if ( $parents_number && is_int( $parents_number ) ) {
                                $page_prefix = str_repeat( "-", $parents_number );
                            }

                            $title = $child_page->post_title ? $child_page->post_title :  __( "(no title)", "share-this-image" );
                            $title = $page_prefix . $title;

                            $options[$child_page->ID] = $title;

                        }

                    }

                }

            }

            return $options;

        }

        /*
         * Get all available page templates
         * @return array
         */
        static public function get_page_templates() {

            $page_templates = get_page_templates();
            $options = array();

            $options['default'] = __( 'Default template', 'share-this-image' );

            if ( $page_templates && ! empty( $page_templates ) ) {
                foreach( $page_templates as $page_template_name => $page_template_file ) {
                    $options[] = array(
                        'name'  => $page_template_name,
                        'value' => $page_template_file
                    );
                }
            }

            return $options;

        }

        /*
         * Get available pages types
         * @return array
         */
        static public function get_page_type() {

            $options = array();

            $types = array(
                'front' => __( 'Front page', 'share-this-image' ),
                'posts' => __( 'Posts page', 'share-this-image' ),
                'search' => __( 'Search results page', 'share-this-image' ),
                'archive' => __( 'Archive page', 'share-this-image' ),
                'tax_page' => __( 'Custom taxonomy archive page', 'share-this-image' ),
                'page' => __( 'Simple page', 'share-this-image' ),
                'singular' => __( 'Singular page', 'share-this-image' ),
                '404' => __( '404 error page', 'share-this-image' ),
            );

            foreach( $types as $type_slug => $type_name ) {
                $options[$type_slug] = $type_name;
            }

            return $options;

        }

        /*
         * Get available archive pages
         * @return array
         */
        static public function get_page_archives() {

            $options = array();

            $args = array(
                'public' => true,
            );
            $post_types = get_post_types( $args, 'object' );

            if ( $post_types && ! empty( $post_types ) ) {
                foreach( $post_types as $post_type_name => $post_type ) {

                    if ( in_array( $post_type->name, array( 'attachment', 'page' ) ) ) {
                        continue;
                    }

                    $taxonomies = get_object_taxonomies( $post_type->name, 'objects' );

                    if ( $taxonomies && ! empty( $taxonomies) ) {
                        foreach ( $taxonomies as $tax ) {
                            if ( ( property_exists( $tax, 'has_archive' ) && $tax->has_archive ) || $tax->public || $tax->publicly_queryable ) {
                                $options[] = array(
                                    'name'  => $tax->label,
                                    'value' => $tax->name
                                );
                            }
                        }
                    }

                }
            }

            return $options;

        }

        /*
         * Get available archive pages terms
         * @return array
         */
        static public function get_page_archive_terms( $name = false ) {

            if ( ! $name ) {
                return false;
            }

            $options = array();

            switch( $name ) {

                case 'attributes':

                    if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
                        $attributes = wc_get_attribute_taxonomies();

                        if ( $attributes && ! empty( $attributes ) ) {
                            foreach( $attributes as $attribute ) {
                                if ( $attribute->attribute_public ) {

                                    $options[] = array(
                                        'name'  => $attribute->attribute_label,
                                        'value' => wc_attribute_taxonomy_name( $attribute->attribute_name )
                                    );

                                }
                            }
                        }

                    }

                    break;

                default:

                    $options = STI_Admin_Helpers::get_tax_terms( $name );

            }

            return $options;

        }

    }

endif;