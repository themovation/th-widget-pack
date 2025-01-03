<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Copyright extends Copyright\Copyright {

    public function get_name() {
        return 'thhf-copyright';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-copyright';
    }

    public function get_categories() {
        return ['themo-site'];
    }

}
