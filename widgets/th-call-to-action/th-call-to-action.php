<?php
/*
Widget Name: Themovation Call to Action
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_CallToAction_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-call-to-action',

			__('Themovation Call to Action', 'themovation-widgets'),

			array(
				'description' => __('', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'text' => array(
					'type' => 'text',
					'label' => __('Text', 'themovation-widgets'),
					'placeholder' => __('Enter text here', 'themovation-widgets'),
				),

				'button_1' => array(
					'type' => 'widget',
					'class' => 'Themovation_SO_WB_Button_Widget',
					'label' => __('Button 1', 'themovation-widgets'),
				),

				'button_2' => array(
					'type' => 'widget',
					'class' => 'Themovation_SO_WB_Button_Widget',
					'label' => __('Button 2', 'themovation-widgets'),
				),
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
siteorigin_widget_register('th-call-to-action', __FILE__, 'Themovation_SO_WB_CallToAction_Widget');