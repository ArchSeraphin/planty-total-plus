<?php

/**
 *
 * @package Total Plus
 */
function total_plus_contact_content() {
    $contact_shortcode = get_theme_mod('total_plus_contact_shortcode');
    $contact_detail = get_theme_mod('total_plus_contact_detail');
    $show_icons = get_theme_mod('total_plus_contact_social_icons', true);
    $show_contact_box = get_theme_mod('total_plus_show_contact_detail', 'on');
    if ($show_contact_box == 'on') {
        ?>
        <div class="ht-contact-detail-toggle ht-open"><i class="flaticon-add"></i></div>
        <div class="ht-contact-content">
            <div class="ht-contact-form">
                <?php echo do_shortcode($contact_shortcode); ?>
            </div>

            <div class="ht-contact-detail">
                <?php echo wp_kses_post($contact_detail); ?>

                <div class="ht-contact-social-icon">
                    <?php
                    if ($show_icons) {
                        do_action('total_plus_social_icons');
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}

function total_plus_contact_map() {
    $latitude = get_theme_mod('total_plus_latitude', 29.424122);
    $longitude = get_theme_mod('total_plus_longitude', -98.493629);
    $map_style = get_theme_mod('total_plus_map_style', 'normal');
    $enable_iframe = get_theme_mod('total_plus_enable_iframe_map', false);
    $iframe = get_theme_mod('total_plus_google_map_iframe');
    ?>
        <div id="ht-google-map">
            <?php 
                if($enable_iframe){
                    echo $iframe;
                }
            ?>
        </div>

    <?php
    if (!empty($longitude) && !empty($latitude) && !$enable_iframe) {
        ?>
        <script src="<?php echo get_template_directory_uri() ?>/js/gmap3.min.js"></script>
        <script>
            jQuery(function ($) {
                var center = [<?php echo $latitude; ?>, <?php echo $longitude; ?>];
                $('#ht-google-map').gmap3({
                        center: center,
                        zoom: 16,
                        scrollwheel: false,
                        mapTypeId: "<?php echo $map_style ?>",
                        mapTypeControl: false,
                    })
                    .marker({
                        position: center,
                        visible: false,
                    })
                    .overlay({
                        position: center,
                        content: '<div><div class="animated-dot">' + '<div class="middle-dot"></div>' + '<div class="signal"></div>' + '<div class="signal2"></div>' + '</div></div>',
                    })
                    .styledmaptype(
                        "light",
                        [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}],
                    )
                    .styledmaptype(
                        "dark",
                        [{"featureType": "all", "elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]}, {"featureType": "all", "elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]}, {"featureType": "all", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#000000"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 20}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 21}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#000000"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#000000"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 16}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 19}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 17}]}],
                    )
                    .styledmaptype(
                        "normal",
                    )
            })
        </script>
        <?php
    }
}

function total_plus_contact_section() {
    if (get_theme_mod('total_plus_contact_section_disable') != 'on') {
        $show_contact_box = get_theme_mod('total_plus_show_contact_detail', 'on');
        $full_window = get_theme_mod('total_plus_contact_enable_fullwindow', 'off');
        $contact_class = array('ht-section', 'ht-contact-section');
        $contact_class[] = 'ht-contact-detail-' . esc_attr($show_contact_box);
        if ($full_window == 'on') {
            $contact_class[] = 'ht-window-height';
        }
        ?>
        <section id="ht-contact-section" class="<?php echo implode(' ', $contact_class); ?>" <?php echo total_parallax_background('contact'); ?>>

            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('contact'); ?>
                <div class="ht-contact-google-map">
                    <?php total_plus_contact_map(); ?>
                </div>

                <div class="ht-container">
                    <?php total_plus_contact_content(); ?>
                </div>
                <?php total_plus_add_bottom_seperator('contact'); ?>
            </div>

        </section>
        <?php
    }
}
