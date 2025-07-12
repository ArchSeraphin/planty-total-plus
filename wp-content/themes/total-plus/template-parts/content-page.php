<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Total Plus
 */
$total_plus_show_title = get_theme_mod('total_plus_show_title', true);
$content_display_title = rwmb_meta('content_display_title');
$content_display_featured_image = rwmb_meta('content_display_featured_image');

if (!$total_plus_show_title && $content_display_title) {
    ?>
    <header class="entry-header">
        <?php the_title(sprintf('<h1 class="entry-title">', esc_url(get_permalink())), '</h1>'); ?>
    </header><!-- .entry-header -->
<?php } elseif ($content_display_title) {
    ?>
    <header class="entry-header">
        <?php the_title(sprintf('<div class="entry-title">', esc_url(get_permalink())), '</div>'); ?>
    </header>
<?php }
?>

<?php if (has_post_thumbnail() && $content_display_featured_image) {
    ?>
    <figure class="entry-figure">
        <?php
        $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-840x420');
        ?>
        <img src="<?php echo esc_url($total_plus_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
    </figure>
<?php }
?>

<div class="entry-content">
    <?php the_content(); ?>
    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'total-plus'),
        'after' => '</div>',
    ));
    ?>
</div><!-- .entry-content -->

