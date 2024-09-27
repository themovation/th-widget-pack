<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Cart extends Cart {

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

    public function render() {
        $settings = $this->get_settings_for_display();
        $cart_type = $settings['hfe_cart_type'];
        $old_cart_type = isset($settings['cart_icon']) ? $settings['cart_icon'] : false;
        if ($cart_type === 'custom' && !empty($old_cart_type)) {
            ob_start();
            parent::render();
            $result = ob_get_clean();
            //if custom icon and an old icon field exists, use it,
            if ($cart_type === 'custom' && !empty($old_cart_type)) {
                $fill = '';

                $search = '<i class="eicon" aria-hidden="true"></i>';
                ob_start();
                \Elementor\Icons_Manager::render_icon($old_cart_type, ['aria-hidden' => 'true'], 'em'); //using em tag tyhpe to avoid strong CSS rule that forces the hardcoded icon
                $replace = ob_get_clean();
                $result = str_replace($search, $replace, $result);
                if ('svg' === $old_cart_type['library'] && !empty($settings['toggle_button_icon_color'])) {
                    $fill = 'style="fill:' . $settings['toggle_button_icon_color'] . ';"';
                    $result = str_replace('<svg', '<svg'.' '.$fill, $result);
                }
            }

            echo $result;
        } else {
            parent::render();
        }
    }

}
