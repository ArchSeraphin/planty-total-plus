<?php

namespace TotalPlusElements\Modules\TestimonialSlider;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-testimonial-slider';
    }

    public function get_widgets() {
        $widgets = [
            'TestimonialSlider',
        ];
        return $widgets;
    }

}
