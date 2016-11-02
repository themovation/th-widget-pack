<? $tag = ( $instance['type'] == 'section' ) ? 'h2' : 'h1'; ?>

<div class="th-header th-<?php echo esc_attr( $instance['align'] ); ?> th-header-<?php echo esc_attr( $instance['type'] ); ?>">
	<?php themo_display_icon( $instance['icon'], false, '', true ); ?>
	<<?php echo $tag; ?>><?php echo esc_html( $instance['title'] ); ?></<?php echo $tag; ?>>
	<?php echo wp_kses_post( $instance['content'] ); ?>
</div>
