<?php
//-----------------------------------------------------
// themo_portfolio_custom_post_type
// Portfolio Post Type
//-----------------------------------------------------

if ( ! function_exists('themo_portfolio_custom_post_type') ) {

	// Register Custom Post Type
	function themo_portfolio_custom_post_type() {

		$labels = array(
			'name'                => _x( 'Projects', 'Post Type General Name', 'themovation-custom-post-types' ),
			'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'themovation-custom-post-types' ),
			'menu_name'           => __( 'Portfolio', 'themovation-custom-post-types' ),
			'parent_item_colon'   => __( 'Parent Project:', 'themovation-custom-post-types' ),
			'all_items'           => __( 'All Projects', 'themovation-custom-post-types' ),
			'view_item'           => __( 'View Project', 'themovation-custom-post-types' ),
			'add_new_item'        => __( 'Add New Project', 'themovation-custom-post-types' ),
			'add_new'             => __( 'Add New', 'themovation-custom-post-types' ),
			'edit_item'           => __( 'Edit Project', 'themovation-custom-post-types' ),
			'update_item'         => __( 'Update Project', 'themovation-custom-post-types' ),
			'search_items'        => __( 'Search Project', 'themovation-custom-post-types' ),
			'not_found'           => __( 'Not found', 'themovation-custom-post-types' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'themovation-custom-post-types' ),
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
			'label'               => __( 'themo_portfolio', 'themovation-custom-post-types' ),
			'description'         => __( 'Portfolio', 'themovation-custom-post-types' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
			'taxonomies'          => array( 'themo_project_type' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 99,
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
			'name'                       => _x( 'Project Types', 'Taxonomy General Name', 'themovation-custom-post-types' ),
			'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'themovation-custom-post-types' ),
			'menu_name'                  => __( 'Project Types', 'themovation-custom-post-types' ),
			'all_items'                  => __( 'All Project Types', 'themovation-custom-post-types' ),
			'parent_item'                => __( 'Parent Project Type', 'themovation-custom-post-types' ),
			'parent_item_colon'          => __( 'Parent Project Type:', 'themovation-custom-post-types' ),
			'new_item_name'              => __( 'New Project Type Name', 'themovation-custom-post-types' ),
			'add_new_item'               => __( 'Add New Project Type', 'themovation-custom-post-types' ),
			'edit_item'                  => __( 'Edit Project Type', 'themovation-custom-post-types' ),
			'update_item'                => __( 'Update Project Type', 'themovation-custom-post-types' ),
			'separate_items_with_commas' => __( 'Separate Project Type with commas', 'themovation-custom-post-types' ),
			'search_items'               => __( 'Search Project Types', 'themovation-custom-post-types' ),
			'add_or_remove_items'        => __( 'Add or remove project type', 'themovation-custom-post-types' ),
			'choose_from_most_used'      => __( 'Choose from the most project types', 'themovation-custom-post-types' ),
			'not_found'                  => __( 'Not Found', 'themovation-custom-post-types' ),
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
