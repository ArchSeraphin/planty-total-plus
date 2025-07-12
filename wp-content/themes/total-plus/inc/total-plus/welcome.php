<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('Total_Plus_Welcome')) {

    class Total_Plus_Welcome {

        /**
         * Theme Name
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        private $theme_name;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        private $theme_version;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $dir;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $uri;

        public function __construct() {
            $theme = wp_get_theme('total-plus');
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;
            self::$dir = get_template_directory() . '/inc/total-plus/';
            self::$uri = get_template_directory_uri() . '/inc/total-plus/';

            /* Theme Activation Notice */
            add_action('load-themes.php', array($this, 'activation_admin_notice'));

            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            $this->load_files();
        }

        /**
         * Initiator
         *
         * @since 1.0.0
         * @return object
         */
        public function load_files() {
            require self::$dir . 'theme-options/theme-options.php';
            require self::$dir . 'recommended-plugins/recommended-plugins.php';
            require self::$dir . 'demo-importer/demo-importer.php';
            require self::$dir . 'system-status/system-status.php';
            require self::$dir . 'updater/theme-updater.php';
        }

        /** Welcome Message Notification on Theme Activation * */
        public function activation_admin_notice() {
            global $pagenow;

            if (is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated']))) {
                add_action('admin_notices', array($this, 'welcome_notice'));
            }
        }

        public function welcome_notice() {
            ?>
            <div class="notice notice-success is-dismissible">
                <p>
                    <?php
                    printf('%1$s %2$s %3$s <a href="%4$s">%5$s</a> %6$s', esc_html__('Welcome! Thank you for choosing', 'total-plus'), esc_html($this->theme_name), esc_html__('Please make sure you visit our', 'total-plus'), esc_url(admin_url('admin.php?page=total-plus')), esc_html__('Welcome Page', 'total-plus'), esc_html__('to get started with Total Plus.', 'total-plus'));
                    ?>
                </p>
                <p><a class="button" href="<?php echo esc_url(admin_url('admin.php?page=total-plus')) ?>"><?php esc_html_e('Lets Get Started', 'total-plus'); ?></a></p>
            </div>
            <?php
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page * */
        public function enqueue_scripts() {
            wp_enqueue_style('welcome-screen', self::$uri . 'css/welcome.css', array(), TOTAL_PLUS_VERSION);
            wp_enqueue_script('total-plus-check-for-update', self::$uri . 'js/check-for-update.js', array('jquery'), TOTAL_PLUS_VERSION);
            wp_localize_script('total-plus-check-for-update', 'total_plus_admin_localize', array(
                'check_update_url' => add_query_arg(array('total_plus_check_for_updates' => 1, 'total_plus_nonce' => wp_create_nonce('total_plus_check_for_updates')), network_admin_url('themes.php')),
                'check_update_text' => __('Check for Update', 'total-plus')
            ));
        }

        /** Register Menu for Welcome Page * */
        public function register_menu() {
            add_menu_page(esc_html__('Welcome', 'total-plus'), esc_html__('Total Plus Panel', 'total-plus'), 'manage_options', 'total-plus', array($this, 'total_plus_welcome'), '', 2);
            add_submenu_page('total-plus', esc_html__('Welcome', 'total-plus'), esc_html__('Welcome', 'total-plus'), 'manage_options', 'total-plus', array($this, 'total_plus_welcome'));
        }

        public function total_plus_welcome() {
            $theme = wp_get_theme();
            ?>
            <div class="wrap total-welcome-wrap wp-clearfix">
                <h1></h1>
                <div class="total-welcome-content">

                    <div class="total-welcome-intro">
                        <h3><?php printf(esc_html__('Welcome to %s', 'total-plus'), $theme->Name); ?> <span class="theme-version">v<?php echo esc_html($theme->Version); ?></span></h3>
                        <p><?php printf(esc_html__('Welcome and thank you for installing %s. We have worked very hard to release a great product and fully commited to making your experience perfect.', 'total-plus'), $theme->Name); ?></p>

                        <p><?php printf(esc_html__('If this is your first experience with %s, we recommend you visiting the following pages', 'total-plus'), $theme->Name); ?></p>

                        <ul class="total-quick-links wp-clearfix">
                            <li><a href="<?php echo admin_url('/admin.php?page=total-plus-license') ?>"><?php echo esc_html('Activating License Key', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=total-plus-install-plugins') ?>"><?php echo esc_html('Installing Recommended Plugins', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=total-plus-demo-importer') ?>"><?php echo esc_html('Importing Demos', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php') ?>"><?php echo esc_html('Setting Customizer Panel', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=total-plus-options') ?>"><?php echo esc_html('Setting Theme Option Panel', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=total-plus-system-status') ?>"><?php echo esc_html('System Status', 'total-plus') ?></a></li>
                            <li><a href="https://hashthemes.com/support/forum/total-plus/" target="_blank"><?php echo esc_html('Support Forum', 'total-plus') ?></a></li>
                            <li><a href="https://hashthemes.com/change-logs/total-plus-change-logs/" target="_blank"><?php echo esc_html('Change Logs', 'total-plus') ?></a></li>
                        </ul>
                    </div>

                    <div class="total-welcome-customizer-links">
                        <h4><?php echo esc_html('Quick Links - Customizer Settings') ?></h4>
                        <ul>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=title_tagline') ?>"><?php echo esc_html('Upoad Logo - Add logo, title, tagline and favicon', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_preloader_options_section') ?>"><?php echo esc_html('Add Preloader - Show beautiful animated preloader untill your website loads', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[panel]=typography') ?>"><?php echo esc_html('Customize Fonts - Set typography family, style, weight, size, line height and color', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=colors') ?>"><?php echo esc_html('Theme Color - Set the primary color of the theme', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_header_layouts') ?>"><?php echo esc_html('Header Layouts - Change the header layout from 6 styles', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_header_options') ?>"><?php echo esc_html('Header Options - Set top header and main header content, style and colors', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[panel]=total_plus_home_panel') ?>"><?php echo esc_html('Home Sections Settings - Enable/Disable, configure various predefined home page sections', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_blog_options_section') ?>"><?php echo esc_html('Blog Page Settings - Choose from different blog styles and configure other blog settings', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_footer_section') ?>"><?php echo esc_html('Footer Settings - Choose footer layout, column and colors', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_layout_options_section') ?>"><?php echo esc_html('Sidebar layouts - Choose sidebar layouts for page, post and archive pages', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_maintenance_section') ?>"><?php echo esc_html('Maintenance Screen - Display Comming Soon or Maintenace page untill your website is not ready', 'total-plus') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=total_plus_gdpr_section') ?>"><?php echo esc_html('GDPR Settings - Allows you to inform users that your site uses cookies and to comply with the EU cookie law GDPR regulations', 'total-plus') ?></a></li>
                        </ul>
                    </div>
                </div>


                <div class="total-welcome-sidebar">

                    <div class="total-support-box">
                        <h5><span class="dashicons dashicons-download"></span><?php echo esc_html('One Click Demo Import', 'total-plus'); ?></h5>
                        <div class="total-support-content">
                            <p><?php echo esc_html('Total Plus allows you to easily create unique looking sites with just one click. Click on the button below to go to the demo importer page and import the desired demo.', 'total-plus'); ?></p>
                            <a class="button button-primary" href="<?php echo admin_url('/admin.php?page=total-plus-demo-importer'); ?>"><?php echo esc_html('Import Demo', 'total-plus') ?></a>
                        </div>
                    </div>

                    <div class="total-support-box">
                        <h5><span class="dashicons dashicons-welcome-write-blog"></span><?php echo esc_html('Documentation', 'total-plus'); ?></h5>
                        <div class="total-support-content">
                            <p><?php echo sprintf(esc_html('Please check our full documentation for detailed information on how to use the theme. You need to be %s to our website with your purchase account to access the documentation.', 'total-plus'), '<a href="https://hashthemes.com/login/" target="_blank">logged in</a>'); ?></p>
                            <a class="button button-primary" href="https://hashthemes.com/documentation/total-plus-documentation/" target="_blank"><?php echo esc_html('View Documentation', 'total-plus') ?></a>
                        </div>
                    </div>

                    <div class="total-support-box">
                        <h5><span class="dashicons dashicons-book"></span><?php echo esc_html('Knowledge Base (Articles)', 'total-plus'); ?></h5>
                        <div class="total-support-content">
                            <p><?php echo esc_html('You can find additional information that are not in the documentation. It can be from general topics to specific aspects of the WordPress and themes.', 'total-plus'); ?></p>
                            <a class="button button-primary" href="https://hashthemes.com/articles/" target="_blank"><?php echo esc_html('View Articles', 'total-plus') ?></a>
                        </div>
                    </div>

                    <div class="total-support-box">
                        <h5><span class="dashicons dashicons-sos"></span><?php echo esc_html('Support Forums', 'total-plus'); ?></h5>
                        <div class="total-support-content">
                            <p><?php echo sprintf(esc_html('Through the forums we offer top notch support. Before asking a questions it\'s highly recommended to search on forums, but if you can\'t find the solution feel free to create a new topic. You need to be %s to our website with your purchase account to access the support page.', 'total-plus'), '<a href="https://hashthemes.com/login/" target="_blank">logged in</a>'); ?></p>
                            <a class="button button-primary" href="https://hashthemes.com/support/" target="_blank"><?php echo esc_html('Visit Support Forum', 'total-plus') ?></a>
                        </div>
                    </div>

                </div>
            </div><!-- .wrap -->
            <?php
        }

    }

}

if (!function_exists('total_plus_welcome')) {

    function total_plus_welcome() {
        return new Total_Plus_Welcome;
    }

}

total_plus_welcome();
