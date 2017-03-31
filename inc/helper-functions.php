<?php

// Elementor Page Settings needs to be synced with Option Tree Settings.
// Compare and update to stay synced.
if ( ! function_exists( 'sync_ot_and_elem_page_settings' ) ) {
    function sync_ot_and_elem_page_settings() {
        global $post;
        if($post->ID){
            $post_id = $post->ID;

            // Are there settings from the Elementor Page Options?
            $elm_page_settings = get_post_meta( $post_id,"_elementor_page_settings");

            //var_dump($elm_page_settings);

            if(isset($elm_page_settings[0]['themo_transparent_header']) && isset($elm_page_settings[0]['themo_page_layout']) && isset($elm_page_settings[0]['hide_title'])){

                $elm_trans_header = $elm_page_settings[0]['themo_transparent_header'];
                $elm_page_layout = $elm_page_settings[0]['themo_page_layout'];
                $elm_hide_title = $elm_page_settings[0]['hide_title'];

                if(empty($elm_trans_header)){
                    //echo "EMPTY";
                    $elm_trans_header = 'off';
                }
                if(empty($elm_hide_title)){
                    //echo "EMPTY";
                    $elm_hide_title = 'off';
                }else{
                    $elm_hide_title = 'on';
                }

                update_post_meta($post_id,'themo_transparent_header',$elm_trans_header);
                update_post_meta($post_id,'themo_page_layout',$elm_page_layout);
                update_post_meta($post_id,'themo_hide_title',$elm_hide_title); //hide_title

            }

        }
    }
}
add_action( 'admin_head', 'sync_ot_and_elem_page_settings' ); // When WP Admin is loaded
add_action( 'template_redirect', 'sync_ot_and_elem_page_settings' ); // When Pages and posts are loaded
add_action( 'elementor/editor/after_save', 'th_update_elem_page_settings_post_meta') ; // When Elementor Editor is saved.



// Option Tree Page Settings needs to be synced with Elementor Page Settings.
// Compare and update to stay synced.

if ( ! function_exists( 'th_check_meta_change' ) ) {
    function th_check_meta_change($meta_id, $post_id, $meta_key, $meta_value){

        // Hide Title Setting
        if ('themo_hide_title' == $meta_key) {
            $ot_setting = get_post_meta($post_id, 'themo_hide_title', 'off');

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
                    if ($ot_setting == 'off') {
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
                    if ($ot_themo_transparent_header == 'off') {
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