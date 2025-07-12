<?php

/**
 *
 * @package Total Plus
 */
function total_plus_portfolio_section() {
    if (get_theme_mod('total_plus_portfolio_section_disable') != 'on') {
        ?>
        <section id="ht-portfolio-section" class="ht-section ht-portfolio-section" <?php echo total_parallax_background('portfolio'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('portfolio'); ?>
                <div class="ht-portfolio-container-wrap">
                    <div class="ht-container">
                        <?php
                        total_plus_portfolio_title();
                        ?>
                    </div>

                    <div class="ht-portfolio-content ht-section-content ht-portfolio-masonary-wrap">
                        <?php
                        total_plus_portfolio_content();
                        ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('portfolio'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_portfolio_title() {
    $total_plus_portfolio_title_style = get_theme_mod('total_plus_portfolio_title_style', 'ht-section-title-top-center');
    $total_plus_portfolio_super_title = get_theme_mod('total_plus_portfolio_super_title');
    $total_plus_portfolio_title = get_theme_mod('total_plus_portfolio_title', esc_html__('Portfolio Section', 'total-plus'));
    $total_plus_portfolio_sub_title = get_theme_mod('total_plus_portfolio_sub_title', esc_html__('Portfolio Section SubTitle', 'total-plus'));

    if ($total_plus_portfolio_title || $total_plus_portfolio_sub_title || $total_plus_portfolio_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_portfolio_title_style); ?>">
            <?php if ($total_plus_portfolio_title || $total_plus_portfolio_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_portfolio_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_portfolio_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_portfolio_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_portfolio_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_portfolio_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_portfolio_sub_title)); ?>
                    </div>
                    <?php
                }

                if ($total_plus_portfolio_title_style == 'ht-section-title-single-row') {
                    $button_text = get_theme_mod('total_plus_portfolio_button_text');
                    $button_link = get_theme_mod('total_plus_portfolio_button_link');
                    if ($button_text && $button_link) {
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

function total_plus_portfolio_content() {
    $total_plus_portfolio_style = get_theme_mod('total_plus_portfolio_style', 'style1');
    $total_plus_portfolio_full_width = get_theme_mod('total_plus_portfolio_full_width', false);
    $portfolio_container_class = $total_plus_portfolio_full_width ? 'ht-fullwidth-container' : '';
    $total_plus_portfolio_title_style = get_theme_mod('total_plus_portfolio_title_style', 'ht-section-title-top-center');

    $portfolio_class = array(
        'ht-portfolio-post-wrap',
        $total_plus_portfolio_style
    );

    $total_plus_portfolio_cat = get_theme_mod('total_plus_portfolio_cat');
    $total_plus_portfolio_active_cat = get_theme_mod('total_plus_portfolio_active_cat', '*');
    $total_active_tab = ($total_plus_portfolio_active_cat == '*') ? '*' : '.total-portfolio-' . $total_plus_portfolio_active_cat;
    $total_plus_portfolio_cat_menu = get_theme_mod('total_plus_portfolio_cat_menu', true);
    $total_plus_portfolio_tab_style = get_theme_mod('total_plus_portfolio_tab_style', 'style1');

    if ($total_plus_portfolio_cat && $total_plus_portfolio_cat_menu) {
        $total_plus_portfolio_cat_array = explode(',', $total_plus_portfolio_cat);
        $total_plus_portfolio_show_all = get_theme_mod('total_plus_portfolio_show_all', true);
        ?>
        <div class="ht-portfolio-cat-name-list <?php echo $total_plus_portfolio_tab_style; ?>">
            <div class="ht-container">
                <div class="ht-portfolio-switch">
                    <i class="flaticon-menu-4"></i>
                </div>

                <div class="ht-portfolio-cat-wrap" data-active="<?php echo $total_active_tab; ?>">
                    <?php if ($total_plus_portfolio_show_all) { ?>
                        <div class="ht-portfolio-cat-name" data-filter="*">
                            <?php _e('All', 'total-plus'); ?>
                        </div>
                        <?php
                    }

                    foreach ($total_plus_portfolio_cat_array as $total_plus_portfolio_cat_single) {
                        $category_slug = "";
                        $category_slug = '.total-portfolio-' . $total_plus_portfolio_cat_single;
                        $term = get_term($total_plus_portfolio_cat_single, 'portfolio_type');
                        if (!empty($term) && !is_wp_error($term)) {
                            $term_name = esc_html($term->name);
                            ?>
                            <div class="ht-portfolio-cat-name" data-filter="<?php echo esc_attr($category_slug); ?>">
                                <?php echo esc_html($term_name); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    $total_plus_portfolio_gutter = get_theme_mod('total_plus_portfolio_gap', true);
    ?>

    <div class="<?php echo esc_attr(implode(' ', $portfolio_class)); ?>" data-gutter="<?php echo $total_plus_portfolio_gutter; ?>">
        <div class="ht-container <?php echo esc_attr($portfolio_container_class); ?>">
            <div class="ht-portfolio-posts">
                <?php
                if ($total_plus_portfolio_cat) {
                    $total_plus_portfolio_cat_array = explode(',', $total_plus_portfolio_cat);
                    $enable_zoom_button = get_theme_mod('total_plus_portfolio_zoom', true);
                    $enable_link_button = get_theme_mod('total_plus_portfolio_link', true);
                    $orderby = get_theme_mod('total_plus_portfolio_orderby', 'date');
                    $order = get_theme_mod('total_plus_portfolio_order', 'DESC');

                    $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => -1,
                        'order' => $order,
                        'orderby' => $orderby,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_type',
                                'field' => 'id',
                                'terms' => $total_plus_portfolio_cat_array,
                            ),
                        ),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()):
                        while ($query->have_posts()) : $query->the_post();

                            $categories = get_the_terms(get_the_ID(), 'portfolio_type');
                            $category_slug = "";
                            $cat_slug = array();

                            foreach ($categories as $category) {
                                $cat_slug[] = 'total-portfolio-' . $category->term_id;
                            }

                            $category_slug = implode(" ", $cat_slug);

                            if (has_post_thumbnail()) {
                                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-600x600');
                                $total_plus_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            } else {
                                $total_plus_image = "";
                            }
                            ?>
                            <div class="ht-portfolio <?php echo esc_attr($category_slug); ?>">
                                <div class="ht-portfolio-outer-wrap">
                                    <div class="ht-portfolio-wrap" style="background-image: url(<?php echo esc_url($total_plus_image[0]) ?>);">
                                        <div class="ht-portfolio-caption">
                                            <h5><?php the_title(); ?></h5>

                                            <?php
                                            if ($enable_link_button) {
                                                $total_plus_portfolio_link = get_permalink();
                                                $total_plus_external_link = rwmb_meta('external_link');
                                                $total_plus_target = '_self';

                                                if ($total_plus_external_link) {
                                                    $total_plus_portfolio_link = $total_plus_external_link;
                                                    $total_plus_external_link_new_tab = rwmb_meta('external_link_new_tab');
                                                    $total_plus_target = $total_plus_external_link_new_tab ? '_blank' : '_self';
                                                }
                                                ?>
                                                <a target="<?php echo esc_attr($total_plus_target); ?>" class="ht-portfolio-link" href="<?php echo esc_url($total_plus_portfolio_link); ?>"><i class="icofont-link"></i></a>
                                            <?php } ?>

                                            <?php if (has_post_thumbnail() && $enable_zoom_button) { ?>
                                                <a class="ht-portfolio-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($total_plus_image_large[0]) ?>"><i class="icofont-search-1"></i></a>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    if ($total_plus_portfolio_title_style != 'ht-section-title-single-row') {
        $button_text = get_theme_mod('total_plus_portfolio_button_text');
        $button_link = get_theme_mod('total_plus_portfolio_button_link');

        if ($button_text && $button_link) {
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
