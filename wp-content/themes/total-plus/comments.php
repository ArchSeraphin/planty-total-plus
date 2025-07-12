<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Total Plus
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment!   ?>

    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            printf(// WPCS: XSS OK.
                    esc_html(_nx('One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'total-plus')), number_format_i18n(get_comments_number())
            );
            ?>
        </h3>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?   ?>
            <nav id="comment-nav-above" class="navigation comment-navigation">
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'total-plus')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'total-plus')); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation.   ?>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'callback' => 'total_plus_comment',
                'avatar_size' => 52
            ));
            ?>
        </ul><!-- .comment-list -->

    <?php endif; // Check for have_comments().   ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'total-plus'); ?></p>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

    $fields = array(
        'author' =>
        '<div class="author-email-url ht-clearfix"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Name', 'total-plus') . ( $req ? '*' : '' ) . '" /></p>',
        'email' =>
        '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Email', 'total-plus') . ( $req ? '*' : '' ) . '" /></p>',
        'url' =>
        '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
        '" size="30" placeholder="' . esc_attr__('Website', 'total-plus') . '" /></p></div>',
        'cookies' => 
        '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'total-plus' ) . '</label></p>',
    );


    $args = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr__('Comment', 'total-plus') . '">' .
        '</textarea></p>',
    );
    ?>

    <?php comment_form($args); ?>

</div><!-- #comments -->
