<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Feature_bar extends Widget_Base {

	public function get_name() {
		return 'themo-feature-bar';
	}

	public function get_title() {
		return __( 'Feature Bar', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-form-vertical';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
	protected function _register_controls() {

        $this->start_controls_section(
            'section_price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$29', 'th-widget-pack' ),
                'placeholder' => __( '$29', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price_text',
            [
                'label' => __( 'Price Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '/month', 'th-widget-pack' ),
                'placeholder' => __( '/month', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

	    $this->start_controls_section(
			'section_items',
			[
				'label' => __( 'Items', 'th-widget-pack' ),
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'new_icon', [
			'fa4compatibility' => 'icon',
			'label' => __( 'Icon', 'th-widget-pack' ),
			'type' => Controls_Manager::ICONS,
			'label_block' => true,
			'default' => [
				'value' => 'fas fa-star',
				'library' => 'fa-solid',
			],
			]
        );
        
        $repeater->add_control(
            'text',[
            'label' => __( 'Text', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'Feature',
            'label_block' => true,
            'default' => 'Feature',
            'dynamic' => [
                'active' => true,
            ],
            ]
        );

		$this->add_control(
			'items',
			[
				'label' => __( 'Items', 'th-widget-pack' ),
				'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        // 'icon' => __( 'th-linea icon-basic-magic-mouse', 'th-widget-pack' ),
                        'new_icon' => [
                            'value' => 'th-linea icon-basic-magic-mouse',
							'library' => 'th-linea',  
                        ],
                        'text' => __( 'One Click Install', 'th-widget-pack' ),
                    ],
                    [
                        // 'icon' => __( 'th-linea icon-software-vector-box', 'th-widget-pack' ),
                        'new_icon' => [
                            'value' => 'th-linea icon-software-vector-box',
							'library' => 'th-linea',  
                        ],
                        'text' => __( 'Drag & Drop Builder', 'th-widget-pack' ),
                    ],
                    [
                        // 'icon' => __( 'th-linea icon-basic-elaboration-message-happy', 'th-widget-pack' ),
                        'new_icon' => [
                            'value' => 'th-linea icon-basic-elaboration-message-happy',
							'library' => 'th-linea',  
                        ],
                        'text' => __( 'Amazing Support', 'th-widget-pack' ),
                    ],

                ],
                'fields' => $repeater->get_controls(),
				'title_field' => '<i class="{{ new_icon.value }}"></i> {{{ text }}}',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label' => __( 'Button', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'button_1_text',
            [
                'label' => __( 'Button Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'th-widget-pack' ),
                'placeholder' => __( 'Button Text', 'th-widget-pack' ),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_1_style',
            [
                'label' => __( 'Button Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ghost-dark',
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
            'button_1_image',
            [
                'label' => __( 'Button Graphic', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    //'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( '#buttonlink', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style_colors',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'section_price_heading',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .th-tour-nav-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'section_price_text_heading',
            [
                'label' => __( 'Price Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_text_typography',
                'selector' => '{{WRAPPER}} .th-tour-nav-price span',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'section_price_icon_heading',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-tour-nav-item i' => 'color: {{VALUE}};',
				],
                'default' => '#1b1b1b',
			]
		);

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav-item i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_icon_text_heading',
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'text',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-tour-nav-item span' => 'color: {{VALUE}};',
				],
                'default' => '#1b1b1b',
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_icon_typography',
                'selector' => '{{WRAPPER}} .th-tour-nav-item span',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'section_button_text_heading',
            [
                'label' => __( 'Button', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav-btn .btn-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typography',
                'selector' => '{{WRAPPER}} .th-tour-nav-btn .btn-1',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav-btn .btn-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );




		$this->end_controls_section();

        $this->start_controls_section(
            'section_padding_content',
            [
                'label' => __( 'Padding', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_background_content',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_background',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .th-tour-nav' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
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
                'selector' => '{{WRAPPER}} .th-tour-nav',
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
                    '{{WRAPPER}} .th-tour-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .th-tour-nav',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        $items = $this->get_settings_for_display( 'items' );

        // Graphic Button
        $button_1_image = false;
        if ( isset( $settings['button_1_image']['id'] ) && $settings['button_1_image']['id'] > "" ) {
            $button_1_image = wp_get_attachment_image( $settings['button_1_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
        }elseif ( ! empty( $settings['button_1_image']['url'] ) ) {
            $this->add_render_attribute( 'button_1_image', 'src', esc_url( $settings['button_1_image']['url'] ) );
            $this->add_render_attribute( 'button_1_image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['button_1_image'] ) ) );
            $this->add_render_attribute( 'button_1_image', 'title', esc_attr( Control_Media::get_image_title( $settings['button_1_image'] ) ) );
            $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_1_image' ) . '>';
        }


        // Graphic Button URL Styling
        if ( isset($button_1_image) && ! empty( $button_1_image ) ) {
            // image button
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-1' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-image' );
        }else{ // Bootstrap Button URL Styling
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-1' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-1-link', 'class', 'btn-' . esc_attr( $settings['button_1_style'] ) );
        }

        // Button URL
        if ( empty( $settings['button_1_link']['url'] ) ) { $settings['button_1_link']['url'] = '#'; };

        if ( ! empty( $settings['button_1_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-1-link', 'href', esc_url( $settings['button_1_link']['url'] ) );

            if ( ! empty( $settings['button_1_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-1-link', 'target', '_blank' );
            }
        }


		?>
		<div class="th-tour-nav">

            <?php if ( ! empty( $settings['price'] ) ) : ?>
            <div class="th-tour-nav-price">
                <?php echo esc_html( $settings['price'] ) ?><?php if ( ! empty( $settings['price_text'] ) ) : ?><span><?php echo esc_html( $settings['price_text'] ) ?></span><?php endif;?>
            </div>
            <?php endif;?>

            <?php if ( ! empty( $settings['button_1_text'] ) || ! empty($button_1_image) ) : ?>
                <div class="th-tour-nav-btn">
                    <?php if ( isset($button_1_image) && ! empty( $button_1_image ) ) : ?>
                        <?php if ( ! empty( $settings['button_1_link']['url'] ) ) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                                <?php echo wp_kses_post( $button_1_image ); ?>
                            </a>
                        <?php else : ?>
                            <?php echo wp_kses_post( $button_1_image ); ?>
                        <?php endif; ?>
                    <?php elseif ( ! empty( $settings['button_1_text'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
                            <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
                                <?php echo esc_html( $settings['button_1_text'] ); ?>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

			<div class="th-tour-nav-items">
				<?php
				$counter = 1; ?>
                <?php foreach ( $items as $item ) : ?>
					<span class="th-tour-nav-item">
                        <?php
                        // new icon render
						$migrated = isset( $item['__fa4_migrated']['new_icon'] );
						$is_new = empty( $item['icon'] );
						if ( $is_new || $migrated ) {
							\Elementor\Icons_Manager::render_icon( $item['new_icon'], [ 'aria-hidden' => 'true' ] ); 
						} else {
							?><i class="<?php echo $item['icon']; ?>" aria-hidden="true"></i><?php
                        }
                        ?>
						<span><?php echo esc_html( $item['text'] ); ?></span>
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
        <#

        var button_1_link_url = '#';
        var button_1_text = '';

        if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
        if ( settings.button_1_text ) { var button_1_text = settings.button_1_text }
        #>

        <div class="th-tour-nav">
            <# if ( settings.price ) { #>
            <div class="th-tour-nav-price">
                {{{ settings.price }}}<# if ( settings.price ) { #><span>{{{ settings.price_text }}}</span><# } #>
            </div>
            <# } #>

            <# if ( button_1_link_url || settings.button_1_image ) { #>
                <div class="th-tour-nav-btn">
                    <# if ( settings.button_1_image && '' !== settings.button_1_image.url ) { #>
                        <a class="btn-1 th-btn btn-image" href="{{ button_1_link_url }}">
                            <img src="{{{ settings.button_1_image.url }}}" />
                        </a>
                    <# } else if ( button_1_text ) { #>
                        <a class="btn btn-1 th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
                            {{{ settings.button_1_text }}}
                        </a>
                    <# } #>
                </div>
                <# } #>

            <div class="th-tour-nav-items">
            <# if ( settings.items ) {
                    _.each(settings.items, function( item ) { 
                        item.iconHTML = elementor.helpers.renderIcon( view, item.new_icon, { 'aria-hidden': true }, 'i' , 'object' ); 
                        item.migrated = elementor.helpers.isIconMigrated( item, 'new_icon' );
                        #>
                    <span class="th-tour-nav-item">
                        <# if ( item.iconHTML.rendered && ( ! item.icon || item.migrated ) ) { #>
					        {{{ item.iconHTML.value }}}
				        <# } else { #>
					        <i class="{{ item.icon }}" aria-hidden="true"></i>
				        <# } #>
                        <span>{{{ item.text }}}</span>
                    </span>
                <# } );
                } #>
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
					'field'       => 'price',
					'type'        => __( 'Price', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
                [
					'field'       => 'price_text',
					'type'        => __( 'Price Text', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
                [
					'field'       => 'button_1_text',
					'type'        => __( 'Button Text', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
                'button_1_link' => [
                    'field'        => 'url',
                    'field_id'    => 'button_1_link', // New key
                    'type'        => __('Link', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
            ],
            'integration-class' => 'WPML_Themo_Feature_Bar',
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Feature_bar() );
