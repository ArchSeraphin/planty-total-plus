<?php

/**
 * Total Plus Custom JS
 *
 * @package Total Plus
 */
function total_plus_check_slider_type_rev($control) {
    $total_plus_slider_type = $control->manager->get_setting('total_plus_slider_type')->value();
    if ($total_plus_slider_type == 'revolution') {
        return true;
    } else {
        return false;
    }
}

function total_plus_check_slider_type_normal($control) {
    $total_plus_slider_type = $control->manager->get_setting('total_plus_slider_type')->value();
    if ($total_plus_slider_type == 'normal') {
        return true;
    } else {
        return false;
    }
}

function total_plus_check_slider_type_banner($control) {
    $total_plus_slider_type = $control->manager->get_setting('total_plus_slider_type')->value();
    if ($total_plus_slider_type == 'banner') {
        return true;
    } else {
        return false;
    }
}
