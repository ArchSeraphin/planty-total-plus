<?php
/**
 * The template for displaying 404 pages (not found).
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
            ?>
            <h1 class="ht-main-title"><?php esc_html_e('404 Error', 'total-plus'); ?></h1>
            <?php
        }

        do_action('total_plus_breadcrumbs');
        ?>
    </div>
</header><!-- .entry-header -->

<div class="ht-container">
    <div class="oops-text"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'total-plus'); ?></div>
    <span class="error-404"><?php esc_html_e('404', 'total-plus'); ?></span>
</div>

<?php get_footer(); ?>
