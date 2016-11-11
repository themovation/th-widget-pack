<?php
/*
Widget Name: Themovation Pricing Plans
Description: Pricing chart widget, great for showcasing multiple pricing options and details.
Author: Themovation
Author URI: themovation.com
*/

if( !class_exists( 'Themovation_Widget_Base' ) ) include_once plugin_dir_path(​THEMOVATION_BASE_FILE) . '/inc/base.class.php';

class Themovation_SO_WB_Pricing_Widget extends Themovation_Widget_Base {

	function __construct() {

		parent::__construct(

			'th-pricing',

			__('Themovation Pricing Plans', 'themovation-widgets'),

			array(
				'description' => __('Pricing chart widget, great for showcasing multiple pricing options and details.', 'themovation-widgets'),
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
							'type' => 'section',
							'label' => __('Button 1' , 'themovation-widgets'),
							'hide' => true,
							'fields' => $this->button_1_form_fields()
						),

						'button_2' => array(
							'type' => 'section',
							'label' => __('Button 2' , 'themovation-widgets'),
							'hide' => true,
							'fields' => $this->button_2_form_fields()
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
		return 'pricing';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-pricing', plugin_dir_url(__FILE__) . 'styles/pricing.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-pricing', __FILE__, 'Themovation_SO_WB_Pricing_Widget');
