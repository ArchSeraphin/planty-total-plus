<?php

/**
 * Front Page
 *
 * @package Total Plus
 */
get_header();

$customizer_home_settings = of_get_option('customizer_home_settings', '1');
$total_plus_enable_frontpage = get_theme_mod('total_plus_enable_frontpage', total_plus_enable_frontpage_default());

if ($total_plus_enable_frontpage && $customizer_home_settings) {
    $total_plus_home_sections = total_plus_frontpage_sections();

    total_plus_slider_section();

    foreach ($total_plus_home_sections as $total_plus_home_section) {
        $total_plus_home_section();
    }
} else {
    if ('posts' == get_option('show_on_front')) {
        include( get_home_template() );
    } else {
        include( get_page_template() );
    }
}
get_footer();
