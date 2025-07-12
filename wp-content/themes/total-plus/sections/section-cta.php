<?php

/**
 *
 * @package Total Plus
 */
function total_plus_cta_section() {
    if (get_theme_mod('total_plus_cta_section_disable') != 'on') {
        $total_plus_cta_style = get_theme_mod('total_plus_cta_style', 'style1');
        $cta_class = array(
            $total_plus_cta_style,
            'ht-section',
            'ht-cta-section'
        );
        ?>
        <section id="ht-cta-section" class="<?php echo esc_attr(implode(' ', $cta_class)); ?>" <?php echo total_parallax_background('cta'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('cta'); ?>
                <div class="ht-container">
                    <?php
                    $total_plus_cta_super_title = get_theme_mod('total_plus_cta_super_title');
                    $total_plus_cta_title = get_theme_mod('total_plus_cta_title', esc_html__('Call To Action Section', 'total-plus'));
                    $total_plus_cta_sub_title = get_theme_mod('total_plus_cta_sub_title', esc_html__('Call To Action Section SubTitle', 'total-plus'));
                    $total_plus_cta_button1_text = get_theme_mod('total_plus_cta_button1_text');
                    $total_plus_cta_button1_link = get_theme_mod('total_plus_cta_button1_link');
                    $total_plus_cta_button2_text = get_theme_mod('total_plus_cta_button2_text');
                    $total_plus_cta_button2_link = get_theme_mod('total_plus_cta_button2_link');
                    $total_plus_cta_video_url = get_theme_mod('total_plus_cta_video_url');
                    $total_plus_cta_video_button_icon = get_theme_mod('total_plus_cta_video_button_icon');
                    if (empty($total_plus_cta_video_button_icon) || (trim($total_plus_cta_video_button_icon) == '')) {
                        $total_plus_cta_video_button_icon = '<span class="video-play-button"><i class="mdi mdi-play"></i></span>';
                    } else {
                        $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($total_plus_cta_video_button_icon), esc_html__('Play Video', 'total-plus'));
                        $total_plus_cta_video_button_icon = '<img alt="' . esc_attr($image_alt_text) . '" src="' . esc_url($total_plus_cta_video_button_icon) . '"/>';
                    }

                    if ($total_plus_cta_title || $total_plus_cta_sub_title || $total_plus_cta_super_title) {
                        ?>
                        <div class="ht-section-title-tagline">
                            <?php if ($total_plus_cta_title || $total_plus_cta_super_title) { ?>
                                <div class="ht-section-title-wrap">
                                    <?php if ($total_plus_cta_super_title) { ?>
                                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_cta_super_title); ?></span>
                                    <?php } ?>

                                    <?php if ($total_plus_cta_title) { ?>
                                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_cta_title); ?></h2>
                                    <?php } ?>
                                </div>
                                <?php
                            }

                            if ($total_plus_cta_sub_title) {
                                ?>
                                <div class="ht-section-tagline">
                                    <div class="ht-section-tagline-text">
                                        <?php echo wp_kses_post(wpautop($total_plus_cta_sub_title)); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                    }

                    if ($total_plus_cta_button1_link || $total_plus_cta_button2_link || $total_plus_cta_video_url) {
                        ?>
                        <div class="ht-cta-buttons">
                            <?php if ($total_plus_cta_video_url) { ?>
                                <div id="cta-video">
                                    <a href="<?php echo esc_url($total_plus_cta_video_url); ?>"><?php echo $total_plus_cta_video_button_icon; ?></a>
                                </div>
                            <?php } ?>

                            <?php if ($total_plus_cta_button1_link) { ?>
                                <a class="ht-cta-button1" href="<?php echo esc_url($total_plus_cta_button1_link); ?>"><?php echo esc_html($total_plus_cta_button1_text); ?></a>
                            <?php } ?>

                            <?php if ($total_plus_cta_button2_link) { ?>
                                <a class="ht-cta-button2" href="<?php echo esc_url($total_plus_cta_button2_link); ?>"><?php echo esc_html($total_plus_cta_button2_text); ?></a>
                            <?php } ?>

                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php total_plus_add_bottom_seperator('cta'); ?>
            </div>
        </section>
        <?php
    }
}
