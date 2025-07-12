<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
/* HEADER PANEL */
$wp_customize->add_panel('total_plus_header_settings_panel', array(
    'title' => esc_html__('Header Settings', 'total-plus'),
    'priority' => 15
));

$wp_customize->get_section('title_tagline')->panel = 'total_plus_header_settings_panel';
$wp_customize->get_section('title_tagline')->title = esc_html__('Logo & Favicon', 'total-plus');

$wp_customize->add_setting('total_plus_hide_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_hide_title', array(
    'type' => 'checkbox',
    'section' => 'title_tagline',
    'label' => esc_html__('Hide Site Title', 'total-plus')
));

$wp_customize->selective_refresh->add_partial('total_plus_hide_title', array(
    'selector' => '#ht-site-branding',
    'render_callback' => 'total_plus_header_logo'
));

$wp_customize->add_setting('total_plus_hide_tagline', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_hide_tagline', array(
    'type' => 'checkbox',
    'section' => 'title_tagline',
    'label' => esc_html__('Hide Site Tagline', 'total-plus')
));

$wp_customize->selective_refresh->add_partial('total_plus_hide_tagline', array(
    'selector' => '#ht-site-branding',
    'render_callback' => 'total_plus_header_logo'
));

$wp_customize->add_setting('total_plus_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_title_color', array(
    'section' => 'title_tagline',
    'label' => esc_html__('Title/Tagline Color', 'total-plus')
)));

//HEADER SETTINGS
$wp_customize->add_section('total_plus_header_options', array(
    'title' => esc_html__('Header Options', 'total-plus'),
    'panel' => 'total_plus_header_settings_panel'
));

//HEADER SETTINGS
$wp_customize->add_section('total_plus_header_options', array(
    'title' => esc_html__('Header Options', 'total-plus'),
    'panel' => 'total_plus_header_settings_panel'
));

$wp_customize->add_setting('total_plus_header_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_header_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_header_options',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Layouts', 'total-plus'),
            'fields' => array(
                'total_plus_mh_layout',
                'total_plus_header_position',
                'total_plus_logo_height',
                'total_plus_responsive_width'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Top Bar', 'total-plus'),
            'fields' => array(
                'total_plus_top_header',
                'total_plus_th_bg_color',
                'total_plus_th_text_color',
                'total_plus_th_anchor_color',
                'total_plus_th_padding',
                'total_plus_th_disable_mobile',
                'total_plus_top_header_options_heading',
                'total_plus_th_left_display',
                'total_plus_th_right_display',
                'total_plus_top_header_seperator',
                'total_plus_social_link',
                'total_plus_th_menu',
                'total_plus_th_widget',
                'total_plus_th_text'
            ),
        ),
        array(
            'name' => esc_html__('Main Menu', 'total-plus'),
            'fields' => array(
                'total_plus_sticky_header',
                'total_plus_mh_bg_color',
                'total_plus_mh_bg_color_mobile',
                'total_plus_mh_height',
                'total_plus_add_menu',
                'total_plus_mh_show_search',
                'total_plus_mh_show_cart',
                'total_plus_mh_show_social',
                'total_plus_menu_seperator',
                'total_plus_mh_menu_color',
                'total_plus_mh_menu_hover_color',
                'total_plus_mh_menu_hover_bg_color',
                'total_plus_submenu_seperator',
                'total_plus_mh_submenu_bg_color',
                'total_plus_mh_submenu_color',
                'total_plus_mh_submenu_hover_color',
                'total_plus_mh_submenu_hover_bg_color',
                'total_plus_menuhover_seperator',
                'total_plus_mh_menu_hover_style',
                'total_plus_menu_dropdown_padding',
                'total_plus_dropdown_seperator',
                'total_plus_toggle_button_bg_color',
                'total_plus_toggle_button_color'
            ),
        ),
    ),
)));

//HEADER LAYOUTS
$wp_customize->add_setting('total_plus_mh_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'header-style1'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_mh_layout', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Header Layout', 'total-plus'),
    'class' => 'ht-full-width',
    'options' => array(
        'header-style1' => $imagepath . '/inc/customizer/images/header-1.png',
        'header-style2' => $imagepath . '/inc/customizer/images/header-2.png',
        'header-style3' => $imagepath . '/inc/customizer/images/header-3.png',
        'header-style4' => $imagepath . '/inc/customizer/images/header-4.png',
        'header-style5' => $imagepath . '/inc/customizer/images/header-5.png',
        'header-style6' => $imagepath . '/inc/customizer/images/header-6.png'
    )
)));

$wp_customize->add_setting('total_plus_header_position', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'header-above'
));

