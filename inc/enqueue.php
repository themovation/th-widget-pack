<?php

if ( ! function_exists( 'themovation_so_wb_admin' ) ) :
// Enqueueing Backend CSS File
function themovation_so_wb_admin() {
	wp_enqueue_style( 'themo-admin-style', plugin_dir_url( __FILE__ ) . '../css/admin.css', array(), ​THEMOVATION_WB_VER );
	wp_enqueue_script( 'themo-admin-script', plugin_dir_url( __FILE__ ) . '../js/admin.js', array( 'jquery' ), ​THEMOVATION_WB_VER, true );
}
endif;
add_action('admin_enqueue_scripts', 'themovation_so_wb_admin' );

if ( ! function_exists ( 'themovation_so_wb_scripts' ) ) :
// Enqueueing Frontend stylesheet and scripts.
function themovation_so_wb_scripts() {
	wp_enqueue_style( 'themo-animatation', plugin_dir_url( __FILE__ ) . '../css/animation.css', array(), ​THEMOVATION_WB_VER );
	wp_enqueue_script( 'themo-so-waypoints', plugin_dir_url( __FILE__ ) . '../js/jquery.waypoints.js', array( 'jquery' ), ​THEMOVATION_WB_VER, true );
	wp_enqueue_script( 'themo-so-wb-js', plugin_dir_url( __FILE__ ) . '../js/themovation.js', array( 'jquery', 'themo-so-waypoints' ), ​THEMOVATION_WB_VER, true );
}
endif;
add_action( 'wp_enqueue_scripts', 'themovation_so_wb_scripts' );
