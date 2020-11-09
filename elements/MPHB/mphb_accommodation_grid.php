<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Grid extends Widget_Base {

    public function get_name() {
        return 'themo-accommodation-grid';
    }

    public function get_title() {
        return __( 'Accommodation Grid', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
            'post_type' => array('mphb_room_type'),
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

    private function get_tours_group_list() {
        $portfolio_group = array();

        $portfolio_group['none'] = __( 'None', 'th-widget-pack' );

        $taxonomy = 'mphb_room_type_category';

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
                'label' => __( 'Layout', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'filter',
            [
                'label' => __( 'Show Filters', 'th-widget-pack' ),
                'descrition' => __( 'Use Accommodation Category to filter your results.', 'th-widget-pack' ),
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
                'label'   => __( 'Select by Category', 'th-widget-pack' ),
                'type'    => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                //'default' => 'none',
                'options' => $this->get_tours_group_list()
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
                    'menu_order' => __( 'Drag and Drop', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __( 'Number of Columns to Show', 'th-widget-pack' ),
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




        $this->end_controls_section();

        $this->start_controls_section(
            'card_price_style',
            [
                'label' => __( 'Price & Image Overlay', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_2',
                ],
            ]
        );

        $this->add_control(
            'card_price_color',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-card-caption p' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_gradient',
                'label' => __( 'Image Gradient', 'th-widget-pack' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .th-port-style-2 .th-port-card .th-port-card-img:after',
                'description' => 'Control the image overlay gradient.',

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_style_background',
            [
                'label' => __( 'Title & Text', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_2',
                ],
            ]
        );

        /*$this->add_control(
            'card_price_background_color',
            [
                'label' => __( 'Price Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-card .th-port-card-img:after' => 'background-color: {{VALUE}};',
                ],

            ]
        );*/



        $this->add_control(
            'card_title_color',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#2C2C33',
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-title' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'card_text_color',
            [
                'label' => __( 'Text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} .th-port-style-2 .th-port-sub' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'card_background_color',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .th-port-card-default' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_background',
            [
                'label' => __( 'Grid', 'th-widget-pack' ),
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

            //error_log("RGBA: ".$default_rgba,0);
        }


        $this->add_control(
            'hover_color',
            [
                'label' => __( 'Hover Background Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
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
                    //'{{WRAPPER}} .th-portfolio-item .th-port-overlay' => 'background-color: {{VALUE_FROM_ANOHTER_CONTROL}};',
                ],
                //'label_block' => true,
            ]
        );

        $this->add_control(
            'hover_color_mobile',
            [
                'label' => __( 'Background Color for Mobile', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                /*'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],*/
                'default' => $default_rgba,
                'selectors' => [
                    '(mobile){{WRAPPER}} .th-portfolio-item .th-port-overlay' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_overlay_mobile' => 'yes',
                ],
                'separator' => 'none',
                //'label_block' => true,
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
                /*'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],*/
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
                    //'{{WRAPPER}} .th-portfolio-item:hover .th-port-overlay' => 'opacity: 0;',
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-top-text' => 'opacity: 0;',
                    '{{WRAPPER}} .th-portfolio-item:hover .th-port-center' => 'opacity: 0;',
                    //'(mobile){{WRAPPER}} .th-port-center' => 'opacity: 1;',
                    //'{{WRAPPER}} .th-portfolio-item .th-port-overlay' => 'background-color: {{VALUE_FROM_ANOHTER_CONTROL}};',
                ],
                //'separator' => 'before'

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
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_bar_link_color',
            [
                'label' => __( 'Link Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters a' => 'color: {{VALUE}};  opacity:0.8;',
                ],
            ]
        );

        $this->add_control(
            'filter_bar_hover_color',
            [
                'label' => __( 'Hover Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-portfolio-filters a:hover' => 'color: {{VALUE}}; opacity:1;',
                ],
            ]
        );

        $this->add_control(
            'filter_bar_active_color',
            [
                'label' => __( 'Active Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .th-portfolio-filters a.current' => 'color: {{VALUE}}; opacity:1; border-color: {{VALUE}};',
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

                    $taxonomy = 'mphb_room_type_category';



                    // Only show filter links for the groups selected.
                    $tax_args = array(
                        'taxonomy' => $taxonomy,
                        'include' => $settings['group'],
                        'hide_empty' => false,
                        'orderby' => 'slug',
                        'order' => 'ASC',
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
                $args['post_type'] = array( 'mphb_room_type' );
                if ( $settings['group'] ) {
                    if ( in_array( 'none', $settings['group'] ) ) {
                        $settings['group'] = array_diff( $settings['group'], array( 'none' ) );
                    }
                    if ( $settings['group'] ) {
                        $project_type_id = $settings['group'];
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'mphb_room_type_category',
                                'field'    => 'term_id',
                                'terms'    => $project_type_id,
                            ),
                        );
                    }
                }
                if ( $settings['order'] == 'date' ) {
                    $args['orderby'] = 'date';
                } elseif ( $settings['order'] == 'menu_order' ) {
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
                        $project_thumb_alt_img = get_post_meta( get_the_ID(), 'th_room_thumb', false );

                        $fallback_lightbox_image = false;

                        if ( isset( $project_thumb_alt_img[0] ) && $project_thumb_alt_img[0] > "" ) {
                            $alt = false;

                            // Check if Image comes in Med size with Square crop / else get small

                            $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "th_img_md_square");

                            if ($th_image) {

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
                            }
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
                        $terms = get_the_terms( get_the_ID(), 'mphb_room_type_category' );
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
                                        $th_image = wp_get_attachment_image_src($th_id, "th_img_md_square");

                                        if ($th_image){

                                            $width = $th_image[1];
                                            $height = $th_image[2];


                                            if ((605 == $width) && (605 == $height)){
                                                echo wp_kses_post(get_the_post_thumbnail( get_the_ID(), "th_img_md_square", $featured_img_attr ));
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

                                            }
                                        }
                                    }else{
                                        echo '<img width="605" height="605" src="https://via.placeholder.com/605x605?'.
                                            __('text=No+featured+image+found','th-widget-pack').
                                            '" class="img-responsive th-port-img wp-post-image" alt="">';
                                    }
                                }

                                $th_tour_title = get_the_title();
                                $th_tour_title_meta = get_post_meta( get_the_ID(), 'th_room_title', true );
                                if( $th_tour_title_meta > "" ) {
                                    $th_tour_title = $th_tour_title_meta;
                                }

                                $th_tour_highlight = false;
                                $th_tour_highlight = get_post_meta( get_the_ID(), 'th_room_highlight', true );

                                $th_tour_price = false;
                                $th_tour_price = get_post_meta( get_the_ID(), 'th_room_price', true );

                                $th_tour_price_per = false;
                                $th_tour_price_per = get_post_meta( get_the_ID(), 'th_room_price_per', true );

                                $th_tour_intro = false;
                                $th_tour_intro = get_post_meta( get_the_ID(), 'th_room_intro', true );
                                if( $th_tour_intro === false || empty( $th_tour_intro ) ) {
                                    $automatic_post_excerpts = 'on';
                                    if ( function_exists( 'get_theme_mod' ) ) {
                                        $automatic_post_excerpts = get_theme_mod( 'themo_automatic_post_excerpts', 'on' );
                                    }
                                    if( $automatic_post_excerpts === 'off' ) {
                                        $th_tour_intro = apply_filters( 'the_content', get_the_content() );
                                        $th_tour_intro = str_replace( ']]>', ']]&gt;', $th_tour_intro );
                                        if( $th_tour_intro != "" ) {
                                            $th_tour_intro = '<p class="th-port-sub">' . $th_tour_intro . '</p>';
                                        }
                                    } else {
                                        $th_tour_intro = apply_filters( 'the_excerpt', get_the_excerpt() );
                                        $th_tour_intro = str_replace( ']]>', ']]&gt;', $th_tour_intro );
                                        $th_tour_intro = str_replace( '<p', '<p class="th-port-sub th-auto-off"', $th_tour_intro );
                                    }
                                }else{
                                    $th_tour_intro = '<p class="th-port-sub th-else">' . $th_tour_intro . '</p>';
                                }

                                $th_tour_button_text = false;
                                $th_tour_button_text = get_post_meta( get_the_ID(), 'th_room_button_text', true );
                                ?>
                                <?php if($th_port_style_2){ ?>
                                    <?php if($th_tour_price > ""){
                                        echo '<div class="th-port-card-caption th-pricing-cost"><p>', $th_tour_price,$th_tour_price_per,'</p></div>';
                                    }?>
                                    </span>
                                    <span class="th-port-card-body">
                                      <h3 class="th-port-title"><?php echo esc_html( $th_tour_title ); ?></h3>
                                      <?php echo wp_kses_post($th_tour_intro); ?>
                                    </span>
                                    </a>
                                </div>

                                <?php }else { ?>
                                <div class="th-port-overlay"></div>
                                <div class="th-port-inner">
                                    <?php if( $th_tour_highlight ) { ?>
                                        <div class="th-port-top-text"><?php echo esc_html($th_tour_highlight); ?></div>
                                    <?php } ?>
                                    <div class="th-port-center">
                                        <h3 class="th-port-title"><?php echo esc_html( $th_tour_title ); ?></h3>
                                        <?php echo wp_kses_post($th_tour_intro); ?>

                                        <?php if($th_tour_price > ""){
                                            if($th_tour_price_per > ""){
                                                $th_tour_price_per = '<span>'. $th_tour_price_per. '</span>';
                                            }
                                            echo '<div class="th-pricing-cost">', $th_tour_price,$th_tour_price_per,'</div>';
                                        }?>

                                        <?php if( ! $th_tour_button_text === false || ! empty( $th_tour_button_text ) ) { ?>
                                            <span class="th-port-btn"><?php echo esc_html( $th_tour_button_text ); ?></span>
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

    protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Accommodation_Grid() );
