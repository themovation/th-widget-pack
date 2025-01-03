<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Navigation_Menu extends NavigationMenu\Navigation_Menu {

    public function get_name() {
        return 'thhf-navigation-menu';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-navigation';
    }

    public function get_categories() {
        return ['themo-site'];
    }

    public function get_script_depends() {
        return ['aloha-hfe-widgets-js'];
    }

}
