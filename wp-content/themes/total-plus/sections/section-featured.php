<?php

/**
 *
 * @package Total Plus
 */
function total_plus_featured_section() {
    if (get_theme_mod('total_plus_featured_section_disable') != 'on') {
        ?>
        <section id="ht-featured-section" class="ht-section ht-featured-section" <?php echo total_parallax_background('featured'); ?>>
            <div class="ht-section-wrap">
                <?php total_plus_add_top_seperator('featured'); ?>
                <div class="ht-container ht-featured-container ht-clearfix">
                    <?php total_plus_featured_title(); ?>
                    <div class="ht-featured-content ht-section-content">
                        <?php total_plus_featured_content(); ?>
                    </div>
                </div>
                <?php total_plus_add_bottom_seperator('featured'); ?>
            </div>
        </section>
        <?php
    }
}

function total_plus_featured_title() {
    $total_plus_featured_title_style = get_theme_mod('total_plus_featured_title_style', 'ht-section-title-top-center');
    $total_plus_featured_super_title = get_theme_mod('total_plus_featured_super_title');
    $total_plus_featured_title = get_theme_mod('total_plus_featured_title', esc_html__('Featured Section', 'total-plus'));
    $total_plus_featured_sub_title = get_theme_mod('total_plus_featured_sub_title', esc_html__('Featured Section SubTitle', 'total-plus'));

    if ($total_plus_featured_title || $total_plus_featured_sub_title || $total_plus_featured_super_title) {
        ?>
        <div class="ht-section-title-tagline <?php echo esc_attr($total_plus_featured_title_style); ?>">
            <?php if ($total_plus_featured_title || $total_plus_featured_super_title) { ?>
                <div class="ht-section-title-wrap">
                    <?php if ($total_plus_featured_super_title) { ?>
                        <span class="ht-section-super-title"><?php echo esc_html($total_plus_featured_super_title); ?></span>
                    <?php } ?>

                    <?php if ($total_plus_featured_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($total_plus_featured_title); ?></h2>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <div class="ht-section-tagline">
            <?php if ($total_plus_featured_sub_title) { ?>
                <div class="ht-section-tagline-text">
                <?php echo wp_kses_post(wpautop($total_plus_featured_sub_title)); ?>
                </div>
            <?php } 

            if( $total_plus_featured_title_style == 'ht-section-title-single-row' || $total_plus_featured_title_style == 'ht-section-title-side' ){
                $button_text = get_theme_mod('total_plus_featured_button_text');
                $button_link = get_theme_mod('total_plus_featured_button_link');
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

function total_plus_featured_content() {
    $total_plus_featured_col = get_theme_mod('total_plus_featured_col', 3);
    $total_plus_featured_style = get_theme_mod('total_plus_featured_style', 'style1');
    $total_plus_featured_title_style = get_theme_mod('total_plus_featured_title_style', 'ht-section-title-top-center');

    $feature_class = array(
        'ht-featured-post-wrap',
        $total_plus_featured_style,
        'ht-col-' . $total_plus_featured_col
    );
    ?>
    <div class="<?php echo implode(' ', $feature_class) ?>">
        <?php
        $featured_blocks = json_decode(get_theme_mod('total_plus_featured'));

        if (!empty($featured_blocks)) {

            foreach ($featured_blocks as $featured_block) {
                $featured_block_icon = $featured_block->icon;
                $featured_block_title = !empty($featured_block->title) ? apply_filters('total_plus_translate_string', $featured_block->title, 'Featured Block') : '';
                $featured_block_content = !empty($featured_block->content) ? apply_filters('total_plus_translate_string', $featured_block->content, 'Featured Block') : '';
                $featured_block_link_text = !empty($featured_block->link_text) ? apply_filters('total_plus_translate_string', $featured_block->link_text, 'Featured Block') : esc_html__('Read More', 'total-plus');
                $featured_block_link = !empty($featured_block->link) ? apply_filters('total_plus_translate_string', $featured_block->link, 'Featured Block') : '';
                $featured_block_enable = $featured_block->enable;
                if ($featured_block_enable == 'on') {
                    ?>
                    <div class="ht-featured-post">
                        <div class="ht-featured-icon"><i class="<?php echo esc_attr($featured_block_icon); ?>"></i></div>
                        <h5><?php echo esc_html($featured_block_title); ?></h5>
                        <div class="ht-featured-excerpt">
                            <?php echo wp_kses_post($featured_block_content); ?>
                        </div>
                        <?php if (!empty($featured_block_link)) { ?>
                            <div class="ht-featured-link">
                                <a href="<?php echo esc_url($featured_block_link); ?>"><?php echo esc_html($featured_block_link_text); ?><i class="mdi mdi-chevron-right"></i></a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <?php

    if( $total_plus_featured_title_style != 'ht-section-title-single-row' && $total_plus_featured_title_style != 'ht-section-title-side' ){
        $button_text = get_theme_mod('total_plus_featured_button_text');
        $button_link = get_theme_mod('total_plus_featured_button_link');

        if( $button_text && $button_link){
            echo '<div class="ht-section-button">';
            echo '<a class="ht-button" href="' . esc_attr($button_link) . '">' . esc_html($button_text) . '</a>';
            echo '</div>';
        }
    }
}
