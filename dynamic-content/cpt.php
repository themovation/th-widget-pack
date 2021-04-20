<?php 
namespace ThWidgetPack\Modules\Dynamic_Content;

defined( 'ABSPATH' ) || exit;

class Cpt{

    public function __construct() {
        add_action( 'init', [ $this, 'post_type' ] );
        register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
        register_activation_hook( __FILE__, [$this, 'flush_rewrites'] );   
    }

    public function post_type() {
        
        $labels = array(
            'name'                  => _x( 'ThWidgetPack items', 'Post Type General Name', 'th-widget-pack' ),
            'singular_name'         => _x( 'ThWidgetPack item', 'Post Type Singular Name', 'th-widget-pack' ),
            'menu_name'             => esc_html__( 'ThWidgetPack item', 'th-widget-pack' ),
            'name_admin_bar'        => esc_html__( 'ThWidgetPack item', 'th-widget-pack' ),
            'archives'              => esc_html__( 'Item Archives', 'th-widget-pack' ),
            'attributes'            => esc_html__( 'Item Attributes', 'th-widget-pack' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'th-widget-pack' ),
            'all_items'             => esc_html__( 'All Items', 'th-widget-pack' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'th-widget-pack' ),
            'add_new'               => esc_html__( 'Add New', 'th-widget-pack' ),
            'new_item'              => esc_html__( 'New Item', 'th-widget-pack' ),
            'edit_item'             => esc_html__( 'Edit Item', 'th-widget-pack' ),
            'update_item'           => esc_html__( 'Update Item', 'th-widget-pack' ),
            'view_item'             => esc_html__( 'View Item', 'th-widget-pack' ),
            'view_items'            => esc_html__( 'View Items', 'th-widget-pack' ),
            'search_items'          => esc_html__( 'Search Item', 'th-widget-pack' ),
            'not_found'             => esc_html__( 'Not found', 'th-widget-pack' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'th-widget-pack' ),
            'featured_image'        => esc_html__( 'Featured Image', 'th-widget-pack' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'th-widget-pack' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'th-widget-pack' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'th-widget-pack' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'th-widget-pack' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'th-widget-pack' ),
            'items_list'            => esc_html__( 'Items list', 'th-widget-pack' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'th-widget-pack' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'th-widget-pack' ),
        );
        $rewrite = array(
            'slug'                  => 'thwidgetpack-content',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__( 'ThWidgetPack item', 'th-widget-pack' ),
            'description'           => esc_html__( 'thwidgetpack_content', 'th-widget-pack' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor', 'permalink' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => false,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable' => true,
            'rewrite'               => $rewrite,
            'query_var' => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => 'thwidgetpack-content',
        );
        register_post_type( 'thwidgetpack_content', $args );
    }

    public function flush_rewrites() {
        $this->post_type();
        flush_rewrite_rules();
    }
}

new Cpt();