<?php
//-----------------------------------------------------
// th_string_contains
// IF String contains any items in an array (case insensitive).
//-----------------------------------------------------
function th_string_contains($str, $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

//-----------------------------------------------------
// th_RandNumber
// Return a random number
//-----------------------------------------------------
function th_RandNumber($e){
    $rand = 0;
    for($i=0;$i<$e;$i++){
        $rand =  $rand .  rand(0, 9);
    }
    return $rand;
}

//-----------------------------------------------------
// Generate random string
// @return string
//-----------------------------------------------------
function th_randomString($length = 6) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }

    return $str;
}

// Elementor Page Settings needs to be synced with Option Tree Settings.
// Compare and update to stay synced.
if ( ! function_exists( 'sync_ot_and_elem_page_settings' ) ) {
    function sync_ot_and_elem_page_settings() {
        global $post;
        if(isset($post->ID)){
            $post_id = $post->ID;

            $page = \Elementor\Plugin::$instance->documents->get( $post_id );

            if ( $page ) {

                $elm_trans_header = $page->get_settings_for_display('themo_transparent_header');
                $elm_page_layout = $page->get_settings_for_display('themo_page_layout');
                $elm_hide_title = $page->get_settings_for_display('hide_title');
                $elm_header_content_style = $page->get_settings_for_display('themo_header_content_style');
                $elm_alt_logo = $page->get_settings_for_display('themo_alt_logo');

                if (empty($elm_trans_header)) {
                    $elm_trans_header = 'off';
                }
                if (empty($elm_hide_title)) {
                    $elm_hide_title = 'off';
                } else {
                    $elm_hide_title = 'on';
                }

                update_post_meta($post_id, 'themo_transparent_header', $elm_trans_header);
                update_post_meta($post_id, 'themo_page_layout', $elm_page_layout);
                update_post_meta($post_id, 'themo_hide_title', $elm_hide_title); //hide_title
                update_post_meta($post_id, 'themo_header_content_style', $elm_header_content_style);
                update_post_meta($post_id, 'themo_alt_logo', $elm_alt_logo);

                //}
            }

        }
    }
}
if( function_exists( 'elementor_load_plugin_textdomain' ) ) {
    //add_action('admin_head', 'sync_ot_and_elem_page_settings'); // When WP Admin is loaded
    //add_action('template_redirect', 'sync_ot_and_elem_page_settings'); // When Pages and posts are loaded
    //add_action( 'elementor/editor/after_save', 'th_update_elem_page_settings_post_meta') ; // When Elementor Editor is saved.
}



// Option Tree Page Settings needs to be synced with Elementor Page Settings.
// Compare and update to stay synced.

if ( ! function_exists( 'th_check_meta_change' ) ) {
    function th_check_meta_change($meta_id, $post_id, $meta_key, $meta_value){

        // Hide Title Setting
        if ('themo_hide_title' == $meta_key) {
            $ot_setting = get_post_meta($post_id, 'themo_hide_title', true);

            // Are there settings from the Elementor Page Options?
            $elm_page_settings = get_post_meta($post_id, "_elementor_page_settings");

            if (isset($elm_page_settings)) {
                // If this options exists, check to see if OT needs updating.
                if (isset($elm_page_settings[0]['hide_title'])) {

                    $elm_setting = $elm_page_settings[0]['hide_title'];

                    if (empty($elm_setting)) {
                        $elm_setting = 'off';
                    }else{
                        $elm_setting = 'on';
                    }

                    if ($ot_setting == $elm_setting) {
                        return;
                    } else {
                        if ($ot_setting == 'off') {
                            $elm_page_settings[0]['hide_title'] = '';
                        } else {
                            $elm_page_settings[0]['hide_title'] = 'yes';
                        }
                        update_post_meta($post_id, '_elementor_page_settings', $elm_page_settings[0]);
                    }
                } else {
                    if ($ot_setting == 'off' || $ot_setting == '') {
                        $elm_page_settings[0]['hide_title'] = '';
                    } else {
                        $elm_page_settings[0]['hide_title'] = 'yes';
                    }
                    update_post_meta($post_id, '_elementor_page_settings', $elm_page_settings[0]);

                }
            }

        }

        // Transparent Header Setting
        if ('themo_transparent_header' == $meta_key) {
            $ot_themo_transparent_header = get_post_meta($post_id, 'themo_transparent_header', true);

            // Are there settings from the Elementor Page Options?
            $elm_page_settings = get_post_meta($post_id, "_elementor_page_settings");

            if (isset($elm_page_settings)) {
                // If this options exists, check to see if OT needs updating.
                if (isset($elm_page_settings[0]['themo_transparent_header'])) {

                    $elm_trans_header = $elm_page_settings[0]['themo_transparent_header'];

                    if (empty($elm_trans_header)) {
                        $elm_trans_header = 'off';
                    }

                    if ($ot_themo_transparent_header == $elm_trans_header) {
                        return;
                    } else {
                        if ($ot_themo_transparent_header == 'off') {
                            $elm_page_settings[0]['themo_transparent_header'] = '';
                        } else {
                            $elm_page_settings[0]['themo_transparent_header'] = 'on';
                        }
                        update_post_meta($post_id, '_elementor_page_settings', $elm_page_settings[0]);
                    }
                } else {
                    if ($ot_themo_transparent_header == 'off' || $ot_themo_transparent_header == '') {
                        $elm_page_settings[0]['themo_transparent_header'] = '';
                    } else {
                        $elm_page_settings[0]['themo_transparent_header'] = 'on';
                    }
                    update_post_meta($post_id, '_elementor_page_settings', $elm_page_settings[0]);

                }
            }

        }

        // Page Side Bar Setting
        if ('themo_page_layout' == $meta_key) {
            $ot_setting = get_post_meta($post_id, 'themo_page_layout', true);

            // Are there settings from the Elementor Page Options?
            $elm_page_settings = get_post_meta($post_id, "_elementor_page_settings");

            if (isset($elm_page_settings)) {
                // If this options exists, check to see if OT needs updating.
                if (isset($elm_page_settings[0]['themo_page_layout'])) {

                    $elm_settings = $elm_page_settings[0]['themo_page_layout'];

                    if ($ot_setting == $elm_settings) {
                        return;
                    } else {
                        $elm_page_settings[0]['themo_page_layout'] = $ot_setting;
                        update_post_meta($post_id, '_elementor_page_settings', $elm_page_settings[0]);
                    }
                } else {
                    $elm_page_settings[0]['themo_page_layout'] = $ot_setting;
                    update_post_meta($post_id, '_elementor_page_settings', $elm_page_settings[0]);

                }
            }

        }
    }
}
add_action('updated_post_meta', 'th_check_meta_change', 0, 4);


