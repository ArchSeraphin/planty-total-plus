<?php

/**
 * @package Total Plus
 */
function total_plus_dymanic_styles() {
    $custom_css = $tablet_css = $mobile_css = $ios_css = "";
    $color = get_theme_mod('total_plus_template_color', '#FFC107');
    $color_rgba = total_plus_hex2rgba($color, 0.9);
    $lighter_color_rgba = total_plus_hex2rgba($color, 0.2);
    $darker_color = totalColourBrightness($color, -0.9);
    $container_width = get_theme_mod('total_plus_website_width', 1170);
    $sidebar_width = get_theme_mod('total_plus_sidebar_width', 30);
    $primary_width = 100 - 3 - $sidebar_width;
    $half_container_width = $container_width / 2;
    $boxed_container_width = $container_width + 80;
    $header_five_top_container = $container_width - 100;
    $total_plus_preloader_color = get_theme_mod('total_plus_preloader_color', '#000000');
    $total_plus_preloader_bg_color = get_theme_mod('total_plus_preloader_bg_color', '#FFFFFF');
    $total_plus_responsive_width = get_theme_mod('total_plus_responsive_width', 780);

    /* Full & boxed width */
    $custom_css .= "
	.ht-container,.ht-slide-caption{
            max-width:{$container_width}px;
	}
	body.ht-boxed #ht-page{
            max-width:{$boxed_container_width}px;
	}
	.ht-header-five .ht-top-header.ht-container{
            max-width:{$header_five_top_container}px;
	}
        #primary{ width:{$primary_width}%}
        #secondary{ width:{$sidebar_width}%}
	";

    /* Site Title & Tagline Color */
    $total_plus_title_color = get_theme_mod('total_plus_title_color', '#333333');
    $custom_css .= ".ht-site-title-tagline a, .ht-site-title a, .ht-site-title-tagline a:hover, .ht-site-title a:hover, .ht-site-description{color:$total_plus_title_color}";

    /* Preloader CSS */
    $custom_css .= "
	#ht-preloader-wrap{background: $total_plus_preloader_bg_color;}
	.ball-pulse-sync>div, 
	.ball-pulse>div, 
	.ball-scale-random>div, 
	.ball-scale>div,
	.ball-grid-beat>div, 
	.ball-grid-pulse>div, 
	.ball-pulse-rise>div,
	.total-spin>div,
	.ball-rotate>div,
	.ball-rotate>div:before, 
	.ball-rotate>div:after,
	.cube-transition>div,
	.ball-zig-zag>div,
	.line-scale>div,
	.ball-scale-multiple>div,
	.line-scale-pulse-out>div,
	.ball-spin-fade-loader>div,
	.pacman>div:nth-child(3), 
	.pacman>div:nth-child(4), 
	.pacman>div:nth-child(5), 
	.pacman>div:nth-child(6){
        background: $total_plus_preloader_color;
        }
        
	.ball-clip-rotate>div,
	.ball-clip-rotate-multiple>div,
	.ball-scale-ripple-multiple>div,
	.pacman>div:first-of-type,
	.pacman>div:nth-child(2){
            border-color:$total_plus_preloader_color;
        }";

    /* Typography CSS */
    $fonts = total_plus_get_customizer_fonts();
    $font_class = array(
        'body' => 'html, body, button, input, select, textarea, .megamenu-category .mega-post-title',
        'menu' => '.ht-menu > ul > li > a, a.ht-header-bttn',
        'section_title' => '.ht-section-title',
        'page_title' => '.ht-main-title',
        'h1' => 'h1, .ht-site-title, .entry-header div.entry-title',
        'h2' => 'h2',
        'h3' => 'h3',
        'h4' => 'h4',
        'h5' => 'h5',
        'h6' => 'h6',
        'h' => 'h1, h2, h3, h4, h5, h6, .ht-site-title, .entry-header div.entry-title'
    );

    foreach ($fonts as $key => $value) {
        $font_css = array();
        $font_family = get_theme_mod($key . '_font_family', $value['font_family']);
        $font_style = get_theme_mod($key . '_font_style', $value['font_style']);
        $text_transform = get_theme_mod($key . '_text_transform', $value['text_transform']);
        $text_decoration = get_theme_mod($key . '_text_decoration', $value['text_decoration']);
        if ($key != 'h') {
            $font_size = get_theme_mod($key . '_font_size', $value['font_size']);
        }
        $line_height = get_theme_mod($key . '_line_height', $value['line_height']);
        $letter_spacing = get_theme_mod($key . '_letter_spacing', $value['letter_spacing']);
        if ($key == 'body') {
            $font_color = get_theme_mod($key . '_color', $value['color']);
        }
        $font_italic = 'normal';

        if (strpos($font_style, 'italic')) {
            $font_italic = 'italic';
        }

        $font_weight = absint($font_style);

        $font_css[] = !empty($font_family) ? "font-family: '{$font_family}', serif" : '';
        $font_css[] = !empty($font_weight) ? "font-weight: {$font_weight}" : '';
        $font_css[] = !empty($font_italic) ? "font-style: {$font_italic}" : '';
        $font_css[] = !empty($text_transform) ? "text-transform: {$text_transform}" : '';
        $font_css[] = !empty($text_decoration) ? "text-decoration: {$text_decoration}" : '';
        if ($key != 'h') {
            $font_css[] = !empty($font_size) ? "font-size: {$font_size}px" : '';
        }
        $font_css[] = !empty($line_height) ? "line-height: {$line_height}" : '';
        $font_css[] = !empty($letter_spacing) ? "letter-spacing: {$letter_spacing}px" : '';
        if ($key == 'body') {
            $font_css[] = !empty($font_color) ? "color: {$font_color}" : '';
        }

        $font_style = implode(';', $font_css);

        $custom_css .= "
            $font_class[$key]{{$font_style}}";
    }

    $common_header_typography = get_theme_mod('common_header_typography', false);

    if ($common_header_typography) {
        $header_font_size = get_theme_mod('h_font_size', 42);
        $font_size = $header_font_size - 10;
        $font_increment = intval($font_size / 6);
        $h2_font_size = $header_font_size - $font_increment;
        $h3_font_size = $header_font_size - $font_increment * 2;
        $h4_font_size = $header_font_size - $font_increment * 3;
        $h5_font_size = $header_font_size - $font_increment * 4;
        $h6_font_size = $header_font_size - $font_increment * 5;

        $custom_css .= "h2{font-size:{$h2_font_size}px}";
        $custom_css .= "h3{font-size:{$h3_font_size}px}";
        $custom_css .= "h4{font-size:{$h4_font_size}px}";
        $custom_css .= "h5{font-size:{$h5_font_size}px}";
        $custom_css .= "h6{font-size:{$h6_font_size}px}";
    }

    $i_font_size = get_theme_mod('menu_font_size', 14);
    $i_font_family = get_theme_mod('menu_font_family', 'Oswald');
    $custom_css .= "
	.ht-main-navigation{
        font-size: {$i_font_size}px;
        font-family: $i_font_family;
	}
        .single-ht-megamenu .ht-main-content{
        font-family: $i_font_family;
        }
	";

    $total_plus_content_header_color = get_theme_mod('total_plus_content_header_color', '#000000');
    $total_plus_content_text_color = get_theme_mod('total_plus_content_text_color', '#333333');
    $total_plus_content_link_color = get_theme_mod('total_plus_content_link_color', '#000000');
    $total_plus_content_link_hov_color = get_theme_mod('total_plus_content_link_hov_color', '#000000');
    $total_plus_content_widget_title_color = get_theme_mod('total_plus_content_widget_title_color', '#000000');
    $total_plus_content_light_color = total_plus_hex2rgba($total_plus_content_text_color, 0.1);
    $total_plus_content_lighter_color = total_plus_hex2rgba($total_plus_content_text_color, 0.05);

    $custom_css .= ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6 {color:$total_plus_content_header_color}";
    $custom_css .= ".ht-main-content{color:$total_plus_content_text_color}";
    $custom_css .= "a{color:$total_plus_content_link_color}";
    $custom_css .= "a:hover{color:$total_plus_content_link_hov_color}";
    $custom_css .= ".widget-area li{border-color:$total_plus_content_lighter_color}";
    $custom_css .= ".ht-sidebar-style2 .widget-area .widget{border-color:$total_plus_content_light_color}";
    $custom_css .= ".widget-area .widget-title, #reply-title, #comments .comments-title, .total-plus-related-post .related-post-title{color:$total_plus_content_widget_title_color}";
    $custom_css .= ".ht-sidebar-style1 .widget-area .widget-title:after, .ht-sidebar-style1 #reply-title:after, .ht-sidebar-style1 #comments .comments-title:after, .ht-sidebar-style1 .total-plus-related-post .related-post-title:after, .ht-sidebar-style2 .widget-area .widget:before {background-color:$total_plus_content_widget_title_color}";
    $custom_css .= ".ht-sidebar-style3 .widget-area .widget-title, .ht-sidebar-style3 #reply-title,.ht-sidebar-style3 #comments .comments-title,.ht-sidebar-style3 .total-plus-related-post .related-post-title {border-color:$total_plus_content_widget_title_color}";

    /* Top Header */
    $total_plus_th_bg_color = get_theme_mod('total_plus_th_bg_color', '#FFC107');
    $total_plus_th_text_color = get_theme_mod('total_plus_th_text_color', '#FFFFFF');
    $total_plus_th_anchor_color = get_theme_mod('total_plus_th_anchor_color', '#EEEEEE');
    $total_plus_th_padding = get_theme_mod('total_plus_th_padding', 15);
    $total_plus_mh_height = get_theme_mod('total_plus_mh_height', 90);
    $total_plus_mh_half_height = $total_plus_mh_height / 2;
    $total_plus_mh_bg_color = get_theme_mod('total_plus_mh_bg_color', '#FFFFFF');
    $total_plus_mh_bg_color_mobile = get_theme_mod('total_plus_mh_bg_color_mobile', '#FFFFFF');
    $total_plus_mh_menu_color = get_theme_mod('total_plus_mh_menu_color', '#333333');
    $total_plus_mh_menu_hover_color = get_theme_mod('total_plus_mh_menu_hover_color', '#333333');
    $total_plus_mh_menu_hover_bg_color = get_theme_mod('total_plus_mh_menu_hover_bg_color', '#FFC107');
    $total_plus_mh_submenu_bg_color = get_theme_mod('total_plus_mh_submenu_bg_color', '#FFFFFF');
    $total_plus_mh_submenu_color = get_theme_mod('total_plus_mh_submenu_color', '#333333');
    $total_plus_mh_submenu_hover_color = get_theme_mod('total_plus_mh_submenu_hover_color', '#333333');
    $total_plus_mh_submenu_hover_bg_color = get_theme_mod('total_plus_mh_submenu_hover_bg_color');
    $total_plus_menu_dropdown_padding = get_theme_mod('total_plus_menu_dropdown_padding', 0);
    $total_plus_logo_actual_height = get_theme_mod('total_plus_logo_height', 50);
    $total_plus_logo_height = $total_plus_mh_height - 30;
    $total_plus_border_height = $total_plus_mh_height + 25;
    $total_caption_top_margin = $total_plus_mh_half_height + 25;
    $total_plus_header3_height = $total_plus_mh_height + 4;
    $total_header4_bottom_margin = $total_plus_mh_half_height + 40;
    $total_plus_logo_min_height = min($total_plus_logo_height, $total_plus_logo_actual_height);
    $custom_css .= "
        .ht-site-header .ht-top-header{
            background: $total_plus_th_bg_color;
            color: $total_plus_th_text_color;
            padding-top: {$total_plus_th_padding}px;
            padding-bottom: {$total_plus_th_padding}px;
        }

        .ht-site-header .ht-top-header a,
        .ht-site-header .ht-top-header a:hover,
        .ht-site-header .ht-top-header a i,
        .ht-site-header .ht-top-header a:hover i{
            color: $total_plus_th_anchor_color;
        }

        .ht-header-one .ht-header,
        .ht-header-two .ht-header .ht-container,
        .ht-header-three .ht-header .ht-container,
        .ht-header-four .ht-header .ht-container,
        .ht-header-five .ht-header .ht-container,
        .ht-sticky-header .ht-header-two .ht-header.headroom.headroom--not-top,
        .ht-sticky-header .ht-header-three .ht-header.headroom.headroom--not-top,
        .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top,
        .ht-sticky-header .ht-header-five .ht-header.headroom.headroom--not-top,
        .ht-header-six .ht-main-navigation{
            background: $total_plus_mh_bg_color;
        }
        
        .ht-sticky-header .ht-header-two .ht-header.headroom.headroom--not-top .ht-container,
        .ht-sticky-header .ht-header-three .ht-header.headroom.headroom--not-top .ht-container,
        .ht-sticky-header .ht-header-four .ht-header.headroom--not-top .ht-container,
        .ht-sticky-header .ht-header-five .ht-header.headroom--not-top .ht-container{
            background: none;
        }

        .ht-header-one .ht-header .ht-container,
        .ht-header-two .ht-main-navigation,
        .ht-header-four .ht-main-navigation,
        .ht-header-five .ht-header-wrap,
        .ht-header-six .ht-main-navigation .ht-container{
            height: {$total_plus_mh_height}px;
        }
        
        .ht-header-three .ht-header .ht-container{
             height: {$total_plus_header3_height}px;
        }

        .hover-style5 .ht-menu > ul > li.menu-item > a,
        .hover-style6 .ht-menu > ul > li.menu-item > a,
        .hover-style5 .ht-header-bttn,
        .hover-style6 .ht-header-bttn{
            line-height: {$total_plus_mh_height}px;
        }
        
        .ht-header-one #ht-site-branding img,
        .ht-header-two #ht-site-branding img,
        .ht-header-three #ht-site-branding img,
        .ht-header-five #ht-site-branding img{
            height: {$total_plus_logo_actual_height}px;
        }
        
        .ht-header-one #ht-site-branding img,
        .ht-header-two #ht-site-branding img,
        .ht-header-three #ht-site-branding img,
        .ht-header-five #ht-site-branding img{
            max-height: {$total_plus_logo_height}px;
        }
        
        .ht-header-four #ht-site-branding img,
        .ht-header-six #ht-site-branding img{
            max-height: {$total_plus_logo_actual_height}px;
        }
        
        .ht-menu > ul > li.menu-item > a,
        .hover-style1 .ht-menu>ul>li.menu-item.menu-item-social-icon:hover > a > i,
        .hover-style1 .ht-menu>ul>li.menu-item.menu-item-search:hover > a > i,
        .hover-style1 .ht-menu>ul>li.menu-item.menu-item-ht-cart:hover > a > i,
        .hover-style3 .ht-menu>ul>li.menu-item.menu-item-social-icon:hover > a > i,
        .hover-style3 .ht-menu>ul>li.menu-item.menu-item-search:hover > a > i,
        .hover-style3 .ht-menu>ul>li.menu-item.menu-item-ht-cart:hover > a > i,
        .hover-style5 .ht-menu>ul>li.menu-item.menu-item-social-icon:hover > a > i,
        .hover-style5 .ht-menu>ul>li.menu-item.menu-item-search:hover > a > i,
        .hover-style5 .ht-menu>ul>li.menu-item.menu-item-ht-cart:hover > a > i{
            color: $total_plus_mh_menu_color;
        }
        
        .hover-style1 .ht-menu>ul>li.menu-item:hover>a, 
        .hover-style1 .ht-menu>ul>li.menu-item.current_page_item>a, 
        .hover-style1 .ht-menu>ul>li.menu-item.current-menu-item>a, 
        .hover-style1 .ht-menu>ul>li.menu-item.current_page_ancestor>a, 
        .hover-style1 .ht-menu>ul>li.menu-item.current>a,
        .ht-menu > ul > li.menu-item:hover > a,
        .ht-menu > ul > li.menu-item:hover > a > i,
        .ht-menu > ul > li.menu-item.current_page_item > a,
        .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .ht-menu > ul > li.menu-item.current > a{
            color: $total_plus_mh_menu_hover_color;
        }

        .ht-menu ul ul,
        .menu-item-ht-cart .widget_shopping_cart,
        #ht-responsive-menu{
            background: $total_plus_mh_submenu_bg_color;
        }
        
        .ht-menu .megamenu *,
        #ht-responsive-menu .megamenu *,
        .ht-menu .megamenu a,
        #ht-responsive-menu .megamenu a,
        .ht-menu ul ul li.menu-item > a,
        .menu-item-ht-cart .widget_shopping_cart a,
        .menu-item-ht-cart .widget_shopping_cart,
        #ht-responsive-menu li.menu-item > a,
        #ht-responsive-menu li.menu-item > a i,
        #ht-responsive-menu li .dropdown-nav,
        .megamenu-category .mega-post-title a{
            color: $total_plus_mh_submenu_color;
        }
        

        .ht-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,
        .ht-menu ul ul.megamenu li.menu-item > a:hover,
        .ht-menu ul ul li.menu-item > a:hover i,
        .ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab{
            color: $total_plus_mh_submenu_hover_color;
        }
        
        .ht-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,
        .ht-menu ul ul.megamenu li.menu-item > a:hover,
        .ht-menu ul ul li.menu-item > a:hover i,
        .ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab{
            background-color: $total_plus_mh_submenu_hover_bg_color;
        }

        .ht-header-three .ht-header .ht-container,
        .ht-sticky-header .ht-header-three .ht-header.headroom.headroom--not-top{
            border-bottom: 4px solid $total_plus_th_bg_color;
        }

        .ht-header-four .ht-middle-header{
            padding-bottom: {$total_plus_mh_half_height}px;
            border-color: $total_plus_mh_bg_color;
        }

        .ht-hide-titlebar .ht-header-four#ht-masthead{
            padding-bottom: {$total_header4_bottom_margin}px;
        }

        .ht-header-five .ht-top-header + .ht-header .ht-container:before,
        .ht-header-five .ht-top-header + .ht-header .ht-container:after{
            border-bottom: {$total_plus_border_height}px solid {$total_plus_mh_bg_color};
        }

        .hover-style1 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style1 .ht-menu > ul > li.menu-item.current > a,
        .hover-style5 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style5 .ht-menu > ul > li.menu-item.current > a{
            background: $total_plus_mh_menu_hover_bg_color;
        }

        .hover-style2 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style2 .ht-menu > ul > li.menu-item.current > a,
        .hover-style4 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style4 .ht-menu > ul > li.menu-item.current > a{
            color: $total_plus_mh_menu_hover_color;
            border-color: $total_plus_mh_menu_hover_color;
        }

        .hover-style3 .ht-menu > ul > li.menu-item:hover > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current_page_item > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .hover-style3 .ht-menu > ul > li.menu-item.current > a{
            background: $total_plus_mh_menu_hover_bg_color;
        }

        .hover-style6 .ht-menu > ul > li.menu-item:hover > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current_page_item > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current-menu-item > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current_page_ancestor > a:before,
        .hover-style6 .ht-menu > ul > li.menu-item.current > a:before{
            background: $total_plus_mh_menu_hover_color;
        }

        .ht-header-over .ht-slide-caption{
            margin-top: {$total_plus_mh_half_height}px;
        }

        .ht-header-style2 .ht-slide-caption,
        .ht-header-style3 .ht-slide-caption,
        .ht-header-style5 .ht-slide-caption{
            margin-top: {$total_caption_top_margin}px;
        }
        
        .ht-menu>ul>li.menu-item{
            padding-top: {$total_plus_menu_dropdown_padding}px;
            padding-bottom: {$total_plus_menu_dropdown_padding}px;
        }
    ";

    /* Service Section Image */
    $total_plus_service_bg = get_theme_mod('total_plus_service_bg_url');
    $total_plus_service_bg_repeat = get_theme_mod('total_plus_service_bg_repeat', 'no-repeat');
    $total_plus_service_bg_size = get_theme_mod('total_plus_service_bg_size', 'auto');
    $total_plus_service_bg_position = get_theme_mod('total_plus_service_bg_pos', 'center-center');
    $total_plus_service_bg_position = str_replace('-', ' ', $total_plus_service_bg_position);
    $total_plus_service_bg_attach = get_theme_mod('total_plus_service_bg_attach', 'scroll');
    $custom_css .= "
        .ht-service-bg{ 
            background-image:url($total_plus_service_bg);
            background-repeat: $total_plus_service_bg_repeat;
            background-size: $total_plus_service_bg_size;
            background-position: $total_plus_service_bg_position;
            background-attachment: $total_plus_service_bg_attach;
        }
    ";

    if ($total_plus_service_bg && $total_plus_service_bg_attach == 'fixed') {
        $ios_css .= ".ht-service-bg{background-attachment:scroll}";
    }

    /* Banner Image */
    $total_plus_banner_image = get_theme_mod('total_plus_banner_image', get_template_directory_uri() . '/images/bg.jpg');
    $total_plus_banner_image_repeat = get_theme_mod('total_plus_banner_image_repeat', 'no-repeat');
    $total_plus_banner_image_size = get_theme_mod('total_plus_banner_image_size', 'cover');
    $total_plus_banner_image_position = get_theme_mod('total_plus_banner_image_position', 'center-center');
    $total_plus_banner_image_position = str_replace('-', ' ', $total_plus_banner_image_position);
    $total_plus_banner_image_attach = get_theme_mod('total_plus_banner_image_attach', 'fixed');
    $custom_css .= "
        .ht-main-banner{ 
            background-image:url($total_plus_banner_image);
            background-repeat: $total_plus_banner_image_repeat;
            background-size: $total_plus_banner_image_size;
            background-position: $total_plus_banner_image_position;
            background-attachment: $total_plus_banner_image_attach;
        }
    ";

    if ($total_plus_banner_image && $total_plus_banner_image_attach == 'fixed') {
        $ios_css .= ".ht-main-banner{background-attachment:scroll}";
    }

    /* Background Color */
    $custom_css .= "
        button,
        input[type='button'],
        input[type='reset'],
        input[type='submit'],
        .ht-button,
        .total-plus-related-post .related-post-title:after,
        .comment-navigation .nav-previous a,
        .comment-navigation .nav-next a,
        .pagination .page-numbers,
        .ht-slide-cap-title span,
        .ht-progress-bar-length,
        .ht-service-section.style1 .ht-service-post:after,
        .ht-service-section.style1 .ht-service-icon,
        .ht-testimonial-wrap .bx-wrapper .bx-controls-direction a,
        .ht-blog-section .ht-blog-read-more a,
        #ht-back-top:hover,
        .entry-readmore a,
        .blog-layout2 .entry-date,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product:hover .total-product-title-wrap .button,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce nav.woocommerce-pagination ul li a,
        .woocommerce nav.woocommerce-pagination ul li span,
        .woocommerce span.onsale,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce #respond input#submit.disabled,
        .woocommerce #respond input#submit:disabled,
        .woocommerce #respond input#submit:disabled[disabled],
        .woocommerce a.button.disabled, .woocommerce a.button:disabled,
        .woocommerce a.button:disabled[disabled],
        .woocommerce button.button.disabled,
        .woocommerce button.button:disabled,
        .woocommerce button.button:disabled[disabled],
        .woocommerce input.button.disabled,
        .woocommerce input.button:disabled,
        .woocommerce input.button:disabled[disabled],
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce-MyAccount-navigation-link a,

        .ht-pricing.style1:hover .ht-pricing-header,
        .ht-pricing.style1:hover .ht-pricing-header:before,
        .ht-pricing.style1:hover .ht-pricing-header:after,
        .ht-pricing.style1:hover .ht-pricing-button a,
        .ht-pricing.style1.ht-featured .ht-pricing-header,
        .ht-pricing.style1.ht-featured .ht-pricing-header:before,
        .ht-pricing.style1.ht-featured .ht-pricing-header:after,
        .ht-pricing.style1.ht-featured .ht-pricing-button a,
        .ht-pricing.style2 .ht-pricing-button a,
        .ht-pricing.style2:hover .ht-pricing-header,
        .ht-pricing.style2.ht-featured .ht-pricing-header ,
        .ht-pricing.style3 .ht-pricing-price,
        .ht-pricing.style3 .ht-pricing-main,
        .ht-pricing.style4 .ht-pricing-header,
        .ht-pricing.style4 .ht-pricing-button a,
        .ht-tab-wrap.style2 .ht-tab.ht-active,
        .ht-tab-wrap.style1 .ht-tab.ht-active:after,
        .ht-portfolio-cat-name-list.style4 .ht-portfolio-cat-wrap,
        .ht-portfolio-cat-name-list.style4 .ht-portfolio-switch,
        .footer-style3 .ht-top-footer .ht-container,
        .ht-logo-section .style2 .flipto-prev,
        .ht-logo-section .style2 .flipto-next,
        .ht-style2-accordion .ht-accordion-header,
        .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name.active:after,
        .ht-tab-wrap.style4 .ht-tab.ht-active span:before,
        .ht-tab-wrap.style5 .ht-tab.ht-active,
        .ht-tab-wrap.style5 .ht-tab.ht-active:after,
        .ht-contact-detail,
        .ht-search-close
        {
            background:{$color};
        }";

    /* Color */
    $custom_css .= "
        .blog-layout1 .ht-post-info .entry-date span.ht-day,
        .blog-layout4 .ht-post-info a:hover, 
        .blog-layout4-first .ht-post-info a:hover,
        .blog-layout3 .ht-post-info a:hover,
        .no-comments,
        .woocommerce .woocommerce-breadcrumb a:hover,
        .breadcrumb-trail a:hover span,
        .ht-portfolio-cat-name:hover,
        .ht-portfolio-cat-name.active,
        .ht-portfolio-caption a i,
        .ht-counter-icon,
        .woocommerce div.product p.price,
        .woocommerce div.product span.price,
        .woocommerce .product_meta a:hover,
        .woocommerce-error:before,
        .woocommerce-info:before,
        .woocommerce-message:before,
        .ht-pricing.style3 .ht-pricing-header h5,
        .ht-service-section.style2 .ht-service-icon i,
        .ht-service-section.style2 .ht-service-excerpt h5,
        .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name:hover, 
        .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name.active,
        .ht-style2-accordion .ht-accordion-header:before,
        .ht-contact-section .ht-contact-detail .ht-contact-social-icon a i,
        .animated-dot .middle-dot:after
        {
            color:{$color};
        }";

    /* Border Color */
    $custom_css .= "
        .ht-header-four .ht-main-navigation ul ul,
        .ht-counter,
        .ht-testimonial-wrap .bx-wrapper img,
        .ht-blog-section .style1 .ht-blog-post,
        #ht-colophon.footer-style1,
        .woocommerce ul.products li.product:hover,
        .woocommerce-page ul.products li.product:hover,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product:hover .total-product-title-wrap .button,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce div.product .woocommerce-tabs ul.tabs,
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,

        .ht-pricing.style3 ,
        .ht-service-section.style2 .ht-service-post,
        .ht-tab-wrap.style3 .ht-tab.ht-active,
        .ht-style2-accordion .ht-accordion-content-wrap,
        .ht-tab-wrap.style4 .ht-tab span,
        .ht-tab-wrap.style4 .ht-tab:after,
        .animated-dot .signal2,
        .content-area .entry-content blockquote,
        .ht-testimonial-wrap .ht-testimonial img,
        blockquote:not(.wp-block-quote)
        {
            border-color: {$color};
        }

        .woocommerce-error,
        .woocommerce-info,
        .woocommerce-message{
            border-top-color: {$color};
        }

        .nav-next a:after,
        .ht-tab-wrap.style2 .ht-tab.ht-active:after{
            border-left-color: {$color};
        }

        .nav-previous a:after{
            border-right-color: {$color};
        }

        .ht-service-section.style1 .ht-active .ht-service-icon{
            box-shadow: 0px 0px 0px 2px #FFF, 0px 0px 0px 4px {$color};
        }

        .woocommerce ul.products li.product .onsale:after{
            border-color: transparent transparent {$darker_color} {$darker_color};
        }

        .woocommerce span.onsale:after{
            border-color: transparent {$darker_color} {$darker_color} transparent
        }

        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:before{
            border-color: {$color} transparent transparent
        }

        .ht-portfolio-caption,
        .ht-team-member.style1 .ht-team-member-excerpt,
        .ht-team-member.style1 .ht-title-wrap{
            background:{$color_rgba}
        }
        
        .animated-dot .signal{
            border-color: {$lighter_color_rgba};
            box-shadow: inset 0 0 35px 10px {$lighter_color_rgba};
        }
    ";

    /* Section Background CSS */
    $total_plus_banner_overlay_color = get_theme_mod('total_plus_banner_overlay_color', 'rgba(0,0,0,0)');
    $total_plus_slider_overlay_color = get_theme_mod('total_plus_slider_overlay_color', 'rgba(0,0,0,0)');
    $custom_css .= "
        .ht-main-banner:before{background-color:$total_plus_banner_overlay_color } 
        .ht-slide:before{ background-color:$total_plus_slider_overlay_color }
    ";

    $total_plus_home_sections = total_plus_frontpage_sections();

    foreach ($total_plus_home_sections as $total_plus_home_section) {
        $section = explode('_', $total_plus_home_section);
        $sectionname = $section[2];
        $sectionid = '#ht-' . $sectionname . '-section';
        $sectionclass = '.ht-' . $sectionname . '-section';
        $sectioncolor = get_theme_mod('total_plus_' . $sectionname . '_text_color', '#333333');
        $sectiontoppadding = get_theme_mod('total_plus_' . $sectionname . '_padding_top', '100');
        $sectionbottompadding = get_theme_mod('total_plus_' . $sectionname . '_padding_bottom', '100');
        $sectiontoppadding_tablet = get_theme_mod('total_plus_' . $sectionname . '_tablet_padding_top');
        $sectionbottompadding_tablet = get_theme_mod('total_plus_' . $sectionname . '_tablet_padding_bottom');
        $sectiontoppadding_mobile = get_theme_mod('total_plus_' . $sectionname . '_mobile_padding_top');
        $sectionbottompadding_mobile = get_theme_mod('total_plus_' . $sectionname . '_mobile_padding_bottom');
        $top_seperator_height = get_theme_mod('total_plus_' . $sectionname . '_ts_height', 60);
        $bottom_seperator_height = get_theme_mod('total_plus_' . $sectionname . '_bs_height', 60);
        $top_seperator_height_tablet = get_theme_mod('total_plus_' . $sectionname . '_ts_height_tablet');
        $bottom_seperator_height_tablet = get_theme_mod('total_plus_' . $sectionname . '_bs_height_tablet');
        $top_seperator_height_mobile = get_theme_mod('total_plus_' . $sectionname . '_ts_height_mobile');
        $bottom_seperator_height_mobile = get_theme_mod('total_plus_' . $sectionname . '_bs_height_mobile');
        $sectionfullheight = get_theme_mod('total_plus_' . $sectionname . '_enable_fullwindow', 'off');
        $sectionbgtype = get_theme_mod('total_plus_' . $sectionname . '_bg_type', 'color-bg');
        $sectionbgimage = get_theme_mod('total_plus_' . $sectionname . '_bg_image_url');
        $sectionbgimage_repeat = get_theme_mod('total_plus_' . $sectionname . '_bg_image_repeat', 'no-repeat');
        $sectionbgimage_size = get_theme_mod('total_plus_' . $sectionname . '_bg_image_size', 'cover');
        $sectionbgimage_position = get_theme_mod('total_plus_' . $sectionname . '_bg_position', 'center-center');
        $sectionbgimage_position = str_replace('-', ' ', $sectionbgimage_position);
        $sectionbgimage_attach = get_theme_mod('total_plus_' . $sectionname . '_bg_image_attach', 'fixed');
        $sectionbgoverlay = get_theme_mod('total_plus_' . $sectionname . '_overlay_color', 'rgba(255,255,255,0)');
        $sectionalignitem = get_theme_mod('total_plus_' . $sectionname . '_align_item', 'top');

        $css = $css1 = array();

        if ($sectionbgtype == 'color-bg' || $sectionbgtype == 'image-bg') {
            $sectionbgcolor = get_theme_mod('total_plus_' . $sectionname . '_bg_color', '#FFFFFF');
            $css[] = "background-color: $sectionbgcolor";
        }

        if ($sectionbgtype == 'image-bg' && !empty($sectionbgimage)) {
            $css[] = "background-image: url($sectionbgimage)";
            $css[] = "background-size: {$sectionbgimage_size}";
            $css[] = "background-position: {$sectionbgimage_position}";
            $css[] = "background-attachment: {$sectionbgimage_attach}";
            $css[] = "background-repeat: {$sectionbgimage_repeat}";
            if (!empty($sectionbgoverlay)) {
                $css1[] = "background-color: $sectionbgoverlay";
            }
        } elseif ($sectionbgtype == 'video-bg') {
            if (!empty($sectionbgoverlay)) {
                $css1[] = "background-color: $sectionbgoverlay";
            }
        } elseif ($sectionbgtype == 'gradient-bg') {
            $sectiongradientcolor = get_theme_mod('total_plus_' . $sectionname . '_bg_gradient');
            $css[] = "$sectiongradientcolor";
        }

        if ($sectionbgtype == 'image-bg' && !empty($sectionbgimage) && $sectionbgimage_attach == 'fixed') {
            $ios_css .= "$sectionclass{background-attachment:scroll}";
        }

        $custom_css .= "$sectionclass{" . implode(';', $css) . "}";

        if ($sectionfullheight == 'on') {
            $css1[] = "min-height:100vh";
            $css1[] = "display: -webkit-flex";
            $css1[] = "display: -ms-flexbox";
            $css1[] = "display: flex";
            $css1[] = "overflow: hidden";
            $css1[] = "flex-wrap: wrap";
            if ($sectionalignitem == 'top') {
                $css1[] = "align-items: flex-start";
            } elseif ($sectionalignitem == 'middle') {
                $css1[] = "align-items: center";
            } elseif ($sectionalignitem == 'bottom') {
                $css1[] = "align-items: flex-end";
            }
        }
        $css1[] = "padding-top: {$sectiontoppadding}px";
        $css1[] = "padding-bottom: {$sectionbottompadding}px";
        $css1[] = "color: $sectioncolor";

        $custom_css .= "$sectionclass .ht-section-wrap{" . implode(';', $css1) . "}";

        if (!empty($sectiontoppadding_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-wrap{padding-top: {$sectiontoppadding_tablet}px}";
        }

        if (!empty($sectionbottompadding_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-wrap{padding-bottom: {$sectionbottompadding_tablet}px}";
        }

        if (!empty($sectiontoppadding_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-wrap{padding-top: {$sectiontoppadding_mobile}px}";
        }

        if (!empty($sectionbottompadding_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-wrap{padding-bottom: {$sectionbottompadding_mobile}px}";
        }

        if (!empty($top_seperator_height)) {
            $custom_css .= "$sectionclass .ht-section-seperator.top-section-seperator{height: {$top_seperator_height}px}";
        }

        if (!empty($bottom_seperator_height)) {
            $custom_css .= "$sectionclass .ht-section-seperator.bottom-section-seperator{height: {$bottom_seperator_height}px}";
        }

        if (!empty($top_seperator_height_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-seperator.top-section-seperator{height: {$top_seperator_height_tablet}px}";
        }

        if (!empty($bottom_seperator_height_tablet)) {
            $tablet_css .= "$sectionclass .ht-section-seperator.bottom-section-seperator{height: {$bottom_seperator_height_tablet}px}";
        }

        if (!empty($top_seperator_height_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-seperator.top-section-seperator{height: {$top_seperator_height_mobile}px}";
        }

        if (!empty($bottom_seperator_height_mobile)) {
            $mobile_css .= "$sectionclass .ht-section-seperator.bottom-section-seperator{height: {$bottom_seperator_height_mobile}px}";
        }

        $section_seperator = get_theme_mod("total_plus_{$sectionname}_section_seperator");
        $top_seperator_color = get_theme_mod("total_plus_{$sectionname}_ts_color", '#FF0000');
        $bottom_seperator_color = get_theme_mod("total_plus_{$sectionname}_bs_color", '#FF0000');

        $super_title_color = get_theme_mod("total_plus_{$sectionname}_super_title_color");
        $title_color = get_theme_mod("total_plus_{$sectionname}_title_color");
        $link_color = get_theme_mod("total_plus_{$sectionname}_link_color");
        $link_hov_color = get_theme_mod("total_plus_{$sectionname}_link_hov_color");
        $button_bg_color = get_theme_mod("total_plus_{$sectionname}_mb_bg_color");
        $button_text_color = get_theme_mod("total_plus_{$sectionname}_mb_text_color");
        $button_hov_bg_color = get_theme_mod("total_plus_{$sectionname}_mb_hov_bg_color");
        $button_hov_text_color = get_theme_mod("total_plus_{$sectionname}_mb_hov_text_color");

        if ($section_seperator == 'top' || $section_seperator == 'top-bottom') {
            $custom_css .= ".ht-{$sectionname}-section .top-section-seperator svg{ fill:$top_seperator_color }";
        }
        if ($section_seperator == 'bottom' || $section_seperator == 'top-bottom') {
            $custom_css .= ".ht-{$sectionname}-section .bottom-section-seperator svg{ fill:$bottom_seperator_color }";
        }

        if ($super_title_color) {
            $custom_css .= ".ht-{$sectionname}-section .ht-section-super-title{color:$super_title_color}";
        }

        if ($title_color) {
            $custom_css .= ".ht-{$sectionname}-section .ht-section-title{color:$title_color}";
            $custom_css .= ".ht-{$sectionname}-section .ht-section-title-top-cs .ht-section-title:after, .ht-{$sectionname}-section .ht-section-title-top-ls .ht-section-title:after, .ht-{$sectionname}-section .ht-section-title-big .ht-section-title:after{background:$title_color}";
            $custom_css .= ".ht-{$sectionname}-section .ht-section-title-big .ht-section-title:after{box-shadow: -35px -8px 0px 0px $title_color}";
        }

        if ($link_color) {
            $custom_css .= ".ht-{$sectionname}-section a, .ht-{$sectionname}-section a > i{color:$link_color}";
        }

        if ($link_hov_color) {
            $custom_css .= ".ht-{$sectionname}-section a:hover, .ht-{$sectionname}-section a:hover > i{color:$link_hov_color}";
        }

        if ($button_bg_color) {
            $custom_css .= ".ht-{$sectionname}-section .ht-section-button .ht-button{background:$button_bg_color}";
        }

        if ($button_bg_color) {
            $custom_css .= ".ht-{$sectionname}-section .ht-section-button .ht-button{color:$button_text_color}";
        }

        if ($button_hov_bg_color) {
            $custom_css .= ".ht-{$sectionname}-section .ht-section-button .ht-button:hover{background:$button_hov_bg_color}";
        }

        if ($button_hov_text_color) {
            $custom_css .= ".ht-{$sectionname}-section .ht-section-button .ht-button:hover{color:$button_hov_text_color}";
        }

        if ($sectionid == '#ht-logo-section') {
            $custom_css .= ".ht-logo-section .style1 .owl-dots .owl-dot{background-color:{$sectioncolor}}";
        }

        $custom_css .= "$sectionclass .ht-section-title-top-ls .ht-section-title:after, $sectionclass .ht-section-title-top-cs .ht-section-title:after,$sectionclass .ht-section-title-big .ht-section-title:after{background:{$sectioncolor} }";
        $custom_css .= "$sectionclass .ht-section-title-big .ht-section-title:after{box-shadow:-35px -8px 0px 0px {$sectioncolor} }";
        $custom_css .= "$sectionclass .ht-section-title-single-row .ht-section-title-wrap{border-color:{$sectioncolor} }";
    }

    $slider_bottom_seperator = get_theme_mod("total_plus_slider_bottom_seperator", 'none');
    $slider_bottom_seperator_color = get_theme_mod("total_plus_slider_bs_color", '#FF0000');
    $total_plus_slider_bs_height = get_theme_mod("total_plus_slider_bs_height", 60);
    $total_plus_slider_bs_height_tablet = get_theme_mod("total_plus_slider_bs_height_tablet");
    $total_plus_slider_bs_height_mobile = get_theme_mod("total_plus_slider_bs_height_mobile");
    if ($slider_bottom_seperator != 'none') {
        $custom_css .= "#ht-home-slider-section .bottom-section-seperator svg{ fill:$slider_bottom_seperator_color; }";
        $custom_css .= "#ht-home-slider-section .bottom-section-seperator{ height:{$total_plus_slider_bs_height}px }";

        if (!empty($total_plus_slider_bs_height_tablet)) {
            $tablet_css .= "#ht-home-slider-section .bottom-section-seperator{ height:{$total_plus_slider_bs_height_tablet}px }";
        }

        if (!empty($total_plus_slider_bs_height_mobile)) {
            $mobile_css .= "#ht-home-slider-section .bottom-section-seperator{ height:{$total_plus_slider_bs_height_mobile}px }";
        }
    }

    $total_plus_caption_title_background_color = get_theme_mod("total_plus_caption_title_background_color", '#333333');
    $total_plus_caption_title_color = get_theme_mod("total_plus_caption_title_color", "#FFFFFF");
    $total_plus_caption_subtitle_color = get_theme_mod("total_plus_caption_subtitle_color", "#FFFFFF");
    $total_plus_slider_arrow_bg_color = get_theme_mod("total_plus_slider_arrow_bg_color", "#222222");
    $total_plus_slider_arrow_color = get_theme_mod("total_plus_slider_arrow_color", "#FFFFFF");
    $total_plus_slider_arrow_bg_color_hover = get_theme_mod("total_plus_slider_arrow_bg_color_hover", "#FFFFFF");
    $total_plus_slider_arrow_color_hover = get_theme_mod("total_plus_slider_arrow_color_hover", "#222222");
    $total_plus_caption_button_bg_color = get_theme_mod("total_plus_caption_button_bg_color");
    $total_plus_caption_button_border_color = get_theme_mod("total_plus_caption_button_border_color", "#FFFFFF");
    $total_plus_caption_button_text_color = get_theme_mod("total_plus_caption_button_text_color", "#FFFFFF");
    $total_plus_caption_button_bg_hov_color = get_theme_mod("total_plus_caption_button_bg_hov_color", "#FFFFFF");
    $total_plus_caption_button_border_hov_color = get_theme_mod("total_plus_caption_button_border_hov_color", "#FFFFFF");
    $total_plus_caption_button_text_hov_color = get_theme_mod("total_plus_caption_button_text_hov_color", "#333333");

    $custom_css .= ".ht-slide-cap-title span{background:$total_plus_caption_title_background_color}";
    $custom_css .= ".ht-slide-cap-title,.ht-banner-title{color:$total_plus_caption_title_color}";
    $custom_css .= ".ht-slide-cap-desc, .ht-banner-subtitle{color:$total_plus_caption_subtitle_color}";
    $custom_css .= ".ht-slide-button a, .ht-banner-button a.ht-button{background:$total_plus_caption_button_bg_color;color:$total_plus_caption_button_text_color;border-color:$total_plus_caption_button_border_color}";
    $custom_css .= ".ht-slide-button a:hover, .ht-banner-button a.ht-button:hover{background:$total_plus_caption_button_bg_hov_color;color:$total_plus_caption_button_text_hov_color;border-color:$total_plus_caption_button_border_hov_color}";

    $custom_css .= "#ht-home-slider-section .owl-nav [class*=owl-]{background:$total_plus_slider_arrow_bg_color}";
    $custom_css .= "#ht-home-slider-section .owl-nav [class*=owl-]:before, #ht-home-slider-section .owl-nav [class*=owl-]:after{background:$total_plus_slider_arrow_color}";
    $custom_css .= "#ht-home-slider-section .owl-nav [class*=owl-]:hover{background:$total_plus_slider_arrow_bg_color_hover}";
    $custom_css .= "#ht-home-slider-section .owl-nav [class*=owl-]:hover:before, #ht-home-slider-section .owl-nav [class*=owl-]:hover:after{background:$total_plus_slider_arrow_color_hover}";

    $custom_css .= "#ht-home-slider-section .owl-dots .owl-dot{border-color:$total_plus_slider_arrow_bg_color}";
    $custom_css .= "#ht-home-slider-section .owl-dots .owl-dot.active{background:$total_plus_slider_arrow_bg_color}";

    $total_plus_progressbar_text_color = get_theme_mod("total_plus_progressbar_text_color", '#333333');
    $total_plus_progressbar_bg_color = get_theme_mod("total_plus_progressbar_bg_color", "#F6F6F6");
    $total_plus_progressbar_indication_bar_color = get_theme_mod("total_plus_progressbar_indication_bar_color", "#000000");

    $custom_css .= ".ht-progress h6, .ht-progress-bar-length span{color:$total_plus_progressbar_text_color}";
    $custom_css .= ".ht-progress-bar{background:$total_plus_progressbar_bg_color}";
    $custom_css .= ".ht-progress-bar-length{background:$total_plus_progressbar_indication_bar_color}";

    $total_plus_featured_block_icon_color = get_theme_mod("total_plus_featured_block_icon_color", "#000000");
    $total_plus_featured_block_title_color = get_theme_mod("total_plus_featured_block_title_color", "#111111");
    $total_plus_featured_block_text_color = get_theme_mod("total_plus_featured_block_text_color", "#333333");
    $total_plus_featured_block_readmore_color = get_theme_mod("total_plus_featured_block_readmore_color", "#000000");
    $total_plus_featured_block_background_color = get_theme_mod("total_plus_featured_block_background_color", "#FFFFFF");
    $total_plus_featured_block_border_color = get_theme_mod("total_plus_featured_block_border_color", "#FFC107");
    $total_plus_featured_block_icon_bg_color = get_theme_mod("total_plus_featured_block_icon_bg_color", "#FFC107");

    $custom_css .= ".ht-featured-icon i{color:$total_plus_featured_block_icon_color}";
    $custom_css .= ".ht-featured-post h5{color: $total_plus_featured_block_title_color}";
    $custom_css .= ".ht-featured-post .ht-featured-excerpt{color: $total_plus_featured_block_text_color}";
    $custom_css .= ".ht-featured-section .ht-featured-link a, .ht-featured-section .ht-featured-link a i,.ht-featured-section .ht-featured-link a:hover, .ht-featured-section .ht-featured-link a:hover i{color: $total_plus_featured_block_readmore_color}";
    $custom_css .= ".ht-featured-section .style2 .ht-featured-post, .ht-featured-section .style7 .ht-featured-post{background: $total_plus_featured_block_background_color}";
    $custom_css .= ".ht-featured-section .style1 .ht-featured-post, .ht-featured-section .style2 .ht-featured-post, .ht-featured-section .style3 .ht-featured-post{border-color:$total_plus_featured_block_border_color}";
    $custom_css .= ".ht-featured-section .style1 .ht-featured-post:before, .ht-featured-section .style1 .ht-featured-post:after, .ht-featured-section .style1 .ht-featured-link a{background:$total_plus_featured_block_border_color}";
    $custom_css .= ".ht-featured-section .style7 .ht-featured-icon{background:$total_plus_featured_block_icon_bg_color}";

    $total_plus_highlight_block_highlight_color = get_theme_mod("total_plus_highlight_block_highlight_color", $color);
    $total_plus_highlight_block_highlight_color_rgba = total_plus_hex2rgba($total_plus_highlight_block_highlight_color, 0.9);
    $total_plus_highlight_block_icon_color = get_theme_mod("total_plus_highlight_block_icon_color", "#FFFFFF");
    $total_plus_highlight_block_title_color = get_theme_mod("total_plus_highlight_block_title_color", "#FFFFFF");
    $total_plus_highlight_block_excerpt_color = get_theme_mod("total_plus_highlight_block_excerpt_color", "#FFFFFF");
    $total_plus_highlight_block_readmore_color = get_theme_mod("total_plus_highlight_block_readmore_color", "#FFFFFF");

    $custom_css .= ".ht-highlight-style.style1 .ht-highlight-title, .ht-highlight-style.style1 .ht-highlight-hover{background:$total_plus_highlight_block_highlight_color_rgba}";
    $custom_css .= ".ht-highlight-style.style2 .ht-highlight-icon, .ht-highlight-style.style3 .ht-highlight-hover{background:$total_plus_highlight_block_highlight_color}";
    $custom_css .= ".ht-highlight-icon i{color:$total_plus_highlight_block_icon_color}";
    $custom_css .= ".ht-highlight-style.style4 .ht-highlight-icon:before,.ht-highlight-style.style4 .ht-highlight-icon:after{background:$total_plus_highlight_block_icon_color}";
    $custom_css .= ".ht-highlight-post h5{color:$total_plus_highlight_block_title_color}";
    $custom_css .= ".ht-highlight-excerpt{color:$total_plus_highlight_block_excerpt_color}";
    $custom_css .= ".ht-highlight-link a, .ht-highlight-link a:hover{color:$total_plus_highlight_block_readmore_color}";

    $total_plus_team_block_overlay_color = get_theme_mod('total_plus_team_block_overlay_color', 'rgba(255,193,7,0.9)');
    $total_plus_team_block_background_color = get_theme_mod('total_plus_team_block_background_color', '#FFFFFF');
    $total_plus_team_block_title_color = get_theme_mod('total_plus_team_block_title_color', '#000000');
    $total_plus_team_block_designation_color = get_theme_mod('total_plus_team_block_designation_color', '#444444');
    $total_plus_team_block_excerpt_color = get_theme_mod('total_plus_team_block_excerpt_color', '#444444');
    $total_plus_team_block_social_icon_color = get_theme_mod('total_plus_team_block_social_icon_color', '#333333');
    $total_plus_team_block_detail_link_color = get_theme_mod('total_plus_team_block_detail_link_color', '#000000');
    $total_plus_team_block_arrow_bg_color = get_theme_mod('total_plus_team_block_arrow_bg_color', '#FFFFFF');
    $total_plus_team_block_arrow_color = get_theme_mod('total_plus_team_block_arrow_color', '#222222');
    $total_plus_team_block_arrow_bg_color_hover = get_theme_mod('total_plus_team_block_arrow_bg_color_hover', '#FFFFFF');
    $total_plus_team_block_arrow_color_hover = get_theme_mod('total_plus_team_block_arrow_color_hover', '#222222');

    $custom_css .= ".ht-team-section .ht-team-member.style1 .ht-title-wrap, .ht-team-section .ht-team-member.style1 .ht-team-member-excerpt, .ht-team-section .ht-team-member.style3:hover .ht-team-image-overlay{background:$total_plus_team_block_overlay_color}";
    $custom_css .= ".ht-team-section .ht-team-member.style2 .ht-team-member-inner,.ht-team-section .ht-team-member.style3, .ht-team-section .ht-team-member.style4, .ht-team-section .ht-team-member.style5 .ht-team-member-content, .ht-team-section .ht-team-member.style6 .ht-team-member-content{background:$total_plus_team_block_background_color}";
    $custom_css .= ".ht-team-section .ht-team-member.style1 .ht-title-wrap h5, .ht-team-section .ht-team-member.style1 h5, .ht-team-section .ht-team-member h5{color:$total_plus_team_block_title_color}";
    $custom_css .= ".ht-team-section .ht-team-member.style1 .ht-team-member-excerpt h5:after{background:$total_plus_team_block_title_color}";
    $custom_css .= ".ht-team-section .ht-team-designation{color:$total_plus_team_block_designation_color !important}";
    $custom_css .= ".ht-team-section .ht-team-member .team-short-content{color:$total_plus_team_block_excerpt_color}";
    $custom_css .= ".ht-team-section .ht-team-social-id a, .ht-team-section .ht-team-social-id a i{color:$total_plus_team_block_social_icon_color !important; border-color:$total_plus_team_block_social_icon_color !important}";
    $custom_css .= ".ht-team-section .ht-team-member a.ht-team-detail{color:$total_plus_team_block_detail_link_color !important}";
    $custom_css .= ".ht-team-section .ht-team-member a.ht-team-detail:before, .ht-team-section .ht-team-member a.ht-team-detail:after{background:$total_plus_team_block_detail_link_color !important}";
    $custom_css .= ".ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-prev, .ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-next{background:$total_plus_team_block_arrow_bg_color;color:$total_plus_team_block_arrow_color; border-color:$total_plus_team_block_arrow_bg_color}";
    $custom_css .= ".ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-prev:hover, .ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-next:hover{background:$total_plus_team_block_arrow_bg_color_hover;color:$total_plus_team_block_arrow_color_hover; border-color:$total_plus_team_block_arrow_bg_color_hover}";

    $total_plus_testimonial_block_background_color = get_theme_mod('total_plus_testimonial_block_background_color', '#FFFFFF');
    $total_plus_testimonial_block_name_color = get_theme_mod('total_plus_testimonial_block_name_color', '#000000');
    $total_plus_testimonial_block_designation_color = get_theme_mod('total_plus_testimonial_block_designation_color', '#444444');
    $total_plus_testimonial_block_text_color = get_theme_mod('total_plus_testimonial_block_text_color', '#333333');
    $total_plus_testimonial_block_dot_color = get_theme_mod('total_plus_testimonial_block_dot_color', '#333333');

    $custom_css .= ".ht-testimonial-section .style3 .ht-testimonial-box,.ht-testimonial-section .style4 .ht-testimonial-box{background:$total_plus_testimonial_block_background_color}";
    $custom_css .= ".ht-testimonial-section .ht-testimonial-wrap h5{color:$total_plus_testimonial_block_name_color}";
    $custom_css .= ".ht-testimonial-section .ht-testimonial-wrap .designation{color:$total_plus_testimonial_block_designation_color}";
    $custom_css .= ".ht-testimonial-section .ht-testimonial-excerpt{color:$total_plus_testimonial_block_text_color}";
    $custom_css .= ".ht-testimonial-section .style4 .owl-nav [class^='owl-']{color:$total_plus_testimonial_block_dot_color}";
    $custom_css .= ".ht-testimonial-wrap.style2 .slick-dots li{border-color:$total_plus_testimonial_block_dot_color}";
    $custom_css .= ".ht-testimonial-wrap.style1 .owl-dots .owl-dot, .ht-testimonial-wrap.style2 .slick-dots li.slick-active button{background:$total_plus_testimonial_block_dot_color}";

    $total_plus_counter_block_background_color = get_theme_mod('total_plus_counter_block_background_color', '#FFFFFF');
    $total_plus_counter_block_border_color = get_theme_mod('total_plus_counter_block_border_color', '#333333');
    $total_plus_counter_block_icon_color = get_theme_mod('total_plus_counter_block_icon_color', '#333333');
    $total_plus_counter_block_title_color = get_theme_mod('total_plus_counter_block_title_color', '#333333');
    $total_plus_counter_block_number_color = get_theme_mod('total_plus_counter_block_number_color', '#333333');

    $custom_css .= ".ht-counter-section .style3 .ht-counter{background:$total_plus_counter_block_background_color }";
    $custom_css .= ".ht-counter-section .style1 .ht-counter, .ht-counter-section .style3 .ht-counter:before{border-color:$total_plus_counter_block_border_color}";
    $custom_css .= ".ht-counter-section .style1 .ht-counter:after, .ht-counter-section .style1 .ht-counter:before, .ht-counter-section .style2 .ht-counter:before,.ht-counter-section .style2 .ht-counter:after, .ht-counter-section .style2 .ht-counter>span:before,.ht-counter-section .style2 .ht-counter>span:after{background:$total_plus_counter_block_border_color}";
    $custom_css .= ".ht-counter-section .ht-counter-icon i{color:$total_plus_counter_block_icon_color}";
    $custom_css .= ".ht-counter-section .style2 .ht-counter-icon:after{background:$total_plus_counter_block_icon_color}";
    $custom_css .= ".ht-counter-section .ht-counter-title{color:$total_plus_counter_block_title_color}";
    $custom_css .= ".ht-counter-section .ht-counter-count{color:$total_plus_counter_block_number_color}";

    $total_plus_tab_block_tab_title_color = get_theme_mod('total_plus_tab_block_tab_title_color', '#333333');
    $total_plus_tab_block_tab_active_title_color = get_theme_mod('total_plus_tab_block_tab_active_title_color', '#333333');
    $total_plus_tab_block_active_bg_color = get_theme_mod('total_plus_tab_block_active_bg_color', '#FFC107');
    $total_plus_tab_content_title_color = get_theme_mod('total_plus_tab_content_title_color', '#333333');
    $total_plus_tab_content_text_color = get_theme_mod('total_plus_tab_content_text_color', '#333333');

    $custom_css .= ".ht-tab-section .ht-tab-wrap .ht-tab, .ht-tab-section .ht-tab-wrap.style2 .ht-tab *{color:$total_plus_tab_block_tab_title_color}";
    $custom_css .= ".ht-tab-section .ht-tab-wrap.style1 .ht-tabs:after{background:$total_plus_tab_block_tab_title_color}";
    $custom_css .= ".ht-tab-section .ht-tab-wrap.style4 .ht-tab:after,.ht-tab-section .ht-tab-wrap.style4 .ht-tab span{border-color:$total_plus_tab_block_tab_title_color}";
    $custom_css .= ".ht-tab-section .ht-tab-wrap .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active *, .ht-tab-section .ht-tab-wrap.style3 .ht-tab.ht-active *, .ht-tab-section .ht-tab-wrap.style5 .ht-tab.ht-active *{color:$total_plus_tab_block_tab_active_title_color}";
    $custom_css .= "body:not(.rtl) .ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active:after{border-left-color:$total_plus_tab_block_active_bg_color}";
    $custom_css .= "body.rtl .ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active:after{border-right-color:$total_plus_tab_block_active_bg_color}";

    $custom_css .= ".ht-tab-section .ht-tab-wrap.style3 .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style4 .ht-tab.ht-active span{border-color:$total_plus_tab_block_active_bg_color}";
    $custom_css .= ".ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style1 .ht-tab.ht-active:after, .ht-tab-section .ht-tab-wrap.style4 .ht-tab.ht-active span:before, .ht-tab-section .ht-tab-wrap.style5 .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style5 .ht-tab.ht-active:after{background:$total_plus_tab_block_active_bg_color}";
    $custom_css .= ".ht-tab-section .ht-tab-content h1,.ht-tab-section .ht-tab-content h2,.ht-tab-section .ht-tab-content h3,.ht-tab-section .ht-tab-content h4,.ht-tab-section .ht-tab-content h5,.ht-tab-section .ht-tab-content h6{color:$total_plus_tab_content_title_color}";
    $custom_css .= ".ht-tab-section .ht-tab-content{color:$total_plus_tab_content_text_color}";

    $total_plus_pricing_block_highlight_color = get_theme_mod('total_plus_pricing_block_highlight_color', '#FFC107');
    $total_plus_pricing_block_highlight_text_color = get_theme_mod('total_plus_pricing_block_highlight_text_color', '#FFFFFF');

    $custom_css .= ".ht-pricing.style4 .ht-pricing-header:before{background-image: linear-gradient(-45deg, transparent 14px, $color 0), linear-gradient(45deg, transparent 14px, $color 0)}";

    $custom_css .= ".ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header,.ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header:before, .ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header:after, .ht-pricing-section .ht-pricing.style1:hover .ht-pricing-button a, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header:before, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header:after, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-button a, .ht-pricing-section .ht-pricing.style2:hover .ht-pricing-header, .ht-pricing-section .ht-pricing.style2.ht-featured .ht-pricing-header, .ht-pricing-section .ht-pricing.style2 .ht-pricing-button a,.ht-pricing-section .ht-pricing.style3 .ht-pricing-price,.ht-pricing-section .ht-pricing.style3 .ht-pricing-main, .ht-pricing-section .ht-pricing.style4 .ht-pricing-header, .ht-pricing-section .ht-pricing.style4 .ht-pricing-button a{background:$total_plus_pricing_block_highlight_color}";
    $custom_css .= ".ht-pricing-section .ht-pricing.style3{border-color:$total_plus_pricing_block_highlight_color}";
    $custom_css .= ".ht-pricing-section .ht-pricing.style3 .ht-pricing-header h5{color:$total_plus_pricing_block_highlight_color}";
    $custom_css .= ".ht-pricing-section .ht-pricing.style4 .ht-pricing-header:before{background-image: linear-gradient(-45deg, transparent 14px, $total_plus_pricing_block_highlight_color 0), linear-gradient(45deg, transparent 14px, $total_plus_pricing_block_highlight_color 0)}";
    $custom_css .= ".ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header *, .ht-pricing-section .ht-pricing.style1:hover .ht-pricing-button a, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header *, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-button a, .ht-pricing-section .ht-pricing.style2:hover .ht-pricing-header *, .ht-pricing-section .ht-pricing.style2.ht-featured .ht-pricing-header *, .ht-pricing-section .ht-pricing.style2 .ht-pricing-button a, .ht-pricing-section .ht-pricing.style3 .ht-pricing-price *, .ht-pricing-section .ht-pricing.style3 .ht-pricing-list *, .ht-pricing-section .ht-pricing.style3 .ht-pricing-button a, .ht-pricing-section .ht-pricing.style4 .ht-pricing-header *, .ht-pricing-section .ht-pricing.style4 .ht-pricing-button a{color:$total_plus_pricing_block_highlight_text_color}";
    $custom_css .= ".ht-pricing-section .ht-pricing.style3 .ht-pricing-button a{border-color:$total_plus_pricing_block_highlight_text_color}";

    $total_plus_blog_block_title_color = get_theme_mod("total_plus_blog_block_title_color", '#333333');
    $total_plus_blog_block_excerpt_color = get_theme_mod("total_plus_blog_block_excerpt_color", '#333333');
    $total_plus_blog_block_meta_color = get_theme_mod("total_plus_blog_block_meta_color", '#333333');
    $total_plus_blog_block_meta_background_color = get_theme_mod("total_plus_blog_block_meta_background_color", '#FFC107');
    $total_plus_blog_block_readmore_button_bg_color = get_theme_mod("total_plus_blog_block_readmore_button_bg_color", '#FFC107');
    $total_plus_blog_block_readmore_button_text_color = get_theme_mod("total_plus_blog_block_readmore_button_text_color", '#FFFFFF');

    $custom_css .= ".ht-blog-post h5 a, .ht-blog-section .style4 .ht-blog-excerpt h5 a{color:$total_plus_blog_block_title_color}";
    $custom_css .= ".ht-blog-post .ht-blog-excerpt-text{color:$total_plus_blog_block_excerpt_color}";
    $custom_css .= ".ht-blog-section .style1 .ht-blog-date, .ht-blog-wrap.style2 .ht-blog-date, .ht-blog-section .style2 .ht-blog-footer span, .ht-blog-section .style3 .ht-blog-date, .ht-blog-section .style4 .ht-blog-date, .ht-blog-section .style4 .ht-blog-footer *, .ht-blog-section .style3 .ht-blog-date span{color:$total_plus_blog_block_meta_color}";
    $custom_css .= ".ht-blog-section .style2 .ht-blog-footer:after{background:$total_plus_blog_block_meta_color}";
    $custom_css .= ".ht-blog-section .style3 .ht-blog-date{background:$total_plus_blog_block_meta_background_color}";
    $custom_css .= ".ht-blog-section .ht-blog-read-more a{background:$total_plus_blog_block_readmore_button_bg_color;color:$total_plus_blog_block_readmore_button_text_color}";
    $custom_css .= ".ht-blog-section .style1 .ht-blog-post{border-color:$total_plus_blog_block_readmore_button_bg_color}";

    $total_plus_contact_title_color = get_theme_mod('total_plus_contact_title_color');
    $total_plus_contact_text_color = get_theme_mod('total_plus_contact_text_color', '#333333');
    $total_plus_contact_social_button_bg_color = get_theme_mod('total_plus_contact_social_button_bg_color', '#FFFFFF');
    $total_plus_contact_social_button_text_color = get_theme_mod('total_plus_contact_social_button_text_color', '#000000');

    $custom_css .= ".ht-contact-detail h1,.ht-contact-detail h2,.ht-contact-detail h3,.ht-contact-detail h4,.ht-contact-detail h5,.ht-contact-detail h6{color:$total_plus_contact_title_color}";
    $custom_css .= ".ht-contact-section .ht-contact-detail{color:$total_plus_contact_text_color}";
    $custom_css .= ".ht-contact-detail .ht-contact-social-icon a{background:$total_plus_contact_social_button_bg_color}";
    $custom_css .= ".ht-contact-section .ht-contact-detail .ht-contact-social-icon a i{color:$total_plus_contact_social_button_text_color}";

    $total_plus_service_block_icon_color = get_theme_mod('total_plus_service_block_icon_color', '#333333');
    $total_plus_service_block_icon_bg_color = get_theme_mod('total_plus_service_block_icon_bg_color', '#FFC107');
    $total_plus_service_block_title_color = get_theme_mod('total_plus_service_block_title_color', '#333333');
    $total_plus_service_block_excerpt_color = get_theme_mod('total_plus_service_block_excerpt_color', '#333333');
    $total_plus_service_block_link_color = get_theme_mod('total_plus_service_block_link_color', '#333333');

    $custom_css .= ".ht-service-section.style1 .ht-service-icon i, .ht-service-section.style2 .ht-service-icon i, .ht-service-section.style3 .ht-service-icon i, .ht-service-section.style4 .ht-service-icon i{color:$total_plus_service_block_icon_color}";
    $custom_css .= ".ht-service-section.style1 .ht-service-icon, .ht-service-section.style1 .ht-service-post:after{background:$total_plus_service_block_icon_bg_color}";
    $custom_css .= ".ht-service-section.style1 .ht-active .ht-service-icon{box-shadow:0px 0px 0px 2px #FFF, 0px 0px 0px 4px $total_plus_service_block_icon_bg_color}";
    $custom_css .= ".ht-service-section .ht-service-excerpt h5, .ht-service-section.style2 .ht-service-excerpt h5{color:$total_plus_service_block_title_color}";
    $custom_css .= ".ht-service-section .ht-service-text-inner{color:$total_plus_service_block_excerpt_color}";
    $custom_css .= ".ht-service-section .ht-service-more, .ht-service-section .ht-service-more>i{color:$total_plus_service_block_link_color !important}";

    $total_plus_news_block_title_color = get_theme_mod('total_plus_news_block_title_color', '#333333');
    $total_plus_news_block_text_color = get_theme_mod('total_plus_news_block_text_color', '#333333');
    $total_plus_news_block_link_color = get_theme_mod('total_plus_news_block_link_color', '#333333');
    $total_plus_news_block_background_color = get_theme_mod('total_plus_news_block_background_color', '#FFFFFF');

    $custom_css .= ".ht-news-section .style2 .ht-news-content{background:$total_plus_news_block_background_color}";
    $custom_css .= ".ht-news-content h5{color:$total_plus_news_block_title_color}";
    $custom_css .= ".ht-news-section .ht-news-text{color:$total_plus_news_block_text_color}";
    $custom_css .= ".ht-news-section .ht-news-link, .ht-news-section .ht-news-link > i{color:$total_plus_news_block_link_color}";

    $total_plus_portfolio_block_tab_text_color = get_theme_mod('total_plus_portfolio_block_tab_text_color', '#333333');
    $total_plus_portfolio_block_active_tab_text_color = get_theme_mod('total_plus_portfolio_block_active_tab_text_color', '#111111');
    $total_plus_portfolio_block_tab_background_color = get_theme_mod('total_plus_portfolio_block_tab_background_color', '#FFC107');
    $total_plus_portfolio_block_image_hov_background_color = get_theme_mod('total_plus_portfolio_block_image_hov_background_color', '#FFC107');
    $total_plus_portfolio_block_title_color = get_theme_mod('total_plus_portfolio_block_title_color', '#FFFFFF');
    $total_plus_portfolio_block_button_bg_color = get_theme_mod('total_plus_portfolio_block_button_bg_color', '#FFFFFF');
    $total_plus_portfolio_block_button_color = get_theme_mod('total_plus_portfolio_block_button_color', '#000000');
    $total_plus_portfolio_block_tab_light_text_color = total_plus_hex2rgba($total_plus_portfolio_block_tab_text_color, 0.2);
    $total_plus_portfolio_block_image_hov_background_color1 = total_plus_hex2rgba($total_plus_portfolio_block_image_hov_background_color, 0.9);

    $custom_css .= ".ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name,.ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name,.ht-portfolio-section .ht-portfolio-cat-name-list.style3 .ht-portfolio-cat-name, .ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-cat-name, .ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-switch i,.ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-switch i{color:$total_plus_portfolio_block_tab_text_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name, .ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name{border-color:$total_plus_portfolio_block_tab_light_text_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name.active, .ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name.active, .ht-portfolio-section .ht-portfolio-cat-name-list.style3 .ht-portfolio-cat-name.active{color:$total_plus_portfolio_block_active_tab_text_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name.active:after{background:$total_plus_portfolio_block_active_tab_text_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-cat-wrap,.ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-switch{background:$total_plus_portfolio_block_tab_background_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-caption{background:$total_plus_portfolio_block_image_hov_background_color1}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-caption h5{color:$total_plus_portfolio_block_title_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-caption a{background:$total_plus_portfolio_block_button_bg_color}";
    $custom_css .= ".ht-portfolio-section .ht-portfolio-caption a i{color:$total_plus_portfolio_block_button_color}";

    $cta_button1_bg_color = get_theme_mod("total_plus_cta_button1_bg_color", $color);
    $cta_button1_text_color = get_theme_mod("total_plus_cta_button1_text_color", "#FFFFFF");
    $cta_button2_bg_color = get_theme_mod("total_plus_cta_button2_bg_color", "#333333");
    $cta_button2_text_color = get_theme_mod("total_plus_cta_button2_text_color", "#FFFFFF");
    $total_plus_cta_video_icon_color = get_theme_mod("total_plus_cta_video_icon_color", "#e52d27");

    $custom_css .= ".ht-cta-buttons a.ht-cta-button1{background:$cta_button1_bg_color;color:$cta_button1_text_color}";
    $custom_css .= ".ht-cta-buttons a.ht-cta-button2{background:$cta_button2_bg_color;color:$cta_button2_text_color}";
    $custom_css .= ".ht-cta-buttons a.ht-cta-button1:hover{background:$cta_button2_bg_color;color:$cta_button2_text_color}";
    $custom_css .= ".ht-cta-buttons a.ht-cta-button2:hover{background:$cta_button1_bg_color;color:$cta_button1_text_color}";
    $custom_css .= "#cta-video .video-play-button:after,#cta-video .video-play-button:before{background-color:$total_plus_cta_video_icon_color;}";



    $page_overwrite_defaults = '';
    if (is_singular(array('post', 'page', 'product', 'portfolio'))) {
        $page_overwrite_defaults = rwmb_meta('page_overwrite_defaults');
    }

    if (!$page_overwrite_defaults) {
        /* Title Bar Settings */
        $total_plus_titlebar_layout = get_theme_mod('total_plus_titlebar_layout', 'style1');
        $total_plus_titlebar_bg_url = get_theme_mod('total_plus_titlebar_bg_url');
        $total_plus_titlebar_bg_repeat = get_theme_mod('total_plus_titlebar_bg_repeat', 'no-repeat');
        $total_plus_titlebar_bg_size = get_theme_mod('total_plus_titlebar_bg_size', 'cover');
        $total_plus_titlebar_bg_position = get_theme_mod('total_plus_titlebar_bg_position', 'center-center');
        $total_plus_titlebar_bg_position = str_replace('-', ' ', $total_plus_titlebar_bg_position);
        $total_plus_titlebar_bg_attach = get_theme_mod('total_plus_titlebar_bg_attach', 'fixed');
        $total_plus_titlebar_bg_color = get_theme_mod('total_plus_titlebar_bg_color', '#f7f9fd');
        $total_plus_titlebar_bg_overlay = get_theme_mod('total_plus_titlebar_bg_overlay', 'rgba( 0, 0, 0, 0)');
        $total_plus_titlebar_text_color = get_theme_mod('total_plus_titlebar_text_color', '#333333');
        $total_plus_titlebar_padding = get_theme_mod('total_plus_titlebar_padding', 50);

        $custom_css .= "
            .ht-main-header{
            background-color: $total_plus_titlebar_bg_color;
            background-image: url($total_plus_titlebar_bg_url);
            background-repeat: $total_plus_titlebar_bg_repeat;
            background-size: $total_plus_titlebar_bg_size;
            background-position: $total_plus_titlebar_bg_position;
            background-attachment: $total_plus_titlebar_bg_attach;
            padding-top: {$total_plus_titlebar_padding}px;
            padding-bottom: {$total_plus_titlebar_padding}px;
            color: $total_plus_titlebar_text_color;
            }";

        if ($total_plus_titlebar_bg_url && $total_plus_titlebar_bg_attach == 'fixed') {
            $ios_css .= ".ht-main-header{background-attachment:scroll}";
        }

        $custom_css .= "
            .ht-main-header *,
            .woocommerce .woocommerce-breadcrumb a, 
            .breadcrumb-trail a{
            color: $total_plus_titlebar_text_color;
            }";

        if ($total_plus_titlebar_bg_overlay) {
            $custom_css .= "
                .ht-main-header:before{
                        background-color: $total_plus_titlebar_bg_overlay;
                }";
        }

        $custom_css .= "@media screen and (max-width: {$total_plus_responsive_width}px){
            .ht-main-header{
                padding-top: {$total_plus_titlebar_padding}px !important;
            }
        }";
    } else {
        $titlebar_background = rwmb_meta('titlebar_background');
        $titlebar_color = rwmb_meta('titlebar_color');
        $titlebar_padding = rwmb_meta('titlebar_padding');

        if ($titlebar_background) {
            $titlebar_bg_image = isset($titlebar_background['titlebar_bg_image']) ? $titlebar_background['titlebar_bg_image'] : '';
            $titlebar_bg_color = isset($titlebar_background['titlebar_bg_color']) ? $titlebar_background['titlebar_bg_color'] : '';
            $titlebar_bg_repeat = isset($titlebar_background['titlebar_bg_repeat']) ? $titlebar_background['titlebar_bg_repeat'] : '';
            $titlebar_bg_size = isset($titlebar_background['titlebar_bg_size']) ? $titlebar_background['titlebar_bg_size'] : '';
            $titlebar_bg_attachment = isset($titlebar_background['titlebar_bg_attachment']) ? $titlebar_background['titlebar_bg_attachment'] : '';
            $titlebar_bg_position = isset($titlebar_background['titlebar_bg_position']) ? $titlebar_background['titlebar_bg_position'] : '';
            $titlebar_overlay_bg_color = isset($titlebar_background['overlay_bg_color']) ? $titlebar_background['overlay_bg_color'] : '';

            $custom_css .= ".ht-main-header{";

            if ($titlebar_bg_image) {

                $image = wp_get_attachment_image_src($titlebar_bg_image[0], 'full');
                $custom_css .= "background-image: url($image[0]);";

                if ($titlebar_bg_repeat) {
                    $custom_css .= "background-repeat: $titlebar_bg_repeat;";
                }

                if ($titlebar_bg_attachment) {
                    $custom_css .= "background-attachment: $titlebar_bg_attachment;";
                }

                if ($titlebar_bg_position) {
                    $custom_css .= "background-position: $titlebar_bg_position;";
                }

                if ($titlebar_bg_size) {
                    $custom_css .= "background-size: $titlebar_bg_size;";
                }
            }

            if ($titlebar_bg_color) {
                $custom_css .= "background-color: $titlebar_bg_color;";
            }

            $custom_css .= "}";

            if ($titlebar_bg_image && $titlebar_bg_attachment == 'fixed') {
                $ios_css .= ".ht-main-header{background-attachment:scroll}";
            }

            if ($titlebar_bg_image && $titlebar_overlay_bg_color) {
                $custom_css .= "
                    .ht-main-header:before{
                        background-color: $titlebar_overlay_bg_color;
                    }";
            }
        }

        if ($titlebar_color) {
            $custom_css .= "
                .ht-main-header *,
                .woocommerce .woocommerce-breadcrumb a, 
                .breadcrumb-trail a{
                color: $titlebar_color;
                }";
        }

        if ($titlebar_padding) {
            $custom_css .= ".ht-main-header{";
            $custom_css .= "padding-top: {$titlebar_padding}px;";
            $custom_css .= "padding-bottom: {$titlebar_padding}px;";
            $custom_css .= "}";

            $custom_css .= "@media screen and (max-width: {$total_plus_responsive_width}px){
                .ht-main-header{
                    padding-top: {$titlebar_padding}px !important;
                }
            }";
        }
    }

    /* Singular Page text and Background */

    if (is_singular(array('post', 'page', 'portfolio', 'product'))) {
        $page_text_color = rwmb_meta('page_text_color');
        $page_background = rwmb_meta('page_background');
        $content_width = rwmb_meta('content_width');

        if ($content_width == 'full-width') {
            $custom_css .= "
                .ht-main-content{
                    width: 100%;
                }";
        }

        if ($page_background) {
            $page_bg_image = isset($page_background['page_bg_image']) ? $page_background['page_bg_image'] : '';
            $page_bg_color = isset($page_background['page_bg_color']) ? $page_background['page_bg_color'] : '';
            $page_bg_repeat = isset($page_background['page_bg_repeat']) ? $page_background['page_bg_repeat'] : '';
            $page_bg_size = isset($page_background['page_bg_size']) ? $page_background['page_bg_size'] : '';
            $page_bg_attachment = isset($page_background['page_bg_attachment']) ? $page_background['page_bg_attachment'] : '';
            $page_bg_position = isset($page_background['page_bg_position']) ? $page_background['page_bg_position'] : '';

            $custom_css .= "body{";

            if ($page_bg_image) {
                $image = wp_get_attachment_image_src($page_bg_image[0], 'full');

                $custom_css .= "background-image: url($image[0]);";

                if ($page_bg_repeat) {
                    $custom_css .= "background-repeat: $page_bg_repeat;";
                }

                if ($page_bg_attachment) {
                    $custom_css .= "background-attachment: $page_bg_attachment;";
                }

                if ($page_bg_position) {
                    $custom_css .= "background-position: $page_bg_position;";
                }

                if ($page_bg_size) {
                    $custom_css .= "background-size: $page_bg_size;";
                }
            }

            if ($page_bg_color) {
                $custom_css .= "background-color: $page_bg_color;";
            }

            $custom_css .= "}";

            if ($page_bg_image && $page_bg_attachment == 'fixed') {
                $ios_css .= "body{background-attachment:scroll}";
            }
        }

        if ($page_text_color) {
            $custom_css .= "
                .ht-main-content,
                .ht-main-content h1,
                .ht-main-content h2,
                .ht-main-content h3,
                .ht-main-content h4,
                .ht-main-content h5,
                .ht-main-content h6,
                .ht-main-content a{
                        color: $page_text_color;
                }
                ";
        }
    }

    /* Footer Settings */
    $total_plus_footer_bg_color = get_theme_mod('total_plus_footer_bg_color', '#333333');
    $total_plus_footer_bg_url = get_theme_mod('total_plus_footer_bg_url');
    $total_plus_footer_bg_repeat = get_theme_mod('total_plus_footer_bg_repeat', 'no-repeat');
    $total_plus_footer_bg_size = get_theme_mod('total_plus_footer_bg_size', 'auto');
    $total_plus_footer_bg_position = get_theme_mod('total_plus_footer_bg_position', 'center-center');
    $total_plus_footer_bg_position = str_replace('-', ' ', $total_plus_footer_bg_position);
    $total_plus_footer_bg_attach = get_theme_mod('total_plus_footer_bg_attach', 'scroll');
    $total_plus_footer_text_color = get_theme_mod('total_plus_footer_text_color', '#EEEEEE');
    $total_plus_footer_anchor_color = get_theme_mod('total_plus_footer_anchor_color', '#EEEEEE');

    $custom_css .= "
        #ht-colophon{
        background-image:url($total_plus_footer_bg_url);
        background-repeat: $total_plus_footer_bg_repeat;
        background-size: $total_plus_footer_bg_size;
        background-position: $total_plus_footer_bg_position;
        background-attachment: $total_plus_footer_bg_attach;
        }
        
        #ht-colophon:before{
                background-color: $total_plus_footer_bg_color;
        }

        .ht-site-footer *{
                color: $total_plus_footer_text_color;
        }

        #ht-colophon a{
                color: $total_plus_footer_anchor_color;
        }";

    if ($total_plus_footer_bg_url && $total_plus_footer_bg_attach == 'fixed') {
        $ios_css .= "#ht-colophon{background-attachment:scroll}";
    }

    $custom_css .= "    
        .ht-header-six .ht-main-navigation:before{
            right: calc( 50% + {$half_container_width}px - 300px );
        }
        
        body.rtl .ht-header-six .ht-main-navigation:before{
            left: calc( 50% + {$half_container_width}px - 300px );
            right: 0;
        }
        
        .ht-header-six .ht-main-navigation:after{
            right: calc( 30% + {$half_container_width}px - 50px);
        }
        
        body.rtl .ht-header-six .ht-main-navigation:after{
            left: calc( 30% + {$half_container_width}px - 50px);
            right: auto;
        }

        @media screen and (max-width: {$total_plus_responsive_width}px){
            .ht-menu{
                display: none;
            }

            #ht-mobile-menu{
                display: block;
            }

            .ht-header-one .ht-header, 
            .ht-header-two .ht-header .ht-container, 
            .ht-header-three .ht-header .ht-container, 
            .ht-header-four .ht-header .ht-container, 
            .ht-header-five .ht-header .ht-container,
            .ht-header-six .ht-main-navigation{
                background: {$total_plus_mh_bg_color_mobile};
            }
            
            #ht-site-branding,
            .ht-header-two #ht-site-branding,
            .ht-header-two .ht-header-nav-wrap,
            .ht-header-three .ht-main-navigation,
            .ht-header-five .ht-main-navigation{
                float: none;
                width: auto;
            }
            
            .ht-header-two #ht-site-branding{
                padding-left:0;
                max-width: none;
            }
            
            body.rtl .ht-header-two #ht-site-branding{
                padding-right:0;
                padding-left: 15px;
            }
            
            .ht-header-two .ht-main-navigation{
                padding-right:0;
            }
            
            body.rtl .ht-header-two .ht-main-navigation{
                padding-left:0;
            }
            
            .ht-header-five .ht-top-header.ht-container,
            .ht-header-two .ht-header .ht-container{
                padding-left: 5%;
                padding-right: 5%;
            }
            
            .ht-header-two .ht-top-header{
                display: none;
            }
            
            .ht-header-two .ht-main-navigation{
                justify-content: flex-end;
            }
            
            #ht-masthead.ht-header-two{
                position: relative;
                margin: 0;
            }
            
            #ht-masthead.ht-header-two .ht-header .ht-container{
                padding: 0 5% !important;
            }
            
            .ht-boxed #ht-masthead.ht-header-two,
            .ht-boxed #ht-masthead.ht-header-five{
                left: 0;
                right: 0;
            }
            
            .ht-header-style2 .ht-slide-caption, 
            .ht-header-style3 .ht-slide-caption, 
            .ht-header-style5 .ht-slide-caption,
            .ht-header-over .ht-slide-caption{
                margin-top: 0;
            }
            
            .ht-header-three .ht-header,
            .ht-header-five .ht-header-wrap{ 
                justify-content: space-between;
            }
            
            .ht-header-three .ht-top-header{
                margin-bottom:0
            }
            
            #ht-masthead.ht-header-three{
                position:relative;
            }
            
            .ht-header-four .ht-header-wrap{
                position:relative;
            }
            
            .ht-header-four .ht-header,
            .ht-header-five .ht-top-header,
            .ht-header-six #ht-site-branding{
                transform: translateY(0);
                -moz-transform: translateY(0);
                -webkit-transform: translateY(0);
            }
            
            .ht-header-four .ht-middle-header{
                padding-bottom:0;
            }
            
            .ht-header-over #ht-masthead{
                position:relative;
            }
            
            .ht-header-five .ht-top-header+.ht-header .ht-container{
                padding-top:0;
            }
            
            .ht-header-five .ht-header-wrap{
                padding:0;
            }

            .ht-header-five .ht-header{
                margin-top: 0;
            }
            
            .ht-header-six #ht-site-branding{
                width:auto;
            }
            
            .ht-header-six .ht-main-navigation:before,
            .ht-header-six .ht-main-navigation:after{
                display:none;
            }
            
            .ht-header-widget{
                display: none;
            }
            
            .ht-header-two .ht-mobile-top-header{
                display: block;
                padding-left: 0;
                padding-right: 0;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-tab{
                width: 100%;
                padding: 0;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content{
                display: none;
            }
            .megamenu-full-width.megamenu-category .cat-megamenu-tab > div{
                padding: 15px 40px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            .megamenu-full-width.megamenu-category .cat-megamenu-tab > div:after{
                display: none;
            }
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full{
                display: none;
            }
            
            #ht-content{
                padding-top: 0 !important;
            }
            
            .ht-sticky-header .headroom.headroom--not-top {
                position: relative;
                top: auto;
                left: auto;
                right: auto;
                z-index: 9999;
                width: auto;
                box-shadow: none;
                -webkit-animation: none;
                animation: none;
            }
            
            .admin-bar.ht-sticky-header .headroom.headroom--not-top{
                top: auto;
            }

            .ht-header-one #ht-site-branding img,
            .ht-header-two #ht-site-branding img,
            .ht-header-three #ht-site-branding img,
            .ht-header-five #ht-site-branding img{
                height: auto;
                max-height: {$total_plus_logo_min_height}px;
            }
        }

        @media screen and (max-width: {$container_width}px){  
            .elementor-section.elementor-section-boxed>.elementor-container,
            .ht-container{
                padding-left: 5% !important;
                padding-right: 5% !important;
            }
            .ht-header-two .ht-header .ht-container{
                padding: 0 !important;
            }

            .ht-header-five .ht-top-header.ht-container{
                max-width: none;
                clip-path: none;
            }
            
            .ht-header-five .ht-header .ht-container{
                clip-path: none;
            }
            
            .ht-header-six .ht-menu {
                margin-left: 0
            }
            
            .ht-header-six .ht-main-navigation:before{
                display: none;
            }
            
            .ht-header-six #ht-site-branding {
                transform: translateY(0);
                -ms-transform: translateY(0);
                -webkit-transform: translateY(0);
            }
        }";

    $custom_css .= "
            @media screen and (min-width: {$boxed_container_width}px) {
                body.ht-no-sidebar.ht-boxed .alignfull,
                body.ht-no-sidebar-narrow.ht-boxed .alignfull{
                    margin-left: calc(50% - {$boxed_container_width}px / 2);
                    margin-right: calc(50% - {$boxed_container_width}px / 2);
                }

                body.ht-right-sidebar.ht-boxed .alignfull {
                    margin-left: calc(50% / .7 - {$boxed_container_width}px / 2);
                    margin-right: 0;
                }

                body.ht-left-sidebar.ht-boxed .alignfull {
                    margin-right: calc(50% / .7 - {$boxed_container_width}px / 2);
                    margin-left: 0;
                }
            }";

    /* Header Button */
    $total_plus_hb_text_color = get_theme_mod('total_plus_hb_text_color', '#FFFFFF');
    $total_plus_hb_text_hov_color = get_theme_mod('total_plus_hb_text_hov_color', '#FFFFFF');
    $total_plus_hb_bg_color = get_theme_mod('total_plus_hb_bg_color', '#FFC107');
    $total_plus_hb_bg_hov_color = get_theme_mod('total_plus_hb_bg_hov_color', '#FFC107');
    $total_plus_hb_borderradius = get_theme_mod('total_plus_hb_borderradius', '0');

    $custom_css .= "
            a.ht-header-bttn{
                color: $total_plus_hb_text_color;
                background: $total_plus_hb_bg_color;
                border-radius: {$total_plus_hb_borderradius}px;
            }

            a.ht-header-bttn:hover{
                color: $total_plus_hb_text_hov_color;
                background: $total_plus_hb_bg_hov_color;
            }
        ";

    /* GDPR */
    $total_plus_gdpr_bg = get_theme_mod('total_plus_gdpr_bg', '#333333');
    $total_plus_gdpr_text_color = get_theme_mod('total_plus_gdpr_text_color', '#FFFFFF');
    $total_plus_button_bg_color = get_theme_mod('total_plus_button_bg_color', '#FFC107');
    $total_plus_button_text_color = get_theme_mod('total_plus_button_text_color', '#FFFFFF');
    $custom_css .= "
            .total-plus-privacy-policy{
                color: $total_plus_gdpr_text_color;
                background: $total_plus_gdpr_bg;
            }

            .policy-text a{
                color: $total_plus_gdpr_text_color;
            }

            .policy-buttons a,
            .policy-buttons a:hover{
                color: $total_plus_button_text_color;
                background: $total_plus_button_bg_color;
            }
        ";

    /* Mobile Menu Button */
    $total_plus_toggle_button_bg_color = get_theme_mod('total_plus_toggle_button_bg_color', '#0e0e0e');
    $total_plus_toggle_button_color = get_theme_mod('total_plus_toggle_button_color', '#FFFFFF');

    $custom_css .= ".collapse-button{background:{$total_plus_toggle_button_bg_color}}";
    $custom_css .= ".collapse-button .icon-bar{background:{$total_plus_toggle_button_color}}";

    $custom_css .= "@media screen and (max-width:768px){{$tablet_css}}";
    $custom_css .= "@media screen and (max-width:480px){{$mobile_css}}";
    $custom_css .= "@supports (-webkit-touch-callout: none) {{$ios_css} [data-pllx-bg-ratio]{background-attachment:scroll !important; background-position:center !important;}}";

    $custom_css .= total_plus_bbpress_dymanic_styles();

    return total_plus_css_strip_whitespace($custom_css);
}

function total_plus_bbpress_dymanic_styles() {
    $color = get_theme_mod('total_plus_template_color', '#FFC107');
    $bbpress_custom_css = "
            #bbpress-forums li.bbp-footer, 
            #bbpress-forums li.bbp-header{
                background: $color;
            }
        ";

    return $bbpress_custom_css;
}
