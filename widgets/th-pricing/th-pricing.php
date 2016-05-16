<?php
/*
Widget Name: Themovation Pricing Plans
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Pricing_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-pricing',

			__('Themovation Pricing Plans', 'themovation-widgets'),

			array(
				'description' => __('', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'table' => array(
					'type' => 'repeater',
					'label' => __('Pricing Table' , 'themovation-widgets'),
					'item_name'  => __('Column', 'themovation-widgets'),
					'item_label' => array(
						'selector'     => "[id*='title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(

						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'themovation-widgets'),
							'placeholder' => __('Enter title here', 'themovation-widgets'),
						),

						'price' => array(
							'type' => 'text',
							'label' => __('Price', 'themovation-widgets'),
							'placeholder' => __('Free', 'themovation-widgets'),
						),

						'text' => array(
							'type' => 'text',
							'label' => __('Price Text', 'themovation-widgets'),
							'placeholder' => __('/month', 'themovation-widgets'),
						),

						'features' => array(
							'type' => 'textarea',
							'label' => __('Pricing Plan Features', 'themovation-widgets'),
							'placeholder' => __('List all details here. Use a line break to force a new row.', 'themovation-widgets'),
							'rows' => 7
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

						'popular' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __('Most Popular/Featured', 'themovation-widgets'),
						),
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
siteorigin_widget_register('th-pricing', __FILE__, 'Themovation_SO_WB_Pricing_Widget');
