<?php
/**
 * Template Name: Blank Template(For Page Builders)
 *
 * @package Total Plus
 */
get_header();

$container_class = array('ht-main-content', 'ht-clearfix');

$content_width = rwmb_meta('content_width');
if (!($content_width) || $content_width == 'container') {
    $container_class[] = 'ht-container';
}
?>
<div class="<?php echo implode(' ', $container_class); ?>">
    <div class="content-area">
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; // End of the loop.  ?>

        </main><!-- #main -->
    </div><!-- #primary -->
</div>

<?php
get_footer();
