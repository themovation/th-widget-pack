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
			$custom_slug = ot_get_option( 'themo_portfolio_rewrite_slug', 'course' );
		} else {
			$custom_slug = 'course';
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
			'slug'                       => 'hole-type',
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

/**
 * Add holes meta box
 */
function themo_holes_add_meta_box( $post ) {
	add_meta_box(
		'themo_holes_meta_box',
		__( 'Hole', 'themovation-widgets' ),
		'themo_holes_build_meta_box',
		'themo_portfolio',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes_themo_portfolio', 'themo_holes_add_meta_box' );

/**
 * Build holes meta box
 */
function themo_holes_build_meta_box( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'themo_holes_meta_box_nonce' );

	$current_holes_number = get_post_meta( $post->ID, '_holes_number', true );
	$current_holes_par = get_post_meta( $post->ID, '_holes_par', true );
	$current_holes_yards = get_post_meta( $post->ID, '_holes_yards', true );
	$current_holes_handicap = get_post_meta( $post->ID, '_holes_handicap', true );

	?>
	<div class='inside'>

		<h4 style="margin-bottom: 0"><?php _e( 'Hole #', 'themovation-widgets' ); ?></h4>
		<p style="margin: 0">
			<input type="text" name="hole-number" value="<?php echo $current_holes_number; ?>" />
		</p>

		<h4 style="margin-bottom: 0"><?php _e( 'Par', 'themovation-widgets' ); ?></h4>
		<p style="margin: 0">
			<input type="text" name="par" value="<?php echo $current_holes_par; ?>" />
		</p>

		<h4 style="margin-bottom: 0"><?php _e( 'Yards', 'themovation-widgets' ); ?></h4>
		<p style="margin: 0">
			<input type="text" name="yards" value="<?php echo $current_holes_yards; ?>" />
		</p>

		<h4 style="margin-bottom: 0"><?php _e( 'Handicap', 'themovation-widgets' ); ?></h4>
		<p style="margin: 0">
			<input type="text" name="handicap" value="<?php echo $current_holes_handicap; ?>" />
		</p>

	</div>
	<?php
}

/**
 * Save holes meta box
 */
function themo_holes_save_meta_box( $post_id ) {

	if ( !isset( $_POST['themo_holes_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['themo_holes_meta_box_nonce'], basename( __FILE__ ) ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_REQUEST['hole-number'] ) ) {
		update_post_meta( $post_id, '_holes_number', sanitize_text_field( $_POST['hole-number'] ) );
	}

	if ( isset( $_REQUEST['par'] ) ) {
		update_post_meta( $post_id, '_holes_par', sanitize_text_field( $_POST['par'] ) );
	}

	if ( isset( $_REQUEST['yards'] ) ) {
		update_post_meta( $post_id, '_holes_yards', sanitize_text_field( $_POST['yards'] ) );
	}

	if ( isset( $_REQUEST['handicap'] ) ) {
		update_post_meta( $post_id, '_holes_handicap', sanitize_text_field( $_POST['handicap'] ) );
	}

}
add_action( 'save_post_themo_portfolio', 'themo_holes_save_meta_box', 10, 2 );
