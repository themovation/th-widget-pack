<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Header extends Widget_Base {

	public function get_name() {
		return 'themo-header';
	}

	public function get_title() {
		return __( 'Header', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
	protected function _register_controls() {

        $this->start_controls_section(
            'section_align',
            [
                'label' => __( 'Position', 'th-widget-pack' ),
            ]
        );

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .th-header-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'header_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .th-header-wrap' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto; margin-left:0;',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto; margin-right:0;',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Content Alignment', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                    '{{WRAPPER}} .th-header-wrap .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'th-widget-pack' ),
			]
		);

        // $this->add_control(
        //     'icon',
        //     [
        //         'label' => __( 'Choose Icon', 'th-widget-pack' ),
        //         'type' => Controls_Manager::ICON,
		// 		'options' => themo_icons(),
		// 		'include' => themo_fa_icons()
        //     ]
        // );
        $this->add_control(
            'new_icon',
            [
                'label' => __( 'Choose Icon', 'th-widget-pack' ),
                'fa4compatibility' => 'icon',
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                /*'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],*/
            ]
        );		


        $this->add_control(
            'view',
            [
                'label' => __( 'Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'th-widget-pack' ),
                    'stacked' => __( 'Filled', 'th-widget-pack' ),
                    'framed' => __( 'Framed', 'th-widget-pack' ),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]

        );

        $this->add_control(
            'shape',
            [
                'label' => __( 'Shape', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __( 'Circle', 'th-widget-pack' ),
                    'square' => __( 'Square', 'th-widget-pack' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'view!' => 'default',
                ],
                'prefix_class' => 'elementor-shape-',
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'sm' => __( 'Small', 'th-widget-pack' ),
                    'md' => __( 'Medium', 'th-widget-pack' ),
                    'lg' => __( 'Large', 'th-widget-pack' ),
                    'xl' => __( 'Extra Large', 'th-widget-pack' ),
                ],
                'default' => 'lg',
            ]
        );

        $this->add_responsive_control(
            'position',
            [
                'label' => __( 'Position', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'top',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'top' => [
                        'title' => __( 'Top', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position%s-',
                'toggle' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title & Description', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => __( 'Title HTML Tag', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __( 'H1', 'th-widget-pack' ),
                    'h2' => __( 'H2', 'th-widget-pack' ),
                    'h3' => __( 'H3', 'th-widget-pack' ),
                    'h4' => __( 'H4', 'th-widget-pack' ),
                    'h5' => __( 'H5', 'th-widget-pack' ),
                    'h6' => __( 'H6', 'th-widget-pack' ),
                ],
                'default' => 'h1',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title_divider',
            [
                'label' => __( 'Title Divider', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Show', 'th-widget-pack' ),
                'label_off' => __( 'Hide', 'th-widget-pack' ),
                'return_value' => 'yes',
                /*'condition' => [
                    'title_size' => 'h2',
                ],*/
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title Text', 'th-widget-pack' ),
                'placeholder' => __( 'Title Text', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => __( 'Description', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Nulla eget tortor ac ipsum gravida sollicitudin vel aliquet ligula. Phasellus vitae nisi at risus euismod.', 'th-widget-pack' ),
                'placeholder' => __( 'Your Description', 'th-widget-pack' ),
                'title' => __( 'Input icon text here', 'th-widget-pack' ),
                'rows' => 10,
                'separator' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );




        $this->add_responsive_control(
            'description_align',
            [
                'label' => __( 'Description Alignment', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
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
                'separator' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_buttons',
            [
                'label' => __( 'Buttons', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'button_1_heading',
            [
                'label' => __( 'Button 1', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'button_1_text',
            [
                'label' => __( 'Button Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Text', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_1_style',
            [
                'label' => __( 'Button Style', 'th-widget-pack' ),
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
            ]
        );


        $this->add_control(
            'button_1_image',
            [
                'label' => __( 'Button Graphic', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    //'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#buttonlink', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->add_control(
            'button_2_heading',
            [
                'label' => __( 'Button 2', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'button_2_text',
            [
                'label' => __( 'Button Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Text', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_2_style',
            [
                'label' => __( 'Button Style', 'th-widget-pack' ),
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
            ]
        );

        $this->add_control(
            'button_2_image',
            [
                'label' => __( 'Button Graphic', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    //'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_2_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#buttonlink', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => __( 'Alignment Override', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
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
                'separator' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .th-btn-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'th-widget-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'th-widget-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Divider Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-header-wrap .th-header-divider' => 'border-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'title_divider' => 'yes',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
            ]
        );

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'th-widget-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        $elm_animation = false;
        if ( ! empty( $settings['hover_animation'] ) ) {
            $elm_animation = 'elementor-animation-' . esc_attr( $settings['hover_animation'] );
        }
        $this->add_render_attribute( 'icon', 'class', ['elementor-icon', $elm_animation] );

		$icon_tag = 'span';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', esc_url( $settings['link']['url'] ) );
			$icon_tag = 'a';

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}
		}

        $this->add_render_attribute( 'th-icon-size', 'class', 'elementor-icon-box-icon' );
        $this->add_render_attribute( 'th-icon-size', 'class', 'th-icon-size-' . esc_attr( $settings['icon_size'] ) );

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

        // BUTTON 1

        // Graphic Button
        $button_1_image = false;
        if ( isset( $settings['button_1_image']['id'] ) && $settings['button_1_image']['id'] > "" ) {
            $button_1_image = wp_get_attachment_image( $settings['button_1_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
        }elseif ( ! empty( $settings['button_1_image']['url'] ) ) {
            $this->add_render_attribute( 'button_1_image', 'src', esc_url( $settings['button_1_image']['url'] ) );
            $this->add_render_attribute( 'button_1_image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['button_1_image'] ) ) );
            $this->add_render_attribute( 'button_1_image', 'title', esc_attr( Control_Media::get_image_title( $settings['button_1_image'] ) ) );
            $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_1_image' ) . '>';
        }

        // Graphic Button URL Styling
        if ( isset($button_1_image) && ! empty( $button_1_image ) ) {
            // image button
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-1' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-image' );
        }else{ // Bootstrap Button URL Styling
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-1' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-' . esc_attr( $settings['button_1_style'] ) );
        }

        // Button URL
        if ( empty( $settings['button_1_link']['url'] ) ) { $settings['button_1_link']['url'] = '#'; };

        if ( ! empty( $settings['button_1_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-1-link', 'href', esc_url( $settings['button_1_link']['url'] ) );

            if ( ! empty( $settings['button_1_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-1-link', 'target', '_blank' );
            }
        }

        // BUTTON 2

        // Graphic Button
        $button_2_image = false;
        if ( isset( $settings['button_2_image']['id'] ) && $settings['button_2_image']['id'] > "" ) {
            $button_2_image = wp_get_attachment_image( $settings['button_2_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
        }elseif ( ! empty( $settings['button_2_image']['url'] ) ) {
            $this->add_render_attribute( 'button_2_image', 'src', esc_url( $settings['button_2_image']['url'] ) );
            $this->add_render_attribute( 'button_2_image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['button_2_image'] ) ) );
            $this->add_render_attribute( 'button_2_image', 'title', esc_attr( Control_Media::get_image_title( $settings['button_2_image'] ) ) );
            $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_2_image' ) . '>';
        }

        // Graphic Button URL Styling
        if ( isset($button_2_image) && ! empty( $button_2_image ) ) {
            // image button
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-image' );
        }else{ // Bootstrap Button URL Styling
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-' . esc_attr( $settings['button_2_style'] ) );
        }

        // Button URL
        if ( empty( $settings['button_2_link']['url'] ) ) { $settings['button_2_link']['url'] = '#'; };

        if ( ! empty( $settings['button_2_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-2-link', 'href', esc_url( $settings['button_2_link']['url'] ) );

            if ( ! empty( $settings['button_2_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-2-link', 'target', '_blank' );
            }
        }

        $this->add_render_attribute( 'th-header-class', 'class', 'elementor-icon-box-title' );

        // Divider & Alignment Class
        
        if ( isset($settings['title_divider']) && 'yes' == $settings['title_divider'] ) {
            $this->add_render_attribute( 'th_divider_span', 'class', 'th-header-divider' );
        }

		?>
		<div class="th-header-wrap">
        <div class="elementor-icon-box-wrapper <?php if ( ( isset($settings['icon'] ) && $settings['icon'] > "" ) || (is_array( $settings['new_icon'] ) && !empty($settings['new_icon']['value'])) ){ echo "th-show-icon"; } ?>">
            <?php if ( ( isset($settings['icon'] ) && $settings['icon'] > "" ) || (is_array( $settings['new_icon'] ) && !empty($settings['new_icon']['value'])) ){ ?>
                <div <?php echo $this->get_render_attribute_string( 'th-icon-size' ); ?>>
                    <<?php echo wp_kses_post(implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] )); ?>>
                        <?php
                        // new icon render
                        $migrated = isset( $settings['__fa4_migrated']['new_icon'] );
                        $is_new = empty( $settings['icon'] );
                        if ( $is_new || $migrated ) {
                            \Elementor\Icons_Manager::render_icon( $settings['new_icon'], [ 'aria-hidden' => 'true' ] ); 
                        } else {
                            ?><i class="<?php echo $settings['icon']; ?>" aria-hidden="true" fff></i><?php
                        }
                        ?>
                    </<?php echo esc_attr( $icon_tag ); ?>>
                </div>
                <?php } ?>
                <div class="elementor-icon-box-content">
                    <<?php echo esc_attr($settings['title_size']); ?> <?php echo $this->get_render_attribute_string( 'th-header-class' );?>>
                        <<?php echo wp_kses_post(implode( ' ', [ $icon_tag, $link_attributes ] )); ?>><?php echo esc_html( $settings['title_text'] ); ?></<?php echo wp_kses_post($icon_tag); ?>>
                    </<?php echo esc_attr( $settings['title_size'] ); ?>>
                    <?php if ( isset($settings['title_divider']) && 'yes' == $settings['title_divider'] ) {?>
                        <span <?php echo $this->get_render_attribute_string( 'th_divider_span' ); ?>></span>
                    <?php } ?>
                    <p class="elementor-icon-box-description"><?php echo wp_kses_post( $settings['description_text'] ); ?></p>

                    <?php if ( ! empty( $settings['button_1_text'] ) || ! empty( $settings['button_2_text'] )  || ! empty($button_1_image) || ! empty( $button_2_image ) ) : ?>
                        <div class="th-btn-wrap">
                            <?php if ( isset($button_1_image) && ! empty( $button_1_image ) ) : ?>
                                <?php if ( ! empty( $settings['button_1_link']['url'] ) ) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                                        <?php echo wp_kses_post( $button_1_image ); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_kses_post( $button_1_image ); ?>
                                <?php endif; ?>
                            <?php elseif ( ! empty( $settings['button_1_text'] )  ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                                    <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
                                        <?php echo esc_html( $settings['button_1_text'] ); ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <?php if ( isset($button_2_image) && ! empty( $button_2_image ) ) : ?>
                                <?php if ( ! empty( $settings['button_2_link']['url'] ) ) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
                                        <?php echo wp_kses_post( $button_2_image ); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_kses_post( $button_2_image ); ?>
                                <?php endif; ?>
                            <?php elseif ( ! empty( $settings['button_2_text'] ) ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
                                    <?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
                                        <?php echo esc_html( $settings['button_2_text'] ); ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

		<?php
	}

	protected function _content_template() {
		?>

		<#
        iconHTML = elementor.helpers.renderIcon( view, settings.new_icon, { 'aria-hidden': true }, 'i' , 'object' ); 
        migrated = elementor.helpers.isIconMigrated( settings, 'new_icon' );
        var link = '',
        iconTag = 'span';
        icon_size = '';
        icon_show = '';
        var th_divder_span = '';
        var th_header_class = 'elementor-icon-box-title';

        // Divider & Alignment Class
        if ( settings.title_divider  && 'yes' == settings.title_divider  ) {
            var th_divder_span = "<span class='th-header-divider'></span>";
        }

        if ( settings.icon_size ) { var icon_size = 'th-icon-size-'+settings.icon_size }
        if ( settings.icon || settings.new_icon) { var icon_show = 'th-show-icon'}
                #>
        <div class="th-header-wrap">
            <div class="elementor-icon-box-wrapper {{ icon_show }}">
                <# if ( settings.icon || ( iconHTML.rendered && ( ! settings.icon || migrated ) ) ) { #>
                <div class="elementor-icon-box-icon {{ icon_size }}">
                    <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
                        <# if ( iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
					        {{{ iconHTML.value }}}
				        <# } else { #>
					        <i class="{{ settings.icon }}" aria-hidden="true"></i>
				        <# } #>
                    </{{{ iconTag }}}>
                </div>
                <# } #>
                <div class="elementor-icon-box-content">
                    <{{{ settings.title_size }}} class="{{{th_header_class}}}">
                        <{{{ iconTag + ' ' + link }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
                    </{{{ settings.title_size }}}>
                    {{{th_divder_span}}}
                    <p class="elementor-icon-box-description">{{{ settings.description_text }}}</p>

                    <#  var button_1_link_url = '#';
                        var button_1_text = '';

                        if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
                        if ( settings.button_1_text ) { var button_1_text = settings.button_1_text }


                        var button_2_link_url = '#';
                        var button_2_text = '';

                        if ( settings.button_2_link.url ) { var button_2_link_url = settings.button_2_link.url }
                        if ( settings.button_2_text ) { var button_2_text = settings.button_2_text }

                    #>

                        <# if ( button_1_text || button_2_text || settings.button_1_image || settings.button_2_image) { #>
                        <div class="th-btn-wrap">
                            <# if ( settings.button_1_image && '' !== settings.button_1_image.url ) { #>
                                <a class="btn-1 th-btn btn-image" href="{{ button_1_link_url }}">
                                    <img src="{{{ settings.button_1_image.url }}}" />
                                </a>
                            <# } else if ( button_1_text ) { #>
                                <a class="btn btn-1 th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
                                    {{{ settings.button_1_text }}}
                                </a>
                            <# } #>
                            <# if ( settings.button_2_image && '' !== settings.button_2_image.url ) { #>
                                <a class="btn-2 th-btn btn-image" href="{{ button_2_link_url }}">
                                    <img src="{{{ settings.button_2_image.url }}}" />
                                </a>
                            <# } else if ( button_2_text ) { #>
                                <a class="btn btn-2 th-btn btn-{{ settings.button_2_style }}" href="{{ button_2_link_url }}">
                                    {{{ settings.button_2_text }}}
                                </a>
                            <# } #>
                        </div>
                    <# } #>
                </div>
            </div>
        </div>

		<?php
	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets[ $this->get_name() ] = [
			'conditions' => [ 'widgetType' => $this->get_name() ],
			'fields'     => [
				[
					'field'       => 'title_text',
					'type'        => __( 'Title Text', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'description_text',
					'type'        => __( 'Description Text', 'th-widget-pack' ),
					'editor_type' => 'AREA'
				],
                [
					'field'       => 'button_1_text',
					'type'        => __( 'Button Text', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
                'button_1_link' => [
                    'field'        => 'url',
                    'field_id'    => 'button_1_link', // New key
                    'type'        => __('Button URL 1', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
				[
					'field'       => 'button_2_text',
					'type'        => __( 'Button Text', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],

                'button_2_link' => [
                    'field'        => 'url',
                    'field_id'    => 'button_2_link', // New key
                    'type'        => __('Button URL 2', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
			],
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Header() );
