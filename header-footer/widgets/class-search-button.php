<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Search_Button extends Search_Button {

    public function get_name() {
        return 'thhf-search-button';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-search';
    }

    public function get_categories() {
        return ['themo-site'];
    }

    public function get_script_depends() {
        return ['aloha-hfe-widgets-js'];
    }

    public function render() {
        $settings = $this->get_settings_for_display();

        ob_start();
        parent::render();
        $result = ob_get_clean();
        if ('icon' === $settings['layout']) {
            $search = '<i class="fas fa-search" aria-hidden="true"></i>';
            ob_start();
            \Elementor\Icons_Manager::render_icon($settings['search_icon'], ['aria-hidden' => 'true']);
            $replace = ob_get_clean();
            $result = str_replace($search, $replace, $result);
        }

        echo $result;
    }

}
