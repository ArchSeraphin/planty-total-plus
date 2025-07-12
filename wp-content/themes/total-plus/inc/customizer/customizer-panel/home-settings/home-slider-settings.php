<?php

/* ============SLIDER IMAGES SECTION============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_slider_section', array(
    'title' => esc_html__('Home Slider', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => -1,
    'hiding_control' => 'total_plus_slider_disable',
)));

$wp_customize->add_setting('total_plus_slider_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

//ENABLE/DISABLE SLIDER
$wp_customize->add_setting('total_plus_slider_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_slider_disable', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section'
)));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_slider_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_slider_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_slider_type',
                'total_plus_slider_heading',
                'total_plus_sliders',
                'total_plus_slider_info',
                'total_plus_slider_setting_heading',
                'total_plus_slider_transition',
                'total_plus_slider_height_type',
                'total_plus_slider_height',
                'total_plus_slider_pause',
                'total_plus_slider_autoplay',
                'total_plus_slider_arrow',
                'total_plus_slider_dots',
                'total_plus_banner_image',
                'total_plus_banner_title',
                'total_plus_banner_subtitle',
                'total_plus_banner_button_text',
                'total_plus_banner_button_link',
                'total_plus_banner_text_alignment',
                'total_plus_banner_parallax_effect',
                'total_plus_slider_shortcode',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_slider_overlay_color',
                'total_plus_banner_overlay_color',
                'total_plus_caption_title_background_color',
                'total_plus_caption_title_color',
                'total_plus_caption_subtitle_color',
                'total_plus_slider_arrow_color_group',
                'total_plus_caption_button_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_slider_bottom_seperator',
                'total_plus_slider_bs_color',
                'total_plus_slider_bs_height'
            )
        )
    ),
)));

$wp_customize->add_setting('total_plus_slider_type', array(
    'default' => 'normal',
    'sanitize_callback' => 'total_plus_sanitize_choices'
));

$wp_customize->add_control('total_plus_slider_type', array(
    'section' => 'total_plus_slider_section',
    'type' => 'radio',
    'label' => esc_html__('Slider Type', 'total-plus'),
    'choices' => array(
        'normal' => esc_html__('Normal Slider', 'total-plus'),
        'revolution' => esc_html__('Revolution Slider', 'total-plus'),
        'banner' => esc_html__('Single Banner Image', 'total-plus')
    )
));

/* Slider */
$wp_customize->add_setting('total_plus_slider_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_slider_heading', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Sliders', 'total-plus')
)));

