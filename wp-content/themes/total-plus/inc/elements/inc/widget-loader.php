<?php

namespace TotalPlusElements;

if (!defined('ABSPATH'))
    exit();

class Total_Plus_Widget_Loader {

    private static $instance = null;
    public static $dir;
    public static $uri;

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __construct() {
        self::$dir = get_template_directory() . '/inc/elements/';
        self::$uri = get_template_directory_uri() . '/inc/elements/';

        spl_autoload_register([$this, 'autoload']);

        $this->includes();
        // Elementor hooks
        $this->add_actions();
    }

    public function autoload($class) {
        if (0 !== strpos($class, __NAMESPACE__)) {
            return;
        }

        $has_class_alias = isset($this->classes_aliases[$class]);

        // Backward Compatibility: Save old class name for set an alias after the new class is loaded
        if ($has_class_alias) {
            $class_alias_name = $this->classes_aliases[$class];
            $class_to_load = $class_alias_name;
        } else {
            $class_to_load = $class;
        }

        if (!class_exists($class_to_load)) {

            $filename = strtolower(
                    preg_replace(
                            ['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'], ['', '$1-$2', '-', DIRECTORY_SEPARATOR], $class_to_load
                    )
            );

            $filename = self::$dir . $filename . '.php';

            if (is_readable($filename)) {
                include( $filename );
            }
        }

        if ($has_class_alias) {
            class_alias($class_alias_name, $class);
        }
    }

    private function includes() {
        require self::$dir . 'inc/module-manager.php';
        require self::$dir . 'inc/helper-functions.php';
    }

    public function add_actions() {
        add_action('elementor/init', [$this, 'add_elementor_widget_categories']);

        //FrontEnd Scripts
        add_action('elementor/frontend/before_register_scripts', [$this, 'register_frontend_scripts']);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);

        //FrontEnd Styles
        add_action('elementor/frontend/before_register_styles', [$this, 'register_frontend_styles']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);

        //Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

        //Editor Style
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);

        //Fires after Elementor preview styles are enqueued.
        add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_preview_styles']);
    }

    function add_elementor_widget_categories() {

        $groups = array(
            'total-plus-elements' => esc_html__('Total Plus Frontpage Elements', 'total-plus'),
        );

        foreach ($groups as $key => $value) {
            \Elementor\Plugin::$instance->elements_manager->add_category($key, ['title' => $value], 1);
        }
    }

    /**
     * Register Frontend Scripts
     */
    public function register_frontend_scripts() {
        
    }

    /**
     * Enqueue Frontend Scripts
     */
    public function enqueue_frontend_scripts() {
        $is_rtl = (is_rtl()) ? 'true' : 'false';
        wp_enqueue_script('total-plus-elements-frontend', self::$uri . 'assets/js/frontend.js', array('jquery'), TOTAL_PLUS_VERSION, true);
        wp_localize_script('total-plus-elements-frontend', 'total_plus_ele_options', array(
            'rtl' => $is_rtl
        ));
    }

    /**
     * Register Frontend Styles
     */
    public function register_frontend_styles() {
        
    }

    /**
     * Enqueue Frontend Styles
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style('total-plus-frontend-style', self::$uri . 'assets/css/frontend.css', array(), TOTAL_PLUS_VERSION);
    }

    /**
     * Enqueue Editor Scripts
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script('total-plus-editor', self::$uri . 'assets/js/editor.js', array('jquery'), TOTAL_PLUS_VERSION, true);
        wp_localize_script('total-plus-editor', 'total_plus_elementor_params', array('is_elementor_pro_installed' => $this->is_elementor_pro_installed()));
    }

    /**
     * Enqueue Editor Styles
     */
    public function enqueue_editor_styles() {
        wp_enqueue_style('total-plus-editor-style', self::$uri . 'assets/css/editor-styles.css', array(), TOTAL_PLUS_VERSION);
    }

    /**
     * Preview Styles
     */
    public function enqueue_preview_styles() {
        
    }

    /**
     * Check if theme has elementor Pro installed
     *
     * @return boolean
     */
    public function is_elementor_pro_installed() {
        return function_exists('elementor_pro_load_plugin') ? 'yes' : 'no';
    }

}

if (!function_exists('total_plus_widget_loader')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function total_plus_widget_loader() {
        return Total_Plus_Widget_Loader::get_instance();
    }

}
total_plus_widget_loader();
