<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('Total_Plus_Theme_Options')) {

    class Total_Plus_Theme_Options {

        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Theme Name
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $theme_name;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $theme_version;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $theme_dir;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $theme_uri;

        public function __construct() {
            $theme = wp_get_theme();
            self::$theme_name = $theme->Name;
            self::$theme_version = $theme->Version;
            self::$theme_dir = get_template_directory() . '/inc/total-plus/theme-options/';
            self::$theme_uri = get_template_directory_uri() . '/inc/total-plus/theme-options/';

            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            require_once self::$theme_dir . 'options-framework/options-framework.php';

            add_filter('optionsframework_menu', array($this, 'options_menu_params'));

            add_filter('options_framework_location', array($this, 'options_array_locations'));
        }

        /**
         * Initiator
         *
         * @since 1.0.0
         * @return object
         */
        public static function get_instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page * */
        public function enqueue_scripts() {
            wp_enqueue_style('total-plus-theme-options', self::$theme_uri . 'css/theme-options.css', array(), TOTAL_PLUS_VERSION);
            wp_enqueue_script('total-plus-theme-options', self::$theme_uri . 'js/theme-options.js', array('jquery'), TOTAL_PLUS_VERSION, false);
        }

        public function options_menu_params($menu) {
            $menu['page_title'] = __('Theme Options', 'total-plus');
            $menu['menu_title'] = __('Theme Options', 'total-plus');
            $menu['menu_slug'] = 'total-plus-options';
            $menu['parent_slug'] = 'total-plus';

            return $menu;
        }

        public function options_array_locations() {
            return array('/inc/total-plus/theme-options/options.php');
        }

    }

}

if (!function_exists('totalplus_theme_options')) {

    /**
     * Returns instanse of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function totalplus_theme_options() {
        return Total_Plus_Theme_Options::get_instance();
    }

}

totalplus_theme_options();
