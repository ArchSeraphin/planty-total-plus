<?php
/**
 * @package Total Plus
 */
add_action('total_plus_mobile_header', 'total_plus_header_button', 20);
add_action('total_plus_mobile_header', 'total_plus_responsive_navigation', 10);
add_action('total_plus_header', 'total_plus_header_styles');
add_action('total_plus_top_header', 'total_plus_top_left_header');
add_action('total_plus_top_header', 'total_plus_top_right_header');
add_action('total_plus_social_icons', 'total_plus_social_icons');

function total_plus_header_styles() {
    $header_style = get_theme_mod('total_plus_mh_layout', 'header-style1');

    switch ($header_style) {
        case 'header-style1':
            get_template_part('inc/header/header', 'one');
            break;

        case 'header-style2':
            get_template_part('inc/header/header', 'two');
            break;

        case 'header-style3':
            get_template_part('inc/header/header', 'three');
            break;

        case 'header-style4':
            get_template_part('inc/header/header', 'four');
            break;

        case 'header-style5':
            get_template_part('inc/header/header', 'five');
            break;

        case 'header-style6':
            get_template_part('inc/header/header', 'six');
            break;

        case 'header-style7':
            get_template_part('inc/header/header', 'seven');
            break;

        case 'header-style8':
            get_template_part('inc/header/header', 'eight');
            break;

        case 'header-style9':
            get_template_part('inc/header/header', 'nine');
            break;

        default:
            get_template_part('inc/header/header', 'one');
            break;
    }
}

function total_plus_header_logo() {
    $hide_title = get_theme_mod('total_plus_hide_title');
    $hide_tagline = get_theme_mod('total_plus_hide_tagline');

    if (function_exists('has_custom_logo') && has_custom_logo()) {
        the_custom_logo();
    }

    if (!$hide_title || !$hide_tagline) {
        ?>
        <div class="ht-site-title-tagline">
            <?php
            if (!$hide_title) {
                if (is_front_page()) :
                    ?>
                    <h1 class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                    <p class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                <?php
                endif;
            }

            if (!$hide_tagline) {
                ?>
                <p class="ht-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                <?php
            }
            ?>
        </div>
        <?php
    }
}

function total_plus_main_navigation() {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container_class' => 'ht-menu ht-clearfix',
        'menu_class' => 'ht-clearfix',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'fallback_cb' => false,
        'walker' => new Total_Plus_Custom_Nav_Walker()
    ));
}

function total_plus_responsive_navigation() {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container_id' => 'ht-mobile-menu',
        'menu_id' => 'ht-responsive-menu',
        'items_wrap' => '<div class="menu-collapser"><div class="collapse-button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div></div><ul id="%1$s" class="%2$s">%3$s</ul>',
        'fallback_cb' => false,
        'walker' => new Total_Plus_Custom_Nav_Walker()
    ));
}

function total_plus_top_header_menu() {
    $menu_id = get_theme_mod('total_plus_th_menu');

    if (!empty($menu_id)) {
        wp_nav_menu(array(
            'menu' => $menu_id,
            'container' => NULL,
            'menu_class' => 'ht-clearfix',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => -1
        ));
    }
}

function total_plus_top_header_widget() {
    $widget_id = get_theme_mod('total_plus_th_widget');

    if (!empty($widget_id) && is_active_sidebar($widget_id)) {
        dynamic_sidebar($widget_id);
    }
}

function total_plus_top_header_text() {
    $text = get_theme_mod('total_plus_th_text', __('California, TX 70240 | (1800) 456 7890', 'total-plus'));

    if (!empty($text)) {
        echo wp_kses_post(force_balance_tags($text));
    }
}

function total_plus_top_left_header() {
    $left_header = get_theme_mod('total_plus_th_left_display', 'none');
    if ($left_header !== 'none') {
        ?>
        <div class="ht-th-left th-<?php echo esc_attr($left_header) ?>">
            <?php
            if ($left_header == 'social') {
                do_action('total_plus_social_icons');
            } elseif ($left_header == 'menu') {
                total_plus_top_header_menu();
            } elseif ($left_header == 'widget') {
                total_plus_top_header_widget();
            } elseif ($left_header == 'text') {
                total_plus_top_header_text();
            }
            ?>
        </div><!-- .ht-th-left -->
        <?php
    }
}

