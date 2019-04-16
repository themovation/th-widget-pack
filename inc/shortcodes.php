<?php
/**
 * Themovation Shortcodes
 *
 */

/*
==========================================================
Accordion
==========================================================
*/
function th_accordion( $atts, $content ){
    extract( shortcode_atts( array(
        'title' => '',
        'icon' => ''
    ), $atts ) );

    $content = wp_kses_post($content);

    global $group_ID, $accordion_count;

    $collapse_ID = th_randomString();
    $accordion_count++;

    if ($accordion_count == 1){
        $in = 'in';
    }else{
        $in = '';
    }

    $glyphicon_markup = false;
    if(isset($icon) && $icon > ""){
        $glyphicon_markup = '<i class="'.$icon.'"></i>';
    }



    $output = 		'<div class="panel panel-default">';
    $output .= 			'<div class="panel-heading">';
    $output .= 				'<h4 class="panel-title">';
    $output .= 					'<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$group_ID.'" href="#'.$collapse_ID.'">'.$glyphicon_markup.$title.'</a>';
    $output .= 				'</h4>';
    $output .= 			'</div><!-- end heading -->';
    $output .= 			'<div id="'.$collapse_ID.'" class="panel-collapse collapse '.$in.'">';
    $output .= 				'<div class="panel-body">';
    $output .= 					do_shortcode( $content );
    $output .= 				'</div>';
    $output .= 			'</div><!-- end body -->';
    $output .= 		'</div><!-- end panel -->';

    return $output;
}

add_shortcode( 'accordion', 'th_accordion' );

/*
==========================================================
Accordion Group
==========================================================
*/
function th_accordion_group( $atts, $content ) {

    global $group_ID, $accordion_count;
    $group_ID = th_randomString();


    $output = '<div class="panel-group" id="'.$group_ID.'">';
    $output .= do_shortcode( $content );
    $output .= '</div><!-- end group -->';

    return $output;
}

add_shortcode('accordion_group', 'th_accordion_group');

/*
==========================================================
Alerts
==========================================================
*/
function th_alerts( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'type' => 'alert-info', /* alert-info, alert-success, alert-danger, alert-warning */
        'block' => 'false',
        'close' => 'false', /* display close link */
        'heading' => ''
    ), $atts ) );

    // sanitize
    $type = sanitize_html_class($type);
    $block = sanitize_html_class($block);
    $close = sanitize_html_class($close);
    $heading = sanitize_text_field($heading);
    $content = wp_kses_post($content);

    if($block == 'true') {$alertblock = 'alert-block';}
    $output = '<div class="fade in alert '. $type . ' '. $block . '">';
    if($close == 'true') {
        $icon = do_shortcode('[ icon="fa fa-minus" wrapper=i]');
        $output .= '<a class="close" data-dismiss="alert">'.$icon.'</a>';
    }
    if($heading <> '') {
        $output .= '<h4 class="alert-heading">'.$heading.'</h4>';
    }
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}

add_shortcode('alert', 'th_alerts');

/*
==========================================================
Blockquotes
==========================================================
*/
function th_blockquotes( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'reverse' => '', /* on, off */
        'cite' => '', /* text for cite */
        'align' => '', /* left, right */
        'name' => '', // Person's Name
    ), $atts ) );

    // sanitize
    $content = wp_kses_post($content);
    $name = sanitize_text_field($name);
    $cite = sanitize_text_field($cite);
    $reverse = sanitize_html_class($reverse);
    $align = sanitize_html_class($align);


    $output = '<blockquote class="';
    if($reverse == 'on') {
        $output .= 'blockquote-reverse ';
    }

    if($align == 'left') {
        $output .= 'text-left ';
    }
    elseif($align == 'right'){
        $output .= 'text-right ';
    }

    $output .= '"><p>'.$content.'</p>';

    $space = "";

    if ($cite > ""){
        $cite = '<cite class="blockquote-space" title="'.$cite.'">'.$cite.'</cite>';
    }

    if($name > "" || $cite > ""){
        $output .= '<footer>'.$name.$cite.'</footer>';
    }

    $output .= '</blockquote>';

    return $output;
}

add_shortcode('blockquote', 'th_blockquotes');


