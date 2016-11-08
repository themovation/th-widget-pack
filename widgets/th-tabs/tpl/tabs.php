<?php
$themo_animation = $instance['panels_info']['style']['themo-animation-styles'];
?>
<div class="th-faq th-widget-has-repeater">
	<dl class="th-faq-list">

		<?php foreach( $instance['faqs'] as $faq ) { ?>

			<?php if ( !empty( $themo_animation ) && $themo_animation != 'none' ) : ?>
				<div class="<?php echo $themo_animation . ' hide-animation widget-repeater-animate'; ?>">
			<?php endif; ?>

				<dt class="th-faq-dt"><?php echo esc_html( $faq['title'] ); ?></dt>
				<dd class="th-faq-dd"><?php echo wp_kses_post( $faq['content'] ); ?></dd>

			<?php if ( !empty( $themo_animation ) && $themo_animation != 'none' ) : ?>
				</div>
			<?php endif; ?>

		<?php } ?>

	</dl>
</div>
