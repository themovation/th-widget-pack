<?php
switch ( $instance['rows'] ) {
	case '1':
		$rows = ' col-md-12';
		break;
	case '2':
		$rows = ' col-md-6';
		break;
	case '3':
		$rows = ' col-md-4';
		break;
	default:
		$rows = '';
}
?>

<div class="th-testimonials row">

	<?php foreach( $instance['testimonials'] as $i => $testimonial ) { ?>

		<div class="th-testimonial-single<?php echo $rows; ?>">
			<figure class="th-quote">
				<div class="th-star-rating th-star-<?php echo $testimonial['rating']; ?>">
					<span class="th-star-1 glyphicons"></span>
					<span class="th-star-2 glyphicons"></span>
					<span class="th-star-3 glyphicons"></span>
					<span class="th-star-4 glyphicons"></span>
					<span class="th-star-5 glyphicons"></span>
				</div>
				<blockquote><?php echo wp_kses_post( $testimonial['quote'] ); ?></blockquote>
				<?php if( $testimonial['image'] ) echo wp_get_attachment_image( $testimonial['image'], 'themo_testimonials', false, array( 'class' => 'th-circle' ) ); ?>
				<figcaption><?php echo esc_html( $testimonial['name'] ); ?><span><?php echo esc_html( $testimonial['title'] ); ?></span></figcaption>
			</figure>
		</div>

	<?php } ?>

</div>
