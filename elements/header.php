<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Header extends Widget_Base {

	public function get_name() {
		return 'themo-header';
	}

	public function get_title() {
		return __( 'Header', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
			]
		);

        $this->add_control(
            'icon',
            [
                'label' => __( 'Choose Icon', 'elementor' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'elementor' ),
                    'stacked' => __( 'Stacked', 'elementor' ),
                    'framed' => __( 'Framed', 'elementor' ),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => __( 'Position', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'top',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'top' => [
                        'title' => __( 'Top', 'elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle' => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title & Description', 'elementor' ),
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __( 'H1', 'elementor' ),
                    'h2' => __( 'H2', 'elementor' ),
                    'h3' => __( 'H3', 'elementor' ),
                    'h4' => __( 'H4', 'elementor' ),
                    'h5' => __( 'H5', 'elementor' ),
                    'h6' => __( 'H6', 'elementor' ),
                ],
                'default' => 'h1',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'This is the heading', 'elementor' ),
                'placeholder' => __( 'Your Title', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
                'placeholder' => __( 'Your Description', 'elementor' ),
                'title' => __( 'Input icon text here', 'elementor' ),
                'rows' => 10,
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => __( 'Justified', 'elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'separator' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_align_override',
            [
                'label' => __( 'Description Alignment Override', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'description_align',
            [
                'label' => __( 'Description Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => __( 'Justified', 'elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'condition' => [
                    'description_align_override' => 'yes',
                ],
                'separator' => 'none',
                'show_label' => false,
                /*'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
                ],*/
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} #main-flex-slider {{CURRENT_ITEM}} .slider-bg .th-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_buttons',
            [
                'label' => __( 'Buttons', 'elementor' ),
            ]
        );

        $this->add_control(
            'button_1_heading',
            [
                'label' => __( 'Button 1', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'slide_button_text_1',
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'elementor' ),
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'slide_button_style_1',
            [
                'label' => __( 'Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-light',
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
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'slide_button_link_1',
            [
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'elementor' ),
                'separator' => 'none',
            ]
        );


        $this->add_control(
            'button_2_heading',
            [
                'label' => __( 'Button 2', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'slide_button_text_2',
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'More Info', 'elementor' ),
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'slide_button_style_2',
            [
                'label' => __( 'Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-light',
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
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'slide_button_link_2',
            [
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'elementor' ),
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
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
                'prefix_class' => 'th-btn-align-',
                'default' => '',
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();


		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
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
				'label' => __( 'Secondary Color', 'elementor' ),
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


		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'small' => __( 'Small', 'elementor' ),
                    'large' => __( 'Large', 'elementor' ),
                ],
                'default' => 'large',
			]
		);




		$this->end_controls_section();



		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
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


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}
		}

		$this->add_render_attribute( 'i', 'class', $settings['icon'] );

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );
		?>
		<div class="elementor-icon-box-wrapper">
			<div class="elementor-icon-box-icon">
				<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
					<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
				</<?php echo $icon_tag; ?>>
			</div>
			<div class="elementor-icon-box-content">
				<<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
				</<?php echo $settings['title_size']; ?>>
				<p class="elementor-icon-box-description"><?php echo $settings['description_text']; ?></p>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<# var link = '',
				iconTag = 'span'; #>
		<div class="elementor-icon-box-wrapper">
			<div class="elementor-icon-box-icon">
				<{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
					<i class="{{ settings.icon }}"></i>
				</{{{ iconTag }}}>
			</div>
			<div class="elementor-icon-box-content">
				<{{{ settings.title_size }}} class="elementor-icon-box-title">
					<{{{ iconTag + ' ' + link }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
				</{{{ settings.title_size }}}>
				<p class="elementor-icon-box-description">{{{ settings.description_text }}}</p>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Header() );
