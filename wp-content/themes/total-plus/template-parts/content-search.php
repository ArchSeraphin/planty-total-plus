<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package Total Plus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('total-hentry'); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        echo wp_trim_words(strip_shortcodes(get_the_content()), 130);
        ?>
    </div><!-- .entry-content -->

    <div class="entry-readmore">
        <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'total-plus'); ?></a>
    </div>

</article><!-- #post-## -->

