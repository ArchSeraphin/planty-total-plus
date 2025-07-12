<?php

if (!defined('WPINC')) {
    die();
}

if (!class_exists('TotalPlusElements')) {

    class TotalPlusElements {

        private static $instance = null;

        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (self::$instance == null) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct() {

            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                return;
            }

            require get_template_directory() . '/inc/elements/inc/widget-loader.php';

            $options = get_option('total-plus-options');

            if (!isset($options['elementor_default_font_color']) || $options['elementor_default_font_color']) {
                if ('yes' !== get_option('elementor_disable_color_schemes')) {
                    update_option('elementor_disable_color_schemes', 'yes');
                }

                if ('yes' !== get_option('elementor_disable_typography_schemes')) {
                    update_option('elementor_disable_typography_schemes', 'yes');
                }
            }
        }

    }

}

/**
 * Returns instanse of the plugin class.
 *
 * @since  1.0.0
 * @return object
 */
if (!function_exists('total_plus_elements')) {

    function total_plus_elements() {
        return TotalPlusElements::get_instance();
    }

}

total_plus_elements();
