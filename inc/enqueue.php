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



if('uplands' == THEMO_CURRENT_THEME){
    // GOLF
// FRONTEND // After Elementor registers all styles.
    add_action( 'elementor/frontend/after_register_styles', 'th_enqueue_after_frontend_golf' );

    function th_enqueue_after_frontend_golf() {
        wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/golf_icons.css', array(), THEMO_VERSION);
    }

    // EDITOR // Before the editor scripts enqueuing.
    add_action( 'elementor/editor/before_enqueue_scripts', 'th_enqueue_before_editor_golf' );

    function th_enqueue_before_editor_golf() {
        wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/golf_icons.css', array(), THEMO_VERSION);
        // JS for the Editor
        //wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), THEMO_VERSION);
    }

}else{
    // FRONTEND // After Elementor registers all styles.
    add_action( 'elementor/frontend/after_register_styles', 'th_enqueue_after_frontend' );

    function th_enqueue_after_frontend() {
        wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);
    }

// EDITOR // Before the editor scripts enqueuing.
    add_action( 'elementor/editor/before_enqueue_scripts', 'th_enqueue_before_editor' );

    function th_enqueue_before_editor() {
        wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);
        // JS for the Editor
        wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), THEMO_VERSION, true);
    }
}




// PREVIEW // Before the preview styles enqueuing.
add_action( 'elementor/preview/enqueue_styles', 'th_enqueue_preview' );

function th_enqueue_preview() {
    wp_enqueue_style( 'themo-preview-style', THEMO_URL  . 'css/th-preview.css', array(), THEMO_VERSION);
    wp_enqueue_script( 'themo-preview-script', THEMO_URL  . 'js/th-preview.js', array(), THEMO_VERSION);
    wp_enqueue_script( 'themo-google-map', THEMO_URL . 'js/themo-google-maps.js', array(), THEMO_VERSION, true);

}

// FRONTEND // After Elementor registers all scripts.
add_action( 'elementor/editor/after_enqueue_scripts', 'th_enqueue_after_frontend_scripts' );

function th_enqueue_after_frontend_scripts() {
    
    if ( ENABLE_BLOCK_LIBRARY === true ) {
        // JS for the Editor
        //wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), THEMO_VERSION);
        wp_enqueue_style( 'thmv-library-style', THEMO_URL . 'css/th-library.css', [ 'elementor-editor' ], THEMO_VERSION );
        wp_enqueue_script( 'thmv-library-script', THEMO_URL . 'js/th-library.js', [ 'elementor-editor', 'jquery-hover-intent' ], THEMO_VERSION, true );

        $localized_data = [
            'i18n' => [
                'templatesEmptyTitle' => esc_html__( 'No Templates Found', 'th-widget-pack' ),
                'templatesEmptyMessage' => esc_html__( 'Try different category or sync for new templates.', 'th-widget-pack' ),
                'templatesNoResultsTitle' => esc_html__( 'No Results Found', 'th-widget-pack' ),
                'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different word.', 'th-widget-pack' ),
            ]
        ];

        wp_localize_script( 'thmv-library-script', 'ThBlockEditor', $localized_data );
    }

}


add_action( 'elementor/editor/after_enqueue_scripts', 'th_enqueue_after_frontend_scripts' );


/* If Elementor P is not active, tuck away widgets. */
if ( ! function_exists ( 'thmv_tuck_pro_widgets' ) ) {
    function thmv_tuck_pro_widgets(){
        ?>
        <style>
            #elementor-panel-category-pro-elements,
            #elementor-panel-category-woocommerce-elements,
            #elementor-panel-category-theme-elements {
                display: none;
            }
        </style>
<?php
    }
}

if ( !defined( 'ELEMENTOR_PRO_VERSION' )) {
    add_action( 'elementor/editor/footer', 'thmv_tuck_pro_widgets' );
}