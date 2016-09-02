<?php
if ( ! function_exists ( 'themovation_so_wb_animation_field' ) ) :
// The Text Contrast option
function themovation_so_wb_animation_field( $fields ) {

	$fields['themo-animation-styles'] = array(
			'name'        => __( 'Animation Styles', 'themovation-widgets' ),
			'type'        => 'select',
			'group'       => 'design',
			'default'     => 'slideUp',
			'options'     => array(
				'slideUp'    => __( 'Slide Up', 'themovation-widgets' ),
				'slideDown'  => __( 'Slide Down', 'themovation-widgets' ),
				'slideLeft'  => __( 'Slide Left', 'themovation-widgets' ),
				'slideRight' => __( 'Slide Right', 'themovation-widgets' ),
				'fadeIn'     => __( 'Fade In', 'themovation-widgets' ),
			),
			'priority'    => 10,
	);

	unset( $fields['background'] );
	unset( $fields['background_image_attachment'] );
	unset( $fields['background_display'] );
	unset( $fields['border_color'] );
	unset( $fields['font_color'] );
	unset( $fields['link_color'] );

	return $fields;
}
endif;
add_filter( 'siteorigin_panels_widget_style_fields', 'themovation_so_wb_animation_field', 10 );

if ( ! function_exists ( 'themovation_siteorigin_widget_options' ) ) :
// Adding compatibility with Option Tree
function themovation_siteorigin_widget_options() {

	if ( function_exists( 'ot_get_option' ) ) {
		$th_so_style_panel_options = ot_get_option( 'th_so_style_panel_options', 'off' );
		if ( $th_so_style_panel_options == 'on' ) {
			remove_filter( 'siteorigin_panels_widget_style_fields', 'themovation_so_wb_animation_field', 10 );
		}
	}

}
endif;
add_action( 'after_setup_theme', 'themovation_siteorigin_widget_options', 2 );
