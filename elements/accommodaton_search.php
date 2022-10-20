<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Search extends Themo_Widget_Accommodation_Listing {

    var $searchParams = [];
    var $is_preview = false;

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $this->is_preview = isset($_REQUEST['action']) && in_array($_REQUEST['action'], ['elementor', 'elementor_ajax']) ? 1 : 0;

        add_filter('mphb_search_available_rooms', function ($arr) {
            $this->searchParams = $arr;
            $checkInDate = $checkOutDate = '';

            if (isset($this->searchParams['from_date'])) {
                $checkInDate = \MPHB\Utils\DateUtils::formatDateWPFront($this->searchParams['from_date']);
            }
            if (isset($this->searchParams['to_date'])) {
                $checkOutDate = \MPHB\Utils\DateUtils::formatDateWPFront($this->searchParams['to_date']);
            }
            $this->searchParams['from_date_formatted'] = $checkInDate;
            $this->searchParams['to_date_formatted'] = $checkOutDate;
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

        $styles = ''
                . '.elementor-widget-' . $key . ' .mphb-empty-cart-message'
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
        add_action('elementor/element/' . $this->get_name() . '/thmv_style_section_link/after_section_end', function ($element, $args) {
            $element->start_controls_section(
                    'thmv_style_section_book_button',
                    [
                        'label' => __('Book Button', 'th-widget-pack'),
                        'tab' => Controls_Manager::TAB_STYLE,
                        'condition' => [
                            'thmv_hide_booking_button' => '',
                        ],
                    ]
            );
            $element->add_control(
                    'book_button_style',
                    [
                        'label' => __('Button Style', 'th-widget-pack'),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => __('Default', 'th-widget-pack'),
                            'standard-primary' => __('Standard Primary', 'th-widget-pack'),
                            'standard-accent' => __('Standard Accent', 'th-widget-pack'),
                            'standard-light' => __('Standard Light', 'th-widget-pack'),
                            'standard-dark' => __('Standard Dark', 'th-widget-pack'),
                            'ghost-primary' => __('Ghost Primary', 'th-widget-pack'),
                            'ghost-accent' => __('Ghost Accent', 'th-widget-pack'),
                            'ghost-light' => __('Ghost Light', 'th-widget-pack'),
                            'ghost-dark' => __('Ghost Dark', 'th-widget-pack'),
                            'cta-primary' => __('CTA Primary', 'th-widget-pack'),
                            'cta-accent' => __('CTA Accent', 'th-widget-pack'),
                        ],
                        'separator' => 'before',
                    ]
            );

            $element->add_responsive_control(
                    'book_link_padding',
                    [
                        'label' => __('Padding', 'elementor'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .thmv-book-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
            );
            $element->add_responsive_control(
                    'book_button_stretch',
                    [
                        'label' => __('Stretch Button', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'th-widget-pack'),
                        'label_off' => __('No', 'th-widget-pack'),
                        'return_value' => 'yes',
                    ]
            );
            $element->end_controls_section();
            $element->start_controls_section(
                    'thmv_style_section_reservation_button',
                    [
                        'label' => __('Confirm Reservation Button', 'th-widget-pack'),
                        'tab' => Controls_Manager::TAB_STYLE,
                    ]
            );
            $element->add_control(
                    'reservation_button_style',
                    [
                        'label' => __('Button Style', 'th-widget-pack'),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => __('Default', 'th-widget-pack'),
                            'standard-primary' => __('Standard Primary', 'th-widget-pack'),
                            'standard-accent' => __('Standard Accent', 'th-widget-pack'),
                            'standard-light' => __('Standard Light', 'th-widget-pack'),
                            'standard-dark' => __('Standard Dark', 'th-widget-pack'),
                            'ghost-primary' => __('Ghost Primary', 'th-widget-pack'),
                            'ghost-accent' => __('Ghost Accent', 'th-widget-pack'),
                            'ghost-light' => __('Ghost Light', 'th-widget-pack'),
                            'ghost-dark' => __('Ghost Dark', 'th-widget-pack'),
                            'cta-primary' => __('CTA Primary', 'th-widget-pack'),
                            'cta-accent' => __('CTA Accent', 'th-widget-pack'),
                        ],
                        'separator' => 'before',
                    ]
            );
            $element->add_responsive_control(
                    'reservation_button_padding',
                    [
                        'label' => __('Padding', 'elementor'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .mphb-confirm-reservation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
            );
            $element->end_controls_section();
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
        echo '<div class="elementor-widget-' . $parent_name . ' mphb_sc_search_results-wrapper">';
        if ($total > 0 && $show_message) {
            ?>
            <p class="thmv-search-results-info alert" style="border-color: #e2e2e2;">
                <?php
                echo esc_html(sprintf(_n('%s accommodation found', '%s accommodations found', $total, 'th-widget-pack'), $total));

                echo esc_html(sprintf(__(' from %s - till %s', 'th-widget-pack'), $this->searchParams['from_date_formatted'], $this->searchParams['to_date_formatted']));
                ?>
            </p>

            <?php
        }

        //if not preview, then show the top cart
        if (!$this->is_preview) {
            ob_start();
            MPHB()->getShortcodes()->getSearchResults()->renderReservationCart();
            $cart = ob_get_clean();
            $cart_style = $this->get_settings_for_display('reservation_button_style');
            if(!empty($cart_style)){
                $cart_style =  'btn-' .$cart_style;
            }
            // Confirm Button Style
            $cart_render = str_replace(
                    'mphb-confirm-reservation',
                    'mphb-confirm-reservation btn th-btn ' . esc_attr($cart_style),
                    $cart
            );
            echo $cart_render;
        }


        echo $results;
        echo '</div>';
    }

    protected function after_learn_more($post) {

        if ($this->get_settings_for_display('thmv_hide_booking_button')) {
            return false;
        }

        $buttonstyle = $this->get_settings_for_display('book_button_style');
        $btn_classes = 'thmv-book-button btn th-btn';
        if (!empty($buttonstyle)) {
            $btn_classes .= ' btn-' . $buttonstyle;
        }

        $this->setupResponsiveControl($this->get_settings_for_display(), 'book_button_stretch', 'book_button', 'streched');
        $class_arr = $this->get_render_attributes('book_button', 'class');
        $btn_classes .= ' ' . implode(' ', $class_arr);
        //if preview, show the static content, else apply motopress filter
        if ($this->is_preview) {

            $currencyCode = get_option('mphb_currency_symbol', $this->defaultCurrency);
            $maxRoomsCount = 2;
            ?>
            <p class="mphb-regular-price"><?php esc_html_e('Prices start at:', 'th-widget-pack') ?> <span class="mphb-price">
                    <span class="mphb-currency"><?= $currencyCode ?></span>77</span> 
                <span class="mphb-price-period" title="<?php esc_html_e('Based on your search parameters', 'th-widget-pack'); ?>">
                    <?php esc_html_e('per night', 'th-widget-pack') ?>
                </span>
            </p>
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
                        echo esc_html(sprintf(_n('of %d accommodation available.', 'of %d accommodations available.', $maxRoomsCount, 'th-widget-pack'), $maxRoomsCount));
                        ?></span>
                </p>

                <button class="<?php echo $btn_classes ?> button mphb-button mphb-book-button"><?php esc_html_e('Book', 'th-widget-pack'); ?></button>
            </div>
            <?php
        } else {
            MPHB()->setCurrentRoomType($post);
            ob_start();
            echo '<p class="mphb-regular-price">';
            echo esc_html__('Prices start at:', 'th-widget-pack') . ' ';
            mphb_tmpl_the_room_type_price_for_dates($this->searchParams['from_date'], $this->searchParams['to_date']);
            echo '</p>';
            do_action('mphb_sc_search_results_render_book_button');
            $button_render = ob_get_clean();
            $cart_style = $this->get_settings_for_display('reservation_button_style');
            if(!empty($cart_style)){
                $cart_style =  'btn-' .$cart_style;
            }
            // Confirm Button Style
            $button_render_final = str_replace(
                    'mphb-confirm-reservation',
                    'mphb-confirm-reservation btn th-btn ' . esc_attr($cart_style),
                    $button_render
            );
            echo str_replace("mphb-book-button", $btn_classes . " mphb-book-button", $button_render_final);
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
