<?php

namespace TotalPlusElements\Modules\TeamBlock;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-team-block';
    }

    public function get_widgets() {
        $widgets = [
            'TeamBlock',
        ];
        return $widgets;
    }

}
