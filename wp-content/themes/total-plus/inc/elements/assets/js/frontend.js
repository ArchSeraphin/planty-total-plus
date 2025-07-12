(function ($, elementor) {
    "use strict";
    var TotalPlusElements = {

        init: function () {

            var widgets = {
                'total-plus-slider.default': TotalPlusElements.sliderController,
                'total-plus-progress-bar.default': TotalPlusElements.progressBarController,
                'total-plus-portfolio-masonry.default': TotalPlusElements.portfolioMasonaryController,
                'total-plus-portfolio-carousel.default': TotalPlusElements.portfolioCarouselController,
                'total-plus-service-block.default': TotalPlusElements.serviceController,
                'total-plus-team-carousel.default': TotalPlusElements.teamCarouselController,
                'total-plus-testimonial-carousel.default': TotalPlusElements.testimonialCarouselController,
                'total-plus-testimonial-slider.default': TotalPlusElements.testimonialSliderController,
                'total-plus-logo-carousel.default': TotalPlusElements.logoCarouselController,
                'total-plus-image-flipster.default': TotalPlusElements.imageFlipsterController,
                'total-plus-tab-block.default': TotalPlusElements.tabController,
                'total-plus-counter-block.default': TotalPlusElements.counterController,
                'total-plus-video-popup.default': TotalPlusElements.videoController,
                'total-plus-contact-block.default': TotalPlusElements.totalContactBlock,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

        },

        sliderController: function ($scope) {
            var $element = $scope.find('.tp-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                var sliderObj = {
                    rtl: JSON.parse(total_plus_options.rtl),
                    items: 1,
                    loop: true,
                    mouseDrag: false,
                    autoplay: JSON.parse(params.autoplay),
                    autoplayTimeout: params.pause,
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    navText: ['', ''],
                }

                if (params.transition == 'fade') {
                    sliderObj.animateOut = 'fadeOut';
                }

                $element.owlCarousel(sliderObj);
            }
        },

        progressBarController: function ($scope) {
            var $el = $scope.find('.tp-progress-bar-sec');
            if (($el.length > 0)) {
                var $newel = $el.find('.tp-progress-bar');
                $newel.each(function (index) {
                    var $this = $(this);
                    var delay_time = parseInt(index * 100 + 300);
                    $this.waypoint(function () {
                        setTimeout(function () {
                            $this.find('.tp-progress-bar-length').animate({
                                width: $this.attr("data-width") + '%'
                            }, 1000, function () {
                                $this.find('span').animate({
                                    opacity: 1
                                }, 500).attr('data-index', index);
                            });
                        }, delay_time);
                        this.destroy();
                    }, {
                        offset: '90%',
                    });
                });
            }
        },

        testimonialCarouselController: function ($scope) {
            var $element = $scope.find('.tp-testimonial-carousel');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    rtl: JSON.parse(total_plus_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    center: true,
                    stagePadding: 0,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                        },
                        769: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },

        testimonialSliderController: function ($scope) {
            var $element = $scope.find('.tp-testimonial-slider');
            if ($element.hasClass('tp-style1')) {
                if ($element.find('.tp-testimonial-slider').length > 0) {
                    var params = JSON.parse($element.find('.tp-testimonial-slider').attr('data-params'));
                    $element.find('.tp-testimonial-slider').owlCarousel({
                        rtl: JSON.parse(total_plus_ele_options.rtl),
                        loop: JSON.parse(params.loop),
                        autoplay: JSON.parse(params.autoplay),
                        autoplaySpeed: params.speed,
                        autoplayTimeout: params.pause,
                        autoplayHoverPause: JSON.parse(params.pause_on_hover),
                        nav: false,
                        dots: JSON.parse(params.dots),
                        items: 1
                    });
                }
            } else if ($element.hasClass('tp-style2')) {
                var $imageWrap = $element.find('.tp-testimonial-image-wrap');
                var $contentWrap = $element.find('.tp-testimonial-content-wrap');

                if ($contentWrap.length > 0) {
                    var params = JSON.parse($contentWrap.attr('data-params'));
                    var image_sides = $imageWrap.attr('data-count');

                    if (image_sides > 3) {
                        image_sides = 3;
                    } else {
                        image_sides = 1;
                    }

                    $contentWrap.not('.slick-initialized').slick({
                        rtl: JSON.parse(total_plus_ele_options.rtl),
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: JSON.parse(params.dots),
                        fade: false,
                        asNavFor: $imageWrap,
                        speed: params.speed
                    });
                    $imageWrap.not('.slick-initialized').slick({
                        rtl: JSON.parse(total_plus_options.rtl),
                        slidesToShow: image_sides,
                        slidesToScroll: 1,
                        asNavFor: $contentWrap,
                        dots: false,
                        arrows: false,
                        centerMode: true,
                        focusOnSelect: true,
                        centerPadding: 0,
                        autoplay: JSON.parse(params.autoplay),
                        autoplaySpeed: params.pause,
                        infinite: JSON.parse(params.loop),
                        pauseOnHover: JSON.parse(params.pause_on_hover),
                        speed: params.speed
                    });
                }

            }
        },

        portfolioMasonaryController: function ($scope) {
            var $element = $scope.find('.tp-portfolio-masonary-wrap');
            var $id = $scope.data('id');

            var active_tab = $element.find('.tp-portfolio-cat-wrap').data('active');
            if ($element.find('.tp-portfolio-cat-name[data-filter="' + active_tab + '"]').length == 0) {
                var active_tab = $element.find('.tp-portfolio-cat-name:first').data('filter');
            }

            $element.find('.tp-portfolio-cat-name[data-filter="' + active_tab + '"]').addClass('active');

            var $container = $('.tp-portfolio-posts-' + $id).imagesLoaded(function () {

                $container.isotope({
                    itemSelector: '.tp-portfolio',
                    filter: active_tab
                });

                TpSetMasonryClass($element, $container);

                $(window).on('resize', function () {
                    TpGetMasonry($element, $container);
                }).resize();

                $container.isotope({
                    itemSelector: '.tp-portfolio',
                    filter: active_tab,
                });
            });

            $element.find('.tp-portfolio-cat-name-list').on('click', '.tp-portfolio-cat-name', function () {
                var filterValue = $(this).attr('data-filter');
                $container.isotope({
                    filter: filterValue
                });

                TpSetMasonryClass($element, $container);
                TpGetMasonry($element, $container);

                $container.isotope({
                    filter: filterValue
                });

                $(this).siblings('.tp-portfolio-cat-name').removeClass('active');
                $(this).addClass('active');
            });

            $element.find('.tp-portfolio-cat-name-list').on('click', '.tp-portfolio-switch', function () {
                $(this).next('.tp-portfolio-cat-wrap').toggleClass('tp-open');
            });
        },

        portfolioCarouselController: function ($scope) {
            var $element = $scope.find('.tp-portfolio-slider');
            var item_id = $scope.attr('data-id');
            if ($element.find('.tp-portfolio-carousel-slides').length > 0) {
                var params = JSON.parse($element.find('.tp-portfolio-carousel-slides').attr('data-params'));
                var owl = 'owl' + item_id;
                owl = $element.find('.tp-portfolio-carousel-slides').owlCarousel({
                    rtl: JSON.parse(total_plus_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: false,
                    dots: JSON.parse(params.dots),
                    mouseDrag: true,
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                        },
                        769: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });

                $element.find('.owl-next').click(function () {
                    owl.trigger('next.owl.carousel');
                })

                $element.find('.owl-prev').click(function () {
                    owl.trigger('prev.owl.carousel');
                })

                if (params.show_tab) {
                    var active_tab = $element.find('.tp-portfolio-filter-wrap').data('active');
                    if ($element.find('.tp-portfolio-filter-btn[data-filter="' + active_tab + '"]').length == 0) {
                        var active_tab = $element.find('.tp-portfolio-filter-btn:first').data('filter');
                    }
                    $element.find("[data-filter='" + active_tab + "']").addClass('btn-active');
                    owl.owlFilter(active_tab);

                    $element.on('click', '.tp-portfolio-filter-btn', function (e) {
                        var filter_data = $(this).data('filter');
                        /* return if current */
                        if ($(this).hasClass('btn-active'))
                            return;
                        /* active current */
                        $(this).addClass('btn-active').siblings().removeClass('btn-active');
                        /* Filter */
                        owl.owlFilter(filter_data, function (_owl) {
                            $(_owl).find('.tp-portfolio-carousel-item').each(function (index) {
                                $(this).addClass('tppc-loading').delay(50 * index).queue(function () {
                                    $(this).dequeue().removeClass('tppc-loading')
                                })
                            });
                        });
                    });
                }
            }
        },

        serviceController: function ($scope) {

            var $el = $scope.find('.tp-service-toggle');
            if (($el.length > 0)) {
                $el.on('click', '.tp-service-excerpt .tp-service-title', function () {
                    $(this).parents('.tp-service-post').siblings().find('.tp-service-text').slideUp();
                    $(this).parents('.tp-service-post').siblings().removeClass('tp-active');
                    $(this).next('.tp-service-text').slideToggle();
                    $(this).parents('.tp-service-post').toggleClass('tp-active');
                });

                $el.on('click', '.tp-service-icon', function () {
                    $(this).parents('.tp-service-post').siblings().find('.tp-service-text').slideUp();
                    $(this).parents('.tp-service-post').siblings().removeClass('tp-active');
                    $(this).next('.tp-service-excerpt').find('.tp-service-text').slideToggle();
                    $(this).parent('.tp-service-post').toggleClass('tp-active');
                });
            }

        },

        teamCarouselController: function ($scope) {
            var $element = $scope.find('.tp-team-carousel');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    rtl: JSON.parse(total_plus_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.nav),
                    dots: false,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                        },
                        769: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },

        logoCarouselController: function ($scope) {
            var $element = $scope.find('.tp-logo-carousel');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: false,
                    dots: JSON.parse(params.dots),
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                        },
                        769: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },

        imageFlipsterController: function ($scope) {
            var $element = $scope.find('.tp-image-flipster-carousel');
            if ($element.length > 0) {
                $element.flipster({
                    itemContainer: '.tp-flipster',
                    itemSelector: '.tp-image-slide',
                    style: $element.attr('data-style'),
                    enableMousewheel: false,
                    enableKeyboard: true,
                    enableNavButtons: true,
                    enableTouch: true,
                    prevText: '<i class="mdi mdi-chevron-left"></i>',
                    nextText: '<i class="mdi mdi-chevron-right"></i>',
                });
            }
        },

        tabController: function ($scope) {
            var $element = $scope.find('.tp-tab-wrap');
            if ($element.length > 0) {
                $element.find('.tp-content:first').show();
                $element.find('.tp-tab-link:first').addClass('tp-active');
                $element.find('.tp-tab-link').on('click', function () {
                    $(this).siblings('.tp-tab-link').removeClass('tp-active');
                    $(this).addClass('tp-active');
                    var id = $(this).attr('id');
                    id = id.split('-');
                    $(this).closest('.tp-tab-wrap').find('.tp-content').hide();
                    $(this).closest('.tp-tab-wrap').find('#tp-content-' + id[2]).show();
                });
            }
        },

        counterController: function ($scope) {
            var $ele = $scope.find('.tp-counter');
            $ele.waypoint(function () {
                $ele.each(function () {
                    var $odometer = $(this).find('.odometer');
                    setTimeout(function () {
                        $odometer.html($odometer.data('count'));
                    }, 1000);
                });
                this.destroy();
            }, {
                offset: '90%'
            });
        },

        videoController: function ($scope) {
            var $element = $scope.find('.tp-video-popup');
            if ($element.length > 0) {
                $element.find('a').lightGallery({
                    selector: 'this'
                });
            }
        },

        totalContactBlock: function ($scope) {
            var $element = $scope.find('.tp-contact-module');
            if ($element.length > 0) {
                $element.find('.tp-contact-detail-toggle').on('click', function () {
                    if ($(this).hasClass('tp-open')) {
                        $(this).next('.tp-contact-content').addClass('tp-box-hidden');
                        $(this).addClass('tp-closed').removeClass('tp-open');
                    } else {
                        $(this).next('.tp-contact-content').removeClass('tp-box-hidden');
                        $(this).removeClass('tp-closed').addClass('tp-open');
                    }
                });
            }
        },

    };
    $(window).on('elementor/frontend/init', TotalPlusElements.init);
}(jQuery, window.elementorFrontend));