/*
==========================================================
Button Group
==========================================================
*/
function th_button_group( $atts, $content ) {
    extract( shortcode_atts( array(
        'variation' => '',
    ), $atts ) );

    $variation = sanitize_html_class($variation); // sanitize

    if($variation == "justified" ){
        $variation = "btn-group-justified";
    }

    $output = '<div class="btn-group '.$variation.'">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    return $output;}

add_shortcode('button_group', 'th_button_group');

/*
==========================================================
Buttons
==========================================================
*/
function th_buttons( $atts, $content = null) {
    extract( shortcode_atts( array(
        'type' => 'default', /* primary, default, info, success, danger, warning, inverse, cta */
        'size' => '', /* lg, sm, xs */
        'url'  => '',
        'text' => '',
        'icon' => '',
        'icon_halflings' => '',
        'icon_social' => '',
        'icon_filetype' => '',
        'iconcolor' => '',
        'target' => '_self',
        'dropdown' => '',
        'split' => '',
        'title' => '',
        'rel' => '',
        'role' => '',
        'data_toggle' => '',
        'data_target' => '',
        'data_placement' => '',
        'data_content' => '',
        'data_trigger' => '',
        'extra_classes' => '',
    ), $atts ) );



    // sanitize
    $type = sanitize_html_class($type);
    $size = sanitize_html_class($size);
    $url = esc_url($url);
    $text = sanitize_text_field($text);
    $icon = sanitize_text_field($icon);
    $icon_halflings = sanitize_text_field($icon_halflings);
    $icon_social = sanitize_text_field($icon_social);
    $icon_filetype = sanitize_text_field($icon_filetype);
    $iconcolor = sanitize_html_class($iconcolor);


    $target_attr = "";
    if($target > ""){
        $target_attr = "target='".sanitize_html_class($target)."'";
    }

    $dropdown = sanitize_html_class($dropdown);
    $split = sanitize_html_class($split);
    $title = sanitize_text_field($title);
    $rel = sanitize_html_class($rel);
    $role = sanitize_html_class($role);
    $data_toggle = sanitize_html_class($data_toggle);
    $data_target = sanitize_text_field($data_target);
    $data_placement = sanitize_html_class($data_placement);
    $data_content = wp_kses_post($data_content);
    $data_trigger = sanitize_html_class($data_trigger);
    $extra_classes = sanitize_html_class($extra_classes);

    // If this is a dropdown button, then insert dropdown-toggle class and also data-toggle
    if($dropdown == 'yes'){
        $dropdown = "dropdown-toggle";
        $data_toggle = "dropdown";
        $dropdown_before = "<ul class='dropdown-menu' role='menu'>";
        $dropdown_after = "</ul>";
    }else{
        $dropdown = '';
        $dropdown_before = '';
        $dropdown_after = '';
    }

    if($data_toggle > ""){
        $data_toggle = "data-toggle='$data_toggle'";
    }
    if ($data_target > ""){
        $data_target = "data-target='$data_target'";
    }
    if ($data_placement > ""){
        $data_placement = "data-placement='$data_placement'";
    }

    if ($data_content > ""){
        $data_content = "data-content='$data_content'";
    }

    if($role > ""){
        $role = "role='$role'";
    }
    if($title > ""){
        $title = "title='$title'";
    }

    if($rel > ""){
        $rel = "rel='$rel'";
    }
    if ($data_trigger > ""){
        $data_trigger = "data-trigger='$data_trigger'";
    }

    if($type == "default" || $type == ""){
        $type = "btn-default";
    }
    else{
        $type = "btn-" . $type;
    }

    if($size == "default" || $size == ""){
        $size = "";
    }
    else{
        $size = "btn-" . $size;
    }

    if($icon > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon.'" wrapper=i] ');
    }elseif($icon_halflings > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_halflings.'" wrapper=i] ');
    }elseif($icon_social > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_social.'" wrapper=i] ');
    }elseif($icon_filetype > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_filetype.'" wrapper=i] ');
    }else{
        $icon = "";
    }

    if ($split == 'yes'){
        $output = "<button type=\"button\" class=\"btn $type $size\">".$icon . $text."</button>";
        $output .= "<button type=\"button\" class=\"btn $type $size dropdown-toggle\" data-toggle=\"dropdown\">";
        $output .= "<span class=\"caret\"></span>";
        $output .= "<span class=\"sr-only\">Toggle Dropdown</span>";
        $output .= "</button>";
    }else{
        $output = '<a href="' . $url . '" ' . $target_attr . ' class="btn '. $type .' '. $size .' '. $dropdown .' '. $extra_classes.'" '. $data_toggle . ' '. $data_target.' ' .$data_placement.' ' .$title.' ' .$rel. ' ' .$data_trigger.' ' .$role.' ' .$data_content.'>';
        $output .= $icon;
        $output .= $text;
        $output .= '</a>';
    }

    $output .=  $dropdown_before;
    $output .= do_shortcode( $content );
    $output .= $dropdown_after;

    return $output;
}

