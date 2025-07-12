<?php

namespace TotalPlusElements\Modules\ProgressBar;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-progress-bar';
    }

    public function get_widgets() {
        $widgets = [
            'ProgressBar',
        ];
        return $widgets;
    }

}
