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

if ( ! function_exists( 'th_add_custom_controls_elem_page_settings' ) ) {
    function th_add_custom_controls_elem_page_settings($element, $args)
    {
        $element->add_control(
            'themo_transparent_header',
            [
                'label' => __( 'Transparent Header', 'your-plugin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'On', 'your-plugin' ),
                'label_off' => __( 'Off', 'your-plugin' ),
                'return_value' => 'on',
            ]
        );

        $element->add_control(
            'themo_page_layout',
            [
                'label' => __( 'Sidebar', 'your-plugin' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'full',
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'your-plugin' ),
                        'icon' => 'fa fa-long-arrow-left',
                    ],
                    'full' => [
                        'title' => __( 'No Sidebar', 'your-plugin' ),
                        'icon' => 'fa fa-times',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'your-plugin' ),
                        'icon' => 'fa fa-long-arrow-right',
                    ],

                ],
                'return_value' => 'yes',
            ]
        );
    }
}
add_action( 'elementor/element/page-settings/section_page_settings/before_section_end', 'th_add_custom_controls_elem_page_settings',10, 2);
