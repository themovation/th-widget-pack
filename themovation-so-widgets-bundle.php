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
