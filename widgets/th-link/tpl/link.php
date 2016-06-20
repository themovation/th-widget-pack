<?php
if( $instance['link']['new_window'] ) $target = ' target="_blank"';
if( $instance['link']['lightbox'] === 'on' ) $lightbox = ' data-toggle="lightbox"';
if( $instance['link']['lightbox_width'] ) $lightbox_width = ' data-width="' . esc_html( $instance['link']['lightbox_width'] ) . '"';

if( $instance['link']['lightbox'] ) { ?>

	<a href="<?php echo sow_esc_url( $instance['link']['new_window'] ); ?>"<?php echo $target; ?><?php echo $lightbox; ?><?php echo $lightbox_width; ?>> </a>

<?php }
