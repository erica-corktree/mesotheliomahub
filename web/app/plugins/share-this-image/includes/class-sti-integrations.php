<?php
/**
 * STI integrations
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'STI_Integrations' ) ) :

    /**
     * Class for main plugin functions
    */
    class STI_Integrations {

        /**
         * @var STI_Integrations The single instance of the class
         */
        protected static $_instance = null;

        /**
         * Main STI_Integrations Instance
         *
         * Ensures only one instance of STI_Integrations is loaded or can be loaded.
         *
         * @static
         * @return STI_Integrations - Main instance
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        /**
         * Setup actions and filters for all things settings
         */
        public function __construct() {

            $this->includes();

            // Metaslider plugin
            add_filter( 'metaslider_flex_slider_parameters', array( $this, 'metaslider_flex_slider_parameters' ) );
            //add_filter( 'metaslider_nivo_slider_parameters', array( $this, 'metaslider_nivo_slider_parameters' ) );

            // Photo Gallery plugin
            if ( class_exists( 'BWG' ) ) {
                add_action( 'wp_enqueue_scripts', array( $this, 'bwg_wp_enqueue_scripts' ), 9999999 );
            }

            // SimpLy Gallery Block & Lightbox plugin
            if ( defined('PGC_SGB_VERSION') ) {
                add_action( 'wp_head', array( $this, 'pgc_wp_head' ) );
                add_action( 'wp_enqueue_scripts', array( $this, 'pgc_wp_enqueue_scripts' ), 9999999 );
            }

            // Simple Lightbox plugin
            if ( function_exists( 'slb_init' ) ) {
                add_action( 'wp_head', array( $this, 'slb_wp_head' ) );
            }

            // Envira gallery plugin
            if ( class_exists( 'Envira_Gallery' ) || class_exists( 'Envira_Gallery_Lite' ) ) {
                add_action( 'wp_enqueue_scripts', array( $this, 'envira_wp_enqueue_scripts' ), 9999999 );
            }

        }

        /**
         * Include files
         */
        public function includes() {

            // Gutenberg block
            if ( function_exists( 'register_block_type' ) ) {
                include_once( STI_DIR . '/includes/modules/gutenberg/class-sti-gutenberg-init.php' );
            }

        }

        /*
         * Metaslider flex slider integration
         */
        public function metaslider_flex_slider_parameters( $options ) {

            $settings = $this->get_settings();

            $options['after'] = 'function(slider){ $("'. esc_html( stripslashes( 'img' ) ) .'").sti(); }';

            return $options;
        }

        /*
        * Metaslider nivo slider integration
        */
        public function metaslider_nivo_slider_parameters( $options ) {

            $settings = $this->get_settings();

            $options['afterChange'] = 'function(){ $("'. esc_html( stripslashes( 'img' ) ) .', .nivo-main-image").sti(); }';

            return $options;

        }

        /*
         * Photo Gallery plugin
         */
        public function bwg_wp_enqueue_scripts() {

            $script = "
                document.addEventListener('stiLoaded', function() {
                
                    function bwg_sti_share_container( el ) {
                      if ( el.closest('.bwg-item').length > 0 ) {
                          el = false;
                      }
                      return el;
                    }
                    StiHooks.add_filter( 'sti_share_container', bwg_sti_share_container );
                  
                    var timeoutID;
                      jQuery('body').on('DOMSubtreeModified', '#spider_popup_wrap', function() {
                        window.clearTimeout(timeoutID);
                        timeoutID = window.setTimeout( function() {
                            jQuery('.bwg_popup_image').sti( { 'position' : 'image' } );
                        }, 1000 );
                    });
                
                }, false);
            ";

            wp_add_inline_script( 'sti-script', $script);

        }

        /*
         * SimpLy Gallery plugin: custom styles
         */
        public function pgc_wp_head() {

            echo '<style>
            .pgc-rev-lb-b-view.pgc-rev-lb-b-activate {
                z-index: 2147483 !important;
            }
            </style>';

        }

        /*
         * SimpLy Gallery plugin: custom js
         */
        public function pgc_wp_enqueue_scripts() {

            $script = "
                document.addEventListener('stiLoaded', function() {
                    var timeoutID;
                    jQuery(document).on( 'click', '.action-lightbox', function() {                  
                        timeoutID = window.setTimeout( function() {
                            jQuery('.pgc-rev-lb-b-activate img').sti();
                        }, 1000 );
                    } );
                }, false);
            ";

            wp_add_inline_script( 'sti-script', $script);

        }

        /*
         * Simple Lightbox plugin: fix styles inside lightbox
         */
        public function slb_wp_head() {

            $css_file_url = STI_URL . '/assets/css/sti.css';
            $css_file_dir = STI_DIR . '/assets/css/sti.css';

            $css_styles = file_get_contents( $css_file_dir );

            $css_styles = str_replace('.sti ', '#slb_viewer_wrap .slb_theme_slb_baseline .sti ', $css_styles );
            $css_styles = str_replace('.sti.', '#slb_viewer_wrap .slb_theme_slb_baseline .sti.', $css_styles );
            $css_styles = str_replace('.sti-mobile-btn', '#slb_viewer_wrap .slb_theme_slb_baseline .sti-mobile-btn', $css_styles );

            $css_styles = '#slb_viewer_wrap .slb_theme_slb_baseline .sti { width: auto !important; height: auto  !important; }' . $css_styles;
            $css_styles = '#slb_viewer_wrap .slb_theme_slb_baseline .sti-mobile-btn { width: 36px !important; height: 36px !important; }' . $css_styles;
            $css_styles = '.sti.sti-top.sti-mobile { z-index: 999999; }' . $css_styles;

            echo '<style>' . $css_styles . '</style>';

        }

        /*
         * Envira gallery: relayout sharingbuutons on images load
         */
        public function envira_wp_enqueue_scripts() {

            $script = "
                document.addEventListener('stiLoaded', function() {
                
                     var mylazyTimeoutID;
                     jQuery( document ).on( 'envira_image_lazy_load_complete', function( event ) {
                        window.clearTimeout(mylazyTimeoutID);
                        mylazyTimeoutID = window.setTimeout( function() {
                            jQuery('.envira-gallery-wrap img').sti('relayout');
                        }, 100 );
                     });
                            
                }, false);
            ";

            wp_add_inline_script( 'sti-script', $script);

        }

        /*
         * Register plugin settings
         */
        public function get_settings( $id = false ) {
            $sti_options = get_option( 'sti_settings' );
            if ( $id ) {
                return $sti_options[ $id ];
            } else {
                return $sti_options;
            }
        }

    }

endif;