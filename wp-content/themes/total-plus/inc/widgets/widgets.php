<?php
/**
 *
 * @package Total Plus
 */
require_once get_template_directory() . '/inc/widgets/add-widget.php';

require_once get_template_directory() . '/inc/widgets/widget-fields.php';

$active_widgets = array_keys(of_get_option('enabled_widgets', total_plus_widget_list()));

if (is_array($active_widgets)) {
    foreach ($active_widgets as $widgets) {
        if (file_exists(get_template_directory() . '/inc/widgets/' . $widgets . '.php')) {
            require_once get_template_directory() . '/inc/widgets/' . $widgets . '.php';
        }
    }
}

function total_plus_widget_list() {
    return array(
        'widget-accordian' => esc_html__('Accordian', 'total-plus'),
        'widget-banner-ads' => esc_html__('Banner Ads', 'total-plus'),
        'widget-cta' => esc_html__('Call To Action', 'total-plus'),
        'widget-contact-detail' => esc_html__('Contact Detail', 'total-plus'),
        'widget-contact-info' => esc_html__('Contact Info', 'total-plus'),
        'widget-countdown' => esc_html__('Count Down', 'total-plus'),
        'widget-counter' => esc_html__('Counter', 'total-plus'),
        'widget-facebook-box' => esc_html__('Facebook Box', 'total-plus'),
        'widget-highlight-block' => esc_html__('Highlight Block', 'total-plus'),
        'widget-flickr' => esc_html__('Flickr', 'total-plus'),
        'widget-icon-text' => esc_html__('Icon Text', 'total-plus'),
        'widget-image-box' => esc_html__('Image Text', 'total-plus'),
        'widget-latest-posts' => esc_html__('Latest Posts', 'total-plus'),
        'widget-portfolio-carousel' => esc_html__('Portfolio Carousel', 'total-plus'),
        'widget-portfolio-masonary' => esc_html__('Portfolio Masonary', 'total-plus'),
        'widget-pricing' => esc_html__('Pricing Table', 'total-plus'),
        'widget-profile' => esc_html__('Profile', 'total-plus'),
        'widget-progressbar' => esc_html__('Progress Bar', 'total-plus'),
        'widget-social-icons' => esc_html__('Social Icons', 'total-plus'),
        'widget-tab' => esc_html__('Tabs', 'total-plus'),
        'widget-team' => esc_html__('Team', 'total-plus'),
        'widget-team-carousel' => esc_html__('Team Carousel', 'total-plus'),
        'widget-testimonial' => esc_html__('Testimonial', 'total-plus'),
        'widget-testimonial-carousel' => esc_html__('Testimonial Carousel', 'total-plus'),
        'widget-testimonial-slider' => esc_html__('Testimonial Slider', 'total-plus')
    );
}

/**
 * Enqueue Style and Script for widgets
 */
function total_plus_admin_scripts() {
    wp_enqueue_style('font-awesome-6.4.2', get_template_directory_uri() . '/css/all.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('font-awesome-v4-shims', get_template_directory_uri() . '/css/v4-shims.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('essential-icon', get_template_directory_uri() . '/css/essential-icon.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), TOTAL_PLUS_VERSION);

    wp_enqueue_style('total-plus-admin-style', get_template_directory_uri() . '/inc/widgets/css/widget-style.css', array('wp-color-picker'), TOTAL_PLUS_VERSION);

    wp_enqueue_media();
    $is_widgets_block_editor = function_exists('wp_use_widgets_block_editor') && wp_use_widgets_block_editor() ? 'true' : 'false';
    wp_enqueue_script('total-plus-widget-script', get_template_directory_uri() . '/inc/widgets/js/widget-script.js', array('jquery', 'wp-color-picker', 'jquery-ui-datepicker'), TOTAL_PLUS_VERSION, true);
    wp_localize_script('total-plus-widget-script', 'total_plus_widget_options', array(
        'widgets_block_editor' => $is_widgets_block_editor,
    ));
}

add_action('admin_enqueue_scripts', 'total_plus_admin_scripts', 100);

add_action('elementor/editor/before_enqueue_scripts', 'total_plus_admin_scripts');


/* ADD EDITOR TO CUSTOMIZER */

function total_plus_customizer_editor() {
    ?>
    <div id="ht-wp-editor-widget-container" style="display: none;">
        <a class="ht-wp-editor-widget-close" href="#" title="<?php esc_attr_e('Close', 'total-plus'); ?>"><i class="icofont-close-squared-alt"></i></a>
        <div class="editor">
            <?php
            $settings = array('textarea_rows' => 55, 'editor_height' => 260);
            wp_editor('', 'wpeditorwidget', $settings);
            ?>
            <p><a href="#" class="ht-wp-editor-widget-update-close button button-primary"><?php _e('Save and Close', 'total-plus'); ?></a></p>
        </div>
    </div>
    <div id="ht-wp-editor-widget-backdrop" style="display: none;"></div>
    <?php
}

// END output_wp_editor_widget_html*/

add_action('widgets_admin_page', 'total_plus_customizer_editor', 100);
add_action('customize_controls_print_footer_scripts', 'total_plus_customizer_editor');
add_action('elementor/editor/before_enqueue_scripts', 'total_plus_customizer_editor');

//SiteOrigin Builder
if (function_exists('siteorigin_panels_render')) {
    add_action('admin_print_scripts-post.php', 'total_plus_customizer_editor', 100);
    add_action('admin_print_scripts-post-new.php', 'total_plus_customizer_editor', 100);
}

//Beaver Builder
if (class_exists('FLBuilder')) {
    if (isset($_GET['fl_builder'])) {
        add_action('total_plus_after_footer', 'total_plus_customizer_editor', 100);
    }
}

/* Add Filters for the Customizer wp_editor */
add_filter('wp_editor_widget_content', 'wptexturize');
add_filter('wp_editor_widget_content', 'convert_smilies');
add_filter('wp_editor_widget_content', 'convert_chars');
add_filter('wp_editor_widget_content', 'wpautop');
add_filter('wp_editor_widget_content', 'shortcode_unautop');
add_filter('wp_editor_widget_content', 'do_shortcode', 11);
