<?php

/* ============TAB SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_tab_section', array(
    'title' => esc_html__('Tab Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_tab_section'),
    'hiding_control' => 'total_plus_tab_section_disable'
)));

//ENABLE/DISABLE SERVICE SECTION
$wp_customize->add_setting('total_plus_tab_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_tab_section_disable', array(
    'section' => 'total_plus_tab_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_tab_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_tab_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_tab_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_tab_section_heading',
                'total_plus_tab_super_title',
                'total_plus_tab_title',
                'total_plus_tab_sub_title',
                'total_plus_tab_title_style',
                'total_plus_tab_header',
                'total_plus_tabs',
                'total_plus_tab_setting_heading',
                'total_plus_tab_style',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_tab_cs_heading',
                'total_plus_tab_super_title_color',
                'total_plus_tab_title_color',
                'total_plus_tab_text_color',
                'total_plus_tab_block_seperator',
                'total_plus_tab_block_tab_title_color',
                'total_plus_tab_block_tab_active_title_color',
                'total_plus_tab_block_active_bg_color',
                'total_plus_tab_content_title_color',
                'total_plus_tab_content_text_color',
                'total_plus_tab_link_color',
                'total_plus_tab_link_hov_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_tab_design_settings',
                'total_plus_tab_enable_fullwindow',
                'total_plus_tab_fw_seperator',
                'total_plus_tab_align_item',
                'total_plus_tab_bg_type',
                'total_plus_tab_bg_color',
                'total_plus_tab_bg_gradient',
                'total_plus_tab_bg_image',
                'total_plus_tab_parallax_effect',
                'total_plus_tab_bg_video',
                'total_plus_tab_overlay_color',
                'total_plus_tab_cs_seperator',
                'total_plus_tab_padding',
                'total_plus_tab_seperator0',
                'total_plus_tab_section_seperator',
                'total_plus_tab_seperator1',
                'total_plus_tab_top_seperator',
                'total_plus_tab_ts_color',
                'total_plus_tab_ts_height',
                'total_plus_tab_seperator2',
                'total_plus_tab_bottom_seperator',
                'total_plus_tab_bs_color',
                'total_plus_tab_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_tab_section_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_tab_section_heading', array(
    'section' => 'total_plus_tab_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tab_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_tab_super_title', array(
    'section' => 'total_plus_tab_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_tab_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Tab Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_tab_title', array(
    'section' => 'total_plus_tab_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_tab_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Tab Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_tab_sub_title', array(
    'section' => 'total_plus_tab_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_tab_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_tab_title_style', array(
    'section' => 'total_plus_tab_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => array(
        'ht-section-title-top-center' => esc_html__('Top Center Aligned', 'total-plus'),
        'ht-section-title-top-cs' => esc_html__('Top Center Aligned with Seperator', 'total-plus'),
        'ht-section-title-top-left' => esc_html__('Top Left Aligned', 'total-plus'),
        'ht-section-title-top-ls' => esc_html__('Top Left Aligned with Seperator', 'total-plus'),
        'ht-section-title-single-row' => esc_html__('Top Single Row', 'total-plus'),
        'ht-section-title-big' => esc_html__('Top Center Aligned with Big Title', 'total-plus')
    )
));

//TABS PAGES

$wp_customize->add_setting('total_plus_tab_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_tab_header', array(
    'section' => 'total_plus_tab_section',
    'label' => esc_html__('Tab Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tabs', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => '',
            'title' => '',
            'page' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_tabs', array(
    'section' => 'total_plus_tab_section',
    'box_label' => esc_html__('Tabs Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Icon', 'total-plus'),
        'default' => ''
    ),
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'total-plus'),
        'default' => ''
    ),
    'page' => array(
        'type' => 'select',
        'label' => esc_html__('Select Page', 'total-plus'),
        'options' => $total_plus_page_choice,
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

$wp_customize->add_setting('total_plus_tab_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_tab_setting_heading', array(
    'section' => 'total_plus_tab_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tab_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_tab_style', array(
    'section' => 'total_plus_tab_section',
    'label' => esc_html__('Tab Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/tab-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/tab-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/tab-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/tab-style4.png',
        'style5' => $imagepath . '/inc/customizer/images/tab-style5.png'
    )
)));

$wp_customize->add_setting("total_plus_tab_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_tab_block_seperator", array(
    'section' => 'total_plus_tab_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_tab_block_tab_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_tab_block_tab_title_color', array(
    'section' => 'total_plus_tab_section',
    'priority' => 56,
    'label' => esc_html__('Tab Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tab_block_tab_active_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_tab_block_tab_active_title_color', array(
    'section' => 'total_plus_tab_section',
    'priority' => 56,
    'label' => esc_html__('Active Tab Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tab_block_active_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_tab_block_active_bg_color', array(
    'section' => 'total_plus_tab_section',
    'priority' => 56,
    'label' => esc_html__('Active Tab Background/Borders Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tab_content_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_tab_content_title_color', array(
    'section' => 'total_plus_tab_section',
    'priority' => 56,
    'label' => esc_html__('Tab Content Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_tab_content_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_tab_content_text_color', array(
    'section' => 'total_plus_tab_section',
    'priority' => 56,
    'label' => esc_html__('Tab Content Text Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_tab_title_style', array(
    'selector' => '.ht-tab-section',
    'render_callback' => 'total_plus_tab_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_tab_super_title', array(
    'selector' => '.ht-tab-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_tab_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_tab_title', array(
    'selector' => '.ht-tab-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_tab_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_tab_sub_title', array(
    'selector' => '.ht-tab-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_tab_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_tabs', array(
    'selector' => '.ht-tab-section .ht-section-content',
    'render_callback' => 'total_plus_tab_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_tab_style', array(
    'selector' => '.ht-tab-section .ht-section-content',
    'render_callback' => 'total_plus_tab_content'
));


