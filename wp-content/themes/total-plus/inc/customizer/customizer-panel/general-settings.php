<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
/* GENERAL SETTINGS PANEL */
$wp_customize->add_panel('total_plus_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'total-plus'),
    'priority' => 1
));

//MOVE FRONT PAGE, BACKGROUND AND COLOR SETTING INTO GENERAL SETTING PANEL
$wp_customize->get_section('background_image')->panel = 'total_plus_general_settings_panel';
$wp_customize->get_control('background_color')->section = 'background_image';

//COLOR SETTINGS
$wp_customize->add_setting('total_plus_template_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_template_color', array(
    'section' => 'colors',
    'label' => esc_html__('Theme Primary Color', 'total-plus')
)));

//GENERAL SETTINGS
$wp_customize->add_section('total_plus_general_options_section', array(
    'title' => esc_html__('General Options', 'total-plus'),
    'panel' => 'total_plus_general_settings_panel'
));

$wp_customize->add_setting('total_plus_style_option', array(
    'default' => 'head',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_style_option', array(
    'section' => 'total_plus_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Dynamic Style Option', 'total-plus'),
    'choices' => array(
        'head' => esc_html__('WP Head', 'total-plus'),
        'file' => esc_html__('Custom File', 'total-plus')
    ),
    'description' => esc_html__('WP Head option will save the custom CSS in the header of the HTML file and Custom file option will save the custom CSS in a seperate file.', 'total-plus')
));

$wp_customize->add_setting('total_plus_website_layout', array(
    'default' => 'wide',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_website_layout', array(
    'section' => 'total_plus_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Website Layout', 'total-plus'),
    'choices' => array(
        'wide' => esc_html__('Wide', 'total-plus'),
        'boxed' => esc_html__('Boxed', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_website_width', array(
    'sanitize_callback' => 'absint',
    'default' => 1170,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_website_width', array(
    'section' => 'total_plus_general_options_section',
    'label' => esc_html__('Website Container Width', 'total-plus'),
    'input_attrs' => array(
        'min' => 900,
        'max' => 1400,
        'step' => 10
    )
)));

$wp_customize->add_setting('total_plus_sidebar_width', array(
    'sanitize_callback' => 'absint',
    'default' => 30,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_sidebar_width', array(
    'section' => 'total_plus_general_options_section',
    'label' => esc_html__('Sidebar Width (%)', 'total-plus'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 50,
        'step' => 1
    )
)));

/*
  $wp_customize->add_setting('total_plus_website_layout_seperator', array(
  'sanitize_callback' => 'total_plus_sanitize_text'
  ));

  $wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_website_layout_seperator', array(
  'section' => 'total_plus_general_options_section'
  )));


  $wp_customize->add_setting('total_plus_scroll_animation', array(
  'sanitize_callback' => 'total_plus_sanitize_checkbox',
  'default' => true
  ));

  $wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_scroll_animation', array(
  'section' => 'total_plus_general_options_section',
  'label' => esc_html__('Animation Effect on Scroll', 'total-plus'),
  'description' => esc_html__('Elements appear with some animation as they appear in viewscreen', 'total-plus')
  )));
 * 
 */

$wp_customize->add_setting('total_plus_scroll_animation_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_scroll_animation_seperator', array(
    'section' => 'total_plus_general_options_section'
)));

$wp_customize->add_setting('total_plus_backtotop', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_backtotop', array(
    'section' => 'total_plus_general_options_section',
    'label' => esc_html__('Back to Top Button', 'total-plus'),
    'description' => esc_html__('A button on click scrolls to the top of the page.', 'total-plus')
)));
/*
$wp_customize->add_setting('total_plus_backtotop_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, 'total_plus_backtotop_seperator', array(
    'section' => 'total_plus_general_options_section'
)));

$wp_customize->add_setting('total_plus_nice_scroll', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => false
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_nice_scroll', array(
    'section' => 'total_plus_general_options_section',
    'label' => esc_html__('Fancy ScrollBar', 'total-plus'),
    'description' => esc_html__('Removes browser default scrollbar and replace it with fancy scrollbar.', 'total-plus')
)));
 */

