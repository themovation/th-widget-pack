<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Page_Title extends Page_Title {

    public function get_name() {
        return 'thhf-page-title';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
       return 'th-editor-icon-page-title';
    }

    public function get_categories() {
        return ['themo-site'];
    }

}
