<?php
if ( ! function_exists ( 'themovation_so_wb_animation_field' ) ) :
// The Text Contrast option
function themovation_so_wb_animation_field( $fields ) {

	$fields['themo-animation-styles'] = array(
			'name'        => __( 'Animation Styles', 'themovation-widgets' ),
			'type'        => 'select',
			'group'       => 'design',
			'default'     => 'none',
			'options'     => array(
				'none'          => __( 'None', 'themovation-widgets' ),
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

if ( function_exists( 'ot_get_option' ) ) {
	$th_so_style_panel_options = ot_get_option( 'th_so_style_panel_options', 'off' );
	if ($th_so_style_panel_options == 'on'){
		remove_filter( 'siteorigin_panels_widget_style_fields', 'themovation_so_wb_animation_field', 10 );
	}
}

if ( !function_exists ( 'themovation_so_wb_animation_attribute' ) ) :
// Adding animation class to widget
function themovation_so_wb_animation_attribute( $attributes, $args ) {

	if( !empty( $args['themo-animation-styles'] ) && ( $args['themo-animation-styles'] !== 'none' ) ) {
		array_push( $attributes['class'], $args['themo-animation-styles'], 'hide-animation', 'widget-animate' );
	}
	return $attributes;
}
endif;
add_filter( 'siteorigin_panels_widget_style_attributes', 'themovation_so_wb_animation_attribute', 10, 2);
