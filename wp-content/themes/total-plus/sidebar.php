<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Total Plus
 */
$total_plus_sidebar_layout = "right-sidebar";
$total_plus_sidebar_left = 'total-left-sidebar';
$total_plus_sidebar_right = 'total-right-sidebar';

if (is_singular('page')) {
    $total_plus_sidebar_layout = rwmb_meta('sidebar_layout');
    $total_plus_sidebar_left = rwmb_meta('left_sidebar') ? rwmb_meta('left_sidebar') : $total_plus_sidebar_left;
    $total_plus_sidebar_right = rwmb_meta('right_sidebar') ? rwmb_meta('right_sidebar') : $total_plus_sidebar_right;

    if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_page_layout', 'right-sidebar');
    }
} elseif (is_singular('post')) {
    $total_plus_sidebar_layout = rwmb_meta('sidebar_layout');
    $total_plus_sidebar_left = rwmb_meta('left_sidebar') ? rwmb_meta('left_sidebar') : $total_plus_sidebar_left;
    $total_plus_sidebar_right = rwmb_meta('right_sidebar') ? rwmb_meta('right_sidebar') : $total_plus_sidebar_right;

    if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_post_layout', 'right-sidebar');
    }
} elseif (is_singular('product')) {
    $total_plus_sidebar_layout = rwmb_meta('sidebar_layout');
    $total_plus_sidebar_left = rwmb_meta('left_sidebar') ? rwmb_meta('left_sidebar') : $total_plus_sidebar_left;
    $total_plus_sidebar_right = rwmb_meta('right_sidebar') ? rwmb_meta('right_sidebar') : $total_plus_sidebar_right;

    if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_shop_layout', 'right-sidebar');
    }
} elseif (is_singular('portfolio')) {
    $total_plus_sidebar_layout = rwmb_meta('sidebar_layout');
    $total_plus_sidebar_left = rwmb_meta('left_sidebar') ? rwmb_meta('left_sidebar') : $total_plus_sidebar_left;
    $total_plus_sidebar_right = rwmb_meta('right_sidebar') ? rwmb_meta('right_sidebar') : $total_plus_sidebar_right;

    if (!$total_plus_sidebar_layout || $total_plus_sidebar_layout == 'default-sidebar') {
        $total_plus_sidebar_layout = get_theme_mod('total_plus_page_layout', 'right-sidebar');
    }
} elseif (is_archive() && !is_home() && !is_search()) {
    $total_plus_sidebar_layout = get_theme_mod('total_plus_archive_layout', 'right-sidebar');
} elseif (is_home()) {
    $total_plus_sidebar_layout = get_theme_mod('total_plus_home_blog_layout', 'right-sidebar');
} elseif (is_search()) {
    $total_plus_sidebar_layout = get_theme_mod('total_plus_search_layout', 'right-sidebar');
}

if ($total_plus_sidebar_layout == "no-sidebar" || $total_plus_sidebar_layout == "no-sidebar-narrow") {
    return;
}

if (is_active_sidebar($total_plus_sidebar_right) && $total_plus_sidebar_layout == "right-sidebar") {
    ?>
    <div id="secondary" class="widget-area">
        <?php dynamic_sidebar($total_plus_sidebar_right); ?>
    </div><!-- #secondary -->
    <?php
}

if (is_active_sidebar($total_plus_sidebar_left) && $total_plus_sidebar_layout == "left-sidebar") {
    ?>
    <div id="secondary" class="widget-area">
        <?php dynamic_sidebar($total_plus_sidebar_left); ?>
    </div><!-- #secondary -->
    <?php
}