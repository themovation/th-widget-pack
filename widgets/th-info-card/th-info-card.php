<?php
/*
Widget Name: Themovation Info Card
Description: An styled question and answer list. Ideal for FAQs.
Author: Themovation
Author URI: themovation.com
*/

if( !class_exists( 'Themovation_Widget_Base' ) ) include_once plugin_dir_path(​THEMOVATION_BASE_FILE) . '/inc/base.class.php';

class Themovation_SO_WB_InfoCard_Widget extends Themovation_Widget_Base {

	function __construct() {

		parent::__construct(

			'th-info-card',

			__('Themovation Info Card', 'themovation-widgets'),

			array(
				'description' => __('An styled question and answer list. Ideal for FAQs.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
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

				'button_1' => array(
					'type' => 'section',
					'label' => __('Button 1' , 'themovation-widgets'),
					'hide' => true,
					'fields' => $this->button_1_form_fields()
				),

				'button_2' => array(
					'type' => 'section',
					'label' => __('Button 2' , 'themovation-widgets'),
					'hide' => true,
					'fields' => $this->button_2_form_fields()
				),

				'align' => array(
					'type' => 'radio',
					'label' => __('Align Calendar', 'themovation-widgets'),
					'default' => 'centered',
					'options' => array(
						'left' => __('Left', 'themovation-widgets'),
						'centered' => __('Center', 'themovation-widgets'),
						'right' => __('Right', 'themovation-widgets'),
					)
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

						'opacity' => array(
							'type' => 'slider',
							'label' => __('Opacity', 'themovation-widgets'),
							'default' => 100,
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

				'border-color' => array(
					'type' => 'color',
					'label' => __('Border Color', 'themovation-widgets'),
				),

				'card-align' => array(
					'type' => 'radio',
					'label' => __('Card Alignment', 'themovation-widgets'),
					'default' => 'centered',
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
		return 'info-card';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-info-card', plugin_dir_url(__FILE__) . 'styles/info-card.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-info-card', __FILE__, 'Themovation_SO_WB_InfoCard_Widget');
