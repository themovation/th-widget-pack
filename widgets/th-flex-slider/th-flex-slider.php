<?php
/*
Widget Name: Themovation Flex Slider
Description: Full width slider.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_FlexSlider_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-flex-slider',

			__('Themovation Flex Slider', 'themovation-widgets'),

			array(
				'description' => __('Full width slider.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'slides' => array(
					'type' => 'repeater',
					'label' => __('Slides' , 'themovation-widgets'),
					'item_name'  => __('Slide', 'themovation-widgets'),
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

						'service_block' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Service_Widget',
							'label' => __('Service Block', 'themovation-widgets'),
							'hide' => false
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

						'image' => array(
							'type' => 'section',
							'label' => __('Featured Image' , 'themovation-widgets'),
							'hide' => true,
							'fields' => array(

								'image' => array(
									'type' => 'media',
									'fallback' => false,
									'label' => __('Image', 'themovation-widgets'),
									'default'     => '',
									'library' => 'image',
								),

								'link' => array(
									'type' => 'widget',
									'class' => 'Themovation_SO_WB_Link_Widget',
									'label' => __('Link', 'themovation-widgets'),
									'hide' => false
								),
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

								'image' => array(
									'type' => 'media',
									'fallback' => false,
									'label' => __('Background Image', 'themovation-widgets'),
									'default'     => '',
									'library' => 'image',
								),

								'repeat'    => array(
									'type'    => 'select',
									'default' => 'blank',
									'label'   => __('Background Repeat', 'themovation-widgets'),
									'options' => array(
										'blank' => __('Blank', 'themovation-widgets'),
										'no-repeat' => __('No Repeat', 'themovation-widgets'),
										'repeat' => __('Repeat All', 'themovation-widgets'),
										'repeat-x' => __('Repeat Horizontally', 'themovation-widgets'),
										'repeat-y' => __('Repeat Vertically', 'themovation-widgets'),
									),
								),

								'attachment'    => array(
									'type'    => 'select',
									'default' => 'blank',
									'label'   => __('Background Attachment', 'themovation-widgets'),
									'options' => array(
										'blank' => __('Blank', 'themovation-widgets'),
										'fixed' => __('Fixed', 'themovation-widgets'),
										'scroll' => __('Scroll', 'themovation-widgets'),
									),
								),

								'position'    => array(
									'type'    => 'select',
									'default' => 'blank',
									'label'   => __('Background Position', 'themovation-widgets'),
									'options' => array(
										'blank' => __('Blank', 'themovation-widgets'),
										'left-top' => __('Left Top', 'themovation-widgets'),
										'left-center' => __('Left Center', 'themovation-widgets'),
										'left-bottom' => __('Left Bottom', 'themovation-widgets'),
										'center-top' => __('Center Top', 'themovation-widgets'),
										'center-center' => __('Center Center', 'themovation-widgets'),
										'center-bottom' => __('Center Bottom', 'themovation-widgets'),
										'right-top' => __('Right Top', 'themovation-widgets'),
										'right-center' => __('Right Center', 'themovation-widgets'),
										'right-bottom' => __('Right Bottom', 'themovation-widgets'),
									),
								),

								'size' => array(
									'type' => 'text',
									'label' => __('Background Size', 'themovation-widgets'),
									'placeholder' => __('Cover', 'themovation-widgets'),
								),

								'contrast'    => array(
									'type'    => 'radio',
									'default' => 'dark',
									'label'   => __('Text Contrast', 'themovation-widgets'),
									'options' => array(
										'dark' => __('Dark', 'themovation-widgets'),
										'light' => __('Light', 'themovation-widgets'),
									),
								),
							)
						),

						'padding' => array(
							'type' => 'section',
							'label' => __('Padding' , 'themovation-widgets'),
							'hide' => true,
							'fields' => array(

								'top' => array(
									'type' => 'slider',
									'label' => __( 'Top Padding', 'themovation-widgets' ),
									'default' => 0,
									'min' => 0,
									'max' => 300,
									'integer' => true,
								),

								'bottom' => array(
									'type' => 'slider',
									'label' => __( 'Bottom Padding', 'themovation-widgets' ),
									'default' => 0,
									'min' => 0,
									'max' => 300,
									'integer' => true,
								),
							)
						),

						'shortcode' => array(
							'type' => 'section',
							'label' => __('Shortcode' , 'themovation-widgets'),
							'hide' => true,
							'fields' => array(

								'shortcode' => array(
									'type' => 'text',
									'label' => __('Shortcode', 'themovation-widgets'),
									'placeholder' => __('Cover', 'themovation-widgets'),
								),

								'tooltip' => array(
									'type' => 'text',
									'label' => __('Booked Calendar Tooltip', 'themovation-widgets'),
								),

								'ff_border' => array(
									'type'    => 'radio',
									'default' => 'none',
									'label'   => __('Formidable Form Border', 'themovation-widgets'),
									'options' => array(
										'none' => __('None', 'themovation-widgets'),
										'light' => __('Light', 'themovation-widgets'),
										'dark' => __('Dark', 'themovation-widgets'),
									),
								),
							)
						),

						'styling' => array(
							'type' => 'section',
							'label' => __('Alignment and Styling' , 'themovation-widgets'),
							'hide' => true,
							'fields' => array(

								'large' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __('Large Styling', 'themovation-widgets'),
								),

								'alignment' => array(
									'type'    => 'radio',
									'default' => 'slide-cal-left',
									'label'   => __('Content Alignment Options', 'themovation-widgets'),
									'options' => array(
										'slide-cal-left' => __('Left', 'themovation-widgets'),
										'slide-cal-center' => __('Center', 'themovation-widgets'),
										'slide-cal-right' => __('Right', 'themovation-widgets'),
									),
								),
							)
						),
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
siteorigin_widget_register( 'th-flex-slider', __FILE__, 'Themovation_SO_WB_FlexSlider_Widget' );
