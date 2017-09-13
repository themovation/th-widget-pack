<?php

if ( ! function_exists ( 'themovation_so_wb_scripts' ) ) :
// Enqueueing Frontend stylesheet and scripts.
function themovation_so_wb_scripts() {

    //wp_enqueue_script( 'themo-js-head', THEMO_URL . 'js/themo-head.js', array('jquery'), THEMO_VERSION, false);
    wp_enqueue_script( 'themo-js-foot', THEMO_URL . 'js/themo-foot.js', array('jquery'), THEMO_VERSION, true);

    wp_register_script( 'themo-google-map', THEMO_URL . 'js/themo-google-maps.js', array(), THEMO_VERSION, true);

    // Enqueue font awesome on all pages
    wp_enqueue_style( 'font-awesome' );

	if ( wp_script_is( 'booked-font-awesome', 'enqueued' ) && wp_style_is( 'font-awesome', 'enqueued' ) ) {
		wp_dequeue_script( 'booked-font-awesome' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'themovation_so_wb_scripts', 20 );

// FRONTEND // After Elementor registers all styles.
add_action( 'elementor/frontend/after_register_styles', function() {
    wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);
} );

// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);
    // JS for the Editor
    wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), THEMO_VERSION);
} );


// PREVIEW // Before the preview styles enqueuing.
add_action( 'elementor/preview/enqueue_styles', function() {
    wp_enqueue_style( 'themo-preview', THEMO_URL  . 'css/th-preview.css', array(), THEMO_VERSION);
    wp_enqueue_script( 'themo-preview', THEMO_URL  . 'js/th-preview.js', array(), THEMO_VERSION);
} );
