<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_CallToAction extends Widget_Base {

	public function get_name() {
		return 'themo-call-to-action';
	}

	public function get_title() {
		return __( 'Call to Action', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
	protected function _register_controls() {
		$this->start_controls_section(
			'section_text',
			[
				'label' => __( 'Text', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Phasellus semper viverra tristique. Sed justo tortor, iaculis.', 'th-widget-pack' ),
				'placeholder' => __( 'Title', 'th-widget-pack' ),
				'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_button_1',
            [
                'label' => __( 'Button 1', 'th-widget-pack' ),
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
            'section_button_2',
            [
                'label' => __( 'Button 2', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'button_2_text',
            [
                'label' => __( 'Button Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Text', 'th-widget-pack' ),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
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
            'button_2_image',
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
            'button_2_link',
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
            'section_content_title_heading',
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-cta-text span' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_content_title_typography',
                'selector' => '{{WRAPPER}} .th-cta-text span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'section_title_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'elementor' ),
                'selector' => '{{WRAPPER}} .th-cta-text span',
            ]
        );

        $this->add_control(
            'section_button_1_heading',
            [
                'label' => __( 'Button 1', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_1_text_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-cta-btn .btn-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_button_1_typography',
                'selector' => '{{WRAPPER}} .th-cta-btn .btn-1',
            ]
        );

        $this->add_responsive_control(
            'section_button_1_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-cta-btn .btn-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_button_2_heading',
            [
                'label' => __( 'Button 2', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_2_text_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-cta-btn .btn-2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_button_2_typography',
                'selector' => '{{WRAPPER}} .th-cta-btn .btn-2',
            ]
        );

        $this->add_responsive_control(
            'section_button_2_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-cta-btn .btn-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

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

        // BUTTON 2

        // Graphic Button
        $button_2_image = false;
        if ( isset( $settings['button_2_image']['id'] ) && $settings['button_2_image']['id'] > "" ) {
            $button_2_image = wp_get_attachment_image( $settings['button_2_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
        }elseif ( ! empty( $settings['button_2_image']['url'] ) ) {
            $this->add_render_attribute( 'button_2_image', 'src', esc_url( $settings['button_2_image']['url'] ) );
            $this->add_render_attribute( 'button_2_image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['button_2_image'] ) ) );
            $this->add_render_attribute( 'button_2_image', 'title', esc_attr( Control_Media::get_image_title( $settings['button_2_image'] ) ) );
            $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_2_image' ) . '>';
        }

        // Graphic Button URL Styling
        if ( isset($button_2_image) && ! empty( $button_2_image ) ) {
            // image button
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-image' );
        }else{ // Bootstrap Button URL Styling
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
            $this->add_render_attribute( 'btn-2-link', 'class', 'btn-' . esc_attr( $settings['button_2_style'] ) );
        }

        // Button URL
        if ( empty( $settings['button_2_link']['url'] ) ) { $settings['button_2_link']['url'] = '#'; };

        if ( ! empty( $settings['button_2_link']['url'] ) ) {
            $this->add_render_attribute( 'btn-2-link', 'href', esc_url( $settings['button_2_link']['url'] ) );

            if ( ! empty( $settings['button_2_link']['is_external'] ) ) {
                $this->add_render_attribute( 'btn-2-link', 'target', '_blank' );
            }
        }
        ?>
		<div class="th-cta">
			<?php if ( $settings['text'] ) : ?>
		        <div class="th-cta-text">
		            <span><?php echo wp_kses_post( $settings['text'] ); ?></span>
		        </div>
		    <?php endif; ?>

            <?php if ( ! empty( $settings['button_1_text'] )  || ! empty( $settings['button_2_text'] ) || ! empty($button_1_image) || ! empty( $button_2_image )) : ?>
            <div class="th-cta-btn">

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

                <?php if ( isset($button_2_image) && ! empty( $button_2_image ) ) : ?>
                    <?php if ( ! empty( $settings['button_2_link']['url'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
                            <?php echo wp_kses_post( $button_2_image ); ?>
                        </a>
                    <?php else : ?>
                        <?php echo wp_kses_post( $button_2_image ); ?>
                    <?php endif; ?>
                <?php elseif ( ! empty( $settings['button_2_text'] )  ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
                        <?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
                            <?php echo esc_html( $settings['button_2_text'] ); ?>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="th-cta">
			<# if ( settings.text ) { #>
		        <div class="th-cta-text">
		            <span>{{{ settings.text }}}</span>
		        </div>
		    <# } #>
            <#  var button_1_link_url = '#';
                var button_1_text = '';

                if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
                if ( settings.button_1_text ) { var button_1_text = settings.button_1_text }


                var button_2_link_url = '#';
                var button_2_text = '';

                if ( settings.button_2_link.url ) { var button_2_link_url = settings.button_2_link.url }
                if ( settings.button_2_text ) { var button_2_text = settings.button_2_text }
            #>
            <# if ( button_1_text || button_2_text || settings.button_1_image || settings.button_2_image) { #>
                <div class="th-cta-btn">
                    <# if ( settings.button_1_image && '' !== settings.button_1_image.url ) { #>
                        <a class="btn-1 th-btn btn-image" href="{{ button_1_link_url }}">
                            <img src="{{{ settings.button_1_image.url }}}" />
                        </a>
                    <# } else if ( button_1_text ) { #>
                        <a class="btn btn-1 th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
                            {{{ settings.button_1_text }}}
                        </a>
                    <# } #>
                    <# if ( settings.button_2_image && '' !== settings.button_2_image.url ) { #>
                        <a class="btn-2 th-btn btn-image" href="{{ button_2_link_url }}">
                            <img src="{{{ settings.button_2_image.url }}}" />
                        </a>
                    <# } else if ( button_2_text  ) { #>
                        <a class="btn btn-2 th-btn btn-{{ settings.button_2_style }}" href="{{ button_2_link_url }}">
                            {{{ settings.button_2_text }}}
                        </a>
                    <# } #>
                </div>
            <# } #>
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
					'field'       => 'text',
					'type'        => __( 'Text', 'th-widget-pack' ),
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
                    'type'        => __('Button URL 1', 'th-widget-pack'),
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
                    'type'        => __('Button URL 2', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
			],
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_CallToAction() );
