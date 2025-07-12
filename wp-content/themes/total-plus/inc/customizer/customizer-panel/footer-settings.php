<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
$wp_customize->add_section('total_plus_footer_section', array(
    'title' => esc_html__('Footer Settings', 'total-plus'),
    'priority' => 50
));

$wp_customize->add_setting('total_plus_footer_sec_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_footer_sec_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_footer_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_footer_layout',
                'total_plus_footer_col',
                'total_plus_footer_copyright'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_footer_bg',
                'total_plus_footer_bg_color',
                'total_plus_footer_text_color',
                'total_plus_footer_anchor_color'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_footer_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'footer-style1'
));

$wp_customize->add_control(new Total_Plus_Image_Select($wp_customize, 'total_plus_footer_layout', array(
    'section' => 'total_plus_footer_section',
    'label' => esc_html__('Footer Layout', 'total-plus'),
    'image_path' => $imagepath . '/inc/customizer/images/',
    'choices' => array(
        'footer-style1' => esc_html__('Footer Layout 1', 'total-plus'),
        'footer-style2' => esc_html__('Footer Layout 2', 'total-plus'),
        'footer-style3' => esc_html__('Footer Layout 3', 'total-plus'),
        'footer-style4' => esc_html__('Footer Layout 4', 'total-plus'),
        'footer-style5' => esc_html__('Footer Layout 5', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_footer_col', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'col-3-1-1-1'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_footer_col', array(
    'section' => 'total_plus_footer_section',
    'label' => esc_html__('Footer Column', 'total-plus'),
    'class' => 'ht-one-third-width',
    'options' => array(
        'col-1-1' => $imagepath . '/inc/customizer/images/col-1-1.jpg',
        'col-2-1-1' => $imagepath . '/inc/customizer/images/col-2-1-1.jpg',
        'col-3-1-1-1' => $imagepath . '/inc/customizer/images/col-3-1-1-1.jpg',
        'col-3-1-2' => $imagepath . '/inc/customizer/images/col-3-1-2.jpg',
        'col-3-2-1' => $imagepath . '/inc/customizer/images/col-3-2-1.jpg',
        'col-4-1-1-1-1' => $imagepath . '/inc/customizer/images/col-4-1-1-1-1.jpg',
        'col-4-1-1-2' => $imagepath . '/inc/customizer/images/col-4-1-1-2.jpg',
        'col-4-2-1-1' => $imagepath . '/inc/customizer/images/col-4-2-1-1.jpg',
        'col-4-1-2-1' => $imagepath . '/inc/customizer/images/col-4-1-2-1.jpg',
        'col-4-1-3' => $imagepath . '/inc/customizer/images/col-4-1-3.jpg',
        'col-4-3-1' => $imagepath . '/inc/customizer/images/col-4-3-1.jpg'
    )
)));

$wp_customize->add_setting('total_plus_footer_bg_url', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_footer_bg_id', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_footer_bg_repeat', array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_footer_bg_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_footer_bg_position', array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_footer_bg_attach', array(
    'default' => 'fixed',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

// Registers example_background control
$wp_customize->add_control(new Total_Plus_Background_Control($wp_customize, 'total_plus_footer_bg', array(
    'label' => esc_html__('Footer Background', 'total-plus'),
    'section' => 'total_plus_footer_section',
    'settings' => array(
        'image_url' => 'total_plus_footer_bg_url',
        'image_id' => 'total_plus_footer_bg_id',
        'repeat' => 'total_plus_footer_bg_repeat', // Use false to hide the field
        'size' => 'total_plus_footer_bg_size',
        'position' => 'total_plus_footer_bg_position',
        'attach' => 'total_plus_footer_bg_attach'
    )
)));

$wp_customize->add_setting('total_plus_footer_bg_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_footer_bg_color', array(
    'label' => esc_html__('Footer Background/Overlay Color', 'total-plus'),
    'description' => esc_html__('To use background image, set the opacity of background color to 0', 'total-plus'),
    'section' => 'total_plus_footer_section'
)));

$wp_customize->add_setting('total_plus_footer_text_color', array(
    'default' => '#EEEEEE',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_footer_text_color', array(
    'section' => 'total_plus_footer_section',
    'label' => esc_html__('Footer Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_footer_anchor_color', array(
    'default' => '#EEEEEE',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_footer_anchor_color', array(
    'section' => 'total_plus_footer_section',
    'label' => esc_html__('Footer Anchor Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_footer_copyright', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('&copy; 2020. All Right Reserved.', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_footer_copyright', array(
    'section' => 'total_plus_footer_section',
    'type' => 'textarea',
    'label' => esc_html__('Copyright Text', 'total-plus')
));
