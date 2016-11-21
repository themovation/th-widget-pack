<?php
/*
Widget Name: Themovation Button
Description: A button with different styles including graphic and add to cart.
Author: Themovation
Author URI: themovation.com
*/

if( !class_exists( 'Themovation_Widget_Base' ) ) include_once plugin_dir_path(​THEMOVATION_BASE_FILE) . '/inc/base.class.php';

class Themovation_SO_WB_Button_Widget extends Themovation_Widget_Base {

	function __construct() {

		parent::__construct(

			'th-button',

			__('Themovation Button', 'themovation-widgets'),

			array(
				'description' => __('A button with different styles including graphic and add to cart.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
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
				)
			),

			plugin_dir_path(__FILE__)
		);
	}



	function modify_form( $form ) {
		$form['button']['fields']['product_button']['options'] = $this->get_woocommerce_product_list();
		return $form;
	}

	function get_template_name($instance) {
		return 'button';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-button', plugin_dir_url(__FILE__) . 'styles/button.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-button', __FILE__, 'Themovation_SO_WB_Button_Widget');
