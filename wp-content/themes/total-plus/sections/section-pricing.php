<?php

/**
 *
 * @package Total Plus
 */
function total_plus_pricing_section() {
    if (get_theme_mod('total_plus_pricing_section_disable') != 'on') {
        ?>
        <section id="ht-pricing-section" class="ht-section ht-pricing-section" <?php echo total_parallax_background('pricing'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('pricing'); ?>
                <div class="ht-container ht-pricing-container ht-clearfix">
                    <?php
                    total_plus_pricing_title();
                    ?>
                    <div class="ht-pricing-content ht-section-content">
                        <?php
                        total_plus_pricing_content();
                        ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('pricing'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_pricing_title() {
    $total_plus_pricing_title_style = get_theme_mod('total_plus_pricing_title_style', 'ht-section-title-top-center');
    $total_plus_pricing_super_title = get_theme_mod('total_plus_pricing_super_title');
    $total_plus_pricing_title = get_theme_mod('total_plus_pricing_title', esc_html__('Pricing Section', 'total-plus'));
    $total_plus_pricing_sub_title = get_theme_mod('total_plus_pricing_sub_title', esc_html__('Pricing Section SubTitle', 'total-plus'));
    
    if ($total_plus_pricing_title || $total_plus_pricing_sub_title || $total_plus_pricing_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_pricing_title_style); ?>">
            <?php if ($total_plus_pricing_title || $total_plus_pricing_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_pricing_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_pricing_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_pricing_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_pricing_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <div class="ht-section-tagline">
            <?php if ($total_plus_pricing_sub_title) { ?>
                <div class="ht-section-tagline-text">
                <?php echo wp_kses_post(wpautop($total_plus_pricing_sub_title)); ?>
                </div>
            <?php } 

            if( $total_plus_pricing_title_style == 'ht-section-title-single-row' || $total_plus_pricing_title_style == 'ht-section-title-side' ){
                $button_text = get_theme_mod('total_plus_pricing_button_text');
                $button_link = get_theme_mod('total_plus_pricing_button_link');
                if( $button_text && $button_link){
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

function total_plus_pricing_content() {
    $total_plus_pricing_style = get_theme_mod('total_plus_pricing_style', 'style1');
    $total_plus_pricing_col = get_theme_mod('total_plus_pricing_col', '3');
    $total_plus_pricing_title_style = get_theme_mod('total_plus_pricing_title_style', 'ht-section-title-top-center');

    $pricing_wrap_class = array(
        'ht-pricing-wrap',
        'ht-pricing-col-' . $total_plus_pricing_col,
        'ht-clearfix'
    );
    ?>

    <div class="<?php echo esc_attr(implode(' ', $pricing_wrap_class)); ?>">
        <?php
        $total_plus_pricings = json_decode(get_theme_mod('total_plus_pricing'));
        
        if (!empty($total_plus_pricings)) {
            foreach ($total_plus_pricings as $total_plus_pricing) {
                $total_plus_pricing_plan = !empty($total_plus_pricing->plan) ? apply_filters('total_plus_translate_string', $total_plus_pricing->plan, 'Pricing Block') : '';
                $total_plus_pricing_currency = !empty($total_plus_pricing->currency) ? apply_filters('total_plus_translate_string', $total_plus_pricing->currency, 'Pricing Block') : '';
                $total_plus_pricing_price = !empty($total_plus_pricing->price) ? apply_filters('total_plus_translate_string', $total_plus_pricing->price, 'Pricing Block') : '';
                $total_plus_pricing_price_per = !empty($total_plus_pricing->price_per) ? apply_filters('total_plus_translate_string', $total_plus_pricing->price_per, 'Pricing Block') : '';
                $total_plus_pricing_content = !empty($total_plus_pricing->content) ? apply_filters('total_plus_translate_string', $total_plus_pricing->content, 'Pricing Block') : '';
                $total_plus_pricing_button_text = !empty($total_plus_pricing->button_text) ? apply_filters('total_plus_translate_string', $total_plus_pricing->button_text, 'Pricing Block') : '';
                $total_plus_pricing_button_link = !empty($total_plus_pricing->button_link) ? apply_filters('total_plus_translate_string', $total_plus_pricing->button_link, 'Pricing Block') : '';
                $total_plus_pricing_is_featured = $total_plus_pricing->is_featured;
                $total_plus_pricing_enable = $total_plus_pricing->enable;
                $featured_class = $total_plus_pricing_is_featured == 'yes' ? 'ht-featured' : '';

                $pricing_class = array(
                    'ht-pricing',
                    $featured_class,
                    $total_plus_pricing_style
                );

                if ($total_plus_pricing && $total_plus_pricing_enable == 'on') {
                    ?>
                    <div class="<?php echo esc_attr(implode(' ', array_filter($pricing_class))); ?>">
                        <div class="ht-pricing-header">
                            <h5><?php echo esc_html($total_plus_pricing_plan); ?></h5>
                            <div class="ht-pricing-price">
                                <div class="ht-pricing-price-inner">
                                    <span class="ht-currency"><?php echo esc_html($total_plus_pricing_currency); ?></span>
                                    <?php echo esc_html($total_plus_pricing_price); ?>
                                    <span class="ht-price-per"><?php echo esc_html($total_plus_pricing_price_per); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="ht-pricing-main">
                            <?php
                            if (!empty($total_plus_pricing_content)) {
                                $total_plus_pricing_content_lists = explode("\n", $total_plus_pricing_content);
                                ?>
                                <ul class="ht-pricing-list">
                                    <?php foreach ($total_plus_pricing_content_lists as $total_plus_pricing_content_list) { ?>
                                        <li><?php echo wp_kses_post($total_plus_pricing_content_list); ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>

                            <?php if (!empty($total_plus_pricing_button_link) || !empty($total_plus_pricing_button_text)) { ?>
                                <div class="ht-pricing-button">
                                    <a href="<?php echo esc_html($total_plus_pricing_button_link) ?>"><?php echo esc_html($total_plus_pricing_button_text) ?></a>
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
    if( $total_plus_pricing_title_style != 'ht-section-title-single-row' && $total_plus_pricing_title_style != 'ht-section-title-side' ){
        $button_text = get_theme_mod('total_plus_pricing_button_text');
        $button_link = get_theme_mod('total_plus_pricing_button_link');

        if( $button_text && $button_link){
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
