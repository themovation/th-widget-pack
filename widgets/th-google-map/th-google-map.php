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

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-maps', plugin_dir_url(__FILE__) . 'styles/google-maps.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-google-map', __FILE__, 'Themovation_SO_WB_Maps_Widget');
