<?php

/* ============COUNTER SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_counter_section', array(
    'title' => esc_html__('Counter Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_counter_section'),
    'hiding_control' => 'total_plus_counter_section_disable'
)));

//ENABLE/DISABLE COUNTER SECTION
$wp_customize->add_setting('total_plus_counter_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_counter_section_disable', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_counter_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_counter_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_counter_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_counter_title_subtitle_heading',
                'total_plus_counter_super_title',
                'total_plus_counter_title',
                'total_plus_counter_sub_title',
                'total_plus_counter_title_style',
                'total_plus_counter_heading',
                'total_plus_counter',
                'total_plus_counter_setting_heading',
                'total_plus_counter_style',
                'total_plus_counter_col',
                'total_plus_counter_more_button_heading',
                'total_plus_counter_button_text',
                'total_plus_counter_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_counter_cs_heading',
                'total_plus_counter_super_title_color',
                'total_plus_counter_title_color',
                'total_plus_counter_text_color',
                'total_plus_counter_link_color',
                'total_plus_counter_link_hov_color',
                'total_plus_counter_block_seperator',
                'total_plus_counter_block_background_color',
                'total_plus_counter_block_border_color',
                'total_plus_counter_block_icon_color',
                'total_plus_counter_block_title_color',
                'total_plus_counter_block_number_color',
                'total_plus_counter_mb_seperator',
                'total_plus_counter_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_counter_enable_fullwindow',
                'total_plus_counter_align_item',
                'total_plus_counter_fw_seperator',
                'total_plus_counter_bg_type',
                'total_plus_counter_bg_color',
                'total_plus_counter_bg_gradient',
                'total_plus_counter_bg_image',
                'total_plus_counter_parallax_effect',
                'total_plus_counter_bg_video',
                'total_plus_counter_overlay_color',
                'total_plus_counter_cs_seperator',
                'total_plus_counter_padding',
                'total_plus_counter_seperator0',
                'total_plus_counter_section_seperator',
                'total_plus_counter_seperator1',
                'total_plus_counter_top_seperator',
                'total_plus_counter_ts_color',
                'total_plus_counter_ts_height',
                'total_plus_counter_seperator2',
                'total_plus_counter_bottom_seperator',
                'total_plus_counter_bs_color',
                'total_plus_counter_bs_height'
            ),
        )
    ),
)));

$wp_customize->add_setting('total_plus_counter_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));



$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_counter_title_subtitle_heading', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_counter_super_title', array(
    'section' => 'total_plus_counter_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_counter_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Counter Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_counter_title', array(
    'section' => 'total_plus_counter_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_counter_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Counter Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_counter_sub_title', array(
    'section' => 'total_plus_counter_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_counter_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_counter_title_style', array(
    'section' => 'total_plus_counter_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

$wp_customize->add_setting('total_plus_counter_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_counter_heading', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('Counters', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'title' => '',
            'value' => '',
            'icon' => 'icofont-angry-monster',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_counter', array(
    'section' => 'total_plus_counter_section',
    'box_label' => esc_html__('Counter Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'total-plus'),
        'default' => ''
    ),
    'value' => array(
        'type' => 'text',
        'label' => esc_html__('Counter Value', 'total-plus'),
        'default' => ''
    ),
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Icon', 'total-plus'),
        'default' => 'icofont-angry-monster'
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

$wp_customize->add_setting('total_plus_counter_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_counter_setting_heading', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_counter_style', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('Counter Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/counter-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/counter-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/counter-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/counter-style4.png'
    )
)));

$wp_customize->add_setting('total_plus_counter_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_counter_col', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('No of Columns', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 6,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_counter_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_counter_more_button_heading', array(
    'section' => 'total_plus_counter_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_counter_button_text', array(
    'section' => 'total_plus_counter_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_counter_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_counter_button_link', array(
    'section' => 'total_plus_counter_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_counter_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_counter_block_seperator", array(
    'section' => 'total_plus_counter_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_counter_block_background_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_counter_block_background_color', array(
    'section' => 'total_plus_counter_section',
    'priority' => 56,
    'label' => esc_html__('Counter Block Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_block_border_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_counter_block_border_color', array(
    'section' => 'total_plus_counter_section',
    'priority' => 56,
    'label' => esc_html__('Counter Block Border Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_block_icon_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_counter_block_icon_color', array(
    'section' => 'total_plus_counter_section',
    'priority' => 56,
    'label' => esc_html__('Counter Block Icon Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_block_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_counter_block_title_color', array(
    'section' => 'total_plus_counter_section',
    'priority' => 56,
    'label' => esc_html__('Counter Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_counter_block_number_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_counter_block_number_color', array(
    'section' => 'total_plus_counter_section',
    'priority' => 56,
    'label' => esc_html__('Counter Block Number Color', 'total-plus')
)));


$wp_customize->selective_refresh->add_partial('total_plus_counter_title_style', array(
    'selector' => '.ht-counter-section',
    'render_callback' => 'total_plus_counter_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_super_title', array(
    'selector' => '.ht-counter-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_counter_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_title', array(
    'selector' => '.ht-counter-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_counter_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_sub_title', array(
    'selector' => '.ht-counter-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_counter_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_counter', array(
    'selector' => '.ht-counter-content',
    'render_callback' => 'total_plus_counter_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_style', array(
    'selector' => '.ht-counter-content',
    'render_callback' => 'total_plus_counter_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_col', array(
    'selector' => '.ht-counter-content',
    'render_callback' => 'total_plus_counter_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_button_text', array(
    'selector' => '.ht-counter-section',
    'render_callback' => 'total_plus_counter_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_counter_button_link', array(
    'selector' => '.ht-counter-section',
    'render_callback' => 'total_plus_counter_section',
    'container_inclusive' => true
));

