<?php
if (!class_exists('Total_Plus_Recommended_Plugins')) {

    class Total_Plus_Recommended_Plugins {

        /**
         * Recommended Plugins Array
         * @var     array
         * @access  public
         * @since   1.0.0
         */
        public $this_uri;
        public $this_dir;

        public function __construct() {

            // This uri & dir
            $this->this_uri = get_template_directory_uri() . '/inc/total-plus/recommended-plugins/';
            $this->this_dir = get_template_directory() . '/inc/total-plus/recommended-plugins/';

            /* Resigter Recommended Plugin Menu */
            add_action('admin_menu', array($this, 'register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            require_once $this->this_dir . 'plugin-installer.php';
        }

        public static function get_recommended_plugins() {
            $recommended_plugins = array(
                array(
                    'name' => 'Elementor',
                    'slug' => 'elementor',
                    'required' => false,
                    'description' => esc_html__('The most advanced frontend drag & drop page builder. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.', 'total-plus'),
                    'external_url' => 'https://wordpress.org/plugins/elementor/',
                    'author_name' => 'Elementor',
                    'author_url' => 'https://elementor.com/',
                    'icon' => 'https://ps.w.org/elementor/assets/icon-256x256.gif'
                ),
                array(
                    'name' => 'Easy Elementor Addons',
                    'slug' => 'easy-elementor-addons',
                    'required' => false,
                    'description' => esc_html__('Easy Elementor Addons is an all in one element pack extension for Elementor page builder.', 'total-plus'),
                    'external_url' => 'https://wordpress.org/plugins/easy-elementor-addons/',
                    'author_name' => 'HashThemes',
                    'author_url' => 'https://hashthemes.com/',
                    'icon' => 'https://ps.w.org/easy-elementor-addons/assets/icon-256x256.png'
                ),
                array(
                    'name' => 'Hash Form – Drag & Drop Form Builder',
                    'slug' => 'hash-form',
                    'required' => false,
                    'description' => esc_html__('Unleash the power of creativity and interaction with Hash Form.', 'total-plus'),
                    'external_url' => 'https://wordpress.org/plugins/hash-form/',
                    'author_name' => 'HashThemes',
                    'author_url' => 'https://hashthemes.com/',
                    'icon' => 'https://ps.w.org/hash-form/assets/icon-256x256.gif'
                ),
                array(
                    'name' => 'Simple Floating Menu',
                    'slug' => 'simple-floating-menu',
                    'path' => 'simple-floating-menu/simple-floating-menu.php',
                    'description' => esc_html__('Simple Floating Menu adds a stylish designed menu in your website.', 'total-plus'),
                    'external_url' => 'https://wordpress.org/plugins/simple-floating-menu/',
                    'author_name' => 'HashThemes',
                    'author_url' => 'https://hashthemes.com/',
                    'icon' => 'https://ps.w.org/simple-floating-menu/assets/icon-256x256.png'
                ),
                array(
                    'name' => 'Revolution Slider',
                    'slug' => 'revslider',
                    'source' => 'https://hashthemes.com/import-files/plugins/revslider.zip',
                    'required' => false,
                    'description' => esc_html__('Slider Revolution - Premium responsive slider', 'total-plus'),
                    'external_url' => 'https://revolution.themepunch.com/',
                    'author_name' => 'Theme Punch',
                    'author_url' => 'https://revolution.themepunch.com/',
                    'icon' => get_template_directory_uri() . '/inc/total-plus/recommended-plugins/images/revolution-slider.png'
                )
            );

            return $recommended_plugins;
        }

        public function register_menu() {
            add_submenu_page('total-plus', esc_html__('Install Plugins', 'total-plus'), esc_html__('Install Plugins', 'total-plus'), 'manage_options', 'total-plus-install-plugins', array($this, 'recommended_plugin_page'));
            if (current_user_can('manage_options')) {
                global $submenu;
                $permalink = admin_url('customize.php');
                $submenu['total-plus'][] = array(esc_html__('Customize', 'total-plus'), 'manage_options', $permalink);
            }
        }

        public function recommended_plugin_page() {
            $recommended_plugins = Total_Plus_Recommended_Plugins::get_recommended_plugins();
            ?>
            <div class="wrap recommended-plugin-wrap">
                <h1><?php esc_html_e('Recommended Plugins', 'total-plus'); ?></h1>
                <p><?php esc_html_e('To utilize the theme fully, please install all the Recommended Plugins. Please install it one by one.', 'total-plus'); ?></p>

                <div class="recommended-plugins-list wp-clearfix">
                    <?php
                    foreach ($recommended_plugins as $plugin) {
                        $icon_url = $plugin['icon'];
                        $author = $plugin['author_name'];
                        $name = $plugin['name'];
                        $link = $plugin['external_url'];
                        $btn_class = Total_Plus_Plugin_Installer::generate_plugin_class($plugin);
                        $label = Total_Plus_Plugin_Installer::generate_plugin_label($plugin);
                        $status = Total_Plus_Plugin_Installer::plugin_active_status($plugin);
                        $source = isset($plugin['source']) ? $plugin['source'] : '';
                        $path = isset($plugin['path']) ? $plugin['path'] : $plugin['slug'] . '/' . $plugin['slug'] . '.php';
                        ?>
                        <div class="recommended-plugin">
                            <?php
                            if ($status == 'active') {
                                ?>
                                <div class="item-ribbon active">
                                    <i class="dashicons dashicons-yes"></i>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="plugin-img-wrap">
                                <img src="<?php echo esc_url($icon_url); ?>" />
                                <div class="version-author-info">
                                    <span class="author"><?php printf(esc_html__('By %s', 'total-plus'), $author); ?></span>
                                </div>
                            </div>
                            <div class="plugin-title-install wp-clearfix">
                                <span class="title" title="<?php echo esc_attr($name); ?>">
                                    <?php echo esc_html($name); ?>
                                </span>

                                <span class="plugin-action-btn plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>">
                                    <a
                                        class="<?php echo esc_attr($btn_class); ?>" 
                                        data-source="<?php echo esc_attr($source); ?>"
                                        data-slug="<?php echo esc_attr($plugin['slug']); ?>" 
                                        data-path="<?php echo esc_attr($path); ?>"
                                        href="javascript:void()">
                                            <?php echo esc_html($label); ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <?php
        }

        public function enqueue_scripts($hook) {
            if ('total-plus-panel_page_total-plus-install-plugins' == $hook) {
                wp_enqueue_style('recommended-plugins', $this->this_uri . 'css/style.css', array(), TOTAL_PLUS_VERSION);
                wp_enqueue_style('plugin-install');
                wp_enqueue_script('plugin-install');
                wp_enqueue_script('updates');
            }
        }

    }

}

new Total_Plus_Recommended_Plugins;

