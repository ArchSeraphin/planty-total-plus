<?php

/* ============PRICING SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_pricing_section', array(
    'title' => esc_html__('Pricing Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_pricing_section'),
    'hiding_control' => 'total_plus_pricing_section_disable'
)));

//ENABLE/DISABLE pricing SECTION
$wp_customize->add_setting('total_plus_pricing_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_pricing_section_disable', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_pricing_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_pricing_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_pricing_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_pricing_title_subtitle_heading',
                'total_plus_pricing_super_title',
                'total_plus_pricing_title',
                'total_plus_pricing_sub_title',
                'total_plus_pricing_title_style',
                'total_plus_pricing_header',
                'total_plus_pricing',
                'total_plus_pricing_setting_heading',
                'total_plus_pricing_style',
                'total_plus_pricing_col',
                'total_plus_pricing_more_button_heading',
                'total_plus_pricing_button_text',
                'total_plus_pricing_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_pricing_cs_heading',
                'total_plus_pricing_super_title_color',
                'total_plus_pricing_title_color',
                'total_plus_pricing_text_color',
                'total_plus_pricing_link_color',
                'total_plus_pricing_link_hov_color',
                'total_plus_pricing_block_seperator',
                'total_plus_pricing_block_highlight_color',
                'total_plus_pricing_block_highlight_text_color',
                'total_plus_pricing_mb_seperator',
                'total_plus_pricing_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_pricing_enable_fullwindow',
                'total_plus_pricing_align_item',
                'total_plus_pricing_fw_seperator',
                'total_plus_pricing_bg_type',
                'total_plus_pricing_bg_color',
                'total_plus_pricing_bg_gradient',
                'total_plus_pricing_bg_image',
                'total_plus_pricing_parallax_effect',
                'total_plus_pricing_bg_video',
                'total_plus_pricing_overlay_color',
                'total_plus_pricing_cs_seperator',
                'total_plus_pricing_padding',
                'total_plus_pricing_seperator0',
                'total_plus_pricing_section_seperator',
                'total_plus_pricing_seperator1',
                'total_plus_pricing_top_seperator',
                'total_plus_pricing_ts_color',
                'total_plus_pricing_ts_height',
                'total_plus_pricing_seperator2',
                'total_plus_pricing_bottom_seperator',
                'total_plus_pricing_bs_color',
                'total_plus_pricing_bs_height'
            ),
        )
    ),
)));

$wp_customize->add_setting('total_plus_pricing_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_pricing_title_subtitle_heading', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_pricing_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_pricing_super_title', array(
    'section' => 'total_plus_pricing_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_pricing_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Pricing Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_pricing_title', array(
    'section' => 'total_plus_pricing_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_pricing_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Pricing Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_pricing_sub_title', array(
    'section' => 'total_plus_pricing_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_pricing_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_pricing_title_style', array(
    'section' => 'total_plus_pricing_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

$wp_customize->add_setting('total_plus_pricing_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_pricing_header', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('Pricing Blocks', 'total-plus')
)));

$wp_customize->add_setting('total_plus_pricing', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'plan' => '',
            'currency' => '',
            'price' => '',
            'price_per' => '',
            'content' => '',
            'button_text' => '',
            'button_link' => '',
            'is_featured' => 'no',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_pricing', array(
    'section' => 'total_plus_pricing_section',
    'box_label' => esc_html__('Pricing Block', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'plan' => array(
        'type' => 'text',
        'label' => esc_html__('Pricing Title', 'total-plus'),
        'default' => ''
    ),
    'currency' => array(
        'type' => 'text',
        'label' => esc_html__('Currency Symbol', 'total-plus'),
        'default' => ''
    ),
    'price' => array(
        'type' => 'text',
        'label' => esc_html__('Price', 'total-plus'),
        'default' => ''
    ),
    'price_per' => array(
        'type' => 'text',
        'label' => esc_html__('Price Per(/month, /year)', 'total-plus'),
        'default' => ''
    ),
    'content' => array(
        'type' => 'textarea',
        'label' => esc_html__('Plan Feature List', 'total-plus'),
        'default' => '',
        'description' => esc_html__('Enter Feature list seperated by Enter', 'total-plus'),
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
    'is_featured' => array(
        'type' => 'checkbox',
        'label' => esc_html__('Is Featured?', 'total-plus'),
        'default' => 'no'
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

$wp_customize->add_setting('total_plus_pricing_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_pricing_setting_heading', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_pricing_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_pricing_style', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('Pricing Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/pricing-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/pricing-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/pricing-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/pricing-style4.png',
    )
)));

$wp_customize->add_setting('total_plus_pricing_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_pricing_col', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('No of Columns', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 4,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_pricing_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_pricing_more_button_heading', array(
    'section' => 'total_plus_pricing_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_pricing_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_pricing_button_text', array(
    'section' => 'total_plus_pricing_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_pricing_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_pricing_button_link', array(
    'section' => 'total_plus_pricing_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_pricing_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_pricing_block_seperator", array(
    'section' => 'total_plus_pricing_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_pricing_block_highlight_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_pricing_block_highlight_color', array(
    'section' => 'total_plus_pricing_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block HighLight Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_pricing_block_highlight_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_pricing_block_highlight_text_color', array(
    'section' => 'total_plus_pricing_section',
    'priority' => 56,
    'label' => esc_html__('Testimonial Block HighLight Text Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_title_style', array(
    'selector' => '.ht-pricing-section',
    'render_callback' => 'total_plus_pricing_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_super_title', array(
    'selector' => '.ht-pricing-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_pricing_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_title', array(
    'selector' => '.ht-pricing-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_pricing_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_sub_title', array(
    'selector' => '.ht-pricing-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_pricing_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing', array(
    'selector' => '.ht-pricing-content',
    'render_callback' => 'total_plus_pricing_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_style', array(
    'selector' => '.ht-pricing-content',
    'render_callback' => 'total_plus_pricing_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_col', array(
    'selector' => '.ht-pricing-content',
    'render_callback' => 'total_plus_pricing_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_button_text', array(
    'selector' => '.ht-pricing-section',
    'render_callback' => 'total_plus_pricing_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_pricing_button_link', array(
    'selector' => '.ht-pricing-section',
    'render_callback' => 'total_plus_pricing_section',
    'container_inclusive' => true
));
