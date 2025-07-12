<?php

/**
 *
 * @package Total Plus
 */
function total_plus_testimonial_section() {
    if (get_theme_mod('total_plus_testimonial_section_disable') != 'on') {
        ?>
        <section id="ht-testimonial-section" class="ht-section ht-testimonial-section" <?php echo total_parallax_background('testimonial'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('testimonial'); ?>
                <div class="ht-container ht-testimonial-container ht-clearfix">
                    <?php total_plus_testimonial_title(); ?>
                    <div class="ht-testimonial-content ht-section-content">
                        <?php total_plus_testimonial_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('testimonial'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_testimonial_title() {
    $total_plus_testimonial_title_style = get_theme_mod('total_plus_testimonial_title_style', 'ht-section-title-top-center');
    $total_plus_testimonial_super_title = get_theme_mod('total_plus_testimonial_super_title');
    $total_plus_testimonial_title = get_theme_mod('total_plus_testimonial_title', esc_html__('Testimonial Section', 'total-plus'));
    $total_plus_testimonial_sub_title = get_theme_mod('total_plus_testimonial_sub_title', esc_html__('Testimonial Section SubTitle', 'total-plus'));

    if ($total_plus_testimonial_title || $total_plus_testimonial_sub_title || $total_plus_testimonial_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_testimonial_title_style); ?>">
            <?php if ($total_plus_testimonial_title || $total_plus_testimonial_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_testimonial_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_testimonial_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_testimonial_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_testimonial_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="ht-section-tagline">
                <?php if ($total_plus_testimonial_sub_title) { ?>
                    <div class="ht-section-tagline-text">
                        <?php echo wp_kses_post(wpautop($total_plus_testimonial_sub_title)); ?>
                    </div>
                <?php
                }

                if ($total_plus_testimonial_title_style == 'ht-section-title-single-row' || $total_plus_testimonial_title_style == 'ht-section-title-side') {
                    $button_text = get_theme_mod('total_plus_testimonial_button_text');
                    $button_link = get_theme_mod('total_plus_testimonial_button_link');
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

function total_plus_testimonial_content() {
    $total_plus_testimonial_style = get_theme_mod('total_plus_testimonial_style', 'style1');
    $total_plus_testimonial_title_style = get_theme_mod('total_plus_testimonial_title_style', 'ht-section-title-top-center');

    $testimonial_class = array(
        'ht-testimonial-wrap',
        'ht-clearfix',
        $total_plus_testimonial_style
    );

    if ($total_plus_testimonial_style == 'style2') {
        $thumb = 'total-400x400';
    } else {
        $thumb = 'total-100x100';
    }

    $dir_rtl = (is_rtl()) ? 'dir="rtl"' : '';

    $col = 3;
    if ($total_plus_testimonial_title_style == 'ht-section-title-side') {
        $col = 2;
    }

    $total_plus_testimonials = json_decode(get_theme_mod('total_plus_testimonial'));

    if (!empty($total_plus_testimonials)) {
        ?>
        <div class="<?php echo esc_attr(implode(' ', $testimonial_class)) ?>">
            <?php
            if ($total_plus_testimonial_style == 'style1') {
                ?>
                <div class="ht-testimonial-slider owl-carousel">
                    <?php
                    foreach ($total_plus_testimonials as $total_plus_testimonial) {
                        $enable = $total_plus_testimonial->enable;

                        if ($enable == 'on') {
                            $image = $total_plus_testimonial->image;
                            $name = !empty($total_plus_testimonial->name) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->name, 'Testimonial Block') : '';
                            $designation = !empty($total_plus_testimonial->designation) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->designation, 'Testimonial Block') : '';
                            $content = !empty($total_plus_testimonial->content) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->content, 'Testimonial Block') : '';

                            if (!empty($image)) {
                                $image_id = attachment_url_to_postid($image);
                                $image_array = wp_get_attachment_image_src($image_id, $thumb);
                                $image_url = $image_array[0];
                            }
                            ?>
                            <div class="ht-testimonial">
                                <div class="ht-testimonial-excerpt">
                                    <i class="icofont-quote-left"></i>
                                    <?php
                                    if (!empty($content)) {
                                        echo wp_kses_post($content);
                                    }
                                    ?>
                                </div>
                                <?php
                                if (!empty($image_url)) {
                                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image_url), $name);
                                    ?>
                                    <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
                                    <?php
                                }
                                ?>
                                <h5><?php echo esc_html($name); ?></h5>
                                <div class="designation"><?php echo esc_html($designation); ?></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            } elseif ($total_plus_testimonial_style == 'style2') {
                ?>
                <div class="ht-testimonial-image-wrap" <?php echo $dir_rtl; ?>>
                    <?php
                    foreach ($total_plus_testimonials as $total_plus_testimonial) {
                        $enable = $total_plus_testimonial->enable;

                        if ($enable == 'on') {
                            $image = $total_plus_testimonial->image;
                            $name = $total_plus_testimonial->name;

                            if (!empty($image)) {
                                $image_id = attachment_url_to_postid($image);
                                $image_array = wp_get_attachment_image_src($image_id, $thumb);
                                $image_url = $image_array[0];
                            }
                            ?>
                            <div class="ht-testimonial-image-slide">
                                <?php if (!empty($image_url)) { 
                                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image_url), $name);
                                    ?>
                                    <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="ht-testimonial-content-wrap" <?php echo $dir_rtl; ?>>
                    <?php
                    foreach ($total_plus_testimonials as $total_plus_testimonial) {
                        $enable = $total_plus_testimonial->enable;

                        if ($enable == 'on') {
                            $name = !empty($total_plus_testimonial->name) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->name, 'Testimonial Block') : '';
                            $designation = !empty($total_plus_testimonial->designation) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->designation, 'Testimonial Block') : '';
                            $content = !empty($total_plus_testimonial->content) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->content, 'Testimonial Block') : '';
                            ?>
                            <div class="ht-testimonial">
                                <div class="ht-testimonial-excerpt">
                                    <?php
                                    if (!empty($content)) {
                                        echo wp_kses_post($content);
                                    }
                                    ?>
                                </div>
                                <h5><?php echo esc_html($name); ?></h5>
                                <div class="designation"><?php echo esc_html($designation); ?></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            } elseif ($total_plus_testimonial_style == 'style3') {
                foreach ($total_plus_testimonials as $total_plus_testimonial) {
                    $enable = $total_plus_testimonial->enable;

                    if ($enable == 'on') {
                        $image = $total_plus_testimonial->image;
                        $name = !empty($total_plus_testimonial->name) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->name, 'Testimonial Block') : '';
                        $designation = !empty($total_plus_testimonial->designation) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->designation, 'Testimonial Block') : '';
                        $content = !empty($total_plus_testimonial->content) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->content, 'Testimonial Block') : '';

                        if (!empty($image)) {
                            $image_id = attachment_url_to_postid($image);
                            $image_array = wp_get_attachment_image_src($image_id, $thumb);
                            $image_url = $image_array[0];
                        }
                        ?>
                        <div class="ht-testimonial-box">
                            <div class="ht-testimonial-excerpt">
                                <?php
                                if (!empty($content)) {
                                    echo wp_kses_post($content);
                                }
                                ?>
                            </div>

                            <div class="ht-testimonial-footer flexbox">
                                <?php
                                if (!empty($image_url)) {
                                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image_url), $name);
                                    ?>
                                    <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
                                    <?php
                                }
                                ?>

                                <div class="ht-testimonial-title">
                                    <h5><?php echo esc_html($name); ?></h5>
                                    <div class="designation"><?php echo esc_html($designation); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } elseif ($total_plus_testimonial_style == 'style4') {
                ?>
                <div class="ht-testimonial-carousel owl-carousel" data-col="<?php echo absint($col); ?>">
                    <?php
                    foreach ($total_plus_testimonials as $total_plus_testimonial) {
                        $enable = $total_plus_testimonial->enable;

                        if ($enable == 'on') {
                            $image = $total_plus_testimonial->image;
                            $name = !empty($total_plus_testimonial->name) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->name, 'Testimonial Block') : '';
                            $designation = !empty($total_plus_testimonial->designation) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->designation, 'Testimonial Block') : '';
                            $content = !empty($total_plus_testimonial->content) ? apply_filters('total_plus_translate_string', $total_plus_testimonial->content, 'Testimonial Block') : '';

                            if (!empty($image)) {
                                $image_id = attachment_url_to_postid($image);
                                $image_array = wp_get_attachment_image_src($image_id, $thumb);
                                $image_url = $image_array[0];
                            }
                            ?>
                            <div class="ht-testimonial-box">
                                <div class="ht-testimonial-excerpt">
                                    <?php
                                    if (!empty($content)) {
                                        echo wp_kses_post($content);
                                    }
                                    ?>
                                </div>

                                <div class="ht-testimonial-footer flexbox">
                                    <?php
                                    if (!empty($image_url)) {
                                        $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image_url), $name);
                                        ?>
                                        <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
                                        <?php
                                    }
                                    ?>

                                    <div class="ht-testimonial-title">
                                        <h5><?php echo esc_html($name); ?></h5>
                                        <div class="designation"><?php echo esc_html($designation); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }

    if ($total_plus_testimonial_title_style != 'ht-section-title-single-row' && $total_plus_testimonial_title_style != 'ht-section-title-side') {
        $button_text = get_theme_mod('total_plus_testimonial_button_text');
        $button_link = get_theme_mod('total_plus_testimonial_button_link');

        if ($button_text && $button_link) {
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
