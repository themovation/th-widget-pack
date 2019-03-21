<?php
//-----------------------------------------------------
// mphb_room_type
// MotoPress Accommodation Post Type Add-ons
//-----------------------------------------------------


add_action( 'admin_init', 'th_register_mphb_room_type_meta_boxes' );

function th_register_mphb_room_type_meta_boxes()
{

    //-----------------------------------------------------
    // Page Layout, Sidebar, Content Editor Sort Order
    //-----------------------------------------------------
    $themo_rooms_meta_box = array(
        'id' => 'th_rooms_meta_box',
        'title' => __('Accommodation Grid Options', 'bellevue'),
        'pages' => array('mphb_room_type'),
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