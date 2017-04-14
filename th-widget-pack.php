<?php
/**
 * Plugin Name: Embark Theme Widget Pack
 * Version: 1.0.0
 * Plugin URI: themovation.com
 * Description: A widget pack for the Embark Theme
 * Author: Themovation
 * Author URI: themovation.com
 * Text Domain: th-widget-pack
 * Domain Path: /languages/
 * License: GPL v3
 */


define('THEMO_VERSION', '1.0.0');

define( 'THEMO__FILE__', __FILE__ );
define( 'THEMO_PLUGIN_BASE', plugin_basename( THEMO__FILE__ ) );
define( 'THEMO_URL', plugins_url( '/', THEMO__FILE__ ) );
define( 'THEMO_PATH', plugin_dir_path( THEMO__FILE__ ) );
define( 'THEMO_ASSETS_URL', THEMO_URL . 'assets/' );
define( 'THEMO_COLOR_PRIMARY', '#3A3B74' );
define( 'THEMO_COLOR_ACCENT', '#F6C15E' );



if ( ! function_exists( 'themovation_so_wb_translation' ) ) :
// Making the plugin translation ready
    function themovation_so_wb_translation() {
        load_plugin_textdomain( 'th-widget-pack', false, THEMO_PLUGIN_BASE  . '/languages/' );
    }
endif;
add_action( 'plugins_loaded', 'themovation_so_wb_translation' );

// Run Setup
require_once THEMO_PATH . 'inc/setup.php';
