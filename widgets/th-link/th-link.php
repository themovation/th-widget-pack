<?php
/*
Widget Name: Themovation Link
Description: Special use widget. Not designed for standalone use.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Link_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-link',

			__('Themovation Link', 'themovation-widgets'),

			array(
				'description' => __('Special use widget. Not designed for standalone use.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'link' => array(
					'type' => 'section',
					'label' => __('Link' , 'themovation-widgets'),
					'hide' => true,
					'fields' => array(

						'url' => array(
							'type' => 'link',
							'label' => __('Link URL', 'themovation-widgets'),
						),

						'new_window' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __('Open in a new window', 'themovation-widgets'),
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

						'lightbox_height' => array(
							'type' => 'number',
							'label' => __('Lightbox height', 'themovation-widgets'),
							'state_handler' => array(
								'lightbox[on]' => array('show'),
								'lightbox[off]' => array('hide'),
							),
						),
					)
				)
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'link';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-link', plugin_dir_url(__FILE__) . 'styles/link.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-link', __FILE__, 'Themovation_SO_WB_Link_Widget');
