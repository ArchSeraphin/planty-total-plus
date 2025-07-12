<?php

/* ============TESTIMONIAL PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_testimonial_section', array(
    'title' => esc_html__('Testimonial Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_testimonial_section'),
    'hiding_control' => 'total_plus_testimonial_section_disable'
)));

//ENABLE/DISABLE TESTIMONIAL SECTION
$wp_customize->add_setting('total_plus_testimonial_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_testimonial_section_disable', array(
    'section' => 'total_plus_testimonial_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_testimonial_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_testimonial_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_testimonial_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_testimonial_title_subtitle_heading',
                'total_plus_testimonial_super_title',
                'total_plus_testimonial_title',
                'total_plus_testimonial_sub_title',
                'total_plus_testimonial_title_style',
                'total_plus_testimonial_header',
                'total_plus_testimonial',
                'total_plus_testimonial_setting_heading',
                'total_plus_testimonial_style',
                'total_plus_testimonial_more_button_heading',
                'total_plus_testimonial_button_text',
                'total_plus_testimonial_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_testimonial_cs_heading',
                'total_plus_testimonial_super_title_color',
                'total_plus_testimonial_title_color',
                'total_plus_testimonial_text_color',
                'total_plus_testimonial_link_color',
                'total_plus_testimonial_link_hov_color',
                'total_plus_testimonial_block_seperator',
                'total_plus_testimonial_block_background_color',
                'total_plus_testimonial_block_name_color',
                'total_plus_testimonial_block_designation_color',
                'total_plus_testimonial_block_text_color',
                'total_plus_testimonial_block_dot_color',
                'total_plus_testimonial_mb_seperator',
                'total_plus_testimonial_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_testimonial_enable_fullwindow',
                'total_plus_testimonial_align_item',
                'total_plus_testimonial_fw_seperator',
                'total_plus_testimonial_bg_type',
                'total_plus_testimonial_bg_color',
                'total_plus_testimonial_bg_gradient',
                'total_plus_testimonial_bg_image',
                'total_plus_testimonial_parallax_effect',
                'total_plus_testimonial_bg_video',
                'total_plus_testimonial_overlay_color',
                'total_plus_testimonial_cs_seperator',
                'total_plus_testimonial_padding',
                'total_plus_testimonial_seperator0',
                'total_plus_testimonial_section_seperator',
                'total_plus_testimonial_seperator1',
                'total_plus_testimonial_top_seperator',
                'total_plus_testimonial_ts_color',
                'total_plus_testimonial_ts_height',
                'total_plus_testimonial_seperator2',
                'total_plus_testimonial_bottom_seperator',
                'total_plus_testimonial_bs_color',
                'total_plus_testimonial_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_testimonial_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_testimonial_title_subtitle_heading', array(
    'section' => 'total_plus_testimonial_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_testimonial_super_title', array(
    'section' => 'total_plus_testimonial_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_testimonial_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Testimonial Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_testimonial_title', array(
    'section' => 'total_plus_testimonial_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_testimonial_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Testimonial Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_testimonial_sub_title', array(
    'section' => 'total_plus_testimonial_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_testimonial_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_testimonial_title_style', array(
    'section' => 'total_plus_testimonial_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

//TESTIMONIAL PAGES
$wp_customize->add_setting('total_plus_testimonial_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_testimonial_header', array(
    'section' => 'total_plus_testimonial_section',
    'label' => esc_html__('Testimonial', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'image' => '',
            'name' => '',
            'designation' => '',
            'content' => '',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_testimonial', array(
    'section' => 'total_plus_testimonial_section',
    'box_label' => esc_html__('Testimonial Block', 'total-plus'),
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

$wp_customize->add_setting('total_plus_testimonial_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_testimonial_setting_heading', array(
    'section' => 'total_plus_testimonial_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_testimonial_style', array(
    'section' => 'total_plus_testimonial_section',
    'label' => esc_html__('Testimonial Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/testimonial-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/testimonial-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/testimonial-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/testimonial-style4.png',
    )
)));

$wp_customize->add_setting('total_plus_testimonial_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_testimonial_more_button_heading', array(
    'section' => 'total_plus_testimonial_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_testimonial_button_text', array(
    'section' => 'total_plus_testimonial_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_testimonial_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_testimonial_button_link', array(
    'section' => 'total_plus_testimonial_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_testimonial_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_testimonial_block_seperator", array(
    'section' => 'total_plus_testimonial_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_testimonial_block_background_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_testimonial_block_background_color', array(
    'section' => 'total_plus_testimonial_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_block_name_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_testimonial_block_name_color', array(
    'section' => 'total_plus_testimonial_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block Name Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_block_designation_color', array(
    'default' => '#444444',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_testimonial_block_designation_color', array(
    'section' => 'total_plus_testimonial_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block Designation Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_block_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_testimonial_block_text_color', array(
    'section' => 'total_plus_testimonial_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_testimonial_block_dot_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_testimonial_block_dot_color', array(
    'section' => 'total_plus_testimonial_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block Dots/Arrow Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_title_style', array(
    'selector' => '.ht-testimonial-section',
    'render_callback' => 'total_plus_testimonial_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_super_title', array(
    'selector' => '.ht-testimonial-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_testimonial_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_title', array(
    'selector' => '.ht-testimonial-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_testimonial_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_sub_title', array(
    'selector' => '.ht-testimonial-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_testimonial_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial', array(
    'selector' => '.ht-testimonial-content',
    'render_callback' => 'total_plus_testimonial_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_style', array(
    'selector' => '.ht-testimonial-content',
    'render_callback' => 'total_plus_testimonial_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_button_text', array(
    'selector' => '.ht-testimonial-section',
    'render_callback' => 'total_plus_testimonial_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_testimonial_button_link', array(
    'selector' => '.ht-testimonial-section',
    'render_callback' => 'total_plus_testimonial_section',
    'container_inclusive' => true
));
