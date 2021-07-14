<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Listing extends Widget_Base {

    public function get_name() {
        return 'themo-accommodation-listing';
    }

    public function get_title() {
        return __( 'Accommodation Listing', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }

    private function get_list() {
        $portfolio = array();

        $loop = new \WP_Query( array(
            'post_type' => array('themo_room'),
            'posts_per_page' => -1,
            'post_status'=>array('publish'),
        ) );

        $portfolio['none'] = __('None', 'th-widget-pack');

        while ( $loop->have_posts() ) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $portfolio[$id] = $title;
        endwhile;
        
        wp_reset_postdata();

        return $portfolio;
    }

    private function get_group_list() {
        $portfolio_group = array();

        $portfolio_group['none'] = __( 'None', 'th-widget-pack' );

        $taxonomy = 'themo_room_type';

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
            'thmv_section_data',
            [
                'label' => __( 'Data', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'thmv_data_switcher',
            [
                'label' => __( 'Use data source', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'thmv_data_source',
            [
                'label' => __( 'Source', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'themo_room_type',
                'options' => [
                    'themo_room_type' => __( 'Rooms', 'th-widget-pack' ),
                    'mphb_room_type' => __( 'Accommodations', 'th-widget-pack' ),
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
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
                'options' => $this->get_list(),
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'group',
            [
                'label'   => __( 'Select by Group', 'th-widget-pack' ),
                'type'    => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_group_list(),
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
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
                'label' => __( 'Columns', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => __( '1', 'th-widget-pack' ),
                    '2' => __( '2', 'th-widget-pack' ),
                    '3' => __( '3', 'th-widget-pack' ),
                    '4' => __( '4', 'th-widget-pack' ),
                    '5' => __( '5', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'thmv_section_hide_data_heading',
            [
                'label' => __( 'Hide', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_highlight',
            [
                'label' => __( 'Highlight', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'thmv_hide_title',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_preface',
            [
                'label' => __( 'Preface', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_description',
            [
                'label' => __( 'Description', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_icons',
            [
                'label' => __( 'Icons', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_rating',
            [
                'label' => __( 'Rating', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_location',
            [
                'label' => __( 'Location', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_data_switcher' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thmv_section_image',
            [
                'label' => __( 'Image', 'th-widget-pack' ),
                'condition' => [
                    'thmv_data_switcher' => '',
                ],
            ]
        );

        $this->add_control(
            'thmv_image',
            [
                'label' => __( 'Image', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],

            ]
        );

        $this->add_control(
            'thmv_carousel_switcher',
            [
                'label' => __( 'Carousel', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'thmv_carousel',
            [
                'label' => __( 'Add Images', 'elementor' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'thmv_carousel_switcher' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thmv_section_content',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'condition' => [
                    'thmv_data_switcher' => '',
                ],
            ]
        );



        $this->add_control(
            'thmv_highlight',
            [
                'label' => __( 'Highlight', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Newly Renovated', 'th-widget-pack' ),
                'placeholder' => __( 'Newly Renovated', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4'],
                ],
            ]
        );

        $this->add_control(
            'thmv_title',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Studio Suite', 'th-widget-pack' ),
                'placeholder' => __( 'Studio Suite', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],

            ]
        );

        $this->add_control(
            'thmv_preface',
            [
                'label' => __( 'Preface', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '4 guests, 2 bedrooms, 1 bath', 'th-widget-pack' ),
                'placeholder' => __( '4 guests, 2 bedrooms, 1 bath', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4'],
                ],
            ]
        );

        $this->add_control(
            'thmv_description',
            [
                'label' => __( 'Description', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'The Studio Suite is warm and welcoming, with a large, gorgeous bathroom that includes a full-size whirlpool tub.',
                'dynamic' => [
                    'active' => true,
                ],
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

            ]
        );

        $repeater->add_control(
            'thmv_icon_label', [
                'label' => __( 'Label', 'th-widget-pack' ),
                'description' => 'May not show for all styles.',
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Wifi ',
                'default' => 'Wifi',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'thmv_icons',
            [
                'label' => __( 'Icons', 'th-widget-pack' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'thmv_icon' => [
                        'value' => 'fas fa-wifi',
                        'library' => 'fa-solid',
                    ],
                        'thmv_icon_label' => __( 'Wifi', 'th-widget-pack' ),
                    ],
                    [ 'thmv_icon' => [
                        'value' => 'fas fa-blender',
                        'library' => 'fa-solid',
                    ],
                        'thmv_icon_label' => __( 'Kitchen', 'th-widget-pack' ),
                    ],
                ],
                'title_field' => '<i class="{{ thmv_icon.value }}"></i> {{{ thmv_icon_label }}}',
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_2', 'style_3', 'style_6'],
                ],
            ]
        );

        $this->add_control(
            'thmv_rating_switcher',
            [
                'label' => __( 'Star Rating', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_5'],
                ],
            ]
        );


        $this->add_control(
            'thmv_rating',
            [
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'range' => [
                    'px' => [
                        'min' => .5,
                        'max' => 5,
                        'step' => .5,
                    ],
                ],
                'condition' => [
                    'thmv_rating_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5'],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'thmv_location_switcher',
            [
                'label' => __( 'Location', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'return_value' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_5'],
                ],
            ]
        );

        $this->add_control(
            'thmv_location_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
                'default' => [
                    'value' => 'fas fa-map-marker-alt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5'],
                ],
            ]
        );

        $this->add_control(
        'thmv_location_text',
    	[
            'label' => __( 'Text', 'th-widget-pack' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => "10 km away",
            'default' => "10 km away",
            'label_block' => true,
            'condition' => [
                'thmv_location_switcher' => 'yes',
                'thmv_style' => [ 'style_1', 'style_5'],
            ],
        ]
        );



        $this->add_control(
            'thmv_location_link',
            [
                'label' => __( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'elementor' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5'],
                ],

            ]
        );

        $this->add_control(
            'thmv_price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$299', 'th-widget-pack' ),
                'placeholder' => __( '$299', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'thmv_price_before',
            [
                'label' => __( 'Before Price', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Starting at', 'th-widget-pack' ),
                'placeholder' => __( 'Starting at', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'thmv_price_after',
            [
                'label' => __( 'After Price', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '/each', 'th-widget-pack' ),
                'placeholder' => __( '/each', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );




        $this->end_controls_section();

        $this->start_controls_section(
            'thmv_section_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'condition' => [
                    'thmv_data_switcher' => '',
                ],
            ]
        );

        $this->add_control(
            'thmv_link_text',
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Learn More', 'elementor' ),
                'placeholder' => __( 'Learn More', 'elementor' ),
            ]
        );

        $this->add_control(
            'thmv_link',
            [
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

		$this->end_controls_section();



        /* STYLE - Layout */
        $this->start_controls_section(
            'thmv_section_layout',
            [
                'label' => __( 'Layout', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thmv_style',
            [
                'label' => __( 'Choose style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => __( 'Style 1', 'th-widget-pack' ),
                    'style_2' => __( 'Style 2', 'th-widget-pack' ),
                    'style_3' => __( 'Style 3', 'th-widget-pack' ),
                    'style_4' => __( 'Style 4', 'th-widget-pack' ),
                    'style_5' => __( 'Style 5', 'th-widget-pack' ),
                    'style_6' => __( 'Style 6', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'thmv_wrapper_text_align',
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
                    '{{WRAPPER}} .thmv-wrapper-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /* STYLE - Imnage */
        $this->start_controls_section(
            'thmv_section_image_style',
            [
                'label' => __( 'Image', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thmv_post_image_size',
            [
                'label' => __( 'Image Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'th_img_sm_standard',
                'options' => [
                    'th_img_sm_standard' => __( 'Standard', 'th-widget-pack' ),
                    'th_img_sm_landscape' => __( 'Landscape', 'th-widget-pack' ),
                    'th_img_sm_portrait' => __( 'Portrait', 'th-widget-pack' ),
                    'th_img_sm_square' => __( 'Square', 'th-widget-pack' ),
                    'th_img_lg' => __( 'Large', 'th-widget-pack' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thmv_section_content_style',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        /* STYLE - Images - Carousel */

        /* STYLE - Icons */
        $this->add_control(
            'thmv_section_carousel_heading',
            [
                'label' => __( 'Carousel', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_carousel_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_carousel_icon_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_carousel_switcher' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'thmv_carousel_icon_size',
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
                    '{{WRAPPER}} .element i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'thmv_carousel_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thmv_carousel_background_color',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_carousel_switcher' => 'yes',
                ],
            ]
        );



        /* STYLE - Highlight */
        $this->add_control(
            'thmv_section_highlight_heading',
            [
                'label' => __( 'Highlight', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4']
                ],
            ]
        );

        $this->add_control(
            'thmv_highlight_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'thmv_highlight_typography',
                'selector' => '{{WRAPPER}} .element',
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4']
                ],
            ],
        );

        $this->add_control(
            'thmv_highlight_background_color',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4' ]
                ],
            ]
        );

        /* STYLE - Title */
        $this->add_control(
            'thmv_section_title_heading',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'thmv_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'thmv_title_typography',
                'selector' => '{{WRAPPER}} .element',
            ]
        );

        /* STYLE - Preface */
        $this->add_control(
            'thmv_section_preface_heading',
            [
                'label' => __( 'Preface', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4']
                ],
            ]
        );

        $this->add_control(
            'thmv_preface_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'thmv_preface_typography',
                'selector' => '{{WRAPPER}} .element',
                'condition' => [
                    'thmv_style' => [ 'style_2', 'style_3', 'style_4']
                ],
            ]
        );

        /* STYLE - Description */
        $this->add_control(
            'thmv_section_description_heading',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'thmv_description_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'thmv_description_typography',
                'selector' => '{{WRAPPER}} .element',
            ]
        );

        /* STYLE - Icons */
        $this->add_control(
            'thmv_section_icon_heading',
            [
                'label' => __( 'Icons', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_2', 'style_3', 'style_6']
                ],
            ]
        );

        $this->add_control(
            'thmv_icon_color',
            [
                'label' => __( 'Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_2', 'style_3', 'style_6']
                ],
            ]
        );

        $this->add_responsive_control(
            'thmv_icon_size',
            [
                'label' => __( 'Icon Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_2', 'style_3', 'style_6']
                ],
            ]
        );

        /*$this->add_control(
            'thmv_section_icon_label_heading',
            [
                'label' => __( 'Icon Label', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );*/

        $this->add_control(
            'thmv_icon_label_color',
            [
                'label' => __( 'Label Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_6']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Label Typography', 'elementor' ),
                'name' => 'thmv_icon_label_typography',
                'selector' => '{{WRAPPER}} .element',
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_6']
                ],
            ]
        );

        /* STYLE - Rating */
        $this->add_control(
            'thmv_section_rating_heading',
            [
                'label' => __( 'Rating', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_rating_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        $this->add_control(
            'thmv_rating_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_rating_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        $this->add_responsive_control(
            'thmv_rating_size',
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
                    '{{WRAPPER}} .element' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'thmv_rating_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        /* STYLE - Location */
        $this->add_control(
            'thmv_section_location_icon_heading',
            [
                'label' => __( 'Location', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        $this->add_control(
            'thmv_location_icon_color',
            [
                'label' => __( 'Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        $this->add_responsive_control(
            'thmv_location_icon_size',
            [
                'label' => __( 'Icon Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        $this->add_control(
            'thmv_icon_location_color',
            [
                'label' => __( 'Location Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Location Typography', 'elementor' ),
                'name' => 'thmv_location_typography',
                'selector' => '{{WRAPPER}} .element',
                'condition' => [
                    'thmv_location_switcher' => 'yes',
                    'thmv_style' => [ 'style_1', 'style_5']
                ],
            ]
        );

        /* STYLE - Price */
        $this->add_control(
            'thmv_section_price_heading',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'thmv_price_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'thmv_price_typography',
                'selector' => '{{WRAPPER}} h4',
            ]
        );

        $this->add_control(
            'thmv_before_price_text_color',
            [
                'label' => __( 'Before Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Before Typography', 'elementor' ),
                'name' => 'thmv_before_price_text_typography',
                'selector' => '{{WRAPPER}} span',
            ]
        );

        $this->add_control(
            'thmv_after_price_text_color',
            [
                'label' => __( 'After Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'After Typography', 'elementor' ),
                'name' => 'thmv_after_price_text_typography',
                'selector' => '{{WRAPPER}} span',
            ]
        );

        $this->add_control(
            'thmv_price_background_color',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_2', 'style_3', 'style_4' ]
                ],
            ]
        );

        /*$this->add_control(
            'thmv_price_text_background',
            [
                'label' => __( 'Background', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );



        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_gradient',
                'label' => __( 'Image Gradient', 'th-widget-pack' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .th-package.th-package-style-2 .th-pkg-img:after',
                'description' => 'Control the image overlay gradient.',
                'condition' => [
                    'style' => 'style_2',
                ],

            ]
        );

        $this->add_responsive_control(
            'price_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );*/

        $this->end_controls_section();

        $this->start_controls_section(
            'thmv_style_section_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thmv_link_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_hide_link' => '',
                    'thmv_style' => [ 'style_2', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'button_style',
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
                'condition' => [
                    'thmv_hide_link' => '',
                    'thmv_style' => [ 'style_1', 'style_4', 'style_5', 'style_6' ]
                ],
            ]
        );

        $this->end_controls_section();




    }

    protected function render() {
        $thmv_settings = $this->get_settings_for_display();


        switch( $thmv_settings['thmv_style'] ) {
            case "style_1":
                ?>

                <!--- Listing-style-1 start--->
                <h1>Listing-style-1</h1>
                <div class="thmv-lst-styl-1">
                    <div class="thmv-column">
                        <div class="thme-grid-style-1">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="emma-dau.png" alt="">
                                <div class="thmv-price">
                                    <h4>From</h4>
                                    <h4>19$</h4>
                                    <span>per person</span>
                                </div>
                            </div>
                            <div class="thme-grid-rating">
                                <ul class="thme-star-rating">
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li>5.0 (230)</li>
                                </ul>
                                <ul class="thme-grid-location">
                                    <li><svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 0.5C3.0975 0.5 0.75 2.8475 0.75 5.75C0.75 9.6875 6 15.5 6 15.5C6 15.5 11.25 9.6875 11.25 5.75C11.25 2.8475 8.9025 0.5 6 0.5ZM6 7.625C4.965 7.625 4.125 6.785 4.125 5.75C4.125 4.715 4.965 3.875 6 3.875C7.035 3.875 7.875 4.715 7.875 5.75C7.875 6.785 7.035 7.625 6 7.625Z" fill="#8C8D8C"/></svg>
                                    </li>
                                    <li>10 km from Tiny House</li>
                                </ul>
                            </div>
                            <div class="thme-info">
                                <h3>Pose For Portraits With A Photographer</h3>
                                <p>Nulla at mauris accumsan eros ullamcorper tincidunt at nec ipsum. In iaculis est ut sapien ultrices, vel feugiat nulla lobortis. Donec nec quam accumsan, lobortis.</p>
                                <a class="thmv-learn-btn" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="thmv-column">
                        <div class="thme-grid-style-1">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="emma-dau.png" alt="">
                                <div class="thmv-price">
                                    <h4>From</h4>
                                    <h4>19$</h4>
                                    <span>per person</span>
                                </div>
                            </div>
                            <div class="thme-grid-rating">
                                <ul class="thme-star-rating">
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
                                        </svg></li>
                                    <li>5.0 (230)</li>
                                </ul>
                                <ul class="thme-grid-location">
                                    <li><svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 0.5C3.0975 0.5 0.75 2.8475 0.75 5.75C0.75 9.6875 6 15.5 6 15.5C6 15.5 11.25 9.6875 11.25 5.75C11.25 2.8475 8.9025 0.5 6 0.5ZM6 7.625C4.965 7.625 4.125 6.785 4.125 5.75C4.125 4.715 4.965 3.875 6 3.875C7.035 3.875 7.875 4.715 7.875 5.75C7.875 6.785 7.035 7.625 6 7.625Z" fill="#8C8D8C"/></svg>
                                    </li>
                                    <li>10 km from Tiny House</li>
                                </ul>
                            </div>
                            <div class="thme-info">
                                <h3>Pose For Portraits With A Photographer</h3>
                                <ul class="thme-list">
                                    <li>
                                        <svg width="19" height="26" viewBox="0 0 19 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.4167 0.25H0.5V25.75H6.16667V17.25H10.4167C15.1058 17.25 18.9167 13.4392 18.9167 8.75C18.9167 4.06083 15.1058 0.25 10.4167 0.25ZM10.7 11.5833H6.16667V5.91667H10.7C12.2583 5.91667 13.5333 7.19167 13.5333 8.75C13.5333 10.3083 12.2583 11.5833 10.7 11.5833Z" fill="#404040"/></svg>
                                        <span>Free parking on premises</span>
                                    </li>
                                    <li>
                                        <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.47428 14.8984L12.4835 10.8892L2.53845 0.958395C0.328451 3.16839 0.328451 6.75256 2.53845 8.97673L8.47428 14.8984ZM18.0793 12.3342C20.2468 13.3401 23.2926 12.6317 25.5451 10.3792C28.2509 7.67339 28.7751 3.79173 26.6926 1.70923C24.6243 -0.359105 20.7426 0.150895 18.0226 2.85673C15.7701 5.10923 15.0618 8.15506 16.0676 10.3226L2.24095 24.1492L4.23845 26.1467L13.9993 16.4142L23.7459 26.1609L25.7435 24.1634L15.9968 14.4167L18.0793 12.3342Z" fill="#404040"/></svg>
                                        <span>Kitchen</span>
                                    </li>
                                    <li class="">
                                        <svg width="32" height="23" viewBox="0 0 32 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.416687 6.74991L3.25002 9.58325C10.2909 2.54241 21.7092 2.54241 28.75 9.58325L31.5834 6.74991C22.9842 -1.84925 9.03002 -1.84925 0.416687 6.74991ZM11.75 18.0832L16 22.3332L20.25 18.0832C17.9125 15.7316 14.1017 15.7316 11.75 18.0832ZM6.08335 12.4166L8.91669 15.2499C12.8267 11.3399 19.1734 11.3399 23.0834 15.2499L25.9167 12.4166C20.4484 6.94825 11.5659 6.94825 6.08335 12.4166Z" fill="#404040"/></svg>
                                        <span>Wifi</span>
                                    </li>
                                    <li class="">
                                        <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.1667 24.3333V15.8333H17.8333V24.3333H24.9167V13H29.1667L15 0.25L0.833344 13H5.08334V24.3333H12.1667Z" fill="#404040"/>
                                        </svg>
                                        <span>Hangers</span>
                                    </li>
                                </ul>
                                <a class="thmv-learn-btn" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Listing-style-1 end--->

                <?php

                break;
            case "style_2":
                ?>
                <!--- Listing-style-2 start--->
                <h1>Listing-style-2</h1>
                <div class="thmv-lst-styl-2">
                    <div class="thmv-column-2">
                        <div class="thme-grid-style-2">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="paul-postema.jpg" alt="">
                                <div class="thmv-top-box"><span>Top</span></div>
                                <div class="thmv-price"><h4>From 50$</h4></div>
                            </div>
                            <div class="thme-grid-sleep">
                                <h4>Sleeps 2, Queen Bed</h4>
                                <ul class="thme-grid-facility">
                                    <li>
                                        <svg width="22" height="15" viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.916504 4.25003L2.74984 6.08336C7.30567 1.52753 14.694 1.52753 19.2498 6.08336L21.0832 4.25003C15.519 -1.31414 6.48984 -1.31414 0.916504 4.25003ZM8.24984 11.5834L10.9998 14.3334L13.7498 11.5834C12.2373 10.0617 9.7715 10.0617 8.24984 11.5834ZM4.58317 7.9167L6.4165 9.75003C8.9465 7.22003 13.0532 7.22003 15.5832 9.75003L17.4165 7.9167C13.8782 4.37836 8.13067 4.37836 4.58317 7.9167Z" fill="#AEAEAE"/></svg>
                                    </li>
                                    <li>
                                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.221 9C8.93683 8.79833 8.68016 8.57833 8.46933 8.34L7.186 6.91917C7.01183 6.72667 6.79183 6.57083 6.5535 6.46083C6.28766 6.3325 5.98516 6.25 5.6735 6.25H5.646C4.50933 6.25 3.5835 7.17583 3.5835 8.3125V9H0.833496V16.3333C0.833496 17.3417 1.6585 18.1667 2.66683 18.1667H17.3335C18.3418 18.1667 19.1668 17.3417 19.1668 16.3333V9H9.221ZM5.41683 16.3333H3.5835V10.8333H5.41683V16.3333ZM9.0835 16.3333H7.25016V10.8333H9.0835V16.3333ZM12.7502 16.3333H10.9168V10.8333H12.7502V16.3333ZM16.4168 16.3333H14.5835V10.8333H16.4168V16.3333ZM16.096 3.37167L16.0318 3.3075C15.5093 2.73917 15.2802 2.015 15.4177 1.29083L15.5002 0.75H13.7677L13.7127 1.14417C13.5293 2.39083 13.9602 3.62833 14.9043 4.55417L14.9685 4.60917C15.491 5.1775 15.7202 5.90167 15.5827 6.62583L15.4818 7.16667H17.2327L17.2877 6.7725C17.4802 5.52583 17.0402 4.28833 16.096 3.37167ZM12.4293 3.37167L12.3652 3.3075C11.8427 2.73917 11.6135 2.015 11.751 1.29083L11.8335 0.75H10.101L10.046 1.14417C9.86266 2.39083 10.2935 3.62833 11.2377 4.55417L11.3018 4.60917C11.8243 5.1775 12.0535 5.90167 11.916 6.62583L11.8152 7.16667H13.566L13.621 6.7725C13.8135 5.52583 13.3735 4.28833 12.4293 3.37167Z" fill="#AEAEAE"/>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.3332 0.75H0.666504V9.91667C0.666504 11.9425 2.30734 13.5833 4.33317 13.5833H9.83317C11.859 13.5833 13.4998 11.9425 13.4998 9.91667V7.16667H15.3332C16.3507 7.16667 17.1665 6.34167 17.1665 5.33333V2.58333C17.1665 1.56583 16.3507 0.75 15.3332 0.75ZM15.3332 5.33333H13.4998V2.58333H15.3332V5.33333ZM0.666504 15.4167H15.3332V17.25H0.666504V15.4167Z" fill="#AEAEAE"/></svg>
                                    </li>
                                    <li>
                                        <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 0.916504L0.75 4.58317V10.0832C0.75 15.1707 4.27 19.9282 9 21.0832C13.73 19.9282 17.25 15.1707 17.25 10.0832V4.58317L9 0.916504ZM9 10.9907H15.4167C14.9308 14.7673 12.41 18.1315 9 19.1857V10.9998H2.58333V5.77484L9 2.924V10.9907Z" fill="#AEAEAE"/>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.94828 1.73984L4.63744 0.429004C2.43745 2.1065 0.989112 4.6915 0.860779 7.62484H2.69411C2.83161 5.19567 4.07828 3.069 5.94828 1.73984ZM17.3058 7.62484H19.1391C19.0016 4.6915 17.5533 2.1065 15.3624 0.429004L14.0608 1.73984C15.9124 3.069 17.1683 5.19567 17.3058 7.62484ZM15.4999 8.08317C15.4999 5.269 13.9966 2.91317 11.3749 2.28984V1.6665C11.3749 0.905671 10.7608 0.291504 9.99994 0.291504C9.23911 0.291504 8.62494 0.905671 8.62494 1.6665V2.28984C5.99411 2.91317 4.49995 5.25984 4.49995 8.08317V12.6665L2.66661 14.4998V15.4165H17.3333V14.4998L15.4999 12.6665V8.08317ZM9.99994 18.1665C10.1283 18.1665 10.2474 18.1573 10.3666 18.1298C10.9624 18.0015 11.4483 17.5982 11.6866 17.0482C11.7783 16.8282 11.8241 16.5898 11.8241 16.3332H8.15744C8.16661 17.3415 8.98244 18.1665 9.99994 18.1665Z" fill="#AEAEAE"/>
                                        </svg>
                                    </li>
                                </ul>
                            </div>
                            <div class="thme-info">
                                <h3>SIGNATURE SUITE</h3>
                                <p>One word of caution: make sure your client knows that lorem ipsum is filler text. You don't want them wondering why you filled their website with a foreign language.</p>
                                <a class="thmv-btn-styl-2" href="#">
                                    <span>Learn More</span> <svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.356 4.618H0.918V3.61H4.356V0.0639992H6.354V3.61H9.792V4.618H6.354V8.146H4.356V4.618Z" fill="#1C1715"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Listing-style-2 end--->
                <?php
                break;
            case "style_3":
                ?>
                <!--- Listing-style-3 start--->
                <h1>Listing-style-3</h1>
                <div class="thmv-lst-styl-3">
                    <div class="thmv-column-3">
                        <div class="thme-grid-style-3">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="thmv-3.jpg" alt="">
                                <div class="thmv-price"><h4>From 50$</h4></div>
                            </div>
                            <div class="thme-info">
                                <div class="thmv-top-box"><span>Top</span></div>
                                <h3>SIGNATURE SUITE</h3>
                                <h4>Sleeps 2, Queen Bed</h4>
                                <p>One word of caution: make sure your client knows that lorem ipsum is filler text. You don't want them wondering why you filled their website with a foreign language.</p>
                                <a class="thmv-btn-styl-3" href="#">
                                    <span>Learn More</span> <svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.356 4.618H0.918V3.61H4.356V0.0639992H6.354V3.61H9.792V4.618H6.354V8.146H4.356V4.618Z" fill="#1C1715"/></svg>
                                </a>
                                <div class="thme-grid-sleep">
                                    <ul class="thme-grid-facility">
                                        <li>
                                            <svg width="22" height="15" viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.916504 4.25003L2.74984 6.08336C7.30567 1.52753 14.694 1.52753 19.2498 6.08336L21.0832 4.25003C15.519 -1.31414 6.48984 -1.31414 0.916504 4.25003ZM8.24984 11.5834L10.9998 14.3334L13.7498 11.5834C12.2373 10.0617 9.7715 10.0617 8.24984 11.5834ZM4.58317 7.9167L6.4165 9.75003C8.9465 7.22003 13.0532 7.22003 15.5832 9.75003L17.4165 7.9167C13.8782 4.37836 8.13067 4.37836 4.58317 7.9167Z" fill="#AEAEAE"/></svg>
                                        </li>
                                        <li>
                                            <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.221 9C8.93683 8.79833 8.68016 8.57833 8.46933 8.34L7.186 6.91917C7.01183 6.72667 6.79183 6.57083 6.5535 6.46083C6.28766 6.3325 5.98516 6.25 5.6735 6.25H5.646C4.50933 6.25 3.5835 7.17583 3.5835 8.3125V9H0.833496V16.3333C0.833496 17.3417 1.6585 18.1667 2.66683 18.1667H17.3335C18.3418 18.1667 19.1668 17.3417 19.1668 16.3333V9H9.221ZM5.41683 16.3333H3.5835V10.8333H5.41683V16.3333ZM9.0835 16.3333H7.25016V10.8333H9.0835V16.3333ZM12.7502 16.3333H10.9168V10.8333H12.7502V16.3333ZM16.4168 16.3333H14.5835V10.8333H16.4168V16.3333ZM16.096 3.37167L16.0318 3.3075C15.5093 2.73917 15.2802 2.015 15.4177 1.29083L15.5002 0.75H13.7677L13.7127 1.14417C13.5293 2.39083 13.9602 3.62833 14.9043 4.55417L14.9685 4.60917C15.491 5.1775 15.7202 5.90167 15.5827 6.62583L15.4818 7.16667H17.2327L17.2877 6.7725C17.4802 5.52583 17.0402 4.28833 16.096 3.37167ZM12.4293 3.37167L12.3652 3.3075C11.8427 2.73917 11.6135 2.015 11.751 1.29083L11.8335 0.75H10.101L10.046 1.14417C9.86266 2.39083 10.2935 3.62833 11.2377 4.55417L11.3018 4.60917C11.8243 5.1775 12.0535 5.90167 11.916 6.62583L11.8152 7.16667H13.566L13.621 6.7725C13.8135 5.52583 13.3735 4.28833 12.4293 3.37167Z" fill="#AEAEAE"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.3332 0.75H0.666504V9.91667C0.666504 11.9425 2.30734 13.5833 4.33317 13.5833H9.83317C11.859 13.5833 13.4998 11.9425 13.4998 9.91667V7.16667H15.3332C16.3507 7.16667 17.1665 6.34167 17.1665 5.33333V2.58333C17.1665 1.56583 16.3507 0.75 15.3332 0.75ZM15.3332 5.33333H13.4998V2.58333H15.3332V5.33333ZM0.666504 15.4167H15.3332V17.25H0.666504V15.4167Z" fill="#AEAEAE"/></svg>
                                        </li>
                                        <li>
                                            <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0.916504L0.75 4.58317V10.0832C0.75 15.1707 4.27 19.9282 9 21.0832C13.73 19.9282 17.25 15.1707 17.25 10.0832V4.58317L9 0.916504ZM9 10.9907H15.4167C14.9308 14.7673 12.41 18.1315 9 19.1857V10.9998H2.58333V5.77484L9 2.924V10.9907Z" fill="#AEAEAE"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.94828 1.73984L4.63744 0.429004C2.43745 2.1065 0.989112 4.6915 0.860779 7.62484H2.69411C2.83161 5.19567 4.07828 3.069 5.94828 1.73984ZM17.3058 7.62484H19.1391C19.0016 4.6915 17.5533 2.1065 15.3624 0.429004L14.0608 1.73984C15.9124 3.069 17.1683 5.19567 17.3058 7.62484ZM15.4999 8.08317C15.4999 5.269 13.9966 2.91317 11.3749 2.28984V1.6665C11.3749 0.905671 10.7608 0.291504 9.99994 0.291504C9.23911 0.291504 8.62494 0.905671 8.62494 1.6665V2.28984C5.99411 2.91317 4.49995 5.25984 4.49995 8.08317V12.6665L2.66661 14.4998V15.4165H17.3333V14.4998L15.4999 12.6665V8.08317ZM9.99994 18.1665C10.1283 18.1665 10.2474 18.1573 10.3666 18.1298C10.9624 18.0015 11.4483 17.5982 11.6866 17.0482C11.7783 16.8282 11.8241 16.5898 11.8241 16.3332H8.15744C8.16661 17.3415 8.98244 18.1665 9.99994 18.1665Z" fill="#AEAEAE"/>
                                            </svg>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Listing-style-3 end--->
                <?php
                break;
            case "style_4":
                ?>
                <!--- Listing-style-4 start--->
                <h1>Listing-style-4</h1>
                <div class="thmv-lst-styl-4">
                    <div class="thmv-column-3">
                        <div class="thme-grid-style-4">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="paul-postema-square.png" alt="">
                                <div class="thmv-top-box thmv-top-box-left">50%</div>
                                <div class="thmv-price"><h4>From 50$</h4></div>
                            </div>
                            <div class="thme-info">
                                <h3>SIGNATURE SUITE</h3>
                                <span class="thmv-subheading">Sleeps 2, Queen Bed</span>
                                <p>Lorem ipsum, or lipsum as it is sometimes known, is text used in laying out print, graphic or web designs.</p>
                                <a class="thmv-learn-btn thmv-w-100" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="thmv-column-3">
                        <div class="thme-grid-style-4">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="minh-pham.png" alt="">
                            </div>
                            <div class="thme-info">
                                <h3>SIGNATURE SUITE</h3>
                                <span class="thmv-subheading">Sleeps 2, Queen Bed</span>
                                <p>Lorem ipsum, or lipsum as it is sometimes known, is text used in laying out print, graphic or web designs.</p>
                                <a class="thmv-learn-btn thmv-w-100" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="thmv-column-3">
                        <div class="thme-grid-style-4">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="paul-postema-V.png" alt="">
                                <div class="thmv-top-box thmv-top-box-right">50%</div>
                                <div class="thmv-price thmv-price-left"><h4>From 50$</h4></div>
                            </div>
                            <div class="thme-info">
                                <h3>SIGNATURE SUITE</h3>
                                <span class="thmv-subheading">Sleeps 2, Queen Bed</span>
                                <p>Lorem ipsum, or lipsum as it is sometimes known, is text used in laying out print, graphic or web designs.</p>
                                <a class="thmv-learn-btn" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Listing-style-4 end--->
                <?php
                break;
            case "style_5":
                ?>
                <!--- Listing-style-5 start--->
                <h1>Listing-style-5</h1>
                <div class="thmv-lst-styl-5">
                    <div class="thmv-column">
                        <div class="thme-grid-style-5">
                            <div class="thme-grid-img">
                                <img class="img-fluid" src="jakob-owens.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="thmv-column">
                        <div class="thme-grid-style-5 right-col">
                            <div class="thme-rating">
					<span>
						<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.1649 1.16338C10.4642 0.242069 11.7676 0.242069 12.067 1.16338L13.8692 6.71012C14.0031 7.12214 14.3871 7.4011 14.8203 7.4011H20.6525C21.6212 7.4011 22.024 8.64072 21.2402 9.21012L16.5219 12.6382C16.1714 12.8928 16.0248 13.3442 16.1586 13.7562L17.9609 19.303C18.2602 20.2243 17.2058 20.9904 16.422 20.421L11.7037 16.9929C11.3532 16.7383 10.8786 16.7383 10.5281 16.9929L5.8098 20.421C5.02609 20.9904 3.97161 20.2243 4.27096 19.303L6.0732 13.7562C6.20708 13.3442 6.06042 12.8928 5.70993 12.6382L0.991594 9.21012C0.20788 8.64072 0.610655 7.4011 1.57938 7.4011H7.41156C7.84479 7.4011 8.22875 7.12214 8.36262 6.71012L10.1649 1.16338Z" fill="#FFC804"/>
						</svg>
						<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.1649 1.16338C10.4642 0.242069 11.7676 0.242069 12.067 1.16338L13.8692 6.71012C14.0031 7.12214 14.3871 7.4011 14.8203 7.4011H20.6525C21.6212 7.4011 22.024 8.64072 21.2402 9.21012L16.5219 12.6382C16.1714 12.8928 16.0248 13.3442 16.1586 13.7562L17.9609 19.303C18.2602 20.2243 17.2058 20.9904 16.422 20.421L11.7037 16.9929C11.3532 16.7383 10.8786 16.7383 10.5281 16.9929L5.8098 20.421C5.02609 20.9904 3.97161 20.2243 4.27096 19.303L6.0732 13.7562C6.20708 13.3442 6.06042 12.8928 5.70993 12.6382L0.991594 9.21012C0.20788 8.64072 0.610655 7.4011 1.57938 7.4011H7.41156C7.84479 7.4011 8.22875 7.12214 8.36262 6.71012L10.1649 1.16338Z" fill="#FFC804"/>
						</svg>
						<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.1649 1.16338C10.4642 0.242069 11.7676 0.242069 12.067 1.16338L13.8692 6.71012C14.0031 7.12214 14.3871 7.4011 14.8203 7.4011H20.6525C21.6212 7.4011 22.024 8.64072 21.2402 9.21012L16.5219 12.6382C16.1714 12.8928 16.0248 13.3442 16.1586 13.7562L17.9609 19.303C18.2602 20.2243 17.2058 20.9904 16.422 20.421L11.7037 16.9929C11.3532 16.7383 10.8786 16.7383 10.5281 16.9929L5.8098 20.421C5.02609 20.9904 3.97161 20.2243 4.27096 19.303L6.0732 13.7562C6.20708 13.3442 6.06042 12.8928 5.70993 12.6382L0.991594 9.21012C0.20788 8.64072 0.610655 7.4011 1.57938 7.4011H7.41156C7.84479 7.4011 8.22875 7.12214 8.36262 6.71012L10.1649 1.16338Z" fill="#FFC804"/>
						</svg>
						<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.1649 1.16338C10.4642 0.242069 11.7676 0.242069 12.067 1.16338L13.8692 6.71012C14.0031 7.12214 14.3871 7.4011 14.8203 7.4011H20.6525C21.6212 7.4011 22.024 8.64072 21.2402 9.21012L16.5219 12.6382C16.1714 12.8928 16.0248 13.3442 16.1586 13.7562L17.9609 19.303C18.2602 20.2243 17.2058 20.9904 16.422 20.421L11.7037 16.9929C11.3532 16.7383 10.8786 16.7383 10.5281 16.9929L5.8098 20.421C5.02609 20.9904 3.97161 20.2243 4.27096 19.303L6.0732 13.7562C6.20708 13.3442 6.06042 12.8928 5.70993 12.6382L0.991594 9.21012C0.20788 8.64072 0.610655 7.4011 1.57938 7.4011H7.41156C7.84479 7.4011 8.22875 7.12214 8.36262 6.71012L10.1649 1.16338Z" fill="#FFC804"/>
						</svg>
						<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.1649 1.16338C10.4642 0.242069 11.7676 0.242069 12.067 1.16338L13.8692 6.71012C14.0031 7.12214 14.3871 7.4011 14.8203 7.4011H20.6525C21.6212 7.4011 22.024 8.64072 21.2402 9.21012L16.5219 12.6382C16.1714 12.8928 16.0248 13.3442 16.1586 13.7562L17.9609 19.303C18.2602 20.2243 17.2058 20.9904 16.422 20.421L11.7037 16.9929C11.3532 16.7383 10.8786 16.7383 10.5281 16.9929L5.8098 20.421C5.02609 20.9904 3.97161 20.2243 4.27096 19.303L6.0732 13.7562C6.20708 13.3442 6.06042 12.8928 5.70993 12.6382L0.991594 9.21012C0.20788 8.64072 0.610655 7.4011 1.57938 7.4011H7.41156C7.84479 7.4011 8.22875 7.12214 8.36262 6.71012L10.1649 1.16338Z" fill="#FFC804"/>
						</svg>
					</span>
                                <span>5.0 (230)</span>
                            </div>
                            <div class="thme-location">
                                <svg width="15" height="21" viewBox="0 0 15 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.49998 0.0833359C3.46873 0.0833359 0.208313 3.34375 0.208313 7.375C0.208313 12.8438 7.49998 20.9167 7.49998 20.9167C7.49998 20.9167 14.7916 12.8438 14.7916 7.375C14.7916 3.34375 11.5312 0.0833359 7.49998 0.0833359ZM7.49998 9.97917C6.06248 9.97917 4.89581 8.8125 4.89581 7.375C4.89581 5.9375 6.06248 4.77084 7.49998 4.77084C8.93748 4.77084 10.1041 5.9375 10.1041 7.375C10.1041 8.8125 8.93748 9.97917 7.49998 9.97917Z" fill="#191B18"/></svg>
                                10 km from Tiny House
                            </div>
                            <div class="thme-info">
                                <h3>Pose For Portraits With A Photographer</h3>
                                <!-- <span class="thmv-subheading">Sleeps 2, Queen Bed</span> -->
                                <p>One brave soul did take a stab at translating the almost-Latin. According to The Guardian, Jaspreet Singh Boparai undertook the challenge with the goal of making the text “precisely as incoherent in English as it is in Latin - and to make it incoherent.</p>
                                <p class="thmv-pricegtxt">From 19$ per person</p>
                                <a class="thmv-learn-btn thmv-w-100" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Listing-style-5 end--->
                <?php
                break;
            case "style_6":
                ?>
                <!--- Listing-style-6 start--->
                <h1>Listing-style-6</h1>
                <div class="thmv-lst-styl-6">
                    <div class="thmv-column-1">
                        <div class="thme-grid-style-5">
                            <!-- <div class="thme-grid-img">
                                <img class="img-fluid" src="room-comfrtable.png" alt="">
                            </div> -->
                            <div class="thme-imglider infinity" id="slider1">
                                <input type="radio" name="slides" checked="checked" id="slides_1" />
                                <input type="radio" name="slides" id="slides_2" />
                                <input type="radio" name="slides" id="slides_3" />
                                <input type="radio" name="slides" id="slides_4" />
                                <ul>
                                    <li><img src="room-comfrtable.png" /></li>
                                    <li><img src="room-comfrtable2.jpg" /></li>
                                    <li><img src="room-comfrtable.png" /></li>
                                    <li><img src="room-comfrtable2.jpg" /></li>
                                </ul>
                                <div class="arrows">
                                    <label for="slides_1"></label>
                                    <label for="slides_2"></label>
                                    <label for="slides_3"></label>
                                    <label for="slides_4"></label>
                                    <label class="goto-first" for="slides_1"></label>
                                    <label class="goto-last" for="slides_4"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="thmv-column-2">
                        <div class="thme-grid-style-5 right-col">
                            <div class="thme-info">
                                <h3>room #1 - comfrtable</h3>
                                <hr class="thmv-separator">
                                <p>The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the days before computerized design</p>
                                <ul class="thme-grid-facility">
                                    <li>
                                        <svg width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 22L17.3333 16.1333C16.1296 15.2167 14.625 14.6667 13 14.6667C11.375 14.6667 9.87037 15.2167 8.66667 16.1333L13 22ZM13 0C8.125 0 3.62315 1.63778 0 4.4L2.16667 7.33333C5.17593 5.03556 8.93148 3.66667 13 3.66667C17.0685 3.66667 20.8241 5.03556 23.8333 7.33333L26 4.4C22.3769 1.63778 17.875 0 13 0ZM13 7.33333C9.75 7.33333 6.75278 8.42111 4.33333 10.2667L6.5 13.2C8.30556 11.8189 10.5565 11 13 11C15.4435 11 17.6944 11.8189 19.5 13.2L21.6667 10.2667C19.2472 8.42111 16.25 7.33333 13 7.33333Z" fill="black"/>
                                        </svg>
                                        <span>wifi</span>
                                    </li>
                                    <li>
                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.18182 0H21.8182C22.3968 0 22.9518 0.231785 23.361 0.644365C23.7701 1.05694 24 1.61652 24 2.2V19.8C24 20.3835 23.7701 20.9431 23.361 21.3556C22.9518 21.7682 22.3968 22 21.8182 22H2.18182C1.60316 22 1.04821 21.7682 0.63904 21.3556C0.22987 20.9431 0 20.3835 0 19.8V2.2C0 1.61652 0.22987 1.05694 0.63904 0.644365C1.04821 0.231785 1.60316 0 2.18182 0ZM13.0909 2.2V19.8H21.8182V2.2H13.0909ZM2.18182 2.2V19.8H10.9091V2.2H2.18182ZM4.36364 12.1H6.54545V16.5H4.36364V12.1ZM4.36364 4.4H8.72727V6.05H4.36364V4.4ZM4.36364 7.7H8.72727V9.35H4.36364V7.7ZM15.2727 12.1H17.4545V16.5H15.2727V12.1ZM15.2727 4.4H19.6364V6.05H15.2727V4.4ZM15.2727 7.7H19.6364V9.35H15.2727V7.7Z" fill="black"/>
                                        </svg>
                                        <span>lockers</span>
                                    </li>
                                    <li>
                                        <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.44637 12.3668L1.40714 7.30179C-0.469046 5.39938 -0.469046 2.33372 1.40714 0.44343L9.84996 8.9255L6.44637 12.3668ZM14.6006 10.1736L12.8326 11.9548L21.1071 20.2915L19.4113 22L11.1368 13.6633L2.86238 22L1.1666 20.2915L12.9048 8.46504C12.0509 6.6111 12.6522 4.0059 14.5645 2.07926C16.8616 -0.247253 20.1569 -0.683473 21.9129 1.08564C23.6808 2.86688 23.2478 6.187 20.9387 8.50139C19.0264 10.428 16.4407 11.0339 14.6006 10.1736Z" fill="black"/>
                                        </svg>
                                        <span>menu</span>
                                    </li>
                                    <li>
                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.4 6.11111V3.66667C20.4 1.65 18.78 0 16.8 0H7.2C5.22 0 3.6 1.65 3.6 3.66667V6.11111C1.62 6.11111 0 7.76111 0 9.77778V15.8889C0 17.9056 1.62 19.5556 3.6 19.5556V22H6V19.5556H18V22H20.4V19.5556C22.38 19.5556 24 17.9056 24 15.8889V9.77778C24 7.76111 22.38 6.11111 20.4 6.11111ZM6 3.66667C6 2.99444 6.54 2.44444 7.2 2.44444H16.8C17.46 2.44444 18 2.99444 18 3.66667V7.06444C17.268 7.73667 16.8 8.70222 16.8 9.77778V12.2222H7.2V9.77778C7.2 8.70222 6.732 7.73667 6 7.06444V3.66667ZM21.6 15.8889C21.6 16.5611 21.06 17.1111 20.4 17.1111H3.6C2.94 17.1111 2.4 16.5611 2.4 15.8889V9.77778C2.4 9.10556 2.94 8.55556 3.6 8.55556C4.26 8.55556 4.8 9.10556 4.8 9.77778V14.6667H19.2V9.77778C19.2 9.10556 19.74 8.55556 20.4 8.55556C21.06 8.55556 21.6 9.10556 21.6 9.77778V15.8889Z" fill="black"/>
                                        </svg>
                                        </svg>
                                        <span>sofa</span>
                                    </li>
                                </ul>
                                <div class="thme-grid-booking">
                                    <a class="thmv-learn-btn thmv-w-100" href="#">check availability</a>
                                    <p class="thmv-learn-btn thmv-offer-text thmv-w-100" href="#">from $10/per bed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Listing-style-6 end--->
                <?php
                break;
            default:

        }

        ?>



        <?php
    }

    protected function _content_template() {}

    /*
     * <article class="th-package">
            <# if ( settings.url && settings.url.url ) { #>
                <a class="th-pkg-click"  href="{{ settings.url.url }}"></a>
            <# } #>
            <div class="th-pkg-info">
                <# if ( '' !== settings.price ) { #>
                    <h4>{{{ settings.price }}}</h4>
                <# } #>
                <# if ( '' !== settings.price_text ) { #>
                    <span>{{{ settings.price_text }}}</span>
                <# } #>
            </div>
            <# if ( '' !== settings.image.url ) {
                    var image = {
                    id: settings.image.id,
                    url: settings.image.url,
                    size: settings.image_size,
                    dimension: settings.image_custom_dimension,
                    model: editModel
                    };

                    var image_url = elementor.imagesManager.getImageUrl( image );

                    if ( ! image_url ) {
                    return;
                    }
                #>
                <div class="th-pkg-img">
                    <img src="{{{ image_url }}}" />
                </div>
            <# } #>
            <div class="th-pkg-content">
                <# if ( '' !== settings.pre_title ) { #>
                    <div class="th-package-pre-title">{{{ settings.pre_title }}}</div>
                <# } #>
                <# if ( '' !== settings.title ) { #>
                    <h3>{{{ settings.title }}}</h3>
                <# } #>
                <# if ( '' !== settings.content ) { #>
                    <div class="th-package-content">
                        {{{ settings.content }}}
                    </div>
                <# } #>
            </div>
        </article>
     * */

    public function add_wpml_support() {
        add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
    }

    public function wpml_widgets_to_translate_filter( $widgets ) {
        $widgets[ $this->get_name() ] = [
            'conditions' => [ 'widgetType' => $this->get_name() ],
            'fields'     => [

                [
                    'field'       => 'pre_title',
                    'type'        => __( 'Pre Title', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                [
                    'field'       => 'title',
                    'type'        => __( 'Title', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                [
                    'field'       => 'content',
                    'type'        => __( 'Content', 'th-widget-pack' ),
                    'editor_type' => 'AREA'
                ],
                [
                    'field'       => 'thmv_price',
                    'type'        => __( 'thmv_price', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                [
                    'field'       => 'price_text',
                    'type'        => __( 'Price Text', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                'url' => [
                    'field'        => 'url',
                    'field_id'    => 'url', // New key
                    'type'        => __('Link URL', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
            ],
        ];
        return $widgets;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Accommodation_Listing() );
