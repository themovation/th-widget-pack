<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Pricing extends Widget_Base {

	public function get_name() {
		return 'themo-pricing';
	}

	public function get_title() {
		return __( 'Pricing', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'elementor-pro' ),
			'sm' => __( 'Small', 'elementor-pro' ),
			'md' => __( 'Medium', 'elementor-pro' ),
			'lg' => __( 'Large', 'elementor-pro' ),
			'xl' => __( 'Extra Large', 'elementor-pro' ),
		];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_pricing',
			[
				'label' => __( 'Pricing Table', 'elementor' ),
			]
		);

		$this->add_control(
			'pricing',
			[
				'label' => __( 'Pricing Table', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'url' => 'http://your-link.com'
					]
				],
				'fields' => [
					[
						'name' => 'price_col_title',
						'label' => __( 'Title', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( '1 hour tour', 'elementor' ),
                        'placeholder' => __( '1 hour tour', 'elementor' ),
						'label_block' => true,
					],
                    [
                        'name' => 'price_col_sub_title',
                        'label' => __( 'Sub Title', 'elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '3 People +', 'elementor' ),
                        'placeholder' => __( '3 People +', 'elementor' ),
                        'label_block' => true,
                    ],
					[
						'name' => 'price_col_price',
						'label' => __( 'Price', 'elementor' ),
						'type' => Controls_Manager::TEXT,
                        'default' => __( '$99', 'elementor' ),
                        'placeholder' => __( '$99', 'elementor' ),
						'label_block' => true,
					],
					[
						'name' => 'price_col_text',
						'label' => __( 'Price text', 'elementor' ),
						'type' => Controls_Manager::TEXT,
                        'default' => __( '/person', 'elementor' ),
                        'placeholder' => __( '/person', 'elementor' ),
						'label_block' => true,
					],
					[
						'name' => 'price_col_description',
						'label' => __( 'Description', 'elementor' ),
						'type' => Controls_Manager::TEXTAREA,
                        'default' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'elementor' ),
						'placeholder' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'elementor' ),
						'label_block' => true,
					],
                    [
                        'name' => 'price_col_button_1_show',
                        'label' => __( 'Button 1', 'elementor' ),
                        'default' => 'yes',
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'elementor' ),
                        'label_off' => __( 'No', 'elementor' ),
                        'return_value' => 'yes',
                        'separator' => 'before',
                    ],
					[
						'name' => 'price_col_button_1_text',
						'label' => __( 'Button 1 Text', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'BOOK THIS TOUR', 'elementor' ),
						'placeholder' => __( 'BOOK THIS TOUR', 'elementor' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
					],
                    [
                        'name' => 'price_col_button_1_style',
                        'label' => __( 'Button 1 Style', 'elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'cta-accent',
                        'options' => [
                            'standard-primary' => __( 'Standard Primary', 'elementor' ),
                            'standard-accent' => __( 'Standard Accent', 'elementor' ),
                            'standard-light' => __( 'Standard Light', 'elementor' ),
                            'standard-dark' => __( 'Standard Dark', 'elementor' ),
                            'ghost-primary' => __( 'Ghost Primary', 'elementor' ),
                            'ghost-accent' => __( 'Ghost Accent', 'elementor' ),
                            'ghost-light' => __( 'Ghost Light', 'elementor' ),
                            'ghost-dark' => __( 'Ghost Dark', 'elementor' ),
                            'cta-primary' => __( 'CTA Primary', 'elementor' ),
                            'cta-accent' => __( 'CTA Accent', 'elementor' ),
                        ],
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_1_icon',
                        'label' => __( 'Button 1 Icon', 'elementor' ),
                        'type' => Controls_Manager::ICON,
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
					[
						'name' => 'price_col_button_1_link',
						'label' => __( 'Button 1 Link', 'elementor' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'http://your-link.com', 'elementor' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
					],
                    [
                        'name' => 'price_col_button_1_div',
                        'type' => Controls_Manager::DIVIDER,
                    ],
                    [
                        'name' => 'price_col_button_2_show',
                        'label' => __( 'Button 2', 'elementor' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'elementor' ),
                        'label_off' => __( 'No', 'elementor' ),
                        'return_value' => 'yes',
                        'default' => '',
                        'separator' => 'before',
                    ],
                    [
                        'name' => 'price_col_button_2_text',
                        'label' => __( 'Button 2 Text', 'elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Click Here', 'elementor' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_2_style',
                        'label' => __( 'Button 2 Style', 'elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'standard-primary',
                        'options' => [
                            'standard-primary' => __( 'Standard Primary', 'elementor' ),
                            'standard-accent' => __( 'Standard Accent', 'elementor' ),
                            'standard-light' => __( 'Standard Light', 'elementor' ),
                            'standard-dark' => __( 'Standard Dark', 'elementor' ),
                            'ghost-primary' => __( 'Ghost Primary', 'elementor' ),
                            'ghost-accent' => __( 'Ghost Accent', 'elementor' ),
                            'ghost-light' => __( 'Ghost Light', 'elementor' ),
                            'ghost-dark' => __( 'Ghost Dark', 'elementor' ),
                            'cta-primary' => __( 'CTA Primary', 'elementor' ),
                            'cta-accent' => __( 'CTA Accent', 'elementor' ),
                        ],
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_2_icon',
                        'label' => __( 'Button 2 Icon', 'elementor' ),
                        'type' => Controls_Manager::ICON,
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_2_link',
                        'label' => __( 'Button 2 Link', 'elementor' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __( 'http://your-link.com', 'elementor' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_2_div',
                        'type' => Controls_Manager::DIVIDER,
                    ],
                    [
                        'name' => 'price_col_featured',
                        'label' => __( 'Featured', 'elementor' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'elementor' ),
                        'label_off' => __( 'No', 'elementor' ),
                        'return_value' => 'yes',
                        'default' => '',
                        'separator' => 'before',
                    ],
                    [
                        'name' => 'price_col_background',
                        'label' => __( 'Background Color', 'elementor' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#54595f',
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                        ],
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_featured',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
				],
				'title_field' => '{{{ price_col_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-pricing-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-pricing-title',
			]
		);*/

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-cost' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Price Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-pricing-cost',
			]
		);*/

		$this->add_control(
			'price_text_color',
			[
				'label' => __( 'Price Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-cost span' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_text_typography',
				'label' => __( 'Price Text Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-pricing-cost span',
			]
		);*/

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-features ul li' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-pricing-features ul li',
			]
		);*/

		/*$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button_1',
			[
				'label' => __( 'Button 1', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size_1',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_control( 'button_color_1',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1' => 'color: {{VALUE}}; border-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography_1',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .th-button-1',
			]
		);

		$this->add_control(
			'button_border_width_1',
			[
				'label' => __( 'Border Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-button-1' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);

		$this->add_control(
			'button_border_radius_1',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-button-1' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'button_1_tabs' );

		$this->start_controls_tab( 'normal_1', [ 'label' => __( 'Normal', 'elementor' ) ] );

		$this->add_control(
			'button_text_color_1',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color_1',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color_1',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover_1', [ 'label' => __( 'Hover', 'elementor' ) ] );

		$this->add_control(
			'button_hover_text_color_1',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color_1',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color_1',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-1:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button_2',
			[
				'label' => __( 'Button 2', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size_2',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_control( 'button_color_2',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2' => 'color: {{VALUE}}; border-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography_2',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .th-button-2',
			]
		);

		$this->add_control(
			'button_border_width_2',
			[
				'label' => __( 'Border Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-button-2' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);

		$this->add_control(
			'button_border_radius_2',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-button-2' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'button_2_tabs' );

		$this->start_controls_tab( 'normal_2', [ 'label' => __( 'Normal', 'elementor' ) ] );

		$this->add_control(
			'button_text_color_2',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color_2',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color_2',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover_2', [ 'label' => __( 'Hover', 'elementor' ) ] );

		$this->add_control(
			'button_hover_text_color_2',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color_2',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color_2',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-button-2:hover' => 'border-color: {{VALUE}};',
				],
			]
		);*/

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_featured',
			[
				'label' => __( 'Featured', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'featured_title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'featured_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .th-highlight .th-pricing-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'featured_title_typography',
				'label' => __( 'Title Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-highlight .th-pricing-title',
			]
		);*/

		$this->add_control(
			'featured_price_color',
			[
				'label' => __( 'Price Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-cost' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'featured_price_typography',
				'label' => __( 'Price Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-highlight .th-pricing-cost',
			]
		);*/

		$this->add_control(
			'featured_price_text_color',
			[
				'label' => __( 'Price Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-cost span' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'featured_price_text_typography',
				'label' => __( 'Price Text Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-highlight .th-pricing-cost span',
			]
		);*/

		$this->add_control(
			'featured_description_color',
			[
				'label' => __( 'Description Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-features ul li' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'featured_description_typography',
				'label' => __( 'Description Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-highlight .th-pricing-features ul li',
			]
		);*/

		$this->end_controls_section();

		/*$this->start_controls_section(
			'section_style_featured_button_1',
			[
				'label' => __( 'Featured Button 1', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'featured_button_size_1',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_control( 'featured_button_color_1',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1' => 'color: {{VALUE}}; border-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'featured_button_typography_1',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .th-highlight .th-button-1',
			]
		);

		$this->add_control(
			'featured_button_border_width_1',
			[
				'label' => __( 'Border Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);

		$this->add_control(
			'featured_button_border_radius_1',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'featured_button_1_tabs' );

		$this->start_controls_tab( 'featured_normal_1', [ 'label' => __( 'Normal', 'elementor' ) ] );

		$this->add_control(
			'featured_button_text_color_1',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_background_color_1',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_border_color_1',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'featured_hover_1', [ 'label' => __( 'Hover', 'elementor' ) ] );

		$this->add_control(
			'featured_button_hover_text_color_1',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_hover_background_color_1',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_hover_border_color_1',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-1:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_featured_button_2',
			[
				'label' => __( 'Featured Button 2', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'featured_button_size_2',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_control( 'featured_button_color_2',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2' => 'color: {{VALUE}}; border-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'featured_button_typography_2',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .th-highlight .th-button-2',
			]
		);

		$this->add_control(
			'featured_button_border_width_2',
			[
				'label' => __( 'Border Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);

		$this->add_control(
			'featured_button_border_radius_2',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'featured_button_2_tabs' );

		$this->start_controls_tab( 'featured_normal_2', [ 'label' => __( 'Normal', 'elementor' ) ] );

		$this->add_control(
			'featured_button_text_color_2',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_background_color_2',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_border_color_2',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'featured_hover_2', [ 'label' => __( 'Hover', 'elementor' ) ] );

		$this->add_control(
			'featured_button_hover_text_color_2',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_hover_background_color_2',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_button_hover_border_color_2',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-button-2:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_section();*/
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['pricing'] ) ) {
			return;
		}

		$column_number = sizeof( $settings['pricing'] );

		switch( $column_number ) {
			case 1:
				$table_class = ' th-one-col';
				$column_class = ' col-sm-6 col-sm-offset-3';
				break;
			case 2:
				$table_class = ' th-two-col';
				$column_class = ' col-sm-6';
				break;
			case 3:
				$table_class = ' th-three-col';
				$column_class = ' col-md-4 col-sm-6';
				break;
			case 4:
				$table_class = ' th-four-col';
				$column_class = ' col-md-3 col-sm-6';
				break;
			case 5:
				$table_class = ' th-five-col';
				$column_class = ' col-md-2 col-sm-6';
				break;
			case 6:
				$table_class = ' th-six-col';
				$column_class = ' col-md-2 col-sm-6';
				break;
			default:
				$table_class = '';
				$column_class = '';
		}
		?>

		<div class="th-pricing-table<?php echo $table_class; ?>">

			<div class="row">

				<?php foreach( $settings['pricing'] as $column ) { ?>

					<?php if ( ! $column['price_col_featured'] ) : ?>
						<?php if ( ! empty( $settings['button_size_1'] ) ) {
							$this->add_render_attribute( 'th-button-1', 'class', 'th-button-size-' . $settings['button_size_1'] );
						} ?>
						<?php if ( ! empty( $settings['button_size_2'] ) ) {
							$this->add_render_attribute( 'th-button-2', 'class', 'th-button-size-' . $settings['button_size_2'] );
						} ?>
					<?php else : ?>
						<?php if ( ! empty( $settings['featured_button_size_1'] ) ) {
							$this->add_render_attribute( 'th-button-1', 'class', 'th-button-size-' . $settings['featured_button_size_1'] );
						} ?>
						<?php if ( ! empty( $settings['featured_button_size_2'] ) ) {
							$this->add_render_attribute( 'th-button-2', 'class', 'th-button-size-' . $settings['featured_button_size_2'] );
						} ?>
					<?php endif; ?>

					<div class="elementor-repeater-item-<?php echo $column['_id'] ?> th-pricing-column<?php echo( $column['price_col_featured'] ? ' th-highlight' : '' ); echo $column_class; ?>">


                    <?php if ( isset( $column['price_col_title'] ) && ! empty( $column['price_col_title'] ) ) : ?>
						<div class="th-pricing-title"><?php echo esc_html( $column['price_col_title'] ); ?></div>
                    <?php endif; ?>

                    <?php if ( isset( $column['price_col_sub_title'] ) && ! empty( $column['price_col_sub_title'] ) ) : ?>
                        <div class="th-pricing-sub-title"><?php echo esc_html( $column['price_col_sub_title'] ); ?></div>
                    <?php endif; ?>

                    <?php if ( (isset( $column['price_col_price'] ) && ! empty( $column['price_col_price'] )) || (isset( $column['price_col_price'] ) && ! empty( $column['price_col_price'] )))  : ?>
                        <div class="th-pricing-cost">
                            <?php echo esc_html( $column['price_col_price'] ); ?>
                            <span><?php echo esc_html( $column['price_col_text'] ); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ( isset( $column['price_col_description'] ) && ! empty( $column['price_col_description'] ) ) : ?>
						<div class="th-pricing-features">
							<ul>
								<?php echo '<li>'.str_replace( array( "\r", "\n\n", "\n" ), array( '', "\n", "</li>\n<li>" ), trim( $column['price_col_description'] , "\n\r" ) ).'</li>'; ?>
							</ul>
						</div>
                    <?php endif; ?>

						<?php if ( ! empty( $column['price_col_button_1_text'] ) || ! empty( $column['price_col_button_2_text'] ) ) : ?>
							<div class="th-btn-wrap">
                                <?php if (isset($column['price_col_button_1_show']) && $column['price_col_button_1_show'] == 'yes') : ?>
                                    <?php $target = $column['price_col_button_1_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                    <?php $button_style = 'btn-' . $column['price_col_button_1_style']; ?>
                                    <?php echo '<a class="btn th-btn th-button th-button-1 ' . $button_style . '" href="' . $column['price_col_button_1_link']['url'] . '"' . $target . '>'; ?>
                                    <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                        <?php echo esc_html( $column['price_col_button_1_text']) ?>
                                    <?php endif;?>
                                    <?php echo '</a>'; ?>
                                <?php endif; ?>
                                <?php if (isset($column['price_col_button_2_show']) && $column['price_col_button_2_show'] == 'yes') : ?>
                                    <?php $target = $column['price_col_button_2_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                    <?php $button_style = 'btn-' . $column['price_col_button_2_style']; ?>
                                    <?php echo '<a class="btn th-btn th-button th-button-2 ' . $button_style . '" href="' . $column['price_col_button_2_link']['url'] . '"' . $target . '>'; ?>
                                    <?php if ( ! empty( $column['price_col_button_2_text'] ) ) : ?>
                                        <?php echo esc_html( $column['price_col_button_2_text']) ?>
                                    <?php endif;?>
                                    <?php echo '</a>'; ?>
                                <?php endif; ?>
							</div>
						<?php endif; ?>

					</div>

				<?php } ?>

			</div>

		</div>

		<script>
			jQuery( function ( $ ) {
				// Adjust Pricing Table Height
				//themo_adjust_pricing_table_height();
			} );
		</script>

		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Pricing() );
