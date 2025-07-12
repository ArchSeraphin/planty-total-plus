<?php

/* ============PORTFOLIO SECTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_portfolio_section', array(
    'title' => esc_html__('Portfolio Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_portfolio_section'),
    'hiding_control' => 'total_plus_portfolio_section_disable'
)));

//ENABLE/DISABLE PORTFOLIO
$wp_customize->add_setting('total_plus_portfolio_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_portfolio_section_disable', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_portfolio_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_portfolio_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_portfolio_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_portfolio_title_sec_heading',
                'total_plus_portfolio_super_title',
                'total_plus_portfolio_title',
                'total_plus_portfolio_sub_title',
                'total_plus_portfolio_title_style',
                'total_plus_portfolio_cat_heading',
                'total_plus_portfolio_cat',
                'total_plus_portfolio_show_all',
                'total_plus_portfolio_active_cat',           
                'total_plus_portfolio_setting_heading',
                'total_plus_portfolio_cat_menu',
                'total_plus_portfolio_tab_style',
                'total_plus_portfolio_style',
                'total_plus_portfolio_orderby',
                'total_plus_portfolio_order',
                'total_plus_portfolio_full_width',
                'total_plus_portfolio_gap',
                'total_plus_portfolio_zoom',
                'total_plus_portfolio_link',
                'total_plus_portfolio_more_button_heading',
                'total_plus_portfolio_button_text',
                'total_plus_portfolio_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_portfolio_cs_heading',
                'total_plus_portfolio_super_title_color',
                'total_plus_portfolio_title_color',
                'total_plus_portfolio_text_color',
                'total_plus_portfolio_link_color',
                'total_plus_portfolio_link_hov_color',
                'total_plus_portfolio_block_seperator',
                'total_plus_portfolio_block_tab_text_color',
                'total_plus_portfolio_block_active_tab_text_color',
                'total_plus_portfolio_block_tab_background_color',
                'total_plus_portfolio_block_image_hov_background_color',
                'total_plus_portfolio_block_title_color', 
                'total_plus_portfolio_block_button_bg_color',
                'total_plus_portfolio_block_button_color',
                'total_plus_portfolio_mb_seperator',
                'total_plus_portfolio_mb_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_portfolio_enable_fullwindow',
                'total_plus_portfolio_align_item',
                'total_plus_portfolio_fw_seperator',
                'total_plus_portfolio_bg_type',
                'total_plus_portfolio_bg_color',
                'total_plus_portfolio_bg_gradient',
                'total_plus_portfolio_bg_image',
                'total_plus_portfolio_parallax_effect',
                'total_plus_portfolio_bg_video',
                'total_plus_portfolio_overlay_color',
                'total_plus_portfolio_cs_seperator',
                'total_plus_portfolio_padding',
                'total_plus_portfolio_seperator0',
                'total_plus_portfolio_section_seperator',
                'total_plus_portfolio_seperator1',
                'total_plus_portfolio_top_seperator',
                'total_plus_portfolio_ts_color',
                'total_plus_portfolio_ts_height',
                'total_plus_portfolio_seperator2',
                'total_plus_portfolio_bottom_seperator',
                'total_plus_portfolio_bs_color',
                'total_plus_portfolio_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_portfolio_title_sec_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_portfolio_title_sec_heading', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_super_title', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_portfolio_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Portfolio Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_title', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_portfolio_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Portfolio Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_sub_title', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_portfolio_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_title_style', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => array(
        'ht-section-title-top-center' => esc_html__('Top Center Aligned', 'total-plus'),
        'ht-section-title-top-cs' => esc_html__('Top Center Aligned with Seperator', 'total-plus'),
        'ht-section-title-top-left' => esc_html__('Top Left Aligned', 'total-plus'),
        'ht-section-title-top-ls' => esc_html__('Top Left Aligned with Seperator', 'total-plus'),
        'ht-section-title-single-row' => esc_html__('Top Single Row', 'total-plus'),
        'ht-section-title-big' => esc_html__('Top Center Aligned with Big Super Title', 'total-plus')
    )
));

//PORTFOLIO CHOICES
$wp_customize->add_setting('total_plus_portfolio_cat_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_portfolio_cat_heading', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Portfolio Category', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_cat', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Customize_Checkbox_Multiple($wp_customize, 'total_plus_portfolio_cat', array(
    'label' => esc_html__('Select Category', 'total-plus'),
    'section' => 'total_plus_portfolio_section',
    'choices' => $total_plus_portfolio_cat
)));

$wp_customize->add_setting('total_plus_portfolio_show_all', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_portfolio_show_all', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('All', 'total-plus')
)));

$total_plus_portfolio_cat['*'] = esc_html__('All', 'total-plus');

$wp_customize->add_setting('total_plus_portfolio_active_cat', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => '*',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_active_cat', array(
    'type' => 'select',
    'label' => esc_html__('Active Category', 'total-plus'),
    'section' => 'total_plus_portfolio_section',
    'choices' => $total_plus_portfolio_cat
));

$wp_customize->add_setting('total_plus_portfolio_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_portfolio_setting_heading', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_cat_menu', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_portfolio_cat_menu', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Show Tab', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_tab_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_portfolio_tab_style', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Portfolio Tab Style', 'total-plus'),
    'class' => 'ht-full-width',
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/portfolio-tab-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/portfolio-tab-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/portfolio-tab-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/portfolio-tab-style4.png',
    )
)));

$wp_customize->add_setting('total_plus_portfolio_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_portfolio_style', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Portfolio Masonary Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/portfolio-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/portfolio-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/portfolio-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/portfolio-style4.png',
        'style5' => $imagepath . '/inc/customizer/images/portfolio-style5.png',
        'style6' => $imagepath . '/inc/customizer/images/portfolio-style6.png',
    )
)));

$wp_customize->add_setting('total_plus_portfolio_orderby', array(
    'default' => 'date',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_orderby', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'select',
    'label' => esc_html__('Portfolio Order By', 'total-plus'),
    'choices' => array(
        'title' => esc_html__('Post Title', 'total-plus'),
        'date' => esc_html__('Posted Dated', 'total-plus'),
        'rand' => esc_html__('Random', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_portfolio_order', array(
    'default' => 'DESC',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_order', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'select',
    'label' => esc_html__('Portfolio Order', 'total-plus'),
    'choices' => array(
        'ASC' => esc_html__('Ascending Order', 'total-plus'),
        'DESC' => esc_html__('Descending Order', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_portfolio_full_width', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_portfolio_full_width', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Full Width', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_gap', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_portfolio_gap', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Portfolio Gap', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_zoom', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_portfolio_zoom', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Show Zoom Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_link', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_portfolio_link', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('Show Link Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_portfolio_more_button_heading', array(
    'section' => 'total_plus_portfolio_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_button_text', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_portfolio_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_portfolio_button_link', array(
    'section' => 'total_plus_portfolio_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_portfolio_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_portfolio_block_seperator", array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_portfolio_block_tab_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_tab_text_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Tab Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_active_tab_text_color', array(
    'default' => '#111111',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_active_tab_text_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Active Tab Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_active_tab_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_tab_background_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Active Tab Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_tab_background_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_tab_background_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Tab Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_image_hov_background_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_image_hov_background_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Image Hover Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_title_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_title_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_button_bg_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_button_bg_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Zoom/Link Button Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_portfolio_block_button_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_portfolio_block_button_color', array(
    'section' => 'total_plus_portfolio_section',
    'priority' => 56,
    'label' => esc_html__('Zoom/Link Button Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_title_style', array(
    'selector' => '.ht-portfolio-section',
    'render_callback' => 'total_plus_portfolio_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_super_title', array(
    'selector' => '.ht-portfolio-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_portfolio_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_title', array(
    'selector' => '.ht-portfolio-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_portfolio_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_sub_title', array(
    'selector' => '.ht-portfolio-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_portfolio_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_cat', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_show_all', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_active_cat', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_cat_menu', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_tab_style', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_style', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_orderby', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_order', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_full_width', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_gap', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_zoom', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_link', array(
    'selector' => '.ht-portfolio-content',
    'render_callback' => 'total_plus_portfolio_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_button_text', array(
    'selector' => '.ht-portfolio-section',
    'render_callback' => 'total_plus_portfolio_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_portfolio_button_link', array(
    'selector' => '.ht-portfolio-section',
    'render_callback' => 'total_plus_portfolio_section',
    'container_inclusive' => true
));

