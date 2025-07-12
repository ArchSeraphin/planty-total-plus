<?php

/**
 * Template part for displaying posts.
 *
 * @package Total Plus
 */
$total_plus_blog_layout = get_theme_mod('total_plus_blog_layout', 'blog-layout1');

switch ($total_plus_blog_layout) {
    case 'blog-layout1':
        get_template_part('template-parts/blog-layout1');
        break;

    case 'blog-layout2':
        get_template_part('template-parts/blog-layout2');
        break;

    case 'blog-layout3':
        get_template_part('template-parts/blog-layout3');
        break;

    case 'blog-layout4':
        get_template_part('template-parts/blog-layout4');
        break;

    default:
        get_template_part('template-parts/blog-layout1');
        break;
}

