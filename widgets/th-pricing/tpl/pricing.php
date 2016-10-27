<?php
// Column count
$column_number = sizeof( $instance['table'] );

switch( $column_number ) {
	case 1:
		$table_class = ' th-one-col';
		$column_class = ' col-sm-6 col-sm-offset-3';
		break;
	case 2:
		$table_class = ' th-two-col';
		$column_class = ' col-sm-6';
		break;
	case 3:
		$table_class = ' th-three-col';
		$column_class = ' col-md-4 col-sm-6';
		break;
	case 4:
		$table_class = ' th-four-col';
		$column_class = ' col-md-3 col-sm-6';
		break;
	case 5:
		$table_class = ' th-five-col';
		$column_class = ' col-md-2 col-sm-6';
		break;
	case 6:
		$table_class = ' th-six-col';
		$column_class = ' col-md-2 col-sm-6';
		break;
	default:
		$table_class = '';
		$column_class = '';
}

$themo_animation = $instance['panels_info']['style']['themo-animation-styles'];
if ( !empty( $themo_animation ) && $themo_animation != 'none' ) :
	$animate_class = $themo_animation . ' hide-animation widget-repeater-animate';
endif;
?>

<div class="th-pricing-table<?php echo $table_class; ?> th-widget-has-repeater">

	<div class="row">

		<?php foreach( $instance['table'] as $i => $column ) { ?>

			<div class="th-pricing-column<?php echo( $column['popular'] ? ' th-highlight' : '' ); echo $column_class; ?> <?php echo $animate_class; ?>">

				<div class="th-pricing-cost"><?php echo esc_html( $column['price'] ); ?><span><?php echo esc_html( $column['text'] ); ?></span></div>

				<div class="th-pricing-title"><?php echo esc_html( $column['title'] ); ?></div>

				<div class="th-pricing-features">
					<ul>
						<?php echo '<li>'.str_replace( array( "\r", "\n\n", "\n" ), array( '', "\n", "</li>\n<li>" ), trim( $column['features'] , "\n\r" ) ).'</li>'; ?>
					</ul>
				</div>

				<div class="th-pricing-btn">
					<?php if( $column['button_1']['button']['button_link']['link']['url'] ) : ?>
						<?php themo_display_button( $column['button_1'] ); ?>
					<?php endif; ?>
					<?php if( $column['button_2']['button']['button_link']['link']['url'] ) : ?>
						<?php themo_display_button( $column['button_2'] ); ?>
					<?php endif; ?>
				</div>

			</div>

		<?php } ?>

	</div>

</div>
