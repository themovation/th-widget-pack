<?php

// Display icon Widget
function themo_display_icon( $instance, $return = false ) {

	$icon = $instance['icon']['icon'];
	$style = $instance['icon']['style'];
	$image = $instance['icon']['image'];

	$open = ( $style != 'standard' ) ? '<div class="' . esc_attr( $style ) . '-med-icon">' : '';
	if( $icon ) {
		$output = siteorigin_widget_get_icon( $icon, $icon_styles );
	} elseif( $image ) {
		$output = wp_get_attachment_image( $image, 'full', false, array( 'class' => 'th-icon th-icon-graphic' ) );
	}
	$close = ( $style != 'standard' ) ? '</div>' : '';

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
	$type = $instance['button']['button_type'];
	$text = $instance['button']['button_text'];
	$style = $instance['button']['button_style'];
	$icon = $instance['button']['button_icon'];
	$link = $instance['button']['button_link'];
	$product_button = $instance['button']['product_button'];
	$product_sku = $instance['button']['product_sku'];
	$graphic = $instance['button']['button_graphic'];
	$graphic_link = $instance['button']['graphic_link'];

	if( $type == 'button' ) {

		$class = 'btn th-btn btn-' . esc_attr( $style );
		$link = sow_esc_url( $link );
		$content = esc_html( $text ) . themo_display_icon( $icon, true );

		themo_display_link( $link, $class, $content );

	} elseif ( $type == 'add-to-cart' ) {

		echo do_shortcode('[add_to_cart id="' . $product_button . '" ' . $product_sku . '"]');

	} elseif ( $type == 'graphic' ) {

		$class = 'th-btn btn-image';
		$content = wp_get_attachment_image( $graphic, 'full', false, '' );

		themo_display_link( $graphic_link, $class, $content );

	}
}
