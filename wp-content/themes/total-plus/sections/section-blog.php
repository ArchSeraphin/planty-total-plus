<?php

/**
 *
 * @package Total Plus
 */
function total_plus_blog_section() {
    if (get_theme_mod('total_plus_blog_section_disable') != 'on') {
        ?>
        <section id="ht-blog-section" class="ht-section ht-blog-section" <?php echo total_parallax_background('blog'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('blog'); ?>
                <div class="ht-container ht-blog-container ht-clearfix">
                    <?php total_plus_blog_title(); ?>
                    <div class="ht-blog-content ht-section-content">
                        <?php total_plus_blog_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('blog'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_blog_title() {
    $total_plus_blog_title_style = get_theme_mod('total_plus_blog_title_style', 'ht-section-title-top-center');
    $total_plus_blog_super_title = get_theme_mod('total_plus_blog_super_title');
    $total_plus_blog_title = get_theme_mod('total_plus_blog_title', esc_html__('Blog Section', 'total-plus'));
    $total_plus_blog_sub_title = get_theme_mod('total_plus_blog_sub_title', esc_html__('Blog Section SubTitle', 'total-plus'));
    
    if ($total_plus_blog_title || $total_plus_blog_sub_title || $total_plus_blog_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_blog_title_style); ?>">
            <?php if ($total_plus_blog_title || $total_plus_blog_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_blog_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_blog_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_blog_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_blog_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <div class="ht-section-tagline">
            <?php if ($total_plus_blog_sub_title) { ?>
                <div class="ht-section-tagline-text">
                <?php echo wp_kses_post(wpautop($total_plus_blog_sub_title)); ?>
                </div>
            <?php } 

            if( $total_plus_blog_title_style == 'ht-section-title-single-row' || $total_plus_blog_title_style == 'ht-section-title-side' ){
                $button_text = get_theme_mod('total_plus_blog_button_text');
                $button_link = get_theme_mod('total_plus_blog_button_link');
                if( $button_text && $button_link){
                    echo '<div class="ht-section-button">';
                    echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
                    echo '</div>';
                }
            }
            ?>
            </div>
        </div>
        <?php
    }
}

function total_plus_blog_content() {
    $total_plus_blog_style = get_theme_mod('total_plus_blog_style', 'style1');
    $total_plus_blog_col = get_theme_mod('total_plus_blog_col', '3');
    $total_plus_blog_title_style = get_theme_mod('total_plus_blog_title_style', 'ht-section-title-top-center');
    $blog_class = array(
        $total_plus_blog_style,
        'ht-blog-col-' . $total_plus_blog_col,
        'ht-blog-wrap',
        'ht-clearfix'
    );
    ?>

    <div class="<?php echo esc_attr(implode(' ', $blog_class)); ?>">
        <?php
        $total_plus_blog_post_count = get_theme_mod('total_plus_blog_post_count', 3);
        $total_plus_blog_cat_exclude = get_theme_mod('total_plus_blog_cat_exclude');
        $total_plus_blog_cat_exclude_array = explode(',', $total_plus_blog_cat_exclude);
        $total_plus_blog_show_date = get_theme_mod('total_plus_blog_show_date', true);
        $total_plus_blog_show_author_comment = get_theme_mod('total_plus_blog_show_author_comment', true);
        $total_plus_blog_excerpt_count = get_theme_mod('total_plus_blog_excerpt_count', 190);

        $args = array(
            'posts_per_page' => absint($total_plus_blog_post_count),
            'category__not_in' => $total_plus_blog_cat_exclude_array
        );
        $query = new WP_Query($args);

        if ($query->have_posts() && $total_plus_blog_style == 'style1') {
            while ($query->have_posts()) : $query->the_post();
                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-400x280');
                $image_alt_text = total_plus_get_image_alt(get_post_thumbnail_id(), get_the_title());
                ?>
                <div class="ht-blog-post ht-clearfix">
                    <?php
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="ht-blog-thumbnail">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_plus_image[0]) ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a>
                            <?php if($total_plus_blog_show_author_comment){ ?>
                                <div class="ht-blog-footer">
                                    <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                    <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="ht-blog-excerpt">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <?php if ($total_plus_blog_show_date) { ?>
                            <div class="ht-blog-date"><i class="mdi mdi-calendar-text"></i><?php echo get_the_date(); ?></div>
                        <?php } ?>
                        
                        <div class="ht-blog-excerpt-text">
                        <?php
                        if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo total_plus_excerpt(get_the_content(), $total_plus_blog_excerpt_count);
                        }
                        ?>
                        </div>
                    </div>

                    <div class="ht-blog-read-more">
                        <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'total-plus'); ?></a>
                    </div>
                </div>
                <?php
            endwhile;
        } elseif ($query->have_posts() && $total_plus_blog_style == 'style2') {
            while ($query->have_posts()) : $query->the_post();
                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-400x280');
                $image_alt_text = total_plus_get_image_alt(get_post_thumbnail_id(), get_the_title());
                ?>
                <div class="ht-blog-post ht-clearfix">
                    <?php
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="ht-blog-thumbnail">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_plus_image[0]) ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="ht-blog-excerpt">
                        <?php if ($total_plus_blog_show_date) { ?>
                            <div class="ht-blog-date"><?php echo get_the_date(); ?></div>
                        <?php } ?>

                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        
                        <div class="ht-blog-excerpt-text">
                        <?php
                        if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo total_plus_excerpt(get_the_content(), $total_plus_blog_excerpt_count);
                        }
                        ?>
                        </div>
                    </div>

                    <?php if($total_plus_blog_show_author_comment){ ?>
                    <div class="ht-blog-footer">
                        <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                        <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                    </div>
                    <?php } ?>
                </div>
                <?php
            endwhile;
        } elseif ($query->have_posts() && $total_plus_blog_style == 'style3') {
            if ($total_plus_blog_show_date) {
                $class = '';
            } else {
                $class = 'ht-full-width';
            }
            while ($query->have_posts()) : $query->the_post();
                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-400x280');
                $image_alt_text = total_plus_get_image_alt(get_post_thumbnail_id(), get_the_title());
                ?>
                <div class="ht-blog-post ht-clearfix">
                    <?php
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="ht-blog-thumbnail">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_plus_image[0]) ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a>

                            <?php if($total_plus_blog_show_author_comment){ ?>
                            <div class="ht-blog-footer">
                                <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="ht-blog-excerpt <?php echo esc_attr($class); ?>">
                        <?php if ($total_plus_blog_show_date) { ?>
                            <div class="ht-blog-date">
                                <span><?php echo get_the_date('d'); ?></span>
                                <span><?php echo get_the_date('M'); ?></span>
                                <span><?php echo get_the_date('Y'); ?></span>	
                            </div>
                        <?php } ?>

                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        
                        <div class="ht-blog-excerpt-text">
                        <?php
                        if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo total_plus_excerpt(get_the_content(), $total_plus_blog_excerpt_count);
                        }
                        ?>
                        </div>
                    </div>

                </div>
                <?php
            endwhile;
        } elseif ($query->have_posts() && $total_plus_blog_style == 'style4') {
            while ($query->have_posts()) : $query->the_post();
                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-400x280');
                $image_alt_text = total_plus_get_image_alt(get_post_thumbnail_id(), get_the_title());
                ?>
                <div class="ht-blog-post">
                    <?php
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="ht-blog-thumbnail">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_plus_image[0]) ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a>

                            <div class="ht-blog-excerpt">
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

                                <?php if ($total_plus_blog_show_date) { ?>
                                    <div class="ht-blog-date"><?php echo get_the_date(); ?></div>
                                <?php } ?>	
                            </div>

                            <?php if($total_plus_blog_show_author_comment){ ?>
                            <div class="ht-blog-footer">
                                <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            endwhile;
        }
        wp_reset_postdata();
        ?>
    </div>
    <?php

    if( $total_plus_blog_title_style != 'ht-section-title-single-row' && $total_plus_blog_title_style != 'ht-section-title-side' ){
        $button_text = get_theme_mod('total_plus_blog_button_text');
        $button_link = get_theme_mod('total_plus_blog_button_link');

        if( $button_text && $button_link){
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