/* Elementor Hooks  */

/*
 * Applied to the PHP html content of a single widget.
 *
 */

/*add_action( 'elementor/widget/render_content', function( $content, $widget ) {

    // Wrap Sideba Widget with our own classes.
    if ( 'sidebar' === $widget->get_name() ) {
        $tmp_content = $content;
        $content = '<div class="sidebar th-widget-area th-sidebar-widget">';
        $content .= $tmp_content;
        $content .= '</div>';
    }

    return $content;
}, 10, 2 );*/


/*
 * Wrap the sidebar widget for our theme styling.
 *
 */

add_action( 'elementor/frontend/widget/before_render', 'th_wrap_sidebar_before', 10, 2 );

function th_wrap_sidebar_before( \Elementor\Widget_Base $widget ) {

    if(is_object($widget)){
        // Wrap Sidebar Widget with our own classes.
        if ( 'sidebar' === $widget->get_name() ) {
            echo '<!-- Themovaiton Sidebar Wrap before -->';
            echo '<div class="sidebar th-widget-area th-sidebar-widget">';
        }
    }
}

add_action( 'elementor/frontend/widget/after_render', 'th_wrap_sidebar_after', 10, 2 );

function th_wrap_sidebar_after( \Elementor\Widget_Base $widget ) {

    if(is_object($widget)){
        // Wrap Sidebar Widget with our own classes.
        if ( 'sidebar' === $widget->get_name() ) {
            echo '</div>';
            echo '<!-- Themovaiton Sidebar Wrap after -->';
        }
    }
}

// On Elementor save, update old page settings post meta
if ( ! function_exists( 'themov_update_meta' ) ) {
    function themov_update_meta($doc, $data){

        if(isset($doc) && isset($data)){

            $post_id = $doc->get_post()->ID;

            $elm_trans_header = isset( $data['settings']['themo_transparent_header'] ) ? $data['settings']['themo_transparent_header'] : 'off';
            $elm_page_layout = isset( $data['settings']['themo_page_layout'] ) ? $data['settings']['themo_page_layout'] : '';
            $elm_hide_title = isset( $data['settings']['hide_title'] ) ? $data['settings']['hide_title'] : 'off';
            $elm_header_content_style = isset( $data['settings']['themo_header_content_style'] ) ? $data['settings']['themo_header_content_style'] : 'light';
            $elm_alt_logo = isset( $data['settings']['themo_alt_logo'] ) ? $data['settings']['themo_alt_logo'] : 'on';

            update_post_meta($post_id, 'themo_transparent_header', $elm_trans_header);
            update_post_meta($post_id, 'themo_page_layout', $elm_page_layout);
            update_post_meta($post_id, 'themo_hide_title', $elm_hide_title); //hide_title
            update_post_meta($post_id, 'themo_header_content_style', $elm_header_content_style);
            update_post_meta($post_id, 'themo_alt_logo', $elm_alt_logo);
        }

    }
}

// Update Meta Data
add_action( 'elementor/document/before_save', 'themov_update_meta', 10, 2 );