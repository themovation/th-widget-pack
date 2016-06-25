<?php

// Display icon Widget
function themo_display_icon( $icon, $style, $image ) {
	if( $style != 'standard' ) echo '<div class="' . esc_attr( $style ) . '-med-icon">';
	if( $icon ) {
		echo siteorigin_widget_get_icon( $icon, $icon_styles );
	} elseif( $image ) {
		echo wp_get_attachment_image( $image, 'full', 'false', array( 'class' => 'th-icon th-icon-graphic' ) );
	}
	if( $style != 'standard' ) echo '</div>';
}

// Display link Widget
function themo_display_link( $url, $target, $lightbox, $lightbox_width, $content ) {
	$url = sow_esc_url( $url );
	$target = ( $target ) ? ' target="_blank"' : '';
	$lightbox_width = ( $lightbox_width && $lightbox == 'on' ) ? ' data-width="' . esc_html( $lightbox_width ) . '"' : '';
	$lightbox = ( $lightbox == 'on' ) ? ' data-toggle="lightbox"' : '';
	$content = ( $content ) ? $content : ' ';

	$link = '<a href="%s"%s%s%s>%s</a>';

	echo sprintf( $link, $url, $target, $lightbox, $lightbox_width, $content );
}
