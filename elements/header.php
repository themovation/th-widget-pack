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
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
            'section_align',
            [
                'label' => __( 'Position', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
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
            ]
        );

        $this->add_control(
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

        $this->add_control(
            'icon',
            [
                'label' => __( 'Choose Icon', 'th-widget-pack' ),
                'type' => Controls_Manager::ICON,
                //'default' => 'fa fa-star',
				'icons' => themo_icons(),
				'include' => themo_fa_icons()
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

        $this->add_control(
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
                'prefix_class' => 'elementor-position-',
                'toggle' => false,
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
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Discover the great outdoors', 'th-widget-pack' ),
                'placeholder' => __( 'Discover the great outdoors', 'th-widget-pack' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => __( 'Description', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Come and join the thrill and excitement of white water rafting with the adventure rafting team!', 'th-widget-pack' ),
                'placeholder' => __( 'Your Description', 'th-widget-pack' ),
                'title' => __( 'Input icon text here', 'th-widget-pack' ),
                'rows' => 10,
                'separator' => 'none',
            ]
        );


        $this->add_responsive_control(
            'description_align',
            [
                'label' => __( 'Description Alignment Override', 'th-widget-pack' ),
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
                'default' => __( 'View All Tours', 'th-widget-pack' ),
                'placeholder' => __( 'View All Tours', 'th-widget-pack' ),
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
            'button_1_icon',
            [
                'label' => __( 'Icon', 'th-widget-pack' ),
                'type' => Controls_Manager::ICON,
				'icons' => themo_icons(),
				'include' => themo_fa_icons()
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#booktour', 'th-widget-pack' ),
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
                'placeholder' => __( 'Book Tour', 'th-widget-pack' ),
                //'default' => __( 'Book Tour', 'th-widget-pack' ),
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
            'button_2_icon',
            [
                'label' => __( 'Icon', 'th-widget-pack' ),
                'type' => Controls_Manager::ICON,
				'icons' => themo_icons(),
				'include' => themo_fa_icons()
            ]
        );

        $this->add_control(
            'button_2_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#booktour', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
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

        $elm_animation = false;
        if ( ! empty( $settings['hover_animation'] ) ) {
            $elm_animation = 'elementor-animation-' . $settings['hover_animation'];
        }
        $this->add_render_attribute('icon', 'class', ['elementor-icon', $elm_animation]);

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
                <?php if (isset($settings['icon']) && $settings['icon'] > ""){ ?>
                <div <?php echo $this->get_render_attribute_string( 'th-icon-size' ); ?>>
                    <<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
                        <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
                    </<?php echo $icon_tag; ?>>
                </div>
                <?php } ?>
                <div class="elementor-icon-box-content">
                    <<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
                        <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
                    </<?php echo $settings['title_size']; ?>>
                    <p class="elementor-icon-box-description"><?php echo $settings['description_text']; ?></p>

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
                    <?php endif; ?>
                </div>
            </div>

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
                <# if ( settings.icon ) { #>
                <div class="elementor-icon-box-icon {{ icon_size }}">
                    <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
                        <i class="{{ settings.icon }}"></i>
                    </{{{ iconTag }}}>
                </div>
                <# } #>
                <div class="elementor-icon-box-content">
                    <{{{ settings.title_size }}} class="elementor-icon-box-title">
                        <{{{ iconTag + ' ' + link }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
                    </{{{ settings.title_size }}}>
                    <p class="elementor-icon-box-description">{{{ settings.description_text }}}</p>

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
        </div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Header() );
