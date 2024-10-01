<?php
/**
 * Plugin Name: Page Builder Widget Pack
 * Version: 2.2.6
 * Plugin URI: themovation.com
 * Description: A widget pack for the Elementor Page Builder
 * Author: Themovation
 * Author URI: themovation.com
 * Text Domain: th-widget-pack
 * Domain Path: /languages/
 * License: GPL v3
 */


define( 'THEMO_VERSION', '2.2.6' );
define( 'THEMO__FILE__', __FILE__ );
define( 'THEMO_PLUGIN_BASE', plugin_basename( THEMO__FILE__ ) );
define( 'THEMO_URL', plugins_url( '/', THEMO__FILE__ ) );
define( 'THEMO_PATH', plugin_dir_path( THEMO__FILE__ ) );
define( 'THEMO_ASSETS_PATH', THEMO_PATH . 'assets/' );
define( 'THEMO_ASSETS_URL', THEMO_URL . 'assets/' );
define( 'THEMO_COLOR_PRIMARY', '#3A3B74' );
define( 'THEMO_COLOR_ACCENT', '#F6C15E' );
define( 'ENABLE_BLOCK_LIBRARY', true );

//HFE constants
define('ALOHA_URL', plugin_dir_url(__FILE__));
define('ALOHA_PATH', __DIR__);
define('ALOHA_CSS_PATH', ALOHA_PATH . '/css');
define('ALOHA_CSS_URL', ALOHA_URL . 'css');
define('ALOHA_JS_PATH', ALOHA_PATH . '/js');
define('ALOHA_JS_URL', ALOHA_URL . 'js');
define('ALOHA_HFE_PATH', ALOHA_PATH . '/header-footer/hfe-plugin/header-footer');
define('ALOHA_HFE_OLD_POST_TYPE', 'elementor-hf');
define('ALOHA_HFE_NEW_POST_TYPE', 'elementor-thhf');
define('ALOHA_DOMAIN', 'header-footer-elementor');
define('ALOHA_WIDGETS_HELP_URL_PREFIX', 'https://help.themovation.com/');


/**
 * Define Elementor Partner ID
 */
if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
    define( 'ELEMENTOR_PARTNER_ID', 2129 );
}

$th_theme = wp_get_theme(); // get theme info and save theme name as constant.
if($th_theme->get( 'Name' ) > ""){
    $th_theme_name_arr = explode("-", $th_theme->get( 'Name' ), 2); // clean up child theme name
    $th_theme_name_arr2 = explode(" ", trim($th_theme_name_arr[0]), 2); // clean up child theme name
    $th_theme_name = trim(strtolower($th_theme_name_arr2[0]));
    define( "THEMO_CURRENT_THEME", $th_theme_name );
};

if(defined('ELEMENTOR_PATH')){
// Run Setup
    require_once THEMO_PATH . 'inc/setup.php';
}

// Making the plugin translation ready
if ( ! function_exists( 'th_translation_ready' ) ) :
    function th_translation_ready() {
        $locale = apply_filters('plugin_locale', get_locale(), "th-widget-pack");
        load_textdomain("th-widget-pack", WP_LANG_DIR.'/th-widget-pack/'.'th-widget-pack'.'-'.$locale.'.mo');
        load_plugin_textdomain( 'th-widget-pack', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    }
endif;

add_action( 'plugins_loaded', 'th_translation_ready' );

function is_elementor_active() {
    if (defined('ELEMENTOR_VERSION') && is_callable('Elementor\Plugin::instance')) {
        return true;
    }

    return false;
}

function aloha_hfe_get_elementor_instance() {
    if (defined('ELEMENTOR_VERSION') && is_callable('Elementor\Plugin::instance')) {
        return $elementor_instance = Elementor\Plugin::instance();
    }
    return false;
}
/**
 * Load the header footer class loader.
 */
require_once THEMO_PATH . 'header-footer/aloha_hfe_overrides.php';
//add_action('admin_menu', 'aloha_add_admin_menu');

function aloha_add_admin_menu() {
    if (is_elementor_active()) {
        add_submenu_page(
                'stratus_dashboard',
                __('Global Templates', ALOHA_DOMAIN),
                __('Global Templates', ALOHA_DOMAIN),
                'edit_pages',
                'edit.php?post_type=elementor-thhf'
        );
    }
}

// Enable white label for HFE and deactivate analytics tracking.
function thmv_set_white_label_opt(){
    $thmv_white_label_opt = array("option" => true);
    return $thmv_white_label_opt;
}
add_filter( 'bsf_white_label_options', 'thmv_set_white_label_opt' );

