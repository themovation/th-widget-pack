<?php $conversion_form = ( $instance['conversion_form'] ) ? ' th-conversion' : ''; ?>

<div class="th-formidable<?php echo $conversion_form; ?>">
	<?php echo do_shortcode( $instance['shortcode'] ); ?>
</div>
