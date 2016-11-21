<?php
$themo_animation = $instance['panels_info']['style']['themo-animation-styles'];

if ( !empty( $themo_animation ) && $themo_animation != 'none' ) :
	$animate_class = $themo_animation . ' hide-animation widget-repeater-animate';
endif;
?>

<div class="th-logos th-widget-has-repeater">
	<?php foreach( $instance['logos'] as $i => $logo ) {
		$image = wp_get_attachment_image( $logo['image'], 'th_img_xs', false, array( 'class' => 'th-logo-img ' . $animate_class ) );

		if( $logo['link']['url'] ) {
			themo_display_link( $logo['link'], '', $image );
		} else {
			echo $image;
		}

	} ?>
</div>