$wp_customize->add_control('total_plus_header_position', array(
    'section' => 'total_plus_header_options',
    'type' => 'select',
    'label' => esc_html__('Header Position', 'total-plus'),
    'choices' => array(
        'header-above' => esc_html__('Above Slider/Banner', 'total-plus'),
        'header-over' => esc_html__('Over Slider/Banner', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_logo_height', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage',
    'default' => 50
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_logo_height', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Logo Height(px)', 'total-plus'),
    'description' => esc_html('The logo height will not increase beyond the header height. Increase the header height first.', 'total-plus'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 140,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_responsive_width', array(
    'sanitize_callback' => 'absint',
    'default' => 780
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_responsive_width', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Enable Responsive Menu After(px)', 'total-plus'),
    'description' => esc_html('Set the value of the screen immediately after the menu item breaks into multiple line.', 'total-plus'),
    'input_attrs' => array(
        'min' => 480,
        'max' => 1400,
        'step' => 10
    )
)));

//TOP HEADER SETTINGS
$wp_customize->add_setting('total_plus_top_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_top_header', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Enable Top Header', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_th_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_th_bg_color', array(
    'label' => esc_html__('Top Header Background', 'total-plus'),
    'section' => 'total_plus_header_options',
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

$wp_customize->add_setting('total_plus_th_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_th_text_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_th_anchor_color', array(
    'default' => '#EEEEEE',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_th_anchor_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Anchor(Link) Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_th_padding', array(
    'sanitize_callback' => 'absint',
    'default' => 15,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_th_padding', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Top & Bottom Padding', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 50,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_th_disable_mobile', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_th_disable_mobile', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Disable in Mobile', 'total-plus')
)));

$wp_customize->add_setting('total_plus_top_header_options_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_top_header_options_heading', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Top Header Content', 'total-plus')
)));

$wp_customize->add_setting('total_plus_th_left_display', array(
    'default' => 'none',
    'sanitize_callback' => 'total_plus_sanitize_choices'
));

$wp_customize->add_control('total_plus_th_left_display', array(
    'section' => 'total_plus_header_options',
    'type' => 'radio',
    'label' => esc_html__('Display in Left Header', 'total-plus'),
    'choices' => array(
        'social' => esc_html__('Social Icons', 'total-plus'),
        'menu' => esc_html__('Menu', 'total-plus'),
        'widget' => esc_html__('Widget', 'total-plus'),
        'text' => esc_html__('HTML Text', 'total-plus'),
        'none' => esc_html__('None', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_th_right_display', array(
    'default' => 'text',
    'sanitize_callback' => 'total_plus_sanitize_choices'
));

$wp_customize->add_control('total_plus_th_right_display', array(
    'section' => 'total_plus_header_options',
    'type' => 'radio',
    'label' => esc_html__('Display in Right Header', 'total-plus'),
    'choices' => array(
        'social' => esc_html__('Social Icons', 'total-plus'),
        'menu' => esc_html__('Menu', 'total-plus'),
        'widget' => esc_html__('Widget', 'total-plus'),
        'text' => esc_html__('HTML Text', 'total-plus'),
        'none' => esc_html__('None', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_top_header_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_top_header_seperator', array(
    'section' => 'total_plus_header_options'
)));

$wp_customize->add_setting('total_plus_social_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_social_link', array(
    'label' => esc_html__('Social Icons', 'total-plus'),
    'section' => 'total_plus_header_options',
    'description' => sprintf(esc_html__('Add your %s here', 'total-plus'), '<a href="#" target="_blank">Social Icons</a>')
)));

$wp_customize->add_setting('total_plus_th_menu', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control('total_plus_th_menu', array(
    'section' => 'total_plus_header_options',
    'type' => 'select',
    'label' => esc_html__('Select Menu', 'total-plus'),
    'choices' => $total_plus_menu_choice
));

$wp_customize->add_setting('total_plus_th_widget', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control('total_plus_th_widget', array(
    'section' => 'total_plus_header_options',
    'type' => 'select',
    'label' => esc_html__('Select Widget', 'total-plus'),
    'choices' => $total_plus_widget_list
));

$wp_customize->add_setting('total_plus_th_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('California, TX 70240 | (1800) 456 7890', 'total-plus')
));

$wp_customize->add_control(new Total_Plus_Page_Editor($wp_customize, 'total_plus_th_text', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Html Text', 'total-plus'),
    'include_admin_print_footer' => true
)));


//MAIN HEADER SETTINGS
$wp_customize->add_setting('total_plus_sticky_header', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_sticky_header', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Sticky Header', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_mh_bg_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_mh_bg_color', array(
    'label' => esc_html__('Header Background Color', 'total-plus'),
    'section' => 'total_plus_header_options',
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

$wp_customize->add_setting('total_plus_mh_bg_color_mobile', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_bg_color_mobile', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Header Bar Background Color(Mobile)', 'total-plus')
)));

