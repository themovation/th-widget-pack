<?php
/*
Widget Name: Themovation Link
Description: Special use widget. Not designed for standalone use.
Author: Themovation
Author URI: themovation.com
*/

if( !class_exists( 'Themovation_Widget_Base' ) ) include_once plugin_dir_path(​THEMOVATION_BASE_FILE) . '/inc/base.class.php';

class Themovation_SO_WB_Link_Widget extends Themovation_Widget_Base {

	function __construct() {

		parent::__construct(

			'th-link',

			__('Themovation Link', 'themovation-widgets'),

			array(
				'description' => __('Special use widget. Not designed for standalone use.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'link' => array(
					'type' => 'section',
					'label' => __('Link' , 'themovation-widgets'),
					'hide' => true,
					'fields' => $this->link_form_fields()
				)
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'link';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-link', plugin_dir_url(__FILE__) . 'styles/link.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-link', __FILE__, 'Themovation_SO_WB_Link_Widget');
