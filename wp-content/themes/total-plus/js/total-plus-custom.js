/**
 * Total Plus Custom JS
 *
 * @package Total Plus
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */

jQuery(function ($) {
    /* Preloader Module */
    $(window).load(function () {
        $('#ht-preloader-wrap').fadeOut('slow');
    });

    /* Search Module */
    $('.menu-item-search a').click(function () {
        $('.ht-search-wrapper').addClass('ht-search-triggered');
        setTimeout(function () {
            $('.ht-search-wrapper .search-field').focus();
        }, 1000);
    });

    $('.ht-search-close').click(function () {
        $('.ht-search-wrapper').removeClass('ht-search-triggered');
    });

    /* Contact Detail Open/Close in Contact Section */
    $('body').on('click', '.ht-contact-detail-toggle.ht-open', function () {
        $(this).next('.ht-contact-content').addClass('ht-box-hidden');
        $(this).addClass('ht-closed').removeClass('ht-open');
    });

    $('body').on('click', '.ht-contact-detail-toggle.ht-closed', function () {
        $(this).next('.ht-contact-content').removeClass('ht-box-hidden');
        $(this).removeClass('ht-closed').addClass('ht-open');
    });

    /* Responsive Menu */
    $('body').on('click', '#ht-mobile-menu .menu-collapser', function () {
        $(this).next('ul').slideToggle();
    });

    $('#ht-responsive-menu .dropdown-nav').on('click', function () {
        $(this).parents('a').siblings('ul').slideToggle();
        $(this).toggleClass('ht-opened');
        return false;
    })

    /* Main Menu */
    $('.ht-menu > ul').superfish({
        delay: 500,
        animation: {
            opacity: 'show'
        },
        speed: 'fast'
    });

    var $dropdowns = $('.ht-menu > ul > .menu-item.menu-item-has-children:not(.menu-item-megamenu) > .sub-menu');
    if ($dropdowns.length > 0) {
        var $container = $($dropdowns[0]).closest('.ht-container');
        if ($container.length > 0) {
            var container_right_max = $container.offset().left + $container.outerWidth();
            var window_width = $(window).width();
            $dropdowns.each(function () {
                var $dropdown = $(this);
                var $li = $(this).parent();
                if (total_plus_megamenu.rtl == 'true') {
                    if (((window_width - $li.offset().left) + $dropdown.outerWidth()) > container_right_max) {
                        $dropdown.css({
                            'right': 'auto',
                            'left': 0
                        });
                    }

                    if (((window_width - $li.offset().left) + $dropdown.outerWidth() * 2) > container_right_max) {
                        $dropdown.find('.sub-menu').css({
                            'right': 'auto',
                            'left': '100%'
                        });
                    }
                } else {
                    if ($li.offset().left + $dropdown.outerWidth() > container_right_max) {
                        $dropdown.css({
                            'left': 'auto',
                            'right': 0
                        });
                    }

                    if (($li.offset().left + $dropdown.outerWidth() * 2) > container_right_max) {
                        $dropdown.find('.sub-menu').css({
                            'left': 'auto',
                            'right': '100%'
                        });
                    }
                }
            });
        }
    }

    /* Sticky Header */
    var hHeight = 0;
    var adminbarHeight = 0;
    if ($('body').hasClass('admin-bar')) {
        adminbarHeight = 32;
    }
    var $stickyHeader = $('.ht-header');
    if ($('.ht-sticky-header').length > 0 && $stickyHeader.length > 0) {
        hHeight = $stickyHeader.outerHeight();
        $pageWrapper = $('#ht-content');
        var hOffset = $stickyHeader.offset().top;

        var offset = hOffset + hHeight - adminbarHeight;

        $stickyHeader.headroom({
            offset: offset,
            onTop: function () {
                if (($('body').hasClass('ht-header-above') || ($('body').hasClass('ht-header-over') && $('body').hasClass('ht-hide-titlebar'))) && !$('body').hasClass('ht-header-style4')) {
                    $pageWrapper.css({
                        paddingTop: 0
                    });
                }
            },
            onNotTop: function () {
                if (($('body').hasClass('ht-header-above') || ($('body').hasClass('ht-header-over') && $('body').hasClass('ht-hide-titlebar'))) && !$('body').hasClass('ht-header-style4')) {
                    $pageWrapper.css({
                        paddingTop: hHeight + 'px'
                    });
                }
            }
        });
    }

    /* One Page Nav */
    $('.ht-menu, #ht-content').onePageNav({
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.1,
        scrollOffset: hHeight + adminbarHeight
    });

    $('#ht-responsive-menu').onePageNav({
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.1
    });

    // *only* if we have anchor on the url
    if (window.location.hash) {
        $(window).load(function () {
            var sectionid = window.location.hash;
            sectionid = sectionid.replace('/', '');
            if ($(sectionid).length > 0) {
                $('html, body').animate({
                    scrollTop: $(sectionid).offset().top - hHeight
                }, 1000);
            }
        });
    }

    /* Back To Top Menu */
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('#ht-back-top').removeClass('ht-hide');
        } else {
            $('#ht-back-top').addClass('ht-hide');
        }
    });

    $('#ht-back-top').click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    /* Accordian Box Widget */
    $('.ht-accordion-box').accordion({
        "transitionSpeed": 400
    });

    /* Counter Widget */
    $('.ht-counter-widget').waypoint(function () {
        $('.ht-counter').each(function (index) {
            var counter_time = parseInt(index * 500 + 300);
            var $odometer = $(this).find('.odometer');
            setTimeout(function () {
                $odometer.html($odometer.data('count'));
            }, counter_time);
        });
        this.destroy();
    }, {
        offset: '90%'
    });

    /* Portfolio Carousel Widget */
    $('.ht-portfolio-carousel').each(function (index) {
        $this = $(this);
        var params = $this.find('.ht-portfolio-carousel-slides').data('params');
        var owl = 'owl' + index;
        owl = $(this).find('.ht-portfolio-carousel-slides').owlCarousel({
            rtl: JSON.parse(total_plus_options.rtl),
            items: params.items,
            loop: false,
            mouseDrag: true,
            nav: false,
            dots: JSON.parse(params.dots),
            autoplayTimeout: params.pause,
            autoplay: JSON.parse(params.autoplay),
            navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
            margin: params.margin
        });

        $(this).find('.owl-next').click(function () {
            owl.trigger('next.owl.carousel');
        })

        $(this).find('.owl-prev').click(function () {
            owl.trigger('prev.owl.carousel');
        })

        if (params.show_tab == '1') {
            var active_tab = $this.find('.ht-portfolio-filter-wrap').data('active');
            if ($this.find('.ht-portfolio-filter-btn[data-filter="' + active_tab + '"]').length == 0) {
                var active_tab = $this.find('.ht-portfolio-filter-btn:first').data('filter');
            }
            $this.find("[data-filter='" + active_tab + "']").addClass('btn-active');
            owl.owlFilter(active_tab);

            $this.on('click', '.ht-portfolio-filter-btn', function (e) {
                var filter_data = $(this).data('filter');
                /* return if current */
                if ($(this).hasClass('btn-active'))
                    return;
                /* active current */
                $(this).addClass('btn-active').siblings().removeClass('btn-active');
                /* Filter */
                owl.owlFilter(filter_data, function (_owl) {
                    $(_owl).find('.ht-portfolio-carousel-item').each(function (index) {
                        $(this).addClass('htpc-loading').delay(50 * index).queue(function () {
                            $(this).dequeue().removeClass('htpc-loading')
                        })
                    });
                    gallery.data('lightGallery').destroy(true);
                    gallery.lightGallery({
                        selector: '.ht-portfolio-carousel-image',
                        thumbnail: false
                    });
                });
            });
        }

        var gallery = 'gallery' + index;
        var gallery = $this.find('.ht-portfolio-carousel-slides');
        gallery.lightGallery({
            selector: '.ht-portfolio-carousel-image',
            thumbnail: false
        });
    });

    $('.ht-portfolio-posts').lightGallery({
        selector: '.ht-portfolio-image',
        thumbnail: false
    });

    /* Call To Action Video Popup */
    $('#cta-video').lightGallery({
        autoplayFirstVideo: false,
        counter: false
    });

    /* Service Section Toggle */
    $('body').on('click', '.ht-service-section.style1 .ht-service-excerpt h5', function () {
        $(this).parents('.ht-service-post').siblings().find('.ht-service-text').slideUp();
        $(this).parents('.ht-service-post').siblings().removeClass('ht-active');
        $(this).next('.ht-service-text').slideToggle();
        $(this).parents('.ht-service-post').toggleClass('ht-active');
    });

    $('body').on('click', '.ht-service-section.style1 .ht-service-icon', function () {
        $(this).parents('.ht-service-post').siblings().find('.ht-service-text').slideUp();
        $(this).parents('.ht-service-post').siblings().removeClass('ht-active');
        $(this).next('.ht-service-excerpt').find('.ht-service-text').slideToggle();
        $(this).parent('.ht-service-post').toggleClass('ht-active');
    });

    /* Portfolio Switch */
    $('body').on('click', '.ht-portfolio-switch', function () {
        $(this).next('.ht-portfolio-cat-wrap').toggleClass('ht-open');
    });

    /* Maintenance Section */
    if ($('.ht-maintenance-video[data-property]').length > 0) {
        $(".ht-maintenance-video[data-property]").YTPlayer({
            showControls: false,
            containment: 'self',
            mute: true,
            addRaster: false,
            useOnMobile: false,
            playOnlyIfVisible: true,
            anchor: 'center,center',
            showYTLogo: false,
            loop: true,
            optimizeDisplay: true,
            quality: 'hd720'
        });
    }

    if ($('.ht-maintenance-slider .ht-maintenance-slide').length > 0) {
        $('.ht-maintenance-slider').owlCarousel({
            rtl: JSON.parse(total_plus_options.rtl),
            items: 1,
            loop: true,
            mouseDrag: false,
            nav: false,
            dots: false,
            autoplayTimeout: parseInt($('.ht-maintenance-slider').attr('data-timeout')),
            autoplay: true,
            smartSpeed: 600,
            animateOut: 'fadeOut'
        });
    }

    /* WooCommerce Cart Menu */
    $('.menu-item-ht-cart .woocommerce-mini-cart').mCustomScrollbar({
        axis: "y",
        scrollbarPosition: "outside"
    });

    /* WooCommerce YITH Module */
    $(document).on('click', '.product .total-plus-product-actions a.compare:not(.added)', function (e) {
        var $button = $(this);
        setTimeout(function () {
            $button.html('<i class="icofont-random"></i><span class="woo-button-tooltip">Added</span>');
        }, 3000);
    });

    /* Titlebar Padding */
    var headerHeight = $('#ht-masthead').outerHeight();
    if ($('#ht-masthead').hasClass('ht-header-one')) {
        $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(total_plus_options.title_padding));
    } else if ($('#ht-masthead').hasClass('ht-header-two')) {
        $('.ht-main-header').css('padding-top', headerHeight + parseInt(total_plus_options.title_padding) + 40);
    } else if ($('#ht-masthead').hasClass('ht-header-three')) {
        $('.ht-main-header').css('padding-top', headerHeight + parseInt(total_plus_options.title_padding));
    } else if ($('#ht-masthead').hasClass('ht-header-four')) {
        var headerWrapHeight = $('.ht-header-wrap').outerHeight() / 2;
        $('.ht-header-over .ht-main-header').css('padding-top', headerHeight + parseInt(total_plus_options.title_padding) + headerWrapHeight);
        $('.ht-header-above .ht-main-header').css('padding-top', parseInt(total_plus_options.title_padding) + headerWrapHeight);
    } else if ($('#ht-masthead').hasClass('ht-header-five')) {
        $('.ht-main-header').css('padding-top', headerHeight + parseInt(total_plus_options.title_padding));
    }

    selectiveRefreshJquery();

    var hasSelectiveRefresh = (
            'undefined' !== typeof wp &&
            wp.customize &&
            wp.customize.selectiveRefresh &&
            wp.customize.widgetsPreview &&
            wp.customize.widgetsPreview.WidgetPartial
            );
    if (hasSelectiveRefresh) {
        wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
            selectiveRefreshJquery(placement);
        });
    }

    function selectiveRefreshJquery(placement) {
        if (typeof (placement) == 'undefined') {
            var partial = 'total_plus_all';
            var $container = $('.ht-section');
        } else {
            var partial = placement.partial.id;
            var $container = placement.container;
        }

        var section_class, section_partial;

        if (partial.indexOf('total_plus_') !== -1) {
            var partialArr = partial.split('_');
            if (partialArr[2]) {
                section_partial = 'total_plus_' + partialArr[2];
                if (partialArr[2] == 'all') {
                    section_class = '.ht-section';
                } else {
                    section_class = '.ht-' + partialArr[2] + '-section';
                }
            }
        }

        $(window).on("scroll", function () {
            $("[data-pllx-bg-ratio]").each(function () {
                const $section = $(this);
                const scrollPosition = $(window).scrollTop();
                const offset = $section.offset().top; // Section's distance from top of the document
                const speed = $(this).attr('data-pllx-bg-ratio'); // Adjust this value for parallax speed
                var additionalOffset = 0;

                if ($(this).attr('data-pllx-vertical-offset')) {
                    additionalOffset = parseInt($(this).attr('data-pllx-vertical-offset'));
                }

                // Update the background position if the section is in view
                if (
                    scrollPosition + $(window).height() > offset &&
                    scrollPosition < offset + $section.outerHeight()
                ) {
                    const backgroundPosition = additionalOffset + ((scrollPosition - offset) * speed * -1);
                    $section.css("background-position", `center ${backgroundPosition}px`);
                }
            });
        });

        if (['total_plus_all', 'total_plus_banner_parallax_effect', 'total_plus_slider_bottom_seperator'].includes(partial)) {
            if ($('.ht-main-banner[data-motion]').length > 0) {
                $('body').imagesLoaded(function () {
                    $('.ht-main-banner[data-motion]').each(function () {
                        var windowSpy = new $.Espy(window);
                        var element = $(this)[0];
                        var headerClouds = new Motio(element, {
                            fps: 30,
                            speedX: 60
                        });
                        // Play only when in the viewport
                        windowSpy.add(element, function (entered) {
                            headerClouds[entered ? 'play' : 'pause']();
                        });
                    });
                });
            }

            $(window).resize(function () {
                var windowHeight = $(window).height();
                var headerHeight = $('#ht-masthead').outerHeight();
                if ($('body').hasClass('ht-header-over')) {
                    $('.ht-main-banner .ht-container').css('padding-top', headerHeight);
                }

                if (!$('body').hasClass('ht-header-above')) {
                    var headerHeight = 0;
                }

                $('.ht-main-banner .ht-container').css('min-height', windowHeight - headerHeight);
            }).resize();
        }

        if ($container.hasClass('ht-section')) {
            if ($(section_class + '[data-motion]').length > 0) {
                $('body').imagesLoaded(function () {
                    $(section_class + '[data-motion]').each(function () {
                        var windowSpy = new $.Espy(window);
                        var element = $(this)[0];
                        var headerClouds = new Motio(element, {
                            fps: 30,
                            speedX: 60
                        });
                        // Play only when in the viewport
                        windowSpy.add(element, function (entered) {
                            headerClouds[entered ? 'play' : 'pause']();
                        });
                    });
                });
            }

            if ($(section_class + '[data-property]').length > 0) {
                $(section_class + '[data-property]').YTPlayer({
                    showControls: false,
                    containment: 'self',
                    mute: true,
                    addRaster: false,
                    useOnMobile: false,
                    playOnlyIfVisible: true,
                    anchor: 'center,center',
                    showYTLogo: false,
                    loop: true,
                    optimizeDisplay: true,
                    quality: 'hd720'
                });
            }
        }

        if (($('.ht-progress-bar').length > 0) && (['total_plus_all', 'total_plus_progressbar', 'total_plus_disable_about_sidebar'].includes(partial) || ['total_plus_all', 'total_plus_about'].includes(section_partial))) {
            $('.ht-progress-bar').each(function (index) {
                var $this = $(this);
                var delay_time = parseInt(index * 100 + 300);
                $this.waypoint(function () {
                    setTimeout(function () {
                        $this.find('.ht-progress-bar-length').animate({
                            width: $this.attr("data-width") + '%'
                        }, 1000, function () {
                            $this.find("span").animate({
                                opacity: 1
                            }, 500);
                        });
                    }, delay_time);
                    this.destroy();
                }, {
                    offset: '90%',
                });
            });
        }

        if (($('.ht-service-section.style1').length > 0) && ['total_plus_all', 'total_plus_service'].includes(section_partial)) {
            $('.ht-service-section.style1 .ht-service-text:first').show();
            $('.ht-service-section.style1 .ht-service-post:first').addClass('ht-active');
        }

        if ($('#ht-slider .ht-slide').length > 0 && ['total_plus_all', 'total_plus_sliders', 'total_plus_slider'].includes(section_partial)) {
            var sliderObj = {
                rtl: JSON.parse(total_plus_options.rtl),
                items: 1,
                loop: true,
                mouseDrag: false,
                nav: JSON.parse($('#ht-slider').attr('data-nav')),
                dots: JSON.parse($('#ht-slider').attr('data-dots')),
                autoplayTimeout: parseInt($('#ht-slider').attr('data-timeout')),
                autoplay: JSON.parse($('#ht-slider').attr('data-autoplay')),
                smartSpeed: 600
            };

            if ($('#ht-slider').attr('data-transition') == 'fade') {
                sliderObj.animateOut = 'fadeOut';
            }
            var slider = $('#ht-slider').owlCarousel(sliderObj);
        }

        if ($('.ht-tab-wrap').length > 0 && ['total_plus_all', 'total_plus_tabs', 'total_plus_tab'].includes(section_partial)) {
            $('.ht-tab-wrap').each(function () {
                $this = $(this);
                $this.find('.ht-content:first').show();
                $this.find('.ht-tab:first').addClass('ht-active');
                $this.find('.ht-tab').on('click', function () {
                    $(this).siblings('.ht-tab').removeClass('ht-active');
                    $(this).addClass('ht-active');
                    var id = $(this).attr('id');
                    id = id.split('-');
                    $(this).closest('.ht-tab-wrap').find('.ht-content').hide();
                    $(this).closest('.ht-tab-wrap').find('#ht-content-' + id[2]).fadeIn();
                });
            });
        }

        if ($('.ht-testimonial-slider').length > 0 && ['total_plus_all', 'total_plus_testimonial'].includes(section_partial)) {
            $('.ht-testimonial-slider').owlCarousel({
                rtl: JSON.parse(total_plus_options.rtl),
                items: 1,
                loop: true,
                mouseDrag: false,
                nav: false,
                dots: true,
                autoplayTimeout: 8000,
                autoplay: true,
                smartSpeed: 600
            });
        }

        if ($('.ht-testimonial-carousel').length > 0 && ['total_plus_all', 'total_plus_testimonial'].includes(section_partial)) {
            $('.ht-testimonial-carousel').owlCarousel({
                rtl: JSON.parse(total_plus_options.rtl),
                items: parseInt($('.ht-testimonial-carousel').attr('data-col')),
                loop: true,
                mouseDrag: true,
                nav: true,
                dots: false,
                autoplayTimeout: 8000,
                autoplay: true,
                smartSpeed: 600,
                center: true,
                navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        center: false
                    },
                    520: {
                        items: parseInt($('.ht-testimonial-carousel').attr('data-col') - 1),
                        center: false
                    },
                    768: {
                        items: parseInt($('.ht-testimonial-carousel').attr('data-col')),
                    }
                }
            });
        }

        if ($('.ht-testimonial-slides').length > 0 && ['total_plus_all', 'total_plus_testimonial'].includes(section_partial)) {
            $(".ht-testimonial-slides").each(function () {
                var $this = $(this);
                var dataCol = $this.attr('data-col');
                $this.owlCarousel({
                    rtl: JSON.parse(total_plus_options.rtl),
                    autoPlay: 4000,
                    items: parseInt(dataCol),
                    margin: 15,
                    loop: true,
                    dots: false,
                    nav: true,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        520: {
                            items: parseInt(dataCol - 1),
                        },
                        768: {
                            items: parseInt(dataCol),
                        }
                    }
                });
            });
        }

        if ($('.ht-testimonial-wrap.style2').length > 0 && ['total_plus_all', 'total_plus_testimonial'].includes(section_partial)) {
            $('.ht-testimonial-wrap.style2').each(function () {
                var $imageWrap = $(this).find('.ht-testimonial-image-wrap');
                var $contentWrap = $(this).find('.ht-testimonial-content-wrap');
                $contentWrap.not('.slick-initialized').slick({
                    rtl: JSON.parse(total_plus_options.rtl),
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true,
                    fade: false,
                    asNavFor: $imageWrap
                });
                $imageWrap.not('.slick-initialized').slick({
                    rtl: JSON.parse(total_plus_options.rtl),
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: $contentWrap,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                    focusOnSelect: true,
                    centerPadding: 0,
                    autoplay: true,
                    autoplaySpeed: 8000,
                });
            });
        }

        if (($('.ht-team-carousel').length > 0) && ['total_plus_all', 'total_plus_team'].includes(section_partial)) {
            $(".ht-team-carousel").each(function () {
                var $this = $(this);
                var dataCol = $this.attr('data-col');
                $this.owlCarousel({
                    rtl: JSON.parse(total_plus_options.rtl),
                    autoPlay: 4000,
                    items: parseInt(dataCol),
                    margin: 15,
                    loop: true,
                    dots: false,
                    nav: true,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        520: {
                            items: parseInt(dataCol - 1),
                        },
                        768: {
                            items: parseInt(dataCol),
                        }
                    }
                });
            });
        }

        if (($('.ht-logo-section .style1 .ht-logo-carousel').length > 0) && ['total_plus_all', 'total_plus_logo'].includes(section_partial)) {
            $(".ht-logo-section .style1 .ht-logo-carousel").owlCarousel({
                rtl: JSON.parse(total_plus_options.rtl),
                items: 5,
                loop: true,
                nav: false,
                dots: true,
                autoplayTimeout: 8000,
                autoplay: true,
                margin: 50,
                responsive: {
                    0: {
                        items: 2,
                        center: false
                    },
                    520: {
                        items: 3,
                        center: false
                    },
                    768: {
                        items: 4,
                    },
                    1000: {
                        items: 5,
                    }
                }
            });
        }

        if (($('.ht-logo-section .style2 .ht-logo-carousel').length > 0) && ['total_plus_all', 'total_plus_logo'].includes(section_partial)) {
            $(".ht-logo-section .style2 .ht-logo-carousel").flipster({
                style: 'carousel',
                enableMousewheel: false,
                enableNavButtons: true,
                prevText: '<i class="mdi mdi-chevron-left"></i>',
                nextText: '<i class="mdi mdi-chevron-right"></i>'
            });
        }

        if (($('.ht-counter-wrap').length > 0) && ['total_plus_all', 'total_plus_counter'].includes(section_partial)) {
            $('.ht-counter-wrap').waypoint(function () {
                $('.ht-counter').each(function (index) {
                    var counter_time = parseInt(index * 500 + 300);
                    var $odometer = $(this).find('.odometer');
                    setTimeout(function () {
                        $odometer.html($odometer.data('count'));
                    }, counter_time);
                });
                this.destroy();
            }, {
                offset: '90%'
            });
        }

        if ($('.ht-portfolio-masonary-wrap').length > 0 && ['total_plus_all', 'total_plus_portfolio'].includes(section_partial)) {
            $('.ht-portfolio-masonary-wrap').each(function () {
                var $this = $(this);
                var active_tab = $this.find('.ht-portfolio-cat-wrap').data('active');
                if ($this.find('.ht-portfolio-cat-name[data-filter="' + active_tab + '"]').length == 0) {
                    var active_tab = $this.find('.ht-portfolio-cat-name:first').data('filter');
                }

                $this.find('.ht-portfolio-cat-name[data-filter="' + active_tab + '"]').addClass('active');
                var $container = $this.find('.ht-portfolio-posts').imagesLoaded(function () {

                    $container.isotope({
                        itemSelector: '.ht-portfolio',
                        filter: active_tab
                    });

                    SetMasonaryClass($this, $container);

                    $(window).on('resize', function () {
                        GetMasonary($this, $container);
                    }).resize();

                    $container.isotope({
                        itemSelector: '.ht-portfolio',
                        filter: active_tab,
                    });
                });

                $this.find('.ht-portfolio-cat-name-list').on('click', '.ht-portfolio-cat-name', function () {
                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({
                        filter: filterValue
                    });

                    SetMasonaryClass($this, $container);

                    GetMasonary($this, $container);
                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({
                        itemSelector: '.ht-portfolio',
                        filter: filterValue
                    });
                    $(this).siblings('.ht-portfolio-cat-name').removeClass('active');
                    $(this).addClass('active');
                });
            });
        }
    }

    function GetMasonary($element, $container) {
        var winWidth = window.innerWidth;
        var containerWidth = $element.find('.ht-portfolio-posts').width();

        var two_col_image = containerWidth / 2;
        var three_col_image = containerWidth / 3;
        var four_col_image = containerWidth / 4;

        var three_col_image_double = (three_col_image * 2);
        var two_col_image_double = (two_col_image * 2);

        if (winWidth > 768) {

            if ($element.find('.ht-portfolio-post-wrap').hasClass('style1')) {
                $container.find('.ht-portfolio').each(function () {
                    $(this).css({
                        height: three_col_image + 'px',
                        width: three_col_image + 'px'
                    });
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style2')) {
                $container.find('.ht-portfolio').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            height: three_col_image_double + 'px',
                            width: three_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            height: three_col_image + 'px',
                            width: three_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style3')) {
                $container.find('.ht-portfolio').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            width: three_col_image_double + 'px',
                            height: three_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            width: three_col_image + 'px',
                            height: three_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style4')) {
                $container.find('.ht-portfolio').each(function () {
                    $(this).css({
                        height: four_col_image + 'px',
                        width: four_col_image + 'px'
                    });
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style5')) {
                $container.find('.ht-portfolio').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            width: four_col_image * 2 + 'px',
                            height: four_col_image * 2 + 'px'
                        });
                    } else {
                        $(this).css({
                            width: four_col_image + 'px',
                            height: four_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style6')) {
                $container.find('.ht-portfolio').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            width: four_col_image * 2 + 'px',
                            height: four_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            width: four_col_image + 'px',
                            height: four_col_image + 'px'
                        });
                    }
                })
            }

        } else if (winWidth > 480) {
            if ($element.find('.ht-portfolio-post-wrap').hasClass('style1')) {
                $container.find('.ht-portfolio').each(function () {
                    $(this).css({
                        height: two_col_image + 'px',
                        width: two_col_image + 'px'
                    });
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style2')) {
                $container.find('.ht-portfolio').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            height: two_col_image_double + 'px',
                            width: two_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            height: two_col_image + 'px',
                            width: two_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style3')) {
                $container.find('.ht-portfolio').each(function () {
                    $(this).css({
                        width: two_col_image + 'px',
                        height: two_col_image + 'px'
                    });
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style4')) {
                $container.find('.ht-portfolio').each(function () {
                    $(this).css({
                        height: two_col_image + 'px',
                        width: two_col_image + 'px'
                    });
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style5')) {
                $container.find('.ht-portfolio').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            width: two_col_image * 2 + 'px',
                            height: two_col_image * 2 + 'px'
                        });
                    } else {
                        $(this).css({
                            width: two_col_image + 'px',
                            height: two_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style6')) {
                $container.find('.ht-portfolio').each(function () {
                    $(this).css({
                        width: two_col_image + 'px',
                        height: two_col_image + 'px'
                    });
                })
            }
        } else {
            $container.find('.ht-portfolio').each(function () {
                $(this).css({
                    width: containerWidth + 'px',
                    height: containerWidth + 'px'
                });
            })
        }
    }

    function SetMasonaryClass($element, $container) {
        var elems = $container.isotope('getFilteredItemElements');
        var i = 0;
        if ($element.find('.ht-portfolio-post-wrap').hasClass('style2')) {
            elems.forEach(function (item, index) {
                i++;
                if (i == 1 || i == 5) {
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 7) {
                    i = 0;
                }
            })
        } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style3')) {
            elems.forEach(function (item, index) {
                i++;
                if (i == 2 || i == 6) {
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 10) {
                    i = 0;
                }
            })
        } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style5')) {
            elems.forEach(function (item, index) {
                i++;
                if (i == 3 || i == 6) {
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 10) {
                    i = 0;
                }
            })
        } else if ($element.find('.ht-portfolio-post-wrap').hasClass('style6')) {
            elems.forEach(function (item, index) {
                i++;
                if (i == 3 || i == 5 || i == 7) {
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 9) {
                    i = 0;
                }
            })
        }
    }

    /* GDPR Cookies */
    if (total_plus_options.customizer_gdpr_settings && typeof (Cookies) !== 'undefined') {
        var issetPrivacypolicy = Cookies.get('total_plus_cookies');

        if (typeof (issetPrivacypolicy) == 'undefined' && !JSON.parse(total_plus_options.customize_preview)) {
            $('.total-plus-privacy-policy').show();
        }

        $('#total-plus-confirm').on('click', function () {
            $('.total-plus-privacy-policy').fadeOut('fast');
            //var inFifteenMinutes = new Date(new Date().getTime() + 15 * 60 * 1000);
            Cookies.set('total_plus_cookies', 'yes', {
                expires: 1,
                path: '/'
            });
            return false;
        })
    }
});
