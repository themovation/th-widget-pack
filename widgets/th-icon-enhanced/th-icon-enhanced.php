<?php
/*
Widget Name: Themovation Icon Enhanced
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_IconEnhanced_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-icon-enhanced',

			__('Themovation Icon Enhanced', 'themovation-widgets'),

			array(
				'description' => __('Icon widget with link and lightbox support.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				// TO DO : State emitter for lightbox checkbox
				'icon' => array(
					'type' => 'widget',
					'class' => 'SiteOrigin_Widget_Icon_Widget',
					'label' => __('SiteOrigin Icon Widget', 'themovation-widgets'),
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

				'style'    => array(
					'type'    => 'radio',
					'default' => 'standard',
					'label'   => __('Icon Style', 'themovation-widgets'),
					'options' => array(
						'standard' => __('Standard', 'themovation-widgets'),
						'circle' => __('Circle', 'themovation-widgets'),
					),
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
siteorigin_widget_register('th-icon-enhanced', __FILE__, 'Themovation_SO_WB_IconEnhanced_Widget');
