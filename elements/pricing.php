<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Pricing extends Widget_Base {

	public function get_name() {
		return 'themo-pricing';
	}

	public function get_title() {
		return __( 'Pricing', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
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
				'label' => __( 'Pricing Table', 'th-widget-pack' ),
			]
		);

        $repeater = new Repeater();

        $this->add_repeater_controls( $repeater );

        $this->add_control(
            'pricing',
            [
                'label' => __( 'Pricing Table', 'elementor-pro' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => $this->get_repeater_defaults(),
                'separator' => 'after',
                'title_field' => '{{{ price_col_title }}}',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'section_title_heading',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .th-pricing-title',
            ]
        );

        $this->add_control(
            'section_sub_title_heading',
            [
                'label' => __( 'Subtitle', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_sub_title_typography',
                'selector' => '{{WRAPPER}} .th-pricing-sub-title',
            ]
        );

        $this->add_control(
            'section_price_heading',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_price_typography',
                'selector' => '{{WRAPPER}} .th-pricing-cost',
            ]
        );

        $this->add_control(
            'section_price_text_heading',
            [
                'label' => __( 'Price Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'price_text_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_price_text_typography',
                'selector' => '{{WRAPPER}} .th-pricing-cost span',
            ]
        );

        $this->add_control(
            'section_description_heading',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .th-pricing-features ul li',
            ]
        );

        $this->add_control(
            'section_divider_heading',
            [
                'label' => __( 'Divider', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-pricing-table ul li ' => 'border-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_featured',
			[
				'label' => __( 'Featured', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'section_featured_title_heading',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'featured_title_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_featured_title_typography',
                'selector' => '{{WRAPPER}} .th-highlight .th-pricing-title',
            ]
        );

        $this->add_control(
            'section_featured_sub_title_heading',
            [
                'label' => __( 'Subtitle', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'featured_sub_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-highlight .th-pricing-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_featured_sub_title_typography',
                'selector' => '{{WRAPPER}} .th-highlight .th-pricing-sub-title',
            ]
        );

        $this->add_control(
            'section_featured_price_heading',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'featured_price_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-cost' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_featured_price_typography',
                'selector' => '{{WRAPPER}} .th-highlight .th-pricing-cost',
            ]
        );

        $this->add_control(
            'section_featured_price_text_heading',
            [
                'label' => __( 'Price Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'featured_price_text_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-cost span' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_featured_price_text_typography',
                'selector' => '{{WRAPPER}} .th-highlight .th-pricing-cost span',
            ]
        );

        $this->add_control(
            'section_featured_desc_heading',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'featured_description_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-features ul li' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_featured_description_typography',
                'selector' => '{{WRAPPER}} .th-highlight .th-pricing-features ul li',
            ]
        );

        $this->add_control(
            'section_featured_divider_heading',
            [
                'label' => __( 'Divider', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'featured_divider_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-pricing-column.th-highlight ul li' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_border',
            [
                'label' => __( 'Border', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pricing_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pricing-column' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
	}

    protected function add_repeater_controls( Repeater $repeater ) {
        $repeater->add_control(

            'price_col_title',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Price 1', 'th-widget-pack' ),
                'label_block' => true,
                'default' => __( 'Title' , 'th-widget-pack' ),
                'dynamic' => [
                        'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'price_col_sub_title',
            [
                'label' => __( 'Sub Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Sub Title', 'th-widget-pack' ),
                'placeholder' => __( 'Sub Title', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'price_col_price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$99', 'th-widget-pack' ),
                'placeholder' => __( '$99', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'price_col_text',
            [
                'label' => __( 'Price text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( '/each', 'th-widget-pack' ),
                'default' => __( '/each', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
        'price_col_description',
        [
            'label' => __( 'Description', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __( "Maecenas tristique\nUllamcorper mauris\nElementum tortor\nClass aptent", 'th-widget-pack' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
            'default' => __( "Maecenas tristique\nUllamcorper mauris\nElementum tortor\nClass aptent", 'th-widget-pack' ),
        ]
        );

        $repeater->add_control(
        'price_col_button_1_show',
        [
            'label' => __( 'Button 1', 'th-widget-pack' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'th-widget-pack' ),
            'label_off' => __( 'No', 'th-widget-pack' ),
            'return_value' => 'yes',
            'separator' => 'before',
            'default' => 'yes'
        ]
        );

        $repeater->add_control(
        'price_col_button_1_text',
        [
            'label' => __( 'Button 1 Text', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'BUTTON TEXT', 'th-widget-pack' ),
            'default' => __( 'BUTTON TEXT', 'th-widget-pack' ),
            'dynamic' => [
                'active' => true,
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
        ]
        );

        $repeater->add_control(
        'price_col_button_1_style',
        [
            'label' => __( 'Button 1 Style', 'th-widget-pack' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'ghost-primary',
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
            'conditions' => [
                'terms' => [
                    [
                    'name' => 'price_col_button_1_show',
                    'operator' => '==',
                    'value' => 'yes',
                    ],
                ],
            ],
        ]
        );

        $repeater->add_control(
        'button_1_image',
            [
                'label' => __( 'Button Graphic', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
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
        ]
        );

        $repeater->add_control(
        'price_col_button_1_link',
            [
            'label' => __( 'Button 1 Link', 'th-widget-pack' ),
            'type' => Controls_Manager::URL,
            'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
            'dynamic' => [
                'active' => true,
            ],
        ]
        );

        $repeater->add_control(
        'price_col_button_2_show',
            [
            'label' => __( 'Button 2', 'th-widget-pack' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'th-widget-pack' ),
            'label_off' => __( 'No', 'th-widget-pack' ),
            'return_value' => 'yes',
            //'default' => '',
            'separator' => 'before',
        ]
        );

        $repeater->add_control(
        'price_col_button_2_text',
        [
            'label' => __( 'Button 2 Text', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'dynamic' => [
                'active' => true,
            ],
            'conditions' => [
                'terms' => [
                    [
                    'name' => 'price_col_button_2_show',
                    'operator' => '==',
                    'value' => 'yes',
                    ],
                ]
            ],
        ]
        );

        $repeater->add_control(
        'price_col_button_2_style',
            [
            'label' => __( 'Button 2 Style', 'th-widget-pack' ),
            'type' => Controls_Manager::SELECT,
            //'default' => 'standard-primary',
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
            'conditions' => [
                'terms' => [
                    [
                    'name' => 'price_col_button_2_show',
                    'operator' => '==',
                    'value' => 'yes',
                    ],
                ],
            ],
        ]
        );

        $repeater->add_control(
    'button_2_image',
            [
            'label' => __( 'Button Graphic', 'th-widget-pack' ),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => [
                'active' => true,
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
        ]
        );

        $repeater->add_control(
        'price_col_button_2_link',
            [
            'label' => __( 'Button 2 Link', 'th-widget-pack' ),
            'type' => Controls_Manager::URL,
            'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
            'dynamic' => [
                'active' => true,
            ],
        ]
        );

        $repeater->add_control(
        'price_col_featured',
            [
            'label' => __( 'Featured', 'th-widget-pack' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'th-widget-pack' ),
            'label_off' => __( 'No', 'th-widget-pack' ),
            'return_value' => 'yes',
            //'default' => '',
            'separator' => 'before',
            ]
        );

        $repeater->add_control(
        'price_col_background',
            [
            'label' => __( 'Background Color', 'th-widget-pack' ),
            'type' => Controls_Manager::COLOR,
            //'default' => '#FFF',
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
            ]
        ]
        );
    }

    protected function get_repeater_defaults() {
        $placeholder_image_src = Utils::get_placeholder_image_src();

        return [
            [
                'price_col_title' => __( 'Title', 'th-widget-pack' ),
                'price_col_sub_title' => __( 'Sub Title', 'th-widget-pack' ),
                'price_col_price' => __( '$59', 'th-widget-pack' ),
                'price_col_text' => __( '/each', 'th-widget-pack' ),
                'price_col_description' => __( "Maecenas tristique\nUllamcorper mauris\nElementum tortor\nClass aptent", 'th-widget-pack' ),
                'price_col_button_1_show' => __( 'yes', 'th-widget-pack' ),
                'price_col_button_1_text' => __( 'BUTTON TEXT', 'th-widget-pack' ),
                'price_col_button_1_style' => __( 'ghost-primary', 'th-widget-pack' ),
            ],
            [
                'price_col_title' => __( 'Title', 'th-widget-pack' ),
                'price_col_sub_title' => __( 'Sub Title', 'th-widget-pack' ),
                'price_col_price' => __( '$79', 'th-widget-pack' ),
                'price_col_text' => __( '/each', 'th-widget-pack' ),
                'price_col_description' => __( "Maecenas tristique\nUllamcorper mauris\nElementum tortor\nClass aptent", 'th-widget-pack' ),
                'price_col_button_1_show' => __( 'yes', 'th-widget-pack' ),
                'price_col_button_1_text' => __( 'BUTTON TEXT', 'th-widget-pack' ),
                'price_col_button_1_style' => __( 'ghost-light', 'th-widget-pack' ),
                'price_col_featured' => __( 'yes', 'th-widget-pack' ),
            ],
            [
                'price_col_title' => __( 'Title', 'th-widget-pack' ),
                'price_col_sub_title' => __( 'Sub Title', 'th-widget-pack' ),
                'price_col_price' => __( '$99', 'th-widget-pack' ),
                'price_col_text' => __( '/each', 'th-widget-pack' ),
                'price_col_description' => __( "Maecenas tristique\nUllamcorper mauris\nElementum tortor\nClass aptent", 'th-widget-pack' ),
                'price_col_button_1_show' => __( 'yes', 'th-widget-pack' ),
                'price_col_button_1_text' => __( 'BUTTON TEXT', 'th-widget-pack' ),
                'price_col_button_1_style' => __( 'ghost-primary', 'th-widget-pack' ),
            ],

        ];
    }


	protected function render() {
		$settings = $this->get_settings_for_display();

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

		<div class="th-pricing-table<?php echo esc_attr( $table_class ); ?>">

			<div class="row">

				<?php $th_counter=0; foreach( $settings['pricing'] as $column ) { ?>

                    <?php ++$th_counter; ?>

                    <div class="elementor-repeater-item-<?php echo esc_attr( $column['_id'] ) ?> th-pricing-column<?php echo( esc_attr(isset( $column['price_col_featured']) ) && $column['price_col_featured'] == 'yes' ? ' th-highlight' : '' ); echo esc_attr( $column_class ); ?>">

	                    <?php if ( isset( $column['price_col_title'] ) && ! empty( $column['price_col_title'] ) ) : ?>
							<div class="th-pricing-title"><?php echo esc_html( $column['price_col_title'] ); ?></div>
	                    <?php endif; ?>

	                    <?php if ( isset( $column['price_col_sub_title'] ) && ! empty( $column['price_col_sub_title'] ) ) : ?>
	                        <div class="th-pricing-sub-title"><?php echo esc_html( $column['price_col_sub_title'] ); ?></div>
	                    <?php endif; ?>

	                    <?php if ( ( isset( $column['price_col_price'] ) && ! empty( $column['price_col_price'] ) ) || ( isset( $column['price_col_price'] ) && ! empty( $column['price_col_price'] ) ) ) : ?>
	                        <div class="th-pricing-cost">
	                            <?php echo esc_html( $column['price_col_price'] ); ?><span><?php echo esc_html( $column['price_col_text'] ); ?></span>
	                        </div>
	                    <?php endif; ?>

	                    <?php if ( isset( $column['price_col_description'] ) && ! empty( $column['price_col_description'] ) ) : ?>
							<div class="th-pricing-features">
								<ul>
									<?php echo '<li>' . str_replace( array( "\r", "\n\n", "\n" ), array( '', "\n", "</li>\n<li>" ), trim( wp_kses_post( preg_replace('~<p>(.*?)</p>~is', '$1',$column['price_col_description'] )), "\n\r" ) ) . '</li>'; ?>
								</ul>
							</div>
	                    <?php endif; ?>


                        <?php

                        // Graphic Button 1
                        $button_1_image = false;
                        if ( isset( $column['button_1_image']['id'] ) && $column['button_1_image']['id'] > "" ) {
                            $button_1_image = wp_get_attachment_image( $column['button_1_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
                        }elseif ( ! empty( $column['button_1_image']['url'] ) ) {
                            $this->add_render_attribute( 'button_1_image-'.$th_counter, 'src', esc_url( $column['button_1_image']['url'] ) );
                            $this->add_render_attribute( 'button_1_image-'.$th_counter, 'alt', esc_attr( Control_Media::get_image_alt( $column['button_1_image'] ) ) );
                            $this->add_render_attribute( 'button_1_image-'.$th_counter, 'title', esc_attr( Control_Media::get_image_title( $column['button_1_image'] ) ) );
                            $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_1_image'.$th_counter ) . '>';
                        }
                        // Graphic Button URL Styling 1
                        if ( isset($button_1_image) && ! empty( $button_1_image ) ) {
                            // image button
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-image' );
                        }else{ // Bootstrap Button URL Styling
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-' . esc_attr( $column['price_col_button_1_style'] ) );
                        }

                        // Button URL 1
                        if ( empty( $column['price_col_button_1_link']['url'] ) ) { $column['price_col_button_1_link']['url'] = '#'; };

                        if ( ! empty( $column['price_col_button_1_link']['url'] ) ) {
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'href', esc_url( $column['price_col_button_1_link']['url'] ) );

                            if ( ! empty( $column['price_col_button_1_link']['is_external'] ) ) {
                                $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'target', '_blank' );
                            }
                        }

                        // Graphic Button 2
                        $button_2_image = false;
                        if ( isset( $column['button_2_image']['id'] ) && $column['button_2_image']['id'] > "" ) {
                            $button_2_image = wp_get_attachment_image( $column['button_2_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
                        }elseif ( ! empty( $column['button_2_image']['url'] ) ) {
                            $this->add_render_attribute( 'button_2_image-'.$th_counter, 'src', esc_url( $column['button_2_image']['url'] ) );
                            $this->add_render_attribute( 'button_2_image-'.$th_counter, 'alt', esc_attr( Control_Media::get_image_alt( $column['button_2_image'] ) ) );
                            $this->add_render_attribute( 'button_2_image-'.$th_counter, 'title', esc_attr( Control_Media::get_image_title( $column['button_2_image'] ) ) );
                            $button_2_image = '<img ' . $this->get_render_attribute_string( 'button_2_image-'.$th_counter ) . '>';
                        }
                        // Graphic Button URL Styling 2
                        if ( isset($button_2_image) && ! empty( $button_2_image ) ) {
                            // image button
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-1' );
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'th-btn' );
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-image' );
                        }else{ // Bootstrap Button URL Styling
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-1' );
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn' );
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'th-btn' );
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-' . esc_attr( $column['price_col_button_2_style'] ) );
                        }

                        // Button URL 2
                        if ( empty( $column['price_col_button_2_link']['url'] ) ) { $column['price_col_button_2_link']['url'] = '#'; };

                        if ( ! empty( $column['price_col_button_2_link']['url'] ) ) {
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'href', esc_url( $column['price_col_button_2_link']['url'] ) );

                            if ( ! empty( $column['price_col_button_2_link']['is_external'] ) ) {
                                $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'target', '_blank' );
                            }
                        }

                        ?>

                        <div class="th-btn-wrap">
							<?php if ( ! empty( $column['price_col_button_1_text'] ) || ! empty( $column['price_col_button_2_text']) || ! empty($button_1_image) || ! empty( $button_2_image )  ) : ?>
	                            <?php if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) : ?>

                                    <?php if ( isset($button_1_image) && ! empty( $button_1_image ) ) : ?>
                                        <?php if ( ! empty( $column['price_col_button_1_link']['url'] ) ) : ?>
                                            <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                                <?php echo wp_kses_post( $button_1_image ); ?>
                                            </a>
                                        <?php else : ?>
                                            <?php echo wp_kses_post( $button_1_image ); ?>
                                        <?php endif; ?>
                                    <?php elseif ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                            <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                                <?php echo esc_html( $column['price_col_button_1_text'] ); ?>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
	                            <?php endif; ?>
	                            <?php if ( isset( $column['price_col_button_2_show'] ) && $column['price_col_button_2_show'] == 'yes' ) : ?>
                                    <?php if ( isset($button_2_image) && ! empty( $button_2_image ) ) : ?>
                                        <?php if ( ! empty( $column['price_col_button_2_link']['url'] ) ) : ?>
                                            <a <?php echo $this->get_render_attribute_string( 'btn-2-link-'.$th_counter ); ?>>
                                                <?php echo wp_kses_post( $button_2_image ); ?>
                                            </a>
                                        <?php else : ?>
                                            <?php echo wp_kses_post( $button_2_image ); ?>
                                        <?php endif; ?>
                                    <?php elseif ( ! empty( $column['price_col_button_2_text'] ) ) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'btn-2-link-'.$th_counter ); ?>>
                                            <?php if ( ! empty( $column['price_col_button_2_text'] ) ) : ?>
                                                <?php echo esc_html( $column['price_col_button_2_text'] ); ?>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
	                            <?php endif; ?>
							<?php endif; ?>
                        </div>

					</div>

				<?php } ?>

			</div>

		</div>

		<?php
	}

    protected function _content_template() {}

    public function add_wpml_support() {
        add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
    }
        
    public function wpml_widgets_to_translate_filter( $widgets ) {
        $widgets[ $this->get_name() ] = [
            'conditions'        => [ 'widgetType' => $this->get_name() ],
            'fields'            => array(),
            'integration-class' => 'WPML_Themo_Pricing',
        ];
        return $widgets;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Pricing() );
