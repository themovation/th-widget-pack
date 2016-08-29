<div class="th-service-blocks th-sb-<?php echo $instance['align'] ?>">
<?php foreach( $instance['blocks'] as $block ) { ?>

	<div class="th-sb-single<?php echo ( ( $block['icon']['icon']['style'] != 'standard' ) ? '-' . $block['icon']['icon']['style'] : '' ); ?>">

		<?php
		$icon = themo_display_icon( $block['icon'], true, 'th-sb-icon' );

		if( $block['link']['link']['url'] ) {
			themo_display_link( $block['link'], '', $icon );
		} else {
			echo $icon;
		}
		?>

		<div class="th-sb-text">
			<?php
			$title = '<h3>' . esc_html( $block['title'] ) . '</h3>';

			if( $block['link']['link']['url'] ) {
				themo_display_link( $block['link'], '', $title );
			} else {
				echo $title;
			}
			?>
			<?php echo wp_kses_post( $block['content'] ); ?>
		</div>

	</div>

<?php } ?>

</div>
