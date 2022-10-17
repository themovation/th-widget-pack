<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Search extends Themo_Widget_Accommodation_Listing {

    public function get_name() {
        return 'themo-accommodation-search-results';
    }

    public function get_title() {
        return __('Accommodation Search Results', 'th-widget-pack');
    }

    public function get_icon() {
        return 'th-editor-icon-search-results';
    }

    public function loadTHMVAssets($editMode = false) {
        $modified = filemtime(THEMO_PATH . 'css/accommodation.css');
        $parent_name = parent::get_name();
        wp_enqueue_style($parent_name, THEMO_URL . 'css/accommodation.css', array(), $modified);
    }

    public function _register_controls() {
        parent::_register_controls();

        $this->update_control('thmv_data_switcher', ['default' => 'yes']);
        $this->update_control('thmv_data_source', ['default' => 'mphb_room_type']);
        $this->update_control('order', ['default' => 'date']);
        
        $parent_name = parent::get_name();
        $this->set_render_attribute('_wrapper', 'class', 'elementor-widget-'.$parent_name);
    }

    protected function render() {
        //set class of the parent widget so the CSS works
        parent::render();
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Themo_Widget_Accommodation_Search());
add_action('elementor/editor/before_enqueue_styles', function () {
    echo '<style>'
    . '.elementor-control-thmv_data_switcher,'
    . '.elementor-control-thmv_data_source,'
    . '.elementor-control-individual_mphb_room_type,'
    . '.elementor-control-group_mphb_room_type,'
    . '.elementor-control-order{'
    . 'display: none!important;'
    . '}</style>';
}
);
