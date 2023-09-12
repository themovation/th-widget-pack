<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Portfolio_Grid extends Widget_Base {

    public function loadTHMVAssets($editMode=false){
        $modified = filemtime(THEMO_PATH.'css/portfolio.css');
        wp_enqueue_style( $this->get_name(), THEMO_URL . 'css/portfolio.css', array(), $modified );
    }

    public function get_name() {
        return 'themo-portfolio-grid';
    }

    public function get_title() {
        return __( 'Portfolio Grid', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'th-editor-icon-portfolio-grid';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    private function get_tours_list() {
        $portfolio = array();

        $loop = new \WP_Query( array(
            'post_type' => array('themo_portfolio'),
            'posts_per_page' => -1,
            'post_status'=>array('publish'),
        ) );

        $portfolio['none'] = __('None', 'th-widget-pack');

        while ( $loop->have_posts() ) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $portfolio[$id] = $title;
        endwhile;

        //wp_reset_query();
        wp_reset_postdata();

        return $portfolio;
    }

    private function get_project_group_list() {
        $portfolio_group = array();

        $portfolio_group['none'] = __( 'None', 'th-widget-pack' );

        $taxonomy = 'themo_project_type';

        $tax_terms = get_terms( $taxonomy );

        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
            foreach( $tax_terms as $item ) {
                $portfolio_group[$item->term_id] = $item->name;
            }
        }

        return $portfolio_group;
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Data source', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'filter',
            [
                'label' => __( 'Show Filters', 'th-widget-pack' ),
                'descrition' => __( 'Use Groups to filter your results.', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'term_hierarchy',
            [
                'label' => __( 'Term Hierarchy', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'parent' => __( 'Parent', 'th-widget-pack' ),
                    'child' => __( 'Child', 'th-widget-pack' ),
                ],
                'default' => 'parent',
                'condition' => [
                    'filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_sort_label',
            [
                'label' => __( "Show 'Sort:'", 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'th-widget-pack' ),
                'label_off' => __( 'Hide', 'th-widget-pack' ),
                'return_value' => 'yes',
                'condition' => [
                    'filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_all',
            [
                'label' => __( "Show 'All'", 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'th-widget-pack' ),
                'label_off' => __( 'Hide', 'th-widget-pack' ),
                'return_value' => 'yes',
                'condition' => [
                    'filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'individual',
            [
                'label'   => __( 'Select Individually', 'th-widget-pack' ),
                'type'    => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                //'default' => 'none',
                'options' => $this->get_tours_list(),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'group',
            [
                'label'   => __( 'Select by Group', 'th-widget-pack' ),
                'type'    => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                //'default' => 'none',
                'options' => $this->get_project_group_list()
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Order by', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'menu_order',
                'options' => [
                    'date' => __( 'Date Published', 'th-widget-pack' ),
                    'title' => __( 'Title', 'th-widget-pack' ),
                    'menu_order' => __( 'Drag and Drop', 'th-widget-pack' ),
                ],
            ]
        );





        $this->end_controls_section();

        $this->start_controls_section(
            'layout_style',
            [
                'label' => __( 'Layout Style', 'th-widget-pack' ),
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
                    'style_2' => __( 'Style 2', 'th-widget-pack' )
                ],
            ]
        );
        $this->add_control(
            'sortorder',
            [
                'label' => __( 'Order', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => __( 'Ascending', 'th-widget-pack' ),
                    'DESC' => __( 'Descending', 'th-widget-pack' ),
                ],
                'condition' => [
                    'order!' => 'menu_order',
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => __( '2', 'th-widget-pack' ),
                    '3' => __( '3', 'th-widget-pack' ),
                    '4' => __( '4', 'th-widget-pack' ),
                    '5' => __( '5', 'th-widget-pack' ),
                ],
            ]
        );


        $this->add_control(
            'gutter',
            [
                'label' => __( 'Gutter', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'on',
                'options' => [
                    'on' => __( 'On', 'th-widget-pack' ),
                    'off' => __( 'Off', 'th-widget-pack' )
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => __('Spacing', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-port-gutter .th-portfolio-item' => 'border: {{SIZE}}{{UNIT}} solid transparent;',
                ],
                'condition' => [
                    'gutter' => 'on'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_price_style',
            [
                'label' => __( 'Image & Overlay', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'featured_image_size',
                'default' => 'th_img_md_square',
                'exclude' => [ 'thumbnail','medium','medium_large','large','1536x1536','2048x2048','themo-logo','th_img_xs','th_img_lg','th_img_xl','th_img_xxl','themo_brands','th_img_sm_standard','custom'],
                //$size = $settings[ 'grid_image' . '_size' ];
                //$size = $settings['featured_image_size'];
            ]
        );

        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __( 'Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .th-port-card-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .th-port-card-img',
            ]
        );


        $this->add_control(
            'thmv_section_img_text',
            [
                'label' => __('Text', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_price_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-card-caption p' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'elementor'),
                'name' => 'thmv_price_typography',
                'selector' => '{{WRAPPER}} .th-port-style-2 .th-port-card-caption p',
            ]
        );

        $this->add_control(
            'thmv_section_img_overlay',
            [
                'label' => __('Overlay', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_gradient',
                'label' => esc_html__( 'Image Gradient', 'th-widget-pack' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .th-port-style-2 .th-port-card .th-port-card-img:after',
                'description' => 'Control the image overlay gradient.',
            ]
        );
        $this->add_control(
            'thmv_section_img_behavior',
            [
                'label' => __('Hover', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'img_hover',
            [
                'label' => __( 'Grow image', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                //'default' => 'no',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-item' => 'overflow:visible;',
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-img' => 'transform:none;',
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-card-img' => 'transform:scale(1.05,1.05);',
                    '{{WRAPPER}} .th-port-card-img' => ' -webkit-transition:all 0.25s linear; -moz-transition:all 0.25s linear; transition:all 0.25s linear;',
                ],
            ]
        );

        $this->add_control(
            'card_hover',
            [
                'label' => __( 'Grow content', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                //'default' => 'no',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-card-img' => 'transform:none;',
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-card' => 'transform:scale(1.05,1.05);',
                    '{{WRAPPER}} .th-port-card' => ' -webkit-transition:all 0.25s linear; -moz-transition:all 0.25s linear; transition:all 0.25s linear;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_style_background',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_2',
                ],
            ]
        );



        /* STYLE - Title */
        $this->add_control(
            'thmv_section_title_heading',
            [
                'label' => __('Title', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#2C2C33',
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-title' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'elementor'),
                'name' => 'thmv_title_typography',
                'selector' => '{{WRAPPER}} .th-port-style-2 .th-port-title',
            ]
        );

        /* STYLE - Text */
        $this->add_control(
            'thmv_section_text_heading',
            [
                'label' => __('Text', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_text_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-sub' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'elementor'),
                'name' => 'thmv_text_typography',
                'selector' => '{{WRAPPER}} .th-port-style-2 .th-port-sub',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Content Align', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                    '{{WRAPPER}} .th-port-card-body' => 'text-align: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        /* STYLE - Background */
        $this->add_control(
            'thmv_section_background',
            [
                'label' => __('Background', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_background_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .th-port-card-default' => 'background-color: {{VALUE}};',
                ],

            ]
        );


        $this->add_responsive_control(
            'thmv_background_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .th-port-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label' => __( 'Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .th-port-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .th-port-card',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_background',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_1',
                ],
            ]
        );

        $default_rgba = 'rgba(0, 0, 0, 0.75)'; // Fallback RGBA\

        if ( function_exists( 'get_theme_mod' ) ) {

            $default_hex = get_theme_mod( 'color_primary', $default_rgba );

            // Test if HEX, then convert to RGBA, else use RGBA
            if (isset($default_hex) && strpos($default_hex, '#') !== false) {
                list($r, $g, $b) = sscanf($default_hex, "#%02x%02x%02x");
                $default_rgba = "rgba(".$r .", ". $g. ", ". $b . ", 0.75)";
            }elseif(isset($default_hex)){
                $default_rgba = $default_hex;
            }


        }

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'featured_image_size_grid',
                'default' => 'th_img_sm_square',
                'exclude' => [ 'thumbnail','medium','medium_large','large','1536x1536','2048x2048','themo-logo','th_img_xs','th_img_lg','th_img_xl','th_img_xxl','themo_brands','th_img_sm_standard','custom'],
                //$size = $settings[ 'grid_image' . '_size' ];
                //$size = $settings['featured_image_size'];
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => __( 'Hover Background Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => $default_rgba,
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-overlay' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );


        $this->add_control(
            'show_overlay_mobile',
            [
                'label' => __( 'Always Show Content for Mobile', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '(mobile){{WRAPPER}} .th-port-center' => 'opacity: 1;',
                ],
            ]
        );

        $this->add_control(
            'hover_color_mobile',
            [
                'label' => __( 'Background Color for Mobile', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => $default_rgba,
                'selectors' => [
                    '(mobile){{WRAPPER}} .th-portfolio-item .th-port-overlay' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_overlay_mobile' => 'yes',
                ],
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'show_overlay_tablet',
            [
                'label' => __( 'Always Show Content for Tablet', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '(tablet){{WRAPPER}} .th-port-center' => 'opacity: 1;',
                ],
            ]
        );

        $this->add_control(
            'hover_color_tablet',
            [
                'label' => __( 'Background Color for Tablet', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => $default_rgba,
                'selectors' => [
                    '(tablet){{WRAPPER}} .th-portfolio-item .th-port-overlay' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_overlay_tablet' => 'yes',
                ],
                'separator' => 'none',
                //'label_block' => true,
            ]
        );

        $this->add_control(
            'show_overlay_desktop',
            [
                'label' => __( 'Always Show Content for Desktop', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '(desktop){{WRAPPER}} .th-port-center' => 'opacity: 1;',
                ],
            ]
        );

        $this->add_control(
            'hover_color_desktop',
            [
                'label' => __( 'Background Color for Desktop', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,

                'default' => $default_rgba,
                'selectors' => [
                    '(desktop){{WRAPPER}} .th-portfolio-item .th-port-overlay' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_overlay_desktop' => 'yes',
                ],
                'separator' => 'none',
                //'label_block' => true,
            ]
        );

        $this->add_control(
            'hide_text_on_hover',
            [
                'label' => __( 'Hide Text on Hover', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-top-text' => 'opacity: 0;',
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-center' => 'opacity: 0;',
                ],
                //'separator' => 'before'

            ]
        );

        $this->add_control(
            'thmv_section_text',
            [
                'label' => __('Text', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'thmv_text_color',
            [
                'label' => __('Color', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-port-top-text, {{WRAPPER}} .th-port-title, {{WRAPPER}} .th-port-sub, {{WRAPPER}} .th-pricing-cost' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'thmv_section_button',
            [
                'label' => __('Button', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'elementor'),
                'name' => 'thmv_link_typography',
                'selector' => '{{WRAPPER}} .thmv-btn',
            ]
        );
        $this->add_control(
            'thmv_link_color',
            [
                'label' => __('Color', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thmv-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'thmv_link_background_color',
            [
                'label' => __('Background', 'th-widget-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thmv-btn' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => __('Button Style', 'th-widget-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
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
            'thmv_link_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .thmv-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_style_filter_bar',
            [
                'label' => __( 'Filter Bar', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'filter_bar_text_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_bar_link_color',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters a' => 'color: {{VALUE}};  opacity:0.8;',
                    '{{WRAPPER}} .th-portfolio-filters a.current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'elementor'),
                'name' => 'thmv_filter_typography',
                'selector' => '{{WRAPPER}} .th-portfolio-filters',
            ]
        );

        $this->add_control(
            'filter_bar_hover_color',
            [
                'label' => __( 'Hover', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters a:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}; opacity:1;',
                ],
            ]
        );

        $this->add_control(
            'filter_bar_active_color',
            [
                'label' => __( 'Active', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .th-portfolio-filters a.current' => 'color: {{VALUE}}; opacity:1; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_bar_text_color',
            [
                'label' => __( 'Sort Label', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*$this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();*/

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( isset( $settings['style'] ) &&  $settings['style'] == 'style_2' ){
            $img_size = $settings[ 'featured_image_size' . '_size' ];
        }else{
            $img_size = $settings[ 'featured_image_size_grid' . '_size' ];
        }


        $buttonstyle = $settings['button_style'];

        $this->remove_render_attribute('thmv_link'); //reset
        if (empty($buttonstyle)) {
            $this->add_render_attribute('thmv_link', 'class', 'th-port-btn', true);
        } else {
            $this->add_render_attribute('thmv_link', 'class', 'thmv-btn btn btn-1 th-btn btn-' . $buttonstyle, true);
        }

        global $th_folio_count;
        $folio_id = 'th-portfolio-' . ++$th_folio_count;


        switch( $settings['columns'] ) {
            case 2:
                $portfolio_row = ' two-columns';
                $portfolio_item = array('th-portfolio-item', 'item', 'col-sm-6');
                break;
            case 3:
                $portfolio_row = ' three-columns';
                $portfolio_item = array('th-portfolio-item', 'item', 'col-md-4', 'col-sm-6');
                break;
            case 4:
                $portfolio_row = ' four-columns';
                $portfolio_item = array('th-portfolio-item', 'item', 'col-md-3', 'col-sm-6');
                break;
            case 5:
                $portfolio_row = ' five-columns';
                $portfolio_item = array('th-portfolio-item', 'item', 'col-md-2', 'col-sm-6', 'row-eq-height');
                break;
            default:
                $portfolio_row = '';
                $portfolio_item = array();
        }

        if ( isset( $settings['gutter'] ) &&  $settings['gutter'] == 'on' ){
            $portfolio_row .= ' th-port-gutter';
        }

        $th_port_style_2 = false;
        if ( isset( $settings['style'] ) &&  $settings['style'] == 'style_2' ){
            $portfolio_row .= ' th-port-style-2 display-flex';
            $th_port_style_2 = true;
        }

        ?>

        <?php
        $th_uid = uniqid( 'th-portfolio-content-' );
        ?>
        <div id="<?php echo esc_attr($th_uid); ?>" class="th-portfolio">

            <?php if ( $settings['filter'] == 'yes' ) : ?>

                <div id="filters" class="th-portfolio-filters">
                    <?php
                    if(isset($settings['filter_sort_label']) && $settings['filter_sort_label'] =='yes') { ?>
                        <span><?php echo esc_html__( 'Sort:', 'th-widget-pack' ); ?></span>
                    <?php } ?>

                    <?php if(isset($settings['filter_all']) && $settings['filter_all']) { ?>
                        <a href="#" data-filter="*" class="current"><?php echo esc_html__( 'All', 'th-widget-pack' ); ?></a>
                    <?php } ?>

                    <?php
                    $taxonomy = 'themo_project_type';

                    // Only show filter links for the groups selected.
                    $tax_args = array(
                        'taxonomy' => $taxonomy,
                        'include' => $settings['group'],
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => $settings['sortorder'],
                        'parent' => 0,
                    );

                    $tax_terms = get_terms( $tax_args );

                    // Child terms only
                    if(isset($settings['term_hierarchy']) && $settings['term_hierarchy'] == 'child' ){
                        foreach ( $tax_terms as $pterm ) {
                            //Get the Child terms
                            $tax_args['parent']=$pterm->term_id;
                            $tax_args['hide_empty']=true;

                            $child_tax_terms = get_terms( $tax_args );
                            foreach ( $child_tax_terms as $cterm ) {
                                echo '<a href="#" data-filter="#'.esc_attr($th_uid).' .p-' . esc_attr($cterm->slug) . '">' . esc_html($cterm->name) .'</a>';
                            }
                        }

                    }else{ // Parent terms
                        foreach ( $tax_terms as $tax_term ) {
                            echo '<a href="#" data-filter="#'.esc_attr($th_uid).' .p-' . esc_attr($tax_term->slug) . '">' . esc_html($tax_term->name) .'</a>';
                        }
                    }
                    ?>
                </div>

            <?php endif; ?>

            <div id="th-portfolio-row" class="th-portfolio-row row portfolio_content <?php echo esc_attr($portfolio_row); ?>">

                <?php
                $args = array();
                if ( $settings['individual'] ) {
                    if ( in_array( 'none', $settings['individual'] ) ) {
                        $settings['individual'] = array_diff( $settings['individual'], array( 'none' ) );
                    }
                    if ( $settings['individual'] ) {
                        $post_ids = $settings['individual'];
                        $args['post__in'] = $post_ids;
                    }
                }
                $args['post_type'] = array( 'themo_portfolio' );
                if ( $settings['group'] ) {
                    if ( in_array( 'none', $settings['group'] ) ) {
                        $settings['group'] = array_diff( $settings['group'], array( 'none' ) );
                    }
                    if ( $settings['group'] ) {
                        $project_type_id = $settings['group'];
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'themo_project_type',
                                'field'    => 'term_id',
                                'terms'    => $project_type_id,
                                //'operator' => 'IN',
                            ),
                        );
                    }
                }
                if ( $settings['order'] == 'date' ) {
                    $args['orderby'] = 'date';
                    $args['order'] = $settings['sortorder'];
                }elseif($settings['order'] == 'title'){
                    $args['orderby'] = 'title';
                    $args['order'] = $settings['sortorder'];
                }elseif ( $settings['order'] == 'menu_order' ) {
                    $args['orderby'] = 'menu_order';
                    $args['order'] = 'ASC';
                }
                $args['post_status'] = 'publish';
                $args['posts_per_page'] = -1;

                // The Query
                $query = new \WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        // get post format
                        $format = get_post_format();
                        if ( false === $format ) {
                            $format = '';
                        }

                        // default settings
                        $link_url = get_the_permalink();
                        $link_title = get_the_title();
                        $link_target_markup = false;
                        $th_image_url = false;
                        $alt_text = '';

                        // Link post type options
                        if ( isset( $format ) && $format == 'link' ) {

                            $link_url = get_post_meta( get_the_ID(), '_format_link_url', true );
                            $link_title = get_post_meta( get_the_ID(), '_format_link_title', true );
                            $link_target = get_post_meta( get_the_ID(), '_format_link_target' );

                            if ( ! $link_url > "" ) {
                                $link_url = get_the_permalink();
                            }

                            // Link Target
                            if( isset( $link_target[0][0] ) && $link_target[0][0] == "_blank" ) {
                                $link_target_markup = "target='_blank'";
                            }

                            // Custom Title
                            if( ! $link_title > "" ) {
                                $link_title = get_the_title();
                            }
                        }

                        // Get Project Format Options
                        $project_thumb_alt_img = get_post_meta( get_the_ID(), 'th_project_thumb', false );

                        $fallback_lightbox_image = false;

                        if ( isset( $project_thumb_alt_img[0] ) && $project_thumb_alt_img[0] > "" ) {
                            $alt = false;

                            // Check if Image comes in Med size with Square crop / else get small

                            $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], $img_size);

                            $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], $img_size);

                            /*if ($th_image) {

                                $width = $th_image[1];
                                $height = $th_image[2];


                                if ((605 !== $width) && (605 !== $height)){

                                    // Check if Image comes in Small size with Square crop / else get thumb

                                    $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "th_img_sm_square");

                                    $width = $th_image[1];
                                    $height = $th_image[2];

                                    if ((394 !== $width) && (394 !== $height)){

                                        $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "thumbnail");
                                    }
                                }
                            }*/
                            $th_image_url = false;
                            if( isset( $th_image[0] ) ) {
                                $th_image_url = $th_image[0];

                            }
                            $alt_text = get_post_meta($project_thumb_alt_img[0], '_wp_attachment_image_alt', true);
                            $fallback_lightbox_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "th_img_xl");


                        }

                        //Image post type options
                        if( isset( $format ) && $format == 'image' ) {

                            // Fallback lightbox url
                            if( isset( $fallback_lightbox_image[0] ) ) {
                                $link_url = $fallback_lightbox_image[0];
                            }


                            // lightbox mark up
                            $featured_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'th_img_xl' );
                            if( isset( $featured_url[0] ) ) {
                                $link_url = $featured_url[0];
                            }
                            $elementor_global_image_lightbox = get_option('elementor_global_image_lightbox');

                            if (!empty($elementor_global_image_lightbox) && $elementor_global_image_lightbox == 'yes') {
                                $link_target_markup = false;
                            }else{
                                $link_target_markup = ' data-toggle=lightbox data-gallery=multiimages';
                            }

                            $link_title = the_title_attribute( 'echo=0' );
                        }

                        $filtering_links = array();
                        $terms = get_the_terms( get_the_ID(), 'themo_project_type' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                $filtering_links[] = 'p-' . $term->slug;
                            }
                        }

                        $classes = array_merge( $portfolio_item, $filtering_links );
                        ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

                            <?php if($th_port_style_2){ ?>
                            <div class="th-port-card th-port-card-default">
                                <?php echo '<a href="' . esc_url( $link_url ) . '" class="th-port-card-link" ' . esc_html( $link_target_markup ) . '>'; ?>
                                <span class="th-port-card-img">
                            <?php }else { ?>
                            <div class="th-port-wrap">
                            <?php } ?>
                                <?php
                                if ( isset( $th_image_url ) && $th_image_url > "" ) {
                                    echo '<img class="img-responsive th-port-img" src="' . esc_url( $th_image_url ) . '" alt="' . esc_attr( $alt_text ) . '">';
                                } else {
                                    if ( has_post_thumbnail( get_the_ID() ) ) {
                                        $featured_img_attr = array( 'class'	=> "img-responsive th-port-img" );

                                        $th_id = get_post_thumbnail_id(get_the_ID());
                                        $th_image = wp_get_attachment_image_src($th_id, $img_size);

                                        if ($th_image){

                                            $width = $th_image[1];
                                            $height = $th_image[2];

                                            echo wp_kses_post(get_the_post_thumbnail( get_the_ID(), $img_size, $featured_img_attr ));

                                            /*if ((605 == $width) && (605 == $height)){
                                                echo wp_kses_post(get_the_post_thumbnail( get_the_ID(), $img_size, $featured_img_attr ));
                                            }
                                            else{
                                                $th_image = wp_get_attachment_image_src($th_id, "th_img_sm_square");
                                                $width = $th_image[1];
                                                $height = $th_image[2];

                                                if ((394 == $width) && (394 == $height)){
                                                    echo wp_kses_post(get_the_post_thumbnail( get_the_ID(), "th_img_sm_square", $featured_img_attr ));
                                                }else{
                                                    //default when no image
                                                    echo wp_kses_post(get_the_post_thumbnail( get_the_ID(), "thumbnail", $featured_img_attr ));
                                                }

                                            }*/
                                        }
                                    }else{
                                        echo '<img width="605" height="605" src="https://via.placeholder.com/605x605?'.
                                            __('text=No+featured+image+found','th-widget-pack').
                                            '" class="img-responsive th-port-img wp-post-image" alt="">';
                                    }
                                }

                                $th_project_title = get_the_title();
                                $th_project_title_meta = get_post_meta( get_the_ID(), 'th_project_title', true );
                                if( $th_project_title_meta > "" ) {
                                    $th_project_title = $th_project_title_meta;
                                }

                                $th_project_highlight = false;
                                $th_project_highlight = get_post_meta( get_the_ID(), 'th_project_highlight', true );

                                $th_tour_price = false;
                                $th_tour_price = get_post_meta( get_the_ID(), 'th_tour_price', true );

                                $th_tour_price_per = false;
                                $th_tour_price_per = get_post_meta( get_the_ID(), 'th_tour_price_per', true );

                                $th_project_intro = false;
                                $th_project_intro = get_post_meta( get_the_ID(), 'th_project_intro', true );
                                if( $th_project_intro === false || empty( $th_project_intro ) ) {
                                    $automatic_post_excerpts = 'on';
                                    if ( function_exists( 'get_theme_mod' ) ) {
                                        $automatic_post_excerpts = get_theme_mod( 'themo_automatic_post_excerpts', 'on' );
                                    }
                                    if( $automatic_post_excerpts === 'off' ) {
                                        $th_project_intro = apply_filters( 'the_content', get_the_content() );
                                        $th_project_intro = str_replace( ']]>', ']]&gt;', $th_project_intro );
                                        if( $th_project_intro != "" ) {
                                            $th_project_intro = '<p class="th-port-sub">' . $th_project_intro . '</p>';
                                        }
                                    } else {
                                        $th_project_intro = apply_filters( 'the_excerpt', get_the_excerpt() );
                                        $th_project_intro = str_replace( ']]>', ']]&gt;', $th_project_intro );
                                        $th_project_intro = str_replace( '<p', '<p class="th-port-sub th-auto-off"', $th_project_intro );
                                    }
                                }else{
                                    $th_project_intro = '<p class="th-port-sub th-else">' . $th_project_intro . '</p>';
                                }

                                $th_project_button_text = false;
                                $th_project_button_text = get_post_meta( get_the_ID(), 'th_project_button_text', true );
                                ?>
                                <?php if($th_port_style_2){ ?>
                                    <?php if($th_tour_price > ""){
                                        echo '<div class="th-port-card-caption th-pricing-cost"><p>', $th_tour_price,$th_tour_price_per,'</p></div>';
                                    }?>
                                    </span>
                                    <span class="th-port-card-body">
                                      <h3 class="th-port-title"><?php echo esc_html( $th_project_title ); ?></h3>
                                      <?php echo wp_kses_post($th_project_intro); ?>
                                    </span>
                                    </a>
                                </div>

                                <?php }else { ?>
                                <div class="th-port-overlay"></div>
                                <div class="th-port-inner">
                                    <?php if( $th_project_highlight ) { ?>
                                        <div class="th-port-top-text"><?php echo esc_html($th_project_highlight); ?></div>
                                    <?php } ?>
                                    <div class="th-port-center">
                                        <h3 class="th-port-title"><?php echo esc_html( $th_project_title ); ?></h3>
                                        <?php echo wp_kses_post($th_project_intro); ?>

                                        <?php if($th_tour_price > ""){
                                            if($th_tour_price_per > ""){
                                                $th_tour_price_per = '<span>'. $th_tour_price_per. '</span>';
                                            }
                                            echo '<div class="th-pricing-cost">', $th_tour_price,$th_tour_price_per,'</div>';
                                        }?>

                                        <?php if( ! $th_project_button_text === false || ! empty( $th_project_button_text ) ) { ?>
                                            <span <?php echo $this->get_render_attribute_string('thmv_link'); ?>><?php echo esc_html( $th_project_button_text ); ?></span>
                                        <?php } ?>
                                    </div>
                                    <?php echo '<a href="' . esc_url( $link_url ) . '" class="th-port-link" ' . esc_html( $link_target_markup ) . '></a>'; ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="alert">';
                    _e('Sorry, no results were found.', 'th-widget-pack');
                    echo '</div>';
                    get_search_form();
                }
                // Restore original Post Data
                wp_reset_postdata();
                ?>

            </div>

        </div>

        <?php
    }

    protected function content_template() {}
}

Plugin::instance()->widgets_manager->register( new Themo_Widget_Portfolio_Grid() );
