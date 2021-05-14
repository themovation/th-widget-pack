<?php

// Adding Custom Icons for Icon Control
if('embark' == THEMO_CURRENT_THEME || 'bellevue' == THEMO_CURRENT_THEME ){
    require_once THEMO_PATH . 'fields/icons.php' ;
}elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME){
    require_once THEMO_PATH . 'fields/stratus_icons.php' ;
}elseif('uplands' == THEMO_CURRENT_THEME){
    require_once THEMO_PATH . 'fields/golf_icons.php' ;
}else{
    require_once THEMO_PATH . 'fields/icons.php' ;
}

require_once THEMO_PATH . 'inc/helper-functions.php' ;

if ( ! function_exists( 'themovation_elements' ) ) {
    function themovation_elements()
    {
        require_once THEMO_PATH . 'elements/slider.php';
        require_once THEMO_PATH . 'elements/header.php';
        require_once THEMO_PATH . 'elements/button.php';
        require_once THEMO_PATH . 'elements/call-to-action.php';
        require_once THEMO_PATH . 'elements/testimonial.php';
        require_once THEMO_PATH . 'elements/service-block.php';
        require_once THEMO_PATH . 'elements/formidable-form.php';
        require_once THEMO_PATH . 'elements/info-card.php';

        if('bellevue' == THEMO_CURRENT_THEME ){
            require_once THEMO_PATH . 'elements/team_2.php';
        }else{
            require_once THEMO_PATH . 'elements/team.php';
        }

        if('embark' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME || 'uplands' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/appointments.php';
        }elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/appointments.php';
        }

        if('embark' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/tour-grid.php';
        }elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/portfolio-grid.php';
        }elseif('bellevue' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/room-grid.php';
        }elseif('uplands' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/course-guide.php';
        }


        if('embark' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/tour-info.php';
        }elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME || 'uplands' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/info-bar.php';
        }elseif('bellevue' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/room-info.php';
        }

        if('bellevue' == THEMO_CURRENT_THEME ){
            require_once THEMO_PATH . 'elements/package_2.php';
        }else{
            require_once THEMO_PATH . 'elements/package.php';
        }


        if('embark' == THEMO_CURRENT_THEME || 'bellevue' == THEMO_CURRENT_THEME ){
            require_once THEMO_PATH . 'elements/itinerary.php';
        }elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME || 'uplands' == THEMO_CURRENT_THEME){
            require_once THEMO_PATH . 'elements/expand-list.php';
        }

        require_once THEMO_PATH . 'elements/pricing.php';
        if('uplands' == THEMO_CURRENT_THEME || 'bellevue' == THEMO_CURRENT_THEME) {
            require_once THEMO_PATH . 'elements/pricing-list.php';
            require_once THEMO_PATH . 'elements/image-carousel-timeline.php';
        }
        require_once THEMO_PATH . 'elements/blog.php';
        require_once THEMO_PATH . 'elements/image-gallery.php';
        require_once THEMO_PATH . 'elements/google-maps.php';

        if('bellevue' == THEMO_CURRENT_THEME){
            // Check if the MotoPress Hotel Booking is active
            if (class_exists('HotelBookingPlugin')) {
                require_once THEMO_PATH . 'elements/MPHB/mphb_accommodation_grid.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_availability_calendar.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_booking_form.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_accommodation_details.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_accommodation_rates.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_service_details.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_search_form.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_search_results.php';
                require_once THEMO_PATH . 'elements/MPHB/mphb_checkout_form.php';
            }
            if (function_exists('wpbs_menu')) {
                require_once THEMO_PATH . 'elements/WPBS/wp-booking-system.php';
            }
        }
    }
}


// Include Custom Widgets
add_filter( 'elementor/widgets/widgets_registered', 'themovation_elements' );

function th_check_some_other_plugin() {
    include_once(ABSPATH.'wp-admin/includes/plugin.php');



    if ( is_user_logged_in() && ( ENABLE_BLOCK_LIBRARY === true ) && get_option( "theme_is_registered_stratusx", false ) ) {
        include_once THEMO_PATH . 'library/library-manager.class.php' ;
        include_once THEMO_PATH . 'library/library-source.class.php' ;
    }elseif( is_user_logged_in() && ( ENABLE_BLOCK_LIBRARY === true ) && ('bellevue' == THEMO_CURRENT_THEME && get_option( "theme_is_registered_bellevuex", false ))){
        include_once THEMO_PATH . 'library/library-manager.class.php' ;
        include_once THEMO_PATH . 'library/library-source.class.php' ;
    }

    if (!function_exists('is_plugin_active') || !is_plugin_active( 'wpml-translation-management/plugin.php') || !is_plugin_active( 'wpml-string-translation/plugin.php')) {
        return;
    }
    require_once THEMO_PATH . 'languages/wpml-translations.php' ;
}
add_action( 'plugins_loaded', 'th_check_some_other_plugin' );


