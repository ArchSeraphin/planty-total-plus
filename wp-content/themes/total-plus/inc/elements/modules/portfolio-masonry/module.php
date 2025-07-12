<?php

namespace TotalPlusElements\Modules\PortfolioMasonry;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-portfolio-masonry';
    }

    public function get_widgets() {
        $widgets = [
            'PortfolioMasonry',
        ];
        return $widgets;
    }

}
