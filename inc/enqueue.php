<?php

if ( ! function_exists( 'themovation_so_wb_admin' ) ) :
// Enqueueing Backend CSS File
function themovation_so_wb_admin() {
	wp_enqueue_style( 'themo-admin-style', plugin_dir_url( __FILE__ ) . '../css/admin.css', array(), ​THEMOVATION_WB_VER );
	wp_enqueue_script( 'themo-admin-script', plugin_dir_url( __FILE__ ) . '../js/admin.js', array( 'jquery' ), ​THEMOVATION_WB_VER, true );
	wp_enqueue_script( 'themo-admin-layout-script', plugin_dir_url( __FILE__ ) . '../js/admin-row-layout.js', array( 'jquery' ), ​THEMOVATION_WB_VER, true );

	if ( function_exists( 'ot_get_option' ) ) {
		$th_so_style_panel_options = ot_get_option( 'th_so_style_panel_options', 'off' ); // defaults to off
		if ($th_so_style_panel_options == 'on'){
			wp_dequeue_script( 'themo-admin-layout-script' );
		}
	}
}
endif;
add_action('admin_enqueue_scripts', 'themovation_so_wb_admin' );

if ( ! function_exists ( 'themovation_so_wb_scripts' ) ) :
// Enqueueing Frontend stylesheet and scripts.
function themovation_so_wb_scripts() {

	wp_enqueue_script( 'themo-row-style-js', plugin_dir_url(__FILE__) . '../js/row-styles.js', array(), ​THEMOVATION_WB_VER, true );

	if ( function_exists( 'ot_get_option' ) ) {
		$th_so_style_panel_options = ot_get_option( 'th_so_style_panel_options', 'off' ); // defaults to off
		if ($th_so_style_panel_options == 'on'){
			wp_dequeue_script( 'themo-row-style-js' );
		}
	}

}
endif;
add_action( 'wp_enqueue_scripts', 'themovation_so_wb_scripts' );
