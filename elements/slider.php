<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Slider extends Widget_Base {

	public function get_name() {
		return 'themo-slider';
	}

	public function get_title() {
		return __( 'Slider', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
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
			'section_slides',
			[
				'label' => __( 'Slides', 'elementor' ),
			]
		);

		$th_repeater = new Repeater();

		$th_repeater->start_controls_tabs( 'slider_repeater' );

		$th_repeater->start_controls_tab( 'slide_background', [ 'label' => __( 'Background', 'elementor' ) ] );

		$th_repeater->add_control(
			'slide_bg_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$th_repeater->add_control(
			'slide_bg_image',
			[
				'label' => __( 'Background Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-image: url({{URL}})',
				],
			]
		);

		$th_repeater->add_control(
			'slide_bg_repeat',
			[
				'label' => __( 'Background Repeat', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'options' => [
					'no-repeat' => __( 'No Repeat', 'elementor' ),
					'repeat' => __( 'Repeat All', 'elementor' ),
					'repeat-x' => __( 'Repeat Horizontally', 'elementor' ),
					'repeat-y' => __( 'Repeat Vertically ', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-repeat: {{VALUE}}',
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
			'slide_bg_attachment',
			[
				'label' => __( 'Background Attachment', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'scroll',
				'options' => [
					'fixed' => __( 'Fixed', 'elementor' ),
					'scroll' => __( 'Scroll', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-attachment: {{VALUE}}',
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
			'slide_bg_position',
			[
				'label' => __( 'Background Position', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left top',
				'options' => [
					'left top' =>  __( 'Left Top', 'elementor' ),
					'left center' =>  __( 'Left Center', 'elementor' ),
					'left bottom' =>  __( 'Left Bottom', 'elementor' ),
					'center top' =>  __( 'Center Top', 'elementor' ),
					'center center' =>  __( 'Center Center', 'elementor' ),
					'center bottom' =>  __( 'Center Bottom', 'elementor' ),
					'right top' =>  __( 'Right Top', 'elementor' ),
					'right center' =>  __( 'Right Center', 'elementor' ),
					'right bottom' =>  __( 'Right Bottom', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-position: {{VALUE}}',
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
			'slide_bg_size',
			[
				'label' => __( 'Background Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => __( 'Cover', 'elementor' ),
					'auto' => __( 'Auto', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'background-size: {{VALUE}}',
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
				'label' => __( 'Background Overlay', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
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
				'label' => __( 'Overlay Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .th-slider-overlay' => 'background-color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'slide_bg_image[url]',
							'operator' => '!=',
							'value' => '',
						],
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

		$th_repeater->start_controls_tab( 'slide_content', [ 'label' => __( 'Content', 'elementor' ) ] );

		$th_repeater->add_control(
			'slide_title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Title', 'elementor' ),
				'label_block' => true,
			]
		);

		$th_repeater->add_control(
			'slide_text',
			[
				'label' => __( 'Content', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Slide Content', 'elementor' ),
				'show_label' => false,
			]
		);

        $th_repeater->add_control(
            'slide_button_text_1_show',
            [
                'label' => __( 'Button 1', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
                'return_value' => 'yes',
                'default' => '',
                'separator' => 'before',
            ]
        );



		$th_repeater->add_control(
			'slide_button_text_1',
			[
				'label' => __( 'Button 1 Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'elementor' ),
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
                'label' => __( 'Button 1 Style', 'elementor' ),
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
                    'cta-primary' => __( 'CTA Accent', 'elementor' ),
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
				'label' => __( 'Button 1 Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
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
            'slide_button_text_1_div',
            [
                'type' => Controls_Manager::DIVIDER,
                /*'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slide_button_text_1_show',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],*/
            ]
        );


        $th_repeater->add_control(
            'slide_button_text_2_show',
            [
                'label' => __( 'Button 2', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
                'return_value' => 'yes',
                'default' => '',
                'separator' => 'before',
            ]
        );

        /*$th_repeater->add_control(
            'slide_button_text_2_div',
            [
                'type' => Controls_Manager::DIVIDER,
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
        );*/

		$th_repeater->add_control(
			'slide_button_text_2',
			[
				'label' => __( 'Button 2 Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'elementor' ),
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
					'cta-primary' => __( 'CTA Accent', 'elementor' ),
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
                'label' => __( 'Button 2 Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'elementor' ),
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
				'label' => __( 'Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'background-image: url({{URL}})',
				],
			]
		);

		$th_repeater->add_control(
			'slide_image_url',
			[
				'label' => __( 'Image URL', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
			]
		);

		$th_repeater->add_control(
			'slide_shortcode',
			[
				'label' => __( 'Shortcode', 'elementor' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$th_repeater->add_control(
			'slide_shortcode_border',
			[
				'label' => __( 'Shortcode Form Border', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => [
					'light' => __( 'Light', 'elementor' ),
					'dark' => __( 'Dark', 'elementor' ),
					'none' => __( 'None', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'background-size: {{VALUE}}',
				]
			]
		);

		$th_repeater->add_control(
			'slide_tooltip',
			[
				'label' => __( 'Display Tooltip', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
				'return_value' => 'yes',
			]
		);

		$th_repeater->add_control(
			'slide_tooltip_text',
			[
				'label' => __( 'Tooltip Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'slide_tooltip' => 'yes',
				],
			]
		);

		$th_repeater->end_controls_tab();

		$th_repeater->start_controls_tab( 'slide_style', [ 'label' => __( 'Style', 'elementor' ) ] );

		/*$th_repeater->add_control(
			'slide_custom_style',
			[
				'label' => __( 'Custom', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
				'return_value' => 'yes',
				'description'   => __( 'Set custom style that will only affect this specific slide.', 'elementor' ),
			]
		);*/

        $th_repeater->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', 'elementor' ),
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
                    '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .th-slide-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $th_repeater->add_control(
            'slide_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .th-slide-content' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto',
                ],
            ]
        );

        $th_repeater->add_control(
			'slide_vertical_position',
			[
				'label' => __( 'Vertical Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
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
                //'prefix_class' => 'th-slide-v-position-',
			]
		);

		$th_repeater->add_control(
			'slide_text_align',
			[
				'label' => __( 'Text Align', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .th-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$th_repeater->add_control(
			'slide_title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-title' => 'color: {{VALUE}}'
				],
			]
		);

		$th_repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'slide_title_typo',
				'label' => __( 'Title Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-title',
				'condition' => [
					'slide_custom_style' => 'yes',
				],
			]
		);

		$th_repeater->add_control(
			'slide_content_color',
			[
				'label' => __( 'Content Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-subtitle p' => 'color: {{VALUE}}'
				],
			]
		);

		$th_repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'slide_content_typo',
				'label' => __( 'Content Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .slider-subtitle p',
				'condition' => [
					'slide_custom_style' => 'yes',
				],
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
				'fields' => array_values( $th_repeater->get_controls() ),
				'title_field' => '{{{ slide_title }}}',
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __( 'Height', 'elementor' ),
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
					'size' => 400,
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slides_down_arrow',
			[
				'label' => __( 'Down Arrow', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'slides_down_arrow_link',
			[
				'label' => __( 'Down Arrow URL anchor', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '#prices', 'elementor' ),
				'condition' => [
					'slides_down_arrow' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'elementor' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'animation',
			[
				'label' => __( 'Animation', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => __( 'Fade', 'elementor' ),
					'slide' => __( 'Slide', 'elementor' ),
				],
				'description' => __( 'Controls the animation type, "fade" or "slide"', 'elementor' ),
			]
		);

		$this->add_control(
			'easing',
			[
				'label' => __( 'Easing', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'swing',
				'options' => [
					'swing' => __( 'Swing', 'elementor' ),
					'linear' => __( 'Linear', 'elementor' ),
				],
				'description' => __( 'Determines the easing method used in jQuery transitions', 'elementor' ),
			]
		);

		$this->add_control(
			'animation_loop',
			[
				'label' => __( 'Animation Loop', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Gives the slider a seamless infinite loop', 'elementor' ),
			]
		);

		$this->add_control(
			'smooth_height',
			[
				'label' => __( 'Smooth Height', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Animate the height of the slider smoothly for slides of varying height', 'elementor' ),
			]
		);

		$this->add_control(
			'slideshow_speed',
			[
				'label' => __( 'Slideshow Speed', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 15000,
					],
				],
				'description' => __( 'Set the speed of the slideshow cycling, in milliseconds', 'elementor' ),
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label' => __( 'Animation Speed', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'description' => __( 'Set the speed of animations, in milliseconds', 'elementor' ),
			]
		);

		$this->add_control(
			'randomize',
			[
				'label' => __( 'Randomize', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Randomize slide order, on load', 'elementor' ),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause On Hover', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Pause the slideshow when hovering over slider, then resume when no longer hovering', 'elementor' ),
			]
		);

		$this->add_control(
			'touch',
			[
				'label' => __( 'Touch', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Allow touch swipe navigation of the slider on enabled devices', 'elementor' ),
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => __( 'Direction Nav', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Create previous/next arrow navigation', 'elementor' ),
			]
		);

		$this->add_control(
			'paging',
			[
				'label' => __( 'Paging Control', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'On',
				'description' => __( 'Create navigation for paging control of each slide', 'elementor' ),
			]
		);

		$this->end_controls_section();

        /*$this->start_controls_section(
            'section_style_slides',
            [
                'label' => __( 'Slides', 'elementor' ),
                'tab' => ntrols_Manager::TAB_STYLE,
            ]
        );

        /*$this->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', 'elementor' ),
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
                    '{{WRAPPER}} #main-flex-slider .slider-bg .container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'th-slide-h-position-',
            ]
        );

        $this->add_control(
            'slides_vertical_position',
            [
                'label' => __( 'Vertical Position', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'middle',
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'elementor' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'elementor' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'elementor' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'th-slide-v-position-',
            ]
        );

        $this->add_control(
            'slides_text_align',
            [
                'label' => __( 'Text Align', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} #main-flex-slider .slider-bg .container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();*/

		// $this->start_controls_section(
		// 	'section_style_title',
		// 	[
		// 		'label' => __( 'Title', 'elementor' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );
		//
		// $this->add_control(
		// 	'title_spacing',
		// 	[
		// 		'label' => __( 'Spacing', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .slider-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'title_color',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .slider-title' => 'color: {{VALUE}}',
		//
		// 		],
		// 	]
		// );
		//
		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'title_typography',
		// 		'label' => __( 'Typography', 'elementor' ),
		// 		'scheme' => Scheme_Typography::TYPOGRAPHY_1,
		// 		'selector' => '{{WRAPPER}} #main-flex-slider .slider-bg .container .slider-title',
		// 	]
		// );
		//
		// $this->end_controls_section();
		//
		// $this->start_controls_section(
		// 	'section_style_content',
		// 	[
		// 		'label' => __( 'Content', 'elementor' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );
		//
		// $this->add_control(
		// 	'content_spacing',
		// 	[
		// 		'label' => __( 'Spacing', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .slider-subtitle p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'content_color',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .slider-subtitle p' => 'color: {{VALUE}}',
		// 		],
		// 	]
		// );
		//
		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'content_typography',
		// 		'label' => __( 'Typography', 'elementor' ),
		// 		'scheme' => Scheme_Typography::TYPOGRAPHY_2,
		// 		'selector' => '{{WRAPPER}} #main-flex-slider .slider-bg .container .slider-subtitle p',
		// 	]
		// );
		//
		// $this->end_controls_section();
		//
		// $this->start_controls_section(
		// 	'section_style_button_1',
		// 	[
		// 		'label' => __( 'Button 1', 'elementor' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_size_1',
		// 	[
		// 		'label' => __( 'Size', 'elementor' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'sm',
		// 		'options' => self::get_button_sizes(),
		// 	]
		// );
		//
		// $this->add_control( 'button_color_1',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1' => 'color: {{VALUE}}; border-color: {{VALUE}}',
		//
		// 		],
		// 	]
		// );
		//
		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'button_typography_1',
		// 		'label' => __( 'Typography', 'elementor' ),
		// 		'selector' => '{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1',
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_border_width_1',
		// 	[
		// 		'label' => __( 'Border Width', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 20,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_border_radius_1',
		// 	[
		// 		'label' => __( 'Border Radius', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1' => 'border-radius: {{SIZE}}{{UNIT}};',
		// 		],
		// 		'separator' => 'after',
		// 	]
		// );
		//
		// $this->start_controls_tabs( 'button_1_tabs' );
		//
		// $this->start_controls_tab( 'normal_1', [ 'label' => __( 'Normal', 'elementor' ) ] );
		//
		// $this->add_control(
		// 	'button_text_color_1',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_background_color_1',
		// 	[
		// 		'label' => __( 'Background Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_border_color_1',
		// 	[
		// 		'label' => __( 'Border Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1' => 'border-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->end_controls_tab();
		//
		// $this->start_controls_tab( 'hover_1', [ 'label' => __( 'Hover', 'elementor' ) ] );
		//
		// $this->add_control(
		// 	'button_hover_text_color_1',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1:hover' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_hover_background_color_1',
		// 	[
		// 		'label' => __( 'Background Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1:hover' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_hover_border_color_1',
		// 	[
		// 		'label' => __( 'Border Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-1:hover' => 'border-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->end_controls_tabs();
		//
		// $this->end_controls_section();
		//
		// $this->start_controls_section(
		// 	'section_style_button_2',
		// 	[
		// 		'label' => __( 'Button 2', 'elementor' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_size_2',
		// 	[
		// 		'label' => __( 'Size', 'elementor' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'sm',
		// 		'options' => self::get_button_sizes(),
		// 	]
		// );
		//
		// $this->add_control( 'button_color_2',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2' => 'color: {{VALUE}}; border-color: {{VALUE}}',
		//
		// 		],
		// 	]
		// );
		//
		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'button_typography_2',
		// 		'label' => __( 'Typography', 'elementor' ),
		// 		'selector' => '{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2',
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_border_width_2',
		// 	[
		// 		'label' => __( 'Border Width', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 20,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_border_radius_2',
		// 	[
		// 		'label' => __( 'Border Radius', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2' => 'border-radius: {{SIZE}}{{UNIT}};',
		// 		],
		// 		'separator' => 'after',
		// 	]
		// );
		//
		// $this->start_controls_tabs( 'button_2_tabs' );
		//
		// $this->start_controls_tab( 'normal_2', [ 'label' => __( 'Normal', 'elementor' ) ] );
		//
		// $this->add_control(
		// 	'button_text_color_2',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_background_color_2',
		// 	[
		// 		'label' => __( 'Background Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_border_color_2',
		// 	[
		// 		'label' => __( 'Border Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2' => 'border-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->end_controls_tab();
		//
		// $this->start_controls_tab( 'hover_2', [ 'label' => __( 'Hover', 'elementor' ) ] );
		//
		// $this->add_control(
		// 	'button_hover_text_color_2',
		// 	[
		// 		'label' => __( 'Text Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2:hover' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_hover_background_color_2',
		// 	[
		// 		'label' => __( 'Background Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2:hover' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->add_control(
		// 	'button_hover_border_color_2',
		// 	[
		// 		'label' => __( 'Border Color', 'elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} #main-flex-slider .slider-bg .container .th-button-2:hover' => 'border-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		//
		// $this->end_controls_tabs();
		//
		// $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$this->add_render_attribute( 'slider-bg', 'class', 'slide-cal-center' );

		$init_main_loop = 0;
		?>

		<div id="main-flex-slider" class="flexslider" >
			<ul class="slides">
				<?php foreach( $settings['slides'] as $slide ) { ?>

					<?php if ( ! empty( $settings['button_size_1'] ) ) {
						$this->add_render_attribute( 'th-button-1', 'class', 'th-button-size-' . $settings['button_size_1'] );
					} ?>
					<?php if ( ! empty( $settings['button_size_2'] ) ) {
						$this->add_render_attribute( 'th-button-2', 'class', 'th-button-size-' . $settings['button_size_2'] );
					} ?>

					<li class="elementor-repeater-item-<?php echo $slide['_id'] ?>">
						<div class="slider-bg">
							<div class="th-slider-overlay">
							<div class="th-slider-overlay">
                                <div class="th-slide-inner">
                                    <div class="th-slide-content">
                                        <?php if ( ! empty( $slide['slide_title'] ) ) : ?>
                                            <h1 class="slider-title"><?php echo esc_html( $slide['slide_title']) ?></h1>
                                        <?php endif;?>

                                        <?php if ( ! empty( $slide['slide_text'] ) ) : ?>
                                            <div class="slider-subtitle">
                                                <p><?php echo esc_html( $slide['slide_text']) ?></p>
                                            </div>
                                        <?php endif;?>
                                        <?php if ( ! empty( $slide['slide_button_text_1'] ) || ! empty( $slide['slide_button_text_2'] ) ) : ?>
                                            <div class="page-title-button">
                                                <?php if (isset($slide['slide_button_text_1_show']) && $slide['slide_button_text_1_show'] == 'yes') : ?>
                                                    <?php if ( ! empty( $slide['slide_button_link_1']['url']) ) : ?>
                                                        <?php $target = $slide['slide_button_link_1']['is_external'] ? ' target="_blank"' : ''; ?>
                                                        <?php $button_style = 'btn-' . $slide['slide_button_style_1']; ?>
                                                        <?php echo '<a class="btn th-btn th-button th-button-1 ' . $button_style . '" href="' . $slide['slide_button_link_1']['url'] . '"' . $target . '>'; ?>
                                                    <?php endif; ?>
                                                    <?php if ( ! empty( $slide['slide_button_text_1'] ) ) : ?>
                                                        <?php echo esc_html( $slide['slide_button_text_1']) ?>
                                                    <?php endif;?>
                                                    <?php if ( ! empty( $slide['slide_button_link_1']['url'] ) ) : ?>
                                                        <?php echo '</a>'; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (isset($slide['slide_button_text_2_show']) && $slide['slide_button_text_2_show'] == 'yes') : ?>
                                                    <?php if ( ! empty( $slide['slide_button_link_2']['url'] ) ) : ?>
                                                        <?php $target = $slide['slide_button_link_2']['is_external'] ? ' target="_blank"' : ''; ?>
                                                        <?php $button_style = 'btn-' . $slide['slide_button_style_2']; ?>
                                                        <?php echo '<a class="btn th-btn th-button th-button-2 ' . $button_style . '" href="' . $slide['slide_button_link_2']['url'] . '"' . $target . '>'; ?>
                                                    <?php endif; ?>
                                                    <?php if ( ! empty( $slide['slide_button_text_2'] ) ) : ?>
                                                        <?php echo esc_html( $slide['slide_button_text_2']) ?>
                                                    <?php endif;?>
                                                    <?php if ( ! empty( $slide['slide_button_link_2']['url'] ) ) : ?>
                                                        <?php echo '</a>'; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( $slide['slide_image']['id'] ) : ?>
                                            <div class="page-title-image ">
                                                <?php if ( ! empty( $slide['slide_image_url']['url'] ) ) : ?>
                                                    <?php $img_target = $slide['slide_image_url']['is_external'] ? ' target="_blank"' : ''; ?>
                                                    <?php echo '<a href="' . $slide['slide_image_url']['url'] . '"' . $img_target . '>'; ?>
                                                <?php endif; ?>
                                                <?php echo wp_get_attachment_image( $slide['slide_image']['id'], 'large', false, array( 'class' => 'hero wp-post-image' ) ); ?>
                                                <?php if ( ! empty( $slide['slide_image_url']['url'] ) ) : ?>
                                                    <?php echo '</a>'; ?>
                                                <?php endif; ?>
                                                </div>
                                        <?php endif; ?>

                                        <?php if ( $slide['slide_shortcode'] ) : ?>
                                            <?php $show_tooltip = $slide['slide_tooltip'] == 'yes' ? true : false; ?>
                                            <?php $tooltip = $slide['slide_tooltip_text'] ? $slide['slide_tooltip_text'] : ''; ?>
                                            <?php $themo_flex_smoothheight = strpos($slide['slide_shortcode'], 'booked-calendar') !== FALSE ? false : true; ?>
                                            <?php themo_do_metabox_shortcode( $slide['slide_shortcode'], '', '', '', $show_tooltip, $tooltip ); ?>
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
				<a href="<?php echo $settings['slides_down_arrow_link']['url'] ?>" <?php echo $down_target ?> class="slider-scroll-down th-icon th-i-down"></a>
			<?php endif; ?>
		</div>

		<script>
			jQuery(window).load(function() {
				themo_start_flex_slider(
					'#main-flex-slider',
					'<?php echo $settings['animation']; ?>',
					'<?php echo $settings['easing']; ?>',
					<?php echo $settings['animation_loop'] ? 'true' : 'false'; ?>,
					<?php echo $settings['smooth_height'] ? 'true' : 'false'; ?>,
					<?php echo ! $settings['slideshow_speed']['size'] ? '0' : $settings['slideshow_speed']['size']; ?>,
					<?php echo ! $settings['animation_speed']['size'] ? '0' : $settings['animation_speed']['size']; ?>,
					<?php echo $settings['randomize'] ? 'true' : 'false'; ?>,
					<?php echo $settings['pause_on_hover'] ? 'true' : 'false'; ?>,
					<?php echo $settings['touch'] ? 'true' : 'false'; ?>,
					<?php echo $settings['direction'] ? 'true' : 'false'; ?>,
					<?php echo $settings['paging'] ? 'true' : 'false'; ?>
				);
			});
		</script>
		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Slider() );
