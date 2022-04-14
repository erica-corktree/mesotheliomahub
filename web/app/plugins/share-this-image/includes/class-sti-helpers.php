<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if ( ! class_exists( 'STI_Helpers' ) ) :

    /**
     * Class for plugin help methods
     */
    class STI_Helpers {

        /**
         * Generate images css selector
         * @param array $condition Display conditions
         * @return string Css selector
         */
        static public function generate_css_selector( $condition ) {

            $selector = 'img';
            $selectors_arr = array();

            if ( is_array( $condition ) && ! empty( $condition ) ) {
                foreach ( $condition as $condition_group ) {
                    if ( $condition_group && !empty( $condition_group ) ) {

                        $group_selector = '';
                        $selector_in = array();
                        $selector_not = array();

                        $image_id_in = array();
                        $image_id_not = array();

                        $image_format_in = array();
                        $image_format_not = array();

                        $image_url_equal = array();
                        $image_url_not_equal = array();
                        $image_url_contains = array();
                        $image_url_not_contains = array();

                        foreach ( $condition_group as $condition_rule ) {

                            $rule_type = $condition_rule['param'];
                            $rule_operator = $condition_rule['operator'];
                            $rule_value = $condition_rule['value'];

                            switch ( $rule_type ) {

                                case 'selector':
                                    if ( $rule_operator === 'equal' ) {
                                        $selector_in[] = $rule_value;
                                    } else {
                                        $selector_not[] = $rule_value;
                                    }
                                    break;

                                case 'image':
                                    if ( $rule_value !== 'sti_any' ) {
                                        if ( $rule_operator === 'equal' ) {
                                            $image_id_in[] = $rule_value;
                                        } else {
                                            $image_id_not[] = $rule_value;
                                        }
                                    }
                                    break;

                                case 'image_format':
                                    if ( $rule_value !== 'sti_any' ) {
                                        if ( $rule_operator === 'equal' ) {
                                            $image_format_in[] = $rule_value;
                                        } else {
                                            $image_format_not[] = $rule_value;
                                        }
                                    }
                                    break;

                                case 'image_url':
                                    if ( $rule_operator === 'equal' ) {
                                        $image_url_equal[] = $rule_value;
                                    } elseif( $rule_operator === 'not_equal' ) {
                                        $image_url_not_equal[] = $rule_value;
                                    } elseif( $rule_operator === 'contains' ) {
                                        $image_url_contains[] = $rule_value;
                                    } else {
                                        $image_url_not_contains[] = $rule_value;
                                    }
                                    break;

                            }

                        }

                        if ( ! empty( $selector_in ) ) {
                            $group_selector .= implode( '', $selector_in );
                        } else {
                            $group_selector .= 'img';
                        }

                        if ( ! empty( $image_id_in ) ) {
                            foreach ( $image_id_in as $image_id_in_item ) {
                                $group_selector .= '.wp-image-' . $image_id_in_item;
                            }
                        }

                        if ( ! empty( $image_format_in ) ) {
                            foreach ( $image_format_in as $image_format_in_item ) {
                                $group_selector .= "[src$='." . $image_format_in_item . "']";
                            }
                        }

                        if ( ! empty( $image_url_equal ) ) {
                            foreach ( $image_url_equal as $image_url_equal_item ) {
                                $group_selector .= "[src='" . $image_url_equal_item . "']";
                            }
                        }

                        if ( ! empty( $image_url_contains ) ) {
                            foreach ( $image_url_contains as $image_url_contains_item ) {
                                $group_selector .= "[src*='" . $image_url_contains_item . "']";
                            }
                        }

                        if ( ! empty( $image_url_not_equal ) ) {
                            foreach ( $image_url_not_equal as $image_url_not_equal_item ) {
                                $group_selector .= ":not([src='" . $image_url_not_equal_item . "'])";
                            }
                        }

                        if ( ! empty( $image_url_not_contains ) ) {
                            foreach ( $image_url_not_contains as $image_url_not_contains_item ) {
                                $group_selector .= ":not([src*='" . $image_url_not_contains_item . "'])";
                            }
                        }

                        if ( ! empty( $selector_not ) ) {
                            foreach ( $selector_not as $selector_not_item ) {
                                $group_selector .= ':not(' . $selector_not_item . ')';
                            }
                        }

                        if ( ! empty( $image_id_not ) ) {
                            foreach ( $image_id_not as $image_id_not_item ) {
                                $group_selector .= ':not(.wp-image-' . $image_id_not_item . ')';
                            }
                        }

                        if ( ! empty( $image_format_not ) ) {
                            foreach ( $image_format_not as $image_format_not_item ) {
                                $group_selector .= ":not([src$='." . $image_format_not_item . "'])";
                            }
                        }

                        if ( $group_selector ) {
                            $selectors_arr[] = $group_selector;
                        }

                    }
                }
            }

            if ( ! empty( $selectors_arr ) ) {
                $selector = implode( ', ', $selectors_arr );
            }

            return $selector;

        }

    }

endif;