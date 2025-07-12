<?php
/**
 * The template for displaying all pages.
 *
 * @package Total Plus
 */
get_header();
?>

<div class="ht-main-content ht-container" style="margin-top: 80px">
    <div class="content-area">
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('template-parts/content', 'page'); ?>

            <?php endwhile; // End of the loop.  ?>

        </main><!-- #main -->
    </div><!-- #primary -->
</div>

<?php
get_footer();
