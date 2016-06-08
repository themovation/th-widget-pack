<?php
/*
Widget Name: Themovation Google Map
Description: Add a Google Map widget.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Maps_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-google-map',

			__('Themovation Google Map', 'themovation-widgets'),

			array(
				'description' => __('Add a Google Map widget.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'map' => array(
					'type' => 'widget',
					'class' => 'SiteOrigin_Widget_GoogleMap_Widget',
					'label' => __('SiteOrigin Google Maps Widget', 'themovation-widgets'),
					'hide' => false
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'google-maps';
	}

	function get_style_name($instance) {
		return '';
	}

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_style( 'themo-maps', siteorigin_widget_get_plugin_dir_url('th-maps') . 'styles/google-maps.css', array(), INKED_SO_WIDGETS );

		parent::enqueue_frontend_scripts( $instance );
	}
}
siteorigin_widget_register('th-google-map', __FILE__, 'Themovation_SO_WB_Maps_Widget');
