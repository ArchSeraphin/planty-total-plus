<?php

/**
 * The header for our theme.
 *
 * @package Total Plus
 */
function total_plus_preloader() {
    $enable_preloader = get_theme_mod('total_plus_preloader', 'off');
    $preloader_type = get_theme_mod('total_plus_preloader_type', 'preloader1');
    $preloader_image = get_theme_mod('total_plus_preloader_image', 'off');

    if ($enable_preloader == 'on') {
        echo '<div id="ht-preloader-wrap">';
        if ($preloader_type != 'custom') {
            get_template_part('inc/preloader/' . $preloader_type);
        } else {
            echo '<img src="' . esc_url($preloader_image) . '" alt="Preloader"/>';
        }
        echo '</div>';
    }
}

add_action('total_plus_before_page', 'total_plus_preloader');

function total_plus_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $total_plus_hide_titlebar = $total_plus_sidebar_layout = $disable_space_below_header = $disable_space_above_footer = '';

    $customizer_home_settings = of_get_option('customizer_home_settings', '1');
    $total_plus_enable_frontpage = get_theme_mod('total_plus_enable_frontpage', total_plus_enable_frontpage_default());

    if (is_front_page() && $customizer_home_settings && $total_plus_enable_frontpage) {
        $classes[] = 'ht-enable-frontpage';
    }

    $total_plus_hide_titlebar = $total_plus_sidebar_layout = $disable_space_below_header = $disable_space_above_footer = '';

    if (is_singular('page') || is_singular('portfolio')) {
        global $post;
        $total_plus_hide_titlebar = rwmb_meta('hide_titlebar', $post->ID);
        $disable_space_below_header = rwmb_meta('disable_space_below_header', $post->ID);
        $disable_space_above_footer = rwmb_meta('disable_space_above_footer', $post->ID);
        $total_plus_sidebar_layout = rwmb_meta('sidebar_layout', $post->ID);
        if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
            $total_plus_sidebar_layout = get_theme_mod('total_plus_page_layout', 'right-sidebar');
        }
    } elseif (is_singular('post')) {
        global $post;
        $total_plus_hide_titlebar = rwmb_meta('hide_titlebar', $post->ID);
        $total_plus_sidebar_layout = rwmb_meta('sidebar_layout', $post->ID);
        if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
            $total_plus_sidebar_layout = get_theme_mod('total_plus_post_layout', 'right-sidebar');
        }
    } elseif (total_plus_is_woocommerce_activated() && is_woocommerce()) {
        global $post;
        if (is_singular()) {
            $total_plus_hide_titlebar = rwmb_meta('hide_titlebar', $post->ID);
            $total_plus_sidebar_layout = rwmb_meta('sidebar_layout', $post->ID);
        }

        if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
            $total_plus_sidebar_layout = get_theme_mod('total_plus_shop_layout', 'right-sidebar');
        }
    } elseif (is_archive() && !is_home() && !is_search()) {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_archive_layout', 'right-sidebar');
    } elseif (is_home()) {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_home_blog_layout', 'right-sidebar');
    } elseif (is_search()) {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_search_layout', 'right-sidebar');
    } else {
        $total_plus_sidebar_layout = 'right-sidebar';
    }

    $classes[] = 'ht-' . $total_plus_sidebar_layout;

    $sticky_header = get_theme_mod('total_plus_sticky_header', 'off');
    $website_layout = get_theme_mod('total_plus_website_layout', 'wide');
    $header_position = get_theme_mod('total_plus_header_position', 'header-above');
    $header_style = get_theme_mod('total_plus_mh_layout', 'header-style1');
    $sidebar_style = get_theme_mod('total_plus_sidebar_style', 'sidebar-style1');

    if ($header_style == 'header-style1' || $header_style == 'header-style4') {
        $classes[] = 'ht-' . $header_position;
    } elseif ($header_style == 'header-style6') {
        $classes[] = 'ht-header-above';
    } else {
        $classes[] = 'ht-header-over';
    }

    if ($sticky_header == 'on') {
        $classes[] = 'ht-sticky-header';
    }

    if ($total_plus_hide_titlebar) {
        $classes[] = 'ht-hide-titlebar';
    }

    if ($disable_space_below_header) {
        $classes[] = 'ht-no-header-space';
    }

    if ($disable_space_above_footer) {
        $classes[] = 'ht-no-footer-space';
    }

    $classes[] = 'ht-' . $website_layout;

    $classes[] = 'ht-' . $header_style;

    $classes[] = 'ht-' . $sidebar_style;

    return $classes;
}

