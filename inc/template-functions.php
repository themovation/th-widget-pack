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
