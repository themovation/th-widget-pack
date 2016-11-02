<?php
//-----------------------------------------------------
// themo_portfolio_custom_post_type
// Portfolio Post Type
//-----------------------------------------------------

if ( ! function_exists('themo_portfolio_custom_post_type') ) {

	// Register Custom Post Type
	function themo_portfolio_custom_post_type() {

		$labels = array(
			'name'                => _x( 'Holes', 'Post Type General Name', 'themovation-widgets' ),
			'singular_name'       => _x( 'Hole', 'Post Type Singular Name', 'themovation-widgets' ),
			'menu_name'           => __( 'Course Guide', 'themovation-widgets' ),
			'parent_item_colon'   => __( 'Parent Hole:', 'themovation-widgets' ),
			'all_items'           => __( 'All Holes', 'themovation-widgets' ),
			'view_item'           => __( 'View Hole', 'themovation-widgets' ),
			'add_new_item'        => __( 'Add New Holes', 'themovation-widgets' ),
			'add_new'             => __( 'Add New', 'themovation-widgets' ),
			'edit_item'           => __( 'Edit Hole', 'themovation-widgets' ),
			'update_item'         => __( 'Update Hole', 'themovation-widgets' ),
			'search_items'        => __( 'Search Hole', 'themovation-widgets' ),
			'not_found'           => __( 'Not found', 'themovation-widgets' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'themovation-widgets' ),
		);

		if ( function_exists( 'ot_get_option' ) ) {
			$custom_slug = ot_get_option( 'themo_portfolio_rewrite_slug', 'portfolio' );
		}else{
			$custom_slug = 'portfolio';
		}

		$rewrite = array(
			'slug'                => $custom_slug,
			'with_front'          => false,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'themo_portfolio', 'themovation-widgets' ),
			'description'         => __( 'Course Guide', 'themovation-widgets' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
			'taxonomies'          => array( 'themo_project_type' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-flag',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( 'themo_portfolio', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'themo_portfolio_custom_post_type', 0 );

}

//-----------------------------------------------------
// themo_project_type
// Project Types Taxonomy
//-----------------------------------------------------

if ( ! function_exists( 'themo_project_type' ) ) {

	// Register Custom Taxonomy
	function themo_project_type() {

		$labels = array(
			'name'                       => _x( 'Hole Types', 'Taxonomy General Name', 'themovation-widgets' ),
			'singular_name'              => _x( 'Hole Type', 'Taxonomy Singular Name', 'themovation-widgets' ),
			'menu_name'                  => __( 'Hole Types', 'themovation-widgets' ),
			'all_items'                  => __( 'All Hole Types', 'themovation-widgets' ),
			'parent_item'                => __( 'Parent Hole Type', 'themovation-widgets' ),
			'parent_item_colon'          => __( 'Parent Hole Type:', 'themovation-widgets' ),
			'new_item_name'              => __( 'New Hole Type Name', 'themovation-widgets' ),
			'add_new_item'               => __( 'Add New Hole Type', 'themovation-widgets' ),
			'edit_item'                  => __( 'Edit Hole Type', 'themovation-widgets' ),
			'update_item'                => __( 'Update Hole Type', 'themovation-widgets' ),
			'separate_items_with_commas' => __( 'Separate Hole Type with commas', 'themovation-widgets' ),
			'search_items'               => __( 'Search Hole Types', 'themovation-widgets' ),
			'add_or_remove_items'        => __( 'Add or remove hole type', 'themovation-widgets' ),
			'choose_from_most_used'      => __( 'Choose from the most hole types', 'themovation-widgets' ),
			'not_found'                  => __( 'Not Found', 'themovation-widgets' ),
		);
		$rewrite = array(
			'slug'                       => 'project-type',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'themo_project_type', array( 'themo_portfolio' ), $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'themo_project_type', 0 );

}
