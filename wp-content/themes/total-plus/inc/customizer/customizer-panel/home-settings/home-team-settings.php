<?php

/* ============TEAM SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_team_section', array(
    'title' => esc_html__('Team Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_team_section'),
    'hiding_control' => 'total_plus_team_section_disable'
)));

//ENABLE/DISABLE TEAM SECTION
$wp_customize->add_setting('total_plus_team_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_team_section_disable', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('total_plus_team_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_team_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_team_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_team_title_subtitle_heading',
                'total_plus_team_super_title',
                'total_plus_team_title',
                'total_plus_team_sub_title',
                'total_plus_team_title_style',
                'total_plus_team_header',
                'total_plus_team',
                'total_plus_team_setting_heading',
                'total_plus_team_style',
                'total_plus_team_col',
                'total_plus_team_slider_enable',
                'total_plus_team_more_button_heading',
                'total_plus_team_button_text',
                'total_plus_team_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_team_cs_heading',
                'total_plus_team_super_title_color',
                'total_plus_team_title_color',
                'total_plus_team_text_color',
                'total_plus_team_link_color',
                'total_plus_team_link_hov_color',
                'total_plus_team_block_seperator',
                'total_plus_team_block_overlay_color',
                'total_plus_team_block_background_color',
                'total_plus_team_block_title_color',
                'total_plus_team_block_designation_color',
                'total_plus_team_block_excerpt_color',
                'total_plus_team_block_social_icon_color',
                'total_plus_team_block_detail_link_color',
                'total_plus_team_block_arrow_color_group',
                'total_plus_team_mb_seperator',
                'total_plus_team_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_team_enable_fullwindow',
                'total_plus_team_align_item',
                'total_plus_team_fw_seperator',
                'total_plus_team_bg_type',
                'total_plus_team_bg_color',
                'total_plus_team_bg_gradient',
                'total_plus_team_bg_image',
                'total_plus_team_parallax_effect',
                'total_plus_team_bg_video',
                'total_plus_team_overlay_color',
                'total_plus_team_cs_seperator',
                'total_plus_team_padding',
                'total_plus_team_seperator0',
                'total_plus_team_section_seperator',
                'total_plus_team_seperator1',
                'total_plus_team_top_seperator',
                'total_plus_team_ts_color',
                'total_plus_team_ts_height',
                'total_plus_team_seperator2',
                'total_plus_team_bottom_seperator',
                'total_plus_team_bs_color',
                'total_plus_team_bs_height'
            ),
        )
    ),
)));

$wp_customize->add_setting('total_plus_team_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_team_title_subtitle_heading', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_team_super_title', array(
    'section' => 'total_plus_team_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_team_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Team Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_team_title', array(
    'section' => 'total_plus_team_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_team_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Team Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_team_sub_title', array(
    'section' => 'total_plus_team_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_team_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_team_title_style', array(
    'section' => 'total_plus_team_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

$wp_customize->add_setting('total_plus_team_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_team_header', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('Team Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'image' => '',
            'name' => '',
            'designation' => '',
            'content' => '',
            'facebook_link' => '',
            'twitter_link' => '',
            'instagram_link' => '',
            'link' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_team', array(
    'section' => 'total_plus_team_section',
    'box_label' => esc_html__('Team Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Image', 'total-plus'),
        'default' => ''
    ),
    'name' => array(
        'type' => 'text',
        'label' => esc_html__('Name', 'total-plus'),
        'default' => ''
    ),
    'designation' => array(
        'type' => 'text',
        'label' => esc_html__('Designation', 'total-plus'),
        'default' => ''
    ),
    'content' => array(
        'type' => 'textarea',
        'label' => esc_html__('Short Detail', 'total-plus'),
        'default' => ''
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Detail Page Link', 'total-plus'),
        'default' => ''
    ),
    'facebook_link' => array(
        'type' => 'text',
        'label' => esc_html__('Facebook Url', 'total-plus'),
        'default' => ''
    ),
    'twitter_link' => array(
        'type' => 'text',
        'label' => esc_html__('Twitter Url', 'total-plus'),
        'default' => ''
    ),
    'instagram_link' => array(
        'type' => 'text',
        'label' => esc_html__('Instagram Url', 'total-plus'),
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

$wp_customize->add_setting('total_plus_team_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_team_setting_heading', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_team_style', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('Team Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/team-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/team-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/team-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/team-style4.png',
        'style5' => $imagepath . '/inc/customizer/images/team-style5.png',
        'style6' => $imagepath . '/inc/customizer/images/team-style6.png',
    )
)));

$wp_customize->add_setting('total_plus_team_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_team_col', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('No of Columns', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 4,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_team_slider_enable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_team_slider_enable', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('Enable Carousel Slider', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_team_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_team_more_button_heading', array(
    'section' => 'total_plus_team_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_team_button_text', array(
    'section' => 'total_plus_team_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_team_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_team_button_link', array(
    'section' => 'total_plus_team_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_team_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_team_block_seperator", array(
    'section' => 'total_plus_team_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_team_block_overlay_color', array(
    'default' => 'rgba(255,193,7,0.9)',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_team_block_overlay_color', array(
    'label' => esc_html__('Team Block Overlay Color', 'total-plus'),
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        'rgba( 255, 255, 255, 0.2 )',
        'rgba( 0, 0, 0, 0.2 )'
    )
)));

$wp_customize->add_setting('total_plus_team_block_background_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_team_block_background_color', array(
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'label' => esc_html__('Team Block Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_block_title_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_team_block_title_color', array(
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'label' => esc_html__('Team Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_block_designation_color', array(
    'default' => '#444444',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_team_block_designation_color', array(
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'label' => esc_html__('Team Block Designation Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_block_excerpt_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_team_block_excerpt_color', array(
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'label' => esc_html__('Team Block Excerpt Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_block_social_icon_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_team_block_social_icon_color', array(
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'label' => esc_html__('Team Block Social Icon Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_block_detail_link_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_team_block_detail_link_color', array(
    'section' => 'total_plus_team_section',
    'priority' => 56,
    'label' => esc_html__('Team Block Detail link Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_team_block_arrow_bg_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_team_block_arrow_color', array(
    'default' => '#222222',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_team_block_arrow_bg_color_hover', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_team_block_arrow_color_hover', array(
    'default' => '#222222',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Color_Tab_Control($wp_customize, 'total_plus_team_block_arrow_color_group', array(
    'label' => esc_html__('Team Carousel Navigation Colors', 'total-plus'),
    'section' => 'total_plus_team_section',
    'show_opacity' => false,
    'priority' => 56,
    'settings' => array(
        'normal_total_plus_team_block_arrow_bg_color' => 'total_plus_team_block_arrow_bg_color',
        'normal_total_plus_team_block_arrow_color' => 'total_plus_team_block_arrow_color',
        'hover_total_plus_team_block_arrow_bg_color_hover' => 'total_plus_team_block_arrow_bg_color_hover',
        'hover_total_plus_team_block_arrow_color_hover' => 'total_plus_team_block_arrow_color_hover',
    ),
    'group' => array(
        'normal_total_plus_team_block_arrow_bg_color' => esc_html__('Arrow Background Color', 'total-plus'),
        'normal_total_plus_team_block_arrow_color' => esc_html__('Arrow Color', 'total-plus'),
        'hover_total_plus_team_block_arrow_bg_color_hover' => esc_html__('Arrow Background Color', 'total-plus'),
        'hover_total_plus_team_block_arrow_color_hover' => esc_html__('Arrow Color', 'total-plus')
    )
)));

$wp_customize->selective_refresh->add_partial('total_plus_team_title_style', array(
    'selector' => '.ht-team-section',
    'render_callback' => 'total_plus_team_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_team_super_title', array(
    'selector' => '.ht-team-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_team_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_team_title', array(
    'selector' => '.ht-team-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_team_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_team_sub_title', array(
    'selector' => '.ht-team-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_team_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_team', array(
    'selector' => '.ht-team-content',
    'render_callback' => 'total_plus_team_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_team_style', array(
    'selector' => '.ht-team-content',
    'render_callback' => 'total_plus_team_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_team_col', array(
    'selector' => '.ht-team-content',
    'render_callback' => 'total_plus_team_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_team_slider_enable', array(
    'selector' => '.ht-team-content',
    'render_callback' => 'total_plus_team_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_team_button_text', array(
    'selector' => '.ht-team-section',
    'render_callback' => 'total_plus_team_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_team_button_link', array(
    'selector' => '.ht-team-section',
    'render_callback' => 'total_plus_team_section',
    'container_inclusive' => true
));

