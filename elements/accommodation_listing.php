<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Listing extends Widget_Base {

    var $totalIcons = 12;

    public function get_name() {
        return 'themo-accommodation-listing';
    }

    public function get_title() {
        return __('Accommodation Listing', 'th-widget-pack');
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return ['themo-elements'];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }

    private function get_list() {
        $portfolio = array();

        $loop = new \WP_Query(array(
            'post_type' => array('themo_room'),
            'posts_per_page' => -1,
            'post_status' => array('publish'),
        ));

        $portfolio['none'] = __('None', 'th-widget-pack');

        while ($loop->have_posts()) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $portfolio[$id] = $title;
        endwhile;

        wp_reset_postdata();

        return $portfolio;
    }

    private function get_group_list() {
        $portfolio_group = array();

        $portfolio_group['none'] = __('None', 'th-widget-pack');

        $taxonomy = 'themo_room_type';

        $tax_terms = get_terms($taxonomy);

        if (!empty($tax_terms) && !is_wp_error($tax_terms)) {
            foreach ($tax_terms as $item) {
                $portfolio_group[$item->term_id] = $item->name;
            }
        }

        return $portfolio_group;
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'thmv_section_data',
                [
                    'label' => __('Data', 'th-widget-pack'),
                ]
        );

        $this->add_control(
                'thmv_data_switcher',
                [
                    'label' => __('Use data source', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'thmv_data_source',
                [
                    'label' => __('Source', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'themo_room_type',
                    'options' => [
                        'themo_room_type' => __('Rooms', 'th-widget-pack'),
                        'mphb_room_type' => __('Accommodations', 'th-widget-pack'),
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'individual',
                [
                    'label' => __('Select Individually', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => $this->get_list(),
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'group',
                [
                    'label' => __('Select by Group', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => $this->get_group_list(),
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'order',
                [
                    'label' => __('Order by', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'menu_order',
                    'options' => [
                        'date' => __('Date Published', 'th-widget-pack'),
                        'menu_order' => __('Drag and Drop', 'th-widget-pack'),
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'columns',
                [
                    'label' => __('Columns', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => __('1', 'th-widget-pack'),
                        '2' => __('2', 'th-widget-pack'),
                        '3' => __('3', 'th-widget-pack'),
                        '4' => __('4', 'th-widget-pack'),
                        '5' => __('5', 'th-widget-pack'),
                    ],
                ]
        );

        $this->add_control(
                'thmv_section_hide_data_heading',
                [
                    'label' => __('Hide', 'elementor'),
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
                    'label' => __('Highlight', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Title', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Preface', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Description', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thme-info p' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'thmv_hide_icons',
                [
                    'label' => __('Icons', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Rating', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Location', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Price', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
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
                    'label' => __('Link', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .element ' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        /** listing repeater * */
        $this->start_controls_section(
                'thmv_section_listing',
                [
                    'label' => __('Listings', 'th-widget-pack'),
                    'condition' => [
                        'thmv_data_switcher' => '',
                    ],
                ]
        );
        $listing = new Repeater();
        $listing->add_control(
                'thmv_style',
                [
                    'label' => __('Choose style', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style_1',
                    'options' => [
                        'style_1' => __('Style 1', 'th-widget-pack'),
                        'style_2' => __('Style 2', 'th-widget-pack'),
                        'style_3' => __('Style 3', 'th-widget-pack'),
                        'style_4' => __('Style 4', 'th-widget-pack'),
                        'style_5' => __('Style 5', 'th-widget-pack'),
                        'style_6' => __('Style 6', 'th-widget-pack'),
                    ],
                ]
        );
        /** tabs begin * */
        $listing->start_controls_tabs('listing');
        /** tab image begin * */
        $listing->start_controls_tab('image',
                [
                    'label' => __('Image', 'th-widget-pack'),
                ]
        );
        $listing->add_control(
                'thmv_image',
                [
                    'label' => __('Image', 'th-widget-pack'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );
        $listing->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thmv_image',
                    'default' => 'large',
                    'separator' => 'none',
                ]
        );
        $listing->add_control(
                'thmv_carousel_switcher',
                [
                    'label' => __('Carousel', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                ]
        );

        $listing->add_control(
                'thmv_carousel',
                [
                    'label' => __('Add Images', 'elementor'),
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

        $listing->end_controls_tab();
        /** tab image end * */
        /** tab data * */
        $listing->start_controls_tab('data',
                [
                    'label' => __('Data', 'th-widget-pack'),
                ]
        );

        $listing->add_control(
                'thmv_highlight',
                [
                    'label' => __('Highlight', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Newly Renovated', 'th-widget-pack'),
                    'placeholder' => __('Newly Renovated', 'th-widget-pack'),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4'],
                    ],
                ]
        );

        $listing->add_control(
                'thmv_title',
                [
                    'label' => __('Title', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Studio Suite', 'th-widget-pack'),
                    'placeholder' => __('Studio Suite', 'th-widget-pack'),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );

        $listing->add_control(
                'thmv_preface',
                [
                    'label' => __('Preface', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('4 guests, 2 bedrooms, 1 bath', 'th-widget-pack'),
                    'placeholder' => __('4 guests, 2 bedrooms, 1 bath', 'th-widget-pack'),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4'],
                    ],
                ]
        );
        $listing->add_control(
                'thmv_title_separator',
                [
                    'label' => __('Title Separator', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'default'=> 'yes',
                    'condition' => [
                        'thmv_style' => ['style_6'],
                    ],
                ]
        );
        $listing->add_control(
                'thmv_description',
                [
                    'label' => __('Description', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => 'The Studio Suite is warm and welcoming, with a large, gorgeous bathroom that includes a full-size whirlpool tub.',
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );

        $listing->add_control(
                'thmv_rating_switcher',
                [
                    'label' => __('Star Rating', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $listing->add_control(
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
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );

        $listing->add_control(
                'thmv_location_switcher',
                [
                    'label' => __('Location', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $listing->add_control(
                'thmv_location_icon',
                [
                    'label' => __('Icon', 'elementor'),
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
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $listing->add_control(
                'thmv_location_text',
                [
                    'label' => __('Text', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => "10 km away",
                    'default' => "10 km away",
                    'label_block' => true,
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $listing->add_control(
                'thmv_location_link',
                [
                    'label' => __('Link', 'elementor'),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __('https://your-link.com', 'elementor'),
                    'default' => [
                        'url' => '#',
                    ],
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $listing->add_control(
                'thmv_price',
                [
                    'label' => __('Price', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('$299', 'th-widget-pack'),
                    'placeholder' => __('$299', 'th-widget-pack'),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'separator' => 'before',
                ]
        );

        $listing->add_control(
                'thmv_price_before',
                [
                    'label' => __('Before Price', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Starting at', 'th-widget-pack'),
                    'placeholder' => __('Starting at', 'th-widget-pack'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );

        $listing->add_control(
                'thmv_price_after',
                [
                    'label' => __('After Price', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('/each', 'th-widget-pack'),
                    'placeholder' => __('/each', 'th-widget-pack'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );

        $listing->end_controls_tab();
        /** tab data end * */
        /** tab Icons begin * */
        $listing->start_controls_tab('icons',
                [
                    'label' => __('Icons', 'th-widget-pack'),
                //conditions don't work with tabs
                ]
        );

        for ($i = 0; $i < $this->totalIcons; $i++) {
            $array = [
                'label' => __('Icon', 'th-widget-pack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
                'condition' => [
                    'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_6'],
                ]
            ];
            if ($i == 0) {
                $array['default'] = [
                    'value' => 'fas fa-wifi',
                    'library' => 'fa-solid',
                ];
            }
            $listing->add_control(
                    'thmv_icon_icon' . $i, $array);

            $listing->add_control(
                    'thmv_icon_label' . $i, [
                'label' => __('Label', 'th-widget-pack'),
                'description' => 'May not show for all styles.',
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Wifi ',
                'default' => ($i == 0 ? 'Wifi' : ''),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_6'],
                ]
                    ]
            );
        }

        $listing->add_control(
                'thmv_icon_ordering',
                [
                    'label' => __('Ordering', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );
        $listing->end_controls_tab();
        /** tab icons end * */
        /** tab link begin * */
        $listing->start_controls_tab('link',
                [
                    'label' => __('Link', 'th-widget-pack'),
                ]
        );
        $listing->add_control(
                'thmv_link_text',
                [
                    'label' => __('Text', 'elementor'),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => __('Learn More', 'elementor'),
                    'placeholder' => __('Learn More', 'elementor'),
                ]
        );

        $listing->add_control(
                'thmv_link',
                [
                    'label' => __('Link', 'th-widget-pack'),
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

        $listing->end_controls_tab();
        /** tab link end * */
        $listing->end_controls_tabs();
        /** tabs end* */
        $this->add_control(
                'listings',
                [
                    'label' => __('Listings', 'th-widget-pack'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $listing->get_controls(),
                    'title_field' => '{{{ thmv_title }}}',
                ]
        );
        $this->end_controls_section();
        /** listing repeater end* */
        /* STYLE - Layout */
        $this->start_controls_section(
                'thmv_section_layout',
                [
                    'label' => __('Layout', 'th-widget-pack'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'thmv_style',
                [
                    'label' => __('Choose style', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style_1',
                    'options' => [
                        'style_1' => __('Style 1', 'th-widget-pack'),
                        'style_2' => __('Style 2', 'th-widget-pack'),
                        'style_3' => __('Style 3', 'th-widget-pack'),
                        'style_4' => __('Style 4', 'th-widget-pack'),
                        'style_5' => __('Style 5', 'th-widget-pack'),
                        'style_6' => __('Style 6', 'th-widget-pack'),
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_wrapper_text_align',
                [
                    'label' => __('Content Align', 'th-widget-pack'),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'th-widget-pack'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'th-widget-pack'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'th-widget-pack'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thmv-wrapper-content' => 'text-align: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'thmv_section_content_style',
                [
                    'label' => __('Content', 'th-widget-pack'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        /* STYLE - Images - Carousel */

        /* STYLE - Icons */
        $this->add_control(
                'thmv_section_carousel_heading',
                [
                    'label' => __('Carousel', 'elementor'),
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
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-info .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_carousel_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_carousel_icon_size',
                [
                    'label' => __('Size', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thme-info .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thmv_carousel_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'thmv_carousel_background_color',
                [
                    'label' => __('Background', 'th-widget-pack'),
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
                    'label' => __('Highlight', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        $this->add_control(
                'thmv_highlight_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
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
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_highlight_typography',
                    'selector' => '{{WRAPPER}} .element',
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
                    ],
                ],
        );

        $this->add_control(
                'thmv_highlight_background_color',
                [
                    'label' => __('Background', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
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
                'thmv_title_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-info h3' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_title_typography',
                    'selector' => '{{WRAPPER}} .thme-info h3',
                ]
        );

        /* STYLE - Preface */
        $this->add_control(
                'thmv_section_preface_heading',
                [
                    'label' => __('Preface', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        $this->add_control(
                'thmv_preface_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
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
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_preface_typography',
                    'selector' => '{{WRAPPER}} .element',
                    'condition' => [
                        'thmv_style' => ['style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        /* STYLE - Description */
        $this->add_control(
                'thmv_section_description_heading',
                [
                    'label' => __('Description', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'thmv_description_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-info p' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_description_typography',
                    'selector' => '{{WRAPPER}} .thme-info p',
                ]
        );

        /* STYLE - Icons */
        $this->add_control(
                'thmv_section_icon_heading',
                [
                    'label' => __('Icons', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_6']
                    ],
                ]
        );

        $this->add_control(
                'thmv_icon_color',
                [
                    'label' => __('Icon Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-info .elementor-icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_6']
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_icon_size',
                [
                    'label' => __('Icon Size', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thme-info .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_6']
                    ],
                ]
        );

        /* $this->add_control(
          'thmv_section_icon_label_heading',
          [
          'label' => __( 'Icon Label', 'elementor' ),
          'type' => Controls_Manager::HEADING,
          'separator' => 'before',
          ]
          ); */

        $this->add_control(
                'thmv_icon_label_color',
                [
                    'label' => __('Label Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-info .thme-list span' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_6']
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Label Typography', 'elementor'),
                    'name' => 'thmv_icon_label_typography',
                    'selector' => '{{WRAPPER}} .thme-info .thme-list span',
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_6']
                    ],
                ]
        );

        /* STYLE - Rating */
        $this->add_control(
                'thmv_section_rating_heading',
                [
                    'label' => __('Rating', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_rating_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_control(
                'thmv_rating_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-star-rating svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_rating_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_rating_size',
                [
                    'label' => __('Size', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thme-star-rating svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thmv_rating_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        /* STYLE - Location */
        $this->add_control(
                'thmv_section_location_icon_heading',
                [
                    'label' => __('Location', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_control(
                'thmv_location_icon_color',
                [
                    'label' => __('Icon Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-location .location-icon i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_location_icon_size',
                [
                    'label' => __('Icon Size', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thme-location .location-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_control(
                'thmv_icon_location_color',
                [
                    'label' => __('Location Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thme-location .location' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Location Typography', 'elementor'),
                    'name' => 'thmv_location_typography',
                    'selector' => '{{WRAPPER}} .thme-location .location',
                    'condition' => [
                        'thmv_location_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        /* STYLE - Price */
        $this->add_control(
                'thmv_section_price_heading',
                [
                    'label' => __('Price', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'thmv_price_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .thmv-price .price' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_price_typography',
                    'selector' => '{{WRAPPER}} .thmv-price .price',
                ]
        );

        $this->add_control(
                'thmv_before_price_text_color',
                [
                    'label' => __('Before Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#1C1715',
                    'selectors' => [
                        '{{WRAPPER}} .thmv-price .price-before' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Before Typography', 'elementor'),
                    'name' => 'thmv_before_price_text_typography',
                    'selector' => '{{WRAPPER}} .thmv-price .price-before',
                ]
        );

        $this->add_control(
                'thmv_after_price_text_color',
                [
                    'label' => __('After Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#1C1715',
                    'selectors' => [
                        '{{WRAPPER}} .thmv-price .price-after' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('After Typography', 'elementor'),
                    'name' => 'thmv_after_price_text_typography',
                    'selector' => '{{WRAPPER}} .thmv-price .price-after',
                ]
        );

        $this->add_control(
                'thmv_price_background_color',
                [
                    'label' => __('Background', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-price' => 'background: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        /* $this->add_control(
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
          ); */

        $this->end_controls_section();

        $this->start_controls_section(
                'thmv_style_section_link',
                [
                    'label' => __('Link', 'th-widget-pack'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'thmv_link_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-learn-btn' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_hide_link' => '',
                        'thmv_style' => ['style_2', 'style_3']
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
                    'condition' => [
                        'thmv_hide_link' => '',
                        'thmv_style' => ['style_1', 'style_4', 'style_5', 'style_6']
                    ],
                ]
        );

        $this->end_controls_section();
    }

    private function getStar() {
        ob_start();
        ?>
        <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.52677 1.14039C6.81457 0.195585 8.15218 0.195588 8.43998 1.1404L9.2671 3.85572C9.39532 4.27666 9.78366 4.56432 10.2237 4.56432H13.0309C13.9839 4.56432 14.3967 5.77095 13.6434 6.35474L11.2637 8.19898C10.9356 8.45324 10.7987 8.88374 10.9196 9.2808L11.8021 12.1776C12.0862 13.1104 11.0036 13.8568 10.2329 13.2595L8.09594 11.6034C7.73536 11.3239 7.23139 11.3239 6.87081 11.6034L4.73386 13.2595C3.96311 13.8568 2.88055 13.1104 3.16469 12.1776L4.04711 9.2808C4.16806 8.88374 4.03115 8.45324 3.70306 8.19898L1.32334 6.35474C0.570037 5.77095 0.982864 4.56432 1.9359 4.56432H4.74305C5.18309 4.56432 5.57143 4.27666 5.69965 3.85572L6.52677 1.14039Z" fill="#FFC804"/>
        </svg>
        <?php
        return ob_get_clean();
    }

    private function getLocationIcon($icon = false, $name = false) {
        ob_start();
        if (!$icon) {
            ?>
            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 0.5C3.0975 0.5 0.75 2.8475 0.75 5.75C0.75 9.6875 6 15.5 6 15.5C6 15.5 11.25 9.6875 11.25 5.75C11.25 2.8475 8.9025 0.5 6 0.5ZM6 7.625C4.965 7.625 4.125 6.785 4.125 5.75C4.125 4.715 4.965 3.875 6 3.875C7.035 3.875 7.875 4.715 7.875 5.75C7.875 6.785 7.035 7.625 6 7.625Z" fill="#8C8D8C"/></svg>

            <?php
        } else {
            Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
        }

        return ob_get_clean();
    }

    private function getSvgIcon($icon) {
        if (empty($icon))
            return '';

        switch ($icon) {
            case 'plus':
                return '<svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.356 4.618H0.918V3.61H4.356V0.0639992H6.354V3.61H9.792V4.618H6.354V8.146H4.356V4.618Z" fill="#1C1715"/></svg>';

                break;
        }

        return '';
    }

    private function setupIcon(&$iconList, $list, &$j, $i) {
        $icon = 'thmv_icon_icon' . $i;
        $label = 'thmv_icon_label' . $i;
        $isIcon = (isset($list[$icon]) && !empty($list[$icon]['value']));
        $isLabel = (isset($list[$label]) && !empty($list[$label]));
        if ($isIcon || $isLabel) {
            if ($isIcon) {
                $iconList[$j]['thmv_icon'] = $list[$icon];
            }
            if ($isLabel) {
                $iconList[$j]['thmv_icon_label'] = $list[$label];
            }
            $j++;
        }
    }

    private function getIcons($list) {
        $iconList = [];
        $ordering = $list['thmv_icon_ordering'];
        $j = 0;
        if (!empty(trim($ordering))) {
            $orderingArr = explode(',', trim($ordering));
            foreach ($orderingArr as $i) {
                $this->setupIcon($iconList, $list, $j, $i);
            }
        } else {
            for ($i = 0; $i < $this->totalIcons; $i++) {
                $this->setupIcon($iconList, $list, $j, $i);
            }
        }
        return $iconList;
    }

    private function renderIcon($icon) {
        ob_start();

        if (isset($icon['thmv_icon'])) {
            ?>
            <div class="elementor-icon thmv-icon">
                <?php
                Icons_Manager::render_icon($icon['thmv_icon'], ['aria-hidden' => 'true']);
                ?>

            </div>
            <?php
        }
        ?>

        <?php if (isset($icon['thmv_icon_label'])): ?>
            <span><?php echo esc_html($icon['thmv_icon_label']); ?></span>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    private function renderSlider($settings, $images) {
        $slides = [];

        foreach ($images as $attachment) {
            $image_url = Group_Control_Image_Size::get_attachment_image_src($attachment['id'], 'thmv_image', $settings);
            if (!$image_url && isset($attachment['url'])) {
                $image_url = $attachment['url'];
            }

            $image_html = '<img class="swiper-slide-image" src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($attachment)) . '" />';

            $link_tag = '';

            $slide_html = '<div class="swiper-slide">' . $link_tag . '<figure class="swiper-slide-inner">' . $image_html;

            $slide_html .= '</figure>';

            $slide_html .= '</div>';

            $slides[] = $slide_html;
        }
        $this->add_render_attribute([
            'carousel' => [
                'class' => 'elementor-image-carousel swiper-wrapper',
            ],
            'carousel-wrapper' => [
                'class' => 'elementor-image-carousel-wrapper swiper-container',
                'dir' => 'ltr',
            ],
        ]);
        $sliderSettings = '{"slides_to_show":"1","autoplay":"no","navigation":"both","infinite":"yes","effect":"slide","speed":500}';
        ?>
        <div data-widget_type="image-carousel.default" data-settings='<?= $sliderSettings ?>' data-element_type="widget" class="elementor-element elementor-arrows-position-inside  elementor-widget elementor-widget-image-carousel">

            <div <?php echo $this->get_render_attribute_string('carousel-wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('carousel'); ?>>
                    <?php echo implode('', $slides); ?>
                </div>
                <?php if (1 < count($slides)) : ?>
                    <div class="elementor-swiper-button elementor-swiper-button-prev">
                        <i class="eicon-chevron-left" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php _e('Previous', 'elementor'); ?></span>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next">
                        <i class="eicon-chevron-right" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php _e('Next', 'elementor'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    private function getDescription() {
        $th_tour_intro = get_post_meta(get_the_ID(), 'th_room_intro', true);
        if ($th_tour_intro === false || empty($th_tour_intro)) {
            $automatic_post_excerpts = 'on';
            if (function_exists('get_theme_mod')) {
                $automatic_post_excerpts = get_theme_mod('themo_automatic_post_excerpts', 'on');
            }
            if ($automatic_post_excerpts === 'off') {
                $th_tour_intro = apply_filters('the_content', get_the_content());
                $th_tour_intro = str_replace(']]>', ']]&gt;', $th_tour_intro);
            } else {
                $th_tour_intro = apply_filters('the_excerpt', get_the_excerpt());
                $th_tour_intro = str_replace(']]>', ']]&gt;', $th_tour_intro);
            }
        }

        return strip_tags($th_tour_intro); //maybe keep bold, italics
    }

    private function getImageFromPost() {
        // Get Project Format Options
        $project_thumb_alt_img = get_post_meta(get_the_ID(), 'th_room_thumb', false);
        $alt = '';
        $th_image_url = '';
        if (isset($project_thumb_alt_img[0]) && $project_thumb_alt_img[0] > "") {
            $alt = false;

            // Check if Image comes in Med size with Square crop / else get small

            $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "th_img_md_square");

            if ($th_image) {

                $width = $th_image[1];
                $height = $th_image[2];

                if ((605 !== $width) && (605 !== $height)) {

                    // Check if Image comes in Small size with Square crop / else get thumb

                    $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "th_img_sm_square");

                    $width = $th_image[1];
                    $height = $th_image[2];

                    if ((394 !== $width) && (394 !== $height)) {

                        $th_image = wp_get_attachment_image_src($project_thumb_alt_img[0], "thumbnail");
                    }
                }
            }
            $th_image_url = false;
            if (isset($th_image[0])) {
                $th_image_url = $th_image[0];
            }
            $alt_text = get_post_meta($project_thumb_alt_img[0], '_wp_attachment_image_alt', true);
        } else {
            $featured_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'th_img_xl');
            if (is_array($featured_url)) {
                $th_image_url = $featured_url[0];
            }
        }

        if (empty($th_image_url)) {
            $th_image_url = 'https://via.placeholder.com/605x605?' . __('text=No+featured+image+found', 'th-widget-pack');
        }

        $imageArr = ['url' => $th_image_url, 'alt' => $alt];
        return $imageArr;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (isset($_GET['debug'])) {
            echo "<pre>";
            print_r($settings);
            exit;
        }

        $dataSource = !empty($settings['thmv_data_source']) ? $settings['thmv_data_source'] : false;
        if ($dataSource) {
            $args = array();
            if ($settings['individual']) {
                if (in_array('none', $settings['individual'])) {
                    $settings['individual'] = array_diff($settings['individual'], array('none'));
                }
                if ($settings['individual']) {
                    $post_ids = $settings['individual'];
                    $args['post__in'] = $post_ids;
                }
            }
            if ($dataSource === 'themo_room_type') {
                $postType = 'themo_room';
            } else {
                $postType = $dataSource;
            }
            $args['post_type'] = $postType;
            if ($settings['group']) {
                if (in_array('none', $settings['group'])) {
                    $settings['group'] = array_diff($settings['group'], array('none'));
                }
                if ($settings['group']) {
                    $project_type_id = $settings['group'];
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => $dataSource,
                            'field' => 'term_id',
                            'terms' => $project_type_id,
                        ),
                    );
                }
            }
            if ($settings['order'] == 'date') {
                $args['orderby'] = 'date';
            } elseif ($settings['order'] == 'menu_order') {
                $args['orderby'] = 'menu_order';
                $args['order'] = 'ASC';
            }
            $args['post_status'] = 'publish';
            $args['posts_per_page'] = -1;

            // The Query
            $query = new \WP_Query($args);

            $carousel_switcher = false;
        } else {
            if (!isset($settings['listings']) or!count($settings['listings'])) {
                return;
            }
        }

        /*         * global vars * */
        $buttonstyle = $settings['button_style'];
        $columnClass = floor(100 / $settings['columns']);
        $listingStyleDefault = $settings['thmv_style'];

        $this->add_render_attribute('thmv_column', 'class', 'thmv-column elementor-column elementor-col-' . $columnClass);

        if (empty($buttonstyle)) {
            $this->add_render_attribute('thmv_link', 'class', 'thmv-learn-btn', true);
        } else {
            $this->add_render_attribute('thmv_link', 'class', 'btn btn-1 th-btn btn-' . $buttonstyle, true);
        }



        $listingStyle = str_replace('style_', '', $listingStyleDefault);
        $this->add_render_attribute('thmv_wrapper', 'class', 'elementor-row thmv-lst-styl-' . $listingStyle, true);

        echo '<h1>Listing style ' . $listingStyle . ($dataSource ? ' Data source' : '') . '</h1>';
        echo '<div ' . $this->get_render_attribute_string('thmv_wrapper') . '>';

        if ($dataSource) {
            if ($query->have_posts()) {
                ?>
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    // get post format
                    $format = get_post_format();
                    if (false === $format) {
                        $format = '';
                    }

                    // default settings

                    $image = $this->getImageFromPost();
                    $title = get_the_title();
                    $description = $this->getDescription();

                    $price = get_post_meta(get_the_ID(), 'th_room_price', true);
                    $price_after = get_post_meta(get_the_ID(), 'th_room_price_per', true);
                    $link_text = get_post_meta(get_the_ID(), 'th_room_button_text', true);
                    if (empty($link_text)) {
                        $link_text = __('Learn More', 'th-widget-pack');
                    }
                    $link_url = get_the_permalink();

                    $showStars = $settings['thmv_rating_switcher'] == 'yes' ? true : false;
                    $starsRating = $settings['thmv_rating'];
                    ?>
                    <div class="thmv-column">
                        <div class="thme-grid-style-1">
                            <div class="thme-grid-img">
                                <?php if (isset($image) && !empty($image['url'])): ?>
                                    <img class="img-fluid" src="<?= $image['url'] ?>" alt="">
                                    <?php endif; ?>  

                                    <div class="thmv-price">
                                        <?php if (!empty($price)): ?>
                                            <h4><?= $price ?></h4>
                                        <?php endif; ?>
                                        <?php if (!empty($price_after)): ?>
                                            <span><?= $price_after ?></span>
                                        <?php endif; ?>
                                    </div>
                            </div>
                            <div class="thme-grid-rating">
                                <?php if ($showStars && $starsRating['size'] > 0): ?>

                                    <ul class="thme-star-rating">
                                        <?php
                                        $size = floor($starsRating['size']);
                                        for ($i = 0; $i < $size; $i++):
                                            ?>
                                            <li><?= $this->getStar(); ?></li>
                                        <?php endfor; ?>
                                        <li><?= $starsRating['size'] ?></li>


                                    </ul>
                                <?php endif; ?>

                                <ul class="thme-location">
                                    <li><?= $this->getLocationIcon() ?></li>
                                    <li>10 km from Tiny House</li>
                                </ul>
                            </div>
                            <div class="thme-info">
                                <?php if (!empty($title)): ?>
                                    <h3><?= esc_html($title) ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($description)): ?>
                                    <p><?= esc_html($description) ?></p>
                                <?php endif; ?>

                                <?php if (!empty($link_url)) : ?>
                                    <a <?php echo $this->get_render_attribute_string('thmv_link'); ?> href="<?= $link_url ?>">
                                        <?= isset($link_text) ? $link_text : '' ?>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php
            } else {
                echo '<div class="alert">';
                _e('Sorry, no results were found.', 'th-widget-pack');
                echo '</div>';
            }
        } else {

            foreach ($settings['listings'] as $list) {



                $image = $list['thmv_image'];
                $carousel_switcher = $list['thmv_carousel_switcher'] == 'yes' ? true : false;
                $carouselImages = $list['thmv_carousel'];

                $title = $list['thmv_title'];
                $titleSeparator = $list['thmv_title_separator'];
                $description = $list['thmv_description'];
                $link_url = $list['thmv_link']['url'];
                $price = $list['thmv_price'];
                $price_before = $list['thmv_price_before'];
                $price_after = $list['thmv_price_after'];
                $link_text = $list['thmv_link_text'];
                $showStars = $list['thmv_rating_switcher'] == 'yes' ? true : false;
                $starsRating = $list['thmv_rating'];
                $locationText = $list['thmv_location_text'];
                $showLocation = $list['thmv_location_switcher'] == 'yes';
                $locationIcon = $list['thmv_location_icon'];
                $icons = $this->getIcons($list);
                /** button link attributes * */
                if (!empty($link_url)) {
                    $this->add_render_attribute('thmv_link', 'href', esc_url($link_url), true);
                    if (!empty($list['thmv_link']['is_external'])) {
                        $this->add_render_attribute('thmv_link', 'target', '_blank', true);
                    }
                    if (!empty($list['thmv_link']['nofollow'])) {
                        $this->add_render_attribute('thmv_link', 'rel', 'nofollow', true);
                    }
                }
                ?>

                <?php ob_start(); ?>
                <div class="thmv-price">
                    <?php if (!empty($price_before)): ?>
                        <div class="price-before"><?= $price_before ?><?= (!empty($price) ? '&nbsp;' : '') ?></div>
                    <?php endif; ?>
                    <?php if (!empty($price)): ?>
                        <div class="price"><?= $price ?></div>
                    <?php endif; ?>
                    <?php if (!empty($price_after) && in_array($listingStyle, [1,6])): ?>
                        <div class="price-after"><?= $price_after ?></div>
                    <?php endif; ?>
                </div>
                <?php $priceBlock = ob_get_clean(); ?>


                <div <?php echo $this->get_render_attribute_string('thmv_column'); ?>>
                    <div class="elementor-widget-wrap">

                        <div class="thme-grid-style-<?= $listingStyle ?> elementor-element">
                            <div class="thme-grid-img">
                                <?php if (!$carousel_switcher && isset($image) && !empty($image['url'])): ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($list, 'thmv_image'); ?>
                                <?php endif; ?>

                                <?php
                                if ($carousel_switcher && is_array($carouselImages)):
                                    $this->renderSlider($list, $carouselImages);
                                endif;
                                ?>  

                                <?php if (in_array($listingStyle, [2])): ?>
                                    <div class="thmv-top-box"><span>Top</span></div>
                                <?php endif; ?>

                                <?php if (in_array($listingStyle, [1, 2, 3, 4])): ?>    
                                    <?php echo $priceBlock; ?>
                                <?php endif; ?>     
                            </div>

                            <?php if (in_array($listingStyle, array(2))): ?>
                                <div class="thme-grid-sleep">
                                    <h4>Sleeps 2, Queen Bed</h4>
                                    <?php if (count($icons)): ?>
                                        <ul class="thme-grid-facility">
                                            <?php
                                            foreach ($icons as $icon):
                                                echo '<li>' . $this->renderIcon($icon) . '</li>';
                                                ?>   
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            <?php endif;
                            ?>
                            <div class="thme-info">

                                <?php if ($showStars || $showLocation): ?>
                                    <div class="thme-grid-rating">
                                        <?php if ($showStars && $starsRating['size'] > 0): ?>
                                            <ul class="thme-star-rating">
                                                <?php
                                                $size = floor($starsRating['size']);
                                                for ($i = 0; $i < $size; $i++):
                                                    ?>
                                                    <li><?= $this->getStar(); ?></li>
                                                <?php endfor; ?>
                                                <li><?= $starsRating['size'] ?></li>
                                            </ul>
                                        <?php endif; ?>

                                        <?php if ($showLocation): ?>
                                            <ul class="thme-location">
                                                <li class="location-icon"><?= $this->getLocationIcon($locationIcon, 'thmv_location_icon') ?></li>
                                                <li class="location"><?= $locationText ?></li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (in_array($listingStyle, [3])): ?>
                                    <div class="thmv-top-box"><span>Top</span></div>
                                <?php endif; ?>
                                <?php if (!empty($title)): ?>
                                    <h3><?= esc_html($title) ?></h3>
                                <?php endif; ?>
                                <?php if (in_array($listingStyle, array(6)) && $titleSeparator): ?>    
                                    <hr class="thmv-separator">
                                <?php endif; ?>    
                                <?php if (in_array($listingStyle, array(3, 4))): ?>    
                                    <h4>Sleeps 2, Queen Bed</h4>  
                                <?php endif; ?>
                                <?php if (!empty($description)): ?>
                                    <p><?= esc_html($description) ?></p>
                                <?php endif; ?>

                                <?php
                                $iconListClass = 'thme-list';
                                if ($listingStyle == 6) {
                                    $iconListClass = 'thme-grid-facility';
                                }

                                if (count($icons) && in_array($listingStyle, array(1, 6))):
                                    ?>
                                    <ul class="<?= $iconListClass ?>">
                                        <?php
                                        foreach ($icons as $icon):
                                            echo '<li>' . $this->renderIcon($icon) . '</li>';
                                            ?>   
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php
                                endif;
                                ?>
                                <?php if (in_array($listingStyle, [5])): ?>    
                                    <?php echo $priceBlock; ?>
                                <?php endif; ?>   

                                <div class="<?=($listingStyle==6 ? 'thme-grid-booking' : '')?>">
                                    <?php if (!empty($link_url)) : ?>
                                        <a <?php echo $this->get_render_attribute_string('thmv_link'); ?>>
                                            <?= isset($link_text) ? $link_text : '' ?>
                                            <?php
                                            if (in_array($listingStyle, array(2, 3))):
                                                echo $this->getSvgIcon('plus');
                                                ?>

                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (in_array($listingStyle, [6])): ?>    
                                        <?php echo $priceBlock; ?>
                                    <?php endif; ?> 
                                </div>

                                <?php if (count($icons) && in_array($listingStyle, array(3))): ?>
                                    <ul class="thme-grid-facility">
                                        <?php
                                        foreach ($icons as $icon):
                                            echo '<li>' . $this->renderIcon($icon) . '</li>';
                                            ?>   
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>


                <?php
            }
        }

        echo '</div>';

        if ($dataSource && $query) {
            wp_reset_postdata();
        }
        ?>



        <?php
    }

    protected function _content_template() {
        
    }

    public function add_wpml_support() {
        add_filter('wpml_elementor_widgets_to_translate', [$this, 'wpml_widgets_to_translate_filter']);
    }

    public function wpml_widgets_to_translate_filter($widgets) {
        $widgets[$this->get_name()] = [
            'conditions' => ['widgetType' => $this->get_name()],
            'fields' => [
                [
                    'field' => 'pre_title',
                    'type' => __('Pre Title', 'th-widget-pack'),
                    'editor_type' => 'LINE'
                ],
                [
                    'field' => 'title',
                    'type' => __('Title', 'th-widget-pack'),
                    'editor_type' => 'LINE'
                ],
                [
                    'field' => 'content',
                    'type' => __('Content', 'th-widget-pack'),
                    'editor_type' => 'AREA'
                ],
                [
                    'field' => 'thmv_price',
                    'type' => __('thmv_price', 'th-widget-pack'),
                    'editor_type' => 'LINE'
                ],
                [
                    'field' => 'price_text',
                    'type' => __('Price Text', 'th-widget-pack'),
                    'editor_type' => 'LINE'
                ],
                'url' => [
                    'field' => 'url',
                    'field_id' => 'url', // New key
                    'type' => __('Link URL', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
            ],
        ];
        return $widgets;
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Themo_Widget_Accommodation_Listing());
