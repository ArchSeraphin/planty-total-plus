<?php

$customizer_home_settings = of_get_option('customizer_home_settings', '1');
if (!$customizer_home_settings) {
    return;
}

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
/* HOME PANEL */
$wp_customize->add_panel('total_plus_home_panel', array(
    'title' => esc_html__('Home Sections/Settings', 'total-plus'),
    'description' => esc_html__('Drag and Drop to Reorder', 'total-plus') . '<img class="total-plus-drag-spinner" src="' . admin_url('/images/spinner.gif') . '">',
    'priority' => 20
));

include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-slider-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-about-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-featured-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-highlight-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-service-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-portfolio-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-pricing-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-team-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-testmonial-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-updates-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-tab-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-logo-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-counter-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-cta-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-blog-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-contact-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-customa-settings.php';
include_once get_template_directory() .'/inc/customizer/customizer-panel/home-settings/home-customb-settings.php';


$section_array = total_plus_sections_array();
$exculde_section_array = array('about', 'contact', 'tab', 'cta', 'customa', 'customb');

foreach ($section_array as $id) {

    $wp_customize->add_setting("total_plus_{$id}_enable_fullwindow", array(
        'default' => 'off',
        'sanitize_callback' => 'total_plus_sanitize_text',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, "total_plus_{$id}_enable_fullwindow", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Full Window Section', 'total-plus'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total-plus'),
            'off' => esc_html__('No', 'total-plus')
        ),
        'priority' => 5
    )));

    $wp_customize->add_setting("total_plus_{$id}_align_item", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
        'default' => 'top',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("total_plus_{$id}_align_item", array(
        'section' => "total_plus_{$id}_section",
        'type' => 'radio',
        'label' => esc_html__('Content Alignment', 'total-plus'),
        'choices' => array(
            'top' => esc_html__('Top', 'total-plus'),
            'middle' => esc_html__('Middle', 'total-plus'),
            'bottom' => esc_html__('Bottom', 'total-plus')
        ),
        'priority' => 10
    ));
        
    $wp_customize->add_setting("total_plus_{$id}_fw_seperator", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
    ));

    $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_{$id}_fw_seperator", array(
        'section' => "total_plus_{$id}_section",
        'priority' => 10
    )));

    $wp_customize->add_setting("total_plus_{$id}_bg_type", array(
        'default' => 'color-bg',
        'sanitize_callback' => 'total_plus_sanitize_choices',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("total_plus_{$id}_bg_type", array(
        'section' => "total_plus_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Background Type', 'total-plus'),
        'choices' => array(
            'color-bg' => esc_html__('Color Background', 'total-plus'),
            'gradient-bg' => esc_html__('Gradient Background', 'total-plus'),
            'image-bg' => esc_html__('Image Background', 'total-plus'),
            'video-bg' => esc_html__('Video Background', 'total-plus')
        ),
        'priority' => 15
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_color", array(
        'default' => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_bg_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Background Color', 'total-plus'),
        'priority' => 20
    )));

    $wp_customize->add_setting("total_plus_{$id}_bg_gradient", array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Total_Plus_Gradient_Control($wp_customize, "total_plus_{$id}_bg_gradient", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Gradient Background', 'total-plus'),
        'priority' => 25
    )));

    // Registers example_background settings
    $wp_customize->add_setting("total_plus_{$id}_bg_image_url", array(
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_image_id", array(
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_image_repeat", array(
        'default' => 'no-repeat',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_image_size", array(
        'default' => 'cover',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_position", array(
        'default' => 'center-center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_image_attach", array(
        'default' => 'fixed',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));

    // Registers example_background control
    $wp_customize->add_control(new Total_Plus_Background_Control($wp_customize, "total_plus_{$id}_bg_image", array(
        'label' => esc_html__('Background Image', 'total-plus'),
        'section' => "total_plus_{$id}_section",
        'settings' => array(
            'image_url' => "total_plus_{$id}_bg_image_url",
            'image_id' => "total_plus_{$id}_bg_image_id",
            'repeat' => "total_plus_{$id}_bg_image_repeat", // Use false to hide the field
            'size' => "total_plus_{$id}_bg_image_size",
            'position' => "total_plus_{$id}_bg_position",
            'attach' => "total_plus_{$id}_bg_image_attach"
        ),
        'priority' => 30
    )));

    $wp_customize->add_setting("total_plus_{$id}_parallax_effect", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
        'default' => 'none',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("total_plus_{$id}_parallax_effect", array(
        'type' => 'radio',
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Background Effect', 'total-plus'),
        'choices' => array(
            'none' => esc_html__('None', 'total-plus'),
            'parallax' => esc_html__('Enable Parallax', 'total-plus'),
            'scroll' => esc_html__('Horizontal Moving', 'total-plus')
        ),
        'priority' => 35
    ));

    $wp_customize->add_setting("total_plus_{$id}_bg_video", array(
        'default' => '6O9Nd1RSZSY',
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control("total_plus_{$id}_bg_video", array(
        'section' => "total_plus_{$id}_section",
        'type' => 'text',
        'label' => esc_html__('Youtube Video ID', 'total-plus'),
        'description' => esc_html__('https://www.youtube.com/watch?v=yNAsk4Zw2p0. Add only yNAsk4Zw2p0', 'total-plus'),
        'priority' => 40
    ));

    $wp_customize->add_setting("total_plus_{$id}_overlay_color", array(
        'default' => 'rgba(255,255,255,0)',
        'sanitize_callback' => 'total_plus_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, "total_plus_{$id}_overlay_color", array(
        'label' => esc_html__('Background Overlay Color', 'total-plus'),
        'section' => "total_plus_{$id}_section",
        'palette' => array(
            'rgb(255, 255, 255, 0.3)', // RGB, RGBa, and hex values supported
            'rgba(0, 0, 0, 0.3)',
            'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
            '#00CC99', // Mix of color types = no problem
            '#00C439',
            '#00C569',
            'rgba( 255, 234, 255, 0.2 )', // Different spacing = no problem
            '#AACC99', // Mix of color types = no problem
            '#33C439',
        ),
        'priority' => 45
    )));

    $wp_customize->add_setting("total_plus_{$id}_cs_heading", array(
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, "total_plus_{$id}_cs_heading", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Color Settings', 'total-plus'),
        'priority' => 50
    )));

    $wp_customize->add_setting("total_plus_{$id}_super_title_color", array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_super_title_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Section Super Title Color', 'total-plus'),
        'priority' => 55
    )));

    $wp_customize->add_setting("total_plus_{$id}_title_color", array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_title_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Section Title Color', 'total-plus'),
        'priority' => 55
    )));

    $wp_customize->add_setting("total_plus_{$id}_text_color", array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_text_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Section Text Color', 'total-plus'),
        'priority' => 55
    )));

    $wp_customize->add_setting("total_plus_{$id}_link_color", array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_link_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Section Link Color', 'total-plus'),
        'priority' => 55
    )));

    $wp_customize->add_setting("total_plus_{$id}_link_hov_color", array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_link_hov_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Section Link Hover Color', 'total-plus'),
        'priority' => 55
    )));

    if (!in_array($id, $exculde_section_array)) {
        $wp_customize->add_setting("total_plus_{$id}_mb_seperator", array(
            'sanitize_callback' => 'total_plus_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_{$id}_mb_seperator", array(
            'section' => "total_plus_{$id}_section",
            'priority' => 60
        )));

        $wp_customize->add_setting("total_plus_{$id}_mb_bg_color", array(
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_setting("total_plus_{$id}_mb_text_color", array(
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_setting("total_plus_{$id}_mb_hov_bg_color", array(
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_setting("total_plus_{$id}_mb_hov_text_color", array(
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_control(new Total_Plus_Color_Tab_Control($wp_customize, "total_plus_{$id}_mb_color_group", array(
            'label' => esc_html__('More Button Colors', 'total-plus'),
            'section' => "total_plus_{$id}_section",
            'show_opacity' => false,
            'priority' => 60,
            'settings' => array(
                "normal_total_plus_{$id}_mb_bg_color" => "total_plus_{$id}_mb_bg_color",
                "normal_total_plus_{$id}_mb_text_color" => "total_plus_{$id}_mb_text_color",
                "hover_total_plus_{$id}_mb_hov_bg_color" => "total_plus_{$id}_mb_hov_bg_color",
                "hover_total_plus_{$id}_mb_hov_text_color" => "total_plus_{$id}_mb_hov_text_color",
            ),
            'group' => array(
                "normal_total_plus_{$id}_mb_bg_color" => esc_html__('Button Background Color', 'total-plus'),
                "normal_total_plus_{$id}_mb_text_color" => esc_html__('Button Text Color', 'total-plus'),
                "hover_total_plus_{$id}_mb_hov_bg_color" => esc_html__('Button Background Color', 'total-plus'),
                "hover_total_plus_{$id}_mb_hov_text_color" => esc_html__('Button Text Color', 'total-plus')
            )
        )));
    }

    $wp_customize->add_setting("total_plus_{$id}_cs_seperator", array(
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_{$id}_cs_seperator", array(
        'section' => "total_plus_{$id}_section",
        'priority' => 80
    )));
    
    $wp_customize->add_setting("total_plus_{$id}_padding_top", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'default' => 100,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_padding_bottom", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'default' => 100,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_tablet_padding_top", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_tablet_padding_bottom", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_mobile_padding_top", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_mobile_padding_bottom", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Total_Plus_Dimensions_Control($wp_customize, "total_plus_{$id}_padding", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Top & Bottom Paddings (px)', 'total-plus'),
        'settings' => array(
            'desktop_top' => "total_plus_{$id}_padding_top",
            'desktop_bottom' => "total_plus_{$id}_padding_bottom",
            'tablet_top' => "total_plus_{$id}_tablet_padding_top",
            'tablet_bottom' => "total_plus_{$id}_tablet_padding_bottom",
            'mobile_top' => "total_plus_{$id}_mobile_padding_top",
            'mobile_bottom' => "total_plus_{$id}_mobile_padding_bottom",
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 400,
            'step' => 1,
        ),
        'priority' => 85
    )));

    $wp_customize->add_setting("total_plus_{$id}_seperator0", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
    ));

    $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_{$id}_seperator0", array(
        'section' => "total_plus_{$id}_section",
        'priority' => 90
    )));

    $wp_customize->add_setting("total_plus_{$id}_section_seperator", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
        'default' => 'no',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("total_plus_{$id}_section_seperator", array(
        'section' => "total_plus_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Enable Separator', 'total-plus'),
        'choices' => array(
            'no' => esc_html__('Disable', 'total-plus'),
            'top' => esc_html__('Enable Top Separator', 'total-plus'),
            'bottom' => esc_html__('Enable Bottom Separator', 'total-plus'),
            'top-bottom' => esc_html__('Enable Top & Bottom Separator', 'total-plus')
        ),
        'priority' => 95
    ));

    $wp_customize->add_setting("total_plus_{$id}_seperator1", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
    ));

    $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_{$id}_seperator1", array(
        'section' => "total_plus_{$id}_section",
        'priority' => 100
    )));

    $wp_customize->add_setting("total_plus_{$id}_top_seperator", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
        'default' => 'big-triangle-center',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("total_plus_{$id}_top_seperator", array(
        'section' => "total_plus_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Top Separator', 'total-plus'),
        'choices' => total_plus_svg_seperator(),
        'priority' => 105
    ));

    $wp_customize->add_setting("total_plus_{$id}_ts_color", array(
        'default' => '#FF0000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_ts_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Top Separator Color', 'total-plus'),
        'priority' => 115
    )));
    
    $wp_customize->add_setting("total_plus_{$id}_ts_height", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'default' => 60,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_ts_height_tablet", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_ts_height_mobile", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Total_Plus_Range_Slider_Control($wp_customize, "total_plus_{$id}_ts_height", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Top Separator Height (px)', 'total-plus'),
        'settings' => array(
            'desktop' => "total_plus_{$id}_ts_height",
            'tablet' => "total_plus_{$id}_ts_height_tablet",
            'mobile' => "total_plus_{$id}_ts_height_mobile",
        ),
        'input_attrs' => array(
            'min' => 20,
            'max' => 200,
            'step' => 1,
        ),
        'priority' => 120
    )));

    $wp_customize->add_setting("total_plus_{$id}_seperator2", array(
        'sanitize_callback' => 'total_plus_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_{$id}_seperator2", array(
        'section' => "total_plus_{$id}_section",
        'priority' => 125
    )));

    $wp_customize->add_setting("total_plus_{$id}_bottom_seperator", array(
        'sanitize_callback' => 'total_plus_sanitize_text',
        'default' => 'big-triangle-center',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control("total_plus_{$id}_bottom_seperator", array(
        'section' => "total_plus_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Bottom Separator', 'total-plus'),
        'choices' => total_plus_svg_seperator(),
        'priority' => 130
    ));

    $wp_customize->add_setting("total_plus_{$id}_bs_color", array(
        'default' => '#FF0000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "total_plus_{$id}_bs_color", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Bottom Separator Color', 'total-plus'),
        'priority' => 135,
    )));
        
    $wp_customize->add_setting("total_plus_{$id}_bs_height", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'default' => 60,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bs_height_tablet", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_setting("total_plus_{$id}_bs_height_mobile", array(
        'sanitize_callback' => 'total_plus_sanitize_number_blank',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Total_Plus_Range_Slider_Control($wp_customize, "total_plus_{$id}_bs_height", array(
        'section' => "total_plus_{$id}_section",
        'label' => esc_html__('Bottom Separator Height (px)', 'total-plus'),
        'input_attrs' => array(
            'min' => 20,
            'max' => 200,
            'step' => 1,
        ),
        'settings' => array(
            'desktop' => "total_plus_{$id}_bs_height",
            'tablet' => "total_plus_{$id}_bs_height_tablet",
            'mobile' => "total_plus_{$id}_bs_height_mobile",
        ),
        'priority' => 140
    )));

    $wp_customize->selective_refresh->add_partial("total_plus_{$id}_bg_type", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "total_plus_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("total_plus_{$id}_parallax_effect", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "total_plus_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("total_plus_{$id}_section_seperator", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "total_plus_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("total_plus_{$id}_top_seperator", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "total_plus_{$id}_section",
        'container_inclusive' => true
    ));

    $wp_customize->selective_refresh->add_partial("total_plus_{$id}_bottom_seperator", array(
        'selector' => "#ht-{$id}-section",
        'render_callback' => "total_plus_{$id}_section",
        'container_inclusive' => true
    ));
}
