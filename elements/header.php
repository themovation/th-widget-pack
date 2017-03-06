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
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-header-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .th-header-wrap' => '{{VALUE}}',
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
                    '{{WRAPPER}} .th-header-wrap' => 'text-align: {{VALUE}};',
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
                'default' => 'lg',
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



        /*$this->add_control(
            'description_align_override',
            [
                'label' => __( 'Description Alignment Override', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
                'return_value' => 'yes',
            ]
        );*/

        $this->add_responsive_control(
            'description_align',
            [
                'label' => __( 'Description Alignment Override', 'elementor' ),
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
                ],
                //'condition' => [
                 //   'description_align_override' => 'yes',
                //],
                'separator' => 'none',
                //'show_label' => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-description' => 'text-align: {{VALUE}};',
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
            'button_1_text',
            [
                'label' => __( 'Button Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Book Tour', 'elementor' ),
                'placeholder' => __( 'Book Tour', 'elementor' ),
            ]
        );

        $this->add_control(
            'button_1_style',
            [
                'label' => __( 'Button Style', 'elementor' ),
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
            ]
        );

        $this->add_control(
            'button_1_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => __( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#booktour', 'elementor' ),
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
            'button_2_text',
            [
                'label' => __( 'Button Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Book Tour', 'elementor' ),
                //'default' => __( 'Book Tour', 'elementor' ),
            ]
        );

        $this->add_control(
            'button_2_style',
            [
                'label' => __( 'Button Style', 'elementor' ),
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
            ]
        );

        $this->add_control(
            'button_2_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'button_2_link',
            [
                'label' => __( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#booktour', 'elementor' ),
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => __( 'Alignment Override', 'elementor' ),
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


        if ( empty( $settings['button_1_link']['url'] ) ) { $settings['button_1_link']['url'] = '#'; };
        if ( empty( $settings['button_2_link']['url'] ) ) { $settings['button_2_link']['url'] = '#'; };

        $this->add_render_attribute( 'btn-1-link', 'class', 'btn-1' );
        $this->add_render_attribute( 'btn-1-link', 'class', 'btn' );
        $this->add_render_attribute( 'btn-1-link', 'class', 'th-btn' );
        $this->add_render_attribute( 'btn-1-link', 'class', 'btn-' . esc_attr($settings['button_1_style']) );

        if ( ! empty( $settings['button_1_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-1-link', 'href', esc_url($settings['button_1_link']['url']) );

            if ( ! empty( $settings['button_1_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-1-link', 'target', '_blank' );
            }
        }

        $this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
        $this->add_render_attribute( 'btn-2-link', 'class', 'btn' );
        $this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
        $this->add_render_attribute( 'btn-2-link', 'class', 'btn-' . esc_attr($settings['button_2_style']) );

        if ( ! empty( $settings['button_2_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-2-link', 'href', esc_url($settings['button_2_link']['url']) );

            if ( ! empty( $settings['button_2_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-2-link', 'target', '_blank' );
            }
        }

		?>
		<div class="th-header-wrap">
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

                <?php if ( ! empty( $settings['button_1_text']) ||  ! empty( $settings['button_1_icon']) || ! empty( $settings['button_2_text']) ||  ! empty( $settings['button_2_icon'])) : ?>
                <div class="th-btn-wrap">
                    <?php if ( ! empty( $settings['button_1_text']) ||  ! empty( $settings['button_1_icon'])) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                            <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
                                <?php echo esc_html( $settings['button_1_text'] ); ?>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['button_1_icon'] ) ) : ?>
                                <i class="<?php echo esc_attr( $settings['button_1_icon'] ); ?>"></i>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['button_2_text']) ||  ! empty( $settings['button_2_icon'])) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
                            <?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
                                <?php echo esc_html( $settings['button_2_text'] ); ?>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['button_2_icon'] ) ) : ?>
                                <i class="<?php echo esc_attr( $settings['button_2_icon'] ); ?>"></i>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

		<?php
	}

	protected function _content_template() {
		?>

		<#
        var link = '',
        iconTag = 'span';
        icon_size = '';
        if ( settings.icon_size ) { var icon_size = 'th-icon-size-'+settings.icon_size }
                #>
        <div class="th-header-wrap">
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


        <#  var button_1_link_url = '#';
            var button_1_text = '';
            var button_1_icon = '';
            if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
            if ( settings.button_1_text ) { var button_1_text = settings.button_1_text }
            if ( settings.button_1_icon ) { var button_1_icon = settings.button_1_icon }

            var button_2_link_url = '#';
            var button_2_text = '';
            var button_2_icon = '';
            if ( settings.button_2_link.url ) { var button_2_link_url = settings.button_2_link.url }
            if ( settings.button_2_text ) { var button_2_text = settings.button_2_text }
            if ( settings.button_2_icon ) { var button_2_icon = settings.button_2_icon }
        #>
        <# if ( button_1_text || button_1_icon || button_2_text || button_2_icon ) { #>
            <div class="th-btn-wrap">
                <# if ( button_1_text || button_1_icon ) { #>
                    <a class="btn btn-1 th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
                        {{{ settings.button_1_text }}}
                        <# if ( settings.button_1_icon ) { #>
                            <i class="{{ settings.button_1_icon }}"></i>
                        <# } #>
                    </a>
                <# } #>
                <# if ( button_2_text || button_2_icon  ) { #>
                    <a class="btn btn-2 th-btn btn-{{ settings.button_2_style }}" href="{{ button_2_link_url }}">
                        {{{ settings.button_2_text }}}
                        <# if ( settings.button_2_icon ) { #>
                            <i class="{{ settings.button_2_icon }}"></i>
                        <# } #>
                    </a>
                <# } #>
            </div>
        <# } #>
        </div>
        </div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Header() );
