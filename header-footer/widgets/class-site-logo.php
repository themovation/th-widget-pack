<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Site_Logo extends SiteLogo\Site_Logo {

    public function get_name() {
        return 'thhf-site-logo';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-site-logo';
    }

    public function get_categories() {
        return ['themo-site'];
    }

}
