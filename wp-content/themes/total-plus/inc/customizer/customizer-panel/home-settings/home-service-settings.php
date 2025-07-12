<?php

/* ============SERVICE SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_service_section', array(
    'title' => esc_html__('Service Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_service_section'),
    'hiding_control' => 'total_plus_service_section_disable'
)));

//ENABLE/DISABLE SERVICE SECTION
$wp_customize->add_setting('total_plus_service_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_service_section_disable', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_service_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_service_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_service_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_service_section_heading',
                'total_plus_service_super_title',
                'total_plus_service_title',
                'total_plus_service_sub_title',
                'total_plus_service_title_style',
                'total_plus_service_header',
                'total_plus_service',
                'total_plus_service_bg_heading',
                'total_plus_service_bg',
                'total_plus_service_bg_align',
                'total_plus_service_setting_heading',
                'total_plus_service_style',
                'total_plus_service_more_button_heading',
                'total_plus_service_button_text',
                'total_plus_service_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_service_cs_heading',
                'total_plus_service_super_title_color',
                'total_plus_service_title_color',
                'total_plus_service_text_color',
                'total_plus_service_link_color',
                'total_plus_service_link_hov_color',
                'total_plus_service_block_seperator',
                'total_plus_service_block_icon_color',
                'total_plus_service_block_icon_bg_color',
                'total_plus_service_block_title_color',
                'total_plus_service_block_excerpt_color',
                'total_plus_service_block_link_color',
                'total_plus_service_mb_seperator',
                'total_plus_service_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_service_enable_fullwindow',
                'total_plus_service_align_item',
                'total_plus_service_fw_seperator',
                'total_plus_service_bg_type',
                'total_plus_service_bg_color',
                'total_plus_service_bg_gradient',
                'total_plus_service_bg_image',
                'total_plus_service_parallax_effect',
                'total_plus_service_bg_video',
                'total_plus_service_overlay_color',
                'total_plus_service_cs_seperator',
                'total_plus_service_padding',
                'total_plus_service_seperator0',
                'total_plus_service_section_seperator',
                'total_plus_service_seperator1',
                'total_plus_service_top_seperator',
                'total_plus_service_ts_color',
                'total_plus_service_ts_height',
                'total_plus_service_seperator2',
                'total_plus_service_bottom_seperator',
                'total_plus_service_bs_color',
                'total_plus_service_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_service_section_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_service_section_heading', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_super_title', array(
    'section' => 'total_plus_service_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_service_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Service Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_title', array(
    'section' => 'total_plus_service_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_service_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Service Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_sub_title', array(
    'section' => 'total_plus_service_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_service_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_title_style', array(
    'section' => 'total_plus_service_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => array(
        'ht-section-title-top-center' => esc_html__('Top Center Aligned', 'total-plus'),
        'ht-section-title-top-cs' => esc_html__('Top Center Aligned with Seperator', 'total-plus'),
        'ht-section-title-top-left' => esc_html__('Top Left Aligned', 'total-plus'),
        'ht-section-title-top-ls' => esc_html__('Top Left Aligned with Seperator', 'total-plus'),
        'ht-section-title-big' => esc_html__('Top Center Aligned with Big Title', 'total-plus')
    )
));

//SERVICE PAGES

$wp_customize->add_setting('total_plus_service_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_service_header', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('Service Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => 'icofont-angry-monster',
            'title' => '',
            'content' => '',
            'link_text' => '',
            'link' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_service', array(
    'section' => 'total_plus_service_section',
    'box_label' => esc_html__('Service Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'total-plus'),
        'default' => 'icofont-angry-monster'
    ),
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'total-plus'),
        'default' => ''
    ),
    'content' => array(
        'type' => 'textarea',
        'label' => esc_html__('Content', 'total-plus'),
        'default' => ''
    ),
    'link_text' => array(
        'type' => 'text',
        'label' => esc_html__('Link Text', 'total-plus'),
        'default' => esc_html__('Read More', 'total-plus'),
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Link', 'total-plus'),
        'default' => ''
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable Section', 'total-plus'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->add_setting('total_plus_service_bg_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_service_bg_heading', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('Service Image', 'total-plus')
)));

// Registers example_background settings
$wp_customize->add_setting('total_plus_service_bg_url', array(
    'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_setting('total_plus_service_bg_id', array(
    'sanitize_callback' => 'absint'
));

$wp_customize->add_setting('total_plus_service_bg_repeat', array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('total_plus_service_bg_size', array(
    'default' => 'auto',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('total_plus_service_bg_pos', array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('total_plus_service_bg_attach', array(
    'default' => 'scroll',
    'sanitize_callback' => 'sanitize_text_field'
));

// Registers example_background control
$wp_customize->add_control(new Total_Plus_Background_Control($wp_customize, 'total_plus_service_bg', array(
    'label' => esc_html__('Background Image', 'total-plus'),
    'section' => 'total_plus_service_section',
    'settings' => array(
        'image_url' => 'total_plus_service_bg_url',
        'image_id' => 'total_plus_service_bg_id',
        'repeat' => 'total_plus_service_bg_repeat', // Use false to hide the field
        'size' => 'total_plus_service_bg_size',
        'position' => 'total_plus_service_bg_pos',
        'attach' => 'total_plus_service_bg_attach'
    )
)));

$wp_customize->add_setting('total_plus_service_bg_align', array(
    'default' => 'right',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_bg_align', array(
    'section' => 'total_plus_service_section',
    'type' => 'radio',
    'label' => esc_html__('Image Position', 'total-plus'),
    'choices' => array(
        'left' => esc_html__('Left', 'total-plus'),
        'right' => esc_html__('Right', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_service_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_service_setting_heading', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_service_style', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('Service Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/service-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/service-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/service-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/service-style4.png'
    )
)));

$wp_customize->add_setting('total_plus_service_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_service_more_button_heading', array(
    'section' => 'total_plus_service_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_button_text', array(
    'section' => 'total_plus_service_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_service_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_service_button_link', array(
    'section' => 'total_plus_service_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_service_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_service_block_seperator", array(
    'section' => 'total_plus_service_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_service_block_icon_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_service_block_icon_color', array(
    'section' => 'total_plus_service_section',
    'priority' => 56,
    'label' => esc_html__('Service Block Icon Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_block_icon_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_service_block_icon_bg_color', array(
    'section' => 'total_plus_service_section',
    'priority' => 56,
    'label' => esc_html__('Service Block Icon Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_block_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_service_block_title_color', array(
    'section' => 'total_plus_service_section',
    'priority' => 56,
    'label' => esc_html__('Service Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_block_excerpt_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_service_block_excerpt_color', array(
    'section' => 'total_plus_service_section',
    'priority' => 56,
    'label' => esc_html__('Service Block Excerpt Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_service_block_link_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_service_block_link_color', array(
    'section' => 'total_plus_service_section',
    'priority' => 56,
    'label' => esc_html__('Service Block Read More Link Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_service_title_style', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_super_title', array(
    'selector' => '.ht-service-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_service_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_title', array(
    'selector' => '.ht-service-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_service_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_sub_title', array(
    'selector' => '.ht-service-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_service_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service', array(
    'selector' => '.ht-service-post-holder',
    'render_callback' => 'total_plus_service_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_service_bg_url', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_bg_size', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_bg_repeat', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_bg_attach', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_bg_pos', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_bg_align', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_style', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_button_text', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_service_button_link', array(
    'selector' => '.ht-service-section',
    'render_callback' => 'total_plus_service_section',
    'container_inclusive' => true
));
