<?php

// WP_Query arguments
$args = array (
	'post_type' => array( 'post' ),
);

if ( $instance['categories'] != 'all' ) {
	if ( is_array( $instance['categories'] ) ) {
		if ( in_array( 'all', $instance['categories'] ) ) {
			$instance['categories'] = array_diff( $instance['categories'], array('all') );
		}

		$categories = implode( ', ', $instance['categories'] );
	} else {
		$categories = array( $instance['categories'] );
	}
	$args['cat'] = $categories;
}

if ( $instance['number'] ) {
	$args['posts_per_page'] = $instance['number'];
}

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) { ?>

	<section class="masonry-blog">
		<div class="container">
			<div class="mas-blog row">

				<?php while ( $query->have_posts() ) { $query->the_post(); ?>

					<?php $format = get_post_format() ? get_post_format() : 'standard'; ?>

					<div class="mas-blog-post col-lg-4 col-md-4 col-sm-6">
						<?php get_template_part('templates/content', $format); ?>
					</div>

				<?php } ?>

			</div>
		</div>
	</section>
	<?php

} else {
	esc_html_e('Sorry, no results were found.', 'themovation-widgets');
}

wp_reset_postdata();
