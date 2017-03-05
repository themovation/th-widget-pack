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

define('​THEMOVATION_WB_VER', '1.0.0');
define('​THEMOVATION_BASE_FILE', __FILE__);

function themovation_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'elements/team.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/package.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/appointments.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/blog.php';
	//require_once plugin_dir_path( __FILE__ ) . 'elements/course-guide.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/tour-grid.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/slider.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/slider-slick.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/pricing.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/formidable-form.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/tour-info.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/button.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/call-to-action.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/itinerary.php';
	require_once plugin_dir_path( __FILE__ ) . 'elements/google-maps.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/testimonial.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/image-gallery.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/header.php';
}
add_filter( 'elementor/widgets/widgets_registered', 'themovation_elements' );

require_once ( 'inc/elementor-section.php' );

require_once ( 'inc/template-functions.php' );

if ( ! function_exists( 'themovation_so_wb_translation' ) ) :
// Making the plugin translation ready
function themovation_so_wb_translation() {
	load_plugin_textdomain( 'themovation-widgets', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
endif;
add_action( 'plugins_loaded', 'themovation_so_wb_translation' );

require_once ( 'inc/enqueue.php' );
require_once ( 'inc/cpt_tours.php' );

add_image_size( 'themo_brands', 150, 80, true);
add_image_size( 'themo_team', 480, 320, true);
