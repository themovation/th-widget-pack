<?php
function themo_add_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'themo-elements',
        [
            'title' => __( 'Themovation Elements', 'th-widget-pack' ),
            'icon' => 'font',
        ]
    );

}
add_action( 'elementor/elements/categories_registered', 'themo_add_elementor_widget_categories' );


