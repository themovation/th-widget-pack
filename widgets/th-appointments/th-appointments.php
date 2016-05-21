<?php
/*
Widget Name: Themovation Booked Appointments Calendar
Description: A booking calendar widget with size and tooltip options.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Appointments_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-appointments',

			__('Themovation Booked Appointment Calendar', 'themovation-widgets'),

			array(
				'description' => __('A booking calendar widget with size and tooltip options.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'shortcode' => array(
					'type' => 'text',
					'label' => __('Form Shortcode', 'themovation-widgets'),
					'placeholder' => __('[add_shortcode_here]', 'themovation-widgets'),
				),

				'tooltip' => array(
					'type' => 'text',
					'label' => __('Tooltip Text', 'themovation-widgets'),
					'placeholder' => __('Book here', 'themovation-widgets'),
				),

				'size' => array(
					'type' => 'select',
					'label' => __('Styling Size', 'themovation-widgets'),
					'default' => 'large',
					'options' => array(
						'large' => __('Large', 'themovation-widgets'),
						'medium' => __('Medium', 'themovation-widgets'),
						'small' => __('Small', 'themovation-widgets'),
					)
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
siteorigin_widget_register('th-appointments', __FILE__, 'Themovation_SO_WB_Appointments_Widget');
