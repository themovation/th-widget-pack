<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Pricing_List extends Widget_Base {

	public function get_name() {
		return 'themo-pricing-list';
	}

	public function get_title() {
		return __( 'Pricing List', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-price-list';
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
				'label' => __( 'Pricing List', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'pricing',
			[
				'label' => __( 'Pricing List', 'th-widget-pack' ),
				'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'price_title' => __( 'Title', 'th-widget-pack' ),
                        'price_sub_title' => __( 'Subtitle', 'th-widget-pack' ),
                        'price_description' => __( "Morbi volutpat risus vitae quam pellentesque lobortis a eu urna.", 'th-widget-pack' ),
                        'price_price' => __( '$59', 'th-widget-pack' ),
                        'price_text' => __( 'each', 'th-widget-pack' ),
                        'price_divider' => __( 'yes', 'th-widget-pack' ),
                        'price_link' => __( '#book', 'th-widget-pack' ),
                    ],

                ],
				'fields' => [
					[
						'name' => 'price_title',
						'label' => __( 'Title', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
                        'placeholder' => __( 'Title', 'th-widget-pack' ),
						'label_block' => true,
					],
                    [
                        'name' => 'price_sub_title',
                        'label' => __( 'Subtitle', 'th-widget-pack' ),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => __( 'Subtitle', 'th-widget-pack' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'price_description',
                        'label' => __( 'Description', 'th-widget-pack' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'placeholder' => __( "Add a description here.", 'th-widget-pack' ),
                        'label_block' => true,
                    ],
					[
						'name' => 'price_price',
						'label' => __( 'Price number', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
                        'placeholder' => __( '$99', 'th-widget-pack' ),
						'label_block' => true,
					],
					[
						'name' => 'price_text',
						'label' => __( 'Price text', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
                        'placeholder' => __( 'each', 'th-widget-pack' ),
						'label_block' => true,
					],
                    [
                        'name' => 'price_link',
                        'label' => __( 'Link', 'th-widget-pack' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                    ],
				],
				'title_field' => '{{{ price_title }}}',
			]
		);

        $this->add_control(
            'price_divider',
            [
                'label' => __( 'Divider', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
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
				'label' => __( 'Title', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-plist-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Subtitle', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-price-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label' => __( 'Price text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Divder', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-show-divider .th-plist-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tabs();

		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['pricing'] ) ) {
			return;
		}

        $this->add_render_attribute('divider', 'class', 'th-price-list');

        if ( isset( $settings['price_divider'] ) && $settings['price_divider'] == 'yes' ) {
            $this->add_render_attribute('divider', 'class', 'th-show-divider');
        }
        ?>

        <div <?php echo $this->get_render_attribute_string( 'divider'); ?>>

            <?php $th_counter=0; foreach( $settings['pricing'] as $column ) { ?>

                <?php ++$th_counter; ?>

                <?php
                // URL
                if ( empty( $column['price_link']['url'] ) ) { $column['price_link']['url'] = '#'; };

                if ( ! empty( $column['price_link']['url'] ) ) {
                    $this->add_render_attribute( 'price_link-'.$th_counter, 'href', esc_url( $column['price_link']['url'] ) );

                    if ( ! empty( $column['price_link']['is_external'] ) ) {
                        $this->add_render_attribute( 'price_link-'.$th_counter, 'target', '_blank' );
                    }
                }
                ?>

                <?php if ($column['price_link']['url'] !== '#' && $column['price_link']['url'] > ""){ ?>
                    <a <?php echo $this->get_render_attribute_string( 'price_link-'.$th_counter ); ?>>
                <?php } ?>

                <div class="th-plist-item">
                    <?php if ( isset( $column['price_title'] ) && ! empty( $column['price_title'] ) ) : ?>
                        <span class="th-plist-title"><?php echo esc_html( $column['price_title'] ); ?></span>
                    <?php endif; ?>

                    <?php if ( (isset( $column['price_sub_title'] ) && ! empty( $column['price_sub_title'] ))
                            || (isset( $column['price_description'] ) && ! empty( $column['price_description'] )) ) : ?>
                        <div class="th-plist-content">
                            <?php if ( isset( $column['price_sub_title'] ) && ! empty( $column['price_sub_title'] ) ) : ?>
                                <span class="th-plist-subtitle"><?php echo esc_html( $column['price_sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php if ( isset( $column['price_description'] ) && ! empty( $column['price_description'] ) ) : ?>
                                <p class="th-plist-description"><?php echo esc_html( $column['price_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( ( isset( $column['price_price'] ) && ! empty( $column['price_price'] ) ) || ( isset( $column['price_text'] ) && ! empty( $column['price_text'] ) ) ) : ?>
                    <div class="th-plist-price">
                        <?php if ( isset( $column['price_price'] ) && ! empty( $column['price_price'] ) ) : ?>
                            <span class="th-plist-price-number"><?php echo esc_html( $column['price_price'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( isset( $column['price_text'] ) && ! empty( $column['price_text'] ) ) : ?>
                            <span class="th-plist-price-text"><?php echo esc_html( $column['price_text'] ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($column['price_link']['url'] !== '#' && $column['price_link']['url'] > ""){ ?>
                    </a>
                <?php } ?>

            <?php } ?>

        </div>

		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Pricing_List() );
