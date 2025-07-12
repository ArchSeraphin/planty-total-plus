<?php

namespace TotalPlusElements\Modules\ContactSection;

use TotalPlusElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-contact-block';
    }

    public function get_widgets() {
        $widgets = [
            'ContactSection',
        ];
        return $widgets;
    }

}
