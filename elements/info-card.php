<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Info_Card extends Widget_Base {

	public function get_name() {
		return 'themo-info-card';
	}

	public function get_title() {
		return __( 'Info Card', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
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
                    '{{WRAPPER}} .th-info-card-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .th-info-card-wrap' => '{{VALUE}}',
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
                    '{{WRAPPER}} .th-info-card-wrap' => 'text-align: {{VALUE}};',
                ],
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
            'title_text',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'th-widget-pack' ),
                'placeholder' => __( 'Title', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_buttons',
            [
                'label' => __( 'Links', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'button_1_text',
            [
                'label' => __( 'Link 1 Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'More Info', 'th-widget-pack' ),
                'placeholder' => __( 'Link Text', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => __( 'Link 1', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#link', 'th-widget-pack' ),
                'separator' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->add_control(
            'button_2_text',
            [
                'label' => __( 'Link 2 Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Link Text', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_2_link',
            [
                'label' => __( 'Link 2', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#link', 'th-widget-pack' ),
                'separator' => 'none',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_bg',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .th-info-card-wrap' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
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
            'section_title_heading',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
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
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
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
            'section_content_heading',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
            ]
        );

        $this->add_control(
            'section_link_1_heading',
            [
                'label' => __( 'Link 1', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'link_1_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-btn-wrap a.th-btn-1' => 'color: {{VALUE}};',
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
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_link_1_typography',
                'selector' => '{{WRAPPER}} .th-btn-wrap a.th-btn-1',
            ]
        );

        $this->add_control(
            'section_link_2_heading',
            [
                'label' => __( 'Link 2', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'link_2_color',
            [
                'label' => __( 'Link 2 Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-btn-wrap a.th-btn-2' => 'color: {{VALUE}};',
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
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_link_2_typography',
                'selector' => '{{WRAPPER}} .th-btn-wrap a.th-btn-2',
            ]
        );

        $this->add_control(
            'section_appearance_heading',
            [
                'label' => __( 'Appearance', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'section_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-info-card-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_border_content',
            [
                'label' => __( 'Border', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .th-info-card-wrap',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-info-card-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .th-info-card-wrap',
            ]
        );
        
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();


        if ( empty( $settings['button_1_link']['url'] ) ) { $settings['button_1_link']['url'] = '#'; };
        if ( empty( $settings['button_2_link']['url'] ) ) { $settings['button_2_link']['url'] = '#'; };

        $this->add_render_attribute( 'btn-1-link', 'class', 'th-btn-1' );

        if ( ! empty( $settings['button_1_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-1-link', 'href', esc_url( $settings['button_1_link']['url'] ) );

            if ( ! empty( $settings['button_1_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-1-link', 'target', '_blank' );
            }
        }

        $this->add_render_attribute( 'btn-2-link', 'class', 'th-btn-2' );

        if ( ! empty( $settings['button_2_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-2-link', 'href', esc_url( $settings['button_2_link']['url'] ) );

            if ( ! empty( $settings['button_2_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-2-link', 'target', '_blank' );
            }
        }

		?>
		<div class="th-info-card-wrap">
            <div class="elementor-icon-box-wrapper">
                <div class="elementor-icon-box-content">
                    <h3 class="elementor-icon-box-title"><?php echo esc_html( $settings['title_text'] ); ?></h3>
                    <p class="elementor-icon-box-description"><?php echo wp_kses_post( $settings['description_text'] ); ?></p>
                </div>
                <?php if ( ! empty( $settings['button_1_text'] ) || ! empty( $settings['button_2_text'] ) ) : ?>
                <div class="th-btn-wrap">
                    <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                            <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
                                <?php echo esc_html( $settings['button_1_text'] ); ?>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
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

		<?php
	}

	protected function _content_template() {
		?>

		<#
        var link = '',
        iconTag = 'span'; #>
        <div class="th-info-card-wrap">
            <div class="elementor-icon-box-wrapper">
                <div class="elementor-icon-box-content">
                    <h3 class="elementor-icon-box-title">{{{ settings.title_text }}}</h3>
                    <p class="elementor-icon-box-description">{{{ settings.description_text }}}</p>
                </div>


                <#  var button_1_link_url = '#';
                    var button_1_text = '';
                    if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
                    if ( settings.button_1_text ) { var button_1_text = settings.button_1_text }

                    var button_2_link_url = '#';
                    var button_2_text = '';
                    if ( settings.button_2_link.url ) { var button_2_link_url = settings.button_2_link.url }
                    if ( settings.button_2_text ) { var button_2_text = settings.button_2_text }
                #>
                <# if ( button_1_text || button_2_text ) { #>
                <div class="th-btn-wrap">
                    <# if ( button_1_text ) { #>
                        <a class="th-btn-1" href="{{ button_1_link_url }}">
                            {{{ settings.button_1_text }}}
                        </a>
                    <# } #>
                    <# if ( button_2_text ) { #>
                        <a class="th-btn-2" href="{{ button_2_link_url }}">
                            {{{ settings.button_2_text }}}
                        </a>
                    <# } #>
                </div>
                <# } #>
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
                    'type'        => __('Link 1', 'th-widget-pack'),
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
                    'type'        => __('Link 2', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
			],
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Info_Card() );
