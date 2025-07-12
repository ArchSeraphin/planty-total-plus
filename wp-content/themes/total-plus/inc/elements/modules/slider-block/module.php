<?php

namespace TotalPlusElements\Modules\SliderBlock;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-slider';
    }

    public function get_widgets() {
        $widgets = [
            'SliderBlock',
        ];
        return $widgets;
    }

}
