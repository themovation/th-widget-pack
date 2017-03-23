<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_TourInfo extends Widget_Base {

	public function get_name() {
		return 'themo-tour-info';
	}

	public function get_title() {
		return __( 'Tour Info Bar', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-form-vertical';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
            'section_price',
            [
                'label' => __( 'Price', 'elementor' ),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$299', 'elementor' ),
                'placeholder' => __( '$299', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'price_text',
            [
                'label' => __( 'Price Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '/person', 'elementor' ),
                'placeholder' => __( '/person', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

	    $this->start_controls_section(
			'section_items',
			[
				'label' => __( 'Items', 'elementor' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => __( 'Items', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'icon' => __( 'fa fa-compass', 'elementor' ),
                        'text' => __( '4.5 Miles', 'elementor' ),
                    ],
                    [
                        'icon' => __( 'fa fa-clock-o', 'elementor' ),
                        'text' => __( '3 Hours', 'elementor' ),
                    ],
                    [
                        'icon' => __( 'fa fa-user-o', 'elementor' ),
                        'text' => __( '3+ People', 'elementor' ),
                    ],

                ],
				'fields' => [
					[
						'name' => 'icon',
						'label' => __( 'Icon', 'elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'label_block' => true,
                        'icons' => themo_icons(),
					],
					[
						'name' => 'text',
						'label' => __( 'Text', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => '$99/person',
						'label_block' => true,
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ text }}}',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label' => __( 'Button', 'elementor' ),
            ]
        );

        $this->add_control(
            'button_1_text',
            [
                'label' => __( 'Button Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Book Tour', 'elementor' ),
                'placeholder' => __( 'Book Tour', 'elementor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_1_style',
            [
                'label' => __( 'Button Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ghost-dark',
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
                'icons' => themo_icons(),
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

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style_colors',
			[
				'label' => __( 'Colors', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#1b1b1b',
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label' => __( 'Price Text Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#1b1b1b',
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav-price span' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-tour-nav-item i' => 'color: {{VALUE}};',
				],
                'default' => '#1b1b1b',
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-tour-nav-item span' => 'color: {{VALUE}};',
				],
                'default' => '#1b1b1b',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        $items = $this->get_settings( 'items' );

        if ( empty( $settings['button_1_link']['url'] ) ) { $settings['button_1_link']['url'] = '#'; };

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

		?>
		<div class="th-tour-nav">

            <?php if ( ! empty( $settings['price'] ) ) : ?>
            <div class="th-tour-nav-price">
                <?php echo esc_html( $settings['price']) ?><?php if ( ! empty( $settings['price_text'] ) ) : ?><span><?php echo esc_html( $settings['price_text']) ?></span><?php endif;?>
            </div>
            <?php endif;?>

            <?php if ( ! empty( $settings['button_1_text']) ||  ! empty( $settings['button_1_icon'])) : ?>
                <div class="th-tour-nav-btn">
                <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                    <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
                        <?php echo esc_html( $settings['button_1_text'] ); ?>
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['button_1_icon'] ) ) : ?>
                        <i class="<?php echo esc_attr( $settings['button_1_icon'] ); ?>"></i>
                    <?php endif; ?>
                </a>
                </div>
            <?php endif; ?>

			<div class="th-tour-nav-items">
				<?php
				$counter = 1; ?>
                <?php foreach ( $items as $item ) : ?>
					<span class="th-tour-nav-item">
						<i class="<?php echo esc_attr($item['icon']); ?>" aria-hidden="true"></i>
						<span><?php echo esc_html($item['text']); ?></span>
					</span>
                    <?php
                    $counter++;
                endforeach; ?>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
        <#  var button_1_link_url = '#';
        if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
        #>

        <div class="th-tour-nav">
            <# if ( settings.price ) { #>
            <div class="th-tour-nav-price">
                {{{ settings.price }}}<# if ( settings.price ) { #><span>{{{ settings.price_text }}}</span><# } #>
            </div>
            <# } #>

            <# if ( button_1_link_url ) { #>
                <div class="th-tour-nav-btn">
                    <a class="btn th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
                        {{{ settings.button_1_text }}}
                        <# if ( settings.button_1_icon ) { #>
                            <i class="{{ settings.button_1_icon }}"></i>
                        <# } #>
                    </a>
                </div>
            <# } #>

            <div class="th-tour-nav-items">
            <# if ( settings.items ) {
                    _.each(settings.items, function( item ) { #>
                    <span class="th-tour-nav-item">
                        <i class="{{{ item.icon }}}" aria-hidden="true"></i>
                        <span>{{{ item.text }}}</span>
                    </span>

                <#  } );
                } #>
            </div>
        </div>
        <?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_TourInfo() );
