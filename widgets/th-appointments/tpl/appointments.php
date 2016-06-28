<div class="th-book-cal-<?php echo esc_attr( $instance['size'] ); ?>">
	<?php if( $instance['tooltip'] ) : ?>
		<div class="th-cal-tooltip"><h3><?php echo esc_html( $instance['tooltip'] ); ?></h3></div>
	<?php endif; ?>
	<?php echo do_shortcode( $instance['shortcode'] ); ?>
</div>
