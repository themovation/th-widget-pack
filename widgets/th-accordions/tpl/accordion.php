<?php
// Accessing global variables
global $th_acc_count;
global $th_acc_panel_count;

$accordion_id = ++$th_acc_count;

$themo_animation = $instance['panels_info']['style']['themo-animation-styles'];

if ( !empty( $themo_animation ) && $themo_animation != 'none' ) :
	$animate_class = $themo_animation . ' hide-animation widget-repeater-animate';
endif;
?>

<div class="th-accordion th-widget-has-repeater">
	<div class="panel-group" id="accordion<?php echo $accordion_id; ?>">

		<?php foreach( $instance['accordions'] as $i => $accordion ) { ?>

			<?php $toggle_id = ++$th_acc_panel_count; ?>

			<div class="panel panel-default <?php echo $animate_class; ?>">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion<?php echo $accordion_id; ?>" href="#collapse<?php echo $toggle_id ?>" class="accordion-toggle">
							<?php themo_display_icon( $accordion['icon'], false, '', false ); ?>
							<?php echo esc_html( $accordion['title'] ); ?>
						</a>
					</h4>
				</div>
				<div id="collapse<?php echo $toggle_id ?>" class="panel-collapse collapse <?php echo ( $accordion['expanded'] ) ? 'in' : '' ;?>">
					<div class="panel-body">
						<?php echo do_shortcode( wp_kses_post( $accordion['content'] ) ); ?>
						<?php if( $accordion['button_1']['button']['button_link']['link']['url'] || $accordion['button_2']['button']['button_link']['link']['url'] ) : ?>
							<div class="accordion-btn">
								<?php if( $accordion['button_1']['button']['button_link']['link']['url'] ) : ?>
									<?php themo_display_button( $accordion['button_1'] ); ?>
								<?php endif; ?>
								<?php if( $accordion['button_2']['button']['button_link']['link']['url'] ) : ?>
									<?php themo_display_button( $accordion['button_2'] ); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php } ?>

	</div>
</div>
