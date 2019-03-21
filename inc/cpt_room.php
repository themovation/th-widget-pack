<?php
//-----------------------------------------------------
// themo_room_custom_post_type
// Room Post Type
//-----------------------------------------------------

if ( ! function_exists('themo_room_custom_post_type') ) {

    // Register Custom Post Type
    function themo_room_custom_post_type() {

        $labels = array(
            'name'                => _x( 'Rooms', 'Post Type General Name', 'th-widget-pack' ),
            'singular_name'       => _x( 'Room', 'Post Type Singular Name', 'th-widget-pack' ),
            'menu_name'           => __( 'Rooms', 'th-widget-pack' ),
            'parent_item_colon'   => __( 'Parent Room:', 'th-widget-pack' ),
            'all_items'           => __( 'All Rooms', 'th-widget-pack' ),
            'view_item'           => __( 'View Room', 'th-widget-pack' ),
            'add_new_item'        => __( 'Add New Rooms', 'th-widget-pack' ),
            'add_new'             => __( 'Add New', 'th-widget-pack' ),
            'edit_item'           => __( 'Edit Room', 'th-widget-pack' ),
            'update_item'         => __( 'Update Room', 'th-widget-pack' ),
            'search_items'        => __( 'Search Room', 'th-widget-pack' ),
            'not_found'           => __( 'Not found', 'th-widget-pack' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'th-widget-pack' ),
        );

        if ( function_exists( 'get_theme_mod' ) ) {
            $custom_slug = get_theme_mod( 'themo_room_rewrite_slug', 'room' );
        } else {
            $custom_slug = 'room';
        }

        $rewrite = array(
            'slug'                => $custom_slug,
            'with_front'          => false,
            'pages'               => true,
            'feeds'               => true,
        );
        $args = array(
            'label'               => __( 'themo_room', 'th-widget-pack' ),
            'description'         => __( 'Rooms', 'th-widget-pack' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
            'taxonomies'          => array( 'themo_room_type' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-admin-network',
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'post',
        );
        register_post_type( 'themo_room', $args );

    }

    // Hook into the 'init' action
    add_action( 'init', 'themo_room_custom_post_type', 0 );

}

//-----------------------------------------------------
// themo_room_type
// Project Types Taxonomy
//-----------------------------------------------------

if ( ! function_exists( 'themo_room_type' ) ) {

    // Register Custom Taxonomy
    function themo_room_type() {

        $labels = array(
            'name'                       => _x( 'Room Types', 'Taxonomy General Name', 'th-widget-pack' ),
            'singular_name'              => _x( 'Room Type', 'Taxonomy Singular Name', 'th-widget-pack' ),
            'menu_name'                  => __( 'Room Types', 'th-widget-pack' ),
            'all_items'                  => __( 'All Room Types', 'th-widget-pack' ),
            'parent_item'                => __( 'Parent Room Type', 'th-widget-pack' ),
            'parent_item_colon'          => __( 'Parent Room Type:', 'th-widget-pack' ),
            'new_item_name'              => __( 'New Room Type Name', 'th-widget-pack' ),
            'add_new_item'               => __( 'Add New Room Type', 'th-widget-pack' ),
            'edit_item'                  => __( 'Edit Room Type', 'th-widget-pack' ),
            'update_item'                => __( 'Update Room Type', 'th-widget-pack' ),
            'separate_items_with_commas' => __( 'Separate Room Type with commas', 'th-widget-pack' ),
            'search_items'               => __( 'Search Room Types', 'th-widget-pack' ),
            'add_or_remove_items'        => __( 'Add or remove Room type', 'th-widget-pack' ),
            'choose_from_most_used'      => __( 'Choose from the most Room types', 'th-widget-pack' ),
            'not_found'                  => __( 'Not Found', 'th-widget-pack' ),
        );
        $rewrite = array(
            'slug'                       => 'room-type',
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
        register_taxonomy( 'themo_room_type', array( 'themo_room' ), $args );

    }

    // Hook into the 'init' action
    add_action( 'init', 'themo_room_type', 0 );

}


add_action( 'admin_init', 'th_register_room_meta_boxes' );

function th_register_room_meta_boxes()
{

    //-----------------------------------------------------
    // Page Layout, Sidebar, Content Editor Sort Order
    //-----------------------------------------------------
    $themo_rooms_meta_box = array(
        'id' => 'th_rooms_meta_box',
        'title' => __('Room Grid Options', 'bellevue'),
        'pages' => array('themo_room'),
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
            // START PAGE LAYOUT META BOX

            array(
                'id' => 'th_room_highlight',
                'label' => 'Highlight',
                'type' => 'text',
                'desc' => __('Displayed at the very top in small text. 1 - 3 words recommended', 'bellevue'),
            ),
            array(
                'id' => 'th_room_title',
                'label' => 'Title',
                'type' => 'text',
                'desc' => __('Defaults to the page title.', 'bellevue'),
            ),
            array(
                'id' => 'th_room_intro',
                'label' => 'Intro',
                'type' => 'text',
                'desc' => __('Displayed below the title. 8 - 10 words recommended', 'bellevue'),
            ),
            array(
                'id'    => "th_room_price",
                'label'  =>  'Price',
                'type'  => 'text',
                'desc' => __('Displayed below the title. e.g.: $99', 'bellevue'),
            ),
            array(
                'id'    => "th_room_price_per",
                'label'  =>  'Price per',
                'type'  => 'text',
                'desc' => __('Displayed after the price. e.g.: /night', 'bellevue'),
            ),
            array(
                'id' => 'th_room_button_text',
                'label' => 'Button Text',
                'type' => 'text',
                'desc' => __('Displayed below the intro.', 'bellevue'),
            ),
            array(
                'id'          => "th_room_thumb",
                'label'       => __( 'Alternative Grid Image', 'bellevue'),
                'type'        => 'upload',
                'class'       => 'ot-upload-attachment-id',
                'desc' => 'Helpful when using the "Image Format". The theme will use the Alternative Image for the room grid and the Featured Image for the lightbox.',
            ),
            // END PAGE LAYOUT META BOX
        )
    );

    if (function_exists('ot_register_meta_box')) {
        ot_register_meta_box($themo_rooms_meta_box);
    }

}


function jt_get_allowed_project_formats() {

    return array( 'image','link' );
}

add_action( 'load-post.php',     'jt_post_format_support_filter' );
add_action( 'load-post-new.php', 'jt_post_format_support_filter' );
add_action( 'load-edit.php',     'jt_post_format_support_filter' );

function jt_post_format_support_filter() {

    $screen = get_current_screen();

    // Bail if not on the projects screen.
    if ( empty( $screen->post_type ) ||  $screen->post_type !== 'themo_room' )
        return;

    // Check if the current theme supports formats.
    if ( current_theme_supports( 'post-formats' ) ) {

        $formats = get_theme_support( 'post-formats' );

        // If we have formats, add theme support for only the allowed formats.
        if ( isset( $formats[0] ) ) {
            $new_formats = array_intersect( $formats[0], jt_get_allowed_project_formats() );

            // Remove post formats support.
            remove_theme_support( 'post-formats' );

            // If the theme supports the allowed formats, add support for them.
            if ( $new_formats )
                add_theme_support( 'post-formats', $new_formats );
        }
    }

    // Filter the default post format.
    add_filter( 'option_default_post_format', 'jt_default_post_format_filter', 95 );
}

function jt_default_post_format_filter( $format ) {

    return in_array( $format, jt_get_allowed_project_formats() ) ? $format : 'standard';
}

// hide any extra fields.
if ( ! function_exists( 'th_hide_meta_box' ) ) {
    function th_hide_meta_box($hidden, $screen)
    {
        //make sure we are dealing with the correct screen
        if ('themo_room' == $screen->post_type) {

            //lets hide everything
            $hidden = array('postexcerpt', 'slugdiv', 'postcustom', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
            //$hidden[] = 'my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
        }
        return $hidden;
    }
    add_filter('default_hidden_meta_boxes','th_hide_meta_box',10,2);
}

// Turn off commenting by default.

function th_default_comments_off( $data ) {
    if( $data['post_type'] == 'themo_room' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 0;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'th_default_comments_off' );