<?php
/*
Widget Name: Themovation Service Blocks
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Service_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-service',

			__('Themovation Service Blocks', 'themovation-widgets'),

			array(
				'description' => __('Icons with heading, text and link support.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'blocks' => array(
					'type' => 'repeater',
					'label' => __('Service Blocks' , 'themovation-widgets'),
					'item_name'  => __('Service Item', 'themovation-widgets'),
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

						'content' => array(
							'type' => 'tinymce',
							'label' => __('Content', 'themovation-widgets'),
							'default' => '',
							'rows' => 10,
							'default_editor' => 'tinymce',
							'button_filters' => array(
								'mce_buttons' => array( $this, 'filter_mce_buttons' ),
								'mce_buttons_2' => array( $this, 'filter_mce_buttons_2' ),
								'mce_buttons_3' => array( $this, 'filter_mce_buttons_3' ),
								'mce_buttons_4' => array( $this, 'filter_mce_buttons_5' ),
								'quicktags_settings' => array( $this, 'filter_quicktags_settings' ),
							),
						),

						'icon' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Icon_Widget',
							'label' => __('Icon', 'themovation-widgets'),
							'hide' => true
						),

						'link' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Link_Widget',
							'label' => __('Link', 'themovation-widgets'),
							'hide' => true
						),
					)
				),

				'align' => array(
					'type' => 'select',
					'label' => __('Align Service Blocks', 'themovation-widgets'),
					'default' => 'left',
					'options' => array(
						'left' => __('Left', 'themovation-widgets'),
						'centered' => __('Center', 'themovation-widgets'),
						'right' => __('Right', 'themovation-widgets'),
					)
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
siteorigin_widget_register('th-service', __FILE__, 'Themovation_SO_WB_Service_Widget');
