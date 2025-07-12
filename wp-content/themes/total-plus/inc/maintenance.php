<?php
$total_plus_maintenance_date = get_theme_mod('total_plus_maintenance_date');
$date = str_replace('/', '-', $total_plus_maintenance_date);
$utcdate = date("D, d M Y H:i:s T", strtotime($date));
header("HTTP/1.1 503 Service Unavailable");
header("Retry-After: $utcdate");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php
        wp_head();
        $total_plus_maintenance_bg_type = get_theme_mod('total_plus_maintenance_bg_type', 'banner');
        ?>
    </head>
    <body class="<?php echo esc_attr($total_plus_maintenance_bg_type); ?>">
        <?php
        $total_plus_maintenance_logo = get_theme_mod('total_plus_maintenance_logo');
        $total_plus_maintenance_title = get_theme_mod('total_plus_maintenance_title', esc_html__('WEBSITE UNDER MAINTENANCE', 'total-plus'));
        $total_plus_maintenance_text = get_theme_mod('total_plus_maintenance_text', esc_html__('We are coming soon with new changes. Stay Tuned!', 'total-plus'));
        $total_plus_maintenance_shortcode = get_theme_mod('total_plus_maintenance_shortcode');
        $total_plus_maintenance_banner_image = get_theme_mod('total_plus_maintenance_banner_image', get_template_directory_uri() . '/images/bg.jpg');
        $total_plus_maintenance_slider_shortcode = get_theme_mod('total_plus_maintenance_slider_shortcode');
        $total_plus_maintenance_sliders = get_theme_mod('total_plus_maintenance_sliders');
        $total_plus_maintenance_slider_pause = get_theme_mod('total_plus_maintenance_slider_pause', 5);
        $total_plus_maintenance_video = get_theme_mod('total_plus_maintenance_video', 'yNAsk4Zw2p0');
        $total_plus_maintenance_bg_overlay_color = get_theme_mod('total_plus_maintenance_bg_overlay_color', 'rgba(255,255,255,0)');
        $total_plus_maintenance_title_color = get_theme_mod('total_plus_maintenance_title_color', '#FFFFFF');
        $total_plus_maintenance_text_color = get_theme_mod('total_plus_maintenance_text_color', '#FFFFFF');
        $total_plus_maintenance_counter_color = get_theme_mod('total_plus_maintenance_counter_color', '#FFFFFF');
        $total_plus_maintenance_social_icon_color = get_theme_mod('total_plus_maintenance_social_icon_color', '#FFFFFF');
        ?>

        <div class="ht-maintenance-bg">
            <?php
            if ($total_plus_maintenance_bg_type == 'revolution' && !empty($total_plus_maintenance_slider_shortcode)) {
                echo do_shortcode($total_plus_maintenance_slider_shortcode);
            } elseif ($total_plus_maintenance_bg_type == 'banner' && !empty($total_plus_maintenance_banner_image)) {
                ?>
                <div class="ht-maintenance-banner" style="background-image:url(<?php echo esc_url($total_plus_maintenance_banner_image) ?>)"></div>
                <?php
            } elseif ($total_plus_maintenance_bg_type == 'video' && !empty($total_plus_maintenance_video)) {
                $video_attr = 'data-property="{videoURL:\'' . $total_plus_maintenance_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $total_plus_maintenance_video . '/maxresdefault.jpg\'}"';
                wp_enqueue_script('YTPlayer');
                ?>
                <div class="ht-maintenance-video" <?php echo $video_attr; ?>></div>
                <?php
            } elseif ($total_plus_maintenance_bg_type == 'slider' && !empty($total_plus_maintenance_sliders)) {
                ?>
                <div class="ht-maintenance-slider owl-carousel" data-timeout="<?php echo $total_plus_maintenance_slider_pause * 1000; ?>">
                    <?php
                    $sliders = json_decode($total_plus_maintenance_sliders);

                    foreach ($sliders as $slider) {
                        $image = $slider->image;
                        if ($image) {
                            $slide_bg_css = "style=background-image:url(" . esc_url($image) . ")";
                            ?>
                            <div class="ht-maintenance-slide" <?php echo esc_attr($slide_bg_css) ?>></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>

        <div id="ht-maintenance-page">
            <div class="ht-maintenance-page animated fadeInUp">
                <header>
                    <?php
                    if (!empty($total_plus_maintenance_logo)) {
                        ?>
                        <div class="ht-maintenance-logo">
                            <img src="<?php echo esc_url($total_plus_maintenance_logo) ?>" alt="Logo">
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if (!empty($total_plus_maintenance_title)) {
                        ?>
                        <h1>
                            <?php echo esc_html($total_plus_maintenance_title) ?>
                        </h1>
                        <?php
                    }
                    ?>

                    <?php echo wp_kses_post($total_plus_maintenance_text); ?>
                </header>

                <?php if ($total_plus_maintenance_date) { ?>
                    <div class="ht-maintenance-countdown"></div>
                    <script>
                        jQuery(function ($) {
                            $('.ht-maintenance-countdown').countdown('<?php echo $total_plus_maintenance_date; ?>', function (event) {
                                var $this = $(this).html(event.strftime(''
                                        + '<div class="ht-count-label"><span>%D</span><label><?php echo __('Days', 'total-plus'); ?></label></div>'
                                        + '<div class="ht-count-label"><span>%H</span><label><?php echo __('Hours', 'total-plus'); ?></label></div>'
                                        + '<div class="ht-count-label"><span>%M</span><label><?php echo __('Minutes', 'total-plus'); ?></label></div>'
                                        + '<div class="ht-count-label"><span>%S</span><label><?php echo __('Seconds', 'total-plus'); ?></label></div>'));
                            });
                        });
                    </script>
                <?php } ?>

                <?php if ($total_plus_maintenance_shortcode) {
                    ?>
                    <div class="ht-maintenance-shortcode">
                        <?php echo do_shortcode($total_plus_maintenance_shortcode); ?>
                    </div>
                <?php } ?>

                <footer>
                    <div class="ht-maintenance-social">
                        <?php
                        do_action('total_plus_social_icons');
                        ?>
                    </div>
                </footer>
            </div>
        </div>
        <style type="text/css">
            .ht-maintenance-bg:after{
                background-color: <?php echo $total_plus_maintenance_bg_overlay_color; ?>
            }
            #ht-maintenance-page{
                color: <?php echo $total_plus_maintenance_text_color; ?>
            }
            #ht-maintenance-page h1,
            #ht-maintenance-page h2,
            #ht-maintenance-page h3,
            #ht-maintenance-page h4,
            #ht-maintenance-page h5,
            #ht-maintenance-page h6{
                color: <?php echo $total_plus_maintenance_title_color; ?>
            }
            #ht-maintenance-page .ht-maintenance-countdown *{
                color: <?php echo $total_plus_maintenance_counter_color; ?>
            }
            .ht-maintenance-social a{
                border-color: <?php echo $total_plus_maintenance_social_icon_color; ?>;
                color: <?php echo $total_plus_maintenance_social_icon_color; ?>;
            }
        </style>
        <?php
        wp_footer();
        ?>
    </body>
</html>