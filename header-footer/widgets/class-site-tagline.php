<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Site_Tagline extends SiteTagline\Site_Tagline {

    public function get_name() {
        return 'thhf-site-tagline';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-site-tagline';
    }

    public function get_categories() {
        return ['themo-site'];
    }

}
