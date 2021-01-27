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

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
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

        $repeater = new Repeater();

        $repeater->add_control(
            'price_title', [
            'label' => __( 'Title', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Title', 'th-widget-pack' ),
            'label_block' => true,
            'default' => __( 'Title', 'th-widget-pack' ),
            'dynamic' => [
                'active' => true,
            ]
            ]
        );

        $repeater->add_control(
            'price_sub_title', [
            'label' => __( 'Subtitle', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Subtitle', 'th-widget-pack' ),
            'label_block' => true,
            'default' => __( 'Subtitle', 'th-widget-pack' ),
            'dynamic' => [
                'active' => true,
            ]
            ]
        );    

        $repeater->add_control(
            'price_description', [
            'label' => __( 'Description', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __( "Add a description here.", 'th-widget-pack' ),
            'default' => __( "Add a description here.", 'th-widget-pack' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
            ]
        );    

        $repeater->add_control(
            'price_div', [
            'label' => __( 'Divider', 'th-widget-pack' ),
            'type' => Controls_Manager::DIVIDER,
            'style' => 'thick'
            ]
        );

        $repeater->add_control(
            'price_col_button_1_show', [
            'label' => __( 'Use button', 'th-widget-pack' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'th-widget-pack' ),
            'label_off' => __( 'No', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => '',
            ]
        );
        
        $repeater->add_control(
        'price_col_button_1_text', [
            'label' => __( 'Button Text', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'BUTTON TEXT', 'th-widget-pack' ),
            'default' => __( 'BUTTON TEXT', 'th-widget-pack' ),
            'dynamic' => [
                'active' => true,
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
            ]
        );    

        $repeater->add_control(
            'price_col_button_1_style', [
            'label' => __( 'Button Style', 'th-widget-pack' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'ghost-primary',
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
            ]
        );    


        $repeater->add_control(
            'button_1_image', [
            'label' => __( 'Button Graphic', 'th-widget-pack' ),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => [
                'active' => true,
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
            ]
        );

        $repeater->add_control(
            'price_price', [
            'label' => __( 'Price number', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( '$99', 'th-widget-pack' ),
            'default' => __( '$99', 'th-widget-pack' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
            'conditions' => [
                'terms' => [
                    [
                        'name' => 'price_col_button_1_show',
                        'operator' => '==',
                        'value' => '',
                    ],
                ],
            ],
            ]
        );
        
        
        $repeater->add_control(
            'price_text', [
            'label' => __( 'Price text', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'each', 'th-widget-pack' ),
            'default' => __( 'each', 'th-widget-pack' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
            'conditions' => [
                'terms' => [
                    [
                        'name' => 'price_col_button_1_show',
                        'operator' => '==',
                        'value' => '',
                    ],
                ],
            ],
            ]
        );
        
        
        $repeater->add_control(
            'price_link', [
            'label' => __( 'Link', 'th-widget-pack' ),
            'type' => Controls_Manager::URL,
            'placeholder' => 'http://your-link.com',
            'default' => [
                'url' => '',
            ],
            'dynamic' => [
                'active' => true,
            ],
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
                        'url' => 'http://your-link.com'
                    ],

                ],
                'fields' => $repeater->get_controls(),
                //'fields' => array_values( $this->get_controls() ),
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
                'condition' => [
                    'style' => 'style_1',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => __( 'Style 1', 'th-widget-pack' ),
                    'style_2' => __( 'Style 2', 'th-widget-pack' )
                ],
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
            'section_title_heading',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '#2C2C2C',
				'selectors' => [
					'{{WRAPPER}} .th-plist-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .th-plist-title',
            ]
        );

        $this->add_control(
            'section_sub_title_heading',
            [
                'label' => __( 'Subtitle', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_sub_title_typography',
                'selector' => '{{WRAPPER}} .th-plist-subtitle',
            ]
        );

        $this->add_control(
            'section_description_heading',
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
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .th-plist-description',
            ]
        );

        $this->add_control(
            'section_price_heading',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
                'default' => '#2C2C2C',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-price-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_price_typography',
                'selector' => '{{WRAPPER}} .th-plist-price-number',
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
                'default' => '#2C2C2C',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_price_text_typography',
                'selector' => '{{WRAPPER}} .th-plist-price-text',
            ]
        );

        $this->add_control(
            'section_button_text_heading',
            [
                'label' => __( 'Button Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list .th-btn' => 'color: {{VALUE}};',
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
                'name' => 'section_button_text_typography',
                'selector' => '{{WRAPPER}} .th-price-list .th-btn',

            ]
        );

        $this->add_responsive_control(
            'tour_section_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-price-list .th-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Divider Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-show-divider .th-plist-item' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'style' => 'style_1',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_background',
            [
                'label' => __( 'Border & Background', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_2',
                ],
            ]
        );

        $this->add_control(
            'background_1',
            [
                'label' => __( 'Background 1', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-style-2.row:nth-child(odd)' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_2',
            [
                'label' => __( 'Background 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-style-2.row:nth-child(even)' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'Border',
            [
                'label' => __( 'Border', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-style-2' => 'border-color: {{VALUE}};',
                ],
            ]
        );


		$this->end_controls_section();

        $this->end_controls_tabs();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['pricing'] ) ) {
			return;
		}

        $this->add_render_attribute('th-price-list-class', 'class', 'th-price-list');

        if ( isset( $settings['price_divider'] ) && $settings['price_divider'] == 'yes' ) {
            $this->add_render_attribute('th-price-list-class', 'class', 'th-show-divider');
        }

        $th_list_style_2 = false;
        if ( isset( $settings['style'] ) &&  $settings['style'] == 'style_2' ){
            $this->add_render_attribute('th-price-list-class', 'class', 'th-plist-style-2');
            $this->add_render_attribute('th-price-list-class', 'class', 'row');
            $this->add_render_attribute('th-price-list-class', 'class', 'fsi-row-lg-level');
            $this->add_render_attribute('th-price-list-class', 'class', 'fsi-row-md-level');
            $this->add_render_attribute('th-price-list-class', 'class', 'fsi-row-sm-level');
            //$themo_list_row_class .= ' th-package-style-2';
            $th_list_style_2 = true;
        }




        if($th_list_style_2){
            $th_counter=0; foreach( $settings['pricing'] as $column ) {

                ++$th_counter;
                //https://getbootstrap.com/docs/3.3/examples/grid/


                if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) {

                    // Graphic Button 1
                    $button_1_image = false;
                    if ( isset( $column['button_1_image']['id'] ) && $column['button_1_image']['id'] > "" ) {
                        $button_1_image = wp_get_attachment_image( $column['button_1_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
                    }elseif ( ! empty( $column['button_1_image']['url'] ) ) {
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'src', esc_url( $column['button_1_image']['url'] ) );
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'alt', esc_attr( Control_Media::get_image_alt( $column['button_1_image'] ) ) );
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'title', esc_attr( Control_Media::get_image_title( $column['button_1_image'] ) ) );
                        $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_1_image'.$th_counter ) . '>';
                    }
                    // Graphic Button URL Styling 1
                    if ( isset($button_1_image) && ! empty( $button_1_image ) ) {
                        // image button
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-image' );
                    }else{ // Bootstrap Button URL Styling
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-' . esc_attr( $column['price_col_button_1_style'] ) );
                    }

                    // Button URL 1
                    if (empty($column['price_link']['url'])) {
                        $column['price_link']['url'] = '#';
                    };

                    if (!empty($column['price_link']['url'])) {
                        $this->add_render_attribute('btn-1-link-' . $th_counter, 'href', esc_url($column['price_link']['url']));

                        if (!empty($column['price_link']['is_external'])) {
                            $this->add_render_attribute('btn-1-link-' . $th_counter, 'target', '_blank');
                        }
                    }
                }else{
                    if ( empty( $column['price_link']['url'] ) ) { $column['price_link']['url'] = '#'; };

                    $this->add_render_attribute( 'price_link-'.$th_counter, 'class', 'th-plist-link' );
                    $this->add_render_attribute( 'price_link-'.$th_counter, 'class', 'col-sm-12 ' );

                    if ( ! empty( $column['price_link']['url'] ) ) {
                        $this->add_render_attribute( 'price_link-'.$th_counter, 'href', esc_url( $column['price_link']['url'] ) );

                        if ( ! empty( $column['price_link']['is_external'] ) ) {
                            $this->add_render_attribute( 'price_link-'.$th_counter, 'target', '_blank' );
                        }
                    }
                }
                ?>




                <div <?php echo $this->get_render_attribute_string( 'th-price-list-class'); ?>>
                    <?php if ($column['price_col_button_1_show'] !== 'yes'  && $column['price_link']['url'] !== '#' && $column['price_link']['url'] > ""){ ?>
                    <a <?php echo $this->get_render_attribute_string( 'price_link-'.$th_counter ); echo $this->get_render_attribute_string( 'price_link-'.$th_counter ); ?>>
                        <?php } ?>
                    <div class="col-sm-4 ">
                        <?php if ( isset( $column['price_title'] ) && ! empty( $column['price_title'] ) ) : ?>
                            <div class="th-plist-title"><?php echo esc_html( $column['price_title'] ); ?></div>
                        <?php endif; ?>

                        <?php if ( (isset( $column['price_sub_title'] ) && ! empty( $column['price_sub_title'] ))) : ?>
                            <div class="th-plist-content">
                                <?php if ( isset( $column['price_sub_title'] ) && ! empty( $column['price_sub_title'] ) ) : ?>
                                    <span class="th-plist-subtitle"><?php echo esc_html( $column['price_sub_title'] ); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4">
                        <?php if ( isset( $column['price_description'] ) && ! empty( $column['price_description'] ) ) : ?>
                            <p class="th-plist-description"><?php echo esc_html( $column['price_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4">
                        <?php if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) { ?>
                        <div class="th-btn-wrap">
                            <?php if ( isset($button_1_image) && ! empty( $button_1_image ) ) : ?>
                                <?php if ( ! empty( $column['price_link']['url'] ) ) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                        <?php echo wp_kses_post( $button_1_image ); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_kses_post( $button_1_image ); ?>
                                <?php endif; ?>
                            <?php elseif ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                    <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                        <?php echo esc_html( $column['price_col_button_1_text'] ); ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php }else{ ?>
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
                        <?php }; ?>
                    </div>
                    <?php if ($column['price_col_button_1_show'] !== 'yes'  && $column['price_link']['url'] !== '#' && $column['price_link']['url'] > ""){ ?>
                    </a>
                    <?php } ?>
                </div>



                <?php
            }
        ?>

        <?php
        }else{ ?>

        <div <?php echo $this->get_render_attribute_string( 'th-price-list-class'); ?>>

            <?php $th_counter=0; foreach( $settings['pricing'] as $column ) { ?>

                <?php ++$th_counter; ?>


                <?php

                if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) {

                    // Graphic Button 1
                    $button_1_image = false;
                    if ( isset( $column['button_1_image']['id'] ) && $column['button_1_image']['id'] > "" ) {
                        $button_1_image = wp_get_attachment_image( $column['button_1_image']['id'], "th_img_xs", false, array( 'class' => '' ) );
                    }elseif ( ! empty( $column['button_1_image']['url'] ) ) {
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'src', esc_url( $column['button_1_image']['url'] ) );
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'alt', esc_attr( Control_Media::get_image_alt( $column['button_1_image'] ) ) );
                        $this->add_render_attribute( 'button_1_image-'.$th_counter, 'title', esc_attr( Control_Media::get_image_title( $column['button_1_image'] ) ) );
                        $button_1_image = '<img ' . $this->get_render_attribute_string( 'button_1_image'.$th_counter ) . '>';
                    }
                    // Graphic Button URL Styling 1
                    if ( isset($button_1_image) && ! empty( $button_1_image ) ) {
                        // image button
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-image' );
                    }else{ // Bootstrap Button URL Styling
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-' . esc_attr( $column['price_col_button_1_style'] ) );
                    }

                    // Button URL 1
                    if (empty($column['price_link']['url'])) {
                        $column['price_link']['url'] = '#';
                    };

                    if (!empty($column['price_link']['url'])) {
                        $this->add_render_attribute('btn-1-link-' . $th_counter, 'href', esc_url($column['price_link']['url']));

                        if (!empty($column['price_link']['is_external'])) {
                            $this->add_render_attribute('btn-1-link-' . $th_counter, 'target', '_blank');
                        }
                    }
                }else{
                    if ( empty( $column['price_link']['url'] ) ) { $column['price_link']['url'] = '#'; };

                    if ( ! empty( $column['price_link']['url'] ) ) {
                        $this->add_render_attribute( 'price_link-'.$th_counter, 'href', esc_url( $column['price_link']['url'] ) );

                        if ( ! empty( $column['price_link']['is_external'] ) ) {
                            $this->add_render_attribute( 'price_link-'.$th_counter, 'target', '_blank' );
                        }
                    }
                }
                ?>



                <div class="th-plist-item">
                    <?php if (($column['price_link']['url'] !== '#' && $column['price_link']['url'] > "") && (isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] != 'yes')){ ?>
                    <a <?php echo $this->get_render_attribute_string( 'price_link-'.$th_counter ); ?>>
                        <?php } ?>

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

                    <?php if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) { ?>
                    <div class="th-plist-price">
                        <div class="th-btn-wrap">
                            <?php if ( isset($button_1_image) && ! empty( $button_1_image ) ) : ?>
                                <?php if ( ! empty( $column['price_link']['url'] ) ) : ?>
                                    <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                        <?php echo wp_kses_post( $button_1_image ); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_kses_post( $button_1_image ); ?>
                                <?php endif; ?>
                            <?php elseif ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'btn-1-link-'.$th_counter ); ?>>
                                    <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
                                        <?php echo esc_html( $column['price_col_button_1_text'] ); ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php }else{ ?>
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
                    <?php }; ?>

                        <?php if (($column['price_link']['url'] !== '#' && $column['price_link']['url'] > "") && (isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] != 'yes')){ ?>
                    </a>
                <?php } ?>
                </div>



            <?php } ?>

        </div>

        <?php } ?>

		<?php
	}

	protected function _content_template() {}

    public function add_wpml_support() {
        add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
    }

    public function wpml_widgets_to_translate_filter( $widgets ) {
        $widgets[ $this->get_name() ] = [
            'conditions'        => [ 'widgetType' => $this->get_name() ],
            'fields'            => array(),
            'integration-class' => 'WPML_Themo_Pricing_List',
        ];
        return $widgets;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Pricing_List() );
