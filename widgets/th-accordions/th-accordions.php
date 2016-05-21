<?php
/*
Widget Name: Themovation Accordions
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Accordions_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-accordions',

			__('Themovation Accordion', 'themovation-widgets'),

			array(
				'description' => __('Collapsible, expandable content blocks.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'accordions' => array(
					'type' => 'repeater',
					'label' => __('Accordion' , 'themovation-widgets'),
					'item_name'  => __('Collapsable Item', 'themovation-widgets'),
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

						'button_1' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Button_Widget',
							'label' => __('Button 1', 'themovation-widgets'),
							'hide' => true
						),

						'button_2' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Button_Widget',
							'label' => __('Button 2', 'themovation-widgets'),
							'hide' => true
						),

						'icon' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Icon_Widget',
							'label' => __('Icon', 'themovation-widgets'),
							'hide' => true
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
siteorigin_widget_register('th-accordions', __FILE__, 'Themovation_SO_WB_Accordions_Widget');
