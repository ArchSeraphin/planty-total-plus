(function ($) {
    var total_plus_megamenu = {

        recalcTimeout: false,

        // bind the click event to all elements with the class avia_uploader
        bind_click: function () {
            var megmenuActivator = '.field-megamenu select, #menu-to-edit';

            $(document).on('change', megmenuActivator, function () {
                var selectbox = $(this),
                        container = selectbox.parents('.menu-item:eq(0)');

                if (selectbox.val() == 'megamenu_full_width' || selectbox.val() == 'megamenu_auto_width') {
                    container.addClass('menu-item-mega-menu-active');
                } else {
                    container.removeClass('menu-item-mega-menu-active');
                }

                //check if anything in the dom needs to be changed to reflect the (de)activation of the mega menu
                total_plus_megamenu.recalc();

            });
        },

        recalcInit: function () {
            $(document).on('mouseup', '.menu-item-bar', function (event, ui) {
                if (!$(event.target).is('a')) {
                    clearTimeout(total_plus_megamenu.recalcTimeout);
                    total_plus_megamenu.recalcTimeout = setTimeout(total_plus_megamenu.recalc, 500);
                }
            });
        },

        recalc: function () {
            var menuItems = $('.menu-item', '#menu-to-edit');

            menuItems.each(function (i) {
                var item = $(this),
                        megaMenuCheckbox = $('.field-megamenu select', this);

                if (!item.is('.menu-item-depth-0')) {
                    var checkItem = menuItems.filter(':eq(' + (i - 1) + ')');
                    if (checkItem.is('.menu-item-mega-menu-active')) {
                        item.addClass('menu-item-mega-menu-active');
                    } else {
                        item.removeClass('menu-item-mega-menu-active');
                    }
                }

            });

        }

    };

    $(function () {
        total_plus_megamenu.bind_click();
        total_plus_megamenu.recalcInit();
        total_plus_megamenu.recalc();
    });


})(jQuery);