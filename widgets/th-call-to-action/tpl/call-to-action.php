<div class="th-cta">
	<?php if( $instance['text'] ) : ?>
		<div class="th-cta-text">
			<span><?php echo $instance['text']; ?></span>
		</div>
	<?php endif; ?>
	<div class="th-cta-btn">
		<?php if( $instance['button_1']['button']['button_link']['link']['url'] ) : ?>
			<?php themo_display_button( $instance['button_1'] ); ?>
		<?php endif; ?>
		<?php if( $instance['button_2']['button']['button_link']['link']['url'] ) : ?>
			<?php themo_display_button( $instance['button_2'] ); ?>
		<?php endif; ?>
	</div>
</div>
