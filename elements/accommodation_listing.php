<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Themo_Widget_Accommodation_Listing extends Widget_Base {

    var $totalIcons = 12;
    var $imageKey = 'thmv_image';

    public function loadTHMVAssets($editMode = false) {
        $modified = filemtime(THEMO_PATH . 'css/accommodation.css');
        wp_enqueue_style($this->get_name(), THEMO_URL . 'css/accommodation.css', array(), $modified);
    }

    public function get_name() {
        return 'themo-accommodation-listing';
    }

    private function getImageKey() {
        return $this->imageKey;
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

    private function get_list($postType) {
        $portfolio = array();

        $loop = new \WP_Query(array(
            'post_type' => $postType,
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

    private function get_group_list($taxonomy) {
        $portfolio_group = array();

        $portfolio_group['none'] = __('None', 'th-widget-pack');

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
                    'options' => $this->get_list('themo_room'),
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_data_source' => 'themo_room_type',
                    ],
                ]
        );
        $this->add_control(
                'individual_mphb_room_type',
                [
                    'label' => __('Select Individually', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => $this->get_list('mphb_room_type'),
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_data_source' => 'mphb_room_type',
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
                    'options' => $this->get_group_list('themo_room_type'),
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_data_source' => 'themo_room_type',
                    ],
                ]
        );
        $this->add_control(
                'group_mphb_room_type',
                [
                    'label' => __('Select by Group', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => $this->get_group_list('mphb_room_type_category'),
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_data_source' => 'mphb_room_type',
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

        $this->add_responsive_control(
                'columns',
                [
                    'label' => __('Columns', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => __('Default', 'th-widget-pack'),
                        '1' => __('1', 'th-widget-pack'),
                        '2' => __('2', 'th-widget-pack'),
                        '3' => __('3', 'th-widget-pack'),
                        '4' => __('4', 'th-widget-pack'),
                        '5' => __('5', 'th-widget-pack'),
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thmv_data_source_image',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'thmv_align_image',
                [
                    'label' => __('Image alignment', 'th-widget-pack'),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'th-widget-pack'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'alternate' => [
                            'title' => __('Alternate', 'th-widget-pack'),
                            'icon' => 'fa fa-times',
                        ],
                        'right' => [
                            'title' => __('Right', 'th-widget-pack'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => '',
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_style' => ['style_3', 'style_5', 'style_6'],
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

        $this->add_responsive_control(
                'thmv_hide_highlight',
                [
                    'label' => __('Highlight', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-grid .thmv-top-box ' => 'display:none !important;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );
        $this->add_responsive_control(
                'thmv_hide_title',
                [
                    'label' => __('Title', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-title ' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_preface',
                [
                    'label' => __('Preface', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-preface ' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_style' => ['style_2', 'style_3', 'style_4'],
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_description',
                [
                    'label' => __('Description', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-info .thmv-description' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_icons',
                [
                    'label' => __('Icons', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-icons ' => 'display:none !important;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_6'],
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_rating',
                [
                    'label' => __('Rating', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-star-rating ' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_location',
                [
                    'label' => __('Location', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-location ' => 'display:none;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                        'thmv_style' => ['style_1', 'style_5'],
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_price',
                [
                    'label' => __('Price', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-price' => 'display:none !important;',
                    ],
                    'condition' => [
                        'thmv_data_switcher' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_hide_link',
                [
                    'label' => __('Link', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'selectors' => [
                        '{{WRAPPER}} .thmv-btn ' => 'display:none;',
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
                    'name' => $this->getImageKey(),
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

        $listing->add_control(
                'thmv_align_image_right',
                [
                    'label' => __('Show images on the right side', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'condition' => [
                        'thmv_style' => ['style_3', 'style_5', 'style_6'],
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
                    'default' => 'yes',
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

        $this->end_controls_section();

        $this->start_controls_section(
                'thmv_section_content_style',
                [
                    'label' => __('Content', 'th-widget-pack'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        /* STYLE - Highlight */
        $this->add_control(
                'thmv_section_highlight_heading',
                [
                    'label' => __('Highlight', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
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
                        '{{WRAPPER}} .elementor-row .thmv-top-box span' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_highlight_typography',
                    'selector' => '{{WRAPPER}} .thmv-top-box span',
                ],
        );

        $this->add_control(
                'thmv_highlight_background_color',
                [
                    'label' => __('Background', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-row .thmv-top-box span' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .elementor-row .thmv-top-box' => 'background: none;',
                    ],
                ]
        );

        $this->add_control(
                'thmv_highlight_background_blur',
                [
                    'label' => __('Background Blur', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 25,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thmv-top-box' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );
        $this->add_control(
                'thmv_highlight_align',
                [
                    'label' => __('Align', 'th-widget-pack'),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'th-widget-pack'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'right' => [
                            'title' => __('Right', 'th-widget-pack'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => '',
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
                        '{{WRAPPER}} .thmv-info .thmv-title' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_title_typography',
                    'selector' => '{{WRAPPER}} .thmv-info .thmv-title',
                ]
        );
        /* STYLE - Title Separator */
        $this->add_control(
                'thmv_section_title_separator_heading',
                [
                    'label' => __('Title Separator', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_6']
                    ],
                ]
        );

        $this->add_control(
                'thmv_title_separator_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thmv-separator' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_6']
                    ],
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
                        '{{WRAPPER}} .thmv-preface' => 'color: {{VALUE}};',
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
                    'selector' => '{{WRAPPER}} .thmv-preface',
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
                        '{{WRAPPER}} .thmv-info .thmv-description' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_description_typography',
                    'selector' => '{{WRAPPER}} .thmv-info .thmv-description',
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
                        '{{WRAPPER}} .thmv-icons .elementor-icon.thmv-icon' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}}   .thmv-icons .elementor-icon.thmv-icon' => 'font-size: {{SIZE}}{{UNIT}};',
//                        '{{WRAPPER}} .thmv-icons.thmv-grid-facility .elementor-icon.thmv-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .thmv-icons.thmv-list .thmv-icon-label' => 'color: {{VALUE}};',
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
                    'selector' => '{{WRAPPER}} .thmv-icons.thmv-list .thmv-icon-label, {{WRAPPER}} .thmv-icons .thmv-icon-label',
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
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_control(
                'thmv_rating_color',
                [
                    'label' => __('Icon Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .thmv-star-rating svg path' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .thmv-star-rating li:not(:last-child)' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_responsive_control(
                'thmv_rating_size',
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
                        '{{WRAPPER}} .thmv-star-rating svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .thmv-star-rating li:not(:last-child)' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_control(
                'thmv_rating_text_color',
                [
                    'label' => __('Text Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} ul.thmv-star-rating li:last-child' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Text Typography', 'elementor'),
                    'name' => 'thmv_rating_typography',
                    'selector' => '{{WRAPPER}} ul.thmv-star-rating li:last-child',
                    'condition' => [
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
                        '{{WRAPPER}} .thmv-location .location-icon i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
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
                        '{{WRAPPER}} .thmv-location .location-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
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
                        '{{WRAPPER}} .thmv-location .location' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Location Typography', 'elementor'),
                    'name' => 'thmv_location_typography',
                    'selector' => '{{WRAPPER}} .thmv-location .location',
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_5']
                    ],
                ]
        );

        /* STYLE - Before Price */
        $this->add_control(
                'thmv_section_before_price_heading',
                [
                    'label' => __('Before Price', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
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
                    //'default' => '#ffffff',
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


        /* STYLE - After Price */
        $this->add_control(
            'thmv_section_after_price_heading',
            [
                'label' => __('After Price', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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

        /* STYLE - Price Background */
        $this->add_control(
            'thmv_section_price_background_heading',
            [
                'label' => __('Price Background', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_4']
                    ],
            ]
        );
        $this->add_control(
                'thmv_price_background_color',
                [
                    'label' => __('Background', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-row .thmv-price' => 'background: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_4']
                    ],
                ]
        );

        // backdrop-filter: blur(25px);

        $this->add_control(
                'thmv_price_background_blur',
                [
                    'label' => __('Background Blur', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 25,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thmv-price' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_4']
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );
        $this->add_control(
                'thmv_price_align',
                [
                    'label' => __('Align', 'th-widget-pack'),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'th-widget-pack'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'right' => [
                            'title' => __('Right', 'th-widget-pack'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'condition' => [
                        'thmv_style' => ['style_1', 'style_2', 'style_3', 'style_4']
                    ],
                    'default' => '',
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

        /* STYLE - Price Divider */
        $this->add_control(
                'thmv_section_price_divider_heading',
                [
                    'label' => __('Price Divider', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'thmv_style' => ['style_5']
                    ],
                ]
        );

        $this->add_control(
                'thmv_price_divider_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'condition' => [
                        'thmv_style' => ['style_5']
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thmv-style-5 .thmv-price:before' => 'border-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'thmv_price_divider_size',
                [
                    'label' => __('Width', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thmv-style-5 .thmv-price:before' => 'border-left-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thmv_style' => ['style_5']
                    ],
                ]
        );
        /* STYLE - carousel */

        $this->add_control(
                'thmv_section_carousel_heading',
                [
                    'label' => __('Carousel', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
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
                        '{{WRAPPER}} .elementor-swiper-button' => 'color: {{VALUE}};',
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
                            'min' => 0,
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'thmv_style_section_link',
                [
                    'label' => __('Link', 'th-widget-pack'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'thmv_hide_link' => '',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => __('Typography', 'elementor'),
                    'name' => 'thmv_link_typography',
                    'selector' => '{{WRAPPER}} .elementor-row .thmv-btn',
                ]
        );
        $this->add_control(
                'thmv_link_color',
                [
                    'label' => __('Color', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-row .thmv-btn' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'thmv_link_background_color',
                [
                    'label' => __('Background', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-row .thmv-btn' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'thmv_link_color_hover',
                [
                    'label' => __('Color - Hover', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-row .thmv-btn:hover' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'thmv_link_background_color_hover',
                [
                    'label' => __('Background - Hover', 'th-widget-pack'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-row .thmv-btn:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
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
        $this->add_responsive_control(
                'thmv_button_stretch',
                [
                    'label' => __('Stretch Button', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    /*'condition' => [
                        'thmv_style' => ['style_1', 'style_4', 'style_5']
                    ],*/
                ]
        );

        $this->end_controls_section();
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

    private function getIconsFromThePost($icons) {
        $iconList = [];
        $i = 0;
        if (!empty($icons)) {
            foreach ($icons as $icon) {
                if (empty($icon['value']) && empty($icon['label']))
                    continue;
                if (!empty($icon['value'])) {
                    $iconList[$i]['thmv_icon'] = $icon;
                }
                if (!empty($icon['label'])) {
                    $iconList[$i]['thmv_icon_label'] = $icon['label'];
                }
                $i++;
            }
        }


        return $iconList;
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

    private function renderIcon($icon, $listingStyle) {
        ob_start();
        $tooltip = isset($icon['thmv_icon_label']) ? $icon['thmv_icon_label'] : '';
        if (isset($icon['thmv_icon'])) {
            ?>
            <div class="elementor-icon thmv-icon">
                <?php
                Icons_Manager::render_icon($icon['thmv_icon'], ['aria-hidden' => 'true', 'title' => $tooltip]);
                ?>

            </div>
            <?php
        }
        ?>

        <?php if (isset($icon['thmv_icon_label']) && in_array($listingStyle, array(1, 6))): ?>
            <span class="thmv-icon-label"><?php echo esc_html($icon['thmv_icon_label']); ?></span>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    private function renderSlider($settings, $images) {
        $slides = [];

        foreach ($images as $attachment) {
            $image_url = Group_Control_Image_Size::get_attachment_image_src($attachment['id'], $this->getImageKey(), $settings);
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

    private function getDescription($list) {
        $automatic_post_excerpts = 'on';
        if (function_exists('get_theme_mod')) {
            $automatic_post_excerpts = get_theme_mod('themo_automatic_post_excerpts', 'on');
        }
        if ($automatic_post_excerpts === 'off') {
            $th_tour_intro = apply_filters('the_content', get_the_content(null, false, $list));
        } else {
            $th_tour_intro = apply_filters('the_excerpt', get_the_excerpt($list));
        }

        return strip_tags($th_tour_intro); //maybe keep bold, italics
    }

    private function getImageFromPost($list) {
        // Get Project Format Options
        $imageArr = [];
        $alt = '';
        $th_imageId = get_post_meta(get_the_ID($list->ID), 'th_room_thumb', true);
        if (empty($th_imageId)) {
            $th_imageId = get_post_thumbnail_id($list->ID);
        }

        if (!empty($th_imageId)) {
            $th_image_url = wp_get_attachment_image_src($th_imageId);
        }

        if ($th_image_url) {
            $imageArr = ['url' => $th_image_url, 'id' => $th_imageId, 'alt' => $alt, 'source' => 'library'];
        }

        return $imageArr;
    }

    private function setupColumns($settings, $columnField, $attribute) {
        $this->add_render_attribute('thmv_column', 'class', 'thmv-column elementor-column');
        $cols = [$columnField, $columnField . '_tablet', $columnField . '_mobile'];
        foreach ($cols as $col) {
            if (isset($settings[$col])) {
                if (empty($settings[$col])) {
                    $colPercentage = 'default';
                } else {
                    $colPercentage = floor(100 / $settings[$col]);
                }

                $device = str_replace([$columnField, '_'], "", $col);
                $device .= strpos($col, '_') ? '-' : '';
                $this->add_render_attribute($attribute, 'class', 'thmv-column-' . $device . $colPercentage);
            }
        }
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

    private function getImageSizeInfo($settings, $imageKey) {

        $imgSize = $settings[$imageKey . '_size'];
        $dim = $settings[$imageKey . '_custom_dimension'];
        $image = isset($settings[$imageKey]) ? $settings[$imageKey] : false;
        $imageSizeInfo = array($this->getImageKey() => $image, $this->getImageKey() . '_size' => $imgSize, $this->getImageKey() . '_custom_dimension' => $dim);

        return $imageSizeInfo;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $dataSource = !empty($settings['thmv_data_source']) ? $settings['thmv_data_source'] : false;
        if ($dataSource) {
            $args = array();
            $individual = $dataSource === 'mphb_room_type' ? $settings['individual_mphb_room_type'] : $settings['individual'];
            if ($individual) {
                if (in_array('none', $individual)) {
                    $individual = array_diff($individual, array('none'));
                }
                if ($individual) {
                    $post_ids = $individual;
                    $args['post__in'] = $post_ids;
                }
            }
            if ($dataSource === 'themo_room_type') {
                $postType = 'themo_room';
            } else {
                $postType = $dataSource;
            }
            $args['post_type'] = $postType;

            $group = $dataSource === 'mphb_room_type' ? $settings['group_mphb_room_type'] : $settings['group'];
            $taxonomy = $dataSource === 'mphb_room_type' ? 'mphb_room_type_category' : 'themo_room_type';

            if ($group) {
                if (in_array('none', $group)) {
                    $group = array_diff($group, array('none'));
                }
                if ($group) {
                    $project_type_id = $group;
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => $taxonomy,
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
            $posts = get_posts($args);

            if (!$posts || !count($posts)) {
                echo '<div class="alert">';
                _e('Sorry, no results were found.', 'th-widget-pack');
                echo '</div>';
                return;
            }
        } else {
            if (!isset($settings['listings']) || !count($settings['listings'])) {
                return;
            }

            $posts = $settings['listings'];
        }

        /*         * global vars * */
        $buttonstyle = $settings['button_style'];
        $listingStyleDefault = $settings['thmv_style'];

        $highlightAlign = $settings['thmv_highlight_align'];
        $priceAlign = $settings['thmv_price_align'];

        $this->setupColumns($settings, 'columns', 'thmv_column');

        $listingStyle = str_replace('style_', '', $listingStyleDefault);
        $this->add_render_attribute('thmv_wrapper', 'class', 'elementor-row thmv-style-' . $listingStyle, true);

        if ($dataSource && !empty($settings['thmv_align_image'])) {
            $this->add_render_attribute('thmv_wrapper', 'class', 'image-alignment-' . $settings['thmv_align_image']);
        }
        echo '<div ' . $this->get_render_attribute_string('thmv_wrapper') . '>';

        foreach ($posts as $list) {

            $this->remove_render_attribute('thmv_link'); //reset
            if (empty($buttonstyle)) {
                $this->add_render_attribute('thmv_link', 'class', 'thmv-btn thmv-learn-btn', true);
            } else {
                $this->add_render_attribute('thmv_link', 'class', 'thmv-btn btn btn-1 th-btn btn-' . $buttonstyle, true);
            }

            $this->setupResponsiveControl($settings, 'thmv_button_stretch', 'thmv_link', 'streched');

            if ($dataSource) {
                // get post format
                $format = get_post_format($list);
                if (false === $format) {
                    $format = '';
                }

                // default settings
                $imageSizeInfo = $this->getImageSizeInfo($settings, 'thmv_data_source_image');

                $carousel_switcher = false;
                $carouselImages = [];
                $tempImages = get_post_meta($list->ID, 'th_gallery', true);

                if (!empty($tempImages)) {
                    $carousel_switcher = true;
                    $tempImagesArr = explode(",", $tempImages);
                    foreach ($tempImagesArr as $imgId) {
                        $url = wp_get_attachment_image_url($imgId);
                        $imgArr = ['id' => $imgId, 'url' => $url];
                        $carouselImages[] = $imgArr;
                    }
                }
                $renderedImage = '';
                if (!$carousel_switcher) {
                    $image = $this->getImageFromPost($list);
                    if (count($image)) {
                        $tempKey = $this->getImageKey();
                        $imageSizeInfo[$tempKey] = $image;
                        $renderedImage = Group_Control_Image_Size::get_attachment_image_html($imageSizeInfo, $this->getImageKey());
                    }
                }

                $showImgesRightSide = $settings['thmv_align_image'];

                $preface = get_post_meta($list->ID, 'th_room_intro', true);
                $highlight = get_post_meta($list->ID, 'th_room_highlight', true);

                $titleOverride = get_post_meta($list->ID, 'th_room_title', true);
                $title = !empty($titleOverride) ? $titleOverride : get_the_title($list);

//                $titleSeparator = $list['thmv_title_separator'];

                $description = $this->getDescription($list);
                $link_url = get_the_permalink($list);
                $this->add_render_attribute('thmv_link', 'href', esc_url($link_url), true);

                $price = get_post_meta($list->ID, 'th_room_price', true);
                $price_before = get_post_meta($list->ID, 'th_room_price_before', true);

                $price_after = get_post_meta($list->ID, 'th_room_price_per', true);
                $link_text = get_post_meta($list->ID, 'th_room_button_text', true);
                if (empty($link_text)) {
                    $link_text = __('Learn More', 'th-widget-pack');
                }

                $iconsTemp = get_post_meta($list->ID, 'th_room_icons', true);

                $icons = $this->getIconsFromThePost($iconsTemp);

                $showStars = false;
                $tempStarsRating = get_post_meta($list->ID, 'th_room_rating', true);
                $starsRating = false;
                if (!empty($tempStarsRating) && $tempStarsRating > 0) {
                    $showStars = true;
                    $starsRating['size'] = $tempStarsRating;
                }
                $showLocation = false;
                $locationText = get_post_meta($list->ID, 'th_room_location', true);
                $locationIcon = ['value' => 'fas fa-map-marker-alt', 'library' => 'fa-solid'];
                if (!empty($locationText)) {
                    $showLocation = true;
                }
                $locationLink = get_post_meta($list->ID, 'th_room_location_link', true);
                if (!empty($locationLink)) {
                    $this->add_render_attribute('thmv_location_link', 'href', esc_url($locationLink));
                    $this->add_render_attribute('thmv_location_link', 'target', '_blank', true);
                }


//                $icons = $this->getIcons($list);
            } else {

                $imageSizeInfo = $this->getImageSizeInfo($list, $this->getImageKey());
                $renderedImage = Group_Control_Image_Size::get_attachment_image_html($list, $this->getImageKey());

                $carousel_switcher = $list['thmv_carousel_switcher'] == 'yes' ? true : false;
                $carouselImages = $list['thmv_carousel'];

                $preface = $list['thmv_preface'];
                $highlight = $list['thmv_highlight'];

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
                $locationLink = isset($list['thmv_location_link']['url']) ? $list['thmv_location_link']['url'] : false;
                $icons = $this->getIcons($list);

                $showImgesRightSide = isset($list['thmv_align_image_right']) && $list['thmv_align_image_right'] == 'yes';

                if (!empty($link_url)) {
                    $this->add_render_attribute('thmv_link', 'href', esc_url($link_url), true);
                    if (!empty($list['thmv_link']['is_external'])) {
                        $this->add_render_attribute('thmv_link', 'target', '_blank', true);
                    }
                    if (!empty($list['thmv_link']['nofollow'])) {
                        $this->add_render_attribute('thmv_link', 'rel', 'nofollow', true);
                    }
                }
                if (!empty($locationLink)) {
                    $this->add_render_attribute('thmv_location_link', 'href', esc_url($locationLink), true);
                    if (!empty($list['thmv_location_link']['is_external'])) {
                        $this->add_render_attribute('thmv_location_link', 'target', '_blank', true);
                    }
                    if (!empty($list['thmv_location_link']['nofollow'])) {
                        $this->add_render_attribute('thmv_location_link', 'rel', 'nofollow', true);
                    }
                }
            }
            ?>


            <?php
            ob_start();
            if (!empty($price_before) || !empty($price) || !empty($price_after)):
                ?>

                <div class="thmv-price <?= $priceAlign ?>">
                    <?php if (!empty($price_before)): ?>
                        <div class="price-before"><?= $price_before ?><?= (!empty($price) ? '&nbsp;' : '') ?></div>
                    <?php endif; ?>
                    <?php if (!empty($price)): ?>
                        <div class="price"><?= $price ?></div>
                    <?php endif; ?>
                    <?php if (!empty($price_after)): ?>
                        <div class="price-after"><?= $price_after ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php $priceBlock = ob_get_clean(); ?>

            <?php
            ob_start();

            if (count($icons)) {


                $this->add_render_attribute('thmv_iconList', 'class', 'thmv-icons', true);
                if (in_array($listingStyle, array(2, 3, 6))) {
                    $this->add_render_attribute('thmv_iconList', 'class', 'thmv-grid-facility');
                } else {
                    $this->add_render_attribute('thmv_iconList', 'class', 'thmv-list');
                }
                ?>
                <ul <?php echo $this->get_render_attribute_string('thmv_iconList'); ?>>
                    <?php
                    foreach ($icons as $icon):
                        echo '<li>' . $this->renderIcon($icon, $listingStyle) . '</li>';
                        ?>   
                    <?php endforeach; ?>
                </ul>

                <?php
            }
            $iconsList = ob_get_clean();
            ?>


            <div <?php echo $this->get_render_attribute_string('thmv_column'); ?>>
                <div class="elementor-widget-wrap">
                    <?php
                    if ($dataSource) {
                        $imageAlignment = $showImgesRightSide ? 'image-column-' . $showImgesRightSide : '';
                    } else {
                        $imageAlignment = $showImgesRightSide ? 'image-column-right ' : '';
                    }
                    ?>
                    <div class="thmv-grid <?= $imageAlignment ?> elementor-element">
                        <div class="thmv-grid-img">
            <?php if (!$carousel_switcher && !empty($renderedImage)): ?>
                                <?php echo $renderedImage; ?>
                            <?php endif; ?>

                            <?php
                            if ($carousel_switcher && is_array($carouselImages)):
                                $this->renderSlider($imageSizeInfo, $carouselImages);
                            endif;
                            ?>  

                            <?php if (!in_array($listingStyle, [3]) && !empty($highlight)): ?>
                                <div class="thmv-top-box <?= $highlightAlign ?>"><span><?= $highlight ?></span></div>
                            <?php endif; ?>

                            <?php if (in_array($listingStyle, [1, 2, 3, 4])): ?>    
                                <?php echo $priceBlock; ?>
                            <?php endif; ?>     
                        </div>

            <?php if (in_array($listingStyle, array(2))): ?>
                            <div class="thmv-grid-sleep">
                            <?php if (!empty($preface)): ?>
                                    <div class="thmv-preface"><?= $preface ?></div>
                                <?php endif; ?>
                                <?= $iconsList ?>
                            </div>
                            <?php endif;
                            ?>
                        <div class="thmv-info">

            <?php if (($showStars || $showLocation) && in_array($listingStyle, array(1, 5))): ?>
                                <div class="thmv-grid-rating">
                                <?php if ($showStars && isset($starsRating['size']) && $starsRating['size'] > 0): ?>
                                        <ul class="thmv-star-rating">
                                        <?php
                                        $size = floor($starsRating['size']);
                                        $halfStar = strpos($starsRating['size'], '.') ? true : false;

                                        for ($i = 0; $i < $size; $i++):
                                            ?>
                                                <li><i aria-hidden="true" class="fas fa-star"></i></li>
                                                <?php
                                                if ($i == ($size - 1) && $halfStar) {
                                                    ?>
                                                    <li><i aria-hidden="true" class="fas fa-star-half"></i></li>
                                                    <?php
                                                }
                                            endfor;
                                            ?>
                                            <?php ?>      
                                            <li><?= number_format((float) $starsRating['size'], 1, '.', ''); ?></li>
                                        </ul>
                <?php endif; ?>

                                    <?php
                                    if ($showLocation):

                                        $linkPrefix = $linkPostfix = $locationIconHTML = '';
                                        if ($locationIcon) {
                                            ob_start();
                                            Icons_Manager::render_icon($locationIcon, ['aria-hidden' => 'true']);
                                            $locationIconHTML = ob_get_clean();
                                        }
                                        if ($locationLink) {
                                            $linkPrefix = '<a ' . $this->get_render_attribute_string('thmv_location_link') . '>';
                                            $linkPostfix = '</a>';
                                        }
                                        if ($locationText || $locationIconHTML):
                                            ?>
                                            <ul class="thmv-location">
                                            <?php if (!empty($locationIconHTML)) : ?><li class="location-icon"><?= $linkPrefix ?><?php echo $locationIconHTML; ?><?= $linkPostfix ?></li> <?php endif; ?>
                                                <?php if ($locationText) : ?><li class="location"><?= $linkPrefix ?><?= $locationText ?><?= $linkPostfix ?></li><?php endif; ?>
                                            </ul>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            <?php if (in_array($listingStyle, [3]) && !empty($highlight)): ?>
                                <div class="thmv-top-box"><span><?= $highlight ?></span></div>
                            <?php endif; ?>
                            <?php if (!empty($title)): ?>
                                <h3 class="thmv-title"><?= esc_html($title) ?></h3>
                            <?php endif; ?>
                            <?php if (in_array($listingStyle, array(6)) && $titleSeparator): ?>    
                                <hr class="thmv-separator">
                            <?php endif; ?>    
                            <?php if (in_array($listingStyle, array(3, 4))): ?>    
                                <?php if (!empty($preface)): ?>
                                    <div class="thmv-preface"><?= $preface ?></div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($description)): ?>
                                <p class="thmv-description"><?= esc_html($description) ?></p>
                            <?php endif; ?>

                            <?php
                            if (in_array($listingStyle, array(1, 6))):
                                ?>
                                <?= $iconsList ?>
                                <?php
                            endif;
                            ?>
                            <?php if (in_array($listingStyle, [5])): ?>    
                                <?php echo $priceBlock; ?>
                            <?php endif; ?>   

                            <div class="<?= ($listingStyle == 6 ? 'thmv-grid-booking' : '') ?>">
            <?php if (!empty($link_url)) : ?>
                                    <div>
                                        <a <?php echo $this->get_render_attribute_string('thmv_link'); ?>>
                <?= isset($link_text) ? $link_text : '' ?>
                                            <?php
                                            if (in_array($listingStyle, array(2, 3)) && empty($buttonstyle)):
                                                echo '<i class="fas fa-plus"></i>';
                                                ?>

                                            <?php endif; ?>
                                        </a>
                                    </div>
            <?php endif; ?>
                                <?php if (in_array($listingStyle, [6])): ?>    
                                    <?php echo $priceBlock; ?>
                                <?php endif; ?> 
                            </div>

            <?php if (in_array($listingStyle, array(3))): ?>
                                <?= $iconsList ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>


            <?php
        }

        echo '</div>';

        if ($dataSource) {
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
