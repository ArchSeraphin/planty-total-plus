<?php

namespace TotalPlusElements\Modules\TabBlock;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-tab-block';
    }

    public function get_widgets() {
        $widgets = [
            'TabBlock',
        ];
        return $widgets;
    }

}
