<?php
/*
Widget Name: Themovation Portfolio
Description: Displays portfolio items with column and sort layout options.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Portfolio_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-portfolio',

			__('Themovation Portfolio', 'themovation-widgets'),

			array(
				'description' => __('Displays portfolio items with column and sort layout options.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'filter' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => __('Show filter bar', 'themovation-widgets'),
				),

				'individual'    => array(
					'type'    => 'select',
					'default' => '',
					'label'   => __('Select Individually', 'themovation-widgets'),
					'multiple' => true,
					'options' => array(),
				),

				'group'    => array(
					'type'    => 'select',
					'default' => 'standard',
					'label'   => __('Select by Group', 'themovation-widgets'),
					'multiple' => true,
					'options' => array(),
				),

				'order'    => array(
					'type'    => 'radio',
					'default' => 'date',
					'label'   => __('Order by', 'themovation-widgets'),
					'options' => array(
						'date' => __('Date Published', 'themovation-widgets'),
						'menu_order' => __('Drag and Drop', 'themovation-widgets'),
					),
				),

				'columns' => array(
					'type' => 'slider',
					'label' => __( 'Number of Columns to show', 'themovation-widgets' ),
					'default' => 3,
					'min' => 2,
					'max' => 5,
					'integer' => true,
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	// Creating an array of Portfolio items
	function get_themo_portfolio_list() {
		$portfolio = array();
		$loop = new WP_Query( array(
			'post_type' => array('themo_portfolio'),
			'posts_per_page' => -1
		) );
		while ( $loop->have_posts() ) : $loop->the_post();
			$id = get_the_ID();
			$title = get_the_title();
			$portfolio[$id] = $title;
		endwhile; wp_reset_query();
		return $portfolio;
	}

	// Creating an array of Portfolio categories
	function get_themo_portfolio_cats() {
		$portfolio_group = array();
		$taxonomy = 'themo_project_type';
		$tax_terms = get_terms( $taxonomy );
		foreach( $tax_terms as $item ) {
			$portfolio_group[$item->term_id] = $item->name;
		}
		return $portfolio_group;
	}

	function modify_form( $form ) {
		$form['individual']['options'] = $this->get_themo_portfolio_list();
		$form['group']['options'] = $this->get_themo_portfolio_cats();
		return $form;
	}

	function get_template_name($instance) {
		return '';
	}

	function get_style_name($instance) {
		return '';
	}
}
siteorigin_widget_register('th-portfolio', __FILE__, 'Themovation_SO_WB_Portfolio_Widget');
