<?php
/**
 * Plugin Name: Themovation SiteOrigin Widgets Bundle
 * Version: 1.0.0
 * Plugin URI: themovation.com
 * Description: A collection of widgets
 * Author: Themovation
 * Author URI: themovation.com
 * Text Domain: themovation-widgets
 * Domain Path: /languages/
 * License: GPL v3
 */


define('THEMO_VERSION', '1.0.0');

define( 'THEMO__FILE__', __FILE__ );
define( 'THEMO_PLUGIN_BASE', plugin_basename( THEMO__FILE__ ) );
define( 'THEMO_URL', plugins_url( '/', THEMO__FILE__ ) );
define( 'THEMO_PATH', plugin_dir_path( THEMO__FILE__ ) );
define( 'THEMO_ASSETS_URL', THEMO_URL . 'assets/' );


/*
echo "<br>".THEMO__FILE__;
echo "<br>".THEMO_PLUGIN_BASE;
echo "<br>".THEMO_URL;
echo "<br>".THEMO_ASSETS_URL;
echo "<br>".THEMO_PATH;
*/

require_once( 'fields/icons.php' );

function themovation_elements() {
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
add_filter( 'elementor/widgets/widgets_registered', 'themovation_elements' );

require_once ( 'inc/elementor-section.php' );

if ( ! function_exists( 'themovation_so_wb_translation' ) ) :
// Making the plugin translation ready
function themovation_so_wb_translation() {
	load_plugin_textdomain( 'themovation-widgets', false, THEMO_PLUGIN_BASE  . '/languages/' );
}
endif;
add_action( 'plugins_loaded', 'themovation_so_wb_translation' );


require_once  THEMO_PATH . 'inc/enqueue.php';
require_once THEMO_PATH . 'inc/cpt_tours.php' ;
require_once THEMO_PATH . 'inc/shortcodes.php' ;

add_image_size( 'themo_brands', 150, 80, true);
add_image_size( 'themo_team', 480, 320, true);

/**
* GLOBAL VARIABLES
*/
global $th_map_id;
$th_map_id = 0;

// Initial Settings
/*$page_title_selector = get_option( 'elementor_page_title_selector' );
if ( empty( $page_title_selector ) ) {
    update_option( 'elementor_page_title_selector', '.page-title');
}*/


add_action( 'elementor/element/page-settings/section_page_settings/before_section_end', function( $element, $args ) {

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

   // $element->end_controls_section();
}, 10, 2 );



add_action( 'elementor/editor/after_save', function( $post_id, $editor_data ) {


    /*if(isset($post_id) && $post_id > ""){
        $themo_page_ID = $post_id; // Default Page ID
    }

    // Are there settings from the Elementor Page Options?
    $elm_page_settings = get_post_meta( $themo_page_ID,"_elementor_page_settings");
    //echo "SAVED SETTINGS ";
    //echo "<pre>";
    $elm_trans_header = $elm_page_settings[0]['themo_transparent_header'];
    $elm_page_layout = $elm_page_settings[0]['themo_page_layout'];

    //echo $elm_trans_header;
    //echo "<br>";
    //echo $elm_page_layout;

    //echo "</pre>";

    if(empty($elm_trans_header)){
        //echo "EMPTY";
        $elm_trans_header = 'off';
    }
    update_post_meta($themo_page_ID,'themo_transparent_header',$elm_trans_header);
    update_post_meta($themo_page_ID,'themo_page_layout',$elm_page_layout);
    */

});