<?php
function themo_add_elementor_widget_categories( $elements_manager ) {

    $template = wp_get_theme()->get_template();
    $arr = ['bellevue', 'stratus'];
    
    if(in_array($template, $arr)){
        $tempName = ucfirst($template);
    }
    else {
       $tempName = 'Themovation'; 
    }
    
    $elements_manager->add_category(
        'themo-elements',
        [
            'title' => $tempName." ".__( 'General', 'th-widget-pack' ),
            'icon' => 'font',
        ]
    );
    $elements_manager->add_category(
        'themo-site',
        [
            'title' => $tempName." ".__( 'Site', 'th-widget-pack' ),
            'icon' => 'font',
        ]
    );

}
add_action( 'elementor/elements/categories_registered', 'themo_add_elementor_widget_categories' );


