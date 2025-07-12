<?php
/**
 * Template Name: Home Page
 *
 * @package Total Plus
 */
$customizer_home_settings = of_get_option('customizer_home_settings', '1');

get_header();
if ($customizer_home_settings) {

    $total_plus_home_sections = total_plus_frontpage_sections();

    total_plus_slider_section();

    foreach ($total_plus_home_sections as $total_plus_home_section) {
        $total_plus_home_section();
    }
} else {
    $hide_titlebar = rwmb_meta('hide_titlebar');

    if (!$hide_titlebar) {
        $total_plus_show_title = get_theme_mod('total_plus_show_title', true);
        $sub_title = rwmb_meta('sub_title');
        $page_overwrite_defaults = rwmb_meta('page_overwrite_defaults');
        $titlebar_background = rwmb_meta('titlebar_background');
        $parallax = '';

        if ($page_overwrite_defaults && isset($titlebar_background['titlebar_bg_image'])) {
            $parallax = isset($titlebar_background['enable_parallax_effect']) ? 'data-pllx-bg-ratio="0.2"' : '';
        }
        ?>
        <header class="ht-main-header" <?php echo $parallax; ?>>
            <div class="ht-container">
                <?php
                if ($total_plus_show_title) {
                    the_title('<h1 class="ht-main-title">', '</h1>');

                    if ($sub_title) {
                        ?>
                        <div class="ht-sub-title"><?php echo wp_kses_post($sub_title); ?></div>
                        <?php
                    }
                }

                do_action('total_plus_breadcrumbs');
                ?>
            </div>
        </header><!-- .entry-header -->
        <?php
    }

    $container_class = array('ht-main-content', 'ht-clearfix');

    $content_width = rwmb_meta('content_width');
    if (!($content_width) || $content_width == 'container') {
        $container_class[] = 'ht-container';
    }
    ?>
    <div class="<?php echo implode(' ', $container_class); ?>">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content', 'page'); ?>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; // End of the loop.  ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
    <?php
}
get_footer();
