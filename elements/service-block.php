<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_ServiceBlock extends Widget_Base {

	public function get_name() {
		return 'themo-service-block';
	}

	public function get_title() {
		return __( 'Service Block', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
	protected function _register_controls() {

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
        //         'default' => 'th-linea icon-basic-star',
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
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
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
                'default' => 'md',
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
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'th-widget-pack' ),
                'placeholder' => __( 'Title', 'th-widget-pack' ),
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
                'default' => __( 'Maecenas accumsan, elit id hendrerit convallis, lectus lacus fermentum nisi.', 'th-widget-pack' ),
                'placeholder' => __( 'Add a description', 'th-widget-pack' ),
                'title' => __( 'Input icon text here', 'th-widget-pack' ),
                'rows' => 10,
                'separator' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
            ]
        );



        $this->add_control(
            'link',
            [
                'label' => __( 'Link to', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();


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
                'selectors' => [
                    '{{WRAPPER}} .th-service-block-w' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .th-service-block-w' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto; margin-left:0;',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto; margin-right:0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Content Alignment', 'th-widget-pack' ),
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
                'selectors' => [
                    '{{WRAPPER}} .th-service-block-w .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
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
				'label' => __( 'Color', 'th-widget-pack' ),
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
                'dynamic' => [
                    'active' => true,
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
                'dynamic' => [
                    'active' => true,
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
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title span' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
                'dynamic' => [
                    'active' => true,
                ],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title span',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'label' => 'Typography',
			]
		);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'section_content_title_shadow',
                'label' => 'Text Shadow',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title span',
            ]
        );

        $this->add_responsive_control(
            'section_title_space_above',
            [
                'label' => __( 'Space Above', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
                'dynamic' => [
                    'active' => true,
                ],
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
				'label' => __( 'Color', 'th-widget-pack' ),
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
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description, {{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a',
            ]
        );

        $this->add_responsive_control(
            'section_description_space_above',
            [
                'label' => __( 'Space Above', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'margin-top: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        $elm_animation = false;
        if ( ! empty( $settings['hover_animation'] ) ) {
            $elm_animation = 'elementor-animation-' . esc_attr( $settings['hover_animation'] );
        }
        $this->add_render_attribute('icon', 'class', ['elementor-icon', $elm_animation] );

        $icon_tag = 'span';

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'link', 'href', esc_url( $settings['link']['url'] ) );
            $icon_tag = 'a';

            if ( ! empty( $settings['link']['is_external'] ) ) {
                $this->add_render_attribute( 'link', 'target', '_blank' );
            }
        }

        $this->add_render_attribute( 'th-icon-size', 'class', 'elementor-icon-box-icon' );
        $this->add_render_attribute( 'th-icon-size', 'class', 'th-icon-size-'. esc_attr( $settings['icon_size'] ) );

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		?>
		<div class="th-service-block-w">
            <div class="elementor-icon-box-wrapper <?php if ( ( isset($settings['icon'] ) && $settings['icon'] > "") || is_array( $settings['new_icon'] ) ){ echo "th-show-icon"; } ?>">
                <?php if ( ( isset($settings['icon'] ) && $settings['icon'] > "" ) || is_array( $settings['new_icon'] ) ){ ?>
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
                        </<?php echo esc_attr($icon_tag); ?>>
                    </div>
                <?php } ?>
                <div class="elementor-icon-box-content">
                    <<?php echo esc_attr($settings['title_size']); ?> class="elementor-icon-box-title">
                        <<?php echo wp_kses_post(implode( ' ', [ $icon_tag, $link_attributes ] )); ?>><?php echo esc_html( $settings['title_text'] ); ?></<?php echo esc_attr( $icon_tag ); ?>>
                    </<?php echo esc_attr( $settings['title_size'] ); ?>>
                    <p class="elementor-icon-box-description"><?php echo wp_kses_post( $settings['description_text'] ); ?></p>
                </div>
            </div>

        </div>

		<?php
	}

	protected function _content_template() {
		?>
        <#
        var iconHTML = elementor.helpers.renderIcon( view, settings.new_icon, { 'aria-hidden': true }, 'i' , 'object' );
        migrated = elementor.helpers.isIconMigrated( settings, 'new_icon' );
        var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
        iconTag = link ? 'a' : 'span';
        icon_size = '';
        icon_show = '';
        if ( settings.icon_size ) { var icon_size = 'th-icon-size-'+settings.icon_size }
        if ( settings.icon || settings.new_icon) { var icon_show = 'th-show-icon'}

        #>
        <div class="th-service-block-w">
            <div class="elementor-icon-box-wrapper {{ icon_show }}">
                <div class="elementor-icon-box-icon {{ icon_size }}">
                    <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
                        <# if ( iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
					        {{{ iconHTML.value }}}
				        <# } else { #>
					        <i class="{{ settings.icon }}" aria-hidden="true"></i>
				        <# } #>
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

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets[ $this->get_name() ] = [
			'conditions' => [ 'widgetType' => $this->get_name() ],
			'fields'     => [
				[
					'field'       => 'title_text',
					'type'        => __( 'Title', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'description_text',
					'type'        => __( 'Description', 'th-widget-pack' ),
					'editor_type' => 'AREA'
				],
                'link' => [
                    'field'        => 'url',
                    'field_id'    => 'link', // New key
                    'type'        => __('Link to', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
			],
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_ServiceBlock() );
