<?php
/*
Widget Name: Themovation Header
Description: Heading widget with subtext and icon support.
Author: Themovation
Author URI: themovation.com
*/

if( !class_exists( 'Themovation_Widget_Base' ) ) include_once plugin_dir_path(​THEMOVATION_BASE_FILE) . '/inc/base.class.php';

class Themovation_SO_WB_Header_Widget extends Themovation_Widget_Base {

	function __construct() {

		parent::__construct(

			'th-header',

			__('Themovation Header', 'themovation-widgets'),

			array(
				'description' => __('Heading widget with subtext and icon support.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'type' => array(
					'type' => 'radio',
					'label' => __('Type', 'themovation-widgets'),
					'default' => 'section',
					'options' => array(
						'section' => __('Section Header', 'themovation-widgets'),
						'page' => __('Page Header', 'themovation-widgets'),
					)
				),

				'icon' => array(
					'type' => 'section',
					'label' => __('Icon' , 'themovation-widgets'),
					'hide' => true,
					'fields' => $this->icon_form_fields()
				),

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

				'align' => array(
					'type' => 'radio',
					'label' => __('Align', 'themovation-widgets'),
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
		return 'header';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-header', plugin_dir_url(__FILE__) . 'styles/header.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-header', __FILE__, 'Themovation_SO_WB_Header_Widget');