add_shortcode('button', 'th_buttons');
add_shortcode('themo_button', 'th_buttons');

/*
==========================================================
Buttons Dropdown Items
==========================================================
*/
function th_button_dropdown_item( $atts, $content = null) {
    extract( shortcode_atts( array(
        'link' => '#',
        'target' => '_self', // blank, self, parent, top
        'divider' => '', // yes / no
        'icon' => '',
        'icon_halflings' => '',
        'icon_social' => '',
        'icon_filetype' => '',

    ), $atts ) );

    // sanitize
    $link = esc_url($link);
    $target = sanitize_html_class($target);
    $divider = sanitize_html_class($divider);
    $icon = sanitize_text_field($icon);
    $icon_halflings = sanitize_text_field($icon_halflings);
    $icon_social = sanitize_text_field($icon_social);
    $icon_filetype = sanitize_text_field($icon_filetype);

    $targetList = array("blank", "self", "parent", "top");
    if (in_array($target, $targetList)) {
        $target = "_".$link;
    }else{
        $target = "#";
    }

    if($icon > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon.'" wrapper=i] ');
    }elseif($icon_halflings > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_halflings.'" wrapper=i] ');
    }elseif($icon_social > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_social.'" wrapper=i] ');
    }elseif($icon_filetype > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_filetype.'" wrapper=i] ');
    }else{
        $icon = "";
    }


    if ($divider == 'yes') {
        $output = "<li class=\"divider\"></li>";
    }else{
        $output = '<li><a href="' . $link . '" target="' . $target . '">';
        $output .= $icon;
        //$output .= $text;
        $output .=  $content;
        $output .= '</a></li>';
    }

    return $output;
}

add_shortcode('dropdown', 'th_button_dropdown_item');


/*
==========================================================
Code Inline
==========================================================
*/
function th_code( $atts, $content ) {
    extract( shortcode_atts( array(
        'scroll' => 'off',
        'inline' => 'off'
    ), $atts ) );

    // sanitize
    $content = wp_kses_post($content);
    $content = esc_html($content);

    $scroll = sanitize_html_class($scroll);
    $inline = sanitize_html_class($inline);


    if($scroll == "on"){
        $scroll = "class='pre-scrollable'";
    }
    else{
        $scroll = "";
    }

    if($inline == 'on'){
        $output = '<code>'.  $content . '</code>';
    }else{
        $output = '<pre '. $scroll . '>'. $content . '</pre>';
    }

    return $output;
}

add_shortcode('code', 'th_code');

