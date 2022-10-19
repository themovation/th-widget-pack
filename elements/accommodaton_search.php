<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Search extends Themo_Widget_Accommodation_Listing {

    var $searchParams = [];

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        add_filter('mphb_search_available_rooms', function ($arr) {
            $this->searchParams = $arr;
            return $arr;
        }
        );

        $this->addElements();
    }

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
        $key = $this->get_name();

        $modified = filemtime(THEMO_PATH . 'css/accommodation.css');
        $parent_name = parent::get_name();
        wp_enqueue_style($parent_name, THEMO_URL . 'css/accommodation.css', array(), $modified);

        $styles = '.elementor-widget-' . $key . ' .mphb-confirm-reservation,'
                . '.elementor-widget-' . $key . ' .mphb-rooms-reservation-message-wrapper'
                . '{'
                . 'display: none!important;'
                . '}'
                . '.elementor-widget-' . $key . ' .mphb-rooms-quantity{'
                . 'padding: 0 12px !important;'
                . 'color: #6c6c6c;'
                . 'border: 1px solid #d3d3d3;'
                . 'border-radius: 5px;'
                . 'height: 30px;'
                . 'display: inline-block;'
                . 'width: auto;'
                . 'margin-right: 1em;'
                . '}'
                . '';

        wp_register_style($key, false, array(), true, true);
        wp_add_inline_style($key, $styles);
        wp_enqueue_style($key);
    }

    private function addElements() {
        add_action('elementor/element/' . $this->get_name() . '/thmv_section_data/before_section_end', function ($element, $args) {

            $element->add_responsive_control(
                    'thmv_hide_results_message',
                    [
                        'label' => __('Top Message', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'th-widget-pack'),
                        'label_off' => __('No', 'th-widget-pack'),
                        'default' => 'yes'
                    ]
            );
            $element->add_control(
                    'thmv_hide_booking_button',
                    [
                        'label' => __('Booking Button', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'th-widget-pack'),
                        'label_off' => __('No', 'th-widget-pack'),
                        'default' => 'yes',
                    ]
            );
        }, 10, 2);
    }

    public function _register_controls() {
        parent::_register_controls();

        $this->update_control('thmv_data_switcher', ['default' => 'yes']);
        $this->update_control('thmv_data_source', ['default' => 'mphb_room_type']);
        $this->update_control('order', ['default' => 'date']);

//        $this->set_render_attribute('_wrapper', 'class', 'elementor-widget-'.$parent_name);
    }

    protected function render() {
        $parent_name = parent::get_name();
        ob_start();
        parent::render();

        $results = ob_get_clean();
        $show_message = $this->get_settings_for_display('thmv_hide_results_message');
        $total = isset($this->totalAccommodations) ? $this->totalAccommodations : 0; //posts variable from parent::render
        //set class of the parent widget so the CSS works
        echo '<div class="elementor-widget-' . $parent_name . '">';
        if ($total > 0 && $show_message) {
            $checkInDate = $checkOutDate = '';
            if (isset($this->searchParams['from_date'])) {
                $checkInDate = \MPHB\Utils\DateUtils::formatDateWPFront($this->searchParams['from_date']);
            }
            if (isset($this->searchParams['to_date'])) {
                $checkOutDate = \MPHB\Utils\DateUtils::formatDateWPFront($this->searchParams['to_date']);
            }
            ?>
            <p class="thmv-search-results-info alert" style="border-color: #e2e2e2;">
                <?php
                echo esc_html(sprintf(_n('%s accommodation found', '%s accommodations found', $total, 'th-widget-pack'), $total));

                echo esc_html(sprintf(__(' from %s - till %s', 'th-widget-pack'), $checkInDate, $checkOutDate));
                ?>
            </p>

            <?php
        }
        echo $results;
        echo '</div>';
    }

    protected function after_learn_more($post) {

        if ($this->get_settings_for_display('thmv_hide_booking_button')) {
            return false;
        }

        $elementor_preview_active = isset($_REQUEST['action']) && in_array($_REQUEST['action'], ['elementor', 'elementor_ajax']) ? 1 : 0;

        $btn_classes = 'btn btn-standard-primary thmv-book-button ';
        //if preview, show the static content, else apply motopress filter
        if ($elementor_preview_active) {


            $maxRoomsCount = 2;
            ?>
            <div class="mphb-reserve-room-section">
                <p class="mphb-rooms-quantity-wrapper mphb-rooms-quantity-multiple">
                    <select class="mphb-rooms-quantity">
                        <?php for ($count = 1; $count <= $maxRoomsCount; $count++) { ?>
                            <option value="<?php echo esc_attr($count); ?>"><?php
                                echo $count;
                                ?></option>
                        <?php } ?>
                    </select>
                    <span class="mphb-available-rooms-count"><?php
                        echo esc_html(sprintf(_n('of %d accommodation available.', 'of %d accommodations available.', $maxRoomsCount, 'motopress-hotel-booking'), $maxRoomsCount));
                        ?></span>
                </p>

                <button class="<?php echo $btn_classes?> button mphb-button mphb-book-button"><?php esc_html_e('Book', 'motopress-hotel-booking'); ?></button>
            </div>
            <?php
        } else {
            MPHB()->setCurrentRoomType($post);
            ob_start();
            do_action('mphb_sc_search_results_render_book_button');
            echo str_replace("mphb-book-button", $btn_classes." mphb-book-button",ob_get_clean());
            
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Themo_Widget_Accommodation_Search());
add_action('elementor/editor/before_enqueue_styles', function () {
    echo '<style>'
    . '.elementor-control-thmv_data_switcher,'
    . '.elementor-control-thmv_data_source,'
    . '.elementor-control-individual_mphb_room_type,'
    . '.elementor-control-group_mphb_room_type,'
    . '.elementor-control-order'
    . '{'
    . 'display: none!important;'
    . '}</style>';
}
);
