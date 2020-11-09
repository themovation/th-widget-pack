<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Search_Results extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-search-results';
    }

    public function get_title() {
        return __( 'Availability Search Results', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_counter_block',
            [
                'label' => __( 'Information Section', 'th-widget-pack' ),
            ]
        );

        $this->add_control('counter_text', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Section', 'th-widget-pack'),
            'description' => __('Displays above Recommendation Section. Example: "2 accommodations found from [Start Date] - till [End Date]', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .mphb_sc_search_results-info' => 'display:none',
            ],
            'default' => '',
        ));


        $this->end_controls_section();

        $this->start_controls_section(
            'section_recommendation_block',
            [
                'label' => __( 'Recommendation Section', 'th-widget-pack' ),
            ]
        );

        $this->add_control('recommendation_content', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Section', 'th-widget-pack'),
            'description' => __('Displays above Search Results. It recommends the best set of accommodations according to a number of guests in a list.', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .themo_mphb_search_recommend_wrapper' => 'display:none',
            ],
            'default' => '',
        ));

        $this->add_control('recommendation_title', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Title', 'th-widget-pack'),
            //'description' => __('Whether to display title of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .mphb-recommendation-title' => 'display:none',
            ],
            'default' => '',
            'condition' => [
                'recommendation_content' => '',
            ],
        ));



        $this->end_controls_section();

        $this->start_controls_section(
            'section_reservation_details_block',
            [
                'label' => __( 'Reservation Details & Cart', 'th-widget-pack' ),
            ]
        );

        $this->add_control('cart_empty', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Hide Empty Cart Message', 'th-widget-pack'),
            //'description' => __('Displays above Search Results. It recommends the best set of accommodations according to a number of guests in a list.', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .mphb-empty-cart-message' => 'display:none',
            ],
            'default' => '',
        ));

        $this->end_controls_section();

        $this->start_controls_section(
            'section_search_results',
            [
                'label' => __( 'Search Results', 'th-widget-pack' ),
            ]
        );

        $this->add_control('title', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Title', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ));

        $this->add_control('featured_image', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Featured image', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('gallery', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Gallery', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('excerpt', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Excerpt', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('details', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Details', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control(
            'show_icon_titles',
            [
                'label' => __( 'Icon Titles', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default' => '',
                'mobile_default'=> '',
                'label_on' => __( 'Show', 'th-widget-pack' ),
                'label_off' => __( 'Hide', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-title' => 'display: inherit;'
                ],
            ]
        );

        $this->add_control('price', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Price', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('view_button', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('View Link', 'th-widget-pack'),
            //'description' => __('Whether to display "View Details" button with the link to accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));


        $this->end_controls_section();

        $this->start_controls_section('section_order', array(
            'label'       => __('Order', 'th-widget-pack')
        ));

        $this->add_control('orderby', array(
            'type'        => Controls_Manager::SELECT,
            'label'       => __('Order By', 'th-widget-pack'),
            'default'     => 'menu_order',
            'options'     => array(
                'none'           => __('No order', 'th-widget-pack'),
                'title'          => __('Post title', 'th-widget-pack'),
                'name'           => __('Post name (post slug)', 'th-widget-pack'),
                'date'           => __('Post date', 'th-widget-pack'),
                'rand'           => __('Random order', 'th-widget-pack'),
                'menu_order'     => __('Page order', 'th-widget-pack'),
                'post__in'       => __('Price', 'th-widget-pack')
            )
        ));

        $this->add_control('order', array(
            'type'        => Controls_Manager::SELECT,
            'label'       => __('Order', 'th-widget-pack'),
            'default'     => 'ASC',
            'options'     => array(
                'ASC'            => __('Ascending (1,2,3)', 'th-widget-pack'),
                'DESC'           => __('Descending (3,2,1)', 'th-widget-pack')
            )
        ));

        $this->end_controls_section();


        $this->start_controls_section(
            'section_counter_block_style',
            [
                'label' => __( 'Information Section', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'important_note',
            [
                //'label' => __( 'Note', 'th-widget-pack' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( '<p style="line-height: 17px;">Displays above Recommendation Section. Example: "2 accommodations found from [Start Date] - till [End Date]</p>', 'th-widget-pack' ),
                'content_classes' => 'themo-elem-html-control',
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => __( 'Colour', 'th-widget-pack' ),
                //'description' => __('Displays above Recommendation Section. Example: "2 accommodations found from [Start Date] - till [End Date]', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_search_results-info' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_color_typography',
                'selector' => '{{WRAPPER}} .mphb_sc_search_results-info',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,

            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'default'=>'left',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-right',
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_search_results-info' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_recommendation_block_style',
            [
                'label' => __( 'Recommendation Section', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'important_note_2',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( '<p style="line-height: 17px;">Displays above Search Results. It recommends the best set of accommodations according to a number of guests in a list.</p>', 'th-widget-pack' ),
                'content_classes' => 'themo-elem-html-control',
            ]
        );

        $this->add_control(
            'recommendation_heading_color',
            [
                'label' => __( 'Heading', 'th-widget-pack' ),
                //'description' => __('Displays above Recommendation Section. Example: "2 accommodations found from [Start Date] - till [End Date]', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} h2.mphb-recommendation-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'recommendation_heading_typography',
                'selector' => '{{WRAPPER}} h2.mphb-recommendation-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );


        $this->add_control(
            'recommendation_list_color',
            [
                'label' => __( 'Text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.mphb-recommendation-details-list li' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,
                'separator' => 'before',

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'recommendation_list_typography',
                'selector' => '{{WRAPPER}} ul.mphb-recommendation-details-list li',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'recommendation_price_color',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-recommendation-total-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,
                'separator' => 'before',

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'recommendation_price_typography',
                'selector' => '{{WRAPPER}} .mphb-recommendation-total-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'button_reserve_style',
            [
                'label' => __( 'Reserve Button', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-primary',
                'options' => [
                    'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
                    'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
                    'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
                    'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
                    'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
                    'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
                    'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
                    'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
                    'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
                    'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_reservation_details_style',
            [
                'label' => __( 'Reservation Details & Cart', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cart_text_color',
            [
                'label' => __( 'Cart Text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-cart-message' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cart_text_typography',
                'selector' => '{{WRAPPER}} .mphb-cart-message',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'cart_price_color',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-cart-total-price' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,
                'separator' => 'before',

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cart_price_typography',
                'selector' => '{{WRAPPER}} .mphb-cart-total-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'button_confirm_style',
            [
                'label' => __( 'Confirm Button', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-primary',
                'options' => [
                    'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
                    'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
                    'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
                    'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
                    'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
                    'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
                    'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
                    'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
                    'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
                    'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
                ],
                'separator' => 'before'
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_search_results_style',
            [
                'label' => __( 'Search Results', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mphb-room-type-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'excerpt_details_color',
            [
                'label' => __( 'Excerpt', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type p' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'label_block'=>true,
                'separator' => 'before'

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_details_typography',
                'selector' => '{{WRAPPER}} .mphb-room-type p',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        // DETAILS

        $this->add_control(
            'icon_details_color',
            [
                'label' => __( 'Attribute Icon', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li:before' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_details_typography',
                'label' => __( 'Size', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li:before',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'exclude' => [ 'font_family','font_weight','text_transform','font_style','text_decoration','letter_spacing'],
            ]
        );


        $this->add_control(
            'icon_title_color',
            [
                'label' => __( 'Attribute Title', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'show_icon_titles' => 'yes',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_title_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'show_icon_titles' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'value_details_color',
            [
                'label' => __( 'Attribute Value', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-value' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'value_details_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-value',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'value_details_link_color',
            [
                'label' => __( 'Attribute Link', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-value a,
                    {{WRAPPER}} .mphb-room-type .mphb-loop-room-type-attributes li .mphb-attribute-value a:link' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );

        $this->add_control(
            'search_result_price_description_color',
            [
                'label' => __( 'Price Description', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-regular-price' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_result_price_description_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .mphb-room-type .mphb-regular-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'search_result_price_color',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-regular-price .mphb-price' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_result_price_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .mphb-room-type .mphb-regular-price .mphb-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'search_result_view_link_color',
            [
                'label' => __( 'View Link', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-room-type .mphb-view-details-button' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_result_view_link_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .mphb-room-type .mphb-view-details-button',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'button_book_style',
            [
                'label' => __( 'Book Button', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-primary',
                'options' => [
                    'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
                    'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
                    'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
                    'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
                    'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
                    'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
                    'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
                    'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
                    'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
                    'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
        // Button styles

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $atts = $this->get_settings_for_display();


            $themo_form_styling = false;
            if ( function_exists( 'get_theme_mod' ) ) {
                $themo_mphb_styling = get_theme_mod('themo_mphb_use_theme_styling', true);
                if ($themo_mphb_styling == true) {
                    $themo_form_styling = $this->get_render_attribute_string( 'th-form-class');
                }
            }
            ?>
            <div <?php echo $themo_form_styling; ?>>
                <?php
                do_action('mphbe_before_search_results_widget_render', $atts);

                $shortcode = MPHB()->getShortcodes()->getSearchResults();

                $themo_shortcode_render = $shortcode->render($atts, null, $shortcode->getName());

                // Wrapper
                $themo_shortcode_render = str_replace(
                    'mphb_sc_search_results-wrapper',
                    'mphb_sc_search_results-wrapper frm_forms with_frm_style',
                    $themo_shortcode_render
                );

                // Book Button Style
                $themo_shortcode_render = str_replace(
                    'mphb-book-button',
                    'mphb-book-button btn th-btn btn-'.esc_attr( $settings['button_book_style']),
                    $themo_shortcode_render
                );

                // Reserve Button Style
                $themo_shortcode_render = str_replace(
                    'mphb-recommendation-reserve-button',
                    'mphb-recommendation-reserve-button btn th-btn btn-'.esc_attr( $settings['button_reserve_style']),
                    $themo_shortcode_render
                );

                // Confirm Button Style
                $themo_shortcode_render = str_replace(
                    'mphb-confirm-reservation',
                    'mphb-confirm-reservation btn th-btn btn-'.esc_attr( $settings['button_confirm_style']),
                    $themo_shortcode_render
                );

                // Dropdowns
                $themo_shortcode_render = str_replace(
                    'mphb-reserve-room-section',
                    'mphb-reserve-room-section frm_form_field',
                    $themo_shortcode_render
                );

                echo $themo_shortcode_render;

                do_action('mphbe_after_search_results_widget_render', $atts);
                ?>
            </div>
            <?php
        //}
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Search_Results() );
