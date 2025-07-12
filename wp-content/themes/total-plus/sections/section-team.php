<?php

/**
 *
 * @package Total Plus
 */
function total_plus_team_section() {
    if (get_theme_mod('total_plus_team_section_disable') != 'on') {
        ?>
        <section id="ht-team-section" class="ht-section ht-team-section" <?php echo total_parallax_background('team'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('team'); ?>
                <div class="ht-container ht-team-container ht-clearfix">
                    <?php
                    total_plus_team_title();
                    ?>
                    <div class="ht-team-content ht-section-content">
                        <?php
                        total_plus_team_content();
                        ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('team'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_team_title() {
    $total_plus_team_title_style = get_theme_mod('total_plus_team_title_style', 'ht-section-title-top-center');
    $total_plus_team_super_title = get_theme_mod('total_plus_team_super_title');
    $total_plus_team_title = get_theme_mod('total_plus_team_title', esc_html__('Team Section', 'total-plus'));
    $total_plus_team_sub_title = get_theme_mod('total_plus_team_sub_title', esc_html__('Team Section SubTitle', 'total-plus'));

    if ($total_plus_team_title || $total_plus_team_sub_title || $total_plus_team_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_team_title_style); ?>">
            <?php if ($total_plus_team_title || $total_plus_team_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_team_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_team_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_team_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_team_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_team_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_team_sub_title)); ?>
                    </div>
                    <?php
                }

                if ($total_plus_team_title_style == 'ht-section-title-single-row' || $total_plus_team_title_style == 'ht-section-title-side') {
                    $button_text = get_theme_mod('total_plus_team_button_text');
                    $button_link = get_theme_mod('total_plus_team_button_link');
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

function total_plus_team_content() {

    $total_plus_team_style = get_theme_mod('total_plus_team_style', 'style1');
    $total_plus_team_col = get_theme_mod('total_plus_team_col', 3);
    $enable_carousel = get_theme_mod('total_plus_team_slider_enable', 'off');

    $class = ($enable_carousel == 'on') ? 'ht-team-carousel owl-carousel' : 'ht-clearfix';
    $total_plus_team_title_style = get_theme_mod('total_plus_team_title_style', 'ht-section-title-top-center');

    $team_class = array(
        'ht-team-member-wrap'
    );

    if ($total_plus_team_style == 'style4') {
        $thumb = 'total-400x400';
    } else {
        $thumb = 'total-350x420';
    }

    $team_class[] = $enable_carousel == 'on' ? '' : 'ht-team-grid ht-team-col-' . $total_plus_team_col;

    $total_plus_teams = json_decode(get_theme_mod('total_plus_team'));
    if (!empty($total_plus_teams)) {
        ?>
        <div class="<?php echo esc_attr(implode(' ', $team_class)) ?>" >
            <div class="<?php echo esc_attr($class); ?>" data-col="<?php echo absint($total_plus_team_col); ?>">
                <?php
                foreach ($total_plus_teams as $total_plus_team) {
                    $enable = $total_plus_team->enable;

                    if ($enable == 'on') {
                        $image = $total_plus_team->image;
                        $name = !empty($total_plus_team->name) ? apply_filters('total_plus_translate_string', $total_plus_team->name, 'Team Block') : '';
                        $designation = !empty($total_plus_team->designation) ? apply_filters('total_plus_translate_string', $total_plus_team->designation, 'Team Block') : '';
                        $content = !empty($total_plus_team->content) ? apply_filters('total_plus_translate_string', $total_plus_team->content, 'Team Block') : '';
                        $facebook_link = $total_plus_team->facebook_link;
                        $twitter_link = $total_plus_team->twitter_link;
                        $instagram_link = isset($total_plus_team->instagram_link) ? $total_plus_team->instagram_link : '';
                        $link = !empty($total_plus_team->link) ? apply_filters('total_plus_translate_string', $total_plus_team->link, 'Team Block') : '';
                        ?>
                        <div class="ht-team-member <?php echo esc_attr($total_plus_team_style); ?>">

                            <div class="ht-team-member-inner">
                                <?php
                                if (!empty($image)) {
                                    $image_id = attachment_url_to_postid($image);
                                    $image_array = wp_get_attachment_image_src($image_id, $thumb);
                                    $image_url = $image_array[0];
                                } else {
                                    $image_url = get_template_directory_uri() . '/images/team-thumb.png';
                                }
                                $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image_url), $name);
                                ?>

                                <div class="ht-team-image">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr($image_alt_text); ?>" />

                                    <?php if ($total_plus_team_style == 'style3') { ?>
                                        <div class="ht-team-image-overlay">
                                            <div class="ht-team-image-overlay-inner">
                                                <?php if (!empty($content)) { ?>
                                                    <div class="team-short-content">
                                                        <?php echo wp_kses_post($content); ?>
                                                    </div>
                                                    <?php
                                                }

                                                if (!empty($link)) {
                                                    ?>
                                                    <a href="<?php echo esc_url($link); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                                    <?php
                                                }

                                                if ($facebook_link || $twitter_link || $instagram_link) {
                                                    ?>
                                                    <div class="ht-team-social-id">
                                                        <?php if ($facebook_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icofont-facebook"></i></a>
                                                        <?php } ?>

                                                        <?php if ($twitter_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icofont-x-twitter"></i></a>
                                                        <?php } ?>

                                                        <?php if ($instagram_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icofont-instagram"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>

                                <?php if ($total_plus_team_style == 'style1' && !empty($name)) { ?>
                                    <div class="ht-title-wrap">
                                        <h5><?php echo esc_html($name); ?></h5>
                                    </div>
                                <?php } ?>

                                <div class="ht-team-member-content">
                                    <div class="ht-team-member-excerpt">
                                        <div class="ht-team-member-span">
                                            <h5><?php echo esc_html($name); ?></h5>

                                            <?php if (!empty($designation)) { ?>
                                                <div class="ht-team-designation"><?php echo esc_html($designation); ?></div>
                                                <?php
                                            }

                                            if ($total_plus_team_style != 'style3') {
                                                if (!empty($content)) {
                                                    ?>
                                                    <div class="team-short-content">
                                                        <div class="">
                                                            <?php echo wp_kses_post($content); ?>
                                                        </div>
                                                        <?php if (!empty($link) && $total_plus_team_style == 'style5') { ?>
                                                            <a href="<?php echo esc_url($link); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }

                                                if (!empty($link) && $total_plus_team_style != 'style5') {
                                                    ?>
                                                    <a href="<?php echo esc_url($link); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                                    <?php
                                                }

                                                if ($facebook_link || $twitter_link || $instagram_link) {
                                                    ?>
                                                    <div class="ht-team-social-id">
                                                        <?php if ($facebook_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icofont-facebook"></i></a>
                                                        <?php } ?>

                                                        <?php if ($twitter_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icofont-x-twitter"></i></a>
                                                        <?php } ?>

                                                        <?php if ($instagram_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icofont-instagram"></i></a>
                                                            <?php } ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }

    if ($total_plus_team_title_style != 'ht-section-title-single-row' && $total_plus_team_title_style != 'ht-section-title-side') {
        $button_text = get_theme_mod('total_plus_team_button_text');
        $button_link = get_theme_mod('total_plus_team_button_link');

        if ($button_text && $button_link) {
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
