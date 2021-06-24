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
                'condition' => [
                    'thmv_style' => [ 'style_1', 'style_4', 'style_5', 'style_6' ]
                ],
            ]
        );

        $this->add_control(
            'thmv_link_background_color',
            [
                'label' => __( 'Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();




    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Link
        if ( ! empty( $settings['url']['url'] ) ) {
            $this->add_render_attribute( 'link', 'href', esc_url( $settings['url']['url'] ) );

            if ( ! empty( $settings['url']['is_external'] ) ) {
                $this->add_render_attribute( 'link', 'target', '_blank' );
            }
        }
        $this->add_render_attribute( 'front-icon-wrapper','class','icon-wrapper' );
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