/*
==========================================================
Columns
==========================================================
*/
function th_columns( $atts, $content ) {
    extract( shortcode_atts( array(
        'span' => '12',
    ), $atts ) );

    // sanitize
    //$content = wp_kses_post($content);
    $span = intval($span);

    $output = '<div class="col-md-'.$span.'">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    return $output;}

add_shortcode('column', 'th_columns');

/*
==========================================================
Column Row
==========================================================
*/
function th_row( $atts, $content ) {

    // sanitize
    $content = wp_kses_post($content);

    $output = '<div class="row">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    return $output;}

add_shortcode('row', 'th_row');

/*
==========================================================
Divider
==========================================================
*/

function th_ruler($atts) {
    extract(shortcode_atts(array(
        'top' => 'false',
        'bottom'=> 'false',
        'margins'=> '10',
    ), $atts));
    $percent = '';
    $styles = array();

    if($top!== 'false'){
        $top = intval($top );
        $styles[] = 'padding-top:'.$top.'px';
    }
    if($bottom!== 'false'){
        $bottom = intval($bottom );
        $styles[] = 'margin-bottom:'.$bottom.'px';
    }
    if($percent!== 'false'){
        $margins = intval($margins );
        $styles[] = 'margin-left:'.$margins.'px';
        $styles[] = 'margin-right:'.$margins.'px';
    }
    if(!empty($styles)){
        $style = ' style="'.implode(';', $styles).'"';
    }else{
        $style = '';
    }
    return '<div class="ruler" '.$style.'></div>';
}

add_shortcode('ruler', 'th_ruler');

/*
==========================================================
Dropcaps
==========================================================
*/
function th_dropcaps( $atts, $content ) {
    extract( shortcode_atts( array(
        'style' => 'book',  // box, circle, book
    ), $atts ) );

    // sanitize
    $content = wp_kses_post($content);
    $style = wp_kses_post($style);

    $styles = array("box", "circle", "book");
    if (in_array($style, $styles)) {
        $style = "dropcap-" . $style;;
    }else{
        $style = "dropcap-book";
    }


    $output = "<span class='dropcap $style'>";
    $output .= do_shortcode( $content );
    $output .= '</span>';
    return $output;}

add_shortcode('dropcaps', 'th_dropcaps');


/*
==========================================================
Full Width Video Play Button
==========================================================
*/
function th_video_play( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'src' => '', // Video SRC
        'width' => '1280', // Video Size
        'size' => 'xl-icon', // Icon Size
        'icon' => 'fa fa-play', // Icon
        'icon_halflings' => '',
        'icon_social' => '',
        'icon_filetype' => '',
        'style' => 'accent', // Icon Style
    ), $atts ) );

    // sanitize
    $src = esc_url($src);
    $width = sanitize_text_field($width);
    $size = sanitize_html_class($size);
    $icon = sanitize_text_field($icon);
    $icon_halflings = sanitize_text_field($icon_halflings);
    $icon_social = sanitize_text_field($icon_social);
    $icon_filetype = sanitize_text_field($icon_filetype);
    $style = sanitize_html_class($style);

    //list($glyhicon_library, $glyhicon_icon) = explode(' ', "$icon ", 2);

    if($icon > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon.'" wrapper=i size='.$size.' style='.$style.'] ');
    }elseif($icon_halflings > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_halflings.'" wrapper=i size='.$size.' style='.$style.'] ');
    }elseif($icon_social > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_social.'" wrapper=i size='.$size.' style='.$style.'] ');
    }elseif($icon_filetype > ""){
        $icon = do_shortcode('[glyphicon icon="'.$icon_filetype.'" wrapper=i size='.$size.' style='.$style.'] ');
    }else{
        $icon = "";
    }

    $elementor_global_image_lightbox = get_option('elementor_global_image_lightbox');
    if (!empty($elementor_global_image_lightbox) && $elementor_global_image_lightbox == 'yes') {
        $output = "<a href='".$src."' class='elementor-icon'>".$icon."</a>";
    }else{
        $output = "<a href='".$src."' class='elementor-icon' data-toggle='lightbox' data-width='".$width."'>".$icon."</a>";
    }



    return $output;
}

add_shortcode('video_play', 'th_video_play');

/*
==========================================================
Icon / Glyphicons
==========================================================
*/
function th_glyphicon( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'icon' => '',
        'icon_halflings' => '',
        'icon_social' => '',
        'icon_filetype' => '',
        'wrapper' => 'i', // span | i (default)
        'size' => '',
        'style' => ''
    ), $atts ) );

    // sanitize
    $icon = sanitize_text_field($icon);
    $icon_halflings = sanitize_text_field($icon_halflings);
    $icon_social = sanitize_text_field($icon_social);
    $icon_filetype = sanitize_text_field($icon_filetype);
    $wrapper = sanitize_html_class($wrapper);
    $size = sanitize_html_class($size);
    $style = sanitize_html_class($style);

    //list($glyhicon_library, $glyhicon_icon) = explode(' ', "$icon ", 2);

    if($icon > ""){
        $glyphicon_sets = array("halflings","social","filetype");
        if(function_exists('th_string_contains') && !th_string_contains($icon, $glyphicon_sets)){
            $icon = "$icon";
        }
    }elseif($icon_halflings > ""){
        $icon = "$icon_halflings";
    }elseif($icon_social > ""){
        $icon = "$icon_social";
    }elseif($icon_filetype > ""){
        $icon = "icon_filetype";
    }else{
        $icon = "";
    }

    $output = "<$wrapper class='$size $style $icon'></$wrapper>";

    return $output;
}

add_shortcode('glyphicon', 'th_glyphicon');


