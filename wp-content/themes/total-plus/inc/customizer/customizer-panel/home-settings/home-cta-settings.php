<?php


/* ============CALL TO ACTION PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_cta_section', array(
    'title' => esc_html__('Call To Action Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_cta_section'),
    'hiding_control' => 'total_plus_cta_section_disable'
)));

//ENABLE/DISABLE LOGO SECTION
$wp_customize->add_setting('total_plus_cta_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_cta_section_disable', array(
    'section' => 'total_plus_cta_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('total_plus_cta_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_cta_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_cta_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_cta_super_title',
                'total_plus_cta_title',
                'total_plus_cta_sub_title',
                'total_plus_cta_button1_text',
                'total_plus_cta_button1_link',
                'total_plus_cta_button2_text',
                'total_plus_cta_button2_link',
                'total_plus_cta_video_heading',
                'total_plus_cta_video_url',
                'total_plus_cta_video_button_icon',
                'total_plus_cta_setting_heading',
                'total_plus_cta_style'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_cta_cs_heading',
                'total_plus_cta_super_title_color',
                'total_plus_cta_title_color',
                'total_plus_cta_text_color',
                'total_plus_cta_link_color',
                'total_plus_cta_link_hov_color',
                'total_plus_cta_button1_bg_color',
                'total_plus_cta_button1_text_color',
                'total_plus_cta_button2_bg_color',
                'total_plus_cta_button2_text_color',
                'total_plus_cta_video_icon_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_cta_enable_fullwindow',
                'total_plus_cta_align_item',
                'total_plus_cta_fw_seperator',
                'total_plus_cta_bg_type',
                'total_plus_cta_bg_color',
                'total_plus_cta_bg_gradient',
                'total_plus_cta_bg_image',
                'total_plus_cta_parallax_effect',
                'total_plus_cta_bg_video',
                'total_plus_cta_overlay_color',
                'total_plus_cta_cs_seperator',
                'total_plus_cta_padding',
                'total_plus_cta_padding_bottom',
                'total_plus_cta_seperator0',
                'total_plus_cta_section_seperator',
                'total_plus_cta_seperator1',
                'total_plus_cta_top_seperator',
                'total_plus_cta_ts_color',
                'total_plus_cta_ts_height',
                'total_plus_cta_seperator2',
                'total_plus_cta_bottom_seperator',
                'total_plus_cta_bs_color',
                'total_plus_cta_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_cta_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_super_title', array(
    'section' => 'total_plus_cta_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Call To Action Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_title', array(
    'section' => 'total_plus_cta_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Call To Action Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_sub_title', array(
    'section' => 'total_plus_cta_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_button1_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_button1_text', array(
    'section' => 'total_plus_cta_section',
    'type' => 'text',
    'label' => esc_html__('Button 1 Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_button1_link', array(
    'default' => '',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_button1_link', array(
    'section' => 'total_plus_cta_section',
    'type' => 'url',
    'label' => esc_html__('Button 1 Link', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_button2_text', array(
    'default' => '',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_button2_text', array(
    'section' => 'total_plus_cta_section',
    'type' => 'text',
    'label' => esc_html__('Button 2 Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_button2_link', array(
    'default' => '',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_button2_link', array(
    'section' => 'total_plus_cta_section',
    'type' => 'url',
    'label' => esc_html__('Button 2 Link', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_video_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_cta_video_heading', array(
    'section' => 'total_plus_cta_section',
    'label' => esc_html__('Video', 'total-plus')
)));

$wp_customize->add_setting('total_plus_cta_video_url', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_cta_video_url', array(
    'section' => 'total_plus_cta_section',
    'type' => 'text',
    'label' => esc_html__('Video Url', 'total-plus'),
    'description' => esc_html__('To display YouTube, Vimeo or VK video, paste the video URL (https://www.youtube.com/watch?v=6O9Nd1RSZSY)', 'total-plus')
));

$wp_customize->add_setting('total_plus_cta_video_button_icon', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_plus_cta_video_button_icon', array(
    'section' => 'total_plus_cta_section',
    'label' => esc_html__('Video Play Icon', 'total-plus'),
    'description' => esc_html__('On clicking the video play button, the video will show in popup. Default play button will show if left empty.', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_cta_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_cta_setting_heading', array(
    'section' => 'total_plus_cta_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_cta_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_cta_style', array(
    'section' => 'total_plus_cta_section',
    'label' => esc_html__('CTA Block Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/cta-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/cta-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/cta-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/cta-style4.png'
    )
)));

$wp_customize->add_setting('total_plus_cta_button1_bg_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_cta_button1_bg_color', array(
    'section' => 'total_plus_cta_section',
    'priority' => 56,
    'label' => esc_html__('Button 1 Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_cta_button1_text_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_cta_button1_text_color', array(
    'section' => 'total_plus_cta_section',
    'priority' => 56,
    'label' => esc_html__('Button 1 Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_cta_button2_bg_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_cta_button2_bg_color', array(
    'section' => 'total_plus_cta_section',
    'priority' => 56,
    'label' => esc_html__('Button 2 Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_cta_button2_text_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_cta_button2_text_color', array(
    'section' => 'total_plus_cta_section',
    'priority' => 56,
    'label' => esc_html__('Button 2 Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_cta_video_icon_color', array(
    'default' => '#e52d27',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_cta_video_icon_color', array(
    'section' => 'total_plus_cta_section',
    'priority' => 56,
    'label' => esc_html__('Video Play Button Color', 'total-plus'),
    'description' => esc_html__('Only applies on default play button. Do not choose white color.', 'total-plus'),
)));

$wp_customize->selective_refresh->add_partial('total_plus_cta_super_title', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_title', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_sub_title', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_button1_text', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_button1_link', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_button2_text', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_button2_link', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_style', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_video_url', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_cta_video_button_icon', array(
    'selector' => '.ht-cta-section',
    'render_callback' => 'total_plus_cta_section',
    'container_inclusive' => true
));
