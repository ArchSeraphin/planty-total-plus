<?php

/**
 *
 * @package Total Plus
 */
function total_plus_tab_section() {
    if (get_theme_mod('total_plus_tab_section_disable') != 'on') {
        ?>
        <section id="ht-tab-section" class="ht-section ht-tab-section" <?php echo total_parallax_background('tab'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('tab'); ?>
                <div class="ht-container">
                    <?php total_plus_tab_title(); ?>

                    <div class="ht-section-content">
                    <?php total_plus_tab_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('tab'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_tab_title() {
    $total_plus_tab_title_style = get_theme_mod('total_plus_tab_title_style', 'ht-section-title-top-center');
    $total_plus_tab_super_title = get_theme_mod('total_plus_tab_super_title');
    $total_plus_tab_title = get_theme_mod('total_plus_tab_title', esc_html__('Tab Section', 'total-plus'));
    $total_plus_tab_sub_title = get_theme_mod('total_plus_tab_sub_title', esc_html__('Tab Section SubTitle', 'total-plus'));

    if ($total_plus_tab_title || $total_plus_tab_sub_title || $total_plus_tab_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_tab_title_style); ?>">
            <?php if ($total_plus_tab_title || $total_plus_tab_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_tab_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_tab_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_tab_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_tab_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <div class="ht-section-tagline">
            <?php if ($total_plus_tab_sub_title) { ?>
                <div class="ht-section-tagline-text">
                <?php echo wp_kses_post(wpautop($total_plus_tab_sub_title)); ?>
                </div>
            <?php } 

            if( $total_plus_tab_title_style == 'ht-section-title-single-row' ){
                $button_text = get_theme_mod('total_plus_tab_button_text');
                $button_link = get_theme_mod('total_plus_tab_button_link');
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

function total_plus_tab_content() {
    $total_plus_tab_style = get_theme_mod('total_plus_tab_style', 'style1');
    $total_plus_tab_title_style = get_theme_mod('total_plus_tab_title_style', 'ht-section-title-top-center');
    $tab_class = array(
        $total_plus_tab_style,
        'ht-tab-wrap',
        'ht-clearfix'
    );
    ?>
    <div class="<?php echo esc_attr(implode(' ', $tab_class)); ?>">
        <?php
        $total_plus_tabs = json_decode(get_theme_mod('total_plus_tabs'));
        ?>
        <div class="ht-tabs">
            <?php
            if (!empty($total_plus_tabs)) {
                foreach ($total_plus_tabs as $total_plus_tab) {
                    $title = $total_plus_tab->title;
                    $title = !empty($title) ? apply_filters('total_plus_translate_string', $title, 'Tabs Block') : '';
                    $icon = $total_plus_tab->icon;
                    $page_id = $total_plus_tab->page;
                    $enable = $total_plus_tab->enable;

                    if ($enable == 'on' && !empty($page_id)) {
                        if (!empty($title)) {
                            $tab_title = $title;
                        } else {
                            $tab_title = get_the_title($page_id);
                        }
                        ?>
                        <div class="ht-tab" id="ht-tab-<?php echo esc_attr($page_id) ?>"><i class="<?php echo esc_html($icon); ?>"></i><span><?php echo esc_html($tab_title); ?></span></div>
                        <?php
                    }
                }
            }
            ?>
        </div>

        <div class="ht-tab-content">
            <?php
            if (!empty($total_plus_tabs)) {
                foreach ($total_plus_tabs as $total_plus_tab) {
                    $page_id = $total_plus_tab->page;
                    $enable = $total_plus_tab->enable;

                    if ($enable == 'on' && !empty($page_id)) {
                        ?>
                        <div class="ht-content" id="ht-content-<?php echo esc_attr($page_id) ?>" style="display:none;">
                            <?php
                            $args = array(
                                'page_id' => absint($page_id)
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()):
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <h3><?php the_title(); ?></h3>
                                    <div class="ht-clearfix">
                                        <?php
                                        the_content();
                                        ?>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php
    if( $total_plus_tab_title_style != 'ht-section-title-single-row' ){
        $button_text = get_theme_mod('total_plus_tab_button_text');
        $button_link = get_theme_mod('total_plus_tab_button_link');

        if( $button_text && $button_link){
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}