//PRELOADER SETTINGS
$wp_customize->add_section('total_plus_preloader_options_section', array(
    'title' => esc_html__('Preloader Options', 'total-plus'),
    'panel' => 'total_plus_general_settings_panel'
));

$wp_customize->add_setting('total_plus_preloader', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_preloader', array(
    'section' => 'total_plus_preloader_options_section',
    'label' => esc_html__('Enable Preloader', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_preloader_type', array(
    'default' => 'preloader1',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Image_Select($wp_customize, 'total_plus_preloader_type', array(
    'section' => 'total_plus_preloader_options_section',
    'type' => 'select',
    'label' => esc_html__('Preloader Type', 'total-plus'),
    'image_path' => $imagepath . '/inc/customizer/images/',
    'choices' => array(
        'preloader1' => esc_html__('Preloader 1', 'total-plus'),
        'preloader2' => esc_html__('Preloader 2', 'total-plus'),
        'preloader3' => esc_html__('Preloader 3', 'total-plus'),
        'preloader4' => esc_html__('Preloader 4', 'total-plus'),
        'preloader5' => esc_html__('Preloader 5', 'total-plus'),
        'preloader6' => esc_html__('Preloader 6', 'total-plus'),
        'preloader7' => esc_html__('Preloader 7', 'total-plus'),
        'preloader8' => esc_html__('Preloader 8', 'total-plus'),
        'preloader9' => esc_html__('Preloader 9', 'total-plus'),
        'preloader10' => esc_html__('Preloader 10', 'total-plus'),
        'preloader11' => esc_html__('Preloader 11', 'total-plus'),
        'preloader12' => esc_html__('Preloader 12', 'total-plus'),
        'preloader13' => esc_html__('Preloader 13', 'total-plus'),
        'preloader14' => esc_html__('Preloader 14', 'total-plus'),
        'preloader15' => esc_html__('Preloader 15', 'total-plus'),
        'preloader16' => esc_html__('Preloader 16', 'total-plus'),
        'custom' => esc_html__('Custom', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_preloader_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_preloader_color', array(
    'section' => 'total_plus_preloader_options_section',
    'label' => esc_html__('Preloader Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_preloader_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_plus_preloader_image', array(
    'section' => 'total_plus_preloader_options_section',
    'description' => esc_html__('Custom Preloader Image - gif image is preferable', 'total-plus')
)));

$wp_customize->add_setting('total_plus_preloader_bg_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_preloader_bg_color', array(
    'section' => 'total_plus_preloader_options_section',
    'label' => esc_html__('Preloader Background Color', 'total-plus')
)));

//ADMIN LOGO
$wp_customize->add_section('total_plus_admin_logo_section', array(
    'title' => esc_html__('Admin Logo', 'total-plus'),
    'panel' => 'total_plus_general_settings_panel',
    'description' => esc_html__('The logo will appear in the admin login page.', 'total-plus')
));

$wp_customize->add_setting('total_plus_admin_logo', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_plus_admin_logo', array(
    'section' => 'total_plus_admin_logo_section',
    'label' => esc_html__('Upload Admin Logo', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_admin_logo_width', array(
    'sanitize_callback' => 'absint',
    'default' => 180,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_admin_logo_width', array(
    'section' => 'total_plus_admin_logo_section',
    'label' => esc_html__('Logo Width', 'total-plus'),
    'input_attrs' => array(
        'min' => 80,
        'max' => 320,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_admin_logo_height', array(
    'sanitize_callback' => 'absint',
    'default' => 80,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_admin_logo_height', array(
    'section' => 'total_plus_admin_logo_section',
    'label' => esc_html__('Logo Height', 'total-plus'),
    'input_attrs' => array(
        'min' => 30,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_admin_logo_link', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_admin_logo_link', array(
    'section' => 'total_plus_admin_logo_section',
    'type' => 'text',
    'label' => esc_html__('Admin Logo Link', 'total-plus'),
    'description' => esc_html__('This is the url that is opened when clicked on the admin logo.', 'total-plus')
));
