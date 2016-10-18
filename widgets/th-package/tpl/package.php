<?php
$content_bg = ( $instance['background']['color'] ? 'style = "background: ' . esc_attr( $instance['background']['color'] ) . '"' : '' );
if( $instance['price']['background']['color'] ) {
	$price_bg = hex2rgba( $instance['price']['background']['color'], ($instance['price']['background']['opacity'] / 100) );
	$price_bg = 'style = "background: ' . esc_attr( $price_bg ) . '"';
}
?>

<article class="th-package">

	<?php if ( $instance['link']['link']['url'] ) {
		themo_display_link( $instance['link'], 'th-pkg-click', '' );
	} ?>

	<div class="th-pkg-info th-pkg-info-<?php echo esc_attr( $instance['price']['background']['contrast'] ); ?>"  <?php echo $price_bg; ?>>

		<h4><?php echo esc_html( $instance['price']['price'] ); ?></h4>
		<span><?php echo esc_html( $instance['price']['text'] ); ?></span>

	</div>

	<?php if ( $instance['image'] ) : ?>

		<div class="th-pkg-img">

			<?php echo wp_get_attachment_image( $instance['image'], 'full', false, '' ); ?>

		</div>

	<?php endif; ?>

	<div class="th-pkg-content th-pkg-con-<?php echo esc_attr( $instance['background']['contrast'] ); ?>" <?php echo $content_bg; ?>>

		<h3><?php echo esc_html( $instance['title'] ); ?></h3>
		<?php echo do_shortcode( wp_kses_post( $instance['content'] ) ); ?>

	</div>

</article>
