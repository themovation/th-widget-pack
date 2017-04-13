<?php



//-----------------------------------------------------
// themo_string_contains
// IF String contains any items in an array (case insensitive).
//-----------------------------------------------------
function themo_string_contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

//-----------------------------------------------------
// themo_RandNumber
// Return a random number
//-----------------------------------------------------
function themo_RandNumber($e){
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
function themo_randomString($length = 6) {
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
        if($post->ID){
            $post_id = $post->ID;

            // Are there settings from the Elementor Page Options?
            $elm_page_settings = get_post_meta( $post_id,"_elementor_page_settings");

            //var_dump($elm_page_settings);

            if(isset($elm_page_settings[0]['themo_transparent_header']) && isset($elm_page_settings[0]['themo_page_layout'])
                && isset($elm_page_settings[0]['hide_title']) && isset($elm_page_settings[0]['themo_header_content_style'])
                && isset($elm_page_settings[0]['themo_alt_logo'])){

                $elm_trans_header = $elm_page_settings[0]['themo_transparent_header'];
                $elm_page_layout = $elm_page_settings[0]['themo_page_layout'];
                $elm_hide_title = $elm_page_settings[0]['hide_title'];
                $elm_header_content_style = $elm_page_settings[0]['themo_header_content_style'];
                $elm_alt_logo = $elm_page_settings[0]['themo_alt_logo'];

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
                update_post_meta($post_id,'themo_header_content_style',$elm_header_content_style);
                update_post_meta($post_id,'themo_alt_logo',$elm_alt_logo);

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


/* Elementor Hooks  */

/*
 * Applied to the PHP html content of a single widget.
 *
 */

add_action( 'elementor/widget/render_content', function( $content, $widget ) {

    // Wrap Sideba Widget with our own classes.
    if ( 'sidebar' === $widget->get_name() ) {
        $tmp_content = $content;
        $content = '<div class="sidebar th-widget-area th-sidebar-widget">';
        $content .= $tmp_content;
        $content .= '</div>';
    }

    /*
     * IMAGE GALLERY WIDGET
     * Add Image Stretch Option Control
     */
    if ( 'image-gallery-x' === $widget->get_name() ) {

        $settings = $widget->get_settings();


        $gallery_class = false;
        if ( 'yes' === $settings['image_stretch'] ) {
            $gallery_class = 'th-image-stretch';
        }

        $content = '<div class="elementor-image-gallery '.$gallery_class.'">';
        $content .= do_shortcode( '[gallery ' . $widget->get_render_attribute_string( 'shortcode' ) . ']' );
        $content .= '</div>';

    }

    /*
     * TESTIMONIAL WIDGET
     * Use specific image size, th_img_sm_square
     */
    if ( 'testimonialx' === $widget->get_name() ) {
        $settings = $widget->get_settings();

        if ( empty( $settings['testimonial_name'] ) || empty( $settings['testimonial_content'] ) )
            return;

        $has_image = false;
        if ( '' !== $settings['testimonial_image']['url'] ) {
            $image_url = $settings['testimonial_image']['url'];
            $has_image = ' elementor-has-image';
        }

        if ( ! empty( $settings['testimonial_image'] ) ) {

            if ( $settings['testimonial_image']['id'] ) $image = wp_get_attachment_image( $settings['testimonial_image']['id'], 'th_img_sm_square', false, array( 'class' => 'th-team-member-image' ) );

        }

        $testimonial_alignment = $settings['testimonial_alignment'] ? ' elementor-testimonial-text-align-' . $settings['testimonial_alignment'] : '';
        $testimonial_image_position = $settings['testimonial_image_position'] ? ' elementor-testimonial-image-position-' . $settings['testimonial_image_position'] : '';
        ?>
        <div class="elementor-testimonial-wrapper<?php echo $testimonial_alignment; ?>">

            <?php if ( ! empty( $settings['testimonial_content'] ) ) : ?>
                <div class="elementor-testimonial-content">
                    <?php echo $settings['testimonial_content']; ?>
                </div>
            <?php endif; ?>

            <div class="elementor-testimonial-meta<?php if ( $has_image ) echo $has_image; ?><?php echo $testimonial_image_position; ?>">
                <div class="elementor-testimonial-meta-inner">
                    <?php if ( isset( $image ) ) : ?>
                        <div class="elementor-testimonial-image">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <div class="elementor-testimonial-details">
                        <?php if ( ! empty( $settings['testimonial_name'] ) ) : ?>
                            <div class="elementor-testimonial-name">
                                <?php echo $settings['testimonial_name']; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['testimonial_job'] ) ) : ?>
                            <div class="elementor-testimonial-job">
                                <?php echo $settings['testimonial_job']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $content = "";
    }

    return $content;
}, 10, 2 );


/*
 * Applied to the javascript preview templates.
 */

add_action( 'elementor/widget/print_template', function( $template, $widget ) {


    /*
     * TESTIMONIAL WIDGET
     * Use specific image size, th_img_sm_square
     */
    if ( 'testimonialx' === $widget->get_name() ) {
        ?>
        <#
            var imageUrl = false, hasImage = '';
            if ( '' !== settings.testimonial_image.url ) {
            imageUrl = settings.testimonial_image.url;
            hasImage = ' elementor-has-image';
            }

            var testimonial_alignment = settings.testimonial_alignment ? ' elementor-testimonial-text-align-' + settings.testimonial_alignment : '';
            var testimonial_image_position = settings.testimonial_image_position ? ' elementor-testimonial-image-position-' + settings.testimonial_image_position : '';
            #>
            <div class="elementor-testimonial-wrapper{{ testimonial_alignment }}">

                <# if ( '' !== settings.testimonial_content ) { #>
                    <div class="elementor-testimonial-content">
                        {{{ settings.testimonial_content }}}
                    </div>
                    <# } #>

                        <div class="elementor-testimonial-meta{{ hasImage }}{{ testimonial_image_position }}">
                            <div class="elementor-testimonial-meta-inner">
                                <# if ( imageUrl ) { #>
                                    <div class="elementor-testimonial-image">
                                        <img src="{{ imageUrl }}" alt="testimonial" />
                                    </div>
                                    <# } #>

                                        <div class="elementor-testimonial-details">
                                            <# if ( '' !== settings.testimonial_name ) { #>
                                                <div class="elementor-testimonial-name">
                                                    {{{ settings.testimonial_name }}}
                                                </div>
                                                <# } #>

                                                    <# if ( '' !== settings.testimonial_job ) { #>
                                                        <div class="elementor-testimonial-job">
                                                            {{{ settings.testimonial_job }}}
                                                        </div>
                                                        <# } #>
                                        </div>
                            </div>
                        </div>
            </div>
        <?php
        $template = "";
    }

    return $template;
}, 10, 2 );

/*
 * add additional controls to existing sections.
 */

add_action( 'elementor/element/before_section_end', function( $element, $section_id, $args ) {

    /*
     * IMAGE GALLERY WIDGET
     * Add Image Stretch Option Control
     */
    if ( 'image-gallery-x' === $element->get_name() && 'section_gallery-x' === $section_id ) {

        /*$element->add_control(
            'image_stretch',
            [
                'label' => __( 'Image Stretch', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'no' => __( 'No', 'elementor' ),
                    'yes' => __( 'Yes', 'elementor' ),
                ],
            ]
        );*/
    }
}, 10, 3 );