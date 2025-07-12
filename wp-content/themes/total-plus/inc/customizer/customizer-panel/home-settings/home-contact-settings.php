<?php


/* =============CONTACT US================== */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_contact_section', array(
    'title' => esc_html__('Contact Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_contact_section'),
    'hiding_control' => 'total_plus_contact_section_disable'
)));

//ENABLE/DISABLE CONTACT SECTION
$wp_customize->add_setting('total_plus_contact_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_contact_section_disable', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('total_plus_contact_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post'
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_contact_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_contact_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_google_map_heading',
                'total_plus_longitude',
                'total_plus_latitude',
                'total_plus_map_style',
                'total_plus_google_map_api',
                'total_plus_enable_iframe_map',
                'total_plus_google_map_iframe',
                'total_plus_contact_details_heading',
                'total_plus_show_contact_detail',
                'total_plus_contact_shortcode',
                'total_plus_contact_detail',
                'total_plus_contact_social_icons',
                'total_plus_contact_social_link'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_contact_cs_heading',
                'total_plus_contact_super_title_color',
                'total_plus_contact_title_color',
                'total_plus_contact_text_color',
                'total_plus_contact_link_color',
                'total_plus_contact_link_hov_color',
                'total_plus_contact_block_seperator',
                'total_plus_contact_social_button_bg_color',
                'total_plus_contact_social_button_text_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_contact_enable_fullwindow',
                'total_plus_contact_align_item',
                'total_plus_contact_fw_seperator',
                'total_plus_contact_bg_type',
                'total_plus_contact_bg_color',
                'total_plus_contact_bg_gradient',
                'total_plus_contact_bg_image',
                'total_plus_contact_parallax_effect',
                'total_plus_contact_bg_video',
                'total_plus_contact_overlay_color',
                'total_plus_contact_cs_seperator',
                'total_plus_contact_padding',
                'total_plus_contact_seperator0',
                'total_plus_contact_section_seperator',
                'total_plus_contact_seperator1',
                'total_plus_contact_top_seperator',
                'total_plus_contact_ts_color',
                'total_plus_contact_ts_height',
                'total_plus_contact_seperator2',
                'total_plus_contact_bottom_seperator',
                'total_plus_contact_bs_color',
                'total_plus_contact_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_google_map_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_google_map_heading', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Google Map', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_latitude', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => '29.424122',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_latitude', array(
    'section' => 'total_plus_contact_section',
    'type' => 'text',
    'label' => esc_html__('Latitude', 'total-plus'),
    'description' => sprintf(esc_html__('Get the Longitude and Latitude value of the location from %s', 'total-plus'), '<a target="_blank" href="https://www.latlong.net/">here</a>')
));

$wp_customize->add_setting('total_plus_longitude', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => '-98.493629',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_longitude', array(
    'section' => 'total_plus_contact_section',
    'type' => 'text',
    'label' => esc_html__('Longitude', 'total-plus'),
    'description' => sprintf(esc_html__('Get the Longitude and Latitude value of the location from %s', 'total-plus'), '<a target="_blank" href="https://www.latlong.net/">here</a>')
));

$wp_customize->add_setting('total_plus_map_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'normal',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_map_style', array(
    'section' => 'total_plus_contact_section',
    'type' => 'select',
    'label' => esc_html__('Map Style', 'total-plus'),
    'choices' => array(
        'normal' => esc_html__('Normal', 'total-plus'),
        'light' => esc_html__('Light', 'total-plus'),
        'dark' => esc_html__('Dark', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_google_map_api', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_google_map_api', array(
    'label' => esc_html__('Google Map API Key', 'total-plus'),
    'section' => 'total_plus_contact_section',
    'description' => sprintf(esc_html__('Google Map API key is required for a map to work. Enter API key %s', 'total-plus'), '<a target="_blank" href="' . admin_url('admin.php?page=total-plus-options') . '">' . esc_html__('Here', 'total-plus') . '</a>')
)));

$wp_customize->add_setting('total_plus_enable_iframe_map', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_enable_iframe_map', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Enable Iframe Google Map', 'total-plus'),
    'description' => esc_html__('Don\'t have Google API. No Problem. Enable Iframe Google Map and add the Google Map Iframe below.', 'total-plus')
)));

