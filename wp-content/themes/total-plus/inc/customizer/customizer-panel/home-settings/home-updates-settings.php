<?php

/* ============UPDATE SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_news_section', array(
    'title' => esc_html__('News & Update Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_news_section'),
    'hiding_control' => 'total_plus_news_section_disable'
)));

//ENABLE/DISABLE SERVICE SECTION
$wp_customize->add_setting('total_plus_news_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_news_section_disable', array(
    'section' => 'total_plus_news_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('total_plus_news_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_news_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_news_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_news_section_heading',
                'total_plus_news_super_title',
                'total_plus_news_title',
                'total_plus_news_sub_title',
                'total_plus_news_title_style',
                'total_plus_news_header',
                'total_plus_news',
                'total_plus_news_setting_heading',
                'total_plus_news_style',
                'total_plus_news_more_button_heading',
                'total_plus_news_button_text',
                'total_plus_news_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_news_cs_heading',
                'total_plus_news_super_title_color',
                'total_plus_news_title_color',
                'total_plus_news_text_color',
                'total_plus_news_link_color',
                'total_plus_news_link_hov_color',
                'total_plus_news_block_seperator',
                'total_plus_news_block_background_color',
                'total_plus_news_block_title_color',
                'total_plus_news_block_text_color',
                'total_plus_news_block_link_color',
                'total_plus_news_mb_seperator',
                'total_plus_news_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_news_enable_fullwindow',
                'total_plus_news_align_item',
                'total_plus_news_fw_seperator',
                'total_plus_news_bg_type',
                'total_plus_news_bg_color',
                'total_plus_news_bg_gradient',
                'total_plus_news_bg_image',
                'total_plus_news_parallax_effect',
                'total_plus_news_bg_video',
                'total_plus_news_overlay_color',
                'total_plus_news_cs_seperator',
                'total_plus_news_padding',
                'total_plus_news_seperator0',
                'total_plus_news_section_seperator',
                'total_plus_news_seperator1',
                'total_plus_news_top_seperator',
                'total_plus_news_ts_color',
                'total_plus_news_ts_height',
                'total_plus_news_seperator2',
                'total_plus_news_bottom_seperator',
                'total_plus_news_bs_color',
                'total_plus_news_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_news_section_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_news_section_heading', array(
    'section' => 'total_plus_news_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_news_super_title', array(
    'section' => 'total_plus_news_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_news_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('News and Update Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_news_title', array(
    'section' => 'total_plus_news_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_news_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('News and Update Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_news_sub_title', array(
    'section' => 'total_plus_news_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_news_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_news_title_style', array(
    'section' => 'total_plus_news_section',
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

//UPDATES PAGES

$wp_customize->add_setting('total_plus_news_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_news_header', array(
    'section' => 'total_plus_news_section',
    'label' => esc_html__('Updates Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'title' => '',
            'content' => '',
            'image' => '',
            'button_text' => '',
            'button_link' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_news', array(
    'section' => 'total_plus_news_section',
    'box_label' => esc_html__('Updates Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
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
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Image', 'total-plus'),
        'default' => ''
    ),
    'button_text' => array(
        'type' => 'text',
        'label' => esc_html__('Button Text', 'total-plus'),
        'default' => ''
    ),
    'button_link' => array(
        'type' => 'text',
        'label' => esc_html__('Button Link', 'total-plus'),
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

$wp_customize->add_setting('total_plus_news_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_news_setting_heading', array(
    'section' => 'total_plus_news_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_news_style', array(
    'section' => 'total_plus_news_section',
    'label' => esc_html__('Updates Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/news-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/news-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/news-style3.png'
    )
)));

$wp_customize->add_setting('total_plus_news_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_news_more_button_heading', array(
    'section' => 'total_plus_news_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_news_button_text', array(
    'section' => 'total_plus_news_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_news_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_news_button_link', array(
    'section' => 'total_plus_news_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_news_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_news_block_seperator", array(
    'section' => 'total_plus_news_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_news_block_background_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_news_block_background_color', array(
    'section' => 'total_plus_news_section',
    'priority' => 56,
    'label' => esc_html__('News Block Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news_block_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_news_block_title_color', array(
    'section' => 'total_plus_news_section',
    'priority' => 56,
    'label' => esc_html__('News Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news_block_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_news_block_text_color', array(
    'section' => 'total_plus_news_section',
    'priority' => 56,
    'label' => esc_html__('News Block Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_news_block_link_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_news_block_link_color', array(
    'section' => 'total_plus_news_section',
    'priority' => 56,
    'label' => esc_html__('News Block Read More Link Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_news_title_style', array(
    'selector' => '.ht-news-section',
    'render_callback' => 'total_plus_news_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_news_super_title', array(
    'selector' => '.ht-news-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_news_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_news_title', array(
    'selector' => '.ht-news-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_news_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_news_sub_title', array(
    'selector' => '.ht-news-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_news_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_news', array(
    'selector' => '.ht-newscontent',
    'render_callback' => 'total_plus_news_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_news_style', array(
    'selector' => '.ht-newscontent',
    'render_callback' => 'total_plus_news_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_news_button_text', array(
    'selector' => '.ht-news-section',
    'render_callback' => 'total_plus_news_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_news_button_link', array(
    'selector' => '.ht-news-section',
    'render_callback' => 'total_plus_news_section',
    'container_inclusive' => true
));
