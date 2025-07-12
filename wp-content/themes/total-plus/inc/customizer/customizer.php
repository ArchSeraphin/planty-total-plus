<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function total_plus_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->remove_control('header_text');
    $wp_customize->get_section('static_front_page')->priority = -1;

    global $wp_registered_sidebars;
    $imagepath = get_template_directory_uri();
    $total_plus_menu_choice = $total_plus_portfolio_cat = $total_plus_page_choice = $total_plus_cat = array();

    $total_plus_widget_list[] = esc_html__('-- Don\'t Replace --', 'total-plus');
    foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
        $total_plus_widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
    }

    $total_plus_categories = get_categories(array('hide_empty' => 0));
    foreach ($total_plus_categories as $total_plus_category) {
        $total_plus_cat[$total_plus_category->term_id] = $total_plus_category->cat_name;
    }

    $total_plus_portfolio_categories = get_categories(array('taxonomy' => 'portfolio_type', 'hide_empty' => 0));
    foreach ($total_plus_portfolio_categories as $total_plus_portfolio_category) {
        $total_plus_portfolio_cat[$total_plus_portfolio_category->term_id] = $total_plus_portfolio_category->cat_name;
    }

    $total_plus_pages = get_pages(array('hide_empty' => 0));
    foreach ($total_plus_pages as $total_plus_pages_single) {
        $total_plus_page_choice[$total_plus_pages_single->ID] = $total_plus_pages_single->post_title;
    }

    $total_plus_menus = get_terms('nav_menu', array('hide_empty' => false));
    foreach ($total_plus_menus as $total_plus_menus_single) {
        $total_plus_menu_choice[$total_plus_menus_single->slug] = $total_plus_menus_single->name;
    }

    for ($i = 1; $i <= 100; $i++) {
        $total_plus_percentage[$i] = $i;
    }

    $wp_customize->register_control_type('Total_Plus_Background_Control');
    $wp_customize->register_control_type('Total_Plus_Control_Tab');
    $wp_customize->register_control_type('Total_Plus_Dimensions_Control');
    $wp_customize->register_control_type('Total_Plus_Range_Slider_Control');
    $wp_customize->register_control_type('Total_Plus_Sortable_Control');
    $wp_customize->register_control_type('Total_Plus_Color_Tab_Control');
    $wp_customize->register_section_type('Total_Plus_Toggle_Section');

    require get_template_directory() . '/inc/customizer/customizer-panel/maintenance.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/general-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/color-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/header-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/sidebar-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/home-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/blog-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/footer-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/social-settings.php';

    require get_template_directory() . '/inc/customizer/customizer-panel/gdpr-settings.php';

    $wp_customize->add_setting('total_plus_enable_frontpage', array(
        'sanitize_callback' => 'total_plus_sanitize_text',
        'default' => total_plus_enable_frontpage_default()
    ));

    $wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_enable_frontpage', array(
        'section' => 'static_front_page',
        'label' => esc_html__('Enable FrontPage', 'total-plus'),
        'description' => esc_html__('Overwrites the homepage displays setting and shows the frontpage', 'total-plus')
    )));

    /* ============IMPORTANT LINKS============ */
    $wp_customize->add_section('total_plus_implink_section', array(
        'title' => esc_html__('Important Links', 'total-plus'),
        'priority' => 1000
    ));

    $wp_customize->add_setting('total_plus_imp_links', array(
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_imp_links', array(
        'section' => 'total_plus_implink_section',
        'description' => '<a class="ht-implink" href="https://hashthemes.com/wordpress-theme/total/" target="_blank">' . esc_html__('Live Demo', 'total-plus') . '</a><a class="ht-implink" href="https://hashthemes.com/support/forum/total-plus/" target="_blank">' . esc_html__('Support Forum', 'total-plus') . '</a><a class="ht-implink" href="https://www.facebook.com/hashtheme/" target="_blank">' . esc_html__('Like Us in Facebook', 'total-plus') . '</a>',
    )));

    $wp_customize->add_setting('total_plus_rate_us', array(
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_rate_us', array(
        'section' => 'total_plus_implink_section',
        'description' => sprintf(esc_html__('Please do rate our theme if you liked it %s', 'total-plus'), '<a class="ht-implink" href="https://wordpress.org/support/theme/total/reviews/?filter=5" target="_blank">Rate/Review</a>'),
    )));

    $wp_customize->add_setting('total_plus_setup_instruction', array(
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_setup_instruction', array(
        'section' => 'total_plus_implink_section',
        'description' => __('<strong>Instruction - Setting up Home Page</strong><br/>1. Create a new
					page (any title, like Home )<br/>
2. In right column: Page Attributes -> Template: Home Page<br/>
3. Click on Publish<br/>
4. Go to Appearance-> Customize -> General settings -> Static Front Page<br/>
5. Select - A static page<br/>
6. In Front Page, select the page that you created in the step 1<br/>
7. Save changes', 'total-plus'),
    )));

    $wp_customize->remove_control('total_plus_about_super_title_color');
    $wp_customize->remove_control('total_plus_contact_super_title_color');
}

