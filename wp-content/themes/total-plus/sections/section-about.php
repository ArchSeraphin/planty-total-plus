<?php

/**
 *
 * @package Total Plus
 */
function total_plus_about_section() {
    if (get_theme_mod('total_plus_about_page_disable') != 'on') {
        ?>
        <section id="ht-about-section" class="ht-section ht-about-section" <?php echo total_parallax_background('about'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('about'); ?>
                <div class="ht-container ht-about-container">
                    <?php total_plus_about_content(); ?>
                </div>
                <?php total_plus_add_bottom_seperator('about'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_about_page() {
    $total_plus_about_page_id = get_theme_mod('total_plus_about_page');
    if ($total_plus_about_page_id) {
        $page_on_front = get_option('page_on_front');
        $page_for_posts = get_option('page_for_posts');

        if ($total_plus_about_page_id == $page_on_front) {
            esc_html_e('You can not choose the page that is set as the Homepage in Settings > Reading. Please choose another Page', 'total-plus');
        } else if ($total_plus_about_page_id == $page_for_posts) {
            esc_html_e('You can not choose the page that is set as the Posts page. Please choose another Page in Settings > Reading', 'total-plus');
        } else {
            $args = array(
                'page_id' => absint($total_plus_about_page_id)
            );
            $query = new WP_Query($args);
            if ($query->have_posts()):
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <h2 class="ht-section-title"><?php the_title(); ?></h2>
                    <div class="ht-about-content">
                        <?php
                        if (has_excerpt() && '' != get_the_excerpt()) {
                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
        }
    }
}

function total_plus_about_sidebar() {
    $total_plus_disable_about_sidebar = get_theme_mod('total_plus_disable_about_sidebar', 'off');
    if ($total_plus_disable_about_sidebar != 'on') {
        ?>
        <div class="ht-about-sidebar">
            <?php
            $total_plus_about_widget = get_theme_mod('total_plus_about_widget');
            if ($total_plus_about_widget) {
                dynamic_sidebar($total_plus_about_widget);
            } else {
                $total_plus_about_image = get_theme_mod('total_plus_about_image');
                if (!empty($total_plus_about_image)) {
                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($total_plus_about_image));
                    echo '<img alt="' . esc_attr($image_alt_text) . '" src="' . esc_url($total_plus_about_image) . '"/>';
                }
            }
            ?>
        </div>
        <?php
    }
}

function total_plus_about_progressbar() {
    $progressbars = json_decode(get_theme_mod('total_plus_progressbar'));
    if (!empty($progressbars)) {
        ?>
        <div class="ht-progress-bar-sec">
            <?php
            foreach ($progressbars as $progressbar) {
                $progressbar_title = !empty($progressbar->title) ? apply_filters('total_plus_translate_string', $progressbar->title, 'Progress Bar') : '';
                $progressbar_percentage = !empty($progressbar->percentage) ? $progressbar->percentage : '';
                $progressbar_enable = $progressbar->enable;
                if ($progressbar_enable == 'on') {
                    ?>
                    <div class="ht-progress">
                        <h6><?php echo esc_html($progressbar_title); ?></h6>
                        <div class="ht-progress-bar" data-width="<?php echo absint($progressbar->percentage); ?>">
                            <div class="ht-progress-bar-length">
                                <span><?php echo absint($progressbar_percentage) . "%"; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}

function total_plus_about_content() {
    $total_plus_disable_about_sidebar = get_theme_mod('total_plus_disable_about_sidebar', 'off');
    $about_sec_class = $total_plus_disable_about_sidebar == 'on' ? 'fullwidth' : '';
    ?>
    <div class="ht-about-sec <?php echo esc_attr($about_sec_class); ?>">

        <div class="ht-about-page">
            <?php total_plus_about_page(); ?>
        </div>

        <div class="ht-progressbar-container">
            <?php total_plus_about_progressbar(); ?>
        </div>

    </div>
    <?php
    total_plus_about_sidebar();
}
