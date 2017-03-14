<?php
/**
 * Themovation Shortcodes
 *
 */



    add_action('init', 'th_register_shortcodes');

function th_register_shortcodes() {
    if ( !is_plugin_active( 'themovation-shortcodes/themovation-shortcodes.php' ) ) {

        /*
        ==========================================================
        Carousel / Flex Slider
        ==========================================================
        */
        if ( ! function_exists( 'themo_slider_gallery' ) ) :
            function themo_slider_gallery( $atts, $content = null ) {
                if (!empty($atts['ids'])) {
                    if (empty($atts['orderby'])) {
                        $atts['orderby'] = 'post__in';
                    }
                    $atts['include'] = $atts['ids'];
                }


                if (isset($atts['orderby'])) {
                    $atts['orderby'] = sanitize_sql_orderby($atts['orderby']);
                    if (!$atts['orderby']) {
                        unset($atts['orderby']);
                    }
                }

                extract( shortcode_atts( array(
                    'order'      => 'ASC',
                    'orderby'    => 'menu_order ID',
                    'ids' => '',
                    'exclude' => '',
                    'width' => '',
                    'image_size' => '',
                    'image_size_large' => 'themo_full_width',
                ), $atts ) );

                // sanitize
                $ids = sanitize_text_field($ids);
                $exclude = sanitize_text_field($exclude);
                $width = sanitize_text_field($width);
                $image_size = sanitize_text_field($image_size);
                $image_size_large = sanitize_text_field($image_size_large);

                $order = sanitize_text_field($order);
                $orderby = sanitize_text_field($orderby);

                if ($order === 'RAND') {
                    $orderby = 'none';
                }

                if($width > ""){
                    $width = "width: $width";
                    $width .= "px";
                }
                if ( function_exists( 'ot_get_option' ) ) {
                    $themo_flex_autoplay  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_autoplay', "on" ));
                    $themo_flex_animation  = ot_get_option( 'themo_flex_animation', "fade" );
                    $themo_flex_easing  = ot_get_option( 'themo_flex_easing', "swing" );
                    $themo_flex_animationloop  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_animationloop', 'on' ));
                    $themo_flex_smoothheight  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_smoothheight', 'off' ));
                    $themo_flex_slideshowspeed  = ot_get_option( 'themo_flex_slideshowspeed', 7000 );
                    $themo_flex_animationspeed  = ot_get_option( 'themo_flex_animationspeed', 600 );
                    $themo_flex_randomize  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_randomize', 'off' ));
                    $themo_flex_pauseonhover  =themo_return_on_off_boolean( ot_get_option( 'themo_flex_pauseonhover', 'on' ));
                    $themo_flex_touch  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_touch', 'on' ));
                    $themo_flex_directionnav  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_directionnav', 'on' ));
                }
                $themo_flex_settings = "$themo_flex_autoplay, '$themo_flex_animation', '$themo_flex_easing',
                                $themo_flex_animationloop, $themo_flex_smoothheight, $themo_flex_slideshowspeed, $themo_flex_animationspeed,
                                $themo_flex_randomize, $themo_flex_pauseonhover, $themo_flex_touch, $themo_flex_directionnav";

                $flex_ID = themo_randomString();

                global $post;
                $id = $post->ID;
                if ( !empty($ids) ) {
                    $include = preg_replace( '/[^0-9,]+/', '', $ids );
                    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );


                    $attachments = array();
                    foreach ( $_attachments as $key => $val ) {
                        $attachments[$val->ID] = $_attachments[$key];
                    }
                } elseif ( !empty($exclude) ) {
                    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
                    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
                } else {
                    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
                }

                $output = 	"<script>\n jQuery(document).ready(function($) { \n
                            themo_start_flex_slider('#$flex_ID', $themo_flex_settings ); \n
                            }); \n
                        </script>\n";
                $output .= "<div id='$flex_ID' class='flexslider gallery' style='$width'>";
                $output .= "<ul class='slides'>";

                foreach ( $attachments as $id => $attachment ) {
                    $link = wp_get_attachment_url( $id );

                    $output .='<li>';

                    $image_large_attributes = wp_get_attachment_image_src( $attachment->ID, $image_size_large) ;

                    if( $image_large_attributes ) {
                        $image_large_src = $image_large_attributes[0];
                    }else{
                        $image_large_src = wp_get_attachment_url( $attachment->ID );
                    }

                    $image_attributes = wp_get_attachment_image_src( $attachment->ID, $image_size) ;


                    $alt_text = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
                    if ($alt_text > ""){
                        $alt_text = "alt='".$alt_text."'";
                    }

                    if( $image_attributes ) {
                        //echo $image_size;
                        $image_src = $image_attributes[0];
                        //echo $image_src;
                    }else{
                        $image_src = wp_get_attachment_url( $attachment->ID );
                    }

                    $output .= "<a href='".$image_large_src."' data-toggle='lightbox' data-gallery='multiimages'>";
                    $output .= "<img src='".$image_src."' $alt_text />";
                    $output .= "</a>";
                    $output .= "</li>";
                }

                $output .= "</ul><!--  END FLEX UL -->";
                $output .= "</div><!--  END FLEX DIV -->";
                return $output;
            }

            add_shortcode('slider_gallery', 'themo_slider_gallery');
        endif;

        /**
         * Clean up gallery_shortcode()
         *
         * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
         * The number of columns must be a factor of 12.
         *
         * @link http://getbootstrap.com/components/#thumbnails
         */
        if ( ! function_exists( 'roots_gallery' ) ) :
            function roots_gallery($attr) {
                $post = get_post();

                static $instance = 0;
                $instance++;

                if (!empty($attr['ids'])) {
                    if (empty($attr['orderby'])) {
                        $attr['orderby'] = 'post__in';
                    }
                    $attr['include'] = $attr['ids'];
                }

                $output = apply_filters('post_gallery', '', $attr);

                if ($output != '') {
                    return $output;
                }

                if (isset($attr['orderby'])) {
                    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
                    if (!$attr['orderby']) {
                        unset($attr['orderby']);
                    }
                }

                extract(shortcode_atts(array(
                    'order'      => 'ASC',
                    'orderby'    => 'menu_order ID',
                    'id'         => $post->ID,
                    'itemtag'    => '',
                    'icontag'    => '',
                    'captiontag' => '',
                    'columns'    => 3,
                    'size'       => 'thumbnail',
                    'include'    => '',
                    'exclude'    => '',
                    'link'       => ''
                ), $attr));



                $id = intval($id);
                $columns = (12 % $columns == 0) ? $columns: 4;

                $grid = sprintf('col-sm-%1$s col-lg-%1$s', 12/$columns);

                if ($order === 'RAND') {
                    $orderby = 'none';
                }

                if (!empty($include)) {
                    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

                    $attachments = array();
                    foreach ($_attachments as $key => $val) {
                        $attachments[$val->ID] = $_attachments[$key];
                    }
                } elseif (!empty($exclude)) {
                    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
                } else {
                    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
                }

                if (empty($attachments)) {
                    return '';
                }

                if (is_feed()) {
                    $output = "\n";
                    foreach ($attachments as $att_id => $attachment) {
                        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
                    }
                    return $output;
                }

                $unique = (get_query_var('page')) ? $instance . '-p' . get_query_var('page'): $instance;
                $output = '<div class="gallery gallery-' . $id . '-' . $unique . '">';

                // We used to adjust size by column but now we let the user choose.
                //$size = return_gallery_thumb_size($columns);

                $i = 0;
                foreach ($attachments as $id => $attachment) {

                    $img_attr = array(
                        'class'	=> "thumbnail img-thumbnail test",
                    );

                    switch($link) {
                        case 'file':
                            $image = wp_get_attachment_link($id, $size, false, false);
                            break;
                        case 'none':
                            $image = wp_get_attachment_image($id, $size, false, $img_attr);
                            break;
                        default:
                            $image = wp_get_attachment_link($id, $size, true, false);
                            break;
                    }
                    $output .= ($i % $columns == 0) ? '<div class="row gallery-row">': '';
                    $output .= '<div class="' . $grid .'">' . $image;

                    $gallery_text_div_open = "";
                    $gallery_text_div_close = "";

                    if(trim($attachment->post_title) || trim($attachment->post_excerpt)){
                        $gallery_text_div_open = '<div class="gallery-text">';
                        $gallery_text_div_close = "</div>";
                    }

                    $output .= $gallery_text_div_open;

                    if (trim($attachment->post_title)) {
                        $output .= '<div class="image-title">' . wptexturize($attachment->post_title) . '</div>';
                    }

                    if (trim($attachment->post_excerpt)) {
                        $output .= '<div class="caption">' . wptexturize($attachment->post_excerpt) . '</div>';
                    }

                    $output .= $gallery_text_div_close;

                    $output .= '</div>';
                    $i++;
                    $output .= ($i % $columns == 0) ? '</div>' : '';
                }

                $output .= ($i % $columns != 0 ) ? '</div>' : '';
                $output .= '</div>';

                return $output;
            }
            remove_shortcode('gallery');
            add_shortcode('gallery', 'roots_gallery');
            add_filter('use_default_gallery_style', '__return_null');
        endif;


    }

}
