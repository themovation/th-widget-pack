<?php
/*
Widget Name: Themovation Content Editor
Description: A rich-text, text editor.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Editor_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-content-editor',

			__('Themovation Content Editor', 'themovation-widgets'),

			array(
				'description' => __('A rich-text, text editor.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'content' => array(
					'type' => 'tinymce',
					'label' => __('Content', 'themovation-widgets'),
					'default' => '',
					'rows' => 15,
					'default_editor' => 'tinymce',
					'button_filters' => array(
						'mce_buttons' => array( $this, 'filter_mce_buttons' ),
						'mce_buttons_2' => array( $this, 'filter_mce_buttons_2' ),
						'mce_buttons_3' => array( $this, 'filter_mce_buttons_3' ),
						'mce_buttons_4' => array( $this, 'filter_mce_buttons_5' ),
						'quicktags_settings' => array( $this, 'filter_quicktags_settings' ),
					),
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'content-editor';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-editor', plugin_dir_url(__FILE__) . 'styles/content-editor.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-content-editor', __FILE__, 'Themovation_SO_WB_Editor_Widget');
