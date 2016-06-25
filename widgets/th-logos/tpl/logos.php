<div class="th-logos">
	<?php foreach( $instance['logos'] as $i => $logo ) {
		$image = wp_get_attachment_image( $logo['image'], 'themo_brands', false, array( 'class' => 'th-logo-img' ) );

		if( $logo['link']['link']['url'] ) {
			themo_display_link( $logo['link'], '', $image );
		} else {
			echo $image;
		}

	} ?>
</div>