/*
==========================================================
Image shapes
==========================================================
*/
function th_image_shapes( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'src' => '',
        'link' => '',
        'target' => '',
        'class' => '',
        'alt' => '',
        'width' => '',
        'height' => '',
        'shape' => 'img-rounded', /* img-rounded, img-circle, img-thumbnail*/
    ), $atts ) );


    // sanitize
    $src = esc_url($src);
    $link = esc_url($link);
    $target = sanitize_html_class($target);
    $class = sanitize_text_field($class);
    $alt = sanitize_text_field($alt);
    $width = sanitize_text_field($width);
    $height = sanitize_text_field($height);
    $shape = "img-".sanitize_html_class($shape);

    if($width > ""){
        $width = "width='$width'";;
    }
    if($height > ""){
        $height = "height='$height'";;
    }
    if($target > ""){
        $target="target='$target'";
    }
    $img_tag = "<img class='$shape $class' alt='$alt' src='$src' $width $height />";

    if($link > ""){
        $output = "<a href='$link' $target>";
        $output .= $img_tag;
        $output .= "</a>";
    }else{
        $output = $img_tag;
    }

    return $output;
}

add_shortcode('shape', 'th_image_shapes');


/*
==========================================================
Jumbotron
==========================================================
*/
function th_jumbotron( $atts, $content ) {
    extract( shortcode_atts( array(
        'background' => '', /* alert-info, alert-success, alert-error */
        'color' => '',
    ), $atts ) );

    // sanitize
    $background = sanitize_text_field($background);
    $color = sanitize_text_field($color);

    $output = '<div style="background-color:'.$background.';color:'.$color.';" class="jumbotron">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    return $output;}

add_shortcode('jumbotron', 'th_jumbotron');

/*
==========================================================
Labels
==========================================================
*/
function th_shortcode_labels( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
        'text' => '',
    ), $atts ) );

    $type = strtolower($type);

    // sanitize
    $type = sanitize_html_class($type);
    $text = sanitize_text_field($text);

    $types = array("default", "primary", "success", "info", "warning", "danger");
    if (in_array($type, $types)) {
        $type = "label-" . $type;;
    }else{
        $type = "label-default";
    }

    $output = '<span class="label ' . $type . '">';
    $output .= $text;
    $output .= '</span>';

    return $output;
}

add_shortcode('label', 'th_shortcode_labels');

/*
==========================================================
Lead
==========================================================
*/

function th_lead( $atts, $content ) {
    extract( shortcode_atts( array(
        'align' => '',  // Left, Center, Right
    ), $atts ) );

    // sanitize
    $content = sanitize_text_field($content);
    $align = sanitize_text_field($align);

    switch ($align) {
        case 'left':
            $align = 'pull-left';
            break;
        case 'right':
            $align = 'pull-right';
            break;
        case 'center':
            $align = 'text-center';
            break;
        default:
            $align = '';
    }


    $output = "<p class='lead $align'>";
    $output .= do_shortcode( $content );
    $output .= '</p>';
    return $output;}

add_shortcode('lead', 'th_lead');

/*
==========================================================
Link
==========================================================
*/
function th_link( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'url' => '#',
        'target' => '',	// _blank, _self, _parent, _top
        'class' => '',
        'title' => '',
        'rel' => '',
        'data_placement' => '',
        'data_trigger' => '',
        'data_content' => '',
    ), $atts ) );

    // sanitize
    $url = esc_url($url);

    $target_attr = "";
    if($target > ""){
        $target_attr = "target='".sanitize_html_class($target)."'";
    }

    $class = sanitize_text_field($class);
    $title = sanitize_text_field($title);
    $rel = sanitize_html_class($rel);
    $data_placement = sanitize_html_class($data_placement);
    $data_trigger = sanitize_html_class($data_trigger);
    $data_content = wp_kses_post($data_content);
    $content = wp_kses_post($content);



    if ($data_placement > ""){
        $data_placement = "data-placement='$data_placement'";
    }
    if($title > ""){
        $title = "title='$title'";
    }

    if($rel > ""){
        $rel = "rel='$rel'";
    }

    if ($data_trigger > ""){
        $data_trigger = "data-trigger='$data_trigger'";
    }

    if ($data_content > ""){
        $data_content = "data-content='$data_content'";
    }

    $output = "<a href='$url' $target_attr class='$class' $data_placement $rel $title $data_trigger $data_content>";
    $output .= do_shortcode( $content );
    $output .= "</a>";

    return $output;
}

add_shortcode('link', 'th_link');


