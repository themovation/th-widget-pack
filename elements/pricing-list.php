<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Pricing_List extends Widget_Base {

    
        public function loadTHMVAssets($editMode=false){
            $modified = filemtime(THEMO_PATH.'css/pricing-list.css');
            wp_enqueue_style( $this->get_name(), THEMO_URL . 'css/pricing-list.css', array(), $modified );
        }
        
	public function get_name() {
		return 'themo-pricing-list';
	}

	public function get_title() {
		return __( 'Pricing List', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'th-editor-icon-pricing';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}
        
        private function setupResponsiveControl($settings, $field, $attribute, $class) {
            $responsiveFields = [$field, $field . '_tablet', $field . '_mobile'];
            foreach ($responsiveFields as $f) {
                if (!empty($settings[$f])) {
                    $device = str_replace([$field, '_'], "", $f);
                    if (!empty($device)) {
                        $device = '-' . $device;
                    } else {
                        $device = '-' . 'desktop';
                    }
                    $this->add_render_attribute($attribute, 'class', $class . $device);
                }
            }
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
				'label' => __( 'Content', 'th-widget-pack' ),
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'thmv_icon', [
                'label' => __( 'Icon', 'th-widget-pack' ),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-wifi',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'style' => [ 'style_3'],
                ],

            ]
        );

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
            'description'=>'For style 3, enter every item in a new line.'
    
            ]
        );    

        $repeater->add_control(
            'price1_div', [
            'label' => __( 'Divider', 'th-widget-pack' ),
            'type' => Controls_Manager::DIVIDER,
            'style' => 'thick'
            ]
        );

        $repeater->add_control(
                'price_icon',
                [
                    'label' => __('Icon', 'elementor'),
                    'description' => __('For style 3 only.', 'elementor'),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-home',
                        'library' => 'fa-solid',
                    ],
                ]
        );
        $repeater->add_control(
            'button_div', [
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
            'description'=>'For style 1 and 2 only.'
            /*'conditions' => [
                'terms' => [
                    [
                        'name' => 'style',
                        'operator' => '!=',
                        'value' => 'style_3',
                    ],
                ],
            ],*/
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
//            'conditions' => [
//                'terms' => [
//                    [
//                        'name' => 'price_col_button_1_show',
//                        'operator' => '==',
//                        'value' => 'yes',
//                    ],
//                ],
//            ],
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
        $repeater->add_control(
            'price_div', [
            'label' => __( 'Divider', 'th-widget-pack' ),
            'type' => Controls_Manager::DIVIDER,
            'style' => 'thick'
            ]
        );

//        $repeater->add_control(
//            'button_1_image', [
//            'label' => __( 'Button Graphic', 'th-widget-pack' ),
//            'type' => Controls_Manager::MEDIA,
//            'dynamic' => [
//                'active' => true,
//            ],
//            'conditions' => [
//                'terms' => [
//                    [
//                        'name' => 'price_col_button_1_show',
//                        'operator' => '==',
//                        'value' => 'yes',
//                    ],
//                ],
//            ],
//            ]
//        );
        
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
//            'conditions' => [
//                'terms' => [
//                    [
//                        'name' => 'price_col_button_1_show',
//                        'operator' => '==',
//                        'value' => '',
//                    ],
//                ],
//            ],
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
//            'conditions' => [
//                'terms' => [
//                    [
//                        'name' => 'price_col_button_1_show',
//                        'operator' => '==',
//                        'value' => '',
//                    ],
//                ],
//            ],
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
                'tab' => Controls_Manager::TAB_STYLE,
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
                    'style_2' => __( 'Style 2', 'th-widget-pack' ),
                    'style_3' => __( 'Style 3', 'th-widget-pack' ),
                ],
            ]
        );



        $this->add_control(
            'spacing',
            [
                'label' => __( 'Spacing', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-plist-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .th-price-list.th-show-divider .th-plist-item' => 'padding-bottom: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'style_1',
                    //'price_divider' => ''
                ],
            ]
        );

        $this->add_control(
            'spacing_alt',
            [
                'label' => __( 'Spacing', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even)' => 'margin-top: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
                ],
            ]
        );

        /*$this->add_control(
            'divider_spacing',
            [
                'label' => __( 'Spacing', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [

                ],
                'condition' => [
                    'style' => 'style_1',
                    'price_divider' => 'yes'
                ],
            ]
        );*/

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __( 'Icon', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        /*$this->add_control(
            'section_price_icon_heading',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );*/

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon ' => 'color: unset;',
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon svg path' => 'fill: {{VALUE}};',
                ],
                'default' => '#1b1b1b',
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'icon_color_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thmv-prc-styl-3 .th-price-list:nth-child(even) .thmv-info-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 .th-price-list:nth-child(even) .thmv-info-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 .th-price-list:nth-child(even) .thmv-info-icon svg path' => 'fill: {{VALUE}};',
                ],
                'default' => '#1b1b1b',
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 12,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon' => 'width:unset; min-width: 60px;',
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 .thmv-info-icon svg' => 'height:auto; width: {{SIZE}}px;',
                ],
                'condition' => [
                    'style' => ['style_3']
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
            ]
        );



        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-plist-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-plist-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
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

        /* SUB TITLE STYLE 1 and 2 */

        $this->add_control(
            'section_sub_title_heading',
            [
                'label' => __( 'Subtitle', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => ['style_1','style_2']
                ],
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-subtitle' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_1','style_2']
                ],
            ]
        );

        $this->add_control(
            'sub_title_color_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-plist-subtitle' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2']
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_sub_title_typography',
                'selector' => '{{WRAPPER}} .th-plist-subtitle',
                'condition' => [
                    'style' => ['style_1','style_2']
                ],
            ]
        );

        /* SUB TITLE / DESCRIPTION STYLE 3 */
        $this->add_control(
            'section_sub_title_heading_S3',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'sub_title_color_S3',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .thmv-prc-styl-3 .th-plist-subtitle' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 ul li:not(:last-child):after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'sub_title_color_S3_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .thmv-prc-styl-3 .th-price-list:nth-child(even) .th-plist-subtitle' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .thmv-prc-styl-3 .th-price-list:nth-child(even) ul li:not(:last-child):after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_sub_title_typography_S3',
                'selector' => '{{WRAPPER}} .thmv-prc-styl-3 .th-plist-subtitle',
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        /* DESCRIPTION */
        $this->add_control(
            'section_description_heading',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => ['style_1','style_2']
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_1','style_2']
                ],
            ]
        );

        $this->add_control(
            'description_color_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-plist-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .th-plist-description',
                'condition' => [
                    'style' => ['style_1','style_2']
                ],
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
                'default' => '#2C2C2C',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-price-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_color_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#2C2C2C',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-plist-price-number' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
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
            'section_divider_heading',
            [
                'label' => __( 'Divider', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => 'style_1',
                    'price_divider' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => __( 'Style', 'plugin-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid'  => __( 'Solid', 'plugin-domain' ),
                    'dashed' => __( 'Dashed', 'plugin-domain' ),
                    'dotted' => __( 'Dotted', 'plugin-domain' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-price-list.th-show-divider .th-plist-item' => 'border-bottom-style: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_1',
                    'price_divider' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-show-divider .th-plist-item' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_1',
                    'price_divider' => 'yes'
                ],
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
                'default' => '#2C2C2C',
                'selectors' => [
                    '{{WRAPPER}} .th-plist-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_text_color_2',
            [
                'label' => __( 'Color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                
                'default' => '#2C2C2C',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-plist-price-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
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
            'section_price_text_bg_heading',
            [
                'label' => __( 'Price Background', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'price_background',
            [
                'label' => __( 'color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .thmv-info-pricing' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'price_background_2',
            [
                'label' => __( 'color 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .thmv-info-pricing' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );

        $this->add_responsive_control(
            'price_background_radius',
            [
                'label' => __('Corner Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .thmv-info-pricing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style_3']
                ],
            ]
        );


        $this->end_controls_section();


        /* Button */
        $this->start_controls_section(
                'button_style_section',
                [
                        'label' => __( 'Button', 'th-widget-pack' ),
                        'tab' => Controls_Manager::TAB_STYLE,
                ]

	    );

        /*$this->add_control(
            'section_button_text_heading',
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );*/

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list .th-btn' => 'color: {{VALUE}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],

            ]
        );

        $this->add_control(
            'button_text_background_color',
            [
                'label' => __('Background', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list .th-btn' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
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

        $this->add_control(
            'section_button_background',
            [
                'label' => __( 'Hover', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __('Text', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list .th-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
                'button_text_background_color_hover',
                [
                    'label' => __('Background', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .th-price-list .th-btn:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                    ],
                ]
        );


        $this->add_control(
                'price_col_button_1_style',
                [
                    'label' => __('Button Style', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'standard-primary',
                    'options' => [
                        '' => __('Default', 'th-widget-pack'),
                        'standard-primary' => __('Standard Primary', 'th-widget-pack'),
                        'standard-accent' => __('Standard Accent', 'th-widget-pack'),
                        'standard-light' => __('Standard Light', 'th-widget-pack'),
                        'standard-dark' => __('Standard Dark', 'th-widget-pack'),
                        'ghost-primary' => __('Ghost Primary', 'th-widget-pack'),
                        'ghost-accent' => __('Ghost Accent', 'th-widget-pack'),
                        'ghost-light' => __('Ghost Light', 'th-widget-pack'),
                        'ghost-dark' => __('Ghost Dark', 'th-widget-pack'),
                        'cta-primary' => __('CTA Primary', 'th-widget-pack'),
                        'cta-accent' => __('CTA Accent', 'th-widget-pack'),
                    ],
                    'separator' => 'before',
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
        $this->add_responsive_control(
                'thmv_button_stretch',
                [
                    'label' => __('Stretch Button', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                ]
        );


        $this->add_control(
            'section_button_2',
            [
                'label' => __( 'Button 2', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => ['style_2','style_3']
                ],
            ]
        );

        $this->add_control(
            'button_text_color_2',
            [
                'label' => __( 'Text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-btn' => 'color: {{VALUE}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
                ],

            ]
        );


        $this->add_control(
            'button_background_color_2',
            [
                'label' => __('Background', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-btn' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
                ],
            ]
        );

        $this->add_control(
            'section_button_background_2',
            [
                'label' => __( 'Button 2 Hover', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => ['style_2','style_3']
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover_2',
            [
                'label' => __('Text', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
                ],
            ]
        );

        $this->add_control(
            'button_background_color_hover_2',
            [
                'label' => __('Background', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even) .th-btn:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_2','style_3']
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
                    'style' => ['style_2','style_3']
                ],
            ]
        );

        $this->add_control(
            'background_1',
            [
                'label' => __( 'Background 1', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(odd)' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_2',
            [
                'label' => __( 'Background 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list:nth-child(even)' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'Border',
            [
                'label' => __( 'Border', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-price-list' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'background_radius',
            [
                'label' => __('Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .th-price-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            //$this->add_render_attribute('th-price-list-class', 'class', 'row');
            $this->add_render_attribute('th-price-list-class', 'class', 'fsi-row-lg-level');
            $this->add_render_attribute('th-price-list-class', 'class', 'fsi-row-md-level');
            $this->add_render_attribute('th-price-list-class', 'class', 'fsi-row-sm-level');
            //$themo_list_row_class .= ' th-package-style-2';
            $th_list_style_2 = true;
        }
       $buttonstyle = $settings['price_col_button_1_style'];
       
        switch( $settings['style'] ) {
            case "style_1":
                ?>
                <div <?php echo $this->get_render_attribute_string( 'th-price-list-class'); ?>>

                    <?php $th_counter=0; foreach( $settings['pricing'] as $column ) { ?>

                        <?php ++$th_counter; ?>


                        <?php

                        if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) {
                            
                            
                             // Bootstrap Button URL Styling
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                            $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-' . esc_attr( $buttonstyle ) );
                            $this->setupResponsiveControl($settings, 'thmv_button_stretch', 'btn-1-link-'.$th_counter, 'streched');

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
                                            <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
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

            <?php
                break;
            case "style_2":
                $th_counter=0; foreach( $settings['pricing'] as $column ) {

                ++$th_counter;
                //https://getbootstrap.com/docs/3.3/examples/grid/


                if ( isset( $column['price_col_button_1_show'] ) && $column['price_col_button_1_show'] == 'yes' ) {

                    
                    // Bootstrap Button URL Styling
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-1' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'th-btn' );
                        $this->add_render_attribute( 'btn-1-link-'.$th_counter, 'class', 'btn-' . esc_attr( $buttonstyle ) );
                        $this->setupResponsiveControl($settings, 'thmv_button_stretch', 'btn-1-link-'.$th_counter, 'streched');


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
                                    <?php if ( ! empty( $column['price_col_button_1_text'] ) ) : ?>
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
                break;
            case "style_3":

                    ?>
                <!--- Pricing-style-3 start--->

                <div class="thmv-prc-styl-3">
                    <?php

                    foreach ($settings['pricing'] as $column):
                        $this->remove_render_attribute('thmv_link'); //reset
                        $this->setupResponsiveControl($settings, 'thmv_button_stretch', 'thmv_link', 'streched');
                        if (empty($buttonstyle)) {
                                $this->add_render_attribute('thmv_link', 'class', 'thmv-learn-btn th-btn');
                            } else {
                                $this->add_render_attribute('thmv_link', 'class', 'th-btn btn btn-1 btn-' . $buttonstyle);
                        }
                        $price = isset($column['price_price']) && !empty($column['price_price']) ? $column['price_price'] : '';
                         $priceText = isset($column['price_text']) && !empty($column['price_text']) ? $column['price_text'] : '';
                         $icon = isset($column['price_icon']) ? $column['price_icon'] : false;
                        
                         
                        $buttonURL = $column['price_link']['url'];
                        $buttonText = $column['price_col_button_1_text']; 
                        
                        
                        
                        
                        
                        if (!empty($buttonURL)) {
                            $this->add_render_attribute('thmv_link', 'href', esc_url($buttonURL), true);
                            if (!empty($column['price_link']['is_external'])) {
                                $this->add_render_attribute('thmv_link', 'target', '_blank', true);
                            }
                            if (!empty($column['price_link']['nofollow'])) {
                                $this->add_render_attribute('thmv_link', 'rel', 'nofollow', true);
                            }
                        }
                        
                     $descriptionArr = explode("\n", $column['price_description']);  
                ?>
                    <div class="thmv-prc-row th-price-list">
                        <div class="thmv-column-1">
                         
                            <?php if ($icon) {
                                
                                ?>
                                <div class="elementor-icon thmv-info-icon">
                                    <?php
                                     Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
                                    ?>

                                </div>
                                <?php
                            }
                            ?>
                            
                            <div class="thmv-info">
                                <h3 class="th-plist-title"><?= esc_html($column['price_title']) ?></h3>
                                <?php if (count($descriptionArr)): ?>
                                    <ul class="meta_info">

                                        <?php foreach ($descriptionArr as $desc): ?>
                                            <li class="th-plist-subtitle"><?= esc_html($desc) ?></li>

                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($price || $priceText) : ?>

                            <div class="thmv-column-2">
                                <div class="thmv-info-pricing">
                                    <div class="thmv-price th-plist-price-number"><?= esc_html($price) ?></div>
                                    <div class="thmv-price-title th-plist-price-text"><?= esc_html($priceText) ?></div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="thmv-column-3">
                            <div class="thmv-info-button">
                                <a <?php echo $this->get_render_attribute_string('thmv_link'); ?>>
                                    <?= isset($buttonText) ? $buttonText : '' ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
               
                <!--- Priceing-style-3 end--->
            <?php
                break;
        }


        if($th_list_style_2){

        ?>

        <?php
        }else{ ?>



        <?php } ?>

		<?php
	}

	protected function content_template() {}

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
