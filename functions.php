<?php
// Enqueue le style parent de manière moderne
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('total-plus-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('total-plus-child-style', get_stylesheet_uri(), array('total-plus-style'));

});