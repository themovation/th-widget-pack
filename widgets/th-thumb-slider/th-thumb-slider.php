<?php
/*
Widget Name: Themovation Thumbnail Slider
Description: Inline thumbnail images inside a moving slider / carousel.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_ThumbSlider_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-thumb-slider',

			__('Themovation Thumbnail Slider', 'themovation-widgets'),

			array(
				'description' => __('Inline thumbnail images inside a moving slider / carousel.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'slides' => array(
					'type' => 'repeater',
					'label' => __('Thumbnail Slides' , 'themovation-widgets'),
					'item_name'  => __('Slide', 'themovation-widgets'),
					'item_label' => array(
						'selector'     => "[id*='title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(

						'image' => array(
							'type' => 'media',
							'fallback' => false,
							'label' => __('Image', 'themovation-widgets'),
							'default'     => '',
							'library' => 'image',
						),

						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'themovation-widgets'),
							'placeholder' => __('Enter title here', 'themovation-widgets'),
						),

						'small_text' => array(
							'type' => 'text',
							'label' => __('Small Text', 'themovation-widgets'),
						),

						'link' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Link_Widget',
							'label' => __('Link', 'themovation-widgets'),
							'hide' => false
						),
					)
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'thumb-slider';
	}

	function get_style_name($instance) {
		return '';
	}

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_style( 'themo-thumb-slider', siteorigin_widget_get_plugin_dir_url('th-thumb-slider') . 'styles/thumb-slider.css', array(), INKED_SO_WIDGETS );

		parent::enqueue_frontend_scripts( $instance );
	}
}
siteorigin_widget_register('th-thumb-slider', __FILE__, 'Themovation_SO_WB_ThumbSlider_Widget');
