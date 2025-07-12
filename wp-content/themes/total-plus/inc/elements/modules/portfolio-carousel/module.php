<?php

namespace TotalPlusElements\Modules\PortfolioCarousel;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-portfolio-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'PortfolioCarousel',
        ];
        return $widgets;
    }

}
