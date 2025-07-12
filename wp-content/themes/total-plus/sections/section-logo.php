<?php

/**
 *
 * @package Total Plus
 */
function total_plus_logo_section() {
    if (get_theme_mod('total_plus_logo_section_disable') != 'on') {
        ?>
        <section id="ht-logo-section" class="ht-section ht-logo-section" <?php echo total_parallax_background('logo'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('logo'); ?>
                <div class="ht-container">
                    <?php total_plus_logo_title(); ?>
                    <div class="ht-logo-content ht-section-content">
                        <?php total_plus_logo_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('logo'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_logo_title() {
    $total_plus_logo_title_style = get_theme_mod('total_plus_logo_title_style', 'ht-section-title-top-center');
    $total_plus_logo_super_title = get_theme_mod('total_plus_logo_super_title');
    $total_plus_logo_title = get_theme_mod('total_plus_logo_title', esc_html__('Client Logo Section', 'total-plus'));
    $total_plus_logo_sub_title = get_theme_mod('total_plus_logo_sub_title', esc_html__('Client Logo Section SubTitle', 'total-plus'));

    if ($total_plus_logo_title || $total_plus_logo_sub_title || $total_plus_logo_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_logo_title_style); ?>">
            <?php if ($total_plus_logo_title || $total_plus_logo_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_logo_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_logo_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_logo_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_logo_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_logo_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_logo_sub_title)); ?>
                    </div>
                    <?php
                }

                if ($total_plus_logo_title_style == 'ht-section-title-single-row') {
                    $button_text = get_theme_mod('total_plus_logo_button_text');
                    $button_link = get_theme_mod('total_plus_logo_button_link');
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

function total_plus_logo_content() {
    $total_plus_logo_style = get_theme_mod('total_plus_logo_style', 'style1');
    $total_plus_logos = json_decode(get_theme_mod('total_plus_logo'));
    $total_plus_logo_new_tab = get_theme_mod('total_plus_logo_new_tab', true);
    $target = $total_plus_logo_new_tab ? '_blank' : '_self';
    $total_plus_logo_title_style = get_theme_mod('total_plus_logo_title_style', 'ht-section-title-top-center');

    echo '<div class="' . $total_plus_logo_style . '">';
    if (!empty($total_plus_logos)) {
        if ($total_plus_logo_style == 'style1') {
            ?>
            <div class="ht-logo-carousel owl-carousel">
                <?php
                foreach ($total_plus_logos as $total_plus_logo) {
                    $enable = $total_plus_logo->enable;
                    $logo_link = $total_plus_logo->link;
                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($total_plus_logo->image), esc_html__('Logo', 'total-plus'));
                    if ($enable == 'on') {
                        if (!empty($logo_link)) {
                            ?>
                            <a href="<?php echo esc_url($logo_link) ?>" target="<?php echo esc_attr($target) ?>"><img src="<?php echo esc_url($total_plus_logo->image); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo esc_url($total_plus_logo->image); ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
                            <?php
                        }
                    }
                }
                ?>
            </div>
        <?php } elseif ($total_plus_logo_style == 'style2') {
            ?>
            <div class="ht-logo-carousel">
                <ul>
                    <?php
                    foreach ($total_plus_logos as $total_plus_logo) {
                        $enable = $total_plus_logo->enable;
                        $logo_link = $total_plus_logo->link;
                        $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($total_plus_logo->image), esc_html__('Logo', 'total-plus'));
                        if ($enable == 'on') {
                            if (!empty($logo_link)) {
                                ?>
                                <li><a href="<?php echo esc_url($logo_link) ?>" target="<?php echo esc_attr($target) ?>"><img src="<?php echo esc_url($total_plus_logo->image); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a></li>
                                <?php
                            } else {
                                ?>
                                <li><img src="<?php echo esc_url($total_plus_logo->image); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
        } elseif ($total_plus_logo_style == 'style3' || $total_plus_logo_style == 'style4') {
            ?>
            <div class="ht-logo-grid">
                <?php
                $i = 0;
                $logo_count = count($total_plus_logos);
                $last_logo_count = $logo_count % 4;
                if ($last_logo_count == 0) {
                    $last_logo_count = 4;
                }

                foreach ($total_plus_logos as $total_plus_logo) {
                    $enable = $total_plus_logo->enable;
                    $logo_link = $total_plus_logo->link;
                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($total_plus_logo->image), esc_html__('Logo', 'total-plus'));

                    if ($enable == 'on') {
                        $i++;
                        if (($logo_count - $i) < $last_logo_count) {
                            $class = 'last-row';
                        } else {
                            $class = '';
                        }

                        if (!empty($logo_link)) {
                            ?>
                            <div class="ht-logo-item <?php echo esc_attr($class); ?>"><a href="<?php echo esc_url($logo_link) ?>" target="<?php echo esc_attr($target) ?>"><img src="<?php echo esc_url($total_plus_logo->image); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></a></div>
                            <?php
                        } else {
                            ?>
                            <div class="ht-logo-item <?php echo esc_attr($class); ?>"><img src="<?php echo esc_url($total_plus_logo->image); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"></div>
                                <?php
                            }
                        }
                    }
                    ?>
            </div>
            <?php
        }
    }
    echo '</div>';

    if ($total_plus_logo_title_style != 'ht-section-title-single-row') {
        $button_text = get_theme_mod('total_plus_logo_button_text');
        $button_link = get_theme_mod('total_plus_logo_button_link');

        if ($button_text && $button_link) {
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
