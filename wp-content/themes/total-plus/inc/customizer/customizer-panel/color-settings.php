<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
$wp_customize->get_section('colors')->title = esc_html__('Color Settings', 'total-plus');
$wp_customize->get_section('colors')->priority = 10;

//COLOR SETTINGS
$wp_customize->add_setting('total_plus_template_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_template_color', array(
    'section' => 'colors',
    'label' => esc_html__('Theme Primary Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_color_section_seperator1', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_color_section_seperator1', array(
    'section' => 'colors'
)));

$wp_customize->add_setting('total_plus_color_content_info', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_color_content_info', array(
    'section' => 'colors',
    'label' => esc_html__('Content Colors', 'total-plus'),
    'description' => esc_html__('This settings apply only in the single pages likes page and post detail pages only.', 'total-plus')
)));

$wp_customize->add_setting('total_plus_content_header_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_content_header_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Header Color(H1, H2, H3, H4, H5, H6)', 'total-plus')
)));

$wp_customize->add_setting('total_plus_content_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_content_text_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_content_link_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_content_link_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Link Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_content_link_hov_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_content_link_hov_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Link Hover Color', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_color_section_seperator2', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_color_section_seperator2', array(
    'section' => 'colors'
)));

$wp_customize->add_setting('total_plus_content_widget_title_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_content_widget_title_color', array(
    'section' => 'colors',
    'label' => esc_html__('Sidebar Widget Title Color', 'total-plus')
)));