$wp_customize->add_setting('total_plus_sliders', array(
    'sanitize_callback' => 'total_plus_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'image' => '',
            'title' => '',
            'subtitle' => '',
            'button_link' => '',
            'button_text' => esc_html__('Read More', 'total-plus'),
            'alignment' => 'center',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Repeater_Controler($wp_customize, 'total_plus_sliders', array(
    'label' => esc_html__('Add Sliders', 'total-plus'),
    'section' => 'total_plus_slider_section',
    'box_label' => esc_html__('Slider', 'total-plus'),
    'add_label' => esc_html__('Add Slider', 'total-plus'),
        ), array(
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Image', 'total-plus'),
        'default' => ''
    ),
    'title' => array(
        'type' => 'text',
        'label' => esc_html__('Slider Caption Title', 'total-plus'),
        'default' => ''
    ),
    'subtitle' => array(
        'type' => 'textarea',
        'label' => esc_html__('Slider Caption Subtitle', 'total-plus'),
        'default' => ''
    ),
    'button_link' => array(
        'type' => 'text',
        'label' => esc_html__('Slider Button Link', 'total-plus'),
        'default' => ''
    ),
    'button_text' => array(
        'type' => 'text',
        'label' => esc_html__('Slider Button Text', 'total-plus'),
        'default' => esc_html__('Read More', 'total-plus')
    ),
    'alignment' => array(
        'type' => 'select',
        'label' => esc_html__('Slider Caption Alignment', 'total-plus'),
        'default' => 'center',
        'options' => array(
            'center' => esc_html__('Center', 'total-plus'),
            'left' => esc_html__('Left', 'total-plus'),
            'right' => esc_html__('Right', 'total-plus')
        )
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable Slider', 'total-plus'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->add_setting('total_plus_slider_info', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Info_Text($wp_customize, 'total_plus_slider_info', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Note:', 'total-plus'),
    'description' => esc_html__('Recommended Image Size: 1900X800 px', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_slider_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_slider_setting_heading', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Slider Settings', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_slider_transition', array(
    'default' => 'slide',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_slider_transition', array(
    'section' => 'total_plus_slider_section',
    'type' => 'radio',
    'label' => esc_html__('Slider Transition', 'total-plus'),
    'choices' => array(
        'slide' => esc_html__('Slide', 'total-plus'),
        'fade' => esc_html__('Fade', 'total-plus')
    )
));

$slider_default_height_type = get_theme_mod('total_plus_slider_full_screen', false) ? 'full' : 'auto';

$wp_customize->add_setting('total_plus_slider_height_type', array(
    'default' => $slider_default_height_type,
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_slider_height_type', array(
    'section' => 'total_plus_slider_section',
    'type' => 'radio',
    'label' => esc_html__('Slider Height', 'total-plus'),
    'description' => esc_html__('Image may crop on either sides in Full Height and Custom Height opiton.', 'total-plus'),
    'choices' => array(
        'auto' => esc_html__('Auto', 'total-plus'),
        'full' => esc_html__('Full Height', 'total-plus'),
        'custom' => esc_html__('Custom Height', 'total-plus'),
    )
));

$wp_customize->add_setting("total_plus_slider_height", array(
    'sanitize_callback' => 'total_plus_sanitize_number_blank',
    'default' => '800',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("total_plus_slider_height_tablet", array(
    'sanitize_callback' => 'total_plus_sanitize_number_blank',
    'default' => '600',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("total_plus_slider_height_mobile", array(
    'sanitize_callback' => 'total_plus_sanitize_number_blank',
    'default' => '400',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Slider_Control($wp_customize, "total_plus_slider_height", array(
    'section' => "total_plus_slider_section",
    'label' => esc_html__('Custom Slider Height (px)', 'total-plus'),
    'input_attrs' => array(
        'min' => 200,
        'max' => 2000,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "total_plus_slider_height",
        'tablet' => "total_plus_slider_height_tablet",
        'mobile' => "total_plus_slider_height_mobile",
    )
)));

$wp_customize->add_setting('total_plus_slider_pause', array(
    'default' => '5',
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_slider_pause', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Slider Pause Duration', 'total-plus'),
    'description' => esc_html__('Slider Pause duration in seconds', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 10,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_slider_autoplay', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_slider_autoplay', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Auto Play Slider', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_slider_arrow', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_slider_arrow', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Slider Arrow', 'total-plus'),
)));

$wp_customize->add_setting('total_plus_slider_dots', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_slider_dots', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Slider Dots', 'total-plus'),
)));


/* Banner */
$wp_customize->add_setting('total_plus_banner_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage',
    'default' => get_template_directory_uri() . '/images/bg.jpg'
));

$wp_customize->add_setting('total_plus_banner_image_id', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_banner_image_repeat', array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_banner_image_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_banner_image_position', array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_banner_image_attach', array(
    'default' => 'fixed',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

// Registers example_background control
$wp_customize->add_control(new Total_Plus_Background_Control($wp_customize, 'total_plus_banner_image', array(
    'label' => esc_html__('Upload Banner Image', 'total-plus'),
    'section' => 'total_plus_slider_section',
    'settings' => array(
        'image_url' => 'total_plus_banner_image',
        'image_id' => 'total_plus_banner_image_id',
        'repeat' => 'total_plus_banner_image_repeat',
        'size' => 'total_plus_banner_image_size',
        'position' => 'total_plus_banner_image_position',
        'attach' => 'total_plus_banner_image_attach'
    )
)));

$wp_customize->add_setting('total_plus_banner_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_banner_title', array(
    'section' => 'total_plus_slider_section',
    'type' => 'text',
    'label' => esc_html__('Banner Title', 'total-plus'),
));

$wp_customize->add_setting('total_plus_banner_subtitle', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_banner_subtitle', array(
    'section' => 'total_plus_slider_section',
    'type' => 'textarea',
    'label' => esc_html__('Banner SubTitle', 'total-plus'),
));

$wp_customize->add_setting('total_plus_banner_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_banner_button_text', array(
    'section' => 'total_plus_slider_section',
    'type' => 'text',
    'label' => esc_html__('Button Text', 'total-plus'),
));

$wp_customize->add_setting('total_plus_banner_button_link', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_banner_button_link', array(
    'section' => 'total_plus_slider_section',
    'type' => 'text',
    'label' => esc_html__('Button Link', 'total-plus'),
));

