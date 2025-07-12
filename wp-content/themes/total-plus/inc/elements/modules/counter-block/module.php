<?php

namespace TotalPlusElements\Modules\CounterBlock;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-counter-block';
    }

    public function get_widgets() {
        $widgets = [
            'CounterBlock',
        ];
        return $widgets;
    }

}
