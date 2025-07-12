<?php
/**
 * Template part for displaying posts.
 *
 * @package Total Plus
 */
$total_plus_archive_content = get_theme_mod('total_plus_archive_content', 'excerpt');
$total_plus_blog_date = get_theme_mod('total_plus_blog_date', true);
$total_plus_blog_author = get_theme_mod('total_plus_blog_author', true);
$total_plus_blog_comment = get_theme_mod('total_plus_blog_comment', true);
$total_plus_blog_category = get_theme_mod('total_plus_blog_category', true);
$total_plus_blog_tag = get_theme_mod('total_plus_blog_tag', true);
$total_plus_archive_excerpt_length = get_theme_mod('total_plus_archive_excerpt_length', '100');
$total_plus_archive_readmore = get_theme_mod('total_plus_archive_readmore', esc_html__('Read More', 'total-plus'));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('total-hentry', 'blog-layout2')); ?>>

    <div class="ht-post-wrapper">
        <?php if (has_post_thumbnail()): ?>
            <figure class="entry-figure">
                <?php
                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-840x420');
                ?>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_plus_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
            </figure>
        <?php endif; ?>

        <div class="entry-body ht-clearfix">
            
            <?php if($total_plus_blog_date || $total_plus_blog_author || $total_plus_blog_comment) { ?>
            <div class="ht-post-info">
                <?php if ('post' == get_post_type() && $total_plus_blog_date) :
                    $post_date = get_the_date('d');
                    $post_month = get_the_date('M');
                    ?>

                    <div class="ht-post-date">
                        <div class="entry-date published updated">
                            <div class="ht-day"><?php echo $post_date; ?></div>
                            <div class="ht-month"><?php echo $post_month; ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="entry-author-comment">
                    <?php
                    if ($total_plus_blog_author) {
                        $avatar = get_avatar(get_the_author_meta('ID'), 48);
                        $author = sprintf(esc_html_x('By %s', 'post author', 'total-plus'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>');
                        echo $avatar;
                        echo '<div class="entry-author"> ' . $author . '</div>';
                    }

                    if ($total_plus_blog_comment) {
                        echo total_plus_comment_link();
                    }
                    ?>
                </div>
            </div><!-- .entry-meta -->
            <?php } ?>

            <div class="ht-post-content">

                <?php if ($total_plus_blog_category || $total_plus_blog_tag) { ?>
                    <div class="entry-meta">
                        <?php
                        if ($total_plus_blog_category) {
                            echo total_plus_entry_category();
                        }

                        if ($total_plus_blog_tag) {
                            echo total_plus_entry_tag();
                        }
                        ?>
                    </div>
                <?php } ?>

                <header class="entry-header">
                    <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    if ($total_plus_archive_content == 'excerpt') {
                        echo wp_trim_words(strip_shortcodes(get_the_content()), $total_plus_archive_excerpt_length);
                    } else {
                        the_content();
                    }
                    ?>
                </div><!-- .entry-content -->

                <?php if ($total_plus_archive_content == 'excerpt') { ?>
                    <div class="entry-readmore">
                        <a href="<?php the_permalink(); ?>"><?php echo $total_plus_archive_readmore; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->