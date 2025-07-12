(function ($) {

    if ($('.total-plus-tab-filter').length > 0) {

        var first_class = $('.total-plus-tag-tab:first').data('filter');
        $('.total-plus-tag-tab:first').addClass('total-plus-active');

        var $container = $('.total-plus-demo-box-wrap').imagesLoaded(function () {
            $container.isotope({
                itemSelector: '.total-plus-demo-box',
                filter: first_class
            });
        });

        $('.total-plus-tab-filter').on('click', '.total-plus-tag-tab', function () {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({filter: filterValue});
            $('.total-plus-tag-tab').removeClass('total-plus-active');
            $(this).addClass('total-plus-active');
        });

    }

    $('.total-plus-modal-button').on('click', function (e) {
        e.preventDefault();
        $('body').addClass('total-plus-modal-opened');
        var modalId = $(this).attr('href');
        $(modalId).fadeIn();

        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $('.total-plus-modal-back, .total-plus-modal-cancel').on('click', function (e) {
        $('body').removeClass('total-plus-modal-opened');
        $('.total-plus-modal').hide();
        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $('body').on('click', '.total-plus-import-demo', function () {
        var $el = $(this);
        var demo = $(this).attr('data-demo-slug');
        var reset = $('#checkbox-reset-' + demo).is(':checked');
        var reset_message = '';

        if (reset) {
            reset_message = total_plus_ajax_data.reset_database;
            var confirm_message = 'Are you sure to proceed? Resetting the database will delete all your contents.';
        } else {
            var confirm_message = 'Are you sure to proceed?';
        }

        $import_true = confirm(confirm_message);
        if ($import_true == false)
            return;

        $("html, body").animate({scrollTop: 0}, "slow");

        $('#total-plus-modal-' + demo).hide();
        $('#total-plus-import-progress').show();

        $('#total-plus-import-progress .total-plus-import-progress-message').html(total_plus_ajax_data.prepare_importing).fadeIn();

        var info = {
            demo: demo,
            reset: reset,
            next_step: 'total_plus_install_demo',
            next_step_message: reset_message
        };

        setTimeout(function () {
            do_ajax(info);
        }, 2000);
    });

    function do_ajax(info) {
        console.log(info);
        if (info.next_step) {
            var data = {
                action: info.next_step,
                demo: info.demo,
                reset: info.reset,
                security: total_plus_ajax_data.nonce
            };

            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                beforeSend: function () {
                    if (info.next_step_message) {
                        $('#total-plus-import-progress .total-plus-import-progress-message').hide().html('').fadeIn().html(info.next_step_message);
                    }
                },
                success: function (response) {
                    var info = JSON.parse(response);

                    if (!info.error) {
                        if (info.complete_message) {
                            $('#total-plus-import-progress .total-plus-import-progress-message').hide().html('').fadeIn().html(info.complete_message);
                        }
                        setTimeout(function () {
                            do_ajax(info)
                        }, 2000);
                    } else {
                        $('#total-plus-import-progress .total-plus-import-progress-message').html(info.error_message);
                        $('#total-plus-import-progress').addClass('import-error');
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    $('#total-plus-import-progress .total-plus-import-progress-message').html(total_plus_ajax_data.import_error);
                    $('#total-plus-import-progress').addClass('import-error');
                }
            });
        } else {
            $('#total-plus-import-progress .total-plus-import-progress-message').html(total_plus_ajax_data.import_success);
            $('#total-plus-import-progress').addClass('import-success');
        }
    }
})(jQuery);
