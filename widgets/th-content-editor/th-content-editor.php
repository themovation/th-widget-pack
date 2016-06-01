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

			'th-editor',

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

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_style( 'themo-editor', siteorigin_widget_get_plugin_dir_url('th-editor') . 'styles/content-editor.css', array(), INKED_SO_WIDGETS );

		parent::enqueue_frontend_scripts( $instance );
	}
}
siteorigin_widget_register('th-editor', __FILE__, 'Themovation_SO_WB_Editor_Widget');
