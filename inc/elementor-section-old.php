<?php
namespace Elementor;

function themovation_elementor_section() {
    Plugin::instance()->elements_manager->add_category(
        'themo-elements',
        [
            'title'  => __( 'Themovation Elements', 'th-widget-pack' ),
            'icon' => 'font'
        ],
        1
    );
}
add_action( 'elementor/init', 'Elementor\themovation_elementor_section' );




