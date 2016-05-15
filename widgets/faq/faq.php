<?php
/*
Widget Name: Themovation FAQ
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_FAQ_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-faq',

			__('Themovation FAQ', 'themovation-widgets'),

			array(
				'description' => __('', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				// Fields go here
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return '';
	}

	function get_style_name($instance) {
		return '';
	}
}
siteorigin_widget_register('th-faq', __FILE__, 'Themovation_SO_WB_FAQ_Widget');
