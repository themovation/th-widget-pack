<?php
if( $instance['link']['new_window'] ) $target = ' target="_blank"';
if( $instance['link']['lightbox'] ) $lightbox = ' data-toggle="lightbox" data-width="' . esc_html( $instance['link']['lightbox_width'] ) . '"';

if( $instance['link']['lightbox'] ) { ?>

	<a href="<?php echo sow_esc_url( $instance['link']['new_window'] ); ?>"<?php echo $target; ?><?php echo $lightbox; ?>> </a>

<?php }
