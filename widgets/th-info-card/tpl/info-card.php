<?php
if( $instance['background']['color'] ) {
	$info_bg = hex2rgba( $instance['background']['color'], ($instance['background']['opacity'] / 100) );
	$info_bg = $instance['background']['color'] ? 'background: ' . esc_attr( $info_bg ) . ';' : '';
	$info_border = $instance['border-color'] ? 'border: 1px solid ' . $instance['border-color'] . ';' : '';
	$info_style = ( $instance['background']['color'] || $instance['border-color'] ) ? 'style = "' . $info_bg . ' ' . $info_border . '"' : '';
}
?>

<div class="th-info-card th-con-<?php echo esc_attr( $instance['align'] ); ?> th-card-<?php echo esc_attr( $instance['card-align'] ); ?>" <?php echo $info_style; ?>>
	<?php if ( $instance['link']['url'] ) {
		themo_display_link( $instance['link'], '', '' );
	} ?>
	<h2 class="th-info-card-title"><?php echo esc_html( $instance['title'] ); ?></h2>
	<?php echo do_shortcode( wp_kses_post( $instance['content'] ) ); ?>
	<?php if( $instance['button_1']['button_link']['link']['url'] || $instance['button_1']['button_link']['link']['url'] ) : ?>
		<div class="th-card-btn">
			<?php themo_display_buttons( $instance['button_1'], $instance['button_2'] ); ?>
		</div>
	<?php endif; ?>
</div>
