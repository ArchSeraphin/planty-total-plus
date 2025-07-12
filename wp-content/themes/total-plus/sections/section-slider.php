<?php

/**
 *
 * @package Total Plus
 */
function total_plus_slider_section() {
    $disable_section = get_theme_mod('total_plus_slider_disable', 'off');
    if ($disable_section == 'on') {
        return;
    }
    ?>

    <div id="ht-home-slider-section">
        <?php
        $total_plus_slider_type = get_theme_mod('total_plus_slider_type', 'normal');

        if ($total_plus_slider_type == 'normal') {

            $slider_default_height_type = get_theme_mod('total_plus_slider_full_screen', false) ? 'full' : 'auto';
            $slider_height_type = get_theme_mod('total_plus_slider_height_type', $slider_default_height_type);
            $full_window = ($slider_height_type == 'full') ? true : false;
            $slider_class = $full_window ? 'ht-full-window-slider' : '';
            $sliders = json_decode(get_theme_mod('total_plus_sliders'));
            $slider_pause = get_theme_mod('total_plus_slider_pause', '5');
            $slider_pause = $slider_pause * 1000;
            $slider_arrow = get_theme_mod('total_plus_slider_arrow', true);
            $slider_arrow = $slider_arrow == true ? 'true' : 'false';
            $slider_dots = get_theme_mod('total_plus_slider_dots', false);
            $slider_dots = $slider_dots == true ? 'true' : 'false';
            $slider_autoplay = get_theme_mod('total_plus_slider_autoplay', true);
            $slider_autoplay = $slider_autoplay == true ? 'true' : 'false';
            $slider_transition = get_theme_mod('total_plus_slider_transition', 'slide');
            if ($slider_height_type == 'custom') {
                $total_plus_slider_height = get_theme_mod('total_plus_slider_height', 800);
                $total_plus_slider_height_tablet = get_theme_mod('total_plus_slider_height_tablet', 600);
                $total_plus_slider_height_mobile = get_theme_mod('total_plus_slider_height_mobile', 400);
                echo '<style>';
                echo '#ht-slider .ht-slide img{object-fit:cover; object-position: center; height: 100%;}';
                echo '#ht-slider .ht-slide{height:' . $total_plus_slider_height . 'px}';
                echo '@media screen and (max-width:768px){';
                echo '#ht-slider .ht-slide{height:' . $total_plus_slider_height_tablet . 'px}';
                echo '}';
                echo '@media screen and (max-width:480px){';
                echo '#ht-slider .ht-slide{height:' . $total_plus_slider_height_mobile . 'px}';
                echo '}';
                echo '</style>';
            }
            ?>
            <div id="ht-slider" class="owl-carousel <?php echo esc_attr($slider_class); ?>" data-transition="<?php echo esc_attr($slider_transition) ?>" data-timeout="<?php echo absint($slider_pause) ?>" data-nav="<?php echo esc_attr($slider_arrow) ?>" data-dots="<?php echo esc_attr($slider_dots) ?>" data-autoplay="<?php echo esc_attr($slider_autoplay) ?>">

                <?php
                if (!empty($sliders)) {
                    foreach ($sliders as $slider) {
                        $image = $slider->image;
                        $title = !empty($slider->title) ? apply_filters('total_plus_translate_string', $slider->title, 'Sliders') : '';
                        $subtitle = !empty($slider->subtitle) ? apply_filters('total_plus_translate_string', $slider->subtitle, 'Sliders') : '';
                        $button_text = !empty($slider->button_text) ? apply_filters('total_plus_translate_string', $slider->button_text, 'Sliders') : '';
                        $button_link = !empty($slider->button_link) ? apply_filters('total_plus_translate_string', $slider->button_link, 'Sliders') : '';
                        $alignment = isset($slider->alignment) ? $slider->alignment : 'center';
                        $enable = $slider->enable;

                        if ($enable == 'on') {
                            $slide_bg_css = $full_window ? "style=background-image:url(" . esc_url($image) . ")" : '';
                            ?>
                            <div class="ht-slide" <?php echo esc_attr($slide_bg_css) ?>>

                                <?php
                                if ($image && !$full_window) {
                                    $image_alt_text = total_plus_get_image_alt(attachment_url_to_postid($image), esc_html__('Slider Image', 'total-plus'));
                                    echo '<img alt="' . esc_attr($image_alt_text) . '" src="' . esc_url($image) . '">';
                                }
                                ?>

                                <div class="ht-slide-caption ht-slide-<?php echo esc_attr($alignment); ?>">
                                    <?php if ($title) { ?>
                                        <div class="ht-slide-cap-title">
                                            <span><?php echo wp_kses_post($title); ?></span>
                                        </div>
                                    <?php } ?>

                                    <?php if ($subtitle) { ?>
                                        <div class="ht-slide-cap-desc">
                                            <?php echo wp_kses_post($subtitle); ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($button_link) { ?>
                                        <div class="ht-slide-button">
                                            <a href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>

                            <?php
                        }
                    }
                }
                ?>

            </div>
            <?php
        } elseif ($total_plus_slider_type == 'banner') {
            $parallax_mode = "";
            $title = get_theme_mod('total_plus_banner_title');
            $subtitle = get_theme_mod('total_plus_banner_subtitle');
            $button_text = get_theme_mod('total_plus_banner_button_text');
            $button_link = get_theme_mod('total_plus_banner_button_link');
            $banner_text_alignment = get_theme_mod('total_plus_banner_text_alignment', 'left');
            $parallax_effect = get_theme_mod('total_plus_banner_parallax_effect', 'none');
            if ($parallax_effect == 'parallax') {
                $parallax_mode = 'data-pllx-bg-ratio="0.5"';
            } elseif ($parallax_effect == 'scroll') {
                $parallax_mode = 'data-motion="true"';
            }
            ?>
            <div class="ht-main-banner" <?php echo $parallax_mode; ?>>
                <div class="ht-container ht-banner-<?php echo esc_attr($banner_text_alignment); ?>">
                    <div class="ht-banner-caption">
                        <h2 class="ht-banner-title"><?php echo esc_html($title); ?></h2>
                        <div class="ht-banner-subtitle">
                            <?php echo wp_kses_post($subtitle); ?>
                        </div>

                        <?php if (!empty($button_link)) { ?>
                            <div class="ht-banner-button">
                                <a class="ht-button" href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        } elseif ($total_plus_slider_type == 'revolution') {

            $total_plus_slider_shortcode = get_theme_mod('total_plus_slider_shortcode');
            echo do_shortcode($total_plus_slider_shortcode);
        }
        do_action('after_slider_section');
        ?>
    </div>
    <?php
}
