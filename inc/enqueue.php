<?php

if ( ! function_exists( 'themovation_so_wb_admin' ) ) :
// Enqueueing Backend CSS File
function themovation_so_wb_admin() {
	wp_enqueue_style( 'themo-admin-style', plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), ​THEMOVATION_WB_VER );
	wp_enqueue_script( 'themo-admin-script', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), ​THEMOVATION_WB_VER, true );
}
endif;
add_action('admin_enqueue_scripts', 'themovation_so_wb_admin' );