/*
==========================================================
Modals
==========================================================
*/
function th_modal_window($atts, $content = null){
    extract(shortcode_atts( array(
        'button_type' => 'info',  /* primary, default, info, success, danger, warning, inverse, cta */
        'button_text' => 'More',
        'button_size' => 'lg',  /* lg, sm, xs */
        'title'		=> '',
        'footer' => 'on' // on / off
    ), $atts ));

    // sanitize
    $button_type = sanitize_html_class($button_type);
    $button_text = sanitize_text_field($button_text);
    $button_size = sanitize_html_class($button_size);
    $title = sanitize_text_field($title);
    $footer = sanitize_html_class($footer);
    $content = wp_kses_post($content);

    $modal_ID = th_randomString();
    // $modal_ID = "modal";
    $button = "<!-- Button trigger modal -->";
    $button .= do_shortcode("[button text='$button_text' type='$button_type' size='$button_size' data_toggle='modal' data_target='#$modal_ID']");

    $modal = $button;
    $modal .= "<div id='$modal_ID' class='modal fade' tabindex='1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";

    $modal .= "<div class='modal-dialog'>";
    $modal .= "<div class='modal-content'>";
    $modal .= 	"<div class='modal-header'>";
    $modal .=		"<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
    $modal .=		"<h4>$title</h4>";
    $modal .=   "</div>";
    $modal .=	"<div class='modal-body'>";
    $modal .=		do_shortcode($content);
    $modal .=   "</div>";
    if($footer == 'on'){
        $modal .=   "<div class='modal-footer'>";
        $modal .=   	"<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
        $modal .= 	"</div>";
    }
    $modal .= "</div><!-- /.modal-content -->";
    $modal .= "</div><!-- /.modal-dialog -->";
    $modal .= "</div><!-- /.modal -->";

    return $modal;
}

add_shortcode("modal", "th_modal_window");

/*
==========================================================
Page Header
==========================================================
*/
function th_page_header( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'text' => '',
        'subtext' => '',
    ), $atts ) );

    // sanitize
    $text = sanitize_text_field($text);
    $subtext = sanitize_text_field($subtext);
    $content = wp_kses_post($content);

    if($subtext > ""){
        $subtext = ' <small>'. $subtext . '</small>';
    }

    $output = '<div class="page-header"><h1>'.$text.'';
    $output .= $subtext;
    $output .= '</h1></div>';
    return $output;
}

add_shortcode('header', 'th_page_header');

/*
==========================================================
Panel with Heading
==========================================================
*/

function th_panel( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'type' => 'default', //deafult, primary, success, info, warning, danger
        'heading' => '',
    ), $atts ) );

    // sanitize
    $type = sanitize_html_class($type);
    $heading = sanitize_text_field($heading);
    $content = wp_kses_post($content);

    $output =  "<div class='panel panel-$type'>";
    if ($heading > ""){
        $output .= "<div class='panel-heading'>$heading</div>";
    }
    $output .= "<div class='panel-body'>";
    $output .= do_shortcode( $content );
    $output .= "</div>";
    $output .= "</div>";

    return $output;
}

add_shortcode('panel', 'th_panel');

/*
==========================================================
Popovers
==========================================================
*/
function th_popover( $atts, $content = null) {
    extract( shortcode_atts( array(
        'button_text' => '',
        'button_type' => '',
        'button_size' => '',
        'popover_title' => '',
        'popover_placement' => 'top',
        'link' => '',
        'target' => '_self'
    ), $atts ) );

    // sanitize
    $button_text = sanitize_text_field($button_text);
    $button_type = sanitize_html_class($button_type);
    $button_size = sanitize_html_class($button_size);
    $popover_title = sanitize_text_field($popover_title);
    $popover_placement = sanitize_html_class($popover_placement);
    $link = esc_url($link);
    $target = sanitize_html_class($target);
    $content = wp_kses_post($content);

    $button = do_shortcode("[button url='$link' target='$target' text='$button_text' type='$button_type' size='$button_size' title='$popover_title' rel='popover' data_content='$content' data_placement='$popover_placement' data_trigger='hover']");

    return $button;}

add_shortcode('popover', 'th_popover');


