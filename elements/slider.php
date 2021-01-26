<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Slider extends Widget_Base {

	public function get_name() {
		return 'themo-slider';
	}

	public function get_title() {
		return __( 'Slider', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-slides';
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
			'section_slides',
			[
				'label' => __( 'Slides', 'th-widget-pack' ),
			]
		);

		$th_repeater = new Repeater();

		$th_repeater->start_controls_tabs( 'slider_repeater' );

		$th_repeater->start_controls_tab( 'slide_background', [ 'label' => __( 'Background', 'th-widget-pack' ) ] );

		$th_repeater->add_control(
			'slide_bg_color',
			[
				'label' => __( 'Background Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4A4A4A',
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$th_repeater->add_control(
			'slide_bg_image',
			[
				'label' => __( 'Background Image', 'th-widget-pack' ),
				'type' => Controls_Manager::MEDIA,
                'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-image: url({{URL}});',
				],
			]
		);

		$th_repeater->add_control(
            'section_bg_heading',
            [
                'label' => __( 'Image', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$th_repeater->add_responsive_control(
			'slide_bg_repeat',
			[
				'label' => __( 'Background Repeat', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'options' => [
					'no-repeat' => __( 'No Repeat', 'th-widget-pack' ),
					'repeat' => __( 'Repeat All', 'th-widget-pack' ),
					'repeat-x' => __( 'Repeat Horizontally', 'th-widget-pack' ),
					'repeat-y' => __( 'Repeat Vertically ', 'th-widget-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-repeat: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$th_repeater->add_responsive_control(
			'slide_bg_attachment',
			[
				'label' => __( 'Background Attachment', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'scroll',
				'options' => [
					'fixed' => __( 'Fixed', 'th-widget-pack' ),
					'scroll' => __( 'Scroll', 'th-widget-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-attachment: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$th_repeater->add_responsive_control(
			'slide_bg_position',
			[
				'label' => __( 'Background Position', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'left top' =>  __( 'Left Top', 'th-widget-pack' ),
					'left center' =>  __( 'Left Center', 'th-widget-pack' ),
					'left bottom' =>  __( 'Left Bottom', 'th-widget-pack' ),
					'center top' =>  __( 'Center Top', 'th-widget-pack' ),
					'center center' =>  __( 'Center Center', 'th-widget-pack' ),
					'center bottom' =>  __( 'Center Bottom', 'th-widget-pack' ),
					'right top' =>  __( 'Right Top', 'th-widget-pack' ),
					'right center' =>  __( 'Right Center', 'th-widget-pack' ),
					'right bottom' =>  __( 'Right Bottom', 'th-widget-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-position: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$th_repeater->add_responsive_control(
			'slide_bg_size',
			[
				'label' => __( 'Background Size', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => __( 'Cover', 'th-widget-pack' ),
					'auto' => __( 'Auto', 'th-widget-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-size: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$th_repeater->add_control(
			'slide_bg_overlay',
			[
				'label' => __( 'Background Overlay', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'th-widget-pack' ),
				'label_off' => __( 'No', 'th-widget-pack' ),
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$th_repeater->add_control(
			'slide_bg_overlay_color',
			[
				'label' => __( 'Overlay Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.5)',
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .has-image-bg.th-slider-overlay' => 'background-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_overlay',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$th_repeater->end_controls_tab();

		$th_repeater->start_controls_tab( 'slide_content', [ 'label' => __( 'Content', 'th-widget-pack' ) ] );

		$th_repeater->add_control(
			'slide_title',
			[
				'label' => __( 'Title', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Title', 'th-widget-pack' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$th_repeater->add_control(
			'slide_text',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Slide Content', 'th-widget-pack' ),
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $th_repeater->add_control(
            'slide_button_text_1_show',
            [
                'label' => __( 'Button 1', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );



		$th_repeater->add_control(
			'slide_button_text_1',
			[
				'label' => __( 'Button 1 Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'th-widget-pack' ),
				'dynamic' => [
					'active' => true,
				],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slide_button_text_1_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'separator' => 'before',
			]
		);

        $th_repeater->add_control(
            'slide_button_style_1',
            [
                'label' => __( 'Button 1 Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-light',
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
                            'name' => 'slide_button_text_1_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $th_repeater->add_control(
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
                            'name' => 'slide_button_text_1_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

		$th_repeater->add_control(
			'slide_button_link_1',
			[
				'label' => __( 'Button 1 Link', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slide_button_text_1_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
			]
		);




        $th_repeater->add_control(
            'slide_button_text_2_show',
            [
                'label' => __( 'Button 2', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
                'default' => '',
                'separator' => 'before',
            ]
        );


		$th_repeater->add_control(
			'slide_button_text_2',
			[
				'label' => __( 'Button 2 Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'More Info', 'th-widget-pack' ),
				'dynamic' => [
					'active' => true,
				],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slide_button_text_2_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
			]
		);

		$th_repeater->add_control(
			'slide_button_style_2',
			[
				'label' => __( 'Button 2 Style', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard-light',
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
                            'name' => 'slide_button_text_2_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
			]
		);

        $th_repeater->add_control(
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
                            'name' => 'slide_button_text_2_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $th_repeater->add_control(
            'slide_button_link_2',
            [
                'label' => __( 'Button 2 Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                'dynamic' => [
					'active' => true,
				],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slide_button_text_2_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

		$th_repeater->add_control(
			'slide_image',
			[
				'label' => __( 'Image', 'th-widget-pack' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$th_repeater->add_control(
			'slide_image_url',
			[
				'label' => __( 'Image URL', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$th_repeater->add_control(
			'slide_shortcode',
			[
				'label' => __( 'Shortcode', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);



        $th_repeater->add_control(
            'inline_form',
            [
                'label' => __( 'Formidable Form Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'Default', 'th-widget-pack' ),
                    'inline' => __( 'Inline', 'th-widget-pack' ),
                    'stacked' => __( 'Stacked', 'th-widget-pack' ),

                ],
                'dynamic' => [
					'active' => true,
				],
            ]
        );

		$th_repeater->add_control(
			'slide_shortcode_border',
			[
				'label' => __( 'Form Background', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
                    'none' => __( 'None', 'th-widget-pack' ),
                    'th-form-bg th-light-bg' => __( 'Light', 'th-widget-pack' ),
					'th-form-bg th-dark-bg' => __( 'Dark', 'th-widget-pack' ),

				],
                'condition' => [
                    'inline_form' => 'stacked',
                ],
                'dynamic' => [
					'active' => true,
				],
			]
		);

		$th_repeater->add_control(
			'slide_tooltip',
			[
				'label' => __( 'Calendar Tooltip', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'th-widget-pack' ),
				'label_off' => __( 'No', 'th-widget-pack' ),
				'return_value' => 'yes',
			]
		);

		$th_repeater->add_control(
			'slide_tooltip_text',
			[
				'label' => __( 'Tooltip Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'slide_tooltip' => 'yes',
				],
                'default' => __( 'Calendar Toolip', 'th-widget-pack' ),
                'plcaeholder' => __( 'Calendar Toolip', 'th-widget-pack' ),
                'dynamic' => [
					'active' => true,
				],
			]
		);

        if('bellevue' == THEMO_CURRENT_THEME){
            $th_repeater->add_control(
                'th_cal_size',
                [
                    'label' => __( 'Calendar Size', 'th-widget-pack' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'small',
                    'options' => [
                        'small' => __( 'Small', 'th-widget-pack' ),
                    ]
                ]
            );
        }else{
            $th_repeater->add_control(
                'th_cal_size',
                [
                    'label' => __( 'Calendar Size', 'th-widget-pack' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'small',
                    'options' => [
                        'small' => __( 'Small', 'th-widget-pack' ),
                        'large' => __( 'Large', 'th-widget-pack' ),
                    ]
                ]
            );

        }

		$th_repeater->end_controls_tab();

		$th_repeater->start_controls_tab( 'slide_style', [ 'label' => __( 'Style', 'th-widget-pack' ) ] );

        $th_repeater->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .th-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $th_repeater->add_responsive_control(
            'slide_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'th-widget-pack' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .th-slide-content' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto; margin-left:0;',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto; margin-right:0;',
                ],
                'default' => 'center',
            ]
        );

        $th_repeater->add_responsive_control(
			'slide_vertical_position',
			[
				'label' => __( 'Vertical Position', 'th-widget-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'th-widget-pack' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'th-widget-pack' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'th-widget-pack' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .th-slide-inner' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
                'default' => 'middle',
                //'prefix_class' => 'th-slide-v-position-',
			]
		);

		$th_repeater->add_control(
			'slide_text_align',
			[
				'label' => __( 'Text Align', 'th-widget-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
                'default' => 'center',
			]
		);



		$th_repeater->add_control(
			'slide_title_color',
			[
				'label' => __( 'Title Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-title' => 'color: {{VALUE}}'
				],
                'default' => '#FFFFFF',
			]
		);

		$th_repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'slide_title_typo',
				'label' => __( 'Title Typography', 'th-widget-pack' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-title',
			]
		);

		$th_repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'slide_title_shadow',
				'label'	=> 'Text Shadow',
				'selector' => '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-title',
			]
		);
		

		$th_repeater->add_control(
			'slide_content_color',
			[
				'label' => __( 'Content Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-subtitle p' => 'color: {{VALUE}}',
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .wpbs-legend .wpbs-legend-item p' => 'color: {{VALUE}}',
				],
                'default' => '#FFFFFF',
			]
		);

		$th_repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'slide_content_typo',
				'label' => __( 'Content Typography', 'th-widget-pack' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-subtitle p',
			]
		);

		$th_repeater->end_controls_tab();

		$th_repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'elementor-pro' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
                'default' => [
                    [
                        'slide_title' => __( 'In in dictum metus, nec.', 'th-widget-pack' ),
                        'slide_text' => __( 'Donec ultrices libero id leo tempor, nec efficitur sem auctor. Duis dictum justo a risus ultricies.', 'th-widget-pack' ),
                        'slide_button_text_1' => __( 'Button Text', 'th-widget-pack' ),
                        'slide_bg_color' => __( '#CCC', 'th-widget-pack' ),
                        'slide_button_style_1' => __( 'ghost-light', 'th-widget-pack' ),
                    ],
                    [
                        'slide_title' => __( 'Sed diam nunc, pretium vitae.', 'th-widget-pack' ),
                        'slide_text' => __( 'Donec ultrices libero id leo tempor, nec efficitur sem auctor. Duis dictum justo a risus ultricies.', 'th-widget-pack' ),
                        'slide_bg_color' => __( '#4A4A4A', 'th-widget-pack' ),
                        'slide_button_text_1_show' => __( 'no', 'th-widget-pack' ),
                        'slide_shortcode' => __( '[booked-calendar]', 'th-widget-pack' ),

                    ],
                    [
                        'slide_title' => __( 'In pellentesque ultricies nulla dapibus.', 'th-widget-pack' ),
                        'slide_text' => __( 'Donec ultrices libero id leo tempor, nec efficitur sem auctor. Duis dictum justo a risus ultricies.', 'th-widget-pack' ),
                        'slide_bg_color' => __( '#7A85E8', 'th-widget-pack' ),
                        'inline_form' => __( 'inline', 'th-widget-pack' ),
                        'slide_button_text_1_show' => __( 'no', 'th-widget-pack' ),
                        'slide_shortcode' => __( '[formidable id="2"]', 'th-widget-pack' ),
                    ],

                ],
				'fields' => $th_repeater->get_controls(),
				'title_field' => '{{{ slide_title }}}',
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __( 'Height', 'th-widget-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 600,
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->add_control(
			'slides_down_arrow',
			[
				'label' => __( 'Down Arrow', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'th-widget-pack' ),
				'label_off' => __( 'No', 'th-widget-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'slides_down_arrow_link',
			[
				'label' => __( 'Down Arrow URL anchor', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '#prices', 'th-widget-pack' ),
				'condition' => [
					'slides_down_arrow' => 'yes',
				],
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

        $this->add_control(
            'slide_down_arrow_color',
            [
                'label' => __( 'Down Arrow Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #main-flex-slider a.slider-scroll-down' => 'color: {{VALUE}}'
                ],
                'default' => '#FFFFFF',
                'condition' => [
                    'slides_down_arrow' => 'yes',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'th-widget-pack' ),
				'type' => Controls_Manager::SECTION,
			]
		);

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Auto play', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'th-widget-pack' ),
                'label_off' => __( 'Off', 'th-widget-pack' ),
                'return_value' => 'On',
                'description' => __( 'Start slider automatically', 'th-widget-pack' ),
            ]
        );

		$this->add_control(
			'th_animation',
			[
				'label' => __( 'Transition Style', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => __( 'Fade', 'th-widget-pack' ),
					'slide' => __( 'Slide', 'th-widget-pack' ),
				],
				'description' => __( 'Controls the transition style, "fade" or "slide"', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'easing',
			[
				'label' => __( 'Easing', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'swing',
				'options' => [
					'swing' => __( 'Swing', 'th-widget-pack' ),
					'linear' => __( 'Linear', 'th-widget-pack' ),
				],
				'description' => __( 'Determines the easing method used in jQuery transitions', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'animation_loop',
			[
				'label' => __( 'Infinite Loop', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'default' => 'On',
				'description' => __( 'Gives the slider a seamless infinite loop', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'smooth_height',
			[
				'label' => __( 'Smooth Height', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'default' => 'On',
				'description' => __( 'Animate the height of the slider smoothly for slides of varying height', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'slideshow_speed',
			[
				'label' => __( 'Slideshow Speed', 'th-widget-pack' ),
				'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4000,
                ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 15000,
					],
				],
				'description' => __( 'Set the speed of the slideshow cycling, in milliseconds (1 s = 1000 ms)', 'th-widget-pack' ),
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label' => __( 'Animation Speed', 'th-widget-pack' ),
				'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 550,
                ],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'description' => __( 'Set the speed of animations, in milliseconds (1 s = 1000 ms)', 'th-widget-pack' ),
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->add_control(
			'randomize',
			[
				'label' => __( 'Randomize', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'description' => __( 'Randomize slide order, on load', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause On Hover', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'default' => 'On',
				'description' => __( 'Pause the slideshow when hovering over slider, then resume when no longer hovering', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'touch',
			[
				'label' => __( 'Touch', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'default' => 'On',
				'description' => __( 'Allow touch swipe navigation of the slider on enabled devices', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => __( 'Direction Nav', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'default' => 'On',
				'description' => __( 'Create previous/next arrow navigation', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'paging',
			[
				'label' => __( 'Paging Control', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'th-widget-pack' ),
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'return_value' => 'On',
				'default' => 'On',
				'description' => __( 'Create navigation for paging control of each slide', 'th-widget-pack' ),
			]
		);

		$this->end_controls_section();



	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$this->add_render_attribute( 'slider-bg', 'class', 'slider-bg' );
		$this->add_render_attribute( 'slider-bg', 'class', 'slide-cal-center' );

		$init_main_loop = 0;
		?>

		<div id="main-flex-slider" class="flexslider">
			<ul class="slides">
				<?php $th_counter=0; foreach( $settings['slides'] as $slide ) { ?>

                    <?php ++$th_counter; ?>

                    <?php

                    // Graphic Button 1
                    $button_1_image = false;
                    if ( isset( $slide['button_1_image']['id'] ) && $slide['button_1_image']['id'] > "" ) {
                        $button_1_image = wp_get_attachment_image( $slide['button_1_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
                    }elseif ( ! empty( $slide['button_1_image']['url'] ) ) {
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'src', esc_url( $slide['button_1_image']['url'] ) );
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'alt', esc_attr( Control_Media::get_image_alt( $slide['button_1_image'] ) ) );
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'title', esc_attr( Control_Media::get_image_title( $slide['button_1_image'] ) ) );
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
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-' . esc_attr( $slide['slide_button_style_1'] ) );
                    }

                    // Button URL 1
                    if ( empty( $slide['slide_button_link_1']['url'] ) ) { $slide['slide_button_link_1']['url'] = '#'; };

                    if ( ! empty( $slide['slide_button_link_1']['url'] ) ) {
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'href', esc_url( $slide['slide_button_link_1']['url'] ) );

                        if ( ! empty( $slide['slide_button_link_1']['is_external'] ) ) {
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'target', '_blank' );
                        }
                    }

                    // Graphic Button 2
                    $button_2_image = false;
                    if ( isset( $slide['button_2_image']['id'] ) && $slide['button_2_image']['id'] > "" ) {
                        $button_2_image = wp_get_attachment_image( $slide['button_2_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
                    }elseif ( ! empty( $slide['button_2_image']['url'] ) ) {
                        $this->add_render_attribute( 'button_2_image-'.$th_counter, 'src', esc_url( $slide['button_2_image']['url'] ) );
                        $this->add_render_attribute( 'button_2_image-'.$th_counter, 'alt', esc_attr( Control_Media::get_image_alt( $slide['button_2_image'] ) ) );
                        $this->add_render_attribute( 'button_2_image-'.$th_counter, 'title', esc_attr( Control_Media::get_image_title( $slide['button_2_image'] ) ) );
                        $button_2_image = '<img ' . $this->get_render_attribute_string( 'button_2_image-'.$th_counter ) . '>';
                    }
                    // Graphic Button URL Styling 2
                    if ( isset($button_2_image) && ! empty( $button_2_image ) ) {
                        // image button
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-2' );
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-image' );
                    }else{ // Bootstrap Button URL Styling
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-2' );
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn' );
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'class', 'btn-' . esc_attr( $slide['slide_button_style_2'] ) );
                    }

                    // Button URL 2
                    if ( empty( $slide['slide_button_link_2']['url'] ) ) { $slide['slide_button_link_2']['url'] = '#'; };

                    if ( ! empty( $slide['slide_button_link_2']['url'] ) ) {
                        $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'href', esc_url( $slide['slide_button_link_2']['url'] ) );

                        if ( ! empty( $slide['slide_button_link_2']['is_external'] ) ) {
                            $this->add_render_attribute( 'btn-2-link-'.$th_counter, 'target', '_blank' );
                        }
                    }

                    ?>

					<?php if ( ! empty( $settings['button_size_1'] ) ) {
						$this->add_render_attribute( 'th-button-1', 'class', 'th-button-size-' . esc_attr( $settings['button_size_1'] ) );
					} ?>
					<?php if ( ! empty( $settings['button_size_2'] ) ) {
						$this->add_render_attribute( 'th-button-2', 'class', 'th-button-size-' . esc_attr( $settings['button_size_2'] ) );
					} ?>
                    <?php

                    $th_form_border_class = false;
                    $th_formidable_class = 'th-form-default';
                    if ( isset( $slide['inline_form'] ) && $slide['inline_form'] > "" ) :
                        switch ( $slide['inline_form'] ) {
                            case 'stacked':
                                $th_formidable_class = 'th-form-stacked';
                                if ( isset( $slide['slide_shortcode_border'] ) && $slide['slide_shortcode_border'] != 'none' ){
                                    $th_form_border_class = $slide['slide_shortcode_border'];
                                }
                                break;
                            case 'inline':
                                $th_formidable_class = 'th-conversion ';
                                break;
                        }
                    endif;

					$this->add_render_attribute( 'slider-bg', 'class', esc_attr( $th_form_border_class ) );
                    $this->add_render_attribute( 'slider-bg-overlay', 'class', 'th-slide-wrap' );

					if ( 'yes' === $slide['slide_bg_overlay'] ) {
                        $this->add_render_attribute( 'slider-bg-overlay', 'class', 'th-slider-overlay' );
                    }

                    if ($slide['slide_bg_image']['url'] ) {
                        $this->add_render_attribute( 'slider-bg-overlay', 'class', 'has-image-bg' );
                    }

                    $th_cal_align_class = false;
                    if ( isset( $slide['slide_text_align'] ) && $slide['slide_text_align'] > "" ) {
                        switch ( $slide['slide_text_align'] ) {
                            case 'left':
                                $th_cal_align_class =  ' th-left';
                                break;
                            case 'center':
                                $th_cal_align_class = ' th-centered';
                                break;
                            case 'right':
                                $th_cal_align_class = ' th-right';
                                break;
                        }
                    }
                    ?>

                    <li class="elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?>">
						<div <?php echo $this->get_render_attribute_string( 'slider-bg' ); ?>>
                            <div <?php echo $this->get_render_attribute_string( 'slider-bg-overlay' );?>>
                                <div class="th-slide-inner <?php echo esc_attr( $th_cal_align_class ); ?>">
                                    <div class="th-slide-content">
                                        <?php if ( ! empty( $slide['slide_title'] ) ) : ?>
                                            <h1 class="slider-title"><?php echo esc_html( $slide['slide_title'] ) ?></h1>
                                        <?php endif;?>

                                        <?php if ( ! empty( $slide['slide_text'] ) ) : ?>
                                            <div class="slider-subtitle">
                                                <p><?php echo wp_kses_post( $slide['slide_text']) ?></p>
                                            </div>
                                        <?php endif;?>
                                        <?php if ( ! empty( $slide['slide_button_text_1'] ) || ! empty( $slide['slide_button_text_2'] ) || ! empty($button_1_image) || ! empty( $button_2_image )) : ?>
                                            <div class="th-btn-wrap">
                                                <?php if ( isset( $slide['slide_button_text_1_show'] ) && $slide['slide_button_text_1_show'] == 'yes' ) : ?>
                                                    <?php if ( isset($button_1_image) && ! empty( $button_1_image ) ) : ?>
                                                        <?php if ( ! empty( $slide['slide_button_link_1']['url'] ) ) : ?>
                                                            <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                                                <?php echo wp_kses_post( $button_1_image ); ?>
                                                            </a>
                                                        <?php else : ?>
                                                            <?php echo wp_kses_post( $button_1_image ); ?>
                                                        <?php endif; ?>
                                                    <?php elseif ( ! empty( $slide['slide_button_text_1'] ) ) : ?>
                                                        <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                                            <?php if ( ! empty( $slide['slide_button_text_1'] ) ) : ?>
                                                                <?php echo esc_html( $slide['slide_button_text_1'] ); ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ( isset( $slide['slide_button_text_2_show'] ) && $slide['slide_button_text_2_show'] == 'yes' ) : ?>
                                                    <?php if ( isset($button_2_image) && ! empty( $button_2_image ) ) : ?>
                                                        <?php if ( ! empty( $slide['slide_button_link_2']['url'] ) ) : ?>
                                                            <a <?php echo $this->get_render_attribute_string( 'btn-2-link-'.$th_counter ); ?>>
                                                                <?php echo wp_kses_post( $button_2_image ); ?>
                                                            </a>
                                                        <?php else : ?>
                                                            <?php echo wp_kses_post( $button_2_image ); ?>
                                                        <?php endif; ?>
                                                    <?php elseif ( ! empty( $slide['slide_button_text_2'] ) ) : ?>
                                                        <a <?php echo $this->get_render_attribute_string( 'btn-2-link-'.$th_counter ); ?>>
                                                            <?php if ( ! empty( $slide['slide_button_text_2'] ) ) : ?>
                                                                <?php echo esc_html( $slide['slide_button_text_2'] ); ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( $slide['slide_image']['id'] ) : ?>
                                            <div class="page-title-image ">
                                                <?php if ( ! empty( $slide['slide_image_url']['url'] ) ) : ?>
                                                    <?php $img_target = $slide['slide_image_url']['is_external'] ? ' target="_blank"' : ''; ?>
                                                    <?php echo '<a href="' . esc_url( $slide['slide_image_url']['url'] ) . '"' . wp_kses_post( $img_target ) . '>'; ?>
                                                <?php endif; ?>
                                                <?php echo wp_kses_post(wp_get_attachment_image( $slide['slide_image']['id'], 'large', false, array( 'class' => 'hero wp-post-image' ) )); ?>
                                                <?php if ( ! empty( $slide['slide_image_url']['url'] ) ) : ?>
                                                    <?php echo '</a>'; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( isset( $slide['slide_shortcode'] ) ) : ?>
                                            <?php $sth_show_tooltip = $slide['slide_tooltip'] == 'yes' ? true : false; ?>
                                            <?php $th_tooltip = $slide['slide_tooltip_text'] ? $slide['slide_tooltip_text'] : ''; ?>
                                            <?php $themo_flex_smoothheight = strpos( $slide['slide_shortcode'], 'booked-calendar' ) !== FALSE ? false : true; ?>

                                            <?php
                                                $th_shortcode = sanitize_text_field( $slide['slide_shortcode'] );
                                                $th_brackets = array( "[","]" );
                                                $th_shortcode_text = str_replace( $th_brackets, "", $th_shortcode );
                                                $th_shortcode_name = strtok( $th_shortcode_text,  ' ' );
                                                $th_cal_size =  ( isset( $slide['th_cal_size'] ) ? $slide['th_cal_size'] : false );
                                                $th_output = "";

                                                switch ( $th_shortcode_name ) {
                                                    case 'formidable':
                                                        $th_output .= '<div class="' . sanitize_html_class( $th_formidable_class ) . '">';
                                                        $th_output .= do_shortcode( $th_shortcode );
                                                        $th_output .= '</div>';
                                                        break;
                                                    case 'booked-calendar':
                                                        $th_output .= '<div class="th-book-cal-' . esc_attr( $th_cal_size ) . esc_attr( $th_cal_align_class ) .'">';
                                                        if( $sth_show_tooltip ){
                                                            $th_output .= '<div class="th-cal-tooltip">';
                                                            $th_output .= '<h3>' . esc_html( $th_tooltip ) . '</h3>';
                                                            $th_output .= '</div>';
                                                        }
                                                        $th_output .= do_shortcode( $th_shortcode );
                                                        $th_output .= '</div>';
                                                        break;
                                                    case 'wpbs':
                                                        $th_output .= '<div class="th-book-cal-' . esc_attr( $th_cal_size ) . esc_attr( $th_cal_align_class ) .'">';
                                                        if( $sth_show_tooltip ){
                                                            $th_output .= '<div class="th-cal-tooltip">';
                                                            $th_output .= '<h3>' . esc_html( $th_tooltip ) . '</h3>';
                                                            $th_output .= '</div>';
                                                        }
                                                        $th_output .= do_shortcode( $th_shortcode );
                                                        $th_output .= '</div>';
                                                        break;
                                                    default:
                                                        $th_output .= '<div>';
                                                        $th_output .= do_shortcode( $th_shortcode );
                                                        $th_output .= '</div>';
                                                }
                                                echo $th_output;
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>

			<?php if ( $settings['slides_down_arrow'] == 'yes' && $settings['slides_down_arrow_link']['url'] ) : ?>
				<?php $down_target = $settings['slides_down_arrow_link']['is_external'] ? 'target="_blank"' : 'target="_self"'; ?>
				<a href="<?php echo esc_url( $settings['slides_down_arrow_link']['url'] ) ?>" <?php echo wp_kses_post( $down_target ) ?> class="slider-scroll-down th-icon th-i-down"></a>
			<?php endif; ?>
		</div>

		<script>
			jQuery( function ( $ ) {

				themo_start_flex_slider(
					'#main-flex-slider',
                    <?php echo esc_attr( $settings['autoplay'] ) ? 'true' : 'false'; ?>,
					'<?php echo esc_attr( $settings['th_animation'] ); ?>',
					'<?php echo esc_attr( $settings['easing'] ); ?>',
					<?php echo esc_attr( $settings['animation_loop'] ) ? 'true' : 'false'; ?>,
					<?php echo esc_attr( $settings['smooth_height'] ) ? 'true' : 'false'; ?>,
					<?php echo ! esc_attr( $settings['slideshow_speed']['size'] ) ? '0' : $settings['slideshow_speed']['size']; ?>,
					<?php echo ! esc_attr( $settings['animation_speed']['size'] ) ? '0' : $settings['animation_speed']['size']; ?>,
					<?php echo esc_attr( $settings['randomize'] ) ? 'true' : 'false'; ?>,
					<?php echo esc_attr( $settings['pause_on_hover'] ) ? 'true' : 'false'; ?>,
					<?php echo esc_attr( $settings['touch'] ) ? 'true' : 'false'; ?>,
					<?php echo esc_attr( $settings['direction'] ) ? 'true' : 'false'; ?>,
					<?php echo esc_attr( $settings['paging'] ) ? 'true' : 'false'; ?>
				);
			} );
		</script>
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
			'integration-class' => 'WPML_Themo_Slider',
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Slider() );
