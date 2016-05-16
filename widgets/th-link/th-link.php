<?php
/*
Widget Name: Themovation Link
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Link_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-link',

			__('Themovation Link', 'themovation-widgets'),

			array(
				'description' => __('', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				// TO DO : State emitter for lightbox checkbox
				'link' => array(
					'type' => 'section',
					'label' => __('Link' , 'themovation-widgets'),
					'hide' => true,
					'fields' => array(

						'url' => array(
							'type' => 'link',
							'label' => __('Link URL', 'themovation-widgets'),
						),

						'text' => array(
							'type' => 'text',
							'label' => __('Link text', 'themovation-widgets'),
							'placeholder' => __('Enter text', 'themovation-widgets'),
						),

						'new_window' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __('Open in a new window', 'themovation-widgets'),
						),

						'lightbox' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __('Open in lightbox', 'themovation-widgets'),
						),

						'lightbox_width' => array(
							'type' => 'number',
							'label' => __('Lightbox width', 'themovation-widgets'),
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
siteorigin_widget_register('th-link', __FILE__, 'Themovation_SO_WB_Link_Widget');
