var $j = jQuery.noConflict(),
        $window = $j(window);

$j(document).on('ready', function () {
    "use strict";
    // Mega menu

    var $container = $j('.ht-header .ht-container');

    $j('.ht-menu .menu-item-megamenu.megamenu-full-width').hover(function () {
        var $menuWidth = $container.outerWidth(),
                $menuPosition = $container.offset(),
                $menuItemPosition = $j(this).offset(),
                $PositionLeft = $menuItemPosition.left - $menuPosition.left;

        $j(this).find('.megamenu').css({
            'left': '-' + $PositionLeft + 'px',
            'width': $menuWidth
        });
    });

    // Megamenu auto width
    $j('.ht-menu .menu-item-megamenu.megamenu-auto-width .megamenu').each(function () {
        var $li = $j(this).parent(),
                $window_width = $j(window).width(),
                $container = $j('.ht-header .ht-container'),
                $containerWidth = $container.outerWidth(),
                $containerOffset = $container.offset().left,
                $liOffset = $li.offset().left,
                $liWidth = $li.outerWidth(),
                $dropdownWidth = $j(this).outerWidth();
        if (total_plus_megamenu.rtl == 'true') {
            if ($dropdownWidth < $liOffset + $liWidth - $containerOffset) {
                $j(this).css({
                    'right': 0,
                    'left': 'auto'
                });
            } else {
                var $excessWidth = $dropdownWidth - ($liOffset + $liWidth - $containerOffset)
                $j(this).css({
                    'right': -$excessWidth,
                    'left': 'auto',
                });
            }
        } else {
            if ($dropdownWidth < $containerOffset + $containerWidth - $liOffset) {
                $j(this).css({
                    'left': 0,
                    'right': 'auto'
                });
            } else {
                if ($dropdownWidth < $liOffset + $liWidth - $containerOffset) {
                    $j(this).css({
                        'right': 0,
                        'left': 'auto'
                    });
                } else {
                    var $excessWidth = $dropdownWidth - ($containerOffset + $containerWidth - $liOffset);
                    $j(this).css({
                        'left': -$excessWidth,
                        'right': 'auto',
                    });

                }
            }
        }
    });

    $j('li.heading-yes > a').on('click', function () {
        return false;
    });

    $j('.cat-megamenu-tab > div:first').addClass('active-tab');

    $j('.cat-megamenu-tab > div').hoverIntent(function () {
        var $this = $j(this);
        if ($this.hasClass('active-tab')) {
            return;
        }

        $this.siblings().removeClass('active-tab');
        $this.addClass('active-tab');
        var activeCat = $this.data('catid');
        $this.closest('.megamenu').find('.cat-megamenu-content > ul').hide();
        $this.closest('.megamenu').find('#' + activeCat).fadeIn('fast');
    });
});