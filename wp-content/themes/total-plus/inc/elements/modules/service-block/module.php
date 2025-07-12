<?php

namespace TotalPlusElements\Modules\ServiceBlock;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-service-block';
    }

    public function get_widgets() {
        $widgets = [
            'ServiceBlock',
        ];
        return $widgets;
    }

}
