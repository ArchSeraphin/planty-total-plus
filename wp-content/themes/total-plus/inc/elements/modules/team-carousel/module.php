<?php

namespace TotalPlusElements\Modules\TeamCarousel;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-team-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'TeamCarousel',
        ];
        return $widgets;
    }

}
