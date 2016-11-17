<?php

// Display icon Widget
function themo_display_icon( $instance, $return = false, $class, $show_div = true ) {

	$icon = $instance['icon']['icon'];
	$style = $instance['icon']['style'];
	$image = $instance['icon']['image'];

	$open = ( $style != 'standard' && $show_div == true  ) ? '<div class="' . $class . ' ' . esc_attr( $style ) . '-med-icon">' : '';
	$close = ( $style != 'standard' && $show_div == true ) ? '</div>' : '';
	if( $image ) {
		$output = wp_get_attachment_image( $image, 'full', false, array( 'class' => 'th-icon th-icon-graphic' ) );
	} elseif( $icon ) {
		$output = siteorigin_widget_get_icon( $icon, $icon_styles );
	} elseif( !$image && !$icon ) {
		$open = '';
		$close = '';
	}

	if( $return == true ) {
		return $open . $output . $close;
	} else {
		echo $open . $output . $close;
	}

}

// Display link Widget
function themo_display_link( $instance, $class, $content ) {

	$url = sow_esc_url( $instance['link']['url'] );
	$target = ( $instance['link']['new_window'] ) ? ' target="_blank"' : '';
	$lightbox_width = ( $instance['link']['lightbox_width'] && $instance['link']['lightbox'] == 'on' ) ? ' data-width="' . esc_html( $instance['link']['lightbox_width'] ) . '"' : '';
	$lightbox = ( $instance['link']['lightbox'] == 'on' ) ? ' data-toggle="lightbox"' : '';
	$content = ( $content ) ? $content : ' ';
	$class = ( $class ) ? 'class="' . $class . '"' : '';

	$link = '<a %s href="%s"%s%s%s>%s</a>';

	echo sprintf( $link, $class, $url, $target, $lightbox, $lightbox_width, $content );

}

// Display button Widget
function themo_display_button( $instance ) {

	if( $instance['button_1']['button_link']['link']['url'] ) :
		themo_display_single_button( $instance['button_1'] );
	endif;
	if( $instance['button_2']['button_link']['link']['url'] ) :
		themo_display_single_button( $instance['button_2'] );
	endif;

}

function themo_display_single_button( $button ) {

	$type = $button['button_type'];
	$text = $button['button_text'];
	$style = $button['button_style'];
	$icon = $button['button_icon'];
	$link = $button['button_link'];
	$product_button = $button['product_button'];
	$product_sku = $button['product_sku'];
	$graphic = $button['button_graphic'];
	$graphic_link = $button['graphic_link'];

	if( $type == 'button' ) {

		$class = 'btn th-btn btn-' . esc_attr( $style );
		$content = esc_html( $text ) . themo_display_icon( $icon, true, '', false );

		themo_display_link( $link, $class, $content );

	} elseif ( $type == 'add-to-cart' ) {

		echo do_shortcode('[add_to_cart id="' . $product_button . '" ' . $product_sku . '"]');

	} elseif ( $type == 'graphic' ) {

		$class = 'th-btn btn-image';
		$content = wp_get_attachment_image( $graphic, 'full', false, '' );

		themo_display_link( $graphic_link, $class, $content );

	}

}

/* Convert hexdec color string to rgb(a) string */

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
		  return $default;

	//Sanitize $color if "#" is provided
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);

		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}

		//Return rgb(a) color string
		return $output;
}

/**
* GLOBAL VARIABLES
*/
global $th_acc_count, $th_acc_panel_count, $th_thumb_slider_count;
$th_acc_panel_count = $th_acc_count = $th_thumb_slider_count = 0;
