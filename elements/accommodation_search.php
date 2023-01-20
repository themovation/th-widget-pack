<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Search extends Themo_Widget_Accommodation_Listing {

    var $searchParams = [];
    var $is_preview = false;
    var $defaultCurrency = '$';

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

        $key = $this->get_name();

        $styles = '.elementor-widget-' . $key . ' .mphb-empty-cart-message'
                . '{'
                . 'display: none!important;'
                . '}'
                . '.elementor-widget-' . $key . ' .mphb-rooms-quantity'
                . '{'
                . 'min-height: 30px;'
                . 'height: auto;'
                . '}'
                . ''
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

    private function addElements() {
        add_action('elementor/element/' . $this->get_name() . '/thmv_section_data/before_section_end', function ($element, $args) {

            $element->add_responsive_control(
                    'thmv_hide_results_message',
                    [
                        'label' => __('Top Message', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'th-widget-pack'),
                        'label_off' => __('No', 'th-widget-pack'),
                        'default' => ''
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
            $element->add_control(
                    'thmv_hide_booking_price',
                    [
                        'label' => __('Booking Price', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'th-widget-pack'),
                        'label_off' => __('No', 'th-widget-pack'),
                        'default' => '',
                    ]
            );
        }, 9, 2);
        add_action('elementor/element/' . $this->get_name() . '/thmv_style_section_link/after_section_end', function ($element, $args) {
            $element->start_controls_section(
                    'thmv_style_section_book_price',
                    [
                        'label' => __('Booking Price', 'th-widget-pack'),
                        'tab' => Controls_Manager::TAB_STYLE,
                        'condition' => [
                            'thmv_hide_booking_price' => '',
                        ],
                    ]
            );
            $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'label' => __('Typography', 'elementor'),
                        'name' => 'booking_price_typography',
                        'selector' => '{{WRAPPER}} .mphb-regular-price',
                    ]
            );
            $element->add_control(
                    'booking_price_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mphb-regular-price' => 'color: {{VALUE}};',
                        ],
                    ]
            );
            $element->add_control(
                    'booking_price_price_heading',
                    [
                        'label' => __('Price', 'th-widget-pack'),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
            );
            $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'label' => __('Typography', 'elementor'),
                        'name' => 'booking_price_price_typography',
                        'selector' => '{{WRAPPER}} .mphb-price',
                    ]
            );
            $element->add_control(
                    'booking_price_price_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mphb-price' => 'color: {{VALUE}};',
                        ],
                    ]
            );

            $element->end_controls_section();

            $element->start_controls_section(
                    'thmv_style_section_availability_text',
                    [
                        'label' => __('Availability Text', 'th-widget-pack'),
                        'tab' => Controls_Manager::TAB_STYLE,
                        'condition' => [
                            'thmv_hide_booking_price' => '',
                        ],
                    ]
            );
            $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'label' => __('Typography', 'elementor'),
                        'name' => 'availability_typography',
                        'selector' => '{{WRAPPER}} .mphb-available-rooms-count',
                    ]
            );
            $element->add_control(
                    'availability_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mphb-available-rooms-count' => 'color: {{VALUE}};',
                        ],
                    ]
            );
            $element->add_control(
                    'availability_count_dropdown_header',
                    [
                        'label' => __('Dropdown', 'the-widget-pack'),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
            );
            $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'label' => __('Typography', 'elementor'),
                        'name' => 'availability_count_dropdown_typography',
                        'selector' => '{{WRAPPER}} .mphb-rooms-quantity',
                    ]
            );
            $element->add_control(
                    'availability_count_dropdown_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mphb-rooms-quantity' => 'color: {{VALUE}};',
                        ],
                    ]
            );
            $element->add_control(
                    'availability_count_dropdown_border_color',
                    [
                        'label' => __('Border Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .mphb-rooms-quantity' => 'border-color: {{VALUE}};',
                        ],
                    ]
            );

            $element->end_controls_section();

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
            $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'label' => __('Typography', 'elementor'),
                        'name' => 'book_button_typography',
                        'selector' => '{{WRAPPER}} .thmv-book-button',
                    ]
            );
            $element->add_control(
                    'book_button_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .thmv-book-button' => 'color: {{VALUE}};',
                        ],
                    ]
            );
            $element->add_control(
                    'book_button_background_color',
                    [
                        'label' => __('Background', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .thmv-book-button' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                        ],
                    ]
            );

            $element->add_control(
                    'book_button_color_hover',
                    [
                        'label' => __('Color - Hover', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .thmv-book-button:hover' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
            );
            $element->add_control(
                    'book_button_background_color_hover',
                    [
                        'label' => __('Background - Hover', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .thmv-book-button:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
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
                        'condition' => [
                            'thmv_hide_booking_button' => '',
                        ],
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

        $this->update_control('thmv_data_switcher', ['default' => 'yes', 'type' => 'hidden']);
        $this->update_control('thmv_data_source', ['default' => 'mphb_room_type', 'type' => 'hidden']);
        $this->update_control('individual_mphb_room_type', ['type' => 'hidden']);
        $this->update_control('group_mphb_room_type', ['type' => 'hidden']);
        $this->update_control('order', ['default' => 'date', 'type' => 'hidden']);
        $this->update_control('thmv_data_source_image_size', ['default' => 'th_img_md_square']);
        $this->update_control('thmv_hide_link', ['default' => 'yes']);
    }

    public function beforeContentRendered() {
        echo '<div class="elementor-widget-themo-accommodation-listing mphb_sc_search_results-wrapper">';
        $this->searchResultsTopHeader();
        parent::beforeContentRendered();

    }

    public function afterContentRendered() {

        echo '</div>';
        parent::afterContentRendered();
    }

    private function searchResultsTopHeader() {

        $show_message = $this->get_settings_for_display('thmv_hide_results_message');

        if ($this->is_preview) {
            $dateObj = \DateTime::createFromFormat('d/m/Y', date("d/m/Y"));
            $this->searchParams['to_date_formatted'] = $this->searchParams['from_date_formatted'] = \MPHB\Utils\DateUtils::formatDateWPFront($dateObj);
        }

        $total = $this->getTotal(); //posts variable from parent::render
        if ($total > 0 && !(bool) $show_message) {
            ?>
            <p class="thmv-search-results-info alert" style="border-color: #e2e2e2;">
                <?php
                echo esc_html(sprintf(_n('%s accommodation found', '%s accommodations found', $total, 'motopress-hotel-booking'), $total));

                echo esc_html(sprintf(__(' from %s - till %s', 'motopress-hotel-booking'), $this->searchParams['from_date_formatted'], $this->searchParams['to_date_formatted']));
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
            if (!empty($cart_style)) {
                $cart_style = 'btn-' . $cart_style;
            }
            // Confirm Button Style
            $cart_render = str_replace(
                    'mphb-confirm-reservation',
                    'mphb-confirm-reservation btn th-btn ' . esc_attr($cart_style),
                    $cart
            );
            echo $cart_render;
        }
    }

    /** in the case of moto search results widget * */
    protected function setupSearchArguements(&$args) {
        if ($this->is_preview) {
            return;
        }
        //make the search fail by adding a non-existent id
        $args['post__in'] = ['AAAAA'];
        //if it's the search page, it will work fine
        if (function_exists('MPHB')) {
            //main functions setupMatchedRoomTypes and then getAvailableRoomTypes
            $defaultAtts = array(
                'gallery' => 'false',
                'featured_image' => 'false',
                'title' => 'false',
                'excerpt' => 'false',
                'details' => 'false',
                'price' => 'false',
                'view_button' => 'false',
                'default_sorting' => null, // "order" was by default
                'orderby' => null, // "menu_order" by default
                'order' => 'ASC',
                'meta_key' => '',
                'meta_type' => '',
                'class' => ''
            );

            $shortcode = MPHB()->getShortcodes()->getSearchResults();

            $themo_shortcode_render = $shortcode->render($defaultAtts, null, $shortcode->getName());
            //we only need ids from the html since the shortcode class doesn't give us any method to retrive the results publicly
            $count = preg_match_all('/div class="mphb-room-type post-(\d+)\s/', $themo_shortcode_render, $matches);
            if ($count && count($matches[1])) {
                $post_ids = $matches[1];
                $args['post__in'] = $post_ids;
            }
        }
    }

    protected function after_learn_more($post) {

        if ($this->get_settings_for_display('thmv_hide_booking_button') && $this->get_settings_for_display('thmv_hide_booking_price')) {
            return false;
        }

        $buttonstyle = $this->get_settings_for_display('book_button_style');
        $btn_classes = 'thmv-book-button btn th-btn';
        if (!empty($buttonstyle)) {
            $btn_classes .= ' btn-' . $buttonstyle;
        }

        if (!$this->get_settings_for_display('thmv_hide_booking_button')) {
            $this->setupResponsiveControl($this->get_settings_for_display(), 'book_button_stretch', 'book_button', 'streched');
            $class_arr = $this->get_render_attributes('book_button', 'class');
            if (!empty($class_arr)) {
                $btn_classes .= ' ' . implode(' ', $class_arr);
            }
        }

        //if preview, show the static content, else apply motopress filter
        if ($this->is_preview) {

            $maxRoomsCount = 2;
            ?>
            <?php
            $currencyCode = get_option('mphb_currency_symbol', $this->defaultCurrency);

            if (!$this->get_settings_for_display('thmv_hide_booking_price')):
                ?>
                <p class="mphb-regular-price"><?php esc_html_e('Prices start at:', 'motopress-hotel-booking') ?> <span class="mphb-price">
                        <span class="mphb-currency"><?= $currencyCode ?></span>77</span> 
                    <span class="mphb-price-period" title="<?php esc_html_e('Based on your search parameters', 'motopress-hotel-booking'); ?>">
                <?php esc_html_e('per night', 'motopress-hotel-booking') ?>
                    </span>
                </p>
                <?php
            endif;
            ?>
            <?php
            if (!$this->get_settings_for_display('thmv_hide_booking_button')):
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

                    <button class="<?php echo $btn_classes ?> button mphb-button mphb-book-button"><?php esc_html_e('Book', 'motopress-hotel-booking'); ?></button>
                </div>
                <?php
            endif;
            ?>    
            <?php
        } else {
            MPHB()->setCurrentRoomType($post);
            ob_start();

            if (!$this->get_settings_for_display('thmv_hide_booking_price')) {
                echo '<p class="mphb-regular-price">';
                echo esc_html__('Prices start at:', 'th-widget-pack') . ' ';
                mphb_tmpl_the_room_type_price_for_dates($this->searchParams['from_date'], $this->searchParams['to_date']);
                echo '</p>';
            }
            if (!$this->get_settings_for_display('thmv_hide_booking_button')) {
                do_action('mphb_sc_search_results_render_book_button');
            }
            $button_render = ob_get_clean();
            $cart_style = $this->get_settings_for_display('reservation_button_style');
            if (!empty($cart_style)) {
                $cart_style = 'btn-' . $cart_style;
            }
            // Confirm Button Style
            $button_render_final = str_replace(
                    'mphb-confirm-reservation',
                    'mphb-confirm-reservation btn th-btn ' . esc_attr($cart_style),
                    $button_render
            );
            $button_render_final = str_replace(
                    'mphb-rooms-reservation-message-wrapper',
                    'mphb-rooms-reservation-message-wrapper d-flex flex-row-reverse align-items-baseline flex-nowrap' . esc_attr($cart_style),
                    $button_render_final
            );
            echo str_replace("mphb-book-button", $btn_classes . " mphb-book-button", $button_render_final);
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Themo_Widget_Accommodation_Search());
