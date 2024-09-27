<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Copyright_Shortcode extends Copyright_Shortcode {

    public function __construct() {

        add_shortcode('thmv_current_year', [$this, 'display_current_year']);
        add_shortcode('thmv_site_title', [$this, 'display_site_title']);
    }

    public function get_name() {
        return 'thhf-cart';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-cart';
    }

    public function get_categories() {
        return ['themo-site'];
    }

}
