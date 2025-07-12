<?php
/**
 * The template for displaying all single posts.
 *
 * @package Total Plus
 */
get_header();

$hide_titlebar = rwmb_meta('hide_titlebar');
$total_plus_single_blog_title = get_theme_mod('total_plus_single_blog_title', esc_html__('Blog Post', 'total-plus'));
$total_plus_single_post_bottom_elements = get_theme_mod('total_plus_single_post_bottom_elements', array('author_box', 'pagination', 'comment', 'related_posts'));

if (!$hide_titlebar) {
    $total_plus_show_title = get_theme_mod('total_plus_show_title', true);
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
                if ('post' === get_post_type()) {
                    echo '<div class="ht-main-title">' . esc_html($total_plus_single_blog_title) . '</div>';
                } else {
                    the_title('<h1 class="ht-main-title">', '</h1>');
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

                <?php get_template_part('template-parts/content', 'single'); ?>

                <?php
                foreach ($total_plus_single_post_bottom_elements as $element) {
                    $total_plus_function_name = "total_plus_single_{$element}";
                    $total_plus_function_name();
                }
                ?>

            <?php endwhile; // End of the loop.  ?>
        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div>

<?php
get_footer();