function TpGetMasonry($element, $container) {
    var winWidth = window.innerWidth;
    var containerWidth = $element.find('.tp-portfolio-posts').width();

    var two_col_image = containerWidth / 2;
    var three_col_image = containerWidth / 3;
    var four_col_image = containerWidth / 4;

    var three_col_image_double = (three_col_image * 2);
    var two_col_image_double = (two_col_image * 2);

    if (winWidth > 768) {

        if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style1')) {
            $container.find('.tp-portfolio').each(function () {
                jQuery(this).css({
                    height: three_col_image + 'px',
                    width: three_col_image + 'px'
                });
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style2')) {
            $container.find('.tp-portfolio').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        height: three_col_image_double + 'px',
                        width: three_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        height: three_col_image + 'px',
                        width: three_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style3')) {
            $container.find('.tp-portfolio').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: three_col_image_double + 'px',
                        height: three_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: three_col_image + 'px',
                        height: three_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style4')) {
            $container.find('.tp-portfolio').each(function () {
                jQuery(this).css({
                    height: four_col_image + 'px',
                    width: four_col_image + 'px'
                });
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style5')) {
            $container.find('.tp-portfolio').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: four_col_image * 2 + 'px',
                        height: four_col_image * 2 + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: four_col_image + 'px',
                        height: four_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style6')) {
            $container.find('.tp-portfolio').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: four_col_image * 2 + 'px',
                        height: four_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: four_col_image + 'px',
                        height: four_col_image + 'px'
                    });
                }
            })
        }

    } else if (winWidth > 480) {
        if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style1')) {
            $container.find('.tp-portfolio').each(function () {
                jQuery(this).css({
                    height: two_col_image + 'px',
                    width: two_col_image + 'px'
                });
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style2')) {
            $container.find('.tp-portfolio').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        height: two_col_image_double + 'px',
                        width: two_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        height: two_col_image + 'px',
                        width: two_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style3')) {
            $container.find('.tp-portfolio').each(function () {
                jQuery(this).css({
                    width: two_col_image + 'px',
                    height: two_col_image + 'px'
                });
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style4')) {
            $container.find('.tp-portfolio').each(function () {
                jQuery(this).css({
                    height: two_col_image + 'px',
                    width: two_col_image + 'px'
                });
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style5')) {
            $container.find('.tp-portfolio').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: two_col_image * 2 + 'px',
                        height: two_col_image * 2 + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: two_col_image + 'px',
                        height: two_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style6')) {
            $container.find('.tp-portfolio').each(function () {
                jQuery(this).css({
                    width: two_col_image + 'px',
                    height: two_col_image + 'px'
                });
            })
        }
    } else {
        $container.find('.tp-portfolio').each(function () {
            jQuery(this).css({
                width: containerWidth + 'px',
                height: containerWidth + 'px'
            });
        })
    }
}

function TpSetMasonryClass($element, $container) {
    var elems = $container.isotope('getFilteredItemElements');
    var i = 0;
    if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style2')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 1 || i == 5) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 7) {
                i = 0;
            }
        })
    } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style3')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 2 || i == 6) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 10) {
                i = 0;
            }
        })
    } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style5')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 3 || i == 6) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 10) {
                i = 0;
            }
        })
    } else if ($element.find('.tp-portfolio-post-wrap').hasClass('tp-style6')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 3 || i == 5 || i == 7) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 9) {
                i = 0;
            }
        })
    }
}
