<?php
/*
Widget Name: Themovation Testimonials
Description: Display testimonials, reviews and quotes.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Testimonials_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-testimonials',

			__('Themovation Testimonials', 'themovation-widgets'),

			array(
				'description' => __('Display testimonials, reviews and quotes.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'testimonials' => array(
					'type' => 'repeater',
					'label' => __('Testimonials' , 'themovation-widgets'),
					'item_name'  => __('Testimonial', 'themovation-widgets'),
					'item_label' => array(
						'selector'     => "[id*='title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(

						'name' => array(
							'type' => 'text',
							'label' => __('Name', 'themovation-widgets'),
							'placeholder' => __('John Doe', 'themovation-widgets'),
						),

						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'themovation-widgets'),
							'placeholder' => __('Satisfied Customer, CEO', 'themovation-widgets'),
						),

						'quote' => array(
							'type' => 'text',
							'label' => __('Quote', 'themovation-widgets'),
							'placeholder' => __('Five Star Rating. Amazing Service.', 'themovation-widgets'),
							'rows' => 4
						),

						'image' => array(
							'type' => 'media',
							'fallback' => false,
							'label' => __('Image', 'themovation-widgets'),
							'default'     => '',
							'library' => 'image',
						),

						'rating' => array(
							'type' => 'select',
							'label' => __('Rating', 'themovation-widgets'),
							'default' => '5',
							'options' => array(
								'05' => __('0.5', 'themovation-widgets'),
								'10' => __('1', 'themovation-widgets'),
								'15' => __('1.5', 'themovation-widgets'),
								'20' => __('2', 'themovation-widgets'),
								'25' => __('2.5', 'themovation-widgets'),
								'30' => __('3', 'themovation-widgets'),
								'35' => __('3.5', 'themovation-widgets'),
								'40' => __('4', 'themovation-widgets'),
								'45' => __('4.5', 'themovation-widgets'),
								'50' => __('5', 'themovation-widgets'),
							),
						),
					)
				),

				'rows'    => array(
					'type'    => 'select',
					'default' => '1',
					'label'   => __('Testimonials per row', 'themovation-widgets'),
					'options' => array(
						'1' => __('1', 'themovation-widgets'),
						'2' => __('2', 'themovation-widgets'),
						'3' => __('3', 'themovation-widgets'),
					),
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'testimonials';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-testimonials', plugin_dir_url(__FILE__) . 'styles/testimonials.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-testimonials', __FILE__, 'Themovation_SO_WB_Testimonials_Widget');
