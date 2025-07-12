<?php


/* ============CLIENTS LOGO SECTION============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_logo_section', array(
    'title' => esc_html__('Clients Logo Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_logo_section'),
    'hiding_control' => 'total_plus_logo_section_disable'
)));

//ENABLE/DISABLE LOGO SECTION
$wp_customize->add_setting('total_plus_logo_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_logo_section_disable', array(
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_logo_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_logo_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_logo_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_logo_title_subtitle_heading',
                'total_plus_logo_super_title',
                'total_plus_logo_title',
                'total_plus_logo_sub_title',
                'total_plus_logo_title_style',
                'total_plus_logo_header',
                'total_plus_logo',
                'total_plus_logo_new_tab',
                'total_plus_logo_setting_heading',
                'total_plus_logo_style',
                'total_plus_logo_more_button_heading',
                'total_plus_logo_button_text',
                'total_plus_logo_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_logo_cs_heading',
                'total_plus_logo_super_title_color',
                'total_plus_logo_title_color',
                'total_plus_logo_text_color',
                'total_plus_logo_link_color',
                'total_plus_logo_link_hov_color',
                'total_plus_logo_mb_seperator',
                'total_plus_logo_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_logo_enable_fullwindow',
                'total_plus_logo_align_item',
                'total_plus_logo_fw_seperator',
                'total_plus_logo_bg_type',
                'total_plus_logo_bg_color',
                'total_plus_logo_bg_gradient',
                'total_plus_logo_bg_image',
                'total_plus_logo_parallax_effect',
                'total_plus_logo_bg_video',
                'total_plus_logo_overlay_color',
                'total_plus_logo_cs_seperator',
                'total_plus_logo_padding',
                'total_plus_logo_seperator0',
                'total_plus_logo_section_seperator',
                'total_plus_logo_seperator1',
                'total_plus_logo_top_seperator',
                'total_plus_logo_ts_color',
                'total_plus_logo_ts_height',
                'total_plus_logo_seperator2',
                'total_plus_logo_bottom_seperator',
                'total_plus_logo_bs_color',
                'total_plus_logo_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_logo_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_logo_title_subtitle_heading', array(
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_logo_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_super_title', array(
    'section' => 'total_plus_logo_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_logo_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Client Logo Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_title', array(
    'section' => 'total_plus_logo_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_logo_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Clients Logo Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_sub_title', array(
    'section' => 'total_plus_logo_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_logo_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_title_style', array(
    'section' => 'total_plus_logo_section',
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

//CLIENTS LOGOS
$wp_customize->add_setting('total_plus_logo_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_logo_header', array(
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('Clients Logos', 'total-plus')
)));

$wp_customize->add_setting('total_plus_logo', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'image' => '',
            'link' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_logo', array(
    'section' => 'total_plus_logo_section',
    'box_label' => esc_html__('Clients Logo', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Logo', 'total-plus'),
        'default' => ''
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Logo Link', 'total-plus'),
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

$wp_customize->add_setting('total_plus_logo_new_tab', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_new_tab', array(
    'type' => 'checkbox',
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('Open Logo Link in New Tab', 'total-plus')
));

$wp_customize->add_setting('total_plus_logo_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_logo_setting_heading', array(
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_logo_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_logo_style', array(
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('Logo Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/logo-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/logo-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/logo-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/logo-style4.png',
    )
)));

$wp_customize->add_setting('total_plus_logo_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_logo_more_button_heading', array(
    'section' => 'total_plus_logo_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_logo_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_button_text', array(
    'section' => 'total_plus_logo_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_logo_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_logo_button_link', array(
    'section' => 'total_plus_logo_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_title_style', array(
    'selector' => '.ht-logo-section',
    'render_callback' => 'total_plus_logo_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_super_title', array(
    'selector' => '.ht-logo-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_logo_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_title', array(
    'selector' => '.ht-logo-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_logo_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_sub_title', array(
    'selector' => '.ht-logo-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_logo_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_logo', array(
    'selector' => '.ht-logo-content',
    'render_callback' => 'total_plus_logo_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_new_tab', array(
    'selector' => '.ht-logo-content',
    'render_callback' => 'total_plus_logo_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_style', array(
    'selector' => '.ht-logo-content',
    'render_callback' => 'total_plus_logo_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_button_text', array(
    'selector' => '.ht-logo-section',
    'render_callback' => 'total_plus_logo_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_logo_button_link', array(
    'selector' => '.ht-logo-section',
    'render_callback' => 'total_plus_logo_section',
    'container_inclusive' => true
));
