<?php

namespace TotalPlusElements\Modules\ImageFlipster;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-image-flipster';
    }

    public function get_widgets() {
        $widgets = [
            'ImageFlipster',
        ];
        return $widgets;
    }

}