/*
==========================================================
Popover Text
==========================================================
*/
function th_popover_text( $atts, $content = null) {
    extract( shortcode_atts( array(
        'popover_title' => '',
        'popover_content' => '',
        'popover_placement' => 'top',
        'link' => '',
        'target' => '_self'
    ), $atts ) );

    // sanitize
    $popover_title = sanitize_text_field($popover_title);
    $popover_content = wp_kses_post($popover_content);
    $popover_placement = sanitize_html_class($popover_placement);
    $link = esc_url($link);
    $target = sanitize_html_class($target);
    $content = wp_kses_post($content);

    $link = do_shortcode("[link url='$link' target='$target'  title='$popover_title' rel='popover' data_content='$popover_content' data_placement='$popover_placement' data_trigger='hover']".$content."[/link]");

    return $link;}

add_shortcode('popover_text', 'th_popover_text');

/*
==========================================================
Progress Bar
==========================================================
*/
function th_shortcode_progress_bar( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'animate' => 'off',
        'type' => 'default', // success,  info,  warning,  danger
        'striped' => 'off',
        'progress' =>'20',
        'label' => ''
    ), $atts ) );

    // sanitize
    $animate = sanitize_html_class($animate);
    $type = sanitize_html_class($type);
    $striped = sanitize_html_class($striped);
    $progress = sanitize_html_class($progress);
    $label = sanitize_text_field($label);


    if($animate == "on"){
        $animate = "active";
    }
    else{
        $animate = '';
    }
    if($striped == "on"){
        $striped = "progress-striped";
    }
    else{
        $striped = '';
    }
    if($type == "default"){
        $type = "";
    }
    else{
        $type = 'progress-bar-'.$type.'';
    }


    if($label > ""){
        $label = "<span >$progress% $label</span>";
    }else{
        $label = "<span class='sr-only'>$progress% $label</span>";
    }

    $output = '<div class="progress '.$striped.' '.$animate.'"><div class="progress-bar '.$type.'" role="progressbar" style="width:'.$progress.'%;">'.$label.'</div></div>';
    return $output;}

add_shortcode('progress', 'th_shortcode_progress_bar');


/*
==========================================================
Tabs / Togglable
==========================================================
*/
function th_tab_wrap( $atts, $content ){


    $return = '';
    $GLOBALS['tab_count'] = 0;
    $iCount = 0;
    $tagGroup = th_RandNumber(3);
    $iCount = $tagGroup + $iCount;
    $isActive = "active";
    $fade = 'fade in';

    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ){
        $headings[] = '<ul class="nav nav-tabs">';
        $panes[] = '<div class="tab-content">';
        foreach( $GLOBALS['tabs'] as $tab ){

            // sanitize
            $tab['title'] = sanitize_text_field($tab['title']);
            $tab['content'] = wp_kses_post($tab['content']);

            // unique $iCount
            $headings[] = "<li class='$isActive'><a href='#tab$iCount' data-toggle='tab'>".$tab['title']."</a></li>";
            $panes[] = "<div class='tab-pane $isActive $fade' id='tab$iCount'>\n".$tab['content']."</div>";
            $iCount++;
            $isActive = '';
            $fade = 'fade';
        }
        $GLOBALS['tabs'] = array();
        $headings[] = "</ul>";
        $panes[] = '</div>';
        $return = $return . "\n".'<!-- the tabs -->'.implode( "\n", $headings )."\n".implode( "\n", $panes )."\n";
    }

    return $return;
}

add_shortcode( 'tabwrap', 'th_tab_wrap' );

function th_tab( $atts, $content ){
    extract(shortcode_atts(array(
        'title' => 'Tab %d'
    ), $atts));

    // sanitize
    $content = wp_kses_post($content);

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode($content) );

    $GLOBALS['tab_count']++;
}

add_shortcode( 'tab', 'th_tab' );





/*
==========================================================
Tooltip
==========================================================
*/
function th_tooltip( $atts, $content = null) {
    extract( shortcode_atts( array(
        'button_text' => '',
        'button_type' => '',
        'button_size' => '',
        'tooltip_text' => '',
        'tooltip_placement' => 'top',
        'link' => '',
        'target' => '_self'
    ), $atts ) );

    // sanitize
    $button_text = sanitize_text_field($button_text);
    $button_type = sanitize_html_class($button_type);
    $button_size = sanitize_html_class($button_size);
    $tooltip_text = sanitize_text_field($tooltip_text);
    $tooltip_placement = sanitize_html_class($tooltip_placement);
    $link = esc_url($link);
    $target = sanitize_html_class($target);
    $content = wp_kses_post($content);

    $button = do_shortcode("[button text='$button_text' type='$button_type' size='$button_size' title='$tooltip_text' rel='tooltip' data_placement='$tooltip_placement' url='$link' target='$target']");

    return $button;}

