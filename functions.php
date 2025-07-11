<?php
// Enqueue le style parent de manière moderne
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('total-plus-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('total-plus-child-style', get_stylesheet_uri(), array('total-plus-style'));
});

add_filter( 'wp_nav_menu_items', 'ajouter_lien_admin_si_connecte', 10, 2 );

function ajouter_lien_admin_si_connecte( $items, $args ) {
    // Remplacer 'primary' par l'emplacement de ton menu si besoin
    if ( is_user_logged_in() && $args->theme_location == 'primary' ) {
        // URL du panel admin
        $admin_url = admin_url();
        // Créer l'item
        $items .= '<li class="menu-item"><a href="' . esc_url($admin_url) . '">Admin</a></li>';
    }
    return $items;
}
