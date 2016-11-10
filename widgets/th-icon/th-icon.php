<?php
/*
Widget Name: Themovation Icon
Description: Special use widget. Use the Enhanced Icon Widget for standalone use.
Author: Themovation
Author URI: themovation.com
*/

if( !class_exists( 'Themovation_Widget_Base' ) ) include_once plugin_dir_path(​THEMOVATION_BASE_FILE) . '/inc/base.class.php';

class Themovation_SO_WB_Icon_Widget extends Themovation_Widget_Base {

	function __construct() {

		parent::__construct(

			'th-icon',

			__('Themovation Icon', 'themovation-widgets'),

			array(
				'description' => __('Special use widget. Use the Enhanced Icon Widget for standalone use.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'icon' => array(
					'type' => 'section',
					'label' => __('Icon' , 'themovation-widgets'),
					'hide' => true,
					'fields' => $this->icon_form_fields()
				)
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'icon';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-icon', plugin_dir_url(__FILE__) . 'styles/icon.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register( 'th-icon', __FILE__, 'Themovation_SO_WB_Icon_Widget' );
