<?php
/**
 * The header for our theme.
 *
 * @package Total Plus
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php do_action('total_plus_before_page'); ?>
        <div id="ht-page">
            <?php
            if( is_singular(array('post', 'page', 'product', 'portfolio')) ){
                $hide_header = rwmb_meta('hide_header');
            }else{
                $hide_header = '';
            }
            
            if (!$hide_header) {
                do_action('total_plus_header');
            }
            ?>
            <div id="ht-content" class="ht-site-content ht-clearfix">