add_filter('body_class', 'total_plus_body_classes');

if (!function_exists('total_plus_change_wp_page_menu_args')) {

    function total_plus_change_wp_page_menu_args($args) {
        $args['menu_class'] = 'ht-menu ht-clearfix';
        return $args;
    }

}

add_filter('wp_page_menu_args', 'total_plus_change_wp_page_menu_args');

function total_plus_breadcrumbs() {
    $total_plus_breadcrumb = get_theme_mod('total_plus_breadcrumb', true);
    if (!$total_plus_breadcrumb) {
        return;
    }

    $args = array(
        'show_browse' => false,
        'show_on_front' => false,
    );
    breadcrumb_trail($args);
}

add_action('total_plus_breadcrumbs', 'total_plus_breadcrumbs');

function total_plus_convert_to_negative($arg) {
    return('-' . $arg);
}

function total_plus_remove_category($query) {
    $category = get_theme_mod('total_plus_blog_cat');
    $category_array = explode(',', $category);
    $category_array = array_map('total_plus_convert_to_negative', $category_array);
    $category = implode(',', $category_array);
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', $category);
    }
}

add_action('pre_get_posts', 'total_plus_remove_category');

// Allow HTML in author bio section 
remove_filter('pre_user_description', 'wp_filter_kses');

/* Add Author Links */
if (!function_exists('total_plus_add_to_author_profile')) {

    function total_plus_add_to_author_profile($contactmethods) {
        $contactmethods['twitter_profile'] = __('Twitter Profile URL', 'total-plus');
        $contactmethods['facebook_profile'] = __('Facebook Profile URL', 'total-plus');
        $contactmethods['linkedin_profile'] = __('Linkedin Profile URL', 'total-plus');
        $contactmethods['instagram_profile'] = __('Instagram Profile URL', 'total-plus');
        $contactmethods['rss_url'] = __('RSS URL', 'total-plus');

        return $contactmethods;
    }

}

add_filter('user_contactmethods', 'total_plus_add_to_author_profile', 10, 1);

function total_plus_siteorigin_cpt() {
    if (class_exists('SiteOrigin_Panels')) {
        $post_types = SiteOrigin_Panels_Settings::single()->get('post-types');
        if (!in_array('portfolio', $post_types) && !in_array('ht-megamenu', $post_types)) {
            $new_post_type = array('portfolio', 'ht-megamenu');
            $post_types = array_merge($new_post_type, $post_types);
            SiteOrigin_Panels_Settings::single()->set('post-types', $post_types);
        }
    }
}

add_action('init', 'total_plus_siteorigin_cpt', 15);

function total_plus_add_cpt_support() {
    $cpt_support = get_option('elementor_cpt_support');

    if (!$cpt_support) {
        $cpt_support = ['page', 'post', 'portfolio', 'ht-megamenu'];
        update_option('elementor_cpt_support', $cpt_support);
    } else if (!in_array('portfolio', $cpt_support) || !in_array('ht-megamenu', $cpt_support)) {
        $cpt_support[] = 'portfolio';
        $cpt_support[] = 'ht-megamenu';
        update_option('elementor_cpt_support', $cpt_support);
    }
}

add_action('after_switch_theme', 'total_plus_add_cpt_support');

function total_plus_add_top_seperator($section_name) {
    $section_seperator = get_theme_mod("total_plus_{$section_name}_section_seperator", "no");
    if ($section_seperator == 'top' || $section_seperator == 'top-bottom') {
        $top_seperator = get_theme_mod("total_plus_{$section_name}_top_seperator", 'big-triangle-center');
        echo '<div class="ht-section-seperator top-section-seperator svg-' . $top_seperator . '-wrap">';
        get_template_part("inc/svg/{$top_seperator}");
        echo '</div>';
    }
}

