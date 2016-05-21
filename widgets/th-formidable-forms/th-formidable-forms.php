<?php
/*
Widget Name: Themovation Formidable Forms
Description: A Formidable form widget with inline styling options.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Forms_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-formidable-forms',

			__('Themovation Formidable Forms', 'themovation-widgets'),

			array(
				'description' => __('A Formidable form widget with inline styling options.', 'themovation-widgets'),
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

				'conversion_form' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => __('Inline conversion form', 'themovation-widgets'),
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
siteorigin_widget_register('th-formidable-forms', __FILE__, 'Themovation_SO_WB_Forms_Widget');
