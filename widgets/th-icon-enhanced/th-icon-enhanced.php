<?php
/*
Widget Name: Themovation Icon Enhanced
Description: Icon widget with link and lightbox support.
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
				'icon' => array(
					'type' => 'widget',
					'class' => 'SiteOrigin_Widget_Icon_Widget',
					'label' => __('SiteOrigin Icon Widget', 'themovation-widgets'),
					'hide' => false
				),

				'lightbox'    => array(
					'type'    => 'radio',
					'default' => 'off',
					'label'   => __('Open in lightbox', 'themovation-widgets'),
					'state_emitter' => array(
						'callback' => 'select',
						'args' => array( 'lightbox' )
					),
					'options' => array(
						'off' => __('Off', 'themovation-widgets'),
						'on' => __('On', 'themovation-widgets'),
					),
				),

				'lightbox_width' => array(
					'type' => 'number',
					'label' => __('Lightbox width', 'themovation-widgets'),
					'state_handler' => array(
						'lightbox[on]' => array('show'),
						'lightbox[off]' => array('hide'),
					),
				),

				'style'    => array(
					'type'    => 'radio',
					'default' => 'standard',
					'label'   => __('Icon Style', 'themovation-widgets'),
					'options' => array(
						'standard' => __('Standard', 'themovation-widgets'),
						'circle' => __('Circle', 'themovation-widgets'),
						'border' => __('Bordered', 'themovation-widgets'),
					),
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'icon-enhanced';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-icon-enhanced', plugin_dir_url(__FILE__) . 'styles/icon-enhanced.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-icon-enhanced', __FILE__, 'Themovation_SO_WB_IconEnhanced_Widget');