$wp_customize->add_setting('total_plus_google_map_iframe', array(
    //'sanitize_callback' => 'wp_kses_post',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_google_map_iframe', array(
    'section' => 'total_plus_contact_section',
    'type' => 'textarea',
    'label' => esc_html__('Google Map Iframe', 'total-plus')
));

$wp_customize->add_setting('total_plus_contact_details_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_contact_details_heading', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Contact Details', 'total-plus')
)));

$wp_customize->add_setting('total_plus_show_contact_detail', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'on',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_show_contact_detail', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Show Contact Detail', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_contact_shortcode', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_contact_shortcode', array(
    'section' => 'total_plus_contact_section',
    'type' => 'text',
    'label' => esc_html__('Contact Form Shortcode', 'total-plus'),
    'description' => sprintf(esc_html__('Install %s plugin to get the shortcode', 'total-plus'), '<a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>')
));

$wp_customize->add_setting('total_plus_contact_detail', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => '',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Page_Editor($wp_customize, 'total_plus_contact_detail', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Contact Detail', 'total-plus'),
    'include_admin_print_footer' => true
)));

$wp_customize->add_setting('total_plus_contact_social_icons', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_contact_social_icons', array(
    'section' => 'total_plus_contact_section',
    'label' => esc_html__('Show Social Icons Below Contact Detail', 'total-plus')
)));

$wp_customize->add_setting('total_plus_contact_social_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_contact_social_link', array(
    'label' => esc_html__('Social Icons', 'total-plus'),
    'section' => 'total_plus_contact_section',
    'description' => sprintf(esc_html__('Add your %s here', 'total-plus'), '<a href="#">Social Icons</a>')
)));

$wp_customize->add_setting("total_plus_contact_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_contact_block_seperator", array(
    'section' => 'total_plus_contact_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_contact_social_button_bg_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_contact_social_button_bg_color', array(
    'section' => 'total_plus_contact_section',
    'priority' => 56,
    'label' => esc_html__('Contact Block Social Icon Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_contact_social_button_text_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_contact_social_button_text_color', array(
    'section' => 'total_plus_contact_section',
    'priority' => 56,
    'label' => esc_html__('Contact Block Social Icon Color', 'total-plus')
)));


$wp_customize->selective_refresh->add_partial('total_plus_longitude', array(
    'selector' => '.ht-contact-google-map',
    'render_callback' => 'total_plus_contact_map',
));

$wp_customize->selective_refresh->add_partial('total_plus_latitude', array(
    'selector' => '.ht-contact-google-map',
    'render_callback' => 'total_plus_contact_map',
));

$wp_customize->selective_refresh->add_partial('total_plus_map_style', array(
    'selector' => '.ht-contact-google-map',
    'render_callback' => 'total_plus_contact_map',
));

$wp_customize->selective_refresh->add_partial('total_plus_google_map_api', array(
    'selector' => '.ht-contact-google-map',
    'render_callback' => 'total_plus_contact_map',
));

$wp_customize->selective_refresh->add_partial('total_plus_enable_iframe_map', array(
    'selector' => '.ht-contact-google-map',
    'render_callback' => 'total_plus_contact_map',
));

$wp_customize->selective_refresh->add_partial('total_plus_google_map_iframe', array(
    'selector' => '.ht-contact-google-map',
    'render_callback' => 'total_plus_contact_map',
));

$wp_customize->selective_refresh->add_partial('total_plus_contact_shortcode', array(
    'selector' => '.ht-contact-section .ht-container',
    'render_callback' => 'total_plus_contact_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_contact_detail', array(
    'selector' => '.ht-contact-section .ht-container',
    'render_callback' => 'total_plus_contact_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_contact_social_icons', array(
    'selector' => '.ht-contact-section .ht-container',
    'render_callback' => 'total_plus_contact_content',
));

$wp_customize->selective_refresh->add_partial('total_plus_show_contact_detail', array(
    'selector' => '.ht-contact-section',
    'render_callback' => 'total_plus_contact_section',
    'container_inclusive' => true
));