function total_plus_add_bottom_seperator($section_name) {
    $section_seperator = get_theme_mod("total_plus_{$section_name}_section_seperator", "no");
    $bg_type = get_theme_mod("total_plus_{$section_name}_bg_type");
    $bg_video = get_theme_mod("total_plus_{$section_name}_bg_video", '6O9Nd1RSZSY');

    if ($section_seperator == 'bottom' || $section_seperator == 'top-bottom') {
        $bottom_seperator = get_theme_mod("total_plus_{$section_name}_bottom_seperator", 'big-triangle-center');

        echo '<div class="ht-section-seperator bottom-section-seperator svg-' . $bottom_seperator . '-wrap">';
        get_template_part("inc/svg/{$bottom_seperator}");
        echo '</div>';
    }

    if ($bg_type == "video-bg" && !empty($bg_video)) {
        wp_enqueue_script('YTPlayer');
    }
}

function add_slider_bottom_section_seperator() {
    $bottom_seperator = get_theme_mod("total_plus_slider_bottom_seperator", 'none');

    if ($bottom_seperator != 'none') {
        echo '<div class="ht-section-seperator bottom-section-seperator svg-' . $bottom_seperator . '-wrap">';
        get_template_part("inc/svg/{$bottom_seperator}");
        echo '</div>';
    }
}

add_action("after_slider_section", "add_slider_bottom_section_seperator");

function total_plus_maintenance_mode() {
    global $pagenow;
    $total_plus_maintenance = get_theme_mod('total_plus_maintenance', 'off');
    $customizer_maintenance_mode = of_get_option('customizer_maintenance_mode', '1');

    if ($customizer_maintenance_mode && $total_plus_maintenance == 'on' && $pagenow !== 'wp-login.php' && !current_user_can('manage_options') && !is_admin()) {
        if (file_exists(get_template_directory() . '/inc/maintenance.php')) {
            require_once get_template_directory() . '/inc/maintenance.php';
        }
        die();
    }
}

add_action('wp_loaded', 'total_plus_maintenance_mode');

function total_plus_maintenance_mode_on_adminbar($wp_admin_bar) {
    $maintenance_mode = get_theme_mod('total_plus_maintenance', 'off');
    $customizer_maintenance_mode = of_get_option('customizer_maintenance_mode', '1');

    if ($customizer_maintenance_mode && $maintenance_mode == 'on') {
        $args = array(
            'id' => 'total-plus-maintenance-mode',
            'title' => 'Maintenance Mode Active',
            'href' => admin_url('/customize.php?autofocus[section]=total_plus_maintenance_section')
        );
        $wp_admin_bar->add_node($args);
    }
}

add_action('admin_bar_menu', 'total_plus_maintenance_mode_on_adminbar', 999);

function total_plus_login_logo() {
    $admin_logo = get_theme_mod('total_plus_admin_logo');
    $width = get_theme_mod('total_plus_admin_logo_width', 180);
    $height = get_theme_mod('total_plus_admin_logo_height', 80);
    if ($admin_logo) {
        ?> 
        <style type="text/css"> 
            body.login div#login h1 a {
                background-image: url(<?php echo esc_url($admin_logo); ?>); 
                width: <?php echo absint($width) ?>px;
                height: <?php echo absint($height) ?>px;
                background-size: contain;
            } 
        </style>
        <?php
    }
}

add_action('login_enqueue_scripts', 'total_plus_login_logo');

function total_plus_login_link() {
    $admin_logo_link = get_theme_mod('total_plus_admin_logo_link');
    if ($admin_logo_link) {
        return $admin_logo_link;
    }
}

add_filter('login_headerurl', 'total_plus_login_link');