add_action('customize_register', 'total_plus_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function total_plus_customize_preview_js() {
    wp_enqueue_script('total-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-preview.js', array('customize-preview'), TOTAL_PLUS_VERSION, true);
}

add_action('customize_preview_init', 'total_plus_customize_preview_js');

function total_plus_customizer_script() {
    wp_enqueue_script('total-customizer-chosen-script', get_template_directory_uri() . '/inc/customizer/js/chosen.jquery.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/inc/customizer/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), TOTAL_PLUS_VERSION, true);
    $color_picker_strings = array(
        'clear' => __('Clear', 'total-plus'),
        'clearAriaLabel' => __('Clear color', 'total-plus'),
        'defaultString' => __('Default', 'total-plus'),
        'defaultAriaLabel' => __('Select default color', 'total-plus'),
        'pick' => __('Select Color', 'total-plus'),
        'defaultLabel' => __('Color value', 'total-plus'),
    );
    wp_localize_script('wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings);
    wp_enqueue_script('total-customizer-script', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array('jquery', 'jquery-ui-datepicker'), TOTAL_PLUS_VERSION, true);

    wp_enqueue_style('font-awesome-6.4.2', get_template_directory_uri() . '/css/all.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('font-awesome-v4-shims', get_template_directory_uri() . '/css/v4-shims.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('essential-icon', get_template_directory_uri() . '/css/essential-icon.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('total-customizer-chosen-style', get_template_directory_uri() . '/inc/customizer/css/chosen.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('total-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-controls.css', array('wp-color-picker'), TOTAL_PLUS_VERSION);
}

add_action('customize_controls_enqueue_scripts', 'total_plus_customizer_script');

require get_template_directory() . '/inc/customizer/customizer-control-class.php';
require get_template_directory() . '/inc/customizer/customizer-control-sanitization.php';
require get_template_directory() . '/inc/customizer/customizer-active-callbacks.php';

add_action('wp_ajax_total_plus_order_sections', 'total_plus_order_sections');

function total_plus_order_sections() {
    if (isset($_POST['sections'])) {
        set_theme_mod('total_plus_frontpage_sections', $_POST['sections']);
    }
    wp_die();
}

if (!function_exists('total_plus_frontpage_sections')) {

    function total_plus_frontpage_sections() {
        $defaults = array(
            'total_plus_about_section',
            'total_plus_highlight_section',
            'total_plus_featured_section',
            'total_plus_portfolio_section',
            'total_plus_service_section',
            'total_plus_team_section',
            'total_plus_counter_section',
            'total_plus_testimonial_section',
            'total_plus_pricing_section',
            'total_plus_news_section',
            'total_plus_tab_section',
            'total_plus_blog_section',
            'total_plus_logo_section',
            'total_plus_cta_section',
            'total_plus_contact_section',
            'total_plus_customa_section',
            'total_plus_customb_section'
        );
        $sections = get_theme_mod('total_plus_frontpage_sections', $defaults);
        return $sections;
    }

}

if (!function_exists('total_plus_get_section_position')) {

    function total_plus_get_section_position($key) {
        $sections = total_plus_frontpage_sections();
        $position = array_search($key, $sections);
        $return = ( $position + 1 ) * 10;
        return $return;
    }

}

function total_plus_svg_seperator() {
    return array(
        'big-triangle-center' => esc_html__('Big Triangle Center', 'total-plus'),
        'big-triangle-left' => esc_html__('Big Triangle Left', 'total-plus'),
        'big-triangle-right' => esc_html__('Big Triangle Right', 'total-plus'),
        'clouds' => esc_html__('Clouds', 'total-plus'),
        'curve-center' => esc_html__('Curve Center', 'total-plus'),
        'curve-repeater' => esc_html__('Curve Repeater', 'total-plus'),
        'droplets' => esc_html__('Droplets', 'total-plus'),
        'paper-cut' => esc_html__('Paint Brush', 'total-plus'),
        'small-triangle-center' => esc_html__('Small Triangle Center', 'total-plus'),
        'tilt-left' => esc_html__('Tilt Left', 'total-plus'),
        'tilt-right' => esc_html__('Tilt Right', 'total-plus'),
        'uniform-waves' => esc_html__('Uniform Waves', 'total-plus'),
        'water-waves' => esc_html__('Water Waves', 'total-plus'),
        'big-waves' => esc_html__('Big Waves', 'total-plus'),
        'slanted-waves' => esc_html__('Slanted Waves', 'total-plus'),
        'zigzag' => esc_html__('Zigzag', 'total-plus'),
    );
}

function total_plus_tagline_style() {
    return array(
        'ht-section-title-top-center' => esc_html__('Top Center Aligned', 'total-plus'),
        'ht-section-title-top-cs' => esc_html__('Top Center Aligned with Seperator', 'total-plus'),
        'ht-section-title-top-left' => esc_html__('Top Left Aligned', 'total-plus'),
        'ht-section-title-top-ls' => esc_html__('Top Left Aligned with Seperator', 'total-plus'),
        'ht-section-title-single-row' => esc_html__('Top Single Row', 'total-plus'),
        'ht-section-title-side' => esc_html__('Float Left Side', 'total-plus'),
        'ht-section-title-big' => esc_html__('Top Center Aligned with Big Title', 'total-plus')
    );
}


if (!function_exists('total_plus_icon_choices')) {

    function total_plus_icon_choices() {
        echo '<div id="total-plus-icon-box" class="total-plus-icon-box">';
        echo '<div class="total-plus-icon-search">';
        echo '<select>';

        //See customizer-icon-manager.php file
        $icons = apply_filters('total_plus_register_icon', array());

        if ($icons && is_array($icons)) {
            foreach ($icons as $icon) {
                if ($icon['name'] && $icon['label']) {
                    echo '<option value="' . esc_attr($icon['name']) . '">' . esc_html($icon['label']) . '</option>';
                }
            }
        }

        echo '</select>';
        echo '<input type="text" class="total-plus-icon-search-input" placeholder="' . esc_html__('Type to filter', 'total-plus') . '" />';
        echo '</div>';

        if ($icons && is_array($icons)) {
            $active_class = ' active';
            foreach ($icons as $icon) {
                $icon_name = isset($icon['name']) && $icon['name'] ? $icon['name'] : '';
                $icon_prefix = isset($icon['prefix']) && $icon['prefix'] ? $icon['prefix'] : '';
                $icon_displayPrefix = isset($icon['displayPrefix']) && $icon['displayPrefix'] ? $icon['displayPrefix'] . ' ' : '';

                echo '<ul class="total-plus-icon-list ' . esc_attr($icon_name) . esc_attr($active_class) . '">';
                $icon_array = isset($icon['icons']) ? $icon['icons'] : '';
                if (is_array($icon_array)) {
                    foreach ($icon_array as $icon_id) {
                        echo '<li><i class="' . esc_attr($icon_displayPrefix) . esc_attr($icon_prefix) . esc_attr($icon_id) . '"></i></li>';
                    }
                }
                echo '</ul>';
                $active_class = '';
            }
        }

        echo '</div>';
    }

}

add_action('customize_controls_print_footer_scripts', 'total_plus_icon_choices');