<?php
/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */

//LAYOUT OPTIONS
$wp_customize->add_section('total_plus_layout_options_section', array(
    'title' => esc_html__('Sidebar Settings Options', 'total-plus'),
    'priority' => 16
));

$wp_customize->add_setting('total_plus_sidebar_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_sidebar_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_layout_options_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Layouts', 'total-plus'),
            'fields' => array(
                'total_plus_page_layout',
                'total_plus_post_layout',
                'total_plus_archive_layout',
                'total_plus_home_blog_layout',
                'total_plus_search_layout',
                'total_plus_shop_layout'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Styles', 'total-plus'),
            'fields' => array(
                'total_plus_sidebar_style'
            ),
        )
    ),
)));


$wp_customize->add_setting('total_plus_page_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_page_layout', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Page Layout', 'total-plus'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to all the General Pages and Portfolio Pages.', 'total-plus'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('total_plus_post_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_post_layout', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Post Layout', 'total-plus'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to all the Posts.', 'total-plus'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('total_plus_archive_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_archive_layout', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Archive Page Layout', 'total-plus'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to all Archive Pages.', 'total-plus'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('total_plus_home_blog_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_home_blog_layout', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Blog Page Layout', 'total-plus'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to Blog Page.', 'total-plus'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('total_plus_search_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_search_layout', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Search Page Layout', 'total-plus'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to Search Page.', 'total-plus'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('total_plus_shop_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_shop_layout', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Shop Page Layout(WooCommerce)', 'total-plus'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to Shop Page, Product Category, Product Tag and all Single Products Pages.', 'total-plus'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('total_plus_sidebar_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'sidebar-style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_sidebar_style', array(
    'section' => 'total_plus_layout_options_section',
    'label' => esc_html__('Sidebar Style', 'total-plus'),
    'class' => 'ht-half-width',
    'options' => array(
        'sidebar-style1' => $imagepath . '/inc/customizer/images/sidebar-style1.png',
        'sidebar-style2' => $imagepath . '/inc/customizer/images/sidebar-style2.png',
        'sidebar-style3' => $imagepath . '/inc/customizer/images/sidebar-style3.png'
    )
)));