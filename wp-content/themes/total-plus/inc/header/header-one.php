<?php
/**
 * @package Total Plus
 */
$total_plus_mh_menu_hover_style = get_theme_mod('total_plus_mh_menu_hover_style', 'hover-style1');
$total_plus_th_disable_mobile = get_theme_mod('total_plus_th_disable_mobile', false);

$header_class = array('ht-site-header', 'ht-header-one', 'headroom', $total_plus_mh_menu_hover_style);

if($total_plus_th_disable_mobile){
    $header_class[] = 'ht-topheader-mobile-disable';
}
?>

<header id="ht-masthead" class="<?php echo esc_attr(implode(' ', $header_class)); ?>">
    <?php
    $total_plus_top_header = get_theme_mod('total_plus_top_header', 'off');
    if ($total_plus_top_header == 'on') {
        ?>
        <div class="ht-top-header">
            <div class="ht-container ht-clearfix">
                <?php do_action('total_plus_top_header'); ?>
            </div>
        </div><!-- .ht-top-header -->
    <?php } ?>

    <div class="ht-header">
        <div class="ht-container">
            <div id="ht-site-branding">
                <?php total_plus_header_logo(); ?>
            </div><!-- .site-branding -->

            <nav id="ht-site-navigation" class="ht-main-navigation">
                <?php total_plus_main_navigation(); ?>
                <?php do_action('total_plus_mobile_header'); ?>
            </nav><!-- #ht-site-navigation -->
        </div>
    </div>
</header><!-- #ht-masthead -->