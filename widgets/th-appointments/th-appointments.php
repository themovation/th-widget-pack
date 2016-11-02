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
					'label' => __('Calendar Shortcode', 'themovation-widgets'),
					'placeholder' => __('[add_shortcode_here]', 'themovation-widgets'),
					'description' => __('For the standard calendar use [booked-calendar] More options available in the Booked settings area', 'themovation-widgets'),
				),

				'tooltip' => array(
					'type' => 'text',
					'label' => __('Tooltip Text (optional)', 'themovation-widgets'),
					'placeholder' => __('Book here', 'themovation-widgets'),
				),

				'size' => array(
					'type' => 'radio',
					'label' => __('Calendar Size', 'themovation-widgets'),
					'default' => 'large',
					'options' => array(
						'large' => __('Large', 'themovation-widgets'),
						'small' => __('Small', 'themovation-widgets'),
					)
				),

				'align' => array(
					'type' => 'radio',
					'label' => __('Align Calendar', 'themovation-widgets'),
					'default' => 'left',
					'options' => array(
						'left' => __('Left', 'themovation-widgets'),
						'centered' => __('Center', 'themovation-widgets'),
						'right' => __('Right', 'themovation-widgets'),
					)
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'appointments';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-appointments', plugin_dir_url(__FILE__) . 'styles/appointments.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-appointments', __FILE__, 'Themovation_SO_WB_Appointments_Widget');