$wp_customize->add_setting('total_plus_mh_height', array(
    'sanitize_callback' => 'absint',
    'default' => 90,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_mh_height', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Header Height', 'total-plus'),
    'input_attrs' => array(
        'min' => 50,
        'max' => 200,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_add_menu', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_add_menu', array(
    'section' => 'total_plus_header_options',
    'description' => sprintf(esc_html__('Add %1$s and configure the below Settings. Set Menu Typography from %2$s.', 'total-plus'), '<a href="' . admin_url() . '/nav-menus.php" target="_blank">Menu</a>', '<a href="#" id="menu_typography_link">Here</a>')
)));

$wp_customize->add_setting('total_plus_mh_show_search', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_mh_show_search', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Search Button on Menu', 'total-plus')
)));

$wp_customize->add_setting('total_plus_mh_show_cart', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_mh_show_cart', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Cart Button on Menu', 'total-plus'),
    'active_callback' => 'total_plus_is_woocommerce_activated'
)));

$wp_customize->add_setting('total_plus_mh_show_social', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_mh_show_social', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Social Icons on Menu', 'total-plus')
)));

$wp_customize->add_setting('total_plus_menu_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_menu_seperator', array(
    'section' => 'total_plus_header_options'
)));

$wp_customize->add_setting('total_plus_mh_menu_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_menu_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Menu Link Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_mh_menu_hover_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_menu_hover_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Menu Link Color - Hover', 'total-plus')
)));

$wp_customize->add_setting('total_plus_mh_menu_hover_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_menu_hover_bg_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Menu Link Background Color - Hover', 'total-plus')
)));

$wp_customize->add_setting('total_plus_submenu_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_submenu_seperator', array(
    'section' => 'total_plus_header_options'
)));

$wp_customize->add_setting('total_plus_mh_submenu_bg_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_mh_submenu_bg_color', array(
    'label' => esc_html__('SubMenu Background Color', 'total-plus'),
    'section' => 'total_plus_header_options',
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

$wp_customize->add_setting('total_plus_mh_submenu_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_submenu_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('SubMenu Text/Link Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_mh_submenu_hover_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_submenu_hover_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('SubMenu Link Color - Hover', 'total-plus')
)));

$wp_customize->add_setting('total_plus_mh_submenu_hover_bg_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_mh_submenu_hover_bg_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('SubMenu Link Background Color - Hover', 'total-plus')
)));

$wp_customize->add_setting('total_plus_menuhover_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_menuhover_seperator', array(
    'section' => 'total_plus_header_options'
)));

$wp_customize->add_setting('total_plus_mh_menu_hover_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'hover-style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_mh_menu_hover_style', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Menu Hover Style', 'total-plus'),
    'class' => 'ht-full-width',
    'options' => array(
        'hover-style1' => $imagepath . '/inc/customizer/images/hover-style1.png',
        'hover-style2' => $imagepath . '/inc/customizer/images/hover-style2.png',
        'hover-style3' => $imagepath . '/inc/customizer/images/hover-style3.png',
        'hover-style4' => $imagepath . '/inc/customizer/images/hover-style4.png',
        'hover-style5' => $imagepath . '/inc/customizer/images/hover-style5.png',
        'hover-style6' => $imagepath . '/inc/customizer/images/hover-style6.png',
        'hover-style7' => $imagepath . '/inc/customizer/images/hover-style7.png'
    )
)));

$wp_customize->add_setting('total_plus_menu_dropdown_padding', array(
    'default' => 0,
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_menu_dropdown_padding', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Menu item Top/Bottom Padding', 'total-plus'),
    'description' => sprintf(esc_html__('(in px) Select appropriate number so that the submenu on hover appears just below the header bar. %s', 'total-plus'), '<a href="https://hashthemes.com/articles/menu-top-and-bottom-padding/" target="_blank">' . esc_html__('Detail Article Here', 'total-plus') . '</a>'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_dropdown_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_dropdown_seperator', array(
    'section' => 'total_plus_header_options'
)));

$wp_customize->add_setting('total_plus_toggle_button_bg_color', array(
    'default' => '#0e0e0e',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_toggle_button_bg_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Mobile Menu Button Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_toggle_button_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_toggle_button_color', array(
    'section' => 'total_plus_header_options',
    'label' => esc_html__('Mobile Menu Button Bar Color', 'total-plus')
)));

//HEADER BUTTON SETTINGS
$wp_customize->add_section('total_plus_header_button_section', array(
    'title' => esc_html__('Header CTA Button', 'total-plus'),
    'panel' => 'total_plus_header_settings_panel',
    'description' => esc_html__('The CTA button will show on menu', 'total-plus')
));

