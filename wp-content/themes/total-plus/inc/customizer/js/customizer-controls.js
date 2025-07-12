jQuery(document).ready(function ($) {

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    jQuery('html').addClass('colorpicker-ready');

    $('body').on('click', '#customize-control-total_plus_maintenance_social a, #customize-control-total_plus_social_link a, #customize-control-total_plus_contact_social_link a', function () {
        wp.customize.section('total_plus_social_section').expand();
        return false;
    });

    $('body').on('click', '#menu_typography_link', function () {
        wp.customize.section('menu_typography').expand();
        return false;
    });

    $('#sub-accordion-panel-total_plus_home_panel').sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        items: '> li.control-section:not(#accordion-section-total_plus_slider_section)',
        delay: 150,
        update: function (event, ui) {
            $('#sub-accordion-panel-total_plus_home_panel').find('.total-plus-drag-spinner').show();
            total_plus_sections_order('#sub-accordion-panel-total_plus_home_panel');
            $('.wp-full-overlay-sidebar-content').scrollTop(0);
        }
    });

    // Homepage section - control visiblity toggle
    var settingIds = ['about', 'highlight', 'featured', 'portfolio', 'service', 'team', 'counter', 'testimonial', 'blog', 'logo', 'cta', 'pricing', 'news', 'tab', 'contact', 'customa', 'customb'];

    $.each(settingIds, function (i, settingId) {
        wp.customize('total_plus_' + settingId + '_bg_type', function (setting) {
            var setupControlColorBg = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get() || 'image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlImageBg = function (control) {
                var visibility = function () {
                    if ('image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlVideoBg = function (control) {
                var visibility = function () {
                    if ('video-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlGradientBg = function (control) {
                var visibility = function () {
                    if ('gradient-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlOverlay = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get() || 'gradient-bg' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('total_plus_' + settingId + '_bg_color', setupControlColorBg);
            wp.customize.control('total_plus_' + settingId + '_bg_image', setupControlImageBg);
            wp.customize.control('total_plus_' + settingId + '_parallax_effect', setupControlImageBg);
            wp.customize.control('total_plus_' + settingId + '_bg_video', setupControlVideoBg);
            wp.customize.control('total_plus_' + settingId + '_bg_gradient', setupControlGradientBg);
            wp.customize.control('total_plus_' + settingId + '_overlay_color', setupControlOverlay);
        });
    });

    $.each(settingIds, function (i, settingId) {
        wp.customize('total_plus_' + settingId + '_section_seperator', function (setting) {

            var setupTopSeperator = function (control) {
                var visibility = function () {
                    if ('top' === setting.get() || 'top-bottom' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupBottomSeperator = function (control) {
                var visibility = function () {
                    if ('bottom' === setting.get() || 'top-bottom' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('total_plus_' + settingId + '_seperator1', setupTopSeperator);
            wp.customize.control('total_plus_' + settingId + '_top_seperator', setupTopSeperator);
            wp.customize.control('total_plus_' + settingId + '_ts_color', setupTopSeperator);
            wp.customize.control('total_plus_' + settingId + '_ts_height', setupTopSeperator);
            wp.customize.control('total_plus_' + settingId + '_seperator2', setupBottomSeperator);
            wp.customize.control('total_plus_' + settingId + '_bottom_seperator', setupBottomSeperator);
            wp.customize.control('total_plus_' + settingId + '_bs_color', setupBottomSeperator);
            wp.customize.control('total_plus_' + settingId + '_bs_height', setupBottomSeperator);
        });
    });

    $.each(settingIds, function (i, settingId) {
        wp.customize('total_plus_' + settingId + '_enable_fullwindow', function (setting) {

            var setupControlFullWindow = function (control) {
                var visibility = function () {
                    if ('off' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('total_plus_' + settingId + '_align_item', setupControlFullWindow);
        });
    });

    wp.customize('total_plus_enable_iframe_map', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControl1 = function (control) {
            var visibility = function () {
                if (!setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_google_map_iframe', setupControl);
        wp.customize.control('total_plus_latitude', setupControl1);
        wp.customize.control('total_plus_longitude', setupControl1);
        wp.customize.control('total_plus_map_style', setupControl1);
        wp.customize.control('total_plus_google_map_api', setupControl1);
    });

    wp.customize('total_plus_preloader_type', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if ('custom' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControl1 = function (control) {
            var visibility = function () {
                if ('custom' !== setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_preloader_image', setupControl);
        wp.customize.control('total_plus_preloader_color', setupControl1);
    });

    wp.customize('total_plus_archive_content', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if ('excerpt' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_archive_excerpt_length', setupControl);
        wp.customize.control('total_plus_archive_readmore', setupControl);
    });

    wp.customize('total_plus_mh_layout', function (setting) {
        var setupControl = function (control) {
            var visibility = function () {
                if ('header-style1' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupTopHeaderPaddingControl = function (control) {
            var visibility = function () {
                if ('header-style5' === setting.get()) {
                    control.container.addClass('customizer-hidden');
                } else {
                    control.container.removeClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_header_position', setupControl);
        wp.customize.control('total_plus_th_padding', setupTopHeaderPaddingControl);
    });

    wp.customize('total_plus_maintenance_bg_type', function (setting) {
        var setupControlSlider = function (control) {
            var visibility = function () {
                if ('slider' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlShortcode = function (control) {
            var visibility = function () {
                if ('revolution' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBanner = function (control) {
            var visibility = function () {
                if ('banner' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlVideo = function (control) {
            var visibility = function () {
                if ('video' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_maintenance_banner_image', setupControlBanner);
        wp.customize.control('total_plus_maintenance_slider_shortcode', setupControlShortcode);
        wp.customize.control('total_plus_maintenance_sliders', setupControlSlider);
        wp.customize.control('total_plus_maintenance_slider_info', setupControlSlider);
        wp.customize.control('total_plus_maintenance_slider_pause', setupControlSlider);
        wp.customize.control('total_plus_maintenance_video', setupControlVideo);
    });

    wp.customize('total_plus_slider_type', function (setting) {
        var setupControlSlider = function (control) {
            var visibility = function () {
                if ('normal' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlRevolution = function (control) {
            var visibility = function () {
                if ('revolution' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBanner = function (control) {
            var visibility = function () {
                if ('banner' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlSliderBanner = function (control) {
            var visibility = function () {
                if ('normal' === setting.get() || 'banner' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_sliders', setupControlSlider);
        wp.customize.control('total_plus_slider_info', setupControlSlider);
        wp.customize.control('total_plus_slider_setting_heading', setupControlSlider);
        wp.customize.control('total_plus_slider_transition', setupControlSlider);
        wp.customize.control('total_plus_slider_height_type', setupControlSlider);
        wp.customize.control('total_plus_slider_height', setupControlSlider);
        wp.customize.control('total_plus_slider_autoplay', setupControlSlider);
        wp.customize.control('total_plus_slider_arrow', setupControlSlider);
        wp.customize.control('total_plus_slider_dots', setupControlSlider);
        wp.customize.control('total_plus_slider_pause', setupControlSlider);
        wp.customize.control('total_plus_slider_overlay_color', setupControlSlider);
        wp.customize.control('total_plus_slider_arrow_color_group', setupControlSlider);
        wp.customize.control('total_plus_caption_title_background_color', setupControlSlider);

        wp.customize.control('total_plus_banner_image', setupControlBanner);
        wp.customize.control('total_plus_banner_title', setupControlBanner);
        wp.customize.control('total_plus_banner_subtitle', setupControlBanner);
        wp.customize.control('total_plus_banner_button_text', setupControlBanner);
        wp.customize.control('total_plus_banner_button_link', setupControlBanner);
        wp.customize.control('total_plus_banner_text_alignment', setupControlBanner);
        wp.customize.control('total_plus_banner_parallax_effect', setupControlBanner);
        wp.customize.control('total_plus_banner_overlay_color', setupControlBanner);

        wp.customize.control('total_plus_slider_shortcode', setupControlRevolution);

        wp.customize.control('total_plus_slider_heading', setupControlSliderBanner);
        wp.customize.control('total_plus_caption_title_color', setupControlSliderBanner);
        wp.customize.control('total_plus_caption_subtitle_color', setupControlSliderBanner);
        wp.customize.control('total_plus_caption_button_color_group', setupControlSliderBanner);
    });

    wp.customize('common_header_typography', function (setting) {
        var setupControlCommonTypography = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlSeperateTypography = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.addClass('customizer-hidden');
                } else {
                    control.container.removeClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('h_typography', setupControlCommonTypography);
        wp.customize.control('header_typography_note', setupControlCommonTypography);
        wp.customize.control('header_typography_nav', setupControlSeperateTypography);
        wp.customize.control('h1_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h1_typography', setupControlSeperateTypography);
        wp.customize.control('h2_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h2_typography', setupControlSeperateTypography);
        wp.customize.control('h3_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h3_typography', setupControlSeperateTypography);
        wp.customize.control('h4_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h4_typography', setupControlSeperateTypography);
        wp.customize.control('h5_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h5_typography', setupControlSeperateTypography);
        wp.customize.control('h6_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h6_typography', setupControlSeperateTypography);
    });

    wp.customize('total_plus_featured_style', function (setting) {
        var setupControlBorder = function (control) {
            var visibility = function () {
                if ('style1' === setting.get() || 'style2' === setting.get() || 'style3' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style2' === setting.get() || 'style7' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlIconBackground = function (control) {
            var visibility = function () {
                if ('style7' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_featured_block_border_color', setupControlBorder);
        wp.customize.control('total_plus_featured_block_background_color', setupControlBackground);
        wp.customize.control('total_plus_featured_block_icon_bg_color', setupControlIconBackground);
    });

    wp.customize('total_plus_team_style', function (setting) {
        var setupControlOverlay = function (control) {
            var visibility = function () {
                if ('style1' === setting.get() || 'style3' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style2' === setting.get() || 'style3' === setting.get() || 'style4' === setting.get() || 'style5' === setting.get() || 'style6' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_team_block_overlay_color', setupControlOverlay);
        wp.customize.control('total_plus_team_block_background_color', setupControlBackground);
    });

    wp.customize('total_plus_team_slider_enable', function (setting) {
        var setupControlEnabled = function (control) {
            var visibility = function () {
                if ('on' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_team_block_arrow_color_group', setupControlEnabled);
    });

    wp.customize('total_plus_testimonial_style', function (setting) {
        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style3' === setting.get() || 'style4' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_testimonial_block_background_color', setupControlBackground);
    });

    wp.customize('total_plus_testimonial_style', function (setting) {
        var setupControlArrowColor = function (control) {
            var visibility = function () {
                if ('style1' === setting.get() || 'style2' === setting.get() || 'style4' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_testimonial_block_dot_color', setupControlArrowColor);
    });

    wp.customize('total_plus_counter_style', function (setting) {
        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style3' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlBorder = function (control) {
            var visibility = function () {
                if ('style1' === setting.get() || 'style2' === setting.get() || 'style3' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_counter_block_background_color', setupControlBackground);
        wp.customize.control('total_plus_counter_block_border_color', setupControlBorder);
    });

    wp.customize('total_plus_blog_style', function (setting) {
        var setupControlButton = function (control) {
            var visibility = function () {
                if ('style1' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlMetaBg = function (control) {
            var visibility = function () {
                if ('style3' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_blog_block_readmore_button_bg_color', setupControlButton);
        wp.customize.control('total_plus_blog_block_readmore_button_text_color', setupControlButton);
        wp.customize.control('total_plus_blog_block_meta_background_color', setupControlMetaBg);
    });

    wp.customize('total_plus_service_style', function (setting) {
        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style1' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_service_block_icon_bg_color', setupControlBackground);
    });

    wp.customize('total_plus_news_style', function (setting) {
        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style2' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_news_block_background_color', setupControlBackground);
    });

    wp.customize('total_plus_portfolio_tab_style', function (setting) {
        var setupControlBackground = function (control) {
            var visibility = function () {
                if ('style4' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_portfolio_block_tab_background_color', setupControlBackground);
    });

    wp.customize('total_plus_portfolio_tab_style', function (setting) {
        var setupControlTab = function (control) {
            var visibility = function () {
                if ('style1' === setting.get() || 'style2' === setting.get() || 'style3' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('total_plus_portfolio_block_active_tab_text_color', setupControlTab);
    });


    // FontAwesome Icon Control JS
    // $('body').on('click', '.total-plus-customizer-icon-box .total-plus-icon-list li', function () {
    //     var icon_class = $(this).find('i').attr('class');
    //     $(this).closest('.total-plus-icon-box').find('.total-plus-icon-list li').removeClass('icon-active');
    //     $(this).addClass('icon-active');
    //     $(this).closest('.total-plus-icon-box').prev('.total-plus-selected-icon').children('i').attr('class', '').addClass(icon_class);
    //     $(this).closest('.total-plus-icon-box').next('input').val(icon_class).trigger('change');
    //     $(this).closest('.total-plus-icon-box').slideUp();
    // });

    // $('body').on('click', '.total-plus-customizer-icon-box .total-plus-selected-icon', function () {
    //     $(this).next().slideToggle();
    // });

    // $('body').on('change', '.total-plus-customizer-icon-box .total-plus-icon-search select', function () {
    //     var selected = $(this).val();
    //     $(this).closest('.total-plus-icon-box').find('.total-plus-icon-search-input').val('');
    //     $(this).closest('.total-plus-icon-box').find('.total-plus-icon-list li').show();
    //     $(this).closest('.total-plus-icon-box').find('.total-plus-icon-list').hide().removeClass('active');
    //     $(this).closest('.total-plus-icon-box').find('.' + selected).fadeIn().addClass('active');
    // });

    // $('body').on('keyup', '.total-plus-customizer-icon-box .total-plus-icon-search input', function (e) {
    //     var $input = $(this);
    //     var keyword = $input.val().toLowerCase();
    //     search_criteria = $input.closest('.total-plus-icon-box').find('.total-plus-icon-list.active i');

    //     delay(function () {
    //         $(search_criteria).each(function () {
    //             if ($(this).attr('class').indexOf(keyword) > -1) {
    //                 $(this).parent().show();
    //             } else {
    //                 $(this).parent().hide();
    //             }
    //         });
    //     }, 500);
    // });

    // Icon Control JS
    $('body').on('click', '.total-plus-icon-box-wrap .total-plus-icon-list li', function () {
        var icon_class = $(this).find('i').attr('class');
        $(this).closest('.total-plus-icon-box').find('.total-plus-icon-list li').removeClass('icon-active');
        $(this).addClass('icon-active');
        $(this).closest('.total-plus-icon-box').prev('.total-plus-selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).closest('.total-plus-icon-box').slideUp()
        $(this).closest('.total-plus-icon-box').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.total-plus-icon-box-wrap .total-plus-selected-icon', function () {
        if (!$(this).next().is('.total-plus-icon-box')) {
            var iconbox = $('#total-plus-icon-box').clone();
            iconbox.removeAttr('id');
            iconbox.insertAfter($(this));
        }
        $(this).next().slideToggle();
    });

    $('body').on('change', '.total-plus-icon-box-wrap .total-plus-icon-search select', function () {
        var $ele = $(this);
        var selected = $ele.val();
        $ele.parent('.total-plus-icon-search').siblings('.total-plus-icon-list').hide().removeClass('active');
        $ele.parent('.total-plus-icon-search').siblings('.' + selected).show().addClass('active');
        $ele.closest('.total-plus-icon-box').find('.total-plus-icon-search-input').val('');
        $ele.parent('.total-plus-icon-search').siblings('.' + selected).find('li').show();
    });

    $('body').on('keyup', '.total-plus-icon-box-wrap .total-plus-icon-search input', function (e) {
        var $input = $(this);
        var keyword = $input.val().toLowerCase();
        var search_criteria = $input.closest('.total-plus-icon-box').find('.total-plus-icon-list.active i');
        delay(function () {
            $(search_criteria).each(function () {
                if ($(this).attr('class').indexOf(keyword) > -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }, 500);
    });

    // Switch Control
    $('body').on('click', '.onoffswitch', function () {
        var $this = $(this);
        if ($this.hasClass('switch-on')) {
            $(this).removeClass('switch-on');
            $this.next('input').val('off').trigger('change')
        } else {
            $(this).addClass('switch-on');
            $this.next('input').val('on').trigger('change')
        }
    });

    // Gallery Control
    $('.upload_gallery_button').click(function (event) {
        var current_gallery = $(this).closest('label');

        if (event.currentTarget.id === 'clear-gallery') {
            //remove value from input
            current_gallery.find('.gallery_values').val('').trigger('change');

            //remove preview images
            current_gallery.find('.gallery-screenshot').html('');
            return;
        }

        // Make sure the media gallery API exists
        if (typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
            return;
        }
        event.preventDefault();

        // Activate the media editor
        var val = current_gallery.find('.gallery_values').val();
        var final;

        if (!val) {
            final = '[gallery ids="0"]';
        } else {
            final = '[gallery ids="' + val + '"]';
        }
        var frame = wp.media.gallery.edit(final);

        frame.state('gallery-edit').on(
                'update',
                function (selection) {

                    //clear screenshot div so we can append new selected images
                    current_gallery.find('.gallery-screenshot').html('');

                    var element, preview_html = '',
                            preview_img;
                    var ids = selection.models.map(
                            function (e) {
                                element = e.toJSON();
                                preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
                                preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                                current_gallery.find('.gallery-screenshot').append(preview_html);
                                return e.id;
                            }
                    );

                    current_gallery.find('.gallery_values').val(ids.join(',')).trigger('change');
                }
        );
        return false;
    });

    // MultiCheck box Control JS
    $('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function () {

        var checkbox_values = $(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(
                function () {
                    return $(this).val();
                }
        ).get().join(',');

        $(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');

    });

    // Chosen JS
    $(".hs-chosen-select, .customize-control-typography select").chosen({
        width: "100%"
    });

    // Image Selector JS
    $('body').on('click', '.selector-labels label', function () {
        var $this = $(this);
        var value = $this.attr('data-val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.selector-labels').next('input').val(value).trigger('change');
    });

    $('body').on('change', '.total-plus-type-radio input[type="radio"]', function () {
        var $this = $(this);
        $this.parent('label').siblings('label').find('input[type="radio"]').prop('checked', false);
        var value = $this.closest('.radio-labels').find('input[type="radio"]:checked').val();
        $this.closest('.radio-labels').next('input').val(value).trigger('change');
    });

    // Range JS
    $('.customize-control-range').each(function () {
        var sliderValue = $(this).find('.slider-input').val();
        var newSlider = $(this).find('.total-plus-slider');
        var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
        var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
        var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

        newSlider.slider({
            value: sliderValue,
            min: sliderMinValue,
            max: sliderMaxValue,
            step: sliderStepValue,
            range: 'min',
            slide: function (e, ui) {
                $(this).parent().find('.slider-input').trigger('change');
            },
            change: function (e, ui) {
                $(this).parent().find('.slider-input').trigger('change');
            }
        });
    });

    // Change the value of the input field as the slider is moved
    $('.customize-control-range .total-plus-slider').on('slide', function (event, ui) {
        $(this).parent().find('.slider-input').val(ui.value);
    });

    // Reset slider and input field back to the default value
    $('.customize-control-range .slider-reset').on('click', function () {
        var resetValue = $(this).attr('slider-reset-value');
        $(this).parents('.customize-control-range').find('.slider-input').val(resetValue);
        $(this).parents('.customize-control-range').find('.total-plus-slider').slider('value', resetValue);
    });

    // Update slider if the input field loses focus as it's most likely changed
    $('.customize-control-range .slider-input').blur(function () {
        var resetValue = $(this).val();
        var slider = $(this).parents('.customize-control-range').find('.total-plus-slider');
        var sliderMinValue = parseInt(slider.attr('slider-min-value'));
        var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

        // Make sure our manual input value doesn't exceed the minimum & maxmium values
        if (resetValue < sliderMinValue) {
            resetValue = sliderMinValue;
            $(this).val(resetValue);
        }
        if (resetValue > sliderMaxValue) {
            resetValue = sliderMaxValue;
            $(this).val(resetValue);
        }
        $(this).parents('.customize-control-range').find('.total-plus-slider').slider('value', resetValue);
    });

    // TinyMCE editor
    $(document).on('tinymce-editor-init', function () {
        $('.customize-control').find('.wp-editor-area').each(function () {
            var tArea = $(this),
                    id = tArea.attr('id'),
                    input = $('input[data-customize-setting-link="' + id + '"]'),
                    editor = tinyMCE.get(id),
                    content;

            if (editor) {
                editor.onChange.add(function () {
                    this.save();
                    content = editor.getContent();
                    input.val(content).trigger('change');
                });
            }

            tArea.css({
                visibility: 'visible'
            }).on('keyup', function () {
                content = tArea.val();
                input.val(content).trigger('change');
            });

        });
    });

    // Select Image Js
    $('.select-image-control').on('change', function () {
        var activeImage = $(this).find(':selected').attr('data-image');
        $(this).next('.select-image-wrap').find('img').attr('src', activeImage);
    });

    // Date Picker Js
    $(".ht-datepicker-control").datepicker({
        dateFormat: "yy/mm/dd"
    });

    // Scroll to section
    $('body').on('click', '#sub-accordion-panel-total_plus_home_panel .control-subsection .accordion-section-title', function (event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection(section_id);
    });

    // Scroll to Footer
    $('body').on('click', '#accordion-section-total_plus_footer_section .accordion-section-title', function (event) {
        var preview_section_id = "ht-colophon";
        var $contents = jQuery('#customize-preview iframe').contents();

        if ($contents.find('#' + preview_section_id).length > 0) {
            $contents.find("html, body").animate({
                scrollTop: $contents.find("#" + preview_section_id).offset().top
            }, 1000);
        }
    });

    $('#customize-theme-controls').on('click', '.total-plus-repeater-field-title', function () {
        $(this).next().slideToggle();
        $(this).closest('.total-plus-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.total-plus-repeater-field-close', function () {
        $(this).closest('.total-plus-repeater-fields').slideUp();
        $(this).closest('.total-plus-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click", '.total-plus-add-control-field', function () {

        var $this = $(this).parent();
        if (typeof $this != 'undefined') {

            var field = $this.find(".total-plus-repeater-field-control:first").clone();
            if (typeof field != 'undefined') {

                field.find("input[type='text'][data-name]").each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("textarea[data-name]").each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("select[data-name]").each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find(".radio-labels input[type='radio']").each(function () {
                    var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
                    $(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);

                    if ($(this).val() == defaultValue) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });

                field.find(".selector-labels label").each(function () {
                    var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
                    var dataVal = $(this).attr('data-val');
                    $(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);

                    if (defaultValue == dataVal) {
                        $(this).addClass('selector-selected');
                    } else {
                        $(this).removeClass('selector-selected');
                    }
                });

                field.find('.range-input').each(function () {
                    var $dis = $(this);
                    $dis.removeClass('ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all').empty();
                    var defaultValue = parseFloat($dis.attr('data-defaultvalue'));
                    $dis.siblings(".range-input-selector").val(defaultValue);
                    $dis.slider({
                        range: "min",
                        value: parseFloat($dis.attr('data-defaultvalue')),
                        min: parseFloat($dis.attr('data-min')),
                        max: parseFloat($dis.attr('data-max')),
                        step: parseFloat($dis.attr('data-step')),
                        slide: function (event, ui) {
                            $dis.siblings(".range-input-selector").val(ui.value);
                            total_plus_refresh_repeater_values();
                        }
                    });
                });

                field.find('.onoffswitch').each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    if (defaultValue == 'on') {
                        $(this).addClass('switch-on');
                    } else {
                        $(this).removeClass('switch-on');
                    }
                });

                field.find('.total-plus-color-picker').each(function () {
                    $colorPicker = $(this);
                    $colorPicker.closest('.wp-picker-container').after($(this));
                    $colorPicker.prev('.wp-picker-container').remove();
                    $(this).wpColorPicker({
                        change: function (event, ui) {
                            setTimeout(function () {
                                total_plus_refresh_repeater_values();
                            }, 100);
                        }
                    });
                });

                field.find(".attachment-media-view").each(function () {
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if (defaultValue) {
                        $(this).find(".thumbnail-image").html('<img src="' + defaultValue + '"/>').prev('.placeholder').addClass('hidden');
                    } else {
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');
                    }
                });

                field.find(".total-plus-icon-list").each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.total-plus-selected-icon').children('i').attr('class', '').addClass(defaultValue);

                    $(this).find('li').each(function () {
                        var icon_class = $(this).find('i').attr('class');
                        if (defaultValue == icon_class) {
                            $(this).addClass('icon-active');
                        } else {
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find(".total-plus-multi-category-list").each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);

                    $(this).find('input[type="checkbox"]').each(function () {
                        if ($(this).val() == defaultValue) {
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                });

                //field.find('.total-plus-fields').show();

                $this.find('.total-plus-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.total-plus-repeater-fields').show();
                total_plus_refresh_repeater_values();
            }

        }
        return false;
    });

    $("#customize-theme-controls").on("click", ".total-plus-repeater-field-remove", function () {
        if (typeof $(this).parent() != 'undefined') {
            $(this).closest('.total-plus-repeater-field-control').slideUp('normal', function () {
                $(this).remove();
                total_plus_refresh_repeater_values();
            });
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]', function () {
        delay(function () {
            total_plus_refresh_repeater_values();
            return false;
        }, 500);
    });

    $("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]', function () {
        if ($(this).is(":checked")) {
            $(this).val('yes');
        } else {
            $(this).val('no');
        }
        return false;
    });

    // Drag and drop to change order
    $(".total-plus-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        handle: ".total-plus-repeater-field-title",
        update: function (event, ui) {
            total_plus_refresh_repeater_values();
        }
    });

    // Set all variables to be used in scope
    var frame;

    // ADD IMAGE LINK
    $('.customize-control-repeater').on('click', '.total-plus-upload-button', function (event) {
        event.preventDefault();

        var imgContainer = $(this).closest('.total-plus-fields-wrap').find('.thumbnail-image'),
                placeholder = $(this).closest('.total-plus-fields-wrap').find('.placeholder'),
                imgIdInput = $(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use Image'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            placeholder.addClass('hidden');

            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.url).trigger('change');

        });

        // Finally, open the modal on click
        frame.open();
    });

    // DELETE IMAGE LINK
    $('.customize-control-repeater').on('click', '.total-plus-delete-button', function (event) {

        event.preventDefault();
        var imgContainer = $(this).closest('.total-plus-fields-wrap').find('.thumbnail-image'),
                placeholder = $(this).closest('.total-plus-fields-wrap').find('.placeholder'),
                imgIdInput = $(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('').trigger('change');

    });

    var ColorChange = false;
    $('.total-plus-color-picker').wpColorPicker({
        change: function (event, ui) {
            if (jQuery('html').hasClass('colorpicker-ready') && ColorChange) {
                total_plus_refresh_repeater_values();
            }
        }
    });
    ColorChange = true;

    //MultiCheck box Control JS
    $('body').on('change', '.total-plus-type-multicategory input[type="checkbox"]', function () {
        var checkbox_values = $(this).parents('.total-plus-type-multicategory').find('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get().join(',');

        $(this).parents('.total-plus-type-multicategory').find('input[type="hidden"]').val(checkbox_values).trigger('change');
        total_plus_refresh_repeater_values();
    });

    $('.total-plus-repeater-fields .range-input').each(function () {
        var $dis = $(this);
        $dis.slider({
            range: "min",
            value: parseFloat($dis.attr('data-value')),
            min: parseFloat($dis.attr('data-min')),
            max: parseFloat($dis.attr('data-max')),
            step: parseFloat($dis.attr('data-step')),
            slide: function (event, ui) {
                $dis.siblings(".range-input-selector").val(ui.value);
                total_plus_refresh_repeater_values();
            }
        });
    });

    $('.color-tab-toggle').on('click', function () {
        $(this).closest('.customize-control').find('.color-tab-wrap').slideToggle();
    });

    $('.color-tab-switchers li').on('click', function () {
        if ($(this).hasClass('active')) {
            return false;
        }
        var clicked = $(this).attr('data-tab');
        $(this).parent('.color-tab-switchers').find('li').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.color-tab-wrap').find('.color-tab-contents > div').hide();
        $(this).closest('.color-tab-wrap').find('.' + clicked).fadeIn();
    });

    function scrollToSection(section_id) {
        var preview_section_id = "ht-home-slider-section";

        var $contents = $('#customize-preview iframe').contents();

        switch (section_id) {
            case 'accordion-section-total_plus_slider_section':
                preview_section_id = "ht-home-slider-section";
                break;

            case 'accordion-section-total_plus_about_section':
                preview_section_id = "ht-about-section";
                break;

            case 'accordion-section-total_plus_highlight_section':
                preview_section_id = "ht-highlight-section";
                break;

            case 'accordion-section-total_plus_featured_section':
                preview_section_id = "ht-featured-section";
                break;

            case 'accordion-section-total_plus_portfolio_section':
                preview_section_id = "ht-portfolio-section";
                break;

            case 'accordion-section-total_plus_service_section':
                preview_section_id = "ht-service-section";
                break;

            case 'accordion-section-total_plus_team_section':
                preview_section_id = "ht-team-section";
                break;

            case 'accordion-section-total_plus_pricing_section':
                preview_section_id = "ht-pricing-section";
                break;

            case 'accordion-section-total_plus_tab_section':
                preview_section_id = "ht-tab-section";
                break;

            case 'accordion-section-total_plus_news_section':
                preview_section_id = "ht-news-section";
                break;

            case 'accordion-section-total_plus_testimonial_section':
                preview_section_id = "ht-testimonial-section";
                break;

            case 'accordion-section-total_plus_counter_section':
                preview_section_id = "ht-counter-section";
                break;

            case 'accordion-section-total_plus_blog_section':
                preview_section_id = "ht-blog-section";
                break;

            case 'accordion-section-total_plus_logo_section':
                preview_section_id = "ht-logo-section";
                break;

            case 'accordion-section-total_plus_cta_section':
                preview_section_id = "ht-cta-section";
                break;

            case 'accordion-section-total_plus_contact_section':
                preview_section_id = "ht-contact-section";
                break;

            case 'accordion-section-total_plus_customa_section':
                preview_section_id = "ht-customa-section";
                break;

            case 'accordion-section-total_plus_customb_section':
                preview_section_id = "ht-customb-section";
                break;

        }

        if ($contents.find('#' + preview_section_id).length > 0) {
            $contents.find("html, body").animate({
                scrollTop: $contents.find("#" + preview_section_id).offset().top
            }, 1000);
        }

    }

    function total_plus_refresh_repeater_values() {
        $(".control-section.open .total-plus-repeater-field-control-wrap").each(function () {
            var values = [];
            var $this = $(this);

            $this.find(".total-plus-repeater-field-control").each(function () {
                var valueToPush = {};

                $(this).find('[data-name]').each(function () {
                    var dataName = $(this).attr('data-name');
                    var dataValue = $(this).val();
                    valueToPush[dataName] = dataValue;
                });

                values.push(valueToPush);
            });

            $this.next('.total-plus-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    // Homepage Section Sortable
    function total_plus_sections_order(container) {
        var sections = $(container).sortable('toArray');
        var s_ordered = [];
        $.each(sections, function (index, s_id) {
            s_id = s_id.replace("accordion-section-", "");
            s_ordered.push(s_id);
        });

        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                'action': 'total_plus_order_sections',
                'sections': s_ordered,
            }
        }).done(function (data) {
            $.each(s_ordered, function (key, value) {
                wp.customize.section(value).priority(key);
            });
            $(container).find('.total-plus-drag-spinner').hide();
            wp.customize.previewer.refresh();
        });
    }
});

(function (api) {

    // Class extends the UploadControl
    api.controlConstructor['background-image'] = api.UploadControl.extend({

        ready: function () {

            // Re-use ready function from parent class to set up the image uploader
            var image_url = this;
            image_url.setting = this.settings.image_url;
            api.UploadControl.prototype.ready.apply(image_url, arguments);

            // Set up the new controls
            var control = this;

            control.container.addClass('customize-control-image');

            control.container.on('click keydown', '.remove-button',
                    function () {
                        control.container.find('.background-image-fields').hide();
                    }
            );

            control.container.on('change', '.background-image-repeat select',
                    function () {
                        control.settings['repeat'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-size select',
                    function () {
                        control.settings['size'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-attach select',
                    function () {
                        control.settings['attach'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-position select',
                    function () {
                        control.settings['position'].set(jQuery(this).val());
                    }
            );

        },

        /**
         * Callback handler for when an attachment is selected in the media modal.
         * Gets the selected image information, and sets it within the control.
         */
        select: function () {
            var attachment = this.frame.state().get('selection').first().toJSON();
            this.params.attachment = attachment;
            this.settings['image_url'].set(attachment.url);
            this.settings['image_id'].set(attachment.id);
        },

    });

    // Tab Control
    api.TotalTabs = [];

    api.TotalTab = api.Control.extend({

        ready: function () {
            var control = this;
            control.container.find('a.customizer-tab').click(function (evt) {
                var tab = jQuery(this).data('tab');
                evt.preventDefault();
                control.container.find('a.customizer-tab').removeClass('active');
                jQuery(this).addClass('active');
                control.toggleActiveControls(tab);
            });

            api.TotalTabs.push(control.id);
        },

        toggleActiveControls: function (tab) {
            var control = this,
                    currentFields = control.params.buttons[tab].fields;
            _.each(control.params.fields, function (id) {
                var tabControl = api.control(id);
                if (undefined !== tabControl) {
                    if (tabControl.active() && jQuery.inArray(id, currentFields) >= 0) {
                        tabControl.toggle(true);
                    } else {
                        tabControl.toggle(false);
                    }
                }
            });
        }

    });

    jQuery.extend(api.controlConstructor, {
        'tab': api.TotalTab,
    });

    api.bind('ready', function () {
        _.each(api.TotalTabs, function (id) {
            var control = api.control(id);
            control.toggleActiveControls(0);
        });
    });

    // Alpha Color Picker Control
    api.controlConstructor['alpha-color'] = api.Control.extend({
        
        ready: function () {

            var control = this;

            var paletteInput = control.container.find('.alpha-color-control').data('palette');

            if (true == paletteInput) {
                palette = true;
            } else if ((typeof (paletteInput) !== 'undefined') && paletteInput.indexOf('|') !== -1) {
                palette = paletteInput.split('|');
            } else {
                palette = false;
            }

            control.container.find('.alpha-color-control').wpColorPicker({
                change: function (event, ui) {
                    var color = ui.color.to_s();
                        control.setting.set(color);
                },
                clear: function (event) {
                    var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
                    var color = '';

                    if (element) {
                        control.setting.set(color);
                    }
                },
                palettes: palette
            });
        }
    });

    // Color Tab Control
    api.controlConstructor['color-tab'] = api.Control.extend({

        ready: function () {

            var control = this;

            control.container.find('.alpha-color-control').each(function () {
                var $elem = jQuery(this);
                var paletteInput = $elem.data('palette');
                var setting = jQuery(this).attr('data-customize-setting-link');

                if (true == paletteInput) {
                    palette = true;
                } else if ((typeof (paletteInput) !== 'undefined') && paletteInput.indexOf('|') !== -1) {
                    palette = paletteInput.split('|');
                } else {
                    palette = false;
                }

                $elem.wpColorPicker({
                    change: function (event, ui) {
                        var color = ui.color.to_s();

                        if (jQuery('html').hasClass('colorpicker-ready')) {
                            wp.customize(setting, function (obj) {
                                obj.set(color);
                            });
                        }
                    },
                    clear: function (event) {
                        var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
                        var color = '';

                        if (element) {
                            wp.customize(setting, function (obj) {
                                obj.set(color);
                            });
                        }
                    },
                    palettes: palette
                });
            });
        }
    });

    // Dimenstion Control
    api.controlConstructor['dimensions'] = wp.customize.Control.extend({

        ready: function () {

            var control = this;

            control.container.on('change keyup paste', '.dimension-desktop_top', function () {
                control.settings['desktop_top'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-desktop_right', function () {
                control.settings['desktop_right'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-desktop_bottom', function () {
                control.settings['desktop_bottom'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-desktop_left', function () {
                control.settings['desktop_left'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_top', function () {
                control.settings['tablet_top'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_right', function () {
                control.settings['tablet_right'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_bottom', function () {
                control.settings['tablet_bottom'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-tablet_left', function () {
                control.settings['tablet_left'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_top', function () {
                control.settings['mobile_top'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_right', function () {
                control.settings['mobile_right'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_bottom', function () {
                control.settings['mobile_bottom'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.dimension-mobile_left', function () {
                control.settings['mobile_left'].set(jQuery(this).val());
            });
        }
    });

    // Range Slider Control
    api.controlConstructor['range-slider'] = wp.customize.Control.extend({
        ready: function () {
            var control = this,
                    desktop_slider = control.container.find('.total-plus-slider.desktop-slider'),
                    desktop_slider_input = desktop_slider.next('.total-plus-slider-input').find('input.desktop-input'),
                    tablet_slider = control.container.find('.total-plus-slider.tablet-slider'),
                    tablet_slider_input = tablet_slider.next('.total-plus-slider-input').find('input.tablet-input'),
                    mobile_slider = control.container.find('.total-plus-slider.mobile-slider'),
                    mobile_slider_input = mobile_slider.next('.total-plus-slider-input').find('input.mobile-input'),
                    slider_input,
                    $this,
                    val;

            // Desktop slider
            desktop_slider.slider({
                range: 'min',
                value: desktop_slider_input.val(),
                min: +desktop_slider_input.attr('min'),
                max: +desktop_slider_input.attr('max'),
                step: +desktop_slider_input.attr('step'),
                slide: function (event, ui) {
                    desktop_slider_input.val(ui.value).keyup();
                },
                change: function (event, ui) {
                    control.settings['desktop'].set(ui.value);
                }
            });

            // Tablet slider
            tablet_slider.slider({
                range: 'min',
                value: tablet_slider_input.val(),
                min: +tablet_slider_input.attr('min'),
                max: +tablet_slider_input.attr('max'),
                step: +desktop_slider_input.attr('step'),
                slide: function (event, ui) {
                    tablet_slider_input.val(ui.value).keyup();
                },
                change: function (event, ui) {
                    control.settings['tablet'].set(ui.value);
                }
            });

            // Mobile slider
            mobile_slider.slider({
                range: 'min',
                value: mobile_slider_input.val(),
                min: +mobile_slider_input.attr('min'),
                max: +mobile_slider_input.attr('max'),
                step: +desktop_slider_input.attr('step'),
                slide: function (event, ui) {
                    mobile_slider_input.val(ui.value).keyup();
                },
                change: function (event, ui) {
                    control.settings['mobile'].set(ui.value);
                }
            });

            // Update the slider when the number value change
            jQuery('input.desktop-input').on('change keyup paste', function () {
                $this = jQuery(this);
                val = $this.val();
                slider_input = $this.parent().prev('.total-plus-slider.desktop-slider');

                slider_input.slider('value', val);
            });

            jQuery('input.tablet-input').on('change keyup paste', function () {
                $this = jQuery(this);
                val = $this.val();
                slider_input = $this.parent().prev('.total-plus-slider.tablet-slider');

                slider_input.slider('value', val);
            });

            jQuery('input.mobile-input').on('change keyup paste', function () {
                $this = jQuery(this);
                val = $this.val();
                slider_input = $this.parent().prev('.total-plus-slider.mobile-slider');

                slider_input.slider('value', val);
            });

            // Save the values
            control.container.on('change keyup paste', '.desktop input', function () {
                control.settings['desktop'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.tablet input', function () {
                control.settings['tablet'].set(jQuery(this).val());
            });

            control.container.on('change keyup paste', '.mobile input', function () {
                control.settings['mobile'].set(jQuery(this).val());
            });

        }

    });

    // Sortable Control
    api.controlConstructor['sortable'] = wp.customize.Control.extend({

        ready: function () {

            var control = this;

            // Set the sortable container.
            control.sortableContainer = control.container.find('ul.sortable').first();

            // Init sortable.
            control.sortableContainer.sortable({

                // Update value when we stop sorting.
                stop: function () {
                    control.updateValue();
                }
            }).disableSelection().find('li').each(function () {

                // Enable/disable options when we click on the eye of Thundera.
                jQuery(this).find('i.visibility').click(function () {
                    jQuery(this).toggleClass('dashicons-visibility-faint').parents('li:eq(0)').toggleClass('invisible');
                });
            }).click(function () {

                // Update value on click.
                control.updateValue();
            });
        },

        /**
         * Updates the sorting list
         */
        updateValue: function () {

            var control = this,
                    newValue = [];

            this.sortableContainer.find('li').each(function () {
                if (!jQuery(this).is('.invisible')) {
                    newValue.push(jQuery(this).data('value'));
                }
            });

            control.setting.set(newValue);
        }
    });
})(wp.customize);


(function ($) {
    wp.customize.bind('ready', function () {
        wp.customize.section('total_plus_gdpr_section', function (section) {

            section.expanded.bind(function (isExpanding) {

                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                if (isExpanding) {
                    wp.customize.previewer.send('total-plus-gdpr-add-class', {
                        expanded: isExpanding
                    });
                } else {
                    wp.customize.previewer.send('total-plus-gdpr-remove-class', {
                        home_url: wp.customize.settings.url.home
                    });
                }
            });

        });
    });
})(jQuery);



jQuery(document).ready(function ($) {
    // Responsive switchers
    $('.customize-control .responsive-switchers button').on('click', function (event) {

        // Set up variables
        var $this = $(this),
                $devices = $('.responsive-switchers'),
                $device = $(event.currentTarget).data('device'),
                $control = $('.customize-control.has-switchers'),
                $body = $('.wp-full-overlay'),
                $footer_devices = $('.wp-full-overlay-footer .devices');

        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');

        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);

        // Wrapper class
        $body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + $device);

        // Panel footer buttons
        $footer_devices.find('button').removeClass('active').attr('aria-pressed', false);
        $footer_devices.find('button.preview-' + $device).addClass('active').attr('aria-pressed', true);

        // Open switchers
        if ($this.hasClass('preview-desktop')) {
            $control.toggleClass('responsive-switchers-open');
        }

    });

    // If panel footer buttons clicked
    $('.wp-full-overlay-footer .devices button').on('click', function (event) {

        // Set up variables
        var $this = $(this),
                $devices = $('.customize-control.has-switchers .responsive-switchers'),
                $device = $(event.currentTarget).data('device'),
                $control = $('.customize-control.has-switchers');

        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');

        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);

        // Open switchers
        if (!$this.hasClass('preview-desktop')) {
            $control.addClass('responsive-switchers-open');
        } else {
            $control.removeClass('responsive-switchers-open');
        }

    });

    // Linked button
    $('.total-plus-linked').on('click', function () {

        // Set up variables
        var $this = $(this);

        // Remove linked class
        $this.parent().parent('.dimension-wrap').prevAll().slice(0, 4).find('input').removeClass('linked').attr('data-element', '');

        // Remove class
        $this.parent('.link-dimensions').removeClass('unlinked');

    });

    // Unlinked button
    $('.total-plus-unlinked').on('click', function () {

        // Set up variables
        var $this = $(this),
                $element = $this.data('element');

        // Add linked class
        $this.parent().parent('.dimension-wrap').prevAll().slice(0, 4).find('input').addClass('linked').attr('data-element', $element);

        // Add class
        $this.parent('.link-dimensions').addClass('unlinked');

    });

    // Values linked inputs
    $('.dimension-wrap').on('input', '.linked', function () {

        var $data = $(this).attr('data-element'),
                $val = $(this).val();

        $('.linked[ data-element="' + $data + '" ]').each(function (key, value) {
            $(this).val($val).change();
        });

    });

});