$wp_customize->add_setting('total_plus_banner_text_alignment', array(
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'default' => 'center',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_banner_text_alignment', array(
    'type' => 'select',
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Banner Text Alignment', 'total-plus'),
    'choices' => array(
        'left' => esc_html__('Left', 'total-plus'),
        'right' => esc_html__('Right', 'total-plus'),
        'center' => esc_html__('Center', 'total-plus')
    ),
));

$wp_customize->add_setting('total_plus_banner_parallax_effect', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'none',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_banner_parallax_effect', array(
    'type' => 'radio',
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Background Effect', 'total-plus'),
    'choices' => array(
        'none' => esc_html__('None', 'total-plus'),
        'parallax' => esc_html__('Enable Parallax', 'total-plus'),
        'scroll' => esc_html__('Horizontal Moving', 'total-plus')
    ),
));

$wp_customize->add_setting('total_plus_slider_overlay_color', array(
    'default' => 'rgba(255,255,255,0)',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_slider_overlay_color', array(
    'label' => esc_html__('Slider Overlay Color', 'total-plus'),
    'section' => 'total_plus_slider_section',
    'palette' => array(
        'rgb(255, 255, 255, 0.3)', // RGB, RGBa, and hex values supported
        'rgba(0, 0, 0, 0.3)',
        'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
        '#00CC99', // Mix of color types = no problem
        '#00C439',
        '#00C569',
        'rgba( 255, 234, 255, 0.2 )', // Different spacing = no problem
        '#AACC99', // Mix of color types = no problem
        '#33C439',
    )
)));

$wp_customize->add_setting('total_plus_banner_overlay_color', array(
    'default' => 'rgba(255,255,255,0)',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_banner_overlay_color', array(
    'label' => esc_html__('Background Overlay Color', 'total-plus'),
    'section' => 'total_plus_slider_section'
)));

$wp_customize->add_setting('total_plus_caption_title_background_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Alpha_Color_Control($wp_customize, 'total_plus_caption_title_background_color', array(
    'label' => esc_html__('Caption Title Background Color', 'total-plus'),
    'section' => 'total_plus_slider_section',
    'palette' => array(
        'rgb(255, 255, 255, 0.3)', // RGB, RGBa, and hex values supported
        'rgba(0, 0, 0, 0.3)',
        'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
        '#00CC99', // Mix of color types = no problem
        '#00C439',
        '#00C569',
        'rgba( 255, 234, 255, 0.2 )', // Different spacing = no problem
        '#AACC99', // Mix of color types = no problem
        '#33C439',
    ),
)));

