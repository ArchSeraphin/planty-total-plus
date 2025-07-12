<?php

/**
 *
 * @package Total Plus
 */
function total_plus_custom_post_types() {
    $labels = array(
        'name' => esc_html_x('Portfolios', 'post type general name', 'total-plus'),
        'singular_name' => esc_html_x('Portfolio', 'post type singular name', 'total-plus'),
        'menu_name' => esc_html_x('Portfolios', 'admin menu', 'total-plus'),
        'name_admin_bar' => esc_html_x('Portfolio', 'add new on admin bar', 'total-plus'),
        'add_new' => esc_html_x('Add New', 'Portfolio', 'total-plus'),
        'add_new_item' => __('Add New Portfolio', 'total-plus'),
        'new_item' => __('New Portfolio', 'total-plus'),
        'edit_item' => __('Edit Portfolio', 'total-plus'),
        'view_item' => __('View Portfolio', 'total-plus'),
        'all_items' => __('All Portfolios', 'total-plus'),
        'search_items' => __('Search Portfolios', 'total-plus'),
        'parent_item_colon' => __('Parent Portfolios:', 'total-plus'),
        'not_found' => __('No Portfolio found.', 'total-plus'),
        'not_found_in_trash' => __('No Portfolios found in Trash.', 'total-plus'),
        'featured_image' => __('Portfolio Image', 'total-plus'),
        'set_featured_image' => __('Set Portfolio Image', 'total-plus'),
        'remove_featured_image' => __('Remove Portfolio Image', 'total-plus'),
        'use_featured_image' => __('Use as Portfolio Image', 'total-plus')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Show Portfolio Items', 'total-plus'),
        'public' => true,
        'rewrite' => array('slug' => 'portfolio', 'with_front' => true),
        'has_archive' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-schedule',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'capability_type' => 'page',
    );

    register_post_type('portfolio', $args);

    $labels = array(
        'name' => esc_html_x('Portfolio Types', 'taxonomy general name', 'total-plus'),
        'singular_name' => esc_html_x('Portfolio Type', 'taxonomy singular name', 'total-plus'),
        'search_items' => __('Search Portfolio Types', 'total-plus'),
        'popular_items' => __('Popular Portfolio Types', 'total-plus'),
        'all_items' => __('All Portfolio Types', 'total-plus'),
        'edit_item' => __('Edit Portfolio Type', 'total-plus'),
        'update_item' => __('Update Portfolio Type', 'total-plus'),
        'add_new_item' => __('Add New Portfolio Type', 'total-plus'),
        'new_item_name' => __('New Portfolio Type Name', 'total-plus'),
        'separate_items_with_commas' => __('Separate portfolio type with commas', 'total-plus'),
        'add_or_remove_items' => __('Add or remove portfolio type', 'total-plus'),
        'choose_from_most_used' => __('Choose from the most used portfolio type', 'total-plus'),
        'not_found' => __('No portfolio type found.', 'total-plus'),
        'menu_name' => __('Portfolio Types', 'total-plus'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'portfolio-cat'),
        'show_in_rest' => true
    );

    register_taxonomy('portfolio_type', 'portfolio', $args);

    $labels = array(
        'name' => esc_html_x('Mega Menus', 'post type general name', 'total-plus'),
        'singular_name' => esc_html_x('Mega Menu', 'post type singular name', 'total-plus'),
        'menu_name' => esc_html_x('Mega Menus', 'admin menu', 'total-plus'),
        'name_admin_bar' => esc_html_x('Mega Menu', 'add new on admin bar', 'total-plus'),
        'add_new' => esc_html_x('Add New', 'Mega Menu', 'total-plus'),
        'add_new_item' => __('Add New Mega Menu', 'total-plus'),
        'new_item' => __('New Mega Menu', 'total-plus'),
        'edit_item' => __('Edit Mega Menu', 'total-plus'),
        'view_item' => __('View Mega Menu', 'total-plus'),
        'all_items' => __('All Mega Menus', 'total-plus'),
        'search_items' => __('Search Mega Menus', 'total-plus'),
        'parent_item_colon' => __('Parent Mega Menus:', 'total-plus'),
        'not_found' => __('No Mega Menu found.', 'total-plus'),
        'not_found_in_trash' => __('No Mega Menu found in Trash.', 'total-plus')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Show Mega Menu Items', 'total-plus'),
        'public' => true,
        'rewrite' => array('slug' => 'ht-mega-menu'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-schedule',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'capability_type' => 'page',
    );

    register_post_type('ht-megamenu', $args);
}

add_action('init', 'total_plus_custom_post_types');
