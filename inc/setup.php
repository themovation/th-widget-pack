<?php

// Adding Custom Icons for Icon Control
require_once THEMO_PATH . 'fields/icons.php' ;
require_once THEMO_PATH . 'inc/helper-functions.php' ;


if ( ! function_exists( 'themovation_elements' ) ) {
    function themovation_elements()
    {
        require_once THEMO_PATH . 'elements/team.php';
        require_once THEMO_PATH . 'elements/package.php';
        require_once THEMO_PATH . 'elements/appointments.php';
        require_once THEMO_PATH . 'elements/blog.php';
        require_once THEMO_PATH . 'elements/tour-grid.php';
        require_once THEMO_PATH . 'elements/slider.php';
        require_once THEMO_PATH . 'elements/pricing.php';
        require_once THEMO_PATH . 'elements/formidable-form.php';
        require_once THEMO_PATH . 'elements/tour-info.php';
        require_once THEMO_PATH . 'elements/button.php';
        require_once THEMO_PATH . 'elements/call-to-action.php';
        require_once THEMO_PATH . 'elements/itinerary.php';
        require_once THEMO_PATH . 'elements/google-maps.php';
        require_once THEMO_PATH . 'elements/testimonial.php';
        require_once THEMO_PATH . 'elements/image-gallery.php';
        require_once THEMO_PATH . 'elements/header.php';
        require_once THEMO_PATH . 'elements/info-card.php';
        require_once THEMO_PATH . 'elements/service-block.php';
    }
}
// Include Custom Widgets
add_filter( 'elementor/widgets/widgets_registered', 'themovation_elements' );

// Include scripts, custom post type, shortcodes
require_once THEMO_PATH . 'inc/elementor-section.php';
require_once  THEMO_PATH . 'inc/enqueue.php';
require_once THEMO_PATH . 'inc/cpt_tours.php' ;
require_once THEMO_PATH . 'inc/shortcodes.php' ;

// GLOBAL VARIABLES
// global $th_map_id;
// $th_map_id = 0;

// When plugin is installed for the first time, set global elementor settings.

if ( ! function_exists( 'themovation_so_widgets_bundle_setup_elementor_settings' ) ) {
    function themovation_so_widgets_bundle_setup_elementor_settings()
    {

        // Disable color schemes
        $elementor_disable_color_schemes = get_option('elementor_disable_color_schemes');
        if (empty($elementor_disable_color_schemes)) {
            update_option('elementor_disable_color_schemes', 'yes');
        }

        // Disable typography schemes
        $elementor_disable_typography_schemes = get_option('elementor_disable_typography_schemes');
        if (empty($elementor_disable_typography_schemes)) {
            update_option('elementor_disable_typography_schemes', 'yes');
        }

        // Check for our custom post type, if it's not included, include it.
        $elementor_cpt_support = get_option('elementor_cpt_support');
        if (empty($elementor_cpt_support)) {
            $elementor_cpt_support = array();
        }

        if (!in_array("themo_tour", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"themo_tour");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("page", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"page");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("post", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"post");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

    }
}

// on plugin Activaton, set Elementor Global Options and register Custom Post Types.

if ( ! function_exists( 'themovation_so_widgets_bundle_install' ) ) {
    function themovation_so_widgets_bundle_install()
    {
        // trigger our function that sets up Elementor Global Settings
        themovation_so_widgets_bundle_setup_elementor_settings();

        // Regsiter Custom Post Types
        themo_tour_custom_post_type();

        // Register Custom Taxonomy
        themo_tour_type();

        // clear the permalinks after the post type has been registered
        flush_rewrite_rules();
    }
}
register_activation_hook( THEMO__FILE__, 'themovation_so_widgets_bundle_install' );


// Add custom controls to the Page Settings inside the Elementor Global Options.

// Top of section
if ( ! function_exists( 'th_add_custom_controls_elem_page_settings_top' ) ) {
    function th_add_custom_controls_elem_page_settings_top($element, $args)
    {

        $element->add_control(
            'themo_transparent_header',
            [
                'label' => __( 'Transparent Header', 'th-widget-pack' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'On', 'th-widget-pack' ),
                'label_off' => __( 'Off', 'th-widget-pack' ),
                'return_value' => 'on',
            ]
        );

        $element->add_control(
            'themo_header_content_style',
            [
                'label' => __( 'Transparent Header Content Style', 'th-widget-pack' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => 'light',
                'options' => [
                    'light' => __( 'Light', 'th-widget-pack' ),
                    'dark' => __( 'Dark', 'th-widget-pack' ),
                ],
                'condition' => [
                    'themo_transparent_header' => 'on',
                ],
            ]
        );

        $element->add_control(
            'themo_alt_logo',
            [
                'label' => __( 'Use Alternative Logo', 'th-widget-pack' ),
                'description' => __( 'You can upload an alternative logo under Appearance / Customize / Theme Options / Logo / ', 'th-widget-pack' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'Off',
                'label_on' => __( 'On', 'th-widget-pack' ),
                'label_off' => __( 'Off', 'th-widget-pack' ),
                'return_value' => 'on',
                'condition' => [
                    'themo_transparent_header' => 'on',
                ],
            ]
        );

        $page_title_selector = get_option( 'elementor_page_title_selector' );
        if ( empty( $page_title_selector ) ) {
            $page_title_selector = 'h1.entry-title';
        }

        $element->add_control(
            'themo_page_title_margin',
            [
                'label' => __( 'Title  Margin', 'th-widget-pack' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $page_title_selector => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

    }
}
// Bottom of section
if ( ! function_exists( 'th_add_custom_controls_elem_page_settings_bottom' ) ) {
    function th_add_custom_controls_elem_page_settings_bottom($element, $args)
    {

        $element->add_control(
            'themo_page_layout',
            [
                'label' => __( 'Sidebar', 'th-widget-pack' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'full',
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'fa fa-long-arrow-left',
                    ],
                    'full' => [
                        'title' => __( 'No Sidebar', 'th-widget-pack' ),
                        'icon' => 'fa fa-times',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'fa fa-long-arrow-right',
                    ],

                ],
                'return_value' => 'yes',
            ]
        );
    }
}
add_action( 'elementor/element/page-settings/section_page_settings/after_section_start', 'th_add_custom_controls_elem_page_settings_top',10, 2);
add_action( 'elementor/element/page-settings/section_page_settings/before_section_end', 'th_add_custom_controls_elem_page_settings_bottom',10, 2);
