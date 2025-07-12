jQuery(document).ready(function ($) {
    $('.ht-remove-widget').on('click', function (e) {
        e.preventDefault();
        var widget = $(this).attr('data-widget');
        var widgeturl = total_widget_params.widgeturl
        var result = confirm("Are you sure you want to delete " + widget + " Widget?");

        if (result) {
            $.ajax({
                url: total_widget_params.ajaxurl,
                data: ({
                    'action': 'total_plus_remove_widget_area',
                    'widget': widget,
                }),
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
});
