<?php

namespace TotalPlusElements;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (!function_exists('is_plugin_active')) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

final class Total_Plus_Modules_Manager {

    private function get_modules() {
        $modules = [
            'heading',
            'slider-block',
            'progress-bar',
            'featured-block',
            'service-block',
            'highlight-block',
            'team-block',
            'team-carousel',
            'testimonial-block',
            'testimonial-carousel',
            'testimonial-slider',
            'counter-block',
            'pricing-block',
            'news-block',
            'tab-block',
            'portfolio-masonry',
            'portfolio-carousel',
            'blog-section',
            'logo-carousel',
            'image-flipster',
            'video-popup',
            'contact-section',
        ];
        return $modules;
    }

    private function is_module_active($module_id) {
        $options = get_option('total-plus-options');
        $active_widgets = $this->get_modules();

        if (isset($options['enabled_elementor_widgets'])) {
            $active_widgets = array_keys($options['enabled_elementor_widgets']);
        }

        if (in_array($module_id, $active_widgets)) {
            return true;
        }
    }

    public function __construct() {
        $this->require_files();
        $this->register_modules();
    }

    private function require_files() {
        require get_template_directory() . '/inc/elements/base/module-base.php';
    }

    public function register_modules() {
        $modules = $this->get_modules();

        foreach ($modules as $module) {
            if (!$this->is_module_active($module)) {
                continue;
            }
            $class_name = str_replace('-', ' ', $module);
            $class_name = str_replace(' ', '', ucwords($class_name));
            $class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module'; /* TotalPlusElements\Modules\BlokOne\Module */

            $class_name::instance();
        }
    }

}

if (!function_exists('total_plus_module_manager')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function total_plus_module_manager() {
        return new Total_Plus_Modules_Manager();
    }

}
total_plus_module_manager();
