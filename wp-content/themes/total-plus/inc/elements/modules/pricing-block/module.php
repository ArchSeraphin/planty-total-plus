<?php

namespace TotalPlusElements\Modules\PricingBlock;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-pricing-module';
    }

    public function get_widgets() {
        $widgets = [
            'PricingBlock',
        ];
        return $widgets;
    }

}
