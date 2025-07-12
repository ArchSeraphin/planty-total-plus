/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

function total_plus_dynamic_css(control, style) {
    jQuery('style.' + control).remove();

    jQuery('head').append(
            '<style class="' + control + '">' + style + '</style>'
            );
}

function totalPlusGetContrast(hexcolor) {
    if (hexcolor) {
        var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        var r = parseInt(hex.substr(0, 2), 16);
        var g = parseInt(hex.substr(2, 2), 16);
        var b = parseInt(hex.substr(4, 2), 16);
        var contrast = ((r * 299) + (g * 587) + (b * 114)) / 1000;
        return contrast;
    }
}

function totalPlusConvertHex(hexcolor, opacity) {
    if (hexcolor) {
        var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        r = parseInt(hex.substring(0, 2), 16);
        g = parseInt(hex.substring(2, 4), 16);
        b = parseInt(hex.substring(4, 6), 16);

        result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
        return result;
    }
}

(function ($) {
    wp.customize.bind('preview-ready', function () {
        wp.customize.preview.bind('total-plus-gdpr-add-class', function (data) {
            // When the section is expanded, open the login designer page specified via localization.
            if (true === data.expanded) {
                var enable_gdpr = wp.customize('total_plus_enable_gdpr').get();
                if ('off' == enable_gdpr) {
                    var css = '.customizer-gdpr-section .total-plus-privacy-policy{display:none !important}';
                } else {
                    var css = '.customizer-gdpr-section .total-plus-privacy-policy{display:block !important}';
                }
                total_plus_dynamic_css('total_plus_enable_gdpr', css);

                $('body').addClass('customizer-gdpr-section');
            }
        });

        wp.customize.preview.bind('total-plus-gdpr-remove-class', function (data) {
            $('body').removeClass('customizer-gdpr-section');
        });
    });

    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.ht-site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.ht-site-description').text(to);
        });
    });

    wp.customize('total_plus_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-title a, .ht-site-description, .ht-site-description a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_title_color', css);
        });
    });

    wp.customize('total_plus_website_layout', function (value) {
        value.bind(function (to) {
            if (to === 'boxed') {
                $('body').addClass('ht-boxed');
            } else {
                $('body').removeClass('ht-boxed');
            }
        });
    });

    wp.customize('total_plus_th_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header{background:' + to + '}';
            css += '.ht-header-three .ht-header .ht-container,.ht-sticky-header .ht-header-three .ht-header.headroom.headroom--not-top{border-bottom-color:' + to + '}';
            total_plus_dynamic_css('total_plus_th_bg_color', css);
        });
    });

    wp.customize('total_plus_th_text_color', function (value) {
        value.bind(function (to) {
            $('.ht-top-header').css({
                'color': to
            });
        });
    });

    wp.customize('total_plus_th_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header a,.ht-site-header .ht-top-header a:hover,.ht-site-header .ht-top-header a i,.ht-site-header .ht-top-header a:hover i{color:' + to + '}';
            total_plus_dynamic_css('total_plus_th_anchor_color', css);
        });
    });

    wp.customize('total_plus_th_padding', function (value) {
        value.bind(function (to) {
            var headerHeight = $('#ht-masthead').outerHeight();
            var title_padding = wp.customize('total_plus_titlebar_padding').get();

            $('.ht-top-header').css({
                'padding-top': parseInt(to) + 'px',
                'padding-bottom': parseInt(to) + 'px'
            });

            if ($('#ht-masthead').hasClass('ht-header-one')) {
                $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
                $('.ht-header-above .ht-main-header').css('padding-top', parseInt(title_padding));
            } else if ($('#ht-masthead').hasClass('ht-header-two')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding) + 40);
            } else if ($('#ht-masthead').hasClass('ht-header-three')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
            } else if ($('#ht-masthead').hasClass('ht-header-four')) {
                var headerWrapHeight = $('.ht-header-wrap').outerHeight() / 2;
                $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(title_padding) + headerWrapHeight);
                $('.ht-header-above .ht-main-header').css('padding-top', parseInt(title_padding) + headerWrapHeight);
            } else if ($('#ht-masthead').hasClass('ht-header-five')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
            } else {
                $('.ht-main-header').css('padding-top', parseInt(title_padding));
            }
            $('.ht-main-header').css('padding-bottom', title_padding);
        });
    });

    wp.customize('total_plus_mh_bg_color_mobile', function (value) {
        value.bind(function (to) {
            var responsiveWidth = wp.customize('total_plus_responsive_width').get();
            var css = '@media screen and (max-width:' + responsiveWidth + 'px){';
            css += '.ht-header-one .ht-header,.ht-header-two .ht-header .ht-container,.ht-header-three .ht-header .ht-container,.ht-header-four .ht-header .ht-container,.ht-header-five .ht-header .ht-container,.ht-header-six .ht-main-navigation{background:' + to + '}';
            css += '}';
            total_plus_dynamic_css('total_plus_mh_bg_color_mobile', css);
        });
    });

    wp.customize('total_plus_mh_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-one .ht-header,.ht-header-two .ht-header .ht-container,.ht-header-three .ht-header .ht-container,.ht-header-four .ht-header .ht-container,.ht-header-five .ht-header .ht-container,.ht-sticky-header .ht-header-two .ht-header.headroom.headroom--not-top,.ht-sticky-header .ht-header-three .ht-header.headroom.headroom--not-top,.ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top,.ht-sticky-header .ht-header-five .ht-header.headroom.headroom--not-top,.ht-header-six .ht-main-navigation{background:' + to + '}';
            css += '.ht-header-four .ht-middle-header{border-color:' + to + '}';
            css += '.ht-header-five .ht-top-header + .ht-header .ht-container:before,.ht-header-five .ht-top-header + .ht-header .ht-container:after{border-bottom-color:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_bg_color', css);
        });
    });

    wp.customize('total_plus_mh_height', function (value) {
        value.bind(function (to) {
            var total_plus_mh_height = parseInt(to);
            var total_plus_mh_half_height = total_plus_mh_height / 2;
            var total_plus_logo_height = total_plus_mh_height - 30;
            var total_plus_border_height = total_plus_mh_height + 25;
            var total_caption_top_margin = total_plus_mh_half_height + 25;
            var total_plus_header3_height = total_plus_mh_height + 4;
            var total_header4_bottom_margin = total_plus_mh_half_height + 40;
            var title_padding = wp.customize('total_plus_titlebar_padding').get();
            var headerHeight = $('#ht-masthead').outerHeight();

            var css = '.ht-header-one .ht-header .ht-container,.ht-header-two .ht-main-navigation,.ht-header-four .ht-main-navigation,.ht-header-five .ht-header-wrap,.ht-header-six .ht-main-navigation .ht-container{height:' + to + 'px}';
            css += '.hover-style5 .ht-menu > ul > li.menu-item > a,.hover-style6 .ht-menu > ul > li.menu-item > a,.hover-style5 .ht-header-bttn,.hover-style6 .ht-header-bttn{line-height:' + to + 'px}'
            css += '.ht-header-four .ht-middle-header{padding-bottom:' + total_plus_mh_half_height + 'px;}';
            css += '.ht-header-over .ht-slide-caption{margin-top:' + total_plus_mh_half_height + 'px;}';
            css += '.ht-header-five .ht-top-header + .ht-header .ht-container:before,.ht-header-five .ht-top-header + .ht-header .ht-container:after{border-bottom-width:' + total_plus_border_height + 'px;}';
            css += '.ht-header-style2 .ht-slide-caption,.ht-header-style3 .ht-slide-caption,.ht-header-style5 .ht-slide-caption{margin-top:' + total_caption_top_margin + 'px;}';
            css += '.ht-header-three .ht-header .ht-container{height:' + total_plus_header3_height + 'px;}';
            css += '.ht-hide-titlebar .ht-header-four#ht-masthead{padding-bottom:' + total_header4_bottom_margin + 'px;}';

            var responsive_width = wp.customize('total_plus_responsive_width').get();
            var logo_actual_height = wp.customize('total_plus_logo_height').get();
            var min_logo_height = Math.min(parseInt(total_plus_logo_height), parseInt(logo_actual_height));

            css += '.ht-header-one #ht-site-branding img,.ht-header-two #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-five #ht-site-branding img{max-height:' + total_plus_logo_height + 'px;}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.ht-header-one #ht-site-branding img,.ht-header-two #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-five #ht-site-branding img{height: auto;max-height: ' + min_logo_height + 'px}}';

            if ($('#ht-masthead').hasClass('ht-header-one')) {
                $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
                $('.ht-header-above .ht-main-header').css('padding-top', parseInt(title_padding));
            } else if ($('#ht-masthead').hasClass('ht-header-two')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding) + 40);
            } else if ($('#ht-masthead').hasClass('ht-header-three')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
            } else if ($('#ht-masthead').hasClass('ht-header-four')) {
                var headerWrapHeight = $('.ht-header-wrap').outerHeight() / 2;
                $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(title_padding) + headerWrapHeight);
                $('.ht-header-above .ht-main-header').css('padding-top', parseInt(title_padding) + headerWrapHeight);
            } else if ($('#ht-masthead').hasClass('ht-header-five')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
            } else {
                $('.ht-main-header').css('padding-top', parseInt(title_padding));
            }
            $('.ht-main-header').css('padding-bottom', title_padding);

            total_plus_dynamic_css('total_plus_mh_height', css);
        });
    });

    wp.customize('total_plus_logo_height', function (value) {
        value.bind(function (to) {
            var responsive_width = wp.customize('total_plus_responsive_width').get();
            var header_height = wp.customize('total_plus_mh_height').get();
            var logo_height = parseInt(header_height) - 30;
            var min_logo_height = Math.min(parseInt(logo_height), parseInt(to));
            var css = '.ht-header-one #ht-site-branding img,.ht-header-two #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-five #ht-site-branding img{height:' + to + 'px}';
            css += '.ht-header-four #ht-site-branding img,.ht-header-six #ht-site-branding img{max-height:' + to + 'px}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.ht-header-one #ht-site-branding img,.ht-header-two #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-five #ht-site-branding img{height: auto;max-height: ' + min_logo_height + 'px}}';
            total_plus_dynamic_css('total_plus_logo_height', css);
        });
    });

    wp.customize('total_plus_website_width', function (value) {
        value.bind(function (to) {
            var container_width = parseInt(to);
            var boxed_container_width = container_width + 80;
            var header_five_top_container = container_width - 100;
            var css = '.ht-container,.ht-slide-caption{max-width:' + container_width + 'px}';
            css += 'body.ht-boxed #ht-page{max-width:' + boxed_container_width + 'px;}';
            css += '.ht-header-five .ht-top-header.ht-container{max-width:' + header_five_top_container + 'px;}';
            total_plus_dynamic_css('total_plus_website_width', css);
        });
    });

    wp.customize('total_plus_sidebar_width', function (value) {
        value.bind(function (to) {
            var primary = 100 - 3 - parseInt(to);
            var css = '#primary{width:' + primary + '%}';
            css += '#secondary{width:' + to + '%;}';
            total_plus_dynamic_css('total_plus_sidebar_width', css);
        });
    });

    wp.customize('total_plus_mh_menu_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu > ul > li.menu-item > a, .hover-style1 .ht-menu>ul>li.menu-item.menu-item-social-icon:hover > a > i,.hover-style1 .ht-menu>ul>li.menu-item.menu-item-search:hover > a > i,.hover-style1 .ht-menu>ul>li.menu-item.menu-item-ht-cart:hover > a > i,.hover-style3 .ht-menu>ul>li.menu-item.menu-item-social-icon:hover > a > i,.hover-style3 .ht-menu>ul>li.menu-item.menu-item-search:hover > a > i,.hover-style3 .ht-menu>ul>li.menu-item.menu-item-ht-cart:hover > a > i,.hover-style5 .ht-menu>ul>li.menu-item.menu-item-social-icon:hover > a > i,.hover-style5 .ht-menu>ul>li.menu-item.menu-item-search:hover > a > i,.hover-style5 .ht-menu>ul>li.menu-item.menu-item-ht-cart:hover > a > i{color:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_menu_color', css);
        });
    });

    wp.customize('total_plus_mh_menu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.hover-style1 .ht-menu > ul> li.menu-item:hover > a,.hover-style1 .ht-menu > ul> li.menu-item.current_page_item > a, .hover-style1 .ht-menu > ul > li.menu-item.current-menu-item > a,.ht-menu > ul > li.menu-item:hover > a,.ht-menu > ul > li.menu-item:hover > a > i,.ht-menu > ul > li.menu-item.current_page_item > a,.ht-menu > ul > li.menu-item.current-menu-item > a,.ht-menu > ul > li.menu-item.current_page_ancestor > a,.ht-menu > ul > li.menu-item.current > a{color:' + to + '}';
            css += '.hover-style2 .ht-menu > ul > li.menu-item:hover > a,.hover-style2 .ht-menu > ul > li.menu-item.current_page_item > a,.hover-style2 .ht-menu > ul > li.menu-item.current-menu-item > a,.hover-style2 .ht-menu > ul > li.menu-item.current_page_ancestor > a,.hover-style2 .ht-menu > ul > li.menu-item.current > a,.hover-style4 .ht-menu > ul > li.menu-item:hover > a,.hover-style4 .ht-menu > ul > li.menu-item.current_page_item > a,.hover-style4 .ht-menu > ul > li.menu-item.current-menu-item > a,.hover-style4 .ht-menu > ul > li.menu-item.current_page_ancestor > a,.hover-style4 .ht-menu > ul > li.menu-item.current > a{color:' + to + ';border-color:' + to + '}'
            css += '.hover-style6 .ht-menu > ul > li.menu-item:hover > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current_page_item > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current-menu-item > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current_page_ancestor > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current > a:before{background:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_menu_hover_color', css);
        });
    });

    wp.customize('total_plus_mh_menu_hover_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.hover-style1 .ht-menu>ul>li.menu-item:hover>a,.hover-style1 .ht-menu>ul>li.menu-item.current_page_item>a,.hover-style1 .ht-menu>ul>li.menu-item.current-menu-item>a,.hover-style1 .ht-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style1 .ht-menu>ul>li.menu-item.current>a,.hover-style5 .ht-menu>ul>li.menu-item:hover>a,.hover-style5 .ht-menu>ul>li.menu-item.current_page_item>a,.hover-style5 .ht-menu>ul>li.menu-item.current-menu-item>a,.hover-style5 .ht-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style5 .ht-menu>ul>li.menu-item.current>a,.hover-style3 .ht-menu>ul>li.menu-item:hover>a,.hover-style3 .ht-menu>ul>li.menu-item.current_page_item>a,.hover-style3 .ht-menu>ul>li.menu-item.current-menu-item>a,.hover-style3 .ht-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style3 .ht-menu>ul>li.menu-item.current>a{background:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_menu_hover_bg_color', css);
        });
    });

    wp.customize('total_plus_mh_submenu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu ul ul,.menu-item-ht-cart .widget_shopping_cart,#ht-responsive-menu{background:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_submenu_bg_color', css);
        });
    });

    wp.customize('total_plus_mh_submenu_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu .megamenu *,#ht-responsive-menu .megamenu *,.ht-menu .megamenu a,#ht-responsive-menu .megamenu a,.ht-menu ul ul li.menu-item>a,.menu-item-ht-cart .widget_shopping_cart a,.menu-item-ht-cart .widget_shopping_cart,#ht-responsive-menu li.menu-item>a,#ht-responsive-menu li.menu-item>a i,#ht-responsive-menu li .dropdown-nav,.megamenu-category .mega-post-title a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_submenu_color', css);
        });
    });

    wp.customize('total_plus_mh_submenu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,.ht-menu ul ul.megamenu li.menu-item > a:hover,.ht-menu ul ul li.menu-item > a:hover i,.ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab{color:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_submenu_hover_color', css);
        });
    });

    wp.customize('total_plus_mh_submenu_hover_bg_color', function (value) {
        value.bind(function (to) {
            if (!to) {
                to = 'transparent';
            }
            var css = '.ht-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,.ht-menu ul ul.megamenu li.menu-item > a:hover,.ht-menu ul ul li.menu-item > a:hover i,.ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab{background-color:' + to + '}';
            total_plus_dynamic_css('total_plus_mh_submenu_hover_bg_color', css);
        });
    });

    wp.customize('total_plus_mh_menu_hover_style', function (value) {
        value.bind(function (to) {
            $('#ht-masthead').removeClass('hover-style1 hover-style2 hover-style3 hover-style4 hover-style5 hover-style6 hover-style7').addClass(to);
        });
    });

    wp.customize('total_plus_menu_dropdown_padding', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu>ul>li.menu-item{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            total_plus_dynamic_css('total_plus_menu_dropdown_padding', css);
        });
    });

    wp.customize('total_plus_hb_text', function (value) {
        value.bind(function (to) {
            $('.ht-header-bttn').text(to);
        });
    });

    wp.customize('total_plus_hb_link', function (value) {
        value.bind(function (to) {
            $('.ht-header-bttn').attr('href', to);
        });
    });

    wp.customize('total_plus_hb_text_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn{color:' + to + '}';
            total_plus_dynamic_css('total_plus_hb_text_color', css);
        });
    });

    wp.customize('total_plus_hb_text_hov_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_hb_text_hov_color', css);
        });
    });

    wp.customize('total_plus_hb_bg_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn{background:' + to + '}';
            total_plus_dynamic_css('total_plus_hb_bg_color', css);
        });
    });

    wp.customize('total_plus_hb_bg_hov_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn:hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_hb_bg_hov_color', css);
        });
    });

    wp.customize('total_plus_hb_borderradius', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn{border-radius:' + to + 'px}';
            total_plus_dynamic_css('total_plus_hb_borderradius', css);
        });
    });

    wp.customize('total_plus_hb_disable_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.ht-header-bttn').addClass('ht-mobile-hide');
            } else {
                $('.ht-header-bttn').removeClass('ht-mobile-hide');
            }
        });
    });

    wp.customize('total_plus_titlebar_bg_url', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header{background-image:url(' + to + ')}';
            total_plus_dynamic_css('total_plus_titlebar_bg_url', css);
        });
    });

    wp.customize('total_plus_titlebar_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header{background-repeat:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_bg_repeat', css);
        });
    });

    wp.customize('total_plus_titlebar_bg_size', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header{background-size:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_bg_size', css);
        });
    });

    wp.customize('total_plus_titlebar_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '.ht-main-header{background-position:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_bg_position', css);
        });
    });

    wp.customize('total_plus_titlebar_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header{background-attachment:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_bg_attach', css);
        });
    });

    wp.customize('total_plus_titlebar_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header{background-color:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_bg_color', css);
        });
    });

    wp.customize('total_plus_titlebar_bg_overlay', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header:before{background-color:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_bg_overlay', css);
        });
    });

    wp.customize('total_plus_titlebar_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-header,.ht-main-header *,.woocommerce .woocommerce-breadcrumb a,.breadcrumb-trail a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_titlebar_text_color', css);
        });
    });

    wp.customize('total_plus_titlebar_padding', function (value) {
        value.bind(function (title_padding) {
            var headerHeight = $('#ht-masthead').outerHeight();
            if ($('#ht-masthead').hasClass('ht-header-one')) {
                $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
                $('.ht-header-above .ht-main-header').css('padding-top', parseInt(title_padding));
            } else if ($('#ht-masthead').hasClass('ht-header-two')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding) + 40);
            } else if ($('#ht-masthead').hasClass('ht-header-three')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
            } else if ($('#ht-masthead').hasClass('ht-header-four')) {
                var headerWrapHeight = $('.ht-header-wrap').outerHeight() / 2;
                $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(title_padding) + headerWrapHeight);
                $('.ht-header-above .ht-main-header').css('padding-top', parseInt(title_padding) + headerWrapHeight);
            } else if ($('#ht-masthead').hasClass('ht-header-five')) {
                $('.ht-main-header').css('padding-top', headerHeight + parseInt(title_padding));
            } else {
                $('.ht-main-header').css('padding-top', parseInt(title_padding));
            }
            console.log(title_padding);
            $('.ht-main-header').css('padding-bottom', parseInt(title_padding));
        });
    });

    wp.customize('total_plus_footer_bg_url', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-image:url(' + to + ')}';
            total_plus_dynamic_css('total_plus_footer_bg_url', css);
        });
    });

    wp.customize('total_plus_footer_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-repeat:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_bg_repeat', css);
        });
    });

    wp.customize('total_plus_footer_bg_size', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-size:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_bg_size', css);
        });
    });

    wp.customize('total_plus_footer_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '#ht-colophon{background-position:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_bg_position', css);
        });
    });

    wp.customize('total_plus_footer_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-attachment:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_bg_attach', css);
        });
    });

    wp.customize('total_plus_footer_bg_color', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon:before{background-color:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_bg_color', css);
        });
    });

    wp.customize('total_plus_footer_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer *{color:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_text_color', css);
        });
    });

    wp.customize('total_plus_footer_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_footer_anchor_color', css);
        });
    });

    wp.customize('total_plus_footer_copyright', function (value) {
        value.bind(function (to) {
            $('.ht-site-info').html(to);
        });
    });

    wp.customize('total_plus_gdpr_position', function (value) {
        value.bind(function (to) {
            $('.total-plus-privacy-policy').removeClass('top-full-width bottom-full-width bottom-left-float bottom-right-float').addClass(to);
        });
    });

    wp.customize('total_plus_gdpr_bg', function (value) {
        value.bind(function (to) {
            var css = '.total-plus-privacy-policy{background:' + to + '}';
            total_plus_dynamic_css('total_plus_gdpr_bg', css);
        });
    });

    wp.customize('total_plus_gdpr_notice', function (value) {
        value.bind(function (to) {
            $('.policy-text').html(to);
        });
    });

    wp.customize('total_plus_gdpr_confirm_button_text', function (value) {
        value.bind(function (to) {
            $('#total-plus-confirm').text(to);
        });
    });

    wp.customize('total_plus_gdpr_text_color', function (value) {
        value.bind(function (to) {
            var css = '.total-plus-privacy-policy, .policy-text a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_gdpr_text_color', css);
        });
    });

    wp.customize('total_plus_button_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.policy-buttons a,.policy-buttons a:hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_button_bg_color', css);
        });
    });

    wp.customize('total_plus_button_text_color', function (value) {
        value.bind(function (to) {
            var css = '.policy-buttons a,.policy-buttons a:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_button_text_color', css);
        });
    });

    wp.customize('total_plus_gdpr_hide_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.total-plus-privacy-policy').addClass('policy-hide-mobile');
            } else {
                $('.total-plus-privacy-policy').removeClass('policy-hide-mobile');
            }
        });
    });

    wp.customize('total_plus_enable_gdpr', function (value) {
        value.bind(function (to) {
            if ('off' == to) {
                var css = '.customizer-gdpr-section .total-plus-privacy-policy{display:none !important}';
            } else {
                var css = '.customizer-gdpr-section .total-plus-privacy-policy{display:block !important}';
            }

            total_plus_dynamic_css('total_plus_enable_gdpr', css);
        });
    });

    wp.customize('total_plus_banner_image', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-banner{background-image:url(' + to + ')}';
            total_plus_dynamic_css('total_plus_banner_image', css);
        });
    });

    wp.customize('total_plus_banner_image_repeat', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-banner{background-repeat:' + to + '}';
            total_plus_dynamic_css('total_plus_banner_image_repeat', css);
        });
    });

    wp.customize('total_plus_banner_image_size', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-banner{background-size:' + to + '}';
            total_plus_dynamic_css('total_plus_banner_image_size', css);
        });
    });

    wp.customize('total_plus_banner_image_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '.ht-main-banner{background-position:' + to + '}';
            total_plus_dynamic_css('total_plus_banner_image_position', css);
        });
    });

    wp.customize('total_plus_banner_image_attach', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-banner{background-attachment:' + to + '}';
            total_plus_dynamic_css('total_plus_banner_image_attach', css);
        });
    });

    wp.customize('total_plus_banner_title', function (value) {
        value.bind(function (to) {
            $('.ht-banner-title').text(to);
        });
    });

    wp.customize('total_plus_banner_subtitle', function (value) {
        value.bind(function (to) {
            $('.ht-banner-subtitle').text(to);
        });
    });

    wp.customize('total_plus_banner_button_text', function (value) {
        value.bind(function (to) {
            $('.ht-banner-button .ht-button').text(to);
        });
    });

    wp.customize('total_plus_banner_text_alignment', function (value) {
        value.bind(function (to) {
            $('.ht-main-banner .ht-container').removeClass('ht-banner-left ht-banner-right ht-banner-center').addClass('ht-banner-' + to);
        });
    });

    wp.customize('total_plus_banner_overlay_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-main-banner:before{background:' + to + '}';
            total_plus_dynamic_css('total_plus_banner_overlay_color', css);
        });
    });

    wp.customize('total_plus_slider_bs_color', function (value) {
        value.bind(function (to) {
            var css = '#ht-home-slider-section .bottom-section-seperator svg{fill:' + to + '}';
            total_plus_dynamic_css('total_plus_slider_bs_color', css);
        });
    });

    wp.customize('total_plus_slider_bs_height', function (value) {
        value.bind(function (to) {
            var desktop = to;
            var tablet = wp.customize('total_plus_slider_bs_height_tablet').get();
            var mobile = wp.customize('total_plus_slider_bs_height_mobile').get();

            var css = '#ht-home-slider-section .bottom-section-seperator{height:' + desktop + 'px}';

            if (tablet) {
                css += '@media screen and (max-width:768px){';
                css += '#ht-home-slider-section .bottom-section-seperator{height:' + tablet + 'px}';
                css += '}';
            }

            if (mobile) {
                css += '@media screen and (max-width:480px){';
                css += '#ht-home-slider-section .bottom-section-seperator{height:' + mobile + 'px}';
                css += '}';
            }

            total_plus_dynamic_css('total_plus_slider_bs_height', css);
        });
    });

    wp.customize('total_plus_slider_bs_height_tablet', function (value) {
        value.bind(function (to) {
            var desktop = wp.customize('total_plus_slider_bs_height').get();
            var tablet = to;
            var mobile = wp.customize('total_plus_slider_bs_height_mobile').get();

            var css = '#ht-home-slider-section .bottom-section-seperator{height:' + desktop + 'px}';

            if (tablet) {
                css += '@media screen and (max-width:768px){';
                css += '#ht-home-slider-section .bottom-section-seperator{height:' + tablet + 'px}';
                css += '}';
            }

            if (mobile) {
                css += '@media screen and (max-width:480px){';
                css += '#ht-home-slider-section .bottom-section-seperator{height:' + mobile + 'px}';
                css += '}';
            }

            total_plus_dynamic_css('total_plus_slider_bs_height', css);
        });
    });

    wp.customize('total_plus_slider_bs_height_mobile', function (value) {
        value.bind(function (to) {
            var desktop = wp.customize('total_plus_slider_bs_height').get();
            var tablet = wp.customize('total_plus_slider_bs_height_tablet').get();
            var mobile = to;

            var css = '#ht-home-slider-section .bottom-section-seperator{height:' + desktop + 'px}';

            if (tablet) {
                css += '@media screen and (max-width:768px){';
                css += '#ht-home-slider-section .bottom-section-seperator{height:' + tablet + 'px}';
                css += '}';
            }

            if (mobile) {
                css += '@media screen and (max-width:480px){';
                css += '#ht-home-slider-section .bottom-section-seperator{height:' + mobile + 'px}';
                css += '}';
            }

            total_plus_dynamic_css('total_plus_slider_bs_height', css);
        });
    });

    wp.customize('total_plus_slider_overlay_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide:before{background:' + to + '}';
            total_plus_dynamic_css('total_plus_slider_overlay_color', css);
        });
    });


    var settingIds = ['about', 'highlight', 'featured', 'portfolio', 'service', 'team', 'counter', 'testimonial', 'blog', 'logo', 'cta', 'pricing', 'news', 'tab', 'contact', 'customa', 'customb'];

    $.each(settingIds, function (i, settingId) {
        wp.customize('total_plus_' + settingId + '_enable_fullwindow', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                if ('on' == to) {
                    var css = sectionClass + ' .ht-section-wrap{min-height:100vh;display: -webkit-flex;display: -ms-flexbox;display: flex;overflow: hidden;flex-wrap: wrap}';
                } else {
                    var css = sectionClass + ' .ht-section-wrap{min-height:0;display:block;overflow:visible;}';
                }
                total_plus_dynamic_css('total_plus_' + settingId + '_enable_fullwindow', css);

                if (settingId == 'contact' && to == 'on') {
                    $('.ht-contact-section').addClass('ht-window-height');
                } else if (settingId == 'contact' && to == 'off') {
                    $('.ht-contact-section').removeClass('ht-window-height');
                }
            });
        });

        wp.customize('total_plus_' + settingId + '_align_item', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var styles;
                if (to == 'top') {
                    styles = "align-items: flex-start";
                } else if (to == 'middle') {
                    styles = "align-items: center";
                } else if (to == 'bottom') {
                    styles = "align-items: flex-end";
                } else {
                    styles = "align-items: normal";
                }

                var css = sectionClass + ' .ht-section-wrap{' + styles + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_align_item', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_type', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                if ('color-bg' == to) {
                    var color = wp.customize('total_plus_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_color', css);

                    var css = sectionClass + ' .ht-section-wrap{background-color:transparent}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_overlay_color', css);

                    var css = sectionClass + '{background-image:none}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_url', css);

                } else if ('image-bg' == to) {
                    var image = wp.customize('total_plus_' + settingId + '_bg_image_url').get();
                    var css = sectionClass + '{background-image:url(' + image + ')}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_url', css);

                    var image_repeat = wp.customize('total_plus_' + settingId + '_bg_image_repeat').get();
                    var css = sectionClass + '{background-repeat:' + image_repeat + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_repeat', css);

                    var image_size = wp.customize('total_plus_' + settingId + '_bg_image_size').get();
                    var css = sectionClass + '{background-size:' + image_size + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_size', css);

                    var image_position = wp.customize('total_plus_' + settingId + '_bg_position').get();
                    image_position = image_position.replace('-', ' ');
                    var css = sectionClass + '{background-position:' + image_position + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_position', css);

                    var image_attach = wp.customize('total_plus_' + settingId + '_bg_image_attach').get();
                    var css = sectionClass + '{background-attachment:' + image_attach + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_attach', css);

                    var color = wp.customize('total_plus_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_color', css);

                    var color_overlay = wp.customize('total_plus_' + settingId + '_overlay_color').get();
                    var css = sectionClass + ' .ht-section-wrap{background-color:' + color_overlay + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_overlay_color', css);
                } else if ('gradient-bg' == to) {
                    var gradient = wp.customize('total_plus_' + settingId + '_bg_gradient').get();
                    var css = sectionClass + '{' + gradient + '}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_bg_gradient', css);

                    var css = sectionClass + ' .ht-section-wrap{background-color:transparent}';
                    total_plus_dynamic_css('total_plus_' + settingId + '_overlay_color', css);

                } else if ('video-bg' == to) {
                    wp.customize.preview.send('refresh');
                }
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_image_url', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-image:url(' + to + ')}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_url', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_image_repeat', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-repeat:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_repeat', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_image_size', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-size:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_size', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_position', function (value) {
            value.bind(function (to) {
                to = to.replace('-', ' ');
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-position:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_position', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_image_attach', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-attachment:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_image_attach', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bg_gradient', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bg_gradient', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_overlay_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-wrap{background-color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_overlay_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_super_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-super-title{color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_super_title_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-title{color:' + to + '}';
                css += sectionClass + ' .ht-section-title-top-cs .ht-section-title:after,' + sectionClass + '.ht-section-title-top-ls .ht-section-title:after,' + sectionClass + ' .ht-section-title-big .ht-section-title:after{bakground:' + to + '}';
                css += sectionClass + ' .ht-section-title-big .ht-section-title:after{box-shadow: -35px -8px 0px 0px ' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_title_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_text_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-wrap{color:' + to + '}';

                if (settingId == 'logo') {
                    css += sectionClass + " .style1 .owl-dots .owl-dot{background-color:" + to + "}";
                }

                css += sectionClass + " .ht-section-title-top-ls .ht-section-title:after, " + sectionClass + " .ht-section-title-top-cs .ht-section-title:after," + sectionClass + " .ht-section-title-big .ht-section-title:after{background:" + to + " }";
                css += sectionClass + " .ht-section-title-big .ht-section-title:after{box-shadow:-35px -8px 0px 0px " + to + " }";
                css += sectionClass + " .ht-section-title-single-row .ht-section-title-wrap{border-color:" + to + " }";
                total_plus_dynamic_css('total_plus_' + settingId + '_text_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_link_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' a,' + sectionClass + ' a > i{color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_link_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_link_hov_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' a:hover, ' + sectionClass + ' a:hover > i{color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_link_hov_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_mb_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-button .ht-button{background:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_mb_bg_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_mb_text_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-button .ht-button{color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_mb_text_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_mb_hov_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-button .ht-button:hover{background:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_mb_hov_bg_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_mb_hov_text_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-button .ht-button:hover{color:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_mb_hov_text_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = to;
                var tablet = wp.customize('total_plus_' + settingId + '_tablet_padding_top').get();
                var mobile = wp.customize('total_plus_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_tablet_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('total_plus_' + settingId + '_padding_top').get();
                var tablet = to;
                var mobile = wp.customize('total_plus_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_mobile_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('total_plus_' + settingId + '_padding_top').get();
                var tablet = wp.customize('total_plus_' + settingId + '_tablet_padding_top').get();
                var mobile = to;

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = to;
                var tablet = wp.customize('total_plus_' + settingId + '_tablet_padding_bottom').get();
                var mobile = wp.customize('total_plus_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_tablet_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('total_plus_' + settingId + '_padding_bottom').get();
                var tablet = to;
                var mobile = wp.customize('total_plus_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_mobile_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('total_plus_' + settingId + '_padding_bottom').get();
                var tablet = wp.customize('total_plus_' + settingId + '_tablet_padding_bottom').get();
                var mobile = to;

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_ts_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .top-section-seperator svg{ fill:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_ts_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bs_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .bottom-section-seperator svg{ fill:' + to + '}';
                total_plus_dynamic_css('total_plus_' + settingId + '_bs_color', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_ts_height', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = to;
                var tablet = wp.customize('total_plus_' + settingId + '_ts_height_tablet').get();
                var mobile = wp.customize('total_plus_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_ts_height_tablet', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('total_plus_' + settingId + '_ts_height').get();
                var tablet = to;
                var mobile = wp.customize('total_plus_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_ts_height_mobile', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('total_plus_' + settingId + '_ts_height').get();
                var tablet = wp.customize('total_plus_' + settingId + '_ts_height_tablet').get();
                var mobile = to;

                var css = sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bs_height', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = to;
                var tablet = wp.customize('total_plus_' + settingId + '_bs_height_tablet').get();
                var mobile = wp.customize('total_plus_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bs_height_tablet', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('total_plus_' + settingId + '_bs_height').get();
                var tablet = to;
                var mobile = wp.customize('total_plus_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('total_plus_' + settingId + '_bs_height_mobile', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('total_plus_' + settingId + '_bs_height').get();
                var tablet = wp.customize('total_plus_' + settingId + '_bs_height_tablet').get();
                var mobile = to;

                var css = sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                total_plus_dynamic_css('total_plus_' + settingId + '_bs_height', css);
            });
        });

    });

    wp.customize('total_plus_caption_title_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-cap-title span{background:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_title_background_color', css);
        });
    });

    wp.customize('total_plus_caption_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-cap-title, .ht-banner-title{color:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_title_color', css);
        });
    });

    wp.customize('total_plus_caption_subtitle_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-cap-desc,.ht-banner-subtitle{color:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_subtitle_color', css);
        });
    });

    wp.customize('total_plus_slider_arrow_bg_color', function (value) {
        value.bind(function (to) {
            var css = '#ht-home-slider-section .owl-nav [class*=owl-],#ht-home-slider-section .owl-dots .owl-dot.active{background:' + to + '}';
            css += '#ht-home-slider-section .owl-dots .owl-dot{border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_slider_arrow_bg_color', css);
        });
    });

    wp.customize('total_plus_slider_arrow_color', function (value) {
        value.bind(function (to) {
            var css = '#ht-home-slider-section .owl-nav [class*=owl-]:before, #ht-home-slider-section .owl-nav [class*=owl-]:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_slider_arrow_color', css);
        });
    });

    wp.customize('total_plus_slider_arrow_bg_color_hover', function (value) {
        value.bind(function (to) {
            var css = '#ht-home-slider-section .owl-nav [class*=owl-]:hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_slider_arrow_bg_color_hover', css);
        });
    });

    wp.customize('total_plus_slider_arrow_color_hover', function (value) {
        value.bind(function (to) {
            var css = '#ht-home-slider-section .owl-nav [class*=owl-]:hover:before, #ht-home-slider-section .owl-nav [class*=owl-]:hover:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_slider_arrow_color_hover', css);
        });
    });

    wp.customize('total_plus_caption_button_bg_color', function (value) {
        value.bind(function (to) {
            if (!to) {
                to = 'none';
            }
            var css = '.ht-slide-button a, .ht-banner-button a.ht-button{background:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_button_bg_color', css);
        });
    });

    wp.customize('total_plus_caption_button_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-button a, .ht-banner-button a.ht-button{border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_button_border_color', css);
        });
    });

    wp.customize('total_plus_caption_button_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-button a, .ht-banner-button a.ht-button{color:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_button_text_color', css);
        });
    });

    wp.customize('total_plus_caption_button_bg_hov_color', function (value) {
        value.bind(function (to) {
            if (!to) {
                to = 'none';
            }
            var css = '.ht-slide-button a:hover, .ht-banner-button a.ht-button:hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_button_bg_hov_color', css);
        });
    });

    wp.customize('total_plus_caption_button_border_hov_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-button a:hover, .ht-banner-button a.ht-button:hover{border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_button_border_hov_color', css);
        });
    });

    wp.customize('total_plus_caption_button_text_hov_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-slide-button a:hover, .ht-banner-button a.ht-button:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_caption_button_text_hov_color', css);
        });
    });

    wp.customize('total_plus_progressbar_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-progress h6, .ht-progress-bar-length span{color:' + to + '}';
            total_plus_dynamic_css('total_plus_progressbar_text_color', css);
        });
    });

    wp.customize('total_plus_progressbar_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-progress-bar{background:' + to + '}';
            total_plus_dynamic_css('total_plus_progressbar_bg_color', css);
        });
    });

    wp.customize('total_plus_progressbar_indication_bar_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-progress-bar-length{background:' + to + '}';
            total_plus_dynamic_css('total_plus_progressbar_indication_bar_color', css);
        });
    });

    wp.customize('total_plus_featured_block_icon_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-icon i{color:' + to + '}';
            total_plus_dynamic_css('total_plus_featured_block_icon_color', css);
        });
    });

    wp.customize('total_plus_featured_block_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-post h5{color:' + to + '}';
            total_plus_dynamic_css('total_plus_featured_block_title_color', css);
        });
    });

    wp.customize('total_plus_featured_block_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-post .ht-featured-excerpt{color:' + to + '}';
            total_plus_dynamic_css('total_plus_featured_block_text_color', css);
        });
    });

    wp.customize('total_plus_featured_block_readmore_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-section .ht-featured-link a, .ht-featured-section .ht-featured-link a i,.ht-featured-section .ht-featured-link a:hover, .ht-featured-section .ht-featured-link a:hover i{color:' + to + '}';
            total_plus_dynamic_css('total_plus_featured_block_readmore_color', css);
        });
    });

    wp.customize('total_plus_featured_block_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-section .style2 .ht-featured-post, .ht-featured-section .style7 .ht-featured-post{background:' + to + '}';
            total_plus_dynamic_css('total_plus_featured_block_background_color', css);
        });
    });

    wp.customize('total_plus_featured_block_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-section .style1 .ht-featured-post, .ht-featured-section .style2 .ht-featured-post, .ht-featured-section .style3 .ht-featured-post{border-color:' + to + '}';
            css += '.ht-featured-section .style1 .ht-featured-post:before, .ht-featured-section .style1 .ht-featured-post:after, .ht-featured-section .style1 .ht-featured-link a{background:' + to + '}'
            total_plus_dynamic_css('total_plus_featured_block_border_color', css);
        });
    });

    wp.customize('total_plus_featured_block_icon_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-featured-section .style7 .ht-featured-icon{background:' + to + '}';
            total_plus_dynamic_css('total_plus_featured_block_icon_bg_color', css);
        });
    });

    wp.customize('total_plus_highlight_block_highlight_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-highlight-section .style1 .ht-highlight-title, .ht-highlight-section .style1 .ht-highlight-hover{background:' + totalPlusConvertHex(to, 90) + '}';
            css += '.ht-highlight-section .style2 .ht-highlight-icon, .ht-highlight-section .style3 .ht-highlight-hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_highlight_block_highlight_color', css);
        });
    });

    wp.customize('total_plus_highlight_block_icon_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-highlight-icon i{color:' + to + '}';
            css += '.ht-highlight-section .style4 .ht-highlight-icon:before,.ht-highlight-section .style4 .ht-highlight-icon:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_highlight_block_icon_color', css);
        });
    });

    wp.customize('total_plus_highlight_block_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-highlight-post h5{color:' + to + '}';
            total_plus_dynamic_css('total_plus_highlight_block_title_color', css);
        });
    });

    wp.customize('total_plus_highlight_block_excerpt_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-highlight-excerpt{color:' + to + '}';
            total_plus_dynamic_css('total_plus_highlight_block_excerpt_color', css);
        });
    });

    wp.customize('total_plus_highlight_block_readmore_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-highlight-link a, .ht-highlight-link a:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_highlight_block_readmore_color', css);
        });
    });

    wp.customize('total_plus_team_block_overlay_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-member.style1 .ht-title-wrap, .ht-team-section .ht-team-member.style1 .ht-team-member-excerpt, .ht-team-section .ht-team-member.style3:hover .ht-team-image-overlay{background:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_overlay_color', css);
        });
    });

    wp.customize('total_plus_team_block_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-member.style2 .ht-team-member-inner,.ht-team-section .ht-team-member.style3, .ht-team-section .ht-team-member.style4, .ht-team-section .ht-team-member.style5 .ht-team-member-content, .ht-team-section .ht-team-member.style6 .ht-team-member-content{background:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_background_color', css);
        });
    });

    wp.customize('total_plus_team_block_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-member.style1 .ht-title-wrap h5, .ht-team-section .ht-team-member.style1 h5, .ht-team-section .ht-team-member h5{color:' + to + '}';
            css += '.ht-team-section .ht-team-member.style1 .ht-team-member-excerpt h5:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_title_color', css);
        });
    });

    wp.customize('total_plus_team_block_designation_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-designation{color:' + to + ' !important}';
            total_plus_dynamic_css('total_plus_team_block_designation_color', css);
        });
    });

    wp.customize('total_plus_team_block_excerpt_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-member .team-short-content{color:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_excerpt_color', css);
        });
    });

    wp.customize('total_plus_team_block_social_icon_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-social-id a, .ht-team-section .ht-team-social-id a i{color:' + to + ' !important;border-color:' + to + ' !important}';
            total_plus_dynamic_css('total_plus_team_block_social_icon_color', css);
        });
    });

    wp.customize('total_plus_team_block_detail_link_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-member a.ht-team-detail{color:' + to + ' !important}';
            css += '.ht-team-section .ht-team-member a.ht-team-detail:before, .ht-team-section .ht-team-member a.ht-team-detail:after{background:' + to + ' !important}';
            total_plus_dynamic_css('total_plus_team_block_detail_link_color', css);
        });
    });

    wp.customize('total_plus_team_block_arrow_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-prev, .ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-next{background:' + to + ';border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_arrow_bg_color', css);
        });
    });

    wp.customize('total_plus_team_block_arrow_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-prev, .ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-next{color:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_arrow_color', css);
        });
    });

    wp.customize('total_plus_team_block_arrow_bg_color_hover', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-prev:hover, .ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-next:hover{background:' + to + ';border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_arrow_bg_color_hover', css);
        });
    });

    wp.customize('total_plus_team_block_arrow_color_hover', function (value) {
        value.bind(function (to) {
            var css = '.ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-prev:hover, .ht-team-section .ht-team-carousel.owl-carousel .owl-nav .owl-next:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_team_block_arrow_color_hover', css);
        });
    });

    wp.customize('total_plus_testimonial_block_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-testimonial-section .style3 .ht-testimonial-box,.ht-testimonial-section .style4 .ht-testimonial-box{background:' + to + '}';
            total_plus_dynamic_css('total_plus_testimonial_block_background_color', css);
        });
    });

    wp.customize('total_plus_testimonial_block_name_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-testimonial-section .ht-testimonial-wrap h5{color:' + to + '}';
            total_plus_dynamic_css('total_plus_testimonial_block_name_color', css);
        });
    });

    wp.customize('total_plus_testimonial_block_designation_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-testimonial-section .ht-testimonial-wrap .designation{color:' + to + '}';
            total_plus_dynamic_css('total_plus_testimonial_block_designation_color', css);
        });
    });

    wp.customize('total_plus_testimonial_block_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-testimonial-section .ht-testimonial-excerpt{color:' + to + '}';
            total_plus_dynamic_css('total_plus_testimonial_block_text_color', css);
        });
    });

    wp.customize('total_plus_testimonial_block_dot_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-testimonial-section .style4 .owl-nav [class^="owl-"]{color:' + to + '}';
            css += '.ht-testimonial-wrap.style2 .slick-dots li{border-color:' + to + '}';
            css += '.ht-testimonial-wrap.style1 .owl-dots .owl-dot, .ht-testimonial-wrap.style2 .slick-dots li.slick-active button{background:' + to + '}';
            total_plus_dynamic_css('total_plus_testimonial_block_dot_color', css);
        });
    });

    wp.customize('total_plus_counter_block_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-counter-section .style3 .ht-counter{background:' + to + '}';
            total_plus_dynamic_css('total_plus_counter_block_background_color', css);
        });
    });

    wp.customize('total_plus_counter_block_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-counter-section .style1 .ht-counter, .ht-counter-section .style3 .ht-counter:before{border-color:' + to + '}';
            css += '.ht-counter-section .style1 .ht-counter:after, .ht-counter-section .style1 .ht-counter:before, .ht-counter-section .style2 .ht-counter:before,.ht-counter-section .style2 .ht-counter:after, .ht-counter-section .style2 .ht-counter>span:before,.ht-counter-section .style2 .ht-counter>span:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_counter_block_border_color', css);
        });
    });

    wp.customize('total_plus_counter_block_icon_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-counter-section .ht-counter-icon i{color:' + to + '}';
            css += '.ht-counter-section .style2 .ht-counter-icon:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_counter_block_icon_color', css);
        });
    });

    wp.customize('total_plus_counter_block_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-counter-section .ht-counter-title{color:' + to + '}';
            total_plus_dynamic_css('total_plus_counter_block_title_color', css);
        });
    });

    wp.customize('total_plus_counter_block_number_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-counter-section .ht-counter-count{color:' + to + '}';
            total_plus_dynamic_css('total_plus_counter_block_number_color', css);
        });
    });

    wp.customize('total_plus_tab_block_tab_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-tab-section .ht-tab-wrap .ht-tab, .ht-tab-section .ht-tab-wrap.style2 .ht-tab *{color:' + to + '}';
            css += '.ht-tab-section .ht-tab-wrap.style1 .ht-tabs:after{background:' + to + '}';
            css += '.ht-tab-section .ht-tab-wrap.style4 .ht-tab:after,.ht-tab-section .ht-tab-wrap.style4 .ht-tab span{border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_tab_block_tab_title_color', css);
        });
    });

    wp.customize('total_plus_tab_block_tab_active_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-tab-section .ht-tab-wrap .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active *, .ht-tab-section .ht-tab-wrap.style3 .ht-tab.ht-active *, .ht-tab-section .ht-tab-wrap.style5 .ht-tab.ht-active *{color:' + to + '}';
            total_plus_dynamic_css('total_plus_tab_block_tab_active_title_color', css);
        });
    });

    wp.customize('total_plus_tab_block_active_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active:after{border-left-color:' + to + '}';
            css += '.ht-tab-section .ht-tab-wrap.style3 .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style4 .ht-tab.ht-active span{border-color:' + to + '}';
            css += '.ht-tab-section .ht-tab-wrap.style2 .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style1 .ht-tab.ht-active:after, .ht-tab-section .ht-tab-wrap.style4 .ht-tab.ht-active span:before, .ht-tab-section .ht-tab-wrap.style5 .ht-tab.ht-active, .ht-tab-section .ht-tab-wrap.style5 .ht-tab.ht-active:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_tab_block_active_bg_color', css);
        });
    });

    wp.customize('total_plus_tab_content_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-tab-section .ht-tab-content h1,.ht-tab-section .ht-tab-content h2,.ht-tab-section .ht-tab-content h3,.ht-tab-section .ht-tab-content h4,.ht-tab-section .ht-tab-content h5,.ht-tab-section .ht-tab-content h6{color:' + to + '}';
            total_plus_dynamic_css('total_plus_tab_content_title_color', css);
        });
    });

    wp.customize('total_plus_tab_content_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-tab-section .ht-tab-content{color:' + to + '}';
            total_plus_dynamic_css('total_plus_tab_content_text_color', css);
        });
    });

    wp.customize('total_plus_pricing_block_highlight_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header,.ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header:before, .ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header:after, .ht-pricing-section .ht-pricing.style1:hover .ht-pricing-button a, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header:before, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header:after, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-button a, .ht-pricing-section .ht-pricing.style2:hover .ht-pricing-header, .ht-pricing-section .ht-pricing.style2.ht-featured .ht-pricing-header, .ht-pricing-section .ht-pricing.style2 .ht-pricing-button a,.ht-pricing-section .ht-pricing.style3 .ht-pricing-price,.ht-pricing-section .ht-pricing.style3 .ht-pricing-main, .ht-pricing-section .ht-pricing.style4 .ht-pricing-header, .ht-pricing-section .ht-pricing.style4 .ht-pricing-button a{background:' + to + '}';
            css += '.ht-pricing-section .ht-pricing.style3{border-color:' + to + '}';
            css += '.ht-pricing-section .ht-pricing.style3 .ht-pricing-header h5{color:' + to + '}';
            css += '.ht-pricing-section .ht-pricing.style4 .ht-pricing-header:before{background-image: linear-gradient(-45deg, transparent 14px, ' + to + ' 0), linear-gradient(45deg, transparent 14px, ' + to + ' 0)}';
            total_plus_dynamic_css('total_plus_pricing_block_highlight_color', css);
        });
    });

    wp.customize('total_plus_pricing_block_highlight_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-pricing-section .ht-pricing.style1:hover .ht-pricing-header *, .ht-pricing-section .ht-pricing.style1:hover .ht-pricing-button a, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-header *, .ht-pricing-section .ht-pricing.style1.ht-featured .ht-pricing-button a, .ht-pricing-section .ht-pricing.style2:hover .ht-pricing-header *, .ht-pricing-section .ht-pricing.style2.ht-featured .ht-pricing-header *, .ht-pricing-section .ht-pricing.style2 .ht-pricing-button a, .ht-pricing-section .ht-pricing.style3 .ht-pricing-price *, .ht-pricing-section .ht-pricing.style3 .ht-pricing-list *, .ht-pricing-section .ht-pricing.style3 .ht-pricing-button a, .ht-pricing-section .ht-pricing.style4 .ht-pricing-header *, .ht-pricing-section .ht-pricing.style4 .ht-pricing-button a{color:' + to + '}';
            css += '.ht-pricing-section .ht-pricing.style3 .ht-pricing-button a{border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_pricing_block_highlight_text_color', css);
        });
    });


    wp.customize('total_plus_blog_block_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-blog-post h5 a, .ht-blog-section .style4 .ht-blog-excerpt h5 a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_blog_block_title_color', css);
        });
    });

    wp.customize('total_plus_blog_block_excerpt_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-blog-post .ht-blog-excerpt-text{color:' + to + '}';
            total_plus_dynamic_css('total_plus_blog_block_excerpt_color', css);
        });
    });

    wp.customize('total_plus_blog_block_meta_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-blog-section .style1 .ht-blog-date, .ht-blog-wrap.style2 .ht-blog-date, .ht-blog-section .style2 .ht-blog-footer span, .ht-blog-section .style3 .ht-blog-date, .ht-blog-section .style4 .ht-blog-date, .ht-blog-section .style4 .ht-blog-footer *, .ht-blog-section .style3 .ht-blog-date span{color:' + to + '}';
            css += '.ht-blog-section .style2 .ht-blog-footer:after{background:' + to + '}';
            total_plus_dynamic_css('total_plus_blog_block_meta_color', css);
        });
    });

    wp.customize('total_plus_blog_block_readmore_button_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-blog-section .ht-blog-read-more a{background:' + to + '}';
            css += '.ht-blog-section .style1 .ht-blog-post{border-color:' + to + '}';
            total_plus_dynamic_css('total_plus_blog_block_readmore_button_bg_color', css);
        });
    });

    wp.customize('total_plus_blog_block_readmore_button_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-blog-section .ht-blog-read-more a{color:' + to + '}';
            total_plus_dynamic_css('total_plus_blog_block_readmore_button_text_color', css);
        });
    });

    wp.customize('total_plus_blog_block_meta_background_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-blog-section .style3 .ht-blog-date{background:' + to + '}';
            total_plus_dynamic_css('total_plus_blog_block_meta_background_color', css);
        });
    });


    wp.customize('total_plus_cta_button1_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-cta-buttons a.ht-cta-button1{background:' + to + '}';
            css += '.ht-cta-buttons a.ht-cta-button2:hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_cta_button1_bg_color', css);
        });
    });

    wp.customize('total_plus_cta_button1_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-cta-buttons a.ht-cta-button1{color:' + to + '}';
            css += '.ht-cta-buttons a.ht-cta-button2:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_cta_button1_text_color', css);
        });
    });

    wp.customize('total_plus_cta_button2_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-cta-buttons a.ht-cta-button2{background:' + to + '}';
            css += '.ht-cta-buttons a.ht-cta-button1:hover{background:' + to + '}';
            total_plus_dynamic_css('total_plus_cta_button2_bg_color', css);
        });
    });

    wp.customize('total_plus_cta_button2_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-cta-buttons a.ht-cta-button2{color:' + to + '}';
            css += '.ht-cta-buttons a.ht-cta-button1:hover{color:' + to + '}';
            total_plus_dynamic_css('total_plus_cta_button2_text_color', css);
        });
    });

    wp.customize('total_plus_cta_video_icon_color', function (value) {
        value.bind(function (to) {
            var css = '#cta-video .video-play-button:after{background-color:' + to + '}';
            css += '#cta-video .video-play-button:before{background-color:' + to + '}';
            total_plus_dynamic_css('total_plus_cta_video_icon_color', css);
        });
    });

    wp.customize('total_plus_content_header_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6{color:" + to + "}";
            total_plus_dynamic_css('total_plus_content_header_color', css);
        });
    });

    wp.customize('total_plus_contact_title_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-contact-detail h1,.ht-contact-detail h2,.ht-contact-detail h3,.ht-contact-detail h4,.ht-contact-detail h5,.ht-contact-detail h6{color:" + to + "}";
            total_plus_dynamic_css('total_plus_contact_title_color', css);
        });
    });

    wp.customize('total_plus_contact_text_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-contact-section .ht-contact-detail{color:" + to + "}";
            total_plus_dynamic_css('total_plus_contact_text_color', css);
        });
    });

    wp.customize('total_plus_contact_social_button_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-contact-detail .ht-contact-social-icon a{background:" + to + "}";
            total_plus_dynamic_css('total_plus_contact_social_button_bg_color', css);
        });
    });

    wp.customize('total_plus_contact_social_button_text_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-contact-section .ht-contact-detail .ht-contact-social-icon a i{color:" + to + "}";
            total_plus_dynamic_css('total_plus_contact_social_button_text_color', css);
        });
    });

    wp.customize('total_plus_service_block_icon_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-service-section.style1 .ht-service-icon i, .ht-service-section.style2 .ht-service-icon i, .ht-service-section.style3 .ht-service-icon i, .ht-service-section.style4 .ht-service-icon i{color:" + to + "}";
            total_plus_dynamic_css('total_plus_service_block_icon_color', css);
        });
    });

    wp.customize('total_plus_service_block_icon_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-service-section.style1 .ht-service-icon, .ht-service-section.style1 .ht-service-post:after{background:" + to + "}";
            css += ".ht-service-section.style1 .ht-active .ht-service-icon{box-shadow:0px 0px 0px 2px #FFF, 0px 0px 0px 4px " + to + "}";
            total_plus_dynamic_css('total_plus_service_block_icon_bg_color', css);
        });
    });

    wp.customize('total_plus_service_block_title_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-service-section .ht-service-excerpt h5, .ht-service-section.style2 .ht-service-excerpt h5{color:" + to + "}";
            total_plus_dynamic_css('total_plus_service_block_title_color', css);
        });
    });

    wp.customize('total_plus_service_block_excerpt_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-service-section .ht-service-text-inner{color:" + to + "}";
            total_plus_dynamic_css('total_plus_service_block_excerpt_color', css);
        });
    });

    wp.customize('total_plus_service_block_link_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-service-section .ht-service-more, .ht-service-section .ht-service-more>i{color:" + to + " !important}";
            total_plus_dynamic_css('total_plus_service_block_link_color', css);
        });
    });

    wp.customize('total_plus_news_block_title_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-news-content h5{color:" + to + "}";
            total_plus_dynamic_css('total_plus_news_block_title_color', css);
        });
    });

    wp.customize('total_plus_news_block_text_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-news-section .ht-news-text{color:" + to + "}";
            total_plus_dynamic_css('total_plus_news_block_text_color', css);
        });
    });

    wp.customize('total_plus_news_block_link_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-news-section .ht-news-link, .ht-news-section .ht-news-link > i{color:" + to + "}";
            total_plus_dynamic_css('total_plus_news_block_link_color', css);
        });
    });

    wp.customize('total_plus_news_block_background_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-news-section .style2 .ht-news-content{background:" + to + "}";
            total_plus_dynamic_css('total_plus_news_block_background_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_tab_text_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name,.ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name,.ht-portfolio-section .ht-portfolio-cat-name-list.style3 .ht-portfolio-cat-name, .ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-cat-name, .ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-switch i,.ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-switch i{color:" + to + "}";
            css += ".ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name, .ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name{border-color:" + totalPlusConvertHex(to, 20) + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_tab_text_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_active_tab_text_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-cat-name-list.style1 .ht-portfolio-cat-name.active, .ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name.active, .ht-portfolio-section .ht-portfolio-cat-name-list.style3 .ht-portfolio-cat-name.active{color:" + to + "}";
            css += ".ht-portfolio-section .ht-portfolio-cat-name-list.style2 .ht-portfolio-cat-name.active:after{background:" + to + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_active_tab_text_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_tab_background_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-cat-wrap,.ht-portfolio-section .ht-portfolio-cat-name-list.style4 .ht-portfolio-switch{background:" + to + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_tab_background_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_image_hov_background_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-caption{background:" + totalPlusConvertHex(to, 90) + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_image_hov_background_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_title_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-caption h5{color:" + to + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_title_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_button_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-caption a{background:" + to + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_button_bg_color', css);
        });
    });

    wp.customize('total_plus_portfolio_block_button_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-portfolio-section .ht-portfolio-caption a i{color:" + to + "}";
            total_plus_dynamic_css('total_plus_portfolio_block_button_color', css);
        });
    });

    wp.customize('total_plus_content_text_color', function (value) {
        value.bind(function (to) {
            var borderColor = totalPlusConvertHex(to, 10);
            var lighterBorderColor = totalPlusConvertHex(to, 5);
            var css = ".ht-main-content{color:" + to + "}";
            css += ".ht-sidebar-style2 .widget-area .widget{border-color:" + borderColor + "}";
            css += ".widget-area li{border-color:" + lighterBorderColor + "}";
            total_plus_dynamic_css('total_plus_content_text_color', css);
        });
    });

    wp.customize('total_plus_content_link_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-main-content a{color:" + to + "}";
            total_plus_dynamic_css('total_plus_content_link_color', css);
        });
    });

    wp.customize('total_plus_content_link_hov_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-main-content a:hover{color:" + to + "}";
            total_plus_dynamic_css('total_plus_content_link_hov_color', css);
        });
    });

    wp.customize('total_plus_content_widget_title_color', function (value) {
        value.bind(function (to) {
            var css = ".widget-area .widget-title, #reply-title, #comments .comments-title, .total-plus-related-post .related-post-title{color:" + to + "}";
            css += ".ht-sidebar-style1 .widget-area .widget-title:after, .ht-sidebar-style1 #reply-title:after, .ht-sidebar-style1 #comments .comments-title:after, .ht-sidebar-style1 .total-plus-related-post .related-post-title:after, .ht-sidebar-style2 .widget-area .widget:before, .ht-sidebar-style2 #reply-title:before, .ht-sidebar-style2 .comments-title:before, .ht-sidebar-style2 .total-plus-related-post .related-post-title:before {background-color:" + to + "}";
            css += ".ht-sidebar-style3 .widget-area .widget-title, .ht-sidebar-style3 #reply-title,.ht-sidebar-style3 #comments .comments-title,.ht-sidebar-style3 .total-plus-related-post .related-post-title {border-color:" + to + "}";
            total_plus_dynamic_css('total_plus_content_widget_title_color', css);
        });
    });

    wp.customize('total_plus_sidebar_style', function (value) {
        value.bind(function (to) {
            $('body').removeClass('ht-sidebar-style1 ht-sidebar-style2 ht-sidebar-style3').addClass('ht-' + to);
        });
    });

    wp.customize('total_plus_toggle_button_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".collapse-button{background:" + to + "}";
            total_plus_dynamic_css('total_plus_toggle_button_bg_color', css);
        });
    });

    wp.customize('total_plus_toggle_button_color', function (value) {
        value.bind(function (to) {
            var css = ".collapse-button .icon-bar{background:" + to + "}";
            total_plus_dynamic_css('total_plus_toggle_button_color', css);
        });
    });
})(jQuery);