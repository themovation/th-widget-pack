<?php
/*
Widget Name: Themovation Logos
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Logos_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-logos',

			__('Themovation Logos', 'themovation-widgets'),

			array(
				'description' => __('', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'logos' => array(
					'type' => 'repeater',
					'label' => __('Logos' , 'themovation-widgets'),
					'item_name'  => __('Item', 'themovation-widgets'),
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

						'image' => array(
							'type' => 'media',
							'fallback' => false,
							'label' => __('Image', 'themovation-widgets'),
							'default'     => '',
							'library' => 'image',
						),

						'link' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Link_Widget',
							'label' => __('Link', 'themovation-widgets'),
						),
					)
				)
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
siteorigin_widget_register('th-logos', __FILE__, 'Themovation_SO_WB_Logos_Widget');