$wp_customize->add_setting('total_plus_caption_title_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_caption_title_color', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Caption Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_caption_subtitle_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_caption_subtitle_color', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Caption Sub Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_caption_button_bg_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_caption_button_border_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_caption_button_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_caption_button_bg_hov_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_caption_button_border_hov_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_caption_button_text_hov_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Color_Tab_Control($wp_customize, 'total_plus_caption_button_color_group', array(
    'label' => esc_html__('Caption Button Colors', 'total-plus'),
    'section' => 'total_plus_slider_section',
    'show_opacity' => false,
    'settings' => array(
        'normal_total_plus_caption_button_bg_color' => 'total_plus_caption_button_bg_color',
        'normal_total_plus_caption_button_border_color' => 'total_plus_caption_button_border_color',
        'normal_total_plus_caption_button_text_color' => 'total_plus_caption_button_text_color',
        'hover_total_plus_caption_button_bg_hov_color' => 'total_plus_caption_button_bg_hov_color',
        'hover_total_plus_caption_button_border_hov_color' => 'total_plus_caption_button_border_hov_color',
        'hover_total_plus_caption_button_text_hov_color' => 'total_plus_caption_button_text_hov_color',
    ),
    'group' => array(
        'normal_total_plus_caption_button_bg_color' => esc_html__('Button Background Color', 'total-plus'),
        'normal_total_plus_caption_button_border_color' => esc_html__('Button Border Color', 'total-plus'),
        'normal_total_plus_caption_button_text_color' => esc_html__('Button Text Color', 'total-plus'),
        'hover_total_plus_caption_button_bg_hov_color' => esc_html__('Button Background Color', 'total-plus'),
        'hover_total_plus_caption_button_border_hov_color' => esc_html__('Button Border Color', 'total-plus'),
        'hover_total_plus_caption_button_text_hov_color' => esc_html__('Button Text Color', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_slider_arrow_bg_color', array(
    'default' => '#222222',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_slider_arrow_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_slider_arrow_bg_color_hover', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('total_plus_slider_arrow_color_hover', array(
    'default' => '#222222',
    'sanitize_callback' => 'total_plus_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Color_Tab_Control($wp_customize, 'total_plus_slider_arrow_color_group', array(
    'label' => esc_html__('Slider Navigation Colors', 'total-plus'),
    'section' => 'total_plus_slider_section',
    'show_opacity' => true,
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        '#FF0000',
        '#CCCCCC'
    ),
    'settings' => array(
        'normal_total_plus_slider_arrow_bg_color' => 'total_plus_slider_arrow_bg_color',
        'normal_total_plus_slider_arrow_color' => 'total_plus_slider_arrow_color',
        'hover_total_plus_slider_arrow_bg_color_hover' => 'total_plus_slider_arrow_bg_color_hover',
        'hover_total_plus_slider_arrow_color_hover' => 'total_plus_slider_arrow_color_hover',
    ),
    'group' => array(
        'normal_total_plus_slider_arrow_bg_color' => esc_html__('Slider Arrow/Dot Color', 'total-plus'),
        'normal_total_plus_slider_arrow_color' => esc_html__('Slider Arrow Color', 'total-plus'),
        'hover_total_plus_slider_arrow_bg_color_hover' => esc_html__('Slider Arrow', 'total-plus'),
        'hover_total_plus_slider_arrow_color_hover' => esc_html__('Slider Arrow Color', 'total-plus')
    )
)));

/* Revolution Slider Shortcode */
$wp_customize->add_setting('total_plus_slider_shortcode', array(
    'default' => '',
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control('total_plus_slider_shortcode', array(
    'section' => 'total_plus_slider_section',
    'type' => 'text',
    'label' => esc_html__('Slider ShortCode', 'total-plus'),
    'description' => esc_html__('Add the ShortCode for Slider', 'total-plus'),
));

$wp_customize->add_setting('total_plus_slider_bottom_seperator', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'none',
));

$wp_customize->add_control('total_plus_slider_bottom_seperator', array(
    'section' => 'total_plus_slider_section',
    'type' => 'select',
    'label' => esc_html__('Bottom Seperator', 'total-plus'),
    'choices' => array_merge(array('none' => 'None'), total_plus_svg_seperator())
));

$wp_customize->add_setting('total_plus_slider_bs_color', array(
    'default' => '#FF0000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_slider_bs_color', array(
    'section' => 'total_plus_slider_section',
    'label' => esc_html__('Bottom Seperator Color', 'total-plus')
)));

$wp_customize->add_setting("total_plus_slider_bs_height", array(
    'sanitize_callback' => 'total_plus_sanitize_number_blank',
    'default' => 60,
    'transport' => 'postMessage'
));

$wp_customize->add_setting("total_plus_slider_bs_height_tablet", array(
    'sanitize_callback' => 'total_plus_sanitize_number_blank',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("total_plus_slider_bs_height_mobile", array(
    'sanitize_callback' => 'total_plus_sanitize_number_blank',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Slider_Control($wp_customize, "total_plus_slider_bs_height", array(
    'section' => "total_plus_slider_section",
    'label' => esc_html__('Bottom Seperator Height (px)', 'total-plus'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 200,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "total_plus_slider_bs_height",
        'tablet' => "total_plus_slider_bs_height_tablet",
        'mobile' => "total_plus_slider_bs_height_mobile",
    ),
    'priority' => 140
)));

$wp_customize->selective_refresh->add_partial('total_plus_sliders', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_transition', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_pause', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_height_type', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_height_tablet', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_height_mobile', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_height', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_autoplay', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_arrow', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_dots', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_slider_bottom_seperator', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_banner_button_link', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_banner_parallax_effect', array(
    'selector' => '#ht-home-slider-section',
    'render_callback' => 'total_plus_slider_section',
    'container_inclusive' => true
));
