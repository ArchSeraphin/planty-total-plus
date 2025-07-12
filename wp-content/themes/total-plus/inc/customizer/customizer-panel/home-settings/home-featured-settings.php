<?php

/* ============FEATURED SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_featured_section', array(
    'title' => esc_html__('Featured Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_featured_section'),
    'hiding_control' => 'total_plus_featured_section_disable'
)));

//ENABLE/DISABLE FEATURED SECTION
$wp_customize->add_setting('total_plus_featured_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_featured_section_disable', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus'),
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('total_plus_featured_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_featured_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_featured_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_featured_title_sub_title_heading',
                'total_plus_featured_super_title',
                'total_plus_featured_title',
                'total_plus_featured_sub_title',
                'total_plus_featured_title_style',
                'total_plus_featured_block_heading',
                'total_plus_featured',
                'total_plus_featured_setting_heading',
                'total_plus_featured_style',
                'total_plus_featured_col',
                'total_plus_featured_more_button_heading',
                'total_plus_featured_button_text',
                'total_plus_featured_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_featured_cs_heading',
                'total_plus_featured_super_title_color',
                'total_plus_featured_title_color',
                'total_plus_featured_text_color',
                'total_plus_featured_link_color',
                'total_plus_featured_link_hov_color',
                'total_plus_featured_mb_seperator',
                'total_plus_featured_mb_color_group',
                'total_plus_featured_block_seperator',
                'total_plus_featured_block_background_color',
                'total_plus_featured_block_border_color',
                'total_plus_featured_block_icon_color',
                'total_plus_featured_block_icon_bg_color',
                'total_plus_featured_block_title_color',
                'total_plus_featured_block_text_color',
                'total_plus_featured_block_readmore_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_featured_enable_fullwindow',
                'total_plus_featured_align_item',
                'total_plus_featured_fw_seperator',
                'total_plus_featured_bg_type',
                'total_plus_featured_bg_color',
                'total_plus_featured_bg_gradient',
                'total_plus_featured_bg_image',
                'total_plus_featured_parallax_effect',
                'total_plus_featured_bg_video',
                'total_plus_featured_overlay_color',
                'total_plus_featured_cs_seperator',
                'total_plus_featured_padding',
                'total_plus_featured_seperator0',
                'total_plus_featured_section_seperator',
                'total_plus_featured_seperator1',
                'total_plus_featured_top_seperator',
                'total_plus_featured_ts_color',
                'total_plus_featured_ts_height',
                'total_plus_featured_seperator2',
                'total_plus_featured_bottom_seperator',
                'total_plus_featured_bs_color',
                'total_plus_featured_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_featured_title_sub_title_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_featured_title_sub_title_heading', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_featured_super_title', array(
    'section' => 'total_plus_featured_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_featured_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Featured Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_featured_title', array(
    'section' => 'total_plus_featured_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_featured_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Featured Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_featured_sub_title', array(
    'section' => 'total_plus_featured_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_featured_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_featured_title_style', array(
    'section' => 'total_plus_featured_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

//FEATURED BLOCK

$wp_customize->add_setting('total_plus_featured_block_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_featured_block_heading', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('Featured Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured', array(
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

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_featured', array(
    //'label'   => esc_html__('Highlight Page','total-plus'),
    'section' => 'total_plus_featured_section',
    'box_label' => esc_html__('Featured Block', 'total-plus'),
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

$wp_customize->add_setting('total_plus_featured_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_featured_setting_heading', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_featured_style', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('Featured Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/featured-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/featured-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/featured-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/featured-style4.png',
        'style5' => $imagepath . '/inc/customizer/images/featured-style5.png',
        'style6' => $imagepath . '/inc/customizer/images/featured-style6.png',
        'style7' => $imagepath . '/inc/customizer/images/featured-style7.png',
    )
)));

$wp_customize->add_setting('total_plus_featured_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_featured_col', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('No of Columns', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 6,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_featured_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_featured_more_button_heading', array(
    'section' => 'total_plus_featured_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_featured_button_text', array(
    'section' => 'total_plus_featured_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_featured_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_featured_button_link', array(
    'section' => 'total_plus_featured_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_featured_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_featured_block_seperator", array(
    'section' => 'total_plus_featured_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_featured_block_background_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_background_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_block_border_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_border_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Border Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_block_icon_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_icon_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Icon Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_block_icon_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_icon_bg_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Icon Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_block_title_color', array(
    'default' => '#111111',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_title_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_block_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_text_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_featured_block_readmore_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_featured_block_readmore_color', array(
    'section' => 'total_plus_featured_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Read More Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_featured_title_style', array(
    'selector' => '.ht-featured-section',
    'render_callback' => 'total_plus_featured_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_super_title', array(
    'selector' => '.ht-featured-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_featured_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_title', array(
    'selector' => '.ht-featured-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_featured_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_sub_title', array(
    'selector' => '.ht-featured-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_featured_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_featured', array(
    'selector' => '.ht-featured-content',
    'render_callback' => 'total_plus_featured_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_style', array(
    'selector' => '.ht-featured-content',
    'render_callback' => 'total_plus_featured_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_col', array(
    'selector' => '.ht-featured-content',
    'render_callback' => 'total_plus_featured_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_button_text', array(
    'selector' => '.ht-featured-section',
    'render_callback' => 'total_plus_featured_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_featured_button_link', array(
    'selector' => '.ht-featured-section',
    'render_callback' => 'total_plus_featured_section',
    'container_inclusive' => true
));
