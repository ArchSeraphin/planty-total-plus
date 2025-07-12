<?php

/**
 *
 * @package Total Plus
 */
function total_plus_counter_section() {
    if (get_theme_mod('total_plus_counter_section_disable') != 'on') {
        ?>
        <section id="ht-counter-section" class="ht-section ht-counter-section" <?php echo total_parallax_background('counter'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('counter'); ?>
                <div class="ht-container ht-counter-container ht-clearfix">
                    <?php total_plus_counter_title(); ?>
                    <div class="ht-counter-content ht-section-content">
                        <?php total_plus_counter_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('counter'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_counter_title() {
    $total_plus_counter_super_title = get_theme_mod('total_plus_counter_super_title');
    $total_plus_counter_title_style = get_theme_mod('total_plus_counter_title_style', 'ht-section-title-top-center');
    $total_plus_counter_title = get_theme_mod('total_plus_counter_title', esc_html__('Counter Section', 'total-plus'));
    $total_plus_counter_sub_title = get_theme_mod('total_plus_counter_sub_title', esc_html__('Counter Section SubTitle', 'total-plus'));
    
    if ($total_plus_counter_title || $total_plus_counter_sub_title || $total_plus_counter_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_counter_title_style); ?>">
            <?php if ($total_plus_counter_title || $total_plus_counter_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_counter_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_counter_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_counter_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_counter_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <div class="ht-section-tagline">
            <?php if ($total_plus_counter_sub_title) { ?>
                <div class="ht-section-tagline-text">
                <?php echo wp_kses_post(wpautop($total_plus_counter_sub_title)); ?>
                </div>
            <?php } 

            if( $total_plus_counter_title_style == 'ht-section-title-single-row' || $total_plus_counter_title_style == 'ht-section-title-side' ){
                $button_text = get_theme_mod('total_plus_counter_button_text');
                $button_link = get_theme_mod('total_plus_counter_button_link');
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

function total_plus_counter_content() {
    $total_plus_counter_style = get_theme_mod('total_plus_counter_style', 'style1');
    $total_plus_counter_col = get_theme_mod('total_plus_counter_col', 3);
    $total_plus_counter_title_style = get_theme_mod('total_plus_counter_title_style', 'ht-section-title-top-center');
    
    $counter_class = array(
        $total_plus_counter_style,
        'ht-counter-col-' . $total_plus_counter_col,
        'ht-counter-wrap',
        'ht-clearfix'
    );
    ?>
    <div class="<?php echo esc_attr(implode(' ', $counter_class)) ?>">
        <?php
        $i = 0;
        $total_plus_counters = json_decode(get_theme_mod('total_plus_counter'));
        if (!empty($total_plus_counters)) {
            foreach ($total_plus_counters as $total_plus_counter) {
                $total_plus_counter_title = !empty($total_plus_counter->title) ? apply_filters('total_plus_translate_string', $total_plus_counter->title, 'Counter Block') : '';
                $total_plus_counter_count = $total_plus_counter->value;
                $total_plus_counter_icon = $total_plus_counter->icon;
                $total_plus_counter_enable = $total_plus_counter->enable;
                if ($total_plus_counter_count && $total_plus_counter_enable == 'on') {
                    $i++;
                    if ($total_plus_counter_style == 'style1' || $total_plus_counter_style == 'style2') {
                        ?>
                        <div class="ht-counter">
                            <div class="ht-counter-icon">
                                <i class="<?php echo esc_attr($total_plus_counter_icon); ?>"></i>
                            </div>

                            <div class="ht-counter-count odometer odometer<?php echo $i; ?>" data-count="<?php echo absint($total_plus_counter_count); ?>">
                                99
                            </div>

                            <h5 class="ht-counter-title">
                                <?php echo esc_html($total_plus_counter_title); ?>
                            </h5>
                            <span></span>
                        </div>
                        <?php
                    } elseif ($total_plus_counter_style == 'style3') {
                        ?>
                        <div class="ht-counter">
                            <div class="ht-counter-icon">
                                <i class="<?php echo esc_attr($total_plus_counter_icon); ?>"></i>
                            </div>

                            <div class="ht-counter-count odometer odometer<?php echo $i; ?>" data-count="<?php echo absint($total_plus_counter_count); ?>">
                                99
                            </div>

                            <h5 class="ht-counter-title">

                                <?php echo esc_html($total_plus_counter_title); ?>
                            </h5>
                        </div>
                        <?php
                    } elseif ($total_plus_counter_style == 'style4') {
                        ?>
                        <div class="ht-counter">
                            <div class="ht-counter-icon">
                                <i class="<?php echo esc_attr($total_plus_counter_icon); ?>"></i>
                            </div>

                            <div class="ht-counter-right-block">
                                <div class="ht-counter-count odometer odometer<?php echo $i; ?>" data-count="<?php echo absint($total_plus_counter_count); ?>">
                                    99
                                </div>

                                <h5 class="ht-counter-title">
                                    <?php echo esc_html($total_plus_counter_title); ?>
                                </h5>
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

    if( $total_plus_counter_title_style != 'ht-section-title-single-row' && $total_plus_counter_title_style != 'ht-section-title-side' ){
        $button_text = get_theme_mod('total_plus_counter_button_text');
        $button_link = get_theme_mod('total_plus_counter_button_link');

        if( $button_text && $button_link){
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
