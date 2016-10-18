<?php
if( $instance['background']['color'] ) $bg_color = 'style="background-color:' . esc_attr( $instance['background']['color'] ) . '"';
if( $instance['image'] ) $image = wp_get_attachment_image( $instance['image'], 'themo_team', false, array( 'class' => 'th-team-member-image' ) );
if( $instance['title'] ) $title = '<h4>' . esc_html( $instance['title'] ) . '</h4>';
?>

<div class="th-team-member th-<?php echo $instance['background']['contrast'] ?>-text">
	<div class="th-team-member-wrap" <?php echo $bg_color ?>>
		<?php if( $instance['link']['link']['url'] ) : ?>
			<?php themo_display_link( $instance['link'], '', $image . '' . $title ); ?>
		<?php else : ?>
			<?php echo $image . '' . $title; ?>
		<?php endif; ?>
		<h5><?php echo esc_html( $instance['job'] ) ?></h5>
		<div class="th-team-member-bio">
			<?php echo wp_kses_post( $instance['content'] ) ?>
		</div>
		<div class="th-team-member-social">
			<?php foreach( $instance['social'] as $i => $social ) {
				$icon = themo_display_icon( $social['icon'], true, '', true );
				if( $social['link']['link']['url'] ) {
					themo_display_link( $social['link'], '', $icon );
				} else {
					echo $icon;
				}
			} ?>
		</div>
	</div>
</div>
