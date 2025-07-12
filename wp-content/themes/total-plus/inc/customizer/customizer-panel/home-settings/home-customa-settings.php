<?php

/* ============CUSTOM SECTION 1============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_customa_section', array(
    'title' => esc_html__('Custom Section A', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_customa_section'),
    'hiding_control' => 'total_plus_customa_section_disable'
)));

//ENABLE/DISABLE CUSTOM SECTION
$wp_customize->add_setting('total_plus_customa_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_customa_section_disable', array(
    'section' => 'total_plus_customa_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('total_plus_customa_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_customa_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_customa_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_customa_title_subtitle_heading',
                'total_plus_customa_super_title',
                'total_plus_customa_title',
                'total_plus_customa_sub_title',
                'total_plus_customa_title_style',
                'total_plus_customa_page_heading',
                'total_plus_customa_page'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_customa_cs_heading',
                'total_plus_customa_super_title_color',
                'total_plus_customa_title_color',
                'total_plus_customa_text_color',
                'total_plus_customa_link_color',
                'total_plus_customa_link_hov_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_customa_enable_fullwindow',
                'total_plus_customa_align_item',
                'total_plus_customa_fw_seperator',
                'total_plus_customa_bg_type',
                'total_plus_customa_bg_color',
                'total_plus_customa_bg_gradient',
                'total_plus_customa_bg_image',
                'total_plus_customa_parallax_effect',
                'total_plus_customa_bg_video',
                'total_plus_customa_overlay_color',
                'total_plus_customa_cs_seperator',
                'total_plus_customa_padding',
                'total_plus_customa_seperator0',
                'total_plus_customa_section_seperator',
                'total_plus_customa_seperator1',
                'total_plus_customa_top_seperator',
                'total_plus_customa_ts_color',
                'total_plus_customa_ts_height',
                'total_plus_customa_seperator2',
                'total_plus_customa_bottom_seperator',
                'total_plus_customa_bs_color',
                'total_plus_customa_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_customa_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_customa_title_subtitle_heading', array(
    'section' => 'total_plus_customa_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_customa_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_customa_super_title', array(
    'section' => 'total_plus_customa_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_customa_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Custom A Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_customa_title', array(
    'section' => 'total_plus_customa_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_customa_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Custom A Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_customa_sub_title', array(
    'section' => 'total_plus_customa_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_customa_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_customa_title_style', array(
    'section' => 'total_plus_customa_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

$wp_customize->add_setting('total_plus_customa_page_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_customa_page_heading', array(
    'section' => 'total_plus_customa_section',
    'label' => esc_html__('Page', 'total-plus')
)));

$wp_customize->add_setting('total_plus_customa_page', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_customa_page', array(
    'section' => 'total_plus_customa_section',
    'type' => 'dropdown-pages',
    'label' => esc_html__('Select a Page', 'total-plus'),
    'description' => esc_html__('Create a custom layout with the selected page using pagebuilder.', 'total-plus')
));


$wp_customize->selective_refresh->add_partial('total_plus_customa_title_style', array(
    'selector' => '.ht-customa-section',
    'render_callback' => 'total_plus_customa_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_customa_super_title', array(
    'selector' => '.ht-customa-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_customa_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_customa_title', array(
    'selector' => '.ht-customa-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_customa_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_customa_sub_title', array(
    'selector' => '.ht-customa-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_customa_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_customa_page', array(
    'selector' => '.ht-customa-content',
    'render_callback' => 'total_plus_customa_content'
));