function total_plus_gdpr_notice() {
    $enable_notice = get_theme_mod('total_plus_enable_gdpr', 'off');
    $customizer_gdpr_settings = of_get_option('customizer_gdpr_settings', '1');
    if ($customizer_gdpr_settings && ($enable_notice == 'on' || is_customize_preview())) {
        $policy_class = array('total-plus-privacy-policy');
        $total_plus_gdpr_notice = get_theme_mod('total_plus_gdpr_notice', esc_html__('Our website use cookies to improve and personalize your experience and to display advertisements(if any). Our website may also include cookies from third parties like Google Adsense, Google Analytics, Youtube. By using the website, you consent to the use of cookies. We have updated our Privacy Policy. Please click on the button to check our Privacy Policy.', 'total-plus'));
        $total_plus_gdpr_button_text = get_theme_mod('total_plus_gdpr_button_text', __('Privacy Policy', 'total-plus'));
        $total_plus_gdpr_button_link = get_theme_mod('total_plus_gdpr_button_link');
        $policy_class[] = get_theme_mod('total_plus_gdpr_position', 'bottom-full-width');
        $confirm_button = get_theme_mod('total_plus_gdpr_confirm_button_text', __('Ok, I Agree', 'total-plus'));
        $total_plus_gdpr_new_tab = get_theme_mod('total_plus_gdpr_new_tab', true);
        $hide_in_mobile = get_theme_mod('total_plus_gdpr_hide_mobile', false);
        $new_tab = $total_plus_gdpr_new_tab ? 'target="_blank"' : '';
        $policy_class[] = $hide_in_mobile ? 'policy-hide-mobile' : '';
        ?>
        <div class="<?php echo esc_attr(implode(' ', $policy_class)); ?>">
            <div class="ht-container">
                <div class="policy-text">
                    <?php echo wp_kses_post($total_plus_gdpr_notice) ?>
                </div>

                <div class="policy-buttons">
                    <a id="total-plus-confirm" href="#"><?php echo esc_html($confirm_button); ?></a>
                    <?php if ($total_plus_gdpr_button_link) { ?>
                        <a href="<?php echo esc_url($total_plus_gdpr_button_link); ?>" <?php echo esc_attr($new_tab); ?>><?php echo esc_html($total_plus_gdpr_button_text); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
}

add_action('total_plus_before_page', 'total_plus_gdpr_notice');


add_filter('get_the_archive_title', 'total_plus_edit_archive_title');

function total_plus_edit_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }

    return $title;
}

function total_plus_set_customizer_icons() {
    $all_icon_set = array('ico_font' => '1', 'font_awesome' => '1', 'essential_icon' => '1', 'material_icon' => '1');

    $icon_set = of_get_option('customizer_icon_sets', $all_icon_set);
    $icon_set = array_keys($icon_set);

    $disabled_icon_set = array_diff(array_keys($all_icon_set), $icon_set);

    foreach ($disabled_icon_set as $icon) {
        add_filter('total_plus_show_' . $icon, '__return_false');
    }
}

add_action('admin_init', 'total_plus_set_customizer_icons');

if (class_exists('RevSliderFront')) {

    add_action('after_plugin_row_revslider/revslider.php', 'total_plus_remove_plugin_row_notice', -9999);

    /**
     * Remove Slider Revolution activation notice.
     */
    function total_plus_remove_plugin_row_notice() {
        remove_action('after_plugin_row_revslider/revslider.php', array('RevSliderAdmin', 'add_notice_wrap_pre'), 10);
        remove_action('after_plugin_row_revslider/revslider.php', array('RevSliderAdmin', 'add_notice_wrap_post'), 10);
        remove_action('after_plugin_row_revslider/revslider.php', array('RevSliderAdmin', 'show_purchase_notice'), 10);
    }

}

function total_plus_demo_config($demos) {
    return include get_template_directory() . '/inc/total-plus/demo-importer/import_config.php';
}

add_action('hdi_import_files', 'total_plus_demo_config');

if (!function_exists('total_plus_create_elementor_kit')) {

    function total_plus_create_elementor_kit() {
        if (!did_action('elementor/loaded')) {
            return;
        }

        $kit = Elementor\Plugin::$instance->kits_manager->get_active_kit();

        if (!$kit->get_id()) {
            $created_default_kit = Elementor\Plugin::$instance->kits_manager->create_default();
            update_option('elementor_active_kit', $created_default_kit);
        }
    }

}

add_action('init', 'total_plus_create_elementor_kit');