// Include scripts, custom post type, shortcodes
// Older version of Elementor (older than version 2) use the old grouping.
if(defined('ELEMENTOR_PATH') && intval('2') > intval(ELEMENTOR_VERSION) ){
    require_once THEMO_PATH . 'inc/elementor-section-old.php';
}else{
    require_once THEMO_PATH . 'inc/elementor-section.php';
}
require_once THEMO_PATH . 'inc/enqueue.php';

if('embark' == THEMO_CURRENT_THEME){
    require_once THEMO_PATH . 'inc/cpt_tours.php' ;
}elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME){
    require_once THEMO_PATH . 'inc/cpt_portfolio.php' ;
}elseif('bellevue' == THEMO_CURRENT_THEME){
    require_once THEMO_PATH . 'inc/cpt_room.php' ;
    if (class_exists('HotelBookingPlugin')) {
        require_once THEMO_PATH . 'inc/MPHB/cpt_mphb_room_type.php';
    }
}elseif('uplands' == THEMO_CURRENT_THEME){
    require_once THEMO_PATH . 'inc/cpt_hole.php' ;
}

require_once THEMO_PATH . 'inc/shortcodes.php' ;


// GLOBAL VARIABLES
global $th_map_id;
$th_map_id = 0;

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

        // Disable global lightbox by default.
        update_option('elementor_global_image_lightbox', '');

        // Check for our custom post type, if it's not included, include it.
        $elementor_cpt_support = get_option('elementor_cpt_support');
        if (empty($elementor_cpt_support)) {
            $elementor_cpt_support = array();
        }

        if (!in_array("page", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"page");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("post", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"post");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("themo_tour", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"themo_tour");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("themo_portfolio", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"themo_portfolio");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("themo_room", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"themo_room");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("mphb_room_type", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"mphb_room_type");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("mphb_room_service", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"mphb_room_service");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("themo_hole", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"themo_hole");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

        if (!in_array("product", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"product");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }
        // Enable Elementor Support for HFE
        if (!in_array("elementor-thhf", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"elementor-thhf");
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

        if('embark' == THEMO_CURRENT_THEME){
            // Regsiter Custom Post Types
            themo_tour_custom_post_type();

            // Register Custom Taxonomy
            themo_tour_type();
        }elseif('stratus' == THEMO_CURRENT_THEME || 'pursuit' == THEMO_CURRENT_THEME || 'blockchain' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME){
            // Regsiter Custom Post Types
            themo_portfolio_custom_post_type();

            // Register Custom Taxonomy
            themo_project_type();
        }elseif('bellevue' == THEMO_CURRENT_THEME){
            // Regsiter Custom Post Types
            themo_room_custom_post_type();

            // Register Custom Taxonomy
            themo_room_type();
        }elseif('uplands' == THEMO_CURRENT_THEME){
            // Regsiter Custom Post Types
            themo_hole_custom_post_type();

            // Register Custom Taxonomy
            themo_hole_type();
        }



        // clear the permalinks after the post type has been registered
        flush_rewrite_rules();
    }
}
register_activation_hook( THEMO__FILE__, 'themovation_so_widgets_bundle_install' );


// Add custom controls to the Page Settings inside the Elementor Global Options.

