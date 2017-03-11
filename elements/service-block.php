<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_ServiceBlock extends Widget_Base {

	public function get_name() {
		return 'themo-service-block';
	}

	public function get_title() {
		return __( 'Service Block', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
            'section_align',
            [
                'label' => __( 'Position', 'elementor' ),
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
                /*'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],*/
                'selectors' => [
                    '{{WRAPPER}} .th-service-block-w' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'header_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .th-service-block-w' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Content Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                    '{{WRAPPER}} .th-service-block-w .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

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
                'default' => 'fa fa-bus',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'elementor' ),
                    'stacked' => __( 'Filled', 'elementor' ),
                    'framed' => __( 'Framed', 'elementor' ),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => __( 'Shape', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __( 'Circle', 'elementor' ),
                    'square' => __( 'Square', 'elementor' ),
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
                'label' => __( 'Icon Size', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'sm' => __( 'Small', 'elementor' ),
                    'lg' => __( 'Large', 'elementor' ),
                ],
                'default' => 'sm',
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
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Free Shuttle', 'elementor' ),
                'placeholder' => __( 'Free Shuttle', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Shuttle to and from rafting trip. Store your belongings safely.', 'elementor' ),
                'placeholder' => __( 'Shuttle to and from rafting trip. Store your belongings safely.', 'elementor' ),
                'title' => __( 'Input icon text here', 'elementor' ),
                'rows' => 10,
                'separator' => 'none',
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_link',
            [
                'label' => __( 'Lnk', 'elementor' ),
            ]
        );



        $this->add_control(
            'link',
            [
                'label' => __( 'Link to', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'elementor' ),
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

        $this->add_render_attribute( 'th-icon-size', 'class', 'elementor-icon-box-icon' );
        $this->add_render_attribute( 'th-icon-size', 'class', 'th-icon-size-'.$settings['icon_size'] );

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		?>
		<div class="th-service-block-w">
            <div class="elementor-icon-box-wrapper">
                <div <?php echo $this->get_render_attribute_string( 'th-icon-size' ); ?>>
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

        </div>

		<?php
	}

	protected function _content_template() {
		?>

        <#
        var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
        iconTag = link ? 'a' : 'span';
        icon_size = '';
        if ( settings.icon_size ) { var icon_size = 'th-icon-size-'+settings.icon_size }
        #>
        <div class="th-service-block-w">
            <div class="elementor-icon-box-wrapper">
                <div class="elementor-icon-box-icon {{ icon_size }}">
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
        </div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_ServiceBlock() );
