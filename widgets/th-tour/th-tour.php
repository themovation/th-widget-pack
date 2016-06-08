<?php
/*
Widget Name: Themovation Tour
Description: Stylized service or product showcase with photo, heading, text and button support.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Tour_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-tour',

			__('Themovation Tour', 'themovation-widgets'),

			array(
				'description' => __('Stylized service or product showcase with photo, heading, text and button support.', 'themovation-widgets'),
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

				'image' => array(
					'type' => 'media',
					'fallback' => false,
					'label' => __('Image', 'themovation-widgets'),
					'default'     => '',
					'library' => 'image',
				),

				'button_1' => array(
					'type' => 'widget',
					'class' => 'Themovation_SO_WB_Button_Widget',
					'label' => __('Button 1', 'themovation-widgets'),
					'hide' => false
				),

				'button_2' => array(
					'type' => 'widget',
					'class' => 'Themovation_SO_WB_Button_Widget',
					'label' => __('Button 2', 'themovation-widgets'),
					'hide' => false
				),

				'styling' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => __('Large Styling', 'themovation-widgets'),
				),

				'image_opts' => array(
					'type' => 'section',
					'label' => __('Featured Image Options' , 'themovation-widgets'),
					'hide' => true,
					'fields' => array(

						'align' => array(
							'type' => 'radio',
							'label' => __('Align Photo', 'themovation-widgets'),
							'default' => 'right',
							'options' => array(
								'left' => __('Left', 'themovation-widgets'),
								'centered' => __('Center', 'themovation-widgets'),
								'right' => __('Right', 'themovation-widgets'),
							)
						),

						'size' => array(
							'type'    => 'radio',
							'default' => 'small',
							'label'   => __('Photo Siz', 'themovation-widgets'),
							'options' => array(
								'small' => __('Small', 'themovation-widgets'),
								'large' => __('Large', 'themovation-widgets'),
							),
						),

						'pin' => array(
							'type' => 'radio',
							'label' => __('Pin Photo', 'themovation-widgets'),
							'default' => 'none',
							'state_emitter' => array(
								'callback' => 'select',
								'args' => array( 'photo_pin' )
							),
							'options' => array(
								'top' => __('Sticky Top', 'themovation-widgets'),
								'none' => __('None', 'themovation-widgets'),
								'bottom' => __('Sticky Bottom', 'themovation-widgets'),
							)
						),

						'animation' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __('Hover Slide Up Animation', 'themovation-widgets'),
							'state_handler' => array(
								'photo_pin[top]' => array('hide'),
								'photo_pin[none]' => array('hide'),
								'photo_pin[bottom]' => array('show'),
							),
						),
					),
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'tour';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-tour', plugin_dir_url(__FILE__) . 'styles/tour.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-tour', __FILE__, 'Themovation_SO_WB_Tour_Widget');
