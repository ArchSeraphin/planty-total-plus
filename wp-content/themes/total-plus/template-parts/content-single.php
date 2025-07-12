<?php
/**
 * Template part for displaying single posts.
 *
 * @package Total Plus
 */
$total_plus_single_post_top_elements = get_theme_mod('total_plus_single_post_top_elements', array('post_meta', 'featured_image', 'content', 'category', 'tag', 'social_share'));
$content_display_featured_image = rwmb_meta('content_display_featured_image');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    $sub_title = rwmb_meta('sub_title');
    $total_plus_show_title = get_theme_mod('total_plus_show_title', true);
    $content_display_title = rwmb_meta('content_display_title');
    ?>
    
    <header class="entry-header">
        <?php
        the_title(sprintf('<h1 class="entry-title">', esc_url(get_permalink())), '</h1>');
        if ($sub_title) {
            ?>
            <div class="ht-sub-title"><?php echo wp_kses_post($sub_title); ?></div>
            <?php
        }
        ?>
    </header><!-- .entry-header -->

    <?php
    foreach ($total_plus_single_post_top_elements as $element) {
        $function_name = "total_plus_single_{$element}";
        $function_name();
    }
    ?>
</article><!-- #post-## -->
