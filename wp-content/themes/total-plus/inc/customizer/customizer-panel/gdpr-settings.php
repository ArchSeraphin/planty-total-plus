<?php

$customizer_gdpr_settings = of_get_option('customizer_gdpr_settings', '1');
if (!$customizer_gdpr_settings) {
    return;
}

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
/* GDPR SETTINGS PANEL */

$wp_customize->add_section('total_plus_gdpr_section', array(
    'title' => esc_html__('GDPR Settings', 'total-plus'),
    'description' => esc_html__('Use it add GDPR Compliance, Cookies Consent or any other Promotional Stuffs.', 'total-plus')
));

$wp_customize->add_setting('total_plus_gdpr_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_gdpr_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_gdpr_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_gdpr_position',
                'total_plus_gdpr_notice',
                'total_plus_gdpr_confirm_button_text',
                'total_plus_gdpr_button_text',
                'total_plus_gdpr_button_link',
                'total_plus_gdpr_new_tab',
                'total_plus_gdpr_hide_mobile'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_gdpr_bg',
                'total_plus_gdpr_text_color',
                'total_plus_button_bg_color',
                'total_plus_button_text_color'
            ),
        )
    ),
)));

$wp_customize->add_setting('total_plus_enable_gdpr', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_enable_gdpr', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('Activate GDPR Notice', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_gdpr_position', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'bottom-full-width',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_gdpr_position', array(
    'section' => 'total_plus_gdpr_section',
    'type' => 'select',
    'label' => esc_html__('Select Position', 'total-plus'),
    'choices' => array(
        'top-full-width' => esc_html__('Top - Full Width', 'total-plus'),
        'bottom-full-width' => esc_html__('Bottom - Full Width', 'total-plus'),
        'bottom-left-float' => esc_html__('Bottom Left - Float', 'total-plus'),
        'bottom-right-float' => esc_html__('Bottom Right - Float', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_gdpr_bg', array(
    'default' => '#333333',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_gdpr_bg', array(
    'label' => esc_html__('Background Color', 'total-plus'),
    'section' => 'total_plus_gdpr_section',
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        'rgba( 255, 255, 255, 0.2 )',
        'rgba( 0, 0, 0, 0.2 )'
    )
)));

$wp_customize->add_setting('total_plus_gdpr_notice', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Our website use cookies to improve and personalize your experience and to display advertisements(if any). Our website may also include cookies from third parties like Google Adsense, Google Analytics, Youtube. By using the website, you consent to the use of cookies. We have updated our Privacy Policy. Please click on the button to check our Privacy Policy.', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Page_Editor($wp_customize, 'total_plus_gdpr_notice', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('GDPR Notice', 'total-plus'),
    'include_admin_print_footer' => true
)));

$wp_customize->add_setting('total_plus_gdpr_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_gdpr_text_color', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('Text Color', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_gdpr_confirm_button_text', array(
    'default' => esc_html__('Ok, I Agree', 'total-plus'),
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_gdpr_confirm_button_text', array(
    'section' => 'total_plus_gdpr_section',
    'type' => 'text',
    'label' => esc_html__('Confirm Button Text', 'total-plus'),
    'description' => esc_html__('This button closes the GDPR section. Once you close it, the section will not appear for 1 day.', 'total-plus')
));

$wp_customize->add_setting('total_plus_gdpr_button_text', array(
    'default' => esc_html__('Privacy Policy', 'total-plus'),
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_gdpr_button_text', array(
    'section' => 'total_plus_gdpr_section',
    'type' => 'text',
    'label' => esc_html__('GDPR Notice Button Text', 'total-plus'),
));

$wp_customize->add_setting('total_plus_gdpr_button_link', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_gdpr_button_link', array(
    'section' => 'total_plus_gdpr_section',
    'type' => 'text',
    'label' => esc_html__('GDPR Notice Page Link', 'total-plus'),
    'description' => esc_html__('Leave blank if you don\'t want to show', 'total-plus')
));

$wp_customize->add_setting('total_plus_gdpr_new_tab', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_gdpr_new_tab', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('Open Link in New Tab', 'total-plus')
)));

$wp_customize->add_setting('total_plus_button_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_button_bg_color', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('Button Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_button_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_button_text_color', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('Button Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_gdpr_hide_mobile', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_gdpr_hide_mobile', array(
    'section' => 'total_plus_gdpr_section',
    'label' => esc_html__('Hide Section in Mobile', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_gdpr_button_text', array(
    'selector' => '.total-plus-privacy-policy',
    'render_callback' => 'total_plus_gdpr_notice',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_gdpr_button_link', array(
    'selector' => '.total-plus-privacy-policy',
    'render_callback' => 'total_plus_gdpr_notice',
    'container_inclusive' => true
));
