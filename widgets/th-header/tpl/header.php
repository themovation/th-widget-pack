<div class="th-header th-<?php echo esc_attr( $instance['align'] ); ?>">
	<?php themo_display_icon( $instance['icon'] ); ?>
	<h2><?php echo esc_html( $instance['title'] ); ?></h2>
	<?php echo wp_kses_post( $instance['content'] ); ?>
</div>
