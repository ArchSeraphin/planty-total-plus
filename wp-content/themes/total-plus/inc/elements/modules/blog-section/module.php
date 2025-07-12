<?php

namespace TotalPlusElements\Modules\BlogSection;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-blog-section';
    }

    public function get_widgets() {
        $widgets = [
            'BlogSection',
        ];
        return $widgets;
    }

}