$wp_customize->add_setting('total_plus_header_button_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'on'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_header_button_disable', array(
    'section' => 'total_plus_header_button_section',
    'label' => esc_html__('Disable Button', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section'
)));

$wp_customize->add_setting('total_plus_hb_text', array(
    'default' => esc_html__('Call Us', 'total-plus'),
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_hb_text', array(
    'section' => 'total_plus_header_button_section',
    'type' => 'text',
    'label' => esc_html__('Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_hb_link', array(
    'default' => esc_html__('tel:981123232', 'total-plus'),
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_hb_link', array(
    'section' => 'total_plus_header_button_section',
    'type' => 'text',
    'label' => esc_html__('Button Link', 'total-plus')
));

$wp_customize->add_setting('total_plus_hb_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_hb_text_color', array(
    'section' => 'total_plus_header_button_section',
    'label' => esc_html__('Button Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_hb_text_hov_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_hb_text_hov_color', array(
    'section' => 'total_plus_header_button_section',
    'label' => esc_html__('Button Text Hover Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_hb_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_hb_bg_color', array(
    'label' => esc_html__('Button Background Color', 'total-plus'),
    'section' => 'total_plus_header_button_section'
)));

$wp_customize->add_setting('total_plus_hb_bg_hov_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_hb_bg_hov_color', array(
    'label' => esc_html__('Button Background Hover Color', 'total-plus'),
    'section' => 'total_plus_header_button_section'
)));

$wp_customize->add_setting('total_plus_hb_borderradius', array(
    'sanitize_callback' => 'absint',
    'default' => 0,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_hb_borderradius', array(
    'section' => 'total_plus_header_button_section',
    'label' => esc_html__('Button Border Radius', 'total-plus'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_hb_disable_mobile', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_hb_disable_mobile', array(
    'section' => 'total_plus_header_button_section',
    'label' => esc_html__('Disable in Mobile', 'total-plus')
)));

//TITLE BAR SETTINGS
$wp_customize->add_section('total_plus_titlebar_section', array(
    'title' => esc_html__('Title Bar Settings', 'total-plus'),
    'panel' => 'total_plus_header_settings_panel',
    'description' => esc_html__('This setting will apply in all post, pages, archive, search pages', 'total-plus')
));

$wp_customize->add_setting('total_plus_titlebar_bg_url', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_titlebar_bg_id', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_titlebar_bg_repeat', array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_titlebar_bg_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_titlebar_bg_position', array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_titlebar_bg_attach', array(
    'default' => 'fixed',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

// Registers example_background control
$wp_customize->add_control(new Total_Plus_Background_Control($wp_customize, 'total_plus_titlebar_bg', array(
    'label' => esc_html__('Title Bar Background', 'total-plus'),
    'section' => 'total_plus_titlebar_section',
    'settings' => array(
        'image_url' => 'total_plus_titlebar_bg_url',
        'image_id' => 'total_plus_titlebar_bg_id',
        'repeat' => 'total_plus_titlebar_bg_repeat', // Use false to hide the field
        'size' => 'total_plus_titlebar_bg_size',
        'position' => 'total_plus_titlebar_bg_position',
        'attach' => 'total_plus_titlebar_bg_attach'
    )
)));

$wp_customize->add_setting('total_plus_titlebar_bg_color', array(
    'default' => '#f7f9fd',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_titlebar_bg_color', array(
    'section' => 'total_plus_titlebar_section',
    'label' => esc_html__('Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_titlebar_bg_overlay', array(
    'default' => 'rgba( 0, 0, 0, 0)',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_titlebar_bg_overlay', array(
    'label' => esc_html__('Header Background Overlay Color', 'total-plus'),
    'section' => 'total_plus_titlebar_section',
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

$wp_customize->add_setting('total_plus_titlebar_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_titlebar_text_color', array(
    'section' => 'total_plus_titlebar_section',
    'label' => esc_html__('Text Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_show_title', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_show_title', array(
    'section' => 'total_plus_titlebar_section',
    'label' => esc_html__('Page Title/SubTitle', 'total-plus')
)));

$wp_customize->add_setting('total_plus_breadcrumb', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_breadcrumb', array(
    'section' => 'total_plus_titlebar_section',
    'label' => esc_html__('BreadCrumb', 'total-plus'),
    'description' => esc_html__('Breadcrumbs are a great way of letting your visitors find out where they are on your site.', 'total-plus')
)));

$wp_customize->add_setting('total_plus_titlebar_padding', array(
    'sanitize_callback' => 'absint',
    'default' => 50,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_titlebar_padding', array(
    'section' => 'total_plus_titlebar_section',
    'label' => esc_html__('Top & Bottom Padding', 'total-plus'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 200,
        'step' => 1
    )
)));