// Top of section
if ( ! function_exists( 'th_add_custom_controls_elem_post_settings_top' ) ) {

    function th_add_custom_controls_elem_post_settings_top(Elementor\Core\DocumentTypes\PageBase $page)
    {
        // Is elementor Pro loaded
        $elm_pro_loaded = false;
        if( function_exists( 'elementor_pro_load_plugin' ) ) {
            $elm_pro_loaded = true;
        }


        if(isset($page) && $page->get_id() > ""){
            $th_post_type = false;

            $th_post_type = get_post_type($page->get_id());

            if($th_post_type == 'page' || $th_post_type == 'themo_tour' || $th_post_type == 'themo_portfolio' ||
                $th_post_type == 'themo_room' || $th_post_type == 'themo_hole' || $th_post_type == 'mphb_room_type'||
                $th_post_type == 'mphb_room_service' || ($elm_pro_loaded && $th_post_type == 'post')  || ($elm_pro_loaded && $th_post_type == 'revision')){

                // Standard Header Options
                $page->start_controls_section(
                    'thmv_doc_settings_header',
                    [
                        'label' => __( 'Standard Header', 'molotov-form' ),
                        'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    ]
                );

                $page->add_control(
                    'important_note',
                    [
                        //'label' => __( 'Note', 'th-widget-pack' ),
                        'type' => \Elementor\Controls_Manager::RAW_HTML,
                        'raw' => '<div class="elementor-control-title">'.esc_html__('Applies to Standard Header only.', 'th-widget-pack').'</div><div class="elementor-control-field-description">' . sprintf(__('<a href="%1$s" target="_blank">Learn more</p>', 'th-widget-pack'), 'https://themovation.helpscoutdocs.com/article/311-custom-header-footer#standard-header-footer') . '</div>',
                        'content_classes' => 'themo-elem-html-control',
                        'separator' => 'before'
                    ]
                );

                $page->add_control(
                    'themo_transparent_header',
                    [
                        'label' => __( 'Transparent Header', 'th-widget-pack' ),
                        'type' => Elementor\Controls_Manager::SWITCHER,
                        'default' => 'Off',
                        'label_on' => __( 'On', 'th-widget-pack' ),
                        'label_off' => __( 'Off', 'th-widget-pack' ),
                        'return_value' => 'on',
                    ]
                );

                $page->add_control(
                    'themo_header_content_style',
                    [
                        'label' => __( 'Transparent Header Content Style', 'th-widget-pack' ),
                        'type' => Elementor\Controls_Manager::SELECT,
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

                $page->add_control(
                    'themo_alt_logo',
                    [
                        'label' => __( 'Use Alternative Logo', 'th-widget-pack' ),
                        'description' => __( 'You can upload an alternative logo under Appearance / Customize / Theme Options / Logo / ', 'th-widget-pack' ),
                        'type' => Elementor\Controls_Manager::SWITCHER,
                        'default' => 'Off',
                        'label_on' => __( 'On', 'th-widget-pack' ),
                        'label_off' => __( 'Off', 'th-widget-pack' ),
                        'return_value' => 'on',
                        'condition' => [
                            'themo_transparent_header' => 'on',
                        ],
                    ]
                );


                $page->add_control(
                    'themo_header_hide_shadow',
                    [
                        'label' => __( 'Hide Header Shadow', 'th-widget-pack' ),
                        'type' => Elementor\Controls_Manager::SWITCHER,
                        'label_off' => __( 'No', 'elementor' ),
                        'label_on' => __( 'Yes', 'elementor' ),

                        'selectors' => [
                            '{{WRAPPER}} .navbar-default' => 'border: none',
                        ],
                    ]
                );

                $page_title_selector = get_option( 'elementor_page_title_selector' );
                if ( empty( $page_title_selector ) ) {
                    $page_title_selector = 'h1.entry-title';
                }


                $page->add_control(
                    'themo_page_title_margin',
                    [
                        'label' => __( 'Title  Margin', 'th-widget-pack' ),
                        'type' => Elementor\Controls_Manager::SLIDER,
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
                        'dynamic' => [
                            'active' => true,
                        ],
                    ]
                );
                $page->end_controls_section();
            }

            if ($th_post_type == 'page' || $th_post_type == 'themo_tour' || $th_post_type == 'themo_portfolio'
                || $th_post_type == 'themo_room' || $th_post_type == 'themo_hole' || $th_post_type == 'mphb_room_type'
                || $th_post_type == 'mphb_room_service') {

                // Standard Header Options
                $page->start_controls_section(
                    'thmv_doc_settings_sidebar',
                    [
                        'label' => __( 'Sidebar', 'molotov-form' ),
                        'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    ]
                );

                $page->add_control(
                    'themo_page_layout',
                    [
                        'label' => __( 'Sidebar', 'th-widget-pack' ),
                        'type' => Elementor\Controls_Manager::CHOOSE,
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

                $page->end_controls_section();
            }
        }

    }
}


add_action( 'elementor/element/wp-post/document_settings/before_section_start', 'th_add_custom_controls_elem_post_settings_top',10, 2);
add_action( 'elementor/element/wp-page/document_settings/before_section_start', 'th_add_custom_controls_elem_post_settings_top',10, 2);

// Add Parallax Control (Switch) to Section Element in the Editor.
function add_elementor_section_background_controls( Elementor\Element_Section $section ) {

    $section->add_control(
        'th_section_parallax',
        [
            'label' => __( 'Parallax', 'th-widget-pack' ),
            'type' => Elementor\Controls_Manager::SWITCHER,
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'default' => 'no',
        ]
    );
}

add_action( 'elementor/element/section/section_background/before_section_end', 'add_elementor_section_background_controls' );

// Render section backgrou]d parallax
function render_elementor_section_parallax_background( Elementor\Element_Base $element ) {

    if('section' === $element->get_name()){

        if ( 'yes' === $element->get_settings_for_display( 'th_section_parallax' ) ) {

            $th_background = $element->get_settings_for_display( 'background_image' );
            $th_background_URL = $th_background['url'];

            $element->add_render_attribute( '_wrapper', [
                'class' => 'th-parallax',
                'data-parallax' => 'scroll',
                'data-image-src' => $th_background_URL,
            ] ) ;
        }

    }
}

add_action( 'elementor/frontend/section/before_render', 'render_elementor_section_parallax_background' );


// Future use - Get parallax working in Live Preview.
// https://github.com/pojome/elementor/issues/2588
/*add_action( 'elementor/element/print_template', function( $template, $element ) {
    if ( 'section' === $element->get_name() ) {
        echo '<pre>';
        echo 'OVERHERE';
        echo print_r($element);
        echo print_r($template);
        echo '</pre>';
        //$old_template = '<a href="\' + settings.link.url + \'">\' + title_html + \'</a>';
        //$new_template = '<a href="\' + settings.link.url + \'">\' + title_html + ( settings.link.is_external ? \'<i class="fa fa-external-link" aria-hidden="true"></i>\' : \'\' ) + \'</a>';
        $template = str_replace( 'data-id', 'data-id-zzz', $template );
    }

    return $template;
}, 10, 2 );*/



// Adding custom icons to icon control in Elementor
function th_add_custom_icons_tab( $tabs = array() ) {

    $trip_icons = array_values(array_filter(themo_icons(), function ($key) {return strpos($key, 'th-trip') === 0;}, ARRAY_FILTER_USE_KEY));
    $linea_icons = array_values(array_filter(themo_icons(), function ($key) {return strpos($key, 'th-linea') === 0;}, ARRAY_FILTER_USE_KEY));
    $golf_icons = array_values(array_filter(themo_icons(), function ($key) {return strpos($key, 'th-golf') === 0;}, ARRAY_FILTER_USE_KEY));

	if (!empty($trip_icons)) {
        $tabs['th-trip'] = array(
            'name'          => 'th-trip',
            'label'         => __( 'Themovation Trip', 'th-widget-pack' ),
            'labelIcon'     => 'fas fa-icons',
            'prefix'        => 'th-trip travelpack-',
            'displayPrefix' => 'th-trip travelpack',
            'url'           => THEMO_ASSETS_URL . 'icons/icons.css',
            'icons'         => $trip_icons,
            'ver'           => THEMO_VERSION,
        );
    }

    if (!empty($linea_icons)) {
        $tabs['th-linea'] = array(
            'name'          => 'th-linea',
            'label'         => __( 'Themovation Linea', 'th-widget-pack' ),
            'labelIcon'     => 'fas fa-icons',
            'prefix'        => 'th-linea icon-',
            'displayPrefix' => 'th-linea icon',
            'url'           => THEMO_ASSETS_URL . 'icons/icons.css',
            'icons'         => $linea_icons,
            'ver'           => THEMO_VERSION,
        );
    }
    
    if (!empty($golf_icons)) {
        $tabs['th-golf'] = array(
            'name'          => 'th-golf',
            'label'         => __( 'Themovation Golf', 'th-widget-pack' ),
            'labelIcon'     => 'fas fa-icons',
            'prefix'        => 'th-golf golfpack-',
            'displayPrefix' => 'th-golf golfpack',
            'url'           => THEMO_ASSETS_URL . 'icons/golf_icons.css',
            'icons'         => $golf_icons,
            'ver'           => THEMO_VERSION,
        );
    }



	return $tabs;
}

add_filter( 'elementor/icons_manager/additional_tabs', 'th_add_custom_icons_tab' );


