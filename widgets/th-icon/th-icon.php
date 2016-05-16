<?php
/*
Widget Name: Themovation Icon
Description:
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Icon_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-icon',

			__( 'Themovation Icon', 'themovation-widgets' ),

			array(
				'description' => __( '', 'themovation-widgets' ),
				'help'        => '',
			),

			array(
			),

			array(
				'icon' => array(
					'type' => 'section',
					'label' => __( 'Icon' , 'themovation-widgets' ),
					'hide' => true,
					'fields' => array(

						'icon' => array(
							'type' => 'icon',
							'label' => __( 'Icon', 'themovation-widgets' ),
						),

						'style'    => array(
							'type'    => 'radio',
							'default' => 'standard',
							'label'   => __( 'Icon Style', 'themovation-widgets' ),
							'options' => array(
								'standard' => __( 'Standard', 'themovation-widgets' ),
								'circle' => __( 'Circle', 'themovation-widgets' ),
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
siteorigin_widget_register( 'th-icon', __FILE__, 'Themovation_SO_WB_Icon_Widget' );