function total_plus_top_right_header() {
    $right_header = get_theme_mod('total_plus_th_right_display', 'text');
    if ($right_header !== 'none') {
        ?>
        <div class="ht-th-right th-<?php echo esc_attr($right_header) ?>">
            <?php
            if ($right_header == 'social') {
                do_action('total_plus_social_icons');
            } elseif ($right_header == 'menu') {
                total_plus_top_header_menu();
            } elseif ($right_header == 'widget') {
                total_plus_top_header_widget();
            } elseif ($right_header == 'text') {
                total_plus_top_header_text();
            }
            ?>
        </div><!-- .ht-th-right -->
        <?php
    }
}

function total_plus_social_icons() {
    $social_icons = get_theme_mod('total_plus_social_icons');
    $social_icons = json_decode($social_icons);

    if (!empty($social_icons)) {
        foreach ($social_icons as $social_icon) {
            if ($social_icon->enable === 'on' && !empty($social_icon->link)) {
                echo '<a href="' . esc_attr($social_icon->link) . '" target="_blank"><i class="' . esc_attr($social_icon->icon) . '"></i></a>';
            }
        }
    }
}

function total_plus_menu_social_icons() {
    $social_icons = get_theme_mod('total_plus_social_icons');
    $social_icons = json_decode($social_icons);
    $icons = '';

    foreach ($social_icons as $social_icon) {
        if ($social_icon->enable === 'on') {
            $icons .= '<li class="menu-item menu-item-social-icon"><a target="_blank" href="' . esc_attr($social_icon->link) . '"><i class="' . esc_attr($social_icon->icon) . '"></i></a></li>';
        }
    }
    return $icons;
}

function total_plus_header_button(){
    $total_plus_header_button_disable = get_theme_mod('total_plus_header_button_disable', 'on');
    $total_plus_hb_text = get_theme_mod('total_plus_hb_text',__('Call Us', 'total-plus'));
    $total_plus_hb_link = get_theme_mod('total_plus_hb_link', __('tel:981123232', 'total-plus'));
    $total_plus_hb_disable_mobile = get_theme_mod('total_plus_hb_disable_mobile', true);
    $button_class = $total_plus_hb_disable_mobile ? ' ht-mobile-hide' : '';
    
    if( $total_plus_header_button_disable == 'off' ){
        echo '<a class="ht-header-bttn'.$button_class.'" href="'.esc_attr($total_plus_hb_link).'">'.wp_kses_post($total_plus_hb_text).'</a>';
    }
}

if (!function_exists('total_plus_add_search_block')) {

    function total_plus_add_search_block($items, $args) {
        $enable_search = get_theme_mod('total_plus_mh_show_search', false);

        if ($enable_search) {
            if ($args->theme_location == 'primary') {
                $items .= '<li class="menu-item menu-item-search"><a href="javascript:void(0)"><i class="icofont-search-1"></i></a></li>';
            }
        }
        return $items;
    }

}

add_filter('wp_nav_menu_items', 'total_plus_add_search_block', 10, 2);

if (!function_exists('total_plus_add_social_icons')) {

    function total_plus_add_social_icons($items, $args) {
        $enable_icons = get_theme_mod('total_plus_mh_show_social', false);

        if ($enable_icons) {
            if ($args->theme_location == 'primary') {
                $items .= total_plus_menu_social_icons();
            }
        }
        return $items;
    }

}

add_filter('wp_nav_menu_items', 'total_plus_add_social_icons', 9, 2);

if (!function_exists('total_plus_header_search_wrapper')) {

    function total_plus_header_search_wrapper() {
        $enable_search = get_theme_mod('total_plus_mh_show_search', false);
        $placeholder_text = esc_attr__('Type and hit Enter', 'total-plus');
        $form = '<div class="ht-search-wrapper">';
        $form .= '<div class="ht-search-close"><div class="total-plus-selected-icon"><i class="flaticon-multiply"></i></div></div>';
        $form .= '<div class="ht-search-container">';
        $form .= '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">';
        $form .= '<input autocomplete="off" type="search" class="search-field" placeholder="' . $placeholder_text . '" value="' . get_search_query() . '" name="s" />';
        $form .= '<input type="submit" class="search-submit" value="' . esc_attr__('Search', 'total-plus') . '" />';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div>';

        $result = apply_filters('get_search_form', $form);

        if ($enable_search) {
            echo $result;
        }
    }

}

add_action('wp_footer', 'total_plus_header_search_wrapper');
