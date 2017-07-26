<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Pricing extends Widget_Base {

	public function get_name() {
		return 'themo-pricing';
	}

	public function get_title() {
		return __( 'Pricing', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-price-table';
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
			'section_pricing',
			[
				'label' => __( 'Pricing Table', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'pricing',
			[
				'label' => __( 'Pricing Table', 'th-widget-pack' ),
				'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'price_col_title' => __( '1 Hour Tour', 'th-widget-pack' ),
                        'price_col_sub_title' => __( '3 People +', 'th-widget-pack' ),
                        'price_col_price' => __( '$59', 'th-widget-pack' ),
                        'price_col_text' => __( '/person', 'th-widget-pack' ),
                        'price_col_description' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'th-widget-pack' ),
                        'price_col_button_1_show' => __( 'yes', 'th-widget-pack' ),
                        'price_col_button_1_text' => __( 'BOOK THIS TOUR', 'th-widget-pack' ),
                        'price_col_button_1_style' => __( 'ghost-primary', 'th-widget-pack' ),
                        'price_col_button_1_link' => __( '#book', 'th-widget-pack' ),
                    ],
                    [
                        'price_col_title' => __( '2 Hour Tour', 'th-widget-pack' ),
                        'price_col_sub_title' => __( '3 People +', 'th-widget-pack' ),
                        'price_col_price' => __( '$79', 'th-widget-pack' ),
                        'price_col_text' => __( '/person', 'th-widget-pack' ),
                        'price_col_description' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'th-widget-pack' ),
                        'price_col_button_1_show' => __( 'yes', 'th-widget-pack' ),
                        'price_col_button_1_text' => __( 'BOOK THIS TOUR', 'th-widget-pack' ),
                        'price_col_button_1_style' => __( 'ghost-light', 'th-widget-pack' ),
                        'price_col_button_1_link' => __( '#book', 'th-widget-pack' ),
                        'price_col_featured' => __( 'yes', 'th-widget-pack' ),
                    ],
                    [
                        'price_col_title' => __( '3 Hour Tour', 'th-widget-pack' ),
                        'price_col_sub_title' => __( '3 People +', 'th-widget-pack' ),
                        'price_col_price' => __( '$99', 'th-widget-pack' ),
                        'price_col_text' => __( '/person', 'th-widget-pack' ),
                        'price_col_description' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'th-widget-pack' ),
                        'price_col_button_1_show' => __( 'yes', 'th-widget-pack' ),
                        'price_col_button_1_text' => __( 'BOOK THIS TOUR', 'th-widget-pack' ),
                        'price_col_button_1_style' => __( 'ghost-primary', 'th-widget-pack' ),
                        'price_col_button_1_link' => __( '#book', 'th-widget-pack' ),
                    ],

                ],
				'fields' => [
					[
						'name' => 'price_col_title',
						'label' => __( 'Title', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
						//'default' => __( '1 hour tour', 'th-widget-pack' ),
                        'placeholder' => __( '1 hour tour', 'th-widget-pack' ),
						'label_block' => true,
					],
                    [
                        'name' => 'price_col_sub_title',
                        'label' => __( 'Sub Title', 'th-widget-pack' ),
                        'type' => Controls_Manager::TEXT,
                        //'default' => __( '3 People +', 'th-widget-pack' ),
                        'placeholder' => __( '3 People +', 'th-widget-pack' ),
                        'label_block' => true,
                    ],
					[
						'name' => 'price_col_price',
						'label' => __( 'Price', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
                        //'default' => __( '$99', 'th-widget-pack' ),
                        'placeholder' => __( '$99', 'th-widget-pack' ),
						'label_block' => true,
					],
					[
						'name' => 'price_col_text',
						'label' => __( 'Price text', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
                        //'default' => __( '/person', 'th-widget-pack' ),
                        'placeholder' => __( '/person', 'th-widget-pack' ),
						'label_block' => true,
					],
					[
						'name' => 'price_col_description',
						'label' => __( 'Description', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXTAREA,
                        //'default' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'th-widget-pack' ),
						'placeholder' => __( "Return Shuttle\nBasic Training & Safety\nFull Safety Suits\nFood Provided", 'th-widget-pack' ),
						'label_block' => true,
					],
                    [
                        'name' => 'price_col_button_1_show',
                        'label' => __( 'Button 1', 'th-widget-pack' ),
                        //'default' => 'yes',
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'th-widget-pack' ),
                        'label_off' => __( 'No', 'th-widget-pack' ),
                        'return_value' => 'yes',
                        'separator' => 'before',
                    ],
					[
						'name' => 'price_col_button_1_text',
						'label' => __( 'Button 1 Text', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
						//'default' => __( 'BOOK THIS TOUR', 'th-widget-pack' ),
						'placeholder' => __( 'BOOK THIS TOUR', 'th-widget-pack' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
					],
                    [
                        'name' => 'price_col_button_1_style',
                        'label' => __( 'Button 1 Style', 'th-widget-pack' ),
                        'type' => Controls_Manager::SELECT,
                        //'default' => 'cta-accent',
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
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
					[
						'name' => 'price_col_button_1_link',
						'label' => __( 'Button 1 Link', 'th-widget-pack' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_1_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
					],
                    [
                        'name' => 'price_col_button_2_show',
                        'label' => __( 'Button 2', 'th-widget-pack' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'th-widget-pack' ),
                        'label_off' => __( 'No', 'th-widget-pack' ),
                        'return_value' => 'yes',
                        //'default' => '',
                        'separator' => 'before',
                    ],
                    [
                        'name' => 'price_col_button_2_text',
                        'label' => __( 'Button 2 Text', 'th-widget-pack' ),
                        'type' => Controls_Manager::TEXT,
                        //'default' => __( 'Click Here', 'th-widget-pack' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_2_style',
                        'label' => __( 'Button 2 Style', 'th-widget-pack' ),
                        'type' => Controls_Manager::SELECT,
                        //'default' => 'standard-primary',
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
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_button_2_link',
                        'label' => __( 'Button 2 Link', 'th-widget-pack' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'price_col_button_2_show',
                                    'operator' => '==',
                                    'value' => 'yes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'price_col_featured',
                        'label' => __( 'Featured', 'th-widget-pack' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'th-widget-pack' ),
                        'label_off' => __( 'No', 'th-widget-pack' ),
                        'return_value' => 'yes',
                        //'default' => '',
                        'separator' => 'before',
                    ],
                    [
                        'name' => 'price_col_background',
                        'label' => __( 'Background Color', 'th-widget-pack' ),
                        'type' => Controls_Manager::COLOR,
                        //'default' => '#FFF',
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                        ],
                    ],
				],
				'title_field' => '{{{ price_col_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-pricing-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-cost' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label' => __( 'Price Text Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-cost span' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-pricing-features ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_featured',
			[
				'label' => __( 'Featured', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'featured_title_color',
			[
				'label' => __( 'Title Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'featured_sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-highlight .th-pricing-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );


		$this->add_control(
			'featured_price_color',
			[
				'label' => __( 'Price Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-cost' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'featured_price_text_color',
			[
				'label' => __( 'Price Text Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-cost span' => 'color: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'featured_description_color',
			[
				'label' => __( 'Description Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-highlight .th-pricing-features ul li' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['pricing'] ) ) {
			return;
		}

		$column_number = sizeof( $settings['pricing'] );

		switch( $column_number ) {
			case 1:
				$table_class = ' th-one-col';
				$column_class = ' col-sm-6 col-sm-offset-3';
				break;
			case 2:
				$table_class = ' th-two-col';
				$column_class = ' col-sm-6';
				break;
			case 3:
				$table_class = ' th-three-col';
				$column_class = ' col-md-4 col-sm-6';
				break;
			case 4:
				$table_class = ' th-four-col';
				$column_class = ' col-md-3 col-sm-6';
				break;
			case 5:
				$table_class = ' th-five-col';
				$column_class = ' col-md-2 col-sm-6';
				break;
			case 6:
				$table_class = ' th-six-col';
				$column_class = ' col-md-2 col-sm-6';
				break;
			default:
				$table_class = '';
				$column_class = '';
		}
		?>

		<div class="th-pricing-table<?php echo esc_attr( $table_class ); ?>">

			<div class="row">

				<?php foreach( $settings['pricing'] as $column ) { ?>

                    <div class="elementor-repeater-item-<?php echo esc_attr( $column['_id'] ) ?> th-pricing-column<?php echo( esc_attr(isset( $column['price_col_featured']) ) && $column['price_col_featured'] == 'yes' ? ' th-highlight' : '' ); echo esc_attr( $column_class ); ?>">

	                    <?php if ( isset( $column['price_col_title'] ) && ! empty( $column['price_col_title'] ) ) : ?>
							<div class="th-pricing-title"><?php echo esc_html( $column['price_col_title'] ); ?></div>
	                    <?php endif; ?>

	                    <?php if ( isset( $column['price_col_sub_title'] ) && ! empty( $column['price_col_sub_title'] ) ) : ?>
	                        <div class="th-pricing-sub-title"><?php echo esc_html( $column['price_col_sub_title'] ); ?></div>
	                    <?php endif; ?>

	                    <?php if ( ( isset( $column['price_col_price'] ) && ! empty( $column['price_col_price'] ) ) || ( isset( $column['price_col_price'] ) && ! empty( $column['price_col_price'] ) ) ) : ?>
	                        <div class="th-pricing-cost">
	                            <?php echo esc_html( $column['price_col_price'] ); ?><span><?php echo esc_html( $column['price_col_text'] ); ?></span>
	                        </div>
	                    <?php endif; ?>

	                    <?php if ( isset( $column['price_col_description'] ) && ! empty( $column['price_col_description'] ) ) : ?>
							<div class="th-pricing-features">
								<ul>
									<?php echo '<li>' . str_replace( array( "\r", "\n\n", "\n" ), array( '', "\n", "</li>\n<li>" ), trim( wp_kses_post( $column['price_col_description'] ), "\n\r" ) ) . '</li>'; ?>
								</ul>
							</div>
	                    <?php endif; ?>

                        <div class="th-btn-wrap">
							<?php if ( ! empty( $column['price_col_button_1_text'] ) || ! empty( $column['price_col_button_2_text'] ) ) : ?>
	                            <?php if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) : ?>
	                                <?php $target = $column['price_col_button_1_link']['is_external'] ? ' target="_blank"' : ''; ?>
	                                <?php $button_style = 'btn-' . $column['price_col_button_1_style']; ?>
	                                <?php echo '<a class="btn th-btn th-button th-button-1 ' . esc_attr( $button_style ) . '" href="' . esc_url( $column['price_col_button_1_link']['url'] ) . '"' . wp_kses_post( $target ) . '>'; ?>
		                                <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
		                                    <?php echo esc_html( $column['price_col_button_1_text'] ) ?>
		                                <?php endif;?>
	                                <?php echo '</a>'; ?>
	                            <?php endif; ?>
	                            <?php if ( isset( $column['price_col_button_2_show'] ) && $column['price_col_button_2_show'] == 'yes' ) : ?>
	                                <?php $target = $column['price_col_button_2_link']['is_external'] ? ' target="_blank"' : ''; ?>
	                                <?php $button_style = 'btn-' . $column['price_col_button_2_style']; ?>
	                                <?php echo '<a class="btn th-btn th-button th-button-2 ' . esc_attr( $button_style ) . '" href="' . esc_url( $column['price_col_button_2_link']['url'] ) . '"' . wp_kses_post( $target ) . '>'; ?>
		                                <?php if ( ! empty( $column['price_col_button_2_text'] ) ) : ?>
		                                    <?php echo esc_html( $column['price_col_button_2_text'] ) ?>
		                                <?php endif;?>
	                                <?php echo '</a>'; ?>
	                            <?php endif; ?>
							<?php endif; ?>
                        </div>

					</div>

				<?php } ?>

			</div>

		</div>

		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Pricing() );
