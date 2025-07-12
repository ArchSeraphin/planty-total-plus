<?php

/**
 *
 * @package Total Plus
 */
function total_plus_service_section() {
    if (get_theme_mod('total_plus_service_section_disable') != 'on') {
        $total_plus_service_style = get_theme_mod('total_plus_service_style', 'style1');
        $total_plus_service_bg_align = get_theme_mod('total_plus_service_bg_align', 'right');
        $service_class = array(
            $total_plus_service_style,
            'ht-bg-' . $total_plus_service_bg_align,
            'ht-section',
            'ht-service-section'
        );
        ?>
        <section id="ht-service-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>" <?php echo total_parallax_background('service'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('service'); ?>
                <div class="ht-service-bg"></div>
                <div class="ht-container ht-clearfix">
                    <div class="ht-service-posts ht-clearfix">
                        <?php
                        total_plus_service_title();
                        ?>
                        <div class="ht-service-post-holder ht-section-content">
                            <?php
                            if ($total_plus_service_style == 'style3') {
                                echo '<div class="ht-service-bg"></div>';
                            }
                            total_plus_service_content();
                            ?>
                        </div>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('service'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_service_title() {
    $total_plus_service_title_style = get_theme_mod('total_plus_service_title_style', 'ht-section-title-top-center');
    $total_plus_service_super_title = get_theme_mod('total_plus_service_super_title');
    $total_plus_service_title = get_theme_mod('total_plus_service_title', esc_html__('Service Section', 'total-plus'));
    $total_plus_service_sub_title = get_theme_mod('total_plus_service_sub_title', esc_html__('Service Section SubTitle', 'total-plus'));
    
    if ($total_plus_service_title || $total_plus_service_sub_title || $total_plus_service_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_service_title_style); ?>">
            <?php if ($total_plus_service_title || $total_plus_service_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_service_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_service_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_service_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_service_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <div class="ht-section-tagline">
            <?php if ($total_plus_service_sub_title) { ?>
                <div class="ht-section-tagline-text">
                <?php echo wp_kses_post(wpautop($total_plus_service_sub_title)); ?>
                </div>
            <?php } ?>
            </div>
        </div>
        <?php
    }
}

function total_plus_service_content() {
    echo '<div class="ht-service-post-wrap">';
    $total_plus_services = json_decode(get_theme_mod('total_plus_service'));
    $total_plus_service_title_style = get_theme_mod('total_plus_service_title_style', 'ht-section-title-top-center');

    if (!empty($total_plus_services)) {
        foreach ($total_plus_services as $total_plus_service) {
            $icon = $total_plus_service->icon;
            $title = !empty($total_plus_service->title) ? apply_filters('total_plus_translate_string', $total_plus_service->title, 'Service Block') : '';
            $content = !empty($total_plus_service->content) ? apply_filters('total_plus_translate_string', $total_plus_service->content, 'Service Block') : '';
            $link_text = !empty($total_plus_service->link_text) ? apply_filters('total_plus_translate_string', $total_plus_service->link_text, 'Service Block') : esc_html__('Read More', 'total-plus');
            $link = !empty($total_plus_service->link) ? apply_filters('total_plus_translate_string', $total_plus_service->link, 'Service Block') : '';
            $enable = $total_plus_service->enable;

            if ($enable == 'on') {
                ?>
                <div class="ht-service-post">
                    <div class="ht-service-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                    <div class="ht-service-excerpt ht-clearfix">
                        <h5><?php echo esc_html($title); ?></h5>
                        <div class="ht-service-text">
                            <div class="ht-service-text-inner">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                            <?php if (!empty($link)) { ?>
                                <a class="ht-service-more" href="<?php echo esc_url($link); ?>"><?php echo esc_html($link_text); ?><i class="mdi mdi-chevron-right"></i></a>
                                <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    echo '</div>';

    $button_text = get_theme_mod('total_plus_service_button_text');
    $button_link = get_theme_mod('total_plus_service_button_link');

    if( $button_text && $button_link){
        echo '<div class="ht-section-button">';
        echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
        echo '</div>';
    }
}
