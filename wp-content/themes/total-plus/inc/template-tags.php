<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Total Plus
 */
if (!function_exists('total_plus_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function total_plus_posted_on() {
        if ('post' === get_post_type()) {
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf(
                    $time_string, esc_attr(get_the_date(DATE_W3C)), esc_html(get_the_date()), esc_attr(get_the_modified_date(DATE_W3C)), esc_html(get_the_modified_date())
            );
            $posted_on = sprintf(esc_html_x('On %s', 'post date', 'total-plus'), $time_string);

            $avatar = get_avatar(get_the_author_meta('ID'), 32);

            echo $avatar;

            $byline = sprintf(
                    esc_html_x('By %s', 'post author', 'total-plus'), '<span class="author vcard">' . esc_html(get_the_author()) . '</span>'
            );

            $comment_count = get_comments_number(); // get_comments_number returns only a numeric value

            if (comments_open()) {
                if ($comment_count == 0) {
                    $comments = __('0 Comments', 'total-plus');
                } elseif ($comment_count > 1) {
                    $comments = $comment_count . __(' Comments', 'total-plus');
                } else {
                    $comments = __('1 Comment', 'total-plus');
                }
                $comment_link = '<i class="mdi mdi-comment-processing-outline"></i>' . $comments;
            } else {
                $comment_link = "";
            }

            echo '<span class="entry-author"> ' . $byline . '</span><span class="entry-post-date">' . $posted_on . '</span><span class="entry-comment">' . $comment_link . '</span>'; // WPCS: XSS OK.
        }
    }

endif;

if (!function_exists('total_plus_entry_category')) :

    function total_plus_entry_category() {
        $categories_list = get_the_category_list(', ');
        if ($categories_list) {
            echo '<span class="entry-categories">';
            echo '<i class="icofont-folder"></i>' . $categories_list;
            echo '</span>';
        }
    }

endif;

if (!function_exists('total_plus_entry_tag')) :

    function total_plus_entry_tag() {
        $tags_list = get_the_tag_list('<i class="icofont-book-mark"></i>', ', ');
        if ($tags_list) {
            echo '<span class="entry-tags">';
            echo $tags_list;
            echo '</span>';
        }
    }

endif;

if (!function_exists('total_plus_comment_link')) :

    function total_plus_comment_link() {
        $comment_count = get_comments_number(); // get_comments_number returns only a numeric value
        $comment_link = "";

        if (comments_open()) {
            if ($comment_count == 0) {
                $comments = __('0 Comments', 'total-plus');
            } elseif ($comment_count > 1) {
                $comments = $comment_count . __(' Comments', 'total-plus');
            } else {
                $comments = __('1 Comment', 'total-plus');
            }
            $comment_link .= '<span class="entry-comment">';
            $comment_link .= '<i class="mdi mdi-comment-processing-outline"></i><a class="comment-link" href="' . get_comments_link() . '">' . $comments . '</a>';
            $comment_link .= '</span>';
        }

        return $comment_link;
    }

endif;

function total_plus_single_featured_image() {
    if (has_post_thumbnail()) {
        ?>
        <figure class="single-entry-figure">
            <?php
            $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-plus-840x420');
            ?>
            <img src="<?php echo esc_url($total_plus_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
        </figure>
        <?php
    }
}

function total_plus_single_post_meta() {
    if ('post' === get_post_type()) {
        ?>
        <div class="single-entry-meta">
            <?php total_plus_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
    }
}

function total_plus_single_content() {
    ?>
    <div class="single-entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'total-plus'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
    <?php
}

function total_plus_single_category() {
    if ('post' === get_post_type()) {
        $categories_list = get_the_category_list(' ');
        if ($categories_list) {
            echo '<div class="single-entry-footer">';
            echo '<div class="entry-tags">';
            echo '<span class="cat-title"><i class="far fa-folder"></i>' . esc_html__('Categories', 'total-plus') . '</span>';
            echo $categories_list;
            echo '</div>';
            echo '</div>';
        }
    }
}

function total_plus_single_tag() {
    if ('post' === get_post_type()) {
        $tags_list = get_the_tag_list('', '');
        if ($tags_list) {
            echo '<div class="single-entry-footer">';
            echo '<div class="entry-tags">';
            echo '<span class="tags-title"><i class="far fa-bookmark"></i>' . esc_html__('Tags', 'total-plus') . '</span>';
            echo $tags_list;
            echo '</div>';
            echo '</div>';
        }
    }
}

function total_plus_single_social_share() {
    ?>
    <div class="ht-social-share">
        <span><i class="icofont-share"></i><?php esc_html_e('Share', 'total-plus'); ?></span>
            <?php
            total_plus_entry_social_share();
            ?>
    </div>
    <?php
}
