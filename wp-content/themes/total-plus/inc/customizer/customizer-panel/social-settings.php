<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
//SOCIAL SETTINGS
$wp_customize->add_section('total_plus_social_section', array(
    'title' => esc_html__('Social Links', 'total-plus')
));

$wp_customize->add_setting('total_plus_social_icons', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => 'icofont-facebook',
            'text' => '',
            'enable' => 'on'
        )
    ))
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_social_icons', array(
    'label' => esc_html__('Add Social Link', 'total-plus'),
    'section' => 'total_plus_social_section',
    'box_label' => esc_html__('Social Links', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'total-plus'),
        'default' => 'icofont-facebook'
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Add Link', 'total-plus'),
        'default' => ''
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable', 'total-plus'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));
