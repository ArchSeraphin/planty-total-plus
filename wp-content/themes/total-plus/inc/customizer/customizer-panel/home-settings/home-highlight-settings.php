<?php

/* ============HIGHLIGHT SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_highlight_section', array(
    'title' => esc_html__('Highlight Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_highlight_section'),
    'hiding_control' => 'total_plus_highlight_section_disable'
)));

//ENABLE/DISABLE FEATURED SECTION
$wp_customize->add_setting('total_plus_highlight_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_highlight_section_disable', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_highlight_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_highlight_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_highlight_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_highlight_title_sub_title_heading',
                'total_plus_highlight_super_title',
                'total_plus_highlight_title',
                'total_plus_highlight_sub_title',
                'total_plus_highlight_title_style',
                'total_plus_highlight_block_heading',
                'total_plus_highlight',
                'total_plus_highlight_setting_heading',
                'total_plus_highlight_style',
                'total_plus_highlight_col',
                'total_plus_highlight_more_button_heading',
                'total_plus_highlight_button_text',
                'total_plus_highlight_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_highlight_cs_heading',
                'total_plus_highlight_super_title_color',
                'total_plus_highlight_title_color',
                'total_plus_highlight_text_color',
                'total_plus_highlight_link_color',
                'total_plus_highlight_link_hov_color',
                'total_plus_highlight_block_seperator',
                'total_plus_highlight_block_highlight_color',
                'total_plus_highlight_block_icon_color',
                'total_plus_highlight_block_title_color',
                'total_plus_highlight_block_excerpt_color',
                'total_plus_highlight_block_readmore_color',
                'total_plus_highlight_mb_seperator',
                'total_plus_highlight_mb_color_group',
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_highlight_enable_fullwindow',
                'total_plus_highlight_align_item',
                'total_plus_highlight_fw_seperator',
                'total_plus_highlight_bg_type',
                'total_plus_highlight_bg_color',
                'total_plus_highlight_bg_gradient',
                'total_plus_highlight_bg_image',
                'total_plus_highlight_parallax_effect',
                'total_plus_highlight_bg_video',
                'total_plus_highlight_overlay_color',
                'total_plus_highlight_cs_seperator',
                'total_plus_highlight_padding',
                'total_plus_highlight_seperator0',
                'total_plus_highlight_section_seperator',
                'total_plus_highlight_seperator1',
                'total_plus_highlight_top_seperator',
                'total_plus_highlight_ts_color',
                'total_plus_highlight_ts_height',
                'total_plus_highlight_seperator2',
                'total_plus_highlight_bottom_seperator',
                'total_plus_highlight_bs_color',
                'total_plus_highlight_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_highlight_title_sub_title_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_highlight_title_sub_title_heading', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_highlight_super_title', array(
    'section' => 'total_plus_highlight_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_highlight_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Highlight Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_highlight_title', array(
    'section' => 'total_plus_highlight_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_highlight_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Highlight Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_highlight_sub_title', array(
    'section' => 'total_plus_highlight_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_highlight_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_highlight_title_style', array(
    'section' => 'total_plus_highlight_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

//HIGHLIGHT BLOCK

$wp_customize->add_setting('total_plus_highlight_block_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_highlight_block_heading', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('Highlight Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => 'icofont-angry-monster',
            'image' => '',
            'title' => '',
            'content' => '',
            'link_text' => '',
            'link' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_highlight', array(
    'section' => 'total_plus_highlight_section',
    'box_label' => esc_html__('Highlight Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'total-plus'),
        'default' => 'icofont-angry-monster'
    ),
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Image', 'total-plus'),
        'default' => ''
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

$wp_customize->add_setting('total_plus_highlight_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_highlight_setting_heading', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_highlight_style', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('Highlight Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/highlight-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/highlight-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/highlight-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/highlight-style4.png'
    )
)));

$wp_customize->add_setting('total_plus_highlight_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_highlight_col', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('No of Columns', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 4,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_highlight_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_highlight_more_button_heading', array(
    'section' => 'total_plus_highlight_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_highlight_button_text', array(
    'section' => 'total_plus_highlight_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_highlight_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_highlight_button_link', array(
    'section' => 'total_plus_highlight_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_highlight_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_highlight_block_seperator", array(
    'section' => 'total_plus_highlight_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_highlight_block_highlight_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_highlight_block_highlight_color', array(
    'section' => 'total_plus_highlight_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Highlight Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_block_icon_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_highlight_block_icon_color', array(
    'section' => 'total_plus_highlight_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Icon Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_block_title_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_highlight_block_title_color', array(
    'section' => 'total_plus_highlight_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_block_excerpt_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_highlight_block_excerpt_color', array(
    'section' => 'total_plus_highlight_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Excerpt Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_highlight_block_readmore_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_highlight_block_readmore_color', array(
    'section' => 'total_plus_highlight_section',
    'priority' => 56,
    'label' => esc_html__('Featured Block Read More Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_title_style', array(
    'selector' => '.ht-highlight-section',
    'render_callback' => 'total_plus_highlight_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_super_title', array(
    'selector' => '.ht-highlight-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_highlight_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_title', array(
    'selector' => '.ht-highlight-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_highlight_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_sub_title', array(
    'selector' => '.ht-highlight-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_highlight_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight', array(
    'selector' => '.ht-highlight-content',
    'render_callback' => 'total_plus_highlight_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_style', array(
    'selector' => '.ht-highlight-content',
    'render_callback' => 'total_plus_highlight_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_col', array(
    'selector' => '.ht-highlight-content',
    'render_callback' => 'total_plus_highlight_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_button_text', array(
    'selector' => '.ht-highlight-section',
    'render_callback' => 'total_plus_highlight_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_highlight_button_link', array(
    'selector' => '.ht-highlight-section',
    'render_callback' => 'total_plus_highlight_section',
    'container_inclusive' => true
));
