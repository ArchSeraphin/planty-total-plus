<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Total Plus
 */
get_header();

$total_plus_show_title = get_theme_mod('total_plus_show_title', true);
?>
<header class="ht-main-header">
    <div class="ht-container">
        <?php
        if ($total_plus_show_title) {
            the_archive_title('<h1 class="ht-main-title">', '</h1>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
        }

        do_action('total_plus_breadcrumbs');
        ?>
    </div>
</header><!-- .entry-header -->

<div class="ht-main-content ht-clearfix ht-container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if (have_posts()) : ?>

                <?php /* Start the Loop */ ?>
                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'summary');
                    ?>

                <?php endwhile; ?>

                <?php
                the_posts_pagination(array(
                    'prev_text' => __('Prev', 'total-plus'),
                    'next_text' => __('Next', 'total-plus'),
                        )
                );
                ?>

            <?php else : ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
