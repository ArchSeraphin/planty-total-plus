<?php
if (!defined('ABSPATH'))
    exit;

if (!class_exists('Total_Plus_Importer')) {

    class Total_Plus_Importer {

        public $this_uri;
        public $this_dir;
        public $configFile;
        public $uploads_dir;
        public $plugin_install_count;
        public $plugin_active_count;
        public $ajax_response = array();

        /*
         * Constructor
         */

        public function __construct() {

            // This uri & dir
            $this->this_uri = get_template_directory_uri() . '/inc/total-plus/demo-importer/';
            $this->this_dir = get_template_directory() . '/inc/total-plus/demo-importer/';

            $this->uploads_dir = wp_get_upload_dir();

            $this->plugin_install_count = 0;
            $this->plugin_active_count = 0;

            // Include necesarry files
            $this->configFile = include $this->this_dir . 'import_config.php';

            require_once $this->this_dir . 'classes/class-demo-importer.php';
            require_once $this->this_dir . 'classes/class-customizer-importer.php';
            require_once $this->this_dir . 'classes/class-widget-importer.php';

            // WP-Admin Menu
            add_action('admin_menu', array($this, 'total_plus_menu'));

            // Add necesary backend JS
            add_action('admin_enqueue_scripts', array($this, 'load_backends'));

            // Actions for the ajax call
            add_action('wp_ajax_total_plus_install_demo', array($this, 'total_plus_install_demo'));
            add_action('wp_ajax_total_plus_install_plugin', array($this, 'total_plus_install_plugin'));
            add_action('wp_ajax_total_plus_activate_plugin', array($this, 'total_plus_activate_plugin'));
            add_action('wp_ajax_total_plus_download_files', array($this, 'total_plus_download_files'));
            add_action('wp_ajax_total_plus_import_xml', array($this, 'total_plus_import_xml'));
            add_action('wp_ajax_total_plus_customizer_import', array($this, 'total_plus_customizer_import'));
            add_action('wp_ajax_total_plus_menu_import', array($this, 'total_plus_menu_import'));
            add_action('wp_ajax_total_plus_theme_option', array($this, 'total_plus_theme_option'));
            add_action('wp_ajax_total_plus_importing_widget', array($this, 'total_plus_importing_widget'));
            add_action('wp_ajax_total_plus_importing_revslider', array($this, 'total_plus_importing_revslider'));
        }

        /*
         * WP-ADMIN Menu for importer
         */

        function total_plus_menu() {
            add_submenu_page('total-plus', 'OneClick Demo Install', 'Demo Import', 'manage_options', 'total-plus-demo-importer', array($this, 'total_plus_display_demos'));
        }

        /*
         *  Display the available demos
         */

        function total_plus_display_demos() {
            ?>
            <div class="wrap total-plus-demo-importer-wrap">
                <h2><?php echo esc_html__('Total Plus OneClick Demo Importer', 'total-plus'); ?></h2>

                <?php
                if (is_array($this->configFile) && !is_null($this->configFile) && !empty($this->configFile)) {
                    $tags = array();
                    foreach ($this->configFile as $demo_slug => $demo_pack) {
                        if (isset($demo_pack['tags']) && is_array($demo_pack['tags'])) {
                            foreach ($demo_pack['tags'] as $key => $tag) {
                                $tags[$key] = $tag;
                            }
                        }
                    }
                    asort($tags);

                    if (!empty($tags)) {
                        ?>
                        <div class="total-plus-tab-filter">
                            <div class="total-plus-tag-tab" data-filter="*">
                                <?php esc_html_e('All', 'total-plus'); ?>
                            </div>
                            <?php
                            foreach ($tags as $key => $value) {
                                ?>
                                <div class="total-plus-tag-tab" data-filter=".<?php echo esc_attr($key); ?>">
                                    <?php echo esc_html($value); ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <div class="total-plus-demo-box-wrap wp-clearfix">
                        <?php
                        // Loop through Demos
                        foreach ($this->configFile as $demo_slug => $demo_pack) {
                            $tags = '';
                            if (isset($demo_pack['tags'])) {
                                $tags = implode(' ', array_keys($demo_pack['tags']));
                            }
                            ?>
                            <div id="<?php echo esc_attr($demo_slug); ?>" class="total-plus-demo-box <?php echo esc_attr($tags); ?>">
                                <img src="<?php echo esc_url($demo_pack['image']); ?> ">

                                <div class="total-plus-demo-actions">
                                    <h4><?php echo esc_html($demo_pack['name']); ?></h4>

                                    <div class="total-plus-demo-buttons">
                                        <a href="<?php echo esc_url($demo_pack['preview_url']); ?>" target="_blank" class="button">
                                            <?php echo esc_html__('Preview', 'total-plus'); ?>
                                        </a> 

                                        <a href="#total-plus-modal-<?php echo esc_attr($demo_slug) ?>" class="total-plus-modal-button button button-primary">
                                            <?php echo esc_html__('Install', 'total-plus') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                <?php } else {
                    ?>
                    <div class="total-plus-demo-wrap">
                        <?php esc_html_e("It looks like the config file for the demos is missing or conatins errors!. Demo install can\'t go futher!", 'total-plus'); ?>  
                    </div>
                <?php }
                ?>

                <?php
                /* Demo Modals */
                if (is_array($this->configFile) && !is_null($this->configFile)) {
                    foreach ($this->configFile as $demo_slug => $demo_pack) {
                        ?>
                        <div id="total-plus-modal-<?php echo esc_attr($demo_slug) ?>" class="total-plus-modal" style="display: none;">

                            <div class="total-plus-modal-header">
                                <h2><?php printf(esc_html('Import %s Demo', 'total-plus'), esc_html($demo_pack['name'])); ?></h2>
                                <div class="total-plus-modal-back"><span class="dashicons dashicons-no-alt"></span></div>
                            </div>

                            <div class="total-plus-modal-wrap">
                                <p><?php echo sprintf(esc_html__('We recommend you backup your website content before attempting to import the demo so that you can recover your website if something goes wrong. You can use %s plugin for it.', 'total-plus'), '<a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">' . esc_html__('All in one migration', 'total-plus') . '</a>'); ?></p>

                                <p><?php echo esc_html__('This process will install all the required plugins, import contents and setup customizer and theme options.', 'total-plus'); ?></p>

                                <div class="total-plus-modal-recommended-plugins">
                                    <h4><?php esc_html_e('Required Plugins', 'total-plus') ?></h4>
                                    <p><?php esc_html_e('For your website to look exactly like the demo,the import process will install and activate the following plugin if they are not installed or activated.', 'total-plus') ?></p>
                                    <?php
                                    $plugins = isset($demo_pack['plugins']) ? $demo_pack['plugins'] : '';

                                    if (is_array($plugins)) {
                                        ?>
                                        <ul class="total-plus-plugin-status">
                                            <?php
                                            foreach ($plugins as $plugin) {
                                                $name = isset($plugin['name']) ? $plugin['name'] : '';
                                                $status = Total_Plus_Demo_Importer::plugin_active_status($plugin['file_path']);
                                                if ($status == 'active') {
                                                    $plugin_class = '<span class="dashicons dashicons-yes-alt"></span>';
                                                } else if ($status == 'inactive') {
                                                    $plugin_class = '<span class="dashicons dashicons-warning"></span>';
                                                } else {
                                                    $plugin_class = '<span class="dashicons dashicons-dismiss"></span>';
                                                }
                                                ?>
                                                <li class="total-plus-<?php echo esc_attr($status); ?>">
                                                    <?php
                                                    echo $plugin_class . ' ' . esc_html($name) . ' - <i>' . $this->get_plugin_status($status) . '</i>';
                                                    ?>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                        <?php
                                    } else {
                                        ?>
                                        <ul>
                                            <li><?php esc_html_e('No Required Plugins Found.', 'total-plus'); ?></li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="total-plus-reset-checkbox">
                                    <h4><?php esc_html_e('Reset Website', 'total-plus') ?></h4>
                                    <p><?php esc_html_e('Reseting the website will delete all your post, pages, custom post types, categories, taxonomies, images and all other customizer and theme option settings.', 'total-plus') ?></p>
                                    <p><?php esc_html_e('It is always recommended to reset the database for a complete demo import.', 'total-plus') ?></p>
                                    <label>
                                        <input id="checkbox-reset-<?php echo esc_attr($demo_slug); ?>" type="checkbox" value='1' checked="checked"/>
                                        <?php echo esc_html('Reset Website - Check this box only if you are sure to reset the website.', 'total-plus'); ?>
                                    </label>
                                </div>

                                <p><strong><?php echo sprintf(esc_html__('IMPORTANT!! Please make sure that there is not any red indication in the %s page for the demo import to work properly.', 'total-plus'), '<a href="' . admin_url('/admin.php?page=total-plus-system-status') . '" target="_blank">' . esc_html__('System Status', 'total-plus') . '</a>'); ?></strong></p>

                                <a href="javascript:void(0)" data-demo-slug="<?php echo esc_attr($demo_slug) ?>" class="button button-primary total-plus-import-demo"><?php esc_html_e('Import Demo', 'total-plus'); ?></a>
                                <a href="javascript:void(0)" class="button total-plus-modal-cancel"><?php esc_html_e('Cancel', 'total-plus'); ?></a>
                            </div>

                        </div>
                        <?php
                    }
                }
                ?>
                <div id="total-plus-import-progress" style="display: none">
                    <h2 class="total-plus-import-progress-header"><?php echo esc_html__('Demo Import Progress', 'total-plus'); ?></h2>

                    <div class="total-plus-import-progress-wrap">
                        <div class="total-plus-import-loader">
                            <div class="total-plus-loader-content">
                                <div class="total-plus-loader-content-inside">
                                    <div class="total-plus-loader-rotater"></div>
                                    <div class="total-plus-loader-line-point"></div>
                                </div>
                            </div>
                        </div>
                        <div class="total-plus-import-progress-message"></div>
                    </div>
                </div>
            </div>
            <?php
        }

        /*
         *  Do the install on ajax call
         */

        function total_plus_install_demo() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            if (isset($_POST['reset']) && $_POST['reset'] == 'true') {
                $this->database_reset();
                $this->ajax_response['complete_message'] = esc_html__('Database reset complete', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'total_plus_install_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Installing required plugins', 'total-plus');
            $this->send_ajax_response();
        }

        function total_plus_install_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Install Required Plugins
            $this->install_plugins($demo_slug);

            $plugin_install_count = $this->plugin_install_count;

            if ($plugin_install_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins installed', 'total-plus');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to install', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'total_plus_activate_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Activating required plugins', 'total-plus');
            $this->send_ajax_response();
        }

        function total_plus_activate_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Activate Required Plugins
            $this->activate_plugins($demo_slug);

            $plugin_active_count = $this->plugin_active_count;

            if ($plugin_active_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins activated', 'total-plus');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to activate', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'total_plus_download_files';
            $this->ajax_response['next_step_message'] = esc_html__('Downloading demo files', 'total-plus');
            $this->send_ajax_response();
        }

        function total_plus_download_files() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $downloads = $this->download_files($this->configFile[$demo_slug]['external_url']);
            if ($downloads) {
                $this->ajax_response['complete_message'] = esc_html__('All demo files downloaded', 'total-plus');
                $this->ajax_response['next_step'] = 'total_plus_import_xml';
                $this->ajax_response['next_step_message'] = esc_html__('Importing posts, pages and medias. It may take a bit longer time', 'total-plus');
            } else {
                $this->ajax_response['error'] = true;
                $this->ajax_response['error_message'] = esc_html__('Demo import process failed. Demo files can not be downloaded', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function total_plus_import_xml() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Import XML content
            $xml_filepath = $this->demo_upload_dir($demo_slug) . '/content.xml';

            if (file_exists($xml_filepath)) {
                $this->importDemoContent($xml_filepath);
                $this->ajax_response['complete_message'] = esc_html__('All content imported', 'total-plus');
                $this->ajax_response['next_step'] = 'total_plus_customizer_import';
                $this->ajax_response['next_step_message'] = esc_html__('Importing customizer settings', 'total-plus');
            } else {
                $this->ajax_response['error'] = true;
                $this->ajax_response['error_message'] = esc_html__('Demo import process failed. No content file found', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function total_plus_customizer_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $customizer_filepath = $this->demo_upload_dir($demo_slug) . '/customizer.dat';

            if (file_exists($customizer_filepath)) {
                ob_start();
                Total_Plus_Customizer_Importer::import($customizer_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Customizer settings imported', 'total-plus');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No customizer settings found', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'total_plus_menu_import';
            $this->ajax_response['next_step_message'] = esc_html__('Setting menus', 'total-plus');
            $this->send_ajax_response();
        }

        function total_plus_menu_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $menu_array = isset($this->configFile[$demo_slug]['menu_array']) ? $this->configFile[$demo_slug]['menu_array'] : '';
            // Set menu
            if ($menu_array) {
                $this->setMenu($menu_array);
                $this->ajax_response['complete_message'] = esc_html__('Menus saved', 'total-plus');
            }else{
                $this->ajax_response['complete_message'] = esc_html__('No menus saved', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'total_plus_theme_option';
            $this->ajax_response['next_step_message'] = esc_html__('Importing theme option settings', 'total-plus');
            $this->send_ajax_response();
        }

        function total_plus_theme_option() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $options_array = isset($this->configFile[$demo_slug]['options_array']) ? $this->configFile[$demo_slug]['options_array'] : '';

            if (isset($options_array) && is_array($options_array)) {
                foreach ($options_array as $theme_option) {
                    $option_filepath = $this->demo_upload_dir($demo_slug) . '/' . $theme_option . '.json';

                    if (file_exists($option_filepath)) {
                        $data = file_get_contents($option_filepath);

                        if ($data) {
                            update_option($theme_option, json_decode($data, true));
                        }
                    }
                }
                $this->ajax_response['complete_message'] = esc_html__('Theme options settings imported', 'total-plus');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No theme options found', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'total_plus_importing_widget';
            $this->ajax_response['next_step_message'] = esc_html__('Importing widgets', 'total-plus');
            $this->send_ajax_response();
        }

        function total_plus_importing_widget() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $widget_filepath = $this->demo_upload_dir($demo_slug) . '/widget.wie';

            if (file_exists($widget_filepath)) {
                ob_start();
                Total_Plus_Widget_Importer::import($widget_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Widgets imported', 'total-plus');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No widgets found', 'total-plus');
            }

            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';

            if (file_exists($sliderFile)) {
                $this->ajax_response['next_step'] = 'total_plus_importing_revslider';
                $this->ajax_response['next_step_message'] = esc_html__('Importing Revolution slider', 'total-plus');
            } else {
                $this->ajax_response['next_step'] = '';
                $this->ajax_response['next_step_message'] = '';
            }
            
            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function total_plus_importing_revslider() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Get the zip file path
            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';

            if (file_exists($sliderFile)) {
                if (class_exists('RevSlider')) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $sliderFile);
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider installed', 'total-plus');
                } else {
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider plugin not installed', 'total-plus');
                }
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No Revolution slider found', 'total-plus');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = '';
            $this->ajax_response['next_step_message'] = '';
            $this->send_ajax_response();
        }

        public function download_files($external_url) {
            // Make sure we have the dependency.
            if (!function_exists('WP_Filesystem')) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }

            /**
             * Initialize WordPress' file system handler.
             *
             * @var WP_Filesystem_Base $wp_filesystem
             */
            WP_Filesystem();
            global $wp_filesystem;

            $result = true;

            if (!($wp_filesystem->exists($this->demo_upload_dir()))) {
                $result = $wp_filesystem->mkdir($this->demo_upload_dir());
            }

            // Abort the request if the local uploads directory couldn't be created.
            if (!$result) {
                return false;
            } else {
                $demo_pack = $this->demo_upload_dir() . 'demo-pack.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->put_contents($demo_pack, $file);
                unzip_file($demo_pack, $this->demo_upload_dir());
                $wp_filesystem->delete($demo_pack);
                return true;
            }
        }

        /*
         * Reset the database, if the case
         */

        function database_reset() {
            global $wpdb;
            $core_tables = array('commentmeta', 'comments', 'links', 'postmeta', 'posts', 'term_relationships', 'term_taxonomy', 'termmeta', 'terms');
            $exclude_core_tables = array('options', 'usermeta', 'users');
            $core_tables = array_map(function ($tbl) {
                global $wpdb;
                return $wpdb->prefix . $tbl;
            }, $core_tables);
            $exclude_core_tables = array_map(function ($tbl) {
                global $wpdb;
                return $wpdb->prefix . $tbl;
            }, $exclude_core_tables);
            $custom_tables = array();

            $table_status = $wpdb->get_results('SHOW TABLE STATUS');
            if (is_array($table_status)) {
                foreach ($table_status as $index => $table) {
                    if (0 !== stripos($table->Name, $wpdb->prefix)) {
                        continue;
                    }
                    if (empty($table->Engine)) {
                        continue;
                    }

                    if (false === in_array($table->Name, $core_tables) && false === in_array($table->Name, $exclude_core_tables)) {
                        $custom_tables[] = $table->Name;
                    }
                }
            }
            $custom_tables = array_merge($core_tables, $custom_tables);

            foreach ($custom_tables as $tbl) {
                $wpdb->query('SET foreign_key_checks = 0');
                $wpdb->query('TRUNCATE TABLE ' . $tbl);
            }

            // Delete Widgets
            global $wp_registered_widget_controls;

            $widget_controls = $wp_registered_widget_controls;

            $available_widgets = array();

            foreach ($widget_controls as $widget) {
                if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
                    $available_widgets[] = $widget['id_base'];
                }
            }

            update_option('sidebars_widgets', array('wp_inactive_widgets' => array()));
            foreach ($available_widgets as $widget_data) {
                update_option('widget_' . $widget_data, array());
            }

            // Delete Thememods
            $theme_slug = get_option('stylesheet');
            $mods = get_option("theme_mods_$theme_slug");
            if (false !== $mods) {
                delete_option("theme_mods_$theme_slug");
            }

            //Clear "uploads" folder
            $this->clear_uploads($this->uploads_dir['basedir']);
        }

        /**
         * Clear "uploads" folder
         * @param string $dir
         * @return bool
         */
        private function clear_uploads($dir) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                ( is_dir("$dir/$file") ) ? $this->clear_uploads("$dir/$file") : unlink("$dir/$file");
            }

            return ( $dir != $this->uploads_dir['basedir'] ) ? rmdir($dir) : true;
        }

        /*
         * Set the menu on theme location
         */

        function setMenu($menuArray) {

            if (!$menuArray) {
                return;
            }

            $locations = get_theme_mod('nav_menu_locations');

            foreach ($menuArray as $menuId => $menuname) {
                $menu_exists = wp_get_nav_menu_object($menuname);

                if (!$menu_exists) {
                    $term_id_of_menu = wp_create_nav_menu($menuname);
                } else {
                    $term_id_of_menu = $menu_exists->term_id;
                }

                $locations[$menuId] = $term_id_of_menu;
            }

            set_theme_mod('nav_menu_locations', $locations);
        }

        /*
         * Import demo XML content
         */

        function importDemoContent($xml_filepath) {

            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);

            if (!class_exists('WP_Import')) {
                $class_wp_importer = $this->this_dir . "wordpress-importer/wordpress-importer.php";
                if (file_exists($class_wp_importer)) {
                    require_once $class_wp_importer;
                }
            }

            // Import demo content from XML
            if (class_exists('WP_Import')) {
                $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';
                $home_slug = isset($this->configFile[$demo_slug]['home_slug']) ? $this->configFile[$demo_slug]['home_slug'] : '';
                $blog_slug = isset($this->configFile[$demo_slug]['blog_slug']) ? $this->configFile[$demo_slug]['blog_slug'] : '';

                if (file_exists($xml_filepath)) {
                    $wp_import = new WP_Import();
                    $wp_import->fetch_attachments = true;
                    // Capture the output.
                    ob_start();
                    $wp_import->import($xml_filepath);
                    // Clean the output.
                    ob_end_clean();
                    // Import DONE
                    
                    // set homepage as front page
                    if ($home_slug) {
                        $page = get_page_by_path($home_slug);
                        if ($page) {
                            update_option('show_on_front', 'page');
                            update_option('page_on_front', $page->ID);
                        } else {
                            $page = get_page_by_title('Home');
                            if ($page) {
                                update_option('show_on_front', 'page');
                                update_option('page_on_front', $page->ID);
                            }
                        }
                    }

                    if ($blog_slug) {
                        $blog = get_page_by_path($blog_slug);
                        if ($blog) {
                            update_option('show_on_front', 'page');
                            update_option('page_for_posts', $blog->ID);
                        }
                    }

                    if (!$home_slug && !$blog_slug) {
                        update_option('show_on_front', 'posts');
                    }
                }
            }
        }

        function demo_upload_dir($path = '') {
            $upload_dir = $this->uploads_dir['basedir'] . '/demo-pack/' . $path;
            return $upload_dir;
        }

        function install_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $source = isset($plugin['source']) ? $plugin['source'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $location = isset($plugin['location']) ? $plugin['location'] : '';

                if ($source == 'wordpress') {
                    $this->plugin_installer_callback($file_path, $plugin_slug);
                } else {
                    $this->plugin_offline_installer_callback($file_path, $location);
                }
            }
        }

        function activate_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $plugin_status = $this->plugin_status($file_path);

                if ($plugin_status == 'inactive') {
                    $this->activate_plugin($file_path);
                    $this->plugin_active_count++;
                }
            }
        }

        public function plugin_installer_callback($path, $slug) {
            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Include required libs for installation
                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
                require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

                // Get Plugin Info
                $api = $this->call_plugin_api($slug);

                $skin = new WP_Ajax_Upgrader_Skin();
                $upgrader = new Plugin_Upgrader($skin);
                $upgrader->install($api->download_link);
                
                $this->activate_plugin($file_path);

                $this->plugin_install_count++;
            }
        }

        public function plugin_offline_installer_callback($path, $external_url) {

            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Make sure we have the dependency.
                if (!function_exists('WP_Filesystem')) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }

                /**
                 * Initialize WordPress' file system handler.
                 *
                 * @var WP_Filesystem_Base $wp_filesystem
                 */
                WP_Filesystem();
                global $wp_filesystem;

                $plugin = $this->demo_upload_dir() . 'plugin.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->mkdir($this->demo_upload_dir());

                $wp_filesystem->put_contents($plugin, $file);

                unzip_file($plugin, WP_PLUGIN_DIR);

                $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($path);

                $wp_filesystem->delete($plugin);
                
                $this->activate_plugin($file_path);
                
                $this->plugin_install_count++;
            }
        }

        /* Plugin API */

        public function call_plugin_api($slug) {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

            $call_api = plugins_api('plugin_information', array(
                'slug' => $slug,
                'fields' => array(
                    'downloaded' => false,
                    'rating' => false,
                    'description' => false,
                    'short_description' => false,
                    'donate_link' => false,
                    'tags' => false,
                    'sections' => false,
                    'homepage' => false,
                    'added' => false,
                    'last_updated' => false,
                    'compatibility' => false,
                    'tested' => false,
                    'requires' => false,
                    'downloadlink' => true,
                    'icons' => false
            )));

            return $call_api;
        }

        public function activate_plugin($file_path) {
            if ($file_path) {
                $activate = activate_plugin($file_path, '', false, true);
            }
        }

        /* Check if plugin is active or not */

        public function plugin_status($file_path) {
            $status = 'install';

            $plugin_path = WP_PLUGIN_DIR . '/' . $file_path;

            if (file_exists($plugin_path)) {
                $status = is_plugin_active($file_path) ? 'active' : 'inactive';
            }
            return $status;
        }

        public function get_plugin_status($status) {
            switch ($status) {
                case 'install':
                    $plugin_status = esc_html__('Not Installed', 'total-plus');
                    break;

                case 'active':
                    $plugin_status = esc_html__('Installed and Active', 'total-plus');
                    break;

                case 'inactive':
                    $plugin_status = esc_html__('Installed but Not Active', 'total-plus');
                    break;
            }
            return $plugin_status;
        }

        public function send_ajax_response() {
            $json = wp_json_encode($this->ajax_response);
            echo $json;
            die();
        }

        /*
          Register necessary backend js
         */

        function load_backends() {
            $data = array(
                'nonce' => wp_create_nonce('demo-importer-ajax'),
                'prepare_importing' => esc_html__('Preparing to import demo', 'total-plus'),
                'reset_database' => esc_html__('Reseting database', 'total-plus'),
                'no_reset_database' => esc_html__('Database was not reset', 'total-plus'),
                'import_error' => sprintf(esc_html__('There was an error in importing demo. Please make sure that your server has all the recommended settings %s. If there is not red indication in the System Staus page then please reload the page and try again.', 'total-plus'), '<a target="_blank" href="' . admin_url('/admin.php?page=total-plus-system-status') . '">' . esc_html__('here', 'total-plus') . '</a>'),
                'import_success' => '<h2>' . esc_html__('All done. Have fun!', 'total-plus') . '</h2><p>' . esc_html__('Your website has been successfully setup.', 'total-plus') . '</p><a class="button" target="_blank" href="' . esc_url(home_url('/')) . '">' . esc_html__('View your Website', 'total-plus') . '</a><a class="button" href="' . esc_url(admin_url('/admin.php?page=total-plus-demo-importer')) . '">' . esc_html__('Go Back', 'total-plus') . '</a>'
            );

            wp_enqueue_script('isotope-pkgd', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), TOTAL_PLUS_VERSION, true);
            wp_enqueue_script('total-plus-demo-ajax', $this->this_uri . 'assets/demo-importer-ajax.js', array('jquery', 'imagesloaded'), TOTAL_PLUS_VERSION, true);
            wp_localize_script('total-plus-demo-ajax', 'total_plus_ajax_data', $data);
            wp_enqueue_style('total-plus-demo-style', $this->this_uri . 'assets/demo-importer-style.css', array(), TOTAL_PLUS_VERSION);
        }

    }

}
new Total_Plus_Importer;
