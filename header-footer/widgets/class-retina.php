<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Retina extends Retina\Retina {

    public function get_name() {
        return 'thhf-retina';
    }

   
    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

   
    public function get_icon() {
        return 'th-editor-icon-retina-image';
    }

    public function get_categories() {
        return ['themo-site'];
    }

    protected function register_helpful_information() {

       
    }

}
