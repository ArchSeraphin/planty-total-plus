<?php
/* ============ABOUT US SECTION============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_about_section', array(
    'title' => esc_html__('About Us Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_about_section'),
    'hiding_control' => 'total_plus_about_page_disable'
)));

//ENABLE/DISABLE ABOUT US PAGE
$wp_customize->add_setting('total_plus_about_page_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_about_page_disable', array(
    'section' => 'total_plus_about_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));


$wp_customize->add_setting('total_plus_about_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_about_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_about_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_about_page_heading',
                'total_plus_about_page',
                'total_plus_progressbar',
                'total_plus_about_sidebar_heading',
                'total_plus_disable_about_sidebar',
                'total_plus_about_image',
                'total_plus_about_widget',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_about_cs_heading',
                'total_plus_about_super_title_color',
                'total_plus_about_title_color',
                'total_plus_about_text_color',
                'total_plus_about_link_color',
                'total_plus_about_link_hov_color',
                'total_plus_about_block_seperator',
                'total_plus_progressbar_text_color',
                'total_plus_progressbar_bg_color',
                'total_plus_progressbar_indication_bar_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_about_enable_fullwindow',
                'total_plus_about_align_item',
                'total_plus_about_fw_seperator',
                'total_plus_about_bg_type',
                'total_plus_about_bg_color',
                'total_plus_about_bg_gradient',
                'total_plus_about_bg_image',
                'total_plus_about_parallax_effect',
                'total_plus_about_bg_video',
                'total_plus_about_overlay_color',
                'total_plus_about_cs_seperator',
                'total_plus_about_padding',
                'total_plus_about_seperator0',
                'total_plus_about_section_seperator',
                'total_plus_about_seperator1',
                'total_plus_about_top_seperator',
                'total_plus_about_ts_color',
                'total_plus_about_ts_height',
                'total_plus_about_seperator2',
                'total_plus_about_bottom_seperator',
                'total_plus_about_bs_color',
                'total_plus_about_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_about_page_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_about_page_heading', array(
    'section' => 'total_plus_about_section',
    'label' => esc_html__('About Page - Left Block', 'total-plus')
)));

//ABOUT US PAGE
$wp_customize->add_setting('total_plus_about_page', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_about_page', array(
    'section' => 'total_plus_about_section',
    'type' => 'dropdown-pages',
    'label' => esc_html__('Select a Page', 'total-plus')
));


$wp_customize->add_setting('total_plus_progressbar', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'title' => '',
            'percentage' => 50,
            'enable' => 'on'
        )
    ))
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_progressbar', array(
    'label' => esc_html__('Progress Bars', 'total-plus'),
    'section' => 'total_plus_about_section',
    'box_label' => esc_html__('Progress Bar', 'total-plus'),
    'add_label' => esc_html__('Add New', 'total-plus'),
        ), array(
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Title', 'total-plus'),
        'default' => ''
    ),
    'percentage' => array(
        'type' => 'range',
        'label' => esc_html__('Precentage', 'total-plus'),
        'options' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'unit' => '%',
            'val' => '50'
        ),
        'default' => '50'
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

$wp_customize->add_setting('total_plus_about_sidebar_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_about_sidebar_heading', array(
    'section' => 'total_plus_about_section',
    'label' => esc_html__('Sidebar - Right Block', 'total-plus')
)));

$wp_customize->add_setting('total_plus_disable_about_sidebar', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_disable_about_sidebar', array(
    'section' => 'total_plus_about_section',
    'label' => esc_html__('Disable Sidebar', 'total-plus'),
    'description' => esc_html__('If disabled, the left content will cover the full width', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_about_image_heading', array(
    'section' => 'total_plus_about_section',
    'label' => esc_html__('Right Image', 'total-plus')
)));

$wp_customize->add_setting('total_plus_about_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_plus_about_image', array(
    'section' => 'total_plus_about_section',
    'label' => esc_html__('Upload Image', 'total-plus'),
    'description' => esc_html__('Recommended Image Size: 500X600px', 'total-plus')
)));

$wp_customize->add_setting('total_plus_about_widget', array(
    'default' => '0',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_about_widget', array(
    'section' => 'total_plus_about_section',
    'type' => 'select',
    'label' => esc_html__('Replace Image by widget', 'total-plus'),
    'choices' => $total_plus_widget_list
));

$wp_customize->add_setting("total_plus_about_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_about_block_seperator", array(
    'section' => 'total_plus_about_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_progressbar_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_progressbar_text_color', array(
    'section' => 'total_plus_about_section',
    'priority' => 56,
    'label' => esc_html__('Progress Bar Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_progressbar_bg_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
    'default' => '#F6F6F6'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_progressbar_bg_color', array(
    'section' => 'total_plus_about_section',
    'priority' => 56,
    'label' => esc_html__('Progress Bar Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_progressbar_indication_bar_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
    'default' => '#000000'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_progressbar_indication_bar_color', array(
    'section' => 'total_plus_about_section',
    'priority' => 56,
    'label' => esc_html__('Progress Bar Inidcation Bar Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_about_page', array(
    'selector' => '.ht-about-page',
    'render_callback' => 'total_plus_about_page'
));

$wp_customize->selective_refresh->add_partial('total_plus_progressbar', array(
    'selector' => '.ht-progressbar-container',
    'render_callback' => 'total_plus_about_progressbar'
));

$wp_customize->selective_refresh->add_partial('total_plus_disable_about_sidebar', array(
    'selector' => '.ht-about-container',
    'render_callback' => 'total_plus_about_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_about_image', array(
    'selector' => '.ht-about-sidebar',
    'render_callback' => 'total_plus_about_sidebar',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_about_widget', array(
    'selector' => '.ht-about-sidebar',
    'render_callback' => 'total_plus_about_sidebar',
    'container_inclusive' => true
));