<?php

$customizer_maintenance_mode = of_get_option('customizer_maintenance_mode', '1');
if(!$customizer_maintenance_mode){
    return;
}
/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
$wp_customize->add_section('total_plus_maintenance_section', array(
    'title' => esc_html__('Maintenance Mode Settings', 'total-plus'),
    'priority' => -1,
    'description' => '<strong style="color:red">' . esc_html__('Note: Maintenance Screen only appears for non logged in user. Please open the website in another browser as a non logged in user inorder to check.', 'total-plus') . '</strong>'
));

$wp_customize->add_setting('total_plus_maintenance_sec_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_maintenance_sec_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_maintenance_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_maintenance_logo',
                'total_plus_maintenance_title',
                'total_plus_maintenance_text',
                'total_plus_maintenance_date',
                'total_plus_maintenance_shortcode',
                'total_plus_maintenance_social',
                'total_plus_maintenance_bg_type',
                'total_plus_maintenance_banner_image',
                'total_plus_maintenance_slider_shortcode',
                'total_plus_maintenance_sliders',
                'total_plus_maintenance_slider_info',
                'total_plus_maintenance_slider_pause',
                'total_plus_maintenance_video',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_maintenance_bg_overlay_color',
                'total_plus_maintenance_title_color',
                'total_plus_maintenance_text_color',
                'total_plus_maintenance_counter_color',
                'total_plus_maintenance_social_icon_color'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_maintenance', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_maintenance', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Enable Maintenance Screen', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_maintenance_logo', array(
    'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_plus_maintenance_logo', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Upload Logo', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_maintenance_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('WEBSITE UNDER MAINTENANCE', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_maintenance_title', array(
    'section' => 'total_plus_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Maintenance Title', 'total-plus'),
));

$wp_customize->add_setting('total_plus_maintenance_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('We are coming soon with new changes. Stay Tuned!', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Page_Editor($wp_customize, 'total_plus_maintenance_text', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Maintenance Text', 'total-plus')
)));

$wp_customize->add_setting('total_plus_maintenance_date', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Date_Control($wp_customize, 'total_plus_maintenance_date', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Maintenance Date', 'total-plus'),
    'description' => esc_html__('Choose the Date when you plan to make your website live.', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_maintenance_shortcode', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_maintenance_shortcode', array(
    'section' => 'total_plus_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Maintenance ShortCode', 'total-plus'),
    'description' => esc_html__('Add the ShortCode for mailchimp or any other content that you want to show', 'total-plus')
));

$wp_customize->add_setting('total_plus_maintenance_social', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_maintenance_social', array(
    'label' => esc_html__('Social Icons', 'total-plus'),
    'section' => 'total_plus_maintenance_section',
    'description' => sprintf(esc_html__('Add your %s here', 'total-plus'), '<a href="#" target="_blank">Social Icons</a>')
)));

$wp_customize->add_setting('total_plus_maintenance_bg_type', array(
    'default' => 'banner',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_maintenance_bg_type', array(
    'section' => 'total_plus_maintenance_section',
    'type' => 'radio',
    'label' => esc_html__('Maintenance Background Type', 'total-plus'),
    'choices' => array(
        'banner' => esc_html__('Banner Image', 'total-plus'),
        'slider' => esc_html__('Image Slider', 'total-plus'),
        'revolution' => esc_html__('Revolution Slider', 'total-plus'),
        'video' => esc_html__('Video', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_maintenance_banner_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'default' => get_template_directory_uri() . '/images/bg.jpg',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_plus_maintenance_banner_image', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Upload Banner Image', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_maintenance_slider_shortcode', array(
    'default' => '',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_maintenance_slider_shortcode', array(
    'section' => 'total_plus_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Slider ShortCode', 'total-plus'),
    'description' => esc_html__('Add the ShortCode for Slider', 'total-plus')
));

$wp_customize->add_setting('total_plus_maintenance_sliders', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'image' => ''
        )
    ))
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_maintenance_sliders', array(
    'label' => esc_html__('Add Sliders', 'total-plus'),
    'section' => 'total_plus_maintenance_section',
    'box_label' => esc_html__('Slider', 'total-plus'),
    'add_label' => esc_html__('Add Slider', 'total-plus')
        ), array(
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Image', 'total-plus'),
        'default' => ''
    )
)));

$wp_customize->add_setting('total_plus_maintenance_slider_info', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_maintenance_slider_info', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Note:', 'total-plus'),
    'description' => esc_html__('Recommended Image Size: 1900X1000', 'total-plus')
)));

$wp_customize->add_setting('total_plus_maintenance_slider_pause', array(
    'default' => '5',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_maintenance_slider_pause', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Slider Pause Duration', 'total-plus'),
    'description' => esc_html__('Slider Pause duration in seconds', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 10,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_maintenance_video', array(
    'default' => 'yNAsk4Zw2p0',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_maintenance_video', array(
    'section' => 'total_plus_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Video Id', 'total-plus'),
    'description' => 'https://www.youtube.com/watch?v=<strong>yNAsk4Zw2p0</strong>. ' . esc_html__('Add only yNAsk4Zw2p0', 'total-plus')
));

$wp_customize->add_setting('total_plus_maintenance_bg_overlay_color', array(
    'default' => 'rgba(255,255,255,0)',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_maintenance_bg_overlay_color', array(
    'label' => esc_html__('Background Overlay Color', 'total-plus'),
    'section' => 'total_plus_maintenance_section',
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
    )
)));

$wp_customize->add_setting('total_plus_maintenance_title_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_maintenance_title_color', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_maintenance_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_maintenance_text_color', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_maintenance_counter_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_maintenance_counter_color', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Counter Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_maintenance_social_icon_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_maintenance_social_icon_color', array(
    'section' => 'total_plus_maintenance_section',
    'label' => esc_html__('Social Icon Color', 'total-plus')
)));