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
							'type' => 'slider',
							'label' => __( 'Rating', 'themovation-widgets' ),
							'default' => 5,
							'min' => 1,
							'max' => 5,
							'integer' => true,
						),
					)
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

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_style( 'themo-testimonials', siteorigin_widget_get_plugin_dir_url('th-testimonials') . 'styles/testimonials.css', array(), INKED_SO_WIDGETS );

		parent::enqueue_frontend_scripts( $instance );
	}
}
siteorigin_widget_register('th-testimonials', __FILE__, 'Themovation_SO_WB_Testimonials_Widget');
