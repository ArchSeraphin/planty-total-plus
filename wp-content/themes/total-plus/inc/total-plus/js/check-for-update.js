jQuery(document).ready(function($) {
    function add_check_for_update_btn() {
        setTimeout(function() {
            if (!$('.total-plus-theme-button').length) {
                $(`<a href="${total_plus_admin_localize.check_update_url}" class="button total-plus-theme-button">${total_plus_admin_localize.check_update_text}</a>`).appendTo('.theme-overlay .theme-actions .active-theme');
            }
        }, 500);
    }
    add_check_for_update_btn();
    $(document).on('click', '.theme', function() {
        add_check_for_update_btn();
    });
});