<?php

/**
 *
 * @package Total Plus
 */
function total_plus_highlight_section() {
    if (get_theme_mod('total_plus_highlight_section_disable') != 'on') {
        ?>
        <section id="ht-highlight-section" class="ht-section ht-highlight-section" <?php echo total_parallax_background('highlight'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('highlight'); ?>
                <div class="ht-container ht-highlight-container ht-clearfix">
                    <?php total_plus_highlight_title(); ?>
                    <div class="ht-highlight-content ht-section-content">
                        <?php total_plus_highlight_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('highlight'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_highlight_title() {
    $total_plus_highlight_title_style = get_theme_mod('total_plus_highlight_title_style', 'ht-section-title-top-center');
    $total_plus_highlight_super_title = get_theme_mod('total_plus_highlight_super_title');
    $total_plus_highlight_title = get_theme_mod('total_plus_highlight_title', esc_html__('Highlight Section', 'total-plus'));
    $total_plus_highlight_sub_title = get_theme_mod('total_plus_highlight_sub_title', esc_html__('Highlight Section SubTitle', 'total-plus'));

    if ($total_plus_highlight_title || $total_plus_highlight_sub_title || $total_plus_highlight_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_highlight_title_style); ?>">
            <?php if ($total_plus_highlight_title || $total_plus_highlight_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_highlight_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_highlight_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_highlight_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_highlight_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_highlight_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_highlight_sub_title)); ?>
                    </div>
                    <?php
                }

                if ($total_plus_highlight_title_style == 'ht-section-title-single-row' || $total_plus_highlight_title_style == 'ht-section-title-side') {
                    $button_text = get_theme_mod('total_plus_highlight_button_text');
                    $button_link = get_theme_mod('total_plus_highlight_button_link');
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

function total_plus_highlight_content() {
    $total_plus_highlight_col = get_theme_mod('total_plus_highlight_col', 3);
    $total_plus_highlight_style = get_theme_mod('total_plus_highlight_style', 'style1');
    $total_plus_highlight_title_style = get_theme_mod('total_plus_highlight_title_style', 'ht-section-title-top-center');

    $highlight_class = array(
        'ht-highlight-post-wrap',
        'ht-highlight-style',
        $total_plus_highlight_style,
        'ht-col-' . $total_plus_highlight_col,
        'ht-clearfix'
    );
    ?>
    <div class="<?php echo implode(' ', $highlight_class) ?>">
        <?php
        $highlight_blocks = json_decode(get_theme_mod('total_plus_highlight'));

        if (!empty($highlight_blocks)) {
            foreach ($highlight_blocks as $highlight_block) {
                $highlight_block_icon = $highlight_block->icon;
                $highlight_block_image = $highlight_block->image;
                $highlight_block_title = !empty($highlight_block->title) ? apply_filters('total_plus_translate_string', $highlight_block->title, 'Highlight Block') : '';
                $highlight_block_content = !empty($highlight_block->content) ? apply_filters('total_plus_translate_string', $highlight_block->content, 'Highlight Block') : '';
                $highlight_block_link_text = !empty($highlight_block->link_text) ? apply_filters('total_plus_translate_string', $highlight_block->link_text, 'Highlight Block') : esc_html__('Read More', 'total-plus');
                $highlight_block_link = !empty($highlight_block->link) ? apply_filters('total_plus_translate_string', $highlight_block->link, 'Highlight Block') : '';
                $highlight_block_enable = $highlight_block->enable;

                if ($highlight_block_enable == 'on') {
                    if ($total_plus_highlight_style == 'style4') {
                        ?>
                        <div class="ht-highlight-post">

                            <div class="ht-highlight-title" style="background-image:url(<?php echo esc_url($highlight_block_image); ?>)">
                                <div class="ht-highlight-title-inner">
                                    <div class="ht-highlight-icon"><i class="<?php echo esc_attr($highlight_block_icon); ?>"></i></div>
                                    <h5><?php echo esc_html($highlight_block_title); ?></h5>
                                </div>
                            </div>

                            <div class="ht-highlight-hover" style="background-image:url(<?php echo esc_url($highlight_block_image); ?>)">
                                <div class="ht-hightlight-hover-inner">
                                    <div class="ht-highlight-excerpt">
                                        <?php echo wp_kses_post($highlight_block_content); ?>
                                    </div>

                                    <?php if (!empty($highlight_block_link)) { ?>
                                        <div class="ht-highlight-link">
                                            <a href="<?php echo esc_url($highlight_block_link); ?>"><?php echo esc_html($highlight_block_link_text); ?><i class="mdi mdi-chevron-right"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="ht-highlight-post">
                            <?php
                            $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($highlight_block_image), $highlight_block_title);
                            ?>
                            <img alt="<?php echo esc_attr($image_alt_text); ?>" src="<?php echo esc_url($highlight_block_image); ?>">

                            <div class="ht-highlight-title">
                                <div class="ht-highlight-title-inner">
                                    <div class="ht-highlight-icon"><i class="<?php echo esc_attr($highlight_block_icon); ?>"></i></div>
                                    <h5><?php echo esc_html($highlight_block_title); ?></h5>
                                </div>
                            </div>

                            <div class="ht-highlight-hover">
                                <?php if ($total_plus_highlight_style == 'style2') { ?>
                                    <div class="ht-highlight-icon"><i class="<?php echo esc_attr($highlight_block_icon); ?>"></i></div>
                                    <h5><?php echo esc_html($highlight_block_title); ?></h5>
                                <?php }
                                ?>

                                <div class="ht-hightlight-hover-inner">
                                    <div class="ht-highlight-excerpt">
                                        <?php echo wp_kses_post($highlight_block_content); ?>
                                    </div>

                                    <?php if (!empty($highlight_block_link)) { ?>
                                        <div class="ht-highlight-link">
                                            <a href="<?php echo esc_url($highlight_block_link); ?>"><?php echo esc_html($highlight_block_link_text); ?><i class="mdi mdi-chevron-right"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
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
    if ($total_plus_highlight_title_style != 'ht-section-title-single-row' && $total_plus_highlight_title_style != 'ht-section-title-side') {
        $button_text = get_theme_mod('total_plus_highlight_button_text');
        $button_link = get_theme_mod('total_plus_highlight_button_link');

        if ($button_text && $button_link) {
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
