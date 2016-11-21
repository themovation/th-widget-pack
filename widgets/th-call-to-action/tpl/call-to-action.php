<div class="th-cta">
	<?php if( $instance['text'] ) : ?>
		<div class="th-cta-text">
			<span><?php echo esc_html( $instance['text'] ); ?></span>
		</div>
	<?php endif; ?>
	<div class="th-cta-btn">
		<?php themo_display_buttons( $instance['button_1'], $instance['button_2'] ); ?>
	</div>
</div>
