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

        $styles = '.elementor-widget-' . $key . ' .elementor-swiper-button{'
                . 'transform: none;-webkit-transform: none;-ms-transform: none;'
                . '}'
                . '.elementor-widget-' . $key . ' .elementor-row.swiper-wrapper{'
                . '-ms-flex-wrap: nowrap !important;flex-wrap: nowrap !important;'
                . '}'
                . '.elementor-widget-' . $key . ' .elementor-row.swiper-wrapper .swiper-slide.thmv-column{'
                . 'max-width:100%;'
                . '}'
                . '.elementor-widget-' . $key . ' .swiper-slide{'
                . 'text-align:left;'
                . '}'
                . '.elementor-widget-' . $key . ' .mphb-empty-cart-message'
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
            $element->add_control(
                    'thmv_slider_heading',
                    [
                        'label' => __('Slider', 'elementor'),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
            );
            $element->add_control(
                    'thmv_slider_active',
                    [
                        'label' => __('Active', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'th-widget-pack'),
                        'label_off' => __('No', 'th-widget-pack'),
                        'default' => '',
                        'description' => __('Make sure to set the columns at the top, default option might not work as expected.', 'th-widget-pack')
                    ]
            );
        }, 10, 2);
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

            $element->start_controls_section(
                    'thmv_style_section_slider',
                    [
                        'label' => __('Slider', 'th-widget-pack'),
                        'tab' => Controls_Manager::TAB_STYLE,
                        'condition' => [
                            'thmv_slider_active!' => '',
                        ],
                    ]
            );

            $element->add_control(
                    'thmv_slider_icon_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .accommodation-top-navigation .elementor-swiper-button' => 'color: {{VALUE}};',
                        ],
                    ]
            );

            $element->add_responsive_control(
                    'tthmv_slider_icon_size',
                    [
                        'label' => __('Size', 'elementor'),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .accommodation-top-navigation .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                    ]
            );
            $element->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'thmv_slider_navigation_border',
                        'label' => esc_html__('Border', 'elementor'),
                        'selector' => '{{WRAPPER}} .accommodation-top-navigation .elementor-swiper-button',
                        'fields_options' => [
                            'border' => [
                                'default' => 'solid',
                            ],
                            'width' => [
                                'default' => [
                                    'top' => '2',
                                    'right' => '2',
                                    'bottom' => '2',
                                    'left' => '2',
                                    'isLinked' => true,
                                ],
                            ],
                        ]
                    ]
            );

            $element->add_control(
                    'thmv_slider_navigation_border_radius',
                    [
                        'label' => esc_html__('Border Radius', 'elementor'),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => ['%', 'px'],
                        'default' => [
                            'unit' => '%',
                            'size' => '50',
                        ],
                        'range' => [
                            '%' => [
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .accommodation-top-navigation .elementor-swiper-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ],
                    ]
            );
            $element->add_control(
                    'thmv_slider_navigation_margin_between',
                    [
                        'label' => __('Arrows Spacing', 'th-widget-pack'),
                        'type' => Controls_Manager::SLIDER,
                        'default' => [
                            'size' => 15,
                        ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                                'step' => 1,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .accommodation-top-navigation .elementor-swiper-button+.elementor-swiper-button' => 'margin-left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
            );
            $element->add_control(
                    'thmv_slider_view_all_heading',
                    [
                        'label' => __('View All', 'th-widget-pack'),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
            );
            $element->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'label' => __('Typography', 'elementor'),
                        'name' => 'thmv_slider_view_all_typography',
                        'selector' => '{{WRAPPER}} .accommodation-view-all',
                    ]
            );
            $element->add_control(
                    'thmv_slider_view_all_color',
                    [
                        'label' => __('Color', 'th-widget-pack'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .accommodation-view-all' => 'color: {{VALUE}};',
                        ],
                    ]
            );
            $element->add_control(
                    'thmv_slider_navigation_margin',
                    [
                        'label' => __('Margin Bottom', 'th-widget-pack'),
                        'type' => Controls_Manager::SLIDER,
                        'default' => [
                            'size' => 15,
                        ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                                'step' => 1,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .accommodation-top-navigation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

//        $this->set_render_attribute('_wrapper', 'class', 'elementor-widget-'.$parent_name);
    }

    public function beforeContentRendered() {
        $is_carousel_active = $this->get_settings_for_display('thmv_slider_active');
        $total = isset($this->totalAccommodations) ? $this->totalAccommodations : 0;

        if (!$is_carousel_active || !$total) {
            return;
        }

        $columns_desktop = (INT) $this->get_settings_for_display('columns') ? $this->get_settings_for_display('columns') : 2;
        $columns_tablet = (INT) $this->get_settings_for_display('columns_tablet') ? $this->get_settings_for_display('columns_tablet') : $columns_desktop;
        $columns_mobile = (INT) $this->get_settings_for_display('columns_mobile') ? $this->get_settings_for_display('columns_mobile') : 1;

        $sliderSettings = '{"slides_to_show":"' . $columns_desktop . '", "slides_to_show_mobile": "' . $columns_mobile . '", "slides_to_show_tablet": "' . $columns_tablet . '",  "slides_to_scroll":"1","navigation":"arrows","autoplay":"no","infinite":"no","speed":500}';
        echo '<div '
        . 'data-widget_type="image-carousel.default" '
        . 'data-settings=\'' . $sliderSettings . '\' '
        . 'data-element_type="widget" '
        . 'class="elementor-element  elementor-arrows-position-inside elementor-widget elementor-widget-image-carousel">'
        . '<div '
        . 'class="elementor-image-carousel-wrapper swiper-container" '
        . 'dir="ltr">';
        ?>
        <div class="accommodation-top-navigation d-flex justify-content-end align-items-center" style="padding: 0 10px;">
            <div class="accommodation-view-all"><?php _e('View All (' . $total . ')', 'th-widget-pack'); ?>&nbsp;</div>
            <div class="thmv-accommodation-arrows-container d-flex justify-content-end align-items-center position-relative">
                <div class="elementor-swiper-button elementor-swiper-button-prev position-static">
                    <i class="eicon-chevron-left" aria-hidden="true"></i>
                    <span class="elementor-screen-only"><?php _e('Previous', 'elementor'); ?></span>
                </div>
                <div class="elementor-swiper-button elementor-swiper-button-next position-static">
                    <i class="eicon-chevron-right" aria-hidden="true"></i>
                    <span class="elementor-screen-only"><?php _e('Next', 'elementor'); ?></span>
                </div>
            </div>
        </div>

        <?php
    }

    public function afterContentRendered() {
        $is_carousel_active = $this->get_settings_for_display('thmv_slider_active');
        $total = isset($this->totalAccommodations) ? $this->totalAccommodations : 0;
        if (!$is_carousel_active || !$total) {
            return;
        }

        echo '</div></div>';
    }

    protected function render() {

        //check for carousel
        $is_carousel_active = $this->get_settings_for_display('thmv_slider_active');
        if ($is_carousel_active) {
            $this->add_render_attribute('thmv_wrapper', 'class', 'elementor-image-carousel swiper-wrapper');
            $this->add_render_attribute('thmv_column', 'class', 'swiper-slide');
        }


        $parent_name = parent::get_name();
        ob_start();
        parent::render();
        $results = ob_get_clean();

        $show_message = $this->get_settings_for_display('thmv_hide_results_message');
        $total = isset($this->totalAccommodations) ? $this->totalAccommodations : 0; //posts variable from parent::render
        //set class of the parent widget so the CSS works
        echo '<div class="elementor-widget-' . $parent_name . ' mphb_sc_search_results-wrapper">';
        if ($this->is_preview) {
            $dateObj = \DateTime::createFromFormat('d/m/Y', date("d/m/Y"));
            $this->searchParams['to_date_formatted'] = $this->searchParams['from_date_formatted'] = \MPHB\Utils\DateUtils::formatDateWPFront($dateObj);
        }
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


        echo $results;
        echo '</div>';
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
            $btn_classes .= ' ' . implode(' ', $class_arr);
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
