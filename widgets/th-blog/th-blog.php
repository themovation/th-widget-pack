<?php
/*
Widget Name: Themovation Blog
Description: An styled question and answer list. Ideal for FAQs.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Blog_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-blog',

			__('Themovation Blog', 'themovation-widgets'),

			array(
				'description' => __('An styled question and answer list. Ideal for FAQs.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'number' => array(
					'type' => 'number',
					'label' => __('Number of posts to display', 'themovation-widgets'),
				),

				'categories'    => array(
					'type'    => 'select',
					'multiple' => true,
					'default' => 'all',
					'label'   => __('Category Filter', 'themovation-widgets'),
					'options' => $this->get_blog_categories_list(),
				),
			),

			plugin_dir_path(__FILE__)
		);
	}

	// Creating an array of blog categories
	function get_blog_categories_list() {
		$categories = array('all' => __('All Categories', 'themovation-widgets'));
		$get_categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );

		foreach( $get_categories as $category ) {
			$id = $category->term_id;
			$name = $category->name;
			$categories[$id] = $name;
		}

		return $categories;
	}

	function get_template_name($instance) {
		return 'blog';
	}

	function get_style_name($instance) {
		return '';
	}

	function initialize() {

		$this->register_frontend_styles(
			array(
				array( 'themo-blog', plugin_dir_url(__FILE__) . 'styles/blog.css', array(), ​THEMOVATION_WB_VER )
			)
		);

	}
}
siteorigin_widget_register('th-blog', __FILE__, 'Themovation_SO_WB_Blog_Widget');
