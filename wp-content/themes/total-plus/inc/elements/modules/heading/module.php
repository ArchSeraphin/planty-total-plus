<?php

namespace TotalPlusElements\Modules\Heading;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-heading';
    }

    public function get_widgets() {
        $widgets = [
            'Heading',
        ];
        return $widgets;
    }

}
