<?php

function elementor_widget_list() {
    $avaliable_widgets = array(
        'heading' => esc_html__('Heading', 'total-plus'),
        'slider-block' => esc_html__('Slider', 'total-plus'),
        'progress-bar' => esc_html__('Progress Bar', 'total-plus'),
        'featured-block' => esc_html__('Featured Block', 'total-plus'),
        'service-block' => esc_html__('Service Toggle Block', 'total-plus'),
        'highlight-block' => esc_html__('Highlight Block', 'total-plus'),
        'team-block' => esc_html__('Team Block', 'total-plus'),
        'team-carousel' => esc_html__('Team Carousel', 'total-plus'),
        'testimonial-block' => esc_html__('Testimonial Block', 'total-plus'),
        'testimonial-carousel' => esc_html__('Testimonial Carousel', 'total-plus'),
        'testimonial-slider' => esc_html__('Testimonial Slider', 'total-plus'),
        'counter-block' => esc_html__('Counter Block', 'total-plus'),
        'pricing-block' => esc_html__('Pricing Block', 'total-plus'),
        'news-block' => esc_html__('News Block', 'total-plus'),
        'tab-block' => esc_html__('Tab Block', 'total-plus'),
        'portfolio-masonry' => esc_html__('Portfolio Masonary', 'total-plus'),
        'portfolio-carousel' => esc_html__('Portfolio Carousel', 'total-plus'),
        'blog-section' => esc_html__('Blog Section', 'total-plus'),
        'logo-carousel' => esc_html__('Logo Carousel', 'total-plus'),
        'image-flipster' => esc_html__('Image Flipster Carousel', 'total-plus'),
        'video-popup' => esc_html__('Video PopUp', 'total-plus'),
        'contact-section' => esc_html__('Contact Form With Google Map', 'total-plus'),
    );
    return $avaliable_widgets;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */
function optionsframework_options() {

    $widget_list = total_plus_widget_list();
    $elementor_widget_list = elementor_widget_list();
    $std_widget_list = $std_elementor_widget_list = array();

    foreach ($widget_list as $key => $widget) {
        $std_widget_list[$key] = '1';
    }

    foreach ($elementor_widget_list as $key => $widget) {
        $std_elementor_widget_list[$key] = '1';
    }

    $options = array();

    $options[] = array(
        'name' => __('Customizer Settings', 'total-plus'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('Choose Icon Sets', 'total-plus'),
        'desc' => sprintf(__('These icon set will appear in the %s. Choose the set of icons that you want to use. Choosing all the icon set may slow down the customizer panel.', 'total-plus'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[panel]=total_plus_home_panel') . '">' . esc_html__('Home Page Sections', 'total-plus') . '</a>'),
        'id' => 'customizer_icon_sets',
        'std' => array(
            'ico_font' => '1',
            'font_awesome' => '1',
            'essential_icon' => '1',
            'material_icon' => '1'
        ),
        'type' => 'multicheck',
        'options' => array(
            'ico_font' => __('Icon Font - <a href="https://icofont.com/icons" target="_blank">View Here</a>', 'total-plus'),
            'font_awesome' => __('Font Awesome - <a href="https://fontawesome.com/icons?m=free" target="_blank">View Here</a>', 'total-plus'),
            'essential_icon' => __('Essential Light Icons - <a href="http://www.essential-icons.com/" target="_blank">View Here</a>', 'total-plus'),
            'material_icon' => __('Material Icons - <a href="http://materialdesignicons.com/" target="_blank">View Here</a>', 'total-plus')
        )
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('Maintenance Mode Panel', 'total-plus'),
        'label' => __('Enable/Disable', 'total-plus'),
        'desc' => sprintf(__('If you are not using %s then disabling can increase the loading speed of customizer panel.', 'total-plus'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[section]=total_plus_maintenance_section') . '">' . esc_html__('Maintenance Screen', 'total-plus') . '</a>'),
        'id' => 'customizer_maintenance_mode',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('GDPR Settings Panel', 'total-plus'),
        'label' => __('Enable/Disable', 'total-plus'),
        'desc' => sprintf(__('If you are not using %s then disabling can increase the loading speed of customizer panel.', 'total-plus'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[section]=total_plus_gdpr_section') . '">' . esc_html__('GDPR Option', 'total-plus') . '</a>'),
        'id' => 'customizer_gdpr_settings',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('Disable Home Page Settings Panel', 'total-plus'),
        'label' => __('Enable/Disable', 'total-plus'),
        'desc' => sprintf(__('If you are using page builder instead of %s then disabling can increase the loading speed of customizer panel.', 'total-plus'), '<a target="_blank" href="' . admin_url('customize.php?autofocus[panel]=total_plus_home_panel') . '">' . esc_html__('Customizer Home Page Sections', 'total-plus') . '</a>'),
        'id' => 'customizer_home_settings',
        'std' => '1',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('Widget Settings', 'total-plus'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Widgets', 'total-plus'),
        'desc' => sprintf(__('Enable/Disable the Widgets. This widgets will show in %1$s and SiteOrigin Page Builder if you have installed and activated %2$s', 'total-plus'), '<a target="_blank" href="' . admin_url('/widgets.php') . '">' . esc_html__('Widget Page', 'total-plus') . '</a>', '<a target="_blank" href="https://wordpress.org/plugins/siteorigin-panels/">' . esc_html__('SiteOrigin Page Builder', 'total-plus') . '</a>'),
        'id' => 'enabled_widgets',
        'std' => $std_widget_list,
        'type' => 'multicheck',
        'class' => 'three-col-multicheck',
        'options' => $widget_list
    );

    $options[] = array(
        'name' => __('Elementor Widget Settings', 'total-plus'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Disable Default Fonts and Color in Elementor', 'total-plus'),
        'desc' => sprintf(__('Forcefully disable default font and color in the elementor %s', 'total-plus'), '<a target="_blank" href="' . admin_url('/admin.php?page=elementor') . '">Setting Page</a>'),
        'id' => 'elementor_default_font_color',
        'std' => true,
        'type' => 'checkbox',
        'label' => __('Yes/No', 'total-plus'),
    );

    $options[] = array(
        'name' => __('Available Elementor Widgets', 'total-plus'),
        'desc' => __('List of widgets that will be available when editing the page with Elementor.', 'total-plus'),
        'id' => 'enabled_elementor_widgets',
        'std' => $std_elementor_widget_list,
        'type' => 'multicheck',
        'class' => 'three-col-multicheck',
        'options' => elementor_widget_list()
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('NOTE', 'total-plus'),
        'desc' => sprintf(__('These settings will work only if you have installed and activated the %1$s Plugin. You can install Elementor Plugin %2$s.', 'total-plus'), '<a target="_blank" href="https://wordpress.org/plugins/elementor/">Elementor</a>', '<a href="' . admin_url('/admin.php?page=total-plus-install-plugins') . '">' . esc_html__('here', 'total-plus') . '</a>'),
        'type' => 'info',
        'class' => 'boxed-note'
    );

    $options[] = array(
        'name' => __('API Keys', 'total-plus'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Google Map API Key', 'total-plus'),
        'desc' => sprintf(__('Create own API key. %s', 'total-plus'), '<a target="_blank" href="https://hashthemes.com/articles/creating-a-google-maps-api-key/">' . esc_html__('Guide on creating Google Maps API Key', 'total-plus') . '</a>'),
        'id' => 'api_key',
        'type' => 'text'
    );

    $options[] = array(
        'type' => 'break'
    );

    $options[] = array(
        'name' => __('Instagram Access Token:', 'total-plus'),
        'desc' => sprintf(__('Read more about how to get Instagram Access Token %1$s or %2$s', 'total-plus'), '<a target="_blank" href="https://elfsight.com/blog/2016/05/how-to-get-instagram-access-token/">' . esc_html__('here', 'total-plus') . '</a>', '<a target="_blank" href="https://docs.oceanwp.org/article/487-how-to-get-instagram-access-token">' . esc_html__('here', 'total-plus') . '</a>'),
        'id' => 'insta_access_token',
        'type' => 'text'
    );

    return $options;
}
