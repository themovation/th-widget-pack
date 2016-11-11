<?php
$vert = ( $instance['align'] == 'vert' ) ? ' cv-lrg' : '';

$themo_animation = $instance['panels_info']['style']['themo-animation-styles'];

if ( !empty( $themo_animation ) && $themo_animation != 'none' ) :
	$animate_class = $themo_animation . ' hide-animation widget-repeater-animate';
endif;

switch( $instance['row'] ) {
	case 1:
		$service_class = ' th-one-col';
		$column_class = ' col-md-12';
		break;
	case 2:
		$service_class = ' th-two-col';
		$column_class = ' col-sm-6';
		break;
	case 3:
		$service_class = ' th-three-col';
		$column_class = ' col-md-4 col-sm-6';
		break;
	case 4:
		$service_class = ' th-four-col';
		$column_class = ' col-md-3 col-sm-6';
		break;
	case 5:
		$service_class = ' th-five-col';
		$column_class = ' col-md-2 col-sm-6';
		break;
	default:
		$service_class = '';
		$column_class = '';
}
?>

<div class="th-service-blocks row th-widget-has-repeater th-sb-<?php echo $instance['align'] ?><?php echo $service_class; ?>">
<?php foreach( $instance['blocks'] as $block ) { ?>

	<div class="th-sb-single<?php echo ( ( $block['icon']['icon']['style'] != 'standard' ) ? '-' . $block['icon']['icon']['style'] : '' ); ?> <?php echo $animate_class; ?><?php echo $column_class; ?>">

		<?php
		$icon = themo_display_icon( $block['icon'], true, 'th-sb-icon' . $vert , true );

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
