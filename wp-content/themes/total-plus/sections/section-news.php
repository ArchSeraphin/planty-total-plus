<?php

/**
 *
 * @package Total Plus
 */
function total_plus_news_section() {
    if (get_theme_mod('total_plus_news_section_disable') != 'on') {
        $total_plus_news_style = get_theme_mod('total_plus_news_style', 'style1');
        ?>
        <section id="ht-news-section" class="ht-section ht-news-section ht-<?php echo esc_attr($total_plus_news_style) ?>" <?php echo total_parallax_background('news'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('news'); ?>
                <div class="ht-container ht-news-container ht-clearfix">
                    <?php total_plus_news_title(); ?>

                    <div class="ht-newscontent ht-section-content">
                        <?php total_plus_news_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('news'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_news_title() {
    $total_plus_news_title_style = get_theme_mod('total_plus_news_title_style', 'ht-section-title-top-center');
    $total_plus_news_super_title = get_theme_mod('total_plus_news_super_title');
    $total_plus_news_title = get_theme_mod('total_plus_news_title', esc_html__('News and Update Section', 'total-plus'));
    $total_plus_news_sub_title = get_theme_mod('total_plus_news_sub_title', esc_html__('News and Update Section SubTitle', 'total-plus'));

    if ($total_plus_news_title || $total_plus_news_sub_title || $total_plus_news_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_news_title_style); ?>">
            <?php if ($total_plus_news_title || $total_plus_news_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_news_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_news_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_news_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_news_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_news_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_news_sub_title)); ?>
                    </div>
                    <?php
                }

                if ($total_plus_news_title_style == 'ht-section-title-single-row') {
                    $button_text = get_theme_mod('total_plus_news_button_text');
                    $button_link = get_theme_mod('total_plus_news_button_link');
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

function total_plus_news_content() {
    $total_plus_news_style = get_theme_mod('total_plus_news_style', 'style1');
    $total_plus_news_title_style = get_theme_mod('total_plus_news_title_style', 'ht-section-title-top-center');
    $news_class = array(
        $total_plus_news_style,
        'ht-news-wrap',
        'ht-clearfix'
    );
    ?>
    <div class="<?php echo esc_attr(implode(' ', $news_class)); ?>">
        <?php
        $total_plus_news_list = json_decode(get_theme_mod('total_plus_news'));

        if (!empty($total_plus_news_list)) {
            foreach ($total_plus_news_list as $total_plus_news) {
                $title = !empty($total_plus_news->title) ? apply_filters('total_plus_translate_string', $total_plus_news->title, 'News & Update Block') : '';
                $content = !empty($total_plus_news->content) ? apply_filters('total_plus_translate_string', $total_plus_news->content, 'News & Update Block') : '';
                $image = $total_plus_news->image;
                $button_text = !empty($total_plus_news->button_text) ? apply_filters('total_plus_translate_string', $total_plus_news->button_text, 'News & Update Block') : '';
                $button_link = !empty($total_plus_news->button_link) ? apply_filters('total_plus_translate_string', $total_plus_news->button_link, 'News & Update Block') : '';
                $enable = $total_plus_news->enable;

                if ($enable == 'on') {
                    if ($total_plus_news_style == 'style1' || $total_plus_news_style == 'style2') {
                        ?>
                        <div class="ht-news">
                            <?php
                            if (!empty($image)) {
                                $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image), $title);
                                ?>
                                <div class="ht-news-image">
                                    <img src="<?php echo esc_url($image); ?>">
                                </div>
                            <?php } ?>

                            <div class="ht-news-content">
                                <h5><?php echo wp_kses_post($title); ?></h5>

                                <div class="ht-news-text">
                                    <?php
                                    echo wp_kses_post(wpautop($content));
                                    ?>
                                </div>
                                <?php if (!empty($button_text) || !empty($button_link)) { ?>	
                                    <a class="ht-news-link" href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?><i class="mdi mdi-arrow-right"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    } elseif ($total_plus_news_style == 'style3') {
                        ?>
                        <div class="ht-news">
                            <?php
                            if (!empty($image)) {
                                ?>
                                <div class="ht-news-image" style="background-image:url(<?php echo esc_url($image); ?>)">
                                </div>
                            <?php } ?>

                            <div class="ht-news-content">
                                <h5><?php echo wp_kses_post($title); ?></h5>

                                <div class="ht-news-text">
                                    <?php
                                    echo wp_kses_post(wpautop($content));
                                    ?>
                                </div>
                                <?php if (!empty($button_text) || !empty($button_link)) { ?>	
                                    <a class="ht-news-link" href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?><i class="mdi mdi-arrow-right"></i></a>
                                    <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>
    </div>
    <?php
    if ($total_plus_news_title_style != 'ht-section-title-single-row') {
        $button_text = get_theme_mod('total_plus_news_button_text');
        $button_link = get_theme_mod('total_plus_news_button_link');

        if ($button_text && $button_link) {
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
