<?php

/**
 *
 * @package Total Plus
 */
function total_plus_customa_section() {
    if (get_theme_mod('total_plus_customa_section_disable') != 'on') {
        ?>
        <section id="ht-customa-section" class="ht-section ht-customa-section" <?php echo total_parallax_background('customa'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('customa'); ?>
                <div class="ht-container ht-customa-container ht-clearfix">
                    <?php
                    total_plus_customa_title();
                    ?>
                    <div class="ht-customa-content ht-section-content">
                        <?php
                        total_plus_customa_content();
                        ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('customa'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_customa_title() {
    $total_plus_customa_title_style = get_theme_mod('total_plus_customa_title_style', 'ht-section-title-top-center');
    $total_plus_customa_super_title = get_theme_mod('total_plus_customa_super_title');
    $total_plus_customa_title = get_theme_mod('total_plus_customa_title', esc_html__('Custom A Section', 'total-plus'));
    $total_plus_customa_sub_title = get_theme_mod('total_plus_customa_sub_title', esc_html__('Custom A Section SubTitle', 'total-plus'));

    if ($total_plus_customa_title || $total_plus_customa_sub_title || $total_plus_customa_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_customa_title_style); ?>">
            <?php if ($total_plus_customa_title || $total_plus_customa_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_customa_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_customa_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_customa_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_customa_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_customa_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_customa_sub_title)); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}

function total_plus_customa_content() {
    $total_plus_page = get_theme_mod('total_plus_customa_page');
    $page_on_front = get_option('page_on_front');
    $page_for_posts = get_option('page_for_posts');

    if ($total_plus_page) {

        if ($total_plus_page == $page_on_front) {
            esc_html_e('You can not choose the page that is set as the Homepage in Settings > Reading. Please choose another Page', 'total-plus');
        } else if ($total_plus_page == $page_for_posts) {
            esc_html_e('You can not choose the page that is set as the Posts page in Settings > Reading. Please choose another Page', 'total-plus');
        } else {
            // Get ID
            $get_id = $total_plus_page;
            if (function_exists('pll_get_post')) {
                $get_id = pll_get_post($get_id);
            }
            // Check if page is Elementor page
            $elementor = get_post_meta($get_id, '_elementor_edit_mode', true);
            $siteorigin = get_post_meta($get_id, 'panels_data', true);

            // If Elementor
            if (TOTAL_PLUS_ELEMENTOR_ACTIVE && $elementor) {
                echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($get_id);
            }

            // If Beaver Builder
            else if (TOTAL_PLUS_BEAVER_BUILDER_ACTIVE && !empty($get_id)) {
                echo do_shortcode('[fl_builder_insert_layout id="' . $get_id . '"]');
            }

            // If Site Origin
            else if (TOTAL_PLUS_SITEORIGIN_ACTIVE && !empty($get_id) && $siteorigin) {
                echo SiteOrigin_Panels::renderer()->render($get_id);
            } else {

                $template_id = get_post($get_id);

                if ($template_id && !is_wp_error($template_id)) {
                    $content = $template_id->post_content;
                }
                // Display template content
                echo apply_filters('the_content', $content);
            }
        }
    }
}
