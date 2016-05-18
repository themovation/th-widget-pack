<?php
/*
Widget Name: Themovation FAQ
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_FAQ_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-faq',

			__('Themovation FAQ', 'themovation-widgets'),

			array(
				'description' => __('An styled question and answer list. Ideal for FAQs.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'faqs' => array(
					'type' => 'repeater',
					'label' => __('FAQs' , 'themovation-widgets'),
					'item_name'  => __('FAQ', 'themovation-widgets'),
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
					)
				)
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
siteorigin_widget_register('th-faq', __FILE__, 'Themovation_SO_WB_FAQ_Widget');
