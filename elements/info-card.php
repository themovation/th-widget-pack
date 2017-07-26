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
                    '{{WRAPPER}} .th-info-card-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .th-info-card-wrap' => '{{VALUE}}',
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



        /*$this->add_control(
            'description_align_override',
            [
                'label' => __( 'Description Alignment Override', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
            ]
        );*/



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
                'default' => __( 'View All Tours', 'th-widget-pack' ),
                'placeholder' => __( 'View All Tours', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => __( 'Link 1', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#booktour', 'th-widget-pack' ),
                'separator' => 'none',
            ]
        );


        $this->add_control(
            'button_2_text',
            [
                'label' => __( 'Link 2 Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Book Tour', 'th-widget-pack' ),
                //'default' => __( 'Book Tour', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'button_2_link',
            [
                'label' => __( 'Link 2', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#booktour', 'th-widget-pack' ),
                'separator' => 'none',
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
				'label' => __( 'Colors', 'th-widget-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

        $this->add_control(
            'link_1_color',
            [
                'label' => __( 'Link 1 Color', 'th-widget-pack' ),
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

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();


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
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Info_Card() );