add_shortcode('tooltip', 'th_tooltip');


/*
==========================================================
Tooltip Text
==========================================================
*/
function th_tooltip_text( $atts, $content = null) {
    extract( shortcode_atts( array(
        'tooltip_text' => '',
        'tooltip_placement' => 'top',
        'link' => '',
        'target' => '_self'
    ), $atts ) );

    $tooltip_text = sanitize_text_field($tooltip_text);
    $tooltip_placement = sanitize_html_class($tooltip_placement);
    $link = esc_url($link);
    $target = sanitize_html_class($target);

    $link = do_shortcode("[link title='$tooltip_text' rel='tooltip' data_placement='$tooltip_placement' url='$link' target='$target']".$content."[/link]");

    return $link;}

add_shortcode('tooltip_text', 'th_tooltip_text');


/*
==========================================================
Highlights
==========================================================
*/

if ( !function_exists( 'th_highlight' ) ) {
    function th_highlight( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'color'	=> 'primary',
            'class'	=> '',
        ), $atts ) );

        $color = sanitize_html_class($color);
        $class = sanitize_html_class($class);

        $colors = array("primary", "success", "info", "warning", "danger");
        if (in_array($color, $colors)) {
            $color = "bg-" . $color;;
        }else{
            $color = "bg-primary";
        }
        return "<span class='$color $class'>" . do_shortcode( $content ) . "</span>";

    }
    add_shortcode( 'highlight', 'th_highlight' );
}

/*
==========================================================
Carousel / Flex Slider
==========================================================
*/
if ( ! function_exists( 'th_slider_gallery' ) ) :
    function th_slider_gallery( $atts, $content = null ) {


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
        if ( function_exists( 'get_theme_mod' ) ) {
            $themo_flex_autoplay  = get_theme_mod( 'themo_flex_autoplay', true );
            $themo_flex_animation  = get_theme_mod( 'themo_flex_animation', 'fade' );
            $themo_flex_easing  = get_theme_mod( 'themo_flex_easing', "swing" );
            $themo_flex_animationloop  = get_theme_mod( 'themo_flex_animationloop', true );
            $themo_flex_smoothheight  = get_theme_mod( 'themo_flex_smoothheight', true );
            $themo_flex_slideshowspeed  = get_theme_mod( 'themo_flex_slideshowspeed', 4000 );
            $themo_flex_animationspeed  = get_theme_mod( 'themo_flex_animationspeed', 550 );
            $themo_flex_randomize  = get_theme_mod( 'themo_flex_randomize', 0 );
            $themo_flex_pauseonhover  = get_theme_mod( 'themo_flex_pauseonhover', true );
            $themo_flex_touch  = get_theme_mod( 'themo_flex_touch', true );
            $themo_flex_directionnav  = get_theme_mod( 'themo_flex_directionnav ', true );
        }
        $themo_flex_settings = "$themo_flex_autoplay, '$themo_flex_animation', '$themo_flex_easing',
                    $themo_flex_animationloop, $themo_flex_smoothheight, $themo_flex_slideshowspeed, $themo_flex_animationspeed,
                    $themo_flex_randomize, $themo_flex_pauseonhover, $themo_flex_touch, $themo_flex_directionnav";

        $flex_ID = th_randomString();

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
                $image_src = $image_attributes[0];
            }else{
                $image_src = wp_get_attachment_url( $attachment->ID );
            }

            $elementor_global_image_lightbox = get_option('elementor_global_image_lightbox');
            if (!empty($elementor_global_image_lightbox) && $elementor_global_image_lightbox == 'yes') {
                $output .= "<a href='".$image_large_src."'>";
            }else{
                $output .= "<a href='".$image_large_src."' data-toggle='lightbox' data-gallery='multiimages'>";
            }


            $output .= "<img src='".$image_src."' $alt_text />";
            $output .= "</a>";
            $output .= "</li>";
        }

        $output .= "</ul><!--  END FLEX UL -->";
        $output .= "</div><!--  END FLEX DIV -->";
        return $output;
    }

    add_shortcode('slider_gallery', 'th_slider_gallery');
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
            'size'       => 'th_img_md_landscape',
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

        //$size = 'th_img_md_landscape';
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

