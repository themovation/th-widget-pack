<?php
/*
Widget Name: Themovation Package
Description: Package widget, great for promotions, specials and deals.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Package_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-package',

			__('Themovation Package', 'themovation-widgets'),

			array(
				'description' => __('Package widget, great for promotions, specials and deals.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
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

				'price' => array(
					'type' => 'section',
					'label' => __('Price' , 'themovation-widgets'),
					'hide' => true,
					'fields' => array(

						'price' => array(
							'type' => 'text',
							'label' => __('Price', 'themovation-widgets'),
							'placeholder' => __('Free', 'themovation-widgets'),
						),

						'text' => array(
							'type' => 'text',
							'label' => __('Price Text', 'themovation-widgets'),
							'placeholder' => __('/month', 'themovation-widgets'),
						),

						'background' => array(
							'type' => 'section',
							'label' => __('Background' , 'themovation-widgets'),
							'hide' => true,
							'fields' => array(

								'color' => array(
									'type' => 'color',
									'label' => __('Background Color', 'themovation-widgets'),
								),

								'transparency' => array(
									'type' => 'slider',
									'label' => __( 'Transparency', 'themovation-widgets' ),
									'default' => 0,
									'min' => 0,
									'max' => 100,
									'integer' => true,
								),

								'contrast'    => array(
									'type'    => 'radio',
									'default' => 'dark',
									'label'   => __('Text Contrast', 'themovation-widgets'),
									'options' => array(
										'dark' => __('Dark Text', 'themovation-widgets'),
										'light' => __('Light Text', 'themovation-widgets'),
									),
								),
							)
						),
					),
				),

				'image' => array(
					'type' => 'media',
					'fallback' => false,
					'label' => __('Image', 'themovation-widgets'),
					'default'     => '',
					'library' => 'image',
				),

				'background' => array(
					'type' => 'section',
					'label' => __('Background' , 'themovation-widgets'),
					'hide' => true,
					'fields' => array(

						'color' => array(
							'type' => 'color',
							'label' => __('Background Color', 'themovation-widgets'),
						),

						'contrast'    => array(
							'type'    => 'radio',
							'default' => 'dark',
							'label'   => __('Text Contrast', 'themovation-widgets'),
							'options' => array(
								'dark' => __('Dark Text', 'themovation-widgets'),
								'light' => __('Light Text', 'themovation-widgets'),
							),
						),
					)
				),

				'link' => array(
					'type' => 'widget',
					'class' => 'Themovation_SO_WB_Link_Widget',
					'label' => __('Link', 'themovation-widgets'),
					'hide' => false
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
siteorigin_widget_register('th-package', __FILE__, 'Themovation_SO_WB_Package_Widget');
